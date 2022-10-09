<?php
    include_once 'header.php';
?>

    <section class="container">
        <div class="inner-container">
        <h2>Sign Up</h2>
        <form action="includes/signup.inc.php" method="post">
            <p>Full Name</p>
            <input type="text" name="name" placeholder="Full name...">
            <p>E-mail</p>
            <input type="text" name="email" placeholder="Email...">
            <p>User Name</p>
            <input type="text" name="uid" placeholder="Username...">
            <p>Password</p>
            <input type="password" name="pwd" placeholder="Password...">
            <p>Repeat Password</p>
            <input type="password" name="pwdrepeat" placeholder="Repeat password...">
            <br> <br>
            <button type="submit" name="submit">Sign Up</button>
        </form>
        </div>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields.</p>";
            }
            else if ($_GET["error"] == "invaliduid") {
                echo "<p>Choose a proper username.</p>";
            }
            else if ($_GET["error"] == "invalidemail") {
                echo "<p>Choose a proper email.</p>";
            }
            else if ($_GET["error"] == "passwordsdontmatch") {
                echo "<p>Passwords don't match.</p>";
            }
            else if ($_GET["error"] == "stmtfailed") {
                echo "<p>Something went wrong, try again.</p>";
            }
            else if ($_GET["error"] == "usernametaken") {
                echo "<p>Username already taken.</p>";
            }
            else if ($_GET["error"] == "none") {
                echo "<p>You have signed up!</p>";
            }
        }
    ?>  
    </section>

        
<?php
    include_once 'footer.php';
?>