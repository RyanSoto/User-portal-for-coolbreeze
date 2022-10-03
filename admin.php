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

    include_once 'includes/dbh.inc.php';

?>

            <section class="index-into">
                <?php
                        if (isset($_SESSION["useruid"])) {
                            echo "<p>Howdy admin user " . $_SESSION["useruid"] ."</p>";

                        }
                ?>
                <h1>Welcome to the admin page</h1>
                <p>Time to take care of business!</p>

                <?php
                    $sql = "SELECT * FROM property;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    echo"<table border= '1'>";
                    echo"<tr><td>Id</td><td>Street Address</td><td>Apt/Unit #</td><td>City</td><td>State</td><td>Zip Code</td><td>Rent</td><td>Occupied?</td><td>Lease</td></tr>";
                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo"<tr><td>{$row["propId"]}</td><td>{$row["streetAd"]}</td><td>{$row["apt"]}</td><td>{$row["city"]}</td><td>{$row["state"]}</td><td>{$row["zipCode"]}</td><td>{$row["rentTot"]}</td><td>{$row["occupied"]}</td><td>{$row["leaseTerm"]}</td></tr>";
                            // echo "{$row["propId"]} {$row["streetAd"]} {$row["apt"]} {$row["city"]} {$row["state"]} {$row["zipCode"]} {$row["rentTot"]} {$row["occupied"]} {$row["leaseTerm"]} {$row["img_path"]} <br>";
                        }
                    }
                ?>
            </section>
        
<?php
    include_once 'footer.php';
?>