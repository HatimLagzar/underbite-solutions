@php
    /** @var $posts \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] */
@endphp

@extends('admin.layout.auth-template')
@section('title')
    Posts
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col">
            <h2>Posts List</h2>
        </div>
        <div class="col">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary float-end"><i class="fa fa-plus"></i> Add Post</a>
        </div>
    </div>
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Thumbnail</th>
            <th>Lang</th>
            <th>Actions</th>
        </tr>
        @foreach($posts as $key => $post)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $post->getTitle() }}</td>
                <td>{{ \Illuminate\Support\Str::limit(strip_tags($post->getDescription()), 50) }}</td>
                <td><a href="{{ url('storage/posts_thumbnails/' . $post->getThumbnailFileName()) }}" target="_blank">Link</a></td>
                <td>{{ $post->getLang() }}</td>
                <td>
                    <a class="btn btn-sm btn-secondary border-0" href="{{ route('admin.posts.edit', ['post' => $post]) }}"><i class="fa fa-pencil"></i> Edit</a>
                    <form action="{{ route('admin.posts.delete', ['post' => $post]) }}" method="POST"
                          class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger border-0"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection