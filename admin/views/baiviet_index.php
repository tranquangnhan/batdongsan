<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">


                        <div class="row">
                            <div class="col-12 p-m-0">
                             

                                <div class="card-box">
                                    <div class="col-3">
                                        <a  class="btn btn-primary mb-2 hienloc" style="color:white" role="button">Lọc</a>
                                    </div>
                                    <div class="row filter pl-2 pr-2">
                                        <div class="col-lg-12 p-m-0">
                                            <h4 class="mt-0 ml-1 header-title"><?php echo $page_title; ?></h4>
                                            <p class="text-muted font-14 mb-3">
                                            <?php echo $sub_title; ?>
                                            </p>
                                            </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" name="" id="tieude" class="form-control" placeholder="Search theo tiêu đề" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                 
                                                  <select class="form-control" name="" id="quanhuyen">
                                                    <option value="">Quận Huyện</option>
                                                    <?php 
                                                        foreach ( $GetProvince as $key => $value) {
                                                           echo '<option data-id="'.$value['id_quan'].'" value="'.$value['ten_quan'].'">'.$value['ten_quan'].'</option>';
                                                        }
                                                    ?>
                                                  </select>
                                                </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                            <select class="form-control" name="" id="phuongxaajax">
                                                <option value="" selected>Chọn Phường Xã</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                            <select class="form-control" name="" id="duongajax">
                                                <option value="" selected>Chọn Đường</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                    <?php
                                                        $arrDienTich = ['Trên 500 m2','300 - 499 m2',"250 - 299 m2","200 - 249 m2","150 - 199 m2","100 - 149 m2","80 - 99 m2","50 - 79 m2","30 - 49 m2","Dưới 30 m2"];
                                                    ?>
                                                    <select class="form-control" name="" id="locdientich">
                                                        <option value="">Lọc diện tích</option>
                                                        <?php 
                                                            foreach ($arrDienTich as $key => $value) {
                                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group mt-3 pt-1">
                                                <input type="text" name="" id="sotang" class="form-control" placeholder="Số tầng" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="fillter">
                                                <div class="form-group">
                                                  <label for="">Lọc</label>
                                                  <?php
                                                    $arrFilterGia = ['Trên 50 tỉ','40 tỉ - 50 tỉ',"30 tỉ - 40 tỉ","25 tỉ - 30 tỉ","20 tỉ - 25 tỉ","15 tỉ - 20 tỉ","10 tỉ - 15 tỉ","7 tỉ - 10 tỉ","5 tỉ - 7 tỉ","1 tỉ - 5 tỉ","950tr - 1 tỉ","900tr - 949tr","850tr - 899tr","800tr - 849tr","750tr - 799tr","700tr - 749tr","650tr - 699tr","600tr - 649tr","550tr - 599tr","500tr - 549tr","450tr - 499tr","400tr - 449tr","350tr - 399tr","300tr - 349tr","250tr - 299tr","200tr - 249tr","150tr - 199tr","100tr - 149tr","50tr - 99tr","0 - 49tr"];
                                                  ?>
                                                  <select class="form-control" name="" id="gia">
                                                    <option value="">Lọc giá</option>
                                                    <?php 
                                                        foreach ($arrFilterGia as $key => $value) {
                                                           echo '<option value='.$key.'>'.$value.'</option>';
                                                        }
                                                    ?>
                                                  </select>
                                                </div>

                                              
                                            </div> <!-- /fillter -->
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                    <label for="">Nguồn</label>
                                                    <?php
                                                        $arrDienTich = ["Nhà chính chủ","Nhà bán sg","Landlooking","Chợ tốt","Ký gửi"];
                                                    ?>
                                                    <select class="form-control" name="" id="nguon">
                                                        <option value="">Chọn nguồn</option>
                                                        <?php 
                                                            foreach ($arrDienTich as $key => $value) {
                                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                        </div>
                                        <div class="col-lg-2 mt-3 pt-1">
                                             <a  id="filter" class="btn btn-primary ml-2" style="color:white" role="button">Lọc Bài Viết</a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="responsive-table-plugin">
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive" data-pattern="priority-columns">
                                                <table id="key-table" class="table mb-0">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th class="hinh">Hình</th>
                                                                <th >Tiêu Đề </th>
                                                                <th >Quận Huyện</th>
                                                                <th >Phường Xã</th>
                                                                <th >Đường</th>
                                                                <th >Diện tích</th>
                                                                <th>Số tầng</th>
                                                                <th>Giá</th>
                                                                <th style="display:none">Lọc Giá</th>
                                                                <th style="display:none">Lọc Diện Tích</th>
                                                                <th>Nguồn</th>
                                                                <th width="5">Chi tiết </th>

                                                               <?php 
                                                                    if($_SESSION['role'] === '0'){
                                                                        echo ' <th width="5">Xoá </th>';
                                                                    }
                                                                ?>
                                                                <?php 
                                                                    if($_SESSION['role'] === '0' || $_SESSION['role'] === '1' ){
                                                                        echo ' <th width="5">Sửa </th>';
                                                                    }
                                                                ?>
                                                                  <th style="display:none">id</th>
                                                            </tr>
                                                        </thead>
                                                        
                                                        <tbody id="tin">
                                                            
                                                        </tbody>
                                                        
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                       
                             
                     
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->


            </div>
    
