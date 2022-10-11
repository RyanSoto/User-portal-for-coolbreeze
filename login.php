<?php
    include_once 'header.php';
?>

    <section class="container">
        <div class="inner-container">
        <h2>Log in</h2>
            <form action="includes/login.inc.php" method="post">
                <p>User Name</p>
                <input type="text" name="uid" placeholder="Username/Email...">
                <p>Password</p>
                <input type="password" name="pwd" placeholder="Password...">
                <br><br>
                <button type="submit" name="submit">Log in</button>
            </form>
        </div>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields.</p>";
            }
            else if ($_GET["error"] == "wronglogin") {
                echo "<p>Incorrect login information.</p>";
            }
            else if ($_GET["error"] == "notuser") {
                echo "<p>You can't access user accounts as an admin.</p>";
            }
            else if ($_GET["error"] == "notadmin") {
                echo "<p>You are not an admin.</p>";
            }
        }
    ?>  
    </section>
            
        
<?php
    include_once 'footer.php';
?>