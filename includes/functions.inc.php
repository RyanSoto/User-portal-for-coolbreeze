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

function loginUser($conn, $username, $pwd, ) {
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
    echo"<tr><td>Balance</td>";
    echo"<tr><td>{$row["bal"]}</td>";
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
    }
}

function adminShowProp($conn) {
    $sql = "SELECT * FROM property;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo"<table border= '1'>";
    echo"<tr><td>Id</td><td>Street Address</td><td>Apt/Unit #</td><td>City</td><td>State</td><td>Zip Code</td><td>Rent</td><td>Occupied?</td><td>Lease</td></tr>";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo"<tr><td>{$row["propId"]}</td><td>{$row["streetAd"]}</td><td>{$row["apt"]}</td><td>{$row["city"]}</td>
            <td>{$row["state"]}</td><td>{$row["zipCode"]}</td><td>{$row["rentTot"]}</td><td>{$row["occupied"]}</td><td>{$row["leaseTerm"]}</td></tr>";
            // echo "{$row["propId"]} {$row["streetAd"]} {$row["apt"]} {$row["city"]} {$row["state"]} {$row["zipCode"]} {$row["rentTot"]} {$row["occupied"]} {$row["leaseTerm"]} {$row["img_path"]} <br>";
        }
    }
}
