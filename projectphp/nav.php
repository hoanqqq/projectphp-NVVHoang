<style>
  .nav-link{
    color: rgba(0, 0, 0, 0.5) !important;
  }
  .form-control{
    border: none;
    border-bottom: 1px solid #ced4da;

  }
  .form-control:focus{
    box-shadow: 0px 0px 0px 0px;
    border-color: #80bdff;
  }
</style>
<nav class="navbar navbar-expand navbar-white bg-white static-top">


<button class="btn btn-link btn-sm order-1 order-sm-0" id="sidebarToggle" href="#">
  <i class="fas fa-bars"></i>
</button>
<img class="gb_na gb_9d" alt="" aria-hidden="true" src="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png" srcset="https://www.gstatic.com/images/branding/product/1x/contacts_48dp.png 1x, https://www.gstatic.com/images/branding/product/2x/contacts_48dp.png 2x " style="width:40px;height:40px">
<a class="navbar-brand nav-link mr-1" href="index.html">Danh bạ</a>

<!-- Navbar Search -->
<!-- <form class="d-none d-md-inline-block form-inline" style="margin-left :60px;">
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" style="width: 500px; height: 50px">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div>
</form> -->
<form action="" class="d-none d-md-inline-block form-inline" style="margin-left :60px;" method="GET">
    <div class="form-group">
        <input class="form-control" value="<?php echo $_REQUEST['search']; ?>" name="search"  style="width: 500px; height: 50px;display:inline-block;" placeholder="Search">
        <button type="submit" class="btn btn-default" style="margin-left:-50px"><i class="fas fa-search"></i></button>
    </div>
</form>

<!-- Navbar -->
<ul class="navbar-nav ml-auto">
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-user-circle fa-fw"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="#">Settings</a>
      <a class="dropdown-item" href="#">Activity Log</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="logout.php" >Logout</a>
    </div>
  </li>
</ul>

</nav>

<div id="wrapper">
<!-- Sidebar -->
<ul class="sidebar navbar-nav" style="color: black; background: #ffff;">
  <li class="nav-item" style="margin-left: 20px; margin-top: 20px;">
  <button data-toggle="modal" data-target="#form-add" style="width: 170px;
    height: 45px;
    border-radius: 50px;
    box-shadow: 0 1px 2px 0 rgba(60,64,67,0.302), 0 1px 3px 1px rgba(60,64,67,0.149);
    ">
    <img src="upload/plus-google.jpg" alt="" style="width:30px;">
    <span class="ml-3">Tạo liên hệ</span>
    
  </button>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Danh Bạ</span>
    </a>
  </li>
  <ul style="border-top: 1px solid rgba(0, 0, 0, 0.5);  padding: 0rem;">
    <?php 
      include_once('model/nhan.php');

        if($_REQUEST['action'] == 'add-tag'){
          if($_REQUEST['ten'] ){
              $nnhan = new nhan(null,$_REQUEST['ten']);
              nhan::addFromDB($nnhan);
          }
        }
        if($_REQUEST['action'] == 'delete-tag'){
          if($_REQUEST['id'] ){
              nhan::deleteFromDB($_REQUEST['id']);
          }
        }
      $nhans = nhan::getListFromDB();
    ?>
    <?php foreach($nhans as $value){ ?>
    <li class="nav-item" style="list-style: none;">
      <a class="nav-link" href="?tagId=<?php echo $value->id;?>">
        <i class="fas fa-tag"></i>
        <form action="" class="float-right" style=" display: inline-block;" method="POST">
            <input type="hidden" name="action" value="delete-tag"> 
            <input type="hidden" name="id" value="<?php echo $value->id?>"> 
            <button  class="btn "><i class="fas fa-trash-alt"></i></button>
        </form> 
        <span><?php echo $value->ten; ?></span>
        <span class="float-right"><?php echo $value->count;?></span> 
        
      </a>
      
    </li>
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link"  data-toggle="modal" data-target="#form-add-tag">
      <i class="fas fa-plus"></i>
      <span>Tạo nhãn</span>
      </a>
    </li>
  </ul>
</ul>
<div class="modal fade" id="form-add-tag" >
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
          <h4 class="modal-title">form add tag</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <form action="" method="POST">
          <div class="modal-body">
              <input type="hidden" name="action" value="add-tag">
              <div class="form-group">
                  <label>ten</label>   
                  <input class="form-control" type="text" name="ten">
              </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary">submit</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- /.content-wrapper -->


