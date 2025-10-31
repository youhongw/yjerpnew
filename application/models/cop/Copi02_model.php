<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copi02_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006, create_date');
        $this->db->from('copmb');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('copmb');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('a.mb001','mb002disp',  'mb002disp1','mb001disp', 'a.mb004', 'a.mb005', 'a.mb006','a.mb008','a.mb017','a.create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.mb002,b.mb002 as mb002disp ,b.mb003 as mb002disp1 ,  a.mb001, c.ma002 as mb001disp,a.mb003, a.mb008, a.mb017, a.create_date')
	                      ->from('copmb as a')
						  ->join('invmb as b', 'a.mb002 = b.mb001 ','left')
						  ->join('copma as c', 'a.mb001 = c.ma001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('copmb');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  //欄位表頭排序流覽資料
	  function search2($limit, $offset, $sort_by, $sort_order, $tc004){//歷史查價
		//先取有其產品的主單 //檢查排序欄位是否在 table 內幣別,付款條件,課稅別,業務員,收款業務
		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('a.mb002','a_mb002','b.mb002','b.mb003','a.mb003','a.mb004','a.mb008','a.mb010');

	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.mb001';  //檢查排序欄位是否在 table 內幣別,付款條件,課稅別,業務員,收款業務
	    $query = $this->db->select('a.mb002,a.mb002 as a_mb002,b.mb002 as b_mb002,b.mb003 as b_mb003,a.mb003 as a_mb003,a.mb004 as a_mb004,a.mb008 as a_mb008,a.mb010 as a_mb010')
	                    ->from('invmb as b')
						->join('copmb as a', 'a.mb002 = b.mb001 ','left')
		                ->order_by($sort_by, $sort_order)
		                ->limit($limit, $offset)
						->where('a.mb001',$tc004);
	    $ret['rows'] = $query->get()->result();
		
	    $query = $this->db->select('COUNT(*) as count' ,FALSE)
	                    ->from('copmb as a')
						->join('invmb as b', 'a.mb002 = b.mb001 ','left')
						->where('a.mb001', $tc004);
						
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		
	    return $ret;
	}
	function search3($limit=10, $offset, $sort_by, $sort_order,$vmb001)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('a.mb001','mb002disp',  'mb002disp1','mb001disp', 'a.mb004', 'a.mb005', 'a.mb006','a.mb008','a.mb017','a.create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.mb001,a.mb002 as a_mb002,b.mb002 as b_mb002,b.mb003 as b_mb003,a.mb003 as a_mb003,a.mb004 as a_mb004,a.mb008 as a_mb008,a.mb010 as a_mb010')
	                      ->from('copmb as a')
						  ->join('invmb as b', 'a.mb002 = b.mb001 ','left')
						  ->join('copma as c', 'a.mb001 = c.ma001 ','left')
						  ->where('a.mb001',$vmb001)
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('copmb');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    //Talence Editor 2017.03.21
	/***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 10, $offset = 0, $func = "")
	{
		$this->session->set_userdata('copi02_search',"display_search/".$offset);
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where")   
		    { unset($_SESSION['copi02']['search']);}
		
        if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['copi02']['search']);}

		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		//$offset = 0;
		//$vmb001 = $this->uri->segment(4);
		//echo "<pre>";var_dump($limit);exit;
		//a.mb001='".$vmb001."'
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "a.mb002 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['copi02']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['copi02']['search']['where'];
		}
		
		if($this->input->post('find005')){
			if($where){$where .= " and ";}
			$where .= $this->input->post('find005');
		}
		
		if($func == "and_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " and ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($func == "or_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " or ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		//echo "<pre>";var_dump($where);exit;
		
		if($where == ""){$where=false;}
		/* where end */
		
		/* order 處理區域 */
		if($this->input->post('find007')){
			$order = $this->input->post('find007');
		}else{
			$order = "";
		}
		
		if($func == "order" && @strlen($val)!=0){
			$value = $val;
			$order = $value;
		}else{
			$order = "";
		}
		
		if(isset($_SESSION['copi02']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['copi02']['search']['order'];
		}
		
		if(!isset($_SESSION['copi02']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
	//	echo "<pre>";var_dump($offset);exit;
		/* Data SQL */
		$query = $this->db->select('a.mb002 as a_mb002,b.mb002 as b_mb002,b.mb003 as b_mb003,a.mb003 as a_mb003,a.mb004 as a_mb004,a.mb008 as a_mb008,a.mb010 as a_mb010,b.mb017 as b_mb017,d.mc002 as b_mb017disp ')
			 ->from('copmb as a')
			 ->join('invmb as b', 'a.mb002 = b.mb001 ','left')
			 ->join('copma as c', 'a.mb001 = c.ma001 ','left')
			 ->join('cmsmc as d', 'b.mb017 = d.mc001 ','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		// echo "<pre>";var_dump('test2');exit;
		  //   $vmb001=$this->session->userdata('vmb001');
		    //   $where = "("."mb001=".$sql_where.")"; 1060803
			
		  if ($where==""  ) {$where = "("."a.mb001=".$this->session->userdata('vmb001').")";}
		  if ($this->uri->segment(5)=="cn00000" ) {$where = $where." and "."("."a.mb001=".$this->session->userdata('vmb001').")" ;}
		$query = $this->db->select('a.mb002 as a_mb002,b.mb002 as b_mb002,b.mb003 as b_mb003,a.mb003 as a_mb003,a.mb004 as a_mb004,a.mb008 as a_mb008,a.mb010 as a_mb010,b.mb017 as b_mb017,d.mc002 as b_mb017disp ')
			 ->from('copmb as a')
			 ->join('invmb as b', 'a.mb002 = b.mb001 ','left')
			 ->join('copma as c', 'a.mb001 = c.ma001 ','left')
			  ->join('cmsmc as d', 'b.mb017 = d.mc001 ','left')
			->order_by($order)
			->limit($limit,$offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		//echo "<pre>";var_dump($limit);exit;
	//	if ($where>'')
	//	{echo "<pre>";var_dump($this->db->last_query());exit;}
		$_SESSION['copi02']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('copmb as a')
			 ->join('invmb as b', 'a.mb002 = b.mb001 ','left')
			 ->join('copma as c', 'a.mb001 = c.ma001 ','left')
			  ->join('cmsmc as d', 'b.mb017 = d.mc001 ','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['copi02']['search']['where'] = $where;
		$_SESSION['copi02']['search']['order'] = $order;
		$_SESSION['copi02']['search']['offset'] = $offset;
		
		return $ret;
	}
	  /***新增暫存view表方法construct_view
	*	
	*
	***/
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mb001","mb002","mb003","mb004","mb017"
		);
		$view_array = array();
		$index_array = array();
		foreach($data as $key => $val){
			$key_str = "";
			foreach($pk_array as $pk_k => $pk_v){
				if($key_str){
					$key_str .= "_";
				}$key_str .= $val->$pk_v;
			}
			$view_array[$key_str] = $key;
			$index_array[$key] = $key_str;
		}
		$_SESSION['copi02']['search']['view'] = $view_array;
		$_SESSION['copi02']['search']['index'] = $index_array;
	}
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mb001', $this->uri->segment(4));
	    $this->db->where('mb001', $this->uri->segment(4));	
	    $query = $this->db->get('copmb');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->mb002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2,$seq3)    
       { 
		 $this->db->select('a.mb002,b.mb002 as mb002disp,b.mb003 as mb002disp1,  a.mb001, c.ma002 as mb001disp,a.mb003,a.mb004,d.mf002 as mb004disp,a.mb005,a.mb007,a.mb009, a.mb008,
		 a.mb010,a.mb011,a.mb012,a.mb013,a.mb014,a.mb015,a.mb016,a.mb017,a.mb018,a.flag, a.create_date');	
		 $this->db->from('copmb as a');
	     //$this->db->set('mb001', $this->uri->segment(4)); 
	    // $this->db->where('mb001', $this->uri->segment(4));
		 $this->db->join('invmb as b', 'a.mb002 = b.mb001 ','left');
		 $this->db->join('copma as c', 'a.mb001 = c.ma001 ','left'); 
		 $this->db->join('cmsmf as d', 'a.mb004 = d.mf001 ','left'); 
		// $this->db->where('mb001', $this->uri->segment(4));
		 $this->db->where('a.mb002',$this->uri->segment(4)); 
	     $this->db->where('a.mb001', $this->uri->segment(5)); 
	  //   $this->db->where('a.mb003', $this->uri->segment(6)); 
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
	     $seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `copmb` ";
	     $seq1 = " mb001, mb002, mb003, mb004, mb005, mb009,mb014,mb017, create_date FROM `copmb` ";
         $seq2 = "WHERE `a.create_date` >=' ' ";
	     $seq32 = "`a.create_date` >='' ";
         $seq33 = 'mb001 desc' ;
         $seq9 = " ORDER BY mb001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`a.create_date` >='' ";
         $seq7="mb001 ";

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
		if(@$_SESSION['copi02_sql_term']){$seq32 = $_SESSION['copi02_sql_term'];}
		if(@$_SESSION['copi02_sql_sort']){$seq33 = $_SESSION['copi02_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb009','mb014','mb017','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.mb001,a.mb002 as mb002disp,a.mb002 as mb002disp1,c.ma002 as mb001disp, a.mb002, a.mb003, a.mb004, a.mb005,a.mb008, a.mb009,a.mb014,a.mb017, a.create_date')
	                       ->from('copmb as a')						   
		                   ->join('copma as c', 'a.mb001 = c.ma001 ','left') 
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('copmb as a')
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
	    $sort_columns = array('a.mb001','a.mb002','a.mb003', 'b.mb002', 'b.mb003', 'a.mb004', 'a.mb005','c.ma002', 'a.mb006','a.mb008','a.mb017','a.create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.mb001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.mb002,b.mb002 as mb002disp  ,b.mb003 as mb002disp1,  a.mb001, c.ma002 as mb001disp ,a.mb003, a.mb008, a.mb017, a.create_date');
	       $this->db->from('copmb as a');
			$this->db->join('invmb as b', 'a.mb002 = b.mb001 ','left');
			$this->db->join('copma as c', 'a.mb001 = c.ma001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mb001 asc, mb002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('copmb as a');
			$this->db->join('invmb as b', 'a.mb002 = b.mb001 ','left');
			$this->db->join('copma as c', 'a.mb001 = c.ma001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2,$seg3,$seg4)    
       {
	  //  $this->db->set('mb001', $this->input->post('mb001')); 
	    $this->db->where('mb002', $this->input->post('invq02a')); 
	    $this->db->where('mb001', $this->input->post('copq01a')); 
	    $this->db->where('mb004', $this->input->post('cmsq06a')); 
		$this->db->where('mb017', substr($this->input->post('mb017'),0,4).substr($this->input->post('mb017'),5,2).substr(rtrim($this->input->post('mb017')),8,2)); 
	    $query = $this->db->get('copmb');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		  $smb013 = $this->input->post('mb013');
          if ($smb013 != 'Y') {
          $smb013 = 'N';
           }
		   if ($this->input->post('mb009')> '0') {$mb009 =substr($this->input->post('mb009'),0,4).substr($this->input->post('mb009'),5,2).substr(rtrim($this->input->post('mb009')),8,2);}
           else {$mb009='';}
		   if ($this->input->post('mb010')> '0') {$mb010 =substr($this->input->post('mb010'),0,4).substr($this->input->post('mb010'),5,2).substr(rtrim($this->input->post('mb010')),8,2);}
           else {$mb010='';}
		   if ($this->input->post('mb014')> '0') {$mb014 =substr($this->input->post('mb014'),0,4).substr($this->input->post('mb014'),5,2).substr(rtrim($this->input->post('mb014')),8,2);}
           else {$mb014='';}
		   if ($this->input->post('mb017')> '0') {$mb017 =substr($this->input->post('mb017'),0,4).substr($this->input->post('mb017'),5,2).substr(rtrim($this->input->post('mb017')),8,2);}
           else {$mb017='';}
		   if ($this->input->post('mb018')> '0') {$mb018 =substr($this->input->post('mb018'),0,4).substr($this->input->post('mb018'),5,2).substr(rtrim($this->input->post('mb018')),8,2);}
           else {$mb018='';}
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'mb001' => $this->input->post('copq01a'),
		          'mb002' => $this->input->post('invq02a'),
				  'mb003' => $this->input->post('mb003'),
		          'mb004' => $this->input->post('cmsq06a'),
		         
		          'mb005' => $this->input->post('mb005'),		        
                  'mb007' => $this->input->post('mb007'),
				  'mb008' => $this->input->post('mb008'),
				  'mb009' => $mb009,
				  'mb010' =>  $mb010,
				  'mb011' => $this->input->post('mb011'),
				  'mb012' => $this->input->post('mb012'),
				  'mb013' => $this->input->post('mb013'),
				  'mb014' =>  $mb014,
				  'mb015' => $this->input->post('mb015'),
				  'mb016' => $this->input->post('mb016'),
				  'mb017' =>  $mb017,
				  'mb018' =>  $mb018
                      );
         
	    $exist = $this->copi02_model->selone1($this->input->post('invq02a'),$this->input->post('copq01a'),$this->input->post('cmsq06a'),$this->input->post('mb017'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('copmb', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seq2,$seq4)    
       { 	
	 //   $this->db->set('mb001', $this->input->post('mb002c')); 
	 //   $this->db->where('mb001', $this->input->post('mb002c')); 
		 $this->db->where('mb001',$seq2);
        $this->db->where('mb002',$seq4);	
	    $query = $this->db->get('copmb');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mb001o');    
	    $seq2=$this->input->post('mb001c');
    	$seq3=$this->input->post('mb002o');    
	    $seq4=$this->input->post('mb002c');
	    $this->db->where('mb001', $seq1); 
	    $this->db->where('mb002', $seq3); 
	    $query = $this->db->get('copmb');
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
				$mb003=$row->mb003;
                $mb004=$row->mb004;
                $mb005=$row->mb005;
                $mb007=$row->mb007; 
                $mb008=$row->mb008; 
                $mb009=$row->mb009; 
                $mb010=$row->mb010; 
                $mb011=$row->mb011; 
                $mb012=$row->mb012; 
                $mb013=$row->mb013; 
                $mb014=$row->mb014; 
                $mb015=$row->mb015; 
                $mb016=$row->mb016; 	
                $mb017=$row->mb017; 	
                $mb018=$row->mb018; 	 
	 	  endforeach;
	      } 
          //  $seq2=$this->input->post('mb001c');    //主鍵一筆
	      //  $seq4=$this->input->post('mb002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'mb001' => $seq2,
		          'mb002' => $seq4,
		          'mb003' => $mb003,
		          'mb004' => $mb004,
		          'mb005' => $mb005,
                  'mb007' => $mb007,
                  'mb008' => $mb008,
                  'mb009' => $mb009,
                  'mb010' => $mb010,
                  'mb011' => $mb011,
                  'mb012' => $mb012,
                  'mb013' => $mb013,
                  'mb014' => $mb014,
                  'mb015' => $mb015,
				  'mb016' => $mb016,
				  'mb017' => $mb017,
                  'mb018' => $mb018
                 			  
                    );
            $exist = $this->copi02_model->selone2($seq2,$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('copmb', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('mb001o');    //查詢一筆以上
	    $seq2=$this->input->post('mb001c'); 
	    $seq3=$this->input->post('mb002o');    
	    $seq4=$this->input->post('mb002c'); 
		 
	    $sql1 = " SELECT a.mb002,b.mb002 as mb002disp,b.mb003 as mb002disp1, a.mb003, a.mb001, c.ma002 as mb001disp,a.mb008,a.mb003, a.mb017, a.create_date "; 
		$sql2 = " FROM copmb as a LEFT JOIN invmb as b ON  a.mb002=b.mb001 LEFT JOIN copma as c ON a.mb001=c.ma001 "; 
		$sql3 = " WHERE a.mb001 >= '$seq1'  AND a.mb001 <= '$seq2' AND  a.mb002 >= '$seq3'  AND a.mb002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('mb001o');    //查詢一筆以上
	    $seq2=$this->input->post('mb001c'); 
	    $seq3=$this->input->post('mb002o');    
	    $seq4=$this->input->post('mb002c'); 
		 
	    $sql1 = " SELECT a.mb001,a.mb004,b.mb002 as mb002disp,b.mb003 as mb002disp1,a.mb009,  a.mb002, c.ma002 as mb001disp,a.mb003, a.mb008, a.mb017, a.create_date "; 
		$sql2 = " FROM copmb as a LEFT JOIN invmb as b ON  a.mb002=b.mb001 LEFT JOIN copma as c ON a.mb001=c.ma001 "; 
		$sql3 = " WHERE a.mb001 >= '$seq1'  AND a.mb001 <= '$seq2' AND  a.mb002 >= '$seq3'  AND a.mb002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mb001 >= '$seq1'  AND mb001 <= '$seq2' AND  mb002 >= '$seq3'  AND mb002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('copmb')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	           if ($this->input->post('mb009')> '0') {$mb009 =substr($this->input->post('mb009'),0,4).substr($this->input->post('mb009'),5,2).substr(rtrim($this->input->post('mb009')),8,2);}
           else {$mb009='';}
		   if ($this->input->post('mb010')> '0') {$mb010 =substr($this->input->post('mb010'),0,4).substr($this->input->post('mb010'),5,2).substr(rtrim($this->input->post('mb010')),8,2);}
           else {$mb010='';}
		   if ($this->input->post('mb014')> '0') {$mb014 =substr($this->input->post('mb014'),0,4).substr($this->input->post('mb014'),5,2).substr(rtrim($this->input->post('mb014')),8,2);}
           else {$mb014='';}
		   if ($this->input->post('mb017')> '0') {$mb017 =substr($this->input->post('mb017'),0,4).substr($this->input->post('mb017'),5,2).substr(rtrim($this->input->post('mb017')),8,2);}
           else {$mb017='';}
		   if ($this->input->post('mb018')> '0') {$mb018 =substr($this->input->post('mb018'),0,4).substr($this->input->post('mb018'),5,2).substr(rtrim($this->input->post('mb018')),8,2);}
           else {$mb018='';} 			  
		   $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				 
		          'mb004' => $this->input->post('cmsq06a'),
		         
		          'mb005' => $this->input->post('mb005'),		        
                  'mb007' => $this->input->post('mb007'),
				  'mb008' => $this->input->post('mb008'),
				  'mb009' => $mb009,
				  'mb010' =>  $mb010,
				  'mb011' => $this->input->post('mb011'),
				  'mb012' => $this->input->post('mb012'),
				  'mb013' => $this->input->post('mb013'),
				  'mb014' =>  $mb014,
				  'mb015' => $this->input->post('mb015'),
				  'mb016' => $this->input->post('mb016'),
				  'mb017' =>  $mb017,
				  'mb018' =>  $mb018      
                        );
			
            $this->db->where('mb001', $this->input->post('copq01a'));
	        $this->db->where('mb002', $this->input->post('invq02a'));
			$this->db->where('mb003', $this->input->post('mb003'));
            $this->db->update('copmb',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
          }
		  
	//刪除一筆	
	function deletef($seg1,$seg2)      
       {  
	    $seg1=$this->uri->segment(4);
	    $this->db->where('mb001', $seg1);
        $this->db->delete('copmb'); 
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
		      list($seq1,$seq2) = explode("/", $seq[$x]);
		      $seq1;
		      $seq2;
			  $this->db->where('mb002', $seq1);
			  $this->db->where('mb001', $seq2);
              $this->db->delete('copmb'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	   
	   	function filer_search($limit, $offset, $sort_by, $sort_order, $tc004, $like){//歷史查價
		//先取有其產品的主單 //檢查排序欄位是否在 table 內幣別,付款條件,課稅別,業務員,收款業務
		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('a.mb001','a.mb002','b.mb002','b.mb003','a.mb003','a.mb004','a.mb008','a.mb010');
		//if($sort_by == "a.mb003" ){$like = mb_convert_encoding($like, 'UTF-8', 'HTML-ENTITIES'); var_dump("tran");}
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.mb001';  //檢查排序欄位是否在 table 內幣別,付款條件,課稅別,業務員,收款業務
	    $query = $this->db->select('a.mb002 as a_mb002,b.mb002 as b_mb002,b.mb003 as b_mb003,a.mb003 as a_mb003,a.mb004 as a_mb004,a.mb008 as a_mb008,a.mb010 as a_mb010')
	                    ->from('invmb as b')
						->join('copmb as a', 'a.mb002 = b.mb001 ','left')
		                ->order_by($sort_by, $sort_order)
		                ->limit($limit, $offset)
						->where('a.mb001',$tc004)
						->like($sort_by,$like);
	    $ret['rows'] = $query->get()->result();
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                    ->from('invmb as b')
						->join('copmb as a', 'a.mb002 = b.mb001 ','left')
		                ->order_by($sort_by, $sort_order)
		                ->limit($limit, $offset)
						->where('a.mb001',$tc004)
						->like($sort_by,$like);

	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		
	    return $ret;
	}
	 /*==以下AJAX處理區域==*/
	 function ajaxcopi02($seg1)    //ajax 查詢一筆 顯示用 部門6
          { 	              
	    $this->db->set('mb001', $this->uri->segment(4));
	    $this->db->where('mb001', $this->uri->segment(4));	
	    $query = $this->db->get('copmb');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->mb002;
            }
		   return $result;   
		 }
	  }
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword){     
      $this->db->select('a.mb002 as a_mb002,b.mb002 as b_mb002,b.mb003 as b_mb003,a.mb003 as a_mb003,a.mb004 as a_mb004,a.mb008 as a_mb008,a.mb010 as a_mb010 ');
	  $this->db->from('copmb as a');  
	  $this->db->join('invmb as b', 'a.mb002 = b.mb001 ','left'); 
	  $this->db->join('copma as c', 'a.mb001 = c.ma001 ','left'); 
      $this->db->like('a.mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('a.mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookup2($keyword){  
      $me001=urldecode(urldecode($this->uri->segment(4)));	
     $this->db->select('a.mb002 as a_mb002,b.mb002 as b_mb002,b.mb003 as b_mb003,a.mb003 as a_mb003,a.mb004 as a_mb004,a.mb008 as a_mb008,a.mb010 as a_mb010 ');
	  $this->db->from('copmb as a');  
	  $this->db->join('invmb as b', 'a.mb002 = b.mb001 ','left'); 
	  $this->db->join('copma as c', 'a.mb001 = c.ma001 ','left');   
      $this->db->where('a.mb002',$me001);
      $query = $this->db->get(); 
      return $query->result();
    }  	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>