<div class="form-group">
    <label for="city">Cities :</label>
    <select name="city" id="city" class="form-control">
        <option value="0">Select City</option>
        @foreach($cities as $city)
        <option value="{{ $city['id'] }}" {{ (old("cities") == $city['id'] ? "selected":"") }}> {{ $city['name'] }}</option>
        @endforeach
    </select>
</div>