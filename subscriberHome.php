    <?php 
        require_once ("Includes/simplecms-config.php"); //include names for database connectivity
        require_once  ("Includes/connectDB.php"); //connect to DB and create relavent tables
        include("Includes/header.php");     //includes the top of the site page
        
     ?>


    <div id="main"> <!-- Main Body of Page -->


     <?php
        $name = $_SESSION['firstname']." ".$_SESSION['lastname']; //Enscribe user name on screen
        echo "<h2>Hello <strong>{$name}</strong> ,</h2>\n";
     ?>
   
    <br/>
    <h4>Please select one of the options below</h4>
    <!-- Subscriber menu -->
    <ol class="round">
        <li class="one">
            <h5><a href="/subscriptionInfo.php">View Subscription Information</a></h5>
            Check current usage, outstanding fees and more..
             </li>
        <li class="two">
            <h5><a href="/empManagement.php">Manage Employees</a></h5>
            Manage all employees that interact with your applications
        </li>
        <li class="three">
            <h5><a href="/index.php">Manage User Applications</a></h5>
            Create, Edit and Delete Applications 
         </li>
    </ol>


    </div> <!-- End Main Body of Page -->

</div> <!-- End of outer-wrapper which opens in header.php -->

<?php 
    include ("Includes/footer.php");
 ?>