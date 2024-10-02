<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class petowners extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'petowners';
    protected $primaryKey = 'petowner_id';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'password',
        'profile_photo_path',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pets()
    {
        return $this->hasMany(pets::class, 'petowner_id');
    }
}
