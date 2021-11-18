<div class="form-group">
    <label for="city">CITY</label>
    <select name="city" id="city" class="form-control">
        @foreach($cities as $city)
        <option value="{{ $city['id'] }}" {{ (old("cities") == $city['id'] ? "selected":"") }}> {{ $city['name'] }}</option>
        @endforeach
    </select>
</div>