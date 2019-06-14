<?php

namespace Freedom\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Freedom\Comment;
use Freedom\Book;

class CommentController extends Controller
{
  public function add_post($book_id, Request $request) {
    if(!Auth::check()) {
      return redirect('login');
    }

    $comment = new Comment();
    $comment->user_id = $request->user()->id;
    $comment->book_id = $book_id;
    $comment->body = $request->body;

    $comment->save();

    return back();
  }
}
