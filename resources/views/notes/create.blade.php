<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <style>
        .custom-border {
            border: 1px solid #ccc; /* Adjust the border thickness and color as needed */
            padding: 10px; /* Add padding inside the border */
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-inherit border-gray-200  shadow-sm sm:rounded-lg custom-border">
                <form action="{{ route('notes.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-text-input
                            type="text"
                            name="title"
                            field="title"
                            placeholder="Title"
                            class="w-full h-12"
                            aria-autocomplete="off"
                            :value="old('title')"
                        />
                    </div>

                    <div class="mb-4">
                        <x-textarea
                            name="text"
                            field="text"
                            rows="8"
                            placeholder="Start Typing here..."
                            class="w-full bg-gray-00 text-black dark:text-black border dark:bg-gray-900 border-gray-300 "
                            :value="old('text')"
                        />
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-white">Upload Image</label>
                        <input type="file" name="image" id="image" class="mt-1 block w-full text-gray-700 dark:text-gray-200">
                    </div>
                    

                    <div class="mb-4 dark:text-gray-100 ">
                        <button type="submit" name="button" class="ml-auto px-4 py-2 bg-green-600 text-white dark:text-gray-100 rounded hover:bg-green-700 dark:hover:bg-green-500" >Save Note</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
