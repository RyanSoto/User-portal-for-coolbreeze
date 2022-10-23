<?php
    include_once 'header.php';
?>

    <section class="container">
        <div class="inner-container">
        <h2>Log in</h2>
        <div class="form-holder"> 
            <form action="includes/login.inc.php" method="post">
            <div class="form-double"> 
                <div class="form-one-half">
                    <label>User Name</label>
                    <input type="text" name="uid" placeholder="Username/Email...">
                </div>
                <div class="form-one-half"> 
                    <label>Password</label>
                    <input type="password" name="pwd" placeholder="Password...">
                </div>
            </div>
                <br>
                <button type="submit" name="submit">Log in</button>
            </form>
        </div>
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