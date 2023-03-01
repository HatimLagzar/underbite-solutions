@extends('client.layout.app')
@section('title')
    {{__('Contact Us')}}
@endsection
@section('content')


    <div class="container mt-container-contact" >
        <section >
            <div class="container">
                <h1  class="mx-5 mt-5 text-center text-blue text-header-contact-us">Contact <span class="text-pink text-header-contact-us" style="font-size: 35px" >DentiCare</span></h1>
                <p class="text-center mb-5 text-p-header-contact-us">Globally incubate standards compliant channels before scalable. Quickly <br> disseminate superior deliverables whereas web-enabled applications.</p>
                <div class="row">
                    <div class="col-lg-9 order-sm-1 order-md-2 mb-2 col-12 hv-100">
                        <div class="card">
                            <div class="card-body">
                                <form id="contact-us-form" action="#" method="post">

                                    <div class="row">
                                        <div class="form-group col-12 col-lg-6 mb-3">
                                            {{--                <label class="form-label" for="firstNameInput">{{__('First Name')}}</label>--}}
                                            <input id="firstNameInput" placeholder="{{__('First Name')}}" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-12 col-lg-6 mb-3">
                                            {{--                <label class="form-label" for="lastNameInput">{{__('Last Name')}}</label>--}}
                                            <input id="lastNameInput" placeholder="{{__('Last Name')}}" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-12 col-lg-6 mb-3">
                                            {{--                <label class="form-label" for="emailAddress">{{__('Email Address')}}</label>--}}
                                            <input id="emailAddress" placeholder="{{__('Email Address')}}" type="email" class="form-control">
                                        </div>
                                        <div class="form-group col-12 col-lg-6 mb-3">
                                            {{--                <label class="form-label" for="subjectInput">{{__('Subject')}}</label>--}}
                                            <input id="subjectInput" placeholder="{{__('app_number')}}" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 mb-3">
                                            {{--                <label class="form-label" for="messageInput">{{__('Message')}}</label>--}}
                                            <textarea id="messageInput" placeholder="{{__('Message')}}" type="text" rows="8" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-primary rounded-5 d-block">{{__('Send')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3  order-sm-2 order-md-1 mb-sm-card-left-contact hv-100">
                        <div class="card">
                            <div class="card-body">
                                <div >
                                    <div class="d-flex justify-content-center">
                                        <span><i class="fa fa-map-marker fa-3x "  aria-hidden="true" style="color: #ddb0ce"></i></span>
                                    </div>
                                    <h3 class="text-center my-2 " style="color: #47525d;">Our Locations</h3>
                                    <ul class="list-unstyled mt-3" >
                                        <li class="text-center py-2"><strong>UAE - Dubai</strong></li>
                                        <li class="text-center py-2"><strong>Germany - Munich</strong> </li>
                                        <li class="text-center py-2"><strong>USA - California</strong></li>
                                        <li class="text-center py-2"> <strong>UK - London</strong></li>
                                        <li class="text-center py-2"><strong>Russia - Moscow</strong></li>
                                        <li class="text-center py-2"><strong>Japane - Tokyo</strong></li>
                                        <li class="text-center py-2"><strong>Korea - Soul</strong></li>

                                    </ul>
                                    <p class="text-center"><small style="font-weight: 300;font-size: 12px">someone will be in touch with you from one of our offices</small></p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>

    <section id="our-dental-service">
        <h3 class="text-center text-pink fw-light mb-1">{{__('Our Dental Service')}}</h3>
        <h2 class="text-center fw-semibold">{{__('Professionals')}}</h2>
        <p class="text-center text-muted w-50 mx-auto mb-5">{{ __('Distinctively exploit optimal alignments for intuitive bandwidth. Quickly coordinate e-business applications through  revolutionary catalysts for change. Seamlessly underwhelm optimal testing processes....') }}</p>

        <div class="container">
            <div class="row px-lg-5">
                <div class="col-lg-3 col-6">
                    <img src="/images/icons/thumbs-up.png" alt="Thumbs up">
                    <p class="fw-semibold text-center">{{__('Patient Satisfaction')}}</p>
                </div>
                <div class="col-lg-3 col-6">
                    <img src="/images/icons/check-up.png" alt="Check Up">
                    <p class="fw-semibold text-center">{{__('Dental Success')}}</p>
                </div>
                <div class="col-lg-3 col-6">
                    <img src="/images/icons/plane.png" alt="Plane">
                    <p class="fw-semibold text-center">{{__('Travel Satisfaction')}}</p>
                </div>
                <div class="col-lg-3 col-6">
                    <img src="/images/icons/recovery.png" alt="Recovery">
                    <p class="fw-semibold text-center">{{__('Quick Recovery')}}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/pages/contact-us.js') }}"></script>
@endpush
