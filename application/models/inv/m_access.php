<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  

class M_access extends CI_Model
{
	function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	function getaccess($co,$id) //查詢權限
	{ 
	   //超級使用者-->權限全開
	   $super = $this->session->supervisor;
	   
	   if ($super == 1){
		 $lis = "SELECT PROGID FROM progt00";
         $query = $this->db->query($lis);
         if ($query->num_rows() >= 1) {
			 foreach ($query->result() as $row) {
				 $pid = $row->PROGID; //程式ID
				 $qry[$pid] = 'Y';
			 }
		 }
	   }else{
	     //使用者權限
		 $qry = array();
         $lis = "SELECT PROGID, QUR FROM usprt00 WHERE (COMPANY = '".$co."') AND (USERID = '".$id."')";
         $query = $this->db->query($lis);
         if ($query->num_rows() >= 1)
         {
			 foreach ($query->result() as $row)
			 {
				 $pid = $row->PROGID; //程式ID
				 $a1 = $row->QUR; //1-->進入

				 $qry[$pid] = $a1; //只存Y-->使用者與群組只要有一個Y
			 }
         }
		 
		 //查詢使用者的所有群組
		 $lis = "SELECT GROUPID FROM usgrt00 WHERE (COMPANY = '".$co."') AND (USERID = '".$id."')";
         $query = $this->db->query($lis);
         if ($query->num_rows() >= 1)
         {
			 foreach ($query->result() as $row)
			 {
				 $gid = $row->GROUPID; //群組ID
				 
				 //查詢群組權限 > 使用者權限
				 $lis2 = "SELECT PROGID, QUR FROM grprt00 WHERE (COMPANY = '".$co."') AND (GROUPID = '".$gid."')";
         		 $query2 = $this->db->query($lis2);
         		 if ($query2->num_rows() >= 1)
        		 {
					  foreach ($query2->result() as $row2)
					  {
						  $pid = $row2->PROGID; //程式ID
				 		  $a1 = $row2->QUR; //1-->進入
				 
				 		  if ($a1 == 'Y') $qry[$pid] = $a1; //只存Y
					  }
				 }
			 }
		 }
	   }
	 
	   $data = $this->session->set_userdata($qry);
		 
	   return true;
	}
	
	function getsub($prg,$co,$id) //查詢程式功能權限
	{
	   //超級使用者-->權限全開
	   $super = $this->session->supervisor;
	   
	   $qry = array();
	   if ($super == 1){
		 $qry['INS'] = 'Y'; //預設植
		 $qry['UPD'] = 'Y';
		 $qry['DEL'] = 'Y';
		 $qry['PRN'] = 'Y';  
	   }else{
	     //使用者權限
		 $qry['INS'] = 'N'; //預設植
		 $qry['UPD'] = 'N';
		 $qry['DEL'] = 'N';
		 $qry['PRN'] = 'N';
			 
         $lis = "SELECT INS, UPD, DEL, PRN  FROM usprt00 WHERE (COMPANY = '".$co."') AND (USERID = '".$id."') AND (PROGID = '".$prg."')";
         $query = $this->db->query($lis);
         if ($query->num_rows() >= 1)
         {
			 $row = $query->row();
			 $qry['INS'] = $row->INS; //2-->新增
			 $qry['UPD'] = $row->UPD; //3-->更新
			 $qry['DEL'] = $row->DEL; //4-->刪除
			 $qry['PRN'] = $row->PRN; //5-->列印
         }
		 
		 $lis = "SELECT GROUPID FROM usgrt00 WHERE (COMPANY = '".$co."') AND (USERID = '".$id."')";
         $query = $this->db->query($lis);
         if ($query->num_rows() >= 1)
         {
			 foreach ($query->result() as $row)
			 {
				 $gid = $row->GROUPID; //群組ID
				 
				 //查詢群組權限 > 使用者權限
				 $lis2 = "SELECT INS, UPD, DEL, PRN FROM grprt00 WHERE (COMPANY = '".$co."') AND (GROUPID = '".$gid."') AND (PROGID = '".$prg."')";
         		 $query2 = $this->db->query($lis2);
         		 if ($query2->num_rows() >= 1)
                 {
				     $row2 = $query2->row();
				     if ($row2->INS == 'Y') $qry['INS'] = $row2->INS; //2-->新增
			 	     if ($row2->UPD == 'Y') $qry['UPD'] = $row2->UPD; //3-->更新
			 	     if ($row2->DEL == 'Y') $qry['DEL'] = $row2->DEL; //4-->刪除
			 	     if ($row2->PRN == 'Y') $qry['PRN'] = $row2->PRN; //5-->列印
				 }
			 }
		 }
	   }
		 
	   return $qry;
	}
	 
}

?>