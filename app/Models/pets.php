<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\petowners;


class pets extends Model
{
    use HasFactory;
    
    protected $table = 'pets';
    protected $primaryKey = 'pet_id';

    protected $fillable = [
        'registration_number',
        'name',
        'type',
        'breed',
        'age',
        'color',
        'gender',
        'special_notes',
        'petowner_id'
    ];

    public function petowner()
    {
        return $this->belongsTo(petowners::class, 'petowner_id');
    }
}
