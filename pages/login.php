 <!---------------- INCLUDE HEAD and FILES ----------->
 <?php include_once("../inc/_head.php"); ?>

 <!------------ INCLUDE CUSTOM JS FILES -------------->
 <script src="assets/js/login.js"></script>

 <!------------------INCLUDE HEADER ------------------>
 <?php include_once("../inc/_header.php"); ?>


 <!--------------------- MAIN --------------------------->
 <main id="main-login">
   <div class="login-form">
     <h1>Log in</h1>
     <input type="text" id="username" placeholder="Username*" autocomplete="off">
     <input type="password" id="password" placeholder="Password*" autocomplete="off">
     <div><input type="checkbox" id="remember" name="remember">
       <label for="remember">Remember</label>
     </div>
     <button id="login">Login</button>
     <div id="statusMessage"></div>
     <p>Not registred yet? <button id="regLink">Register now</button></p>
     <p>Forgot your password? <button id="passLink">Reset now</button></p>
   </div> <!-- end of .login-form -->


   <div id="registration-form">
     <h1>Registration</h1>
     <input type="text" id="regName" placeholder="Name*" autocomplete="no">
     <input type="text" id="regLastname" placeholder="Last Name*" autocomplete="no">
     <input type="text" id="regUsername" placeholder="Username*" autocomplete="no">
     <input type="email" id="regEmail" placeholder="Email Address*" autocomplete="no">
     <input type="password" id="regPassword" placeholder="Password*" autocomplete="no">
     <input type="password" id="regRePassword" placeholder="Repeat Password*" autocomplete="no">
     <input type="text" id="regPhone" placeholder="Phone* e.g. +381 60 1234567" autocomplete="no">
     <input type="text" id="regAddress" placeholder="Address*" autocomplete="no"><br>
     <button id="register">Register</button>
     <div id="regStatusMessage"></div>
     <p>Already have an account? <button class="loginLink">Log in Here</button></p>
   </div> <!-- end of #registration-form -->


   <div id="resetPassword-form">
     <h1>Reset password</h1>
     <p>Forgot your password? Please enter your email address. You will receive a link to create a new password via email.</p>
     <input type="text" id="passEmail" placeholder="Email Address*" autocomplete="no">
     <button id="resetPassword">Reset password</button>
     <div id="passMessage"></div>
     <p><button class="loginLink">Back to log in</button></p>
   </div> <!-- end of #resetPassword-form -->

 </main>


 <!----------------------- INCLUDE FOOTER ----------------------->
 <?php include_once("../inc/_footer.php"); ?>