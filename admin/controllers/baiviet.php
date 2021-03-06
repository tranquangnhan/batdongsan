<?php 
require_once "models/baiviet.php"; 
require_once "../lib/myfunctions.php"; 
require_once "../lib/ssp.class.php"; 
class BaiViet{
    function __construct()
    {
        $this->model = new Model_Tin();
        $this->lib = new lib();
        $this->ssp = new SSP();
        $act = "index";

        if(isset($_GET["act"])==true) $act = $_GET['act'];

        switch ($act) {
            case 'index':
                $this->index();
                break;
            case 'getapi':
                $this->api();
                break;
            case 'getxa':
                $this->getXa();
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
            // DB table to use
        $table = 'tin';
        
        // Table's primary key
        $primaryKey = 'id';
        
        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
      
     
        $columns = array(
            array( 'db' => 'id', 'dt' => 0 ),
            array(
                'db'        => 'img',
                'dt'        => 1,
                'formatter' => function( $d, $row ) {
                    $arrayImg = json_decode($d);
                    $imgs = '';
                    foreach ($arrayImg as $item) {
                        $imgs .= '<img width="150" height="100" src='.$item.' style="object-fit:cover; margin:3px">';
                    }
                    return  $imgs;
                }
            ),
            array( 'db' => 'tieude',  'dt' => 2),
            array( 'db' => 'quanhuyen',  'dt' => 3 ),
            array( 'db' => 'phuongxa',   'dt' => 4 ),
            array( 'db' => 'dientich',  'dt' => 5 ),
            array( 'db' => 'sotang',  'dt' => 6 ),
            array( 'db' => 'gia',     'dt' => 7 ),
            array( 'db' => 'locgia',     'dt' => 8 ),
            array( 'db'        => 'id',
                    'dt'        => 9,
                    'formatter' => function( $d, $row ) {
                        $linkDel = "'?ctrl=baiviet&act=delete&id=".$d."'";
                        if($_SESSION['role'] === '0'){
                            $buttonDel = '  <td><div  onclick="checkDelete('.$linkDel.')"  class="btn btn-danger" role="button"><i class="fa fa-trash"></i></div></td>';
                        }
                        return $buttonDel;
                    }
                ),
            array( 'db'        => 'id',
                    'dt'        => 10,
                    'formatter' => function( $d, $row ) {
                         $linkEdit = '?ctrl=baiviet&act=edit&id='.$d;
                    
                        if($_SESSION['role'] === '0' || $_SESSION['role'] === '1'){
                            $buttonEdit = ' <td><a href=""><a name="" id="" class="btn btn-primary" href="'.$linkEdit.'" role="button"><span class="mdi mdi-pencil"></span></a></a></a></td>';
                        }
                        return $buttonEdit;
                    }
                ),
         
        );
        
        // SQL server connection information
        $sql_details = array(
            'user' => USER_DB,
            'pass' => PASS_DB,
            'db'   => NAME_DB,
            'host' => HOST_DB
        );
        
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        
        
        echo json_encode(
            $this->ssp->simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        );
        

    }

    function getXa()
    {   
        $Array = array();
        $id = $_POST['id'];
      
        $xa = $this->model->GetXaByIdQuanHuyen($id);
        $Array['xa'] = $xa;
        echo json_encode($Array);
    }

    function index()
    {   
        $ProductList = $this->model-> GetAllProduct();
        $GetProvince = $this->model->GetAllProvince();
        $page_title ="Danh s??ch tin b???t ?????ng s???n";
        $sub_title = "";
        $page_file = "views/baiviet_index.php";
        require_once "views/layout.php";
    }
    function addNew()
    {  
        if(isset($_GET['id'])&&($_GET['act']='dienthoai')){
            $oneRecode = $this->model->showOneTin($_GET['id']);
            $page_title ="S???a ??i???n Tho???i";
            $page_file = "views/baiviet_edit.php";
        }else{
            $page_title ="Th??m ??i???n Tho???i";
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
                $_SESSION['message'] = "B???n ch??a nh???p t??n";
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
    }//th??m m???i d??? li???u v??o db


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
            echo "<script>alert('Th??m th??nh c??ng')</script>";
            header("location: ?ctrl=baiviet&act=index");
        }else
        {
            echo "<script>alert('Th??m th???t b???i')</script>";
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
                echo "<script>alert('S???a th??nh c??ng')</script>";
                header("location: ?ctrl=baiviet&act=index");
            }else
            {
                echo "<script>alert('S???a th???t b???i')</script>";
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
                echo "<script>alert('Xo?? th??nh c??ng')</script>";
                header("location: ?ctrl=baiviet&act=index");
            }else{
                echo "<script>alert('Xo?? th???t b???i')</script>";
            }
        }
        require_once "views/layout.php";
           
        }
    }
}
?>