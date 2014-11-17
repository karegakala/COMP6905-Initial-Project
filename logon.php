<?php 
    require_once ("Includes/session.php");// handles session information
    require_once ("Includes/simplecms-config.php"); ////include names for database connectivity
    require_once ("Includes/connectDB.php");//connect to DB and create relavent tables
    include ("Includes/header.php"); //inclde page header
    //
    if (isset($_POST['submit'])){ // if a post request is recieved with the value submit 
        //Grab data from username and password fields
        $username = $_POST['username'];
        $password = $_POST['password'];

        //get username and id from database
        //$query = "SELECT id, username FROM users WHERE username = ? AND password = SHA(?) LIMIT 1";
         $query = "SELECT id, firstname,lastname,userrole FROM sysusers WHERE username = ? AND password = SHA(?) LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $username, $password);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == 1){ //if the person is a valid user
            $statement->bind_result($_SESSION['userid'], $_SESSION['firstname'], $_SESSION['lastname'],$_SESSION['userrole']); //designate where to place results 
            $statement->fetch(); //put results in bounded variables

            if(is_subscriber()) header("Location: subscriberHome.php"); //if a subscriber, redirect to the subscriber home

            //header ("Location: index.php"); //redirect to home
        }
        else{//user not found
            echo "Username/password combination is incorrect.";
        }
    }
?>
<div id="main">
    <h2>Please enter your login information</h2>
        <form action="logon.php" method="post"> <!-- Form to collect user information and send post request -->
            <fieldset> <!-- group releated elements in a form-->
            <legend>Log on</legend> <!-- basically reference the fieldset -->
            <ol>
                <li>
                    <label for="username">Username:</label> 
                    <input type="text" name="username" value="" id="username" />
                </li>
                <li>
                    <label for="password">Password:</label>
                    <input type="password" name="password" value="" id="password"/>
                </li>
            </ol>
            <input type="submit" name="submit" value="Submit" /> <!-- Submit button that would trigger php function -->
            <p>
                <a href="index.php">Home</a> <!-- Take user back to home -->
            </p>
        </fieldset>
    </form>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>