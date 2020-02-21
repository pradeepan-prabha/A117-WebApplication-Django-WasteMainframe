<!DOCTYPE html>
<html>
  <head>
    <title>Zero Waste City</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="styles/shards-dashboards.1.1.0.min.css">
    <link rel="stylesheet" href="styles/extras.1.1.0.min.css">
    <style>
      /* Always set the map height explicitly to define the size of the div
        element that contains the map. */
      #map {
        width: 100%;
        height: 600px;
        margin: 0 auto;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    
    <div class="container">
        <!-- Total Count  -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
              <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                  <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                      <span class="stats-small__label text-uppercase">Plastic Waste</span>
                      <h6 class="stats-small__value count my-3"><?php echo $totalResult; ?></h6>
                    </div>
                  </div>
                  <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
              <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                  <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                      <span class="stats-small__label text-uppercase">Low Density Waste</span>
                      <h6 class="stats-small__value count my-3"><?php echo $lowResult; ?></h6>
                    </div>
                  </div>
                  <canvas height="120" class="blog-overview-stats-small-2"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
              <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                  <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                      <span class="stats-small__label text-uppercase">Medium Density Waste</span>
                      <h6 class="stats-small__value count my-3"><?php echo $mediumResult; ?></h6>
                    </div>
                  </div>
                  <canvas height="120" class="blog-overview-stats-small-3"></canvas>
                </div>
              </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
              <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                  <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                      <span class="stats-small__label text-uppercase">High Density Waste</span>
                      <h6 class="stats-small__value count my-3"><?php echo $highResult; ?></h6>
                    </div>
                  </div>
                  <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                </div>
              </div>
            </div>
            <!-- Total Count ends here\ -->


        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="page-header no-gutters py-4">
                <h3 class="page-title">Map Visualization</h3>
            </div>
            <div id="map" class="rounded shadow"></div>
            </div>
        </div>
    </div>

    <!-- Google Map API -->
    <script src="scripts/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhDoMmm8hJNWr0XRFSMGN2T5spmJSqegQ&callback=initMap"
    async defer></script>

  </body>
</html>