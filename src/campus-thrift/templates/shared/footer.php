<!DOCTYPE html>
<html lang="en">

<head></head>

<!-- Footer -->
<body>
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
                            <li class="nav-item">
                                <form action="?command=home" method="POST" class="mb-0">
                                    <button type="submit" class="nav-link active icon-button py-1">HOME</button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <form action="?command=messages" method="POST" class="mb-0">
                                    <button type="submit" class="nav-link icon-button py-1">MESSAGES</button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <form action="?command=saved" method="POST" class="mb-0">
                                    <button type="submit" class="nav-link icon-button py-1">SAVED</button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <form action="?command=profile" method="POST" class="mb-0">
                                    <button type="submit" class="nav-link icon-button py-1">PROFILE</button>
                                </form>
                            </li>
                        </ul>
                        <ul class="navbar-nav footer-links flex-column mx-5">
                            <li class="nav-item">
                                <form action="?command=signup" method="POST" class="mb-0">
                                    <button type="submit" class="nav-link icon-button py-1">SIGN IN</button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <form action="" method="" class="mb-0">
                                    <button type="submit" class="nav-link icon-button py-1">ABOUT</button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <form action="" method="" class="mb-0">
                                    <button type="submit" class="nav-link icon-button py-1">CONTACT US</button>
                                </form>
                            </li>
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
</body>
</html>