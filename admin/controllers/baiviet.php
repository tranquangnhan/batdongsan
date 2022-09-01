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
            case 'getduong':
                $this->getDuong();
                break;
            case 'addnew':
                $this->addNew();
                break; 
            case 'edit':
                $this->addNew();
                break;
            case 'detail':
                $this->detail();
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

            array(
                'db'        => 'img',
                'dt'        => 0,
                'formatter' => function( $d, $row  ) {
                    $i=0;
                    $i++;
                    $arrayImg = json_decode($d);
                    $imgs = '<div  id="carouselExampleControls'.$arrayImg[0].'" class="carousel slide" data-interval="false" data-ride="carousel">
                    <div class="carousel-inner">';
                    foreach ($arrayImg as $index => $item) {
                        if($index == 0 ){
                            $imgs .= ' <div class="carousel-item  active">
                            <img class="d-block w-100" src="'.$item.'" alt="Third slide">
                          </div>';
                        }else{
                            $imgs .= ' <div class="carousel-item  ">
                            <img class="d-block w-100" src="'.$item.'" alt="Third slide">
                          </div>';
                        }
                      
                    }
                    $imgs .= '</div>
                                <a class="carousel-control-prev" href="#carouselExampleControls'.$arrayImg[0].'" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls'.$arrayImg[0].'" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </a>
                            </div>';
                    return  $imgs;
                }
            ),
            array( 'db' => 'tieude',  'dt' => 1),
            array( 'db' => 'quanhuyen',  'dt' => 2 ),
            array( 'db' => 'phuongxa',   'dt' => 3 ),
            array( 'db' => 'duong',   'dt' => 4 ),
            array( 'db' => 'dientich',  'dt' => 5 ),
            array( 'db' => 'sotang',  'dt' => 6 ),
            array( 'db' => 'gia',     'dt' => 7 ),
            array( 'db' => 'locgia',     'dt' => 8 ),
            array( 'db' => 'locdientich',     'dt' => 9 ),
            array( 'db'        => 'nguon',
                'dt'        => 10,
                'formatter' => function( $d, $row ) {
                
                    $nguon = '';
                    if($d == 0){
                        $nguon = '<div class="text-primary">Nhà chính chủ<div>';
                    }elseif($d == 1){
                        $nguon = '<div class="text-secondary">Nhà bán sg<div>';
                    }elseif($d == 2){
                        $nguon = '<div class="text-success">Landlooking<div>';
                    }else{
                        $nguon = '<div class="text-danger">Chợ tốt<div>';
                    }
                 
                    return $nguon;
                }
            ),
             array( 'db'        => 'id',
                    'dt'        => 11,
                    'formatter' => function( $d, $row ) {
                         $linkDetail = '?ctrl=baiviet&act=detail&id='.$d;
                         $buttonDetail = ' <td><a href=""><a name="" id="" target="_blank" class="btn btn-success" href="'.$linkDetail.'" role="button"><span class="mdi mdi-feature-search-outline"></span></a></a></a></td>';
                        return $buttonDetail;
                    }
                ),
            array( 'db'        => 'id',
                    'dt'        => 12,
                    'formatter' => function( $d, $row ) {
                        $linkDel = "'?ctrl=baiviet&act=delete&id=".$d."'";
                        if($_SESSION['role'] === '0'){
                            $buttonDel = '  <td><div  onclick="checkDelete('.$linkDel.')"  class="btn btn-danger" role="button"><i class="fa fa-trash"></i></div></td>';
                        }
                        return $buttonDel;
                    }
                ),
            array( 'db'        => 'id',
                    'dt'        => 13,
                    'formatter' => function( $d, $row ) {
                         $linkEdit = '?ctrl=baiviet&act=edit&id='.$d;
                    
                        if($_SESSION['role'] === '0' || $_SESSION['role'] === '1'){
                            $buttonEdit = ' <td><a href=""><a name="" target="_blank" id="" class="btn btn-primary" href="'.$linkEdit.'" role="button"><span class="mdi mdi-pencil"></span></a></a></a></td>';
                        }
                        return $buttonEdit;
                    }
                ),
            array( 'db' => 'id', 'dt' => 14 ),
         
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

    function getDuong()
    {   
        $Array = array();
        $id = $_POST['id'];
      
        $duong = $this->model->GetDuongByIdQuanHuyen($id);
        $Array['duong'] = $duong;
        echo json_encode($Array);
    }

    function index()
    {   
        // $ProductList = $this->model-> GetAllProduct();
        $GetProvince = $this->model->GetAllProvince();
        $page_title ="Lọc tin bất động sản";
        $sub_title = "";
        $page_file = "views/baiviet_index.php";
        require_once "views/layout.php";
    }
    function detail(){
        $oneRecode = $this->model->showOneTin($_GET['id']);
        $checkPhone = $this->model->countPhone($oneRecode['sdt']);
        if($checkPhone>1){
            $tinByPhone = $this->model->getTinByPhone($oneRecode['sdt']);
        }
        $page_title ="Chi tiết tin";
        $page_file = "views/baiviet_chitiet.php";
        require_once "views/layout.php";
    }

    function addNew()
    {  
        $arrayFilterGia = [50000000000,40000000000,30000000000,25000000000,20000000000,15000000000,10000000000,7000000000,5000000000,1000000000,950000000,900000000,850000000,800000000,750000000,700000000,650000000,600000000,550000000,500000000,450000000,40000000,350000000,300000000,250000000,200000000,150000000,100000000,50000000,0];
       
        $GetProvince = $this->model->GetAllProvince();
        if(isset($_GET['id'])&&($_GET['act']='dienthoai')){
            $oneRecode = $this->model->showOneTin($_GET['id']);
            $checkPhone = $this->model->countPhone($oneRecode['sdt']);
            if($checkPhone>1){
	 	 $tinByPhone = $this->model->getTinByPhone($oneRecode['sdt']); 
            }
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
           

            $mota = $_POST['mota'];
            $diachi = $_POST['diachi'];
            $sdt = $_POST['sdt'];
            $nguoidang = $_POST['nguoidang'];
            $quanhuyen = $_POST['quanhuyen'];
            $phuongxa = $_POST['phuongxa'];
            $duong = $_POST['duong'];
           
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

            $ngaydang= date_format(date_create($ngaydang),"Y/m/d");
            $ngaycapnhat= date_format(date_create($ngaycapnhat),"Y/m/d");

            
            
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
                   
                    $this->edit($tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$duong,$gia,$dientich,$dientichcongnhan,
                    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
                    $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
                    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
                    $trangthainha,$duongrong,$ghichu
                    ,$id);
                
                }else
                {
                    $this->store($tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$duong,$gia,$dientich,$dientichcongnhan,
                    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
                    $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
                    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
                    $trangthainha,$duongrong,$ghichu);
                }    
            }

           
        }
     
        require_once "views/layout.php";
    }//thêm mới dữ liệu vào db


    function store(
    $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$duong,$gia,$dientich,$dientichcongnhan,
    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
    $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
    $trangthainha,$duongrong,$ghichu){   
        $idLastBaiViet = $this->model->addNewTin(
        $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$duong,$gia,$dientich,$dientichcongnhan,
        $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
        $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
        $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
        $trangthainha,$duongrong,$ghichu);

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
    $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$duong,
    $gia,$dientich,$dientichcongnhan,
    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
    $hopdongthue,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
    $trangthainha,$duongrong,$ghichu
    ,$id)
    {
        if($_SESSION['role'] === '0' || $_SESSION['role'] === '1'){
            if($this->model->editTin(
            $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$duong,
            $gia,$dientich,$dientichcongnhan,
            $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
            $hopdongthue,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
            $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
            $trangthainha,$duongrong,$ghichu
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
