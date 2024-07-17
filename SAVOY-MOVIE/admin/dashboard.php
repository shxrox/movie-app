<?php 
include('../connect.php');

if(!isset($_SESSION['uid'])){
    echo "<script> window.location.href='../login.php';  </script>";
    exit;
}

// Fetch data for the chart
$category_sql = "SELECT count(catid) as 'category' FROM `categories`";
$category_res = mysqli_query($con, $category_sql);
$catdata = mysqli_fetch_array($category_res);

$movie_sql = "SELECT count(movieid) as 'total_movies' FROM `movies`";
$movie_res = mysqli_query($con, $movie_sql);
$moviedata = mysqli_fetch_array($movie_res);

$theater_sql = "SELECT count(theaterid) as 'total_theater' FROM `theater`";
$theater_res = mysqli_query($con, $theater_sql);
$theaterdata = mysqli_fetch_array($theater_res);

$booking_sql = "SELECT count(bookingid) as 'total_booking' FROM `booking` where status = 1";
$booking_res = mysqli_query($con, $booking_sql);
$bookingdata = mysqli_fetch_array($booking_res);

$user_sql = "SELECT count(userid) as 'total_users' FROM `users` where roteype=2";
$user_res = mysqli_query($con, $user_sql);
$userdata = mysqli_fetch_array($user_res);

$sales_sql = "SELECT SUM(theater.price) as 'total_sale' FROM booking INNER JOIN theater ON theater.theaterid = booking.theaterid WHERE booking.status = 1";
$sales_res = mysqli_query($con, $sales_sql);
$salesdata = mysqli_fetch_array($sales_res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
</head>
<body>

<?php include('header.php')  ?>

<div class="container-admin">
    <h4>Welcome to Admin dashboard!!</h4>

    <div class="row">
        <div class="card-view">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <h5>CATEGORIES</h5>
                        <h6><?=$catdata['category']?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-view">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <h5>MOVIES</h5>
                        <h6><?=$moviedata['total_movies']?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-view">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <h5>THEATER</h5>
                        <h6><?=$theaterdata['total_theater']?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-view">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <h5>BOOKING</h5>
                        <h6><?=$bookingdata['total_booking']?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-view">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <h5>USERS</h5>
                        <h6><?=$userdata['total_users']?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-view">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <h5>SALES</h5>
                        <h6><?=$salesdata['total_sale']?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Container -->
    <div class="chart-container" style="width: 80%; margin: auto; margin-top: 50px;">
        <canvas id="dashboardChart"></canvas>
    </div>
</div>
<h1 class="sales-h1">Sales Chart</h1>
<div class="chart-container" style="width: 80%; margin: auto; margin-top: 50px;">
        <canvas id="salesChart"></canvas>
    </div>
</div>

 <h1 class="sales-h1">Other Data Chart</h1>
    <div class="chart-container" style="width: 80%; margin: auto; margin-top: 50px;">
        <canvas id="otherDataChart"></canvas>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Sales Chart
const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'bar',
    data: {
        labels: ['Sales'],
        datasets: [{
            label: 'Total Sales',
            data: [<?=$salesdata['total_sale']?>],
            backgroundColor: 'rgba(165, 43, 84, 0.2)',
            borderColor: 'rgba(165, 43, 84, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                grid: {
                    color: 'rgba(255, 255, 255, 0.2)', // X-axis grid color
                },
                ticks: {
                    color: 'rgba(255, 255, 255, 1)' // X-axis label color
                }
            },
            y: {
                grid: {
                    color: 'rgba(255, 255, 255, 0.2)' // Y-axis grid color
                },
                ticks: {
                    color: 'rgba(255, 255, 255, 1)' // Y-axis label color
                }
            }
        }
    }
});

// Other Data Chart
const otherDataCtx = document.getElementById('otherDataChart').getContext('2d');
const otherDataChart = new Chart(otherDataCtx, {
    type: 'bar',
    data: {
        labels: ['Categories', 'Movies', 'Theater', 'Booking', 'Users'],
        datasets: [{
            label: 'Other Data',
            data: [
                <?=$catdata['category']?>,
                <?=$moviedata['total_movies']?>,
                <?=$theaterdata['total_theater']?>,
                <?=$bookingdata['total_booking']?>,
                <?=$userdata['total_users']?>
            ],
            backgroundColor: 'rgba(165, 43, 84, 0.2)',
            borderColor: 'rgba(165, 43, 84, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                grid: {
                    color: 'rgba(255, 255, 255, 0.2)', // X-axis grid color
                },
                ticks: {
                    color: 'rgba(255, 255, 255, 1)' // X-axis label color
                }
            },
            y: {
                grid: {
                    color: 'rgba(255, 255, 255, 0.2)' // Y-axis grid color
                },
                ticks: {
                    color: 'rgba(255, 255, 255, 1)' // Y-axis label color
                }
            }
        }
    }
});
</script>

<div class="footer">
    <footer>
    <?php include('footer.php')  ?>

    </footer>
</div>

</body>
</html>