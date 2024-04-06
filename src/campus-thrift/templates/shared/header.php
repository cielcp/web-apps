<?php
?>
<!DOCTYPE html>
<html lang="en">

<head></head>

<body>
    <!-- Nav bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a href="?command=home" class="navbar-brand d-flex align-items-center">
                    <img src="images/logo.png" alt="Campus Thrift Logo">
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
                            <a href="?command=home"><button class="nav-link icon-button"><img src="icons/house.svg"></button></a>
                        </li>
                        <li class="nav-item">
                            <a href="?command=messages"><button class="nav-link icon-button"><img src="icons/letter.svg"></button></a>
                        </li>
                        <li class="nav-item">
                            <a href="?command=saved"><button class="nav-link icon-button"><img src="icons/bookmark.svg"></button></a>
                        </li>
                        <li class="nav-item">
                            <a href="?command=profile"><button class="nav-link icon-button"><img src="icons/person circle.svg"></button></a>
                        </li>
                    </ul>
                    <a href="?command=<?php echo isset($_SESSION['logged']) && $_SESSION['logged'] ? 'logout' : 'showLogin'; ?>">
                        <button><?php echo isset($_SESSION['logged']) && $_SESSION['logged'] ? 'LOGOUT' : 'SIGN IN'; ?></button>
                    </a>
                </div>
            </div>
        </nav>
        <div class="line"></div>
    </header>

</body>
</html>