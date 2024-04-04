<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

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
    <?php include('shared/header.php'); ?>
    
    <!-- Profile info -->
    <section class="container my-4">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="profile-pic-container">
                <img src="images/profilepic.jpg" alt="profile pic" width=30px>
            </div>
            <div class="user-info">
                <h2><?php echo($_SESSION['username'])?></h2>
                <p>3 items</p>
                <p>0 exchanges</p>
            </div>
            </div>
            <a href="#"><button type="button">CREATE LISTING</button></a>
        </div>
    </section>

    <section class="tabs" >
        <a class="tab current" href="profile.html"><button type="button">SELLING</button></a>
        <a class="tab" href="saved.html"><button type="button">SAVED</button></a>
    </section>
    <div class="line"></div>

    <!-- Profile listings -->
    <main>
        <section class="flex-column">
            <div class="listing-container">
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