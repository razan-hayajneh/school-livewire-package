
<ul class="flex mt-3  text-indigo-600 ">
    <li class="mr-6">
      <a class="text-xl" href="#">Upload Task for Student:</a>
    </li>
  </ul>

    <div class="md:flex md:items-center mb-6">
      <div class="md:w-1/3">
        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
           File Title:
        </label>
      </div>
      <div class="md:w-2/3">
        <input class="bg-gray-200 appearance-none border-2 border-gray-20 rounded w-40 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
        type="text"  placeholder="Enter File Title" wire:model="title">
        @error('title') <span class="text-red-500">* {{ $message }}</span>@enderror

    </div>
    <div class="md:w-1/3">
        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
           Upload File:
        </label>
      </div>
      <div class="md:w-2/3">
        <input class="bg-gray-200 appearance-none border-2 border-gray-20 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
        type="file"  placeholder="Enter File Title" wire:model="attachment">
        <button wire:click="submit()" class="px-6 py-2 text-white bg-indigo-600 text-center shadow rounded-lg" type="submit">Save</button>
        @error('attachment') <span class="text-red-500">* {{ $message }}</span>@enderror

    </div>
    @if(session()->has('message1'))
        <div class="text-green-500">
        * {{ session('message1') }}
        </div>
    @endif
    </div>








