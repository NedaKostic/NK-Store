<?php
session_start();
require_once("class/classDatabase.php");
require_once("functions/general.php");
$db = new Database();
if (!$db->connect()) exit("Connection failed");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NK STORE</title>

    <link rel="icon" href="favicon.ico">

    <!------------ INCLUDE CSS Custom File -------------->
    <link rel="stylesheet" href="assets/css/style.css">

    <!---------------- Font Awesome ---------------------->
    <script src="https://kit.fontawesome.com/ff8c852e02.js" crossorigin="anonymous"></script>

    <!---------------------- JQuery ---------------------->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!------------ INCLUDE CUSTOM JS FILES -------------->
    <script src="assets/js/main.js" defer></script>
    <script src="assets/js/cartNum.js" defer></script>
    <script src="assets/js/search.js" defer></script>

    <!------------ INCLUDE CUSTOM JS FILES -------------->
    <script src="assets/js/slider.js"></script>

    <!------------------INCLUDE HEADER ------------------>
    <?php include_once("inc/_header.php"); ?>


    <!----------------------- HERO ----------------------->
    <div id="hero-slider">
        <ul id="slider">
            <li>
                <img src="assets/images/slide_01.jpg" alt="slide01">
                <section class="text-content">
                    <h4>Welcome to NK Store</h4>
                    <h2>Experience the lifestyle</h2>
                </section>
            </li>
            <li>
                <img src="assets/images/slide_02.jpg" alt="slide02">
                <section class="text-content">
                    <h4>New arrivals</h4>
                    <h2>Check our latest collection</h2>
                </section>
            </li>
            <li>
                <img src="assets/images/slide_03.jpg" alt="slide03">
                <section class="text-content">
                    <h4>Best quality</h4>
                    <h2>Only high-quality materials</h2>
                </section>
            </li>
            <li>
                <img src="assets/images/slide_04.jpg" alt="slide04">
                <section class="text-content">
                    <h4>Flash deal</h4>
                    <h2>Grab the best deal</h2>
                </section>
            </li>
        </ul>

        <ol id="circles">
        </ol>

        <div id="left">
            <i class="fas fa-angle-left"></i>
        </div>

        <div id="right">
            <i class="fas fa-angle-right"></i>
        </div>

    </div>
    <!--end of #hero-slider -->


    <!--------------------- MAIN --------------------------->
    <main>
        <div class="container">
            <h2>LATEST PRODUCTS</h2>
            <?php
            $sql = "SELECT * FROM product WHERE is_active = 1 ORDER BY product_id DESC LIMIT 6";
            $result = $db->query($sql);
            if ($db->error()) {
                echo "Error";
                exit();
            }
            ?>

            <section class="products">
                <?php while ($row = $db->fetch_object($result)) { ?>
                    <article class="product">
                        <?php $sql1 = "SELECT * FROM product_image WHERE product_id = $row->product_id";
                        $result1 = $db->query($sql1);
                        while ($row1 = $db->fetch_object($result1)) {
                        ?>
                            <img src='assets/images/products/<?= $row1->product_image_name; ?>' alt='Product image'> <?php } ?>
                        <h3>
                            <span><?= $row->product_name; ?></span><span>
                                <a href='<?= $row->product_id; ?>'><i class='fas fa-angle-double-right'></i></a></span>
                        </h3>
                        <h4>&euro; <?= $row->product_price; ?></h4>
                        <p><?= $row->product_description; ?></p>
                    </article>
                <?php } ?>
            </section>
            <!--end of .products -->

            <section id="why">
                <h2>WHY WE ARE THE BEST?</h2>
                <article>
                    <i class="fas fa-shipping-fast"></i>
                    <h5>ON TIME DELIVERY</h5>
                </article>
                <article>
                    <i class="fas fa-phone-alt"></i>
                    <h5>24/7 LIVE SUPPORT</h5>
                </article>
                <article>
                    <i class="fas fa-percent"></i>
                    <h5>WEEKLY DEALS</h5>
                </article>
                <article>
                    <i class="fas fa-store-alt"></i>
                    <h5>MULTI-LOCATION STORES</h5>
                </article>
                <article>
                    <i class="fas fa-gift"></i>
                    <h5>LOYALITY PROGRAM</h5>
                </article>
            </section>
            <!--end of #why -->

        </div>
        <!--end of .container -->
    </main>


    <!----------------------- INCLUDE FOOTER ----------------------->
    <?php include_once("inc/_footer.php"); ?>