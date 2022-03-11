<?php

    session_start();
    
    require_once '../../assets/config/connect.php';
    
    if(!empty($_SESSION['is_billing_staff_login'])){
        echo "<script>location.href='home.php';</script>";
    }

    if (isset($_POST['login'])) {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $res = mysqli_query($conn, "SELECT login_master.UserPassword, staff_master.ST_Id, staff_master.FullName FROM login_master JOIN staff_master ON staff_master.EmailId = login_master.UserEmail WHERE login_master.UserEmail = '$email' AND staff_master.Status = 1 AND login_master.UserRole = 'Staff'");
        if (mysqli_num_rows($res)>0) {

            $row = mysqli_fetch_assoc($res);
            if ($password == $row['UserPassword']) {

                $_SESSION['user_id'] = $row['ST_Id'];
                $_SESSION['user_role'] = 'Staff';
                $_SESSION['user_name'] = $row['FullName'];
                $_SESSION['user_email'] = $email;
                $_SESSION['is_billing_staff_login'] = true;

                echo "<script>location.href='home.php';</script>";
            }
            else{

              echo "<script>alert('Oops, An invalid password you entered..');</script>";    
            }            
        }
        else{

          echo "<script>alert('Oops, An email does not exist..');</script>";
        }
    }
?>

<link rel="stylesheet" href="popup_style.css">
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <title>Pawsanp - Billing Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Paws and Fur - Billing Page">
  <meta name="keywords" content="Admin , Billing">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">
  <link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
</head>
  <body class="fix-menu">
    <section class="login-block">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="auth-box card" >
              <div class="text-center">
                  <h2 class="mt-4"><strong>PAW<span class="text-danger">SNAP</span></strong></h2>
              </div> 
              <div class="card-block" >
                <div class="row m-b-20">
                  <div class="col-md-12">
                    <h5 class="text-center txt-primary">Login Panel</h5>
                  </div>
                </div>
                <form method="POST">
                  <div class="form-group form-primary">
                    <input type="email" name="email" class="form-control" required="" placeholder="Email ID">
                    <span class="form-bar"></span>
                  </div>
                  <div class="form-group form-primary">
                    <input type="password" name="password" class="form-control" required="" placeholder="Password">
                    <span class="form-bar"></span>
                  </div>
                  <div class="row m-t-25 text-left">
                    <div class="col-12">
                      <div class="forgot-phone text-right f-right">
                        <a href="forgot.php" class="text-right f-w-600"> Forgot Password?</a>
                      </div>
                    </div>
                  </div>
                  <div class="row m-t-30">
                    <div class="col-md-12">
                      <button type="submit" name="login" class="btn btn-danger btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>

    <script type="text/javascript" src="files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="files/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="files/bower_components/modernizr/js/css-scrollbars.js"></script>
    <script type="text/javascript" src="files/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="files/assets/js/common-pages.js"></script>
  </body>
</html>
