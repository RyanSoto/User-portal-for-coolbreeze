<?php

include_once 'header.php';

// userCheck();

// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
//     // last request was more than 30 minutes ago
//     echo "<script>alert('You were logged out for inactivity.');window.location.href='login.php';</script>";
//     session_unset();     // unset $_SESSION variable for the run-time 
//     session_destroy();   // destroy session data in storage

// }
// $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


// include_once 'includes/dbh.inc.php';
// require_once 'includes/functions.inc.php';


?>



<section class="container">
    <div class="inner-container">
        <section class="section-heading">
            <div class="header">
                <h1>Rental Application</h1>
                <p>Here at coolbreezetexas.com, we use the latest enhanced security with SSL to ensure this information is encrypted for your safety.</p>
            </div>
            <div class="header-img">
                <img src="https://coolbreezetexas.com/wp-content/uploads/2022/09/95-959280_padlock-free-icon-level-lock-icon-png.png">
            </div>
        </section>
        <div class="form-holder">
            <form action="includes/application.inc.php" method="post">
                <div class="form-triple">
                    <div class="form-one-third">
                        <label> Rental Application for (address)<span class="required-label">*</span> </label>
                        <select name="appAddress" required>
                            <option value="">Please Select</option>
                            <option value="Vanderbilt, Tx Cottage">Vanderbilt, Tx Cottage</option>
                            <option value="Cologne, Tx Cottage">Cologne, Tx Cottage</option>
                        </select>
                    </div>
                    <div class="form-one-third">
                        <label>Desired length of occupancy<span class="required-label">*</span> </label>
                        <section class="radios">
                            <span class="wrappable">
                                <label for="Weekly">
                                    <input type="radio" name="lengthOfOcc" value="Weekly" required>
                                    Weekly
                                </label>
                            </span>
                            <br>
                            <span class="wrappable">
                                <label for="6 months">
                                    <input type="radio" name="lengthOfOcc" value="6 months">
                                    6 months
                                </label>
                            </span>
                            <br>
                            <span class="wrappable">
                                <label for="12 months">
                                    <input type="radio" name="lengthOfOcc" value="12 months">
                                    12 months
                                </label>
                            </span>
                        </section>
                    </div>
                    <div class="form-one-third">
                        <label>Desired move-in date<span class="required-label">*</span></label>
                        <input type="text" id="datetime" class="moveindate" data-rule-inputmask-incomplete="1" data-inputmask-alias="moveindate" data-inputmask-inputformat="mm/dd/yyyy" name="moveindate" required inputmode="numeric" required = "">
                    </div>
                </div>
                <div class="form-triple">
                    <div class="form-one-third">
                        <label> Name<span class="required-label">*</span> </label>
                        <input type="text" name="fname" required="" placeholder="First name">
                    </div>
                    <div class="form-one-third">

                        <label style="visibility:hidden"> Last</label>
                        <input type="text" name="lname" required="" placeholder="Last name">
                    </div>
                </div>
                <div class="form-double">
                    <div class="form-one-half">
                        <label> Email<span class="required-label">*</span> </label>
                        <input type="text" name="email" required="">
                    </div>

                    <div class="form-one-half">
                        <label> Phone Number<span class="required-label">*</span> </label>
                        <input type="text" name="phone" placeholder="" required="">
                    </div>
                </div>
                <div class="form-single">
                    <div class="form-one-half">
                        <label> Current or Last Address<span class="required-label">*</span> </label>
                        <input type="text" name="lastadd" placeholder="" required="">
                        <div class="forms-field-description">Street number, name, unit/apt #
                        </div>
                    </div>
                </div>
                <div class="form-single">
                    <div class="form-one-half">
                        <!-- <label style="visibility:hidden"> Current or Last Address Line 2</label> -->
                        <input type="text" name="lastadd2" placeholder="">
                        <div class="forms-field-description">Address Line 2
                        </div>
                    </div>
                </div>
                <div class="form-triple">
                    <div class="form-one-third">
                        <label> City<span class="required-label">*</span> </label>
                        <input type="text" name="city" placeholder="" required="">
                    </div>
                    <div class="form-one-third">
                        <label>State<span class="required-label">*</span></label>
                        <input type="text" name="state" placeholder="" required="">
                    </div>
                    <div class="form-one-third">
                        <label>Zip Code<span class="required-label">*</span></label>
                        <input type="text" name="zipCode" placeholder="" required="">
                    </div>
                </div>
                <div class="form-triple">
                    <div class="form-one-third">
                        <!-- <div class="form-medium"> -->
                        <label> Monthly Rent/Mortgage Payments<span class="required-label">*</span> </label>
                        <input type="text" name="monthRent" placeholder="" required="">
                    </div>

                    <!-- </div> -->
                    <div class="form-one-third">
                        <label> How Long Did You Stay at This Address?<span class="required-label">*</span> </label>
                        <select name="lastaddlen" required>
                            <option value="">Please Select</option>
                            <option value="3-6 months">3-6 months</option>
                            <option value="6-12 months">6-12 months</option>
                            <option value="1-2 years">1-2 years</option>
                            <option value="2+ years">2+ years</option>
                        </select>
                    </div>
                </div>
                <div class="form-triple">
                    <div class="form-one-third">
                        <label> Employment Status<span class="required-label">*</span> </label>
                        <select name="employmentstat" required>
                            <option value="">Please Select</option>
                            <option value="Currently Employed">Currently Employed</option>
                            <option value="Seeking Employed">Seeking Employment</option>
                            <option value="Laying Low">Laying Low</option>
                            <option value="Retired">Retired</option>
                        </select>
                    </div>
                    <div class="form-one-third">
                        <label>Company</label>
                        <input type="text" name="company" placeholder="">
                    </div>
                    <div class="form-one-third">
                        <label>Monthly Gross Income<span class="required-label">*</span></label>
                        <input type="text" name="grossinc" placeholder="" required="">
                    </div>
                </div>
                <div class="form-double">
                    <div class="form-one-third form-tiny">
                        <div class="form-tiny">
                            <label> Pets<span class="required-label">*</span> </label>
                            <select name="pets" required>
                                <option value="">Please Select</option>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-one-half">
                        <label> Pet Description </label>
                        <input type="text" name="petsdescrip" placeholder="">
                        <div class="forms-field-description">If yes, please desribe.
                        </div>
                    </div>
                </div>
                <div class="form-single">
                    <div class="form-one-third">
                        <label> Will you be the only occupant?<span class="required-label">*</span> </label>
                        <div class="form-large">
                            <select name="onlyoccupant" required>
                                <option value="">Please Select</option>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-triple">
                    <div class="form-one-third">
                        <label> Name </label>
                        <input type="text" name="occupant2fname" placeholder="First name">
                    </div>
                    <div class="form-one-third">
                        <label style="visibility:hidden"> Last</label>
                        <input type="text" name="occupant2lname" placeholder="Last name">
                    </div>
                    <div class="form-one-third">
                        <label> Relationship</label>
                        <input type="text" name="occupant2relation" placeholder="">
                    </div>
                </div>
                <div class="form-triple">
                    <div class="form-one-third">
                        <label> Name </label>
                        <input type="text" name="occupant3fname" placeholder="First name">
                    </div>
                    <div class="form-one-third">

                        <label style="visibility:hidden"> Last</label>
                        <input type="text" name="occupant3lname" placeholder="Last name">
                    </div>
                    <div class="form-one-third">
                        <label> Relationship</label>
                        <input type="text" name="occupant3relation" placeholder="">
                    </div>
                </div>



                <div class="form-triple">
                    <div class="form-one-third">
                        <label> Do you have a Social Security Number?<span class="required-label">*</span> </label>
                        <select name="haveSSN" required>
                            <option value="">Please Select</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                    <div class="form-one-third">
                        <label>SSN</label>
                        <input type="text" name="SSN" placeholder="">
                    </div>
                    <div class="form-one-third">
                        <label>Date of Birth<span class="required-label">*</span></label>
                        <input type="text" name="dob" placeholder="" required="">
                    </div>
                </div>

                <div class="form-triple">
                    <div class="form-one-third">
                        <label> Have you ever been evicted<span class="required-label">*</span> </label>
                        <div class="form-medium">
                            <select name="haveEviction" required>
                                <option value="">Please Select</option>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-one-half">
                        <label> If yes, explain. </label>
                        <input type="text" name="eviction" placeholder="">
                        <div class="forms-field-description">If yes, please desribe.
                        </div>
                    </div>
                </div>

                <div class="form-triple">
                    <div class="form-one-third">
                        <label> Have you ever been <br> convicted of a felony?<span class="required-label">*</span> </label>
                        <div class="form-medium">
                            <select name="haveFelony" required>
                                <option value="">Please Select</option>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-one-half tick-down">
                        <label> If yes, explain. </label>
                        <input type="text" name="felony" placeholder="">
                    </div>
                </div>

                <div class="form-single">
                    <div class="form-whole">
                        <label>Comment or Message</label>
                        <textarea maxlength="256" name="comment" style="width: 100%; height:150px;"></textarea>
                    </div>
                </div>
                <br>
        </div>

        <div class="form-one-third">
            <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
</section>


<?php
include_once 'footer.php';
?>