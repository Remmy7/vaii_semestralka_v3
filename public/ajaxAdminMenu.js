//ajax javascript pre pridanie textu

$(document).ready(function () { //TODO
    $('#saveArticleButton').click(function () {
        var url = addTextRoute;
        var formData = {
            addText: $('[name="addText"]').val(),
            category_id: $('[name="category_id"]').val(),
            difficulty_id: $('[name="difficulty_id"]').val(),
            _token: $('[name="_token"]').val(),
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (response) {
                $('#modalMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                console.log(response);
            },
            error: function (error) {
                var errorMessages = '';
                $.each(error.responseJSON.errors, function (field, messages) {
                    errorMessages += '<p>' + messages.join(', ') + '</p>';
                });

                $('#modalMessage').html('<div class="alert alert-warning">' + errorMessages + '</div>');
                console.log(error);
            }
        });
    });
});
