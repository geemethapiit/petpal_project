<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointment';
    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'service_provider_id',
        'service_type_id',
        'petowner_id',
        'pet_id',
        'date',
        'start_time',
        'status',
    ];

    public function serviceprovider()
    {
        return $this->belongsTo(serviceprovider::class, 'provider_id');
    }

    public function servicetype()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public function petowner()
    {
        return $this->belongsTo(petowners::class, 'petowner_id');
    }

    public function pet()
    {
        return $this->belongsTo(pets::class, 'pet_id');
    }
}
