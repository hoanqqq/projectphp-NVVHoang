<?php 
    include_once('header.php');
    include_once('nav.php');
?>
<form >
    <fieldset>
        <input placeholder="The first number" value="<?php echo $_GET['num1'];?>" type="text" name="num1">
        <input placeholder="The second number" value="<?php echo $_GET['num2'];?>" type="text" name="num2">
        <select name="operator" id="" >
            <option value="none">please select your operator</option>
            <option <?php if($_GET['operator'] == 'add') echo 'selected';  ?> value="add">+</option>
            <option <?php if($_GET['operator'] == 'substract') echo 'selected';  ?> value="substract">-</option>
            <option <?php if($_GET['operator'] == 'multiply') echo 'selected';  ?> value="multiply">*</option>
            <option <?php if($_GET['operator'] == 'divide') echo 'selected';  ?> value="divide">/</option>
        </select>
        <button name="btnsubmit" value="1" type="submit">submit</button>
<?php 

    if($_GET['btnsubmit']){
        $res = null;
        $num1=  $_GET['num1'];
        $num2=  $_GET['num2'];
        if($num1 ==null || $num2 == null || $_GET['operator'] == "none"){
            echo "<h1>All input required</h1>";
            return;
        }
        $sign= null;
        switch ($_GET['operator']) {
            case 'add':
                # code...
                $res = $num1 + $num2;
                $sign = "+";
                break;
            case 'substract':
                # code...
                $res = $num1 - $num2;
                $sign = "-";
                break;
            case 'multiply':
                # code...
                $res = $num1 * $num2;
                $sign = "*";
                break;
            case 'divide':
                # code...
                $res = $num1 / $num2;
                $sign = "/";
                break;
            
            default:
                # code...
                $res = "please select your operator";

                break;
        }
        if($sign){
            echo "<h1>$num1 $sign $num2 = $res</h1>";
        }else{
            
            
            echo "<h1>$res</h1>";
        }
    }
?>
    </fieldset>
</form>
<?php 
    include('footer.php');
?>