<x-slot name="header">
    <h1 class="text-center">Courses List</h1>
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

            @if($coursesMode)
            @include('livewire.admin-dashboard.courses')
            @endif
            @if($studentsMode)
            @include('livewire.admin-dashboard.students')
            @endif
            @if($sectionsMode)
            @include('livewire.admin-dashboard.sections')
            @endif
        </div>

    </div>
</div>
