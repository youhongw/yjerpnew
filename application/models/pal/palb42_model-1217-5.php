<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class palb42_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 加班單 轉入月出勤  
	function batchaf()           
        {
			
			$vyy=$this->input->post('dateyy');
			$date=date("Ymd");
		//計算年月>關帳年月
             $query = $this->db->query("SELECT ma022   FROM cmsma  
		  WHERE 1  ");         
		foreach ($query->result() as $row)
            {
            $ma022[]=$row->ma022;		 
            }
			$vma022=$ma022[0];		
			if ($vma022 >= $vyy ) { /*return "轉入日期要大於關帳日期.";*/}
		
		//現金或轉帳 mv034
           $sql18 =" update palyh as b,(select a.mv001,a.mv034  from cmsmv as a  order by a.mv001 ) as c
               set b.yh049=c.mv034 
               where b.yh002=c.mv001 and b.yh001='$vyy' " ; 
			 $this->db->query($sql18);
		//投保金額x4 ml006 yh050
           $sql19 =" update palyh as b,(select a.ml001,a.ml007  from palml as a   ) as c
               set b.yh050=round(c.ml007*4,0)
               where  b.yh002=c.ml001 " ; 
			 $this->db->query($sql19);
		//實發金額  palyh  yh051 
           $sql20 =" update palyh as a set yh051=yh033+yh034  where yh033+yh034 > 0 and yh046='2' and yh001='$vyy' " ; 
			 $this->db->query($sql20);
			 
			 $sql20a =" update palyh as a set yh051=yh036  where yh036 > 0 and yh046='1' and yh001='$vyy' " ; 
			 $this->db->query($sql20a);
			 //實發金額
			 $sql201 =" update palyh as a set yh051=yh035  where yh035 >0 and yh046='2' and yh001='$vyy' " ; 
			 $this->db->query($sql201);
			 //稅率
			 $sql202a =" update palyh as a set yh052=0.05  where yh046='2' and (yh051-yh034) >=73001  and yh001='$vyy' " ; 
			 $this->db->query($sql202a);
			 $sql202b =" update palyh as a set yh052=0.05  where yh046='1' and (yh051) >=73001  and yh001='$vyy' " ; 
			 $this->db->query($sql202b);
			 //稅額
			 $sql203a =" update palyh as a set yh053=round((yh051-yh034)*yh052,0)  where yh046='2' and yh001='$vyy' " ; 
			 $this->db->query($sql203a);
			 $sql203b =" update palyh as a set yh053=round((yh051)*yh052,0)  where yh046='1' and yh001='$vyy' " ; 
			 $this->db->query($sql203b);
			 //健保
			  $sql204 =" update palyh as a set yh054=round((yh051-yh050-yh034)*0.0191,0)  where (yh051-yh050-yh034)>0 and  yh001='$vyy' " ; 
			 $this->db->query($sql204);
			 //未投保
			 $sq204a =" update palyh as b,(select a.mv001,a.mv047  from cmsmv as a where mv047='z' order by a.mv001 ) as c
               set b.yh058=c.mv047 
               where b.yh002=c.mv001 and b.yh001='$vyy' " ; 
			 $this->db->query($sq204a);
			   //歸零
			  $sql2040 =" update palyh as a set yh054=0 where  yh058='z' and  yh001='$vyy' " ; 
			 $this->db->query($sql2040);
			 
			  $sql204b =" update palyh as a set yh054=round((yh051-yh034)*0.0191,0)  where yh046='2' and (yh051-yh034)>21009 and yh058='z' and  yh001='$vyy' " ; 
			 $this->db->query($sql204b);
			 
			  $sql204c =" update palyh as a set yh054=round((yh051)*0.0191,0)  where yh046='1' and (yh051)>21009 and yh058='z' and  yh001='$vyy' " ; 
			 $this->db->query($sql204c);
			 //實領金額 
			  $sql205 =" update palyh as a set yh055=yh051-yh053-yh054   where  yh001='$vyy' " ; 
			 $this->db->query($sql205);
			 $sql206 =" update palyh as a set yh056=yh055  where yh049<>'B' and yh001='$vyy' " ; 
			 $this->db->query($sql206);
			 $sql207 =" update palyh as a set yh057=yh055  where yh049='B' and yh001='$vyy' " ; 
			 $this->db->query($sql207);
	      //核發天數 yh037   
			 $sql208 =" update palyh as a set yh037=round(yh051/yh025,2)  where  yh001='$vyy' " ; 
			 $this->db->query($sql208);
		
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