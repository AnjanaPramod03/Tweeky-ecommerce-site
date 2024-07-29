<?php
// Include configuration file and database connection
include('config.php');

// Fetch products grouped by category
$stmt = $pdo->query("SELECT * FROM Products ORDER BY category");

// Initialize arrays to store products for each category
$categories = ['men', 'women', 'kids', 'accessories'];
$productsByCategory = array_fill_keys($categories, []);

// Organize products by category
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $productsByCategory[$row['category']][] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Tweeky Ecommerce </title>


    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

    </head>
    
    <body>
    
  
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
 
    
    
    
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        
                        <a href="index.php" class="logo">
                            <img src="image/1.png">
                        </a>
                        
                        
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#men">Men's</a></li>
                            <li class="scroll-to-section"><a href="#women">Women's</a></li>
                            <li class="scroll-to-section"><a href="#kids">Kid's</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Pages</a>
                                <ul>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="products.php">Products</a></li>
                                    
                                    <li><a href="contact.php">Contact Us</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="login.php"><b>Login</b></a></li>
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
    

    
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>We Are Tweeky </h4>
                                <span>Stylish apparel  &amp; every occasion.</span>
                                <div class="main-border-button">
                                    
                                </div>
                            </div>
                            <img src="assets/images/left-banner-image.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Women</h4>
                                            <span>Best Clothes For Women</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Women</h4>
                                                <p>Discover elegant, comfortable, and versatile styles.</p>
                                                <div class="main-border-button">
                                                    <a href="products.html">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/baner-right-image-01.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Men</h4>
                                            <span>Best Clothes For Men</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Men</h4>
                                                <p>Discover refined, comfortable, and versatile men's fashion.</p>
                                                <div class="main-border-button">
                                                    <a href="products.html">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/baner-right-image-02.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Kids</h4>
                                            <span>Best Clothes For Kids</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Kids</h4>
                                                <p>Uncover playful, comfortable, and durable kids' fashion</p>
                                                <div class="main-border-button">
                                                    <a href="products.html">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/baner-right-image-03.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Accessories</h4>
                                            <span>Best Trend Accessories</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Accessories</h4>
                                                <p>Find trendy, chic, and unique accessories.</p>
                                                <div class="main-border-button">
                                                    <a href="single-product.html">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/baner-right-image-04.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <section class="section" id="men">
        <!-- Men's Latest Section Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Men's Latest</h2>
                        <span>Discover refined, comfortable, and versatile men's Fashion</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                            <?php foreach ($productsByCategory['men'] as $product): ?>
                                <div class="item">
                                    <!-- Product HTML Content -->
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <ul>
                                            <li><a href="single-product.php?product_id=<?php echo $product['product_id']; ?>"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.php?product_id=<?php echo $product['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <img src="uploads/<?php echo $product['image_url']; ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4><?php echo $product['name']; ?></h4>
                                        <span>Rs.<?php echo $product['price']; ?></span>
                                        <!-- Add more product details as needed -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 

    <section class="section" id="women">
        <!-- Women's Latest Section Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Women's Latest</h2>
                        <span>Discover elegant, comfortable, and versatile styles.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="women-item-carousel">
                        <div class="owl-women-item owl-carousel">
                            <?php foreach ($productsByCategory['women'] as $product): ?>
                                <div class="item">
                                    <!-- Product HTML Content -->
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <ul>
                                            <li><a href="single-product.php?product_id=<?php echo $product['product_id']; ?>"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.php?product_id=<?php echo $product['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <img src="<?php echo $product['image_url']; ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4><?php echo $product['name']; ?></h4>
                                        <span>Rs.<?php echo $product['price']; ?></span>
                                        <!-- Add more product details as needed -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section" id="kids">
        <!-- Kids' Latest Section Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Kid's Latest</h2>
                        <span>Uncover playful, comfortable, and durable kids' fashion.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kid-item-carousel">
                        <div class="owl-kid-item owl-carousel">
                            <?php foreach ($productsByCategory['kids'] as $product): ?>
                                <div class="item">
                                    <!-- Product HTML Content -->
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <ul>
                                            <li><a href="single-product.php?product_id=<?php echo $product['product_id']; ?>"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.php?product_id=<?php echo $product['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <img src="<?php echo $product['image_url']; ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4><?php echo $product['name']; ?></h4>
                                        <span>Rs.<?php echo $product['price']; ?></span>
                                        <!-- Add more product details as needed -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section" id="explore">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <h2>Explore Our Products</h2>
                        <span> </span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i><p>.</p>
                        </div>
                        <p>Join us at Tweeky for an urban fashion journey like no other. Dive into our curated collection of streetwear, where every piece exudes urban sophistication and edgy flair. From graphic tees to sleek hoodies, our range caters to modern trendsetters. Explore bold prints, unexpected textures, and cutting-edge designs that speak to your individuality</p>
                        <p>Our team of fashion experts is here to guide you, ensuring a seamless shopping experience tailored to your unique style. With inclusive sizing and styles for all, there's something for everyone at [Store Name]. Don't wait – discover the thrill of street-inspired fashion today!<a rel="nofollow" href="https://paypal.me/templatemo" target="_blank">support us</a> a little via PayPal. Please also tell your friends about our storeThank you.</p>
                        <div class="main-border-button">
                            <a href="products.html">Discover More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="leather">
                                    <h4>Leather Bags</h4>
                                    <span>Latest Collection</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="first-image">
                                    <img src="assets/images/explore-image-01.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="second-image">
                                    <img src="assets/images/explore-image-02.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="types">
                                    <h4>Different Types</h4>
                                    <span>Over 304 Products</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

  
    
    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img src="image/Untitled design.png" alt="tweekystore ecommerce ">
                        </div>
                        <ul>
                            <li><a href="#">no 325 Avissawella road colombo, Srilanka</a></li>
                            <li><a href="#">tweekystore@gmail.com</a></li>
                            <li><a href="#">0761798944</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Shopping &amp; Categories</h4>
                    <ul>
                        <li><a href="#">Men’s Shopping</a></li>
                        <li><a href="#">Women’s Shopping</a></li>
                        <li><a href="#">Kid's Shopping</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Homepage</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Help &amp; Information</h4>
                    <ul>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Tracking ID</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2024 Tweekystore Co., Ltd. All Rights Reserved. 
                        
                        
                        </p>
                        <ul>
                            <li><a href="https://www.facebook.com/anjana.promode"><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/slick.js"></script> 
    <script src="assets/js/lightbox.js"></script> 
    <script src="assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

  </body>
</html>