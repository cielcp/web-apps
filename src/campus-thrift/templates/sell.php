<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Items</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css"/>
    <link rel="stylesheet" href="styles/sell.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/less" ></script>
</head>

<body style="background-color: #F8F5F0;">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid py-3">
                <a class="navbar-brand mx-3" href="index.html">
                    <img src="images/logo.png" alt="Campus Thrift Logo" height="80">
                </a>
                <h1>CAMPUS THRIFT</h1>

                <div class="collapse navbar-collapse justify-content-flex-end" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item mx-3">
                            <a class="nav-link active" href="index.html"><i class="iconoir-home"></i></a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link active" href="messages.html"><i class="iconoir-message-text"></i></a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link active" href="saved.html"><i class="iconoir-star"></i></a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link active" href="profile.html"><i class="iconoir-profile-circle"></i></a>
                        </li>
                    </ul>

                    <button type="button"><a aria-current="page" href="#">SELL NOW</a></button>
                    <button type="button"><a href="signup.html">SIGN UP</a></button>
                    <button type="button"><a href="login.html">LOGIN</a></button>
                </div>
            </div>
        </nav>
    </header>

    <div class="flex-container">
        <div class="container">
            <img src="images/frontshirt.jpg" alt="front of shirt">
        </div>

        <div class="container">
            <div class="item-info">
                <div class="form-group">
                    <label for="itemName">Name:</label>
                    <input type="text" id="itemName" name="itemName" required>
                </div>
                
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="price">Category:</label>
                    <input type="number" id="category" name="cateogry" required>
                </div>
    
    
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
    
                <div class="form-group">
                    <button type="submit">Post</button>
                </div>
            </div> 
        </div>
    </div>
    
    <footer class="container d-flex justify-content-center primary-footer" id="footer">
        <div class="logo-container">
            <img src="images/logo.png" alt="Campus Thrift Logo" height="80">
            <h1>CAMPUS THRIFT</h1>
            <h2>A UVA thrifting platform made by students, for students!</h2>
        </div>
        
        <nav class="container flex-column">
            <ul class="navbar align-items-flex-start">
                <li class="nav-item mx-3"><a class="nav-link active" href="index.html">HOME</a></li>
                <li class="nav-item mx-3"><a class="nav-link active" href="messages.html">MESSAGES</a></li>
                <li class="nav-item mx-3"><a class="nav-link active" href="saved.html">SAVED</a></li>
                <li class="nav-item mx-3"><a class="nav-link active" href="profile.html">PROFILE</a></li>
            </ul>

            <ul class="navbar align-items-flex-start">
                <li class="nav-item mx-3"><a class="nav-link disabled" href="#">ABOUT</a></li>
                <li class="nav-item mx-3"><a class="nav-link disabled" href="#">CONTACT US</a></li>
            </ul>
        </nav>

        <div class="line"></div>
        
        <small class="copyright mx-3">
            &copy; CIEL PARK AND & HANNAH PARK
        </small> 

        <small class="copyright mx-3">
            TERMS & CONDITIONS
        </small> 

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>
