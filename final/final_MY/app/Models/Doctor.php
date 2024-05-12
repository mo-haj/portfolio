<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name','number', 'spec_id','disc','email'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function Patients()
    {
        return $this->hasMany(Patient::class);
    }
}
