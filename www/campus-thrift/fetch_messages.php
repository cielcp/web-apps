<?php
// Include your database connection or any required files here
// Example: include('db_connection.php');

// Example code to fetch messages from the database
// Adjust this code according to your database structure and connection method
$user = $_SESSION['username']; // Assuming the logged-in user's ID is stored in the session
$sql = "SELECT * FROM messages WHERE buyer = ? OR seller = ?";
$messages = $this->db->prepareAndExecute("fetch_messages", $sql, array($user, $user));

header('Content-Type: application/json');
echo json_encode($messages);
?>