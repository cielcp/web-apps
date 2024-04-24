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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body style="background-color: #F8F5F0;">
    <!-- (your existing content) -->

    <!-- Container for listing details -->
    <div id="listingDetailsContainer">
        <!-- Listing details will be populated here by AJAX -->
    </div>

    <script>
        $(document).ready(function() {
            var listingId = <?php echo json_encode($_SESSION['listing_id']); ?>;
            loadListing(1);
        });
        function loadListing() {
            $.ajax({
                url: 'index.php', // Replace with the actual URL to your PHP controller endpoint
                type: 'POST',
                data: { 'command': 'loadListing'},
                dataType: 'json',
                success: function(response) {
                    if (response.result === 'success') {
                        // Assuming response.listing_details contains the details
                        var details = response.listing_details;
                        var html = `
                            <div class="listing-image">
                                <img src="${details.images}" alt="${details.name}">
                            </div>
                            <div class="listing-info">
                                <h2>${details.name}</h2>
                                <p>${details.description}</p>
                                <p>Price: $${details.price}</p>
                                <!-- Other details here -->
                            </div>
                        `;
                        $('#listingDetailsContainer').html(html);
                    } else {
                        // Handle errors
                        $('#listingDetailsContainer').html(`<p>Error: ${response.result}</p>`);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle any AJAX errors here
                    $('#listingDetailsContainer').html('<p>Error loading listing details.</p>');
                }
            });
        }
    </script>


    <!-- (your existing footer content) -->
</body>
</html>