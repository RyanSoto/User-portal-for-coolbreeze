<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdReapeat) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdReapeat)) {
        $result = true;
    }   else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }   else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }   else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
    $result;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }   else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss" , $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }   
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "ssss" , $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();

}

function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }   else {
        $result = false;
    }
    return $result;
}

function createReq($conn, $assocProp, $resident, $urgency, $typeOf, $descrip) {
    $sql = "INSERT INTO main_req (assocProp, resident, urgency, typeOf, descrip) VALUES (?, ?, ?, ?, ?);";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../maintreq.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss" , $assocProp, $resident, $urgency, $typeOf, $descrip);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../maintreq.php?error=none");
    exit();

}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd= password_verify($pwd, $pwdHashed); 
    

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];


        $usertype = $uidExists["usersType"];
        
        if ($usertype === "admin") {

            $_SESSION["usertype"] = $usertype;
            header("location: ../admin.php?user=admin");

            exit(); 
        }
        else {
            $_SESSION["userresnum"] = $uidExists["usersResNum"];
            $_SESSION["userprop"] = $uidExists["usersProp"];
            $_SESSION["usertype"] = $uidExists["usersType"];
            header("location: ../user.php?user=user");

            exit(); 
        }
        
    }
}

function userShowBal($conn) {
    $userResNum = $_SESSION["userresnum"];

    $sql = "SELECT * FROM residents WHERE id=?;";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s" , $userResNum);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = $result->fetch_assoc();

    echo"<table border= '1'>";
    echo"<tr><td>Balance</td></tr>";
    echo"<tr><td>{$row["bal"]}</td></tr>";
    echo"</table>";
}

function userShowProp($conn) {
    $userProp = $_SESSION["userprop"];

    $sql = "SELECT * FROM property WHERE propId=?;";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s" , $userProp);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resultCheck = mysqli_num_rows($result);
    echo"<table border= '1'>";
    echo"<tr><td>Street Address</td><td>Apt/Unit #</td><td>City</td><td>State</td><td>Zip Code</td><td>Rent</td><td>Lease</td></tr>";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo"<tr><td>{$row["streetAd"]}</td><td>{$row["apt"]}</td><td>{$row["city"]}</td>
            <td>{$row["state"]}</td><td>{$row["zipCode"]}</td><td>$ {$row["rentTot"]}</td><td>{$row["leaseTerm"]}</td></tr>";
        }
    }echo"</table>";
}

function adminShowAllProp($conn) {
    $sql = "SELECT * FROM property;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo" <table border= '1'>";
    echo"<tr><td></td><td>Id</td><td>Street Address</td><td>Apt/Unit #</td><td>City</td><td>State</td><td>Zip Code</td><td>Rent</td><td>Occupied?</td><td>Lease</td></tr>";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo"<tr><td><a href='updateprop.php?id={$row["propId"]}' method='post'><button type='submit' name='update'>Update</button></a></td>
            <td>{$row["propId"]}</td><td>{$row["streetAd"]}</td><td>{$row["apt"]}</td><td>{$row["city"]}</td>
            <td>{$row["state"]}</td><td>{$row["zipCode"]}</td><td>$ {$row["rentTot"]}</td><td>{$row["occupied"]}</td>
            <td>{$row["leaseTerm"]}</td></tr>";
        }
    }echo"</table>";
}

function adminShowProp($conn) {
    if (isset($_GET['id'])) {
        // require_once 'includes/dbh.inc.php';
        // include_once 'includes/functions.inc.php';

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM property WHERE propId='$id';";
        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
        $row =mysqli_fetch_array($result);
        echo" <form action='includes/updateprop.inc.php' method='post'>";
        echo" <table border= '1'>";
        echo"<tr><td>Id</td><td>Street Address</td><td>Apt/Unit #</td>
        <td>City</td><td>State</td><td>Zip Code</td><td>Rent</td><td>Occupied?</td><td>Lease</td></tr>";
        echo"<tr><td>{$row["propId"]}</td><td>{$row["streetAd"]}</td><td>{$row["apt"]}</td><td>{$row["city"]}</td>
        <td>{$row["state"]}</td><td>{$row["zipCode"]}</td>
        <td>$ <input style='width:75px' type='text' name='rent' value='{$row["rentTot"]}'></td>
        <td><select style='width:100px' name='occupied'> 
                <option value='{$row["occupied"]}'>{$row["occupied"]}</option>
                <option value='No'>No</option>
                <option value='Reserved'>Reserved</option>
                <option value='Yes'>Yes</option>
            </select></td>
        <td><select style='width:100px' name='leaseTerm'> 
                <option value='{$row["leaseTerm"]}'>{$row["leaseTerm"]}</option>
                <option value='NA'>NA</option>
                <option value='3 month'>3 month</option>
                <option value='6 month'>6 month</option>
                <option value='12 month'>12 month</option>
            </select></td>
            <input type='hidden' name='id' value='$id'>
            </table><button type='submit' name='submit'>Update</button>";
        echo" </form>";
    }
}

function updatePropDB($conn, $id, $rent, $occupied, $lease) {
        $sql = "UPDATE property SET rentTot = ?, occupied = ?, leaseTerm = ? WHERE propId = ?;";
        $stmt= mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../updateprop.php?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "sssi" , $rent, $occupied, $lease, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../manageprop.php?error=none");
        exit();
}

function adminShowAllResi($conn) {
    $sql = "SELECT * FROM residents;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo" <table border= '1'>";
    echo"<tr><td></td><td>Id</td><td>Account Number</td><td>Name</td><td>E-mail</td><td>Associated Property</td>
    <td>Maintenance Requests</td><td>Paid this month?</td><td>Balance</td>";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo"<tr><td><a href='updateresi.php?id={$row["id"]}' method='post'><button type='submit' name='update'>Update</button></a></td>
            <td>{$row["id"]}</td><td>{$row["accNum"]}</td><td>{$row["name"]}</td><td>{$row["email"]}</td>
            <td>{$row["assocProp"]}</td><td>{$row["maintReq"]}</td><td>{$row["havepaid"]}</td><td>$ {$row["bal"]}</td>
            </tr>";
        }
    }echo"</table>";
}

function adminShowResi($conn) {
    if (isset($_GET['id'])) {
        // require_once 'includes/dbh.inc.php';
        // include_once 'includes/functions.inc.php';

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM residents WHERE id='$id';";
        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
        $row =mysqli_fetch_array($result);
        echo" <form action='includes/updateresi.inc.php' method='post'>";
        echo" <table border= '1'>";
        echo"<tr><td>Id</td><td>Account Number</td><td>Name</td><td>E-mail</td><td>Associated Property</td>
            <td>Maintenance Requests</td><td>Paid this month?</td><td>Balance</td>";
        echo"<tr><td>{$row["id"]}</td><td>{$row["accNum"]}</td><td>{$row["name"]}</td><td>{$row["email"]}</td>
            <td>{$row["assocProp"]}</td><td>{$row["maintReq"]}</td>
            <td><select style='width:100px' name='havepaid'> 
                <option value='{$row["havepaid"]}'>{$row["havepaid"]}</option>
                <option value='No'>No</option>
                <option value=Payment Scheduled'>Payment Scheduled</option>
                <option value='Yes'>Yes</option>
            </select></td>
            <td>$ <input style='width:75px' type='text' name='balance' value='{$row["bal"]}'></td>
            <input type='hidden' name='id' value='$id'>
            </table><button type='submit' name='submit'>Update</button>";
        echo" </form>";
    }
}

function updateResiDB($conn, $id, $havepaid, $balance) {
    $sql = "UPDATE residents SET havepaid = ?, bal = ? WHERE id = ?;";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../updateresi.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ssi" , $havepaid, $balance, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../manageresi.php?error=none");
    exit();
}