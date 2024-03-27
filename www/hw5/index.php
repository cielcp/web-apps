<?php
// Our index file is in the web/www directory. 
// If we were to deploy it to the cs4640 server, 
// it would be in our public_html directory


// DEBUGGING ONLY! Show all errors.
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Start/resume the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    // Redirect to main page if user is already logged in
    header("Location: game.php");
    exit();
}

// Class autoloading by name.  All our classes will be in a directory
// that Apache does not serve publicly.  They will be in /opt/src/, which
// is our src/ directory in Docker.
spl_autoload_register(function ($classname) {
        include "/opt/src/hw5/$classname.php";
});

// Other global things that we need to do
// (such as starting a session, coming soon!)

// Instantiate the front controller
$game = new CategoryGameController($_GET);

// Run the controller
$game->run();

