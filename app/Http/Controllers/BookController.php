<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('books.index', [
            'books' => Book::latest()->get(),
            'booksFavorites' => $user->books()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'author' => 'required|min:3|max:255',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->save();

        return to_route('book.index')->with('status', 'Book created successfully!!');

    }

    public function addToFavorite(Book $book)
    {
        $actualBook = Book::find($book->id);
        $actualUser = User::find(auth()->user()->id);
        
        $actualUser->books()->attach($actualBook);

        return to_route('book.index')->with('status', 'Book added to favorites successfully!!');
    }

    public function deleteToFavorite(Book $book)
    {
        $actualBook = Book::find($book->id);
        $actualUser = User::find(auth()->user()->id);

        $actualUser->books()->detach($actualBook);

        return to_route('book.index')->with('status', 'Book deleted to favorites successfully!!');

    }
}
