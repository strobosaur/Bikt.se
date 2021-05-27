// NAVIGATION MENU SEARCH
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
            //console.log(response.left);
            //console.log(response.right);
            //clearInterval(postUpdate);
            $('#flex-container1').empty();
            $('#flex-container1').append(response.left);
            $('#flex-container2').empty();
            $('#flex-container2').append(response.right);
        }
    });

    /*$.ajax({
        url: 'profile_left_ajax.php',
        type: 'POST',
        data: {
            'get_profile': 1,
        },
        success: function(response){
            //console.log(response);
            //clearInterval(postUpdate);
            $('#flex-container1').empty();
            $('#flex-container1').append(response);
            $('#flex-container2').empty();
        }
    });*/
})