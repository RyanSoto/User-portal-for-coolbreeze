<?php
session_start();

if (isset($_POST["submit"])) {

    $assocProp = $_SESSION["userprop"];
    $resident = $_SESSION["userresnum"];
    $urgency = $_POST["urgency"];
    $typeOf = $_POST["typeOf"];
    $descrip = $_POST["descrip"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // if (emptyInputMaintReq($assocProp, $resident, $urgency, $typeOf, $descrip) !== false) {
    //     header("location: ../maintreq.php?error=emptyinput");
    //     exit();
    // }

    // if (invalidUid($username) !== false) {
    //     header("location: ../signup.php?error=invaliduid");
    //     exit();
    // }
    
    // if (invalidEmail($email) !== false) {
    //     header("location: ../signup.php?error=invalidemail");
    //     exit();
    // }

    // if (pwdMatch($pwd, $pwdReapeat) !== false) {
    //     header("location: ../signup.php?error=passwordsdontmatch");
    //     exit();
    // }

    // if (uidExists($conn, $username, $email) !== false) {
    //     header("location: ../signup.php?error=usernametaken");
    //     exit();
    // }

    createReq($conn, $assocProp, $resident, $urgency, $typeOf, $descrip);


 

}   else {
        header("location: ../maintreq.php");
        exit();
    }