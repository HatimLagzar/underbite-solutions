@php
  /** @var \App\Models\Patient[]|\Illuminate\Database\Eloquent\Collection $recentApplications */
@endphp

@extends('admin.layout.auth-template')
@section('content')
  <div class="row">
    <div class="col">
      <section id="visitors">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Visitors</h6>
            <ul class="list-unstyled mb-0">
              <li class="d-inline-block"><a class="text-sm nav-link" href="{{ route('admin.home') }}">All</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=today">Today</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=week">Week</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=month">Month</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=year">Year</a></li>
            </ul>
          </div>
          <div class="card-body">
            <strong>{{ number_format($visitors) }} Visits</strong>
            @if (request()->has('date_filter'))
              @if($visitors < $visitorsRelative)
                <p class="mb-1 text-sm text-danger">- {{ number_format(round($visitorsRelative * 100 / $visitors, 2) - 100, 2) }}% ({{ number_format($visitorsRelative) }} Visits)</p>
              @else
                <p class="mb-1 text-sm text-success">+ {{ number_format(round($visitors * 100 / $visitorsRelative, 2) - 100, 2) }}% ({{ number_format($visitorsRelative) }} Visits)</p>
              @endif
            @endif
            <p class="mb-0 text-sm">{{ number_format($topTenCountriesWithVisits[array_key_first($topTenCountriesWithVisits)]) }} From {{ array_key_first($topTenCountriesWithVisits) }}</p>
            <p class="mb-0 text-sm">{{ number_format($bounceRate, 2) }}% Bounce Rate</p>
          </div>
        </div>
      </section>
    </div>
    <div class="col">
      <section id="submits">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Submits</h6>
            <ul class="list-unstyled mb-0">
              <li class="d-inline-block"><a class="text-sm nav-link" href="{{ route('admin.home') }}">All</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=today">Today</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=week">Week</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=month">Month</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=year">Year</a></li>
            </ul>
          </div>
          <div class="card-body">
            <strong>{{ number_format($submits) }} Submits</strong>
            @if($submitsFromTopCountry)
            <p class="mb-0">{{ number_format($submitsFromTopCountry->counter) }} From {{ $submitsFromTopCountry->country->name }}</p>
            @endif
          </div>
        </div>
      </section>
    </div>
    <div class="col">
      <section id="conversion">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Conversion</h6>
            <ul class="list-unstyled mb-0">
              <li class="d-inline-block"><a class="text-sm nav-link" href="{{ route('admin.home') }}">All</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=today">Today</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=week">Week</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=month">Month</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=year">Year</a></li>
            </ul>
          </div>
          <div class="card-body">
            <strong>{{ $conversion }}%</strong>
            @if (request()->has('date_filter'))
              @if($conversion < $conversionRelative)
                <p class="mb-1 text-sm text-danger">- {{ number_format(round($conversionRelative * 100 / $conversion, 2) - 100, 2) }}% ({{ number_format($conversionRelative, 2) }}%)</p>
              @elseif($conversionRelative > 0)
                <p class="mb-1 text-sm text-success">+ {{ number_format(round($conversion * 100 / $conversionRelative, 2) - 100, 2) }}% ({{ number_format($conversionRelative, 2) }}%)</p>
              @else
                <p class="mb-1 text-sm">+0% compared to previous cycle</p>
              @endif
            @endif
          @if($conversionFromTopCountry)
            <p class="mb-0">{{ $conversionFromTopCountry }}</p>
            @endif
          </div>
        </div>
      </section>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-12 col-lg-8">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Visitors Repartition</h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div id="map-container" style="position: relative; width: 100%; height: 300px;"></div>
            </div>
            <div class="col">
              <ul class="list-group">
                @foreach($topTenCountriesWithVisits as $key => $countryVisits)
                  <li class="list-group-item">{{ $key }} {{ number_format($countryVisits) }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Gender Ratio</h6>
        </div>
        <div class="card-body">
          <canvas id="gender-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-12 col-lg-8">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">
            Latest Applications
          </h6>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Age</th>
              <th>Height</th>
              <th>Weight</th>
              <th>Country</th>
              <th>Submitted At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($recentApplications as $key => $application)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $application->getFullName() }}</td>
                <td>{{ $application->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</td>
                <td>{{ $application->getAge() }}</td>
                <td>{{ turnCentimeterToFoot($application->getHeight()) . ' ft' }}</td>
                <td>{{ turnKilogramToLbs($application->getWeight()) . ' lbs' }}</td>
                <td>{{ $application->getCountry()->getName() }}</td>
                <td>{{ $application->getCreatedAt()->diffForHumans() }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Devices</h6>
        </div>
        <div class="card-body">
          <canvas id="devices-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-12 col-lg-8">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Top Navigation Flows</h6>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.home') }}">
            <div class="form-group mb-3">
              <label class="form-label" for="from-url">From Page:</label>
              <select name="from_url" id="from-url" class="form-select" onchange="this.form.submit()">
                <option {{ request()->get('from_url') === route('pages.home') ? 'selected' : ''}} value="{{ route('pages.home') }}">Home</option>
                <option {{ request()->get('from_url') === route('pages.about') ? 'selected' : ''}} value="{{ route('pages.about') }}">About Us</option>
                <option {{ request()->get('from_url') === route('pages.faq') ? 'selected' : ''}} value="{{ route('pages.faq') }}">FAQ</option>
                <option {{ request()->get('from_url') === route('pages.contact-us') ? 'selected' : ''}} value="{{ route('pages.contact-us') }}">Contact Us</option>
                <option {{ request()->get('from_url') === route('pages.blog') ? 'selected' : ''}} value="{{ route('pages.blog') }}">Blog</option>
              </select>
            </div>
          </form>
          <table class="table table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Url</th>
              <th># times visited</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topUrls as $key => $url)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $url->to }}</td>
                <td>{{ $url->visits }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datamaps/0.5.9/datamaps.all.min.js"></script>
  <script>
    const data = {!! $visitorsByCountry !!};
    console.log(data)
    const map = new Datamap({
      element: document.getElementById('map-container'),
      fills: {
        HIGH: '#123456',
        MEDIUM: '#2d639d',
        LOW: '#a2bfe7',
        UNKNOWN: 'rgb(0,0,0)',
        defaultFill: '#eee'
      },
      data,
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
          integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    const ctx = document.getElementById('gender-canvas').getContext('2d');
    const genderCanvas = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Male', 'Female'],
        datasets: [{
          data: [{{ $males }}, {{ $females }}],
          backgroundColor: [
            'rgb(54,162,235)',
            'rgb(255,128,128)',
          ],
        }]
      },
    });

    const ctxDevices = document.getElementById('devices-canvas').getContext('2d');
    const devicesCanvas = new Chart(ctxDevices, {
      type: 'doughnut',
      data: {
        labels: ['Desktop', 'Tablet', 'Mobile'],
        datasets: [{
          data: [{{ $desktop }}, {{ $tablet }}, {{ $mobile }}],
          backgroundColor: [
            'rgb(45,99,157)',
            'rgb(54,162,235)',
            'rgb(255,244,128)',
          ],
        }]
      },
    });
  </script>
@endsection