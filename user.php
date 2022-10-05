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
                        if (isset($_SESSION["useruid"])) {
                            echo "<p>Howdy user " . $_SESSION["useruid"] ." " . $_SESSION["userresnum"] ."</p>";

                        }
                ?>
                <h2>Here you can check your balance, make a payment, or request for maintenance/repair.</h2>
                <div class="bal-check-form">
                    <form action="includes/bal.inc.php" method="get">
                        <button type="submit" name="bal">Check Balance</button>
                    </form>

            </section>
        
<?php
    include_once 'footer.php';
?>