@php
  /** @var $posts \App\Models\Post[]|\Illuminate\Pagination\LengthAwarePaginator */
@endphp
@extends('client.layout.app')
@section('title')
  Blog
@endsection
@section('content')
  <section id="blog-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <h3 class="fw-light mb-1">{{__('Dental Surgery')}}</h3>
          <h2 class="fw-semibold">{{__('Blog Posts')}}</h2>
          <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
        </div>
      </div>
    </div>
  </section>

  <section id="blog-posts">
    <div class="container">
      @foreach($posts as $post)
        <div class="post-item">
          <div class="row">
            <div class="col-lg-3 col-12 mb-3">
              <img class="img-thumbnail" src="{{ url('storage/posts_thumbnails/' . $post->getThumbnailFileName()) }}"
                   alt="Blog post thumbnail">
            </div>
            <div class="col-lg col-12 right-side mb-4">
              <h3>{{ $post->getTitle() }}</h3>
              <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->getDescription()), 200) }}</p>
              <button class="btn btn-primary">Read More</button>
            </div>
          </div>
        </div>
      @endforeach
      <nav aria-label="Page navigation example" class="d-flex pagination-wrapper">
        <ul class="pagination mx-auto">
          @if($posts->links()->paginator->currentPage() > 1)
            <li class="page-item next">
              <a class="page-link"
                 href="{{ route('pages.blog') }}?page={{$posts->links()->paginator->currentPage() - 1}}">Back</a>
            </li>
          @endif
          @foreach($posts->links()->elements[0] as $link)
            <li class="page-item">
              <a
                class="page-link {{ $posts->links()->paginator->currentPage() === intval(explode('=', $link)[1]) ? 'active' : '' }}"
                href="{{ $link }}">{{ explode('=', $link)[1] }}</a>
            </li>
          @endforeach
          @if($posts->links()->paginator->lastPage() > $posts->links()->paginator->currentPage())
            <li class="page-item next">
              <a class="page-link"
                 href="{{ route('pages.blog') }}?page={{$posts->links()->paginator->currentPage() + 1}}">Next</a>
            </li>
          @endif
        </ul>
      </nav>
    </div>
  </section>
@endsection