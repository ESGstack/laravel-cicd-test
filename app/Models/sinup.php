<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class sinup extends Model
{
    use HasApiTokens;

    protected $fillable = ['name', 'password', 'email', 'address', 'image'];
}
