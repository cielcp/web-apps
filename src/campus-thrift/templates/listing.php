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
        <form action="?command=login" method="post" id="listingForm" >
    
            <div class="text-center">
                <button type="submit" class=""> listing </button>
        </form>
        <div class="listing-details-container" id = "listing-details-container">
   
        </div>

    </section>

    <!-- Footer -->
    <?php include('shared/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>