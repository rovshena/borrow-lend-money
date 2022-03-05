window.addEventListener("load", function () {
    $('.preloader').fadeOut();
});

function disableSubmitButton() {
    document.getElementById('submit-button').setAttribute('disabled', 'true');
    document.getElementById('loading').classList.remove('d-none');
    $('.preloader').show();
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// $(document).ajaxStart(function() {
//     $('.preloader').show();
// });
//
// $(document).ajaxStop(function() {
//     $('.preloader').fadeOut();
// });
