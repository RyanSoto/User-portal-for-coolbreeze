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
    echo "<script>alert('Your request has been sent!');window.location.href='../user.php?error=none';</script>"; 
    // header("location: ../user.php?error=none");
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
    echo"<tr><td>$ {$row["bal"]}</td></tr>";
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
    echo"<tr><td>Street Address</td><td>Apt/Unit #</td><td>City</td><td>State</td><td>Zip Code</td><td>Rent</td><td>Leased</td></tr>";
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
    echo"<tr><td></td><td>Id</td><td>Street Address</td><td>Apt/Unit #</td><td>City</td><td>State</td><td>Zip Code</td><td>Rent</td><td>Occupied?</td><td>Leased</td></tr>";
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
                <option value='No'>No</option>
                <option value='Yes'>Yes</option>
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
    <td>Paid this month?</td><td width='150'>Balance</td>";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo"<tr><td><a href='updateresi.php?id={$row["id"]}' method='post'><button type='submit' name='update'>Update</button></a></td>
            <td>{$row["id"]}</td><td>{$row["accNum"]}</td><td>{$row["name"]}</td><td>{$row["email"]}</td>
            <td>{$row["assocProp"]}</td><td>{$row["havepaid"]}</td><td>$ {$row["bal"]}</td>
            </tr>";
        }
    }echo"</table>";
}

function adminShowAllResiNameAsc($conn) {
    $sql = "SELECT * FROM residents ORDER BY name ASC;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo" <table border= '1'>";
    echo"<tr><td></td><td>Id</td><td>Account Number</td><td>Name</td><td>E-mail</td><td>Associated Property</td>
    <td>Paid this month?</td><td width='150'>Balance</td>";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo"<tr><td><a href='updateresi.php?id={$row["id"]}' method='post'><button type='submit' name='update'>Update</button></a></td>
            <td>{$row["id"]}</td><td>{$row["accNum"]}</td><td>{$row["name"]}</td><td>{$row["email"]}</td>
            <td>{$row["assocProp"]}</td><td>{$row["havepaid"]}</td><td>$ {$row["bal"]}</td>
            </tr>";
        }
    }echo"</table>";
}

function adminShowAllResiNameDesc($conn) {
    $sql = "SELECT * FROM residents ORDER BY name DESC;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo" <table border= '1'>";
    echo"<tr><td></td><td>Id</td><td>Account Number</td><td>Name</td><td>E-mail</td><td>Associated Property</td>
    <td>Paid this month?</td><td width='150'>Balance</td>";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo"<tr><td><a href='updateresi.php?id={$row["id"]}' method='post'><button type='submit' name='update'>Update</button></a></td>
            <td>{$row["id"]}</td><td>{$row["accNum"]}</td><td>{$row["name"]}</td><td>{$row["email"]}</td>
            <td>{$row["assocProp"]}</td><td>{$row["havepaid"]}</td><td>$ {$row["bal"]}</td>
            </tr>";
        }
    }echo"</table>";
}

function adminShowAllResiBalAsc($conn) {
    $sql = "SELECT * FROM residents ORDER BY bal DESC;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo" <table border= '1'>";
    echo"<tr><td></td><td>Id</td><td>Account Number</td><td>Name</td><td>E-mail</td><td>Associated Property</td>
    <td>Paid this month?</td><td width='150'>Balance</td>";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo"<tr><td><a href='updateresi.php?id={$row["id"]}' method='post'><button type='submit' name='update'>Update</button></a></td>
            <td>{$row["id"]}</td><td>{$row["accNum"]}</td><td>{$row["name"]}</td><td>{$row["email"]}</td>
            <td>{$row["assocProp"]}</td><td>{$row["havepaid"]}</td><td>$ {$row["bal"]}</td>
            </tr>";
        }
    }echo"</table>";
}

function adminShowResi($conn) {
    if (isset($_GET['id'])) {

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM residents WHERE id='$id';";
        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
        $row =mysqli_fetch_array($result);
        echo" <form action='includes/updateresi.inc.php' method='post'>";
        echo" <table border= '1'>";
        echo"<tr><td>Id</td><td>Account Number</td><td>Name</td><td>E-mail</td><td>Associated Property</td>
            <td>Paid this month?</td><td>Balance</td>";
        echo"<tr><td>{$row["id"]}</td><td>{$row["accNum"]}</td><td>{$row["name"]}</td><td>{$row["email"]}</td>
            <td>{$row["assocProp"]}</td>
            <td><select style='width:190px' name='havepaid'> 
                <option value='{$row["havepaid"]}'>{$row["havepaid"]}</option>
                <option value='No'>No</option>
                <option value='Payment Scheduled'>Payment Scheduled</option>
                <option value='Yes'>Yes</option>
            </select></td>
            <td class='cell-dollar-sign'>$<input style='width:120px' type='text' name='balance' value={$row["bal"]}></input></td>
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
    
    mysqli_stmt_bind_param($stmt, "sii" , $havepaid, $balance, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../manageresi.php?error=none");
    exit();
}

function adminCurrentReq($conn) {
    $sql = "SELECT * FROM main_req;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    echo" <table border= '1'>";
    echo"<tr><td></td><td>Id</td><td>Status</td><td>Property</td><td>Resident</td><td>Urgency</td><td>Type</td><td>Description</td></tr>";
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo"<tr><td><a href='updatereq.php?id={$row["id"]}' method='post'><button type='submit' name='update'>Update</button></a></td>
            <td>{$row["id"]}</td><td>{$row["status"]}</td><td>{$row["assocProp"]}</td><td>{$row["resident"]}</td>
            <td>{$row["urgency"]}</td><td>{$row["typeOf"]}</td><td>{$row["descrip"]}</td></tr>";
        }
    }echo"</table>";
}

function adminShowReq($conn) {
    if (isset($_GET['id'])) {

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM main_req WHERE id='$id';";
        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
        $row =mysqli_fetch_array($result);
        echo" <form action='includes/updatereq.inc.php' method='post'>";
        echo" <table border= '1'>";
        echo"<tr><td>Id</td><td>Status</td><td>Property</td><td>Resident</td><td>Urgency</td><td>Type</td><td>Description</td></tr>";
        echo"<tr><td>{$row["id"]}</td>            
        <td><select style='width:190px' name='status'>
            <option value={$row["status"]}> {$row["status"]}</option>
            <option value='Request Sent'>Request Sent</option>
            <option value='Accepted''>Accepted</option>
            <option value='Resolved'>Resolved</option>
            </select></td>
            <td>{$row["assocProp"]}</td><td>{$row["resident"]}</td>
            <td>{$row["urgency"]}</td><td>{$row["typeOf"]}</td><td>{$row["descrip"]}</td>
            <input type='hidden' name='id' value='$id'>
            </table><button type='submit' name='submit'>Update</button>";
        echo" </form>";
    }
}

function updateReq($conn, $id, $status) {
    $sql = "UPDATE main_req SET status = ? WHERE id = ?;";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../updatereq.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "si" , $status, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../managemaint.php?error=none");
    exit();
}

function userCheck() {
    if (!isset($_SESSION["useruid"]))
    {
        header("location:login.php?error=notloggedin");
        exit();
    } else 

    if  ($_SESSION["usertype"] == "admin") {
        header("location: login.php?error=notuser");
        exit();
    }
}

function adminCheck() {
    if (!isset($_SESSION["useruid"]))
    {
        header("location:login.php?error=notloggedin");
        exit();
    } else 

    if  ($_SESSION["usertype"] == "user") {
        header("location: login.php?error=notadmin");
        exit();
    }
}

function postApp($conn, $appAddress, $lengthOfOcc, $moveindate, $name, $email, $phone, $lastadd, 
$city, $state, $zipCode, $monthRent, $lastaddlen, $employmentstat, $company, $grossinc,  
$pets, $petsdescrip, $onlyoccupant, $occupant2name, $occupant2relation, $occupant3name, $occupant3relation, $haveSSN, 
$SSN, $dob, $haveEviction, $eviction, $haveFelony, $felony, $comments) {


    $sql = "INSERT INTO applications (appAddress, lengthOfOcc, moveindate, name, email, phone, lastadd, 
    city, state, zipCode, monthRent, lastaddlen, employmentstat, company, grossinc,  
    pets, petsdescrip, onlyoccupant, occupant2name, occupant2relation, occupant3name, occupant3relation, haveSSN, 
    SSN, dob, haveEviction, eviction, haveFelony, felony, comments) VALUES (?, ?, ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, ?, ?, ?,  
    ?, ?, ?, ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, ?, ?);";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../application.php?error=stmtfailed");
        exit();
    }
    
    $hashedSSN = password_hash($SSN, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssss" , $appAddress, $lengthOfOcc, $moveindate, $name, $email, $phone, $lastadd, 
    $city, $state, $zipCode, $monthRent, $lastaddlen, $employmentstat, $company, $grossinc,  
    $pets, $petsdescrip, $onlyoccupant, $occupant2name, $occupant2relation, $occupant3name, $occupant3relation, $haveSSN, 
    $hashedSSN, $dob, $haveEviction, $eviction, $haveFelony, $felony, $comments);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    // header("location: ../application.php?error=none");
    // exit();

    
    
}

function timeOutLogout() {
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
        // last request was more than 30 minutes ago
        echo "<script>alert('You were logged out for inactivity.');window.location.href='index.php';</script>";
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
    
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}