<?php

include_once '../header1.php';

// adminCheck();
// timeOutLogout();

// include_once 'includes/dbh.inc.php';
// require_once 'includes/functions.inc.php';

if ((isset($_POST["submit"])) || (isset($_POST["download"]))) {

$owner = $_POST["owner"];
$ownerAdd = $_POST["ownerAdd"];
$tenant = $_POST["tenant"];
$address = $_POST["address"];
$depoAmount = $_POST["depoAmount"];
$todayDay = date('jS');
$todayMonth = date('F');
$todayYear = date('y');
$leaseTerm = $_POST["leaseTerm"];
$lsday = $_POST["lsday"];
$lsmonth = $_POST["lsmonth"];
$lsyear = $_POST["lsyear"];
$leday = $_POST["leday"];
$lemonth = $_POST["lemonth"];
$leyear = $_POST["leyear"];
$rentTot = $_POST["rentTot"];
$rentMon = $_POST["rentMon"];
$prorate = $_POST["prorate"];
$occupanymax = $_POST["occupanymax"];
$maxVehicles = $_POST["maxVehicles"];
$specialProv = $_POST["specialProv"];
$ownerPay = $_POST["ownerPay"];

} else {

$leaseID = '$leasesID';
$json = file_get_contents('leasevariables' . $leaseID . '.json');
$leasevariables = json_decode($json);

$owner = $leasevariables->owner;
$ownerAdd = $leasevariables->ownerAdd;
$tenant = $leasevariables->tenant;
$address = $leasevariables->address;
$depoAmount = $leasevariables->depoAmount;
$todayDay = $leasevariables->todayDay;
$todayMonth = $leasevariables->todayMonth;
$todayYear = $leasevariables->todayYear;
$leaseTerm = $leasevariables->leaseTerm;
$lsday = $leasevariables->lsday;
$lsmonth = $leasevariables->lsmonth;
$lsyear = $leasevariables->lsyear;
$leday = $leasevariables->leday;
$lemonth = $leasevariables->lemonth;
$leyear = $leasevariables->leyear;
$rentTot = $leasevariables->rentTot;
$rentMon = $leasevariables->rentMon;
$prorate = $leasevariables->prorate;
$occupanymax = $leasevariables->occupanymax;
$maxVehicles = $leasevariables->maxVehicles;
$specialProv = $leasevariables->specialProv;
$dir = $leasevariables->dir;
$sigPng = $leasevariables->sigPng;
$ownerPay = $leasevariables->ownerPay;
$leaseFileName = $leasevariables->leaseFileName;
}

$fileName = $tenant . "Lease.pdf";

?>

<section class="container">
    <div class="inner-container">
        <h1>Confirm lease agreement entries</h1>
        <div class="form-triple">
            <div class="form-one-third">
                <h3>Tenant</h3>
                <p> <?= $tenant ?> </p>
            </div>
            <div class="form-two-thirds">
                <h3>Address</h3>
                <p> <?= $address ?> </p>
            </div>
        </div>
        <div class="form-triple">
            <div class="form-one-third">
                <h3>Lease length</h3>
                <p> <?= $leaseTerm ?> </p>
            </div>
            <div class="form-two-thirds">
                <h3>Special Provisions</h3>
                <p> <?= $specialProv ?> </p>
            </div>
        </div>
        <div class="form-single">
            <!-- <div class="form-one-half"> -->
            <form action="../../includes/leaseform.inc.php" method="post" target="_blank">
                <input type="hidden" name="owner" value="<?= $owner ?>">
                <input type="hidden" name="ownerAdd" value="<?= $ownerAdd ?>">
                <input type="hidden" name="tenant" value="<?= $tenant ?>">
                <input type="hidden" name="address" value="<?= $address ?>">
                <input type="hidden" name="depoAmount" value="<?= $depoAmount ?>">
                <input type="hidden" name="leaseTerm" value="<?= $leaseTerm ?>">
                <input type="hidden" name="lsday" value="<?= $lsday ?>">
                <input type="hidden" name="lsmonth" value="<?= $lsmonth ?>">
                <input type="hidden" name="lsyear" value="<?= $lsyear ?>">
                <input type="hidden" name="todayDay" value="<?= $todayDay ?>">
                <input type="hidden" name="todayMonth" value="<?= $todayMonth ?>">
                <input type="hidden" name="todayYear" value="<?= $todayYear ?>">
                <input type="hidden" name="leday" value="<?= $leday ?>">
                <input type="hidden" name="lemonth" value="<?= $lemonth ?>">
                <input type="hidden" name="leyear" value="<?= $leyear ?>">
                <input type="hidden" name="rentTot" value="<?= $rentTot ?>">
                <input type="hidden" name="rentMon" value="<?= $rentMon ?>">
                <input type="hidden" name="prorate" value="<?= $prorate ?>">
                <input type="hidden" name="occupanymax" value="<?= $occupanymax ?>">
                <input type="hidden" name="maxVehicles" value="<?= $maxVehicles ?>">
                <input type="hidden" name="specialProv" value="<?= $specialProv ?>">
                <input type="hidden" name="dir" value="<?= $dir ?>">
                <input type="hidden" name="sigPng" value="<?= $sigPng ?>">
                <input type="hidden" name="ownerPay" value="<?= $ownerPay ?>">
                <input type="hidden" name="leaseFileName" value="<?= $leaseFileName ?>">
                <button type="submit" name="submit">Review Lease</button>
        </div>
        </form>
        <br>

        <form action="../signlease.php" method="post">
            <div class="form-whole">
                <div class="form-checkbox">
                    <input type="checkbox" id="leasecheck" class="leasecheck" name="leasecheck" value="Agree" required>

                    <label class="chklabel" for="leasecheck"> By checking this box you agree to the terms of this lease. You agree
                        that this agreement may be electronically signed. You agree that the electronic signatures
                        appearing on this agreement are the same as handwritten signatures for the purposes of validity and
                        admissibility.</label></input>
                </div>
            </div>
                <br>
                <input type="hidden" name="owner" value="<?= $owner ?>">
                <input type="hidden" name="ownerAdd" value="<?= $ownerAdd ?>">
                <input type="hidden" name="tenant" value="<?= $tenant ?>">
                <input type="hidden" name="address" value="<?= $address ?>">
                <input type="hidden" name="depoAmount" value="<?= $depoAmount ?>">
                <input type="hidden" name="leaseTerm" value="<?= $leaseTerm ?>">
                <input type="hidden" name="todayDay" value="<?= $todayDay ?>">
                <input type="hidden" name="todayMonth" value="<?= $todayMonth ?>">
                <input type="hidden" name="todayYear" value="<?= $todayYear ?>">
                <input type="hidden" name="lsday" value="<?= $lsday ?>">
                <input type="hidden" name="lsmonth" value="<?= $lsmonth ?>">
                <input type="hidden" name="lsyear" value="22">
                <input type="hidden" name="leday" value="<?= $leday ?>">
                <input type="hidden" name="lemonth" value="<?= $lemonth ?>">
                <input type="hidden" name="leyear" value="<?= $leyear ?>">
                <input type="hidden" name="rentTot" value="<?= $rentTot ?>">
                <input type="hidden" name="rentMon" value="<?= $rentMon ?>">
                <input type="hidden" name="prorate" value="<?= $prorate ?>">
                <input type="hidden" name="occupanymax" value="<?= $occupanymax ?>">
                <input type="hidden" name="maxVehicles" value="<?= $maxVehicles ?>">
                <input type="hidden" name="specialProv" value="<?= $specialProv ?>">
                <input type="hidden" name="dir" value="<?= $dir ?>">
                <input type="hidden" name="sigPng" value="<?= $sigPng ?>">
                <input type="hidden" name="ownerPay" value="<?= $ownerPay ?>">
                <input type="hidden" name="leaseFileName" value="<?= $leaseFileName ?>">

                <button type="save" name="save">Sign Lease</button>
        </form>
</section>

<?php
include_once 'footer.php';
?>




<!-- <form action="includes/leaseform.inc.php" method="post">

    <input type="hidden" name="tenant" value="<?= $tenant ?>">
    <input type="hidden" name="address" value="<?= $address ?>">
    <input type="hidden" name="depoAmount" value="<?= $depoAmount ?>">
    <input type="hidden" name="leaseTerm" value="<?= $leaseTerm ?>">
    <input type="hidden" name="lsday" value="<?= $lsday ?>">
    <input type="hidden" name="lsmonth" value="<?= $lsmonth ?>">
    <input type="hidden" name="lsyear" value="22">
    <input type="hidden" name="leday" value="<?= $leday ?>">
    <input type="hidden" name="lemonth" value="<?= $lemonth ?>">
    <input type="hidden" name="leyear" value="<?= $leyear ?>">
    <input type="hidden" name="rentTot" value="<?= $rentTot ?>">
    <input type="hidden" name="rentMon" value="<?= $rentMon ?>">
    <input type="hidden" name="prorate" value="<?= $prorate ?>">
    <input type="hidden" name="occupanymax" value="<?= $occupanymax ?>">
    <input type="hidden" name="maxVehicles" value="<?= $maxVehicles ?>">
    <input type="hidden" name="specialProv" value="<?= $specialProv ?>">

</form> -->