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
    <div class="inner-container">
                        <h1>Make a Receipt and Holding Deposit Agreement</h1>
                <div class="form-holder">     
                            
                    <form action="includes/depositform.inc.php" method="post">

                        <div class="form-double">
                            <div class="form-unique"> 
                                <label> Name of the applicant </label>
                                <input type="text" name="applicant" placeholder="Applicant">
                            </div>
                            <div class="form-unique">
                                <label> Address</label>
                                <input style="width: 400px" type="text" name="address" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-double">
                            <div class="form-unique"> 
                                <label> Deposit Amount </label>
                                <input type="text" name="depoAmount" placeholder="Deposit Amount">
                            </div>
                            <div class="form-unique">
                                <label> End Date </label>
                                <input type="date" name="endDate" placeholder="30 days after lease expiration">
                            </div>
                        </div>
                        <button type="submit" name="submit">Review Doc</button>
                        <button type="submit" name="download">Download Doc</button>
                    </form>
                </div>
</div>
</section>

