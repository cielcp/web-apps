<?php

class CampusThriftController {
    private $input;
    private $db;
    private $errorMessage ="";

    /**
     * Constructor
     */
    public function __construct($input) {

                // We should always start (or join) a session at the top
        // of execution of PHP -- the constructor is the best place
        // to do that.
        $this->input = $input;

        // Connect to the database by instantiating a
        // Database object (provided by CS4640).  You have a copy
        // in the src/example directory, but it will be below as well.
        include "db.php";
        $this->db = $dbHandle;
    }

    /**
     * Run the server
     * 
     * Given the input (usually $_GET), then it will determine
     * which command to execute based on the given "command"
     * parameter.  Default is the welcome page.
     */
    public function run() {
        $command = "welcome";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch($command) {
            case "login":
                $this->processLogin();
                break;
            case "profile":
                $this->showProfile();
                break;
            case "signup":
                $this->showSignUp();
                break;
            case "messages":
                $this->showMessages();
                break;
            case "saved":
                $this->showSaved();
                break;
            default:
                $this->showHome();
                break;
        }
    }  

    public function processLogin() {

        // Assuming session_start() has been called at the top of your script
        
        // Check if the form has been submitted and the required POST data is available
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Check if email already exists
            $checkEmailSql = "SELECT 1 FROM users WHERE email = $1";
            $checkEmailStmt = pg_prepare($this->db, "check_email", $checkEmailSql);
            $checkEmailResult = pg_execute($this->db, "check_email", array($email));
        
            if (pg_num_rows($checkEmailResult) > 0) {
            // Email already exists, handle this case
                echo "Email already exists.";
                return; // Stop execution to prevent the insertion of duplicate email
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    

            $sql = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
            $stmt = pg_prepare($this->db, "insert_user", $sql);
            $result = pg_execute($this->db, "insert_user", array($username, $email, $hashedPassword));
            

            if ($result) {
                echo $username;
                // Redirect or perform other success actions
                echo "success";
                // Optionally, redirect to another page
                $this->showProfile();
                // exit;
            } else {
                // Error handling
                //rror_log('Insert error: ' . pg_last_error($this->db));
                // Provide feedback to the user as appropriate
                //echo "An error occurred.";
            }
        } else {
            // If the required POST data isn't available, handle the error
           echo "required";
        }
        $this->showLogin();
    }
    

    
    public function showProfile() {
        if(!isset($_POST["username"]) && !isset($_POST['email'])){
            $this->showLogin();
        }
        else{
            include("/opt/src/Campus-Thrift/templates/profile.php");
        }
    }

    public function showLogin(){
        include("/opt/src/Campus-Thrift/templates/login.php");

    }

    public function showHome(){
        include("/opt/src/Campus-Thrift/templates/home.php");

    }

    public function showSignUp(){
        include("/opt/src/Campus-Thrift/templates/signup.php");

    }

    public function showMessages(){
        if(!isset($_POST['name']) && !isset($_POST['email'])){
            $this->showLogin();
        }
        else{
            include("/opt/src/Campus-Thrift/templates/messages.php");
        }

    }

    public function showSaved(){
        if(!isset($_POST['name']) && !isset($_POST['email'])){
            $this->showLogin();
        }
        else{
            include("/opt/src/Campus-Thrift/templates/saved.php");

        }
    }

    

}