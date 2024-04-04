<!DOCTYPE html>
<html lang="en">

<head></head>

<body>
    <!-- Nav bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <form action="?command=home" method="POST" class="navbar-brand d-flex mb-0 align-items-center">
                    <button type="submit" class="nav-logo" style="border-color:transparent; padding: 0px;">
                        <img src="images/logo.png" alt="Campus Thrift Logo">
                    </button>
                    CAMPUS THRIFT
                </form>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <!-- Properly create at least four different screens with respect to the functionalities you proposed -->
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <form action="?command=home" method="POST" class="mb-0">
                                <button type="submit" class="nav-link icon-button"><img src="icons/house.svg"></button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <form action="?command=messages" method="POST" class="mb-0">
                                <button type="submit" class="nav-link icon-button"><img src="icons/letter.svg"></button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <form action="?command=saved" method="POST" class="mb-0">
                                <button type="submit" class="nav-link icon-button"><img src="icons/bookmark.svg"></button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <form action="?command=profile" method="POST" class="mb-0">
                                <button type="submit" class="nav-link icon-button"><img src="icons/person circle.svg"></button>
                            </form>
                        </li>
                    </ul>
                    <form action="?command=signup" method="POST" class="mb-0">
                        <button type="submit" class="">SIGN IN</button>
                    </form>
                    
                </div>
            </div>
        </nav>
        <div class="line"></div>
    </header>

</body>
</html>