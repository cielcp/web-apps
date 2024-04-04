<?php

class CampusThriftController {

    private $listings = [];
    private $input;
    private $db;

    // An error message to display on the welcome page
    private $errorMessage = "";

    /**
     * Constructor
     */
    public function __construct($input) {
        // We should always start (or join) a session at the top
        // of execution of PHP -- the constructor is the best place
        // to do that.
        session_start(); // start a session!
        
        // Connect to the database by instantiating a
        // Database object (provided by CS4640).  You have a copy
        // in the src/example directory, but it will be below as well.
        $this->db = new Database();
       // $this->db = $this->db->getConnection();

        // Set input
        $this->input = $input;

        // Loading questions no longer necessary, as they are
        // in the database
        //$this->loadQuestions();
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
        $command = "welcome";
        
        // Override command if specified in input
        if (isset($this->input["command"])) {
            $command = $this->input["command"];
        }

        // NOTE: UPDATED 3/29/2024!!!!!
        // If the session doesn't have the key "name", AND they
        // are not trying to login (UPDATE!), then they
        // got here without going through the welcome page, so we
        // should send them back to the welcome page only.
        // if (!isset($_SESSION["name"]) && $command != "login")
        //     $command = "welcome";

        switch($command) {
            case "signup":
                $this->showSignUp();
                break;
            case "login":
                $this->processLogin();
                break;
            case "home":
                $this->showHome();
                break;
            case "profile":
                $this->showProfile();
                break;
            case "messages":
                $this->showMessages();
                break;
            case "saved":
                $this->showSaved();
                break;
            case "viewListing":
                $this->showListing();
                break;
            case "saveListing":
                $this->saveListing();
                break;
            case "createListing":
                $this->createListing();
                break;

            /* case "answer":
                $this->answerQuestion();
                break;
            case "login":
                $this->login();
                break;
            case "logout":
                $this->logout(); */
                // no break; logout will also show the welcome page.
            default:
                //$this->showWelcome();
                $this->showHome();
                //$this->showCreateListing();
                break;
        }
    }



    /**
     * Show home page to user
     */
    public function showHome() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        if ($_SERVER['SERVER_PORT'] === '8080') {
                include "/opt/src/campus-thrift/templates/home.php";
        } else {
                include "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/home.php";
        }
    }


    /**
     * load listing detail as json
     */
    public function loadListing() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        if (isset($_POST['listing_id'])) {
            // sanitizing the input
            $listing_id = $_POST['listing_id'];

            // Set headers to indicate JSON content
            //header('Content-Type: application/json');

            //this worked earlier! keep for reference
            /* $listings = $this->db->query("select * FROM listings;");
            foreach ($listings as $listing):
                echo $listing["name"];
            endforeach; */

            // build the return data structure
            $output = [
                "result"=> "success",
                "listing_details"=> []
            ];

            //get  listing info 
            $query = "SELECT * FROM listings WHERE id=1;";
            $listings = $this->db->query($query);
            foreach ($listings as $listing):
                $keys = ['name', 'creator', 'description', 'price', 'category', 'method', 'images', 'tags'];
                $values = [];
                foreach ($keys as $i):
                    array_push($output["listing_details"], [$i =>$listing[$i]]);
                endforeach;
                // $count=0;
                // foreach ($keys as $i):
                //     array_push($output["listing_details"], [$i => $values[$count]]);
                //     $count += 1;
                // endforeach;
                
            endforeach;

            
                /* foreach ($listing as $detail) {
                    $keys = $listing[$columns];
                    $values = [];
                    foreach ($keys as $key)
                        array_push($values, $listing[$columns][$key]);

                    array_push($output["listing_details"], [
                        "columns" => $columns,
                        "values" => $values
                    ]);
                } */
            
            return json_encode($output, JSON_PRETTY_PRINT); 
            } 
                // Output the JSON data
                // return $json_data;
                //$_SESSION['listing_details'] = $json_data;

            //make a json with the information of the specific listing
            // Fetch the listing details from the database based on the ID
            //$query = "SELECT * FROM listings WHERE ID = $1";
            //uhhhh $res = $this->db->query("select * from questions where id = $1;", $id);
            //$listing = $this->db->query("select * from listings where ID =". $listing_id . ";");
            // Check if the listing was found
            //if ($listing->num_rows > 0) {
            // Fetch data and store it in an array

            // Convert the array to JSON format
            //$json_data = json_encode($listing_details, JSON_PRETTY_PRINT);
            // Output the JSON data
            //echo $json_data;
            //$_SESSION['listing_details'] = $json_data;
        else {
            // No listing found
            return json_encode(array('result' => 'Listing not found'));
        }

    }


    /**
     * Show listing detail pages to user
     */
    public function showListing() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }

        if (isset($_POST['listing_id']) && !empty($_POST['listing_id'])){
            // Store the id to the current session
            $_SESSION['listing_id'] = $_POST['listing_id'];

        // redirect the user to the appropriate listing.php page with the json file
        if ($_SERVER['SERVER_PORT'] === '8080') {
            include "/opt/src/campus-thrift/templates/listing.php";
        } 
        else {
                include "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/listing.php"; //?ID=" . $listing_id;
        }
            // Direct to the view listing page
            if ($_SERVER['SERVER_PORT'] === '8080') {
                include "/opt/src/campus-thrift/templates/listing.php";
            } 
            else {
                include "/students/ccp7gcp/students/ccp7gcp/private/campus-thrift/templates/listing.php"; //?ID=" . $listing_id;
            }
        } else {
            // Invalid request, show error message
            die("Invalid listing ID provided");
        }
        
        // json shtuff
        /* // load the listing details json file
        $data = $this->loadListing();
        //save to session
        $parsed_data = json_decode($data, true);
        $_SESSION['listing_details'] = json_decode($data, true);
        foreach ($data as $item) {
            echo 'ID: ' . $item['id'] . ', Name: ' . $item['name'] . ', Price: ' . $item['price'] . '<br>';
        } */

        // redirect the user to the appropriate listing.php page with the json file

    }


    /**
     * Show listing detail pages to user
     */
    public function saveListing() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        $this->showHome();
    }


    /**
     * Show the signin page to the user.
     */
    public function showWelcome() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        if ($_SERVER['SERVER_PORT'] === '8080') {
                include "/opt/src/campus-thrift/templates/signin.php";
        } else {
                include "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/signin.php";
        }
        
    }

 
    /**
     * Show messages page to user
     */
    public function showMessages() {
        if(!isset($_SESSION['name']) && !isset($_SESSION['email'])){
            $this->showLogin();
        }
        else{
            include "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/messages.php";
        }
    }

    /**
     * Show saved page to user
     */
    public function showSaved() {
        if(!isset($_SESSION['name']) && !isset($_SESSION['email'])){
            $this->showLogin();
        }
        else{
            include "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/saved.php";
        }
    }

    /**
     * Show profile page to user
     */
    public function showProfile() {
        // Show an optional error message if the errorMessage field
        if(!isset($_SESSION['name']) && !isset($_SESSION['email'])){
            $this->showLogin();
        }
        else{
            include "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/profile.php";
        }

    }

    /**
     * Show create-listing page to user
     */
    public function showCreateListing($message = "") {
        //include("/opt/src/campus-thrift/templates/create-listing.php");
        include("/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/create-listing.php");
    }

    /**
     * Show create-listing page to user
     */
    public function createListing() {
        //$x = "hi";
        //$this->db->query("INSERT INTO listings (name, creator, description, price, category, method, images, tags) VALUES ($x, $x, $x, 10, $x, $x, $x, $x);");
        $message = "";
        //echo $x;
    
        //if (!empty($_POST["createButton"])) {
        if (isset($_POST['name'])) {
            //get the input
            $name = $_POST['name'];
            $creator = "cielpark"; //$_SESSION['user'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $method = $_POST['method'];
            $images = $_POST['image'];
            $tags = $_POST['tags'];

            //save the input as an entry in the listing db
            $this->db->query("INSERT INTO listings (name, creator, description, price, category, method, images, tags) 
             VALUES ($1, $2, $3, $4, $5, $6, $7, $8);",
             $name, $creator, $description, $price, $category, $method, $images, $tags);

            //$this->db->query("insert into users (name, email, password, score) values ($1, $2, $3, $4);", 0);
            $message = "<div class=\"alert alert-danger\" role=\"alert\">
                    hey!
                    </div>";

            $this->showProfile();
            }
            else {
                $message = "<div class=\"alert alert-danger\" role=\"alert\">
                    hey!
                    </div>";
            }
        }
        //$this->showCreateListing($message);
    

    public function showSignUp(){
        // check if user entered information
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

/*             // fetch user's email
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
        } */  

            $sql = "SELECT * FROM users WHERE email = $1";
            $user = $this->db->prepareAndExecute("fetch_user", $sql, array($email));

            if ($user) {
                echo "Email Already Exists, Try Logging In!";
                $this->showLogin();
            }
            else {
                // email is not in database, add as new entry
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["email"] = $_POST["email"];

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
                $insertResult = $this->db->prepareAndExecute("insert_user", $sql, array($username, $email, $hashedPassword));
                if ($insertResult) {
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
        include "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/signup.php";
    }

    public function processLogin() {    
        // check if user entered information
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
/* 
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
        }  */
        

            $sql = "SELECT * FROM users WHERE email = $1";
            $user = $this->db->prepareAndExecute("fetch_user", $sql, array($email));

            if ($user && count($user) > 0) {
                $user = $user[0]; // Assuming email is unique, take the first result
                // Verify if password is correct
                if (password_verify($password, $user["password"])) {
                // Password entered is correct, go to profile
                    $_SESSION["username"] = $_POST["username"];
                    $_SESSION["email"] = $_POST["email"];
                    
                    echo "Login Successful";
                    $this->showProfile();
                } else {
                // Password entered is incorrect, go back to login screen
                echo "Incorrect Password, Try Again";
                $this->showLogin();
                }   
            }
            else {
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

    public function showLogin(){
        include "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/login.php";
    }
    
}

