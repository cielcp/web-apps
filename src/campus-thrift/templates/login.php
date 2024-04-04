<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">
    <script src="https://cdn.jsdelivr.net/npm/less" ></script>
</head>

<body style="background-color: #F8F5F0;">
    <!-- Nav bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="index.html">
                    <img src="images/logo.png" alt="Campus Thrift Logo" width="40" height="40" style="margin-right: 10px">
                    CAMPUS THRIFT
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item mx-3">
                            <a class="nav-link active" href="index.html"><i class="iconoir-home"></i></a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" aria-current="page" href="messages.html"><i class="iconoir-message-text"></i></a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="saved.html"><i class="iconoir-star"></i></a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="profile.html"><i class="iconoir-profile-circle"></i></a>
                        </li>
                    </ul>
                    <button class="primary mx-3" type="button"><a href="signup.html">SIGN UP</a></button>
                    <button class="secondary mx-3" type="button"><a href="login.html">LOGIN</a></button>
                </div>
            </div>
        </nav>
    </header>
    <div class="line"></div>

    <!-- Sign up -->
    <section class="log-in justify-content-center">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2 class="text-center">Login to Your Account</h2>
                    <h3 class="text-center">Don't have an account? <a href="signup.html">Sign Up</a></h3>
    
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
                            <input type="submit" value="Sign Up" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div class="line"></div>
    <footer>
        <nav class="navbar navbar-expand-lg navbar-light" id="footer">
            <div class="container-fluid justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <a class="navbar-brand d-flex align-items-center" href="index.html">
                        <img src="images/logo.png" alt="Campus Thrift Logo" style="margin-right: 10px; width:60px;">
                        CAMPUS THRIFT
                    </a>
                    <div class="collapse navbar-collapse">
                        <p class="ms-2">A UVA thrifting platform made by students, for students!</p>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="container d-flex flex-row justify-content-end">
                        <ul class="navbar-nav flex-column mx-5">
                            <li class="nav-item"><a class="nav-link active" href="index.html">HOME</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page"href="#">MESSAGES</a></li>
                            <li class="nav-item"><a class="nav-link active" href="saved.html">SAVED</a></li>
                            <li class="nav-item"><a class="nav-link active" href="rpfile.html">PROFILE</a></li>
                        </ul>
                        <ul class="navbar-nav flex-column mx-5">
                            <li class="nav-item"><a class="nav-link disabled" href="#">SIGN IN</a></li>
                            <li class="nav-item"><a class="nav-link disabled" href="#">ABOUT</a></li>
                            <li class="nav-item"><a class="nav-link disabled" href="#">CONTACT US</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>