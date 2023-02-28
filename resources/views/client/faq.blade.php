@extends('client.layout.app')
@section('title')
    {{__('FAQ')}}
@endsection
@section('content')
    <section id="faq" style="padding-top: 41px;padding-bottom: 45px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
{{--                    <h3 style="font-size: 3rem;" class="fw-semibold">{{__('FAQ')}}</h3>--}}
                    <h3  class="fw-semibold"><span class="underline">{{__('FAQ')}}</span></h3>

                    <div class="break-line"></div>

                    <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}} <br> {{__('a message through the')}}
                        {{__('a message through the')}}<a style="text-decoration: none; color: #b0dae3;" href="{{route('pages.contact-us')}}">{{__('contact us')}}</a> {{('page.')}}</p>
                </div>
            </div>
        </div>
    </section>

    <section id="questions" class="d-flex text-center">
        <div class="container">
            <h3 class="text-pink fw-light mb-1">{{__('Frequently Asked Questions')}}</h3>
            <h2 class="fw-semibold text-blue">{{__('Questions')}}</h2>
            <div class="wrapper">

                <div class="containerr">
                    <div class="question">
                        {{__('Why is visiting the dentist so important?')}}

                    </div>
                    <div class="answercont">
                        <div class="answer">
                            <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area)).')}}</p>
                            <p>{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root..')}}</p>

                        </div>
                    </div>
                </div>

                <div class="containerr">
                    <div class="question">
                        {{__('My teeth feel fine. Do I still need to see a dentist?')}}

                    </div>
                    <div class="answercont">
                        <div class="answer">
                            <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area))).')}}</p>
                            <p>{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root .')}}</p>
                        </div>
                    </div>
                </div>

                <div class="containerr">
                    <div class="question">
                        {{__('What should I look for when choosing the right dentist for me?')}}

                    </div>
                    <div class="answercont">
                        <div class="answer">
                            <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
                            <p>{{__('q4.To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>
                        </div>
                    </div>
                </div>

                <div class="containerr">
                    <div class="question">
                        {{__('How can I take care of my teeth between dental checkups?')}}
                    </div>
                    <div class="answercont">
                        <div class="answer">
                            <p>{{__('q5.Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
                            <p>{{__('a5.To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>
                        </div>
                    </div>
                </div>

                <div class="containerr">
                    <div class="question">
                        {{__('At what age should I start taking my child to see the dentist?')}}
                    </div>
                    <div class="answercont">
                        <div class="answer">
                            <p>{{__('q5.Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>
                            <p>{{__('a5.To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        {{--                <div class="container">--}}
        {{--                    <h3 class="text-pink fw-light mb-1">{{__('Frequently Asked Questions')}}</h3>--}}
        {{--                    <h2 class="fw-semibold text-blue">{{__('Questions')}}</h2>--}}
        {{--                    <ul>--}}
        {{--                        <li class="mb-2">--}}
        {{--                            <button class="btn btn-light d-flex   align-items-center" type="button"--}}
        {{--                                    data-bs-toggle="collapse" data-bs-target="#questionOne"--}}
        {{--                                    aria-expanded="false" aria-controls="questionOne">--}}
        {{--                                <i class="fa fa-plus mx-5  fa-1x "></i>--}}
        {{--                               <span--}}
        {{--                               class="text-center " style="font-size: 23px;">--}}

        {{--                                                           {{__('Why is visiting the dentist so important?')}}--}}

        {{--                               </span>--}}
        {{--                            </button>--}}
        {{--                            <div class="collapse " id="questionOne">--}}

        {{--                                <span class="pull-left pt-5"> <i class="fa fa-minus"></i></span>--}}

        {{--                                <div class="ml-4 border-0">--}}
        {{--                                    <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area)).')}}</p>--}}
        {{--                                    <p>{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root..')}}</p>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </li>--}}
        {{--                        <li class="mb-2">--}}
        {{--                            <button class="btn btn-light rounded border-1 d-flex  align-items-center"--}}
        {{--                                    type="button"--}}
        {{--                                    data-bs-toggle="collapse" data-bs-target="#questionTwo"--}}
        {{--                                    aria-expanded="false" aria-controls="questionTwo">--}}
        {{--                                <i class="fa fa-plus mx-5  fa-1x "></i>--}}
        {{--                                <span--}}
        {{--                                    class="text-center " style="font-size: 23px;">--}}
        {{--                                {{__('My teeth feel fine. Do I still need to see a dentist?')}}--}}
        {{--                                        </span>--}}
        {{--                            </button>--}}
        {{--                            <div class="collapse" id="questionTwo">--}}

        {{--                                <span class="pull-left pt-5"> <i class="fa fa-minus "></i></span>--}}

        {{--                                <div class="ml-4 border-0">--}}
        {{--                                    <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area))).')}}</p>--}}
        {{--                                    <p>{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root .')}}</p>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </li>--}}
        {{--                        <li class="mb-2">--}}
        {{--                            <button class="btn btn-light d-flex  align-items-center" type="button"--}}
        {{--                                    data-bs-toggle="collapse" data-bs-target="#questionThree"--}}
        {{--                                    aria-expanded="false" aria-controls="questionThree">--}}
        {{--                                <i class="fa fa-plus mx-5  fa-1x "></i>--}}
        {{--                                <span  class="text-center " style="font-size: 23px;">--}}
        {{--                                {{__('What should I look for when choosing the right dentist for me?')}}--}}
        {{--                                        </span>--}}
        {{--                            </button>--}}
        {{--                            <div class="collapse" id="questionThree">--}}

        {{--                                <span class="pull-left pt-5"> <i class="fa fa-minus "></i></span>--}}

        {{--                                <div class="ml-4 border-0">--}}
        {{--                                    <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>--}}
        {{--                                    <p>{{__('q4.To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </li>--}}
        {{--                        <li class="mb-2" >--}}
        {{--                            <button class="btn btn-light d-flex  align-items-center" type="button"--}}
        {{--                                    data-bs-toggle="collapse" data-bs-target="#questionFour"--}}
        {{--                                    aria-expanded="false" aria-controls="questionFour">--}}
        {{--                                <i class="fa fa-plus mx-5  fa-1x "></i>--}}
        {{--                                <span  class="text-center " style="font-size: 23px;">--}}
        {{--                                {{__('How can I take care of my teeth between dental checkups?')}}--}}
        {{--                                        </span>--}}
        {{--                            </button>--}}
        {{--                            <div class="collapse" id="questionFour">--}}

        {{--                                <span class="pull-left pt-5"> <i class="fa fa-minus "></i></span>--}}

        {{--                                <div class="ml-4 border-0">--}}
        {{--                                    <p>{{__('q5.Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>--}}
        {{--                                    <p>{{__('a5.To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </li>--}}
        {{--                        <li class="mb-2">--}}
        {{--                            <button class="btn btn-light d-flex  align-items-center" type="button"--}}
        {{--                                    data-bs-toggle="collapse" data-bs-target="#questionFive"--}}
        {{--                                    aria-expanded="false" aria-controls="questionFive">--}}
        {{--                                <i class="fa fa-plus mx-5  fa-1x "></i>--}}
        {{--                                <span  class="text-center " style="font-size: 23px;">--}}
        {{--                                {{__('At what age should I start taking my child to see the dentist?')}}--}}
        {{--                                        </span>--}}
        {{--                            </button>--}}
        {{--                            <div class="collapse  " id="questionFive">--}}

        {{--                                <span class="pull-left pt-5"> <i class="fa fa-minus "></i></span>--}}

        {{--                                <div class="ml-4 border-0">--}}
        {{--                                    <p>{{__('q6.Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).')}}</p>--}}
        {{--                                    <p>{{__('a6.To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>--}}

        {{--                                </div>--}}

        {{--                            </div>--}}
        {{--                        </li>--}}
        {{--                    </ul>--}}

        {{--                </div>--}}
    </section>

    <section id="proud-members">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-12">
                    <h3><span class="text-pink fw-normal">Proud</span><span class="text-blue fw-bold">Members</span>
                    </h3>
                    <p>{{ __('DentiCare prouds itself of being one empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures.') }}</p>
                </div>
                <div class="col-lg d-none d-lg-block"></div>
                <div class="col-lg-5 col-12">
                    <div class="row mb-3">
                        <div class="col">
                            <img src="/images/about_us.jpeg" alt="Doctors">
                        </div>
                        <div class="col">
                            <img src="/images/about_us.jpeg" alt="Doctors">
                        </div>
                        <div class="col">
                            <img src="/images/about_us.jpeg" alt="Doctors">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <img src="/images/about_us.jpeg" alt="Doctors">
                        </div>
                        <div class="col">
                            <img src="/images/about_us.jpeg" alt="Doctors">
                        </div>
                        <div class="col">
                            <img src="/images/about_us.jpeg" alt="Doctors">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@prepend('scripts')
    <script>


        let question = document.querySelectorAll(".question");
        console.log(question)

        question.forEach(question => {

            question.addEventListener("click", event => {
                console.log(this)
                const active = document.querySelector(".question.active");
                console.log(active)
                if (active && active !== question) {
                    active.classList.toggle("active");
                    active.nextElementSibling.style.maxHeight = 0;
                }
                question.classList.toggle("active");
                const answer = question.nextElementSibling;
                if (question.classList.contains("active")) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                } else {
                    answer.style.maxHeight = 0;
                }
            })
        })


    </script>

@endprepend
