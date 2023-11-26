<?php 
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header("Location:login.php");
    exit;
}
$msg="";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4ac9a7d2dc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php
$user_id = $_SESSION['ID'];

$conn = mysqli_connect("localhost", "root","","td_commers");
if(!$conn){
    $msg = "Server connection Error" . mysqli_connect_error();
} else{

 

// product upload

if(isset($_POST['save_product'])){
    if(!isset($_POST['product-title']) || !isset($_POST['product-description']) || !isset($_POST['product-price'])){
        $msg = "Please insert All Field";      
    } else{
        $title = $_POST['product-title']; 
        $description = $_POST['product-description'];
        $description = mysqli_real_escape_string($conn, $description);
        $price = $_POST['product-price']; 

        $url ="";


    $ext = pathinfo($_FILES['product_thumb']['name'], PATHINFO_EXTENSION);
    $types = array('jpg','png','jpeg','gif', 'svg');

    if(!in_array($ext, $types)){
        $msg = "This types of image not allowed!";
    } else if($_FILES['product_thumb']['size' > 100000]){
        $msg = "Your image size is too larze!";
    } else{
        $upload_dir = dirname(__FILE__) . '/uploads';
        if(!file_exists($upload_dir)){
            if(mkdir($upload_dir)){
                $file_name = $_FILES['product_thumb']['name'];
                $file_upload_path = $upload_dir .'/'. $file_name;

                if(file_exists($file_upload_path)){
                    $file_name = rand(0,99999) .'.'.$ext; 
                    $file_upload_path = $upload_dir .'/'. $file_name;
                }

                if(move_uploaded_file($_FILES['product_thumb']['tmp_name'], $file_upload_path)){
                    $host = $_SERVER['HTTP_ORIGIN'];
                    $url = $host . '/td_commers/uploads/' . $file_name;
                   $url = mysqli_query($conn, $upload_avatar_sql);
                }
            } 
        } else{
                $file_name = $_FILES['product_thumb']['name'];
                $file_upload_path = $upload_dir .'/'. $file_name;

                if(file_exists($file_upload_path)){
                    $file_name = rand(0,99999) .'.'. $ext; 
                    $file_upload_path = $upload_dir .'/'. $file_name;
                }

                if(move_uploaded_file($_FILES['product_thumb']['tmp_name'], $file_upload_path)){
                    $host = $_SERVER['HTTP_ORIGIN'];
                    $url = $host . '/td_commers/uploads/' . $file_name;
                   $url = mysqli_query($conn, $upload_avatar_sql);
                }
            
        }
    }


        $set_product_sql = "INSERT INTO `products` (`product_avatar`, `product_title`, `product_description`, `product_price`, `user_id`) VALUES ('$url', '$title', '$description', '$price', '$user_id');";
        $product_result = mysqli_query($conn, $set_product_sql);

    }
}



// if(isset($_POST['save_product'])){

//     // echo '<pre>';
//     // var_dump($_FILES['product_thumb']);
//     // exit;

//     $ext = pathinfo($_FILES['product_thumb']['name'], PATHINFO_EXTENSION);
//     $types = array('jpg','png','jpeg','gif', 'svg');

//     if(!in_array($ext, $types)){
//         $msg = "This types of image not allowed!";
//     } else if($_FILES['product_thumb']['size' > 100000]){
//         $msg = "Your image size is too larze!";
//     } else{
//         $upload_dir = dirname(__FILE__) . '/uploads';
//         if(!file_exists($upload_dir)){
//             if(mkdir($upload_dir,0777,true)){
//                 $file_name = $_FILES['product_thumb']['name'];
//                 $file_upload_path = $upload_dir .'/'. $file_name;

//                 if(file_exists($file_upload_path)){
//                     $file_name = rand(0,99999) .'.'.$ext; 
//                     $file_upload_path = $upload_dir .'/'. $file_name;
//                 }

//                 if(move_uploaded_file($_FILES['product_thumb']['tmp_name'], $file_upload_path)){
//                     $host = $_SERVER['HTTP_ORIGIN'];
//                     $url = $host . '/td_commers/uploads/' . $file_name;
//                     $upload_avatar_sql = "INSERT INTO `products` (`product_avatar`) VALUES ('$url');";
//                     mysqli_query($conn, $upload_avatar_sql);
//                 }
//             } 
//         } else{
//                 $file_name = $_FILES['product_thumb']['name'];
//                 $file_upload_path = $upload_dir .'/'. $file_name;

//                 if(file_exists($file_upload_path)){
//                     $file_name = rand(0,99999) .'.'. $ext; 
//                     $file_upload_path = $upload_dir .'/'. $file_name;
//                 }

//                 if(move_uploaded_file($_FILES['product_thumb']['tmp_name'], $file_upload_path)){
//                     $host = $_SERVER['HTTP_ORIGIN'];
//                     $url = $host . '/td_commers/uploads/' . $file_name;
//                     $upload_avatar_sql = "INSERT INTO `products` (`product_avatar`) VALUES ('$url');";
//                     mysqli_query($conn, $upload_avatar_sql);
//                 }
            
//         }
//     }
// }




}



?>


<header class="header d-flex align-items-center">
            <div class="d-flex">
                <a href="#" class="logo"><span>TD Commers</span></a>
            </div>

            <div class="search-bar">
                <form action="" class=" search-form d-flex align-items-center">
                    <input  type="text" placeholder="Search">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <nav class="header-nav">
                <ul>
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#">
                    <i class="fa-solid fa-user"></i>
                    <span class="d-none d-md-block dropdown-toggle ps-2">Diganta</span>
                    </a><!-- End Profile Iamge Icon -->
                </ul>
            </nav>
 </header>
    <!-- Header Section End -->


    <!-- Sidebar Start -->
    <aside class="sidebar">
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="fa-solid fa-bars"></i>
                <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="profile.php">
                <i class="fa-regular fa-address-book"></i>
                <span>Profile</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="product.php">
                <i class="fa-regular fa-address-book"></i>
                <span>View Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>log Out</span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- Sidebar End -->


    <main id="main">
        <!-- Product Table Start -->
        <div class="col-lg-12">
            <div class="card product-table overflow-auto">
                <div class="filter">
                    <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add</a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Top Seling<span>| Today</span></h5>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Preview</th>
                                <th>Product title</th>
                                <th>Description</th>
                                <th>price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //fetch product 
                                $get_product_sql = "SELECT * FROM `products`";
                                $get_product_result = mysqli_query($conn, $get_product_sql);

                            while($fetch_product = mysqli_fetch_assoc($get_product_result)){

                              echo "<tr>";
                                  echo "<th>";
                                     echo "<img src='".$fetch_product['product_avatar']."' >";
                                  echo "</th>";
                                  echo "<td>" .$fetch_product['product_title']. "</td>";
                                  echo  "<td class='description'>".$fetch_product['product_description']."</td>";
                                  echo "<td>".$fetch_product['product_price']."</td>";
                                  echo  "<td>";
                                       echo "<a href='edit_product.php?id={$fetch_product['ID']}' name='{$fetch_product['ID']}' class='btn btn-primary left' data-bs-toggle='modal' data-bs-target='#editModal' data-bs-whatever='@mdo'>"."Edit". "</a>";
                                       echo "<a href='delete.php?id={$fetch_product['ID']}' class='btn btn-danger'>"."Delete"."</a>";
                                  echo  "</td>";
                               echo "</tr>";
                            }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Product Table End -->

<?php

    $product_id_sql = "SELECT * FROM `products`";
    $product_id_result = mysqli_query($conn, $product_id_sql);
    $fetch_id = mysqli_fetch_assoc($product_id_result);
    $get_id = $fetch_id['ID'];
  

     //fetch product for edit
     $edit_product_sql = "SELECT * FROM `products` WHERE ID = '$get_id'";
     $get_product_result = mysqli_query($conn, $edit_product_sql);
     $edit_product = mysqli_fetch_assoc($get_product_result);


     //update product

     if($_POST['update_product']){
        if(!isset($_POST['product_title']) || !isset($_POST['product_description']) || !isset($_POST['product_price'])){
            $msg="Insert All the field";
        } else{
            $product_title = $_POST['product_title'];
            $product_description = $_POST['product-description'];
            $product_price = $_POST['product_price'];
            // $product_id = $edit_product['ID'];

            $update_sql = "UPDATE `products` SET product_title = '$product_title', product_description = '$product_description', product_price = '$product_price' user_id = '$user_id' WHERE ID = '$product_id';";

            mysqli_query($conn, $update_sql);
        }
     }

?>
        <!-- Edit product Modal Start -->
        <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">image:</label>
                    <input type="file" name="product_thumb" accept="image/png, image/jpg, image/jpge, image/gif" />
                 
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Product Title:</label>
                    <input type="text"  class="form-control" name="product-title" value="<?php echo $edit_product['product_title'] ?>" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" name="product-description" id="message-text"><?php echo $edit_product['product_description'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Price:</label>
                    <input type="text" class="form-control" name="product-price" value="<?php echo $edit_product['product_price'] ?>" id="recipient-name">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="update_product" data-bs-dismiss="modal">Save</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <!-- Edit Product Modal End -->



        <!-- Save Product Start -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">image:</label>
                    <input type="file" name="product_thumb" accept="image/png, image/jpg, image/jpge, image/gif" />
                 
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Product Title:</label>
                    <input type="text"  class="form-control" name="product-title" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" name="product-description" id="message-text"></textarea>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Price:</label>
                    <input type="text" class="form-control" name="product-price" id="recipient-name">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="save_product" data-bs-dismiss="modal">Save</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <!-- Save product End -->


        <!-- get all subscriber -->
        <?php 
        $conn = mysqli_connect("localhost", "root","","td_commers");
        if(!$conn){
            $msg="Server Connection Failed" . mysqli_connect_error();
        } else{
            $user_sql = "SELECT * FROM `users`";
            $user_result = mysqli_query($conn,$user_sql);
        }
        ?>

        <!-- User Table Start -->
        <div class="col-lg-12 mt-5">
            <div class="card product-table overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">All Subscribers<span>| Today</span></h5>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>username</th>
                                <th>Email</th>
                                <th>Registred Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php 
                        
                        
                       echo  "<tbody>";
                       while($get_subscriber = mysqli_fetch_assoc($user_result)){
                           echo  "<tr>";
                              echo  "<td>" . $get_subscriber['ID'] . "</td>";
                                 echo "<th>";
                                  echo  "<img src='".$get_subscriber['user_avatar']."' >";
                                 echo "</th>";
                                echo  "<td>". $get_subscriber['name'] ."</td>";
                                echo  "<td>". $get_subscriber['email'] ."</td>";
                                echo  "<td>". $get_subscriber['upload_date'] ."</td>";
                                echo  '<td>';
                                    echo "<a href='delete_user.php?id={$get_subscriber['ID']}' class='btn btn-danger'>"."Delete"."</a>";
                                echo  '</td>';
                           echo  "</tr>";
                       echo  "</tbody>";
                       }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- User Table End -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>