<?php require_once ("Includes/session.php"); //handles session information
 
 ?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>TaskMe</title>  <!-- Tab Title -->
        <link href="/Styles/Site.css" rel="stylesheet" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1"> 


    </head>
    <body>
        <div class="outer-wrapper">
        <header>
            <div class="content-wrapper">
                <div class="float-left"> <!-- Upper left of Page -->
                     <p class="site-title"><a href="/index.php"><img src="Images/help.jpg"></a> Welcome to TaskMe Software Solution</p> <!-- Main Title of Page -->
                </div>

                <div class="float-right"> <!-- Upper right of Page -->
                    <section id="login"> <!-- Login Section in the upper right hand of page -->
                        <ul id="login">  <!-- Sections appear as buttons on the page top left hand corner -->
                        <?php
                        if (logged_on()){ //if the user is signed in
                            echo '<li><a href="/logoff.php">Sign out</a></li>' . "\n"; //add html content to the page
                            if (is_admin()){ //if the user is admin
                                echo '<li><a href="/addpage.php">Add</a></li>' . "\n";
                                echo '<li><a href="/selectpagetoedit.php">Edit</a></li>' . "\n";
                                echo '<li><a href="/deletepage.php">Delete</a></li>' . "\n";
                            }
                        }else{ //user is not logged on hence show login and register pages
                            echo '<li><a href="/logon.php">Login</a></li>' . "\n";
                            echo '<li><a href="/register.php">Register</a></li>' . "\n";
                        }
                        ?>
                        </ul>
                        <?php if (logged_on()) { //if user is logged on , show the username
                            
                            echo "<div class=\"welcomeMessage\">Welcome, <strong>{$_SESSION['firstname']}</strong></div>\n";
                            
                          

                        } ?>
                    </section>
                </div>

                <div class="clear-fix">  <!-- Not sure what this div does -->
                        
                     <!-- content -->

                </div>
            </div> <!-- end content wrapper -->

                <section class="navigation" data-role="navbar"> <!-- Navigation Menu -->
                    <nav>
                        <ul id="menu">
                            <!--  <li><a href="/index.php">Get Started</a></li> -->
                            <?php
                                
                                if(!logged_on()){ //if user is not logged on then 
                                    echo '<li><a href="/index.php">Get Started</a></li>'."\n";
                                }

                                if(logged_on() && is_subscriber()){ //if the user is a subscriber
                                     echo '<li><a href="/subscriberHome.php">Subscriber Home</a></li>'."\n";
                                     echo '<li><a href="/subscriptionInfo.php">Subscription Information</a></li>'."\n";
                                     echo '<li><a href="/empManagement.php">Employee Manegement</a></li>'."\n";
                                     
                                }

                                /*
                                if(logged_on()){ //if user is logged in then show these options
                                    echo '<li><a href="/index.php">Next Home</a></li>'. "\n";
                                   
                                }*/
                                
                                /*
                                $statement = $databaseConnection->prepare("SELECT id, menulabel FROM pages"); //
                                $statement->execute();

                                if($statement->error)
                                {
                                    die("Database query failed: " . $statement->error);
                                }

                                $statement->bind_result($id, $menulabel);
                                while($statement->fetch())
                                {
                                    echo "<li><a href=\"/page.php?pageid=$id\">$menulabel</a></li>\n";
                                }

                                */
                            ?>
                        </ul> 
                    </nav> <!-- End list of Navigation Options -->
            </section>
        </header> <!-- End Header -->
