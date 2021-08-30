<?php
session_start();
include 'user.php';
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Books Lover | Ebookstore</title>
  <!--Fav Icon-->
  <link rel="shortcut icon" href="images/logo2.jpg" type="image/x-icon">
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?
      family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <!------------------ Header ------------------>
  <div class="container">
    <div class="navbar">
      <div class="logo">
        <a href="index.php">
          <img src="images/EbookStore-Logo.png" alt="EbookStore-Logo" />
        </a>
      </div>
      <!----------  Nav Bar ------------------>
      <nav>
        <ul id="MenuItems">
          <li><a href="index.php">Home</a></li>
          <li><a href="ebooks.html">Ebooks</a></li>
          <li><a href="">About</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li><a href="account.php">Account</a></li>
        </ul>
      </nav>
      <a href="cart.html">
        <img src="images/cart.png" alt="Shoping Cart" width="28px" height="28px"
          style="margin-left: 10px; margin-top: 15px" />
      </a>
      <img src="images/menu.png" class="menu-icon" onclick="menutoggle()" />
    </div>
  </div>

  <!-- ---------- account page------------- -->
  <div class="account-page">
    <div class="container">
      <div class="row">
        <div class="col-2">
          <img src="images/header-pic.png" alt="Header-Pic" width="50%" />
        </div>
        <div class="col-2">
          <?php
            if(isset($_SESSION['logged_username'])){
              $usr = new user($_SESSION['logged_username']);
              ?>
              <h1>Welcome <?php echo $usr -> getUsername() ?></h1>
              You are logged in <br><br>
              <b>Email: </b><?php echo $usr -> getEmail() ?><br><br>
              <form method="post">
                <input type="submit" name="logout" value="LOGOUT" class='btn btn-primary btn-lg'>
              </form>
              <?php
              if(isset($_POST['logout'])){
                unset($_SESSION['logged_username']);
                echo "<script>window.location.href='account.php'</script>";
              }
            }
            else{
              ?>
              <div class="form-container">
                <div class="form-btn">
                  <span onclick="signIn()"> Sign In </span>
                  <span onclick="signUp()"> Sign Up </span>
                  <hr id="indicator" />

                  <form id="signInForm" name="myform" onsubmit="return validation()"
                    method="POST">
                    <input type="text" placeholder="Username" name="uname" value="<?php if(isset($_POST['uname'])){echo $_POST['uname'];} ?>" required />
                    <span id="uname"></span>
                    <input type="password" placeholder="Password" name='password' required/>
                    <button type="submit" class="btn" name='login_btn'>Sign In</button>
                    <a href="">Forgot password</a>
                  </form>

                  <form id="signUpForm" method='post'>
                    <input type="text" placeholder="Username" name='username' required/>
                    <input type="email" placeholder="Email" name='email' required />
                    <input type="password" placeholder="Password" name='password' required />
                    <button type="submit" class="btn" name='signup_btn'>Sign Up</button>
                  </form>
                  <?php
                    if(isset($_POST['login_btn'])){
                      $username = $_POST['uname'];
                      $password = $_POST['password'];
                      $usr = new user($username);
                      if($usr -> isUserNameExist()){
                        if(md5($password)==$usr->getPassword()){
                          $_SESSION['logged_username'] = $username;
                          echo "<script>window.location.href='account.php'</script>";
                        }
                        else{
                          echo "<script>alert('Incorrect password')</script>";
                        }
                      }
                      else{
                        echo "<script>alert('Incorrect username')</script>";
                      }
                    }


                    if(isset($_POST['signup_btn'])){
                      $username = $_POST['username'];
                      $email = $_POST['email'];
                      $password = $_POST['password'];

                      $usr = new user($username);
                      if($usr -> isUserNameExist()){
                        echo "<script>alert('Username is not available. Try another.')</script>";
                      }
                      else{
                        $usr -> setEmail($email);
                        $usr -> setPassword($password);
                        $usr -> insert();
                        $_SESSION['logged_username'] = $username;
                        echo "<script>window.location.href='account.php'</script>";
                      }
                    }
                   ?>

                </div>
              </div>
              <?php
            }
           ?>
        </div>
      </div>
    </div>
  </div>
  <!-- ---------------------footer------------------- -->
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="footer-col-1">
          <h3>Download Our App</h3>
          <p>Download App for Android and ios mobile phone.</p>
          <div class="app-logo">
            <img src="images/Playstore.png" />
            <img src="images/Applestore.png" />
          </div>
        </div>
        <div class="footer-col-2">
          <img src="images/EbookStore-Logo-footer.png" />
          <p>
            For those who are passionate about reading books
            and wanna buy the best books,it's the right site for you!
          </p>
        </div>
        <div class="footer-col-3">
          <h3>Useful Links</h3>
          <ul>
            <li>Coupons</li>
            <li>Blog Post</li>
            <li>Return Policy</li>
            <li>Join Affiliate</li>
          </ul>
        </div>
        <div class="footer-col-4">
          <h3>Follow us</h3>
          <ul>
            <li><a href="https://www.instagram.com/" target="blank"><i class="fab icons fa-instagram"></i></a></li>
            <li><a href="https://www.youtube.com/" target="blank"><i class="fab icons fa-youtube"></i></a></li>
            <li><a href="https://dribbble.com/" target="blank"><i class="fas icons fa-basketball-ball"></i></a></li>
            <li><a href="https://twitter.com/?lang=en" target="blank"><i class="fab icons fa-twitter"></i></a>
            </li>
          </ul>
        </div>
      </div>
      <hr />
      <p class="copyright">Copyright 2021 &copy; - EBookStore</p>
    </div>
  </div>
  <!-- ---------Javascript for toggle menu------------- -->
  <script>
    var MenuItems = document.getElementById("MenuItems");
    MenuItems.style.maxHeight = "0px";
    function menutoggle() {
      if (MenuItems.style.maxHeight == "0px") {
        MenuItems.style.maxHeight = "200px";
      } else {
        MenuItems.style.maxHeight = "0px";
      }
    }
  </script>
  <!-- -----------js for toggle form------------------ -->
  <script>
    var signInForm = document.getElementById("signInForm");
    var signUpForm = document.getElementById("signUpForm");
    var indicator = document.getElementById("indicator");

    function signIn() {
      signUpForm.style.transform = "translateX(300px)";
      signInForm.style.transform = "translateX(300px)";
      indicator.style.transform = "translateX(0px)";
    }
    function signUp() {
      signUpForm.style.transform = "translateX(0px)";
      signInForm.style.transform = "translateX(0px)";
      indicator.style.transform = "translateX(100px)";
    }
  </script>
  <!-- -----------------js for form validation ------------------ -->
  <script>
    function formvalidate() {
      var ptrn = /^([^0-9\W]*)$/;
      if (ptrn.test(document.myform.uname.value)) {
        document.getElementById("uname").textContent = "User Name is Valid";
        document.getElementById("uname").style.background = "#72EF57";
        document.getElementById("uname").style.fontSize = "12px";
      } else {
        document.getElementById("uname").textContent = "User Name is Invalid";
        document.getElementById("uname").style.background = "#EF6257";
        document.getElementById("uname").style.fontSize = "12px";
      }
    }
  </script>
</body>

</html>
