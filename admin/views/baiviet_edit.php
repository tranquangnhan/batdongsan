

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

                                    <h4 class="header-title mt-0 mb-3">Sửa tin bất động sản</h4>

                                    <form data-parsley-validate novalidate method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="">Hình ảnh</label>
                                            <br>
                                            <?php
                                               $imgs = json_decode($oneRecode['img']);
                                               foreach ($imgs as $row) {
                                                   echo '<img width="200" style="object-fit: cover; margin-right:15px; border-radius:3px;" height="200" src="'.$row.'" alt="">';
                                               }
                                            ?>
                                            <br>
                                           <input class="mt-2" type="file" name="img[]" multiple>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Hợp đồng thuê</label>
                                            <br>
                                            <?php
                                               $hopdongthue = json_decode($oneRecode['hopdongthue']);
                                               foreach ($hopdongthue as $hopdong) {
                                                   echo '<img width="200" style="object-fit: cover; margin-right:15px; border-radius:3px;" height="200" src="'.$hopdong.'" alt="">';
                                               }
                                            ?>
                                            <br>
                                           <input class="mt-2" type="file" name="hopdongthue[]" multiple>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Hợp đồng thuê</label>
                                            <br>
                                            <?php
                                               $hinhso = json_decode($oneRecode['hinhso']);
                                               foreach ($hinhso as $rowhinh) {
                                                   echo '<img width="200" style="object-fit: cover; margin-right:15px; border-radius:3px;" height="200" src="'.$rowhinh.'" alt="">';
                                               }
                                            ?>
                                            <br>
                                           <input class="mt-2" type="file" name="hinhso[]" multiple>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Tên bài viết</label>
                                                    <input type="text" name="tieude" value="<?=$oneRecode['tieude']?>" parsley-trigger="change" required
                                                        placeholder="Nhập tên nhà sản xuất" class="form-control" id="userName">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Địa Chỉ</label>
                                                    <input  type="text" name="diachi"  value="<?=$oneRecode['diachi']?>" parsley-trigger="change" required
                                                        placeholder="Nhập địa chỉ" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Điện thoại</label>
                                                    <input  type="text" name="sdt"  value="<?=$oneRecode['sdt']?>" parsley-trigger="change" required
                                                        placeholder="Nhập số điện thoại" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Người đăng</label>
                                                    <input  type="text" name="nguoidang"  value="<?=$oneRecode['nguoidang']?>" parsley-trigger="change" required
                                                        placeholder="Nhập người đăng" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Quận huyện</label>
                                                    <input  type="text" name="quanhuyen"  value="<?=$oneRecode['quanhuyen']?>" parsley-trigger="change" required
                                                        placeholder="Nhập quận huyện" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Phường xã</label>
                                                    <input  type="text" name="phuongxa"  value="<?=$oneRecode['phuongxa']?>" parsley-trigger="change" required
                                                        placeholder="Nhập phường xã" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Giá</label>
                                                    <input  type="text" name="gia"  value="<?=$oneRecode['gia']?>" parsley-trigger="change" required
                                                        placeholder="Nhập giá" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Diện tích</label>
                                                    <input  type="text" name="dientich"  value="<?=$oneRecode['dientich']?>" parsley-trigger="change" required
                                                        placeholder="Nhập diện tích" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Diện tích công nhận</label>
                                                    <input  type="text" name="dientichcongnhan"  value="<?=$oneRecode['dientichcongnhan']?>" parsley-trigger="change" required
                                                        placeholder="Nhập diện tích công nhận" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Rộng</label>
                                                    <input  type="text" name="number"  value="<?=$oneRecode['rong']?>" parsley-trigger="change" required
                                                        placeholder="Nhập chiều rộng" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Dài</label>
                                                    <input  type="text" name="number"  value="<?=$oneRecode['dai']?>" parsley-trigger="change" required
                                                        placeholder="Nhập chiều dài" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Số tầng</label>
                                                    <input  type="number" name="sotang"  value="<?=$oneRecode['sotang']?>" parsley-trigger="change" required
                                                        placeholder="Nhập số tầng" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Số tờ </label>
                                                    <input  type="text" name="soto"  value="<?=$oneRecode['soto']?>" parsley-trigger="change" required
                                                        placeholder="Nhập số tờ" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Số thuở</label>
                                                    <input  type="text" name="sothuo"  value="<?=$oneRecode['sothuo']?>" parsley-trigger="change" required
                                                        placeholder="Nhập số thuở" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Số phòng ngủ</label>
                                                    <input  type="text" name="dat"  value="<?=$oneRecode['dat']?>" parsley-trigger="change" required
                                                        placeholder="Nhập số phòng ngủ" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                          
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Số phòng ngủ </label>
                                                    <input  type="text" name="sophongngu"  value="<?=$oneRecode['sophongngu']?>" parsley-trigger="change" required
                                                        placeholder="Nhập số phòng ngủ" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Số phòng vệ sinh</label>
                                                    <input  type="text" name="sophongvesinh"  value="<?=$oneRecode['sophongvesinh']?>" parsley-trigger="change" required
                                                        placeholder="Nhập số phòng vệ sinh" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Hướng</label>
                                                    <input  type="text" name="huong"  value="<?=$oneRecode['huong']?>" parsley-trigger="change" required
                                                        placeholder="Nhập hướng" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                          
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Ngày Đăng</label>
                                                    <input  type="date" name="ngaydang"  value="<?=$oneRecode['ngaydang']?>" parsley-trigger="change" required
                                                        placeholder="Nhập số phòng ngủ" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Ngày Cập Nhật</label>
                                                    <input  type="date" name="ngaycapnhat"  value="<?=$oneRecode['ngaycapnhat']?>" parsley-trigger="change" required
                                                        placeholder="Nhập số phòng vệ sinh" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Loại</label>
                                                    <input  type="text" name="loai"  value="<?=$oneRecode['loai']?>" parsley-trigger="change" required
                                                        placeholder="Nhập loại" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                          
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Kiểu đường</label>
                                                    <input  type="text" name="kieuduong"  value="<?=$oneRecode['kieuduong']?>" parsley-trigger="change" required
                                                        placeholder="Nhập kiểu đường" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Pháp lý</label>
                                                    <input  type="text" name="phaply"  value="<?=$oneRecode['phaply']?>" parsley-trigger="change" required
                                                        placeholder="Nhập pháp lý" class="form-control" id="emailAddress">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Nguồn</label>
                                                    <select name="nguon" id="" class="form-control">
                                                        <option value=""></option>
                                                        <?php
                                                            $array = ["0"=>"Nhà Chính Chủ","1"=>"Chợ Tốt","2"=>"landlooking","3"=>"Ký gửi"];
                                                            foreach ($array as $key => $value) {
                                                                if($key == $oneRecode['nguon']){
                                                                    echo "<option selected>".$value."</option>";
                                                                }else{
                                                                    echo "<option >".$value."</option>";
                                                                }
                                                            }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-lg-4">
                                              <div class="form-group">
                                                  <label for="">Kiểm duyệt</label>
                                                  <input  type="checkbox"  name="kiemduyet" <?php echo ($oneRecode['kiemduyet'] == 1) ? "checked" : "" ?> parsley-trigger="change" required
                                                     class="form-control" id="emailAddress">
                                              </div>
                                          </div>
                                          <div class="col-lg-4">
                                              <div class="form-group">
                                                  <label for="">Bình chọn chính chủ</label>
                                                  <input  type="number" name="binhchonchinhchu"  value="<?=$oneRecode['binhchonchinhchu']?>" parsley-trigger="change" required
                                                      placeholder="Nhập bình chọn chính chủ" class="form-control" id="emailAddress">
                                              </div>
                                          </div>
                                          <div class="col-lg-4">
                                              <div class="form-group">
                                                    <label for="">Bình chọn môi giới</label>
                                                  <input  type="number" name="binhchonmoigioi"  value="<?=$oneRecode['binhchonmoigioi']?>" parsley-trigger="change" required
                                                      placeholder="Nhập bình chọn môi giới" class="form-control" id="emailAddress">
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-lg-4">
                                              <div class="form-group">
                                                  <label for="">Trạng thái nhà</label>
                                                  <select name="trangthainha" id="" class="form-control">
                                                        <option value=""></option>
                                                        <?php
                                                            $array = ["0"=>"Đã bán","1"=>"Chưa bán","2"=>"Đã cho thuê","3"=>"Chưa cho thuê"];
                                                            foreach ($array as $key => $value) {
                                                                if($key == $oneRecode['trangthainha']){
                                                                    echo "<option selected>".$value."</option>";
                                                                }else{
                                                                    echo "<option >".$value."</option>";
                                                                }
                                                            }
                                                        ?>

                                                    </select>
                                              </div>
                                          </div>
                                          <div class="col-lg-4">
                                              <div class="form-group">
                                                  <label for="">Đường rộng</label>
                                                  <input  type="number" name="duongrong"  value="<?=$oneRecode['duongrong']?>" parsley-trigger="change" required
                                                      placeholder="Nhập đường rộng" class="form-control" id="emailAddress">
                                              </div>
                                          </div>
                                       
                                      </div>


                                            <textarea id="editor1" style="height: 300px;width:100%" name="mota" >
                                            <?=$oneRecode['mota']?>
                                           </textarea>
                                          

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