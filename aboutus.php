<?php
session_start();
require_once 'dbconnect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <style>
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
  <title>Sermind Cafe</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
  <?php
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
  ?>
  <section class="sub-header">
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
    <h1>About Us</h1>
  </section>
  <!-- about us content -->
  <section class="about-us">
    <div class="row">
      <div class="about-col">
        <h1>We are Global</h1>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis
          voluptatibus voluptates obcaecati ut nobis soluta? Aliquam commodi
          delectus odit voluptatibus voluptates, non itaque minima quibusdam.
          Rem delectus maxime a laboriosam esse voluptatibus eos et numquam
          consequuntur omnis voluptas ea fuga, nam quaerat consectetur
          expedita voluptatem soluta voluptate odit nihil laborum!
        </p>
        <a href="" class="hero-btn red-btn">Explore Now</a>
      </div>
      <div class="about-col">
        <img src="images/about.jpg" />
      </div>
    </div>
  </section>
  <!-- Footer -->

  <section class="footer">
    <h4>About Us</h4>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias
      architecto mollitia fugiat sapiente magnam explicabo.
    </p>
    <div class="icons">
      <i class="fa fa-facebook"></i>
      <i class="fa fa-youtube-play"></i>
    </div>
    <p></p>
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
</body>

</html>