<?php
  session_start();
  ob_start();
  if(isset($_SESSION['role'])&&($_SESSION['role']==0 || $_SESSION['role']==1 || $_SESSION['role']==2 )){
    require_once "../system/config.php";
    require_once "../system/database.php";
    require_once "models/loader.php";

    if($_SESSION['role']==0){
      define('ARR_CONTROLLER',["baiviet","users","thongbao"]);
    }else{
      define('ARR_CONTROLLER',["baiviet","thongbao"]);
    }
    $ctrl = 'baiviet';
    if(isset($_GET['ctrl'])==true) $ctrl=$_GET['ctrl'];
    if(in_array($ctrl,ARR_CONTROLLER)==false) die("Không thấy địa chỉ not found 404");
    $pathFile = "controllers/$ctrl.php";
    if(file_exists($pathFile)== true) {
      require_once $pathFile; 
      $controller = new $ctrl;
    }
    else echo "controllers $ctrl not found 404";
  }
  else{
    header("location: controllers/login.php");
  }
?>