<?php

// require 'db.php';

class danhba {

    var $email;
    var $ten;
    var $sodienthoai;
    var $id;
    
    public function __construct($id,$ten,$email,$sodienthoai)
    {
        $this->id = $id;
        $this->email = $email;
        $this->ten = $ten;
        $this->sodienthoai = $sodienthoai;
    }

    function display(){
        echo "email: ". $this->email."<br>";
        echo "ten: ". $this->ten."<br>";
        echo "sodienthoai: ". $this->authtor."<br>";
    }

    static function pagination($mount = 10,$page_index = 1,$search = null){
        if($page_index <= 1) $page_index = 1;
        $data = danhba::getListFromDB($search);
        $res = [];
        $i = 0;
        for($i = $mount*($page_index-1); $i < ($mount*($page_index-1) + $mount) && $i < sizeof($data); $i++){
            $res[] = $data[$i]; 
        }
        $data_res = [
            'data' => $res,
            'size' => sizeof($data),
            'page_index' => $page_index
        ];
        return $data_res;
    }

    static function getListFromDBbyTagId($tag_id){

        $conn = db::connect();
        // print_r($conn);
        //Buoc 2: Thao tac voi CSDL: CRUD
        $sql = "SELECT danhba.* From danhba 
                INNER JOIN danhba_nhan on danhba.id = danhba_nhan.danh_ba_id
                WHERE danhba_nhan.nhan_id =".$tag_id;
        $result = $conn->query($sql);
        $ls = [];
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $danhba = new danhba($row['id'],$row['ten'],$row['email'],$row['sodienthoai'],$row['Year']);
                $ls[] = $danhba;
            }
        }    
        //Buoc 3: Dong ket noi
        $conn->close();
        return $ls;
    }

    static function getListFromDB($tag_id = null){

        if($tag_id !== null){
            return danhba::getListFromDBbyTagId($tag_id);
        }

        $conn = db::connect();
        // print_r($conn);
        //Buoc 2: Thao tac voi CSDL: CRUD
        $sql = "SELECT * From danhba";
        $result = $conn->query($sql);
        $ls = [];
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $danhba = new danhba($row['id'],$row['ten'],$row['email'],$row['sodienthoai'],$row['Year']);
                $ls[] = $danhba;
            }
        }    
        //Buoc 3: Dong ket noi
        $conn->close();
        return $ls;
    }

    static function addFromDB($danhba){
        $conn = db::connect();
        
        $sql = "INSERT INTO `danhba` (`ten`, `email`, `sodienthoai`) VALUES ('".$danhba->ten."','".$danhba->email."','".$danhba->sodienthoai."')";
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }

    static function deleteFromDB($id){
        $conn = db::connect();
        $sql = "DELETE FROM `danhba` WHERE `id` = ".$id;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }

    static function updateFromDB($danhba){
        $conn = db::connect();
        
        $sql = "UPDATE `danhba` SET `ten`= '".$danhba->ten."', 
                                    `email` = '".$danhba->email."', 
                                    `sodienthoai`='".$danhba->sodienthoai."'
                                    WHERE id = ".$danhba->id;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }
}