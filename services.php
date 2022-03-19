<?php
session_start();
require_once 'dbconnect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sermind Cafe</title>
  <link rel="stylesheet" href="service.style.css" />
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
    <h1>Our Services</h1>
  </section>
  <!-- services content -->
  <section class="services">
    <div class="row">
      <div class="services-col">
        <h3>ปรึกษาและออกแบบธีมร้าน</h3>
        <img src="images/cafe.png" alt="" width="256" height="200" />
        <p>
          <li>
            &emsp;&emsp;เรามีทีมงานคุณภาพสำหรับการปรึกษาและออกแบบธีมร้าน
            ที่สามารถตอบโจทย์ความต้องการของลูกค้าได้
          </li>
          <li>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit ut
            atque tempore, facere quis quisquam.
          </li>
        </p>
      </div>
      <div class="services-col">
        <h3>รับเหมาก่อสร้างทั้งระบบ</h3>
        <img src="images/catalogue.png" alt="" width="256" height="200" />
        <p>
          <li>
            &emsp;&emsp;เรามีทีมงานการออกแบบมืออาชีพ
            ที่สามารถให้การปรึกษาและออกแบบร้านฯ อาคารสถานที่ ฯลฯ
            ตามความต้องการของลูกค้าได้
          </li>
          <li>
            เรามีบริษัท Sermind Home ในเครือที่ทำการรับเหมาก่อสร้างทั้งระบบ
            อาคารสถานที่ฯ งานระบบต่างๆ อย่างครบวงจร ในราคาสุดคุ้มของลูกค้า
            Sermind Café
          </li>
        </p>
      </div>
      <div class="services-col">
        <h3>ปรึกษาและจำหน่ายอุปกรณ์ร้าน</h3>
        <img src="images/coffee-machine.png" alt="" width="256" height="200" />
        <p>
          <li>
            &emsp;&emsp;ให้การปรึกษาและจัดจำหน่ายอุปกรณ์สำหรับธุรกิจร้านกาแฟ
            ร้านอาหารเครื่องดื่ม ฯลฯ เช่น เครื่องชงกาแฟ อุปกรณ์บาร์
            อุปกรณ์ครัว ได้อย่างครบวงจร
            และคุ้มค่าเหมาะสมที่สุดสำหรับการทำธุรกิจของลูกค้า
          </li>
          <li>
            ให้การปรึกษาและจัดจำหน่ายวัตถุดิบต่างๆ เช่น เมล็ดกาแฟ ชา โกโก้
            ส่วนผสมเครื่องดื่ม สำหรับธุรกิจร้านกาแฟ ร้านอาหารเครื่องดื่ม ฯลฯ
            ได้อย่างครบวงจร
          </li>
        </p>
      </div>
      <div class="services-col">
        <h3>ปรึกษารูปแบบเมนูต่างๆ</h3>
        <img src="images/coffee-cup.png" alt="" width="256" height="200" />
        <p>
          <li>
            &emsp;&emsp;เรามีทีมงานมืออาชีพที่มีประสบการณ์กว่า 10 ปี
            ที่จะให้การปรึกษาและออกแบบเมนูต่างๆ ทั้งเมนูกาแฟ, เครื่องดื่ม,
            อาหาร ให้กับลูกค้าได้และ จัดทำสูตร, ต้นทุน
            สำหรับการบริหารจัดการต้นทุนต่างๆ ให้ลูกค้าได้
          </li>
        </p>
      </div>
      <div class="services-col">
        <h3>รับฝึกอบรมพนักงาน</h3>
        <img src="images/waiter.png" alt="" width="256" height="200" />
        <p>
          <li>
            &emsp;&emsp;เราจัดคอร์สการฝึกอบรมให้กับผู้ประกอบการ
            หรือพนักงานปฏิบัติงาน ได้ตามความต้องการ เช่น
            ฝึกอบรมการจัดทำกาแฟและเครื่องดื่ม, อาหาร หรือ
            การฝึกอบรมด้านการทำงานบริการต่างๆ ฯลฯ
            โดยการสอนงานจากผู้มีประสบการณ์จริงมากว่า 10 ปี
          </li>
        </p>
      </div>
    </div>
    <a href="https://forms.gle/eErvihpY2WsGcBJ17" target="_blank" class="hero-btn">รับบริการ</a>

  </section>

  <!-- Footer -->

  <section class="footer">
    <h4>About Us</h4>
    <p>
      Sermind Café ร้านกาแฟและเครื่องดื่มที่หลากหลาย
      เพื่อรองรับลูกค้าในหลากหลายกลุ่ม
      ด้วยบรรยากาศที่ร่มรื่นและมีเอกลักษณ์เฉพาะตัว
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