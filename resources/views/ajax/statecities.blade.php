<div class="form-group">
    <select name="cities" id="cities" class="form-control">
        <option value="0">Select City</option>
        @foreach($cities as $city)
        <option value="{{ $city['id'] }}" {{ (old("cities") == $city['id'] ? "selected":"") }}> {{ $city['name'] }}</option>
        @endforeach
    </select>
</div>