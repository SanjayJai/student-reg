<?php

namespace App\Http\Controllers;

use App\Mail\InterviewRegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

class InterviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'position' => 'required|string',
            'qualification' => 'required|string',
            'institution' => 'required|string',
            'year_passing' => 'required|string',
            'specialization' => 'required|string',
            'skills' => 'nullable|string',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        // Generate Unique Registration Number (RBS00012025 -> RBS00022025)
        $lastCandidate = Candidate::latest()->first();
        $regPrefix = 'RBS';
        $nextNumber = $lastCandidate ? intval(substr($lastCandidate->registration_number, 3, 4)) + 1 : 1;
        $registrationNumber = $regPrefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT) . '2025';

        // Handle Resume Upload
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        // Save candidate details in DB
        $candidate = Candidate::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'position' => $request->position,
            'qualification' => $request->qualification,
            'institution' => $request->institution,
            'year_passing' => $request->year_passing,
            'specialization' => $request->specialization,
            'skills' => $request->skills,
            'registration_number' => $registrationNumber,
            'resume' => $resumePath, // Store resume path
        ]);

        // Send Email to User
        Mail::to($candidate->email)->send(new InterviewRegistrationMail($candidate, $registrationNumber));

        return back()->with('success', 'Form submitted successfully! Check your email for your registration number.');
    }
}
