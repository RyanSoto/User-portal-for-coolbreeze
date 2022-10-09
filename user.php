<?php
    
    include_once 'header.php';
    if (!isset($_SESSION["useruid"]))
    {
        header("location:login.php?error=notloggedin");
        exit();
    } else 

    if  ($_SESSION["usertype"] == "admin") {
        header("location: login.php?error=notuser");
        exit();
    }
    



?>

        <section class="container">
            <div class="inner-container">
                <h1>Welcome to the user page</h1>
                <?php
                    include_once 'includes/dbh.inc.php';
                    require_once 'includes/functions.inc.php';
                    
                        if (isset($_SESSION["useruid"])) {
                            echo "<p>Howdy user " . $_SESSION["useruid"] ." </p>";

                        }
                ?>
                <h2>Make a payment or <a href='maintreq.php'>request for maintenance/repair.</a></h2>
                <?php
                    userShowProp($conn);
                    

                    userShowBal($conn);

                ?>
        

            </div>
        </section>
        
<?php
    include_once 'footer.php';
?>