<?php

    session_start();
    
    require_once './assets/config/connect.php';
    
    if(!empty($_SESSION['is_customer_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    if (isset($_POST['login'])) {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $res = mysqli_query($conn, "SELECT login_master.UserPassword, customer_master.CM_Id, customer_master.FullName FROM login_master JOIN customer_master ON customer_master.CustomerEmail = login_master.UserEmail WHERE login_master.UserEmail = '$email' AND customer_master.Status = 1 AND login_master.UserRole = 'Customer'");
        if (mysqli_num_rows($res)>0) {

            $row = mysqli_fetch_assoc($res);
            if ($password == $row['UserPassword']) {

                $_SESSION['user_id'] = $row['CM_Id'];
                $_SESSION['user_name'] = $row['FullName'];
                $_SESSION['user_role'] = 'Customer';
                $_SESSION['user_email'] = $email;
                $_SESSION['is_customer_login'] = true;

                echo "<script>location.href='index.php';</script>";
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

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- tab icon -->
    <link rel="icon" href="./assets/images/tab_icon.png">

    <title>Pawsnap - Login</title>
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
            <h1 class="h3 mb-3 fw-normal">Please login</h1>

            <div class="form-floating">
                <input type="email" class="form-control" required name="email" placeholder="Email ID">
                <label>Email ID</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" required name="password" placeholder="Email ID" placeholder="Password">
                <label>Password</label>
            </div>

            <div class="my-3">
                <p class="text-start">Forgot Password? <a class href="forgot.php">Reset</a></p>
            </div>
            <div class="mb-3">
                <p class="text-end">New User? <a class href="register.php">Register</a></p>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
            <div class="mt-3">
                <a href="index.php">Back to home -></a>
            </div>
        </form>
    </main>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>






















