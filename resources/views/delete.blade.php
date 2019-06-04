@extends('master')

@section('title', "Freedom - Delete - $book->title")

@section('content')

  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header"><b> Are you absolutely sure? </b></div>

        <div class="card-body">
          <p>This action <b>cannot</b> be undone. This will permanently delete {{ $book->title }} and remove it from all favorites lists.</p>

          <p>Please type in the title of the book to confirm.</p>

          <form method="POST" action="/d">
            @csrf
            <input type="hidden" name="id" value="{{ $book->id }}">

            <div class="form-group row">
              <div class="col-md-12">
                <input id="book_title" type="text" class="form-control" onchange="" required>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-12">
                <button id="delete_button" type="submit" class="btn btn-block btn-outline-danger" disabled> I understand the consequences, delete this book </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">

    let delete_button = document.getElementById('delete_button');
    let book_title = document.getElementById('book_title');

    book_title.onkeyup = function() {
      if(book_title.value == '{{ $book->title }}') {
        delete_button.disabled = false;
      } else {
        delete_button.disabled = true;
      }
    };

  </script>
@endsection
