<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   
                    <form action="{{route('chirp.store')}}" method="POST">
                        @csrf
                        <textarea placeholder="What is on your mind?" class="w-full block resize-none h-20 bg-transparent text-white rounded @error('message') border-red-500 @enderror" name="message">{{ old('message')}}</textarea>
                        @if ($errors->any())
                            <p class="text-red-500 mt-1 text-xs">{{$errors->first('message')}}</p>
                        @endif
                        <button class="mt-5 bg-gradient-to-tr from-cyan-400 rounded-md to-blue-700 text-white inline py-2 px-5 text-center font-semibold active:opacity-50" type="submit">Send</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-5 overflow-hidden shadow-sm sm:rounded-lg flex flex-col gap-3">
                @foreach ($chirps as $chirp )
                    <div class="p-6 bg-gray-900 rounded-lg text-gray-900 dark:text-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center gap-1">
                                <div class="h-4 w-4 bg-gradient-to-tr from-cyan-400 to-blue-700 rounded-full shadow-lg"></div>
                                <h3>{{$chirp->user->name}}</h3>
                            </div>
                            <p class="opacity-60 text-xs">{{$chirp->created_at->diffForHumans()}}</p>
                            @if($chirp->updated_at != $chirp->created_at)
                                <p class="opacity-60 text-xs text-red-500">Updated</p>
                            @endif
                            @can('update', $chirp)
                                <a href="{{route('chirps.edit', $chirp)}}" class="text-sm text-cyan-400">Edit</a>
                            @endcan
                            @can('delete', $chirp)
                                <form action="{{route('chirps.destroy', $chirp)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure to delete this chirp?')" class="text-[10px] text-gray-200 p-[2px] bg-red-700 rounded">Delete</button>
                                </form>
                            @endcan
                        </div>
                        <h4 class="mt-5">{{$chirp->message}}</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>