<?php
session_start();
require_once 'config/db.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['productname'];
    $description = $_POST['productdesc'];
    $type = $_POST['producttype'];
    $img = $_FILES['img'];

    $img2 = $_POST['img2'];
    $upload = $_FILES['img']['name'];
    if ($upload != '') {
        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode(".", $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "uploads/" . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                move_uploaded_file($img['tmp_name'], $filePath);
            }
        }
    } else {
        $fileNew = $img2;
    }

    $sql = $conn->prepare("UPDATE products SET name = :name, description = :description, type = :type, image = :image WHERE id = :id");
    $sql->bindParam(':name', $name);
    $sql->bindParam(':description', $description);
    $sql->bindParam(':type', $type);
    $sql->bindParam(':image', $fileNew);
    $sql->bindParam(':id', $id);
    $sql->execute();
    if ($sql) {
        $_SESSION['success'] = "Product updated successfully";
        header('location: display_product.php');
    } else {
        $_SESSION['error'] = "Product not updated";
        header('location: display_product.php');
    }
}
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
    header("location: signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-sacle=1,maximum-scael=1">
    <title>Sermind ADMIN</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Latest compiled Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Admin-page/styles/dpstyle.css">
    <style>
        .cards {
            max-width: 550px;
            margin: auto;
        }
    </style>
</head>

<body>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>
                <sapn class="lab la-accusoft"></sapn> <span>Sermind admin</span>
            </h2>
        </div>
        <!-- Side menu  -->
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="admin_manage.php" class=""><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="" class="active"><span class="las la-shopping-bag"></span>
                        <span>Products</span></a>
                </li>
                <li>
                    <a href="orders.php" class=""><span class="las la-luggage-cart"></span>
                        <span>Orders</span></a>
                </li>
                <li>
                    <a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ'); "><span class="las la-arrow-circle-right"></span>
                        <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Top navbar -->
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>

                Products
            </h2>
            <!-- Display current account Ref from ID -->
            <div class="user-wrapper">
                <img src="1.jpg" widyh="40px" height="40px" alt="">
                <div>
                    <h4>Admin Admin</h4>
                    <small>Super admin</small>
                </div>
            </div>
            <!-- Display current account Ref from ID -->
        </header>
        <!-- Container Card -->
        <main>
            <div class="cards">

                <div class="card-single">
                    <h2>Edit Data</h2>
                    <hr>
                    <form action="edit_product.php?start=0" method="post" enctype="multipart/form-data">
                        <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $stmt = $conn->query("SELECT * FROM products WHERE id = $id");
                            $stmt->execute();
                            $data = $stmt->fetch();
                        }
                        ?>
                        <div class="mb-3">
                            <input type="text" readonly value="<?php echo $data['id']; ?>" require class="form-control" name="id">
                            <label for="productname" class="col-form-label">Product Name:</label>
                            <input type="text" value="<?php echo $data['name']; ?>" require class="form-control" name="productname">
                            <input type="hidden" value="<?php echo $data['image']; ?>" require class="form-control" name="img2">
                        </div>
                        <div class="mb-3">
                            <label for="productdesc" class="col-form-label">Description:</label>
                            <input type="text" value="<?php echo $data['description']; ?>" require class="form-control" name="productdesc">
                        </div>
                        <div class="mb-3">
                            <label for="producttype" class="col-form-label">Type:</label>
                            <select require class="form-control" name="producttype" id="producttype">
                                <option value="">Select type</option>
                                <option value="CFequipment" <?php if ($data['type'] == 'CFequipment') {
                                                                echo 'selected';
                                                            } ?>>CFequipment</option>
                                <option value="CFroaster" <?php if ($data['type'] == 'CFroaster') {
                                                                echo 'selected';
                                                            } ?>>CFroaster</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="col-form-label">Image:</label>
                            <input type="file" class="form-control" id="imgInput" name="img">
                            <img width="100%" src="../Admin-page/uploads/<?php echo $data['image']; ?>" alt="">
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" href="display_product.php">Go Back</a>
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        </div>
                    </form>
                    <!-- Fetch data from database -->


                </div>
                <!-- JavaScript Bundle with Popper -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
                </script>
                <script>
                    let imgInput = document.getElementById('imgInput');
                    let previewImg = document.getElementById('previewImg');

                    imgInput.onchange = evt => {
                        const [file] = imgInput.files;
                        if (file) {
                            previewImg.src = URL.createObjectURL(file)
                        }
                    }
                </script>
                <!-- Fetch data from database -->

            </div>
            <!-- Fetch data from database -->
    </div>
    </div>

    </main>
    </div>


</body>

</html>