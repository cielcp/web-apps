<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Raleway:wght@100..900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/less" ></script>
</head>

<body style="background-color: #F8F5F0;">
    
    <!-- Nav bar -->
    <?php include('shared/header.php'); ?>

    <!-- Sign up -->
    <section class="sign-up justify-content-center">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2 class="text-center">Sign up for a Campus Thrift account!</h2>
    
                    <form action="?command=signup" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" pattern="^[a-zA-Z0-9._%+-]+@virginia\.edu$" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required minlength="8">
                        </div>
    
                        <div class="text-center">
                            <button type="submit">SIGN UP</button>
                        </div>
                    </form>

                    <p class="text-center mt-3">Already have an account? <a href="?command=showLogin">Log in here</a></p>
                </div>
            </div>
        </div>
    </section>
</main>


    <!-- Footer -->
    <?php include('shared/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>
