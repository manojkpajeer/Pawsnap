<?php
    session_start();

    if(!empty($_SESSION['is_shopping_admin_login'])){
        echo "<script>location.href='home.php';</script>";
    }

    require_once './assets/pages/admin-link.php';
    require_once '../../assets/config/connect.php';

    if(isset($_POST['login'])){

        $password = md5($_POST['password']);
        $email = $_POST['email'];

        $res = mysqli_query($conn, "SELECT login_master.UserPassword, admin_master.FullName, admin_master.AM_Id FROM login_master JOIN admin_master ON admin_master.EmailId = login_master.UserEmail WHERE login_master.UserEmail = '$email' AND admin_master.Status = 1 AND  login_master.UserRole = 'Admin'");
        if (mysqli_num_rows($res)>0) {

            $row = mysqli_fetch_assoc($res);
            if ($password == $row['UserPassword']) {
                
                $_SESSION['am_id'] = $row['AM_Id'];
                $_SESSION['user_name'] = $row['FullName'];
                $_SESSION['user_role'] = 'Admin';
                $_SESSION['user_email'] = $email;
                $_SESSION['is_shopping_admin_login'] = true;

                echo "<script>location.href='home.php';</script>";
            }
            else{
                echo "<script>alert('Oops, An invalid password you entered..');</script>";            
            }            
        }
        else{
            echo "<script>alert('Oops, An email does not exist on inactive..');</script>";
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
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body p-4">
                                    <form method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="email" name="email" required placeholder="Email Id"/>
                                            <label>Email ID</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="password" name="password" required placeholder="Password"/>
                                            <label>Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="forgot.php">Forgot Password?</a>
                                            <button type="submit" class="btn btn-primary" name="login">Login</a>
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
