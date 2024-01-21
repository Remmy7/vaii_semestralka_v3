
    document.addEventListener('DOMContentLoaded', function () {
    const gameButtons = document.querySelectorAll('.game-button');
    const form = document.getElementById('gameForm');
    const gameTextIDInput = document.getElementById('gameTextIDInput');

    gameButtons.forEach(button => {
    button.addEventListener('click', function () {
    const gameId = this.getAttribute('data-id');
    gameTextIDInput.value = gameId;
    form.submit();
});
});
});

$(document).ready(function () {
    $('#difficultySelect, #categorySelect').on('change', function () {
        var difficultyID = $('#difficultySelect').val();
        var categoryID = $('#categorySelect').val();

        $.ajax({
            url: '/getGameTexts',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {
                difficultyID: difficultyID,
                categoryID: categoryID,
            },
            success: function (data) {
                $('#gameTextSelect').empty();
                $.each(data, function (index, gameText) {
                    $('#gameTextSelect').append('<option value="' + gameText.id + '" data-gametext="' + gameText.gameText + '">' + gameText.textName + '</option>');
                });
            }
        });
    });
    $('#gameTextSelect').on('change', function () {
        var selectedText = $('#gameTextSelect option:selected').data('gametext');
        $('#textPreview').text(selectedText);
    });
});





