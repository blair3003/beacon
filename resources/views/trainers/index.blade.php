<x-app-layout>
    <x-slot:title>Trainers</x-slot>

    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Trainers</h2>
        <a href="/trainers/create">Create new trainer</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trainers as $trainer)
                            <tr>
                                <td><a href="/trainees/{{ $trainer->trainee->id }}">{{ $trainer->id }}</a></td>
                                <td>{{ $trainer->trainee->first_name }}</td>
                                <td>{{ $trainer->trainee->last_name }}</td>
                                <td>{{ $trainer->trainee->email }}</td>                              
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>