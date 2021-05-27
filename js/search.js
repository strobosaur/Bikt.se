// SEARCH POST IN DATABASE
$('#form-search').submit(function(e) {
    e.preventDefault();

    var keyword = $('#search_text').val();

    $.ajax({
        url: 'search_process_ajax.php',
        type: 'POST',
        data: {
            'search': 1,
            'search_text': keyword,
        },
        success: function(response){
            stopUpdatePosts();
            //clearInterval(intervalUpdatePosts);
            $('#search_text').val('');
            $("#flex-container2").empty();
            $("#flex-container2").append(response);
        }
    });
});