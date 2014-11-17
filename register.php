<?php 
        require_once ("Includes/simplecms-config.php"); //include names for database connectivity
        require_once  ("Includes/connectDB.php"); //connect to DB and create relavent tables
        include("Includes/header.php");     //includes the top of the site page

    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $userrole = "subscriber"; //subscriber info
        
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

                    header ("Location: index.php"); //redirect to home
                }
                else{
                    echo "Failed registration"; //user was not created
                }
                
            //********************************************************************************************************************************************

            /*
                //insert information into database
                $query = "INSERT INTO users (username, password) VALUES (?, SHA(?))";

                $statement = $databaseConnection->prepare($query);
                $statement->bind_param('ss', $username, $password);
                $statement->execute();
                $statement->store_result();
                
                $creationWasSuccessful = $statement->affected_rows == 1 ? true : false; //determine if row was successfully created
                if ($creationWasSuccessful){ // if row was created successfully
                    $userId = $statement->insert_id; //grab the user id created

                    //assign user role to user
                    $addToUserRoleQuery = "INSERT INTO users_in_roles (user_id, role_id) VALUES (?, ?)";
                    $addUserToUserRoleStatement = $databaseConnection->prepare($addToUserRoleQuery);

                    // TODO: Extract magic number for the 'user' role ID.
                    $userRoleId = 2;
                    $addUserToUserRoleStatement->bind_param('dd', $userId, $userRoleId);
                    $addUserToUserRoleStatement->execute();
                    $addUserToUserRoleStatement->close();

                    $_SESSION['userid'] = $userId;
                    $_SESSION['username'] = $username;

                    header ("Location: index.php"); //redirect
                }
                else
                {
                    echo "Failed registration";
                }
                */
            
        
    }//end isset
?>
<div id="main">
    <h2>Welcome Prospective Subscriber</h2>
    <p> Before creating a subscription, be sure to read our pricing and subscription information <a href="/index.php" title="Learn More!">here</a>. </p>
        <form action="register.php" method="post">
            <fieldset>
                <legend>Register an account</legend>
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
                <input type="submit" name="submit" value="Create Subscription" />
                <p>
                    <a href="index.php">Home</a>
                </p>
            </fieldset>
        </form>
     </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>