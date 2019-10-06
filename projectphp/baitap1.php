<?php 
    include_once('header.php');
    include_once('nav.php');
?>
<?php 
    define('PI',3.14);
    
    /**
     * Tinh dien tich hinh tron
     * @param $bankinh so nguyen
     * @return dien tich hinh tron
     */
    function dienTichHinhTron($bankinh){
        return PI * PI * $bankinh;
    }
    echo date('W');
    echo "<br/>";
    echo dienTichHinhTron(5);
?>
<?php 
    include('footer.php');
?>