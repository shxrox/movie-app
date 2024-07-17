<?php include('connect.php')  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">

</head>
<body>
    <section id="team" class="team section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Login Admin / User</h2>
            </div>

            <div class="login-form">

                <form action="login.php" method="post">
                    <div class="form-group">   
                        <input  type="email" name="email" id="email" placeholder="User Name" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder=" Password" required>
                    </div>

                    <div class="form-actions">
                        <button class="login" type="submit" name="login">Login</button>
                        <a href="register.php" class="reg">Register</a>
                    </div>
                </form>
         
            </div>

        </div>
    </section>
</body>
</html>
<?php

if(isset($_POST['login'])){

  $email    = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM `users` WHERE email = '$email' and password = '$password' ";

  $rs = mysqli_query($con, $sql);
  
  if(mysqli_num_rows($rs) > 0){
     $data = mysqli_fetch_array($rs);

     $role = $data['roteype'];

     $_SESSION['uid'] = $data['userid'];
     $_SESSION['type'] = $role;

     if($role == 1){
      echo "<script> alert('admin login successfully!!') </script>";
      echo "<script> window.location.href='admin/dashboard.php';  </script>";
     }
     else if($role == 2){
      echo "<script> alert('user login successfully!!') </script>";
      echo "<script> window.location.href='index.php';  </script>";
     }
     else if($role == 3){
      echo "<script> alert('staff login successfully!!') </script>";
      echo "<script> window.location.href='staff/dashboard.php';  </script>";
     }

  }else{
    echo "<script> alert('Invalid email & password') </script>";
  }

}

?>
