<?php

class Model_Tin extends Model_db{
    function listRecords() 
    {
        $sql = "SELECT * FROM tin";
        return $this->result1(0,$sql);
    }
    
    function addNewTin(
    $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$gia,$dientich,$dientichcongnhan,
    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
    $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
    $trangthainha,$duongrong,$hinhsoImgs,$ghichu)
    {
        $sql = "INSERT INTO tin(tieude,img,mota,diachi,sdt,nguoidang,quanhuyen,phuongxa,gia,dientich,dientichcongnhan,rong,dai,sotang,soto,sothuo,sophongngu,sophongvesinh,hopdongthue,huong,ngaydang,ngaycapnhat,loai,kieuduong,phaply,nguon,kiemduyet,binhchonchinhchu,binhchonmoigioi,trangthainha,duongrong,hinhso,ghichu) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->getLastId($sql,
        $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,$gia,$dientich,$dientichcongnhan,
        $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
        $hopdongthueImgs,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
        $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
        $trangthainha,$duongrong,$hinhsoImgs,$ghichu);
    }

    function deleteTin($id)
    {   
        $sql = "DELETE FROM tin WHERE id = ?";
        return $this->exec1($sql,$id);
    }

    function editTin(
    $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,
    $gia,$dientich,$dientichcongnhan,
    $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
    $hopdongthue,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
    $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
    $trangthainha,$duongrong,$hinhso,$ghichu
    ,$id){
        if($img == "")
        {
            $sql = "UPDATE tin SET tieude= ?,mota=?,diachi=?,sdt=?,nguoidang=?,quanhuyen=?,phuongxa=?,";
            $sql .=" gia=?,dientich=?,dientichcongnhan=?,rong=?,dai=?,sotang=?,soto=?,sothuo=?,sophongngu=?,sophongvesinh=?,";
            $sql .=" hopdongthue=?,huong=?,ngaydang=?,ngaycapnhat=?,loai=?,kieuduong=?,phaply=?,nguon=?,kiemduyet=?,binhchonchinhchu=?,binhchonmoigioi=?,trangthainha=?,duongrong=?,";
            $sql .=" hinhso=?,ghichu=? WHERE id=?";
            return $this->SqlExecDebug($sql,
            $tieude,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,
            $gia,$dientich,$dientichcongnhan,
            $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
            $hopdongthue,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
            $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
            $trangthainha,$duongrong,$hinhso,$ghichu,$id);
        }else
        {
            $sql = "UPDATE tin SET tieude= ?,img=?,mota=?,diachi=?,sdt=?,nguoidang=?,quanhuyen=?,phuongxa=?,";
            $sql .=" gia=?,dientich=?,dientichcongnhan=?,rong=?,dai=?,sotang=?,soto=?,sothuo=?,sophongngu=?,sophongvesinh=?,";
            $sql .=" hopdongthue=?,huong=?,ngaydang=?,ngaycapnhat=?,loai=?,kieuduong=?,phaply=?,nguon=?,kiemduyet=?,binhchonchinhchu=?,binhchonmoigioi=?,trangthainha=?,duongrong=?,";
            $sql .=" hinhso=?,ghichu=? WHERE id=?";
            return $this->SqlExecDebug($sql,
            $tieude,$img,$mota,$diachi,$sdt,$nguoidang,$quanhuyen,$phuongxa,
            $gia,$dientich,$dientichcongnhan,
            $rong,$dai,$sotang,$soto,$sothuo,$sophongngu,$sophongvesinh,
            $hopdongthue,$huong,$ngaydang,$ngaycapnhat,$loai,$kieuduong,
            $phaply,$nguon,$kiemduyet,$binhchonchinhchu,$binhchonmoigioi,
            $trangthainha,$duongrong,$hinhso,$ghichu,$id);
        }
    }

    function showOneTin($id)
    {
        $sql = "SELECT * FROM tin WHERE id=?";
        return $this->result1(1,$sql,$id);
    }
    function countAlltin()
    {
        $sql = "SELECT count(*) AS sodong FROM tin";
        return $this->result1(1,$sql)['sodong'];
    }

    public function Page (int $TotalProduct, int $CurrentPage)
    {
        $LimitPage = 5; // 5 s???n ph???m 2 trang

        $PagedHTML = ''; // kh???i t???o

        $CurrentQuery = $_GET; //query hi???n t???i

        $NextQuery = $_GET; //next query
        $PrevQuery = $_GET; // query tr?????c

        $LastQuery = $_GET; // query tr?????c ????y
        $FirstQuery = $_GET; // query ?????u ti??n

        $IsLastButtonHidden = '';
        $IsNextButtonHidden = '';

        $IsFirstButtonHidden = '';
        $IsPreviousButtonHidden = '';

        $TotalPage = ceil($TotalProduct / PAGE_SIZE); // t???ng s??? page

        if($CurrentPage === 1)
        {
            $IsFirstButtonHidden = 'hidden';
            $IsPreviousButtonHidden = 'hidden';
        }
        // n???u page == 1 th?? kh??ng cho quay v??? trang tr?????c

        if ((int) $CurrentPage === (int) $TotalPage)
        {
            $IsLastButtonHidden = 'hidden';
            $IsNextButtonHidden = 'hidden';
        }
        // n???u t???ng s??? page hi???n t???i == current page th?? kh??ng c?? ti???p t???c

        $NextQuery['Page'] = $CurrentPage + 1;     //t???o ra query ti???p theo
        $LastQuery['Page'] = $TotalPage; // t???o ra query cu???i
   


        $NextButton = '<li class="'.$IsNextButtonHidden.' page-item"><a class="page-link" href="?'.http_build_query($NextQuery).'">></a></li>';
        $LastButton = '<li class="'.$IsLastButtonHidden.' page-item"><a class="page-link" href="?'.http_build_query($LastQuery).'">>|</a></li>';

        $PrevQuery['Page'] = $CurrentPage - 1; //tr??? v??? trang tr?????c
        $FirstQuery['Page'] = 1; // tr??? v??? trang 1

        $PreviousButton = '<li class="'.$IsFirstButtonHidden.' page-item"><a class="page-link" href="?'.http_build_query($PrevQuery).'"><</a></li>';
        $FirstButton = '<li class="'.$IsPreviousButtonHidden.' page-item"><a class="page-link" href="?'.http_build_query($FirstQuery).'">|<</a></li>';
        // tr??? v??? trang tr?????c
        // tr??? v??? trang ????u
        $PagedHTML .= $FirstButton.$PreviousButton;
        //t???o html
        if ($CurrentPage <= $TotalPage && $TotalPage >= 1) // n???u page hi???n t???i nh??? h??n ho???c b???ng t???ng s??? page v?? v?? t???ng s??? page >=1
        {
            $PageBreak = 1; // break page

            if ($CurrentPage > ($LimitPage / 2)) // n???u page hi???n t???i l???n hon 5/2 
            {
                $CurrentQuery['Page'] = 1; // page hi???n t???i b???ng 1 

                $PagedHTML .= '<li class="page-item"><a class="page-link" href="?'.http_build_query($CurrentQuery).'">1</a></li>'; // trang ?????u
                $PagedHTML .= '<li class="page-item"><a class="page-link">...</a></li>'; // ?????n ....
            }

            $Loop = $CurrentPage; // l???p = page hi???n t???i
           
            while ($Loop <= $TotalPage) // curren page => t???ng s??? page
            {
                if ($PageBreak < $LimitPage) // n???u pagebreak ++ n???u pagebreak < 5 (limit page)
                {
                    $CurrentQuery['Page'] = $Loop; // g??n l???i cho current query

                    if ($CurrentPage === $Loop) // n???u currentpage == loop
                    {
                        $PagedHTML .= '<li class="active page-item"><a class="page-link" href="?'.http_build_query($CurrentQuery).'">'.$Loop.'</a></li>';
                    } else $PagedHTML .= '<li class="page-item"><a class="page-link" href="?'.http_build_query($CurrentQuery).'">'.$Loop.'</a></li>';
                }

                $PageBreak++;
                $Loop++;
            }

            if ($CurrentPage < ($TotalPage - ($LimitPage / 2))) 
            {
                $CurrentQuery['Page'] = $TotalPage;

                $PagedHTML .= '<li class="page-item"><a class="page-link"  href="?'.http_build_query($CurrentQuery).'">...</a></li>';
                $PagedHTML .= '<li class="page-item"><a class="page-link" href="?'.http_build_query($CurrentQuery).'">'.$TotalPage.'</a></li>';
            }
        }

        return $PagedHTML.$NextButton.$LastButton;
    }
    function GetProductList($CurrentPage,$Key = ''){
        $sql = "SELECT * FROM tin WHERE id != 0 AND tieude LIKE '%".$Key."%'";
        if ($CurrentPage !== 0)
        {
            $sql .= " GROUP BY id LIMIT ".($CurrentPage - 1) * PAGE_SIZE.", ".PAGE_SIZE;
        }
        return $this->result1(0,$sql);
    }

    function GetAllProduct(){
        $sql = "SELECT * FROM tin WHERE id != 0";
        
        return $this->result1(0,$sql);
    }

    function GetAllProvince(){
        $sql = "SELECT * FROM tbl_quanhuyen WHERE 1";
        
        return $this->result1(0,$sql);
    }

    function GetXaByIdQuanHuyen($id){
        $sql = "SELECT * FROM tbl_xaphuongthitran WHERE maqh = ?";
        return $this->result1(0,$sql,$id);
    }
}