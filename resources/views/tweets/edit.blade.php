<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tweet edit') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 max-w-md mx-auto">
                   <form action="{{route('tweet.update', $tweet->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" value="{{old('title', $tweet->title)}}" name="title" placeholder="Enter a title" class="w-full border-2 bg-gray-900 rounded-md">
                        @error('title')
                            <p class="mt-1 text-sm font-semibold text-red-500">{{$errors->first('title')}}</p>
                        @enderror
                        <textarea name="description" placeholder="Enter a description" class="mt-5 w-full h-24 border-2 bg-gray-900 rounded-md resize-none">{{old('description',  $tweet->description)}}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm font-semibold text-red-500">{{$errors->first('description')}}</p>
                        @enderror
                        <button class="py-2 mt-3 px-4 rounded-md text-white font-semibold text-xs text-center bg-gradient-to-tr from-cyan-400 to-blue-600 active:opacity-50">Update tweet</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

</x-app-layout>