 <?php
    session_start();
    require_once 'dbconnect.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ";
        header("location: signin.php");
    }
    if (isset($_POST['signout'])) {
        session_destroy();
        header("location: signin.php");
    }
    if (isset($_SESSION['user_login'])) {
        $uid = $_SESSION['user_login'];
        $sql = "SELECT * FROM users WHERE uid = '$uid'";
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
     <link rel="stylesheet" href="cart.style.css" />
     <link rel="preconnect" href="https://fonts.googleapis.com" />
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
     <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
     <script src="https://kit.fontawesome.com/c586632368.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
     <!-- jQuery library -->
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <!-- Latest compiled Bootstrap JS-->
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
     <title>All Products</title>
 </head>

 <body>
     <?php
        if (isset($_SESSION['user_login'])) {
            $user_id = $_SESSION['user_login'];
            $stmt = $conn->prepare("SELECT * FROM users WHERE uid = $user_id");
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $user_id = $row['uid'];
                $user_name = $row['firstname'];
            }
        }
        ?>
     <section class="header">
         <nava>
             <a href="index.html"><img src="images/SERMIND_CAFE.png" alt="" /></a>
             <div class="navs-link" id="navLinks">
                 <i class="fa fa-times" onclick="hideMenu()"></i>
                 <ul id="drop">
                     <li><a href="index.php">HOME</a></li>
                     <li><a href="services.php">SERVICES</a></li>
                     <li><a href="display-product.php">PRODUCTS</a></li>
                     <li><a href="aboutus.php">ABOUT US</a></li>
                     <li><a href="contact.php">CONTACT</a></li>
                     <li><a class="icons" href="cart.php"><i class="fa-solid fa-cart-shopping  fa-xl"></i> <span id="cart-item" class="fa-solid fa-badge"></span></a></li>
                     <li><a><?php if (isset($_SESSION['user_login'])) {
                                echo $user_name;
                            } else {
                                echo '<a href="signin.php">SIGN IN</a>';
                            } ?></a>
                         <ul>
                             <?php if (isset($_SESSION['user_login'])) { ?>
                                 <li><a href="user_panel.php">Orders</a></li>
                                 <li><a href="logout.php">Logout</a></li>
                             <?php } ?>
                         </ul>
                 </ul>
             </div>
             <i class="fa fa-bars" onclick="showMenu()"></i>
         </nava>
         <div class="text-box">
             <h1>Your Placed Orders</h1>
             <h2>You can fine your placed order here</h2>
             <br>


         </div>
     </section>

     <section class="container" id="ShowProduct">
         <div class="row justify-content-center">
             <div class="card-body">
                 <div class="table-responsive">
                     <table width="100%">
                         <thead>
                             <tr>
                                 <td>ชื่อ</td>
                                 <td>รายการสินค้า</td>
                                 <td>ราคารวม</td>
                                 <td>รูปแบบการชำระเงิน</td>
                                 <td>รหัสติดตามสินค้า</td>

                             </tr>
                         </thead>
                         <?php
                            $sql = "SELECT * FROM orders WHERE uid = $user_id";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $user_id = $row['uid'];
                                $name = $row['name'];
                                $product = $row['products'];
                                $amount_paid = $row['amount_paid'];
                                $pmode = $row['pmode'];
                                $tracking_code = $row['tracking_code'];
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $user_name = $row['firstname'];
                                }
                            ?>
                             <?php  ?>
                             <tbody>
                                 <tr>
                                     <td><?php echo $name; ?></td>
                                     <td><?php echo $product; ?></td>
                                     <td><?php echo number_format($amount_paid, 2); ?></td>
                                     <td style="text-align: center;"><?php echo $pmode; ?></td>
                                     <td><?php echo $tracking_code; ?></td>
                                     <td><?php echo $user_id; ?></td>
                                 </tr>
                             </tbody>
                         <?php } ?>
                     </table>
                 </div>
             </div>

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
                 });
             }
         });
     </script>
 </body>

 </html>