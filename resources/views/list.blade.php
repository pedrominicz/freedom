@extends('master')

@section('style')
  <style  type="text/css">

    a {
      color: inherit;
      text-decoration: inherit;
    }

    a:hover {
      color: inherit;
      font-weight: bold;
      text-decoration: inherit;
    }

  </style>

@endsection

@section('content')

  @yield('before')

  <!-- TODO turn this into a "list" temblade blade -->
  <div class="row">
    @foreach($books as $book)
      <div class="d-flex justify-content-center col-md-4 col-lg-3 col-xl-2">
        <div class="card mb-4 shadow-sm">
          <a href="/b/{{ $book->id }}">
            @if($book->cover)
              <img alt="{{ $book->title }}" src="/storage/{{ $book->cover }}" class="img-fluid" />
            @else
              <img alt="{{ $book->title }}" src="/storage/nocover.png" class="img-fluid" />
            @endif
            <div class="card-body text-center py-1">
              <p class="card-text">{{ $book->title }}</p>
            </div>
          </a>
        </div>
      </div>
    @endforeach
  </div>

@endsection
