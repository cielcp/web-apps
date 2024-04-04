<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

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
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="index.html">
                    <img class="nav-logo" src="images/logo.png" alt="Campus Thrift Logo">
                    CAMPUS THRIFT
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <!-- Properly create at least four different screens with respect to the functionalities you proposed -->
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.html"><img src="icons/house.svg"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="messages.html"><img
                                    src="icons/letter.svg"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="saved.html"><img src="icons/bookmark.svg"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.html"><img src="icons/person circle.svg"></a>
                        </li>
                    </ul>
                    <a href="signin.html"><button type="button">SIGN IN</button></a>
                </div>
            </div>
        </nav>
        <div class="line"></div>
    </header>

    <!-- Sign up -->
    <section class="sign-up justify-content-center">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2 class="text-center">Sign up for a Campus Thrift account!</h2>
    
                    <form action="/signup">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
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

                    <p class="text-center mt-3">Already have an account? <a href="login.html">Log in here</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="line"></div>
        <nav class="navbar navbar-expand-lg navbar-light" id="footer">
            <div class="container-fluid justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <a class="navbar-brand d-flex align-items-center" href="index.html">
                        <img src="images/logo.png" alt="Campus Thrift Logo">
                        CAMPUS THRIFT
                    </a>
                    <div class="collapse navbar-collapse">
                        <p class="ms-2">A UVA thrifting platform made by students, for students!</p>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="container d-flex justify-content-end">
                        <ul class="navbar-nav footer-links flex-column mx-5">
                            <li class="nav-item"><a class="nav-link active" href="index.html">HOME</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page"
                                    href="messages.html">MESSAGES</a></li>
                            <li class="nav-item"><a class="nav-link active" href="saved.html">SAVED</a></li>
                            <li class="nav-item"><a class="nav-link active" href="profile.html">PROFILE</a></li>
                        </ul>
                        <ul class="navbar-nav footer-links flex-column mx-5">
                            <li class="nav-item"><a class="nav-link disabled" href="#">SIGN IN</a></li>
                            <li class="nav-item"><a class="nav-link disabled" href="#">ABOUT</a></li>
                            <li class="nav-item"><a class="nav-link disabled" href="#">CONTACT US</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="line"></div>
        <div class="d-flex justify-content-between align-items-center p-2">
            <p class="ms-2">&copy 2024 CIEL PARK & HANNAH PARK</p>
            <a class="small" href="#">TERMS & CONDITIONS</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>
