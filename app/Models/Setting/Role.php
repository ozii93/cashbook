<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting\Menu;
use App\Models\User;


class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Relasi ke User (Satu role bisa memiliki banyak user)
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    /**
     * Relasi ke Menu melalui RoleAccess
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'roles_access', 'role_id', 'menu_id')
                    ->withPivot(['can_create', 'can_approve', 'can_update', 'can_delete', 'can_print'])
                    ->withTimestamps();
    }
    
    
}
