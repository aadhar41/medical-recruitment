<div class="input-group mb-3">
    <select name="suburb" id="suburb" class="select2 form-control">
        <option value="0">Select Suburb</option>
        @foreach($suburbs as $suburb)
        <option value="{{ $suburb['id'] }}" {{ (old("suburb") == $suburb['id'] ? "selected":"") }}> {{ $suburb['suburb'] }}</option>
        @endforeach
    </select>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-directions"></span>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
            $('.select2').select2();
        });
</script>