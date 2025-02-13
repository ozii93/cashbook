<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting\Role;
use App\Models\Setting\Menu;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Mendapatkan menu berdasarkan role user
     */
    public function getMenuByRole()
    {
        // Pastikan user memiliki role_id
        if (!$this->role_id) {
            return collect([]); // Kembalikan koleksi kosong jika role_id tidak ada
        }

        // Cache key untuk menyimpan menu berdasarkan user ID
        $cacheKey = 'user_menu_' . $this->id;

        // Hapus cache selama pengujian (bisa dihapus jika sudah tidak perlu debugging)
        Cache::forget($cacheKey);

        return Cache::remember($cacheKey, 3600, function () {
            $role = Role::with(['menus' => function ($query) {
                $query->where('is_active', 1)
                    ->orderBy('order'); // Pastikan diurutkan berdasarkan parent_id
            }])->find($this->role_id);

            if ($role) {
                // Ambil semua menu dengan relasi lengkap
                $menus = $role->menus;

                // Buat struktur hierarki menu
                return $this->buildMenuHierarchy($menus);
            }

            return collect([]);
        });
    }

    /**
     * Fungsi untuk membangun hierarki menu berdasarkan parent_id.
     */
    protected function buildMenuHierarchy($menus)
    {
        $menuByParent = $menus->groupBy('parent_id');

        // Fungsi rekursif untuk membangun hierarki
        $buildMenu = function ($parentId) use (&$buildMenu, $menuByParent) {
            return $menuByParent->get($parentId, collect())->map(function ($menu) use ($buildMenu) {
                $menu->children = $buildMenu($menu->id); // Ambil anak-anak menu
                return $menu;
            });
        };

        // Mulai dari parent_id = null (menu level 1)
        return $buildMenu(null);
    }
}
