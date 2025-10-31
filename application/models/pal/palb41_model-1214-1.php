<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class palb41_model extends CI_Model {
	
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
		//刪除年終試看檔 PALYH
		   $this->db->where('yh001', $vyy);
		   $this->db->delete('palyh'); 
		//新增年終試算 PALTE  select mv001,mv004,$vyymm1 from cmsmv where  mv022='' or substr(mv022,0,6)='$vyymm1' "; 
		  $sql2 = "INSERT INTO  palyh (create_date,yh001,yh002,yh003,yh008,yh015,yh016,yh017,yh018,yh019,yh025,yh041,yh042,yh010,yh011,yh012,yh013,yh014) 
		  SELECT $date,ye001,ye002,ye003,ye009,ye004,ye005,ye006,ye007,ye008,ye010,ye012,ye011,90,75,60,45,30 
          FROM palye
          WHERE  ye001='$vyy'  ";
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
		//職稱代號,年終發放方式, 年終類別,年終公司別yh004,46,47,45 cmsmv  mv212,mv213,mv214,202
           $sql18 =" update palyh as b,(select a.mv001,a.mv212,a.mv213,a.mv214,a.mv202  from cmsmv as a  order by a.mv001 ) as c
               set b.yh004=c.mv212,b.yh046=c.mv213,b.yh047=c.mv214,b.yh045=c.mv202 
               where b.yh002=c.mv001 and b.yh001='$vyy' " ; 
			 $this->db->query($sql18);
		//員工姓名,部門名稱, 職稱名稱  yh005,6,7 cmsmv  mv002,mv004disp,mv212disp
           $sql19 =" update palyh as b,(select a.mv001,a.mv002,a.mv004,a.mv212,d.me002 as mv004disp,e.ya002 as mv212disp  from cmsmv as a left join cmsme as d on a.mv004=d.me001 
                                        left join palya as e on a.mv212=e.ya001		   ) as c
               set b.yh005=c.mv002,b.yh006=mv004disp,b.yh007=mv212disp 
               where b.yh002=c.mv001 and b.yh001='$vyy' " ; 
			 $this->db->query($sql19);
		//換算基數  palyh  yh009 
           $sql20 =" update palyh as a set yh009=1  where a.yh008>=1 and yh001='$vyy' " ; 
			 $this->db->query($sql20);
			 $sql201 =" update palyh as a set yh009=yh008  where a.yh008<1 and yh001='$vyy' " ; 
			 $this->db->query($sql201);
	    //可發天數 palyh  yh010-14  -15-19  
           $sql21 =" update palyh as a set yh020=yh010+yh019+yh018-yh017-0-floor(yh015/5),yh021=yh011+yh019+yh018-yh017-0-floor(yh015/5),
                		  yh022=yh012+yh019+yh018-yh017-0-floor(yh015/5),yh023=yh013+yh019+yh018-yh017-0-floor(yh015/5),yh024=yh014+yh019+yh018-yh017-0-floor(yh015/5)
						  where  yh001='$vyy' " ; 
			 $this->db->query($sql21);
	    //可發金額 palyh  yh026-30  
           $sql22 =" update palyh as a set yh026=round(yh025*yh020,0),yh027=round(yh025*yh021,0),
                		  yh028=round(yh025*yh022,0),yh029=round(yh025*yh023,0),yh030=round(yh025*yh024,0)
						  where  yh001='$vyy' " ; 
			 $this->db->query($sql22);
		//實發金額 palyh  yh031-35  
           $sql23 =" update palyh as a set yh031=yh026,yh032=yh027,yh033=yh028,yh034=yh029,yh035=yh030
						  where  yh001='$vyy' and yh046='1' " ; 
			 $this->db->query($sql23);
		//效率獎金  palyh  31-35
           $sql24 =" update palyh as b,(select a.yg001,a.yg002,a.yg004,a.yg005,a.yg006,a.yg007,a.yg008 from palyg as a  order by a.yg001,a.yg002 ) as c
               set b.yh031=c.yg004,b.yh032=c.yg005,b.yh033=c.yg006,b.yh034=c.yg007,b.yh035=c.yg008 
               where b.yh001=c.yg001 and b.yh002=c.yg002 and yh046='2' " ; 
			 $this->db->query($sql24);
	    //期初獎金  palyh  43
           $sql25 =" update palyh as b,(select a.yd001,a.yd002,a.yd004 from palyd as a  order by a.yd001,a.yd002 ) as c
               set b.yh043=c.yd004 
               where b.yh001=c.yd001 and b.yh002=c.yd002 " ; 
			 $this->db->query($sql25);
	     //列印名稱  palyh  48
           $sql26 =" update palyh as b,(select yb001,yb002 from palyb  ) as c
               set b.yh048=c.yb002 
               where b.yh001='$vyy' and b.yh047=c.yb001 " ; 
			 $this->db->query($sql26);
		
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