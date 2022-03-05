@if (session()->has('success'))
    <script>
        swal.fire({
            title: "{{ __('Success!') }}",
            text: "{{ session('success') }}",
            type: "success"
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        swal.fire({
            title: "{{ __('Error!') }}",
            text: "{{ session('error') }}",
            type: "error"
        });
    </script>
@endif

@if (session()->has('info'))
    <script>
        swal.fire({
            title: "{{ __('Attention!') }}",
            text: "{{ session('info') }}",
            type: "info"
        });
    </script>
@endif

@if ($errors->any())
    <script>
        swal.fire({
            title: "{{ __('Error!') }}",
            text: "{{ implode(" ", $errors->all()) }}",
            type: "error"
        });
    </script>
@endif
