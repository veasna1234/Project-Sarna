<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'tbl_user';
    protected $fillable = [
        'user_id',
        'user_name',
        'email',
        'user_image',
        'password'
    ];
}
