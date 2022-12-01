<form action="{{ $route }}">
  <div class="row justify-content-center">
    <div class="col-6">
      <input name="search"
             type="text"
             role="searchbox"
             class="form-control"
             value="{{ request('search') }}"
             placeholder="Name or Patient Number">
    </div>
    <div class="col-2">
      <button class="btn btn-primary">Search</button>
    </div>
  </div>
</form>