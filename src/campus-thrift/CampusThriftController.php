<?php

class CampusThriftController
{

    private $listings = [];
    private $input;
    private $db;

    // An error message to display on the welcome page
    private $errorMessage = "";

    /**
     * Constructor
     */
    public function __construct($input)
    {
        session_start();
        $this->db = new Database();
        $this->input = $input;
    }

    /**
     * Run the server
     */
    public function run()
    {
        // Get the command
        $command = "welcome";

        // Override command if specified in input
        if (isset($this->input["command"])) {
            $command = $this->input["command"];
        }

        // If the session doesn't have the key "name", AND they
        // are not trying to login (UPDATE!), then they
        // got here without going through the welcome page, so we
        // should send them back to the welcome page only.
        // if (!isset($_SESSION["name"]) && $command != "login")
        //     $command = "welcome";
        switch ($command) {
                // commands to process account stuff
            case "signup":
                $this->processSignup();
                break;
            case "login":
                $this->processLogin();
                break;
            case "logout":
                $this->processLogout();
                break;
                // commands to process listing stuff
            case "saveListing":
                $this->saveListing();
                break;
            case "createListing":
                $this->createListing();
                break;
            case "deleteListing":
                $this->deleteListing();
                break;
                // commands to show pages
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
            case "listing":
                $this->showListing();
                break;
            case "showCreateListing":
                $this->showCreateListing();
                break;
            case "showSignup":
                $this->showSignup();
                break;
            case "showLogin":
                $this->showLogin();
                break;
                // default homepage
            default:
                $this->showHome();
                break;
        }
    }

    public function sendMessage(){
        $username = $_POST['username'];
        $message = $_POST['message'];

        // okay fix this db stuff
        $query = $this->db->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
        $query->execute([$username, $message]);
        echo "Message sent!";
    }

    public function getMessage(){
        // fix db stuff
        $query = $this->db->query("SELECT * FROM messages ORDER BY timestamp DESC");
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($messages);
    }
    /** ------------------- FUNCTIONS TO PROCESS ACCOUNT STUFF ------------------- */

    public function processSignup()
    {
        // check if user entered information
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM users WHERE email = $1";
            $user = $this->db->prepareAndExecute("fetch_user", $sql, array($email));

            if ($user) {
                $message = "An account with that email already exists. Try logging in?";
                $this->showSignup($message);
                return;
            } else {
                // if email is not in database, sign the user in and add as new entry
                $_SESSION["username"] = $username;
                $_SESSION["email"] = $email;
                $_SESSION["logged"] = true;

                // hashing for security!
                //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
                $insertResult = $this->db->prepareAndExecute("insert_user", $sql, array($username, $email, $password)); // $hashedPassword later
                // if unsuccessful, refresh signup and show error message
                if ($insertResult === false) { 
                    $message = "There was an unknown error creating your account";
                    $this->showSignup($message);
                    return;
                } else {
                    // Show welcome message and redirect to home
                    $message = "Welcome to Campus Thrift, " . $username;
                    $this->showHome($message);
                    return;
                }
            }
        } else {
            $message = "Please enter the required fields";
            $this->showSignup($message);
        }
    }

    public function processLogin()
    {
        // check if user entered required information
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM users WHERE email = $1";
            $user = $this->db->prepareAndExecute("fetch_user", $sql, array($email));

            if ($user === false) {
                $message = "An account with that email does not exist, please try again";
                $this->showLogin($message);
                return;
            } else {
                $user = $user[0]; // Assuming email is unique, take the first result
                // Verify if password is correct
                // if (password_verify($password, $user["password"])) {
                if ($password === $user["password"]) {
                    // if password entered is correct, go to home?
                    $_SESSION["username"] = $username;
                    $_SESSION["email"] = $email;
                    $_SESSION["logged"] = true;
                    $message = "Welcome back to Campus Thrift, " . $username;
                    $this->showHome($message);
                    return;
                } else {
                    // If password entered is incorrect, refresh login screen
                    echo "FOR TESTING: password was: " . $user["password"] . " your password was: " . $password;
                    $message = "Incorrect password, please try again";
                    $this->showLogin($message);
                    return;
                }
            }
        } else {
            // Error handling
            // Error_log('Insert error: ' . pg_last_error($this->db));
            // Provide feedback to the user as appropriate
            // echo "An error occurred.";
            $message = "Please enter the required fields";
            $this->showSignup($message);
        }
    }

    public function processLogout()
    {
        $_SESSION = array();
        session_destroy();
        // session_start();
        $message = "You have been logged out";
        $this->showHome($message);
    }

    /** ------------------- FUNCTIONS TO PROCESS LISTING STUFF ------------------- */

    // function to create a listing into the databasae
    public function createListing()
    {
        //$message = "";

        if (!empty($_POST['name']) && !empty($_POST['description']) && isset($_POST['price'])) {
            //get the input
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $method = $_POST['method'];
            $tags = $_POST['tags'];
            // how to do images??????????
            $images = $_POST['image'];
            if (!empty($_SESSION['username'])) {
                $creator = $_SESSION['username'];
            } else {
                $message = "Um how did you get here? You need to sign in to create a listing...";
                $this->showLogin($message);
                return;
            }

            $sql = "INSERT INTO listings (name, description, price, category, images, creator, method, tags)
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
            $insertListing = $this->db->prepareAndExecute("insert_listing", $sql, array($name, $description, $price, $category, $images, $creator, $method, $tags));
            //$this->db->query("insert into users (name, description, password, score) values ($1, $2, $3, $4);", 0);

            if ($insertListing === false) {
                $message = "There was an unknown error creating your listing";
                $this->showCreateListing($message);
            } else {
                $message = "Successfully created your listing";
                $this->showProfile($message);
            }
        } else {
            $message = "Please enter at least the name, description, and price of your item";
            $this->showCreateListing($message);
        }
    }

    // function to delete a listing from the database
    public function deleteListing()
    {
        $message = "";
        if (!empty($_SESSION['listing_id'])) {
            //delete the listing that corresponds to the current id
            $this->db->query("DELETE FROM listings WHERE id=" . $_SESSION['listing_id'] . ";");
            $message = "Successfully deleted listing";
            $this->showProfile($message);
        } else {
            $message = "Invalid listing id";
            $this->showProfile($message);
        }
    }

    // load listing detail as json NOT WORKING
    public function loadListing()
    {
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
                "result" => "success",
                "listing_details" => []
            ];

            //get  listing info 
            $query = "SELECT * FROM listings WHERE id=1;";
            $listings = $this->db->query($query);
            foreach ($listings as $listing) :
                $keys = ['name', 'creator', 'description', 'price', 'category', 'method', 'images', 'tags'];
                $values = [];
                foreach ($keys as $i) :
                    array_push($output["listing_details"], [$i => $listing[$i]]);
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

    // function to save listing NEED TO DO
    public function saveListing()
    {
        $this->showSaved();
    }



    /** ------------------- FUNCTIONS TO SHOW PAGES ------------------- */

    // SWAP TO YOUR URL HERE!!
    public $myURL = "/students/ccp7gcp/students/ccp7gcp/private/campus-thrift/templates/";
    //public $myURL = "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/";

    public function showHome($message = "")
    {
        if (!empty($message)) {
            $alert = "<div class='alert alert-success'>{$message}</div>";
            echo $alert;
        }
        if ($_SERVER['SERVER_PORT'] === '8080') {
            include "/opt/src/campus-thrift/templates/home.php";
        } else {
            include ($this->myURL . "home.php");
        }
    }

    public function showSignup($message = "")
    {
        //$message = "what";
        if (!empty($message)) {
            $alert = "<div class='alert alert-success'>{$message}</div>";
            echo $alert;
        }
        include $this->myURL . "signup.php";
    }

    public function showLogin($message = "")
    {
        if (!empty($message)) {
            $alert = "<div class='alert alert-success'>{$message}</div>";
            echo $alert;
        }
        include $this->myURL . "login.php";
    }

    public function showMessages($message = "")
    {
        if (!empty($message)) {
            $alert = "<div class='alert alert-success'>{$message}</div>";
            echo $alert;
        }
        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            include $this->myURL . "messages.php";
        } else {
            $message = "Please sign in to access messaging";
            $this->showLogin($message);
        }
    }

    public function showSaved($message = "")
    {
        if (!empty($message)) {
            $alert = "<div class='alert alert-success'>{$message}</div>";
            echo $alert;
        }
        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            include $this->myURL . "saved.php";
        } else {
            $message = "Please sign in to access saved listings";
            $this->showLogin($message);
        }
    }

    public function showProfile($message = "")
    {
        if (!empty($message)) {
            $alert = "<div class='alert alert-success'>{$message}</div>";
            echo $alert;
        }
        // Show an optional error message if the errorMessage field
        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            include $this->myURL . "profile.php";
        } else {
            $message = "Please sign in to access your profile";
            $this->showLogin($message);
        }
    }

    public function showListing($message = "")
    {
        // $message = "";
        if (!empty($message)) {
            $alert = "<div class='alert alert-success'>{$message}</div>";
            echo $alert;
        }
        if (!empty($_POST['listing_id'])) {
            // Store the id to the current session
            $_SESSION['listing_id'] = $_POST['listing_id'];
            // redirect the user to the appropriate listing.php page (with the json file?)
            if ($_SERVER['SERVER_PORT'] === '8080') {
                include "/opt/src/campus-thrift/templates/listing.php";
            } else {
                include $this->myURL . "listing.php";
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

    public function showCreateListing($message = "")
    {
        if (!empty($message)) {
            $alert = "<div class='alert alert-success'>{$message}</div>";
            echo $alert;
        }
        //include ("/opt/src/campus-thrift/templates/create-listing.php");
        include($this->myURL . "create-listing.php");
    }
}
