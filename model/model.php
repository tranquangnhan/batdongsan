<?php 
 
class Model_home extends Model_db{


    function postData($name ,$phone, $time,$date,$status){
        $SQL = "INSERT INTO form (name, phone, time,date, status)
        VALUES (?, ?, ?, ?,?)";
        return  $this->exec1($SQL, $name ,$phone, $time,$date,$status);
    }

    function getData(){
        $date = date("Y/m/d");
        // SELECT * FROM `form` WHERE date = "2022-04-16" ORDER BY time,id ASC;
        $SQL = "SELECT count(*) + 1 as stt FROM `form` WHERE date = ? AND status = 1 ORDER BY time,id ASC";
        return  $this->result1(1,$SQL, $date);
    }

    function getStt($time){
        $date = date("Y/m/d");
        $SQL = "SELECT count(*) as sttcuaban, time FROM `form` WHERE date = ? AND time = ?  ORDER BY time,id ASC";
        return  $this->result1(1,$SQL, $date,$time);
    }
    function checkPhone($phone){
        $date = date("Y/m/d");
        $SQL = "SELECT count(*) as countphone FROM `form` WHERE phone = ? AND date = ?";
        return  $this->result1(1,$SQL, $phone, $date)['countphone'];
    }

    function deleteFormBySdt($phone){
        $SQL = "DELETE FROM form WHERE phone = ? AND status = 0";
        return $this->exec1($SQL,$phone);
    }


    function getTimeLeft(){
        $SQL = "SELECT timeleft  FROM `setting`";
        return  $this->result1(1,$SQL)['timeleft'];
    }

    function setTimeLeft(){
        $SQL = "UPDATE setting SET timeleft = timeleft-1";
        return $this->exec1($SQL);
    }
    function resetTime($thoiGian){
        $SQL = "UPDATE setting SET timeleft = ?";
        return $this->exec1($SQL,$thoiGian);
    }
    
    function getThoiGian(){
        $SQL = "SELECT thoigian FROM setting";
        return $this->result1(1,$SQL)['thoigian'];
    }

    function setThoiGian($thoiGian){
        $SQL = "UPDATE setting SET timeleft = ?";
        return $this->exec1($SQL,$thoiGian);
    }
    function getSlByBuoi($buoi){
        $SQL = "SELECT $buoi FROM setting";
        return $this->result1(1,$SQL)[$buoi];
    }

    function getTinMoi(){
        $SQL = "SELECT * FROM baiviet ORDER BY id DESC LIMIT 6";
        return $this->result1(0,$SQL);
    }
    function getTinNhieuView(){
        $SQL = "SELECT * FROM baiviet ORDER BY luotxem DESC LIMIT 6";
        return $this->result1(0,$SQL);
    }
    function getBlogSingle($id){
        $SQL = "SELECT * FROM baiviet WHERE id = ?";
        return $this->result1(1,$SQL,$id);
    }

    function countBenhNhan($time){
        $date = date("Y/m/d");
        $SQL = "SELECT count(*) as countbn FROM form WHERE time =? AND date = ?";
        return $this->result1(1,$SQL,$time,$date)['countbn'];

    }

    function sttDangLam(){
        $SQL = "SELECT timeleft FROM setting";
        return $this->result1(1,$SQL)['timeleft'];
    }
}

