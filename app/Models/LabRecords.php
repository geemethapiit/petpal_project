<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabRecords extends Model
{
    use HasFactory;

    protected $table = 'lab_results';
    protected $primaryKey = 'lab_id';

    protected $fillable = [
        'test_name',
        'results',
        'test_date',
        'reference_result',
        'veterinarian_notes',
        'result_file_url',
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
