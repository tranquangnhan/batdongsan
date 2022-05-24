<?php 
require_once "models/baiviet.php"; 
require_once "../lib/myfunctions.php"; 
class BaiViet{
    function __construct()
    {
        $this->model = new Model_Tin();
        $this->lib = new lib();
        $act = "index";

        if(isset($_GET["act"])==true) $act = $_GET['act'];

        switch ($act) {
            case 'index':
                $this->index();
                break;
            case 'getapi':
                $this->api();
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
    function api(){
        $Return = array();
        $Return['data'] = $this->model-> GetAllProduct();
        $Return['recordsTotal'] = count( $this->model-> GetAllProduct());
        echo json_encode($Return);
    }

    function index()
    {   
        $ProductList = $this->model-> GetAllProduct();
        $page_title ="Danh sách tin bất động sản";
        $sub_title = "";
        $page_file = "views/baiviet_index.php";
        require_once "views/layout.php";
    }
    function addNew()
    {  
        if(isset($_GET['id'])&&($_GET['act']='dienthoai')){
            $oneRecode = $this->model->showOneTin($_GET['id']);
            $page_title ="Sửa Điện Thoại";
            $page_file = "views/baiviet_edit.php";
        }else{
            $page_title ="Thêm Điện Thoại";
            $page_file = "views/baiviet_add.php";
        }

        if(isset($_POST['them'])&&$_POST['them'])
        {

            $tieude = $this->lib->stripTags($_POST['tieude']);
            $slug = $this->lib->slug($tieude);
            $motanh = $_FILES['img'];
         
            $img = $this->lib->checkUpLoadMany($motanh);
            $hopdongthue = $_FILES['hopdongthue'];
            $hopdongthueImgs = $this->lib->checkUpLoadMany($hopdongthue);
            $hinhso = $_FILES['hinhso'];
            $hinhsoImgs = $this->lib->checkUpLoadMany($hinhso);

            $mota = $_POST['mota'];
            $diachi = $_POST['diachi'];
            $sdt = $_POST['sdt'];
            $nguoidang = $_POST['nguoidang'];
            $quanhuyen = $_POST['quanhuyen'];
            $phuongxa = $_POST['phuongxa'];
            $gia = $_POST['gia'];
            $dientich = $_POST['dientich'];
            $dientichcongnhan = $_POST['dientichcongnhan'];
            $rong = $_POST['rong'];
            $dai = $_POST['dai'];
            $sotang = $_POST['sotang'];
            $soto = $_POST['soto'];
            $sothuo = $_POST['sothuo'];
            $sophongngu = $_POST['sophongngu'];
            $sophongvesinh = $_POST['sophongvesinh'];
            $huong = $_POST['huong'];
            $ngaydang = $_POST['ngaydang'];
            $ngaycapnhat = $_POST['ngaycapnhat'];
            $loai = $_POST['loai'];
            $kieuduong = $_POST['kieuduong'];
            $phaply = $_POST['phaply'];
            $nguon = $_POST['nguon'];
            $kiemduyet = ($_POST['kiemduyet'] =='on') ? 1 : 0;
            $binhchonchinhchu = $_POST['binhchonchinhchu'];
            $binhchonmoigioi = $_POST['binhchonmoigioi'];
            $trangthainha = $_POST['trangthainha'];
            $duongrong = $_POST['duongrong'];
            $ghichu = $_POST['ghichu'];


            settype($binhchonchinhchu,"int");
            settype($binhchonmoigioi,"int");
            
            $_SESSION['message'] = "";
            if($tieude == ""){
                $_SESSION['message'] = "Bạn chưa nhập tên";
            } 
         

            if($_SESSION['message']){
                header("location: ?ctrl=thongbao");
            }

            else
            {
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    settype($id,"int");
                    if($hopdongthueImgs == null){
                        $hopdongthueImgs = $oneRecode['hopdongthue'];
                    }
                    if($hinhsoImgs == null){
                        $hinhsoImgs = $oneRecode['hinhso'];
                    }
                    $this->edit($tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$gia,$dientich,$dientichcongnhan,
                    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
                    $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
                    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
                    $trangthainha,$duongrong,$hinhsoImgs,$ghichu
                    ,$id);
                
                }else
                {
                    $this->store($tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$gia,$dientich,$dientichcongnhan,
                    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
                    $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
                    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
                    $trangthainha,$duongrong,$hinhsoImgs,$ghichu);
                }    
            }

           
        }
     
        require_once "views/layout.php";
    }//thêm mới dữ liệu vào db


    function store(
    $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$gia,$dientich,$dientichcongnhan,
    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
    $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
    $trangthainha,$duongrong,$hinhsoImgs,$ghichu){   
        $idLastBaiViet = $this->model->addNewTin(
        $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$gia,$dientich,$dientichcongnhan,
        $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
        $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
        $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
        $trangthainha,$duongrong,$hinhsoImgs,$ghichu);
        if($idLastBaiViet != null)
        {
            echo "<script>alert('Thêm thành công')</script>";
            header("location: ?ctrl=baiviet&act=index");
        }else
        {
            echo "<script>alert('Thêm thất bại')</script>";
        }

        require_once "views/layout.php";
    }

    function edit(
    $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,
    $gia,$dientich,$dientichcongnhan,
    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
    $hopdongthue,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
    $trangthainha,$duongrong,$hinhso,$ghichu
    ,$id)
    {
        if($_SESSION['role'] === '0' || $_SESSION['role'] === '1'){
            if($this->model->editTin(
            $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,
            $gia,$dientich,$dientichcongnhan,
            $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
            $hopdongthue,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
            $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
            $trangthainha,$duongrong,$hinhso,$ghichu
            ,$id))
            {
                echo "<script>alert('Sửa thành công')</script>";
                header("location: ?ctrl=baiviet&act=index");
            }else
            {
                echo "<script>alert('Sửa thất bại')</script>";
            }
            require_once "views/layout.php";
        }
    }

    function delete()
    {
        if($_SESSION['role'] === '0'){
         
        if(isset($_GET['id'])&&($_GET['ctrl']=='baiviet')){
            $id = $_GET['id'];
            settype($id,"int");
            
            if($this->model->deleteTin($id)){
                echo "<script>alert('Xoá thành công')</script>";
                header("location: ?ctrl=baiviet&act=index");
            }else{
                echo "<script>alert('Xoá thất bại')</script>";
            }
        }
        require_once "views/layout.php";
           
        }
    }
}
?>