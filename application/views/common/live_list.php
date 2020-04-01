<!-- Live data row -->
<!-- Swal -->
<script src="ished_iptools/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<link href="ished_iptools/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">

<style>
th.sort{
  cursor:pointer;
}
.swal2-popup.swal2-modal{
  margin-top: 6% !important;
}
</style>
<?php
    if($this->input->get('sort_by') == "DESC"){
      $sort_by = "ASC";
    }else{
      $sort_by = "DESC";
    }
?>
<?php if(!empty($live_list)){ ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fa fa-list"></i> Live Product List</h3>
        <div class="card-tools">
          <a href="<?php echo base_url()?>export_data?live_list=<?php echo $live_list[0]['product_owner'] ?>" type="button" class="btn bt-sm btn-primary" data-refresh="Exporting"><i class="fas fa-download"></i> Export</a>
          <a href="javascript:reload()"><i class="fa fa-location-arrow"></i> View Crawled
            Data&nbsp;&nbsp;&nbsp;</a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0" style="height: 480px;">
        <table class="table table-head-fixed">
          <thead>
            <tr>
              <th class="sort" data-order="p.product_id">Product ID <i class="fa fa-sort"></i></th>
              <th>Photo</th>
              <th class="sort" data-order="pd.name">Display Name <i class="fa fa-sort"></i></th>
              <th class="sort" data-order="pd.base_name">Product Name <i class="fa fa-sort"></i></th>
              <th class="sort" data-order="p.manufacturer_text">Brand <i class="fa fa-sort"></i></th>
              <th>Category</th>
              <th>Sub-category</th>
              <th class="sort" data-order="p.price">Rental Price <i class="fa fa-sort"></i></th>
              <th class="sort" data-order="p.retail_price">Retail Price <i class="fa fa-sort"></i></th>
              <th class="sort" data-order="p.manufacturer_id">Product Master Id <i class="fa fa-sort"></i></th>
              <th>Action </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($live_list as $list){ ?>
            <tr id="product_tr<?php echo $list['product_id'] ?>">
              <td><?php echo $list['product_id'] ?></td>
              <td>
                <?php $images = explode(',',$list['image']);
                            foreach($images as $image){ ?>
                <img src="<?php echo $image; ?>" class="img-bordered img-circle img-md" />
                <?php }
                        ?>
              </td>
              <td><?php echo strip_tags($list['name']) ?></td>
              <td><?php echo strip_tags($list['base_name']) ?></td>
              <td>
                <?php echo strip_tags($list['manufacturer_text']) ?>
                <input type="text" list="manufacturer_id" name="brand_id<?php echo $list['product_id'] ?>" id="brand_id<?php echo $list['product_id'] ?>" value="<?php echo strip_tags($list['manufacturer_id']) ?>" class="form-control select2" style="width:100px"/>
              </td>
              <td><?php echo strip_tags($list['category'][0]['name']) ?></td>
              <td><?php echo strip_tags($list['category'][1]['name']) ?></td>
              <td>
                <div class="input-group" style="width: 90px;">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                  </div>
                  <input type="text" pattern="[0-9]" class="form-control" value="<?php echo $list['price'] ?>" name="price<?php echo $list['product_id'] ?>" id="price<?php echo $list['product_id'] ?>">
                </div>
              </td>
              <td>
                <div class="input-group" style="width: 90px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input type="text" pattern="[0-9]" class="form-control" value="<?php echo $list['retail_price'] ?>" name="retail_price<?php echo $list['product_id'] ?>" id="retail_price<?php echo $list['product_id'] ?>">
                  </div>
              </td>
              <td>
                <input list="master_product_list" name="master<?php echo $list['product_id'] ?>" id="master<?php echo $list['product_id'] ?>" class="form-control select2" style="width:100px" value="<?php echo $list['master_product_id'] ?>">
                <!-- <datalist id="master_product_list<?php echo $list['product_id'] ?>">
                  <?php foreach($master_products as $product){ ?>
                    <option value="<?php echo $product['sr_no'] ?>" <?php if($list['master_product_id'] == $product['sr_no'] ){ echo "Selected"; } ?>>
                      <?php echo $product['product']." [ ".$product['category'].">".$product['sub_category']."]" ?>
                    </option>
                  <?php } ?>
                </datalist>   -->
              </td>
              <td><button type="button" class="btn btn-xs btn-success" data-refresh="Saving" data-product_id="<?php echo $list['product_id'] ?>" onclick="updateProduct(<?php echo $list['product_id'] ?>)" id="update_btn_<?php echo $list['product_id'] ?>"><i class="fa fa-rocket"></i> Update</button>
              <small class="badge badge-warning" id="update_text_<?php echo $list['product_id'] ?>"></small>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<datalist id="master_product_list">
  <?php foreach($master_products as $product){ ?>
  <option value="<?php echo $product['sr_no'] ?>">
    <?php echo $product['product']." [ ".$product['category']." > ".$product['sub_category']."]" ?>
    </option>
  <?php } ?>
</datalist>  

<datalist id="manufacturer_id">
<?php foreach($manufacturers as $manufacturer){ ?>
  <option value="<?php echo $manufacturer['manufacturer_id'] ?>">
    <?php echo $manufacturer['name'] ?>
    </option>
  <?php } ?>
</datalist>
<!-- live data end -->

<script>
  $("th.sort").on("click",function(){
    console.log("<?php echo $sort_by; ?>")
    console.log($(this).attr("data-order"))
    window.location = location.origin+location.pathname+"?live_list=1&order="+$(this).attr("data-order")+"&sort_by=<?php echo $sort_by; ?>"
  })
  function reload(){
  window.location=location.origin+location.pathname
  }
</script>
<script>
  function updateProduct(product_id){
    Swal.fire({
      title: 'Are you sure?',
      text: "",
      showCancelButton: true,
      confirmButtonColor: ' #040463 ',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Upate!'
    }).then((result) => {
      console.log(result);
      if (result.value) {
        console.log(product_id)
        let brand_id = $("#brand_id"+product_id).val()
        let price = $("#price"+product_id).val()
        let retail_price = $("#retail_price"+product_id).val()
        let master = $("#master"+product_id).val()
        let url = '<?php echo base_url('common/live_list/updateIshedPorduct') ?>?manufacturer_id='+brand_id+'&retail_price='+retail_price+'&rental_price='+price+'&master_prodcut_id='+master+'&prodcut_id='+product_id
        console.log(url)
        $("#update_btn_"+product_id).html('Saving')
        $.ajax({
          url: url, 
          dataType:'json',
          success: function(json){
            console.log(json)
            $("#update_btn_"+product_id).html('<i class="fa fa-rocket"></i> Update')
            if(json.success){
              $("#update_text_"+product_id).html('Saved!')
            }else{
              $("#update_text_"+product_id).html('Try Again');
            }
          }
        })
      }
    })
  } 
</script>