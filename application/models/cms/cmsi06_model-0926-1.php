<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cmsi06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mf001, mf002, mf003, mf004, mf005, mf006,mf008,mf010,mf011,mf013, create_date');
          $this->db->from('cmsmf');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mf001 desc, mf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cmsmf');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mf001', 'mf002', 'mf003', 'mf004', 'mf005', 'mf006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mf001, mf002, mf003, mf004, mf005, mf006,create_date')
	                       ->from('cmsmf')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmf');
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
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('cmsi06_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mf001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['cmsi06']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['cmsi06']['search']['where'];
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
				$value .= $val." like '%".$val_ary[$key]."%' ";
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
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
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
		
		if(isset($_SESSION['cmsi06']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['cmsi06']['search']['order'];
		}
		
		if(!isset($_SESSION['cmsi06']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mf001, mf002, mf003, mf004, create_date')
			->from('cmsmf')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mf001, mf002, mf003, mf004, create_date')
			->from('cmsmf')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['cmsi06']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsmf');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['cmsi06']['search']['where'] = $where;
		$_SESSION['cmsi06']['search']['order'] = $order;
		$_SESSION['cmsi06']['search']['offset'] = $offset;
		
		return $ret;
	}	
	//建構SQL字串
	function construct_sql2($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('cmsi06_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mg002 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['cmsi06a']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['cmsi06a']['search']['where'];
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
				$value .= $val." like '%".$val_ary[$key]."%' ";
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
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
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
		
		if(isset($_SESSION['cmsi06a']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['cmsi06a']['search']['order'];
		}
		
		if(!isset($_SESSION['cmsi06a']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mg001, mg002,mg003, create_date')
			->from('cmsmg')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mg001,mg002,mg003, create_date')
			->from('cmsmg')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['cmsi06a']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsmg');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['cmsi06a']['search']['where'] = $where;
		$_SESSION['cmsi06a']['search']['order'] = $order;
		$_SESSION['cmsi06a']['search']['offset'] = $offset;
		
		return $ret;
	}	
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mg001, b.mg002, b.mg003, b.mg004, b.mg005,
		  b.mg006');
		 
        $this->db->from('cmsmf as a');	
        $this->db->join('cmsmg as b', 'a.mf001 = b.mg001   ','left');		
			
		$this->db->where('a.mf001', $this->uri->segment(4)); 
	 //   $this->db->where('a.mf002', $this->uri->segment(5)); 
		$this->db->order_by('mf001 , b.mg002');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mf001, mf002, mf003,mf004')->from('invmb');  
      $this->db->like('mf001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mf002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
		
	//ajax 查詢 顯示 請購單別 mg001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '31');
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
		
	//ajax 查詢顯示用 請購部門	
	function ajaxcmsq05a($seg1)    
        {
	      $this->db->where('me001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsme');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->me002;
              }
		   return $result;   
		  }
	    }
		
	//ajax 查詢顯示用 廠別 mf010  
	function ajaxcmsq02a($seg1)    
        { 
	      $this->db->where('mf001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmf');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mf002;
              }
		    return $result;   
		   }
	    }
		
	//ajax 查詢 顯示用 請購人員  
	function ajaxpalq01a($seg1)    
        { 	              
	      $this->db->set('mv001', $this->uri->segment(4));
		  $this->db->where('mv022', '');
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmv');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mv002;
              }
		   return $result;   
		   }
	    }
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('mf002');
		  $this->db->where('mf001', $this->uri->segment(4));
	      $this->db->where('mf013', $this->uri->segment(5));
		  $query = $this->db->get('cmsmf');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mf002;
              }
		      return $result;   
		     }
	      }
		  
	//ajax 查詢 顯示用 明細 品號	
	function ajaxinvq02a4($seg1)    
        { 
	      $this->db->where('mf001', $this->uri->segment(4));	
	      $query = $this->db->get('invmb');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mf001;
              }
		   return $result;   
		   }
	    }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `cmsmf` ";
	      $seq1 = "mf001, mf002, mf003, mf004, mf005, mf006, create_date FROM `cmsmf` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mf001 desc' ;
          $seq9 = " ORDER BY mf001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="mf001 ";

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
	     $sort_columns = array('mf001', 'mf002', 'mf003', 'mf004', 'mf005', 'mf006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mf001, mf002, mf003, mf004, mf005, mf006,mf007, create_date')
	                       ->from('cmsmf')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmf')
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
	      $sort_columns = array('mf001', 'mf002', 'mf003', 'mf004', 'mf005', 'mf006','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否為 table
	      $this->db->select('mf001, mf002, mf003, mf004, mf005, mf006, create_date');
	      $this->db->from('cmsmf');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mf001 asc, mf002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cmsmf');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('mf001', $this->input->post('mf001'));
		//  $this->db->where('mf002', $this->input->post('mf002'));
	      $query = $this->db->get('cmsmf');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2)    
        {
	      $this->db->where('mg001', $this->input->post('mf001'));
		  $this->db->where('mg002', $seg2);
	      $query = $this->db->get('cmsmg');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  cmsmf	
	function insertf()    //新增一筆 檔頭  cmsmf
        {
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mf001' => $this->input->post('mf001'),
		         'mf002' => $this->input->post('mf002'),
		         'mf003' => $this->input->post('mf003'),
		         'mf004' => $this->input->post('mf004'),
		         'mf005' => $this->input->post('mf005'),
		         'mf006' => $this->input->post('mf006'),
                 'mf007' => $this->input->post('mf007')
                 
                );
         
	      $exist = $this->cmsi06_model->selone1($this->input->post('mf001'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('cmsmf', $data);
			
		// 新增明細 cmsmg
			
			    $n = '0';
			
			   while (isset($_POST['order_product'][  $n  ]['mg002'])) {
		//	while (($_POST['order_product'][  $n  ]['mg002']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['mg002']) {
			
			  if  ( $_POST['order_product'][ $n  ]['mg003']='' )  $_POST['order_product'][ $n  ]['mg003']= 0;
			  if  ( $_POST['order_product'][ $n  ]['mg004']='' )  $_POST['order_product'][ $n  ]['mg004']= 0;
			  if  ( $_POST['order_product'][ $n  ]['mg005']='' )  $_POST['order_product'][ $n  ]['mg005']= 0;
			  if  ( $_POST['order_product'][ $n  ]['mg006']='' )  $_POST['order_product'][ $n  ]['mg006']= 0;
			  $seg2=substr($_POST['order_product'][ $n  ]['mg002'],0,4).substr($_POST['order_product'][ $n ]['mg002'],5,2).substr($_POST['order_product'][ $n ]['mg002'],8,2);
			  
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mg001' => $this->input->post('mf001'),
		         'mg002' =>  substr($_POST['order_product'][ $n  ]['mg002'],0,4).substr($_POST['order_product'][ $n ]['mg002'],5,2).substr($_POST['order_product'][ $n ]['mg002'],8,2),
		         'mg003' =>  $_POST['order_product'][ $n  ]['mg003'],
		         'mg004' => $_POST['order_product'][ $n  ]['mg004'],
		         'mg005' => $_POST['order_product'][ $n  ]['mg005'],
		         'mg006' => $_POST['order_product'][ $n  ]['mg006']
                );   
						 
	      $exist = $this->cmsi06_model->selone1d($this->input->post('mf001'),$seg2);
		 //  if ($exist) { return 'exist'; } 
		    if (!$exist) {$this->db->insert('cmsmg', $data_array);}  
		  
		    //  $this->db->insert('cmsmg', $data_array); 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		//  if ($exist)
		//	{
          //   return 'exist';
		   // } 
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1)    
        { 
	      $this->db->where('mf001', $this->input->post('mf001c')); 
         // $this->db->where('mf002', $this->input->post('mf002c'));
	      $query = $this->db->get('cmsmf');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('mf001', $this->input->post('mf001o'));
		//	$this->db->where('mf002', $this->input->post('mf002o'));
	        $query = $this->db->get('cmsmf');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         		
         //   if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() == 1) 
		       {
			     $result = $query->result();
			     foreach($result as $row):
                $mf002=$row->mf002;$mf003=$row->mf003;$mf004=$row->mf004;$mf005=$row->mf005;$mf006=$row->mf006;$mf007=$row->mf007;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mf001c');    //主鍵一筆檔頭cmsmf
		//	$seq2=$this->input->post('mf002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mf001' => $seq1,'mf002' => $mf002,'mf003' => $mf003,'mf004' => $mf004,'mf005' => $mf005,'mf006' => $mf006,'mf007' => $mf007
                   );
				   
            $exist = $this->cmsi06_model->selone2($this->input->post('mf001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('cmsmf', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('mg001', $this->input->post('mf001o'));
		//	$this->db->where('mg002', $this->input->post('mf002o'));
	        $query = $this->db->get('cmsmg');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         
			    $num=$query->num_rows();
          //  if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() >= 1) 
		       {
			     $result = $query->result();
				 $i=0;
			     foreach($result as $row):
                 $mg002[$i]=$row->mg002;$mg003[$i]=$row->mg003;$mg004[$i]=$row->mg004;$mg005[$i]=$row->mg005;$mg006[$i]=$row->mg006;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('mf001c');    //主鍵一筆明細cmsmg
		//	$seq2=$this->input->post('mf002c'); 
              $i=0;
            while ($i<$num) {	
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                'mg001' => $seq1,'mg002' => $mg002[$i],'mg003' => $mg003[$i],'mg004' => $mg004[$i],'mg005' => $mg005[$i],'mg006' => $mg006[$i]
                ); 
				
             $this->db->insert('cmsmg', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mf001o');    
	      $seq2=$this->input->post('mf001c');
		//  $seq3=$this->input->post('mf002o');    
	    //  $seq4=$this->input->post('mf002c');
	      $sql = " SELECT mf001,mf002,mf003,mf004,mf005,mf006,create_date FROM cmsmf WHERE mf001 >= '$seq1'  AND mf001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('mf001o');    
	      $seq2=$this->input->post('mf001c');
		//  $seq3=$this->input->post('mf002o');    
	   //   $seq4=$this->input->post('mf002c');
	      $sql = " SELECT * FROM cmsmf WHERE mf001 >= '$seq1'  AND mf001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "mf001 >= '$seq1'  AND mf001 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('cmsmf')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mg001, b.mg002, b.mg003, b.mg004, b.mg005,
		  b.mg006');
		 
        $this->db->from('cmsmf as a');	
        $this->db->join('cmsmg as b', 'a.mf001 = b.mg001   ','left');
		$this->db->where('a.mf001', $this->uri->segment(4)); 
	  
		$this->db->order_by('mf001 , b.mg002');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mg001', $this->uri->segment(4));
		//$this->db->where('mg002', $this->uri->segment(5));
	    $query = $this->db->get('cmsmg');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS mf001disp, d.me002 AS mf004disp, e.mf002 AS mf010disp, f.mv002 AS mf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mg001, b.mg002, b.mg003, b.mg004, b.mg005,
		  b.mg006, b.mg007, b.mg011, b.mg009, b.mg017, b.mg018, b.mg012');
		 
        $this->db->from('cmsmf as a');	
        $this->db->join('cmsmg as b', 'a.mf001 = b.mg001  and a.mf002=b.mg002 ','left');		
		$this->db->join('cmsmq as c', 'a.mf001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mf004 = d.me001 ','left');
	    $this->db->join('cmsmf as e', 'a.mf010 = e.mf001 ','left');
		$this->db->join('cmsmv as f ', 'a.mf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mf001', $this->input->post('mf001o')); 
	    $this->db->where('a.mf002', $this->input->post('mf002o')); 
		$this->db->order_by('mf001 , mf002 ,b.mg003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  
	//印單據筆  
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS mf001disp, d.me002 AS mf004disp, e.mf002 AS mf010disp, f.mv002 AS mf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mg001, b.mg002, b.mg003, b.mg004, b.mg005,
		  b.mg006, b.mg007, b.mg011, b.mg009, b.mg017, b.mg018, b.mg012');
		 
        $this->db->from('cmsmf as a');	
        $this->db->join('cmsmg as b', 'a.mf001 = b.mg001  and a.mf002=b.mg002 ','left');		
		$this->db->join('cmsmq as c', 'a.mf001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mf004 = d.me001 ','left');
	    $this->db->join('cmsmf as e', 'a.mf010 = e.mf001 ','left');
		$this->db->join('cmsmv as f ', 'a.mf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mf001', $this->uri->segment(4)); 
	    $this->db->where('a.mf002', $this->uri->segment(5)); 
		$this->db->order_by('mf001 , mf002 ,b.mg003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }	    		
        }
		
	//更改一筆	
	function updatef()   
        {
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'mf002' => $this->input->post('mf002'),
				'mf003' => $this->input->post('mf003'),
			    'mf004' => $this->input->post('mf004'),
		        'mf005' => $this->input->post('mf005'),'mf006' => $this->input->post('mf006'),'mf007' => $this->input->post('mf007')
                );
            $this->db->where('mf001', $this->input->post('mf001'));
		//	$this->db->where('mf002', $this->input->post('mf002'));
            $this->db->update('cmsmf',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('mg001', $this->input->post('mf001'));
            $this->db->delete('cmsmg'); 
			
			$this->db->flush_cache();  
			// 新增明細 cmsmg
			
			    $n = '0';		
			//	$mg003='1000';
		//	while ($_POST['order_product'][  $n  ]['mg002']) {
				while (isset($_POST['order_product'][  $n  ]['mg002'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mg001' => $this->input->post('mf001'),
		         'mg002' => substr($_POST['order_product'][ $n  ]['mg002'],0,4).substr($_POST['order_product'][ $n ]['mg002'],5,2).substr($_POST['order_product'][ $n ]['mg002'],8,2),
		         'mg003' => $_POST['order_product'][ $n  ]['mg003'],
				 'mg004' => $_POST['order_product'][ $n  ]['mg004'],
		         'mg005' => $_POST['order_product'][ $n  ]['mg005'],
		         'mg006' => $_POST['order_product'][ $n  ]['mg006']
                ); 
             if ($_POST['order_product'][  $n  ]['mg002']>'0') {				
		     $this->db->insert('cmsmg', $data_array); }
			// $mmg003 = (int) $mg003+10;
			// $mg003 =  (string)$mmg003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 while ($_POST['order_product'][  $n  ]['mg004']) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mg001' => $this->input->post('mf001'),
		         'mg002' => substr($_POST['order_product'][ $n  ]['mg002'],0,4).substr($_POST['order_product'][ $n ]['mg002'],5,2).substr($_POST['order_product'][ $n ]['mg002'],8,2),
		         'mg003' => $_POST['order_product'][ $n  ]['mg003'],
				 'mg004' => $_POST['order_product'][ $n  ]['mg004'],
		         'mg005' => $_POST['order_product'][ $n  ]['mg005'],
		         'mg006' => $_POST['order_product'][ $n  ]['mg006']
                );   
			  if ($_POST['order_product'][  $n  ]['mg002']>'0') {	
			  $this->db->insert('cmsmg', $data_array); }
		//	$mmg003 = (int) $mg003+10;
		//	$mg003 =  (string)$mmg003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mf001', $this->uri->segment(4));
	//	  $this->db->where('mf002', $this->uri->segment(5));
          $this->db->delete('cmsmf'); 
		  $this->db->where('mg001', $this->uri->segment(4));
		//  $this->db->where('mg002', $this->uri->segment(5));
          $this->db->delete('cmsmg'); 
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
		    	      list($seq1) = explode("/", $seq[$x]);
		    	      $seq1;		    	      
			      $this->db->where('mf001', $seq1);
			   //   $this->db->where('mf002', $seq2);
                  $this->db->delete('cmsmf'); 
				  $this->db->where('mg001', $seq1);
			    //  $this->db->where('mg002', $seq2);
                  $this->db->delete('cmsmg'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	 function del_detail(){
		$this->db->where('mg001', $_POST['del_md001']);
		$this->db->where('mg002', $_POST['del_md002']);
		$this->db->delete('cmsmg');
	}
    /*==以下AJAX處理區域==*/
	 function ajaxcmsi03($seg1)    //ajax 查詢一筆 顯示用 廠別6
          { 	              
	    $this->db->set('mf001', $this->uri->segment(4));
	    $this->db->where('mf001', $this->uri->segment(4));	
	    $query = $this->db->get('cmsmf');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->mf002;
            }
		   return $result;   
		 }
	  }
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword){     
      $this->db->select('mf001, mf002');
	  $this->db->from('cmsmf');  
      $this->db->like('mf001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mf002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookup2($keyword){  
      $mf001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('mf001, mf002');
	  $this->db->from('cmsmf');  
      $this->db->where('mf001',$mf001);
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 廠別
	function lookup_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=10){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('cmsmf');
		foreach($search_col as $key => $val){
			if($key == "and"){
				$this->db->like($val,$keyword[$val],'after');
			}elseif($key == "or"){
				$this->db->or_like($val,$keyword[$val], 'after');
			}
		}
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
    }
   function check_rate($cmsi06){
		$this->db->select('mg001,mg002,mg003')
			->from('cmsmg')
			->where('mg001', $cmsi06)
			->order_by('mg002 desc')
			->limit(1);
		$query = $this->db->get();
		$result = $query->result();
       //  echo "<pre>";var_dump($result->mg003);exit;	
       // return $result[0]->mg003;	   
		if (!isset($result[0]->mg003)) {return $result[0]->mg003;} else {return 1;)
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>