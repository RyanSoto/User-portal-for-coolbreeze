<?php
    include_once 'header.php';
    
    userCheck();

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
        // last request was more than 30 minutes ago
        echo "<script>alert('You were logged out for inactivity.');window.location.href='login.php';</script>";
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage

    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>

    <section class="container">
        <div class="inner-container">
        <h2>Please select a type of repair needed, urgency of the request, and write a short description.</h2>
        <div class="form-holder"> 
            <form action="includes/maintreq.inc.php" method="post">
            <div class="form-single">
            <label for="typeOf">What type of repair</label>
            <select id="typeOf" name="typeOf">
                <option value="plumbing">Plumbing</option>
                <option value="electrical">Electrical</option>
                <option value="appliance">Appliance</option>
                <option value="other">Other</option>
            </select>
            </div>
            <div class="form-single">
            <label for="urgency">Urgency</label>
            <select id="urgency" name="urgency">
                <option value="attention">Attention please</option>
                <option value="urgent">Urgent.</option>
                <option value="emergency">Emergency!</option>
            </select>
            </div>
            <div class="form-single">
                <label>Short Description </label>
                <textarea maxlength="256" name="descrip" style="width:540px; height:180px;"></textarea> 
            </div>
            <br>
            <button type="submit" name="submit">Send</button>
            </form>
        </div>
        <?php
        // if (isset($_GET["error"])) {
        //     if ($_GET["error"] == "emptyinput") {
        //         echo "<p>Fill in all fields.</p>";
        //     }
        //     else if ($_GET["error"] == "invaliduid") {
        //         echo "<p>Choose a proper username.</p>";
        //     }
        //     else if ($_GET["error"] == "invalidemail") {
        //         echo "<p>Choose a proper email.</p>";
        //     }
        //     else if ($_GET["error"] == "passwordsdontmatch") {
        //         echo "<p>Passwords don't match.</p>";
        //     }
        //     else if ($_GET["error"] == "stmtfailed") {
        //         echo "<p>Something went wrong, try again.</p>";
        //     }
        //     else if ($_GET["error"] == "usernametaken") {
        //         echo "<p>Username already taken.</p>";
        //     }
        //     else if ($_GET["error"] == "none") {
        //         echo "<p>You have signed up!</p>";
        //     }
        // }
    ?>
    </div>  
    </section>

        
<?php
    include_once 'footer.php';
?>