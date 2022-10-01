<?php
    include_once 'header.php';

    if (!isset($_SESSION["useruid"]))
    {
        header("location:login.php");
        exit();
    } else 

    if  ($_SESSION["usertype"] == "admin") {
        header("location: login.php?error=notuser");
        exit();
    }
    



?>

            <section class="index-into">
                <?php
                        if (isset($_SESSION["useruid"])) {
                            echo "<p>Howdy user " . $_SESSION["useruid"] ."</p>";

                        }
                ?>
                <h1>Welcome to the user page</h1>
                <p>Here you can make a payment or request.</p>
            </section>
        
<?php
    include_once 'footer.php';
?>