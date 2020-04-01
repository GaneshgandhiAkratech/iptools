<style>
.custom-switch{
  cursor:pointer;
}

.btn-success {
    color: #fff;
    background-color: #094584;
    border-color: #094584;
    box-shadow: none;
}
</style>
<div class="row">
  <div class="col-12">
  <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Product Overview</h3>
                </div>
              </div>
              <div class="card-body">

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> _-
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> --
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
  </div>
</div>
<div class="row">
  <div class="col-4">
    <div class="info-box animated bounceInDown">
      <span class="info-box-icon bg-info"><i class="fa fa-database"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Categories</span>
        <span class="info-box-number"><?php echo $total_category; ?></span>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="info-box animated bounceInDown">
      <span class="info-box-icon bg-warning"><i class="fa fa-ring"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Sub-categories</span>
        <span class="info-box-number"><?php echo $total_sub_category; ?></span>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="info-box animated bounceInDown">
      <span class="info-box-icon bg-success"><i class="fa fa-project-diagram"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Products</span>
        <span class="info-box-number"><?php echo $master_count ?></span>
      </div>
    </div>
  </div>
  
  <?php if($alert){ ?>
    <div class="col-12">
      <div class="alert <?php echo "alert-".$alert['alert']; ?> alert-dismissible fade show"><?php echo $alert['message'] ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    </div>
  <?php } ?>
</div>

<!-- Search container -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title"><i class="fa fa-binoculars"></i> Search Master Product</h3>
    <div class="card-tools">
      <span class="badge badge-success"></span>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-4">
      <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="filter_product_name" id="filter_product_name" class="form-control select2" style="width: 100%;" value="<?php echo $filter_product_name  ?>" placeholder="Product Name" required />
                  </div>
      </div>
      <div class="col-4">
      <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" style="width: 100%;" name="filter_category_id" id="filter_category_id" required>
                      <option value=''>Select Category</option>
                      <?php foreach($all_category as $category){ ?>
                        <option value="<?php echo $category['category_id'] ?>" <?php if($category['category_id'] == $filter_category_id){ echo "selected"; } ?> ><?php echo $category['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
      </div>
      <div class="col-4">
        <div class="form-group">
                    <label>Sub-category</label>
                    <select class="form-control select2" style="width: 100%;" name="filter_sub_category_id" id="filter_sub_category_id" required>
                      <option value=''>Select Sub-categoy</option>
                      <?php foreach($all_sub_category as $category){ ?>
                        <option value="<?php echo $category['category_id'] ?>" <?php if($category['category_id'] == $filter_sub_category_id){ echo "selected"; } ?>><?php echo $category['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
      </div>
    </div>      
  </div>
  <!-- /.card-body -->
  <div class="card-footer text-right">
    <button class="btn btn-sm btn-primary btn-refresh" data-refresh='Searching' id="filter_btn"><i class="fa fa-binoculars"></i> Search</button>
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->
<!-- search container end -->

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-list"></i> 
                Master product list <small class="badge badge-success">Total items :<?php echo $total_list ?></small> </h3>

                <div class="card-tools">
                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div> -->
                  <a href="<?php echo base_url("master_product/downloadCsv") ?>" type="button" class="btn bt-sm btn-primary" data-refresh='Exporting'><i class="fas fa-download"></i> Export</a>
                  <button type="button" class="btn bt-sm btn-primary" data-toggle="modal" data-target="#addProduct"><i class="fas fa-plus-circle"></i> Add Product</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 480px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Sub-category</th>
                      <th>Status</th>
                      <th> </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if($master_prodcts){
                    foreach($master_prodcts as $product){ ?> 
                    <tr class="animated bounceInRight" id="row_<?php echo $product['sr_no'] ?>">
                      <td><?php echo $product['sr_no'] ?></td>
                      <td><?php echo $product['product'] ?></td>
                      <td><?php echo $product['category'] ?></td>
                      <td><?php echo $product['sub_category'] ?></td>
                      <td><?php if($product['status']) { ?>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" checked class="custom-control-input" id="master_product_status<?php echo $product['sr_no'] ?>" name="master_product_status" value="<?php echo $product['sr_no'] ?>" data-status="0">
                        <label class="custom-control-label" for="master_product_status<?php echo $product['sr_no'] ?>">Enable</label>
                    </div>
                      <?php }else{ ?>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="master_product_status<?php echo $product['sr_no'] ?>" name="master_product_status" value="<?php echo $product['sr_no'] ?>" data-status="1">
                        <label class="custom-control-label" for="master_product_status<?php echo $product['sr_no'] ?>">Disable</label>
                    </div>
                      <?php } ?></td>
                      <td><button class="btn btn-warning btn-xs update_product" data-toggle="tooltip" title="Edit Product" data-master_id="<?php echo $product['sr_no'] ?>" data-category_id="<?php echo $product['category_id'] ?>" data-sub_category_id="<?php echo $product['sub_category_id'] ?>" data-product_name="<?php echo $product['product'] ?>"><i class="fa fa-edit"></i> Update</button>
                      <!-- <a href="<?php echo base_url("master_product/del_master_product")."?del_master_product=".$product['sr_no'] ?>" class="btn btn-danger btn-xs del_master_product processing" data-toggle="tooltip" title="Edit Product"><i class="fa fa-trash"></i></a> -->
                    </td>
                    </tr>
                  <?php  } } ?>
                  </tbody>
                  <!-- <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Total items <?php echo $total_list ?></td>
                    </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

  <div class="row">
  <div class="col-12">
  <ul class="pagination pagination-sm">
    <?php for($i = 1;$i<$master_page;$i++){ ?>
    <li class="page-item <?php if($i == $page){ echo 'active'; } ?>" >
      <a href="?page=<?php echo $i ?><?php echo $url ?>"><span class="page-link"><?php echo $i ?></span></a>
    </li>
    <?php } ?>
  </ul>
</nav>
    </div>
</div>

<!-- Add product model -->
<div class="modal fade" id="addProduct">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="nav-icon fas fa-receipt"></i> Add Product to master list</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form name="master_product_from" id="master_product_from" method="POST" action="<?php echo base_url('master_product/add_master_product') ?>">
                <input type="hidden" name="master_product_id" id="master_product_id" />
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="product_name" id="product_name" class="form-control select2" style="width: 100%;" placeholder="Product Name" required />
                  </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" style="width: 100%;" name="category_id" id="category_id" required>
                      <option value=''>Select Category</option>
                      <?php foreach($all_category as $category){ ?>
                        <option value="<?php echo $category['category_id'] ?>"><?php echo $category['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sub-category</label>
                    <select class="form-control select2" style="width: 100%;" name="sub_category_id" id="sub_category_id" required>
                      <option value=''>Select Sub-category</option>
                      <?php foreach($all_sub_category as $category){ ?>
                        <option value="<?php echo $category['category_id'] ?>"><?php echo $category['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group text-right">
                    <button type="submit" class="btn btn-success processing">Save</button>
                  </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<script>
$(function(){
  $(".update_product").on("click",function(){
    $("#master_product_id").val($(this).attr("data-master_id"));
    $("#product_name").val($(this).attr("data-product_name"));
    $("#category_id").val($(this).attr("data-category_id"));
    $("#sub_category_id").val($(this).attr("data-sub_category_id"));
    $("#addProduct").modal();
  })
  $("#filter_btn").on("click",function(){
    let url = '<?php echo base_url("master_product") ?>?';
    let filter_product_name = $("#filter_product_name").val();
    if(filter_product_name){
      url += '&filter_product_name=' + encodeURIComponent(filter_product_name);
    }
    let filter_category_id = $("#filter_category_id").val();
    if(filter_category_id){
      url += '&filter_category_id=' + encodeURIComponent(filter_category_id);
    }
    let filter_sub_category_id = $("#filter_sub_category_id").val();
    if(filter_sub_category_id){
      url += '&filter_sub_category_id=' + encodeURIComponent(filter_sub_category_id);
    }
    location = url;

  })
  $('input[name="master_product_status"]').on("click",function(){
      let master_id = $(this).val()
      let status = parseInt($(this).attr("data-status"))
      if(status){
        $(this).attr("data-status","0")
        $(this).next("label").text("Enable")
      }else{
        $(this).attr("data-status","1")
        $(this).next("label").text("Disable")
      }
      $.get("<?php echo base_url('master_product/enableDisable') ?>?master_id="+master_id+"&status="+status,function(){
          console.log("Status Chnages for "+master_id+" to "+status)
        })
  })
})
</script>
<script src="ished_iptools/plugins/chart.js/Chart.min.js"></script>
<script>
    var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true
  var $visitorsChart = $('#visitors-chart')
  var visitorsChart  = new Chart($visitorsChart, {
    data   : {
      labels  : [<?php echo $graph['label'] ?>],
      datasets: [{
        type                : 'line',
        data                : [<?php echo $graph['add'] ?>],
        backgroundColor     : 'transparent',
        borderColor         : '#D1D1FF',
        pointBorderColor    : '#D1D1FF',
        pointBackgroundColor: '#D1D1FF',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
        {
          type                : 'line',
          data                : [<?php echo $graph['modify'] ?>],
          backgroundColor     : 'tansparent',
          borderColor         : '#ced4da',
          pointBorderColor    : '#ced4da',
          pointBackgroundColor: '#ced4da',
          fill                : false
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 600
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
</script>