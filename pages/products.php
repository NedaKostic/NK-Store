 <!---------------- INCLUDE HEAD and FILES ----------->
 <?php include_once("../inc/_head.php"); ?>

 <!------------------INCLUDE HEADER ------------------>
 <?php include_once("../inc/_header.php"); ?>

 <!----------------------- HERO ----------------------->
 <div id="hero">
     <img src="assets/images/hero_03.jpg" alt="hero03">
 </div>


 <!---------pagination---------->
 <?php
    $sql = "SELECT * FROM product WHERE is_active = 1 ORDER BY product_id ASC";
    $result = $db->query($sql);

    //find the total number of results stored in the database 
    $num_items = 6;   //on the page
    $number_of_results = $db->num_rows($result);

    //determine the total number of pages available  
    $total_pages = ceil($number_of_results / $num_items);

    //determine which page number visitor is currently on
    if (!isset($_GET['page']))
        $page = 1;
    else
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);

    //determine the sql LIMIT starting number for the results on the displaying page  
    $on_this_page = ($page - 1) * $num_items;

    $sql = "SELECT * FROM product WHERE is_active = 1 ORDER BY product_id ASC LIMIT " . $on_this_page . "," . $num_items;
    if (isset($_GET['category'])) $sql = "SELECT * FROM product WHERE is_active = 1 AND category_id=" . $_GET['category'];
    $result = $db->query($sql);

    if ($db->error()) {
        echo "Error";
        exit();
    }

    ?>

 <!----------------------- MAIN ----------------------->
 <main>
     <div class="container">
         <h2>OUR PRODUCTS</h2>
         <section class="products">
             <?php
                while ($row = $db->fetch_object($result)) {
                ?>
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
         </section> <!-- end of .products -->


         <!----------------------- PAGINATION ----------------------->
         <div id="pagination">
             <?php

                if (!isset($_GET['category'])) {
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $page)    //current page
                            echo "<a class='active' href='products?page=" . $i . "'>" . $i . "</a> ";
                        else //show link to other page  
                            echo "<a href='products?page=" . $i . "'>" . $i . "</a> ";
                    }
                }
                ?>
         </div> <!-- end of #pagination -->
     </div> <!-- end of .container -->
 </main>


 <!-- INCLUDE FOOTER -->
 <?php include_once("../inc/_footer.php"); ?>