<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Doctor $doctor)
    {
        return view('doctors.showdetail',compact('doctor'));
    }

    public function list(Doctor $doctor)
    {
        $appointments = Appointment::where('user_id', auth()->id())->where('doctor_id',$doctor->id)->get();

        return view('doctors.appointments', compact('appointments'));
    }

    public function store(Doctor $doctor, AppointmentRequest $request)
    {
      

        Appointment::create([
            'doctor_id' => $doctor->id,
            'user_id' => auth()->id(),
            'date' => $request->input('date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Appointment booked succesfully!');
    }

    public function edit(Appointment $appointment)
    {
        return view('doctors.appointments-edit', compact('appointment'));
    }
}
