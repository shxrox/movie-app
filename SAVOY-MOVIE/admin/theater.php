<?php 
include('../connect.php');

if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php';  </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/theater.css">
    <title>Theater</title>
</head>
<body>

<?php include('header.php')  ?>

<div class="container-theater">

<div class="row">
  <div class="col-lg-6">
    <form action="theater.php" method="post" enctype="multipart/form-data">
      
      <?php
      if(isset($_GET['editid'])){
        $editid  = $_GET['editid'];
        $sql = "SELECT * FROM `theater` WHERE theaterid= '$editid'";
        $res  = mysqli_query($con, $sql);
        $editdata = mysqli_fetch_array($res);
      }
      ?>

      <div class="form-group mb-4">
         <input type="text" class="form-control" name="theater_name" value="<?= isset($editdata) ? $editdata['theater_name'] : '' ?>" placeholder="Enter Theater Name">
      </div>

      <div class="form-group mb-4">
         <select name="movieid" class="form-control">
          <option value="">Select Movies</option>

         <?php
          $sql = "SELECT * FROM `movies`";
          $res  = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0){
            while($data = mysqli_fetch_array($res)){
              $selected = (isset($editdata) && $editdata['movieid'] == $data['movieid']) ? "selected" : "";
              echo "<option value='{$data['movieid']}' $selected>{$data['title']}</option>";
            }
          }else{
            echo "<option value=''>No Movies found</option>";
          }  
          ?> 
         </select>
      </div>

      <div class="form-group mb-4">
      <input type="time" class="form-control" name="timing" value="<?= isset($editdata) ? $editdata['timing'] : '' ?>" placeholder="Enter Timing">
      </div>

      <div class="form-group mb-4">
      <input type="text" class="form-control" name="days" value="<?= isset($editdata) ? $editdata['days'] : '' ?>" placeholder="Enter Days">
      </div>

      <div class="form-group mb-4">
      <input type="date" class="form-control" name="date" value="<?= isset($editdata) ? $editdata['date'] : '' ?>" placeholder="Enter Date">
      </div>

      <div class="form-group mb-4">
      <input type="number" class="form-control" name="price" value="<?= isset($editdata) ? $editdata['price'] : '' ?>" placeholder="Enter Price">
      </div>

      <div class="form-group mb-4">
      <input type="text" class="form-control" name="location" value="<?= isset($editdata) ? $editdata['location'] : '' ?>" placeholder="Enter Location">
      </div>

      <div class="form-group">
      <input type="hidden" name="theaterid" value="<?= isset($editdata) ? $editdata['theaterid'] : '' ?>">
      <input type="submit" class="btn-add <?= isset($editdata) ? 'btn-info' : 'btn-primary' ?>" value="<?= isset($editdata) ? 'Update Theater' : 'Add Theater' ?>" name="<?= isset($editdata) ? 'update' : 'add' ?>">
      </div>
      
    </form>
  
  </div>
  <div class="col-lg-6">
  
     <table class="table">
      <tr>
        <th>#</th>
        <th>Theater</th>
        <th>Movie</th>
        <th>Category</th>
        <th>Date</th>
        <th>Days/Time</th>
        <th>Ticket</th>
        <th>Location</th>
        <th>Action</th>
      </tr>
      
      <?php
      $sql = "SELECT theater.*, movies.title, categories.catname
      FROM theater
      INNER JOIN movies ON movies.movieid = theater.movieid
      INNER JOIN categories ON categories.catid = movies.catid";
      $res  = mysqli_query($con, $sql);
      if(mysqli_num_rows($res) > 0){
        while($data = mysqli_fetch_array($res)){
          ?>

          <tr>
            <td><?= $data['theaterid'] ?></td>
            <td><?= $data['theater_name'] ?></td>
            <td><?= $data['title'] ?></td>
            <td><?= $data['catname'] ?></td>
            <td><?= $data['date'] ?></td>
            <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>
            <td><?= $data['price'] ?></td>
            <td><?= $data['location'] ?></td>
            <td>
              <a href="theater.php?editid=<?= $data['theaterid'] ?>" class="btn btn-primary">Edit</a>
              <a href="theater.php?deleteid=<?= $data['theaterid'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this theater?')">Delete</a>
            </td>
          </tr>

       <?php
        }
      } else {
        echo '<tr><td colspan="9">No theaters found</td></tr>';
      }
      ?>
     </table>

  </div>
</div>
</div>

<?php include('footer.php')  ?>

</body>
</html>

<?php
if(isset($_POST['add'])){
  $movieid = $_POST['movieid'];
  $theater_name = $_POST['theater_name'];
  $days = $_POST['days'];
  $timing = $_POST['timing'];
  $price = $_POST['price'];
  $date = $_POST['date'];
  $location = $_POST['location'];

  $sql = "INSERT INTO `theater`(`theater_name`, `timing`, `days`, `date`, `price`, `location`, `movieid`) 
          VALUES ('$theater_name','$timing','$days','$date','$price','$location','$movieid')";

  if(mysqli_query($con, $sql)){
    echo "<script> alert('Theater added')</script>";
    echo "<script> window.location.href='theater.php' </script>";
  } else {
    echo "<script> alert('Theater not added')</script>";
  }
}

if(isset($_POST['update'])){
  $theaterid = $_POST['theaterid'];
  $movieid = $_POST['movieid'];
  $theater_name = $_POST['theater_name'];
  $days = $_POST['days'];
  $timing = $_POST['timing'];
  $price = $_POST['price'];
  $date = $_POST['date'];
  $location = $_POST['location'];

  $sql = "UPDATE `theater` SET 
            `theater_name`='$theater_name',
            `timing`='$timing',
            `days`='$days',
            `date`='$date',
            `price`='$price',
            `location`='$location',
            `movieid`='$movieid'
          WHERE `theaterid`='$theaterid'";

  if(mysqli_query($con, $sql)){
    echo "<script> alert('Theater updated')</script>";
    echo "<script> window.location.href='theater.php' </script>";
  } else {
    echo "<script> alert('Theater not updated')</script>";
  }
}

if(isset($_GET['deleteid'])){
  $deleteid = $_GET['deleteid'];
  $sql = "DELETE FROM `theater` WHERE theaterid = '$deleteid'";

  if(mysqli_query($con, $sql)){
    echo "<script> alert('Theater deleted')</script>";
    echo "<script> window.location.href='theater.php' </script>";
  } else {
    echo "<script> alert('Theater not deleted')</script>";
  }
}
?>
