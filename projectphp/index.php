<?php 
    session_start();
    include_once('model/db.php');
    include_once('model/danhba.php');
    include_once('model/user.php');
    include_once('header.php');
    include_once('nav.php');
    
    $user = unserialize($_SESSION['user']);    
    
   

    if($_REQUEST['action'] == 'add'){
        if($_REQUEST['ten'] && $_REQUEST['sodienthoai'] && $_REQUEST['email']){
            $danhba = new danhba(null,$_REQUEST['ten'],$_REQUEST['email'],$_REQUEST['sodienthoai']);
            danhba::addFromDB($danhba);
        }
    }
    if($_REQUEST['action'] == 'delete'){
        danhba::deleteFromDB($_REQUEST['id']);
    }
    if($_REQUEST['action'] == 'edit'){
        if($_REQUEST['id'] && $_REQUEST['ten'] && $_REQUEST['sodienthoai'] && $_REQUEST['email']){
            $danhba = new danhba($_REQUEST['id'],$_REQUEST['ten'],$_REQUEST['email'],$_REQUEST['sodienthoai']);
            danhba::updateFromDB($danhba);
        }
    }
    $mount = 5;
    $paginationdanhbas = danhba::pagination($mount,$_REQUEST['page'],$_REQUEST['tagId']);
    $danhbas = $paginationdanhbas['data'];
    // $danhbas = danhba::getListFromDB();
?>
<style>
    .pagination {
    display: inline-block;
    }

    .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    }

    .pagination a.active {
    background-color: #4CAF50;
    color: white;
    }

    .pagination a:hover:not(.active) {background-color: #ddd;}
</style>

<div class="container pt-5">
    <div class="alert alert-success" style="display: none;">Thêm Thành Công</div>
    <div class="dropdown mb-3">
        <button class="btn dropdown-toggle"  href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-tag"></i>
        </button>
        <div id="select-mu" style="display: none;">
            <div class="form-row">
                <div class="form-group" style="width:300px;">
                    <select  name="states" id="select-tag" placeholder="enter select" multiple="multiple" style="display: none;">
                        <?php foreach($nhans as $value){ ?>
                            <option value="<?php echo $value->id;?>"><?php echo $value->ten;?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group" id="btn-ap-dung">
                   <button class="btn bg-secondary">Áp dụng</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- <h1><?php echo $user->fullName; ?></h1> -->
    <div class="modal fade" id="form-add">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tạo liên hệ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    
                    <div class="form-group">
                        <label>ten</label>   
                        <input class="form-control" type="text" name="ten">
                    </div>
                    <div class="form-group">
                        <label>email</label>   
                        <input class="form-control" type="email" name="email">
                    </div>
                    <div class="form-group">
                        <label>So dien thoai</label>   
                        <input class="form-control" type="text" name="sodienthoai">
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
    
    <!-- <button class="btn btn-outline-info float-right" ><i class="fas fa-plus-circle"></i> Thêm</button> -->
    
    <table class="table table-hover">
        <thead class="">
            <tr>
                <th>cCheckbox</th>
                <th>Ten</th>
                <th>Email</th>
                <th>So dien thoai</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($danhbas as $key => $value){
            ?>
            <tr>
                <td><input type="checkbox" name="check-box-contact" class="check-box-id" value="<?php echo $value->id; ?>"></td>
                <td><?php echo $value->ten?></td>
                <td><?php echo $value->email?></td>
                <td><?php echo $value->sodienthoai?></td>
                <td>
                    <div class="modal fade" id="form-edit-<?php echo $value->id?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">form edit with id: <?php echo $value->id?></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <form action="" method="POST">
                                <div class="modal-body">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?php echo $value->id?>">
                                    <div class="form-group">
                                        <label>Ten</label>   
                                        <input class="form-control" type="text" value="<?php echo $value->ten?>" name="ten">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>   
                                        <input class="form-control" type="email" value="<?php echo $value->email?>" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>So dien thoai</label>   
                                        <input class="form-control" type="text" value="<?php echo $value->sodienthoai?>" name="sodienthoai">
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
                    <button class="btn btn-outline-warning" data-toggle="modal" data-target="#form-edit-<?php echo $value->id?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <form action="" style=" display: inline-block;" method="POST">
                        <input type="hidden" name="action" value="delete"> 
                        <input type="hidden" name="id" value="<?php echo $value->id?>"> 
                        <button  class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                    </form>
                </td>
            </tr>    
            <?php 
                }
            ?>
        </tbody>
        
    </table>
    
    <div class="pagination">   
        <?php 
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('?',$url)[0];
            $url .= '?';
            if(isset($_GET['search'])){
                $url .= $dau.'search='.$_GET['search'].'&';
            }
            for($i = 1; $i <= ceil($paginationdanhbas['size']/$mount); $i++){
        ?>
            <a <?php if($i == $paginationdanhbas['page_index'] ) echo "class='active'"; ?> href="<?php echo $url.'page='.$i; ?>"><?php echo $i?></a>
        <?php
            }
        ?>
    </div> 
</div>
<?php 
    include_once('footer.php');
?>
<script>
    $(document).ready(function (){
        $('#dropdownMenuLink').click(function(){
            $('#select-mu').toggle();
        });
        var contact = [];
        $('.check-box-id').change(function(){
            var tmp = [];
            $("input:checkbox[name=check-box-contact]:checked").each(function(){
                tmp.push($(this).val());
            });
            contact = tmp;
        });

        $('#btn-ap-dung').click(function(){
            var tag = $("#select-tag").val();
            console.log(contact);
            console.log(tag);
            $.ajax({
                url         : "controller/GanTag.php",
                data:   {"contact":contact,"tag":tag},
                contentType: "application/json",
                type        : 'get',
                success     : function(data){
                   $(".alert").css({"display":"block"}); 
                }
            });
        });
    });
</script>
