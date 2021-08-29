<x-slot name="header">
    <h1 class="text-center">Students List</h1>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <h2 class="text-sm text-center">{{ session('message') }}</h2>
                    </div>
                </div>
            </div>
            @endif
            <div class="px-4 py-2">
            <button wire:click="create()"
            class="px-6 py-2 text-white bg-indigo-600" type="button">Add New Student
            </button>
            </div>
            @if($isModalOpen)
            @include('livewire.admin-dashboard.create')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-2 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->index +1 }}</td>
                        <td class="border px-4 py-2">{{ $student->name }}</td>
                        <td class="border px-4 py-2">{{$student->user->email }}</td>
                        <td class="border px-4 py-2">{{ $student->phone}}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $student->id }})" class="px-6 py-2 text-white bg-indigo-600" type="button"
                               >Edit</button>
                               @if($isUpdateOpen)
                               @include('livewire.admin-dashboard.edit')
                               @endif

                            <button wire:click="confirm({{ $student->id }})"class="px-6 py-2 text-white bg-red-600 " type="button"
                                >Delete</button>
                                @if($isAlertOpen)
                                @include('livewire.admin-dashboard.student-delete')
                                @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
