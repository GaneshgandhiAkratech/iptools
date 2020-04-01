<!-- Top Info Summery -->
<div class="row">
  <div class="col-4">
    <div class="info-box animated bounceInLeft">
      <span class="info-box-icon bg-info"><i class="fa fa-database"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">No. of products (Crawled)</span>
        <span class="info-box-number"><?php echo $total_list; ?></span>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="info-box animated bounceInLeft">
      <span class="info-box-icon bg-warning"><i class="fa fa-cheese"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">No. of products (Marked for LIVE)</span>
        <span class="info-box-number"><?php echo "310"; ?></span>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="info-box animated bounceInLeft">
      <span class="info-box-icon bg-success"><i class="fa fa-location-arrow"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">LIVE on Akratech</span>
        <span class="info-box-number"><?php echo "310" ?></span>
      </div>
    </div>
  </div>
</div>
<!-- Top Info Summery end-->

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-list"></i> Party Perfect crawled Table</h3>
                <div class="card-tools">
									<span class="badge badge-success">Total Crawled <strong><?php echo $total_list ?></strong></span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 480px;">
              <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Photos</th>
                      <th>Category Name</th>
                      <th>Product Name</th>
                      <th>Descriptions</th>
                      <th>Retail Price</th>
                      <th>Rental Price</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($lists as $list){ ?>
										<tr>
                      <td><?php echo $list['id'] ?></td>
                      <td>
                        <?php if($list['image1'] && (strlen($list['image1']) > 10)){ ?>
                          <img src="<?php echo $list['image1']; ?>" class="img-bordered img-circle img-md"/>
                        <?php } ?>
                        <?php if($list['image2'] && (strlen($list['image2']) > 10)){ ?>
                          <img src="<?php echo $list['image2']; ?>" class="img-bordered img-circle img-md"/>
                        <?php } ?>
                        <?php if($list['image3'] && (strlen($list['image3']) > 10)){ ?>
                          <img src="<?php echo $list['image3']; ?>" class="img-bordered img-circle img-md"/>
                        <?php } ?>
                      </td>
                      <td><?php echo strip_tags($list['category_name']) ?></td>
                      <td><?php echo strip_tags($list['product_name']) ?></td>
                      <td><?php echo strip_tags($list['description']) ?></td>
                      <td><?php echo $list['retail_price'] ?></td>
                      <td><?php echo $list['rental_price'] ?></td>
                      <td></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>