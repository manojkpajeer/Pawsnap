<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../assets/vendor/autoload.php';

    $mail = new PHPMailer(true);

    require_once './assets/pages/admin-link.php';
    require_once '../../assets/config/connect.php';

    if (isset($_POST['reset'])) {
        $email = $_POST['email'];

        $res = mysqli_query($conn, "SELECT login_master.UserPassword, admin_master.FullName FROM login_master JOIN admin_master ON admin_master.EmailId = login_master.UserEmail WHERE login_master.UserEmail = '$email' AND admin_master.Status = 1 AND login_master.UserRole = 'Admin'");
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
                $mail->Subject = "Password reset email - " . $appName;
                $mail->Body = 'hi ' . $customerName . "<br>We received a request to reset the passowrd for your account.<br> Your password is <strong>" . $row['UserPassword'] . "</strong><br>We recomend that you keep your password safe and do not share with anyone. <br>Thank You<br><strong>Team ".$appName."</strong>";
            
                if ($mail->send()) {

                    echo "<script>alert('Yay, We sent an email to recover your password..');location.href='index.php';</script>";
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
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 pt-5">
                            <div class="card mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                </div>
                                <div class="card-body p-4">
                                    <form method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="email" name="email" required placeholder="Email Id"/>
                                            <label>Email address</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="index.php">Return to login</a>
                                            <button type="submit" class="btn btn-primary" name="reset">Submit</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
<?php

require_once './assets/pages/admin-footer.php';
?>
