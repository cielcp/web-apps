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
    <?php include('shared/profile-info.php'); ?>

    <section class="tabs">
        <a class="tab" href="?command=profile"><button type="button">SELLING</button></a>
        <a class="tab current" href="?command=saved"><button type="button">SAVED</button></a>
    </section>
    <div class="line"></div>
    
    <!-- Saved listings -->
    <main>
        <section class="flex-column">
            <div class="category-container">
                <?php 
                    $sql = "SELECT * FROM saved WHERE user_id = $1";
                    $user_id = $_SESSION["user_id"];
                    $saved_listings = $this->db->prepareAndExecute("fetch_saved_listings", $sql, array($user_id));
                    // echo json_encode($listings);
                    if (count($saved_listings) == 0) {
                        echo '<div class="my-5">';
                        echo '<h3"> You don\'t have any listings saved :/ </h3>';
                        echo '</div>';
                    }
                    foreach ($saved_listings as $saved_listing):
                        $sql = "SELECT * FROM listings WHERE id = $1";
                        $listing_id = $saved_listing["listing_id"];
                        // echo "ID is " . $listing_id;
                        $raw_listing = $this->db->prepareAndExecute("fetch_listings_" . $listing_id, $sql, array($listing_id));
                        //echo json_encode($listing);
                        $listing = $raw_listing[0];
                        echo '<div class="listing">';
                        echo '<div class="listing-img-container">';
                        echo '<form action="?command=listing" method="POST" class="listing-img-form mb-0" style="height:100%; width:100%;">';
                        echo '<input type="hidden" name="listing_id" value="' . $listing_id . '">';
                        echo '<button type="submit" style="border-style:none; padding:0px; height:100%; width:100%; border-radius:0px;">';
                        echo '<img src="' . $listing["images"] . '" alt="'. $listing["name"] . '">';
                        echo '</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '<div class="line"></div>';
                        echo '<div class="listing-text-container">';
                        echo '<h3> $'. $listing["price"] . ' '. $listing["name"] . '</h3>';
                        echo '<form action="?command=saveListing" method="POST" class="mb-0">';
                            echo '<input type="hidden" name="listing_id" value="' . $listing["id"] . '">';
                            echo '<button type="submit" class="icon-button bookmark-button">
                                    <img class="bookmark" src="icons/bookmark-filled.svg">
                                    <img class="bookmark hidden" src="icons/bookmark.svg">
                                </button>
                              </form>';
                        echo '</div>';
                        echo '</div>';
                    endforeach;
                ?>
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