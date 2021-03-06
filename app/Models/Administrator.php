<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $primaryKey = 'administrator_id';
    protected $fillable = [
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password'
    ];
}
