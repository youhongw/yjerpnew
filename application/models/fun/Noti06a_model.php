<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noti06a_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
	function selbrowse($num,$offset)   //查詢 table 表所有資料
      {            
	    $this->db->select('mq001, mq002');
        $this->db->from('cmsmq');
        $this->db->order_by('mq001', 'ASC');                //排序  單欄
	   // $this->db->order_by('mq001 asc, mq002 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁10筆
	    $ret['rows']=$this->db->get()->result();			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('cmsmq');
		$this->db->where('mq003` >= 81 and `mq003` <= 87 ');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
      }
	
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002')
	                      ->from('cmsmq')
						  ->where('mq003` >= 81 and `mq003` <= 87 ')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						  ->where('mq003` >= 81 and `mq003` <= 87 ');
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	  function search1($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mq002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mq001' => '1', 'mq002 >=' => $seq6, 'mq002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002')
	                      ->from('cmsmq')
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('mq001' => '1', 'mq002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('mq001','1');
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    
	function selone()    //查詢一筆 修改用
          { 
	    
        $this->db->select('*');		
	    $query = $this->db->get('cmsmq');
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	  }
		
	function findf($limit, $offset, $sort_by, $sort_order)    //查詢多筆進階查詢 mysql 
          {            		
	  //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `cmsmq` ";
	    $seq1 = " mq001,mq002 FROM `cmsmq` ";
            $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
            $seq33 = 'mq001 desc' ;
            $seq9 = " ORDER BY mq001 " ;
	    $seq91=" limit ";
	    $seq92=", ";
	    $seq5=$this->session->userdata('find05');
	    $seq7=$this->session->userdata('find07');

            if (trim($this->input->post('find005'))!='')
		  {
		    $this->session->set_userdata('find05',$this->input->post('find005'));
		    $seq5=$this->session->userdata('find05');
		    $seq2="WHERE ".$seq5;
		    $seq32=$seq5;
		  }
	    if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
			  
	    if (trim($this->input->post('find007'))!='') 
	          {
		    $this->session->set_userdata('find07',$this->input->post('find007'));
		    $seq7=$this->session->userdata('find07');			   
		    $seq9=" ORDER BY ".$seq7;
		    $seq33=$seq7;
		  }
             if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		
             $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mq001', 'mq002');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mq001, mq002')
	                       ->from('cmsmq')
		               ->where($seq32)
			       ->order_by($seq33)
			     //->order_by($sort_by, $sort_order)
			       ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmq')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
          }
	    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mq001, mq002');
	    $this->db->from('cmsmq');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mq001 asc, mq002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsmq');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }


      function ajaxnoti06a($seg1)    //ajax 查詢一筆 不更新網頁 廠別 
          { 	              
	    $this->db->set('mq001', $this->uri->segment(4));
	    $this->db->where('mq001', $this->uri->segment(4));	
		$this->db->where('mq003` >= 81 and `mq003` <= 87 ');
	    $query = $this->db->get('cmsmq');
			
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
}

/* End of file model.php */
/* Location: ./application/model/model.php */