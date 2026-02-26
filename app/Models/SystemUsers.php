<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'telephone',
        'email',
        'usertype',
        'id_role',
        'category',
        'user_status',
        'password',
    ];
}
