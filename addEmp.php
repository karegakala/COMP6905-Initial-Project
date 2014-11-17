<?php 
        require_once ("Includes/simplecms-config.php"); //include names for database connectivity
        require_once  ("Includes/connectDB.php"); //connect to DB and create relavent tables
        include("Includes/header.php");     //includes the top of the site page

    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $userrole = "employee"; //subscriber info
        
               //insert information into database
               
               //create query and attempt to execute
               $sysquery = "INSERT INTO sysusers (username, password,firstname,lastname,userrole) VALUES (?, SHA(?),?,?,?)";

              
               $sysstatement = $databaseConnection->prepare($sysquery);
               
               $sysstatement->bind_param('sssss', $username, $password,$firstname,$lastname,$userrole);
               $sysstatement->execute();
               $sysstatement->store_result();
               
               $creationWasSuccessful = $sysstatement->affected_rows == 1 ? true : false; //determine if rows were successfully created
               if ($creationWasSuccessful){ // if row was created successfully
                    
                    //apply session variables
                    $_SESSION['userid'] = $userId;
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $firstname;

                    header ("Location: empManagement.php"); //redirect to Manamegent portal
                }
                else{
                    echo "Unable to create Employee"; //user was not created
                }
                
    }//end isset
?>
<div id="main">
    <h2>Employee Creation Portal</h2>
    <p> Please re-check all information before submission </p>
        <form action="addEmp.php" method="post">
            <fieldset>
                <legend>Create an employee</legend>
                <ol>
                    <li>
                        <label for="username">Username:</label> 
                        <input type="text" name="username" value="" id="username" />
                    </li>
                    <li>
                        <label for="password">Password:</label>
                        <input type="password" name="password" value="" id="password" />
                    </li>
                    <li>
                        <label for="firstname">First Name:</label>
                        <input type="text" name="firstname" value="" id="firstname" />
                    </li>
                    <li>
                        <label for="lastname">Last Name:</label>
                        <input type="text" name="lastname" value="" id="lastname" />
                    </li>
                </ol>
                <input type="submit" name="submit" value="Create Employee" />
                <p>
                    <a href="empManagement.php">Back to Employee Management</a>
                </p>
            </fieldset>
        </form>
     </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>