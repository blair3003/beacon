<x-app-layout>
    <x-slot:title>Trainees</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Trainees</h2>
        <a href="/trainees/create">Create new trainee</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr class="text-left">
                                <th class="w-1/5">ID</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trainees as $trainee)
                            <tr>
                                <td><a href="/trainees/{{ $trainee->id }}">{{ $trainee->id }}</a></td>
                                <td>{{ $trainee->first_name }}</td>
                                <td>{{ $trainee->last_name }}</td>
                                <td>{{ $trainee->email }}</td>                              
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    <div>{{ $trainees->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>