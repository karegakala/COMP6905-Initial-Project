<?php
    
/* Uses PHP mysqli extensions */
    require_once ("/Includes/simplecms-config.php"); //include names for database connectivity

    function prep_DB_content (){ //prepare database for use
        global $databaseConnection; //access the global value of $databaseConnection inside this function
        $admin_role_id = 1; 

        create_tables($databaseConnection); //create tables if they do not exist in  the database
        create_roles($databaseConnection, $admin_role_id);
        create_admin($databaseConnection, $admin_role_id);
    }

    function create_tables($databaseConnection){ //create and defines tables in database if the do not already exist

        //create defined users table
        $create_sysUsers_query = "CREATE TABLE IF NOT EXISTS sysusers (id INT NOT NULL AUTO_INCREMENT, username VARCHAR(50), password CHAR(40),firstname VARCHAR(50),lastname VARCHAR(50), userrole CHAR(50), PRIMARY KEY (id))";
        $databaseConnection->query($create_sysUsers_query);




        $query_users = "CREATE TABLE IF NOT EXISTS users (id INT NOT NULL AUTO_INCREMENT, username VARCHAR(50), password CHAR(40), PRIMARY KEY (id))"; //create table query
        $databaseConnection->query($query_users); //exeute create table sql query

        $query_roles = "CREATE TABLE IF NOT EXISTS roles (id INT NOT NULL, name VARCHAR(50), PRIMARY KEY (id))";
        $databaseConnection->query($query_roles);

        $query_users_in_roles = "CREATE TABLE IF NOT EXISTS users_in_roles (id INT NOT NULL AUTO_INCREMENT, user_id INT NOT NULL, role_id INT NOT NULL, ";
        $query_users_in_roles .= " PRIMARY KEY (id), FOREIGN KEY (user_id) REFERENCES users(id), FOREIGN KEY (role_id) REFERENCES roles(id))";
        $databaseConnection->query($query_users_in_roles);

        $query_pages = "CREATE TABLE IF NOT EXISTS pages (id INT NOT NULL AUTO_INCREMENT, menulabel VARCHAR(50), content TEXT, PRIMARY KEY (id))";
        $databaseConnection->query($query_pages);
    }

    function create_roles($databaseConnection, $admin_role_id){
        //create types of roles within system - can only be done if there is not another admin
        $query_check_roles_exist = "SELECT id FROM roles WHERE id <= 2"; //make query string that would return result set
        $statement_check_roles_exist = $databaseConnection->prepare($query_check_roles_exist); //prepare and sql statement for execution
        $statement_check_roles_exist->execute(); //execute sql statement
        $statement_check_roles_exist->store_result(); //transfer result set from last executed query into variable
        if ($statement_check_roles_exist->num_rows == 0){//if there is no admins : we would expect an ID of 1 
            $query_insert_roles = "INSERT INTO roles (id, name) VALUES ($admin_role_id, 'admin'), (2, 'user')"; //insert admin id value amd values for a user
            $statement_inser_roles = $databaseConnection->prepare($query_insert_roles); //prepare statement
            $statement_inser_roles->execute(); //execute
        }
    }

    function create_admin($databaseConnection, $admin_role_id){
        // HACK: Storing config values in variables so that they aren't passed by reference later.
        $default_admin_username = DEFAULT_ADMIN_USERNAME;
        $default_admin_password = DEFAULT_ADMIN_PASSWORD;
        //check to see if admin exists
        $query_check_admin_exists = "SELECT id FROM users WHERE username = ? LIMIT 1"; //? acts as placeholder , limit 1 means return the first value
        $statement_check_admin_exists = $databaseConnection->prepare($query_check_admin_exists); //create database statement
        $statement_check_admin_exists->bind_param('s', $default_admin_username); //replace placeholder with value
        $statement_check_admin_exists->execute(); //execute select
        $statement_check_admin_exists->store_result();
        if($statement_check_admin_exists->num_rows == 0){ //if there is no admin create 1
            $query_insert_admin = "INSERT INTO users (username, password) VALUES (?, SHA(?))"; //apply hash to the password
            $statement_insert_admin = $databaseConnection->prepare($query_insert_admin);
            $statement_insert_admin->bind_param('ss', $default_admin_username, $default_admin_password);
            $statement_insert_admin->execute(); //execute insertion
            $statement_insert_admin->store_result();

            $admin_user_id = $statement_insert_admin->insert_id;//get the ID generated from the last inserted statement 
            $query_add_admin_to_role = "INSERT INTO users_in_roles(user_id, role_id) VALUES (?, ?)";
            $statement_add_admin_to_role = $databaseConnection->prepare($query_add_admin_to_role);
            $statement_add_admin_to_role->bind_param('dd', $admin_user_id, $admin_role_id); //admin role ID should be 1
            $statement_add_admin_to_role->execute();
            $statement_add_admin_to_role->close(); //close prepared statement
        }
    }
?>