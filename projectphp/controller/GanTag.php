<?php 
    include_once('../model/db.php');
    include_once('../model/danhbaNhan.php');
    danhbaNhan::addMutil($_REQUEST['contact'],$_REQUEST['tag']);
?>