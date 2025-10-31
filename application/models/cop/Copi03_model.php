<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copi03_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006,mq034, create_date');
        $this->db->from('cmsmq');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mq001 desc, mq002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('cmsmq');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','mq034','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006,mq034, create_date')
	                      ->from('cmsmq')
						  ->like('mq003','2','after')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmq')
						  ->like('mq003','2','after');
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
	function construct_sql($limit=15 , $offset=0 , $func = "")
	{
		$this->session->set_userdata('copi03_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where")   
		    { unset($_SESSION['copi03']['search']);}
		
        if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['copi03']['search']);}

		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mq001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['copi03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['copi03']['search']['where'];
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
				if($value != ""){$value .= " or ";}
				$value .= $val." like '".$val_ary[$key]."%' ";
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
		
		if(isset($_SESSION['copi03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['copi03']['search']['order'];
		}
		
		if(!isset($_SESSION['copi03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		
		$query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
			->from('cmsmq')
			->where('mq003','22')
		    ->order_by($order); 
			
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
			->from('cmsmq')
			->where('mq003','22')
			->order_by($order);
		//	->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['copi03']['search']['sql'] = $this->db->last_query();
		//echo var_dump($this->db->last_query());exit;
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsmq')
			->where('mq003','22');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['copi03']['search']['where'] = $where;
		$_SESSION['copi03']['search']['order'] = $order;
		$_SESSION['copi03']['search']['offset'] = $offset;
		
		return $ret;
	}
	//建構SQL字串 - 報價單
	function construct_sqla($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('copi03_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where")   
		    { unset($_SESSION['copi03']['search']);}
		
        if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['copi03']['search']);}

		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mq001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['copi03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['copi03']['search']['where'];
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
				if($value != ""){$value .= " or ";}
				$value .= $val." like '".$val_ary[$key]."%' ";
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
		
		if(isset($_SESSION['copi03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['copi03']['search']['order'];
		}
		
		if(!isset($_SESSION['copi03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
			->from('cmsmq')
			->where('mq003','21')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
			->from('cmsmq')
			->where('mq003','21')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['copi03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsmq')
			->where('mq003','21');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['copi03']['search']['where'] = $where;
		$_SESSION['copi03']['search']['order'] = $order;
		$_SESSION['copi03']['search']['offset'] = $offset;
		
		return $ret;
	}
	//建構SQL字串 - 銷貨單
	function construct_sqlb($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('copi03_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where")   
		    { unset($_SESSION['copi03']['search']);}
		
         if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['copi03']['search']);}

		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mq001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['copi03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['copi03']['search']['where'];
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
				if($value != ""){$value .= " or ";}
				$value .= $val." like '".$val_ary[$key]."%' ";
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
		
		if(isset($_SESSION['copi03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['copi03']['search']['order'];
		}
		
		if(!isset($_SESSION['copi03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
			->from('cmsmq')
			->where('mq003','23')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
			->from('cmsmq')
			->where('mq003','23')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['copi03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsmq')
			->where('mq003','23');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['copi03']['search']['where'] = $where;
		$_SESSION['copi03']['search']['order'] = $order;
		$_SESSION['copi03']['search']['offset'] = $offset;
		
		return $ret;
	}
	//建構SQL字串 - 銷退單
	function construct_sqlc($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('copi03_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where")   
		    { unset($_SESSION['copi03']['search']);}
		
        if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['copi03']['search']);}

		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;} }
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mq001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['copi03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['copi03']['search']['where'];
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
				if($value != ""){$value .= " or ";}
				$value .= $val." like '".$val_ary[$key]."%' ";
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
		
		if(isset($_SESSION['copi03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['copi03']['search']['order'];
		}
		
		if(!isset($_SESSION['copi03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
			->from('cmsmq')
			->where('mq003','24')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006, create_date')
			->from('cmsmq')
			->where('mq003','24')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['copi03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsmq')
			->where('mq003','24');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['copi03']['search']['where'] = $where;
		$_SESSION['copi03']['search']['order'] = $order;
		$_SESSION['copi03']['search']['offset'] = $offset;
		
		return $ret;
	}
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mq001', $this->uri->segment(4));
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
	//ajax 查詢一筆  結帳單別  
	function ajaxcopq03a61($seg1)    
        { 
	     // $this->db->set('ma002', $this->uri->segment(4));
	      $this->db->where('mq003', '61');
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
	 //ajax 查詢一筆  註記  
	function ajaxcmsq17a1($seg1)    
        { 
	     // $this->db->set('ma002', $this->uri->segment(4));
	      $this->db->where('ms001', '1');
          $this->db->where('ms002', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsms');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ms003;
              }
		   return $result;   
		   } 
	    }
	//ajax 查詢一筆  簽核  
	function ajaxcmsq17a2($seg1)    
        { 
	     // $this->db->set('ma002', $this->uri->segment(4));
	      $this->db->where('ms001', '2');
          $this->db->where('ms002', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsms');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ms003;
              }
		   return $result;   
		   } 
	    }	
		//ajax 查詢一筆  公司  
	function ajaxtaxq02a($seg1)    
        { 
	     // $this->db->set('ma002', $this->uri->segment(4));
	     
          $this->db->where('mb001', $this->uri->segment(4));		  
	      $query = $this->db->get('taxmb');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mb005;
              }
		   return $result;   
		   } 
	    }
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('cmsmq.*, cmsmq.mq001 as mq021disp , a.ms003 as mq025disp, b.ms003 as mq027disp, c.mb005 as mq023disp');	
		 $this->db->from('cmsmq');
	     //$this->db->set('mq001', $this->uri->segment(4)); 
	     $this->db->where('mq001', $this->uri->segment(4));
		 $this->db->join('cmsms as a' , 'cmsmq.mq025 = a.ms002 and a.ms001="1" ' ,'left');
		 $this->db->join('cmsms as b' , 'cmsmq.mq027 = b.ms002 and b.ms001="2" ' ,'left');
		 $this->db->join('taxmb as c' , 'cmsmq.mq023 = c.mb001 ' ,'left');
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `cmsmq` ";
	     $seq1 = " mq001, mq002, mq003, mq004, mq005, mq006,mq034, create_date FROM `cmsmq` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mq001 desc' ;
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
		if(@$_SESSION['copi03_sql_term']){$seq32 = $_SESSION['copi03_sql_term'];}
		if(@$_SESSION['copi03_sql_sort']){$seq33 = $_SESSION['copi03_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','mq034','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006,mq034, create_date')
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
	   
	//篩選多筆    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	   {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
        $sort_by = $this->uri->segment(4);			
        $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005','mq006', 'mq034','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
	    $this->db->select('mq001, mq002, mq003, mq004, mq005,mq006,mq034, create_date');
	    $this->db->from('cmsmq');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mq001 asc, mq002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsmq');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->set('mq001', $this->input->post('mq001')); 
	    $this->db->where('mq001', $this->input->post('mq001')); 
	    $query = $this->db->get('cmsmq');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		//  $smq005 = $this->input->post('mq005');
       //   if ($smq005 != 'Y') {
        //  $smq005 = 'N';
       //    }
		
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'mq001' => $this->input->post('mq001'),
		          'mq002' => $this->input->post('mq002'),
		          'mq003' => $this->input->post('mq003'),
		          'mq004' => $this->input->post('mq004'),
				  'mq005' => $this->input->post('mq005'),
		          'mq006' => $this->input->post('mq006'),
		          'mq007' => $this->input->post('mq007'),
		          'mq008' => $this->input->post('mq008'),
		          'mq009' => $this->input->post('mq009'),
		          'mq010' => $this->input->post('mq010'),
		          'mq011' => $this->input->post('mq011'),
		          'mq012' => $this->input->post('mq012'),
		          'mq013' => $this->input->post('mq013'),
		          'mq014' => $this->input->post('mq014'),
				  'mq015' => $this->input->post('mq015'),
		          'mq016' => $this->input->post('mq016'),
		          'mq017' => $this->input->post('mq017'),
		          'mq018' => $this->input->post('mq018'),
		          'mq019' => $this->input->post('mq019'),
		          'mq020' => $this->input->post('mq020'),
				  'mq021' => $this->input->post('copq03a61'),
		          'mq022' => $this->input->post('mq022'),
		          'mq023' => $this->input->post('taxq02a'),
		          'mq024' => $this->input->post('mq024'),
				  'mq025' => $this->input->post('cmsq17a1'),
		          'mq026' => $this->input->post('mq026'),
		          'mq027' => $this->input->post('cmsq17a2'),
		          'mq028' => $this->input->post('mq028'),
		          'mq029' => $this->input->post('mq029'),
		          'mq030' => $this->input->post('mq030'),
		          'mq031' => $this->input->post('mq031'),
		          'mq032' => $this->input->post('mq032'),
		          'mq033' => $this->input->post('mq033'),
		          'mq034' => $this->input->post('mq034'),
				  'mq035' => $this->input->post('mq035')
                      );
         
	    $exist = $this->copi03_model->selone1($this->input->post('mq001'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('cmsmq', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->set('mq001', $this->input->post('mq002c')); 
	    $this->db->where('mq001', $this->input->post('mq002c')); 
	    $query = $this->db->get('cmsmq');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mq001c');    
	    $seq2=$this->input->post('mq002c');
	    $this->db->where('mq001', $this->input->post('mq001c')); 
	    $query = $this->db->get('cmsmq');
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
                $mq010=$row->mq010;
                $mq011=$row->mq011;
				$mq012=$row->mq012;
				$mq013=$row->mq013;
                $mq014=$row->mq014;
                $mq015=$row->mq015;
                $mq016=$row->mq016; 
                $mq017=$row->mq017;
                $mq018=$row->mq018;
				$mq019=$row->mq019; 
                $mq020=$row->mq020;
                $mq021=$row->mq021;
				$mq022=$row->mq022;
				$mq023=$row->mq023;
                $mq024=$row->mq024;
                $mq025=$row->mq025;
                $mq026=$row->mq026; 
                $mq027=$row->mq027;
                $mq028=$row->mq028;
				$mq029=$row->mq029; 
                $mq030=$row->mq030;
				$mq031=$row->mq031;
				$mq032=$row->mq032;
				$mq033=$row->mq033;
                $mq034=$row->mq034;
                $mq035=$row->mq035;
				
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
		          'mq009' => $mq009,
		          'mq010' => $mq010,
		          'mq011' => $mq011,
		          'mq012' => $mq012,
		          'mq013' => $mq013,
		          'mq014' => $mq014,
		          'mq015' => $mq015,
		          'mq016' => $mq016,
                  'mq017' => $mq017,
		          'mq018' => $mq018,
		          'mq019' => $mq019,
		          'mq020' => $mq020,
		          'mq021' => $mq021, 	
		          'mq022' => $mq022,
		          'mq023' => $mq023,
		          'mq024' => $mq024,
		          'mq025' => $mq025,
		          'mq026' => $mq026,
                  'mq027' => $mq027,
		          'mq028' => $mq028,
		          'mq029' => $mq029,
		          'mq030' => $mq030,
		          'mq031' => $mq031, 
		          'mq032' => $mq032,
		          'mq033' => $mq033,
		          'mq034' => $mq034,
		          'mq035' => $mq035	  
                    );
            $exist = $this->copi03_model->selone2($this->input->post('mq002c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('cmsmq', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('mq001c');    //查詢一筆以上
	    $seq2=$this->input->post('mq002c');
	    $sql = " SELECT mq001,mq002,mq003,mq004,mq005,mq006,create_date FROM cmsmq WHERE mq001 >= '$seq1'  AND mq001 <= '$seq2' ORDER BY mq001 "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('mq001c');    //查詢一筆以上
	    $seq2=$this->input->post('mq002c'); 
	    $sql = " SELECT * FROM cmsmq WHERE mq001 >= '$seq1'  AND mq001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mq001 >= '$seq1'  AND mq001 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('cmsmq')
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
		          'mq009' => $this->input->post('mq009'),
		          'mq010' => $this->input->post('mq010'),
		          'mq011' => $this->input->post('mq011'),
		          'mq012' => $this->input->post('mq012'),
		          'mq013' => $this->input->post('mq013'),
		          'mq014' => $this->input->post('mq014'),
				  'mq015' => $this->input->post('mq015'),
		          'mq016' => $this->input->post('mq016'),
		          'mq017' => $this->input->post('mq017'),
		          'mq018' => $this->input->post('mq018'),
		          'mq019' => $this->input->post('mq019'),
		          'mq020' => $this->input->post('mq020'),
				  'mq021' => $this->input->post('copq03a61'),
		          'mq022' => $this->input->post('mq022'),
		          'mq023' => $this->input->post('taxq02a'),
		          'mq024' => $this->input->post('mq024'),
				  'mq025' => $this->input->post('cmsq17a1'),
		          'mq026' => $this->input->post('mq026'),
		          'mq027' => $this->input->post('cmsq17a2'),
		          'mq028' => $this->input->post('mq028'),
		          'mq029' => $this->input->post('mq029'),
		          'mq030' => $this->input->post('mq030'),
		          'mq031' => $this->input->post('mq031'),
		          'mq032' => $this->input->post('mq032'),
		          'mq033' => $this->input->post('mq033'),
		          'mq034' => $this->input->post('mq034'),
				  'mq035' => $this->input->post('mq035')
                        );
            $this->db->where('mq001', $this->input->post('mq001'));
	       
            $this->db->update('cmsmq',$data);                   //更改一筆
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
	    $this->db->where('mq001', $seg1);
        $this->db->delete('cmsmq'); 
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
		      //   $seq2;
			  $this->db->where('mq001', $seq1);
              $this->db->delete('cmsmq'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	/*==以下AJAX處理區域==*/
	 function ajaxcopi03($seg1)    //ajax 查詢一筆 顯示用 庫別6
          { 	              
	    $this->db->set('mq001', $this->uri->segment(4));
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
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword){     
      $this->db->select('mq001, mq002');
	  $this->db->from('cmsmq'); 
      $this->db->where('mq003', '22');	  
      $this->db->like('mq001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mq002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookup2($keyword){  
      $mq001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('mq001, mq002');
	  $this->db->from('cmsmq');  
	//  $this->db->where('mq003', '22');	  
      $this->db->where('mq001',$mq001);
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1a($keyword){     
      $this->db->select('mq001, mq002');
	  $this->db->from('cmsmq'); 
      $this->db->where('mq003', '21');	  
      $this->db->like('mq001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mq002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookup2a($keyword){  
      $mq001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('mq001, mq002');
	  $this->db->from('cmsmq');  
	  $this->db->where('mq003', '21');	  
      $this->db->where('mq001',$mq001);
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookup_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=10){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('cmsmq');
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
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>