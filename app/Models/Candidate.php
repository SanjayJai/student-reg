<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'email', 'phone', 'dob', 'gender', 'address', 
        'position', 'qualification', 'institution', 'year_passing', 
        'specialization', 'skills', 'registration_number','resume'
    ];
}
