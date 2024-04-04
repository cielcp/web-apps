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
        // check if user entered information
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // fetch user's email
            $sql = "SELECT * FROM users WHERE email = $1";
            $sql_prepare = pg_prepare($this->db, "fetch_user", $sql);
            $result = pg_execute($this->db, "fetch_user", array($email));
    
            // if email exists in database already
            if (pg_num_rows($result) > 0) {
                $user = pg_fetch_assoc($result);
                // verify if password is corrct
                if (password_verify($password, $user["password"])) {
                    // password entered is correct, go to profile
                    echo "Login Successful";
                    $this->showProfile();
                    return;
                } else {
                    // password entered is incorrect, go back to login screen
                    echo "Incorrect Password, Try Again";
                    $this->showLogin();
                }
            } else {
                echo "Email Does Not Exist, Try Again or Sign Up!";
                $this->showLogin();
            }
        } 
        else{
                // Error handling
                // Error_log('Insert error: ' . pg_last_error($this->db));
                // Provide feedback to the user as appropriate
                // echo "An error occurred.";
                echo "All fields are required.";

        }    
        $this->showLogin(); // Show login page on failure or if form data is missing
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
        // check if user entered information
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // fetch user's email
            $sql = "SELECT * FROM users WHERE email = $1";
            $sql_prepare = pg_prepare($this->db, "fetch_user", $sql);
            $result = pg_execute($this->db, "fetch_user", array($email));
    
            // if email exists in database already
            if (pg_num_rows($result) > 0){
                echo "Email Already Exists, Try Logging In!";
                $this->showLogin();
            } 
            else {
                // email is not in database, add as new entry
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
                $stmt = pg_prepare($this->db, "insert_user", $sql);
                $result = pg_execute($this->db, "insert_user", array($username, $email, $hashedPassword));

                if ($result) {
                    echo $username;
                    // Redirect or perform other success actions
                    echo "success making";
                    // Optionally, redirect to another page
                    $this->showProfile();
                }
            }
        }
        else {
            echo "All fields are required.";

        }
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