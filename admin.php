<?php
    include_once 'header.php';
?>

            <section class="index-into">
                <?php
                        if (isset($_SESSION["useruid"])) {
                            echo "<p>Howdy admin user " . $_SESSION["useruid"] ."</p>";

                        }
                ?>
                <h1>Welcome to the admin page</h1>
                <p>Time to take care of business!</p>
            </section>
        
<?php
    include_once 'footer.php';
?>