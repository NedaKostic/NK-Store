 <!---------------- INCLUDE HEAD and FILES ----------->
 <?php include_once("../inc/_head.php"); ?>
 <!------------ INCLUDE CUSTOM JS FILES -------------->
 <script src="assets/js/map.js"></script>
 <script src="assets/js/contact.js" defer></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa3WPfuQ9X7DeSuZ2TavuBUH4LA59YFSc&callback=initMap&libraries=&v=weekly" async></script>

 <!------------------INCLUDE HEADER ------------------>
 <?php include_once("../inc/_header.php"); ?>


 <!--------------------- MAIN --------------------------->
 <main id="main-contact">
     <div class="container">
         <!-- GET IN TOUCH -->
         <section id="getintouch">
             <h2>Get in touch with us</h2>
             <div class="contact-items">
                 <article>
                     <h3>CONTACT US</h3>
                     <p>Fashion never sleeps.</p>
                     <p>We offer 24/7 customer service.</p>
                     <p>Get in touch with us!</p>
                     <p>You can reach us:</p>

                     <h4>By Phone</h4>
                     <p>+38111223344</p>
                     <p>+38161223344</p>
                     <p> Available daily: 8am-10pm </p>

                     <h4>By Email</h4>
                     <p>info@nkstore.com</p>
                     <p>customerservice@nkstore.com</p>

                     <h4>By Social Media</h4>
                     <a class='icon' href="#"><i class="fab fa-facebook-square"></i></a>
                     <a class='icon' href="#"><i class="fab fa-instagram"></i></a>
                     <a class='icon' href="#"><i class="fab fa-linkedin"></i></a>
                 </article>

                 <article>
                     <?php if (!login()) { ?>
                         <div id="contact-form">
                             <h3>SEND US MESSAGE</h3>
                             <label for="name">
                                 <i class="fa fa-user"></i>
                                 <input type="text" id="name" placeholder="Name" autocomplete="no">
                             </label>

                             <label for="email">
                                 <i class="fa fa-envelope-o"></i>
                                 <input type="email" id="email" placeholder="Email" autocomplete="no">
                             </label>

                             <label for="subject">
                                 <i class="fa fa-info-circle"></i>
                                 <input type="text" id="subject" placeholder="Subject" autocomplete="no">
                             </label>

                             <label for="message">
                                 <i id="icon-message" class="fa fa-pencil-square-o"></i>
                                 <textarea rows="8" cols="49" id="message" placeholder="Message"></textarea>
                             </label>

                             <button id="contact-btn">Send message</button>
                             <div id="statusMessage"></div>
                         </div> <!-- end of #contact-form  -->
                     <?php } ?>
                 </article>
             </div> <!-- end of .contact-items  -->
         </section>  <!-- end of #getintouch  -->
        


         <section id="findus">
             <!-- FIND US -->
             <h2>How to find us</h2>
             <div class="contact-items">
                 <article>
                     <h3>OUR MAIN STORE & OFFICES</h3>
                     <div class="tabs" onclick="zoom()">
                         <p><i class="fas fa-map-marker-alt"></i> NK MAIN STORE</p>
                         <p>Bulevar Mihaila Pupina, store no.44, </p>
                         <p>11070 Belgrade, Serbia</p>
                         <p>Telefon no: 011/223355</p>
                     </div>
                 </article>

                 <article id="article-map">
                     <h3>CHECK OUR LOCATIONS</h3>
                     <div id="map"></div>
                 </article>
             </div> <!-- end of .contact-items  -->
         </section> <!-- end of #findus  -->
     </div> <!-- end of .container -->
 </main>


 <!----------------------- INCLUDE FOOTER ----------------------->
 <?php include_once("../inc/_footer.php"); ?>