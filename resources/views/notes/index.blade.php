<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>


    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @if (request()->routeIs('notes.index'))
                <button type="submit" class="ml-auto px-4 py-2 bg-green-600 text-white dark:text-gray-100 rounded hover:bg-green-700 dark:hover:bg-green-500">
                    <a href="{{ route('notes.create') }}" class="btn-success dark:text-gray-100">+ New Note</a>
                </button>
            @endif

            @forelse ($notes as $note)
                <div class="my-6 p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-500 shadow-sm sm:rounded-lg mb-4 flex items-start">
                    <!-- Image (if it exists) -->
                    @if ($note->image_path)
                        <img src="{{ asset('storage/images/' . $note->image_path) }}" alt="Note Image"
                            class="w-20 h-20 rounded-full object-cover mr-4">
                    @endif

                    <div >
                        <div class="text-slate-950 dark:text-white text-2xl font-bold mb-2">
                            <h1>
                                <a @if (request()->routeIs('notes.index'))
                                    href="{{ route('notes.show', $note) }}">{{ $note->title }}
                                    @else
                                    href="{{ route('trashed.show', $note) }}">
                                    {{ $note->title }}</a>
                                @endif
                            </h1>
                        </div>

                        <p class="mt-2 text-gray-700 dark:text-gray-400">
                            {{ Str::limit($note->text, 100) }}
                        </p>
                        <span class="block mt-4 text-sm text-gray-500 ">
                            {{ $note->updated_at->format('Y-m-d H:i') }}
                        </span>
                    </div>
                </div>
            @empty
                @if (request()->routeIs('notes.index'))
                    <p class="text-gray-700 dark:text-gray-300">You don't have any notes yet.</p>
                @else
                    <p class="text-gray-700 dark:text-gray-300">No items in the trash.</p>
                @endif
            @endforelse

            {{ $notes->links() }}

        </div>
    </div>
</x-app-layout>
