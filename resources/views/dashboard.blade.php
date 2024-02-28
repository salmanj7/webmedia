<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            @if (auth()->user()->is_admin == 1)
                <a href="{{ route('doctor.create') }}" class="bg-blue-500 text-blue px-4 py-2 inline-block">Create Doctor</a>
            @endif
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($doctors as $doctor)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 flex flex-col">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $doctor->name }}</h3>
                            <p class="text-gray-600">{{ $doctor->specialization }}</p>
                            <p class="text-sm text-gray-400 mt-2">
                                Available Days: {{ implode(', ', $doctor->availableDays) }}
                            </p>
                        </div>
                        @if (auth()->user()->is_admin == 0)
                            <a href="{{ route('appointments.list', ['doctor' => $doctor->id])}}" class="bg-green-500 text-green-900 px-4 py-2 inline-block ml-4">My Appointments</a>
                        @endif
                        
                        @if (auth()->user()->is_admin == 0)
                            <a href="{{ route('appointment.show', ['doctor' => $doctor->id])}}" class="bg-blue-500 text px-4 py-2 mt-4 ml-auto inline-block">Book Now</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
