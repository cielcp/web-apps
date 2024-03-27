<?php
    include("homework4.php");

    // Hint: include error printing!
?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>Homework 4 Test File</title>
</head>
<body>
<h1>Homework 4 Test File</h1>

<h2>Problem 1</h2>
<?php
    // tests for problem 1
    echo "Test 1\n";
    $test1 = [ [ "score" => 55, "max_points" => 100 ], [ "score" => 55, "max_points" => 100 ] ];
    echo calculateGrade($test1, false); // should be 55
    echo "<br>";
    
    echo "Test 2\n";
    $test2 = [
      ["score" => 90, "max_points" => 100],
      ["score" => 75, "max_points" => 100],
      ["score" => 80, "max_points" => 100]
    ];
    echo calculateGrade($test2, false); // should be 81.667%
    echo "<br>";
    
    echo "Test 3\n";
    $test3 = [
        ["score" => 90, "max_points" => 100],
        ["score" => 75, "max_points" => 100],
        ["score" => 80, "max_points" => 100]
    ];
    echo calculateGrade($test3, true); // should be 85%
    echo "<br>";
    
    echo "Test 4\n";
    $test4 = [
        ["score" => 100, "max_points" => 100],
        ["score" => 90, "max_points" => 100],
        ["score" => 80, "max_points" => 100]
    ];
    echo calculateGrade($test4, true); // should be 95%
    echo "<br>";
?>

<h2>Problem 2</h2>
<?php
    echo gridCubbies(3, 4); // 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
    echo "<br>";
    echo gridCubbies(1, 2); // 1, 2
    echo "<br>";
    echo gridCubbies(2, 2); // 1, 2, 3, 4
    echo "<br>";
    echo gridCubbies(1, 1); // 1
    echo "<br>";
    echo gridCubbies(1, 12); // 12
    echo "<br>";
    echo gridCubbies(5, 4); // 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
?>

<h2>Problem 3</h2>
<?php
    $friend_book1 = ['Happy' => '111-111-1111', 'Sneezy' => '222-222-2222',
      'Doc' => '333-333-3333', 'Grumpy' => '444-444-4444', 'Bashful' => '555-555-5555',
      'Sleepy' => 'sleepy@uva.edu'];

    $friend_book2 = ['Sneezy' => 'sneezy@uva.edu', 'Doc' => 'doc@uva.edu', 
      'Happy' => 'happy@uva.edu', 'Bashful' => 'bashful@uva.edu', 
      'Sleepy' => 'sleepy@uva.edu'];
  
    print_r(combineAddressBooks($friend_book1, $friend_book2));

?>

<h2>Problem 4</h2>
<?php
    $acronyms = "rofl lol afk";
    $searchString = "Rabbits on freezing lakes only like really old fleece leggings.";
    print_r(acronymSummary($acronyms, $searchString));

?>

<p>...</p>
</body>
</html>
