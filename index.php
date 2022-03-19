<?php
session_start();
require_once 'dbconnect.php';

?>

<!DOCTYPE html>
<html>

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
  <section class="header" id="#headimg">
    <nav>
      <a href="index.php"><img src="images/SERMIND_CAFE.png" alt="" /></a>
      <div class="nav-link" id="navLinks">
        <i class="fa fa-times" onclick="hideMenu()"></i>
        <ul id="drop">
          <li><a href="index.php">HOME</a></li>
          <li><a href="services.php">SERVICES</a></li>
          <li><a href="#products">PRODUCTS</a></li>
          <li><a href="aboutus.html">ABOUT US</a></li>
          <li><a href="contact.html">CONTACT</a></li>

        </ul>
      </div>
      <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>

    <div class="text-box">
      <h1>One Stop Service Cafe</h1>
      <p>
        Sermind Café คือรูปแบบของ One Stop Service
        ทางเลือกหนึ่งของผู้ประกอบการที่ต้องการทำธุรกิจร้านกาแฟ
        ร้านอาหารเครื่องดื่ม <span>เรามีทีมงานคุณภาพสำหรับการปรึกษาการทำธุรกิจ
          ที่สามารถตอบโจทย์ความต้องการของลูกค้าได้
      </p>
      </span>
      <a href="" class="hero-btn">Visit Us to Know More</a>
    </div>
  </section>

  <!-- Services -->
  <section class="services">
    <h1>Our Services</h1>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad architecto
      odio quisquam libero placeat hic at ipsa, porro excepturi facere.
    </p>
    <div class="row">
      <div class="services-col">
        <h3>ปรึกษาและออกแบบธีมร้าน</h3>
        <p>
          เรามีทีมงานการออกแบบมืออาชีพ ที่สามารถให้การปรึกษาและออกแบบร้านฯ
          อาคารสถานที่ ตามความต้องการของลูกค้าได้
        </p>
      </div>
      <div class="services-col">
        <h3>รับเหมาก่อสร้างทั้งระบบ</h3>
        <p>
          เรามีบริษัท Sermind Home ในเครือที่ทำการรับเหมาก่อสร้างทั้งระบบ
          อาคารสถานที่ฯ ระบบต่างๆ อย่างครบวงจร ในราคาสุดคุ้มของลูกค้า Sermind
          Café
        </p>
      </div>
      <div class="services-col">
        <h3>ปรึกษาและจำหน่ายอุปกรณ์ร้าน</h3>
        <p>
          ให้การปรึกษาและจัดจำหน่ายอุปกรณ์สำหรับธุรกิจร้านกาแฟ
          ร้านอาหารเครื่องดื่ม เช่น เครื่องชงกาแฟ อุปกรณ์บาร์ เมล็ดกาแฟ ชา
          โกโก้
        </p>
      </div>
      <div class="services-col">
        <h3>ปรึกษารูปแบบเมนูต่างๆ</h3>
        <p>
          เรามีทีมงานมืออาชีพที่มีประสบการณ์กว่า 10 ปี
          ที่จะให้การปรึกษาและออกแบบเมนูต่างๆ ทั้งเมนูกาแฟ, เครื่องดื่ม, อาหาร
          ตามความต้องการของลูกค้าได้
        </p>
      </div>
      <div class="services-col">
        <h3>รับฝึกอบรมพนักงาน</h3>
        <p>
          เราคอร์สฝึกอบรมให้กับผู้ประกอบการ หรือพนักงานปฏิบัติงาน
          ได้ตามความต้องการ จากผู้มีประสบการณ์จริงมากว่า 10 ปี
        </p>
      </div>
    </div>
  </section>

  <!-- Products -->
  <section class="Products " id="products">
    <h1>Our Products</h1>
    <p>
      จัดจำหน่ายวัตถุดิบต่าง ๆ เช่น เมล็ดกาแฟ ชา โกโก้ ส่วนผสมเครื่องดื่ม สำหรับธุรกิจร้านกาแฟ ร้านอาหารเครื่องดื่ม ฯลฯ ได้อย่างครบวงจร
    </p>
    <div class="row">
      <div class="Products-col">
        <a href="display-product.php">
          <img src="images/CoffeMachine.png" />
          <div class="layer">
            <h3>Coffee Machine</h3>
          </div>
        </a>
      </div>
      <div class="Products-col">
        <a id="coffeeroaster" href="coffee-roaster.php">
          <img src="images/coffee-pack.png" />
          <div class="layer">
            <h3>Coffee Roaster</h3>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-- Affiliates -->

  <section class="Affiliates">
    <h1>Our Affiliates</h1>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit
      sapiente alias, ad labore itaque rerum.
    </p>

    <div class="row">
      <div class="Affiliates-col">
        <img src="images/gggg.png" />
        <h3>Our Chains Supply</h3>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam ad
          deserunt porro facere enim quos?
        </p>
      </div>
      <div class="Affiliates-col">
        <img src="images/SERMIND_CAFE.png" />
        <h3>Sermind Tech</h3>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam ad
          deserunt porro facere enim quos?
        </p>
      </div>
      <div class="Affiliates-col">
        <img src="images/SERMIND_CAFE.png" />
        <h3>Sermind Home</h3>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam ad
          deserunt porro facere enim quos?
        </p>
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
      <i class="fa fa-instagram"></i>
      <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
      <i class="fa-solid fa-cart-shopping"></i>
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