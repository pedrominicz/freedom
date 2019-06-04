@extends('master')

@section('title', "Freedom - Edit - $book->title")

@section('content')
  <div class="card">
    <div class="card-header"> Edit - {{ $book->title }} </div>

    <div class="card-body">
      <form method="POST" action="/e" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
          <label for="name" class="col-md-4 col-form-label text-md-right"> Title </label>

          <div class="col-md-6">
            <input id="title" value="{{ $book->title }}" type="text" class="form-control" name="title" required autofocus>
          </div>
        </div>

        <div class="form-group row">
          <label for="email" class="col-md-4 col-form-label text-md-right"> Author </label>

          <div class="col-md-6">
            <input id="author" value="{{ $book->author }}" type="text" class="form-control" name="author">
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right"> Synopsis </label>

          <div class="col-md-6">
            <textarea id="synopsis" type="text" class="form-control" name="synopsis" rows="1">{{ $book->synopsis }}</textarea>
          </div>
        </div>

        <!-- Upload Cover -->
        <div class="form-group row">
          <label for="cover" class="col-md-4 col-form-label text-md-right"> Cover </label>

          <div class="col-md-6">
            <div class="custom-file">
              <input id="cover" type="file" class="custom-file-input" name="cover">
              <label id="cover_label" class="custom-file-label" for="cover">
                @if($book->cover)
                  {{ $book->cover }}
                @else
                  Upload Cover Image
                @endif
              </label>
            </div>
          </div>
        </div>

        <!-- Upload Book -->
        <div class="form-group row">
          <label for="file" class="col-md-4 col-form-label text-md-right"> File </label>

          <div class="col-md-6">
            <div class="custom-file">
              <input id="file" type="file" class="custom-file-input" name="file">
              <label id="file_label" class="custom-file-label" for="file"> {{ $book->file }} </label>
            </div>
          </div>
        </div>

        <input type="hidden" name="id" value="{{ $book->id }}">

        <!-- Submit Button -->
        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
            <button type="submit" style="min-width: 100px;" class="btn btn-outline-primary"> Submit </button>
            <a role="button" href="/d/{{ $book->id }}" style="min-width: 100px;" class="btn btn-outline-danger"> Delete </a>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">

    let synopsis = document.getElementById('synopsis');
    console.log(synopsis.style.height);
    synopsis.style.height = (synopsis.scrollHeight + synopsis.clientHeight) + 'px';
    console.log(synopsis.style.height);

    let cover = document.getElementById('cover');
    let cover_label = document.getElementById('cover_label');

    cover.onchange = function() {
      cover_label.innerText = cover.value.split('\\').pop();
    };

    let file = document.getElementById('file');
    let file_label = document.getElementById('file_label');

    file.onchange = function() {
      file_label.innerText = file.value.split('\\').pop();
    };

  </script>
@endsection
