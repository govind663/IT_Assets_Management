(document.querySelectorAll("[toast-list]") ||
    document.querySelectorAll("[data-choices]") ||
    document.querySelectorAll("[data-provider]")) &&
    (document.writeln(
        "<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'></script>"
    ),
    document.writeln(
        "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/choices.js/1.1.6/choices.min.js'></script>"
    ),
    document.writeln(
        "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js'></script>"
    ));
