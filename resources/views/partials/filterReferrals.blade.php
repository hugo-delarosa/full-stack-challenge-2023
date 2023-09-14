<form class="row" method="get" action="{{route('referral.index')}}">
    <div class="col-12 col-md-8">
        <input type="search"
               class="form-control rounded col pull-left"
               placeholder="Search by any field"
               aria-label="Search"
               name="search"
               value="{{request()->query('search')}}"
        />
    </div>
    <div class="col-1 col-md-1">
        <button type="submit" class="btn btn-outline-primary pull-right bg-info ">Search</button>
    </div>
    <div class="col-1 col-md-1">
        <a type="button" class="btn btn-outline-primary pull-right bg-danger text-danger" href="{{route('referral.index')}}">Clear</a>
    </div>
</form>
