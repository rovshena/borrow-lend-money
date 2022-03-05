function CookieQuestion(message_text, dismiss_text, link_text, privacy_link) {
    window.cookieconsent.initialise({
        palette: {
            popup: {
                background: "#d0f6ea",
                text: "#0cbc87",
            },
            button: {
                background: "#0cbc87",
                text: "#ffffff"
            },
        },
        theme: "classic",
        position: "bottom",
        content: {
            message:
                "<span style='font-family: Nunito, sans-serif;'>" +
                message_text +
                "</span>",
            dismiss:
                "<span style='font-family: Nunito, sans-serif;'>" +
                dismiss_text +
                "</span>",
            link:
                "<span style='font-family: Nunito, sans-serif;'>" +
                link_text +
                "</span>",
            href: privacy_link,
        },
    });
}

window.addEventListener("load", function () {
    $('#preloader').fadeOut();
});

function disableSubmitButton() {
    document.getElementById('submit-button').setAttribute('disabled', 'true');
    document.getElementById('loading').classList.remove('d-none');
    $('#preloader').show();
}
