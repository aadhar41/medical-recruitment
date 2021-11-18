<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="{{ route('home') }}">MSRA</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>VERSION</b> {{env('PANEL_VERSION')}}
    </div>
</footer>
<script>
    $(function() {
        $('.select2').select2();
    });
</script>