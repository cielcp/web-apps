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





/** --------------------- GAME LOGIC STUFF --------------------- */
// Page load and unload. The user’s data must be stored between views of the page.
/** 
 * You should use an object or array object to store the game and game statistics. 
 * By creating an object to store them, you will be able to store the current state 
 * more easily in localStorage by converting the object to a JSON string. 
 * See JSON.stringify() and JSON.parse().
*/

/** 
 * You must write a separate function that handles the setup of the new game. 
 * This function must take one parameter: an object that contains the categories 
 * and words to start the game.
*/
// New game functionality. The user must be able to start a new game.
var allWords = [];
var gamesPlayed = 0;
var gamesWon = 0;
var winStreak = 0;
var totalGuessCount = 0;

function setUpNewGame(newCategories) {
    // reset the game board (clearhistory should reset selected words)
    // generate new categories
    // setup board for display (and checking later)
    const board = document.getElementById('grid');
    board.innerHTML = ''; // This clears the board

    const categories = newCategories["categories"];
    localStorage.setItem('categories', JSON.stringify(categories));
    // categories[0]; // first category in the board
    categories.forEach(function(category) {
        allWords = allWords.concat(category.words);
    });
    shuffle(allWords);
    localStorage.setItem('allWords', allWords);
    localStorage.setItem('guessCount', 0);
    localStorage.setItem('guesses', JSON.stringify([]));
    createCards(allWords);
}


/** 
 * In the event handler for when the user chooses to start a new game, 
 * call getRandomCategories() and pass in your separate function above 
 * as the only parameter. getRandomCategories() will then call your function 
 * with the new category object.
*/
// EVENT HANDLER NOT WORKING
const newGameButton = document.getElementById('newGameButton');
newGameButton.addEventListener('click', function() {
    // if user did not get all categories, update win streak, avg guesses, num games played
    startNewGame();
    makeMessage("New game!");
    if (allWords.length !== 0) {
        const winStreak = document.getElementById('winStreak');
        winStreak.textContent = "Current win streak: 0";
    }
    allWords = [];
    const priorGuessNum = document.getElementById('priorGuessNum');
    priorGuessNum.textContent = "Prior guesses: 0 total";
    const priorGuesses = document.getElementById('priorGuesses');
    priorGuesses.innerHTML = ''; // This clears the prior guesses list
    
    totalGuessCount += guessCount;
    localStorage.setItem('totalGuessCount', JSON.stringify(totalGuessCount));
    var avg = Math.round(totalGuessCount / gamesPlayed);
    document.getElementById('averageGuesses').textContent = "Average guesses per game: " + avg;
});

function startNewGame() {
    const board = document.getElementById('grid');
    board.innerHTML = '';
    // load a new set of categories and redraw the game board
    getRandomCategories(setUpNewGame);
    console.log('Starting a new game...');
    // If a game was currently in progress, clear the win streak and average num guesses
    // Hint: you may want to keep track of the overall number of guesses.
    // Remove any display of the prior guesses for the in-progress game
    // Update the game statistics to increase the number of games played
}
startNewGame();

/** --------------------- DISPLAY MESSAGE STUFF --------------------- */
var message = "";

function makeMessage(message) {
    if(message !== "") {
        const messageContainer = document.getElementById("messageContainer");
        messageContainer.classList.add('alert', 'alert-success');
        messageContainer.textContent = message;
    }
}

/** --------------------- DISPLAY CARDS STUFF --------------------- */
const board = document.getElementById('grid');
// loop through the random board data (REPLACE WITH WORDS ARRAY?)
// might have to be an object to keep track of categories? idk
//var randomWords = ["word1", "word2", "word3", "word4", "word5", "word6", "word7", "word8", "word9", "word10", "word11", "word12", "word13", "word14", "word15", "word16"];

// Function to create cards
function createCards(allWords) {
    var cardCount = 0;
    // create 4 rows 
    maxRow = (allWords.length)/4;
    for (let rowNum = 0; rowNum < maxRow; rowNum++) {
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
            const curr = allWords[cardCount];
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
//createCards();

// event listener to select cards on click
function selectWord(word) {
    word.classList.toggle('selected');
}


/** --------------------- GUESS STUFF --------------------- */
const guessButton = document.getElementById('guessButton');
guessButton.addEventListener('click', function() {
    guessWord();
});


let priorGuesses = document.getElementById("priorGuesses");

function guessWord() {

    totalGuess++;
    localStorage.setItem('totalGuess', JSON.stringify(totalGuess));

    const selectedWords = Array.from(document.querySelectorAll('.selected')).map(element => element.textContent);
    if (selectedWords.length !== 4) {
        makeMessage("Please select exactly 4 words for your guess");
        clearSelections();
        return;
    }

    
    guesses = JSON.parse(localStorage.getItem('guesses'));
    console.log(guesses);
    console.log(guesses);

    // update guess count
    guessCount = localStorage.getItem('guessCount');
    guessCount++;
    // console.log(guessCount);
    localStorage.setItem('guessCount', guessCount);
    const priorGuessNum = document.getElementById('priorGuessNum');
    priorGuessNum.textContent = "Prior guesses: " + guessCount + " total";

    
    // loop over selected words, and check with each category
    let categories = JSON.parse(localStorage.getItem('categories'));
    let guess = { words: selectedWords, message: "Not quite..." };
    
    // loop over the categories
    for (let i = 0; i < 4; i++) {
        let matchCount = 0;
        let category = categories[i]['category'];
        let words = categories[i]['words'];
        
        // count how many of the category words matches the selected words category
        for (let j = 0; j < 4; j++) {
            for (let x = 0; x < 4; x++) {
                if (selectedWords[x] == words[j]) {
                    matchCount++;
                    console.log(matchCount);
                }
            }
        }
        
        if (matchCount == 4) {
            // a correct guess!
            makeMessage("Correct! All words are from the category: " + category);
            guess = { category: category, words: selectedWords, message: "Correct!" };
            //updateGameStatistics(true);

            //remove 4 words from the list to reshuffle and displahy
            for(let i = 0; i < 4; i++){
                let index = allWords.indexOf(selectedWords[i]);
                if (index !== -1) {
                    allWords.splice(index, 1);
                }
            }
            localStorage.setItem('allWords', JSON.stringify(allWords));
            const board = document.getElementById('grid');
            board.innerHTML = ''; // This clears the board
            createCards(allWords);
            // console.log(allWords);
            break;
        }
        else if (matchCount == 3) {
            // one away!
            makeMessage("One away!");
            guess = { words: selectedWords, message: "One away!" };
            break;
        }
        else if (matchCount == 2) {
            // two away!
            makeMessage("Two away!");
            guess = { words: selectedWords, message: "Two away!" };
            break;
        }
    }
    clearSelections(); // Prepare for the next guess

    // update previous guesses
    console.log(guess);
    guesses.push(guess);
    localStorage.setItem("guesses", JSON.stringify(guesses));
    
    const currGuess = document.createElement('p');
    currGuess.textContent = guess["words"] + " " + guess["message"];
    priorGuesses.appendChild(currGuess);
    if(allWords.length == 0){
        makeMessage("you won!");
        
        gamesWon++;
        localStorage.setItem('gamesWon', JSON.stringify(gamesWon));
        document.getElementById('won').textContent = "Games Won: " + gamesWon;
        
        gamesPlayed++;
        localStorage.setItem('gamesPlayed', JSON.stringify(gamesPlayed));
        document.getElementById('played').textContent = "Games Played: " + gamesPlayed;
        
        winStreak++;
        localStorage.setItem('winStreak', JSON.stringify(winStreak));
        document.getElementById('winStreak').textContent = "Current win streak: " + winStreak;

        
        totalGuessCount += guessCount;
        localStorage.setItem('totalGuessCount', JSON.stringify(totalGuessCount));
        var avg = Math.round(totalGuessCount / gamesPlayed);
        document.getElementById('averageGuesses').textContent = "Average guesses per game: " + avg;
    }
}



/** --------------------- SHUFFLE STUFF --------------------- */
const shuffleButton = document.getElementById('shuffleButton');
shuffleButton.addEventListener('click', function() {
    shuffle(allWords);
    shuffleCardContent();
});

function shuffle(array) {
    let i = array.length;
    while (i != 0) {
      let j = Math.floor(Math.random() * i);
      i--;
      [array[i], array[j]] = [
        array[j], array[i]];
    }
  }

function shuffleCardContent() {
    var cardCount = 0;
    const cards = document.querySelectorAll('.card-title');
    cards.forEach(function(card) {
        card.textContent = allWords[cardCount];
        cardCount++;
    });
}


/** --------------------- CLEAR STUFF --------------------- */
document.getElementById("clearButton").addEventListener('click', clearGame);

function clearGame() {
    localStorage.clear('categories');
    localStorage.clear('guessCount');
  
    
    makeMessage('Game cleared');
    // clear game and game stats storage from localstorage

    // clear stats from the DOM
    document.getElementById('played').textContent = 'Games played: 0';
    document.getElementById('won').textContent = 'Games won: 0';
    document.getElementById('winStreak').textContent = 'Current win streak: 0';
    document.getElementById('averageGuesses').textContent = 'Average guesses per game: 0';
    document.getElementById('priorGuessNum').textContent = 'Prior guesses: 0 Total';
    document.getElementById('priorGuesses').innerHTML = '';

    // start new game
    startNewGame();
}

// when the page unloads, store the current game and game stats in localstorage
window.addEventListener('beforeunload', () => {
    const gameData = {
        allWords: allWords,
        gamesWon: gamesWon,
        gamesPlayed: gamesPlayed,
        winStreak: winStreak,
        totalGuess: totalGuess,
        averageGuesses: averageGuesses,
        guesses: JSON.parse(localStorage.getItem('guesses')), 
        guessCount: localStorage.getItem('guessCount')
    };
    localStorage.setItem('gameData', JSON.stringify(gameData));
});

// when the page loads, if there is a game or game stats stored in localstorage, repopulate
document.addEventListener('DOMContentLoaded', () => {
    const savedGameData = localStorage.getItem('gameData');
    if (savedGameData) {
        const gameData = JSON.parse(savedGameData);
        allWords = gameData.allWords;
        gamesWon = gameData.gamesWon;
        gamesPlayed = gameData.gamesPlayed;
        winStreak = gameData.winStreak;
        totalGuess = gameData.totalGuess;
        averageGuesses = gameData.averageGuesses;
        localStorage.setItem('guesses', JSON.stringify(gameData.guesses));
        localStorage.setItem('guessCount', gameData.guessCount);

        // Update UI elements with restored data
        document.getElementById('played').textContent = 'Games played: ' + gamesPlayed;
        document.getElementById('won').textContent = 'Games won: ' + gamesWon;
        document.getElementById('winStreak').textContent = 'Current win streak: ' + winStreak;
        document.getElementById('averageGuesses').textContent = 'Average guesses per game: ' + averageGuesses;
        document.getElementById('priorGuessNum').textContent = 'Prior guesses: ' + gameData.guessCount;

        // Restore the game board
        if (allWords.length > 0) {
            createCards(allWords);
        }
    } else {
        // Start a new game if no game data is found
        startNewGame();
    }
});



function clearSelections() {
    document.querySelectorAll('.selected').forEach(element => {
        element.classList.remove('selected'); // Clear visual selection
    });
}

