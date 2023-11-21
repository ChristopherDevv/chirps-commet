<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps edit') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   
                    <form action="{{route('chirp.update', $chirp)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <textarea placeholder="What is on your mind?" class="w-full block resize-none h-20 bg-transparent text-white rounded @error('message') border-red-500 @enderror" name="message">{{ old('message', $chirp->message)}}</textarea>
                        @if ($errors->any())
                            <p class="text-red-500 mt-1 text-xs">{{$errors->first('message')}}</p>
                        @endif
                        <button class="mt-5 bg-gradient-to-tr from-cyan-400 rounded-md to-blue-700 text-white inline py-2 px-5 text-center font-semibold active:opacity-50" type="submit">Send</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>