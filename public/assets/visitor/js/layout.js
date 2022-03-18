function CookieQuestion(message_text, dismiss_text, link_text, privacy_link) {
    window.cookieconsent.initialise({
        palette: {
            popup: {
                background: "#f6e2d0",
                text: "#fd5631",
            },
            button: {
                background: "#fd5631",
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
    const button = document.getElementById('submit-button')
    const loading = document.getElementById('loading')
    if (button) {
        button.setAttribute('disabled', 'true');
    }
    if (loading) {
        loading.classList.remove('d-none');
    }
    $('#preloader').show();
}
