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
        //$this->loadGame();
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

    // Method to process user login
    private function processLogin() {
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['passwd'])) {
            // Store all the login info to the current session
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['passwd'];
            $_SESSION['num_guesses'] = 0;
            $_SESSION['guess_history'] = [];
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
        $json = file_get_contents('https://cs4640.cs.virginia.edu/homework/connections.json');
        $this->connections = json_decode($json, true);

        if (empty($this->connections)) {
            die("Something went wrong loading connections");
        }
    }
    
    /**
     * Our getGame function, now as a method!
     */
    public function getGame($id=null) {
        /* if ($id === null) {
            $id = array_rand($this->game);
            return [ "id" => $id, "question" => $this->game[$id]["question"]];
        }
        if (is_numeric($id) && isset($this->game[$id])) {
            return $this->game[$id];
        }
        return false; */

        $all_words = [];

        // randomly generates four categories
        $categories = array_rand($this->connections, 4);

        // for each category, randomly generate the 16 words that will be used
        foreach($categories as $category){
            $words = array_rand($this->connections[$category], 4);

            $w = [];
            foreach($words as $index){
                $w[] = $this->connections[$category][$index];
                $all_words[] = $this->connections[$category][$index];
            }
            $this->board[$category] = $w;
        }

        // all 16 words that will be used for the connections game, scrambled
        shuffle($all_words);
        foreach($all_words as $keys => $value){
            $this->random_board[$keys + 1] = $value;
        }

        return $this->random_board;
    
    }
    
    public function answerGame(){
        // given the number, grab the word and then check if the given guess matches the four words
        //temp variable for given answer input = $input

       // input will be four numbers, find the corresponding key value and pair and add it to guess []
       $answer = explode(', ', $_POST["answer"]);
       $guess = [];
       foreach($answer as $item){
           $guess[] = $this->random_board[$item];
       }

       // based on the four names, find if any category matches their guesses
       $match = [];
       $matchingKeys = [];
       foreach($this->board as $key => $value){
           $match = array_intersect($value, $guess);

           // if at least two of words (or phrases) the user guessed are in the same category, 
           // we’ll tell the user how many of the other words (or phrases) in their guess were 
           // not part of the category.
           if(count($match) > 2){
               $matchingKeys[] = $key; //idt we need
               $this->all_guesses[count($match)] = $guess;
           }

           // if guess matches to a given category, remove them from random_board and keep 
           // category name
           if(count($match) == 4){
               foreach($answer as $value){
                   unset($this->random_board[$answer]);
               }
               return $this->random_board;
               $matchingKeys[] = $key; //idt we need
               $this->all_guesses[count($match)] = $guess;
           }
           
           if(count($this->random_board) == 0){
                $this->showGameOver();
           }
       }
       // all of the guesses and how many are incorrect
       $this->all_guesses[4 - count($match)] = $answer;
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
