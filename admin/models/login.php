<?php

class Model_login extends Model_db{

    function checkUser($user,$pass)
    {
        $sql = "select * from users where Username=? and Password=?";
        return $this->result1(1,$sql,$user,$pass);
    }

    function checkUserIsExit($user)
    {
        $sql = "select count(*) as countuser from users where Username=? ";
        return $this->result1(1,$sql,$user)['countuser'];
    }

    function signup($user,$pass,$sdt)
    {
        $sql = "INSERT INTO users (Username, Password, sdtgioithieu,VaiTro)
        VALUES (?,?,?,2);";
        $kq =  $this->exec1($sql,$user,$pass,$sdt);
        if($kq){
             return $this->checkUser($user,$pass);
        }else{
            return false;
        }
    }


}