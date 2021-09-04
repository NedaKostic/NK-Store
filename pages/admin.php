<!---------------- INCLUDE HEAD and FILES ----------->
<?php include_once("../inc/_head.php"); ?>

<?php if (!login()) {
  echo "You must be logged in to access this page!<br>You can log in here: <a style='color:black' href='login'>Log in</a>";
  exit();
}
if ($_SESSION['user_role'] != "administrator") {
  echo "You do not have permission to access this page!";
  exit();
}
?>
<!------------ INCLUDE CUSTOM JS FILES -------------->
<script src="assets/js/admin.js"></script>

<!------------------INCLUDE HEADER ------------------>
<?php include_once("../inc/_header.php"); ?>


<!--------------------- MAIN --------------------------->
<main>
  <div id="wrapper" class="container">
    <h2>Administrator panel</h2>

    <div class="account">

      <div class="admin-tabs">
        <button id="b-dashboard-admin" class="admin-dashboard-content adminBtn"><i class="fas fa-tachometer-alt"></i><span>DASHBOARD</span></button>
        <button id="b-users" class="adminBtn"><i class="fas fa-users-cog"></i><span>MANAGE USERS</span></button>
        <button id="b-products" class="adminBtn"><i class="fas fa-tshirt"></i><span>MANAGE PRODUCTS</span></button>
        <button id="b-reviews" class="adminBtn"><i class="fas fa-comment-alt"></i><span>MANAGE REVIEWS</span></button>
        <button id="b-messages" class="adminBtn"><i class="fas fa-comments"></i><span>MANAGE MESSAGES</span></button>
        <button id="b-purchases" class="adminBtn"><i class="fas fa-shopping-bag"></i><span>VIEW PURCHASES</span></button>
        <button id="b-poll" class="adminBtn"><i class="fas fa-poll"></i><span>POLL RESULTS</span></button>
        <button onclick="window.location.href='logout'"><i class="fas fa-sign-out-alt"></i><span> LOGOUT</span></button>
      </div> <!-- end of .admin-tabs-->


      <div class="tab-content">

        <div id="admin-dashboard-content" class="adminCon">
          <h3>Welcome, <?php echo $_SESSION['user_username']; ?>!</h3>
          <p>Here in you admin panel you can manage users, products, reviews, messages, see recent orders or check pool results.</p>
        </div> <!-- end of #admin-dashboard-content-->

        <div id="users-content" class="adminCon">
          <h3>MANAGE USERS</h3>
          <p>Add new user, update or delete existing user</p>
          <label for="all-users">Select User</label>
          <select id="all-users">
            <option value="0">Select user to manage</option>
          </select>
          <label for="admId">User</label>
          <input type="text" id="admId" disabled>
          <label for="admName">User Name</label>
          <input type="text" id="admName" autocomplete="no">
          <label for="admLastname">User Last Name</label>
          <input type="text" id="admLastname" autocomplete="no">
          <label for="admUsername">User Username</label>
          <input type="text" id="admUsername" autocomplete="no">
          <label for="admEmail">User Email</label>
          <input type="email" id="admEmail" autocomplete="no">
          <label for="admPhone">User Phone</label>
          <input type="text" id="admPhone" autocomplete="no">
          <label for="admAddress">User Address</label>
          <input type="text" id="admAddress" autocomplete="no">
          <label for="admRole">User Role</label>
          <select id="admRole">
            <option value="0">--Choose user role--</option>
            <option value="administrator">Administrator</option>
            <option value="customer">Customer</option>
          </select>
          <button id="admClear">Clear fields</button>
          <button id="admSave">Save changes</button>
          <button id="admDelete">Delete user</button>
          <div id="admUsersMessage"></div>
        </div> <!-- end of #users-content-->


        <div id="products-content" class="adminCon">
          <h3>MANAGE PRODUCTS</h3>
          <p>Add new product, update or delete existing one by size</p>
          <label for="all-products">Select Product</label>
          <select id="all-products">
            <option value="0">Select product to manage</option>
          </select>
          <form action="" method="post" id="product-form" name="product-form" enctype="multipart/form-data">
            <label for="prodId">Product</label>
            <input type="text" id="prodId" name="prodId" readonly>
            <label for="prodSizeId">Size ID</label>
            <input type="text" id="prodSizeId" name="prodSizeId">
            <label for="prodName">Product Name</label>
            <input type="text" id="prodName" name="prodName">
            <label for="prodPrice">Product Price</label>
            <input type="text" id="prodPrice" name="prodPrice">
            <label for="prodDescr">Product Description</label>
            <textarea id="prodDescr" name="prodDescr" cols="40" rows="10"></textarea><br>
            <label for="prodColor">Product Color</label>
            <input type="text" id="prodColor" name="prodColor">
            <label for="prodMaterial">Product Material</label>
            <input type="text" id="prodMaterial" name="prodMaterial">
            <label for="prodCare">Product Care</label>
            <input type="text" id="prodCare" name="prodCare">
            <label for="prodName">Product Origin</label>
            <input type="prodOrigin" id="prodOrigin" name="prodOrigin">
            <label for="prodCategory">Product Category</label>
            <select id="prodCategory" name="prodCategory">
              <option value="0">--Choose Product category--</option>
              <option value="1">Dresses</option>
              <option value="2">Skirts</option>
              <option value="3">T-Shirts</option>
              <option value="4">Blouses & Shirts</option>
              <option value="5">Hoodies</option>
              <option value="6">Trousers</option>
              <option value="7">Shorts</option>
              <option value="8">Jackets & Coats</option>
              <option value="9">Swimwear</option>
              <option value="10">Bags</option>
              <option value="11">Shoes</option>
              <option value="12">Accessories</option>
            </select>
            <label for="prodQty">Product Qty</label>
            <input type="text" id="prodQty" name="prodQty">
            <label for="prodImage">Add product image</label>
            <input type="file" id="prodImage" name="prodImage">
          </form>
          <button id="prodClear">Clear fields</button>
          <button id="prodSave">Save changes</button>
          <button id="prodDelete">Delete product</button> <!-- delete selected size-->
          <button id="prodDeleteAllSizes">Delete all sizes</button> <!-- delete all sizes-->
          <div id="prodMessage"></div>
        </div> <!-- end of #products-content-->



        <div id="reviews-content" class="adminCon">
          <h3>MANAGE REVIEWS</h3>
          <!-- not apprroved reviews -->
          <h4>Approve or reject product's reviews</h4><br>
          <div id="no_new_message"></div>
          <select id="all-reviews">
            <option value="0">Select review to approve/reject</option>
          </select> <br><br>
          <textarea id="review-to-approve" cols="40" rows="8" disabled></textarea><br>
          <button id="reject">Reject</button>
          <button id="approve">Approve</button>
          <div id='approve-message'></div><br>
        </div> <!-- end of #reviews-content-->


        <div id="messages-content" class="adminCon">
          <h3>MANAGE MESSAGES</h3>
          <!-- not answered messages -->
          <h4>Answer messages</h4><br><br>
          <div id="no-new-message1"></div>
          <select id="all-messages">
            <option value="0">Select message to answer</option>
          </select> <br><br>
          <textarea name="message-to-answer" id="message-to-answer" cols="40" rows="8" disabled></textarea><br>
          <textarea name="contact_answer" id="contact_answer" cols="40" rows="8" placeholder="Enter your reply here"></textarea><br>
          <button id="answer">Answer</button>
          <div id='answerMessage'></div><br>
        </div> <!-- end of #messages-content-->


        <div id="purchases-content" class="adminCon">
          <h3>PURCHASES</h3>

          <?php
          $sql = "SELECT * FROM view_cart WHERE is_bought=1 ORDER BY bought_at DESC";
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
                                <th class='cart-col'>Color</th>
                                <th>Size</th>
                                <th>QTY</th>
                                <th>Item Price</th>
                                <th>Shop time</th>
                            </tr>
                        </thead>   
                        <tbody>";
            while ($row = $db->fetch_object($result)) {
              echo "<tr>
                                <td>$row->product_id.$row->product_name</td>
                                <td class='cart-col'>{$row->product_color}</td>
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
        </div> <!-- end of #purchases-content-->

        <div id="poll-content" class="adminCon">
          <h3>POOL RESULTS</h3>
          <h4>Poll: How satisfied are you with our services?</h4>
          <div id="poll_results">
          </div>
        </div> <!-- end of #poll-content-->

      </div> <!-- end of #tab-content--->
    </div> <!-- end of .account-->

  </div> <!-- end of #wrapper-->
</main>


<!----------------------- INCLUDE FOOTER ----------------------->
<?php include_once("../inc/_footer.php"); ?>
