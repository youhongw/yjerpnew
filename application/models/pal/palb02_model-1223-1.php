<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palb02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 加班單 轉入月出勤  
	function batchaf($seq1)
        {
			$spc_day = array(
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
				if($t_year <= 2005 && $key!="70001" && $key!="73001" && $key!="67001" ){$t_year=2005;$t_month="07";}
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
				
				if($year == 2016){//當年特殊算法，過完2016年就沒有用到，可刪
					$upd_data[$key]['mv215'] = round($upd_data[$key]['mv215']*($t_month/12+($t_day/30/12)),2);
				}
			}
			session_start();
			$_SESSION['palb02']['total_num'] = count($upd_data);
			$_SESSION['palb02']['current_num'] = 0;
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
				$_SESSION['palb02']['current_num']++;
			}

			//echo "<pre>";var_dump($upd_data);exit;
			
	        return  "計算完成，三秒後關閉視窗。";/*<script>setTimeout(window.close,3000);</script>";*/
	}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>