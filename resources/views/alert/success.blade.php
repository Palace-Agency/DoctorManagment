@php $message = Session::get('success'); @endphp
{{-- <div class="alert txt-success border-success outline-2x alert-dismissible fade show alert-icons" role="alert"><i
        data-feather="thumbs-up"></i>
    <p><b> Well done! </b>{{$message}}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    var msg = {!! json_encode($message) !!};
    var jsonMsg = JSON.stringify(msg);
    swal("Good job!", jsonMsg, "success");
</script>
