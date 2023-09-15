<div class="container ">
    <form class="row my-5" method="get" action="{{route('referral.index')}}">
        <div class="col-md-5">
            <input type="search"
                   class="form-control rounded col pull-left"
                   placeholder="Search by any field"
                   aria-label="Search"
                   name="search"
                   value="{{request()->query('search')}}"
            />
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
        <div class="col-md-1">
            <a type="button" class="btn btn-danger" href="{{route('referral.index')}}">Clear</a>
        </div>
    </form>

</div>
