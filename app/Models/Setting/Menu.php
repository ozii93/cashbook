<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'm_menu'; // Nama tabel
    protected $fillable = [
        'parent_id',
        'name',
        'url',
        'icon',
        'level',
        'is_active',
        'order',
        'breadcrumb'
    ];

    /**
     * Relasi ke Role melalui RoleAccess
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_access', 'menu_id', 'role_id')
            ->withPivot(['can_create', 'can_approve', 'can_update', 'can_delete', 'can_print'])
            ->withTimestamps();
    }


    /**
     * Relasi ke Parent Menu (untuk hierarki menu)
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Relasi ke Child Menu
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
