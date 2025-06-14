<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $table = 'specialists'; 

    protected $fillable = ['physio', 'treatment'];

    public function physio()
    {
        return $this->belongsTo(User::class, 'physio');
    }

    public function treatmentModel()
    {
        return $this->belongsTo(Treatment::class, 'treatment');
    }
}
