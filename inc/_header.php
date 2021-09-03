<body>
   <!-- HEADER -->
   <header>

      <nav>
         <div class="menu-icon">
            <span class="fas fa-bars"></span>
         </div>

         <div id="logo">
            <a href="home">NK STORE</a>
         </div>

         <div class="nav-items">
            <li><a href="home">Home</a></li>
            <li><a href="about">About Us</a></li>
            <li>
               <div id="dropdown">
                  <a href="products">Products <i class="fa fa-caret-down"></i></a>
                  <div id="dropdown-content">
                     <?php
                     $sql = "SELECT * FROM category ORDER BY category_id ASC";
                     $result = $db->query($sql);
                     while ($row = $db->fetch_object($result))
                        echo "<a href='category-{$row->category_id}'>{$row->category_name}</a>";
                     ?>
                  </div>
               </div>
            </li>

            <li><a href="collection">Collection</a></li>
            <li><a href="contact">Contact Us</a></li>

            <?php
            if (!login()) echo "<li><a href='login'><i class='fas fa-sign-in-alt'></i> Login</a></li>";
            else {
               echo "<li>";
               if ($_SESSION['user_role'] == 'administrator') echo "<a href='admin'><i class='fas fa-user'></i></a></li>";
               else echo "<a href='user'><i class='fas fa-user'></i></a></li>";
            }
            ?>
            <li><a id='cart-link' href='cart'><i class='fas fa-shopping-cart'></i><span id='cart-items-number'></span></a></li>

         </div>
         <div class="cancel-icon">
            <span class="fas fa-times"></span>
         </div>

         <div id="search">
            <input type="text" id="searchBox" name="search" placeholder="Search for products" autocomplete="off">
            <div id="search-results"></div>
         </div>

      </nav>

      <div class="content"></div>

   </header>


   <!-- RESPONSIVE NAVIGATION -->
   <script>
      let menuBtn = document.querySelector(".menu-icon span");
      let cancelBtn = document.querySelector(".cancel-icon");
      let items = document.querySelector(".nav-items");
      menuBtn.onclick = () => {
         items.classList.add("active");
         menuBtn.classList.add("hide");
         cancelBtn.classList.add("show");
      }

      cancelBtn.onclick = () => {
         items.classList.remove("active");
         menuBtn.classList.remove("hide");
         cancelBtn.classList.remove("show");
      }
   </script>