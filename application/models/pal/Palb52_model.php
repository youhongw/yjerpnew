<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palb52_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 刷卡 轉入 加班單  
	function batchaf()           
        {
			$vyymm1=substr($this->input->post('dateyymm'),0,4).substr($this->input->post('dateyymm'),5,2);
			$vyymm=$this->input->post('dateyymm');
			$seq1=substr($this->input->post('dateo1'),0,4).substr($this->input->post('dateo1'),5,2).substr($this->input->post('dateo1'),8,2);    
	        $seq2=substr($this->input->post('datec1'),0,4).substr($this->input->post('datec1'),5,2).substr($this->input->post('datec1'),8,2);
		
		//計算年月>關帳年月
             $query = $this->db->query("SELECT ma022   FROM cmsma  
		  WHERE 1  ");         
		foreach ($query->result() as $row)
            {
            $ma022[]=$row->ma022;		 
            }
			$vma022=$ma022[0];		
			if ($vma022 >= $vyymm1 ) { return "轉入日期要大於關帳日期.";}
		//刪除加班單 日期 PALTF
		   $this->db->where('tf002 >=', $seq1);
		   $this->db->where('tf002 <=', $seq2);
		   $this->db->delete('paltf');  
		   
		//新增加班單 PALTF
		
		/*    $sql2 ="insert into paltf (tf001,tf002,tf004,tf005) 
                  select te001,te002,mo005,max(te003) as te003  from palte as a INNER JOIN cmsmv as b            
                   on  a.te001=b.mv001 
                  LEFT JOIN palmo as c on b.mv027=c.mo001
                  where a.te002>='$seq1' and a.te002<='$seq2' and b.mv044='Y'
                   group by te001,te002 "; 
		 // $sql2 = "INSERT INTO  paltf (tc001,tc002,tc003) select mv001,mv004,$vyymm1 from cmsmv where  mv022='' or substr(mv022,0,6)='$vyymm1' "; 
		  $this->db->query($sql2);  */
		  
		//加班單更新入加班單 PALTF  1120
		
		 $sql21 ="select te001,te002,mo005,max(te003) as te003  from palte as a INNER JOIN cmsmv as b            
                   on  a.te001=b.mv001 
                  LEFT JOIN palmo as c on b.mv027=c.mo001
                  where a.te002>='$seq1' and a.te002<='$seq2' and b.mv044='Y'
                   group by te001,te002 "; 
		$vweek=0;$vhh1=0.0;$vhh2=0.0;$vhh91=0.0;$vhh92=0.0;$vhh93=0.0;$vhh94=0.0;$vhh95=0.0;$vhh96=0.0;
	$result = mysql_query($sql21) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		    //第一筆 星期  20151028   20151120  0-6 vweek=3
			$vte002=substr($te002,0,4).'-'.substr($te002,4,2).'-'.substr($te002,6,2);  
		//	$d="2015-10-28";
            $arrDate=explode("-",$vte002);
            $vweek=date("w",mktime(0,0,0,$arrDate[1],$arrDate[2],$arrDate[0]));
            $te003=$te003.'00';
			$te0031=substr($te003,0,2);
			$te0032=substr($te003,2,2);
			if ($te0032>='0' && $te0032<='29') {$te0033='00';}
			if ($te0032>='30' && $te0032<='59') {$te0033='30';}
			//刷卡以半小時計算
			$te003=$te0031.$te0033.'00';
			$mo005=$mo005.'00';
			 $vhh=(strtotime($te003) - strtotime($mo005))/(60*60);
			 if ($vhh>=2) {$vhh1=2;$vhh2=$vhh-2;} else {$vhh1=$vhh;$vhh2=0;}
			 
			 if ($vweek>='1' &&  $vweek<='5' ) {$vhh91=doubleval($vhh1);$vhh92=doubleval($vhh2);} 
			 if ($vweek>='6'  ) {$vhh93=doubleval($vhh1);$vhh94=doubleval($vhh2);} 
			 if ($vweek=='0'  ) {$vhh95=doubleval($vhh1);$vhh96=doubleval($vhh2);} 
		                      //科目代號
			
				//加班單   paltf  
		$data21 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'tf001' => $te001, 
		         'tf002' => $te002,
		         'tf003' => $vweek,
		         'tf004' => $mo005,
				 'tf005' => $te003,
				 
			     'tf006' => $vhh,
				 'tf007' => '',
				 'tf008' => '',
				 'tf009' => 0,
				 'tf010' => $vhh91,
				 'tf011' => $vhh92,
				 'tf012' =>  $vhh93,
				 'tf013' =>  $vhh94,
				 'tf014' =>  $vhh95,
				 'tf015' =>  $vhh96,
				 'tf016' => '刷卡自動轉入'
				     
                );	
			   $this->db->insert('paltf', $data21);			   
			   
		  //合計不同單號
		   //  $vdail++;           //預設 0  	
		//	$mvtb005=$te001;
		 //   $n++; 
		
       }
	    //   $vweek=date("w",'20151120');
	       return $vhh;
	    //    return  "轉入完成";  

    }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>