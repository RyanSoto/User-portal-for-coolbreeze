<?php
    require_once 'dbh.inc.php';
    session_start();

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
                        // echo "{$row["propId"]} {$row["streetAd"]} {$row["apt"]} {$row["city"]} {$row["state"]} {$row["zipCode"]} {$row["rentTot"]} {$row["occupied"]} {$row["leaseTerm"]} {$row["img_path"]} <br>";
?>