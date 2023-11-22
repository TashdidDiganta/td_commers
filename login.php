<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
if(isset($_POST['login'])){
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        $msg="Please Insert all field";
    } else{
        $username = isset($_POST['username'])? $_POST['username'] : "";
        $password = isset($_POST['password'])? $_POST['password'] : "";

        $conn = mysqli_connect("localhost", "root", "", "td_commers");

        if(!$conn){
            $msg = "Server connection Failed" . mysqli_connect_error() ;
        } else{
            $sql = "SELECT * FROM `users` WHERE (username = '$username') AND (password = '$password')";
            $user_result = mysqli_query($conn, $sql);

            $fectch_result = mysqli_fetch_assoc($user_result);


            if($username = $fectch_result['username'] && $pasword = $fectch_result['password']){
                $_SESSION['ID'] = $fectch_result['ID'];
                $_SESSION['username'] = $fectch_result['username'];
                $_SESSION['login'] = true;

                $msg = "Login successfull";

                if($fectch_result['role'] == 'admin'){
                    header("Location:admin.php?msg={$msg}");
                } else{
                    header("Location:product.php?msg={$msg}");
                }
            } else{
                $msg = "Login Failde";
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
                                        <label for="" class="form-label">Your Username</label>
                                        <input type="text" class="form-control" placeholder="Email" name="username">
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
                                        <button type="submit" class="btn btn-primary w-100" name="login">Log in</button>
                                    </div>
                                    <div class="col-12">
                                        <span class="small">I don't have an account?<a href="registration.php">Registration</a></span>
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