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
                <h1>Welcome to the user page</h1>
                <?php
                    include_once 'includes/dbh.inc.php';
                    
                    
                        if (isset($_SESSION["useruid"])) {
                            echo "<p>Howdy user " . $_SESSION["useruid"] ." </p>";

                        }
                ?>
                <h2>Here you can check your balance, make a payment, or request for maintenance/repair.</h2>
                <?php
                    require_once 'includes/functions.inc.php';
                    showBal($conn);

                ?>
            


            </section>
        
<?php
    include_once 'footer.php';
?>