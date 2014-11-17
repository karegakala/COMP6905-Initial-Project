    <?php 
        require_once ("Includes/simplecms-config.php"); //include names for database connectivity
        require_once  ("Includes/connectDB.php"); //connect to DB and create relavent tables
        include("Includes/header.php");     //includes the top of the site page
        
     ?>


    <div id="main"> <!-- Main Body of Page -->

    <h2>Employee Management Portal</h2>

    <h4>Please select one of the options below</h4>
    <!-- Emp Management menu -->
    <ol class="round">
        <li class="one">
            <h5><a href="/addEmp.php">Add Employee</a></h5>
            Allows subscriber to create an employee account for managing tasks
             </li>
        <li class="two">
            <h5><a href="/viewEmp.php">View all Employees</a></h5>
           View and manage all created employees
        </li>
    </ol>



    </div> <!-- End Main Body of Page -->

</div> <!-- End of outer-wrapper which opens in header.php -->

<?php 
    include ("Includes/footer.php");
 ?>