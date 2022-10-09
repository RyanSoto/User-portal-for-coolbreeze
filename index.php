<?php
    include_once 'header.php';
?>

            <section class="container">
                <?php
                        if (isset($_SESSION["useruid"])) {
                            echo "<p>Howdy " . $_SESSION["useruid"] ."</p>";

                        }
                ?>
                <h1>Welcome to the resident portal</h1>
                <p>Make a payment or request maintenance/repair</p>
            
                <section class="index-categories">
                    <h2>Login Here</h2>
                    <!-- <div class="index-categories-list">
                        <div>
                            <h3>Fun Stuff</h3>
                        </div>
                        <div>
                            <h3>Serious Stuff</h3>
                        </div>
                        <div>
                            <h3>Serious Stuff</h3>
                        </div>
                        <div>
                            <h3>Boring Stuff</h3>
                        </div>
                    </div> -->
                </section>
            </section>
        
<?php
    include_once 'footer.php';
?>