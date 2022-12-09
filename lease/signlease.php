<?php

// include_once 'header.php';

// userCheck();
// timeOutLogout();

// include_once 'includes/dbh.inc.php';
// require_once 'includes/functions.inc.php';

$owner = 'Robert Soto';
$ownerAdd = 'NA'; // $_POST["ownerAdd"];
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
$dir = $_POST["dir"];
$sigPng = $_POST["sigPng"];



?>


<section class="container">
    <div class="inner-container">
        <?php

            
        if (isset($_POST['signaturesubmit'])) {
            $signature = $_POST['signature'];
            // $signatureFileName = uniqid() . '.png';
            $signatureFileName = $sigPng;
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $data = base64_decode($signature);
            $file = $dir . $signatureFileName;
            file_put_contents($file, $data);
            $msg = "<div class='alert alert-success'>Signature Uploaded</div>";

            ob_start();
            include '../includes/leaseform.inc.php';
            ob_end_flush();

            header("location: ../index.php?success=submitted");
            // exit();

        }
        ?>
        <html>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            <style>
                #canvasDiv {
                    position: relative;
                    border: 2px dashed grey;
                    height: 175px;
                }

                #canvas {
                    background-color: white;
                }
                @media screen and (min-width: 320px) and (max-width: 767px) and (orientation: portrait) {
                html {
                    transform: rotate(-90deg);
                    transform-origin: left top;
                    width: 100vh;
                    overflow-x: hidden;
                    position: absolute;
                    top: 100%;
                    left: 0;
                }
                }
            </style>
        </head>

        <body>
            <!-- <div class="container1"> -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <br>
                    <?php echo isset($msg) ? $msg : ''; ?>
                    <h2>Sign Here</h2>
                    <hr>
                    <div id="canvasDiv"></div>
                    <br>
                    <button type="button" class="btn btn-danger" id="reset-btn">Clear</button>
                    <button type="button" class="btn btn-success" id="btn-save">Save</button>
                </div>
                <form id="signatureform" action="" style="display:none" method="post">
                    <input type="hidden" id="signature" name="signature">
                    <input type="hidden" name="signaturesubmit" value="1">
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
                </form>

            </div>
    </div>
    <!-- </div> -->
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script>
        $(document).ready(() => {
            var canvasDiv = document.getElementById('canvasDiv');
            var canvas = document.createElement('canvas');
            canvas.setAttribute('id', 'canvas');
            canvasDiv.appendChild(canvas);
            $("#canvas").attr('height', $("#canvasDiv").outerHeight());
            $("#canvas").attr('width', $("#canvasDiv").width());
            if (typeof G_vmlCanvasManager != 'undefined') {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }

            context = canvas.getContext("2d");
            $('#canvas').mousedown(function(e) {
                var offset = $(this).offset()
                var mouseX = e.pageX - this.offsetLeft;
                var mouseY = e.pageY - this.offsetTop;

                paint = true;
                addClick(e.pageX - offset.left, e.pageY - offset.top);
                redraw();
            });

            $('#canvas').mousemove(function(e) {
                if (paint) {
                    var offset = $(this).offset()
                    //addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
                    addClick(e.pageX - offset.left, e.pageY - offset.top, true);
                    console.log(e.pageX, offset.left, e.pageY, offset.top);
                    redraw();
                }
            });

            $('#canvas').mouseup(function(e) {
                paint = false;
            });

            $('#canvas').mouseleave(function(e) {
                paint = false;
            });

            var clickX = new Array();
            var clickY = new Array();
            var clickDrag = new Array();
            var paint;

            function addClick(x, y, dragging) {
                clickX.push(x);
                clickY.push(y);
                clickDrag.push(dragging);
            }

            $("#reset-btn").click(function() {
                context.clearRect(0, 0, window.innerWidth, window.innerWidth);
                clickX = [];
                clickY = [];
                clickDrag = [];
            });

            $(document).on('click', '#btn-save', function() {
                var mycanvas = document.getElementById('canvas');
                var img = mycanvas.toDataURL("image/png");
                anchor = $("#signature");
                anchor.val(img);
                $("#signatureform").submit();
            });

            var drawing = false;
            var mousePos = {
                x: 0,
                y: 0
            };
            var lastPos = mousePos;

            canvas.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas, e);
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }, false);


            canvas.addEventListener("touchend", function(e) {
                var mouseEvent = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(mouseEvent);
            }, false);


            canvas.addEventListener("touchmove", function(e) {

                var touch = e.touches[0];
                var offset = $('#canvas').offset();
                var mouseEvent = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }, false);



            // Get the position of a touch relative to the canvas
            function getTouchPos(canvasDiv, touchEvent) {
                var rect = canvasDiv.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                };
            }


            var elem = document.getElementById("canvas");

            var defaultPrevent = function(e) {
                e.preventDefault();
            }
            elem.addEventListener("touchstart", defaultPrevent);
            elem.addEventListener("touchmove", defaultPrevent);


            function redraw() {
                //
                lastPos = mousePos;
                for (var i = 0; i < clickX.length; i++) {
                    context.beginPath();
                    if (clickDrag[i] && i) {
                        context.moveTo(clickX[i - 1], clickY[i - 1]);
                    } else {
                        context.moveTo(clickX[i] - 1, clickY[i]);
                    }
                    context.lineTo(clickX[i], clickY[i]);
                    context.closePath();
                    context.stroke();
                }
            }
        })
    </script>

    </html>


    </div>
</section>

<?php
// include_once '../footer.php';
?>