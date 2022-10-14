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
      @for($i = 1; $i <= 6;$i++)
        <div class="post-item">
          <div class="row">
            <div class="col-lg-3 col-12 mb-3">
              <img class="img-thumbnail" src="/images/about_us.jpeg" alt="Blog post thumbnail">
            </div>
            <div class="col-lg col-12 right-side mb-4">
              <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</p>
              <button class="btn btn-primary">Read More</button>
            </div>
          </div>
        </div>
      @endfor

        <nav aria-label="Page navigation example" class="d-flex pagination-wrapper">
          <ul class="pagination mx-auto">
{{--            <li class="page-item prev"><a class="page-link" href="#">Back</a></li>--}}
            <li class="page-item"><a class="page-link active" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item next"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
    </div>
  </section>
@endsection