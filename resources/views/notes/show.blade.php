<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !$note->trashed() ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <div class="flex">
                @if (!$note->trashed())
                    <p class="opacity-70 mr-8 dark:text-gray-100">
                        <strong>Created: </strong>{{ $note->created_at->format('Y-m-d H:i') }}
                    </p>
                    <p class="opacity-70 ml-3 dark:text-gray-100">
                        <strong>Updated: </strong>{{ $note->updated_at->format('Y-m-d H:i') }}
                    </p>

                    <div class="ml-auto">

                        <div class="flex items-center space-x-2"> <!-- Flex container with space between buttons -->
                            <a href="{{ route('notes.edit', $note->uuid) }}">

                                <button type="submit"
                                    class="ml-auto px-4 py-2 bg-blue-800 text-white dark:text-gray-100 rounded hover:bg-blue-700 dark:hover:bg-blue-700">Edit
                                    Note</button>
                            </a>


                            <form action="{{ route('notes.destroy', $note->uuid) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit"
                                    class="ml-auto px-4 py-2  text-white bg-red-800 dark:text-gray-100 rounded hover:bg-red-700 dark:hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to remove this note?')">
                                    Move To Trash
                                </button>

                            </form>
                        </div>


                    </div>


                    {{-- Else statement --}}
                @else
                    <p class="opacity-70 mr-8 dark:text-gray-100">
                        <strong>Deleted: </strong>{{ $note->deleted_at->format('Y-m-d H:i') }}
                    </p>

                    <div class=" flex items-center space-x-2 ml-auto">

                        <form action="{{ route('trashed.update', $note->uuid) }}" method="post" class="ml-auto">
                            @method('put')
                            @csrf

                            <button type="submit"
                                class="ml-auto px-4 py-2 bg-blue-800 text-white dark:text-gray-100 rounded hover:bg-blue-700 dark:hover:bg-blue-700">
                                Restore Note
                            </button>

                        </form>

                        <form action="{{ route('trashed.destroy', $note->uuid) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="ml-auto px-4 py-2  text-white bg-red-800 dark:text-gray-100 rounded hover:bg-red-700 dark:hover:bg-red-700">Delete
                                Forever</button>
                        </form>


                    </div>
                @endif


            </div>


            <div
                class="my-6 p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-500 shadow-sm sm:rounded-lg mb-4 flex items-center">
                @if ($note->image_path)
                    <img src="{{ url('storage/images/' . $note->image_path) }}" alt="Note Image"
                        class="w-20 h-20 rounded-full object-cover mr-4">
                @endif

                <div>
                    <div class="text-slate-950 dark:text-white text-2xl font-bold mb-2">
                        <h1>{{ $note->title }}</h1>
                    </div>
                    <p class="mt-2 text-slate-400">
                        {{ Str::limit($note->text, 100) }}
                    </p>
                </div>
            </div>






        </div>
    </div>
</x-app-layout>
