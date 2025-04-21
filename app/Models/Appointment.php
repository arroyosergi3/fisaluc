<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'physio_id',
        'patient_id',
        'treatment_id',
        'date',
        'time',
    ];

public function treatment()
{
    return $this->belongsTo(Treatment::class);
}
public function patient()
{
    return $this->belongsTo(User::class);
}
public function physio()
{
    return $this->belongsTo(User::class);
}

}
