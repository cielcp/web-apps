<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Ciel Park and Hannah Park">
  <meta name="description" content="Our Connections Game">  
  <title>Connections - Game Over</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">       
</head>

<body>

<div class="container" style="margin-top: 15px;">
            <div class="row">
                <h1 class="text-center">Game Over!</h1>
            </div>
            <!-- previous guesses -->
            <div class="row mt-4 text-center">
                <!-- for each guess in all guesses, show the guess and the hint -->
                <?php 
                    if(isset($_SESSION["all_guesses"])) {
                        $count = 0;
                        // loop through the all guesses data
                        foreach($_SESSION["all_guesses"] as $entry) {
                            $guess = $entry[0][0] . " ". $entry[0][1] . " ". $entry[0][2] . " ". $entry[0][3] ." ";
                            $hint = $entry[1];
                            // if all matched correctly, display as a category card
                            if ($hint !== "Not quite..." && $hint !== "Two away" && $hint !== "One away!") { 
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
                                $count++;
                            }
                        }
                        if ($count === 4) {
                            echo '<h3 class="text-center mt-3 mb-5">It took you '. $_SESSION["num_guesses"] . ' guesses to beat the game! </h3>';
                        } else {
                            echo '<h3 class="text-center mt-3 mb-5">Better luck next time! </h3>';
                        }
                    } else {
                        echo '<p class="text-center mt-2 mb-3"> Bro did not even try </p>';
                    }
                ?>
            </div>
            <div class="row d-flex justify-content-between mb-5">
                <div class="col d-flex justify-content-center">
                <form action="?command=exit" method="post">
                    <button type="submit" class="btn btn-dark">Exit</button>
                </form>
                </div>
                <div class="col d-flex justify-content-center">
                <form action="?command=playAgain" method="post">
                    <button type="submit" class="btn btn-dark">Play again?</button>
                </form>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>