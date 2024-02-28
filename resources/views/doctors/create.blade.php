<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Doctor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('doctor.store') }}"   method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Doctor's Name</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
                            <input type="text" name="specialization" id="specialization" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Available Days</label>
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                            <div class="flex items-center">
                                <input type="checkbox" name="available_days[]" value="{{ $day }}" class="mr-2">
                                <span>{{ $day }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                            <input type="text" name="start_time" id="start_time" class="mt-1 p-2 border rounded-md w-full" placeholder="e.g., 9:00 AM" required>
                        </div>


                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                            <input type="text" name="end_time" id="end_time" class="mt-1 p-2 border rounded-md w-full" placeholder="e.g., 9:30 AM" required>
                        </div>


                        <div class="mt-4">
                            <button type="submit">Save Doctor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>