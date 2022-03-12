@if (session()->has('success'))
    <script>
        swal.fire({
            title: "{{ __('Успех!') }}",
            text: "{{ session('success') }}",
            type: "success"
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        swal.fire({
            title: "{{ __('Ошибка!') }}",
            text: "{{ session('error') }}",
            type: "error"
        });
    </script>
@endif

@if (session()->has('info'))
    <script>
        swal.fire({
            title: "{{ __('Внимание!') }}",
            text: "{{ session('info') }}",
            type: "info"
        });
    </script>
@endif

@if ($errors->any())
    <script>
        swal.fire({
            title: "{{ __('Ошибка!') }}",
            text: "{{ implode(" ", $errors->all()) }}",
            type: "error"
        });
    </script>
@endif
