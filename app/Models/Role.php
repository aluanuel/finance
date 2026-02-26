<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public const IS_DEV = 1;
    public const IS_ADMIN = 2;
    public const IS_MANAGER = 3;
    public const IS_EDITOR = 4;
    public const IS_USER = 5;
}
