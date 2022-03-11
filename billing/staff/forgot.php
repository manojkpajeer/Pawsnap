<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  
  require '../../assets/vendor/autoload.php';
  
  $mail = new PHPMailer(true);

  require_once '../../assets/config/connect.php';
  
  if(isset($_POST['submit']))
  {
    $email = $_POST['emailId'];

    $res = mysqli_query($conn, "SELECT login_master.UserPassword, staff_master.FullName FROM login_master JOIN staff_master ON staff_master.EmailId = login_master.UserEmail WHERE login_master.UserEmail = '$email' AND staff_master.Status = 1 AND login_master.UserRole = 'Staff'");
    if (mysqli_num_rows($res)>0) {

        $row = mysqli_fetch_assoc($res); 
        $customerName = $row['FullName'];
        $appName = "Pawsnap";

        try {                   
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'project.head1994@gmail.com';                    
            $mail->Password   = 'MAnoj143@@';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465;                                  
        
            $mail->setFrom('project.head1994@gmail.com', $appName);
            $mail->addAddress($email, $customerName);
        
            $mail->IsHTML(true);
            $mail->Subject = "Password reset email - Pawsnap";
            $mail->Body = 'hi ' . $customerName . "<br>We received a request to reset the passowrd for your account.<br> Your password is <strong>" . $row['UserPassword'] . "</strong><br>We recomend that you keep your password safe and do not share with anyone. <br>Thank You<br><strong>Team ".$appName."</strong>";
        
            if ($mail->send()) {

              echo "<script>alert('Yay, We sent an email to recover your password..');</script>";  
            } else {

              echo "<script>alert('Oops, Unable to process your request ..');</script>";  
            }
        } catch (Exception $e) {

          echo "<script>alert('Oops, Unable to process your request..');</script>";  
        }
    }
    else{

        echo "<script>alert('Oops, Email does not exist on inactive..');</script>";  
    }
      
  }
?>

<link rel="stylesheet" href="popup_style.css">
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Pawsanp - Reset password</title>

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
<h5 class="text-center txt-primary">Forgot Password</h5>
</div>
</div>
<form method="POST" >
<div class="form-group form-primary">
<input class="form-control" placeholder="Email ID" name="emailId" type="email" autofocus required>
<span class="form-bar"></span>
</div>
<div class="row m-t-25 text-left">
<div class="col-12">

<div class="forgot-phone text-right f-right">
<a href="index.php" class="text-right f-w-600">Remember your password?</a>
</div>

</div>
</div>
<div class="row m-t-30">
<div class="col-md-12">
<button type="submit" name="submit" class="btn btn-danger btn-md btn-block waves-effect text-center m-b-20">Submit</button>
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
