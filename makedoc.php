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
    
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
        // last request was more than 30 minutes ago
        echo "<script>alert('You were logged out for inactivity.');window.location.href='login.php';</script>";
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage

    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    include_once 'includes/dbh.inc.php';
    include_once 'includes/functions.inc.php';

?>

<section class="container">
<div class="inner-container">
                    <h1>Make a Receipt and Holding Deposit Agreement</h1>
            <div class="form-holder">     
                        
                <form action="includes/depositform.inc.php" method="post">

                    <div class="form-double">
                        <div class="form-one-third"> 
                            <label> Name of the applicant </label>
                            <input type="text" name="applicant" placeholder="Applicant">
                        </div>
                        <div class="form-two-thirds">
                            <label> Address</label>
                            <input type="text" name="address" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-double">
                        <div class="form-one-half"> 
                            <label> Deposit Amount </label>
                            <input type="text" name="depoAmount" placeholder="Deposit Amount">
                        </div>
                        <div class="form-one-half">
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

<section class="container">
<div class="inner-container">
                    <h1>Make a Residential Lease Agreement</h1>
            <div class="form-holder">     
                <form action="includes/leaseform.inc.php" method="post">
                    <div class="form-double">
                        <div class="form-one-third"> 
                            <label> Name of the Tenant </label>
                            <input type="text" name="tenant" placeholder="Tenant">
                        </div>
                        <div class="form-two-thirds">
                            <label> Address</label>
                            <input class="form-large" type="text" name="address" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-double">
                        <div class="form-one-half"> 
                            <label> Deposit Amount </label>
                            <input type="text" name="depoAmount" placeholder="Deposit Amount">
                        </div>
                        <div class="form-one-half">
                            <label> Lease Term </label>
                            <select name="leaseTerm" placeholder="Lease Terms">
                                <option value="12 months">12 months</option>
                                <option value="6 months">6 months</option>
                                <option value="18 months">18 months</option>
                                <option value="24 months">24 months</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-triple">
                            <div class="form-one-third">
                                <label> Start Day </label>
                                <select name="lsday" class="lsday form-medium">
                                    <option value="">Day</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                    <option value="4th">4th</option>
                                    <option value="5th">5th</option>
                                    <option value="6th">6th</option>
                                    <option value="7th">7th</option>
                                    <option value="8th">8th</option>
                                    <option value="9th">9th</option>
                                    <option value="10th">10th</option>
                                    <option value="11th">11th</option>
                                    <option value="12th">12th</option>
                                    <option value="13th">13th</option>
                                    <option value="14th">14th</option>
                                    <option value="15th">15th</option>
                                    <option value="16th">16th</option>
                                    <option value="17th">17th</option>
                                    <option value="18th">18th</option>
                                    <option value="19th">19th</option>
                                    <option value="20th">20th</option>
                                    <option value="21st">21st</option>
                                    <option value="22nd">22nd</option>
                                    <option value="23rd">23rd</option>
                                    <option value="24th">24th</option>
                                    <option value="25th">25th</option>
                                    <option value="26th">26th</option>
                                    <option value="27th">27th</option>
                                    <option value="28th">28th</option>
                                    <option value="29th">29th</option>
                                    <option value="30th">30th</option>
                                    <option value="31st">31st</option>
                                </select>
                            </div>
                            <div class="form-one-third">
                                <label> Start Month </label>
                                <select name="lsmonth" class="form-medium">
                                    <option value="">Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select> 
                            </div>
                            <div class="form-one-third">
                                <label> Start Year </label>
                                <input class="form-medium" type="text" name="lsyear" value="22">
                            </div>
                        </div>
                        <div class="form-triple">
                            <div class="form-one-third">
                                <label> End Day </label>
                                <select name="leday" class="lsday form-medium">
                                    <option value="">Day</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                    <option value="4th">4th</option>
                                    <option value="5th">5th</option>
                                    <option value="6th">6th</option>
                                    <option value="7th">7th</option>
                                    <option value="8th">8th</option>
                                    <option value="9th">9th</option>
                                    <option value="10th">10th</option>
                                    <option value="11th">11th</option>
                                    <option value="12th">12th</option>
                                    <option value="13th">13th</option>
                                    <option value="14th">14th</option>
                                    <option value="15th">15th</option>
                                    <option value="16th">16th</option>
                                    <option value="17th">17th</option>
                                    <option value="18th">18th</option>
                                    <option value="19th">19th</option>
                                    <option value="20th">20th</option>
                                    <option value="21st">21st</option>
                                    <option value="22nd">22nd</option>
                                    <option value="23rd">23rd</option>
                                    <option value="24th">24th</option>
                                    <option value="25th">25th</option>
                                    <option value="26th">26th</option>
                                    <option value="27th">27th</option>
                                    <option value="28th">28th</option>
                                    <option value="29th">29th</option>
                                    <option value="30th">30th</option>
                                    <option value="31st">31st</option>
                                </select>
                            </div>
                            <div class="form-one-third">
                                <label> End Month </label>
                                <select class="form-medium" name="lemonth">
                                    <option value="">Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select> 
                            </div>
                            <div class="form-one-third">
                                <label> End Year </label>
                                <input type="text" class="form-medium" name="leyear" value="23">
                            </div>
                        </div>
                        <div class="form-triple">
                            <div class="form-one-third">
                                <label> Rent Total </label>
                                <input class="form-large" type="text" name="rentTot" placeholder="Total rent of Lease">
                            </div>
                            <div class="form-one-third">
                                <label> Rent Monthly </label>
                                <input class="form-large" type="text" name="rentMon" placeholder="Total rent per Month">
                            </div>
                            <div class="form-one-third">
                                <label> Prorated First Month </label>
                                <input class="form-large" type="text" name="prorate" placeholder="Prorated 1st month">
                            </div>
                        </div>
                        <div class="form-double">
                            <div class="form-one-half">
                                <label> Max Occupancy </label>
                                <input type="text" class="form-medium" name="occupanymax" placeholder="Maximum occupancy">
                            </div>
                            <div class="form-one-half">
                                <label> Max Vehicles </label>
                                <input type="text" class="form-medium" name="maxVehicles" placeholder="Maximum vehicles">
                            </div>
                        </div>
                        <div class="form-unique">
                            <label> Special Provisions</label>
                            <input type="text" name="specialProv" placeholder="Special needs promised">
                        </div>
                    </div>
                    <button type="submit" name="submit">Review Doc</button>
                    <button type="submit" name="download">Download Doc</button>
                </form>
            </div>
</div>
</section>

