<?php


    include_once 'header.php';

    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';

    adminCheck();
    timeOutLogout();


?>

            <section class="container">
                <div class="inner-container">
                    <h1>Welcome to the admin page</h1>
                    <?php
                            if (isset($_SESSION["useruid"])) {
                                echo "<p>Howdy admin user " . $_SESSION["useruid"] ."</p>";
                            }
                    ?>
                    <p>Time to take care of business!</p>
                    <section class="admin-categories">
                        <h2>Manage Residents</h2>
                        <div class="admin-categories-list">
                            <div>
                                <h3>Update</h3>
                            </div>
                        </div>
                    </section>
                    <?php
                        adminShowAllResiNameAsc($conn)
                    ?>
                    <a href ="manageresinamedesc.php"><h3> Sort by Name in descending order</h3></a>
                    <a href ="manageresi.php"><h3> Sort by Id</h3></a>
                    
                </div>
            </section>
        
<?php
    include_once 'footer.php';
?>