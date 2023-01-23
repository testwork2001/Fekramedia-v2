<script>
    function UpdatePreview() {
        $('#image').attr('src', URL.createObjectURL(event.target.files[0]));
    };
</script>
