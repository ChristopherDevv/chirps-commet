<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        return view('tweets.index', [
            'tweets' => Tweet::with('user')->latest()->get()
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255'
        ]);
       /*  Tweet::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description
        ]); */
        $tweet = new Tweet();
        $tweet->user_id = auth()->user()->id;
        $tweet->title = $request->title;
        $tweet->description = $request->description;
        $tweet->save();

        return to_route('tweet.index')->with('tweet', 'Tweet added successfully');
    }

    public function edit(Tweet $tweet)
    {
        $this->authorize('update', $tweet);

        return view('tweets.edit', [
            'tweet' => $tweet
        ]);
    }

    public function update(Request $request, Tweet $tweet)
    {

        $this->authorize('update', $tweet);
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255'
        ]);

        $tweet->update($request->only('title', 'description'));

        return to_route('tweet.index')->with('tweet', 'Tweet updated successfully');
    }

    public function destroy(Tweet $tweet)
    {
        $this->authorize('delete', $tweet);
        $tweet->delete();
        return to_route('tweet.index')->with('tweet', 'Tweet deleted successfully');
    }

}
