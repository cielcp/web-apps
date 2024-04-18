<?php

/* Write a setup.php back-end file that accepts the number of rows 
and columns in the board as GET parameters (on the query string) and 
randomly select 10 starting positions–the boxes in the board where the 
lights will be on at the start of the game. */ 

// class setupLightsOut {

 // Get the number of rows and columns from the query string
 // This number will be used to create a square board  --> idt we need rows and columns if it's a square
$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 0;
//$columns = isset($_GET['columns']) ? intval($_GET['columns']) : 0;
echo $rows . $columns;

// Initialize an array to store the starting positions of lights
$starting_positions = [];

// Check if the board has less than 10 boxes
$total_boxes = $rows * $rows;


/* If the board has less than 10 boxes, then your setup.php file should return 
a JSON object with the list of all positions (all lights are on). */   
if ($total_boxes < 10) {
    // If the board has less than 10 boxes, all 10 lights are on
    for ($i = 0; $i <= $rows; $i++) {
        for ($j = 0; $j <= $columns; $j++) {
            $starting_positions[] = [$i, $j];
        }
    }
} else {
    // Randomly select 10 starting positions
    $selected_positions = [];
    while (count($selected_positions) < 10) {
        $random_row = mt_rand(1, $rows);
        $random_column = mt_rand(1, $columns);
        $position = [$random_row, $random_column];
        // Check if the position is already selected
        if (!in_array($position, $selected_positions)) {
            $selected_positions[] = $position;
        }
    }
    $starting_positions = $selected_positions;
}

/* Each position should be defined by its position–or row-column coordinate–in the board. 
This script must return a JSON object with the list of the lights-on starting positions. */    
// Return the starting positions as a JSON object

header('Content-Type: application/json');
echo json_encode($starting_positions);

// }

