<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cmsq15a_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
		  
		  function selbrowse1($num,$offset)   //查詢 table 表所有資料
          {            
	    $this->db->select('mr001, mr002, mr003, mr004, mr005,  create_date');
            $this->db->from('cmsmrv1');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mr001 asc, mr002 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('cmsmrv1');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
          }
		  
		function searcha3($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部) 
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003', 'mr004', 'mr005', 'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr002';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mr001, mr002, mr003, mr004, mr005,  create_date')
	                      ->from('cmsmr')
						  ->where('mr001','3')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmr')
						  ->where('mr001','3');
						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	   function searchb4($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)國家
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003',  'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mr001, mr002, mr003,  create_date')
	                      ->from('cmsmr')
						  ->where('mr001','4') 
						 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                     ->from('cmsmr')
					     ->where('mr001','4');  
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	   function searchc9($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)廠商分類
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003', 'mr004', 'mr005', 'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mr001, mr002, mr003, mr004, mr005,  create_date')
	                     ->from('cmsmr')
						  ->where('mr001','9')
						 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmr')
						  ->where('mr001','9');
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	  function searchd1($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)通路
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003', 'mr004', 'mr005', 'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mr001, mr002, mr003, mr004, mr005,  create_date')
	                      ->from('cmsmr')
						  ->where('mr001','1')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmr')
						  ->where('mr001','1');  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  function search3($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)地區
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mr001' => '1', 'mr002 >=' => $seq6, 'mr002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003',  'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mr001, mr002, mr003, create_date')
	                      ->from('cmsmr')
						  ->like('mr001','3', 'after') 
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('mr001' => '3', 'mr002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmr')
						   ->like('mr001','3', 'after') 
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('mr001','1');
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	   function search4($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)國家
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mr001' => '1', 'mr002 >=' => $seq6, 'mr002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003',  'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mr001, mr002, mr003,   create_date')
	                      ->from('cmsmr')
						   ->like('mr001','4', 'after') 
                            ->like($seq4, $seq6, 'after') 						   
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('mr001' => '4', 'mr002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmr')
						    ->like('mr001','4', 'after') 
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('mr001','1');
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	   function search9($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)廠商分類
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mr001' => '1', 'mr002 >=' => $seq6, 'mr002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003', 'mr004', 'mr005','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mr001, mr002, mr003, mr004, mr005,  create_date')
	                      ->from('cmsmr')
						  ->like('mr001','9', 'after') 
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('mr001' => '9', 'mr002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmr')
						  ->like('mr001','9', 'after') 
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('mr001','1');
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    
	  function search1($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)通路
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mr001' => '1', 'mr002 >=' => $seq6, 'mr002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003', 'mr004', 'mr005', 'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mr001, mr002, mr003, mr004, mr005,  create_date')
	                      ->from('cmsmr')
						   ->like('mr001','1', 'after') 
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('mr001' => '1', 'mr002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmr')
						   ->like('mr001','1', 'after') 
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('mr001','1');
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }	
	function filterf3($limit, $offset , $sort_by  , $sort_order)    //篩選多筆 地區        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003',  'create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mr001, mr002, mr003,  create_date');
	    $this->db->from('cmsmr');
		$this->db->like('mr001','3', 'after');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mr001 asc, mr002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsmr');
		$this->db->like('mr001','3', 'after');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
	  function filterf4($limit, $offset , $sort_by  , $sort_order)    //篩選多筆 國家       
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003',  'create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mr001, mr002, mr003, create_date');
	    $this->db->from('cmsmr');
		$this->db->like('mr001','4', 'after');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mr001 asc, mr002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsmr');
		$this->db->like('mr001','4', 'after');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
		function filterf9($limit, $offset , $sort_by  , $sort_order)    //篩選多筆  廠商分類      
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003',  'create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mr001, mr002, mr003,  create_date');
	    $this->db->from('cmsmr');
		$this->db->like('mr001','9', 'after');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mr001 asc, mr002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsmr');
		$this->db->like('mr001','9', 'after');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }  
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆  通路        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mr001', 'mr002', 'mr003', 'create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mr001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mr001, mr002, mr003,   create_date');
	    $this->db->from('cmsmr');
		//$this->db->where('mr001','4');
		$this->db->like('mr001','1', 'after');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mr001 asc, mr002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsmr');
	//	$this->db->where('mr001','4');
	    $this->db->like('mr001','1', 'after');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }	  
}

/* End of file model.php */
/* Location: ./application/model/model.php */