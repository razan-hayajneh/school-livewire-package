
<x-slot name="header">
    <h1 class="text-center text-xl font-black"><b>Course<b></h1>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if($taskMode && !$studentMode)
            @include('livewire.teacher-dashboard.teacher-task')
            @endif
            @if($studentMode)
            @include('livewire.teacher-dashboard.showstudent')
            @endif

            @if($courseMode)
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-10 ">No.</th>
                        <th class="px-4 py-2 w-10 ">Course Name</th>
                        <th class="px-4 py-2 w-10 ">Section-Number</th>
                        <th class="px-4 py-2 w-10 ">Show Student</th>
                        <th class="px-4 py-2 w-10 ">Task</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $value)
                    <tr>
                        <td class="border px-4 py-2 ">{{$loop->index + 1}}</td>
                        <td class="border px-4 py-2 ">{{ $value->course->name }}</td>
                        <td class="border px-4 py-2 ">{{$value->section_number }}</td>
                        <td class="border px-4 py-2 ">
                        <button wire:click="showStudent({{$value->id }})" class="px-6 py-2 text-white bg-indigo-600" type="button">Show Student</button>
                        </td>
                        <td class="border px-4 py-2 ">
                            <button wire:click="showTask({{$value->id}})" class="px-6 py-2 text-white bg-indigo-600" type="button">Task</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    @endif

</div>
