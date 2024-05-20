@php
    $errors = Session::get('danger');
    $message = $errors
@endphp

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@if(is_array($errors) && count($errors) > 0)
    <script>
        var errorMessages = '';
        @foreach($errors as $error)
            errorMessages += '*{{ $error["message"] }} on {{ $error["day"] }}\n';
        @endforeach

        swal("Error", errorMessages, "error");
    </script>
@else
    <script>
        var msg = {!! json_encode($message) !!};
        var jsonMsg = JSON.stringify(msg);
        swal("Error", jsonMsg, "error");
    </script>
@endif
