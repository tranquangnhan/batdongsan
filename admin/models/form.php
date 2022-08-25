<?php

class Model_laySo extends Model_db{
    function listRecords() 
    {
        $date = date("Y/m/d");
        $sql = "SELECT * FROM form WHERE date = ?";
        return $this->result1(0,$sql,$date);
    }
    
    function setStatus($id){
       $sql =  "UPDATE form SET status=!status WHERE id=?";
       return $this->exec1($sql,$id);
    }

    function addNewform($name,$slug,$img,$date,$noidung,$luotxem,$mota,$public)
    {
        $sql = "INSERT INTO form(name,slug,img,date,noidung,luotxem,mota,public) VALUE(?,?,?,?,?,?,?,?)";
        return $this->getLastId($sql,$name,$slug,$img,$date,$noidung,$luotxem,$mota,$public);
    }

  

    function editform($name,$slug,$img,$date,$noidung,$luotxem,$mota,$public,$id){
        if($img == "")
        {
            $sql = "UPDATE form SET name= ?,slug=?,date=?,noidung=?,luotxem=?,mota=?,public=? WHERE id=?";
            return $this->exec1($sql,$name,$slug,$date,$noidung,$luotxem,$mota,$public,$id);
        }else
        {
            $sql = "UPDATE form SET name= ?,slug=?,img=?,date=?,noidung=?,luotxem=?,mota=?,public=? WHERE id=?";
            return $this->exec1($sql,$name,$slug,$img,$date,$noidung,$luotxem,$mota,$public,$id);
        }
    }

    function showOneform($id)
    {
        $sql = "SELECT * FROM form WHERE id=?";
        return $this->result1(1,$sql,$id);
    }
    function countAllform()
    {
        $date = date("Y/m/d");
        $sql = "SELECT count(*) AS sodong FROM form WHERE date = ?";
        return $this->result1(1,$sql,$date)['sodong'];
    }

    public function Page (int $TotalProduct, int $CurrentPage)
    {
        $LimitPage = 5; // 5 sản phẩm 2 trang

        $PagedHTML = ''; // khởi tạo

        $CurrentQuery = $_GET; //query hiện tại

        $NextQuery = $_GET; //next query
        $PrevQuery = $_GET; // query trước

        $LastQuery = $_GET; // query trước đây
        $FirstQuery = $_GET; // query đầu tiên

        $IsLastButtonHidden = '';
        $IsNextButtonHidden = '';

        $IsFirstButtonHidden = '';
        $IsPreviousButtonHidden = '';

        $TotalPage = ceil($TotalProduct / PAGE_SIZE); // tổng số page

        if($CurrentPage === 1)
        {
            $IsFirstButtonHidden = 'hidden';
            $IsPreviousButtonHidden = 'hidden';
        }
        // nếu page == 1 thì không cho quay về trang trước

        if ((int) $CurrentPage === (int) $TotalPage)
        {
            $IsLastButtonHidden = 'hidden';
            $IsNextButtonHidden = 'hidden';
        }
        // nếu tổng số page hiện tại == current page thì không có tiếp tục

        $NextQuery['Page'] = $CurrentPage + 1;     //tạo ra query tiếp theo
        $LastQuery['Page'] = $TotalPage; // tạo ra query cuối
   


        $NextButton = '<li class="'.$IsNextButtonHidden.' page-item"><a class="page-link" href="?'.http_build_query($NextQuery).'">></a></li>';
        $LastButton = '<li class="'.$IsLastButtonHidden.' page-item"><a class="page-link" href="?'.http_build_query($LastQuery).'">>|</a></li>';

        $PrevQuery['Page'] = $CurrentPage - 1; //trở về trang trước
        $FirstQuery['Page'] = 1; // trở về trang 1

        $PreviousButton = '<li class="'.$IsFirstButtonHidden.' page-item"><a class="page-link" href="?'.http_build_query($PrevQuery).'"><</a></li>';
        $FirstButton = '<li class="'.$IsPreviousButtonHidden.' page-item"><a class="page-link" href="?'.http_build_query($FirstQuery).'">|<</a></li>';
        // trở về trang trước
        // trở về trang đâu
        $PagedHTML .= $FirstButton.$PreviousButton;
        //tạo html
        if ($CurrentPage <= $TotalPage && $TotalPage >= 1) // nếu page hiện tại nhỏ hơn hoặc bằng tổng số page và và tổng số page >=1
        {
            $PageBreak = 1; // break page

            if ($CurrentPage > ($LimitPage / 2)) // nếu page hiện tại lớn hon 5/2 
            {
                $CurrentQuery['Page'] = 1; // page hiện tại bằng 1 

                $PagedHTML .= '<li class="page-item"><a class="page-link" href="?'.http_build_query($CurrentQuery).'">1</a></li>'; // trang đầu
                $PagedHTML .= '<li class="page-item"><a class="page-link">...</a></li>'; // đến ....
            }

            $Loop = $CurrentPage; // lặp = page hiện tại
           
            while ($Loop <= $TotalPage) // curren page => tổng số page
            {
                if ($PageBreak < $LimitPage) // nếu pagebreak ++ nếu pagebreak < 5 (limit page)
                {
                    $CurrentQuery['Page'] = $Loop; // gán lại cho current query

                    if ($CurrentPage === $Loop) // nếu currentpage == loop
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
    function GetProductList($CurrentPage){
        $date = date("Y/m/d");
        $sql = "SELECT * FROM form WHERE id != 0 and date = ?";
        if ($CurrentPage !== 0)
        {
            $sql .= " GROUP BY id LIMIT ".($CurrentPage - 1) * PAGE_SIZE.", ".PAGE_SIZE;
        }
        return $this->result1(0,$sql,$date);
    }

    function deleteForm($id){
        $sql = "DELETE FROM form WHERE id = ? AND status = 0";
        return $this->exec1($sql,$id);
    }

    function soLuong($buoi){
        $date = date("Y/m/d");
        $sql = "SELECT count(*) as sl  FROM form WHERE time = ? AND date = ?";
        return $this->result1(1,$sql,$buoi, $date)['sl'];
    }

    function resetTime($thoiGian){
        $SQL = "UPDATE setting SET timeleft = ?";
        return $this->exec1($SQL,$thoiGian);
    }
    function getThoiGian(){
        $SQL = "SELECT thoigian FROM setting";
        return $this->result1(1,$SQL)['thoigian'];
    }

    function setThoiGian($thoiGian){
        $SQL = "UPDATE setting SET timeleft = ?";
        return $this->exec1($SQL,$thoiGian);
    }

    
    function setSl($sl,$buoi){
        $SQL = "UPDATE setting SET ".$buoi." = ?";
        return $this->exec1($SQL,$sl);
    }
}