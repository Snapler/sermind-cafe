<?php
session_start();
require 'dbconnect.php';

if (isset($_SESSION['user_login'])) {
    $uid = $_SESSION['user_login'];
    $sql = "SELECT * FROM users WHERE uid = '$uid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['id'])) {
    $uid = $_SESSION['user_login'];
    $id = $_POST['id'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
    $pqty = $_POST['pqty'];
    $total_price = $pprice * $pqty;

    $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
    $stmt->bind_param('s', $pcode);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['product_code'] ?? '';

    if (!$code) {
        $query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code, uid) VALUES (?,?,?,?,?,?,?)');

        $query->bind_param('sisiiss', $pname, $pprice, $pimage, $pqty, $total_price, $pcode, $uid);
        $query->execute();


        echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
    }
}

// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    $stmt = $conn->prepare('SELECT * FROM cart');
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart!';
    header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
    $stmt = $conn->prepare('DELETE FROM cart');
    $stmt->execute();
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Item removed from the cart!';
    header('location:cart.php');
}


// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
    $pqty = $_POST['qty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];

    $tprice = $qty * $pprice;

    $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
    $stmt->bind_param('isi', $pqty, $tprice, $pid);
    $stmt->execute();
}
if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
    $uid = $_SESSION['user_login'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];
    $address = $_POST['address'];
    $pmode = $_POST['pmode'];
    $order_id = mt_rand(1000000000, 9999999999);

    $data = '';

    $stmt = $conn->prepare("INSERT INTO orders (name, email, phone, address, pmode, products, amount_paid, order_id, uid) VALUE (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssss", $name, $email, $phone, $address, $pmode, $products, $grand_total, $order_id, $uid);
    $stmt->execute();
    $data .= ' <div class="text-center">
                    <h1 class="display-4 mt-2 text-danger">Thank you for shopping with us!</h1>
                    <h2 class="text-success">Your Order has been Placed!</h2>
                    <h4 class="bg-danger text-light rounded p-2"> Items Purchased : ' . $products . '</h4>
                    <h4>Your Order ID is : ' . $order_id . '</h4>
                    <h4> Your Email : ' . $email . '</h4>
                    <h4> Your Name : ' . $name . '</h4>
                    <h4> Your Phone : ' . $phone . '</h4>
                    <h4> Total Amount Paid : ' . number_format($grand_total, 2) . '</h4>
                    <h4> Payment Method : ' . $pmode . '</h4>
                    <h4>Your Order will be delivered to you within 2-3 working days.</h4>
                </div>';
    echo $data;

    $stmt = $conn->prepare('DELETE FROM cart');
    $stmt->execute();
}
