console.log("uh did this connect");

$(document).ready(function () {
  $('#listingForm').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    $.ajax({
        url: 'index.php', // Replace with the actual URL to your PHP controller endpoint
        type: 'POST',
        data: { 'command': 'loadListing'},
        dataType: 'json',
        success: function(data) {
            loadListing(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle any AJAX errors here
            $('#listingDetailsContainer').html('<p>Error loading listing details.</p>');
        }
    });

  // Get all elements with class "bookmark-button"
  const bookmarkButtons = document.querySelectorAll(".bookmark-button");

  // --------------- NONE OF THIS IS RUNNING METHINKS
  console.log("attempting ajax request");
  // AJAX request to fetch saved listings
  $.ajax({
    url: "savedJson.php", // Replace 'saveListing.php' with your PHP file path
    type: "POST",
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
    error: function (xhr, status, error) {
      console.error("AJAX error:", error);
    },
  });
  // -------------- WANT THIS TO WORK BASED ON THE ^ AJAX QUERY
  // -------------- BUT I J RAW PHPED IT ON THE HOME PAGE
  // Loop through each bookmark button
  bookmarkButtons.forEach(function (button) {
    // WANT THIS TO WORK ASYNC TO SHOW SAVED BUTTONS FILLED IN
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


// Event listener to toggle clicked state of bookmark button
button.addEventListener("click", function () {
  // Get the bookmark images inside this button
  const bookmarks = this.querySelectorAll(".bookmark");

  // Toggle the 'hidden' class for the bookmark images
  bookmarks.forEach(function (bookmark) {
    bookmark.classList.toggle("hidden");
  });
});

function loadListing(data) {
  console.log(data);
  console.log('listing');
  // Assuming response.listing_details contains the details
  var details = data.listing_details;
  var tags = details.tags.split(', '); // Use split instead of explode
  var tagsHtml = '';
  tags.forEach(function(tag) {
      tagsHtml += '<h4 class="tag">' + tag + '</h4>'; // Use JavaScript concatenation
  });

  var html = `
  <div class="listing-info-block">
  <div class="listing-small-info-block">
    <h3>${details.category}</h3>
    <h2 class="my-2">${details.name}</h2>
    <h2 class="mb-2">$${details.price}</h2>
    <div class="d-flex" style="gap:10px;">
        ${tagsHtml}
    </div>
  </div>
<div class="listing-small-info-block d-flex justify-content-end">'
    <form action="?command=saveListing" method="POST" class="mb-0 ">
            <button type="submit" class="icon-button"><img>style="width:40px; height:40px;" src="icons/bookmark.svg"</img></button>
    </form>
</div>

<div class="line"></div>

<div class="listing-info-block">
      <div class="listing-small-info-block">
         <h3>${details.description}</h3>
      </div>
      <div class="vert-line"></div>
      <div class="listing-small-info-block">
          <h3> This item is available for: </h3>
              <ul class="mb-5">
              <li> . ${details.method}'</li>
              </ul>
          
      </div>
  </div>
  </div>
  `;
  $('#listing-details-container').html(html); // Make sure this matches your HTML container ID
}

});


