<!-- update maintenance requests -->

<?php


    include_once 'header.php';

    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';

    adminCheck();
    timeOutLogout();

?>

    <section class="container">
                    <div class="inner-container">
                        <h1>Update Resident</h1>
                        <?php
                        adminShowReq($conn)
                        ?>
                    </div>
    </section>
                        