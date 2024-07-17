
<link rel="stylesheet" href="header.css">
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

  <h1 class="logo"> <img src="./images/savoy-logo-3-removebg.png" alt=""></h1>
    
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
         <?php
         
          if(!isset($_SESSION['uid'])){
           
            echo '
          
           
            <li><a class="nav-link scrollto" href="alltheater.php">Theater</a></li>
            <li><a class="nav-link scrollto" href="about.php">About</a></li>
            <li><a class="nav-link scrollto" href="login.php">Login</a></li>
            <li><a class="nav-link scrollto" href="register.php">Register</a></li>
            ';
          }else{
            $type = $_SESSION['type'];
             if($type == 2){
              echo '
            
              <li><a class="nav-link scrollto" href="alltheater.php">Theater</a></li>
              <li><a class="nav-link scrollto" href="viewuserbooking.php">Booking</a></li>
              <li><a class="nav-link scrollto" href="about.php">About</a></li>
              <li><a class="nav-link scrollto" href="viewprofile.php">Profile</a></li>
              <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
             
              ';
             }
          }

         ?>
        
       
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>