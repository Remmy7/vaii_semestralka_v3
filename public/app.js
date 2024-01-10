const currentTextDisplay = document.getElementById('textAreaArticle')
const playerTextDisplay = document.getElementById('textAreaTyperacer')
const gameTimer = document.getElementById('gameTimer')
const gameTextID = document.getElementById('game_text_id');

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
    //const charactersTyped = playerTextDisplay.value.length; // TODO remake it so it updates on correct click and every gametick
    const currentTime = new Date();
    const elapsedTime = (currentTime - startTime) / 1000 / 60; // in minutes

    const charactersPerMinute = charactersTyped / elapsedTime;
    charactersPerMinuteElement.textContent = `CPM: ${Math.round(charactersPerMinute)}`;
});
//
//

function validateForm(typeOfForm) {
    switch (typeOfForm) {
        case "addText":
            var category = document.getElementById('category').value;
            var difficulty = document.getElementById('difficulty').value;

            if (category === '--select category--' || difficulty === '--select difficulties--') {
                alert('Please select valid options for category and difficulty.');
                return false;
            }
            return true;
        case "deleteText":
            var texts = document.getElementById('texts').value;
            if (texts === '--search texts--') {
                alert('Please select valid option for text.');
                return false;
            }
            return true;

        case "updateCategory":
            var category = document.getElementById('categoryUpdate').value;
            if (category === '--select category--') {
                alert('Please select valid options for category');
                return false;
            }
            return true;

        case "updateDifficulty":
            var difficulty = document.getElementById('updateDifficulty').value;
            if (difficulty === '--select difficulties--') {
                alert('Please select valid options for difficulty.');
                return false;
            }
            return true;

        case "deleteDifficulty":
            var difficulty = document.getElementById('difficultyDelete').value;
            if (difficulty === '--select difficulties--') {
                alert('Please select valid options for difficulty.');
                return false;
            }
            return true;

        case "deleteCategory":
            var category = document.getElementById('categoryDelete').value;
            if (category === '--select category--') {
                alert('Please select valid options for category.');
                return false;
            }
            return true;
    }
}

resetTimer()
setTextGameDisplay()


