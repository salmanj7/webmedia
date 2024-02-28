<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">{{ $appointment->doctor->name }}</h3>
                <p class="text-gray-600">{{ $appointment->doctor->specialization }}</p>
                <p class="text-sm text-gray-400 mt-2">
                    Available Days: {{ implode(', ', $appointment->doctor->availableDays) }}
                </p>
                <form action="#" method="POST">
                    @csrf
                    @method('PUT') 
                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700">Appointment Date</label>
                        <input type="date" name="date" id="date" class="mt-1 p-2 border rounded-md w-full" value="{{ $appointment->date }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" name="start_time" id="start_time" class="mt-1 p-2 border rounded-md w-full" value="{{ $appointment->start_time }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" name="end_time" id="end_time" class="mt-1 p-2 border rounded-md w-full" value="{{ $appointment->end_time }}" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text px-4 py-2 rounded-md">Update Appointment</button>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
