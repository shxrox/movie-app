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
    <link rel="stylesheet" href="../admin/categories.css">
    <title>Categories</title>
</head>
<body>

<?php include('header.php') ?>

   
 
<div class="container-cat">
   
  <div class="row">
    <div class="col-lg-6">

      <?php if(isset($_GET['editid'])): ?>
        <?php
        $editid  = $_GET['editid'];
        $sql = "SELECT * FROM `categories` WHERE catid= '$editid'";
        $res  = mysqli_query($con, $sql);
        $editdata = mysqli_fetch_array($res);
        ?>
        <form action="categories.php" method="post">
          <input type="hidden" id="cat-sec" class="cat-sech value="<?=$editdata['catid']?>" name="catid">
          <div class="form-group mb-4">
            <input type="text" id="cat-sec" class="cat-sech" name="catname" value="<?=$editdata['catname']?>" placeholder="enter category">
          </div>
          <div class="form-group ">
            <input type="submit" class="btn-update" value="Update" name="update">
          </div>
        </form>
      <?php else: ?>
        <form action="categories.php" method="post">
          <div class="form-group mb-4">
            <input type="text" class="form-control" name="catname" value="" placeholder="enter category">
          </div>
          <div class="form-group ">
            <input type="submit" class="btn-submit" value="Add" name="add">
          </div>
        </form>
      <?php endif; ?>

    </div>

    <div class="col-lg-6">
      <table class="table">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Action</th>
        </tr>
        <?php
        $sql = "SELECT * FROM `categories`";
        $res  = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) > 0){
          while($data = mysqli_fetch_array($res)){
            ?>
            <tr>
              <td><?= $data['catid'] ?></td>
              <td><?= $data['catname'] ?></td>
              <td>
                <a href="categories.php?editid=<?= $data['catid'] ?>" class="btn btn-primary">Edit</a>
                <a href="categories.php?deleteid=<?= $data['catid'] ?>" class="btn btn-danger">Delete</a>
              </td>
            </tr>
            <?php
          }
        }else{
          echo '<tr><td colspan="3">No category found</td></tr>';
        }
        ?>
      </table>
    </div>
  </div>
</div>

<?php include('footer.php') ?>

</body>
</html>

<?php
if(isset($_POST['add'])){
  $name = $_POST['catname'];
  $sql = "INSERT INTO `categories`( `catname`) VALUES ('$name')";
  if(mysqli_query($con, $sql)){
    echo "<script> alert('category added')</script>";
    echo "<script> window.location.href='categories.php' </script>";
  }else{
    echo "<script> alert('category not added')</script>";
  }
}

if(isset($_POST['update'])){
  $catid = $_POST['catid'];
  $name = $_POST['catname'];
  $sql = "UPDATE `categories` SET `catname`='$name' WHERE  catid = '$catid'";
  if(mysqli_query($con, $sql)){
    echo "<script> alert('category updated')</script>";
    echo "<script> window.location.href='categories.php' </script>";
  }else{
    echo "<script> alert('category not updated')</script>";
  }
}

if(isset($_GET['deleteid'])){
  $deleteid = $_GET['deleteid'];
  $sql = "DELETE FROM `categories` WHERE catid = '$deleteid'";
  if(mysqli_query($con, $sql)){
    echo "<script> alert('category deleted')</script>";
    echo "<script> window.location.href='categories.php' </script>";
  }else{
    echo "<script> alert('category not deleted')</script>";
  }
}
?>
