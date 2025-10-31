<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palb40_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 加班單 轉入月出勤  
	function batchaf()           
        {
			
			$vyy=$this->input->post('dateyy');
			
		//計算年月>關帳年月
             $query = $this->db->query("SELECT ma022   FROM cmsma  
		  WHERE 1  ");         
		foreach ($query->result() as $row)
            {
            $ma022[]=$row->ma022;		 
            }
			$vma022=$ma022[0];		
			if ($vma022 >= $vyy ) { /*return "轉入日期要大於關帳日期.";*/}
		//刪除出勤彚總檔 PALYE
		   $this->db->where('ye001', $vyy);
		   $this->db->delete('palye'); 
		//新增月出勤彚總 PALTE  select mv001,mv004,$vyymm1 from cmsmv where  mv022='' or substr(mv022,0,6)='$vyymm1' "; 
		  $sql2 = "INSERT INTO  palye (ye001,ye002,ye004,ye005,ye006) 
		  SELECT SUBSTR(tc003,1,4) as tc003,tc001,floor(sum(tc004)/5) as tc004,round(sum(tc007)/8,2) as tc007,round(sum(tc006)/8,2) as tc006 
          FROM paltc
          WHERE  SUBSTR(tc003,1,4)='$vyy'
          group by SUBSTR(tc003,1,4),tc001 ";
		  $this->db->query($sql2);
		//  var_dump($vyy);exit;
		 //計算年資
	/*	 $sql="select mv001,mv004,mv021  from `cmsmv` as a where mv022=''  ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
				$vmv021=parseInt($vyy)-parseInt(substr($mv021,0,4)) ;
				if (substr($mv021,0,4)==$vyy) {$vmv021=round(parseInt(substr($mv021,4,2))/5,2);}
		$data1 = array(
		         'ye003' => $mv004,
				 'ye009' => $vmv021
				     
                );	
		 	   $this->db->where('ye002', $mv001);
			   $this->db->update('palye', $data1);	
	}  */
	    //年資 cmsmv
		   //     $sql14="update palye set ye009=888 ";
			//	$this->db->query($sql14);
        //   $sql15 =" update palye as b,(select a.mv001,a.mv004,substr(a.mv021,1,4) as mv021  from cmsmv as a  group by a.mv001 ) as c   set b.ye009=999  where b.ye002=c.mv001 " ;
         //   $this->db->query($sql15);
		//部門代號 cmsmv
           $sql18 =" update palye as b,(select a.mv001,a.mv004  from cmsmv as a  group by a.mv001 ) as c
               set b.ye003=c.mv004 
               where b.ye002=c.mv001 " ; 
			 $this->db->query($sql18);
		//日薪  PALMD  MD003
           $sql21 =" update palye as b,(select a.md001,a.md003  from palmd as a  group by a.md001 ) as c
               set b.ye010=c.md003 
               where b.ye002=c.md001 " ; 
			 $this->db->query($sql21);
	    //年全勤  
             $sql22 =" update palye set ye008=5  where ye004+ye005+ye006=0 " ; 
			 $this->db->query($sql22);
		//計算年資
		 $vmv020=0.00;
		 $vmv021=0.00;
		 $vmv022=0.00;
		 $sql="select mv001,mv004,mv021  from `cmsmv`   ";
		// echo "<pre>";var_dump($vmv021);exit;
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
				$vmv021= (float) $vyy - (float)substr($mv021,0,4) ;
				$vmv022=round( (float)(substr($mv021,4,2))/12,2);
			//	echo "<pre>";var_dump($vmv021);var_dump($vmv022);exit;
				$vmv020=$vmv021+$vmv022;
			//	echo "<pre>";var_dump($vmv020);exit;
		$data1 = array(		        
				 'ye009' => $vmv020
                );	
		 	   $this->db->where('ye002', $mv001);
			   $this->db->update('palye', $data1);	
		//	   echo "<pre>";var_dump($vmv021);exit;
	}  
		  //科目代號  actmb		刪除下月
     /*      $this->db->where('lc002', $vyymm);
		   $this->db->delete('invlc'); 

		$sql="select a.* from `invlc` as a where lc002='$vyymm'  ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		 
				//月底金額檔  invlc
				$vlc004=$lc006-$lc008-$lc010+$lc012+$lc014+$lc018+$lc020-$lc022-$lc024;
				$vlc005=$lc007-$lc009-$lc011+$lc013+$lc015+$lc019+$lc021-$lc023-$lc025;
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'lc001' => $lc001, 
		         'lc002' => $vyy.$mmm,
		         'lc003' => $lc003,
		         'lc004' => $vlc004,
				 'lc005' => $vlc005
				     
                );	
		 
                 //上      本		   
		  
			   $this->db->insert('invlc', $data1);	
	
	}  */
			
	         return  "計算完成";  
}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>