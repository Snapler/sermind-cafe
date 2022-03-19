<?php
if (isset($_POST['uid'])) {
    $check_data = $conn->prepare("SELECT * FROM users WHERE uid = :uid");
    $check_data->bindParam(":uid", $_POST['uid']);
    $check_data->execute();
    $row = $check_data->fetch(PDO::FETCH_ASSOC);
    $uid = $row['uid'];
}
session_start();
require_once 'dbconnect.php';
if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE uid = '$user_id'");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['uid'];
        $user_name = $row['firstname'];
    }
}
if (isset($_SESSION['user_login'])) {
    $uid = $_SESSION['user_login'];
    $sql = "SELECT * FROM users WHERE uid = '$uid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $sql = "SELECT * FROM cart WHERE uid = '$uid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        html {
            scroll-behavior: smooth;
        }

        #drop {
            list-style: none inside;
            margin: 0;
            padding: 0;
        }

        #drop li {
            position: relative;
            cursor: pointer;
        }

        #drop li a {
            text-decoration: none;
            width: 50px;
            /* this is the width of the menu items */
            line-height: 35px;
            /* this is the hieght of the menu items */
            color: #ffffff;
            /* list item font color */
        }

        #drop li li a {
            font-size: 80%;
            width: 120px;
        }

        /* smaller font size for sub menu items */
        #drop li:hover {
            background-color: transparent;
            /* menu background color on hover */
        }

        /* highlights current hovered list item and the parent list items when hovering over sub menues */
        #drop ul {
            position: absolute;
            padding: 0;
            left: 0;
            display: none;
            /* hides sublists */
        }

        #drop li:hover ul ul {
            display: none;
        }

        /* hides sub-sublists */
        #drop li:hover ul {
            display: block;
        }

        /* shows sublist on hover */
        #drop li li:hover ul {
            display: block;
            /* shows sub-sublist on hover */
            margin-left: 200px;
            /* this should be the same width as the parent list item */
            margin-top: -35px;
            /* aligns top of sub menu with top of list item */
        }
    </style>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="dpstyles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://kit.fontawesome.com/c586632368.js" crossorigin="anonymous"></script>
    <title>All Products</title>
</head>

<body>
    <section class="header">

        <nav>
            <a href="index.php"><img src="images/SERMIND_CAFE.png" alt="" /></a>
            <div class="nav-link" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul id="drop">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="services.php">SERVICES</a></li>
                    <li><a href="display-product.php">PRODUCTS</a></li>
                    <li><a href="aboutus.php">ABOUT US</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h1>Our Products</h1>
            <h2>We have the best products for you</h2>
            <br>
            <a href="#ShowProduct" class="hero-btn">Shop Now!</a>

        </div>

    </section>

    <section class="container" id="ShowProduct">
        <div id="message"></div>
        <div class="row">
            <?php
            $stmt = $conn->prepare("SELECT * FROM products  ORDER BY type ASC limit 4 ");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) :
                $name = $row['name'];
                $desc = $row['description'];
                $image = $row['image'];
            ?>
                <div class="card-deck">
                    <img src="../Admin-page/uploads/<?php echo $row['image']; ?>" style="height: 250px; width:60%;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p style="line-height: 2%;"><?php foreach (explode(',', $row['description']) as $description) { ?></p>
                        <li class="list-style" style="font-size:12px"><?php echo htmlspecialchars($description) ?>
                        <?php } ?>
                    </div>
                    <div class="card-footer">
                        <form action="" class="form-submit">
                            <input type="hidden" class="pname" value="<?= $name; ?>">
                            <input type="hidden" class="pdesc" value="<?= $desc; ?>">
                            <input type="hidden" class="pimage" value="<?= $image ?>">
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>

        </div>
    </section>

    <!-- JavaScrupt for Toggle Menu -->
    <script>
        var navLinks = document.getElementById("navLinks");

        function showMenu() {
            navLinks.style.right = "0";
        }

        function hideMenu() {
            navLinks.style.right = "-200px";
        }
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".addItemBtn").click(function(e) {
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var id = $form.find(".id").val();
                var pname = $form.find(".pname").val();
                var pprice = $form.find(".pprice").val();
                var pimage = $form.find(".pimage").val();
                var pcode = $form.find(".pcode").val();
                var pqty = $form.find(".pqty").val();
                var uid = $form.find("uid").val();

                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: {
                        id: id,
                        pname: pname,
                        pprice: pprice,
                        pimage: pimage,
                        pcode: pcode,
                        pqty: pqty,
                        uid: uid,
                    },
                    success: function(response) {
                        $("#message").html(response);
                        window.scrollTo(0, 0);
                        load_cart_item_number();
                    }
                });
            });

            load_cart_item_number();

            function load_cart_item_number() {
                $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: {
                        cartItem: "cart_item"
                    },
                    success: function(response) {
                        $("#cart-item").html(response);
                    }
                })
            }
        });
    </script>


</body>

</html>