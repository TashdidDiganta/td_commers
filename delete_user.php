<?php

$msg = "";
$id = $_GET['id'];

$conn = mysqli_connect("localhost", "root", "", "td_commers");

if(!$conn){
    $msg = "Server Connection Faield" . mysqli_connect_error();
} else{

    $delete_sql = "DELETE FROM `users` WHERE ID = {$id}";
    $delete_result = mysqli_query($conn, $delete_sql);

    if(!$delete_result){
        $msg = "User delete failed";
        header("Location:admin.php?msg={$msg}");
        exit;
    } else{
        $msg = "User delete successfully";
        header("Location:admin.php?msg={$msg}");
        exit;
    }
}
?>