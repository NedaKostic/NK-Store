<!---------------- INCLUDE HEAD and FILES ----------->
<?php include_once("../inc/_head.php"); ?>

<!------------ INCLUDE CUSTOM JS FILES -------------->
<script src="assets/js/collection.js" defer></script>

<!------------------INCLUDE HEADER ------------------>
<?php include_once("../inc/_header.php"); ?>


<!----------------------- HERO ----------------------->
<div id="hero">
    <img src="assets/images/hero_04.jpg" alt="hero04">
</div>

<!----------------------- MAIN ----------------------->
<main id="main-coll">
    <hgroup class="collection-container">
        <h1>Need inspiration for your style?</h1>
        <h2>Check our latest collections here...</h2>
    </hgroup>

    <div id="tabs" class="collection-container">
        <a id="tab1" onclick="showSS()">New Collection Spring/Summer 2021</a>
        <a id="tab2" onclick="showAW()">Collection Autumn/Winter 2020/2021</a>
    </div>


<!----------------------- MODAL ----------------------->
    <div id="myModal" class="modal">
        <!-- Modal Content (image) -->
        <img class="modal-content" id="img01">
    </div>

    <div id="ss" class="collection-container">
        <div class="items">
            <img class="myImg" src="assets/images/ss_01sm.jpg" alt="ss01sm">
            <img class="myImg" src="assets/images/ss_02sm.jpg" alt="ss02sm">
            <img class="myImg" src="assets/images/ss_03sm.jpg" alt="ss03sm">
            <img class="myImg" src="assets/images/ss_04sm.jpg" alt="ss04sm">
            <img class="myImg" src="assets/images/ss_05sm.jpg" alt="ss05sm">
            <img class="myImg" src="assets/images/ss_06sm.jpg" alt="ss06sm">
        </div>
    </div>

    <div id="aw" class="collection-container">
        <div class="items">
            <img class="myImg" src="assets/images/aw_01sm.jpg" alt="aw01sm">
            <img class="myImg" src="assets/images/aw_02sm.jpg" alt="aw02sm">
            <img class="myImg" src="assets/images/aw_03sm.jpg" alt="aw03sm">
            <img class="myImg" src="assets/images/aw_04sm.jpg" alt="aw04sm">
            <img class="myImg" src="assets/images/aw_05sm.jpg" alt="aw05sm">
            <img class="myImg" src="assets/images/aw_06sm.jpg" alt="aw06sm">
        </div>
    </div>
</main>


<!----------------------- INCLUDE FOOTER ----------------------->
<?php include_once("../inc/_footer.php"); ?>