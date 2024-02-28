<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">Your Appointments</h3>

                @if ($appointments->count() > 0)
                    <ul>
                        @foreach ($appointments as $appointment)
                            <li>
                                {{ $appointment->date }} - {{ $appointment->start_time }} to {{ $appointment->end_time }}
                                <a href="{{ route('appointments.edit', $appointment->id) }}">Edit</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No appointments found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
