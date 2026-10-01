
<script type="text/javascript">
    $(document).ready(function() {
        $('form.disable-on-submit').on('submit', function() {
            $(this).find('input[type="submit"], button[type="submit"]').prop('disabled', true);
        });
    });
</script>
