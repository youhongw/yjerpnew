<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seti02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
	
	function get_print_format($user,$process)
		{			
			$query = $this->db->select('a.tb001,b.mf002 as tb001disp,a.tb002,c.mb002,a.tb003,a.tb004,a.tb005,a.tb006,a.tb007,a.tb008,a.tb009')
			   ->from('settb as a')
			   ->join('admmf as b', 'a.tb001 = b.mf001','left')
			   ->join('admmb as c', 'a.tb002 = c.mb001','left')
			   ->where('tb001',$user)
			   ->where('tb002',$process);
			$ret['data_title'] = $query->get()->result();
			if (count($ret['data_title']) <= 0){
				$query = $this->db->select('a.tb001,b.mf002 as tb001disp,a.tb002,c.mb002,a.tb003,a.tb004,a.tb005,a.tb006,a.tb007,a.tb008,a.tb009')
				   ->from('settb as a')
				   ->join('admmf as b', 'a.tb001 = b.mf001','left')
				   ->join('admmb as c', 'a.tb002 = c.mb001','left')
				   ->where('tb001',"demo")
				   ->where('tb002',$process);
				$ret['data_title'] = $query->get()->result();
			}$ret['data_title'] = $ret['data_title'][0];
			
			$query = $this->db->select('*')
			   ->from('settc')
			   ->where('tc001',$user)
			   ->where('tc002',$process);   
			$ret['data_body'] = $query->get()->result();
			
			if (count($ret['data_body']) <= 0){
				$query = $this->db->select('*')
				   ->from('settc')
				   ->where('tc001',"demo")
				   ->where('tc002',$process);
				$ret['data_body'] = $query->get()->result();
			}
			
			return $ret;
		}
		
	function save_print_format($process,$format_name,$item_data="",$use_table=array())
		{
			//echo "<pre>";var_dump($item_data);exit;
			if(empty($item_data)){return false;}else{extract($item_data);}
			$tb004 = "assets\image\seti02\moci03.png";$tb005=0;$tb006=0;$tb007="";$tb008=0;$tb009=0;
			foreach($use_table as $tb_val){			//檢查有無細項
				$input_name = $tb_val."_detail_input";
				$count_name = $tb_val."_detail_count";
				if(isset($$input_name)&&isset($$count_name)){
					$tb007=$tb_val;$tb008=$$input_name;$tb009=$$count_name;
				}
			}
			if(isset($canvas_src)){$tb004=$canvas_src;}
			if(isset($canvas_width)){$tb005=$canvas_width;}
			if(isset($canvas_height)){$tb006=$canvas_height;}
			
			$data = array( 
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' => date("Ymd"),
				'modifier' => '',
				'modi_date' => '',
				'flag' => 0,
				'tb001' => $this->session->userdata('manager'),
				'tb002' => $process,
				'tb003' => $format_name,
				'tb004' => $tb004,
				'tb005' => $tb005,
				'tb006' => $tb006,
				'tb007' => $tb007,
				'tb008' => $tb008,
				'tb009' => $tb009
			);
			//echo "<pre>";var_dump($data);exit;
			$exist = $this->selone($this->session->userdata('manager'),$process,$format_name);
			if (!$exist)
			{
				$this->db->insert('settb', $data);
			}else{
				unset($data['company']);unset($data['creator']);unset($data['usr_group']);unset($data['create_date']);
				$data['modifier'] = $this->session->userdata('manager');
				$data['modi_date'] = date("Ymd");
				$this->db->where('tb001', $this->session->userdata('manager'));
				$this->db->where('tb002', $process);
				$this->db->where('tb003', $format_name);
				$this->db->update('settb',$data);
			}
			
			//echo "<pre>";var_dump($item_data);exit;
			$this->db->where('tc001', $this->session->userdata('manager'));
			$this->db->where('tc002', $process);
			$this->db->where('tc003', $format_name);
			$this->db->delete('settc'); 
			foreach($item_data['items_input'] as $key=>$val){
				if(strlen($val)>=3){
					$data = array( 
						'company' => $this->session->userdata('syscompany'),
						'creator' => $this->session->userdata('manager'),
						'usr_group' => 'A100',
						'create_date' => date("Ymd"),
						'modifier' => '',
						'modi_date' => '',
						'flag' => 0,
						'tc001' => $this->session->userdata('manager'),
						'tc002' => $process,
						'tc003' => $format_name,
						'tc004' => substr($key,0,5),
						'tc005' => substr($key,6,5),
						'tc006' => $val,
						'tc007' => "",
						'tc008' => ""
					);
					$this->db->insert('settc', $data);
				}
			}
			if(isset($item_data['items_other'])&&is_array($item_data['items_other'])){
			foreach($item_data['items_other'] as $key=>$val){
				if(strlen($val)>=3){
				$data = array( 
					'company' => $this->session->userdata('syscompany'),
					'creator' => $this->session->userdata('manager'),
					'usr_group' => 'A100',
					'create_date' => date("Ymd"),
					'modifier' => '',
					'modi_date' => '',
					'flag' => 0,
					'tc001' => $this->session->userdata('manager'),
					'tc002' => $process,
					'tc003' => $format_name,
					'tc004' => "other",
					'tc005' => substr($key,6,5),
					'tc006' => $val,
					'tc007' => $item_data['items_otherv'][$key],
					'tc008' => ""
				);
				$this->db->insert('settc', $data);
				}
			}
			}
			
			if(isset($item_data['items_other'])&&is_array($item_data['items_other'])){
			foreach($item_data['items_func'] as $key=>$val){
				if(strlen($val)>=3){
				$data = array( 
					'company' => $this->session->userdata('syscompany'),
					'creator' => $this->session->userdata('manager'),
					'usr_group' => 'A100',
					'create_date' => date("Ymd"),
					'modifier' => '',
					'modi_date' => '',
					'flag' => 0,
					'tc001' => $this->session->userdata('manager'),
					'tc002' => $process,
					'tc003' => $format_name,
					'tc004' => "func",
					'tc005' => substr($key,5,5),
					'tc006' => $val,
					'tc007' => "",
					'tc008' => $item_data['items_funcv'][$key]
				);
				$this->db->insert('settc', $data);
				}
			}
			}
		}
	
	function get_table_name($table_array = ""){
		if(!is_array($table_array)){
			return false;
		}
		foreach($table_array as $val){
			$query = $this->db->select('MD001,MD002,MD003,MD004')
			   ->from('admmd')
			   ->where('MD001',$val);
			$temp_ret = $query->get()->result();
			foreach($temp_ret as $v){
				$ret[$val][$v->MD003] = $v;
			}
		}
		
		return $ret;
	}
	
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2,$seq3)
        {
			$query = $this->db->select('a.tb001,a.tb002,a.tb003')
			   ->from('settb as a')
			   ->where('tb001',$seq1)
			   ->where('tb002',$seq2)
			   ->where('tb003',$seq3);
			$ret['data'] = $query->get()->result();
			
			if (count($ret['data']) <= 0){
				return false;
			}
				return true;
	    }
			
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tc001', $this->uri->segment(4));
		  $this->db->where('tc002', $this->uri->segment(5));
          $this->db->delete('purtc'); 
		  $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('purtd'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>