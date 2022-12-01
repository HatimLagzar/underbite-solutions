<div class="card advanced-patient-search">
    <div class="card-header">
        Advanced Filters
    </div>
    <div class="card-body">
        <form action="" class="">
            <div class="form-group d-inline-block">
                <h6>Age</h6>
                <label class="text-sm">
                    From <input name="min_age" type="number" min="0" max="200"
                                class="form-control form-control-sm w-auto d-inline-block"
                                value="{{ request()->get('min_age') }}">
                </label>
                <label class="text-sm">
                    To <input name="max_age" type="number" min="0" max="200"
                              class="form-control form-control-sm w-auto d-inline-block"
                              value="{{ request()->get('max_age') }}">
                </label>
            </div>

            <div class="form-group d-inline-block">
                <h6>Height (cm)</h6>
                <label class="text-sm">
                    From <input name="min_height" type="number" min="0" max="300"
                                class="form-control form-control-sm w-auto d-inline-block"
                                value="{{ request()->get('min_height') }}">
                </label>
                <label class="text-sm">
                    To <input name="max_height" type="number" min="0" max="300"
                              class="form-control form-control-sm w-auto d-inline-block"
                              value="{{ request()->get('max_height') }}">
                </label>
            </div>

            <div class="form-group d-inline-block">
                <h6>Weight (kg)</h6>
                <label class="text-sm">
                    From <input name="min_weight" type="number" min="0" max="300"
                                class="form-control form-control-sm w-auto d-inline-block"
                                value="{{ request()->get('min_weight') }}">
                </label>
                <label class="text-sm">
                    To <input name="max_weight" type="number" min="0" max="300"
                              class="form-control form-control-sm w-auto d-inline-block"
                              value="{{ request()->get('max_weight') }}">
                </label>
            </div>

            <div class="form-group d-inline-block">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select form-select-sm w-auto" style="max-width: 100px;">
                    <option value>All</option>
                    <option value="1" {{ request()->get('gender') === '1' ? 'selected' : '' }}>Male</option>
                    <option value="2" {{ request()->get('gender') === '2' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div class="form-group d-inline-block">
                <label for="country" class="form-label d-block">Country</label>
                <select name="country" id="country" class="form-select form-select-sm" style="max-width: 100px;">
                    <option value>All</option>
                    @foreach(\App\Models\Country::all() as $country)
                        <option
                          value="{{ $country->getCode() }}" {{ request()->get('country') === $country->getCode() ? 'selected' : '' }}>{{ $country->getName() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-inline-block">
                <label for="continent" class="form-label">Continent</label>
                <select name="continent" id="continent" class="form-select form-select-sm" style="max-width: 100px;">
                    <option value>All</option>
                    @foreach(\App\Models\Continent::all() as $continent)
                        <option
                          value="{{ $continent->getCode() }}" {{ request()->get('continent') === $continent->getCode() ? 'selected' : '' }}>{{ $continent->getName() }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group d-inline-block">
                <button class="btn btn-sm btn-primary"><i class="fa fa-search me-1"></i>Filter</button>
                <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-secondary"><i
                      class="fa fa-eraser me-1"></i>Clear</a>
            </div>
        </form>
    </div>
</div>