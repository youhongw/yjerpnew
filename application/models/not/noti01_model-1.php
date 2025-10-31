<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noti01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ma001,ma006,ma004,ma011,ma002,ma012,ma003,ma005,ma007,ma015,ma008,ma016,ma014,ma013,ma009,ma010');
          $this->db->from('notma');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ma001 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('notma');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ma001', 'ma002', 'ma004', 'ma005', 'ma006', 'ma007', 'ma008','ma015');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ma001,ma006,ma004,ma011,ma002,ma012,ma003,ma005,ma007,ma015,ma008,ma016,ma014,ma013,ma009,ma010')
	                       ->from('notma')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('notma');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		//
	/***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('noti01_search',"display_search/".$offset);
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
		$default_order = "ma001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['noti01']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['noti01']['search']['where'];
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
		
		if(isset($_SESSION['noti01']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['noti01']['search']['order'];
		}
		
		if(!isset($_SESSION['noti01']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('ma001, ma002, ma003, ma004, create_date')
			->from('notma')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('ma001, ma002, ma003, ma004, create_date')
			->from('notma')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['noti01']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('notma');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['noti01']['search']['where'] = $where;
		$_SESSION['noti01']['search']['order'] = $order;
		$_SESSION['noti01']['search']['offset'] = $offset;
		
		return $ret;
	}
	//noti04銀行帳號
	function construct_sql2($limit = 15, $offset = 0, $func = "",$sma001)
	{
		$this->session->set_userdata('noti01_search',"display_search/".$offset);
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
		$default_order = "a.ma001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['noti01a']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['noti01a']['search']['where'];
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
		
		if(isset($_SESSION['noti01a']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['noti01a']['search']['order'];
		}
		
		if(!isset($_SESSION['noti01a']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.ma001, a.ma002,a.ma004, b.ma046, a.create_date, b.ma001 as copi01')
			->from('notma as a')
			->join('copma as b','a.ma001 = b.ma046','left')
			->order_by($order);
		// $query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.ma001, a.ma002,a.ma004, b.ma046, a.create_date , b.ma001 as copi01')
			->from('notma as a')
			->join('copma as b','a.ma001 = b.ma046','left')
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['noti01']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('notma as a')
			->join('copma as b','a.ma001 = b.ma046','left');
		$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['noti01a']['search']['where'] = $where;
		$_SESSION['noti01a']['search']['order'] = $order;
		$_SESSION['noti01a']['search']['offset'] = $offset;
		
		return $ret;
	}
	
		//noti04銀行帳號(託收)
	function construct_sql3($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('noti01_search',"display_search/".$offset);
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
		$default_order = "ma001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['noti01b']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['noti01b']['search']['where'];
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
		
		if(isset($_SESSION['noti01b']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['noti01b']['search']['order'];
		}
		
		if(!isset($_SESSION['noti01b']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('ma001,ma002,ma004,create_date')
			->from('notma as a')
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('ma001,ma002,ma004,create_date')
			->from('notma')
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['noti01b']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('notma');
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['noti01b']['search']['where'] = $where;
		$_SESSION['noti01b']['search']['order'] = $order;
		$_SESSION['noti01b']['search']['offset'] = $offset;
		
		return $ret;
	}
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003,c.ma003 as ma003_n');
        $this->db->from('notma as a');
        $this->db->join('notmb as b', 'a.ma001 = b.mb001 ','left');
        $this->db->join('actma as c', 'a.ma005 = c.ma001 ','left');
		$this->db->where('a.ma001', $this->uri->segment(4)); 
	 //   $this->db->where('a.ma002', $this->uri->segment(5)); 
		$this->db->order_by('ma001 , b.mb002');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('invmb');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
		
	//ajax 查詢 顯示 請購單別 mb001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '31');
          $this->db->where('mq001', $this->uri->segment(4));		  
	      $query = $this->db->get('notmq');
			
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
	function ajaxnotq05a($seg1)    
        {
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('notme');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ma002;
              }
		   return $result;   
		  }
	    }
		
	//ajax 查詢顯示用 廠別 ma010  
	function ajaxnotq02a($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('notmb');
			
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
		
	//ajax 查詢 顯示用 請購人員  
	function ajaxpalq01a($seg1)    
        { 	              
	      $this->db->set('mv001', $this->uri->segment(4));
		  $this->db->where('mv022', '');
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('notmv');
			
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
	      $this->db->select_max('ma002');
		  $this->db->where('ma001', $this->uri->segment(4));
	      $this->db->where('ma013', $this->uri->segment(5));
		  $query = $this->db->get('notma');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ma002;
              }
		      return $result;   
		     }
	      }
		  
	//ajax 查詢 顯示用 明細 品號	
	function ajaxinvq02a4($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('invmb');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mb001;
              }
		   return $result;   
		   }
	    }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `notma` ";
	      $seq1 = "ma001,ma006,ma004,ma011,ma002,ma012,ma003,ma005,ma007,ma015,ma008,ma016,ma014,ma013,ma009,ma010 FROM `notma` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'ma001 desc' ;
          $seq9 = " ORDER BY ma001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="ma001 ";

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
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ma001', 'ma006', 'ma004', 'ma002', 'ma003', 'ma005', 'ma006', 'ma007', 'ma008', 'ma009');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ma001,ma006,ma004,ma011,ma002,ma012,ma003,ma005,ma007,ma015,ma008,ma016,ma014,ma013,ma009,ma010')
	                       ->from('notma')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('notma')
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
	      $sort_columns = array('ma001', 'ma006', 'ma004', 'ma002', 'ma003', 'ma005', 'ma006', 'ma007', 'ma008', 'ma009');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
	      $this->db->select('ma001,ma006,ma004,ma011,ma002,ma012,ma003,ma005,ma007,ma015,ma008,ma016,ma014,ma013,ma009,ma010');
	      $this->db->from('notma');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ma001 asc, ma002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('notma');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ma001', $this->input->post('ma001'));
		//  $this->db->where('ma002', $this->input->post('ma002'));
	      $query = $this->db->get('notma');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2)    
        {
	      $this->db->where('mb002', $seg1);
	      $this->db->where('mb001', $seg2);
	      $query = $this->db->get('notmb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  notma	
	function insertf()    //新增一筆 檔頭  notma
        {
	     $data = array( 
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' =>date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'ma001' => $this->input->post('ma001'),
			'ma002' => $this->input->post('ma002'),
			'ma003' => $this->input->post('ma003'),
			'ma004' => $this->input->post('ma004'),
			'ma005' => $this->input->post('ma005'),
			'ma006' => $this->input->post('ma006'),
			'ma007' => $this->input->post('ma007'),
			'ma005' => $this->input->post('ma005'),
			'ma006' => $this->input->post('ma006'),
			'ma007' => $this->input->post('ma007'),
			'ma008' => $this->input->post('ma008'),
			'ma009' => $this->input->post('ma009'),
			'ma010' => $this->input->post('ma010'),
			'ma011' => $this->input->post('ma011'),
			'ma012' => $this->input->post('ma012'),
			'ma013' => $this->input->post('ma013'),
			'ma014' => $this->input->post('ma014'),
			'ma015' => $this->input->post('ma015'),
			'ma016' => $this->input->post('ma016')
		);
         
	      $exist = $this->noti01_model->selone1($this->input->post('ma001'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('notma', $data);
			
		// 新增明細 notmb
			
			    $n = '0';
			
			   while (isset($_POST['order_product'][  $n  ]['mb002'])) {
		//	while (($_POST['order_product'][  $n  ]['mb002']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['mb002']) {
			  if  ( $_POST['order_product'][ $n  ]['mb002'] || $_POST['order_product'][ $n  ]['mb003'] ){
			  $seg2=$this->input->post('ma001');
			  
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mb001' => $this->input->post('ma001'),
		         'mb002' => $_POST['order_product'][ $n  ]['mb002'],
		         'mb003' => $_POST['order_product'][ $n  ]['mb003'],
                );   
						 
	      $exist = $this->noti01_model->selone1d($_POST['order_product'][ $n  ]['mb002'],$seg2);
		   if ($exist) { return 'exist'; } else {$this->db->insert('notmb', $data_array);} 
		  
		 // $this->db->insert('notmb', $data_array);
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			}
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1)    
        { 
	      $this->db->where('ma001', $this->input->post('ma001c')); 
         // $this->db->where('ma002', $this->input->post('ma002c'));
	      $query = $this->db->get('notma');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('ma001', $this->input->post('ma001o'));
		//	$this->db->where('ma002', $this->input->post('ma002o'));
	        $query = $this->db->get('notma');
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
                $ma002=$row->ma002;$ma003=$row->ma003;$ma004=$row->ma004;$ma005=$row->ma005;$ma006=$row->ma006;$ma007=$row->ma007;$ma008=$row->ma008;$ma009=$row->ma009;$ma010=$row->ma010;
				$ma011=$row->ma011;$ma012=$row->ma012;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ma001c');    //主鍵一筆檔頭notma
		//	$seq2=$this->input->post('ma002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ma001' => $seq1,'ma002' => $ma002,'ma003' => $ma003,'ma004' => $ma004,'ma005' => $ma005,'ma006' => $ma006,'ma007' => $ma007,'ma008' => $ma008
				   ,'ma009' => $ma009,'ma010' => $ma010,'ma011' => $ma011,'ma012' => $ma012
                   );
				   
            $exist = $this->noti01_model->selone2($this->input->post('ma001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('notma', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('mb001', $this->input->post('ma001o'));
		//	$this->db->where('mb002', $this->input->post('ma002o'));
	        $query = $this->db->get('notmb');
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
                 $mb002[$i]=$row->mb002;$mb003[$i]=$row->mb003;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ma001c');    //主鍵一筆明細notmb
		//	$seq2=$this->input->post('ma002c'); 
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
                'mb001' => $seq1,'mb002' => $mb002[$i],'mb003' => $mb003[$i]
                ); 
				
             $this->db->insert('notmb', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ma001o');    
	      $seq2=$this->input->post('ma001c');
		//  $seq3=$this->input->post('ma002o');    
	    //  $seq4=$this->input->post('ma002c');
	      $sql = "SELECT a.ma001,a.ma006,a.ma004,a.ma002,ma005,a.ma007,a.ma008,a.ma012 FROM notma as a WHERE a.ma001 >= '$seq1'  AND a.ma001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('ma001o');    
	      $seq2=$this->input->post('ma001c');
		//  $seq3=$this->input->post('ma002o');    
	   //   $seq4=$this->input->post('ma002c');
	      $sql = " SELECT * FROM notma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ma001 >= '$seq1'  AND ma001 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('notma')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006');
		 
        $this->db->from('notma as a');	
        $this->db->join('notmb as b', 'a.ma001 = b.mb001   ','left');
		$this->db->where('a.ma001', $this->uri->segment(4)); 
	  
		$this->db->order_by('a.ma001 , b.mb002');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mb001', $this->uri->segment(4));
		//$this->db->where('mb002', $this->uri->segment(5));
	    $query = $this->db->get('notmb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS ma001disp, d.ma002 AS ma004disp, e.mb002 AS ma010disp, f.mv002 AS ma012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006, b.mb007, b.mb011, b.mb009, b.mb017, b.mb018, b.mb012');
		 
        $this->db->from('notma as a');	
        $this->db->join('notmb as b', 'a.ma001 = b.mb001  and a.ma002=b.mb002 ','left');		
		$this->db->join('notmq as c', 'a.ma001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('notme as d', 'a.ma004 = d.ma001 ','left');
	    $this->db->join('notmb as e', 'a.ma010 = e.mb001 ','left');
		$this->db->join('notmv as f ', 'a.ma012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ma001', $this->input->post('ma001o')); 
	    $this->db->where('a.ma002', $this->input->post('ma002o')); 
		$this->db->order_by('ma001 , ma002 ,b.mb003');
		
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
          $this->db->select('a.* ,c.mq002 AS ma001disp, d.ma002 AS ma004disp, e.mb002 AS ma010disp, f.mv002 AS ma012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006, b.mb007, b.mb011, b.mb009, b.mb017, b.mb018, b.mb012');
		 
        $this->db->from('notma as a');	
        $this->db->join('notmb as b', 'a.ma001 = b.mb001  and a.ma002=b.mb002 ','left');		
		$this->db->join('notmq as c', 'a.ma001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('notme as d', 'a.ma004 = d.ma001 ','left');
	    $this->db->join('notmb as e', 'a.ma010 = e.mb001 ','left');
		$this->db->join('notmv as f ', 'a.ma012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ma001', $this->uri->segment(4)); 
	    $this->db->where('a.ma002', $this->uri->segment(5)); 
		$this->db->order_by('ma001 , ma002 ,b.mb003');
		
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
		        'ma001' => $this->input->post('ma001'),
				'ma002' => $this->input->post('ma002'),
				'ma003' => $this->input->post('ma003'),
				'ma004' => $this->input->post('ma004'),
				'ma005' => $this->input->post('ma005'),
				'ma006' => $this->input->post('ma006'),
				'ma007' => $this->input->post('ma007'),
				'ma005' => $this->input->post('ma005'),
				'ma006' => $this->input->post('ma006'),
				'ma007' => $this->input->post('ma007'),
				'ma008' => $this->input->post('ma008'),
				'ma009' => $this->input->post('ma009'),
				'ma010' => $this->input->post('ma010'),
				'ma011' => $this->input->post('ma011'),
				'ma012' => $this->input->post('ma012'),
				'ma013' => $this->input->post('ma013'),
				'ma014' => $this->input->post('ma014'),
				'ma015' => $this->input->post('ma015'),
				'ma016' => $this->input->post('ma016')
                );
            $this->db->where('ma001', $this->input->post('ma001'));
		//	$this->db->where('ma002', $this->input->post('ma002'));
            $this->db->update('notma',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('mb001', $this->input->post('ma001'));
            $this->db->delete('notmb'); 
			
			$this->db->flush_cache();  
			// 新增明細 notmb
			
			    $n = '0';		
			//	$mb003='1000';
		//	while ($_POST['order_product'][  $n  ]['mb002']) {
			while (isset($_POST['order_product'][  $n  ]['mb002'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mb001' => $this->input->post('ma001'),
		         'mb002' => $_POST['order_product'][ $n  ]['mb002'],
		         'mb003' => $_POST['order_product'][ $n  ]['mb003'],
                );  
		     $this->db->insert('notmb', $data_array);
			// $mmb003 = (int) $mb003+10;
			// $mb003 =  (string)$mmb003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '10';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 while ($_POST['order_product'][  $n  ]['mb002']) {
				if( $_POST['order_product'][ $n  ]['mb002'] || $_POST['order_product'][ $n  ]['mb003'] ){
					  $data_array = array( 
						 'company' => $this->session->userdata('syscompany'),
						 'creator' => $this->session->userdata('manager'),
						 'usr_group' => 'A100',
						 'create_date' =>date("Ymd"),
						 'modifier' => $this->session->userdata('manager'),
						 'modi_date' => date("Ymd"),
						 'flag' => 1,
						 'mb001' => $this->input->post('ma001'),
						 'mb002' => $_POST['order_product'][ $n  ]['mb002'],
						 'mb003' => $_POST['order_product'][ $n  ]['mb003']
						);
					$seg2=$this->input->post('ma001');
					$exist = $this->noti01_model->selone1d($_POST['order_product'][ $n  ]['mb002'],$seg2);
					if ($exist) { return 'exist'; } else {$this->db->insert('notmb', $data_array);} 
					$this->db->insert('notmb', $data_array);
				//	$mmb003 = (int) $mb003+10;
				//	$mb003 =  (string)$mmb003;
					$num =  (int)$n + 1;
					$n =  (string)$num;
				}
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ma001', $this->uri->segment(4));
	//	  $this->db->where('ma002', $this->uri->segment(5));
          $this->db->delete('notma'); 
		  $this->db->where('mb001', $this->uri->segment(4));
		//  $this->db->where('mb002', $this->uri->segment(5));
          $this->db->delete('notmb'); 
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
			      $this->db->where('ma001', $seq1);
			   //   $this->db->where('ma002', $seq2);
                  $this->db->delete('notma'); 
				  $this->db->where('mb001', $seq1);
			    //  $this->db->where('mb002', $seq2);
                  $this->db->delete('notmb'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword){     
      $this->db->select('ma001, ma002,ma004,ma006');
	  $this->db->from('notma');  
      $this->db->like('ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ma002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookup2($keyword){  
      $ma001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('ma001, ma002,ma004');
	  $this->db->from('notma');  
      $this->db->where('ma001',$ma001);
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//noti04.php (託收->noti01a下拉視窗)
	function lookup3($keyword,$smb002){     
      $this->db->select('a.ma001, a.ma002,a.ma004,b.ma046,b.ma001');
	  $this->db->from('notma as a');  
	  $this->db->join('copma as b','a.ma001 = b.ma046','left');  
      $this->db->like('a.ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('a.ma002',urldecode(urldecode($this->uri->segment(4))), 'after');
	  $this->db->where('b.ma001',$smb002);
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  
	
	//noti04.php
	function lookup4($keyword){  
      $ma001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('ma001, ma002, ma004');
	  $this->db->from('notma');  
      $this->db->where('ma001',$ma001);
	 // echo "<pre>";var_dump($this->db);exit;
      $query = $this->db->get(); 
      return $query->result();
    }  		
	
	//noti04.php  (託收->check_noti01a)
	function lookup5($keyword,$smb002){     
      $this->db->select('a.ma001, a.ma002,a.ma004,b.ma046,b.ma001');
	  $this->db->from('notma as a');  
	  $this->db->join('copma as b','a.ma001 = b.ma046','left');  
	  $this->db->where('b.ma001',$smb002);
	  $this->db->where('a.ma001',$keyword);
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  
	
	function lookupd_body($keyword){     
		$this->db->select('*');
		$this->db->from('notma');
		$this->db->where('ma001',urldecode(urldecode($this->uri->segment(4))));
		$query = $this->db->get(); 
		return $query->result();
    }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>