    <?php 
        require_once ("Includes/simplecms-config.php"); //include names for database connectivity
        require_once  ("Includes/connectDB.php"); //connect to DB and create relavent tables
        include("Includes/header.php");     //includes the top of the site page
        
     ?>


    <div id="main"> <!-- Main Body of Page -->

    <h2>Welcome to the simplest way possible to manage tasks!</h2>
    <br/>
    <h4>To begin, please read the instructions below</h4>

    <ol class="round">
        <li class="one">
            <h5>Login</h5>
            If you already have access to TaskMe, please click <a href="/logon.php">login</a> to continue 
        </li>
        <li class="two">
            <h5>Purchase Subscription</h5>
             If you are new to TaskMe, please click <a href="/register.php">register</a> to create a subscription
        </li>
        <li class="three">
            <h5>Learn More</h5>
                For more information about our services please click <a href="/index.php" title="Learn More!">here</a>. 
         </li>

        <!--  
        <li class="asterisk">
            <div class="visit">
                To learn more about PHP, visit <a href="http://php.net" title="PHP.net Website">http://php.net</a>. 
            </div>
         </li>
        -->
    </ol>


    </div> <!-- End Main Body of Page -->

</div> <!-- End of outer-wrapper which opens in header.php -->

<?php 
    include ("Includes/footer.php");
 ?>