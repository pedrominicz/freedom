<?php

namespace Freedom\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Freedom\Book;
use Freedom\Favorite;

class FavoriteController extends Controller
{
  public function favorite_get(Request $request) {
    if(!Auth::check()) {
      return redirect('login');
    }

    $favorites = Favorite::where('user_id', $request->user()->id)->get();

    for($i = 0; $i < count($favorites); ++$i) {
      $favorites[$i] = $favorites[$i]['book_id'];
    }

    $books = Book::whereIn('id', $favorites)->get();

    return view('favorite', [
      'books' => $books,
    ]);
  }

  public function favorite_post($book_id, Request $request) {
    if(!Auth::check()) {
      return redirect('login');
    }

    $favorite = Favorite::where('user_id', $request->user()->id)->where('book_id', $book_id)->first();

    if($favorite) {
      $favorite->delete();
    } else {
      $favorite = new Favorite();
      $favorite->user_id = $request->user()->id;
      $favorite->book_id = $book_id;

      $favorite->save();
    }

    return redirect('/b/' . $book_id);
  }
}
