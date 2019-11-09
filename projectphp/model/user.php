<?php
Class User{
    var $userName;
    var $passWord;
    var $fullName;

    function User($userName, $passWord, $fullName){
        $this->userName = $userName;
        $this->passWord = $passWord;
        $this->fullName = $fullName;
    }

    /**
     * Xác thực người sử dung
     * @param $userName string là tên đăng nhập
     * @param $passWord string là mật khẩu
     * @return User hoặc null 
     */
    static function authentication($userName, $passWord){
        if($userName == "quydd@gmail.com" && $passWord == "quy123123"){
            return new User($userName, $passWord, "Nguyen Thanh Quy");
        }else{
            return null;
        }
    }
}

?>