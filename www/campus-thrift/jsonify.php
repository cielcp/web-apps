<?php

/* FUNCTION TO QUERY DB TO GET A LISTING OBJECT (1 or all?)*/

//

// get the size from the query string, used to create the square board
$size = isset($_GET['size']) ? intval($_GET['size']) : 0;
$starting_positions = [];
$total_boxes = $size * $size;
if ($total_boxes <= 10) {
    // if the board has less than 10 boxes, all lights are on
    for ($i = 1; $i <= $size; $i++) {
        for ($j = 1; $j <= $size; $j++) {
            $starting_positions[] = [$i, $j];
        }
    }
} else {
    // randomly select 10 starting positions
    
    $selected_positions = [];
    while (count($selected_positions) < 10) {
        $random_row = mt_rand(1, $size);
        $random_column = mt_rand(1, $size);
        $position = [$random_row, $random_column];
        // check if the position has already been selected
        if (!in_array($position, $selected_positions)) {
            $selected_positions[] = $position;
        }
    }
    $starting_positions = $selected_positions;
}

/* Each position should be defined by its position–or row-column coordinate–in the board. 
This script must return a JSON object with the list of the lights-on starting positions. */

header('Content-Type: application/json');
echo json_encode($starting_positions);
