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
    <div class="row">
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    1
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    2
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    3
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    4
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    1
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    2
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    3
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    4
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    1
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    2
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    3
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    4
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    1
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    2
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    3
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">
                    4
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- previous guesses -->

    <div class="row mt-4 text-center">
        <h4 class="mb-3">Prior guesses: <?=$_SESSION["num_guesses"]?> total</h4>
        <p>dog cat pear apple <span class="badge bg-warning text-dark">Two away</span></p>
        <p>dog space pear tv <span class="badge bg-secondary">Not quite...</span></p>
        <p>dog space bird tv <span class="badge bg-success">One away!</span></p>
        <div class="row">
        <div class="col">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    1
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    2
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    3
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    4
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION["name"]?></h5>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="row mt-4 text-center">
        <h4 class="mb-3">New guess</h4>
        <form action="?command=answer" method="post">
            <input type="hidden" name="questionid" value="<?=$question["id"]?>">
            <div class="mb-3">
                <label for="answer" class="form-label me-2">Your guess: </label>
                <input type="text" class="form-control-lg" id="trivia-answer" name="answer">
                <div id="emailHelp" class="form-text">Please enter the numeric IDs of the words (space separated)</div>
            </div>
            <button type="submit" class="btn btn-dark mb-5">Submit Guess</button>
        </form>
    </div>
            
            <div class="row">
                <div class="col-xs-12">

                <div class="card">
                    <div class="card-header">
                        Categories
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?=$question["question"]?></h5>
                    </div>
                </div>

                </div>
                
            </div>
            <div class="row">
                <div class="col-xs-12">
                <form action="?command=answer" method="post">
                    <input type="hidden" name="questionid" value="<?=$question["id"]?>">

                    <div class="mb-3">
                        <label for="answer" class="form-label">Your Guess: </label>
                        <input type="text" class="form-control-lg" id="trivia-answer" name="answer">
                        <div id="emailHelp" class="form-text">Please enter the numeric IDs of your guesses, separated by spaces.</div>
                    </div>

                    <button type="submit" class="btn btn-dark">Submit Guess</button>
                </form>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

