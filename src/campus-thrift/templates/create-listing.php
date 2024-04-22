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
              <label for="image">Images:</label>
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
              <label for="category">Category:</label>
              <select class="form-control" id="category" name="category" required>
                <option value="Clothing">Clothing</option>
                <option value="Furniture">Furniture</option>
                <option value="School supplies">School supplies</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="exchange_method">Exchange method: </label>
              <select class="form-control" id="method" name="method" required>
                <option value="Pickup">Pickup</option>
                <option value="Drop off">Drop off</option>
                <option value="Meetup">Meetup</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="description">Description:</label>
              <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
              <label for="tags">Tags:</label>
              <!-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="mensCheck">
                    <label class="form-check-label" for="mensCheck">
                      Men's
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="womensCheck" disabled>
                    <label class="form-check-label" for="womensCheck">
                      Women's
                    </label>
                  </div> -->
              <input type="text" class="form-control" id="tags" name="tags" required>
            </div>

            <div class="text-center">
              <button type="submit" class=""> SUBMIT </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include('shared/footer.php'); ?>

</body>

</html>