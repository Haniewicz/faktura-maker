<script type="module">
    @include("javascript.Functions.AjaxSendRequest")
    $(document).ready(function() {
        $("#EditProfileForm").on('submit', function(e){
            e.preventDefault();

            var form = $(this).serialize();

            SendRequest('POST', "{{ route('edit.profile') }}", form);

        });
    });
</script>
