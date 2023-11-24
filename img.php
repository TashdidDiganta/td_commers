<?php
session_start();


if(isset($_POST['avatar_upload'])){

    // echo '<pre>';
    // var_dump($_FILES['product_thumb']);
    // exit;

    $ext = pathinfo($_FILES['product_thumb']['name'], PATHINFO_EXTENSION);
    $types = array('jpg','png','jpeg','gif', 'svg');

    if(!in_array($ext, $types)){
        $msg = "This types of image not allowed!";
    } else if($_FILES['product_thumb']['size' > 100000]){
        $msg = "Your image size is too larze!";
    } else{
        $upload_dir = dirname(__FILE__) . '/uploads';
        if(!file_exists($upload_dir)){
            if(mkdir($upload_dir,0777,true)){
                $file_name = $_FILES['product_thumb']['name'];
                $file_upload_path = $upload_dir .'/'. $file_name;

                if(file_exists($file_upload_path)){
                    $file_name = rand(0,99999) .'.'.$ext; 
                    $file_upload_path = $upload_dir .'/'. $file_name;
                }

                if(move_uploaded_file($_FILES['product_thumb']['tmp_name'], $file_upload_path)){
                    $host = $_SERVER['HTTP_ORIGIN'];
                    $url = $host . '/td_commers/uploads/' . $file_name;
                    $upload_avatar_sql = "INSERT INTO `products` (`product_avatar`) VALUES ('$url');";
                    mysqli_query($conn, $upload_avatar_sql);
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
                    $upload_avatar_sql = "INSERT INTO `products` (`product_avatar`) VALUES ('$url');";
                    mysqli_query($conn, $upload_avatar_sql);
                }
            
        }
    }
}




?>


<form action="" method="post" enctype="multipart/form-data">

<input type="file" accept="image/jpg, image/png, image/jpeg, image/svg, image/gif" name="product_thumb">
                            <button type="submit" name="avatar_upload">Upload</button>
</form>