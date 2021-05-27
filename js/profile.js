// NAVIGATION MENU PROFILE
$('#menu_profile').click(function(e) {
    e.preventDefault();

    $.ajax({
        url: 'profile_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'get_profile': 1,
        },
        success: function(response){
            stopUpdatePosts();
            $('#flex-container1').empty();
            $('#flex-container1').append(response.left);
            $('#flex-container2').empty();
            $('#flex-container2').append(response.right);
        }
    });
})