<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectedCandidate extends Model
{
    protected $fillable = [
        'registration_number',
        'full_name',
        'email',
        'phone',
        'position',
        'resume',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'registration_number', 'registration_number');
    }
}
