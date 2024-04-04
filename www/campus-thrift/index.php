<?php
// Published version: https://cs4640.cs.virginia.edu/ccp7gcp/hw5

// Our index file is in the web/www directory. 
// If we were to deploy it to the cs4640 server, 
// it would be in our public_html directory


// DEBUGGING ONLY! Show all errors.
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Class autoloading by name.  All our classes will be in a directory
// that Apache does not serve publicly.  They will be in /opt/src/, which
// is our src/ directory in Docker.
spl_autoload_register(function ($classname) {
        include "/students/ccp7gcp/students/ccp7gcp/private/campus-thrift/$classname.php";
        //include "/opt/src/campus-thrift/$classname.php"; // for local
});

// Other global things that we need to do
// (such as starting a session, coming soon!)

// Start/resume the session (not necessary anymore if in controller?)
//session_start();

// Instantiate the front controller
$thrift = new CampusThriftController($_GET);

// Run the controller
$thrift->run();

