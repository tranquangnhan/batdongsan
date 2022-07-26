<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">


                        <div class="row">
                            <div class="col-12">
                             

                                <div class="card-box">
                                     
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="mt-0 header-title"><?php echo $page_title; ?></h4>
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
                                                           echo '<option data-id="'.$value['name_quanhuyen'].'" value='.$value['maqh'].'>'.$value['name_quanhuyen'].'</option>';
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
                                                <input type="text" name="" id="dientich" class="form-control" placeholder="Diện tích" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input type="text" name="" id="sotang" class="form-control" placeholder="Số tầng" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="fillter">
                                                <div class="form-group">
                                                  <label for="">Lọc</label>
                                                  <?php
                                                    $arrFilterGia = ['Trên 50 tỉ','40 tỉ - 50 tỉ',"30 tỉ - 40 tỉ","25 tỉ - 30 tỉ","20 tỉ - 25 tỉ","15 tỉ - 20 tỉ","10 tỉ - 15 tỉ","7 tỉ - 10 tỉ","5 tỉ - 7 tỉ","1 tỉ - 5 tỉ","950tr - 1 tỉ","900tr - 950tr","850tr - 900tr","800tr - 850tr","750tr - 800tr","700tr - 750tr","650tr - 700tr","600tr - 650tr","550tr - 600tr","500tr - 550tr","450tr - 500tr","400tr - 450tr","350tr - 400tr","300tr - 350tr","250tr - 300tr","200tr - 250tr","150tr - 200tr","100tr - 150tr","50tr - 100tr","0 - 50tr"];
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

                                                <a  id="filter" class="btn btn-primary" style="color:white" role="button">LỌC</a>
                                            </div> <!-- /fillter -->
                                        </div>
                                       
                                    </div>
                                    <br>
                                    <table id="key-table" class="table mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="10">STT</th>
                                                    <th width="80">Hình</th>
                                                    <th >Tiêu Đề </th>
                                                    <th >Quận Huyện</th>
                                                    <th >Phường Xã</th>
                                                    <th >Diện tích</th>
                                                    <th>Số tầng</th>
                                                    <th>Giá</th>
                                                    <th>Lọc Giá</th>
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
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody id="tin">
                                            <?php
                                        $stt = 0;
                                            foreach ($ProductList as $row) {
                                                $stt++;
                                                $anHien = ($row['kiemduyet']=='1') ? '<span class="badge badge-success">Duyệt</span>': '<span class="badge badge-danger">Chưa duyệt</span>';
                                                
                                                $linkDel = "'?ctrl=baiviet&act=delete&id=".$row['id']."'";
                                                $linkEdit = '?ctrl=baiviet&act=edit&id='.$row['id'];
                                                if($_SESSION['role'] === '0'){
                                                    $buttonDel = '  <td><div  onclick="checkDelete('.$linkDel.')"  class="btn btn-danger" role="button"><i class="fa fa-trash"></i></div></td>';
                                                }
                                                if($_SESSION['role'] === '0' || $_SESSION['role'] === '1'){
                                                    $buttonEdit = ' <td><a href=""><a name="" id="" class="btn btn-primary" href="'.$linkEdit.'" role="button"><span class="mdi mdi-pencil"></span></a></a></a></td>';
                                                }
                                                
                                                $img = json_decode($row['img']);

                                                $arrayImg = '';
                                                foreach ($img as $item) {
                                                    $arrayImg .= '<img style="object-fit:cover; margin:3px" class="img-admin" width="150" height="100" src="'.$item.'">';
                                                }
                                               
                                                
                                                echo '<tr>
                                                        <td>'.$stt.'</td>
                                                        <td><div>'. $arrayImg.'</div></td>
                                                        <td class="" ><strong>'.$row['tieude']."</strong> <br>". $anHien.'</td>
                                                        <td class="" >'.$row['quanhuyen'].'</td>
                                                        <td class="" >'.$row['phuongxa'].'</td>
                                                        <td>'.$row['dientich'].'</td>
                                                        <td>'.$row['sotang'].'</td>
                                                        <td>'.$row['gia'].'</td>
                                                        <td>'.$row['locgia'].'</td>
                                                        '. $buttonDel.'
                                                        '.$buttonEdit.'
                                                    </tr>';
                                            }
                                        ?>
                                            </tbody>
                                            
                                        </table>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                       
                             
                     
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->


            </div>
    