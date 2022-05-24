<?php

class Model_Users extends Model_db{
    function listRecords() 
    {
        $sql = "SELECT * FROM tin";
        return $this->result1(0,$sql);
    }
    
    function addNewUser($HoTen, $Username,$Password, $Email,$VaiTro,$AnHien)
    {
        $sql = "INSERT INTO users(HoTen,Username,Password,Email,VaiTro,AnHien) VALUE(?,?,?,?,?,?)";
        return $this->getLastId($sql,$HoTen, $Username,$Password, $Email,$VaiTro,$AnHien);
    }

    function deleteUser($id)
    {   
        $sql = "DELETE FROM users WHERE idUser = ?";
        return $this->exec1($sql,$id);
    }

    function editUser($HoTen, $Username,$Password, $Email,$VaiTro,$AnHien,$id){
        $sql = "UPDATE users SET HoTen= ?,Username=?,Password=?,Email=?,VaiTro=?,AnHien=? WHERE idUser=?";
        return $this->SqlExecDebug($sql,$HoTen, $Username,$Password, $Email,$VaiTro,$AnHien,$id);
    }

    function showOneUser($id)
    {
        $sql = "SELECT * FROM users WHERE idUser=?";
        return $this->result1(1,$sql,$id);
    }
    function countAlltin()
    {
        $sql = "SELECT count(*) AS sodong FROM tin";
        return $this->result1(1,$sql)['sodong'];
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
    function GetProductList($CurrentPage,$Key = ''){
        $sql = "SELECT * FROM tin WHERE id != 0 AND tieude LIKE '%".$Key."%'";
        if ($CurrentPage !== 0)
        {
            $sql .= " GROUP BY id LIMIT ".($CurrentPage - 1) * PAGE_SIZE.", ".PAGE_SIZE;
        }
        return $this->result1(0,$sql);
    }

    function GetAllUser(){
        $sql = "SELECT * FROM users WHERE 1";
        return $this->result1(0,$sql);
    }

    function checkEmailIsExits($email){
        $sql = "SELECT count(*) as countemail FROM users WHERE email = ?";
        return $this->result1(1,$sql,$email)['countemail'];
    }
    function checkNameIsExits($username){
        $sql = "SELECT count(*) as countname FROM users WHERE Username = ?";
        return $this->result1(1,$sql,$username)['countname'];
    }
}