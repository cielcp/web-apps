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
                        echo '<h2 class="mb-2"> $' . $listing['price'] . '</h2>';
                        echo '<h3>' . $listing['tags'] . '</h3>';
                    echo '</div>';
                    echo '<div class="listing-small-info-block d-flex justify-content-end">';
                        echo '<form action="?command=saveListing" method="POST" class="mb-0 ">
                                <button type="submit" class="icon-button"><img style="width:40px; height:40px;" src="icons/bookmark.svg"></button>
                            </form>';
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
                            <ul class="mb-5"><li>' . $listing['method'] .'</li></ul>';
                        if ($listing['creator'] == $_SESSION["username"]) {
                            echo '<form action="?command=deleteListing" method="POST" class="mb-0 ">
                                <button type="submit">DELETE LISTING</button>
                            </form>';
                        } else {
                            echo '<a href="?command=messages" class="mb-2 "><button>MESSAGE SELLER</button></a>';
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

    <!-- Footer -->
    <?php include('shared/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>
