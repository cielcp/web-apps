<?php
// The TriviaContoller class is defined in a file that 
// resides in the src/ directory. This means that Apache cannot 
// directly serve the file. Note that when it is deployed to the 
// cs4640 server, this file will need to be placed outside the 
// public_html directory.

class CategoryGameController {

    private $questions = [];
    
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
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch($command) {
            case "game":
                $this->showGame();
                break;
            case "gameOver":
                $this->showGameOver();
                break;
            default:
                $this->showWelcome();
                break;
        }
    }

    /**
     * Load game info from a file, store them as an array
     * in the current object.
     */
    
    public function loadGame() {
        $this->game = json_decode(
            file_get_contents("https://cs4640.cs.virginia.edu/homework/connections.json"), true);

        if (empty($this->game)) {
            die("Something went wrong loading the game");
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
    }

    /**
     * Show the game to the user.  This function loads a
     * template PHP file and displays it to the user based on
     * properties of this object.
     */
    public function showGame($message = "") {
        $game = $this->getGame();
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
        include("/opt/src/hw5/templates/gameOver.php");
    }

    /**
     * Check the user's answer to a question.
     */

    /* public function answerQuestion() {
        $message = "";
        if (isset($_POST["questionid"]) && is_numeric($_POST["questionid"])) {

            $question = $this->getQuestion($_POST["questionid"]);

            if (strtolower(trim($_POST["answer"])) == strtolower($question["answer"])) {
                $message = "<div class=\"alert alert-success\" role=\"alert\">
                    Correct!
                    </div>";
            }
            else {
                $message = "<div class=\"alert alert-danger\" role=\"alert\">
                    Incorrect! The correct answer was: {$question["answer"]}
                    </div>";
            }
        }

        $this->showQuestion($message);
    } */

}
