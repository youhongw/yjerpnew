<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  

class M_rjsi01 extends CI_Model
{
	function __construct()
    {
        parent::__construct();
		$this->load->database();
    }

	function post_dpt($co,$id,$na) //新增部門資料
	{
		//查詢代號，無重複 --> 插入新資料，返回true  |  有重複 --> 返回false
		$lis = "SELECT COMPANY FROM palma WHERE (COMPANY = '".$co."') AND (MA001 = '".$id."')";
        $query = $this->db->query($lis);
        if ($query->num_rows() >= 1)
        {
			return false;
		}
		else
		{
			$lis2 = "INSERT INTO palma (COMPANY,MA001,MA002) VALUES ('$co','$id','$na')";
            $query2 = $this->db->query($lis2);
			return true;
		}
	}
	
	function get_dpt_count($co,$kw) //取部門總筆數
	{
         $lis = "SELECT COUNT(*) AS CT FROM palma WHERE (COMPANY = '".$co."')";
		 if (!empty($kw)){
		    $lis .= " AND (MA001 LIKE '%".$kw."%' OR MA002 LIKE '%".$kw."%')";
		 }
         $query = $this->db->query($lis);
         $row = $query->row();
		 return $row->CT;
	}
	
	function get_dpt($co,$pa,$ct,$kw) //取該頁部門資料
	{
		 $p1 = ($pa-1)*$ct; //第一筆
		 if ($p1 <= 0) $p1 = 0;
		  
		 $qry = array();
         $lis = "SELECT MA001,MA002 FROM palma WHERE (COMPANY = '".$co."') ";
		 if (!empty($kw)){
		    $lis .= " AND (MA001 LIKE '%".$kw."%' OR MA002 LIKE '%".$kw."%')";
		 }
		 $lis .= " ORDER BY MA001 limit ".$p1.",".$ct;    
         $query = $this->db->query($lis);
         if ($query->num_rows() >= 1)
         {
			 $qry = $query->result_array();
         }
		 
		 return $qry;
	}
	
	function get_dpt2($co,$data) //取該頁部門資料2
	{
		 $qry = array();
		 $this->db->select('MA001,MA002');
         $this->db->from('palma');
         $this->db->where('COMPANY', $co);
		 $this->db->where_in('MA001', $data);
		 $this->db->order_by('MA001');
         $qry = $this->db->get()->result_array();
		 
		 return $qry;
	}
	
	function put_data($co,$id,$oid,$na) //更新資料
	{
		$result = false;
		
		//如果ID重複or空白
		if (empty($id)){
			$result = 3;
		}else if ($id != $oid){
		    $lis = "SELECT MA001 FROM palma WHERE (COMPANY = '".$co."') AND (MA001 = '".$id."') AND (MA002 <> '')";
            $query = $this->db->query($lis);
			
		    if($query->num_rows()>=1){
				$result = 2;
			}else{
				$query2 = "UPDATE palma SET MA001 = '".$id."' WHERE (COMPANY = '".$co."') AND (MA001 = '".$oid."')";
                $result2 = $this->db->query($query2);
			 
			    if ($result2) $result = 1;
			    else $result = 0;
			}	  
		}else{
			$query2 = "UPDATE palma SET MA002 = '".$na."' WHERE (COMPANY = '".$co."') AND (MA001 = '".$oid."')";
            $result2 = $this->db->query($query2);
			 
			if ($result2) $result = 1;
			else $result = 0;
		}
		
		return $result;
	}
	
	function del_data($co,$id) //刪除資料
	{
		$result = false;
		$query = "DELETE FROM palma WHERE (COMPANY = '".$co."') AND (MA001 = '".$id."') LIMIT 1";
		$result = $this->db->query($query);
		return $result;
	}
}

?>