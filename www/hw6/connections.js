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


/** --------------------- DISPLAY CARDS STUFF --------------------- */
const board = document.getElementById('grid');
// loop through the random board data (REPLACE WITH WORDS ARRAY?)
// might have to be an object to keep track of categories? idk
var randomWords = ["word1", "word2", "word3", "word4", "word5", "word6", "word7", "word8", "word9", "word10", "word11", "word12", "word13", "word14", "word15", "word16"];

// Function to create cards
function createCards() {
    var cardCount = 0;
    // create 4 rows 
    for (let rowNum = 0; rowNum < 4; rowNum++) {
        // create the current row
        const row = document.createElement('div');
        row.classList.add('row', 'flex-nowrap', 'mb-3');
        // add 4 cards to each row
        for (let cardNum = 0; cardNum < 4; cardNum++) {
            const col = document.createElement('div');
            col.classList.add('col');
            const card = document.createElement('div');
            card.classList.add('card', 'text-white', 'bg-secondary');
            // add event listener to highlight selected card
            card.onclick = function () {
                selectWord(this);
            };
            // fill in card content
            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');
            // get the current word in the scrambled word list? (idk how we wanna do this)
            const curr = randomWords[cardCount];
            const word = document.createElement('h5');
            word.classList.add('card-title');
            word.textContent = curr;
            cardCount++;
            cardBody.appendChild(word);
            card.appendChild(cardBody);
            col.appendChild(card);
            row.appendChild(col);
        }
        board.appendChild(row);
    }
}
// probs have to wrap this in a function so it only runs when user is playing?
createCards();

// event listener to select cards on click
function selectWord(word) {
    word.classList.toggle('selected');
}

// taken from stack overflow probably need to cite/unplagarize?
function shuffle(array) {
    let currentIndex = array.length;
    while (currentIndex != 0) {
      let randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex--;
      [array[currentIndex], array[randomIndex]] = [
        array[randomIndex], array[currentIndex]];
    }
  }


/** --------------------- SHUFFLE STUFF --------------------- */
const shuffleButton = document.getElementById('shuffleButton');
shuffleButton.addEventListener('click', function() {
    shuffle(randomWords);
    shuffleCardContent();
});
function shuffleCardContent() {
    var cardCount = 0;
    const cards = document.querySelectorAll('.card-title');
    cards.forEach(function(card) {
        card.textContent = randomWords[cardCount];
        cardCount++;
    });
}

/** --------------------- GAME LOGIC STUFF --------------------- */
// New game functionality. The user must be able to start a new game.
function setUpNewGame(newCategories) {
    const categories = newCategories["categories"];
    const board = {};
    forEach(categories => {
        // add four categories and their words to the board
    });
}

/** 
 * In the event handler for when the user chooses to start a new game, 
 * call getRandomCategories() and pass in your separate function above 
 * as the only parameter. getRandomCategories() will then call your function 
 * with the new category object.
*/
function startNewGame() {
    getRandomCategories(setUpNewGame);
}

// Clear history. The user must be able to clear the game statistics 
document.getElementById('clearButton').addEventListener('click', clearGame);
function clearHistory() {
    // clear game and game stats storage from localstorage
    localStorage.clear();

    // clear stats from the DOM
    document.getElementById('played').textContent = 'Games played: 0';
    document.getElementById('won').textContent = 'Games won: 0';
    document.getElementById('winStreak').textContent = 'Current win streak: 0';
    document.getElementById('averageGuesses').textContent = 'Average guesses per game: 0';
    document.getElementById('prior-guesses-num').textContent = 'Prior guesses: 0 Total';
    
    // start new game
    startNewGame();
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


/** --------------------- GUESS STUFF --------------------- */
const guessButton = document.getElementById('guessButton');
guessButton.addEventListener('click', function() {
    makeGuess();
});

// Guess words functionality. The user must be able to make a guess.
function makeGuess() {
    // make sure its a valid 4 words (display alert errors if not)
    const guess = Array.from(document.querySelectorAll('.word.selected')).map(element => element.textContent);
    if(guess.length !== 4){
        alert('Please select exactly 4 words for your guess.');
        clearSelections();
        return;
    }

    let result = { isCorrect: false, message: "Not quite right." };

    for (const [category, words] of Object.entries(categories)) {
        // find any matches with the guesses and the word categories
        const matchedWords = guess.filter(word => words.includes(word));

        if (matchedWords.length === 4) {
            result = { isCorrect: true, message: "Correct!" };
            // REMOVE FROM BOARD IF CORRECT, RESHUFFLE
            // SAVE GUESS INTO PRIOR GUESSES
            // UPDATE GAME STATS
            updateStatistics();
            break;
        } else if (matchedWords.length === 3) {
            result.message = 'One Away!';
            updateStatistics();
        } else if (matchedWords.length === 2) {
            result.message = 'Two Away!';
            updateStatistics();
        }
    }

    // save to users prior guesses
    let allGuesses = JSON.parse(localStorage.getItem("allGuesses"));
    allGuesses.push({guess});
    localStorage.setItem("allGuesses", JSON.stringify(allGuesses));
    localStorage.setItem("numGuesses", allGuesses.length.toString());

    // check to see if all cards were guessed,and then end game if all have been gueesed
    //if(randomBoard ===){}

function updateStatistics(){
/*  The number of games played
    The number of games won
    The length of the current win streak (how many games they have won in a row)
    Average number of guesses per game */

}

function clearSelections() {
    // clear all the words selected
    document.querySelectorAll('.word.selected').forEach(element => {
        element.classList.remove('selected');
    });
}


// IGNOREEEEEEEEEEEEEEEEEEEEEEEEE

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

function answerGame() {
    // Assuming 'answers' are selected through the UI and stored as data attributes or in an array
    const selectedElements = Array.from(document.querySelectorAll('.word.selected'));
    const answers = selectedElements.map(el => el.dataset.number); // Example of using data attributes

    if (!answers || answers.length !== 4) {
        alert("Please make a valid guess with exactly 4 words."); // Replaces $_SESSION["message"]
        return; // This exits the function early, similar to 'exit()' in PHP
    }

    let guess = [];
    let randomBoard = JSON.parse(localStorage.getItem("randomBoard")); // Assuming this structure is stored in localStorage

    answers.forEach(num => {
        if (num in randomBoard) {
            guess.push(randomBoard[num]);
        } else {
            alert("Please make a valid guess.");
            return; // This exits the forEach loop and function early. Might need adjustment for actual use.
        }
    });

    let match = [];
    let hint = "Not quite right...";
    let board = JSON.parse(localStorage.getItem("board")); // Your categories and words structure
    
    for (const [key, value] of Object.entries(board)) {
        match = value.filter(word => guess.includes(word));

        if (match.length === 4) {
            hint = key; // Assumes category name is sufficient as a hint.
            // Remove guessed words from the randomBoard
            answers.forEach(num => delete randomBoard[num]);
            break;
        } else if (match.length === 3) {
            hint = "One away!";
        } else if (match.length === 2) {
            hint = "Two away";
        }
    }

    // Update and save the state back to localStorage
    localStorage.setItem("randomBoard", JSON.stringify(randomBoard));

    // Update the list of all previous guesses
    let allGuesses = JSON.parse(localStorage.getItem("allGuesses")) || [];
    allGuesses.push({ guess, hint });
    localStorage.setItem("allGuesses", JSON.stringify(allGuesses));
    localStorage.setItem("numGuesses", allGuesses.length.toString());

    // Check if the game is over
    if (Object.keys(randomBoard).length === 0) {
        // Function to show game over message or screen
        showGameOver();
    } else {
        // Function to update the UI based on the hint or to show the updated board
        updateUI(hint);
    }
}
}
