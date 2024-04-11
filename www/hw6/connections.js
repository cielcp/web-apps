/**
 * This function will query the CS4640 server for a new set of categories.
 *
 * It makes use of AJAX and Promises to await the result.  We won't discuss
 * promises in detail, so you're welcome to review this code for more
 * details.  However, essentially we need the browser to send an AJAX query
 * to our API and then wait for a reply.  If it just waits, then the browser
 * tab will appear to be frozen briefly while the HTTP request is taking place.
 * Therefore, we send the request with a Promise that awaits the results.  When
 * the response comes back from the server, the promise will return the result
 * to our getRandomCategories() function and that will call your function.  This happens
 * asynchronously, so you should treat your function like you would an event
 * handler.
 */
function queryCategories() {
    return new Promise( resolve => {
            // instantiate the object
            var ajax = new XMLHttpRequest();
            // open the request
            ajax.open("GET", "https://cs4640.cs.virginia.edu/homework/connections.php", true);
            // ask for a specific response
            ajax.responseType = "json";
            // send the request
            ajax.send(null);
            
            // What happens if the load succeeds
            ajax.addEventListener("load", function() {
                // Return the word as the fulfillment of the promise 
                if (this.status == 200) { // worked 
                    resolve(this.response);
                } else {
                    console.log("When trying to get a new set of categories, the server returned an HTTP error code.");
                }
            });
            
            // What happens on error
            ajax.addEventListener("error", function() {
                console.log("When trying to get a new set of categories, the connection to the server failed.");
            });
    });
}

/**
 * This is the function you should call to request a new word.
 * It takes one parameter: a callback function.  The function
 * passed in (i.e., a function you write) should take one
 * parameter (the new categories provided by the server) and handle the
 * setup of your new game.  For example, if you write a function 
 * named "setUpNewGame(newCategories)", then in your event handler for a new
 * game, you should call this function as:
 *     getRandomCategories(setUpNewGame);
 * Our getRandomCategories function will wait for the server to provide 
 * a new set of categories, and then it will call **your** function, passing in 
 * the categories as an object, so that your function can continue setting up 
 * the new game.
 */
async function getRandomCategories(callback) {
    var newCategories = await queryCategories();
    callback(newCategories);
}

// I THINK FROM HERE TO .....
document.getElementById('clearButton').addEventListener('click', clearGame);
function clearGame() {
    // clear game and game stats storage from localstorage
    localStorage.clear();

    // clear stats from the DOM
    document.getElementById('played').textContent = 'Games played: 0';
    document.getElementById('won').textContent = 'Games won: 0';
    document.getElementById('winStreak').textContent = 'Current win streak: 0';
    document.getElementById('averageGuesses').textContent = 'Average guesses per game: 0';
    document.getElementById('prior-guesses-num').textContent = 'Prior guesses: 0 Total';
    
    // start new game
}

// when the page unloads, store the current game and game stats in localstorage
window.addEventListener('beforeunload', () => {
    const gameData = { played: 0, won: 0, winStreak: 0, averageGuesses: 0, priorGuesses: 0};
    localStorage.setItem('gameData', JSON.stringify(gameData));});

// when the page loads, if there is a game or game stats stored in localstorage, repopulate
document.addEventListener('DOMContentLoaded', () => {
    const savedGameData = localStorage.getItem('gameData');
    if(savedGameData !== null){
        const gameData = JSON.parse(savedGameData);
    }
});

// HERE IS FINE, JUST PUSHING THIS RN THOUGH TO SAVE LOL, IGNORE BELOW WORKINPROGRESS


function guessWord(){
/*     Selecting Words: It starts by selecting all elements with the class .word that are also marked as .selected 
    (likely through a user interaction like clicking). The Array.from method is used to convert the 
    NodeList returned by document.querySelectorAll into an array, allowing array methods 
    like map to be used. The map function then transforms this array of elements into an 
    array of their text content, effectively capturing the selected words. */

    const selectedWords = Array.from(document.querySelectorAll('.word.selected')).map(element => element.textContent);
    const messageElement = document.getElementById('message'); // Feedback message element

    if (selectedWords.length !== 4) {
        messageElement.textContent = "Please select exactly 4 words for your guess.";
        clearSelections();
        return;
    }

    let result = { isCorrect: false, category: null, message: "Not quite right." };

    for (const [category, words] of Object.entries(categories)) {
        const matchedWords = selectedWords.filter(word => words.includes(word));

        if (matchedWords.length === 4) {
            result = { isCorrect: true, category, message: "" };
            break;
        } else if (matchedWords.length >= 2) {
            result.message = `${matchedWords.length} words match the category ${category}.`;
        }
    }

    if (guessResult.isCorrect) {
        messageElement.textContent = "Correct! All words are from the category: " + guessResult.category;
        updateGameStatistics(true); // Update statistics for a correct guess
    } else {
        messageElement.textContent = guessResult.message;
        updateGameStatistics(false); // Update statistics for an incorrect guess
    }

    clearSelections(); // Prepare for the next guess

}


function startNewGame() {
    // Reset game state and UI for a new game session
    // This is a placeholder function. Implement according to your game's requirements
    console.log('Starting a new game...');
    // For example, reset the game board, generate new categories, or reset selected words.
}


// Assuming words are selectable elements in the UI and have a 'selected' class when selected
function processGuess() {
    const selectedWords = Array.from(document.querySelectorAll('.word.selected')).map(element => element.textContent);
    const messageElement = document.getElementById('message'); // Feedback message element

    if (selectedWords.length !== 4) {
        messageElement.textContent = "Please select exactly 4 words for your guess.";
        clearSelections();
        return;
    }

    // Find out if the selected words belong to the same category and count matches
    const guessResult = evaluateGuess(selectedWords);

    if (guessResult.isCorrect) {
        messageElement.textContent = "Correct! All words are from the category: " + guessResult.category;
        updateGameStatistics(true); // Update statistics for a correct guess
    } else {
        messageElement.textContent = guessResult.message;
        updateGameStatistics(false); // Update statistics for an incorrect guess
    }

    document.querySelectorAll('.word.selected').forEach(element => {
        element.classList.remove('selected'); // Clear visual selection
    });}


function evaluateGuess(selectedWords) {
    let result = { isCorrect: false, category: null, message: "Not quite right." };

    for (const [category, words] of Object.entries(categories)) {
        const matchedWords = selectedWords.filter(word => words.includes(word));

        if (matchedWords.length === 4) {
            result = { isCorrect: true, category, message: "" };
            break;
        } else if (matchedWords.length >= 2) {
            result.message = `${matchedWords.length} words match the category ${category}.`;
        }
    }

    return result;
}



function clearSelections() {
    document.querySelectorAll('.word.selected').forEach(element => {
        element.classList.remove('selected'); // Clear visual selection
    });
}

function updateGameStatistics(isCorrectGuess) {
    // This function should update the game statistics
    // Increment games played, reset or increment win streak, update average guesses, etc.
    // Logic here depends on how you're tracking game statistics (e.g., in localStorage)
}

// Attach event listener to the submission button
document.getElementById('guessButton').addEventListener('click', processGuess);


function answerGame() {
    let answerInput = document.getElementById("answerInput"); // Assuming an input field with ID 'answerInput'
    if (answerInput.value) {
        // Assume 'gameState' is an object where we keep the game state, similar to PHP's $_SESSION
        let gameState = JSON.parse(localStorage.getItem("gameState") || "{}");

        let answer = answerInput.value.split(' ');
        let guess = [];
        let validGuess = true;

        answer.forEach(num => {
            if (gameState.randomBoard && gameState.randomBoard.hasOwnProperty(num)) {
                guess.push(gameState.randomBoard[num]);
            } else {
                gameState.message = "Please make a valid guess";
                validGuess = false;
                // Show message or update the DOM with the game state here
                showGame(gameState); // You'll need to implement this function
                return; // Equivalent to 'exit()' in PHP
            }
        });

        if (!validGuess) {
            return; // Stop execution if the guess was not valid
        }

        let match = [];
        let hint = "Not quite...";

        Object.keys(gameState.board).forEach(key => {
            match = gameState.board[key].filter(word => guess.includes(word));

            if (match.length === 4) {
                answer.forEach(num => {
                    delete gameState.randomBoard[num];
                });
                hint = key; // Assuming key is the category name
            } else if (match.length === 3) {
                hint = "One away!";
            } else if (match.length === 2) {
                hint = "Two away";
            }
        });

        gameState.allGuesses = gameState.allGuesses || [];
        gameState.allGuesses.push({ guess, hint });
        gameState.numGuesses = gameState.allGuesses.length;

        if (Object.keys(gameState.randomBoard).length === 0) {
            showGameOver(gameState); // You'll need to implement this function
            return;
        }

        // Save the updated game state back to localStorage
        localStorage.setItem("gameState", JSON.stringify(gameState));
        showGame(gameState); // Refresh or update game state display
    } else {
        console.error("Not sure how this error is possible but please make a guess.");
    }
}


