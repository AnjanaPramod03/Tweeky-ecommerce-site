<?php
// Include configuration file and database connection
include('config.php');

// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Fetch cart items for the logged-in user
$stmt = $pdo->prepare("SELECT cart.cart_id, products.product_id, products.name, products.price, cart.quantity FROM cart INNER JOIN products ON cart.product_id = products.product_id WHERE cart.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to calculate total price
function calculateTotalPrice($cart_items) {
    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
    return $total_price;
}

// Handle updating cart quantities
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $cart_id => $quantity) {
        $quantity = intval($quantity);
        if ($quantity <= 0) {
            // Remove item from cart if quantity is 0 or negative
            $stmt = $pdo->prepare("DELETE FROM cart WHERE cart_id = ?");
            $stmt->execute([$cart_id]);
        } else {
            // Update quantity for the item in cart
            $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ?");
            $stmt->execute([$quantity, $cart_id]);
        }
    }
    // Redirect to cart page to reflect changes
    header("Location: cart.php");
    exit();
}

// Handle checkout process
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    $total_amount = calculateTotalPrice($cart_items);
    $payment_method = $_POST['payment_method']; // You can add more fields as needed

    // Insert order into orders table
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, payment_method, payment_status) VALUES (?, ?, ?, 'Pending')");
    $stmt->execute([$user_id, $total_amount, $payment_method]);
    $order_id = $pdo->lastInsertId();

    // Insert order details into order_details table
    foreach ($cart_items as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_details (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
    }

    // Clear the cart for the user
    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Redirect to order confirmation page
    header("Location: order_confirmation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <style>
        /* Base Styling */
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            font-size: 36px;
            letter-spacing: 2px;
        }

        /* Cart Container */
        .cart {
            margin-top: 200px !important;
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            animation: fadeIn 1s ease-in-out;
        }

        .cart h1 {
            background: #007bff;
            color: white;
            padding: 20px;
            margin: 0;
            border-radius: 15px 15px 0 0;
            font-size: 28px;
        }

        /* Table Styling */
        .cart table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            table-layout: auto;
        }

        .cart table th,
        .cart table td {
            text-align: left;
            padding: 20px;
        }

        .cart table thead {
            background: #007bff;
            color: white;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cart table tbody tr {
            border-bottom: 1px solid #eaeaea;
        }

        .cart table tbody tr:last-child {
            border-bottom: none;
        }

        .cart table tbody tr:hover {
            background: #f1f1f1;
            transition: background 0.3s ease-in-out;
        }

        /* Input and Buttons Styling */
        .cart input[type="number"] {
            width: 60px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
            outline: none;
        }

        .cart input[type="number"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
        }

        .cart button,
        .cart a {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-size: 14px;
            margin: 5px;
        }

        .cart button:hover,
        .cart a:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .cart button:active,
        .cart a:active {
            background: #003d80;
            transform: translateY(0);
            box-shadow: none;
        }

        /* Total Price Styling */
        .cart h3 {
            text-align: right;
            padding: 20px;
            margin: 0;
            background: #f1f1f1;
            border-radius: 0 0 15px 15px;
            color: #333;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .cart h3 span {
            color: #007bff;
        }

        /* Form Styling */
        .cart form {
            margin: 0;
            padding: 0;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .cart {
                width: 100%;
            }

            .cart table,
            .cart table th,
            .cart table td {
                display: block;
                width: 100%;
            }

            .cart table th,
            .cart table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .cart table th::before,
            .cart table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 20px;
                font-weight: bold;
                text-align: left;
            }

            .cart table thead {
                display: none;
            }

            .cart table tbody tr {
                border-bottom: 1px solid #ddd;
                margin-bottom: 20px;
                padding-bottom: 10px;
            }

            .cart h3 {
                text-align: center;
            }
        }
    </style>
</head>
<body>
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="index.html" class="logo">
                        <img src="image/1.png">
                    </a>
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="index.php" class="active">Home</a></li>
                        <li class="scroll-to-section"><a href="index.php">Men's</a></li>
                        <li class="scroll-to-section"><a href="index.php">Women's</a></li>
                        <li class="scroll-to-section"><a href="index.php">Kid's</a></li>
                        <li class="submenu">
                            <a href="javascript:;">Pages</a>
                            <ul>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="products.php">Products</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                            </ul>
                        </li>
                        <li class="scroll-to-section"><a href="cart.php">Shopping Cart</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="cart">
    <h1>Shopping Cart</h1>
    <div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>Rs.<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <input type="number" name="quantity[<?php echo $item['cart_id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" max="99">
                            </td>
                            <td>Rs.<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <button type="submit" name="update_cart">Update</button>
                                <a href="remove_from_cart.php?cart_id=<?php echo $item['cart_id']; ?>">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
        <div>
            <h3>Total: Rs.<?php echo number_format(calculateTotalPrice($cart_items), 2); ?></h3>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
                <button type="submit" name="checkout">Checkout</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
