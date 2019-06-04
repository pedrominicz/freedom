@extends('list')

@section('title', 'Freedom - Favorites')

@section('before')

  <div class="position-relative m-md-3 text-center bg-light" style="font-family: 'Pacifico', cursive;">
    <h2 class="display-6">
      @if($books->isEmpty())
        No favorite books yet.
      @elseif(count($books) === 1)
        One favorite book.
      @else
        {{ count($books) }} favorite books.
      @endif
    </h2>
  </div>

@endsection
