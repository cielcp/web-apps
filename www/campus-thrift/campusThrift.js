console.log("uh did this connect");

$(document).ready(function () {
  //$(document).on('submit', '.listing-img-form', function(event) {
  //$('.listing-img-form').submit(function(event) {
      //event.preventDefault(); // Stop the form from submitting normally
      var listingId = document.getElementById('listingData').getAttribute('data-listing-id');
      //var listingId = "<?php echo $listingId; ?>";
      //var listingId = 1;
     // var listingId = sessionStorage.getItem('listingId');

      console.log('ajax loaded');
      console.log(listingId);
      // Safely attempting to find and use the listing_id
      //var listingId = $(this).find('input[name="listing_id"]').val();

      $.ajax({
          url: 'index.php', // Replace with the actual URL to your PHP controller endpoint
          type: 'POST',
          data: { 'command': 'loadListing', 'listing_id': listingId},
          dataType: 'json',
          success: function (data) {
              console.log(data); // Check what is actually returned
              loadListing(data);

          },
          error: function (jqXHR, textStatus, errorThrown) {
              // Handle any AJAX errors here
              $('#listingDetailsContainer').html('<p>Error loading listing details.</p>');
          }
      });

  // Get all elements with class "bookmark-button"
  const bookmarkButtons = document.querySelectorAll(".bookmark-button");

  // --------------- NONE OF THIS IS RUNNING METHINK
  $(".saveForm").submit(function (event) {
    event.preventDefault(); // Prevent the default form submission behavior
    // AJAX request to fetch saved listings
    console.log("attempting ajax request!");
    $.ajax({
      url: "savedJson.php",
      type: "POST",
      data: { command: "saveListing" },
      dataType: "json",
      success: function (response) {
        if (response && response.savedListings) {
          console.log("success making ajax request");
          const savedListings = response.savedListings;
          // Loop through saved listings and update UI accordingly
          savedListings.forEach(function (savedListing) {
            // Access the saved listing ID and update UI (e.g., change button color)
            const listingId = savedListing.listing_id;
            console.log("saved listing #", listingId);
            // Example: document.getElementById('button-' + listingId).classList.add('filled');
          });
        }
      },
      error: function (jqXHR, textStatus, error) {
        // Handle any AJAX errors here
        console.error("AJAX error:", error);
      },
    });

    // -------------- WANT THIS TO WORK BASED ON THE ^ AJAX QUERY
    // -------------- BUT I J RAW PHPED IT ON THE HOME PAGE
    // Loop through each bookmark button
    bookmarkButtons.forEach(function (button) {
      // WANT THIS TO WORK ASYNC TO SHOW SAVED BUTTONS FILLED IN
      // Event listener to toggle clicked state of bookmark button
      button.addEventListener("click", function () {
        // Get the bookmark images inside this button
        const bookmarks = this.querySelectorAll(".bookmark");

        // Toggle the 'hidden' class for the bookmark images
        bookmarks.forEach(function (bookmark) {
          bookmark.classList.toggle("hidden");
        });
      });

      // Determine if the listing is saved or not
      const isSaved = button.classList.contains("saved");

      // If the listing is already saved, remove it
      if (isSaved) {
        // Remove the saved listing from the profile (you need to implement this)
        console.log("Removing from saved listings");
        button.classList.remove("saved");
      } else {
        // Save the listing to the profile (you need to implement this)
        console.log("Adding to saved listings");
        button.classList.add("saved");
      }
    });
  });

  function loadListing(data) {

    // Assuming response.listing_details contains the details
/*       var details = data.listing_details;

    var tags = details.tags.split(', '); // Use split instead of explode
    var tagsHtml = '';
    tags.forEach(function (tag) {
        tagsHtml += '<h4 class="tag">' + tag + '</h4>'; // Use JavaScript concatenation
    });

    var method = details.method.split(', '); // Use split instead of explode
    var methodsHtml = '';
    method.forEach(function (method) {
        methodsHtml += '<li>' + method + '</li>'; // Use JavaScript concatenation
    }); */

   
    var details = data.listing_details;
    var tagsHtml = details.tags.split(', ').map(tag => `<h4 class="tag">${tag}</h4>`).join('');
    var methodsHtml = details.method.split(', ').map(method => `<li>${method}</li>`).join('');

    var html = `
        <div class="listing-details-container">
            <img src="${details.images}" alt="${details.name}">
        </div>
        <div class="vert-line"></div>
        <div class="listing-details-container">
            <div class="listing-info-block">
                <div class="listing-small-info-block">
                    <h3>${details.category}</h3>
                    <h2 class="my-2">${details.name}</h2>
                    <h2 class="mb-2">$${details.price}</h2>
                    <div class="d-flex" style="gap:10px;">${tagsHtml}</div>
                </div>
                <div class="listing-small-info-block d-flex justify-content-end">
                    <form action="?command=saveListing" method="POST" class="mb-0">
                        <input type="hidden" name="listing_id" value="${details.id}">
                        <button type="submit" class="icon-button"><img style="width:40px; height:40px;" src="icons/bookmark.svg"></img></button>
                    </form>
                </div>
            </div>
            <div class="line"></div>
            <div class="listing-info-block">
                <div class="listing-small-info-block">
                    <h3>${details.description}</h3>
                </div>
                <div class="vert-line"></div>
                <div class="listing-small-info-block">
                    <h3>This item is available for:</h3>
                    <ul class="mb-5">${methodsHtml}</ul>
                </div>
            </div>
        </div>`;
    $('#listing-section').html(html);
    }

});

