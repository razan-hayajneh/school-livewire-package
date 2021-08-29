<div class="text-teal-900 px-4 py-3 ">
  <button wire:click="back()" class="px-6 py-2 text-white bg-indigo-600 text-center shadow rounded-lg" type="button">Back to Course</button>
</div>

<div class="px-6 py-2 text-white bg-indigo-600" role="alert">
    <p class="text-center text-xl">Course Name: {{$sections->course->name}} -------  Section Number: {{ $sections->section_number  }} </p>

    </div>


<table class="table-fixed w-full">
    <thead>
        @if (!$sections->students->isEmpty())
        <tr class="bg-gray-100">
            <th class="px-4 py-2 w-10 ">No.</th>
            <th class="px-6 py-2 w-10 ">Student Name</th>
            <th class="px-4 py-2 w-10 ">Email</th>
            <th class="px-4 py-2 w-10 ">First Mark</th>
            <th class="px-4 py-2 w-10 ">Second Mark</th>
            <th class="px-4 py-2 w-10">Final Mark</th>
            <th class="px-4 py-2 w-10 ">Action </th>
        </tr>


    </thead>
    <tbody>
        @foreach ($sections->students as $student)
        <tr>
            <td class="border px-4 py-2 ">{{$loop->index + 1}}</td>
            <td class="border px-4 py-2 ">{{ $student->name}}</td>
            <td class="border px-4 py-2 ">{{$student->user->email}}</td>
            <td class="border" >
                 {{$student->pivot->first}}
            </td>
            <td class="border" >
                {{$student->pivot->mid}}

            </td>
            <td class="border" >
                {{$student->pivot->final}}


            </td>
            <td class="border" >
                <button  wire:click="edit({{$student->id}} , {{$sections->id}})" class=" text-white bg-indigo-600 flex flex-1 h-full p-2 border shadow rounded-lg" type="button"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                  </svg>Update Mark</button>
                  @if($isModalOpen)
                  @include('livewire.teacher-dashboard.updatemarks')
                  @endif
        </td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>
@else
<p class="text-center text-red-600 text-xl px-6 py-2"><b>No Student in this section</b></p>
@endif


