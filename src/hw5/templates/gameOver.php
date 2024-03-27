<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="CS4640 Spring 2024">
  <meta name="description" content="Our Front-Controller Trivia Game">  
  <title>PHP Form Example - Trivia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"  crossorigin="anonymous">       
</head>

<body>

<div class="container" style="margin-top: 15px;">
            <div class="row">
                <h1>Game Over!</h1>
            </div>
            <div class="row d-flex justify-content-between">
                <div class="col d-flex justify-content-center">
                <form action="?command=exit" method="post">
                    <button type="submit" class="btn btn-primary">Exit</button>
                </form>
                </div>
                <div class="col d-flex justify-content-center">
                <form action="?command=game" method="post">
                    <button type="submit" class="btn btn-primary">Play again?</button>
                </form>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>