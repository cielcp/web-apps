<?php

class CategoryGameController {
    private $connections = [];
    private $db;

    /**
     * Constructor -- check 
     */
    public function __construct($input) {
        $this->db = new Database();
        $this->input = $input;
        $this->loadQuestions();
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
            case "question":
                $this->showQuestion();
                break;
            case "answer":
                $this->answerQuestion();
                break;
            default:
                $this->showWelcome();
                break;
        }
    }

    /**
     * Load questions from a file, store them as an array
     * in the current object.
     */
    public function loadConnections() {
        $json = file_get_contents('https://cs4640.cs.virginia.edu/homework/connections.json');
        $this->connections = json_decode($json, true);

        if (empty($this->connections)) {
            die("Something went wrong loading connections");
        }
    }
    
    /**
     * Our getQuestion function, now as a method!
     */

    public function getConnections($id=null){
        $categories = array_rand($this->connections, 4);
        
    }
    public function getQuestion($id=null) {
/*         Your application should choose four categories at random from the bank and use them as the 
        categories and words for the game. You should then choose four words at 
        random from each of those categories. */

        if ($id === null) {
            $id = array_rand($this->questions);
            return [ "id" => $id, "question" => $this->questions[$id]["question"]];
        }
        if (is_numeric($id) && isset($this->questions[$id])) {
            return $this->questions[$id];
        }
        return false;
    }

    /**
     * Show a question to the user.  This function loads a
     * template PHP file and displays it to the user based on
     * properties of this object.
     */
    public function showQuestion($message = "") {
        $question = $this->getQuestion();
        include("/opt/src/trivia/templates/question.php");
    }

    /**
     * Show the welcome page to the user.
     */
    public function showWelcome() {
        include("/templates/wecome.php");
    }

    /**
     * Check the user's answer to a question.
     */
    public function answerQuestion() {
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
    }

}
