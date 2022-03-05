@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
@endpush

@push('plugin.js')
    <script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/js/i18n/' . app()->getLocale() . '.js') }}"></script>
@endpush
