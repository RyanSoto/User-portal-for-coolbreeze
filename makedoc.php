<?php


    include_once 'header.php';

    if (!isset($_SESSION["useruid"]))
    {
        header("location:login.php?error=notloggedin");
        exit();
    } else 

    if  ($_SESSION["usertype"] == "user") {
        header("location: login.php?error=notadmin");
        exit();
    }

    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';

?>

    <section class="container">
                    <h1>Make a Receipt and Holding Deposit Agreement</h1>
                    <p> Name of the applicant </p>
                    <form action="includes/depositform.inc.php" method="post">
                    <input type="text" name="applicant" placeholder="Applicant">
                    <p> Address</p>
                    <input style="width: 400px" type="text" name="address" placeholder="Address">
                    <p> Deposit Amount </p>
                    <input type="text" name="depoAmount" placeholder="Deposit Amount">
                    <p> End Date </p>
                    <input type="date" name="endDate" placeholder="30 days after lease expiration">
                    <button type="submit" name="submit">Review Doc</button>
                    <button type="submit" name="download">Download Doc</button>
                </form>

