<?php
// The TriviaContoller class is defined in a file that 
// resides in the src/ directory. This means that Apache cannot 
// directly serve the file. Note that when it is deployed to the 
// cs4640 server, this file will need to be placed outside the 
// public_html directory.

class CategoryGameController {
    private $connections = [];
    private $board = [];
    private $random_board = [];
    private $all_guesses = [];

    private $input;
    private $db;

    /**
     * Constructor
     */
    public function __construct($input) {
        $this->db = new Database();
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
            case "gameOver":
                $this->showGameOver();
                break;
            case "quit":
                $this->showGameOver();
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
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['passwd'])) {
            // Store all the login info to the current session
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['passwd'];
            $_SESSION['num_guesses'] = 0;
            
            // Direct to the game page
            $this->showGame();
        } else {
            // Invalid request, show error message
            die("Please provide your name, email, and password");
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
        $json = file_get_contents("/opt/src/hw5/connections.json");
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
            // also save as list for easy display??

        }
        // if theres already a game saved to the session, it should just calculate the 
        // current state of the game and return that shtuff
        
        return $this->random_board;
    }
    
    public function answerGame(){
        if(isset($_POST["answer"]) && is_numeric($_POST["answer"])){
            // input will be four numbers, find the corresponding key value and add it to guess []
            $answer = explode(' ', $_POST["answer"]);
            $guess = [];
            foreach($answer as $item){
                $guess[] = $this->random_board[$item];
            }

            // based on the four names, find if any category matches their guesses
            $match = [];
            foreach($this->board as $key => $value){
                $match = array_intersect($value, $guess);

                // if there's a perfect match to category, remove from random_board and update board
                if(count($match) == 4){
                    // adds to all_guess array, with the key being the num of matches to a category, 
                    // and value being the 4 numeric guesses
                    $this->all_guesses[count($match)] = $guess;   
                    foreach($answer as $value){
                        unset($this->random_board[$answer]);
                    }
                    $_SESSION["random_board"] = $this->random_board;
                }
                else{
                    $this->all_guesses[count($match)] = $guess; 
                }  
                           
                if(count($this->random_board) == 0){
                    $this->showGameOver();
                }
            }
        }
        // updates total amount of guesses made
        $_SESSION["num_guesses"] = count($this->all_guesses);
        return $this->all_guesses;
    }


    /**
     * Show the game to the user.  This function loads a
     * template PHP file and displays it to the user based on
     * properties of this object.
     */
    public function showGame($message = "") {
        $connections = $this->getGame();
        include("/opt/src/hw5/templates/game.php");
    }

    /**
     * Show the welcome page to the user.
     */
    public function showWelcome() {
        include("/opt/src/hw5/templates/welcome.php");
    }

    /**
     * Show the game over page to the user.
     */
    public function showGameOver() {
        $final_guesses = count($this->all_guesses);    // number of total guesses
        include("/opt/src/hw5/templates/gameOver.php");
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
