<table class="table table-striped table-fixed w-full ">
    <div class="px-4 py-2">
    <button wire:click="switchToCoursesMode()"
    class="px-6 py-2 text-white bg-indigo-600" type="button">Back
    </button>
    <button wire:click="createSection()"
    class="px-6 py-2 text-white bg-indigo-600" type="button">Add New Section
    </button>
    </div>
    @if($isSectionCreateOpen)
    @include('livewire.admin-dashboard.section-create')
    @endif
    <tr class="bg-gray-100">

        <th>section number</th>
        <th>Teacher name</th>
        <th>Actions</th></tr>


     @foreach($sections as $section)
         @if($section->course_id == $courseId )
        <tr>

            <td class="border px-4 py-2">{{ $section->section_number }}</td>
            <td class="border px-4 py-2">{{ $section->teacher->name }}</td>
          <td class="border px-4 py-2">
                <button wire:click="editSection({{ $section->id }})" class="px-6 py-2 text-white bg-indigo-600" type="button"
                   >Edit</button>
                   @if($isUpdateSectionOpen)
                   @include('livewire.admin-dashboard.section-edit')
                   @endif


                    <button wire:click="switchMode({{ $section->id }})" class="px-6 py-2 text-white bg-indigo-600" type="button"
                        >students</button>
                        @if (count($section->students) == 0)
                        <button wire:click="confirmDeleteSection({{ $section->id }})"class="px-6 py-2 text-white bg-red-600 " type="button"
                         >Delete</button>

                         @if($isSectionAlertOpen)
                         @include('livewire.admin-dashboard.section-delete')
                         @endif
                         @endif


            </td>
        </tr>
@endif
        @endforeach
    </table>
