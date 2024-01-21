//ajax javascript pre pridanie textu

$(document).ready(function () {
    $('#saveArticleButton').click(function () {
        var url = addTextRoute;
        var formData = {
            addText: $('[name="addText"]').val(),
            category_id: $('[name="category_id"]').val(),
            difficulty_id: $('[name="difficulty_id"]').val(),
            textName: $('[name="textName"]').val(),
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

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createTextForm');
    const saveButton = document.getElementById('saveArticleButton');

    form.addEventListener('input', function () {
    // Check if all required fields are filled
    const nameField = document.querySelector('[name="textName"]');
    const bodyField = document.querySelector('[name="addText"]');
    const categoryField = document.querySelector('[name="category_id"]');
    const difficultyField = document.querySelector('[name="difficulty_id"]');

    const allFieldsFilled = nameField.value.trim() !== '' &&
    bodyField.value.trim() !== '' &&
    categoryField.value.trim() !== '' && categoryField.value.trim() !== "--select categories--" &&
    difficultyField.value.trim() !== '' && difficultyField.value.trim() !== "--select difficulties--";

    saveButton.disabled = !allFieldsFilled;
});
});


function validateForm(typeOfForm) {
    var category = document.getElementById('category').value;
    var difficulty = document.getElementById('difficulty').value;
    var texts = document.getElementById('texts').value;
    var texts2 = document.getElementById('texts2').value;
    switch (typeOfForm) {

        case "addText":
            if (category === '--select category--' || difficulty === '--select difficulties--') {
                alert('Please select valid options for category and difficulty.');
                return false;
            }
            return true;
        case "deleteText":
            if (texts === '--search texts--') {
                alert('Please select valid option for text.');
                return false;
            }
            return true;
        case "updateText":
            if (texts === '--search texts--') {
                alert('Please select valid option for text.');
                return false;
            }
            return true;

        case "updateCategory":
            if (category === '--select category--') {
                alert('Please select valid options for category');
                return false;
            }
            return true;

        case "updateDifficulty":
            if (difficulty === '--select difficulties--') {
                alert('Please select valid options for difficulty.');
                return false;
            }
            return true;

        case "deleteDifficulty":
            if (difficulty === '--select difficulties--') {
                alert('Please select valid options for difficulty.');
                return false;
            }
            return true;

        case "deleteCategory":
            if (category === '--select category--') {
                alert('Please select valid options for category.');
                return false;
            }
            return true;
    }
}
