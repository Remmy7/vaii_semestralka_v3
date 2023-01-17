
const currentTextDisplay = document.getElementById('textAreaArticle')
const playerTextDisplay = document.getElementById('textAreaTyperacer')
const gameTimer = document.getElementById('gameTimer')

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

function randomQuote() {
    return 'qwerty'
}


let startTime
function resetTimer() {
    startTime = new Date();
    gameInterval = setInterval(() => {
        gameTimer.innerText = getTimerTime()
    }, 60)
}


function getTimerTime() {
    const xd = (Math.floor((new Date() - startTime) / 10) / 100) - 5;
    return xd.toFixed(2);
}

resetTimer()
setTextGameDisplay()


