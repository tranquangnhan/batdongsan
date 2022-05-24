<?php

class Model_login extends Model_db{

    function checkUser($user,$pass)
    {
        $sql = "select * from users where Username=? and Password=?";
        return $this->result1(1,$sql,$user,$pass);
    }


}