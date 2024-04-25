<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing Details</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="styles/main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Raleway:wght@100..900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/less" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="campusThrift.js"></script>

</head>

<body style="background-color: #F8F5F0;">
    
    <!-- Nav bar -->
    <?php include('shared/header.php'); ?>


    <!-- Main section -->
    <section class="d-flex listing-details" id="chat">
        <!-- Listing image -->
        <div class="listing-details-container">
            <?php
                $listings = $this->db->query("select * FROM listings WHERE id=". $_SESSION['listing_id'] . ";");
                foreach ($listings as $listing):
                    echo '<img src="' . $listing["images"] . '" alt="'. $listing["name"] . '">';
            ?>
        </div>

        <div class="vert-line"></div>

        <!-- Listing info -->
        <div class="listing-details-container">

            <?php

            // TRYING TO GET JSON TO WORK, GIVING UP!!

            // Check if the listing ID parameter is set in the URL
            /* if (isset($_SESSION['listing_details'])) {
                // Sanitize the input to prevent SQL injection
                //$listing_id = $_GET['id'];

                $listing = $_SESSION['listing_details'];
                $listing_deets = $listing['listing_details'];
                foreach($listing_deets as $col => $val):
                    echo($col);
                    echo($val);
                endforeach;
                $name = $listing['listing_details']['name'];
                
                echo $name; */

                // Display the listing details
                echo '<div class="listing-info-block">';
                    echo '<div class="listing-small-info-block">';
                        echo '<h3>' . $listing['category'] . '</h3>';
                        echo '<h2 class="my-2">' . $listing['name'] . '</h2>';
                        echo '<h2 class="mb-2"> $' . $listing['price'] . '</h2> <div class="d-flex" style="gap:10px;">';
                        $tagList = explode(', ', $listing['tags']);
                        foreach ($tagList as $tag) {
                            echo '<h4 class="tag">' . $tag . '</h4>';
                        }
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="listing-small-info-block d-flex justify-content-end">';
                        echo '<form class="saveForm" action="?command=saveListing" method="POST" class="mb-0 ">';
                        echo '<input type="hidden" name="listing_id" value="' . $listing["id"] . '">';
                        // if the listing is in the saved listings list
                        /* if (in_array($listing["id"], $saved_ids)) {
                            echo '<button type="submit" class="icon-button bookmark-button">
                                        <img class="bookmark" src="icons/bookmark-filled.svg">
                                        <img class="bookmark hidden" src="icons/bookmark.svg">
                                    </button>
                                </form>';
                        } else { */
                            echo '<button type="submit" class="icon-button bookmark-button">
                                        <img class="bookmark hidden" src="icons/bookmark-filled.svg">
                                        <img class="bookmark" src="icons/bookmark.svg">
                                    </button>';
                        //}
                        echo '</form>';
                    echo '</div>';
                echo '</div>';

                echo '<div class="line"></div>';

                echo '<div class="listing-info-block">';
                    echo '<div class="listing-small-info-block">';
                        echo '<h3>' . $listing['description'] . '</h3>';
                    echo '</div>';
                    echo '<div class="vert-line"></div>';
                    echo '<div class="listing-small-info-block">';
                        echo '<h3> This item is available for: </h3>
                            <ul class="mb-5">';
                        $methods = explode(', ', $listing['method']);
                        // Loop through each method and display as a list element
                        foreach ($methods as $method) {
                            echo '<li>' . $method . '</li>';
                        }
                        echo '</ul>';
                        if(isset($_SESSION["username"])) {
                            if (($listing['creator'] == $_SESSION["username"])) {
                                echo '<form action="?command=deleteListing" method="POST" class="mb-0 ">
                                    <button type="submit">DELETE LISTING</button>
                                </form>';
                            } else {
                                echo '<form action="?command=startMessage" method="POST" class="mb-0 ">';
                                echo '<input type="hidden" name="buyer" value="' . $_SESSION["username"] . '">';
                                echo '<input type="hidden" name="seller" value="' . $listing['creator'] . '">';
                                echo '<button>MESSAGE SELLER</button></a>';
                                echo '</form>';
                            }
                        }
                    echo '</div>';
                echo '</div>';
                
                endforeach;
            /* } else {
                echo 'Not getting.';
            } */
            ?>

            <!-- <div class="listing-info-block">
                
                <div class="listing-small-info-block">
                    <h3> Category </h3>
                    <h2> Name </h2>
                    <h2> $20 </h2>
                    <h3> tags </h3>
                </div>
                <div class="listing-small-info-block d-flex justify-content-end">
                    <form action="?command=saveListing" method="POST" class="mb-0 ">
                        <button type="submit" class="icon-button"><img style="width:40px; height:40px;" src="icons/bookmark.svg"></button>
                    </form>
                </div>
            </div>
            <div class="line"></div>
            <div class="listing-info-block">
                <div class="listing-small-info-block">
                    <p> Description blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah </p>
                </div>
                <div class="vert-line"></div>
                <div class="listing-small-info-block">
                    <p> This item is available for: </p><br>
                    <ul><li>Pickup</li></ul>
                </div>
            </div> -->

        </div>
        
    </section>



    <!-- HANNAHS JSON STUFF -->
    <!-- <section class="d-flex listing-details" id="chat">
        <form action="?command=login" method="post" id="listingForm" >
    
            <div class="text-center">
                <button type="submit" class=""> listing </button>
        </form>
        <div class="listing-details-container" id = "listing-details-container">
   
        </div>

    </section> -->

    <!-- Footer -->
    <?php include('shared/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    <!-- why is this weird
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="campusThrift.js"></script> -->

</body>

</html>