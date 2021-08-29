<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400 rounded-md">
    <div class="h-screen p-6 flex item-center justify-center">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>


        <div class=" align-top bg-white rounded-md text-center shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <br>
               <h1>Are You Sure you want to Delete this task?</h1><br>
                <div class="bg-gray-50 px-4 py-3 rounded-md sm:px-6 sm:flex sm:flex-row-reverse">

                    <span class="flex w-full justify-start rounded-md shadow-sm sm:ml-3 sm:w-auto">

                        <button   wire:click="delete()" type="button"
                            class="px-6 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Yes, Delete Task
                        </button>
                    </span>
                    <span class="px-6 mt-3 flex justify-end w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" type="button"
                            class=" inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Close
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
