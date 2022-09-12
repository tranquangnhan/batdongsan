<?php 
require_once "models/users.php"; 
require_once "../lib/myfunctions.php"; 
class Users{
    function __construct()
    {
        $this->model = new Model_Users();
        $this->lib = new lib();
        $act = "index";

        if(isset($_GET["act"])==true) $act = $_GET['act'];

        switch ($act) {
            case 'index':
                $this->index();
                break;
            case 'addnew':
                $this->addNew();
                break; 
            case 'edit':
                $this->addNew();
                break;
            case 'update':
        
                break;
            case 'delete':
                $this->delete();
                break;   
            default:
         
                break;
        }

    }
   
    
    function index()
    {   
  
        $UserList = $this->model-> GetAllUser();
        $page_title ="Danh sách người dùng";
        $sub_title = "";
        $page_file = "views/users_index.php";
        require_once "views/layout.php";
    }
    function addNew()
    {  
        if(isset($_GET['id'])&&($_GET['ctrl']='users')){
            $oneRecode = $this->model->showOneUser($_GET['id']);
            $page_title ="Sửa Người Dùng";
            $page_file = "views/users_edit.php";
        }else{
            $page_title ="Thêm Người Dùng";
            $page_file = "views/users_add.php";
        }

        if(isset($_POST['them'])&&$_POST['them'])
        {
            
            $HoTen = $_POST['HoTen'];
            $Username = $_POST['Username'];
            $Password = $_POST['Password'];
            $Email = $_POST['Email'];
            $VaiTro = $_POST['VaiTro'];
            $AnHien = $_POST['AnHien'] === 'on' ? 1: 0;

          

            
           
            
            $_SESSION['message'] = "";
            if($Username == ""){
                $_SESSION['message'] = "Bạn chưa nhập username";
            }elseif($Email == ""){
                $_SESSION['message'] = "Bạn chưa nhập email";
            }elseif(strlen($Username)<6 || strlen($Username)>12){
                $_SESSION['message'] = "Username phải từ 6 - 12 kí tự";
            }
         


            else
            {
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    settype($id,"int");
                    $oneRecode = $this->model->showOneUser($_GET['id']);
                    $countEmail = $this->model->checkEmailIsExits($Email);
                    $countUsername = $this->model->checkNameIsExits($Username);
     
                    if($countUsername>=1 && $Username != $oneRecode['Username']){
                        $_SESSION['message'] = "Username đã tồn tại, mời bạn chọn username khác";
                    } elseif($countEmail >=1 && $Email !== $oneRecode['Email']){
                        $_SESSION['message'] = "Email đã tồn tại, mời bạn chọn email khác";
                    }

                    if( $oneRecode['Password'] != $Password){
                     // Validate password strength
                     $uppercase = preg_match('@[A-Z]@', $Password);
                     $lowercase = preg_match('@[a-z]@', $Password);
                     $number    = preg_match('@[0-9]@', $Password);
                     $specialChars = preg_match('@[^\w]@', $Password);
                     if( !$uppercase || !$lowercase || !$number || !$specialChars || strlen($Password) < 6 ){
                         $_SESSION['message'] = "Password phải từ 6 kí tự trở lên, chứa kí tự đặc biệt, chữ hoa, chữ thường";
                     }
                    }

                    $this->edit($HoTen, $Username,md5($Password), $Email,$VaiTro,$AnHien,$id);
                }else
                {
                    $countEmail = $this->model->checkEmailIsExits($Email);
                    $countUsername = $this->model->checkNameIsExits($Username);
                    if($countUsername>=1 ){
                        $_SESSION['message'] = "Username đã tồn tại, mời bạn chọn username khác";
                    } elseif($countEmail >=1 ){
                        $_SESSION['message'] = "Email đã tồn tại, mời bạn chọn email khác";
                    }
                    // Validate password strength
                    $uppercase = preg_match('@[A-Z]@', $Password);
                    $lowercase = preg_match('@[a-z]@', $Password);
                    $number    = preg_match('@[0-9]@', $Password);
                    $specialChars = preg_match('@[^\w]@', $Password);
                    if( !$uppercase || !$lowercase || !$number || !$specialChars || strlen($Password) < 6 ){
                        $_SESSION['message'] = "Password phải từ 6 kí tự trở lên, chứa kí tự đặc biệt, chữ hoa, chữ thường";
                    }
                    $this->store( $HoTen, $Username,md5($Password), $Email,$VaiTro,$AnHien);
                }    
            }

            if($_SESSION['message']){
                header("location: ?ctrl=thongbao");
            }
           
        }
     
        require_once "views/layout.php";
    }//thêm mới dữ liệu vào db


    function store(
        $HoTen, $Username,$Password, $Email,$VaiTro,$AnHien){   
        $idLastUser = $this->model->addNewUser($HoTen, $Username,$Password, $Email,$VaiTro,$AnHien);
        if($idLastUser != null)
        {
            echo "<script>alert('Thêm thành công')</script>";
            header("location: ?ctrl=users&act=index");
        }else
        {
            echo "<script>alert('Thêm thất bại')</script>";
        }

        require_once "views/layout.php";
    }

    function edit(
        $HoTen, $Username,$Password, $Email,$VaiTro,$AnHien,$id)
    {
        if($this->model->editUser(
            $HoTen, $Username,$Password, $Email,$VaiTro,$AnHien,$id))
        {
            echo "<script>alert('Sửa thành công')</script>";
            header("location: ?ctrl=users&act=index");
        }else
        {
            echo "<script>alert('Sửa thất bại')</script>";
        }
        require_once "views/layout.php";
    }

    function delete()
    {
        if(isset($_GET['id'])&&($_GET['ctrl']=='users')){
            $id = $_GET['id'];
            settype($id,"int");
            
            if($this->model->deleteUser($id)){
                echo "<script>alert('Xoá thành công')</script>";
                header("location: ?ctrl=users&act=index");
            }else{
                echo "<script>alert('Xoá thất bại')</script>";
            }
        }
        require_once "views/layout.php";
    }
}
?>