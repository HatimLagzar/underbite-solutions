@php
  /** @var $post \App\Models\Post */
@endphp
@extends('client.layout.app')
@section('title')
  {{ $post->getTitle() }}
@endsection
@section('content')
  <section id="blog-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <h3 class="fw-light mb-1">{{__('Dental Surgery')}}</h3>
          <h2 class="fw-semibold">{{__('Blog Posts')}}</h2>
          <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).,.')}}</p>
        </div>
      </div>
    </div>
  </section>

  <section id="blog-posts">
    <div class="container" style="max-width: 700px;">
      <div class="post-item">
        <div class="col-lg-12 col-12 mb-3">
          <img class="img-fluid w-100" src="{{ url('storage/posts_thumbnails/' . $post->getThumbnailFileName()) }}"
               alt="Blog post thumbnail">
        </div>
        <div class="col-lg col-12 right-side mb-4">
          <h1>{{ $post->getTitle() }}</h1>
          <span class="text-muted text-sm me-3"><i class="fa fa-clock-o me-1"></i> {{ $post->getCreatedAt()->format('m/d/Y h:i A') }}</span>
          <span class="text-muted text-sm"><i class="fa fa-user me-1"></i> {{ $post->getAuthorName() }}</span>
          <p>{!! $post->getDescription() !!}</p>
        </div>
      </div>
    </div>
  </section>
@endsection