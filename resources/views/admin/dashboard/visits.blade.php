@php
  /** @var \App\Models\Patient[]|\Illuminate\Database\Eloquent\Collection $recentApplications */
@endphp

@extends('admin.layout.auth-template')
@section('content')
  <a href="{{ route('admin.home') }}" class="btn btn-dark mb-3"><i class="fa fa-arrow-left me-1"></i>Back</a>
  <div class="row">
    <div class="col">
      <section id="visitors">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Visitors</h6>
            <ul class="list-unstyled mb-0 filter-range-list">
              <li class="d-inline-block"><a class="text-sm nav-link" href="{{ route('admin.visits') }}">All</a></li>
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
                <p class="mb-1 text-sm text-danger">
                  - {{ number_format(round($visitorsRelative * 100 / $visitors, 2) - 100, 2) }}%
                  ({{ number_format($visitorsRelative) }} Visits)</p>
              @else
                <p class="mb-1 text-sm text-success">
                  + {{ number_format(round($visitors * 100 / $visitorsRelative, 2) - 100, 2) }}%
                  ({{ number_format($visitorsRelative) }} Visits)</p>
              @endif
            @endif
            <p class="mb-0 text-sm">{{ number_format($topTenCountriesWithVisits[array_key_first($topTenCountriesWithVisits)]) }}
              From {{ array_key_first($topTenCountriesWithVisits) }}</p>
            <p class="mb-0 text-sm">{{ number_format($bounceRate, 2) }}% Bounce Rate</p>
          </div>
        </div>
      </section>
    </div>
    <div class="col">
      <section id="conversion">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Conversion</h6>
            <ul class="list-unstyled mb-0 filter-range-list">
              <li class="d-inline-block"><a class="text-sm nav-link" href="{{ route('admin.visits') }}">All</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=today">Today</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=week">Week</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=month">Month</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=year">Year</a></li>
            </ul>
          </div>
          <div class="card-body">
            <strong>{{ $conversion }}%</strong>
            @if (request()->has('date_filter'))
              @if($conversion < $conversionRelative && $conversion > 0)
                <p class="mb-1 text-sm text-danger">
                  - {{ number_format(round($conversionRelative * 100 / $conversion, 2) - 100, 2) }}%
                  ({{ number_format($conversionRelative, 2) }}%)</p>
              @elseif($conversionRelative > 0)
                <p class="mb-1 text-sm text-success">
                  + {{ number_format(round($conversion * 100 / $conversionRelative, 2) - 100, 2) }}%
                  ({{ number_format($conversionRelative, 2) }}%)</p>
              @else
                <p class="mb-1 text-sm">+0% compared to previous cycle</p>
              @endif
            @endif
            @if($conversionFromTopCountry)
              <p class="mb-0 text-sm">{{ $conversionFromTopCountry }}</p>
            @endif
          </div>
        </div>
      </section>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-12">
      <section id="visits-line-chart-wrapper">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active"
                    id="today-visits-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#today-visits-tab-pane"
                    type="button"
                    role="tab"
                    aria-controls="today-visits-tab-pane"
                    aria-selected="true">
              Today
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="week-visits-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#week-visits-tab-pane"
                    type="button"
                    role="tab"
                    aria-controls="week-visits-tab-pane"
                    aria-selected="false">
              Week
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="month-visits-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#month-visits-tab-pane"
                    type="button"
                    role="tab"
                    aria-controls="month-visits-tab-pane"
                    aria-selected="false">
              Month
            </button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active"
               id="today-visits-tab-pane"
               role="tabpanel"
               aria-labelledby="today-visits-tab"
               tabindex="0">
            <canvas id="today-visits-line"></canvas>
          </div>
          <div class="tab-pane fade" id="week-visits-tab-pane" role="tabpanel" aria-labelledby="week-visits-tab" tabindex="0">
            <canvas id="week-visits-line"></canvas>
          </div>
          <div class="tab-pane fade" id="month-visits-tab-pane" role="tabpanel" aria-labelledby="month-visits-tab" tabindex="0">
            <canvas id="month-visits-line"></canvas>
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
          <h6 class="mb-0">Devices</h6>
        </div>
        <div class="card-body">
          <canvas id="devices-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Visits grouped by countries</h6>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Country</th>
              <th>Visits</th>
            </tr>
            </thead>
            <tbody>
            @foreach($visitsGroupedByCountryCode as $key => $item)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->country ? $item->country->name : 'Unknown' }}</td>
                <td>{{ number_format($item->counter) }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Top Navigation Flows</h6>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.home') }}">
            <div class="form-group mb-3">
              <label class="form-label" for="from-url">From Page:</label>
              <select name="from_url" id="from-url" class="form-select" onchange="this.form.submit()">
                <option
                    {{ request()->get('from_url') === route('pages.home') ? 'selected' : ''}} value="{{ route('pages.home') }}">
                  Home
                </option>
                <option
                    {{ request()->get('from_url') === route('pages.about') ? 'selected' : ''}} value="{{ route('pages.about') }}">
                  About Us
                </option>
                <option
                    {{ request()->get('from_url') === route('pages.faq') ? 'selected' : ''}} value="{{ route('pages.faq') }}">
                  FAQ
                </option>
                <option
                    {{ request()->get('from_url') === route('pages.contact-us') ? 'selected' : ''}} value="{{ route('pages.contact-us') }}">
                  Contact Us
                </option>
                <option
                    {{ request()->get('from_url') === route('pages.blog') ? 'selected' : ''}} value="{{ route('pages.blog') }}">
                  Blog
                </option>
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
    // example data from server
    var series = @json($visitorsByCountry);


    // Datamaps expect data in format:
    // { "USA": { "fillColor": "#42a844", numberOfWhatever: 75},
    //   "FRA": { "fillColor": "#8dc386", numberOfWhatever: 43 } }
    var dataset = {};

    // We need to colorize every country based on "numberOfWhatever"
    // colors should be uniq for every value.
    // For this purpose we create palette(using min/max series-value)
    var onlyValues = series.map(function (obj) {
      return obj[1];
    });
    var minValue = Math.min.apply(null, onlyValues),
      maxValue = Math.max.apply(null, onlyValues);

    // create color palette function
    // color can be whatever you wish
    var paletteScale = d3.scale.linear()
      .domain([minValue, maxValue])
      .range(["#EFEFFF", "#02386F"]); // blue color

    // fill dataset in appropriate format
    series.forEach(function (item) { //
      // item example value ["USA", 70]
      var iso = item[0],
        value = item[1];
      dataset[iso] = {numberOfThings: value, fillColor: paletteScale(value)};
    });

    // render map
    new Datamap({
      element: document.getElementById('map-container'),
      // projection: 'mercator', // big world map
      // countries don't listed in dataset will be painted with this color
      fills: {defaultFill: '#F5F5F5'},
      data: dataset,
      geographyConfig: {
        borderColor: '#DEDEDE',
        highlightBorderWidth: 2,
        // don't change color on mouse hover
        highlightFillColor: function (geo) {
          return geo['fillColor'] || '#F5F5F5';
        },
        // only change border
        highlightBorderColor: '#B7B7B7',
        // show desired information in tooltip
        popupTemplate: function (geo, data) {
          // don't show tooltip if country don't present in dataset
          if (!data) {
            return;
          }
          // tooltip content
          return ['<div class="hoverinfo">',
            '<strong>', geo.properties.name, '</strong>',
            '<br>Count: <strong>', data.numberOfThings, '</strong>',
            '</div>'].join('');
        }
      }
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
          integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
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

  <script>
    const todayVisitsCtx = document.getElementById('today-visits-line').getContext('2d');
    const todayVisitsCanvas = new Chart(todayVisitsCtx, {
      type: 'line',
      data: {
        labels: [...Object.keys({!! $todayVisitsArr !!})],
        datasets: [{
          label: 'Visits',
          data: [...Object.values({!! $todayVisitsArr !!})],
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
    });

    const weekVisitsCtx = document.getElementById('week-visits-line').getContext('2d');
    const weekVisitsCanvas = new Chart(weekVisitsCtx, {
      type: 'line',
      data: {
        labels: [...Object.keys({!! $weekVisitsArr !!})],
        datasets: [{
          label: 'Visits',
          data: [...Object.values({!! $weekVisitsArr !!})],
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
    });

    const monthVisitsCtx = document.getElementById('month-visits-line').getContext('2d');
    const monthVisitsCanvas = new Chart(monthVisitsCtx, {
      type: 'line',
      data: {
        labels: [...Object.keys({!! $monthVisitsArr !!})],
        datasets: [{
          label: 'Visits',
          data: [...Object.values({!! $monthVisitsArr !!})],
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
    });
  </script>
@endsection