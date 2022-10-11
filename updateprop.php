<!-- update rent, occupied, lease -->

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
                        <h1>Update Property</h1>
                        <?php
                        adminUpdateProp($conn)
                        ?>
                    </div>
    </section>
                        