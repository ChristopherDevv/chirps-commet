<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tweets') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @if (session('tweet'))
            <div class="max-w-7xl px-8 mb-5 mx-auto flex items-center justify-center">
                <span class=" font-bold py-3 text-center text-white bg-gradient-to-tr w-full from-green-300 to-green-500">{{session('tweet')}}</span>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 max-w-md mx-auto">
                   <form action="{{route('tweet.store')}}" method="POST">
                        @csrf
                        <input type="text" value="{{old('title')}}" name="title" placeholder="Enter a title" class="w-full border-2 bg-gray-900 rounded-md">
                        @error('title')
                            <p class="mt-1 text-sm font-semibold text-red-500">{{$errors->first('title')}}</p>
                        @enderror
                        <textarea name="description" placeholder="Enter a description" class="mt-5 w-full h-24 border-2 bg-gray-900 rounded-md resize-none">{{old('description')}}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm font-semibold text-red-500">{{$errors->first('description')}}</p>
                        @enderror
                        <button class="py-2 mt-3 px-4 rounded-md text-white font-semibold text-xs text-center bg-gradient-to-tr from-cyan-400 to-blue-600 active:opacity-50">Add tweet</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-5">
            @if ($tweets->count() > 0)
                @foreach ($tweets as $tweet )
                <div class="bg-white dark:bg-gray-800 overflow-hidden p-5 shadow-sm sm:rounded-lg text-gray-200">
                   <div class="flex items-center gap-5">
                        <div class="flex items-center gap-1">
                            <div class="h-3 w-3 rounded-full bg-pink-500"></div>
                            <p class="font-bold">{{$tweet->user->name}}</p>
                        </div>
                        <p class="opacity-50 text-xs">{{$tweet->created_at->diffForHumans() }}</p>
                        @if ($tweet->updated_at != $tweet->created_at)
                            <p class="opacity-60 text-xs text-red-500">Updated</p>
                        @endif
                        @can('update', $tweet)
                            <a href="{{route('tweet.edit', $tweet)}}">
                                <button class="py-[2px] px-1 rounded text-blue-700 bg-blue-300 text-[10px] font-bold">Edit</button>
                            </a>
                        @endcan
                        @can('delete', $tweet)
                            <form action="{{route('tweet.delete', $tweet)}}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure to delete this tweet?')" type="submit" class="py-[2px] px-1 rounded text-red-700 bg-red-300 text-[10px] font-bold">Delete</button>
                            </form>
                        @endcan
                   </div>
                   <h3 class="font-bold mt-3 text-lg">{{$tweet->title}}</h3>
                   <p class="mt-1">{{$tweet->description}}</p>
                </div>
                @endforeach
            @endif
        </div>
    </div>

</x-app-layout>