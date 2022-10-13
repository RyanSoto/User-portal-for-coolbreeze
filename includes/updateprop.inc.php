
<?php

session_start();
if (!isset($_SESSION["useruid"]))
{
    header("location:../login.php?error=notloggedin");
    exit();
} else 

if  ($_SESSION["usertype"] == "user") {
    header("location: ../login.php?error=notadmin");
    exit();
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
    // last request was more than 30 minutes ago
    echo "<script>alert('You were logged out for inactivity.');window.location.href='../login.php';</script>";
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage

}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


if (isset($_POST["submit"])) {
    $id = $_POST['id'];
    $rent = $_POST["rent"];
    $occupied = $_POST["occupied"];
    $lease = $_POST["leaseTerm"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    updatePropDB($conn, $id, $rent, $occupied, $lease);

}   else {
    header("location: ../updateprop.php");
    exit();
}