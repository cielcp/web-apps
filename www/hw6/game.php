<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Ciel Park and Hannah Park">
  <meta name="description" content="Our Connections Game">  
  <title>Connections - The Game</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">       
</head>

<body>
    
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-xs-12">
            <?=$message?>
        </div>
    </div>
    <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success" role="alert">'. $_SESSION['message'].'</div>';
        }
    ?>
<!-- header info -->
    <div class="row d-flex mb-2 justify-content-space-between">
        <div class="col">
            <h3>Welcome, <?php echo($_SESSION['name'])?></h3>
            <p> <?php echo($_SESSION['email'])?></p>
        </div>
        <div class="col d-flex justify-content-end">
            <form action="?command=quit" method="post">
                <button type="submit" class="btn btn-dark">Quit Game</button>
            </form>
        </div>
    </div>
    
    <!-- the connections grid -->
    <!-- for each word in random board, display 4 words as a row of cards -->
    <?php 
        if(isset($_SESSION["random_board"])) {
            $count = 0; // counter to track the number of cards
            // loop through the random board data
            foreach($_SESSION["random_board"] as $key => $word) {
                // start a new row for every 4th card
                if ($count % 4 == 0) {
                    echo '<div class="row flex-nowrap mb-3">';
                }
                // output the card HTML
                echo '<div class="col">';
                echo '<div class="card text-white bg-secondary">';
                echo '<div class="card-header">' . ($key) . '</div>'; // the card number
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . ($word) . '</h5>'; // the word
                echo '</div>';
                echo '</div>';
                echo '</div>';
                // end the row after every 4th card
                if (($count + 1) % 4 == 0 || $count == count($_SESSION["random_board"]) - 1) {
                    echo '</div>'; // close the row div
                }
                $count++;
            }
        } else {
            echo "Random board data not found.";
        }
    ?>

    <!-- new guess -->
    <div class="row mt-4 text-center">
        <h4 class="mb-3">New Guess</h4>
        <form class="d-flex justify-content-center" action="?command=answer" method="post">
            <div class="mb-3 me-3">
                <label for="answer" class="form-label me-2">Your Guess: </label>
                <input type="text" class="form-control-lg" id="connections-answer" name="answer">
                <div id="answerHelp" class="form-text">Please enter the numeric IDs of the words (space separated)</div>
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark btn-lg">Submit</button>
            </div>
        </form>
    </div>


    <!-- previous guesses -->
    <div class="row my-4 text-center">
        <h4 class="mb-3">Prior Guesses: <?=$_SESSION["num_guesses"]?> Total</h4>
        <!-- for each guess in all guesses, show the guess and the hint -->
        <?php 
            if(isset($_SESSION["all_guesses"])) {
                // loop through the all guesses data
                foreach($_SESSION["all_guesses"] as $entry) {
                    $guess = $entry[0][0] . " ". $entry[0][1] . " ". $entry[0][2] . " ". $entry[0][3] ." ";
                    $hint = $entry[1];
                    // if none correct, show guess + gray tag
                    if ($hint === "Not quite...") { 
                        // output the guess
                        echo '<p>' . ($guess);
                        // output the hint
                        echo '<span class="badge bg-secondary">' . ($hint) . '</span>';
                        echo '</p>';
                    }
                    // if two correct, show guess + yellow tag
                    elseif ($hint === "Two away") {
                        echo '<p>' . ($guess);
                        echo '<span class="badge bg-warning text-dark">' . ($hint) . '</span>';
                        echo '</p>';
                    }
                    // if three correct, show guess + green tag
                    elseif ($hint === "One away!") {
                        echo '<p>' . ($guess);
                        echo '<span class="badge bg-success">' . ($hint) . '</span>';
                        echo '</p>';
                    }
                    // if all matched correctly, display as a category card
                    else { 
                        echo '<div class="row mb-3">';
                        echo '<div class="col">';
                        echo '<div class="card text-white bg-success">';
                        echo '<div class="card-header">' . ($hint) . '</div>'; // the category
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . ($guess) . '</h5>'; // the guess
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    
                }
            }
        ?>
    </div>

    
            

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

