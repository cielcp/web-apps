<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direct Message</title>
    
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

    <!-- Chat -->
    <section class="d-flex" id="chat">
        <div class="chat-log">
            <div class="chat-profile selected"><img src="icons/person circle.svg">
            <?php 
                if (isset($_SESSION['seller'])) {
                    echo $_SESSION['seller'];
                } else {
                    echo "ANON";
                }
            ?>
            </div>
            <div class="line"></div>
            <?php 
                // get all of the user's chatlogs
                $sql = "SELECT * FROM messages WHERE buyer = $1 OR seller = $1";
                $user = $_SESSION['username'];
                $messages = $this->db->prepareAndExecute("fetch_messages", $sql, array($user));
                // echo json_encode($messages);
                foreach ($messages as $message):
                    $buyer = $message["buyer"];
                    $seller = $message["seller"];
                    // if you are the buyer
                    if ($buyer == $_SESSION['username']) {
                        $me = $buyer;
                        $them = $seller;
                    } else {
                        $them = $buyer;
                        $me = $seller;
                    }
                    /*if (isset($_SESSION['seller'])) {
                        if ($them = $_SESSION['seller']) {
                            // echo out a selected block
                            echo '<div class="chat-profile selected"><img src="images/profilepic.jpg">'. $_SESSION['seller'] . '</div>';
                            echo '<div class="line"></div>';
                        } else {
                            echo '<div class="chat-profile"><img src="images/profilepic.jpg">'. $them . '</div>';
                            echo '<div class="line"></div>';
                        }
                    } else {
                        echo '<div class="chat-profile selected"><img src="icons/person circle.svg"> ANON </div>';
                        echo '<div class="line"></div>';
                    }*/
                    
                    echo '<div class="chat-profile"><img src="images/profilepic.jpg">';
                    echo $them;
                    echo '</div>';
                    echo '<div class="line"></div>';
                endforeach;
            ?>
            <div class="chat-profile"><img src="images/profilepic.jpg">Hannah</div>
            <div class="line"></div>
            <div class="chat-profile"><img src="images/logo.png">Ciel</div>
            <div class="line"></div>
        </div>

        <div class="vert-line"></div>

        <div class="chat-container">
            <div class="messages" id="messageArea">
                <div class="message">
                    <img src="icons/person circle.svg">
                    <!-- <p id = "username">name</p> -->
                    <p class="message-bubble">Hello, can I buy this item?</p>
                </div>
                <div class="message mine">
                    <p class="message-bubble me">Sorry, no longer on sale</p>
                    <img src="icons/person circle.svg">
                </div>
            </div>
            <form class="form-inline mt-4" id="messageForm">
                <div class="input-group align-items-center">
                    <input class="form-control search-bar" id = "chatInput" type="text" placeholder="Type a message..." id="messageInput">
                    <button class="btn btn-outline-secondary" id = "sendButton" type="submit">SEND</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php include('shared/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="chat.js"></script>

</body>

</html>
