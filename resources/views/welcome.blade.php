@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-500 to-purple-600 px-4">
    <div class="max-w-4xl w-full bg-white p-8 rounded-lg shadow-xl ">
        <div class="text-center mb-6">
            <img src="{{ asset('images/company-logo.png') }}" alt="Company Logo" class="mx-auto h-20">
        </div>
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-700">Interview Candidate Form</h2>
        
        @if(session('success'))
            <div class="mb-4 text-green-600 text-center font-semibold">{{ session('success') }}</div>
        @endif

        <form action="{{route('interview.store')}}" method="POST" class="grid grid-cols-2 gap-6" enctype="multipart/form-data">
            @csrf
            
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="full_name" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="dob" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" rows="2"></textarea>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Applying Position</label>
                <select name="position" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500">
                    <option>Web Developer</option>
                    <option>Software Engineer</option>
                    <option>Digital Marketing Executive</option>
                    <option>Cyber Security Analyst</option>
                    <option>HR Executive</option>
                    <option>Graphic Designer</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Highest Qualification</label>
                <input type="text" name="qualification" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Institution/University Name</label>
                <input type="text" name="institution" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Year of Passing</label>
                <input type="text" name="year_passing" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Specialization</label>
                <input type="text" name="specialization" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Relevant Skills</label>
                <textarea name="skills" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" rows="2"></textarea>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Resume (PDF/DOCX)</label>
                <input type="file" name="resume" accept=".pdf,.doc,.docx" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="col-span-2 text-center">
                <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-8 py-3 rounded-lg shadow-md hover:shadow-xl transform hover:scale-105 transition-transform duration-300">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
