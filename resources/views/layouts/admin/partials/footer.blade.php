<footer class="app-footer">
    <div class="copyright">
        &copy;
        @if (date('Y') == 2022)
            2022
        @else
            2022 - {{ date('Y') }}
        @endif
        &nbsp;
        {{ __('Все права защищены.') }}
    </div>
</footer>
