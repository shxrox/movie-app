<?php include('connect.php')  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    
    <title>Register</title>

</head>
<body>
    

<section id="team" class="team section-bg">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
          <h2>Register for Booking Ticket</h2>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
          <form action="register.php" method="post" role="form" class="php-email-form">
              <div class="row">
                
                <div class="col form-group mb-3">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required="">
                </div>
              </div>
                <div class="col form-group mb-3">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                </div>

             
              <div class="form-group mb-3">
                <input type="text" class="form-control" name="password" id="password" placeholder="Your Password" required="">
              </div>

              <div class="text-center"><button type="submit" class="btn-reg" name="register">Register</button></div>
            </form>
          </div>

        

        </div>

      </div>
</section>

</body>
</html>

<?php

if(isset($_POST['register'])){

  $name     = $_POST['name'];
  $email    = $_POST['email'];
  $password = $_POST['password'];

  //print_r($_POST);

  $sql = "INSERT INTO `users`(`name`, `email`, `password`, `roteype`) VALUES ('$name','$email','$password','2')";

  if(mysqli_query($con, $sql)){
     echo "<script> alert('user register successfully!!') </script>";
     echo "<script> window.location.href='login.php';  </script>";

  }else{
    echo "<script> alert('user not register')";
  }

}

?>


