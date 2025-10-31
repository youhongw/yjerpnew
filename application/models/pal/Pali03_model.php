<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('*');
          $this->db->from('palms');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ms001 desc ');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->group_by('ms001');
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('palms');
          $query = $this->db->get();        
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
		  
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('*');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ms001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*,COUNT(*) as count_count')
				   ->from('palms')
				   ->group_by('ms001')
				   ->order_by($sort_by, $sort_order)
				   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palms');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	//下拉選單科目名稱op1
	function op1()     //
	    { 
	    
	     $query = $this->db->select('op1_sn,op1_name')
	                       ->from('palop1')
		                   ->order_by('op1_sn', 'asc');
	     $ret['rows1'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palms');
	     $num = $query->get()->result();		
	     $ret['num_rows1'] = $num[0]->count;		
	     return $ret;
	    }	
	//查詢一筆 修改用   
	
	function selone($seg1)    
       {
		$this->db->select('a.*');
        $this->db->from('palms as a');
		$this->db->where('a.ms001', $this->uri->segment(4));
	//	$this->db->query('SET SQL_BIG_SELECTS=1');   //連結太多table 加此行
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;
		 }
	    }

	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `palms` ";
	      $seq1 = "ms001, mv002, mv003, mv004, mv005, mv006,mv007,mv08,mv009,mv011,mv013, create_date FROM `palms` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'ms001 desc' ;
          $seq9 = " ORDER BY ms001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  //$seq5=$this->session->userdata('find05');
	      //$seq7=$this->session->userdata('find07');
          $seq7="ms001 ";
          if (trim($this->input->post('find005'))!='')
		    {
			  $seq5=$this->input->post('find005');
		      $seq2="WHERE ".$seq5;
		      $seq32=$seq5;
		    }
	    if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
			  
	    if (trim($this->input->post('find007'))!='') 
	        {
		      $seq7=$this->input->post('find007');				   
		      $seq9=" ORDER BY ".$seq7;
		      $seq33=$seq7;
		    }
        if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		 //下一頁不會亂跳
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ms001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv006','mv007','mv008','mv009','mv012','mv015','mv021','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ms001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ms001, mv002, mv003, mv004, mv005, mv006,mv007,mv008,mv009,mv012,mv015,mv021, create_date')
	                       ->from('palms')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palms')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//篩選多筆  
		 
	function filterf1($limit, $offset , $sort_by  , $sort_order)           
	    {    
	      $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
          $sort_by = $this->uri->segment(4);			
          $sort_order = $this->uri->segment(5);	
	      $offset=$this->uri->segment(8,0);
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('*', 'COUNT(*) as count_count');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ms001';  //檢查排序欄位是否為 table
			
	      $this->db->select('*,COUNT(*) as count_count');
	      $this->db->from('palms');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
		  $this->db->group_by('ms001');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('palms');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複  
	function selone1($seg1,$seg2)    
        {
	      $this->db->set('ms001', $seg1); 
	      $this->db->where('ms001', $seg1);
	      $this->db->set('ms002', $seg2);
	      $this->db->where('ms002', $seg2);
	      $query = $this->db->get('palms');
	      return $query->num_rows() ;
	    }  	 
		
	//新增多筆	
	function insertf()    
        {
			if(@$this->input->post('ms001')) $ms001 = $this->input->post('ms001');
			if(@$this->input->post('ms002')) $ms002 = $this->input->post('ms002');
			if(@$this->input->post('ms003')) $ms003 = $this->input->post('ms003');
			if(!$ms001 || !$ms002 || !$ms003){
				return "nodata";
			}$done = 0;$totle = 0;
			foreach($ms002 as $key=>$val){
				preg_match_all('/\d/S',$ms002[$key], $matches);
				$temp_ms002 = implode('',$matches[0]);
				$data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ms001' => strtoupper($ms001[$key]),
		         'ms002' => strtoupper($temp_ms002),
		         'ms003' => strtoupper($ms003[$key])
                );
				$exist = $this->pali03_model->selone1($ms001[$key],$ms002[$key]);
				if ($exist){
					return;
				}
				if($this->db->insert('palms', $data)){
					$done++;
				}
				$totle++;
			}
			$return_data['done'] = $done;
			$return_data['total'] = $totle;
			
			return $return_data;
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
          { 	
	        $this->db->set('ms001', $this->input->post('ms001c'));
	        $this->db->where('ms001', $this->input->post('ms001c')); 
	        $query = $this->db->get('palms');
	        return $query->num_rows() ; 
	      }
	//複製一筆	
    function copyf()           
          {
			$ms001o = $this->input->post('ms001o');$ms001c = $this->input->post('ms001c');
			$done = 0;$total = 0;
	        if($ms001o==$ms001c){
				return "已經沒有那個必要了...那個答案早就在你的心裡了";
			}
			$this->db->select('*');
			$this->db->from('palms');
			$this->db->where('ms001', $ms001o);
			$query = $this->db->get();
				
			if ($query->num_rows() > 0) 
			 {
			   $result = $query->result();
			 }
			 
			foreach($result as $key => $val){
				$data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ms001' => strtoupper($ms001c),
		         'ms002' => strtoupper($val->ms002),
		         'ms003' => strtoupper($val->ms003)
                );
				$exist = $this->pali03_model->selone1($ms001c,$val->ms002);
				if ($exist){
					$total++;
				}else{
					if($this->db->insert('palms', $data)){
						$done++;
						$total++;
					}
				}
			}
			$return_data = array('done'=>$done,'total'=>$total);
          
			return $return_data;      //複製一筆  
        }	
		
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ms001o');    
	      $seq2=$this->input->post('ms001c');
	      $sql = " SELECT ms001,mv002,mv004,mv008,mv009,mv012,mv014,mv019,mv020,mv021,mv022,create_date FROM palms WHERE ms001 >= '$seq1'  AND ms001 <= '$seq2' ORDER BY ms001 "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	      $seq1=$this->input->post('ms001o');    //查詢一筆以上
	      $seq2=$this->input->post('ms001c');
		  IF ($this->input->post('dateo') >'0' ) {$seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr($this->input->post('dateo'),8,2);} else {$seq3='';}
		  IF ($this->input->post('datec') >'0' ) {$seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr($this->input->post('datec'),8,2);} else {$seq4='';}
		   IF ($this->input->post('dateo1') >'0' ) {$seq5=substr($this->input->post('dateo1'),0,4).substr($this->input->post('dateo1'),5,2).substr($this->input->post('dateo1'),8,2);} else {$seq5='';}
		  IF ($this->input->post('datec1') >'0' ) {$seq6=substr($this->input->post('datec1'),0,4).substr($this->input->post('datec1'),5,2).substr($this->input->post('datec1'),8,2);} else {$seq6='';}
		  
	      $sql = " SELECT * FROM palms WHERE ms001 >= '$seq1'  AND ms001 <= '$seq2' AND  mv021 >= '$seq3'  AND mv021 <= '$seq4' AND  mv022 >= '$seq5'  AND mv022 <= '$seq6' "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ms001 >= '$seq1'  AND ms001 <= '$seq2'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                ->from('palms')
		                ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//更改一筆	 
	function updatef()   
        {
			if(@$this->input->post('ms001')) $ms001 = $this->input->post('ms001');
			if(@$this->input->post('ms002')) $ms002 = $this->input->post('ms002');
			if(@$this->input->post('ms003')) $ms003 = $this->input->post('ms003');
			if(!$ms001 || !$ms002 || !$ms003){
				return "nodata";
			}$done = 0;$total = 0;
			foreach($ms002 as $key=>$val){
				preg_match_all('/\d/S',$ms002[$key], $matches);
				$temp_ms002 = implode('',$matches[0]);
				$data = array(
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'ms001' => strtoupper($ms001[$key]),
		         'ms002' => strtoupper($temp_ms002),
		         'ms003' => strtoupper($ms003[$key])
                );
				$exist = $this->pali03_model->selone1($ms001[$key],$ms002[$key]);
				if ($exist){
					$this->db->where('ms001', $ms001[$key]);
					$this->db->where('ms002', $ms002[$key]);
					if($this->db->update('palms',$data)){
						$done++;
					}
				}else{
					$data['company'] = $this->session->userdata('syscompany');
					$data['creator'] = $this->session->userdata('manager');
					$data['usr_group'] = 'A100';
					$data['create_date'] = date("Ymd");
					$data['modifier'] = '';
					$data['modi_date'] = '';
					$data['flag'] = 0;
					if($this->db->insert('palms', $data)){
						$done++;
					}
				}
				$total++;
			}
			$return_data['done'] = $done;
			$return_data['total'] = $total;
			
			return $return_data;
        }
		
	//刪除一筆	
	function deletef($seg1,$seg2)      
        { 
	      $this->db->where('ms001', $seg1);
	      $this->db->where('ms002', $seg2);
          $this->db->delete('palms'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//選取刪除多筆   
	function delmutif()    
        {           
          $seq[] = array('','','','','','','','','','','','','','','');
          $x=0;	
          $seq1=' ';
          $seq2=' ';			
	    if (!empty($_POST['selected'])) 
	        {
              foreach($_POST['selected'] as $check) 
		        {
			      $seq[$x] = $check; 
		    	  //list($seq1, $seq2) = explode("/", $seq[$x]);
				    list($seq1) = explode("/", $seq[$x]);
		    	    $seq1;
		    	  //$seq2;
			        $this->db->where('ms001', $seq1);
			      //$this->db->where('mv002', $seq2);
                    $this->db->delete('palms'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
        }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
/* Location: ./application/controllers/puri01.php */
?>