<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali04_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date');
        $this->db->from('palmq');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mq001 desc, mq002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmq');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq008', 'mq007','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq002';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq008, mq007, create_date')
	                      ->from('palmq')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmq');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mq001', $this->uri->segment(4));
	    $this->db->where('mq001', $this->uri->segment(4));	
	    $query = $this->db->get('palmq');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->mq002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('palmq.*');	
		 $this->db->from('palmq');
	     $this->db->where('mq002', $this->uri->segment(4));
		 $query = $this->db->get();
			
	     if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	   }
	   
	//查詢進階查詢 	
	function findf($limit, $offset, $sort_by, $sort_order)     
       {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `palmq` ";
	     $seq1 = " mq001, mq002, mq003, mq004, mq005, mq006,mq007, create_date FROM `palmq` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mq002 asc' ;
         $seq9 = " ORDER BY mq001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mq001 ";

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
	     $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','mq007','mq008','mq007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq002';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006,mq007,mq008,mq007, create_date')
	                       ->from('palmq')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palmq')
		                  ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
       }
	   
	//篩選多筆    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	   {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
        $sort_by = $this->uri->segment(4);			
        $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','mq007','mq008','mq009','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq002';  //檢查排序欄位是否為 table
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, mq007, mq008, mq009, create_date');
	    $this->db->from('palmq');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palmq');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->set('mq002', $this->input->post('mq002')); 
	    $this->db->where('mq002', $this->input->post('mq002')); 
	    $query = $this->db->get('palmq');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		if(!@$this->input->post('mq001')){$mq001=1;}else{$mq001=$this->input->post('mq001');}
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'mq001' => $mq001,
		          'mq002' => $this->input->post('mq002'),
		          'mq003' => $this->input->post('mq003'),
		          'mq004' => $this->input->post('mq004'),
		          'mq005' => $this->input->post('mq005'),
		          'mq006' => $this->input->post('mq006'),
                  'mq007' => $this->input->post('mq007'),
                  'mq008' => $this->input->post('mq008'),
                  'mq009' => $this->input->post('mq009')			  
                      );
         
	    $exist = $this->pali04_model->selone1($this->input->post('mq002'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
		  
			$ret = $this->db->insert('palmq', $data);
			$this->auto_update_level();
           return $ret;
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->set('mq002', $this->input->post('mq002c')); 
	    $this->db->where('mq002', $this->input->post('mq002c')); 
	    $query = $this->db->get('palmq');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mq001c');    
	    $seq2=$this->input->post('mq002c');
	    $this->db->where('mq001', $this->input->post('mq001c')); 
	    $query = $this->db->get('palmq');
	    $exist = $query->num_rows();
        if (!$exist)
	      {
		   return 'exist';
	      }         		
        if ($query->num_rows() != 1) { return 'exist'; }
		if ($query->num_rows() == 1) 
		  {
		   $result = $query->result();
		   foreach($result as $row):
                $mq002=$row->mq002;
				$mq003=$row->mq003;
                $mq004=$row->mq004;
                $mq005=$row->mq005;
                $mq006=$row->mq006; 
                $mq007=$row->mq007;
                $mq008=$row->mq008;
                $mq009=$row->mq009;			
	 	  endforeach;
	      } 
            $seq3=$this->input->post('mq002c');    //主鍵一筆
	  
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'mq001' => $seq3,
		          'mq002' => $mq002,
		          'mq003' => $mq003,
		          'mq004' => $mq004,
		          'mq005' => $mq005,
		          'mq006' => $mq006, 
                  'mq007' => $mq007,
                  'mq008' => $mq008,
                  'mq009' => $mq009		  
                    );
            $exist = $this->pali04_model->selone2($this->input->post('mq002c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palmq', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('mq001c');    //查詢一筆以上
	    $seq2=$this->input->post('mq002c');
	    $sql = " SELECT mq001,mq002,mq003,mq004,mq005,mq006,mq007,mq008,mq009,create_date FROM palmq WHERE mq001 >= '$seq1'  AND mq001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
		 
	    $seq1=$this->input->post('mq001c');    //查詢一筆以上
	    $seq2=$this->input->post('mq002c'); 
		//var_dump($this->input->post('mq002c'));exit;
	    $sql = " SELECT mq001,mq002,mq003,mq004,mq005,mq006,mq007,mq008,mq009,create_date FROM palmq WHERE mq001 >= '$seq1'  AND mq001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mq001 >= '$seq1'  AND mq001 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palmq')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	 
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'mq002' => $this->input->post('mq002'),
		          'mq003' => $this->input->post('mq003'),
		          'mq004' => $this->input->post('mq004'),
		          'mq005' => $this->input->post('mq005'),
		          'mq006' => $this->input->post('mq006'),
                  'mq007' => $this->input->post('mq007'),
                  'mq008' => $this->input->post('mq008'),
                  'mq009' => $this->input->post('mq009')			  
                        );
            $this->db->where('mq002', $this->input->post('mq002'));
	       
            $this->db->update('palmq',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
				  $this->auto_update_level();
                 return TRUE;
              }
                 return FALSE;
          }
		  
	//刪除一筆	
	function deletef($seg1,$seg2)      
       {  
	    $seg1=$this->uri->segment(4);
	    $this->db->where('mq002', $seg1);
        $this->db->delete('palmq'); 
	    if ($this->db->affected_rows() > 0)
          {
			  $this->auto_update_level();
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
		      list($seq1) = explode("/", $seq[$x]);
		      $seq1;
		      //   $seq2;
			  $this->db->where('mq002', $seq1);
              $this->db->delete('palmq'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
			  $this->auto_update_level();
           return TRUE;
          }
           return FALSE;					
       }
	
	function get_rates(){
		$this->db->select('*');
        $this->db->from('palmr');
		$query = $this->db->get();
		$result = $query->result();
	    if ($query->num_rows() > 0) 
		{
			return $result;
		}else{
			return "unset";
		}
	}
	
	//2017.01.19執行任何變動時自動調整等級
	function auto_update_level(){
		$rates = $this->get_rates();$rates = $rates[0];
		if($rates=="unset"){return "rate unset";}
		$query = $this->db->select('company, creator, usr_group, create_date, mq001, mq002, mq003
									, mq004, mq005, mq006, mq007, mq008, mq009')
			->from('palmq')
			->order_by('mq002','asc');

		$origin_data = $query->get()->result();$origin_count = count($origin_data);
		$level_count = 0;
		$new_data = array();
		foreach($origin_data as $key => $val){
			$insurance = $val->mq002*$rates->mr011/100;
			$data = array(
				'company' => $val->company,
				'creator' => $val->creator,
				'usr_group' => $val->usr_group,
				'create_date' => $val->create_date,
				'modifier' => $this->session->userdata('manager'),
				'modi_date' => date("Ymd"),
				'flag' => $this->input->post('flag')+1,
				'mq001' => $level_count,
				'mq002' => $val->mq002,
				'mq003' => round($insurance*$rates->mr013/100,0),
				'mq004' => round(($insurance*$rates->mr013/100)*2,0),
				'mq005' => round(($insurance*$rates->mr013/100)*3,0),
				'mq006' => round(($insurance*$rates->mr013/100)*4,0),
				'mq007' => round($rates->mr014*$rates->mr012*$insurance/100,0),
				'mq008' => round($rates->mr015*$rates->mr012*$insurance/100,0),
				'mq009' => $val->mq009
			);

			$new_data[$level_count] = $data;
			$level_count++;
		}
		$new_count = 0;
		$this->db->where('mq001 >= 0');
		$this->db->delete('palmq');
		
		foreach($new_data as $key => $val){
			$this->db->insert('palmq', $val);$new_count++;
		}
		
		$ret['origin_count'] = $origin_count;
		$ret['new_count'] = $new_count;
		
		return $ret;
	}
	
	//供其他地方取資料用
	function get_all_data()
	  {
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq008, mq007, create_date')
	                      ->from('palmq')
		                  ->order_by('mq002', 'asc');
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmq');
	    $num = $query->get()->result();
	    $ret['num_rows'] = $num[0]->count;
		
	    return $ret;
	  }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>