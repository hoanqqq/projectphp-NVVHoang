<?php 
    include_once('header.php');
    include_once('nav.php');
?>

<div id="content-wrapper">
    <div class="container-fluid row pt-5">
        <?php 
            $maSinhVien = $ho = $ten = $ngaySinh = $email ="";
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $maSinhVien = $_REQUEST['txtMaSinhVien'];
                $ho = $_REQUEST['txtHo'];
                $ten = $_REQUEST['txtTen'];
                $ngaySinh = $_REQUEST['txtNgaySinh'];
                $email = $_REQUEST['txtEmail'];
                var_dump($_FILES);
                if($_FILES['avatar'])
                    move_uploaded_file($_FILES['avatar']['tmp_name'],"upload/".$_FILES['avatar']['name']);
            }
        ?>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="">
                    <div class="form-group">
                        <label for="">Sinh Vien</label>
                        <input type="text" class="form-control" name="txtMaSinhVien" value="<?php echo $maSinhVien;?>">
                    </div>
                    <div class="form-group">
                        <label for="">Ho</label>
                        <input type="text" class="form-control" name="txtHo" value="<?php echo $ho;?>">
                    </div>
                    <div class="form-group">
                        <label for="">Ten</label>
                        <input type="text" class="form-control" name="txtTen" value="<?php echo $ten;?>">
                    </div>
                    <div class="form-group">
                        <label for="">Avatar</label>
                        <input type="file" class="form-control-file" name="avatar" >
                    </div>
                    <div class="form-group">
                        <label for="">Ngay sinh</label>
                        <input type="date" class="form-control" name="ngaySinh" value="<?php echo $ngaySinh;?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="txtEmail" value="<?php echo $email;?>">
                    </div>
                    <button class="btn btn-primary" type="submit">submit</button>
                </div>

            </form>
        </div>
    </div>
</div>
<?php 
    include('footer.php');
?>