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
    <link rel="stylesheet" href="../admin/movies.css">
    <title>Movies</title>
</head>
<body>

<?php include('header.php')  ?>



<div class="container-movies">
   
<div class="row">
  <div class="col-lg-6">
    <form action="movies.php" method="post" enctype="multipart/form-data">

      <?php
      if(isset($_GET['editid'])){
        $editid  = $_GET['editid'];
        $sql = "SELECT * FROM `movies` WHERE movieid= '$editid'";
        $res  = mysqli_query($con, $sql);
        $editdata = mysqli_fetch_array($res);
      }
      ?>

      <div class="form-group mb-4">
         <select name="catid" class="form-control">
          <option value="">Select Category</option>

         <?php
          $sql = "SELECT * FROM `categories`";
          $res  = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0){
            while($data = mysqli_fetch_array($res)){
              $selected = (isset($editdata) && $editdata['catid'] == $data['catid']) ? "selected" : "";
              echo "<option value='{$data['catid']}' $selected>{$data['catname']}</option>";
            }
          } else {
            echo "<option value=''>No Category found</option>";
          }  
          ?> 
         </select>
      </div>

      <div class="form-group mb-4">
      <input type="text" class="form-control" name="title" value="<?= isset($editdata) ? $editdata['title'] : '' ?>" placeholder="Enter title">
      </div>

      <div class="form-group mb-4">
      <input type="text" class="form-control" name="description" value="<?= isset($editdata) ? $editdata['description'] : '' ?>" placeholder="Enter description">
      </div>

      <div class="form-group mb-4">
      <input type="date" class="form-control" name="releasedate" value="<?= isset($editdata) ? $editdata['releasedate'] : '' ?>">
      </div>

      <div class="form-group ">
        Poster:
      <input type="file" id="select-file" class="form-control" name="image">
      </div>

      <div class="form-group ">
      Trailer:
      <input type="file"  id="select-file" class="form-control" name="trailer">
      </div>

      <div class="form-group mb-4">
      Video:
      <input type="file"  id="select-file" class="form-control" name="movie">
      </div>

      <div class="form-group">
      <input type="hidden" name="movieid" value="<?= isset($editdata) ? $editdata['movieid'] : '' ?>">
      <input type="submit" id="btn-add" class="btn <?= isset($editdata) ? 'btn-info' : 'btn-primary' ?>" value="<?= isset($editdata) ? 'Update' : 'Add' ?>" name="<?= isset($editdata) ? 'update' : 'add' ?>">
      </div>
      
    </form>
  
  </div>
  <div class="col-lg-6">
  
     <table class="table">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Category</th>
        <th>Poster</th>
        <th>Action</th>
      </tr>
      
      <?php
      $sql = "SELECT movies.*, categories.catname
      from movies
      inner join categories on categories.catid = movies.catid";
      $res  = mysqli_query($con, $sql);
      if(mysqli_num_rows($res) > 0){
        while($data = mysqli_fetch_array($res)){
          ?>
          <tr>
            <td><?= $data['movieid'] ?></td>
            <td><?= $data['title'] ?></td>
            <td><?= $data['catname'] ?></td>
            <td> <img src="uploads/<?= $data['image'] ?>" height="50" width="50" alt=""> </td>
            <td>
              <a href="movies.php?editid=<?= $data['movieid'] ?>" class="btn btn-primary">Edit</a>
              <a href="movies.php?deleteid=<?= $data['movieid'] ?>" class="btn btn-danger">Delete</a>
          </td>
          </tr>
       <?php
        }
      } else {
        echo '<tr><td colspan="5">No movies found</td></tr>';
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
  $catid = $_POST['catid'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $releasedate = $_POST['releasedate'];
  $image = $_FILES['image']['name'];
  $tmp_image = $_FILES['image']['tmp_name'];
  $trailer = $_FILES['trailer']['name'];
  $tmp_trailer = $_FILES['trailer']['tmp_name'];
  $movie = $_FILES['movie']['name'];
  $tmp_movie = $_FILES['movie']['tmp_name'];

  move_uploaded_file($tmp_image , "uploads/$image");
  move_uploaded_file($tmp_trailer , "uploads/$trailer");
  move_uploaded_file($tmp_movie , "uploads/$movie");

  $sql = "INSERT INTO `movies`(`title`, `description`, `releasedate`, `image`, `trailer`, `movie`, `catid`) 
  VALUES ('$title','$description','$releasedate','$image','$trailer','$movie','$catid')";

  if(mysqli_query($con, $sql)){
    echo "<script> alert('Movie added')</script>";
    echo "<script> window.location.href='movies.php' </script>";
  } else {
    echo "<script> alert('Movie not added')</script>";
  }
}

if(isset($_POST['update'])){
  $movieid = $_POST['movieid'];
  $catid = $_POST['catid'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $releasedate = $_POST['releasedate'];
  $image = $_FILES['image']['name'];
  $tmp_image = $_FILES['image']['tmp_name'];
  $trailer = $_FILES['trailer']['name'];
  $tmp_trailer = $_FILES['trailer']['tmp_name'];
  $movie = $_FILES['movie']['name'];
  $tmp_movie = $_FILES['movie']['tmp_name'];

  if($image) move_uploaded_file($tmp_image , "uploads/$image");
  if($trailer) move_uploaded_file($tmp_trailer , "uploads/$trailer");
  if($movie) move_uploaded_file($tmp_movie , "uploads/$movie");

  $sql = "UPDATE `movies` SET 
            `title`='$title',
            `description`='$description',
            `releasedate`='$releasedate',
            `catid`='$catid'";

  if($image) $sql .= ", `image`='$image'";
  if($trailer) $sql .= ", `trailer`='$trailer'";
  if($movie) $sql .= ", `movie`='$movie'";

  $sql .= " WHERE `movieid`='$movieid'";

  if(mysqli_query($con, $sql)){
    echo "<script> alert('Movie updated')</script>";
    echo "<script> window.location.href='movies.php' </script>";
  } else {
    echo "<script> alert('Movie not updated')</script>";
  }
}

if(isset($_GET['deleteid'])){
  $deleteid = $_GET['deleteid'];
  $sql = "DELETE FROM `movies` WHERE movieid = '$deleteid'";

  if(mysqli_query($con, $sql)){
    echo "<script> alert('Movie deleted')</script>";
    echo "<script> window.location.href='movies.php' </script>";
  } else {
    echo "<script> alert('Movie not deleted')</script>";
  }
}
?>
