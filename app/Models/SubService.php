<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    protected $table = 'subservices';
    protected $primaryKey = 'subservice_id';

    protected $fillable = ['service_type_id', 'name', 'description', 'price'];

    // Define the relationship to the ServiceType model

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id', 'service_type_id');
    }
}