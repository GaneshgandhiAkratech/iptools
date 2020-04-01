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
        <span class="info-box-number"><?php echo "45"; ?></span>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="info-box animated bounceInLeft">
      <span class="info-box-icon bg-success"><i class="fa fa-location-arrow"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">LIVE on Akratech</span>
        <span class="info-box-number"><?php echo "45" ?></span>
      </div>
    </div>
  </div>
</div>
<!-- Top Info Summery end-->

<!-- Crawled row     -->
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-list"></i> Protor Silex Crawled Table</h3>
                <div class="card-tools">
                <a href="<?php echo base_url('hamiltonbeach') ?>?live_list=1"><i class="fa fa-location-arrow"></i> View Live
            Product&nbsp;&nbsp;&nbsp;</a>
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
                      <th style="width: 200px;">Product Name</th>
                      <th>Descriptions</th>
                      <th>Retail Price</th>
                      <th>Rental Price</th>
                      <th>Manual</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($lists as $list){ ?>
										<tr>
                      <td><?php echo $list['id'] ?></td>
                      <td>
                        <?php $images = explode(',',$list['image']);
                            foreach($images as $image){ ?>
                              <img src="<?php echo $image; ?>" class="img-bordered img-circle img-md"/>
                            <?php }
                        ?>
                      </td>
                      <td><?php echo strip_tags($list['category_name']) ?></td>
                      <td><?php echo strip_tags($list['product_name']) ?></td>
                      <td><?php echo strip_tags($list['description']) ?></td>
                      <td><?php echo $list['retail_price'] ?></td>
                      <td><?php echo $list['rental_price'] ?></td>
                      <td>
                        <?php if($list['manual']){ ?>
                          <a href="<?php echo $list['manual'] ?>" target="_BLANK"><i class="fa fa-arrow-alt-circle-right"></i> view PDF</a>
                        <?php } ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
<!-- Crawled row end -->