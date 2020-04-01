<script>
$(document).ready(function(){
  $("li.nav-item a.nav-link.active").removeClass("active")
  $("li.nav-item a.nav-link").each(function(e,el){
      if($(el).attr("href") == location.origin+location.pathname){
          $(el).addClass("active")
      }
  })
})
</script>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Notification</h5>
      <p><i class="fa fa-info-circle"> All caught up!</i></p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Akratech.com</a></strong> <small> Ip tools</small>
  </footer>
</div>
<!-- ./wrapper -->
</body>
</html>
