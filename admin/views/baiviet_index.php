<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">


                        <div class="row">
                            <div class="col-12">
                             

                                <div class="card-box">
                                     
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <h4 class="mt-0 header-title"><?php echo $page_title; ?></h4>
                                        <p class="text-muted font-14 mb-3">
                                        <?php echo $sub_title; ?>
                                        </p>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                              <label for=""></label>
                                              <input type="text" name="" id="quanhuyen" class="form-control" placeholder="Search theo quận/huyện" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for=""></label>
                                                <input type="text" name="" id="phuongxa" class="form-control" placeholder="Search theo phường/xã" aria-describedby="helpId">
                                                </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fillter">
                                                <section class="range-slider" id="facet-price-range-slider" data-options='{"output":{"prefix":""},"maxSymbol":""}'>
                                                    <input name="range-1" id="filter-min" value="0" min="0" max="100000000000" step="1" type="range">
                                                    <input name="range-2" id="filter-max" value="30000000000" min="0" max="100000000000" step="1" type="range">
                                                </section>
                                                <span class="left">0 VND</span>
                                                <span class="right">100.000.000.000 VND</span>
                                            </div> <!-- /fillter -->
                                        </div>
                                    </div>
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
    