<?php 
require_once "../../system/config.php";
require_once "../../system/database.php";
require_once "../models/login.php";
require_once "../../lib/myfunctions.php";
class Login
{
    function __construct()
    {
       
        $this->model = new Model_login();
        $this->lib = new lib();
        $act = "login";
        if(isset($_GET["act"])==true) $act = $_GET['act'];
        switch ($act) {
            case 'login':
                $this->checkUser();
               
                break;
            case 'signup':
                $this->signup();
                break;
            case 'logout':
                $this->logOut();
                break; 
            default:
                break;
        }
     
    }
    function checkUser()
    {   
        if(isset($_POST['login'])&&($_POST['login']))
        {
            $user = $this->lib->stripTags($_POST['user']);
            $pass = $this->lib->stripTags($_POST['password']);
            $taiKhoan = $this->model->checkUser($user,md5($pass));

            if($user == ""||$pass == ""){
                $_SESSION['error_taikhoan'] = "Vui lòng điền đầy đủ thông tin.";
            }elseif(empty($taiKhoan)){
                $_SESSION['error_taikhoan'] = "Tài khoản hoặc mật khẩu không đúng.";
            }
            else
            {
                if($taiKhoan)
                {
                    $_SESSION['sid'] = $taiKhoan['idUser'];
                    $_SESSION['suser'] = $taiKhoan['Username'];
                    $_SESSION['role'] = $taiKhoan['VaiTro'];
                    header("location: ".ROOT_URL."/admin.php");
                }else{

                    header('location: login.php?act=login');
                }
            }
    
        }
        require_once "../views/login.php";
    }
    function logOut()
    {
        if(isset($_GET['logout'])&&($_GET['logout'])){
            unset($_SESSION['sid']);
            unset($_SESSION['suser']);
            unset($_SESSION['role']);
            header('location: login.php?act=login');
        }
    }
    function signup(){
        if(isset($_POST['login'])&&($_POST['login']))
        {
            
            $user = $this->lib->stripTags($_POST['user']);
            $sdt = $this->lib->stripTags($_POST['sdt']);
            $pass = $this->lib->stripTags($_POST['password']);
            $repass = $this->lib->stripTags($_POST['repassword']);

            if($user == ""||$pass == "" || $repass == ""){
                $_SESSION['error_taikhoan'] = "Vui lòng điền đầy đủ thông tin.";
            }elseif($pass !== $repass){
                $_SESSION['error_taikhoan'] = "Mật khẩu nhập lại không trùng khớp";
            }elseif( $this->model->checkUserIsExit($user) >= 1){
                $_SESSION['error_taikhoan'] = "Tài khoản đã tồn tại";
            }
            else
            {
                $taiKhoan = $this->model->signup($user,$pass,$sdt);
                if($taiKhoan)
                {
                    $_SESSION['sid'] = $taiKhoan['idUser'];
                    $_SESSION['suser'] = $taiKhoan['Username'];
                    $_SESSION['role'] = $taiKhoan['VaiTro'];
                    header("location: ".ROOT_URL."/admin.php");
                }else{
                    header('location: login.php?act=signup');
                }
            }
    
        }
        require_once "../views/signup.php";
    }
}
new Login;