<!DOCTYPE html>
<html lang="en">

<!-- https://cs4640.cs.virginia.edu/ccp7gcp/campus-thrift -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Ciel Park and Hannah Park">
    <meta name="description" content="A website for UVA students to sell and thrift/buy items from other students">
    <meta name="keywords" content="UVA, sell, buy, thrift">

    <!-- Open Graph metadata -->
    <meta property="og:title" content="Campus Thrift Home">
    <meta property="og:type" content="website">
    <meta property="og:image"
        content="https://ih1.redbubble.net/image.1855973871.2974/flat,750x,075,f-pad,750x1000,f8f8f8.jpg">
    <meta property="og:url" content="https://www.campusthrift.com">
    <meta property="og:description" content="Sell and Thrift items from Students!">
    <meta property="og:site_name" content="Campus Thrift">

    <title>Campus Thrift Home</title>
    
    <!-- stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Raleway:wght@100..900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/less"></script>
</head>

<body style="background-color: #F8F5F0;">
    
    <!-- Nav bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="index.php">
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
                            <a class="nav-link active" href="home.php"><img src="icons/house.svg"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="messages.php"><img
                                    src="icons/letter.svg"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="saved.php"><img src="icons/bookmark.svg"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php"><img src="icons/person circle.svg"></a>
                        </li>
                    </ul>
                    <a href="signin.php"><button type="button">SIGN IN</button></a>
                </div>
            </div>
        </nav>
        <div class="line"></div>
    </header>
    

    <!-- Main content -->
    <main>
        <!-- Search and filter -->
        <section class="flex-row">
            <div class="row align-items-center my-4 justify-content-between">
                <!-- Properly accept users’ data entries (i.e., inputs), but does not need to process input -->
                <form class="form-inline col">
                    <div class="input-group">
                        <input class="form-control search-bar" list="" type="search" placeholder="Search"
                            aria-label="Search">
                    </div>
                </form>
                <form class="form-inline col d-flex justify-content-end">
                    <button type="submit" class="icon-button"><img src="icons/sliders.svg"></button>
                </form>
            </div>
        </section>

        <!-- Recently added category -->
        <section class="my-4">
            <div class="category-text-container">
                <h2>Recently added</h2>
                <a href="#">See more <img src="icons/angle-right.svg"> </a>
            </div>
            <div class="category-container">
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/greyshirt.jpg" alt="grey shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/blueshirt.jpg" alt="blue shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/redshirt.jpg" alt="red shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/greyshirt.jpg" alt="grey shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/blueshirt.jpg" alt="blue shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing sixth">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/blueshirt.jpg" alt="blue shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Under $20 category -->
        <section class="mb-5">
            <div class="category-text-container">
                <h2>Under $20</h2>
                <a href="#">See more <img src="icons/angle-right.svg"> </a>
            </div>
            <div class="category-container">
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/greyshirt.jpg" alt="grey shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/blueshirt.jpg" alt="blue shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/redshirt.jpg" alt="red shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/greyshirt.jpg" alt="grey shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/blueshirt.jpg" alt="blue shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing sixth">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/blueshirt.jpg" alt="blue shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Free category -->
        <section class="mb-5">
            <div class="category-text-container">
                <h2>Free</h2>
                <a href="#">See more <img src="icons/angle-right.svg"> </a>
            </div>
            <div class="category-container">
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/greyshirt.jpg" alt="grey shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/blueshirt.jpg" alt="blue shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/redshirt.jpg" alt="red shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/greyshirt.jpg" alt="grey shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/blueshirt.jpg" alt="blue shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
                <div class="listing sixth">
                    <div class="listing-img-container">
                        <a href="#">
                            <img src="images/blueshirt.jpg" alt="blue shirt image">
                        </a>
                    </div>
                    <div class="line"></div>
                    <div class="listing-text-container">
                        <h3>$10</h3>
                        <button class="icon-button"><img src="icons/bookmark.svg"></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- View all listings -->
        <section>
            <a class="view-all" href="#">
                <h3>View all listings</h3>
                <img src="icons/angle-down.svg">
            </a>
        </section>
    </main>


    <!-- Footer -->
    <footer>
        <div class="line"></div>
        <nav class="navbar navbar-expand-lg navbar-light" id="footer">
            <div class="container-fluid justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <a class="navbar-brand d-flex align-items-center" href="index.php">
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
                            <li class="nav-item"><a class="nav-link active" href="index.php">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" aria-current="page"
                                    href="messages.php">MESSAGES</a></li>
                            <li class="nav-item"><a class="nav-link" href="saved.php">SAVED</a></li>
                            <li class="nav-item"><a class="nav-link" href="profile.php">PROFILE</a></li>
                        </ul>
                        <ul class="navbar-nav footer-links flex-column mx-5">
                            <li class="nav-item"><a class="nav-link" href="signin.php">SIGN IN</a></li>
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