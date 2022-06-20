<x-app-layout>
    <x-slot:title>Venue</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Venue #{{ $venue->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div><strong>Name:</strong> {{ $venue->name }}</div>

                    <div>
                        <a href="/venues/{{  $venue->id }}/edit">Edit</a>

                        <form method="POST" action="/venues/{{ $venue->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>

                        <a href="/venues">Back</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
