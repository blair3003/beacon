<x-app-layout>
    <x-slot:title>Trainee</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $trainee->full_name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div><strong>First name:</strong> {{ $trainee->first_name }}</div>
                    <div><strong>Last name:</strong> {{ $trainee->last_name }}</div>
                    <div><strong>Email:</strong> {{ $trainee->email }}</div>
                    <div><strong>Trainer?:</strong> {{ $trainee->isTrainer() ? 'Yes' : 'No' }}</div>

                    <div>
                        <a href="/trainees/{{ $trainee->id }}/edit">Edit</a>

                        <form method="POST" action="/trainees/{{ $trainee->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>

                        <a href="/trainees">Back</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>