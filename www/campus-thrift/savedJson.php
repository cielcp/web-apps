<?php
// Query the database to fetch all saved listings for the current user
$savedListingsQuery = $this->db->prepareAndExecute("fetch_saved_listings", "SELECT listing_id FROM saved WHERE user_id = $1", [$user_id]);
$savedListings = $savedListingsQuery ? $savedListingsQuery->fetchAll(PDO::FETCH_ASSOC) : [];

// Prepare the data to be sent to JavaScript
$data = [
    'message' => $message,
    'savedListings' => $savedListings
];

// Convert data to JSON format
$jsonData = json_encode($data);

header('Content-Type: application/json');
echo $jsonData;
