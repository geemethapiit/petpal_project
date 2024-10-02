<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ServiceType extends Model
{
    protected $table = 'servicetypes';
    protected $primaryKey = 'service_type_id';

    protected $fillable = ['name', 'description', 'image'];

    public function subServices()
    {
        return $this->hasMany(SubService::class, 'service_type_id');
    }
}
