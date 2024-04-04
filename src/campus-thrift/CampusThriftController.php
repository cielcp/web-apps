<?php

class CampusThriftController {

    private $listings = [];
    
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
            case "home":
                $this->showHome();
                break;
            case "profile":
                $this->showProfile();
                break;
            case "message":
                $this->showMessages();
                break;
            case "saved":
                $this->showSaved();
                break;
            case "createListing":
                $this->createListing();
                break;

            case "answer":
                $this->answerQuestion();
                break;
            case "login":
                $this->login();
                break;
            case "logout":
                $this->logout();
                // no break; logout will also show the welcome page.
            default:
                //$this->showWelcome();
                //$this->showHome();
                $this->showCreateListing();
                break;
        }
    }

    /**
     * Show HOMEPAGE page to user
     */
    public function showHome() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include("/opt/src/campus-thrift/templates/home.php");
    }

    /**
     * Show HOMEPAGE page to user
     */
    public function showListingDetail() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include("/opt/src/campus-thrift/templates/listingDetail.php");
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
        include("/opt/src/campus-thrift/templates/signin.php");
    }

    /**
     * Login Function
     *
     * This function checks that the user submitted the form and did not
     * leave the name and email inputs empty.  If all is well, we set
     * their information into the session and then send them to the 
     * question page.  If all didn't go well, we set the class field
     * errorMessage and show the welcome page again with that message.
     *
     * NOTE: This is the function we wrote in class!  It **should** also
     * check more detailed information about the name/email to make sure
     * they are valid.
     */
    public function login() {
        if (isset($_POST["fullname"]) && isset($_POST["email"]) &&
            !empty($_POST["fullname"]) && !empty($_POST["email"])) {
            $_SESSION["name"] = $_POST["fullname"];
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["score"] = 0;
            header("Location: ?command=question");
            return;
        }
        $this->errorMessage = "Error logging in - Name and email is required";
        $this->showWelcome();
    }

    /**
     * Alternate Login Function
     *
     * **NEW**: we can replace the function above with this function which
     * will check the user's credentials against their information in the
     * database's users table to see if their password is correct.
     *
     * 1) if the user is not in the table, it automatically adds them and saves
     * the 1-way hash of their password to the table (so that they can log in again later)
     * 2) if the user is in the table, then it verifies that the password they
     * provided is correct.   If so, it allows them to continue playing, reading their
     * score out of the database.
     *
     * NOTE: you should **not** save passwords in clear text -- only the hashed passwords
     * are stored in the database.
     */
    public function loginDatabase() {
        // User must provide a non-empty name, email, and password to attempt a login
        if(isset($_POST["fullname"]) && !empty($_POST["fullname"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["passwd"]) && !empty($_POST["passwd"])) {

                // Check if user is in database, by email
                $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
                if (empty($res)) {
                    // User was not there (empty result), so insert them
                    $this->db->query("insert into users (name, email, password, score) values ($1, $2, $3, $4);",
                        $_POST["fullname"], $_POST["email"],
                        // Use the hashed password!
                        password_hash($_POST["passwd"], PASSWORD_DEFAULT), 0);
                    $_SESSION["name"] = $_POST["fullname"];
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["score"] = 0;
                    // Send user to the appropriate page (question)
                    header("Location: ?command=question");
                    return;
                } else {
                    // User was in the database, verify password is correct
                    // Note: Since we used a 1-way hash, we must use password_verify()
                    // to check that the passwords match.
                    if (password_verify($_POST["passwd"], $res[0]["password"])) {
                        // Password was correct, save their information to the
                        // session and send them to the question page
                        $_SESSION["name"] = $res[0]["name"];
                        $_SESSION["email"] = $res[0]["email"];
                        $_SESSION["score"] = $res[0]["score"];
                        header("Location: ?command=question");
                        return;
                    } else {
                        // Password was incorrect
                        $this->errorMessage = "Incorrect password.";
                    }
                }
        } else {
            $this->errorMessage = "Name, email, and password are required.";
        }
        // If something went wrong, show the welcome page again
        $this->showWelcome();
    }

    /**
     * Show messages page to user
     */
    public function showMessages() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include("/opt/src/campus-thrift/templates/messages.php");
    }

    /**
     * Show saved page to user
     */
    public function showSaved() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        include("/opt/src/campus-thrift/templates/saved.php");
    }

    /**
     * Show profile page to user
     */
    public function showProfile() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $message = "";
        if (!empty($this->errorMessage)) {
            $message = "<div class='alert alert-danger'>{$this->errorMessage}</div>";
        }
        //include("/opt/src/campus-thrift/templates/profile.php");
        include("/students/ccp7gcp/students/ccp7gcp/private/campus-thrift/templates/profile.php");

    }

    /**
     * Show create-listing page to user
     */
    public function showCreateListing($message = "") {
        //include("/opt/src/campus-thrift/templates/create-listing.php");
        include("/students/ccp7gcp/students/ccp7gcp/private/campus-thrift/templates/create-listing.php");
    }

    /**
     * Show create-listing page to user
     */
    public function createListing() {
        $x = "hi";
        //$this->db->query("INSERT INTO listing (name, creator, description, price, category, method, image, tags) VALUES ($x, $x, $x, 10, $x, $x, $x, $x);");
        $message = "";
        echo $x;
        $listings = $this->db->query("select * FROM listing;");

        foreach ($listings as $listing):
            echo $listing["name"];
        endforeach;
    
        //if (!empty($_POST["createButton"])) {
        if (isset($_POST['name'])) {
            //get the input
            $name = $_POST['name'];
            $creator = "cielpark"; //$_SESSION['user'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $method = $_POST['method'];
            $image = $_POST['image'];
            $tags = $_POST['tags'];

            //save the input as an entry in the listing db
            
            
            $this->db->query("INSERT INTO listing (name, creator, description, price, category, method, image, tags) 
             VALUES ($1, $2, $3, $4, $5, $6, $7, $8);",
             $name, $creator, $description, $price, $category, $method, $image, $tags);

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
    }


    /**
     * Logout
     *
     * Destroys the session, essentially logging the user out.  It will then start
     * a new session so that we have $_SESSION if we need it.
     */
    // public function logout() {
    //     session_destroy();
    //     session_start();
    // }
















    
    /**
     * Our getQuestion function, now as a method!
     */
//     public function getQuestion($id=null) {

//         // If $id is not set, then get a random question
//         // We wrote this in class.
//         if ($id === null) {
//             // Read ONE random question from the database
//             $qn = $this->db->query("select * from questions order by random() limit 1;");

//             // The query function calls pg_fetch_all, which returns an **array of arrays**.
//             // That means that if we only have one row in our result, it's an array at
//             // position 0 of the array of arrays.
//             // Note: we should check that $qn here is _not_ false first!
//             return $qn[0];
//         }
        
//         // If an $id **was** passed in, then we should get that specific
//         // question from the database.
//         //
//         // NOTE: We did **not** write this in class, but it is provided/updated
//         // below:
//         if (is_numeric($id)) {
//             $res = $this->db->query("select * from questions where id = $1;", $id);
//             if (empty($res)) {
//                 return false;
//             }
//             return $res[0];
//         }
       
//         // Anything else, just return false
//         return false;
//     }

//     /**
//      * Show a question to the user.  This function loads a
//      * template PHP file and displays it to the user based on
//      * properties of this object and the SESSION information.
//      */
//     public function showQuestion($message = "") {
//         $name = $_SESSION["name"];
//         $email = $_SESSION["email"];
//         $score = $_SESSION["score"];
//         $question = $this->getQuestion();
//         include("/opt/src/trivia/templates/question.php");
//     }


//     /**
//      * Check the user's answer to a question.
//      */
//     public function answerQuestion() {
//         $message = "";
//         if (isset($_POST["questionid"]) && is_numeric($_POST["questionid"])) {

//             $question = $this->getQuestion($_POST["questionid"]);

//             if (strtolower(trim($_POST["answer"])) == strtolower($question["answer"])) {
//                 $message = "<div class=\"alert alert-success\" role=\"alert\">
//                     Correct!
//                     </div>";
//                 // Update the score in the session
//                 $_SESSION["score"] += 10;

//                 // **NEW**: We'll update the user's score in the database, too!
//                 $this->db->query("update users set score = $1 where email = $2;", 
//                                     $_SESSION["score"], $_SESSION["email"]);
//             }
//             else {
//                 $message = "<div class=\"alert alert-danger\" role=\"alert\">
//                     Incorrect! The correct answer was: {$question["answer"]}
//                     </div>";
//             }
//         }

//         $this->showQuestion($message);
//     }

// }
