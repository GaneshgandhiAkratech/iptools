<div class="row">
  <!-- Product data card -->
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header border-0">
        <h3 class="card-title">Product Overview</h3>
        <div class="card-tools">
          <select class="btn btn-tool btn-sm">
            <option>Today</option>
            <option>Week</option>
            <option selected>Month</option>
            <option>Year</option>
          </select> 
        </div>
      </div>
      <div class="card-body table-responsive p-0" style="height: 480px;">
        <canvas id="pieChart_product_data" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> 
        <table class="table table-head-fixed">
          <thead>
            <tr>
                <th colspan="4">TOP 10 Viewed <small>items</small></th>
              </tr>
            <tr>
            <tr>
              <th>Product</th>
              <th>Rental Price</th>
              <th>Views</th>
              <th>View Percentage</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($view_product as $key => $product) { ?>
            <tr>
              <td>
                <?php if($product['image']){ ?>
                <img src="<?php echo $product['image']; ?>" alt="Product 1"
                  class="img-circle img-size-32 mr-2">
                <?php } echo $product['name']; ?>
              </td>
              <td>$<?php echo $product['price']; ?> USD</td>
              <td>
                <strong class="text-success mr-1">
                  <?php echo $product['viewed']; ?>
                </strong>
              </td>
              <td>
                <?php echo $product['percent']; ?>
                <!-- <a href="#" class="text-muted">
                  <i class="fas fa-search"></i>
                </a> -->
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /.Product data card end -->

    <!-- Rented Product data card -->
    <div class="col-lg-6">
    <div class="card">
      <div class="card-header border-0">
        <h3 class="card-title">Rented Product Overview</h3>
        <div class="card-tools">
          <select class="btn btn-tool btn-sm">
            <option>Today</option>
            <option>Week</option>
            <option selected>Month</option>
            <option>Year</option>
          </select>
        </div>
      </div>
      <div class="card-body table-responsive p-0" style="height: 480px;">
        <canvas id="pieChart_rented_data" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> 
        <table class="table table-head-fixed">
          <thead>
              <tr>
                <th colspan="4">TOP 10 Rented <small>items</small></th>
              </tr>
              <tr>
                <th>#</th>
                <th>Product</th>
                <th>Rented <small>times</small></th>
                <th>Total</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($view_product as $key => $product) { ?>
            <tr>
              <td>
                <?php if($product['image']){ ?>
                <img src="<?php echo $product['image']; ?>" alt="Product 1"
                  class="img-circle img-size-32 mr-2">
                <?php } echo $product['name']; ?>
              </td>
              <td>$<?php echo $product['price']; ?> USD</td>
              <td>
                <strong class="text-success mr-1">
                  <?php echo $product['viewed']; ?>
                </strong>
              </td>
              <td>
                <?php echo $product['percent']; ?>
                <!-- <a href="#" class="text-muted">
                  <i class="fas fa-search"></i>
                </a> -->
              </td>
            </tr>
          <?php } ?>
          </tbody>
         </table>
      </div>
    </div>
  </div>
  <!-- /. Rented Product data card end -->

  
  <!-- Store data card -->
  <div class="col-lg-12">
  <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Other Overview</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-tool">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-success text-xl">
                    <i class="ion ion-ios-refresh-empty"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-success"></i> 12%
                    </span>
                    <span class="text-muted">CONVERSION RATE</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-warning text-xl">
                    <i class="ion ion-ios-cart-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                    </span>
                    <span class="text-muted">SALES RATE</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-danger text-xl">
                    <i class="ion ion-ios-people-outline"></i>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <i class="ion ion-android-arrow-down text-danger"></i> 1%
                    </span>
                    <span class="text-muted">REGISTRATION RATE</span>
                  </p>
                </div>
                <!-- /.d-flex -->
              </div>
            </div>
            </div>
            <!-- store conversion end -->
</div>

<!-- Third Party section -->
<h3 class="mt-4 mb-4">Third Party Product</h3>
<div class="row">

  <div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header text-white"
        style="background: url('image/third_party/greentop2.png') center center;">
        <h3 class="widget-user-username text-right">Green Top</h3>
        <h5 class="widget-user-desc text-right"></h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle" src="image/third_party/greentop_logo-min.png" alt="User Avatar">
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">130</h5>
              <span class="description-text">PRODUCTS</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">310</h5>
              <span class="description-text">Active</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">310</h5>
              <span class="description-text">Live on Akratech</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  <div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header text-white"
        style="background: url('image/third_party/party_perfect.png') center center;">
        <h3 class="widget-user-username text-right">Party Perfect</h3>
        <h5 class="widget-user-desc text-right"></h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle" src="image/third_party/party_perfect_logo-min.png" alt="User Avatar">
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">425</h5>
              <span class="description-text">PRODUCTS</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">310</h5>
              <span class="description-text">Active</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">310</h5>
              <span class="description-text">Live on Shed</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  <div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header text-white"
        style="background: url('image/third_party/hamilton_logo-min.png') center center;">
        <h3 class="widget-user-username text-right">Lowes</h3>
        <h5 class="widget-user-desc text-right"></h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle" src="image/third_party/hamilton.png" alt="User Avatar" style="height: 90px;">
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">468</h5>
              <span class="description-text">PRODUCTS</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">98</h5>
              <span class="description-text">Active</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">98</h5>
              <span class="description-text">Live on Shed</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  <!-- /.col -->
</div>
<!-- Third party section end -->

<!-- ChartJS -->
<script src="ished_iptools/plugins/chart.js/Chart.min.js"></script>
<script>
    var pieChart = new Chart( $('#pieChart_product_data').get(0).getContext('2d'), {
      type: 'pie',
      data: {
        labels: [
            'Total Product',
            'Live Product',
            'Not Viewed', 
            'Disabled Product'
        ],
        datasets: [
          {
            data: [<?php echo $product_data['all_product']; ?>,<?php echo $product_data['live_product']; ?>,<?php echo $product_data['not_viewed']; ?>,<?php echo $product_data['disable_product']; ?>],
            backgroundColor : ['#32E50E','#0EDFE5','#f56954', '#00a65a'],
          }
        ]
      },
      options: {
        maintainAspectRatio : false,
        responsive : true,
      }      
    })
//order data pi chart
    var pieChart = new Chart( $('#pieChart_rented_data').get(0).getContext('2d'), {
      type: 'pie',
      data: {
        labels: [
            'Total Order',
            'In Progress',
            'Completed',
            'Cancelled'
        ],
        datasets: [
          {
            data: [<?php echo $order_data['all_order']; ?>,<?php echo $order_data['progress']; ?>,<?php echo $order_data['completed']; ?>,<?php echo $order_data['cancelled']; ?>],
            backgroundColor : ['#32E50E','#F9F916','#f56954', '#00a65a'],
          }
        ]
      },
      options: {
        maintainAspectRatio : false,
        responsive : true,
      }      
    })
</script>