function uploadPreview(input) {
    if (input.files && input.files[0]) {
        var preview = new FileReader();
        preview.onload = function (e) {
            $('#c_profile_preview').attr('src', e.target.result);
        }
        preview.readAsDataURL(input.files[0]);
    }
}

$('#photo, #photo_url').change(function () {
    uploadPreview(this)
});