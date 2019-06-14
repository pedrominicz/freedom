<?php

namespace Freedom\Http\Controllers;

use Illuminate\Http\Request;
use Freedom\Book;

class HomeController extends Controller
{
  public function home_get() {
    $books = Book::all();

    return view('home', [
      'books' => $books
    ]);
  }

  public function search_get(Request $request) {
    $query = $request->q;

    if(!$query) {
      return redirect('/');
    }

    $books = Book::where('title', 'like', "%$query%")->get();

    return view('search', [
      'books' => $books
    ]);
  }
}
