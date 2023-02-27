@php
    /** @var $countries \App\Models\Country[] */
@endphp
@extends('admin.layout.auth-template')
@section('title')
    Create Post
@endsection
@section('content')
    <section class="my-3">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach

        <h2>Create Post</h2>
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="titleInput" class="form-label">Title</label>
                <input id="titleInput"
                       name="title"
                       class="form-control"
                       placeholder="Place your title here"
                       required>
            </div>

            <div class="form-group mb-3">
                <label for="editor" class="form-label">Description</label>
                <textarea id="editor"
                          name="description"
                          class="form-control"
                          placeholder="Place your post here"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="lang" class="form-label">Language</label>
                <select name="lang" id="lang" class="form-select">
                    <option>Select Language</option>
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="ar">Arabic</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="authorNameInput" class="form-label">Author</label>
                <input id="authorNameInput"
                       name="author_name"
                       class="form-control"
                       placeholder="Place your author name here"
                       required>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Thumbnail</label>
                <input class="form-control" type="file" id="formFile" name="thumbnail" accept="image/*" required>
            </div>

            <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Create</button>
            <button type="reset" class="btn btn-secondary"><i class="fa fa-eraser"></i> Reset</button>
        </form>
    </section>
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