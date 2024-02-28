<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\Availability;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $doctorId = $this->route('doctor');

        return [
            'date' => 'required|date|after_or_equal:today',
            'start_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($doctorId) {
                    $end_time = $this->input('end_time');
                    $selectedDate = $this->input('date');
    
                    $existingAppointments = Appointment::where('doctor_id', $doctorId->id)
                        ->where('date', $selectedDate)
                        ->where('start_time', '<=', $value)
                        ->where('end_time', '>', $value)
                        ->count();
    
                    if ($existingAppointments > 0) {
                        $fail('The selected start time overlaps with an existing appointment.');
                    }
                    $userBookingCount = Appointment::where('doctor_id', $doctorId->id)
                    ->where('date', $selectedDate)
                    ->where('user_id', auth()->id())
                    ->count();

                if ($userBookingCount > 0) {
                    $fail('You have already booked an appointment for the selected date.');
                }
                
                },
            ],
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
    
    }
}
