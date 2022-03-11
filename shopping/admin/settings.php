<?php
    session_start();

    if(empty($_SESSION['is_shopping_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './assets/pages/admin-link.php';
    require_once './assets/pages/admin-header.php';
    require_once '../../assets/config/connect.php';

    if(isset($_POST['update'])){

        if ($_POST['npass'] == $_POST['cpass']) {

            $opass = $_POST['opass'];
            $npass = $_POST['npass'];
    
            $res1 = mysqli_query($conn, "SELECT LM_Id FROM login_master WHERE UserEmail = '$_SESSION[user_email]' AND UserPassword = '$opass' AND UserRole = 'Admin'");
            if(mysqli_num_rows($res1)>0){
                $row1 = mysqli_fetch_assoc($res1);
                if(mysqli_query($conn, "UPDATE login_master SET UserPassword = '$npass' WHERE LM_Id = ' " . $row1['LM_Id'] ."'")){
                    echo "<script>alert('Yay, Your password updated successfully..');</script>";
                }
                else{
                    echo "<script>alert('Oops, Unable to process your request..');</script>";
                }
            }
            else{
                echo "<script>alert('Oops, An invalid current password..');</script>";
            }
        } else {
    
            echo "<script>alert('Oops, The password confirmation does not match..');</script>";
        }        
    } 
?>
    
        <div id="layoutSidenav">
            <?php

                require_once './assets/pages/admin-sidebar.php';
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid p-4">
                        <div class="row">
                        <div class="col-sm-12 col-lg-3 col-md-6"></div>
                            <div class="col-sm-12 col-lg-6 col-md-6">
                                <div class="card mt-4 p-4">
                                    <span class="text-center h1">Change Password</span>
                                    <form method="post" class="row">
                                        <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                            <label class="form-label">Current Password</label>
                                            <input type="password" class="form-control" required name="opass">
                                        </div>
                                        <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="npass" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" maxlength="25">
                                        </div>
                                        <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" name="cpass" required maxlength="25">
                                        </div>
                                        <div class="col-12 mt-3">
                                            <button class="btn btn-primary" type="submit" name="update">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-3 col-md-6"></div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    
<?php

    require_once './assets/pages/admin-footer.php';
?>
