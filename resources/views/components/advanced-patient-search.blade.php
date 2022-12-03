<div class="card advanced-patient-search">
    <div class="card-body">
        <form action="" class="">
            <div class="form-group d-inline-block">
                <label for="age">Age</label>
                <select name="age[]" id="age" class="form-select form-select-sm w-auto" multiple>
                    <option value>Select Age</option>
                    @foreach(\App\Models\Patient::AVAILABLE_AGES as $stringRange => $arrayHeight)
                        <option value="{{ $stringRange }}" {{ request('age') && in_array($stringRange, request('age')) ? 'selected' : '' }}>{{ $stringRange }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group d-inline-block">
                <label for="height">Height</label>
                <select name="height[]" id="height" class="form-select form-select-sm w-auto" multiple>
                    <option value>Select Height</option>
                    @foreach(\App\Models\Patient::AVAILABLE_HEIGHTS as $stringRange => $array)
                        <option value="{{ $stringRange }}" {{ request('height') && in_array($stringRange, request('height')) ? 'selected' : '' }}>{{ $stringRange }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group d-inline-block">
                <label for="weight">Weight</label>
                <select name="weight[]" id="weight" class="form-select form-select-sm w-auto" multiple>
                    <option value>Select Weight</option>
                    @foreach(\App\Models\Patient::AVAILABLE_WEIGHTS as $stringRange => $array)
                        <option value="{{ $stringRange }}" {{ request('weight') && in_array($stringRange, request('weight')) ? 'selected' : '' }}>{{ $stringRange }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group d-inline-block">
                <label for="country" class="form-label d-block">Country</label>
                <select name="country[]" id="country" class="form-select form-select-sm w-auto" multiple>
                    <option value>All</option>
                    @foreach(\App\Models\Country::all() as $country)
                        <option
                          value="{{ $country->getCode() }}" {{ request('country') && in_array($country->getCode(), request('country')) ? 'selected' : '' }}>{{ $country->getName() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-inline-block">
                <label for="continent" class="form-label">Continent</label>
                <select name="continent[]" id="continent" class="form-select form-select-sm w-auto" multiple>
                    <option value>All</option>
                    @foreach(\App\Models\Continent::all() as $continent)
                        <option
                          value="{{ $continent->getCode() }}" {{ request('continent') && in_array($continent->getCode(), request('continent')) ? 'selected' : '' }}>{{ $continent->getName() }}</option>
                    @endforeach
                </select>
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
                <button class="btn btn-sm btn-primary"><i class="fa fa-search me-1"></i>Filter</button>
                <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-secondary"><i
                      class="fa fa-eraser me-1"></i>Clear</a>
            </div>
        </form>
    </div>
</div>