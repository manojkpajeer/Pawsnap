<?php 
  session_start();
    
  require_once '../assets/config/connect.php';
  
  if(empty($_SESSION['is_billing_admin_login'])){
      echo "<script>location.href='index.php';</script>";
  }

  require_once './pages/header.php';

if (isset($_POST['submit']))
{

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
<div class="pcoded-content">
    <div class="card">
        <div class="card-block">
            <form  method="POST" enctype="multipart/form-data">
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 style="float: left;">Update Your Password</h4>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Current Password</label>
                                                            <input type="password" class="form-control" name="opass" placeholder="Enter Current Password" required />
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <input type="password" class="form-control" name="npass" placeholder="Enter New Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" maxlength="25"/>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Confirm Password</label>
                                                            <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" required maxlength="25"/>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 mt-3 text-center">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-danger mt-4" name="submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once './pages/footer.php';
?>