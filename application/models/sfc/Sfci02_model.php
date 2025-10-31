<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sfci02_model extends CI_Model {
	
	function __construct()
        {
        parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		  
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	    $this->db->select('mr001, mr002, mr003, mr004, mr005, mr006, mr011, mr012, mr013, mr014, mr015, mr021, create_date');
        $this->db->from('palmr');
	    $this->db->order_by('mr001 desc, mr002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmr');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
        }
	   
	//查詢一筆 看資料   
	function selone()
	    { 
		 $query = $this->db->select('a.*')
            ->from('sfcma as a');
	     $ret['rows'] = $query->get()->result();
		 return $ret;	
	    }
		
	//更改一筆	 
	function updatef()   
	  {
		$data = array(
			'creator' => $this->session->userdata('manager'),
			'usr_group' => $this->input->post('usr_group'),
			'create_date' =>substr($this->input->post('create_date'),0,4).substr($this->input->post('create_date'),5,2).substr($this->input->post('create_date'),8,2),			               
			'modifier' =>$this->input->post('modifier'),
			'modi_date' =>date("Ymd"),
			'flag' => '0',
			'ma001' => $this->input->post('ma001'),
			'ma002' => $this->input->post('ma002'),
			'ma003' => $this->input->post('ma003'),
			'ma004' => $this->input->post('ma004'),
			'ma005' => $this->input->post('ma005')
		);
		$this->load->vars($data);
		//$this->db->where('ma001', '001');
		$this->db->update('sfcma',$data);                   //更改一筆
		if ($this->db->affected_rows() > 0)
		  {
			 return TRUE;
		  }
			 return FALSE;
	  }
	
	function auto_update_ajax(){
		$this->load->model('pal/pali01_model','',TRUE);//員工基本資料
		$this->load->model('pal/pali02_model','',TRUE);//勞保等級
		$this->load->model('pal/pali04_model','',TRUE);//健保等級
		$this->load->model('pal/pali27_model','',TRUE);//加保作業檔頭
		$this->load->model('pal/pali24_model','',TRUE);//加保作業檔身
		$rates_data = $this->selone();$rates_data = $rates_data['rows'][0];
		$cmsmv_temp = $this->pali01_model->get_all_data(10,0,'ti001','asc');
		$palmp_temp = $this->pali02_model->get_all_data(10,0,'ti001','asc');
		$palmq_temp = $this->pali04_model->get_all_data(10,0,'ti001','asc');
		$old_temp = $this->pali27_model->get_all_data(10,0,'ti001','asc');
		$old_palti = array();
		foreach($cmsmv_temp['rows'] as $key => $val){
			$cmsmv_data[$val->mv001] = $val;
		}
		foreach($palmp_temp['rows'] as $key => $val){
			$palmp_data[$val->mp001] = $val;
		}
		foreach($palmq_temp['rows'] as $key => $val){
			$palmq_data[$val->mq001] = $val;
		}
		foreach($old_temp['rows'] as $key => $val){
			$old_palti[$val->ti001] = $val;
		}
		//資料收集完畢，先進行等級表比對並置換(已投保金額為主)
		$new_palti = array();
		foreach($old_palti as $key => $val){
			$new_palti[$key] = (array)$val;
			extract((array)$val);//拆解為變數
			$palmp_ps = "";$palmq_ps = "";
			//自動新增加保日期
			if(strlen($ti010)<6&&!$ti011&&$ti009){
				$new_palti[$key]['ti010'] = $cmsmv_data[$ti001]->mv021;
			}
			if(strlen($ti006)<6&&!$ti007&&$ti005){
				$new_palti[$key]['ti006'] = $cmsmv_data[$ti001]->mv021;
			}
			foreach($palmp_data as $k => $v){//比對勞保等級
				if($v->mp002 == $ti009){
					if($ti008 == $v->mp001){break;}//都一樣就不用改了
					$palmp_ps .= "勞保等級更新 ".$new_palti[$key]['ti008']."->".$v->mp001." ";
					$new_palti[$key]['ti008'] = $v->mp001;
					break;
				}else{
					if($v->mp002 > $ti009){
						$palmp_ps .= "勞保等級更新 ".$new_palti[$key]['ti008']."->".$v->mp001." ";
						$palmp_ps .= "勞保保額:".$new_palti[$key]['ti009']."->".$v->mp002;
						$new_palti[$key]['ti008'] = $v->mp001;
						$new_palti[$key]['ti009'] = $v->mp002;
						break;
					}
				}
			}
			
			foreach($palmq_data as $k => $v){//比對健保
				if($v->mq002 == $ti005){
					if($ti004 == $v->mq001){break;}//都一樣就不用改了
					$palmq_ps .= "健保等級更新 ".$new_palti[$key]['ti004']."->".$v->mq001." ";
					$new_palti[$key]['ti004'] = $v->mq001;
					break;
				}else{
					if($v->mq002 > $ti005){
						$palmq_ps .= "健保等級更新 ".$new_palti[$key]['ti004']."->".$v->mq001." ";
						$palmq_ps .= "健保保額:".$new_palti[$key]['ti005']."->".$v->mq002;
						$new_palti[$key]['ti004'] = $v->mq001;
						$new_palti[$key]['ti005'] = $v->mq002;
						break;
					}
				}
			}
			if($palmp_ps || $palmq_ps){
				$new_palti[$key]['ti013'] = $new_palti[$key]['ti013']." ".date("Y/m/d")." 保費自動更新 ".$palmp_ps." ".$palmq_ps;
			}
		}//資料處理完畢
		$total_count = count($new_palti);$palti_count = 0;$palml_count = 0;
		foreach($new_palti as $key=>$val){
			$upd_data = array(			//先將palti更新一遍
				'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $val['flag']+1,
				 'ti002' => $val['ti002'],
		         'ti003' => $val['ti003'],
		         'ti004' => $val['ti004'],
		         'ti005' => $val['ti005'],
		         'ti006' => $val['ti006'],
			     'ti007' => $val['ti007'],
		         'ti008' => $val['ti008'],
		         'ti009' => $val['ti009'],
				 'ti010' => $val['ti010'],
		         'ti011' => $val['ti011'],
				 'ti012' => $val['ti012'],
                 'ti013' => $val['ti013'],
				 'ti014' => $val['ti014']
			);
            $this->db->where('ti001',  $val['ti001']);
            $this->db->update('palti',$upd_data);
			
			if($this->db->affected_rows()>0){
				$palti_count++;
			}
		
			$family = $this->pali27_model->get_famliy_num($val['ti001']);
			$rates_data->family_count = 0;$rates_data->family_data = array();
			if($family != "nodata"){
				$rates_data->family_count = $family['count'];
				$rates_data->family_data = $family['data'];
			}
			
			$this->pali27_model->auto_addrecord($rates_data,$val);
			
			if($this->db->affected_rows()>0){
				$palml_count++;
			}
		}
		
		$ret = array();
		$ret['palti_count'] = $palti_count;
		$ret['palml_count'] = $palml_count;
		$ret['total_count'] = $total_count;
		
		return $ret;
	}
	
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>