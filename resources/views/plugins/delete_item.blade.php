@push('page.js')
    <script>
        $('body').on('click', '.delete-item', function () {
            url = $(this).attr('data-href');
            swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('Are you sure that you want to delete the selected item') }}",
                type: "question",
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('No') }}",
                onOpen: () => Swal.getCancelButton().focus()
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function (response) {
                            if (response.success) {
                                $('#datatable').DataTable().ajax.reload();
                                toastr.success(response.success);
                            } else {
                                toastr.error(response.error);
                            }
                        },
                        error: function (response) {
                            toastr.error(response.statusText);
                        }
                    });
                }
            });
        });
    </script>
@endpush
