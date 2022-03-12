@push('page.js')
    <script>
        $('body').on('click', '.delete-item', function () {
            url = $(this).attr('data-href');
            swal.fire({
                title: "{{ __('Вы уверены?') }}",
                text: "{{ __('Вы уверены, что хотите удалить выбранный элемент') }}",
                type: "question",
                showCancelButton: true,
                confirmButtonText: "{{ __('Да') }}",
                cancelButtonText: "{{ __('Нет') }}",
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
