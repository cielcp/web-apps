<?php
?>
<!DOCTYPE html>
<html lang="en">

<head></head>

<body>
    <!-- Profile info -->
    <section class="container my-4">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="profile-pic-container">
                    <img src="images/profilepic.jpg" alt="profile pic" width=30px>
                </div>
                <div class="user-info">
                    <h2>
                        <?php 
                            if (isset($_SESSION['username'])) {
                                echo ($_SESSION['username']);
                            } else {
                                echo "Anonymous";
                            }
                        ?>
                    </h2>                    
                    <p>
                        <?php 
                            $sql = "SELECT * FROM listings WHERE creator = $1";
                            $listings = $this->db->prepareAndExecute("fetch_num", $sql, array($_SESSION["username"]));
                            echo count($listings) . " ";
                        ?>
                        items
                    </p>
                </div>
            </div>
            <form action="?command=showCreateListing" method="POST" class="mb-0">
                <button type="submit">CREATE LISTING</button>
            </form>
        </div>
    </section>
</body>
</html>