<?php include 'dbconnect.php';
$sql = "SELECT * FROM products WHERE type = 'CFroaster'";
$result = $conn->query($sql);

$fileArr = glob('path/*.php');

foreach ($fileArr as $val) {

  echo $val . "<br>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"" rel=" nofollow">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sermind Cafe</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style.css" />

  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>


<body>
  <section class="sub-header">
    <nav>
      <a href="index.html"><img src="images/SERMIND_CAFE.png" alt="" /></a>
      <div class="nav-link" id="navLinks">
        <i class="fa fa-times" onclick="hideMenu()"></i>
        <ul>
          <li><a href="index.html">HOME</a></li>
          <li><a href="services.html">SERVICES</a></li>
          <li><a href="products.php">PRODUCTS</a></li>
          <li><a href="aboutus.html">ABOUT US</a></li>
          <li><a href="contact.html">CONTACT</a></li>
        </ul>
      </div>
      <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>
    <h1>Our Products</h1>
  </section>
  <!-- Our Products content -->
  <section class="Products">
    <div class="cf-menu-header">


      <a id="coffeeequip" href="#" style="font-size: 34px;"> Coffee Roaster</a>

    </div>

    <div class="row">
      <div class="products-col">
        <!-- Data Fetching From Database -->
        <?php while ($row = $result->fetch_assoc()) : ?>
          <ul></ul>
          <img src="../Admin-page/uploads/<?php echo $row['image']; ?>" alt="" width="150" height="250" />
          <h3><?php echo $row['name'] ?></h3>
          <?php foreach (explode(',', $row['description']) as $desc) { ?>
            <li><?php echo htmlspecialchars($desc) ?></li>
          <?php } ?>
          <!-- Data Fetching From Database -->
      </div>

      <div class=" products-col">


      <?php endwhile ?>

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