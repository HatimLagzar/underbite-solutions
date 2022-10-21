@php
  /** @var $post \App\Models\Post */
  /** @var $countries \App\Models\Country[] */
@endphp

@extends('admin.layout.auth-template')
@section('title')
  Edit Post
@endsection

@section('content')
  @foreach($errors->all() as $error)
    <div class="alert alert-danger mb-3">{{ $error }}</div>
  @endforeach

  <h2>Update Post</h2>
  <form action="{{ route('admin.posts.update', ['post' => $post]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
      <label for="titleInput" class="form-label">Title</label>
      <input id="titleInput"
             name="title"
             class="form-control"
             placeholder="Place your title here"
             value="{{ $post->getTitle() }}"
             required>
    </div>

    <div class="form-group mb-3">
      <label for="editor" class="form-label">Description</label>
      <textarea id="editor"
                name="description"
                class="form-control"
                placeholder="Place your post here">{{ $post->getDescription() }}</textarea>
    </div>

    <div class="form-group mb-3">
      <label for="lang" class="form-label">Language</label>
      <select name="lang" id="lang" class="form-select">
        <option>Select Language</option>
        <option value="en" {{ $post->getLang() === 'en' ? 'selected' : '' }}>English</option>
        <option value="fr" {{ $post->getLang() === 'fr' ? 'selected' : '' }}>French</option>
        <option value="ar" {{ $post->getLang() === 'ar' ? 'selected' : '' }}>Arabic</option>
      </select>
    </div>

    <div class="form-group mb-3">
      <label for="authorNameInput" class="form-label">Author</label>
      <input id="authorNameInput"
             name="author_name"
             class="form-control"
             placeholder="Place your author name here"
             value="{{ $post->getAuthorName() }}"
             required>
    </div>

    <div class="mb-3">
      <label for="formFile" class="form-label">Thumbnail</label>
      <input class="form-control" type="file" id="formFile" name="thumbnail" accept="image/*">
    </div>

    <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Update</button>
    <button class="btn btn-secondary" type="reset"><i class="fa fa-eraser"></i> Reset</button>
  </form>
@endsection

@section('scripts')
  <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
      .create(document.querySelector('#editor'))
      .then(editor => {
        console.log(editor);
      })
      .catch(error => {
        console.error(error);
      });
  </script>
@endsection