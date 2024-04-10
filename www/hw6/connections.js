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

function showGame(gameState) {
    // Implement this to update the game UI based on gameState
    // This may include showing messages, updating guess lists, etc.
}

function showGameOver(gameState) {
    // Implement this to handle game over state
    // Could redirect to a game over screen or display a message
}


// Assuming `getRandomCategories` is defined and fetches new categories and words
// for the game, then calls a callback function with the fetched data.

document.getElementById('newGameButton').addEventListener('click', startNewGame);

async function startNewGame() {
    // Reset game state and statistics if a game is in progress
    resetGameState();

    // Fetch new game data and redraw the game board
    getRandomCategories(setUpNewGame); // Assuming this function exists and fetches new categories
}

function resetGameState() {
    let gameState = JSON.parse(localStorage.getItem("gameState") || "{}");

    // Update game statistics
    if (!gameState.stats) {
        gameState.stats = {
            gamesPlayed: 0,
            winStreak: 0,
            totalGuesses: 0,
            averageGuesses: 0,
        };
    } else {
        // Game was in progress, update statistics
        gameState.stats.gamesPlayed += 1;
        gameState.stats.winStreak = 0; // Reset win streak
        // Update average guesses per game
        gameState.stats.averageGuesses = gameState.stats.totalGuesses / gameState.stats.gamesPlayed;
    }

    // Clear prior guesses
    gameState.priorGuesses = [];

    // Save updated game state
    localStorage.setItem("gameState", JSON.stringify(gameState));

    // Optionally, clear the game board visually
    clearGameBoardDisplay();
}

function setUpNewGame(newCategories) {
    // This function will populate the game board with new categories and words
    // Remember to clear the game board first if not done in resetGameState
    // Implement game board setup logic here using `newCategories`
}

function clearGameBoardDisplay() {
    // Implement clearing of the game board in the DOM
    // This might involve setting the innerHTML of the game board container to an empty string
}

// Make sure `getRandomCategories` is defined or available from another script
// and correctly invokes `setUpNewGame` with the new categories data.
