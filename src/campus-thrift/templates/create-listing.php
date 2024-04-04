<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Nav bar -->
    <?php include('shared/header.php'); ?>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Product Form
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
                <select class="form-control" id="exchange_method" name="method" required>
                  <option value="Cash">Cash</option>
                  <option value="Credit Card">Credit Card</option>
                  <option value="Crypto">Crypto</option>
                </select>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="tags">Tags (separated by comma)</label>
                <input type="text" class="form-control" id="tags" name="tags" required>
              </div>
              <input type="submit" name="createButton" class="btn btn-primary" value="Submit"></input>
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
