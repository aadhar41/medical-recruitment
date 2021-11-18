<div class="input-group mb-3">
    <select name="city" id="city" class="select2 form-control">
        <option value="0">Select City</option>
        @foreach($cities as $city)
        <option value="{{ $city['id'] }}" {{ (old("cities") == $city['id'] ? "selected":"") }}> {{ $city['name'] }}</option>
        @endforeach
    </select>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-map-signs"></span>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
            $('.select2').select2();
        });
</script>