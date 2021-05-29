// PROFILE IMAGE UPLOAD
$('#form-submit-img').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append('submit-img', 1);

    $.ajax({
        url: 'register_img_process_ajax.php',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(){
            $('#file').val(null);
            getProfileAjax();
            setBottomBarMessage("Din profilbild har uppdaterats");
        }
    });
});