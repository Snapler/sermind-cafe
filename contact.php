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
    <h1>Contact Us</h1>
  </section>
  <!-- contact us content -->

  <section class="location">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d242.09378614492377!2d100.4119884363461!3d13.86899023331832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e291a38ab83c01%3A0xe4b643906c185579!2z4Lia4Lij4Li04Lip4Lix4LiX4LmC4LiB4Lil4Lia4Lit4LilMjA1ICjguJvguKPguLDguYDguJfguKjguYTguJfguKIpIOC4iOC4s-C4geC4seC4lA!5e0!3m2!1sth!2sth!4v1641290512167!5m2!1sth!2sth" width="480" height="400" allowfullscreen="" loading="lazy"></iframe>
  </section>

  <section class="contact-us">
    <div class="row">
      <div class="contact-col">
        <div>
          <i class="fa fa-home"></i>
          <span>
            <h5>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio,
              asperiores!
            </h5>
            <p>Lorem ipsum dolor sit amet.</p>
          </span>
        </div>
        <div>
          <i class="fa fa-phone"></i>
          <span>
            <h5>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor,
              iste.
            </h5>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
          </span>
        </div>
        <div>
          <i class="fa fa-envelope-o"></i>
          <span>
            <h5>Lorem ipsum dolor sit amet consectetur adipisicing.</h5>
            <p>Lorem ipsum dolor sit amet.</p>
          </span>
        </div>
      </div>
      <div class="contact-col">
        <form action="/form-handler.php" method="post">
          <input type="text" name="name" placeholder="Enter your name" required />
          <input type="email" name="email" placeholder="Enter email address" required />
          <input type="text" name="subject" placeholder="Enter your subject" required />
          <textarea rows="8" name="message" placeholder="Message" required></textarea>
          <button type="submit" class="hero-btn red-btn">Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->

  <section class="footer">
    <h4>About Us</h4>
    <p>
      Sermind Café ร้านกาแฟและเครื่องดื่มที่หลากหลาย เพื่อรองรับลูกค้าในหลากหลายกลุ่ม ด้วยบรรยากาศที่ร่มรื่นและมีเอกลักษณ์เฉพาะตัว
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