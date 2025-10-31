<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palb53_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 加班單 轉入月出勤  
	function batchaf()           
        {
			$vyymm1=substr($this->input->post('dateyymm'),0,4).substr($this->input->post('dateyymm'),5,2);
			$vyymm=$this->input->post('dateyymm');
			$seq1=substr($this->input->post('date1o'),0,4).substr($this->input->post('date1o'),5,2).substr($this->input->post('date1o'),8,2);    
	        $seq2=substr($this->input->post('date1c'),0,4).substr($this->input->post('date1c'),5,2).substr($this->input->post('date1c'),8,2);
			$seq3=substr($this->input->post('date2o'),0,4).substr($this->input->post('date2o'),5,2).substr($this->input->post('date2o'),8,2);    
	        $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('date2c'),5,2).substr($this->input->post('date2c'),8,2);
		//計算年月>關帳年月
             $query = $this->db->query("SELECT ma022   FROM cmsma  
		  WHERE 1  ");         
		foreach ($query->result() as $row)
            {
            $ma022[]=$row->ma022;		 
            }
			$vma022=$ma022[0];		
			if ($vma022 >= $vyymm1 ) { return "轉入日期要大於關帳日期.";}
		//刪除月出勤檔 PALTC
		   $this->db->where('tc003', $vyymm1);
		   $this->db->delete('paltc'); 
		//新增月出勤人員 PALTC
		  $sql2 = "INSERT INTO  paltc (tc001,tc002,tc003) select mv001,mv004,$vyymm1 from cmsmv where  mv022='' or substr(mv022,0,6)='$vyymm1' "; 
		  $this->db->query($sql2);
		//加班單更新入月出勤 PALTF
           $sql21 =" update paltc as b,(select a.tf001,sum(a.tf010) as tf010,sum(a.tf011) as tf011,sum(a.tf012) as tf012,sum(a.tf013) as tf013,
		                                 sum(a.tf014) as tf014,sum(a.tf015) as tf015  
               from paltf as a, paltc b 
               where a.tf001=b.tc001 and a.tf002>='$seq1' and a.tf002<='$seq2' and tc003='$vyymm1' and a.tf017 = 'Y' group by a.tf001
                ) c
               set b.tc017=c.tf010, b.tc018=c.tf011, b.tc019=c.tf012, b.tc020=c.tf013, b.tc021=c.tf014, b.tc022=c.tf015 
               where b.tc001=c.tf001  " ; 
			 $this->db->query($sql21);
		//請假單更新入月出勤	 PALTG
		        $sql22 =" update paltc as b,(select a.tg001,sum(a.tg004) as tg004,sum(a.tg005) as tg005,sum(a.tg006) as tg006,sum(a.tg007) as tg007,
		                                 sum(a.tg008) as tg008,sum(a.tg009) as tg009,sum(a.tg010) as tg010,sum(a.tg011) as tg011, 
                                         sum(a.tg012) as tg012,sum(a.tg013) as tg013,sum(a.tg014) as tg014,sum(a.tg015) as tg015,sum(a.tg016) as tg016									 
               from paltg as a, paltc b 
               where a.tg001=b.tc001 and a.tg003>='$seq3' and a.tg003<='$seq4' and tc003='$vyymm1' group by a.tg001
                ) c
               set b.tc004=c.tg004, b.tc005=c.tg005, b.tc006=c.tg006, b.tc007=c.tg007, b.tc008=c.tg008, b.tc009=c.tg009, b.tc010=c.tg010, b.tc011=c.tg011,
			       b.tc012=c.tg012,b.tc013=c.tg013,b.tc014=c.tg014,b.tc015=c.tg015,b.tc016=c.tg016
               where b.tc001=c.tg001  " ; 
			 $this->db->query($sql22);
			
			
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
			
	         return  "轉入完成";  
}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>