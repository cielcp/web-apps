<?php
// BELOW IS JUST CHAT GPTED
// class setupLightsOut {

    // Get the number of rows and columns from the query string
$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 0;
$columns = isset($_GET['columns']) ? intval($_GET['columns']) : 0;

// Initialize an array to store the starting positions of lights
$starting_positions = [];

// Check if the board has less than 10 boxes
$total_boxes = $rows * $columns;
if ($total_boxes <= 10) {
    // If the board has less than 10 boxes, all 10 lights are on
    for ($i = 1; $i <= $rows; $i++) {
        for ($j = 1; $j <= $columns; $j++) {
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

// Return the starting positions as a JSON object
header('Content-Type: application/json');
echo json_encode($starting_positions);

// }

