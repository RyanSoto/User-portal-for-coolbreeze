<?php
    include_once 'header.php';
?>

    <section class="container">
        <div class="inner-container">
        <h2>Sign Up</h2>
        <div class="form-holder">
            <form action="includes/signup.inc.php" method="post">
                <div class="form-double">
                    <div class="form-unique">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Full name...">
                    <div class="form-unique">
                        <label>E-mail</label>
                        <input type="text" name="email" placeholder="Email...">
                </div>
                <div class="form-triple">
                    <div class="form-unique">
                        <label>User Name</label>
                        <input type="text" name="uid" placeholder="Username...">
                    </div>
                    <div class="form-unique">
                        <label>Password</label>
                        <input type="password" name="pwd" placeholder="Password...">
                    </div>
                    <div class="form-unique">
                        <label>Repeat Password</label>
                        <input type="password" name="pwdrepeat" placeholder="Repeat password...">
                    </div>
                </div>
                <br> 
                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>
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