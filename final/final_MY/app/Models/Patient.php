<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'Img',
        'name',
        'email',
        'number',
        'disc',
        'doctor_id',
        
    ];

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function Appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
