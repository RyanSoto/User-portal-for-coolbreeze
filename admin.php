<?php


    include_once 'header.php';

    if (!isset($_SESSION["useruid"]))
    {
        header("location:login.php?error=notloggedin");
        exit();
    } else 

    if  ($_SESSION["usertype"] == "user") {
        header("location: login.php?error=notadmin");
        exit();
    }

    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';

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
                                <h3>Manage Residents</h3>
                            </div>
                            <div>
                                <h3>Manage Maintenance/Repair Requests</h3>
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