
<x-slot name="header">
    <h1 class="text-center text-xl font-black"><b>Task<b></h1>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            <table class="table-fixed w-full">
                <thead class="bg-gray-100">
                    @if (!$sections->isEmpty()) 
                    <tr>
                        <th class="px-4 py-2 w-10 ">No.</th>
                        <th class="px-4 py-2 w-10 ">Course Name</th>
                        <th class="px-4 py-2 w-10 ">Section-Number</th>
                        <th class="px-4 py-2 w-10 ">Task Title</th>
                        <th class="px-4 py-2 w-10 ">Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section )
                    @foreach ($section->tasks as $task )
                    <tr>
                        <td class="border px-4 py-2 ">{{$loop->index + 1}}</td>
                        <td class="border px-4 py-2 ">{{$section->course->name}}</td>
                        <td class="border px-4 py-2 ">{{$section->section_number}}</td>
                        <td class="border px-4 py-2 ">{{$task->title}}</td>
                        <td class="border px-4 py-2 ">

                        <button wire:click="export({{$task->id}})" type="button"  class="bg-grey-light hover:bg-grey text-grey-darkest font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                            <span>Download</span>
                            </button>


                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
            <br>
@else
<p class="text-center text-red-600 text-xl px-6 py-2"><b>No Task </b></p>
@endif



