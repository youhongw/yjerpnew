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
		//==========================1051217  41
		//職稱代號,年終發放方式, 年終類別,年終公司別yh004,46,47,45 cmsmv  mv212,mv213,mv214,202
           $sql18g =" update palyh as b,(select a.mv001,a.mv212,a.mv213,a.mv214,a.mv202  from cmsmv as a  order by a.mv001 ) as c
               set b.yh004=c.mv212,b.yh046=c.mv213,b.yh047=c.mv214,b.yh045=c.mv202 
               where b.yh002=c.mv001 and b.yh001='$vyy' " ; 
			 $this->db->query($sql18g);
		//員工姓名,部門名稱, 職稱名稱  yh005,6,7 cmsmv  mv002,mv004disp,mv212disp
           $sql19g =" update palyh as b,(select a.mv001,a.mv002,a.mv004,a.mv212,d.me002 as mv004disp,e.ya002 as mv212disp  from cmsmv as a left join cmsme as d on a.mv004=d.me001 
                                        left join palya as e on a.mv212=e.ya001		   ) as c
               set b.yh005=c.mv002,b.yh006=mv004disp,b.yh007=mv212disp 
               where b.yh002=c.mv001 and b.yh001='$vyy' " ; 
			 $this->db->query($sql19g);
		//換算基數  palyh  yh009 
           $sql20g=" update palyh as a set yh009=1  where a.yh008>=1 and yh001='$vyy' " ; 
			 $this->db->query($sql20g);
			 $sql201h =" update palyh as a set yh009=yh008  where a.yh008<1 and yh001='$vyy' " ; 
			 $this->db->query($sql201h);
	    //可發天數 palyh  yh010-14  -15-19  
           $sql21g =" update palyh as a set yh020=yh010+yh019+yh018-yh017-0-floor(yh015/5),yh021=yh011+yh019+yh018-yh017-0-floor(yh015/5),
                		  yh022=yh012+yh019+yh018-yh017-0-floor(yh015/5),yh023=yh013+yh019+yh018-yh017-0-floor(yh015/5),yh024=yh014+yh019+yh018-yh017-0-floor(yh015/5)
						  where  yh001='$vyy' " ; 
			 $this->db->query($sql21g);
	    //可發金額 palyh  yh026-30  
           $sql22g =" update palyh as a set yh026=round(yh025*yh020,0),yh027=round(yh025*yh021,0),
                		  yh028=round(yh025*yh022,0),yh029=round(yh025*yh023,0),yh030=round(yh025*yh024,0)
						  where  yh001='$vyy' " ; 
			 $this->db->query($sql22g);
		//實發金額 palyh  yh031-35  
           $sql23g =" update palyh as a set yh031=yh026,yh032=yh027,yh033=yh028,yh034=yh029,yh035=yh030
						  where  yh001='$vyy' and yh046='1' " ; 
			 $this->db->query($sql23g);
		//效率獎金  palyh  31-35
           $sql24g =" update palyh as b,(select a.yg001,a.yg002,a.yg004,a.yg005,a.yg006,a.yg007,a.yg008 from palyg as a  order by a.yg001,a.yg002 ) as c
               set b.yh031=c.yg004,b.yh032=c.yg005,b.yh033=c.yg006,b.yh034=c.yg007,b.yh035=c.yg008 
               where b.yh001=c.yg001 and b.yh002=c.yg002 and yh046='2' " ; 
			 $this->db->query($sql24g);
		//效率獎金扣考勤功過 vyh32 	 
			  $sql241g =" update palyh set yh032=round((yh019+yh018-yh017-0-floor(yh015/5))*yh025,0)              
               where yh001='$vyy' and yh046='2' " ; 
			 $this->db->query($sql241g);
			 
			 $sql242g =" update palyh set yh033=yh031+yh032              
               where yh001='$vyy' and yh046='2' " ; 
			 $this->db->query($sql242g);
			  $sql243g =" update palyh set yh035=yh033+yh034              
               where yh001='$vyy' and yh046='2' " ; 
			 $this->db->query($sql243g);
	    //期初獎金  palyh  43
           $sql25h =" update palyh as b,(select a.yd001,a.yd002,a.yd004 from palyd as a  order by a.yd001,a.yd002 ) as c
               set b.yh043=c.yd004 
               where b.yh001=c.yd001 and b.yh002=c.yd002 " ; 
			 $this->db->query($sql25h);
		 //本年度考績  palyh  41,42
           $sql251h =" update palyh as b,(select a.yf001,a.yf004,a.yf005 from palyf as a  order by a.yf001,a.yf002 ) as c
               set b.yh041=c.yf004, b.yh042=c.yf005
               where b.yh001=c.yf001 and b.yh002=c.yf002 " ; 
			 $this->db->query($sql251h);
	     //列印名稱  palyh  48
           $sql26h =" update palyh as b,(select yb001,yb002 from palyb  ) as c
               set b.yh048=c.yb002 
               where b.yh001='$vyy' and b.yh047=c.yb001 " ; 
			 $this->db->query($sql26h);
		
		  //科目代號  actmb		刪除下月
		//=========================1051217
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
			 $sql204k =" update palyh as a set yh054=0  where   yh001='$vyy' " ; 
			 $this->db->query($sql204k);
			 
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