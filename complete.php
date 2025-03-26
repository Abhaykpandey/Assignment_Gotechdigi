<?php
include "cfg/dbconnect.php";

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "UPDATE product SET status='completed' WHERE product_id='$product_id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product marked as complete!');</script>";
    } else {
        echo "<script>alert('Error updating product.');</script>";
    }
}
echo "<script>window.location='index.php';</script>";
?>
