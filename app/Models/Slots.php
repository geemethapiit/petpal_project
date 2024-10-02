<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slots extends Model
{
    use HasFactory;

    protected $table = 'slots';
    protected $primaryKey = 'slot_id';

    protected $fillable = [
        'service_provider_id',
        'service_type_id',
        'start_time',
        'end_time',
        'slot_duration',
        'slot_count'
    ];


    public function serviceprovider()
    {
        return $this->belongsTo(serviceprovider::class, 'provider_id');
    }

    public function servicetype()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

}
