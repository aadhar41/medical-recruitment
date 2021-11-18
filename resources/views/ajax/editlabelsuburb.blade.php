<div class="form-group">
    <label for="suburb">SUBURB</label>
    <select name="suburb" id="suburb" class="form-control">
        @foreach($suburbs as $suburb)
        <option value="{{ $suburb['id'] }}" {{ (old("suburb") == $suburb['id'] ? "selected":"") }}> {{ $suburb['suburb'] }}</option>
        @endforeach
    </select>
</div>