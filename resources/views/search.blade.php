@extends('list')

@section('title')
  Freedom - Search - {{ request()->input('q') }}
@endsection

@section('before')

  <div class="position-relative m-md-3 text-center bg-light" style="font-family: 'Pacifico', cursive;">
    <h2 class="display-6">
      @if($books->isEmpty())
        No search results for "{{ request()->input('q') }}".
      @elseif(count($books) === 1)
        One search result for "{{ request()->input('q') }}".
      @else
        {{ count($books) }} search results for "{{ request()->input('q') }}".
      @endif
    </h2>
  </div>

@endsection
