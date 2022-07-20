<x-app-layout>
    <x-slot:title>Courses</x-slot>

    <x-slot:header>
        <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight">Courses</h2>
        <x-link url="{{ route('courses.create') }}">Create new Course</x-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td><a href="/courses/{{ $course->id }}">{{ $course->title }}</a></td>
                                <td>{{ $course->description }}</td>                             
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>