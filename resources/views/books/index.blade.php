<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mx-auto max-w-3xl text-gray-900 dark:text-gray-100">
                   
                 <form action="{{route('book.store')}}" method="POST">
                    @csrf
                   <div class="flex items-center gap-10">
                        <div class="flex flex-col gap-3 w-full">
                            <input type="text" name="title" placeholder="Title of the book" class="p-2 rounded-lg bg-slate-900">
                            @error('title')
                                <p class="font-semibold text-red-500 text-center">{{$errors->first('title')}}</p>
                            @enderror
                            <input type="text" name="author" placeholder="Author of the book" class="p-2 rounded-lg bg-slate-900">
                            @error('author')
                                <p class="font-semibold text-red-500 text-center">{{$errors->first('author')}}</p>
                            @enderror
                        </div>
                        <textarea name="description" placeholder="Description of the book" class="resize-none h-28 w-full p-2 rounded-lg bg-slate-900"></textarea>
                    </div>
                   <button type="submit" class="rounded-md text-center text-white w-full p-3 font-bold text-xs bg-gradient-to-tr from-purple-700 to-cyan-400 active:opacity-60 mt-7">Add book</button>
                </form>
                    
                </div>
            </div>
        </div>
    </div>

    <section class="py-10 flex items-start gap-20 w-full max-w-5xl mx-auto">
        <div class="w-1/2 text-gray-300 flex flex-col gap-7">
            @foreach ($books as $book)
                <div>
                    <div class="flex items-center gap-3">
                        <img class="w-24 h-auto" src="https://img.icons8.com/3d-fluency/188/bookmark.png" alt="bookmark"/>
                        <div>
                            <h4 class="font-bold">{{$book->title}}</h4>
                            <p class="mt-1 opacity-60 text-sm">{{$book->author}}</p>
                            @if (auth()->user()->books->contains($book->id))
                                <p class="text-xs mt-1 text-yellow-500 opacity-50 font-bold">Added to favorite</p>
                            @endif
                        </div>
                        @if (auth()->user()->books->contains($book->id))
                            <form action="{{route('book.deletefavorite', $book)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="py-2 px-4 rounded-md text-center font-bold text-xs text-red-500 bg-red-400 bg-opacity-10 hover:bg-opacity-20 transition-all duration-500">Delete to favorite</button>
                            </form>
                        @else
                            <form action="{{route('book.favorite', $book)}}" method="POST">
                                @csrf
                                <button type="submit" class="py-2 px-4 rounded-md text-center font-bold text-xs text-cyan-600 bg-cyan-400 bg-opacity-10 hover:bg-opacity-20 transition-all duration-500">Add to favorite</button>
                            </form>
                        @endif
                    </div>
                    <p class="mt-2 p-2 rounded-lg bg-slate-700 bg-opacity-20">{{$book->description}}</p>
                </div>
            @endforeach
        </div>
        <div class="w-1/2">
            <div class="flex items-center justify-center gap-3">
                <img class="w-32 h-auto" src="https://img.icons8.com/3d-fluency/375/weixing.png" alt="weixing"/>
                <div class="text-gray-200">
                    <h3 class="font-bold">Favorites books</h3>
                    <p class="opacity-50">@<span>{{auth()->user()->name}}</span></p>
                </div>
            </div>
            @if ($booksFavorites->count() > 0)
                @foreach ($booksFavorites as $book)
                    <div class="mt-5 px-5 py-7 rounded-lg border-4 border-gray-400 border-dashed w-full text-gray-300 flex items-center gap-5">
                        <div>
                            <div class="flex items-center gap-1">
                                <img class="w-9 h-auto" src="https://img.icons8.com/3d-fluency/188/bookmark.png" alt="bookmark"/>
                                <h3 class="font-bold">{{$book->title}}</h3>
                            </div>
                            <p class="font-bold opacity-50 mt-1">- {{$book->author}}</p>
                        </div>
                        <form action="{{route('book.deletefavorite', $book)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure to delete this book to favorities?')" class="py-2 px-4 rounded-md text-center font-bold text-xs text-red-500 bg-red-400 bg-opacity-10 hover:bg-opacity-20 transition-all duration-500">Delete to favorite</button>
                        </form>
                    </div>
                @endforeach
            @else
                <h4 class="text-center mt-10 font-bold text-2xl text-gray-700">Favorite Books no added</h4>
            @endif
        </div>
    </section>
</x-app-layout>