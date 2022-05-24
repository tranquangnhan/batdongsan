

<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="row d-flex justify-content-center">
                            <div class="col-xl-10">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
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

                                    <h4 class="header-title mt-0 mb-3">Người Dùng</h4>

                                    <form data-parsley-validate novalidate method="post" enctype="multipart/form-data">
                                       
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Họ Tên</label>
                                                    <input type="text" name="HoTen" value="<?=$oneRecode['HoTen']?>" parsley-trigger="change" required
                                                        placeholder="Nhập họ tên" class="form-control" id="userName">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Tên Người Dùng</label>
                                                    <input  type="text" name="Username"  value="<?=$oneRecode['Username']?>" parsley-trigger="change" required
                                                        placeholder="Nhập tên người dùng" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Mật Khẩu</label>
                                                    <input  type="password" name="Password"  value="<?=$oneRecode['Password']?>" parsley-trigger="change" required
                                                        placeholder="Nhập tên người dùng" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input  type="text" name="Email"  value="<?=$oneRecode['Email']?>" parsley-trigger="change" required
                                                        placeholder="Nhập email" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                  
                                                    <div class="form-group">
                                                        <label for="">Vai Trò</label>
                                                      <select class="form-control" name="VaiTro" id="">
                                                       
                                                       
                                                        <?php 
                                                            $arrayRole = ["0"=>"admin","1"=>"subadmin","2"=>"Người Dùng"];
                                                    
                                                            foreach ($arrayRole as $key => $value) {
                                                                if($oneRecode['VaiTro'] ==  $key){
                                                                    echo '<option selected>'.$value.'</option>';
                                                                }else{
                                                                    echo '<option >'.$value.'</option>';
                                                                }
                                                            }
                                                            
                                                        ?>
                                                      </select>
                                                    </div>
                                                  
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-check">
                                                  <label class="form-check-label">
                                                    <input type="checkbox" <?php echo (($oneRecode['AnHien'] == "1") ? 'checked': '');  ?> class="form-check-input" name="AnHien" id=""  >
                                                    Ẩn Hiện
                                                  </label>
                                                </div>
                                            </div>
                                        </div>
                                          

                                        <div class="form-group text-right mb-0 mt-5">
                                            <input type="submit" name="them" class="btn btn-primary waves-effect waves-light mr-1" value="Sửa">
                                           <a href="?ctrl=baiviet&act=index" clas="btn btn-secondary waves-effect waves-light">Huỷ</a>
                                        </div>

                                    </form>
                                </div>
                            </div><!-- end col -->
                        </div>
                    </div>
                </div>
            </div>