<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php
            $class = "";
            if (session('success')) {
                $class = "bg-cyan";
            } elseif (session('warning')) {
                $class = "bg-yellow";
            } elseif (session('error')) {
                $class = "bg-red";
            } elseif (session('info')) {
                $class = "bg-blue";
            }
            ?>

            <div class="modal-header <?php echo $class; ?>">

                <h4 class="modal-title" id="exampleModalLabel">
                    @if (session('success'))
                    Success !!
                    @elseif (session('warning'))
                    Warning !!
                    @elseif (session('info'))
                    Info !!
                    @elseif (session('error'))
                    Alert !!
                    @endif
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="far fa-times-circle" style="color:#fff;"></i></span>
                </button>
            </div>
            <div class="modal-body text-muted">
                <strong>
                    @if (session('success'))
                    {{session('success')}}
                    @elseif (session('warning'))
                    {{session('warning')}}
                    @elseif (session('info'))
                    {{session('info')}}
                    @elseif (session('error'))
                    {{session('error')}}
                    @endif
                </strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@if (session('success'))
<script>
    $('#exampleModal').modal('show')
</script>
@elseif (session('warning'))
<script>
    $('#exampleModal').modal('show')
</script>
@elseif (session('info'))
<script>
    $('#exampleModal').modal('show')
</script>
@elseif (session('error'))
<script>
    $('#exampleModal').modal('show')
</script>
@endif