<?php
    
    include_once 'header.php';
    
    userCheck();
    timeOutLogout();
    



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


            </div>
        </section>
        
<?php
    include_once 'footer.php';
?>