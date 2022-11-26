<div class="row mb-3">
    <div class="col-8">
        <div class="card">
            <div class="card-header">Seach Bar</div>
            <div class="card-body">
                <form action="{{ $route }}">
                    <div class="row">
                        <div class="col">
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
            </div>
        </div>
    </div>
</div>