<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAccess extends Model
{
    use HasFactory;

    protected $table = 'roles_access'; // Nama tabel
    protected $fillable = [
        'role_id', 
        'menu_id', 
        'can_create', 
        'can_approve', 
        'can_update', 
        'can_delete', 
        'can_print'
    ];

    /**
     * Relasi ke Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Relasi ke Menu
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
