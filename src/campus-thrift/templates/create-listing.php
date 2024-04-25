<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Listing</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/main.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Raleway:wght@100..900&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/less"></script>
</head>

<body style="background-color: #F8F5F0;">

  <!-- Nav bar -->
  <?php include('shared/header.php'); ?>

  <!-- Main form -->
  <section class="log-in justify-content-center">
    <div class="container my-4">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h2 class="text-center">Create a new listing</h2>

          <form action="?command=createListing" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="image">Image:</label>
              <input type="file" class="form-control" id="image" name="image" required>
            </div>

            <div class="mb-3">
              <label for="title">Title:</label>
              <input type="text" class="form-control" id="title" name="name" required>
            </div>

            <div class="mb-3">
              <label for="price">Price:</label>
              <input type="number" class="form-control" id="price" name="price" required>
            </div>

            <div class="mb-3">
              <label for="description">Description:</label>
              <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
              <label for="category">Category:</label>
              <select class="form-control" id="category" name="category" required>
                <option value="" selected disabled>Select Category</option>
                <option value="Clothing">Clothing</option>
                <option value="Home">Home</option>
                <option value="School supplies">School supplies</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="tags">Tags:</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="excellentCheck">
                <label class="form-check-label" for="excellentCheck">Excellent</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="greatCheck">
                <label class="form-check-label" for="greatCheck">Great</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="goodCheck">
                <label class="form-check-label" for="goodCheck">Good</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="poorCheck">
                <label class="form-check-label" for="poorCheck">Poor</label>
              </div>
              <div id="tagsContainer"></div>
            </div>

            <div class="mb-3">
              <label for="exchange_method">Exchange methods: </label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="pickupCheck">
                <label class="form-check-label" for="pickupCheck">Pickup</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="dropoffCheck">
                <label class="form-check-label" for="dropoffCheck">Dropoff</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="meetupCheck">
                <label class="form-check-label" for="meetupCheck">Meetup</label>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class=""> CREATE </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include('shared/footer.php'); ?>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // JavaScript object to store tag options
    const tagOptions = {
      Clothing: ["Xsmall", "Small", "Medium", "Large", "Xlarge", "Tops", "Bottoms", "Outerwear", "Dresses", "Shoes", "Bags", "Accessories"],
      Home: ["Table", "Chair", "Couch", "Storage", "Decoration", "Dishware", "Appliances"],
      "School supplies": ["Textbooks", "Stationary", "Electronics", "Equipment", "Other"],
      Other: ["Entertainment", "Collectibles", "Lease", "Tickets", "Food", "Services", "Health & Beauty"]
    };
    // Function to fetch tags based on selected category
    function fetchTags() {
      var category = $("#category").val();
      var tagsContainer = $("#tagsContainer");
      tagsContainer.empty(); // Clear previous tags
      // Show checkboxes based on selected category
      if (tagOptions.hasOwnProperty(category)) {
        tagOptions[category].forEach(tag => {
          addCheckbox(tagsContainer, tag);
        });
      } else {
        addCheckbox(tagsContainer, "No Tags Available");
      }
    }

    // Function to add a checkbox to the tags container
    function addCheckbox(container, value) {
      var checkbox = $("<div>").addClass("form-check");
      var box = $("<input>").addClass("form-check-input").attr("type", "checkbox").attr("name", value + "Check");
      var tag = $("<label>").addClass("form-check-label").text(value);
      checkbox.append(box).append(tag);
      container.append(checkbox);
    }

    // Event listener for category change
    $("#category").on("change", fetchTags);

  });
</script>

</html>