<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invq04a_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
		  
		  function selbrowse1($num,$offset)   //查詢 table 表所有資料
          {            
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date');
            $this->db->from('cmsmq');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mq001 asc, mq002 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('cmsmq');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
          }
		  
		function searcha($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
	                      ->from('cmsmq')
						  ->where('mq003','11')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						   ->where('mq003','11');  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	   function searchb($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
	                      ->from('cmsmq')
						 ->where('mq003','12')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						    ->where('mq003','12'); 
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	   function searchc($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
	                      ->from('cmsmq')
						 ->where('mq003','13')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						    ->where('mq003','13'); 
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	  function searchd($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
	                        ->from('cmsmq')
						 ->where('mq003','14')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						  ->where('mq003','14'); 
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    function searche($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
	                        ->from('cmsmq')
						 ->where('mq003','15')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						  ->where('mq003','15'); 
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    function searchf($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
	                        ->from('cmsmq')
						 ->where('mq003','16')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						  ->where('mq003','16'); 
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    function searchg($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
	                        ->from('cmsmq')
						 ->where('mq003','17')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						  ->where('mq003','17'); 
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	  function search1($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mq001' => '1', 'mq002 >=' => $seq6, 'mq002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
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
	  
	   function search2($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mq001' => '1', 'mq002 >=' => $seq6, 'mq002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
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
	  
	   function search3($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mq001' => '1', 'mq002 >=' => $seq6, 'mq002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
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
	    
	  function search4($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mq001' => '1', 'mq002 >=' => $seq6, 'mq002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
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
	    function search5($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mq001' => '1', 'mq002 >=' => $seq6, 'mq002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
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
	    function search6($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mq001' => '1', 'mq002 >=' => $seq6, 'mq002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
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
	    function search7($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (部份條件)
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mb002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mq001' => '1', 'mq002 >=' => $seq6, 'mq002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
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
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date');
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
	  function filterf2($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date');
	    $this->db->from('cmsmq');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mq001 asc, mq002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invmav2');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
		function filterf3($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date');
	    $this->db->from('cmsmq');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mq001 asc, mq002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invmav3');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }  
	function filterf4($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date');
	    $this->db->from('cmsmq');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mq001 asc, mq002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invmav4');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }	  
	function filterf5($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date');
	    $this->db->from('cmsmq');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mq001 asc, mq002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invmav5');
		$this->db->where('mq001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }	 
	function filterf6($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date');
	    $this->db->from('invmav6');
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
	function filterf7($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date');
	    $this->db->from('invmav7');
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
	function ajaxpinvq04a11($seg1)    //ajax 查詢一筆 顯示用 報價單別 tb001
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '11');
          $this->db->where('mq001', $this->uri->segment(4));		  
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
	
      function ajaxpinvq04a12($seg1)    //ajax 查詢一筆 顯示用 訂單單別 tb001
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '12');
          $this->db->where('mq001', $this->uri->segment(4));		  
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
     function ajaxpinvq04a13($seg1)    //ajax 查詢一筆 顯示用 銷貨單別 tb001
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '13');
          $this->db->where('mq001', $this->uri->segment(4));		  
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
     function ajaxpinvq04a14($seg1)    //ajax 查詢一筆 顯示用 退貨單別 tb001
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '14');
          $this->db->where('mq001', $this->uri->segment(4));		  
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
   function ajaxpinvq04a15($seg1)    //ajax 查詢一筆 顯示用 退貨單別 tb001
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '15');
          $this->db->where('mq001', $this->uri->segment(4));		  
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
  function ajaxpinvq04a16($seg1)    //ajax 查詢一筆 顯示用 退貨單別 tb001
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '16');
          $this->db->where('mq001', $this->uri->segment(4));		  
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
  function ajaxpinvq04a17($seg1)    //ajax 查詢一筆 顯示用 退貨單別 tb001
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '17');
          $this->db->where('mq001', $this->uri->segment(4));		  
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