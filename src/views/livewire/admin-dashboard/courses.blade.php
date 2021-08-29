<div class="px-4 py-2">
    <button wire:click="create()"
    class="px-6 py-2 text-white bg-indigo-600" type="button">Add New Course
    </button>
    </div>
    @if($isModalOpen)
    @include('livewire.admin-dashboard.course-create')
    @endif

    <table class="table-fixed w-full">
        <thead>
            <tr class="bg-gray-100">

                <th class="px-4 py-2">Course Name</th>

                <th class="px-2 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>

                <td class="border px-4 py-2">{{ $course->name }}</td>



                <td class="border px-4 py-2">
                    <button wire:click="edit({{ $course->id }})" class="px-6 py-2 text-white bg-indigo-600" type="button"
                       >Edit</button>
                       <button wire:click="switchToSectionsMode({{ $course->id }})" class="px-6 py-2 text-white bg-indigo-600" type="button"
                        >Sections</button>
                       @if($isUpdateOpen)
                       @include('livewire.admin-dashboard.course-update')
                       @endif

                       @if (count($course->sections) == 0)
                       <button wire:click="confirm({{ $course->id }})"class="px-6 py-2 text-white bg-red-600 " type="button"
                        >Delete</button>
                        @if($isAlertOpen)
                        @include('livewire.admin-dashboard.course-delete')
                        @endif
                         @endif

                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
