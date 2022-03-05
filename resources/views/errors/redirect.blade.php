<script>
    window.setTimeout(function() {
        window.location.href = "{{ url()->previous() }}";
    }, 3000);
</script>
