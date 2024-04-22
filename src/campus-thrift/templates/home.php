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
    <?php include('shared/header.php'); ?>
    

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

        <!-- Example all listings -->
        <section class="my-4">
            <div class="category-text-container">
                <h2>Testing</h2>
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
            </div>
        </section>

        <!-- All listings -->
        <section class="my-4">
            <div class="category-text-container">
                <h2>All listings</h2>
            </div>
            <div class="category-container">
                <?php 
                    $listings = $this->db->query("select * FROM listings;");

                    foreach ($listings as $listing):
                        echo '<div class="listing">';
                        echo '<div class="listing-img-container">';
                        echo '<form action="?command=listing" method="POST" class="listing-img-form mb-0" style="height:100%; width:100%;">';
                        echo '<input type="hidden" name="listing_id" value="' . $listing["id"] . '">';
                        echo '<button type="submit" style="border-style:none; padding:0px; height:100%; width:100%; border-radius:0px;">';
                        echo '<img src="' . $listing["images"] . '" alt="'. $listing["name"] . '">';
                        echo '</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '<div class="line"></div>';
                        echo '<div class="listing-text-container">';
                        echo '<h3> $'. $listing["price"] . ' '. $listing["name"] . '</h3>';
                        if (isset($_SESSION["username"]) && ($listing["creator"] !== $_SESSION["username"])) {
                            echo '<form action="?command=saveListing" method="POST" class="mb-0">
                                <button type="submit" class="icon-button"><img src="icons/bookmark.svg"></button>
                              </form>';
                        }
                        echo '</div>';
                        echo '</div>';
                    endforeach;
                ?>
            </div>
        </section>

        <!-- View all listings -->
        <!-- <section>
            <a class="view-all" href="#">
                <h3>View all listings</h3>
                <img src="icons/angle-down.svg">
            </a>
        </section> -->
    </main>

    <!-- Footer -->
    <?php include('shared/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>