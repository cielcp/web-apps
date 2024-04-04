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
        <div class="listing-details-img-container">
            <img src="images/greyshirt.jpg" style="width:50%;">
        </div>

        <div class="vert-line"></div>

        <!-- Listing info -->
        <div class="listing-details-container">
            <?php
            // Check if the listing ID parameter is set in the URL
            if (isset($_SESSION['listing_details'])) {
                // Sanitize the input to prevent SQL injection
                //$listing_id = $_GET['id'];

                $listing = $_SESSION['listing_details'];
                $listing_deets = $listing['listing_details'];
                foreach($listing_deets as $col => $val):
                    echo($col);
                    echo($val);
                endforeach;
                $name = $listing['listing_details']['name'];
                
                echo $name;

                // Display the listing details
                    echo '<p>' . $listing['category'] . '</p>';
                    echo '<h2>' . $listing['name'] . '</h2>';
                    echo '<p> $' . $listing['price'] . '</p>';
                    echo '<p>' . $listing['description'] . '</p>';
                    echo '<p>' . $listing['tags'] . '</p>';
                    echo '<p> This item is available for:' . $listing['method'] . '</p>';
                    echo '<p> Message seller ' . $listing['creator'] . '</p>';
                
            } else {
                echo 'Not getting.';
            }
            ?>

            <div class="messages" id="messageArea">
                <div class="message">
                    <img src="icons/person circle.svg">
                    <p class="message-bubble">Hello, can I buy this item?</p>
                </div>
                <div class="message mine">
                    <p class="message-bubble me">Sorry, no longer on sale</p>
                    <img src="icons/person circle.svg">
                </div>
            </div>
            <form class="form-inline mt-4">
                <div class="input-group align-items-center">
                    <input class="form-control search-bar" type="text" placeholder="Type a message..." id="messageInput">
                    <button class="btn btn-outline-secondary" type="submit">SEND</button>
                </div>
            </form>
        </div>
        
    </section>

    <!-- Footer -->
    <?php include('shared/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>
