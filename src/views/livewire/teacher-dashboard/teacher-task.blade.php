<div class="text-teal-900 px-4 py-3 ">
    <button wire:click="back()" class="px-6 py-2 text-white bg-indigo-600 text-center shadow rounded-lg" type="button">Back to Course</button>
</div>

            <table class="table-fixed w-full">
                <thead class="bg-gray-100">
                    @if (!$tasks->isEmpty())
                    <tr>
                        <th class="px-4 py-2 w-10 ">No.</th>
                        <th class="px-4 py-2 w-10 ">Task Title</th>
                        <th class="px-4 py-2 w-10 ">Download</th>
                        <th class="px-4 py-2 w-10 ">Delete</th>
                    </tr>
                </thead>
                 <tbody>

                    @foreach ($tasks as $task )
                    <tr>
                        <td class="border px-4 py-2 ">{{$loop->index + 1}}</td>
                        <td class="border px-4 py-2 ">{{$task->title}}</td>
                        <td class="border px-4 py-2 ">

                        <button wire:click="export({{$task->id}})" type="button"  class="bg-grey-light hover:bg-grey text-grey-darkest font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                            <span>Download</span>
                            </button>


                        </td>
                        <td class="border px-4 py-2 ">
                            <button wire:click="confirm({{$task->id }})"class="px-6 py-2 text-white bg-red-600 " type="button"
                                >Delete</button>
                             @if($isAlertOpen)
                            @include('livewire.teacher-dashboard.delete-task')
                            @endif
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <br>
@else
<p class="text-center text-red-600 text-xl px-6 py-2"><b>No Task </b></p>
@endif
<div class="flex justify-between ...">
    <button wire:click="openFileMode()"class="px-6 py-2 text-white bg-indigo-600 shadow rounded-lg" type="button">Upload Task</button>
</div>
@if($fileMode)
@include('livewire.teacher-dashboard.uploadfile')
@endif



