<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class palb03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 加班單 轉入月出勤  
	function batchaf($seq1)
        {
		  /*	$spc_day = array(
			'0' => 3, '0.5' => 3, '1' => 7, '2' => 10, '3' => 14, '4' => 14, '5' => 15
			, '6' => 15, '7' => 15, '8' => 15, '9' => 15);
			$year = substr($seq1,0,4);
			$month = substr($seq1,4,2);
			$query = $this->db->select('mv001, mv021')
			   ->from('cmsmv')
			   ->where('mv022',"");
			$ret = $query->get()->result();
			$data = array();
			foreach($ret as $val){
				$data[$val->mv001] = $val->mv021;
			}unset($ret);
			$upd_data = array();
			foreach($data as $key => $val){
				$t_year = substr($val,0,4);$t_month = substr($val,4,2);$t_day = substr($val,6,2);
				if($t_year <= 2005 && $key!="70001" && $key!="73001" && $key!="67001" && $key!="77001" && $key!="82008" && $key!="93033" && $key!="99902"){$t_year=2005;$t_month="07";$t_day="01";}
				$total_year = ($year - $t_year)+(($month-$t_month)/12);
				$total_year += (30-$t_day+1)/30/12;
				$total_year = round($total_year,2);
				if($total_year < 0){//年資計算完成
					$upd_data[$key]['mv031'] = 0;
				}else{
					$upd_data[$key]['mv031'] = $total_year;
				}
				//新特休算法，切割兩個區段
				$total_year = $year-$t_year;
				if($total_year<=5){
					$upd_data[$key]['mv215'] = $spc_day[$total_year];
					$upd_data[$key]['mv216'] = $spc_day[$total_year+1];
				}else{
					if($total_year>=10){$upd_data[$key]['mv215'] = $spc_day[5]+$total_year-9;}
					else{$upd_data[$key]['mv215'] = $spc_day[5];}
					if($total_year+1>=10){$upd_data[$key]['mv216'] = $spc_day[5]+$total_year+1-9;}
					else{$upd_data[$key]['mv216'] = $spc_day[5];}
				}
				if($upd_data[$key]['mv215']>30){
					$upd_data[$key]['mv215'] = 30;
				}
				if($upd_data[$key]['mv216']>30){
					$upd_data[$key]['mv216'] = 30;
				}
				
				if($year == 2016 && $upd_data[$key]['mv215']!=3){//當年特殊算法，過完2016年就沒有用到，可刪
					$upd_data[$key]['mv215'] = round($upd_data[$key]['mv215']*(($t_month-1)/12+(($t_day-1)/30/12)),1);
					$temp_int = round($upd_data[$key]['mv215']);
					if($temp_int-$upd_data[$key]['mv215'] != 0.5){//如果不是0.5就取到整數
						$upd_data[$key]['mv215'] = $temp_int;
					}
				}
			}
			session_start();
			$_SESSION['palb03']['total_num'] = count($upd_data);
			$_SESSION['palb03']['current_num'] = 0;
			foreach($upd_data as $key => $val){
				$data = array(
					'mv031' => $val['mv031'],
					'mv215' => $val['mv215'],
					'mv216' => $val['mv216'],
					'mv217' => $year
				);
				$data['modifier'] = $this->session->userdata('manager');
				$this->db->where('mv001', $key);
				$this->db->update('cmsmv', $data);
				$_SESSION['palb03']['current_num']++;
			}   */
			
			$query = $this->db->select('mv001, mv021, mv215, mv216 ,mv217')
			   ->from('cmsmv')
			   ->where('mv022',"");
			$ret = $query->get()->result();
			
			foreach($ret as $row){
				//處理特休日期
				$month = $seq1;
				$mv215 =  $row->mv215;
				$mv216 =  $row->mv216;
				$mv217 =  $row->mv217;
				$mv001 = $row->mv001;
	          if(substr($row->mv021,0,4) <= 2005 && $mv001!="70001" && $mv001!="73001" && $mv001!="67001" && $mv001!="77001" && $mv001!="82008"  ){$row->mv021="20050701";}
	       
			   $str_day1 = $mv217.substr($row->mv021,4,2).substr($row->mv021,6,2);
	           if($mv215<=3){$str_day1 = date('Ymd', strtotime ("+6 month", strtotime($str_day1)));}
	            if($mv217==2016){
		         if((substr($row->mv021,0,4)<=2016 && substr($row->mv021,4,2)<7) || substr($str_day1,0,4) < 2017 )
			        $str_day1 = "20170101";
	            }
				$str_day2 = ($mv217+1).substr($row->mv021,4,2).substr($row->mv021,6,2);
	            $end_day1 = date('Ymd', strtotime ("-1 day", strtotime($str_day2)));
	            $end_day2 = date('Ymd', strtotime ("-1 day", strtotime(($mv217+2).substr($row->mv021,4,2).substr($row->mv021,6,2))));
			     
				 
				 $end_day11 = date('Ymd', strtotime ("1 month", strtotime($end_day1)));
				 $end_day21 = date('Ymd', strtotime ("1 month", strtotime($end_day2)));
				 //特休用
				   $str_day1a=substr($str_day1,0,6);
				   $end_day11a=substr($end_day11,0,6);
				   $str_day2a=substr($str_day2,0,6);
				   $end_day21a=substr($end_day21,0,6);
				   
				   $end_day1b=substr($end_day1,0,6);  //原日期
				   
     			$data = array(
					'mv301' => $str_day1,
					'mv302' => $end_day1,
					'mv303' => $month,
					'mv304' => $end_day11,
					'mv305' => $mv215,
					'mv307' => $str_day2,
					'mv308' => $end_day2,
					'mv309' => $end_day21,
					'mv310' => $mv216
				);
				$key=$row->mv001;
				$this->db->where('mv001', $key);
				$this->db->update('cmsmv', $data);
				//原日期請特休1 mv3061
				 $sql29 =" update cmsmv as b,(select a.tc001,round(sum(a.tc008)/8,2) as tc008
               from  paltc a 
               where a.tc001=$mv001  and a.tc003>='$str_day1a' and a.tc003<='$end_day1b'  group by a.tc001
                ) c
               set b.mv3061=c.tc008 
               where b.mv001=c.tc001 and b.mv001='$mv001'  ";
			   $this->db->query($sql29);
			   //原到期日期-延期日期請特休1 mv3062 差額天
				 $sql29 =" update cmsmv as b,(select a.tc001,round(sum(a.tc008)/8,2) as tc008
               from  paltc a 
               where a.tc001=$mv001  and a.tc003>='$end_day1b' and a.tc003<='$end_day11a'  group by a.tc001
                ) c
               set b.mv3062=c.tc008
               where b.mv001=c.tc001 and b.mv001='$mv001'  ";
			   $this->db->query($sql29);
			   
				//已請特休1 (未超過)
				 $sql21 =" update cmsmv as b,(select a.tc001,round(sum(a.tc008)/8,2) as tc008
               from  paltc a 
               where a.tc001=$mv001  and a.tc003>='$str_day1a' and a.tc003<='$end_day11a'  group by a.tc001
                ) c
               set b.mv306=round(c.tc008,2) 
               where b.mv001=c.tc001 and b.mv001='$mv001'  ";
			   $this->db->query($sql21);
			   //已請特休1 (超過)
				 $sql21 =" update cmsmv as b,(select a.tc001,round(sum(a.tc008)/8,2) as tc008
               from  paltc a 
               where a.tc001=$mv001  and a.tc003>='$str_day1a' and a.tc003<='$end_day11a'  group by a.tc001
                ) c
               set b.mv306=round(c.tc008-b.mv3062,2) 
               where b.mv001=c.tc001 and b.mv001='$mv001' and  b.mv306-b.mv305>0  ";
			   $this->db->query($sql21);
			   
			    //已請特休2 (未超過) ===============================
				 $sql22 =" update cmsmv as b,(select a.tc001,round(sum(a.tc008)/8,2) as tc008
               from  paltc a 
               where a.tc001=$mv001  and a.tc003>='$end_day11a' and a.tc003<='$end_day21a'  group by a.tc001
                ) c
               set b.mv311=round(c.tc008,2) 
               where b.mv001=c.tc001 and b.mv001='$mv001' and b.mv306-b.mv305<=0 ";
			 $this->db->query($sql22);
								
				 //已請特休2 (超過)
				 $sql22 =" update cmsmv as b,(select a.tc001,round(sum(a.tc008)/8,2) as tc008
               from  paltc a 
               where a.tc001=$mv001  and a.tc003>='$str_day2a' and a.tc003<='$end_day21a'  group by a.tc001
                ) c
               set b.mv311=round(c.tc008,2) 
               where b.mv001=c.tc001 and b.mv001='$mv001' and  b.mv306-b.mv305>0 ";
			 $this->db->query($sql22);
				
			}unset($ret);
			
		

			//echo "<pre>";var_dump($upd_data);exit;
			
	        return  "計算完成，三秒後關閉視窗。";/*<script>setTimeout(window.close,3000);</script>";*/
	}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>