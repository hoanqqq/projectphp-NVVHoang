<?php

// require 'db.php';

class nhan {

    var $ten;
    var $count; // so luong nguoi duoc gan nhan
    public function __construct($id,$ten,$count = 0)
    {
        $this->id = $id;
        $this->ten = $ten;
        $this->count = $count;
    }

    function display(){
        echo "ten: ". $this->ten."<br>";
    }

    static function pagination($mount = 10,$page_index = 1,$search = null){
        if($page_index <= 1) $page_index = 1;
        $data = nhan::getListFromDB($search);
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
    
    static function getListFromDB(){

        $conn = db::connect();
        // print_r($conn);
        //Buoc 2: Thao tac voi CSDL: CRUD
        $sql = "SELECT nhan.*,COUNT(nhan.id) as count,danhba_nhan.id as danhba_id  From nhan left join danhba_nhan on nhan.id = danhba_nhan.nhan_id group by nhan.id";
        $result = $conn->query($sql);
        $ls = [];
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                if(!$row['danhba_id']) $row['count'] = null;
                $nhan = new nhan($row['id'],$row['ten'],$row['count']);
                $ls[] = $nhan;
            }
        }    
        //Buoc 3: Dong ket noi
        $conn->close();
        return $ls;
    }

    static function addFromDB($nhan){
        $conn = db::connect();
        
        $sql = "INSERT INTO `nhan` (`ten`) VALUES ('".$nhan->ten."')";
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }

    static function deleteFromDB($id){
        $conn = db::connect();
        $sql = "DELETE FROM `nhan` WHERE `id` = ".$id;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }

    static function updateFromDB($nhan){
        $conn = db::connect();
        
        $sql = "UPDATE `nhan` SET `ten`= '".$nhan->ten."' 
                                    WHERE id = ".$nhan->id;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }
}