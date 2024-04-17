<?php
// BELOW IS JUST CHAT GPTED

// Get the number of rows and columns from the query string
$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 0;
$columns = isset($_GET['columns']) ? intval($_GET['columns']) : 0;

// Initialize an array to store the starting positions of lights
$starting_positions = [];

// Check if the board has less than 10 boxes
$total_boxes = $rows * $columns;
if ($total_boxes <= 10) {
    // If the board has less than 10 boxes, all lights are on
    for ($i = 1; $i <= $rows; $i++) {
        for ($j = 1; $j <= $columns; $j++) {
            $starting_positions[] = [$i, $j];
        }
    }
} else {
    // Randomly select 10 starting positions
    $selected_positions = [];
    while (count($selected_positions) < 10) {
        $random_row = mt_rand(1, $rows);
        $random_column = mt_rand(1, $columns);
        $position = [$random_row, $random_column];
        // Check if the position is already selected
        if (!in_array($position, $selected_positions)) {
            $selected_positions[] = $position;
        }
    }
    $starting_positions = $selected_positions;
}

// Return the starting positions as a JSON object
header('Content-Type: application/json');
echo json_encode($starting_positions);




class CategoryGameController {
    private $connections = [];
    private $board = [];
    private $random_board = [];
    private $all_guesses = [];

    private $input;

    /**
     * Constructor
     */
    public function __construct($input) {
        $this->input = $input;
        $this->loadGame();
    }

    /**
     * Run the server
     * 
     * Given the input (usually $_GET), then it will determine
     * which command to execute based on the given "command"
     * parameter.  Default is the welcome page.
     */
    public function run() {
        // Get the command
        $command = "example";

        // Override command if specified in input
        if (isset($this->input["command"])) {
            $command = $this->input["command"];
        }

        // Check if user is logged in
        /* if(isset($_SESSION['email'])) {
            $command = "game"; // Show game if user is logged in
        } */

        switch($command) {
            case "login":
                $this->processLogin();
                break;
            case "game":
                $this->showGame();
                break;
            case "answer":
                $this->answerGame();
                break;
            case "gameOver":
                $this->showGameOver();
                break;
            case "quit":
                $this->showGameOver();
                break;
            case "playAgain":
                $this->playAgain();
                break;
            case "exit":
                $this->exitGame();
                break;
            default:
                $this->showWelcome();
                break;
        }
    }


    /**
     * Method to process user login, store form info in session, redirect to game page
     */
    private function processLogin() {
        if(isset($_POST['name']) && isset($_POST['email']) && !empty($_POST['name']) && !empty($_POST['email'])){
            // Store all the login info to the current session
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['num_guesses'] = 0;
            
            // Direct to the game page
            $this->showGame();
        } else {
            // Invalid request, show error message
            die("Please provide your name and email");
        }
    }


    /**
     * Load game info from a file, store them as an array
     * in the current object.
     */
    public function loadGame() {
        /* When you publish your code to the CS4640 server, update your code to read our 
        connections.json file directly from the server. You can do this by reading from the 
        following absolute path: /var/www/html/homework/connections.json */
        
        // loads all the categories in the json file
        $json = file_get_contents("/var/www/html/homework/connections.json");
        //$json = file_get_contents("/opt/src/hw5/connections.json"); // for local dev
        $this->connections = json_decode($json, true);

        if (empty($this->connections)) {
            die("Something went wrong loading the game");
        }
    }
    
    /**
     * Our getGame function, now as a method!
     */
    public function getGame($id=null) {
        // if it's our first time getting the game, should get 4 random categories,
        // the board, and the random board and save those to session
        if (!isset($_SESSION["board"])) {
            $all_words = [];
            // randomly generates four categories
            $categories = array_rand($this->connections, 4);
            // for each category, get 4 random words for that category, and save all to board
            foreach($categories as $category){
                $words = array_rand($this->connections[$category], 4);
                $w = [];
                foreach($words as $index){
                    $w[] = $this->connections[$category][$index];
                    $all_words[] = $this->connections[$category][$index];
                }
                $this->board[$category] = $w;
            }
            // now that our board of 16 words is done, save to session
            $_SESSION["board"] = $this->board;
            // all 16 words that will be used for the connections game, scrambled
            shuffle($all_words);
            foreach($all_words as $keys => $value){
                $this->random_board[$keys + 1] = $value; // do we need to + 1??
            }
            // now that our random board for display is done, 
            // save to session for display and checking
            $_SESSION["random_board"] = $this->random_board;
        }
        // if theres already a game saved to the session, it should just calculate the 
        // current state of the game and return that shtuff
        
        return $this->random_board;
    }
    
    public function answerGame(){
        if(isset($_POST["answer"])){
            unset($_SESSION["message"]);
            // answer is an array of the 4 input numbers
            $answer = explode(' ', $_POST["answer"]);
            $guess = [];
            // get the words corresponding to the numeric input
            foreach($answer as $num){
                if (array_key_exists($num, $_SESSION["random_board"])) { //if the number is a valid guess
                    $word = $_SESSION["random_board"][$num];
                    $guess[] = $word;
                } 
                else {
                    $_SESSION["message"] = "Please make a valid guess";
                    $this->showGame();
                    exit();
                }
            }
            // based on the four words, find if any category matches
            $match = [];
            $hint = "Not quite...";
            foreach($_SESSION["board"] as $key => $value) {
                $match = array_intersect($value, $guess);
                // if there's a perfect match to category, remove from random_board and update board
                if(count($match) == 4) { 
                    foreach($answer as $num){
                        unset($_SESSION["random_board"][$num]);
                    }
                    $hint = $key;
                }
                elseif (count($match) == 3) {
                    $hint = "One away!";
                }
                elseif (count($match) == 2) {
                    $hint = "Two away";
                }
            }
            // update the list of all previous guesses
            $_SESSION["all_guesses"][] = [$guess, $hint];
            $_SESSION["num_guesses"] = count($_SESSION["all_guesses"]);
            // if after checking, the random_board is now empty, redirect to game over
            if (count($_SESSION["random_board"]) === 0) {
                $this->showGameOver();
                exit();
            }
            // Redirect to the game page
            $this->showGame();
        } else {
            die("Not sure how this error is possible but plz make a guess??");
        }
    }

    /**
     * Show the game to the user.  This function loads a
     * template PHP file and displays it to the user based on
     * properties of this object.
     */
    public function showGame($message = "") {
        $connections = $this->getGame();
        // updates total amount of guesses made
        if(isset($_SESSION["all_guesses"])) {
            $_SESSION["num_guesses"] = count($_SESSION["all_guesses"]);
        }
        include("/students/ccp7gcp/students/ccp7gcp/private/hw5/templates/game.php");
    }

    /**
     * Show the welcome page to the user.
     */
    public function showWelcome() {
        include("/students/ccp7gcp/students/ccp7gcp/private/hw5/templates/welcome.php");
    }

    /**
     * Show the game over page to the user.
     */
    public function showGameOver() {
        $_GET["command"] = "gameOver";
        // updates total amount of guesses made
        if(isset($_SESSION["all_guesses"])) {
            $_SESSION["num_guesses"] = count($_SESSION["all_guesses"]);
        }
        include("/students/ccp7gcp/students/ccp7gcp/private/hw5/templates/gameOver.php");
    }

    /**
     * function to play again
     * keeps the session but resets all the session variables except login info
     */
    public function playAgain() {
        $this->connections = [];
        $this->board = [];
        $this->random_board = [];
        $this->all_guesses = [];
        $_SESSION['num_guesses'] = 0;
        unset($_SESSION["board"]);
        unset($_SESSION["random_board"]);
        unset($_SESSION["all_guesses"]);
        unset($_SESSION["message"]);
        $this->loadGame();
        $this->showGame();
    }

    /**
     * Exit the game and destroy the session.
     */
    private function exitGame() {
        // Destroy the session
        session_destroy();
        // Redirect to the welcome page
        $this->showWelcome();
    }

}