@php
  /** @var \App\Models\Patient[]|\Illuminate\Database\Eloquent\Collection $recentApplications */
@endphp

@extends('admin.layout.auth-template')
@section('content')
  <a href="{{ route('admin.home') }}" class="btn btn-dark mb-3"><i class="fa fa-arrow-left me-1"></i>Back</a>
  <div class="row">
    <div class="col">
      <section id="submits">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Submits</h6>
            <ul class="list-unstyled mb-0 filter-range-list">
              <li class="d-inline-block"><a class="text-sm nav-link" href="{{ route('admin.submits') }}">All</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=today">Today</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=week">Week</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=month">Month</a></li>
              <li class="d-inline-block"><a class="text-sm nav-link" href="?date_filter=year">Year</a></li>
            </ul>
          </div>
          <div class="card-body">
            <strong>{{ number_format($submits) }} Submits</strong>
            @if($submitsFromTopCountry)
              <p class="mb-1 text-sm">
                {{ getPercentage($submits, $submitsFromTopCountry->counter) }}%
                ({{ number_format($submitsFromTopCountry->counter) }})
                From {{ $submitsFromTopCountry->country->name }}
              </p>
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
            <ul class="list-unstyled mb-0 filter-range-list">
              <li class="d-inline-block"><a class="text-sm nav-link" href="{{ route('admin.submits') }}">All</a></li>
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
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Submits Repartition</h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div id="map-container" style="position: relative; width: 100%; height: 300px;"></div>
            </div>
            <div class="col">
              <ul class="list-group">
                @foreach($topTenCountriesWithSubmits as $key => $countrySubmits)
                  <li class="list-group-item">{{ $key }} {{ number_format($countrySubmits) }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12 col-lg-8">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Female Submits Per Country</h6>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Country</th>
              <th>Submits</th>
            </tr>
            </thead>
            <tbody>
            @foreach($femaleSubmitsGroupedByCountries as $key => $item)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->country->name }}</td>
                <td>{{ $item->counter }}</td>
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
          <h6 class="mb-0">Gender Ratio</h6>
        </div>
        <div class="card-body">
          <canvas id="gender-canvas"></canvas>
          <p class="mb-0 mt-2">Percentages:</p>
          <ul>
            <li class="text-sm">{{ getPercentage($males + $females, $males) }}% Males</li>
            <li class="text-sm">{{ getPercentage($males + $females, $females) }}% Females</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-12 col-lg-8">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Male Submits Per Country</h6>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Country</th>
              <th>Submits</th>
            </tr>
            </thead>
            <tbody>
            @foreach($maleSubmitsGroupedByCountries as $key => $item)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->country->name }}</td>
                <td>{{ $item->counter }}</td>
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
          <h6 class="mb-0">Ages Ratio</h6>
        </div>
        <div class="card-body">
          <canvas id="ages-canvas"></canvas>
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
    var series = @json($submitsByCountry);
    console.log(series)


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
  </script>

  <script>
    const agesCtx = document.getElementById('ages-canvas').getContext('2d');
    const agesCanvas = new Chart(agesCtx, {
      type: 'doughnut',
      data: {
        labels: ['< 25', '25-30', '30-40', '40-50', '50-60', '> 60'],
        datasets: [{
          data: [{{ $below25 }}, {{ $below30 - $below25 }}, {{ $below40 - $below30 }}, {{ $below50 - $below40}}, {{ $below60 - $below50 }}, {{ $above60 }}],
          backgroundColor: [
            'rgb(54,162,235)',
            'rgb(255,244,128)',
            'rgb(162,191,231)',
            'rgb(255,128,128)',
            'rgb(156,162,169)',
            'rgb(45,99,157)',
          ],
        }]
      },
    });
  </script>
@endsection