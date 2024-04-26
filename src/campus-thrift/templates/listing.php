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
    <?php $listingId = $_SESSION['listing_id'] ?? 'default_id'; ?>
    <div id="listingData" data-listing-id="<?php echo htmlspecialchars($listingId); ?>"></div>

    <section class="d-flex listing-details" id="listing-section">
        <!-- Listing section -->
        <div class="listing-details-container" id="listing-img"></div>
        <div class="vert-line"></div>
        <div class="listing-details-container">
            <div class="listing-info-block">
                <div class="listing-small-info-block" id="listing-main-info"></div>
                <div class="listing-small-info-block d-flex justify-content-end">
                    <?php
                        $sql = "SELECT * FROM saved WHERE user_id = $1";
                        if (!empty($_SESSION["user_id"])) {
                            $user_id = $_SESSION["user_id"];
                            $saved_listings = $this->db->prepareAndExecute("fetch_listing_saved_listings", $sql, array($user_id));
                            $saved_ids = [];
                            foreach ($saved_listings as $saved_listing) :
                                $saved_ids[] = $saved_listing["listing_id"];
                            endforeach;
                        } 
                        if (!empty($_SESSION["username"])) {
                            echo '<form action="?command=saveListing" method="POST" class="mb-0">';
                            echo '<input type="hidden" name="listing_id" value="' . $listingId . '">';
                            // if the listing is in the saved listings list
                            if (in_array($listingId, $saved_ids)) {
                                echo '<button type="submit" class="icon-button bookmark-button">
                                            <img class="bookmark" src="icons/bookmark-filled.svg" style="width:40px; height:40px;">
                                            <img class="bookmark hidden" src="icons/bookmark.svg" style="width:40px; height:40px;">
                                        </button>
                                    </form>';
                            } else {
                                echo '<button type="submit" class="icon-button bookmark-button">
                                            <img class="bookmark hidden" src="icons/bookmark-filled.svg" style="width:40px; height:40px;">
                                            <img class="bookmark" src="icons/bookmark.svg" style="width:40px; height:40px;">
                                        </button>
                                    </form>';
                            }
                        }
                    ?>
                    
                </div>
            </div>
            <div class="line"></div>
            <div class="listing-info-block">
                <div class="listing-small-info-block" id="listing-description"></div>
                <div class="vert-line"></div>
                <div class="listing-small-info-block">
                    <h3>This item is available for:</h3>
                    <ul class="mb-5" id="listing-methods"></ul>
                    <?php
                        $listings = $this->db->query("select * FROM listings WHERE id=". $listingId . ";");
                        $listing = $listings[0];
                        if(!empty($_SESSION["username"])) {
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
                        } else {
                            echo 'Please sign in to claim this listing';
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('shared/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>

