<!---------------- INCLUDE HEAD and FILES ----------->
<?php include_once("../inc/_head.php"); ?>

<?php if (!login()) {
    echo "You must be logged in to access this page!<br>You can log in here: <a style='color:black' href='login'>Log in</a>";
    exit();
}
if ($_SESSION['user_role'] != "customer") {
    echo "You do not have permission to access this page!";
    exit();
}
?>

<!------------ INCLUDE CUSTOM JS FILES -------------->
<script src="assets/js/user.js"></script>

<!------------------INCLUDE HEADER ------------------>
<?php include_once("../inc/_header.php"); ?>


<!--------------------- MAIN --------------------------->
<main>
    <div id="wrapper" class="container">
        <h2>My account</h2>
        <div class="account">
            <div class="account-tabs">
                <button id="b-dashboard" class="active-account-tab accBtn"><i class="fas fa-tachometer-alt"></i><span>DASHBOARD</span></button>
                <button id="b-orders" class="accBtn"><i class="fas fa-shopping-bag"></i><span>ORDERS</span></button>
                <button id="b-address" class="accBtn"><i class="fas fa-map-marker-alt"></i><span>DELIVERY ADDRESS</span></button>
                <button id="b-password" class="accBtn"><i class="fas fa-user-cog"></i><span>CHANGE PASSWORD</span></button>
                <button id="b-opinion" class="accBtn"><i class="fas fa-clipboard-list"></i><span>GIVE US OPINION</span></button>
                <button id="b-contact" class="accBtn"><i class="fas fa-pen"></i><span>CONTACT US</span></button>
                <button onclick="window.location.href='logout'"><i class="fas fa-sign-out-alt"></i><span> LOGOUT</span></button>
            </div> <!-- end of .account-tabs  -->


            <div class="tab-content">
                <div id="dashboard-content" class="accCon">
                    <h3>Welcome, <?php echo $_SESSION['user_username']; ?>!</h3>
                    <p>Here in you account panel you can see your recent orders, manage delivery address, change password and edit other account details, contact us or ask for help.</p>
                </div> <!-- end of #dashboard-content  -->

                <div id="orders-content" class="accCon">
                    <h3>Recent orders</h3>
                    <?php
                    $sql = "SELECT * FROM view_cart WHERE user_id={$_SESSION['user_id']} AND is_bought=1 ORDER BY bought_at DESC LIMIT 8";
                    $result = $db->query($sql);

                    if ($db->error()) {
                        $showMessage['fail'] = "Error, please try again.";
                        exit();
                    }

                    if ($db->num_rows($result) > 0) {
                        echo "<table id='orders-tbl'>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>QTY</th>
                                <th>Item price</th>
                                <th>Shop time</th>
                            </tr>
                        </thead>   
                        <tbody>";
                        while ($row = $db->fetch_object($result)) {
                            echo "<tr>
                                <td>{$row->product_name}</td>
                                <td>{$row->size_name}</td>
                                <td>{$row->cart_quantity}</td>
                                <td>&euro;  {$row->product_price_per_item}</td>
                                <td>{$row->bought_at}</td>
                            </tr>";
                        }
                        echo "</tbody>  
                         </table>";
                    } else echo "<p>No order has been made yet.</p>";
                    ?>
                </div> <!-- end of #orders-content  -->

                <div id="address-content" class="accCon">
                    <h3>Delivery address</h3>
                    <p>Here you can change address that will be used as your delivery address.</p>
                    <input type="text" id="deliveryAddress" placeholder="Address*" autocomplete="off">
                    <br><button id="changeAddress">Save Address</button>
                    <div id="changeAddressMessage"></div>
                </div> <!-- end of #address-content  -->


                <div id="password-content" class="accCon">
                    <h3>Change password</h3>
                    <input type="password" id="currentPwd" placeholder="Current password*">
                    <input type="password" id="newPwd" placeholder="New password*">
                    <input type="password" id="confirmNewPwd" placeholder="Confirm New password*">
                    <br><button id="changePassword">Save changes</button>
                    <div id="changePassMessage"></div>
                </div> <!-- end of #password-content  -->


                <div id="contact-content" class="accCon">
                    <h3>Contact us</h3>
                    <p>Need help or have question? Send us your message bellow:</p>
                    <input type="text" id="contactSubject" placeholder="Subject*" autocomplete="off">
                    <textarea rows="8" cols="49" id="contactMessage" placeholder="Message*"></textarea>
                    <br><button id="contactUs">Send message</button>
                    <div id="contactStatusMessage"></div>
                </div> <!-- end of #contact-content  -->


                <div id="opinion-content" class="accCon">
                    <h3>Give us your opinion</h3>
                    <div id="poll">
                        <h4>How satisfied are you with our services?</h4>
                        <input type='radio' id="1" class="radio-options" name='vote'>Extremely Unsatisfied <br>
                        <input type='radio' id="2" class="radio-options" name='vote'>Unsatisfied <br>
                        <input type='radio' id="3" class="radio-options" name='vote'>Neutral <br>
                        <input type='radio' id="4" class="radio-options" name='vote'>Satisfied <br>
                        <input type='radio' id="5" class="radio-options" name='vote'>Extremely Satisfied <br>
                        <button id="confirm">Confirm</button>
                    </div>
                    <div id="opinion-message"></div>
                </div> <!-- end of #opinion-content  -->
            </div> <!-- end of #tab-content  -->
        </div> <!-- end of #account  -->
    </div> <!-- end of #wrapper  -->
</main>

<!----------------------- INCLUDE FOOTER ----------------------->
<?php include_once("../inc/_footer.php"); ?>
