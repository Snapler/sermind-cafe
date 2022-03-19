<?php
session_start();
require_once 'config/db.php';



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
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../Admin-page/styles/style.css">
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
                    <a href="" class="active"><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="display_product.php"><span class="las la-shopping-bag"></span>
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

                Dashboard
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
                <?php
                $sql = $conn->prepare("SELECT COUNT(id) FROM products ");
                $sql->execute();
                $row = $sql->fetch();
                $numrecords = $row[0]; ?>
                <div class="card-single">
                    <!-- Fetch data from database -->
                    <div>
                        <h1> <?php echo $numrecords ?> </h1>
                        <span>Current Products</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>



                <!-- Fetch data from database -->


            </div>

            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Recent Added Products</h3>

                            <button>See all <span class="las la-arrow-right"></span></button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Product Title</td>
                                            <td>Type</td>
                                            <td>Added By</td>
                                        </tr>
                                    </thead>
                                    <?php
                                    $sql = "SELECT * FROM products RIGHT JOIN users ON users.urole = users.urole WHERE urole = 'admin'";
                                    $result = $conn->query($sql);

                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $image = $row['image'];
                                        $description = $row['description'];
                                        $type = $row['type'];
                                        $urole = $row['urole'];
                                    ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $type; ?></td>
                                                <td>
                                                    <span class=""></span>
                                                    <?php echo $urole ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fetch data from database -->
    </div>
    </div>

    </main>
    </div>


</body>

</html>