@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
@endpush

@push('plugin.js')
    <script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/summernote/lang/summernote-' . app()->getLocale() . '.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/summernote/summernote-cleaner.js') }}"></script>
@endpush

@push('page.js')
    <script>
        $('textarea.summernote').summernote({
            lang: "{{ app()->getLocale() }}",
            fontName: 'Nunito',
            fontNames: ['Nunito'],
            fontNamesIgnoreCheck: ['Nunito'],
            toolbar: [
                ['cleaner',['cleaner']],
                ['fontname', ['fontsize', 'fontsizeunit', 'color']],
                ['font', ['bold', 'italic', 'underline']],
                ['font', ['strikethrough', 'superscript', 'subscript', 'clear']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['table', ['table', 'link', 'hr']],
                ['view', ['undo', 'redo', 'fullscreen', 'help', 'codeview']]
            ],
            cleaner:{
                action: 'both',
                newline: '<br>',
                icon: '<i class="fas fa-brush"></i>',
                keepHtml: false,
                keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'],
                keepClasses: false,
                badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'],
                badAttributes: ['style', 'start'],
                limitChars: false,
                limitDisplay: 'both',
                limitStop: false
            }
        });
    </script>
@endpush
