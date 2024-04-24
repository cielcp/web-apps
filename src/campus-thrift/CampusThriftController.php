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

    /** ------------------- MESSAGE STUFF? ------------------- */


    public function sendMessage()
    {
        $username = $_POST['username'];
        $message = $_POST['message'];

        // okay fix this db stuff
        $query = $this->db->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
        $query->execute([$username, $message]);
        echo "Message sent!";
    }

    public function getMessage()
    {
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
                    $user = $this->db->prepareAndExecute("fetch_user", $sql, array($email));
                    $userid = $user["id"];
                    $_SESSION["user_id"] = $userid;
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
                    
                    // WHY IS THIS RETURNING NULL
                    $userid = $user["id"];
                    $_SESSION["user_id"] = $userid;
                    $message = "Wel " . $user["id"] . "come back to Campus Thrift, " . $username;
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

            // PROCESS METHOD
            $method = "";
            if (isset($_POST['pickupCheck'])) {
                $method .= "Pickup, ";
            }
            if (isset($_POST['dropoffCheck'])) {
                $method .= "Dropoff, ";
            }
            if (isset($_POST['meetupCheck'])) {
                $method .= "Meetup, ";
            }
            // Remove trailing comma and space
            $method = rtrim($method, ", ");

            // PROCESS TAGS
            $tags = "";
            if (isset($_POST['excellentCheck'])) {
                $tags .= "Excellent, ";
            }
            if (isset($_POST['greatCheck'])) {
                $tags .= "Great, ";
            }
            if (isset($_POST['goodCheck'])) {
                $tags .= "Good, ";
            }
            if (isset($_POST['poorCheck'])) {
                $tags .= "Poor, ";
            }
            // Clothing
            if (isset($_POST['XsmallCheck'])) {
                $tags .= "Xsmall, ";
            }
            if (isset($_POST['SmallCheck'])) {
                $tags .= "Small, ";
            }
            if (isset($_POST['MediumCheck'])) {
                $tags .= "Medium, ";
            }
            if (isset($_POST['LargeCheck'])) {
                $tags .= "Large, ";
            }
            if (isset($_POST['XlargeCheck'])) {
                $tags .= "Xlarge, ";
            }
            if (isset($_POST['TopsCheck'])) {
                $tags .= "Tops, ";
            }
            if (isset($_POST['BottomsCheck'])) {
                $tags .= "Bottoms, ";
            }
            if (isset($_POST['OuterwearCheck'])) {
                $tags .= "Outerwear, ";
            }
            if (isset($_POST['DressesCheck'])) {
                $tags .= "Dresses, ";
            }
            if (isset($_POST['ShoesCheck'])) {
                $tags .= "Shoes, ";
            }
            if (isset($_POST['BagsCheck'])) {
                $tags .= "Bags, ";
            }
            if (isset($_POST['AccessoriesCheck'])) {
                $tags .= "Accessories, ";
            }
            // Home
            if (isset($_POST['TableCheck'])) {
                $tags .= "Table, ";
            }
            if (isset($_POST['ChairCheck'])) {
                $tags .= "Chair, ";
            }
            if (isset($_POST['CouchCheck'])) {
                $tags .= "Couch, ";
            }
            if (isset($_POST['StorageCheck'])) {
                $tags .= "Storage, ";
            }
            if (isset($_POST['DecorationCheck'])) {
                $tags .= "Decoration, ";
            }
            if (isset($_POST['DishwareCheck'])) {
                $tags .= "Dishware, ";
            }
            if (isset($_POST['AppliancesCheck'])) {
                $tags .= "Appliances, ";
            }
            // School supplies
            if (isset($_POST['TextbooksCheck'])) {
                $tags .= "Textbooks, ";
            }
            if (isset($_POST['StationaryCheck'])) {
                $tags .= "Stationary, ";
            }
            if (isset($_POST['ElectronicsCheck'])) {
                $tags .= "Electronics, ";
            }
            if (isset($_POST['EquipmentCheck'])) {
                $tags .= "Equipment, ";
            }
            if (isset($_POST['OtherCheck'])) {
                $tags .= "Other, ";
            }
            // Other
            if (isset($_POST['EntertainmentCheck'])) {
                $tags .= "Entertainment, ";
            }
            if (isset($_POST['CollectiblesCheck'])) {
                $tags .= "Collectibles, ";
            }
            if (isset($_POST['LeaseCheck'])) {
                $tags .= "Lease, ";
            }
            if (isset($_POST['TicketsCheck'])) {
                $tags .= "Tickets, ";
            }
            if (isset($_POST['FoodCheck'])) {
                $tags .= "Food, ";
            }
            if (isset($_POST['ServicesCheck'])) {
                $tags .= "Services, ";
            }
            if (isset($_POST['Health & BeautyCheck'])) {
                $tags .= "Health & Beauty, ";
            }
            // Remove trailing comma and space
            $tags = rtrim($tags, ", ");

            // PROCESS IMAGE
            // Check the image file
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $message = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $message = "File is not an image.";
                $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $message = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                $message = "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "webp"
            ) {
                $message = "Sorry, only JPG, JPEG, PNG, GIF, and WEBP files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                // $message = "Sorry, your file was not uploaded.";
                $images = "images/greyshirt.jpg";
                $this->showCreateListing($message);
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                    // Store file path in database
                    $image_path = $target_file;
                    // Insert $image_path into your database table
                    $images = $image_path;
                } else {
                    $message = "Sorry, there was an error uploading your file.";
                    $this->showCreateListing($message);
                }
            }


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
            // ALSO REMOVE IMAGE FROM SERVER?


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

    // script to save listing and return as an ajax request to display saved buttons correctly
    public function saveListing()
    {
        // Check if the user is logged in
        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            // Check if the listing ID is provided
            if (!empty($_POST['listing_id'])) {
                $listing_id = $_POST['listing_id'];

                // Check if the listing exists in the database
                $listing = $this->db->prepareAndExecute("fetch_listing", "SELECT * FROM listings WHERE id = $1", [$listing_id]);

                if ($listing) {
                    // Get the id of the currently logged-in user
                    // THIS IS RETURNING NULL AND ITS REALLY MESSING ME UP!!
                    $user_id = $_SESSION['user_id'];
                    // echo $user_id;

                    // Check if the listing is already saved by the user
                    $savedListing = $this->db->prepareAndExecute("fetch_saved_listing", "SELECT * FROM saved WHERE listing_id = $1 AND user_id = $2", [$listing_id, $user_id]);

                    if ($savedListing) {
                        //remove the saved listing that corresponds to the current id
                        $this->db->query("DELETE FROM saved WHERE listing_id=" . $listing_id . ";");
                        $message = "Listing removed from saved.";
                    } else {
                        // Save the listing
                        $insertResult = $this->db->prepareAndExecute("insert_saved_listing", "INSERT INTO saved (listing_id, user_id) VALUES ($1, $2)", [$listing_id, $user_id]);
                        if ($insertResult === false) {
                            $message = "Error saving listing.";
                        } else {
                            $message = "Listing saved successfully.";
                        }
                    }
                } else {
                    $message = "Listing not found.";
                }
            } else {
                $message = "No listing ID provided.";
            }
        } else {
            // User is not logged in
            $message = "Please log in to save listings.";
        }

        // Show the appropriate message and redirect to the home page (or saved page?)
        $this->showHome($message);
    }



    /** ------------------- FUNCTIONS TO SHOW PAGES ------------------- */

    // SWAP TO YOUR URL HERE!!
    public $myURL = "/opt/src/campus-thrift/templates/";
    //public $myURL = "/students/ccp7gcp/students/ccp7gcp/private/campus-thrift/templates/";
    //public $myURL = "/students/hyp2ftn/students/hyp2ftn/private/campus-thrift/templates/";

    public function showHome($message = "")
    {
        if (!empty($message)) {
            $alert = "<div class='alert alert-success'>{$message}</div>";
            echo $alert;
        }
        include($this->myURL . "home.php");
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
            include $this->myURL . "listing.php";
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
