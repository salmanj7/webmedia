<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoctorRequest;
use App\Models\Availability;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function create()
    {
        $doctors=Doctor::all();
        return view('doctors.create',compact('doctors'));
    }

    public function store(CreateDoctorRequest $request)
    {
        $doctor = Doctor::create([
            'name' => $request->input('name'),
            'specialization' => $request->input('specialization'),
        ]);

        foreach ($request->input('available_days') as $day) {
            $doctor->availability()->create([
                'doctor_id' => $doctor->id,
                'day' => $day,
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ]);
        }
        
        return redirect()->route('dashboard')->with('success', 'Doctor created successfully!');
    }

    public function dashboard()
    {
        $doctors = Doctor::with('availability')->get();
        $doctors->load('availability');
        return view('dashboard', compact('doctors'));
    }
}
