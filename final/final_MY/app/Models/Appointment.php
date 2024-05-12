<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Appointment extends Model
{
    protected $fillable = ['doctor_id', 'patient_id','patient_name', 'appointment_date', 'appointment_time','Note'];
    public function Doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
}
