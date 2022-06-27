<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include("plugin/db_connect.php");
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  //$exists=false;
  // check whether this usrname exists
  $exists = "SELECT * FROM `users` WHERE user_name='$username' ";
  $result = mysqli_query($con, $exists);
  $numExitstRow = mysqli_num_rows($result);
  if ($numExitstRow > 0) {
    // $exists=true;
    $showError = " User name Already Exists";
  } else {
    // $exists=false;
    if ($username != "" && $password != "" && ($password == $cpassword)) {
      $hash= password_hash($password,PASSWORD_DEFAULT);
      $sql = "INSERT INTO `users`(`user_name`,`password`,`dt`) VALUES('$username','$hash',current_timestamp())";
      $result = mysqli_query($con, $sql);
      if ($result) {
        $showAlert = true;
      }
    } else {
      $showError = "Passwords do not match ";
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>signup</title>
</head>

<body>
  <?php require("plugin/_nav.php") ?>
  <?php
  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success!</strong>Your account is now created and You can log in .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
  }
  ?>
  <?php
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ERROR!</strong>' . $showError . '.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
  }
  ?>

  <div class="container">
    <h1 class="text-center">Signup to our website</h1>
    <form action="/loginsystem/signup1.php" method="post">
      <div class="mb-3 col-md-6">
        <label for="exampleInputEmail1" class="form-label">User name</label>
        <input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp">

      </div>
      <div class="mb-3 col-md-6">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="mb-3 col-md-6">
        <label for="exampleInputPassword1" class="form-label"> Confirm Password</label>
        <input type="password" class="form-control" id="cpassword" name="cpassword">
        <div id="emailHelp" class="form-text">Make sure to type the same password</div>
      </div>

      <button type="submit" class="btn btn-primary">Signup</button>
    </form>
  </div>


  <!-- <h1>Hello, world!</h1> -->

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
