<?php

session_start();
require_once 'config/db.php';


if (isset($_POST['submit'])) {
    $productname = $_POST['productname'];
    $productdesc = $_POST['productdesc'];
    $producttype = $_POST['producttype'];
    $img = $_FILES['img'];

    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode(".", $img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "uploads/" . $fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
            if (move_uploaded_file($img['tmp_name'], $filePath)) {
                $sql = $conn->prepare("INSERT INTO products (name, description, type, image) VALUES (:name, :description, :type, :image)");
                $sql->bindParam(':name', $productname);
                $sql->bindParam(':description', $productdesc);
                $sql->bindParam(':type', $producttype);
                $sql->bindParam(':image', $fileNew);
                $sql->execute();

                if ($sql) {
                    $_SESSION['success'] = "Product added successfully";
                    header('location: display_product.php');
                } else {
                    $_SESSION['error'] = "Product not added";
                    header('location: display_product.php');
                }
            }
        }
    }
}
