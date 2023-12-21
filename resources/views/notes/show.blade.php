<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- {{ request()->routeIs('notes.show') ?__('Notes') :__('Trash') }} --}}
            {{ !$note->trashed() ? __('Notes') : __('Trash') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <div class="flex">
                @if (!$note->trashed())
                    <p class="opacity-70">
                        <strong>Created:</strong>{{ $note->created_at->diffForHumans() }}
                    </p>
                    <p class="opacity-70 ml-4">
                        <strong>Updated:</strong>{{ $note->updated_at->diffForHumans() }}
                    </p>
                    <a href="{{ route('notes.edit', $note) }}" class="btn-link ml-auto">Edit Note</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-4"
                            onclick="return confirm('Are you sure you wish to move this note to Trash?')">Move to
                            Trash</button>
                    </form>
                @else
                    <p class="opacity-70">
                        <strong>Deleted at:</strong>{{ $note->deleted_at->diffForHumans() }}
                    </p>
                    <form action="{{ route('trashed.update',$note) }}" method="post" class="ml-auto">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn-link ">Restore Note</a>

                    </form>
                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-4"
                            onclick="return confirm('Are you sure you want to delete this note forever ?')">Delete forever
                        </button>
                    </form>
                @endif
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    {{ $note->titile }}

                </h2>
                <p class="mt-6 whitespace-pre-wrap">
                    {{ $note->text, 200 }}
                </p>
            </div>

        </div>
    </div>
    </div>
</x-app-layout>
