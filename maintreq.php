<?php
    include_once 'header.php';
?>

    <section class="container">
        <div class="inner-container">
        <h2>Please select a type of repair, urgency, and a short description.</h2>
        <form action="includes/maintreq.inc.php" method="post">
        <label for="typeOf">What type of repair</label>
        <select id="typeOf" name="typeOf">
            <option value="plumbing">Plumbing</option>
            <option value="electrical">Electrical</option>
            <option value="appliance">Appliance</option>
            <option value="other">Other</option>
        </select>
        <br>
        <label for="urgency">Urgency</label>
        <select id="urgency" name="urgency">
            <option value="emergency">Emergency!</option>
            <option value="urgent">Urgent.</option>
            <option value="attention">Attention please.</option>
        </select>
        <br>
        <textarea name="descrip" style="width:300px; height:100px;"></textarea>
        <br>
        <button type="submit" name="submit">Send</button>
        </form>
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