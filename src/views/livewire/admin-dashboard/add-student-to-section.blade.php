<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="h-screen p-6 flex item-center justify-center">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 ">

                    <div class="mb-4 ">
                            <div class="block text-gray-700 text-sm font-bold mb-2 ">
                                <x-jet-label for="student" value="{{ __('Student') }}" />

                                <select wire:model="student" required class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option value="choose">choose student..</option>
                                    @foreach ( $students as $student )
                                   <option value="{{ $student->id }}">{{ $student->name }}</option>
                                   @endforeach


                                </select>
                                @error('student') <span class="text-red-500">{{ $message }}</span>@enderror


                            </div>

                    </div>
            </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="px-6 flex w-full rounded-md sm:ml-3 sm:w-auto">
                        <button wire:click="addStudentToSection()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Add
                        </button>
                    </span>
                    <span class="px-6 mt-3 flex w-full rounded-md sm:mt-0 sm:w-auto">
                        <button wire:click="closeModalPopover()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Close
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
