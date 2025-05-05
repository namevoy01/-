<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Register </title>
  <link rel="stylesheet" href="assets/css/register1.css">
</head>
<body>
  <div class="container">
  <?php if(!empty($_SESSION['message'])): ?>
            <div class="alert alert-warning alert-dismissible fade show my-5" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    <!-- Title section -->
    <div class="title">Registration Admin</div>
    <div class="content">
      <!-- Registration form -->
      <form action="<?php echo $base_url . '/admin_register_form.php' ?>" method="post" class="my-4" enctype="multipart/form-data">
        <div class="user-details">
          <!-- Input for Full Name -->
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" placeholder="Enter your Username" required>
          </div>
          <!-- Input for Username -->
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your Password" name="password" required>
          </div>
          <!-- Input for Email -->
          <div class="input-box">
            <span class="details">Fullname</span>
            <input type="text" placeholder="Enter your Fullname" name="fullname" required>
          </div>
          <!-- Input for Password -->
          <div class="input-box">
            <span class="details">Surname</span>
            <input type="text" name="surname" placeholder="Enter your Surname" required>
          </div>
          <!-- Input for Confirm Password -->
          <div class="input-box">
            <span class="details">Phone</span>
            <input type="text" placeholder="Enter your Phone" name="phone" required>
          </div>
          <div class="input-box">
            <span class="details">Image</span>
            <input type="file" name="image" required >
          </div>
        </div>
        <!-- Submit button -->
        <div class="button">
          <input type="submit" value="Submit">
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>