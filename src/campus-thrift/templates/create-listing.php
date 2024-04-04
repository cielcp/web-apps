<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Raleway:wght@100..900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/less"></script>
</head>
<body style="background-color: #F8F5F0;">
    <!-- Nav bar -->
    <?php include('shared/header.php'); ?>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Create a new listing
          </div>
          <div class="card-body">
            <form action="?command=createListing" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="image">Image</label>
                <input type="text" class="form-control" id="image" name="image" required>
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" required>
              </div>
              <div class="form-group">
                <label for="exchange_method">Exchange Method</label>
                <select class="form-control" id="method" name="method" required>
                  <option value="Pickup">Pickup</option>
                  <option value="Drop off">Drop off</option>
                  <option value="Meetup">Meetup</option>
                </select>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="tags">Tags</label>
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
              <button type="submit" name="createButton"> SUBMIT </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include('shared/footer.php'); ?>
  
</body>
</html>
