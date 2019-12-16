$(document).ready(function() {

    $('.form').on('submit', function(e) {
        e.preventDefault();

        //AJAX
        $.ajax({
            url: 'http://localhost:8000/addClient/',
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                window.location.href = `http://localhost:8000/commander`
            },
            error: function(error) {
                console.log('Erreur ' + error);
            }
        });
        return false;

    });

});