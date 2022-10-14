@extends('client.layout.app')
@section('title')
  FAQ
@endsection
@section('content')
  <section id="faq">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <h3 class="fw-light mb-1">{{__('Dental Surgery')}}</h3>
          <h2 class="fw-semibold">{{__('FAQ')}}</h2>
          <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
        </div>
      </div>
    </div>
  </section>

  <section id="questions">
    <div class="container">
      <h3 class="text-pink fw-light mb-1">{{__('Frequently Asked Questions')}}</h3>
      <h2 class="fw-semibold text-blue">{{__('Questions')}}</h2>
      <ul>
        <li>
          <button class="btn btn-primary d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#questionOne"
                  aria-expanded="false" aria-controls="questionOne">
            {{__('Why is visiting the dentist so important?')}}
            <i class="fa fa-solid fa-caret-down"></i>
          </button>
          <div class="collapse show" id="questionOne">
            <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
            <p>{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>
          </div>
        </li>
        <li>
          <button class="btn btn-primary d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#questionTwo"
                  aria-expanded="false" aria-controls="questionTwo">
            {{__('My teeth feel fine. Do I still need to see a dentist?')}}
            <i class="fa fa-solid fa-caret-down"></i>
          </button>
          <div class="collapse" id="questionTwo">
            <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
            <p>{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>
          </div>
        </li>
        <li>
          <button class="btn btn-primary d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#questionThree"
                  aria-expanded="false" aria-controls="questionThree">
            {{__('What should I look for when choosing the right dentist for me?')}}
            <i class="fa fa-solid fa-caret-down"></i>
          </button>
          <div class="collapse" id="questionThree">
            <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
            <p>{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>
          </div>
        </li>
        <li>
          <button class="btn btn-primary d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#questionFour"
                  aria-expanded="false" aria-controls="questionFour">
            {{__('How can I take care of my teeth between dental checkups?')}}
            <i class="fa fa-solid fa-caret-down"></i>
          </button>
          <div class="collapse" id="questionFour">
            <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
            <p>{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>
          </div>
        </li>
        <li>
          <button class="btn btn-primary d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#questionFive"
                  aria-expanded="false" aria-controls="questionFive">
            {{__('At what age should I start taking my child to see the dentist?')}}
            <i class="fa fa-solid fa-caret-down"></i>
          </button>
          <div class="collapse" id="questionFive">
            <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
            <p>{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>
          </div>
        </li>
      </ul>
    </div>
  </section>

  <section id="proud-members">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-12">
          <h3><span class="text-pink fw-normal">Proud</span><span class="text-blue fw-bold">Members</span></h3>
          <p>{{ __('DentiCare prouds itself of being one empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures.') }}</p>
        </div>
        <div class="col-lg d-none d-lg-block"></div>
        <div class="col-lg-5 col-12">
          <img class="img-thumbnail" src="/images/about_us.jpeg" alt="Doctors">
        </div>
      </div>
    </div>
  </section>
@endsection