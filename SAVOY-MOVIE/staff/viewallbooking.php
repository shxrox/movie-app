<?php 
include('../connect.php');

if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php';  </script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../staff/viewallbooking.css">
    <title>Booking</title>
</head>
<body>

<?php include('header.php') ?>

<div class="container-viewallbooking" style="margin-top:100px!important;">
  <form action="viewallbooking.php" method="post">
    <div class="row">
      <div class="col-lg-3">
        <input type="date" name="start" class="form-control">
      </div>
      <div class="col-lg-3">
        <input type="date" name="end" class="form-control">
      </div>
      <div class="col-lg-3">
         <select name="status" id="" class="form-control">
          <option value="">Select Status</option>
          <option value="0">Pending</option>
          <option value="1">Approve</option>
         </select>
      </div>
      <div class="col-lg-3">
        <input type="submit" name="btnsearch" value="Search" class="btn-s btn-success">
      </div>
    </div>
  </form>
</div>

<div class="container-viewallbooking">
  <div class="row mt-5">
    <div class="col-lg-12">
      <table class="table">
        <tr>
          <th>#</th>
          <th>Theater</th>
          <th>Category</th>
          <th>Date</th>
          <th>Days/Time</th>
          <th>Ticket</th>
          <th>Location</th>
          <th>User</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        
        <?php
        if(isset($_POST['btnsearch'])){
          $start = $_POST['start'];
          $end = $_POST['end'];
          $status = $_POST['status'];
          $total_sale = 0;

          $sql = "SELECT booking.bookingid, booking.bookingdate, booking.person, theater.theater_name, theater.timing, theater.days, theater.price, theater.location, movies.title, categories.catname, users.name AS 'username', booking.status
                  FROM booking
                  INNER JOIN theater ON theater.theaterid = booking.theaterid
                  INNER JOIN users ON users.userid = booking.userid
                  INNER JOIN movies ON movies.movieid = theater.movieid
                  INNER JOIN categories ON categories.catid = movies.catid
                  WHERE booking.bookingdate BETWEEN '$start' AND '$end' AND booking.status = '$status'";
          $res = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0){
            while($data = mysqli_fetch_array($res)){
              $total_sale += $data['price'];
              ?>
              <tr>
                <td><?= $data['bookingid'] ?></td>
                <td><?= $data['theater_name'] ?></td>
                <td><?= $data['title'] ?> - <?= $data['catname'] ?></td>
                <td><?= $data['bookingdate'] ?></td>
                <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>
                <td><?= $data['price'] ?></td>
                <td><?= $data['location'] ?></td>
                <td><?= $data['username'] ?></td>
                <td>
                  <?php if($data['status'] == 0): ?>
                    <a href="#" class="btn-ped">Pending</a>
                  <?php else: ?>
                    <a href="#" class="btn btn-success">Approved</a>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($data['status'] == 1): ?>
                    <button type="button" class="btn btn-light" disabled>Completed</button>
                  <?php else: ?>
                    <a href="viewallbooking.php?approveid=<?= $data['bookingid'] ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to approve this booking?')">Approve</a>
                  <?php endif; ?>
                  <a href="viewallbooking.php?deleteid=<?= $data['bookingid'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                </td>
              </tr>
              <?php
            }
            echo "<tr><td colspan='10'>Total Sale: <strong>Rs.$total_sale</strong></td></tr>";
          }
        } else {
          $sql = "SELECT booking.bookingid, booking.bookingdate, booking.person, theater.theater_name, theater.timing, theater.days, theater.price, theater.location, movies.title, categories.catname, users.name AS 'username', booking.status
                  FROM booking
                  INNER JOIN theater ON theater.theaterid = booking.theaterid
                  INNER JOIN users ON users.userid = booking.userid
                  INNER JOIN movies ON movies.movieid = theater.movieid
                  INNER JOIN categories ON categories.catid = movies.catid";
          $res = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0){
            while($data = mysqli_fetch_array($res)){
              ?>
              <tr>
                <td><?= $data['bookingid'] ?></td>
                <td><?= $data['theater_name'] ?></td>
                <td><?= $data['title'] ?> - <?= $data['catname'] ?></td>
                <td><?= $data['bookingdate'] ?></td>
                <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>
                <td><?= $data['price'] ?></td>
                <td><?= $data['location'] ?></td>
                <td><?= $data['username'] ?></td>
                <td>
                  <?php if($data['status'] == 0): ?>
                    <a href="#" class="btn btn-warning">Pending</a>
                  <?php else: ?>
                    <a href="#" class="btn btn-success">Approved</a>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($data['status'] == 1): ?>
                    <button type="button" class="btn btn-light" disabled>Completed</button>
                  <?php else: ?>
                    <a href="viewallbooking.php?approveid=<?= $data['bookingid'] ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to approve this booking?')">Approve</a>
                  <?php endif; ?>
                  <a href="viewallbooking.php?deleteid=<?= $data['bookingid'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                </td>
              </tr>
              <?php
            }
          } else {
            echo '<tr><td colspan="10">No booking found</td></tr>';
          }
        }
        ?>
      </table>
    </div>
  </div>
</div>


   <div class="btn-feedback">
    
        <button id="ViewFeedBacks" onclick="openContactUsPage()">FeedBacks</button>

   </div>
<script>
    function openContactUsPage() {
        window.location.href = '../admin/submit_feedback.php'; 
    }
</script>


<?php include('footer.php') ?>

</body>
</html>

<?php
if(isset($_GET['approveid'])){
  $bookingid = $_GET['approveid'];
  $sql = "UPDATE booking SET status = 1 WHERE bookingid = '$bookingid'";

  if(mysqli_query($con, $sql)){
    echo "<script>alert('Booking approved successfully!')</script>";
    echo "<script>window.location.href='viewallbooking.php';</script>";
  } else {
    echo "<script>alert('Approval failed!')</script>";
  }
}

if(isset($_GET['deleteid'])){
  $bookingid = $_GET['deleteid'];
  $sql = "DELETE FROM booking WHERE bookingid = '$bookingid'";

  if(mysqli_query($con, $sql)){
    echo "<script>alert('Booking deleted successfully!')</script>";
    echo "<script>window.location.href='viewallbooking.php';</script>";
  } else {
    echo "<script>alert('Deletion failed!')</script>";
  }
}
?>
