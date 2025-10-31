<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali02_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mp001, mp002, mp003, mp004, mp005, mp006, create_date');
        $this->db->from('palmp');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mp001 desc, mp002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmp');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mp001', 'mp002', 'mp003', 'mp004', 'mp008', 'mp009','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mp002';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mp001, mp002, mp003, mp004, mp008, mp009, create_date')
	                      ->from('palmp')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmp');
	    $num = $query->get()->result();
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mp001', $this->uri->segment(4));
	    $this->db->where('mp001', $this->uri->segment(4));	
	    $query = $this->db->get('palmp');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->mp002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('palmp.*');	
		 $this->db->from('palmp');
	     $this->db->where('mp002', $this->uri->segment(4));
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `palmp` ";
	     $seq1 = " mp001, mp002, mp003, mp004, mp005, mp006,mp007, create_date FROM `palmp` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mp001 desc' ;
         $seq9 = " ORDER BY mp001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mp001 ";

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
	     $sort_columns = array('mp001', 'mp002', 'mp003', 'mp004', 'mp005', 'mp006','mp007','mp008','mp009','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mp001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mp001, mp002, mp003, mp004, mp005, mp006,mp007,mp008,mp009, create_date')
	                       ->from('palmp')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palmp')
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
	    $sort_columns = array('mp001', 'mp002', 'mp003', 'mp004', 'mp005', 'mp006','mp007','mp008','mp009','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mp001';  //檢查排序欄位是否為 table
	    $this->db->select('mp001, mp002, mp003, mp004, mp005, mp006, mp007, mp008, mp009, create_date');
	    $this->db->from('palmp');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palmp');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->set('mp002', $this->input->post('mp002')); 
	    $this->db->where('mp002', $this->input->post('mp002')); 
	    $query = $this->db->get('palmp');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		if(!@$this->input->post('mp001')){$mp001=1;}else{$mp001=$this->input->post('mp001');}
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'mp001' => $mp001,
		          'mp002' => $this->input->post('mp002'),
		          'mp003' => $this->input->post('mp003'),
		          'mp004' => $this->input->post('mp004'),
		          'mp005' => $this->input->post('mp005'),
		          'mp006' => $this->input->post('mp006'),
                  'mp007' => $this->input->post('mp007'),
                  'mp008' => $this->input->post('mp008'),
                  'mp009' => $this->input->post('mp009'),
                  'mp010' => $this->input->post('mp010')				  
                      );
         
	    $exist = $this->pali02_model->selone1($this->input->post('mp002'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
		   $ret = $this->db->insert('palmp', $data);		   
		   $this->auto_update_level();
           return $ret;
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->set('mp001', $this->input->post('mp002c')); 
	    $this->db->where('mp001', $this->input->post('mp002c')); 
	    $query = $this->db->get('palmp');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mp001c');    
	    $seq2=$this->input->post('mp002c');
	    $this->db->where('mp001', $this->input->post('mp001c')); 
	    $query = $this->db->get('palmp');
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
                $mp002=$row->mp002;
				$mp003=$row->mp003;
                $mp004=$row->mp004;
                $mp005=$row->mp005;
                $mp006=$row->mp006; 
                $mp007=$row->mp007;
                $mp008=$row->mp008;
                $mp009=$row->mp009;
                $mp010=$row->mp010;				
	 	  endforeach;
	      } 
            $seq3=$this->input->post('mp002c');    //主鍵一筆
	  
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'mp001' => $seq3,
		          'mp002' => $mp002,
		          'mp003' => $mp003,
		          'mp004' => $mp004,
		          'mp005' => $mp005,
		          'mp006' => $mp006, 
                  'mp007' => $mp007,
                  'mp008' => $mp008,
                  'mp009' => $mp009,
                  'mp010' => $mp010				  
                    );
            $exist = $this->pali02_model->selone2($this->input->post('mp002c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palmp', $data);      //複製一筆
			  $this->auto_update_level();
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('mp001c');    //查詢一筆以上
	    $seq2=$this->input->post('mp002c');
	    $sql = " SELECT mp001,mp002,mp003,mp004,mp005,mp006,mp007,create_date FROM palmp WHERE mp001 >= '$seq1'  AND mp001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('mp001c');    //查詢一筆以上
	    $seq2=$this->input->post('mp002c'); 
	    $sql = " SELECT * FROM palmp WHERE mp001 >= '$seq1'  AND mp001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mp001 >= '$seq1'  AND mp001 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palmp')
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
				  'mp002' => $this->input->post('mp002'),
		          'mp003' => $this->input->post('mp003'),
		          'mp004' => $this->input->post('mp004'),
		          'mp005' => $this->input->post('mp005'),
		          'mp006' => $this->input->post('mp006'),
                  'mp007' => $this->input->post('mp007'),
                  'mp008' => $this->input->post('mp008'),
                  'mp009' => $this->input->post('mp009'),
                  'mp010' => $this->input->post('mp010')				  
                        );
            $this->db->where('mp002', $this->input->post('mp002'));
	       
            $this->db->update('palmp',$data);                   //更改一筆
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
	    $this->db->where('mp001', $seg1);
        $this->db->delete('palmp'); 
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
			  $this->db->where('mp001', $seq1);
              $this->db->delete('palmp'); 
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
		$query = $this->db->select('company, creator, usr_group, mp001, mp002, mp003, mp004
									, mp005, mp006, mp007, mp008, mp009, mp010, create_date')
			->from('palmp')
			->order_by('mp002','asc');

		$origin_data = $query->get()->result();$origin_count = count($origin_data);
		$level_count = 0;
		$new_data = array();
		foreach($origin_data as $key => $val){
			$insurance = $rates->mr001*$val->mp002/100+$rates->mr002*$val->mp002/100;
			$data = array(
				'company' => $val->company,
				'creator' => $val->creator,
				'usr_group' => $val->usr_group,
				'create_date' => $val->create_date,
				'modifier' => $this->session->userdata('manager'),
				'modi_date' => date("Ymd"),
				'flag' => $this->input->post('flag')+1,
				'mp001' => $level_count,
				'mp002' => $val->mp002,
				'mp003' => round($rates->mr001*$val->mp002/100,0),
				'mp004' => round($rates->mr002*$val->mp002/100,0),
				'mp005' => round($rates->mr003*$val->mp002/100,0),
				'mp006' => round($rates->mr004*$val->mp002/100,0),
				'mp008' => round($rates->mr005*$insurance/100,0),
				'mp009' => round($rates->mr006*$insurance/100,0),
				'mp007' => round(($rates->mr003*$val->mp002/100)+($rates->mr005*$insurance/100),0),
				'mp010' => $val->mp010
			);

			$new_data[$level_count] = $data;
			$level_count++;
		}
		$new_count = 0;
		$this->db->where('mp001 >= 0');
		$this->db->delete('palmp');
		$temp_ary = array(
				'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => '',
		        'modi_date' => '',
		        'flag' => 0,
				'mp001' => 0,'mp002' => 0,'mp003' => 0,'mp004' => 0,
				'mp005' => 0,'mp006' => 0,'mp008' => 0,'mp009' => 0,
				'mp007' => 0,'mp010' => ""
			);
		//$this->db->insert('palmp', $temp_ary);
		foreach($new_data as $key => $val){
			$this->db->insert('palmp', $val);$new_count++;
		}
		
		$ret['origin_count'] = $origin_count;
		$ret['new_count'] = $new_count;
		
		return $ret;
	}
	
	//供其他地方取資料用
	function get_all_data()     
	  { 
	    $query = $this->db->select('mp001, mp002, mp003, mp004, mp008, mp009, create_date')
	                      ->from('palmp')
		                  ->order_by('mp002', 'asc');
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmp');
	    $num = $query->get()->result();
	    $ret['num_rows'] = $num[0]->count;
		
	    return $ret;
	  }
	  
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>