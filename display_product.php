<?php
session_start();
require_once 'config/db.php';


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM products WHERE id = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Product deleted successfully')</script>";
        $_SESSION['success'] = "Product deleted successfully";
        header("refresh:1; url=display_product.php");
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
                    <!-- Fetch data from database -->
                    <?php
                    $numperpage = 3;
                    $countsql = $conn->prepare("SELECT COUNT(id) FROM products ");
                    $countsql->execute();
                    $row = $countsql->fetch();
                    $numrecords = $row[0];

                    $numlinks = ceil($numrecords / $numperpage);
                    // echo "Number of page : " . $numlinks;
                    isset($_GET['start']) ? $page = $_GET['start'] : $page = "";
                    if (!$page) $page = 0;
                    $start = $page * $numperpage;
                    // echo "Start is : " . $start;
                    // Show all product from database
                    $sql = "SELECT * FROM products limit $start,$numperpage";

                    $stmt = $conn->query($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $image = $row['image'];
                        $description = $row['description'];
                        $type = $row['type'];

                    ?>

                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success">
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                        <div class="card">
                            <div class="card-image">
                                <img width="40%" src="../Admin-page/uploads/<?php echo $image; ?>" alt="">
                            </div>

                            <h3><?php echo $name; ?></h3>
                            <p><?php foreach (explode(',', $row['description']) as $description) { ?></p>
                            <li class="list-style" style="font-size:12px"><?php echo htmlspecialchars($description) ?>
                            <?php } ?>
                            <div class="card-action">
                                <a href="edit_product.php?id=<?php echo $id; ?>">
                                    <span class="las la-edit"></span>
                                </a>
                                <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $id; ?>">
                                    <span class=" las la-trash-alt"></span>
                                </a>
                            </div>
                        </div>

                    <?php


                    }
                    // $numperpage * $start;
                    for ($i = 0; $i < $numlinks; $i++) {
                        $y = $i + 1;
                        echo '<a href="display_product.php?start=' . $i . '">   ' . $y . '</a>';
                    }
                    ?>
                    <!-- Fetch data from database -->



                    <?php
                    $sql = "SELECT type FROM products limit 2";
                    try {
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                    } catch (PDOException $e) {
                        echo ($e->getMessage());
                    }
                    ?>
                    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add products</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="insert.php" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="productname" class="col-form-label">Product Name:</label>
                                            <input type="text" require class="form-control" name="productname">
                                        </div>
                                        <div class="mb-3">
                                            <label for="productdesc" class="col-form-label">Description:</label>
                                            <input type="text" require class="form-control" name="productdesc">
                                        </div>
                                        <div class="mb-3">
                                            <label for="producttype" class="col-form-label">Type:</label>
                                            <select require class="form-control" name="producttype" id="producttype">
                                                <option value="">Select type</option>
                                                <option value="CFequipment">CFequipment</option>
                                                <option value="CFroaster">CFroaster</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="img" class="col-form-label">Image:</label>
                                            <input type="file" require class="form-control" id="imgInput" name="img">
                                            <img width="100%" id="previewImg" alt="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-success">submit</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div>

                        <button class="add-menu" data-bs-toggle="modal" data-bs-target="#productModal">
                            Add Products
                        </button>
                    </div>


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