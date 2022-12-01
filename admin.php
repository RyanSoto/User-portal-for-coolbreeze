<?php


    include_once 'header.php';
    include_once 'includes/functions.inc.php';
    include_once 'includes/dbh.inc.php';
    
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
                        <h2>Make changes to the database or create a document</h2>
                        <div class="admin-categories-list">
                            <div>
                                <h3><a href='manageprop.php'>Manage Properties</a></h3>
                            </div>
                            <div>
                                <h3><a href='manageresi.php'>Manage Residents</a></h3>
                            </div>
                            <div>
                                <h3><a href='managemaint.php'>Manage Maintenance/Repair Requests</a></h3>
                            </div>
                            <div>
                                <h3><a href='makedoc.php'>Create a document</a></h3>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        
<?php
    include_once 'footer.php';
?>