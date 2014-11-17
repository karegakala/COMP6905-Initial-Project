<?php
    session_start(); //create / resume session based on particular get request
    require_once  ("Includes/connectDB.php"); //connect to DB and create admin and tables as required

    function logged_on(){ //determine if a user is logged on
        return isset($_SESSION['userid']); //if there is a value for the user id supplied
    }

    function confirm_is_admin() { //shows the relavent page once based on the user
        if (!logged_on()){ //if no user is logged in then the logon page is presented
            header ("Location: logon.php"); //redirect browser to the supplied php page
        }

        if (!is_admin()){ //if the user is the admin then redirect to the index page
            header ("Location: index.php");
        }
    }

    function is_subscriber(){ //determines if the user is a subscriber
         return strcmp($_SESSION['userrole'],"subscriber")==0;
    }

    function is_employee(){
        return strcmp($_SESSION['userrole'],"employee")==0;
    }

    function is_admin(){
        global $databaseConnection; //use the global database connection field
        //select rows that have the supplied session user as an admin
        $query = "SELECT user_id FROM users_in_roles UIR INNER JOIN roles R on UIR.role_id = R.id WHERE R.name = 'admin' AND UIR.user_id = ? LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('d', $_SESSION['userid']);
        $statement->execute();
        $statement->store_result();
        return $statement->num_rows == 1; //if there is a row then it would return true meaning the person is an admin
    }
?>