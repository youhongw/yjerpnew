<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmsq21a_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
		  
		  function selbrowse1($num,$offset)   //查詢 table 表所有資料
          {            
	    $this->db->select('na001, na002, na003, na004, na005, na006, create_date');
            $this->db->from('cmsna');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('na001 asc, na002 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('cmsna');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
          }
		  
		function searcha($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('na001, na002, na003, na004, na005, na006, create_date')
	                      ->from('cmsna')
						  ->where('na001','1')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsna')
						   ->where('na001','1');  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	   function searchb($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('na001, na002, na003, na004, na005, na006, create_date')
	                      ->from('cmsna')
						 ->where('na001','2')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsna')
						    ->where('na001','2'); 
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	   function searchc($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('na001, na002, na003, na004, na005, na006, create_date')
	                      ->from('invmav3')
						 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('invmav3');
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	  function searchd($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料 (全部)
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('na001, na002, na003, na004, na005, na006, create_date')
	                      ->from('invmav4')
						 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('invmav4');
						    
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
	//	$array = array('na001' => '1', 'na002 >=' => $seq6, 'na002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('na001, na002, na003, na004, na005, na006, create_date')
	                      ->from('cmsna')
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('na001' => '1', 'na002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsna')
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('na001','1');
                        						  
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
	//	$array = array('na001' => '1', 'na002 >=' => $seq6, 'na002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('na001, na002, na003, na004, na005, na006, create_date')
	                      ->from('cmsna')
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('na001' => '1', 'na002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsna')
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('na001','1');
                        						  
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
	//	$array = array('na001' => '1', 'na002 >=' => $seq6, 'na002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('na001, na002, na003, na004, na005, na006, create_date')
	                      ->from('invmav3')
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('na001' => '1', 'na002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('invmav3')
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('na001','1');
                        						  
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
	//	$array = array('na001' => '1', 'na002 >=' => $seq6, 'na002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('na001, na002, na003, na004, na005, na006, create_date')
	                      ->from('invmav4')
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('na001' => '1', 'na002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('invmav4')
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('na001','1');
                        						  
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
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否為 table
			
	    $this->db->select('na001, na002, na003, na004, na005, na006, create_date');
	    $this->db->from('cmsna');
		$this->db->where('na001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('na001 asc, na002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsna');
		$this->db->where('na001','1');
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
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否為 table
			
	    $this->db->select('na001, na002, na003, na004, na005, na006, create_date');
	    $this->db->from('cmsna');
		$this->db->where('na001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('na001 asc, na002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsna');
		$this->db->where('na001','1');
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
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否為 table
			
	    $this->db->select('na001, na002, na003, na004, na005, na006, create_date');
	    $this->db->from('invmav3');
		$this->db->where('na001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('na001 asc, na002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invmav3');
		$this->db->where('na001','1');
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
	    $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否為 table
			
	    $this->db->select('na001, na002, na003, na004, na005, na006, create_date');
	    $this->db->from('invmav4');
		$this->db->where('na001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('na001 asc, na002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invmav4');
		$this->db->where('na001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }	  
	//ajax 查詢一筆  付款條件(採購1)	
	function ajaxcmsq21a1($seg1)    
        { 	              
	     // $this->db->set('ma001', $this->uri->segment(4));
		  $this->db->where('na001', '1');
	      $this->db->where('na002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsna');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->na003;
              }
		   return $result;   
		   }
	    }
	function ajaxcmsq21a2($seg1)    
        { 	              
	     // $this->db->set('ma001', $this->uri->segment(4));
		  $this->db->where('na001', '2');
	      $this->db->where('na002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsna');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->na003;
              }
		   return $result;   
		   }
	    }
}

/* End of file model.php */
/* Location: ./application/model/model.php */