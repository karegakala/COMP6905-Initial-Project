<?php 
    require_once ("Includes/session.php");// handles session information
    require_once ("Includes/simplecms-config.php"); ////include names for database connectivity
    require_once ("Includes/connectDB.php");//connect to DB and create relavent tables
    include ("Includes/header.php"); //inclde page header

    function populate(){
         global $databaseConnection;
         $userrole = "employee";
         $query = "SELECT id, username,firstname,lastname FROM sysusers WHERE userrole = ?";

         $statement = $databaseConnection->prepare($query);
         echo "inside pop";
         $statement->bind_param('s', $userrole);
         $statement->execute(); //execute query
         
         $resultset=  $statement->get_result(); //get result set
         
         while($row = $resultset->fetch_assoc()){
             $empname = $row["firstname"]." ".$row["lastname"];
             echo "<tr>\n";
                echo "<td>{$row["id"]}</td>\n";
                echo "<td> {$row["username"]} </td>\n";
                echo "<td> {$empname}</td>\n";
             echo "</tr>\n";

         }
         $resultset->free(); //release resultset

    }

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
    <h2>Employee Database</h2>
    <p>Below is a listing of all employees within subscriber database</p>
        
    <table style="width:100%;border: 1px solid black;border-collapse: collapse">
        <tr>
            <td> <strong> Employee ID </strong> </td>
            <td> <strong> Employee Username </strong></td>
            <td> <strong> Employee Name </strong></td>
        </tr>

        <?php
            
            populate();
        ?>


    
    </table>

    <p>
      <a href="empManagement.php">Back to Employee Management</a>
    </p>
</div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>