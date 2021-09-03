<!---------------- INCLUDE HEAD and FILES ----------->
<?php include_once("../inc/_head.php"); ?>

<!------------ INCLUDE CUSTOM JS FILES -------------->
<script src="assets/js/singleproduct.js" defer></script>
<script src="assets/js/review.js" defer></script>
<script src="assets/js/sizeQty.js" defer></script>
<script src="assets/js/cart.js" defer></script>

<!------------------INCLUDE HEADER ------------------>
<?php include_once("../inc/_header.php"); ?>

<!--------------------- MAIN --------------------------->
<main>

    <section id="singleproduct" class="small-container">

        <article id="product-overview">

            <?php
            if (isset($_GET['id']))
                $sql = "SELECT * FROM view_all_products WHERE is_active=1 AND quantity>0 AND product_id=" . $_GET['id'];

            $result = $db->query($sql);
            if ($db->error()) {
                echo "Error";
                exit();
            }
            $row = $db->fetch_object($result);
            ?>
            <div id="image">
                <img src='assets/images/products/<?= $row->product_image_name; ?>' alt='Product image'>
            </div>

            <div id="overview">
                <h3><?= $row->product_name; ?></h3><br>
                <div class="rows"><span>PRICE:</span><?= $row->product_price; ?> &euro;</div>
                <div class="rows"><span>COLOR:</span>
                    <?php if ($row->product_color != "multicolor") {
                        echo "<div id='color' style='background-color:$row->product_color;'></div>";
                    } else {
                        echo "<div id='color' style='background-image: url(assets/images/multicolor.jpg)'></div>";
                    }
                    ?></div>
                <div class="rows"><span>SIZE:</span>
                    <input type="hidden" id="size_product_id" value="<?= $row->product_id; ?>">
                    <select name="choose-size" id="choose-size">
                        <option value="0">Select size</option>
                    </select>
                </div>
                <div class="rows"><span>QTY:</span>
                    <select name="choose-qty" id="choose-qty">
                        <option value="0">Select quantity</option>
                    </select>
                    <?php if (login()) { ?>
                        <button id="add-to-cart">Add to cart</button>
                </div>
            <?php
                    } else echo "</div><div class='notice'>*You must be logged in to buy products!</div>";
            ?>
            <div id="cartMessage"></div>
            </div> <!-- end of #overview  -->

        </article> <!-- end of #product-overview  -->


        <div id="product-tabs">
            <button id="binfo" class="active-tab">PRODUCT INFO</button>
            <?php           //for number of reviews
            $product_id = $_GET['id'];
            $sql = "SELECT * FROM review WHERE product_id={$product_id} AND is_approved=1";
            $result = $db->query($sql);
            $row = $db->fetch_object($result);
            ?>
            <button id="breview">REVIEWS (<?= $db->num_rows($result) ?>) </button>
            <button id="bdelivery">DELIVERY & RETURNS</button>
        </div> <!-- end of #product-tabs  -->


        <article id="product-info">
            <div id="info">
                <?php
                $sql = "SELECT * FROM view_all_products WHERE is_active=1 AND quantity>0 AND product_id=" . $_GET['id'];
                $result = $db->query($sql);
                if ($db->error()) {
                    echo "Error";
                    exit();
                }
                $row = $db->fetch_object($result);
                ?>
                <div><span>Description:</span> <?= $row->product_description; ?></div>
                <div><span>Material:</span><?= $row->product_material; ?></div>
                <div><span>Care:</span><?= $row->product_care; ?></div>
                <div><span>Country of origin:</span><?= $row->product_origin; ?></div>
            </div>



            <div id="review">
                <!-- with ajax -->
                <!-- insert review form -->
                <?php if (login()) { ?>
                    <p>You can write your review here</p><br>
                    <input type="hidden" id="review_product_id" value="<?= $row->product_id; ?>">
                    <input type="text" id="review_name" placeholder="Enter name"><br><br>
                    <textarea id="review_textarea" cols="60" rows="10" placeholder="Leave your review here"></textarea><br>
                    <button id="review-button">Send</button>
                    <div id="reviewMessage"></div>
                <?php
                } else echo "<div class='notice'>*You must be logged in to leave reviews!</div>";
                ?>

                <!-- show comments that have been aproved -->
                <?php
                $product_id = $_GET['id'];
                $sql = "SELECT * FROM review WHERE product_id={$product_id} AND is_approved=1 ORDER BY created_at DESC";
                $result = $db->query($sql);
                if ($db->error()) {
                    echo "Error";
                    exit();
                }
                while ($row = $db->fetch_object($result)) {
                ?>
                    <div id="approved_reviews">
                        <p><span><?= $row->review_name ?></span> [ <?= $row->created_at ?> ]</p>
                        <p> <?= $row->review_text ?> </p>
                    </div>
                <?php
                }   //end of while
                ?>
            </div> <!-- end of #review -->

            <div id="delivery">
                <div><span> Delivery:</span>Order before 4pm Monday-Friday for home delivery the next day. Orders placed between 4pm on Friday and 4pm on Sunday will be delivered on Monday. Orders placed after 4pm on Sunday will be delivered on Tuesday. </div>
                <div><span>Returns:</span>If you want to return a product, the customer pays the shipping cost back. Please note that the items must be returned with the original receipt, unworn and in the condition they were purchased, including all packaging. Refund for the returned item is made to the original buyer's payment method after the return has been received and approved by us. NK store is not responsible for any shipping damage on return shipment, therefore return well packed.
                </div>
            </div> <!-- end of #delivery  -->

        </article> <!-- end of #product-info  -->
    </section> <!-- end of #singleproduct  -->

</main>


<!----------------------- INCLUDE FOOTER ----------------------->
<?php include_once("../inc/_footer.php"); ?>