<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400 ">
    <div class="h-screen p-6 flex items-center justify-center">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form  style="text-align: left;">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                   <div class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"> Student: {{$studentName}}</div></div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4 ">
                            <form class="w-full max-w-sm">
                                <div class="md:flex md:items-center mb-6">
                                  <div class="md:w-1/3">
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                        First Mark:
                                    </label>
                                  </div>
                                  <div class="md:w-2/3">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-20 rounded w-40 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                    type="text"  placeholder="Enter First Mark" wire:model="firstMark">
                                    @error('firstMark') <span class="text-red-500">{{ $message }}</span>@enderror

                                    <button wire:click.prevent="updateFirst()" type="button"
                                    class="bg-indigo-600 shadow rounded-lg inline-flex justify-center w-40 rounded-md border border-transparent px-4 py-2  text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                   Save
                                </button>
                                @if (session()->has('message1'))
                                <div>
                                    <h2 class="text-sm  text-green-500">{{ session('message1') }}</h2>
                                </div>
                                @endif
                                </div>
                                </div>

                                <div class="md:flex md:items-center mb-6">
                                    <div class="md:w-1/3">
                                      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                          Second Mark:
                                      </label>
                                    </div>
                                    <div class="md:w-2/3">
                                      <input class="bg-gray-200 appearance-none border-2 border-gray-20 rounded w-40 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                      type="text"  placeholder="Enter Second Mark" wire:model="secondMark">
                                      @error('secondMark') <span class="text-red-500">{{ $message }}</span>@enderror

                                      <button wire:click.prevent="updateSecond()" type="button"
                                      class="bg-indigo-600 shadow rounded-lg inline-flex justify-center w-40 rounded-md border border-transparent px-4 py-2  text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                     Save
                                  </button>
                                  @if (session()->has('message2'))
                                    <div>
                                        <h2 class="text-sm  text-green-500">{{ session('message2') }}</h2>
                                    </div>
                                    @endif
                                  </div>
                                  </div>

                                  <div class="md:flex md:items-center mb-6">
                                    <div class="md:w-1/3">
                                      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                          Final Mark:
                                      </label>
                                    </div>
                                    <div class="md:w-2/3">
                                      <input class="bg-gray-200 appearance-none border-2 border-gray-20 rounded w-40 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                      type="text"  placeholder="Enter Final Mark" wire:model="finalMark">
                                      @error('finalMark') <span class="text-red-500">{{ $message }}</span>@enderror

                                      <button wire:click.prevent="updateFinal()" type="button"
                                      class="bg-indigo-600 shadow rounded-lg inline-flex justify-center w-40 rounded-md border border-transparent px-4 py-2  text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                     Save
                                  </button>
                                  @if (session()->has('message3'))
                                  <div>
                                      <h2 class="text-sm  text-green-500">{{ session('message3') }}</h2>
                                  </div>
                                  @endif
                                  </div>
                                </div>
                              </form>
                    </div>
                </div>
              <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                    <span class="mt-3 flex w-70 rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Close
                        </button>

                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

