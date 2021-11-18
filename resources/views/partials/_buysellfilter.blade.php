<div class="sidebar-css" style="min-height: auto;">
    <h4>Filter
        <a href="{{ route('front.buysell.clearsearch') }}" class="badge badge-primary offset-5 pd-4">
            Clear All
        </a>

    </h4>

    <form action="{{ route('front.buysell.search') }}" method="GET" enctype="multipart/form-data" id="buysell-filter-form">
        {{ method_field('GET') }}
        <div class="form-group mb-2">
            <input type="text" name="postcode" id="postcode" class="form-control" filter-name="postcode" placeholder="Search Suburb or Postcode" autocomplete="off" />
        </div>
        @if(isset($states))
        <div class="form-group mb-2">
            <select name="states" id="states" class="form-control">
                <option value="">Select State</option>
                @foreach($states as $state)
                <option value="{{ $state->id }}" filter-name="states" filter-val="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="form-group  mb-2">
            <input type="text" name="city" id="city" class="form-control" filter-name="city" placeholder="Select City" autocomplete="off" />
        </div>

        <div class="form-group mb-2">
            <div class="row gx-2">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="$(Min)" name="min" autocomplete="off" />
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="$(Max)" name="max" autocomplete="off" />
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" class="btn btn-primary w-100 js-filter">
            SEARCH
        </a>
    </form>
</div>
<script>
    $(function() {
        $('.select2').select2();
    });

    $(document).ready(function() {
        $(".js-filter").click(function() {
            document.getElementById("buysell-filter-form").submit();
        });
    });
</script>