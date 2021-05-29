// PROFILE IMAGE DELETE
$('#delete-profile-img').submit(function(e) {
    e.preventDefault();

    $.ajax({
        url: 'register_img_delete_ajax.php',
        type: 'POST',
        data: {
            'delete-img': 1,
        },
        success: function(){
            getProfileAjax();
            setBottomBarMessage("Din profilbild har raderats");
        }
    });
});