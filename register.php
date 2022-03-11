<?php

    session_start();
    
    require_once './assets/config/connect.php';
    
    if(!empty($_SESSION['is_customer_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    if (isset($_POST['register'])) {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $name = $_POST['name'];

        $res = mysqli_query($conn, "SELECT CM_Id FROM customer_master WHERE CustomerEmail = '$email' AND Status = 1");
        if (mysqli_num_rows($res)>0) {

            echo "<script>alert('Oops, An Email Id already in use..');</script>";   
        }
        else{

            if(mysqli_query($conn, "INSERT INTO customer_master(FullName, CustomerEmail, CustomerPhone, Status, DateCreate) 
                VALUES ('$name', '$email', '$phone', 1,  NOW())")){

                $password = $_POST['password'];

                if (mysqli_query($conn, "INSERT INTO login_master (UserEmail, UserPassword, UserRole) VALUES ('$email', '$password', 'Customer')")) {
                                            
                    echo "<script>alert('Yay, You have registered successfully..');location.href='login.php';</script>";

                } else {
                    
                    echo "<script>alert('Oops, Unable to add staff..');</script>";
                }    
            }
            else{

                echo "<script>alert('Oops, Unable to process your request..');</script>";
            }
        }     
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- tab icon -->
    <link rel="icon" href="./assets/images/tab_icon.png">

    <title>Pawsnap - Register</title>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      html,
        body {
        height: 100%;
        }

        body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        }

        .form-signin .checkbox {
        font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
        z-index: 2;
        }

        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>
  </head>

  <body class="text-center">
    <main class="form-signin border">
        <form method="POST">
            <img class="mb-4" src="./assets/images/logo.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please register</h1>
            <div class="form-floating">
                <input type="text" class="form-control" name="name" required placeholder="Full Name">
                <label>Full Name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" required placeholder="Email ID">
                <label>Email ID</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="phone" placeholder="Phone No" pattern="[6-9]{1}[0-9]{9}" title="Phone number start with 6-9 and remaing 9 digit with 0-9" maxlength="10">
                <label>Phone No</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" maxlength="25">
                <label>Password</label>
            </div>

            <div class="my-3">
                <p class="text-start">Have an account? <a class href="login.php">login</a></p>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="register">Submit</button>
            <div class="mt-3">
                <a href="index.php">Back to home -></a>
            </div>
        </form>
    </main>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>






















