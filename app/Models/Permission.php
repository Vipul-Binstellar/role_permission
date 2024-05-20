<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'module_permission';

    protected $fillable = [
	    'role_id',
	    'module',
	    'read',
	    'create',
	    'update',
	    'delete'
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
