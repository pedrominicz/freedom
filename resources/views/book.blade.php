@extends('master')

@section('title', 'Freedom - ' . $book->title)

@section('content')

  <div class="row">

    <div class="col-md-4 col-lg-3 offset-lg-1">

      <!-- Cover -->
      @if($book->cover)
        <img alt="{{ $book->title }}" src="/storage/{{ $book->cover }}" class="rounded img-thumbnail" />
      @else
        <img alt="{{ $book->title }}" src="https://i.imgur.com/ow6gafs.png" class="rounded img-thumbnail" />
      @endif

    </div>

    <div class="col-md-8 col-lg-7">

      <!-- Title -->
      <h2 class="display-7" style="font-family: 'Pacifico', cursive;">{{ $book->title }}</h1>

      <!-- Author -->
      @if($book->author)
        <p>by {{ $book->author }}</p>
      @endif

      <!-- Synopsis -->
      @if($book->synopsis)
        <hr>
        <p>{!! nl2br($book->synopsis) !!}</p>
      @endif

      <hr>

      <!-- Buttons -->
      <div class="row float-right mx-1">

        <!-- Download Button -->
        <a role="button" href="/storage/{{ $book->file }}" style="min-width: 120px;" class="btn btn-outline-secondary mx-1 mb-2"> Download </a>

        <!-- Favorite Button -->
        <form method="POST" action="/f/{{ $book->id }}">
          @csrf
          <button id="button" type="summit" style="min-width: 120px;" class="btn btn-outline-secondary mx-1 mb-2">
            @if($favorite)
              <i class="far fa-heart"></i>
              &nbsp;Unfavorite
            @else
              <i class="fas fa-heart"></i>
              &nbsp;Favorite
            @endif
          </button>
        </form>

        <!-- Admin Buttons -->
        @if(Auth::user() && Auth::user()->is_admin == true)
          <!-- Edit Book -->
          <a role="button" href="/e/{{ $book->id }}" style="min-width: 120px;" class="btn btn-outline-secondary mx-1 mb-2"> Edit </a>

          <!-- Delete Book -->
          <a role="button" href="/d/{{ $book->id }}" style="min-width: 120px;" class="btn btn-outline-danger mx-1 mb-2"> Delete </a>
        @endif

      </div>

    </div>

  </div>

@endsection
