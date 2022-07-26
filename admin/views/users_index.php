<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">


                        <div class="row">
                            <div class="col-12">
                            

                                <div class="card-box">
                                     <h4 class="mt-0 header-title"><?php echo $page_title; ?></h4>
                                    <p class="text-muted font-14 mb-3">
                                    <?php echo $sub_title; ?>
                                    </p>
                                    <table class="table mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="10">STT</th>
                                                    <th >Tên Người dùng</th>
                                                    <th >Họ tên </th>
                                                    <th >Email</th>
                                                    <th >Vai Trò</th>
                                                    <th width="5">Xoá </th>
                                                    <th width="5">Sửa</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody >
                                            <?php
                                        $stt = 0;
                                            foreach ($UserList  as $row) {
                                                $stt++;
                                                $anHien = ($row['AnHien']=='1') ? '<span class="badge badge-success">Hiện</span>': '<span class="badge badge-danger">Ẩn</span>';
                                                
                                                $linkDel = "'?ctrl=users&act=delete&id=".$row['idUser']."'";
                                                $linkEdit = '?ctrl=users&act=edit&id='.$row['idUser'];
                                                
                                                $img = json_decode($row['img']);

                                                $arrayImg = '';
                                                foreach ($img as $item) {
                                                    $arrayImg .= '<img style="object-fit:cover; margin:3px" class="img-admin" width="300" height="200" src="'.$item.'">';
                                                }
                                                $arrayRole = ["0"=>"admin","1"=>"subadmin","2"=>"Người Dùng"];
                                             
                                                foreach ($arrayRole as $key => $value) {
                                                    if($row['VaiTro'] ==  $key){
                                                        $role = $value;
                                                    }
                                                }
                                                echo '<tr>
                                                        <td>'.$stt.'</td>
                                                        <td class="" >'.$row['Username']." <br>". $anHien.'</td>
                                                        <td class="" >'.$row['HoTen'].'</td>
                                                        <td class="" >'.$row['Email'].'</td>
                                                        <td>'. $role.'</td>
                                                        <td><div  onclick="checkDelete('.$linkDel.')"  class="btn btn-danger" role="button"><i class="fa fa-trash"></i></div></td>
                                                        <td><a href=""><a name="" id="" class="btn btn-primary" href="'.$linkEdit.'" role="button"><span class="mdi mdi-pencil"></span></a></a></a></td>
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
    
