<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ServiceProvider extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'service_providers';
    protected $primaryKey = 'provider_id';

    protected $fillable = [
        'business_name',
        'business_license_no',
        'contact_no',
        'email',
        'password',
        'status',
    ];
}
