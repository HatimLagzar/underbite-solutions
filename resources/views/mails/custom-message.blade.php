@component('mail::message')

# {{ __('Subject: We have received your application') }}

@if(!$message)
<p>{{__('Hi dear')}} {{ $patient->getFirstName() }},</p>
<p>{{ __('Thank you for submitting your application. We are currently receiving a high volume of
  applications and our processing is delayed, please wait while we review your application and get back to you with
  the next step. Your application number is') }} {{ $patient->getPatientNumber() }}.</p>
<p style="margin-bottom: 30px;">{{ __('While we process and review your application you can tell someone about our program who
  might also find it helpful.')}}</p>
<p style="margin-bottom: 18px;">{{__('Thank you')}},</p>
@else
{!! $message !!}
@endif

<p style="margin-bottom: 0;">{{ __('Staff at UnitedOrthodontists.com') }}</p>
<p style="margin-bottom: 15px;"><em style="font-size: 13px;">{{ __('Helping the most needy receive the care they need.') }}</em></p>

<img style="margin-bottom: 10px;" width="230" src="{{ asset('images/mails/logo.png') }}" alt="Logo">

<p>
  {{ __('Follow us on:') }}
  <a style="margin-right: 5px;" href="{{env('FACEBOOK_PAGE_URL', '#')}}"><img width="25"
                                                                               src="{{ asset('images/icons/facebook.png') }}"
                                                                               alt="Facebook"></a>
  <a href="{{ env('INSTAGRAM_PAGE_URL', '#') }}"><img width="25" src="{{ asset('images/icons/instagram.png') }}"
                                                      alt="Instagram"></a>
</p>

<p style="margin-bottom: 15px;">{{ __('Please do not reply to this message. This email is an automated notification, which is
  unable to receive replies. If you have questions please go to') }} <a href="{{ route('pages.contact-us') }}">{{ route('pages.contact-us') }}</a> {{ __('or check out') }}
  <a href="{{ route('pages.faq') }}">{{ route('pages.faq') }}</a>.</p>

<hr style="background-color: #888; border: none; height: 2px; margin-bottom: 20px;">

<p style="color: #888;">{{ __('WARNING: CONFIDENTIALITY NOTICE - The information enclosed with this transmission are the
  private, confidential property of the sender, and the material is privileged communication intended solely for the
  individual indicated. If you are not the intended recipient, you are hereby notified that any review, disclosure,
  copying, distribution, or the taking of any other action relevant to the contents of this transmission are strictly
  prohibited and legal action will be taken in case of violation. If you have received this transmission in error,
  please notify us immediately at') }} <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a> {{ __('and permanently delete this email and any
  attachments.') }}</p>

@endcomponent
