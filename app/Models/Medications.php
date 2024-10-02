<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medications extends Model
{
    use HasFactory;

    protected $table = 'medications';
    protected $primaryKey = 'medication_id';

    protected $fillable = [
        'medication_name',
        'medication_dosage',
        'medication_frequency',
        'medication_duration',
        'medication_notes',
        'medication_file_url',
        'pet_id',
        'veterinarian_id',
        'service_provider_id'
    ];

    public function pet()
    {
        return $this->belongsTo(Pets::class, 'pet_id', 'pet_id');
    }

    public function veterinarian()
    {
        return $this->belongsTo(Person::class, 'veterinarian_id', 'person_id');
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProviders::class, 'service_provider_id', 'provider_id');
    }   
}
