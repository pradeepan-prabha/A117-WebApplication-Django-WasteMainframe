<?php 
  include("dbconnect/connect.php");
  
  $db_selected = mysqli_select_db($connection, $database);
    if (!$db_selected) {
        die ('Can\'t use db : ' . mysqli_error());
  }

  $query = "select w.waste_char, count(*) from waste_details w inner join waste_product_details p on w.refid = p.refid inner join waste_location_details loc on loc.refid = p.refid group by w.waste_char;";

  $highQuery = "select count(*) from waste_details where waste_char = 2";
  $mediumQuery = "select count(*) from waste_details where waste_char = 1";
  $lowQuery = "select count(*) from waste_details where waste_char = 3";

  $totalQuery = "select count(*) from waste_details w inner join waste_product_details p on w.refid = p.refid inner join waste_location_details loc on loc.refid = p.refid;";

  $result = mysqli_query($connection, $query);

  $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $highResult = calCount($connection, $highQuery);
  $lowResult = calCount($connection, $lowQuery);
  $mediumResult = calCount($connection, $mediumQuery);
  $totalResult = calCount($connection, $totalQuery);

  function calCount($connection, $query){
    $result = mysqli_query($connection, $query);
    $result = mysqli_fetch_assoc($result);
    return $result["count(*)"];
  }
?>

<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Zero Waste City</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="styles/shards-dashboards.1.1.0.min.css">
    <link rel="stylesheet" href="styles/extras.1.1.0.min.css">
    <script async defer src="https://buttons.github.io/buttons.js"></script>    
    <style>
      #map {
        height: 600px;
        width: 100%;      
      }
      
      button[data-toggle="modal"] {
        display: none;
      }

      #barChart, #multiLineChart, #pieChart, #lineChart {
        height: 350px;
        margin: 5px;
      }
    </style>
  </head>
  <body class="h-100">
    <div class="container">
      <div class="row">

            
            <!-- Total Count  -->
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
            </div>
            <!-- End Small Stats Blocks -->

            <!-- Google Maps Starts here -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="page-header no-gutters py-4">
                    <h3 class="page-title">Map Visualization</h3>
                </div>
                <div id="map" class="rounded shadow"></div>
              </div>
            </div>
          <!-- Google Maps ends here -->

            <div class="row">
              <!-- Users Stats -->
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="page-header no-gutters py-4">
                    <h3 class="page-title">Graph Visualizations</h3>
                </div>
              </div>
              
              <!-- Chart Boxes -->
              <div class="container">
                  <div class="row">
                      <div id="barChart" class="col-lg-12 shadow-lg rounded"></div>
                      <div id="lineChart" class="col-lg-6 shadow-lg rounded"></div>
                      <div id="pieChart" class="col-lg-6 shadow-lg rounded"></div>
                      <div id="lineChart" class="col-lg-12 shadow-lg rounded"></div>
                  </div>
              </div>
  
                  
  

              </div>
            </div>
          </div>
          
          <footer class="col-lg main-footer d-flex p-2 px-3 bg-white border-top">
            <span class="copyright ml-auto my-auto mr-2">Copyright © 2020
              <a href="#" rel="nofollow">Mind Bender</a>
            </span>
          </footer>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="scripts/extras.1.1.0.min.js"></script>
    <script src="scripts/shards-dashboards.1.1.0.min.js"></script>
    <script src="scripts/shards-dashboards.1.1.0.js"></script>
    <script src="scripts/app/app-blog-overview.1.1.0.js"></script>

    <!-- Google Map API -->
    <script src="scripts/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAT91p-SFz3zFeyYrGYz7sF6KiwGgheQtk&callback=initMap"
    async defer></script>

    <!-- Graphs -->
    <script src="scripts/canvasjs.min.js"></script>
    <script src="scripts/graphs.js"></script>

  </body>
</html>