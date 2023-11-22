<?php 
session_start();

if(isset($_SESSION['login']) && $_SESSION['login']== true){
    header("Location:product.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">


    <script src="https://kit.fontawesome.com/4ac9a7d2dc.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
$msg = "";
if(isset($_POST['registration'])){
    if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['username']) || !isset($_POST['password'])){
        $msg = "Please inset all the field";
    } else{
        $name = isset($_POST['name'])? $_POST['name']: "";
        $email = isset($_POST['email'])? $_POST['email']: "";
        $username = isset($_POST['username'])? $_POST['username']: "";
        $password = isset($_POST['password'])? $_POST['password']: "";


        $conn = mysqli_connect("localhost", "root", "", "td_commers");

        if(!$conn){
            $msg = "Server connection Failed" . mysqli_connect_error();
        } else{
            $email = mysqli_real_escape_string($conn, $email);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $check_email = "SELECT * FROM  `users` WHERE email = '{$email}'";
            $email_result = mysqli_query($conn, $check_email);
            $email_exist = mysqli_fetch_assoc($email_result);

            if($email_exist){
                $msg = "This email already used";
            } else{

                $registration_sql = "INSERT INTO `users` (`name`, `email`, `username`, `password`) VALUES ('$name', '$email', '$username', '$password');";
                 $data = mysqli_query($conn, $registration_sql);

                 $user_id = mysqli_insert_id($conn);
                 $user_sql = "SELECT * `users` WHERE ID = {$user_id}";
                 $user_result = mysqli_query($conn,$user_sql);
                 $user_info = mysqli_fetch_assoc($user_result);

                 if(!$data){
                    $msg = "Registration Faild";
                 } else{
                    $_SESSION['ID'] = $user_info['ID'];
                    $_SESSION['username'] = $user_info['username'];
                    $_SESSION['login'] = true;

                    if($user_info['role']== 'admin'){
                        header("Location:admin.php");
                    } else{
                        header("Location:product.php");
                    }
                 }

            }
        }
    }
}



?>
    <!-- Registration-html-start -->
    <div class="container">
        <section class="section d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="d-flex justify-content-center py-4">
                            <a href="" class="logo"><span>TD_Commers</span></a>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Enter your personal details to create account</p>
                                </div>

                                <form method="post" class="row g-3">
                                    <div class="col-12">
                                        <label for="" class="form-label">Your Name</label>
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="form-label">Your Email</label>
                                        <input type="text" class="form-control" placeholder="Email" name="email">
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text">@</span>
                                            <input type="text" class="form-control" placeholder="Username" name="username">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="form-label">Password</label>
                                        <input type="text" class="form-control" placeholder="password" name="password">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label for="" class="form-check-label">I agree and accept the <a href="#">terms and conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" name="registration" class="btn btn-primary w-100">Create Account</button>
                                    </div>
                                    <div class="col-12">
                                        <span class="small">Already have an account?<a href="login.php">Log in</a></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Registration-html-end -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>