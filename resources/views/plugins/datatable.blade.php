<script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net/js/dataTables.bootstrap.js') }}"></script>

<script>
    $(function () {
        var datatable = $('#datatable').DataTable({
            dom: "<'row'<'col-sm-12 col-md-12 col-lg-6'l><'col-sm-12 col-md-12 col-lg-6 text-md-left'f>>\n<'table-responsive'tr>\n<'row align-items-center'<'col-sm-12'i><'col-sm-12 d-flex justify-content-center'p>>",
            language: {
                url: "{{ '/assets/vendor/datatables.net/translations/datatable.' . app()->getLocale() . '.json' }}"
            },
            processing: true,
            serverSide: true,
            autoWidth: false,
            deferRender: true,
            search: {
                return: true,
            },
            select: {
                selector:'td:not(:last-child)',
                style: 'single'
            },
            @yield('datatable')
        });

        @yield('datatable-select-event')
    });
</script>
