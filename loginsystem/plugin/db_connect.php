<?php
  global $con;
  $con=mysqli_connect("localhost","root","") or die('Error connection Occur...');
  if($con)
 // echo "connected";
  $db=mysqli_select_db($con,"uservkcode") or die(mysqli_error($con));
  if($db)
 // echo "Database Selected"; 
  

?>