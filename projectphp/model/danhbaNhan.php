<?php

// require 'db.php';

class danhbaNhan {

    var $danhba_id;
    var $nhan_id;
    var $id;
    
    public function __construct($id,$danhba_id,$nhan_id)
    {
        $this->id = $id;
        $this->danhba_id = $danhba_id;
        $this->nhan_id = $nhan_id;
    }


    static function deleteFromDB($id){
        $conn = db::connect();
        $sql = "DELETE FROM `danhba_nhan` WHERE `id` = ".$id;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }
    
    static function addFromDB($danhbaNhan){
        $conn = db::connect();
        $sql = "SELECT `id` FROM `danhba_nhan` WHERE `danh_ba_id` = ".$danhbaNhan->danhba_id." AND `nhan_id` = ".$danhbaNhan->nhan_id;
        $result = $conn->query($sql);
        if($result->num_rows <=0){
            $sql = "INSERT INTO `danhba_nhan` (`danh_ba_id`,`nhan_id`) VALUES (".$danhbaNhan->danhba_id.",".$danhbaNhan->nhan_id.")";
            $result = $conn->query($sql);
        }
        echo $conn->error;
        $conn->close();
    }

    static function addMutil($contact, $tag){
        foreach($contact as $value_contact){
            foreach($tag as $value_tag){
                $danhba_nhan = new danhbaNhan(null,$value_contact,$value_tag);
                danhbaNhan::addFromDB($danhba_nhan);
            }
        }
    }
}