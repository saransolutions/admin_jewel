<?php

function step1($id, $total, $page)
{
?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo MAIN_TITLE." - ".$page["title"]; ?></title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/jsQR.js"></script>
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <?php echo sidebar(); ?>
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
          <?php echo top_bar(); ?>
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <!-- Default Action buttons -->
            <div class="d-flex justify-content-between">
              <div>
                <!--free left space-->
              </div>
            </div>
            <!-- End Action buttons -->

            <!-- start card - steps -->
            <div class="card">
              <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                  <!-- Wizard navigation item 1-->
                  <a class="nav-item nav-link active" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                    <div class="wizard-step-text mt-4">
                      <div class="wizard-step-text-name">Step <span class="badge badge-light">1 </span></div>
                    </div>
                  </a>
                  <!-- Wizard navigation item 3-->
                  <a class="nav-item nav-link" href="#wizard3" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                    <div class="wizard-step-text mt-4">
                      <div class="wizard-step-text-name">Step <span class="badge badge-light">2 </span></div>
                    </div>
                  </a>
                  <!-- Wizard navigation item 4-->
                  <a class="nav-item nav-link" href="#wizard4" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                    <div class="wizard-step-text mt-4">
                      <div class="wizard-step-text-name">Step <span class="badge badge-light">3 </span></div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <!-- end card - steps -->


            <!-- start form + cart -->
            <div class="row" style="padding:10px;">
              <div class="col-md-12 col-lg-9">
                <div class="card text-center">
                  <div class="card-body">
                    <h1>Add Customer</h1>
                    <div class="dropdown" style="padding-top:5%;">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Existing Customer
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php
                        $data = "";
                        $sql = "select * from " . DB_NAME . ".customers ORDER BY id DESC";
                        $rows = getFetchArray($sql);
                        foreach ($rows as $result) {
                          $data = $data . '<a class="dropdown-item" href="orders.php?action=step2&total='.$total.'&pid=' . $id . '&cid=' . $result["id"] . '">' . $result["first_name"] . ' ' . $result["last_name"] . '</a>';
                        }
                        echo $data;
                        ?>
                      </div>
                    </div>
                  </div>
                  <!-- select by QR Code -->
                  <div class="card-body" style="padding-top:20%;">
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $id;?>"></input>
                    <div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
                    <canvas id="canvas" hidden></canvas>
                    <div id="output" hidden>
                      <div id="outputMessage">No QR code detected.</div>
                      <div hidden><b>Data:</b> <span id="outputData"></span></div>
                    </div>
                  </div>
                  <!-- select by QR Code -->
                </div>
              </div>

              <!-- start of cart -->
              <div class="col-sm">
                <div class="col-md-12 col-lg-9 order-md-last">
                  <h4 class="">
                    <span class="text-primary">Your cart</span>
                    <span class="badge badge-dark bg-primary rounded-pill">1</span>
                  </h4>
                  <ul class="list-group">
                    <li class="list-group-item d-flex">
                      <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">New Project</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex">
                      <span>Total </span>
                      <strong> 0 CHF</strong>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- end of cart -->
            </div>
            <!-- end of form + cart -->
          </div>
          <!-- End of Page Content -->
        </div>
        <!-- End of Main Content -->
        <?php echo get_footer(); ?>
        <?php echo reports_form(); ?>
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <?php echo logout_modal() ?>
    <!-- Logout Modal-->
    <!-- call js scripts -->
    <?php echo js_scripts() ?>
    <!-- call js scripts -->
    
  <script>
    var video = document.createElement("video");
    var canvasElement = document.getElementById("canvas");
    var canvas = canvasElement.getContext("2d");
    var loadingMessage = document.getElementById("loadingMessage");
    var outputContainer = document.getElementById("output");
    var outputMessage = document.getElementById("outputMessage");
    var outputData = document.getElementById("outputData");
    

    function drawLine(begin, end, color) {
      canvas.beginPath();
      canvas.moveTo(begin.x, begin.y);
      canvas.lineTo(end.x, end.y);
      canvas.lineWidth = 4;
      canvas.strokeStyle = color;
      canvas.stroke();
    }

    // Use facingMode: environment to attemt to get the front camera on phones
    navigator.mediaDevices.getUserMedia({
      video: {
        facingMode: "environment"
      }
    }).then(function(stream) {
      video.srcObject = stream;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.play();
      requestAnimationFrame(tick);
    });

    function tick() {
      loadingMessage.innerText = "⌛ Loading video..."
      if (video.readyState === video.HAVE_ENOUGH_DATA) {
        loadingMessage.hidden = true;
        canvasElement.hidden = false;
        outputContainer.hidden = false;

        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        var code = jsQR(imageData.data, imageData.width, imageData.height, {
          inversionAttempts: "dontInvert",
        });
        if (code) {
          drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
          drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
          drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
          drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
          outputMessage.hidden = true;
          outputData.parentElement.hidden = false;
          // let text1 = "<a href='";
          // let text2 = text1.concat(code.data);
          // let result = text2.concat("&product_id="+product_id+"&action=new_order' target='_blank'>Selected customer </a>");
          canvasElement.hidden = true;
          /*outputData.outerHTML = result;*/
          let result = code.data;
          var product_id = <?php echo json_encode($id); ?>;
          var total = <?php echo json_encode($total); ?>;
          let cid = result.replace("customers.php?cid=", "");
          let url = "orders.php?action=step2&total="+total+"&cid="+cid+"&pid="+product_id;
          window.open(url);
        } else {
            outputMessage.hidden = false;
            outputData.parentElement.hidden = true;
        }
      }
      requestAnimationFrame(tick);
    }
  </script>
  </body>
<?php
}

function js_scripts()
{
?>
    <!--scripts-->
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!--scripts-->
<?php
}

?>