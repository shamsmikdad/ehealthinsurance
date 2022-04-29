<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable =[
       'pharmacist_id',
       'patient_id',
       'drug_id',
       'date',
       'paidValue'
    ];
}
