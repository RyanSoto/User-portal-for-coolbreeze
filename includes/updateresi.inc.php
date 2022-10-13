
<?php

session_start();
if (!isset($_SESSION["useruid"]))
{
    header("location:login.php?error=notloggedin");
    exit();
} else 

if  ($_SESSION["usertype"] == "user") {
    header("location: login.php?error=notadmin");
    exit();
}


if (isset($_POST["submit"])) {
    $id = $_POST['id'];
    $havepaid = $_POST["havepaid"];
    $balance = $_POST["balance"];
    // $lease = $_POST["leaseTerm"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    updateResiDB($conn, $id, $havepaid, $balance);

}   else {
    header("location: ../updateprop.php");
    exit();
}