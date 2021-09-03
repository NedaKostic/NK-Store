 <!---------------- INCLUDE HEAD and FILES ----------->
 <?php include_once("../inc/_head.php"); ?>

 <!------------ INCLUDE CUSTOM JS FILES -------------->
 <script src="assets/js/cart.js" defer></script>

 <!------------------INCLUDE HEADER ------------------>
 <?php include_once("../inc/_header.php"); ?>


 <!--------------------- MAIN --------------------------->
 <main id="main-cart">

     <section class="container">
         <?php if (login()) { ?>
             <div id='cart-message'></div>
             <div id="cart"></div>
             <div id="cart-bottom"></div>
         <?php
            } else echo "<div class='cart-notice'><p>You must be logged in to buy products!</p>
                <a href='products'>Check our products here <i class='fas fa-angle-double-right'></i></a></div>";
            ?>
     </section>
 </main>


 <!----------------------- INCLUDE FOOTER ----------------------->
 <?php include_once("../inc/_footer.php"); ?>