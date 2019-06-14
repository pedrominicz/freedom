<?php

namespace Freedom\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Freedom\Book;
use Freedom\User;
use Freedom\Comment;
use Freedom\Favorite;

class BookController extends Controller
{
  /***********************/
  /* public GET requests */
  /***********************/
  public function book_get($id, Request $request) {
    $book = Book::findOrFail($id);

    if(Auth::check()) {
      $favorite = Favorite::where('user_id', $request->user()->id)->where('book_id', $id)->first();
    } else {
      $favorite = null;
    }

    $comments = array();

    foreach($book->comments as $comment) {
      array_push($comments, [
        'body' => $comment->body,
        'commenter' => User::findOrFail($comment->user_id)->name,
      ]);
    }

    return view('book', [
      'book' => $book,
      'favorite' => $favorite,
      'comments' => $comments,
    ]);
  }

  public function home() {
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

  /**********************/
  /* admin GET requests */
  /**********************/
  public function add_get(Request $request) {
    if(!Auth::check() || !$request->user()->is_admin == True) {
      abort(404);
    }

    return view('add');
  }

  public function edit_get($id, Request $request) {
    if(!Auth::check() || !$request->user()->is_admin == True) {
      abort(404);
    }

    $book = Book::findOrFail($id);

    return view('edit', [
      'book' => $book,
    ]);
  }

  public function delete_get($id, Request $request) {
    if(!Auth::check() || !$request->user()->is_admin == True) {
      abort(404);
    }

    $book = Book::findOrFail($id);

    return view('delete', [
      'book' => $book,
    ]);
  }

  /***********************/
  /* admin POST requests */
  /***********************/
  public function add_post(Request $request) {
    if(!Auth::check() || !$request->user()->is_admin == True) {
      abort(404);
    }

    $this->validate($request, [
      'file' => 'max:1999',
      'cover' => 'image|nullable|max:1999',
    ]);

    $book = new Book();
    $book->title = $request->title;
    $book->author = $request->author;
    $book->synopsis = $request->synopsis;
    // Book File
    $file_path = time() . '_' . $request->file('file')->getClientOriginalName();
    $request->file('file')->storeAs('public', $file_path);
    $book->file = $file_path;
    // Cover File
    if($request->hasFile('cover')) {
      $cover_path = time() . '_' . $request->file('cover')->getClientOriginalName();
      $request->file('cover')->storeAs('public', $cover_path);
      $book->cover = $cover_path;
    }

    $book->save();

    return redirect('/b/' . $book->id);
  }

  public function edit_post(Request $request) {
    if(!Auth::check() || !$request->user()->is_admin == True) {
      abort(404);
    }

    $this->validate($request, [
      'file' => 'nullable|max:1999',
      'cover' => 'image|nullable|max:1999',
    ]);

    $book = Book::find($request->id);
    $book->title = $request->title;
    $book->author = $request->author;
    $book->synopsis = $request->synopsis;
    // Book File
    if($request->hasFile('file')) {
      if($book->file) {
        Storage::delete('public/' . $book->file);
      }
      $file_path = time() . '_' . $request->file('file')->getClientOriginalName();
      $request->file('file')->storeAs('public', $file_path);
      $book->file = $file_path;
    }
    // Cover File
    if($request->hasFile('cover')) {
      if($book->cover) {
        Storage::delete('public/' . $book->cover);
      }
      $cover_path = time() . '_' . $request->file('cover')->getClientOriginalName();
      $request->file('cover')->storeAs('public', $cover_path);
      $book->cover = $cover_path;
    }

    $book->save();

    return redirect('/b/' . $book->id);
  }

  public function delete_post(Request $request) {
    if(!Auth::check() || !$request->user()->is_admin == True) {
      abort(404);
    }

    $book = Book::find($request->id);
    Storage::delete('public/' . $book->file);
    if($book->cover) {
      Storage::delete('public/' . $book->cover);
    }
    $book->delete();

    Favorite::where('book_id', $request->id)->delete();
    Comment::where('book_id', $request->id)->delete();

    return redirect('/');
  }
}
