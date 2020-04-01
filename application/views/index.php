<?php include 'common/header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <?php foreach($breadcumbs as $breadcumb){ ?>
              <?php if(isset($breadcumb['active']) && $breadcumb['active']){ ?>
                <li class="breadcrumb-item active"><?php echo $breadcumb['title'] ?></li>
              <?php }else{ ?>
                <li class="breadcrumb-item"><a href="<?php echo $breadcumb['url'] ?>"><?php echo $breadcumb['title'] ?></a></li>
              <?php } ?>          
            <?php } ?>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <?php echo $main_content; ?>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'common/footer.php'; ?>