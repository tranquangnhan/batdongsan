<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row d-flex justify-content-center">
                <div class="col-xl-10">
                    <div class="card-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                            </div>
                        </div>

                        <h4 class="header-title mt-0 mb-3">Chi Tiết Tin Bất Động Sản</h4>

                        <form data-parsley-validate novalidate method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Hình ảnh</label>
                                <br>
                                <?php
                                               $imgs = json_decode($oneRecode['img']);
                                               foreach ($imgs as $row) {
                                                   echo '<img width="150" style="object-fit: cover; margin-right:15px; border-radius:3px; margin-top:5px" height="150" src="'.$row.'" alt="">';
                                               }
                                            ?>
                                <br>
                            </div>
                            <?php 
                             if($_SESSION['role'] === '0'){ ?>
                            <div class="form-group">
                                <label for="">Hợp đồng thuê / hình sổ</label>
                                <br>
                                <?php
                                
                                    $hopdongthue = json_decode($oneRecode['hopdongthue']);
                                    foreach ($hopdongthue as $hopdong) {
                                        echo '<img width="100" style="object-fit: cover; margin-right:15px; border-radius:3px;" height="100" src="'.$hopdong.'" alt="">';
                                    }
                               
                                   ?>
                                <br>
                            </div>
                        
                        <?php }?>



                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Tên bài viết</label>
                                        <h1 class="text-danger"><?=$oneRecode['tieude']?></h1>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h5 class="font-600 m-b-5">Địa chỉ</h5>
                                        <p class="text-muted"><?=$oneRecode['diachi']?></p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="font-600 ">Điện thoại</h5>
                                    <p class="text-muted mb-0"><?=$oneRecode['sdt']?></p>
                                         <?php
                                            if($checkPhone>1){
                                                echo '<span class="badge badge-danger badge-pill">Sdt có thể là môi giới, có '.$checkPhone.' bài viết dùng sdt này</span>';
                                            }else{
                                                echo '<span class="badge badge-success badge-pill"> Có '.$checkPhone.' bài viết dùng sdt này</span>';
                                            }
                                        ?>
                                        <br>
                                        <label for="">Link bài trùng</label><br>
                                        <?php
                                            if(isset($tinByPhone) && count($tinByPhone)>0){
                                                foreach ($tinByPhone as  $value) {
                                                    echo '<span style="font-size:9pt"><a href="index.php?ctrl=baiviet&act=detail&id='.$value['id'].'">'.$value['tieude'].'</a></span>';
                                                }
                                            }
                                        ?>
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="font-600 m-b-5">Người đăng</h5>
                                    <p class="text-muted"><?=$oneRecode['nguoidang']?></p>

                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-6">
                                    <h5 class="font-600 m-b-5">Quận huyện</h5>
                                    <p class="text-muted"><?=$oneRecode['quanhuyen']?></p>
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="font-600 m-b-5">Phường xã</h5>
                                    <p class="text-muted"><?=$oneRecode['phuongxa']?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Giá</h5>
                                    <p class="text-muted"><?=$oneRecode['gia']?></p>
                                </div>
                                <div class="col-lg-4">

                                    <h5 class="font-600 m-b-5">Diện tích</h5>
                                    <p class="text-muted"><?=$oneRecode['dientich']?></p>
                                 
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Diện tích công nhận</h5>
                                    <p class="text-muted"><?=$oneRecode['dientichcongnhan']?></p>
                                   
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Rộng</h5>
                                    <p class="text-muted"><?=$oneRecode['rong']?></p>
                                 
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Dài</h5>
                                    <p class="text-muted"><?=$oneRecode['dai']?></p>
                                  
                                </div>
                                <div class="col-lg-4">
                                     <h5 class="font-600 m-b-5">Số tầng</h5>
                                    <p class="text-muted"><?=$oneRecode['sotang']?></p>
                                 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Số tờ </h5>
                                    <p class="text-muted"><?=$oneRecode['soto']?></p>
                                   
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Số thuở </h5>
                                    <p class="text-muted"><?=$oneRecode['sothuo']?></p>
                                  
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Số phòng ngủ  </h5>
                                    <p class="text-muted"><?=$oneRecode['sophongngu']?></p>
                                   
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Số phòng vệ sinh</h5>
                                    <p class="text-muted"><?=$oneRecode['sophongvesinh']?></p>
                                 
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Hướng</h5>
                                    <p class="text-muted"><?=$oneRecode['huong']?></p>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Đường rộng</h5>
                                    <p class="text-muted"><?=$oneRecode['duongrong']?></p>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Ngày Đăng</h5>
                                    <p class="text-muted"><?=$oneRecode['ngaydang']?></p>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Ngày Cập Nhật</h5>
                                    <p class="text-muted"><?=$oneRecode['ngaycapnhat'] ?? date("Y-m-d")?></p>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Loại</h5>
                                    <p class="text-muted"><?=$oneRecode['loai'] ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Kiểu đường</h5>
                                    <p class="text-muted"><?=$oneRecode['kieuduong'] ?></p>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Pháp lý</h5>
                                    <?php
                                            $array = ["0"=>"Sổ hồng/ Sổ đỏ","1"=>"Hợp đồng mua bán / khác"];
                                            foreach ($array as $key => $value) {
                                                if($key == $oneRecode['phaply']){
                                                    echo "<div >".$value."</div>";
                                                }
                                            }
                                        ?>
                                </div>
                                <div class="col-lg-4">
                                     <h5 class="font-600 m-b-5">Nguồn</h5>
                                     <?php
                                              $array = ["0"=>"Nhà Chính Chủ","1"=>"Nhà bán sg","2"=>"landlooking","3"=>"Chợ tốt"];
                                            foreach ($array as $key => $value) {
                                                if($key == $oneRecode['nguon']){
                                                    echo "<div >".$value."</div>";
                                                }
                                            }
                                        ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                         <h5 class="font-600 m-b-5">Kiểm duyệt</h5>
                                        <input type="checkbox" name="kiemduyet" onclick="return false"
                                            <?php echo ($oneRecode['kiemduyet'] == 1) ? "checked" : "" ?>
                                            parsley-trigger="change" required class="form-control" id="emailAddress">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Bình chọn chính chủ</h5>
                                    <p class="text-muted"><?=$oneRecode['binhchonchinhchu'] ?></p>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Bình chọn môi giới</h5>
                                    <p class="text-muted"><?=$oneRecode['binhchonmoigioi'] ?></p>
                                </div>
                            </div>

                            <div class="row">
                                 <div class="col-lg-4">
                                    <h5 class="font-600 m-b-5">Trạng thái nhà</h5>
                                
                                    <?php
                                        $array = ["0"=>"Đã bán","1"=>"Chưa bán","2"=>"Đã cho thuê","3"=>"Chưa cho thuê"];
                                        foreach ($array as $key => $value) {
                                            if($key == $oneRecode['trangthainha']){
                                                echo "<div selected>".$value."</div>";
                                            }
                                        }
                                    ?> 
                                   </div>


                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                <h5 class="font-600 m-b-5">Nội dung</h5>
                                 <?=$oneRecode['mota']?>
                                </div>
                            </div>
                             
                            <div class="form-group text-right mb-0 mt-5">
                                <a href="?ctrl=baiviet&act=index" class="btn btn-primary waves-effect waves-light mr-1">Xong</a>
                            
                            </div>
                        </form>
                    </div>
                </div><!-- end col -->
            </div>
        </div>
    </div>
</div>