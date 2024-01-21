const currentTextDisplay = document.getElementById('textAreaArticle')
const playerTextDisplay = document.getElementById('textAreaTyperacer')
const gameTimer = document.getElementById('gameTimer')
const gameTextID = document.getElementById('game_text_id');
const resetGameButton = document.getElementById('resetGame');


let charactersTyped = 1;
playerTextDisplay.addEventListener('input', () => {
    const displayArray = currentTextDisplay.querySelectorAll('span')
    const playerInputArray = playerTextDisplay.value.split('')

    let typo = false;
    if (displayArray)
        displayArray.forEach((characterSpan, index) => {
            const character = playerInputArray[index]
            if (gameTimer.innerText < 0) {
                playerTextDisplay.value = null;
            }
            if (character == null) {
                characterSpan.classList.remove('correctLetter')
                characterSpan.classList.remove('incorrectLetter')
                typo = true
            } else if (typo) {
                characterSpan.classList.add('incorrectLetter')
                characterSpan.classList.remove('correctLetter')
            } else if (character !== characterSpan.innerText) {
                characterSpan.classList.remove('correctLetter')
                characterSpan.classList.add('incorrectLetter')
                typo = true
            } else {
                charactersTyped++;
                characterSpan.classList.remove('incorrectLetter')
                characterSpan.classList.add('correctLetter')
            }

        })
    if (!typo) {
        endGame();
    }

})

resetGameButton.addEventListener('click', () => {
    console.log('Reset game...');
    clearInterval(gameInterval);
    resetTimer();
    setTextGameDisplay();
})

function endGame() {
    clearInterval(gameInterval);
    getTimerTime();
    setTextGameDisplay();
    addToLeaderboard();
    charactersTyped = 1;

}

function addToLeaderboard() {
    const gameTextID = document.getElementById('game_text_id').value;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/saveGame',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: {
            gameTextID: gameTextID,
            time: gameTimer.innerText

        },
        success: function(response) {
            console.log('Result saved successfully');
        },
        error: function(error) {
            console.error('Error saving result', error);
        }
    });
}

async function setTextGameDisplay() {
    const quote = currentTextDisplay.innerText;
    currentTextDisplay.innerHTML = '';
    quote.split('').forEach(character => {
        const characterSpan = document.createElement('span');
        characterSpan.innerText = character;
        currentTextDisplay.appendChild(characterSpan);
    })
    playerTextDisplay.value = null;
}


let startTime
function resetTimer() {
    startTime = new Date();
    gameInterval = setInterval(() => {
        gameTimer.innerText = getTimerTime();
        charactersTyped = 1;

    }, 60)
}


function getTimerTime() {
    const xd = (Math.floor((new Date() - startTime) / 10) / 100) - 5;
    return xd.toFixed(2);
}

//
//trying to make CPM work
const charactersPerMinuteElement = document.getElementById('CPM');
playerTextDisplay.addEventListener('input', function() {
    if (!startTime) {
        startTime = new Date();
    }
    const currentTime = new Date();
    const elapsedTime = (currentTime - startTime) / 1000 / 60; // in minutes

    const charactersPerMinute = charactersTyped / elapsedTime;
    charactersPerMinuteElement.textContent = `CPM: ${Math.round(charactersPerMinute)}`;
});
//
//

resetTimer()
setTextGameDisplay()

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
