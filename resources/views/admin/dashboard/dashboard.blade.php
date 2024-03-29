@php
    /** @var \App\Models\Patient[]|\Illuminate\Database\Eloquent\Collection $recentApplications */
@endphp

@extends('admin.layout.auth-template')
@section('content')
    <div class="row">
        <div class="col">
            <section id="visitors">
                <div class="card">
                    <div class="card-header  text-bg-secondary d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Visitors</h6>
                        <ul class="list-unstyled mb-0 filter-range-list">
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ !request()->has('date_filter') && \Illuminate\Support\Facades\Route::current()->getName() === 'admin.home' ? 'active' : '' }}"
                                    href="{{ route('admin.home') }}">All</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'today' ? 'active' : '' }}"
                                    href="?date_filter=today">Today</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'week' ? 'active' : '' }}"
                                    href="?date_filter=week">Week</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'month' ? 'active' : '' }}"
                                    href="?date_filter=month">Month</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'year' ? 'active' : '' }}"
                                    href="?date_filter=year">Year</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <strong>{{ number_format($visitors) }} Visits</strong>
                        @if (request()->has('date_filter'))
                            @if ($visitorsRelative === 0)

                            @elseif($visitors < $visitorsRelative)
                                <p class="mb-1 text-sm text-danger">
                                    - {{ number_format(round($visitorsRelative * 100 / $visitors, 2) - 100, 2) }}%
                                    ({{ number_format($visitorsRelative) }} Visits)</p>
                            @else
                                <p class="mb-1 text-sm text-success">
                                    + {{ number_format(round($visitors * 100 / $visitorsRelative, 2) - 100, 2) }}%
                                    ({{ number_format($visitorsRelative) }} Visits)</p>
                            @endif
                        @endif
                        <p
                            class="mb-0 text-sm">{{ number_format($topTenCountriesWithVisits[array_key_first($topTenCountriesWithVisits)]) }}
                            From {{ array_key_first($topTenCountriesWithVisits) }}</p>
                        <p class="mb-0 text-sm">{{ number_format($bounceRate, 2) }}% Bounce Rate</p>
                        <a href="{{ route('admin.visits') }}" class="d-block text-end text-sm text-black">More ></a>
                    </div>
                </div>
            </section>
        </div>
        <div class="col">
            <section id="submits">
                <div class="card">
                    <div class="card-header  text-bg-secondary d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Submits</h6>
                        <ul class="list-unstyled mb-0 filter-range-list">
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ !request()->has('date_filter') && \Illuminate\Support\Facades\Route::current()->getName() === 'admin.home' ? 'active' : '' }}"
                                    href="{{ route('admin.home') }}">All</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'today' ? 'active' : '' }}"
                                    href="?date_filter=today">Today</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'week' ? 'active' : '' }}"
                                    href="?date_filter=week">Week</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'month' ? 'active' : '' }}"
                                    href="?date_filter=month">Month</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'year' ? 'active' : '' }}"
                                    href="?date_filter=year">Year</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <strong>{{ number_format($submits) }} Submits</strong>
                        <p class="mb-0 text-sm">{{ getPercentage($submits, $sourcesNumbers[0]) }}%
                            ({{ number_format($sourcesNumbers[0]) }})
                            From {{ $sourcesNames[0] }}</p>
                        @if($submitsFromTopCountry)
                            <p class="mb-0 text-sm">
                                {{ getPercentage($submits, $submitsFromTopCountry->counter) }}%
                                ({{ number_format($submitsFromTopCountry->counter) }})
                                From {{ $submitsFromTopCountry->country->name }}
                            </p>
                        @endif
                        <p class="mb-0 text-sm">{{ getPercentage($males + $females, $females) }}% Females</p>
                        <a href="{{ route('admin.submits') }}" class="d-block text-end text-sm text-black">More ></a>
                    </div>
                </div>
            </section>
        </div>
        <div class="col">
            <section id="conversion">
                <div class="card">
                    <div class="card-header  text-bg-secondary d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Conversion</h6>
                        <ul class="list-unstyled mb-0 filter-range-list">
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ !request()->has('date_filter') && \Illuminate\Support\Facades\Route::current()->getName() === 'admin.home' ? 'active' : '' }}"
                                    href="{{ route('admin.home') }}">All</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'today' ? 'active' : '' }}"
                                    href="?date_filter=today">Today</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'week' ? 'active' : '' }}"
                                    href="?date_filter=week">Week</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'month' ? 'active' : '' }}"
                                    href="?date_filter=month">Month</a></li>
                            <li class="d-inline-block"><a
                                    class="text-sm nav-link {{ request()->get('date_filter') === 'year' ? 'active' : '' }}"
                                    href="?date_filter=year">Year</a></li>
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
                            <p class="mb-1 text-sm">{{ $conversionFromTopCountry }}</p>
                        @endif
                        @if($females < $males)
                            <p class="mb-1 text-sm">Most converting
                                gender: {{ getPercentage($males + $females, $males) }}% Males</p>
                        @else
                            <p class="mb-1 text-sm">Most converting
                                gender: {{ getPercentage($males + $females, $females) }}%
                                Females</p>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header  text-bg-secondary">
                    <h6 class="mb-0">Visitors Repartition</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div id="regions_div" class="justify-content-center " style="position: relative; max-width: 700px; height: 100%!important;"></div>
                        </div>
                        <div class="col">
                            <ul class="list-group">
                                @foreach($topTenCountriesWithVisits as $key => $countryVisits)
                                    <li class="list-group-item text-sm">{{ $key }} {{ number_format($countryVisits) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header  text-bg-secondary">
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
                <div class="card-header  text-bg-secondary">
                    <h6 class="mb-0">
                        Latest Applications
                    </h6>
                </div>
                <div class="card-body table-responsive">
                    <table class="table align-middle">
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
                <div class="card-header  text-bg-secondary">
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
                <div class="card-header  text-bg-secondary">
                    <h6 class="mb-0">Top Navigation Flows</h6>
                </div>
                <div class="card-body table-responsive">
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
                    <table class="table align-middle">
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
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header  text-bg-secondary">
                    <h6 class="mb-0">Sources</h6>
                </div>
                <div class="card-body">
                    <canvas id="source-canvas"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.6.9/topojson.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datamaps/0.5.9/datamaps.all.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        var series = @json($visitorsByCountry);
        // let d= ['Country', 'Popularity'];
        // let obj = JSON.parse(series);
        // let arr = Object.values(series);
        var onlyValues = series.map(function (obj) {
            let second = obj[0].slice(0, -1)
            // let val =  second[0] + second[1].toLowerCase(); // concatenate the first character and the second character in lowercase


            return [second, obj[1]];

        });
        let arr = Object.values(onlyValues)

        arr.unshift(['Country', 'Count: '])

        console.log(arr)
        google.charts.load('current', {
            'packages': ['geochart'],
        });
        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable(arr);

            var options = {
                colorAxis: {colors: ['#a4dfab', '#04500d']},
            };

            var map = new google.visualization.GeoChart(document.getElementById('regions_div'));
            // $(window).resize(function () {
            //     map.draw(data, options);
            //
            // })
            map.draw(data, options);
        }
    </script>
    {{--  <script>--}}
    {{--    // example data from server--}}
    {{--    var series = @json($visitorsByCountry);--}}
    {{--    console.log(series)--}}


    {{--    // Datamaps expect data in format:--}}
    {{--    // { "USA": { "fillColor": "#42a844", numberOfWhatever: 75},--}}
    {{--    //   "FRA": { "fillColor": "#8dc386", numberOfWhatever: 43 } }--}}
    {{--    var dataset = {};--}}

    {{--    // We need to colorize every country based on "numberOfWhatever"--}}
    {{--    // colors should be uniq for every value.--}}
    {{--    // For this purpose we create palette(using min/max series-value)--}}
    {{--    var onlyValues = series.map(function (obj) {--}}
    {{--      return obj[1];--}}
    {{--    });--}}
    {{--    var minValue = Math.min.apply(null, onlyValues),--}}
    {{--      maxValue = Math.max.apply(null, onlyValues);--}}

    {{--    // create color palette function--}}
    {{--    // color can be whatever you wish--}}
    {{--    var paletteScale = d3.scale.linear()--}}
    {{--      .domain([minValue, maxValue])--}}
    {{--      .range(["#EFEFFF", "#02386F"]); // blue color--}}

    {{--    // fill dataset in appropriate format--}}
    {{--    series.forEach(function (item) { //--}}
    {{--      // item example value ["USA", 70]--}}
    {{--      var iso = item[0],--}}
    {{--        value = item[1];--}}
    {{--      dataset[iso] = {numberOfThings: value, fillColor: paletteScale(value)};--}}
    {{--    });--}}
    {{--console.log(dataset)--}}
    {{--    // render map--}}
    {{--    new Datamap({--}}
    {{--      element: document.getElementById('map-container'),--}}
    {{--      // projection: 'mercator', // big world map--}}
    {{--      // countries don't listed in dataset will be painted with this color--}}
    {{--      fills: {defaultFill: '#F5F5F5'},--}}
    {{--      data: dataset,--}}
    {{--      geographyConfig: {--}}
    {{--        borderColor: '#DEDEDE',--}}
    {{--        highlightBorderWidth: 2,--}}
    {{--        // don't change color on mouse hover--}}
    {{--        highlightFillColor: function (geo) {--}}
    {{--          return geo['fillColor'] || '#F5F5F5';--}}
    {{--        },--}}
    {{--        // only change border--}}
    {{--        highlightBorderColor: '#B7B7B7',--}}
    {{--        // show desired information in tooltip--}}
    {{--        popupTemplate: function (geo, data) {--}}
    {{--          // don't show tooltip if country don't present in dataset--}}
    {{--          if (!data) {--}}
    {{--            return;--}}
    {{--          }--}}
    {{--          // tooltip content--}}
    {{--          return ['<div class="hoverinfo">',--}}
    {{--            '<strong>', geo.properties.name, '</strong>',--}}
    {{--            '<br>Count: <strong>', data.numberOfThings, '</strong>',--}}
    {{--            '</div>'].join('');--}}
    {{--        }--}}
    {{--      }--}}
    {{--    });--}}
    {{--  </script>--}}

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

        const ctxSources = document.getElementById('source-canvas').getContext('2d');
        const sourcesCanvas = new Chart(ctxSources, {
            type: 'doughnut',
            data: {
                labels: @json($sourcesNames),
                datasets: [{
                    data: @json($sourcesNumbers),
                    backgroundColor: [
                        'rgb(45,99,157)',
                        'rgb(54,162,235)',
                        'rgb(255,244,128)',
                        'rgb(50,70,128)',
                        'rgb(0,0,0)',
                        'rgb(255,30,128)',
                        'rgb(0,255,10)',
                        'rgb(10,20,128)',
                    ],
                }]
            },
        });
    </script>
@endsection
