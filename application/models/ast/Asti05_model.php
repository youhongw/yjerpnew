<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asti05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mf001, mf002, mf003, mf004, mf0011, mf0019,mf020, create_date');
          $this->db->from('astmf');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mf001 desc, mf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('astmf');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.mf001', 'a.mf002', 'a.mf003', 'a.mf004', 'a.mf011', 'a.mf019','a.mf030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*')
	                       ->from('astmf as a')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('astmf');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('asti05_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['asti05']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['asti05']['search']);}
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mf001 asc,mf002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti05']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti05']['search']['where'];
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
				$value .= $val." like '".$val_ary[$key]."%' ";  //%% 合部搜尋 先一個 like '%
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
		
		if(isset($_SESSION['asti05']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti05']['search']['order'];
		}
		
		if(!isset($_SESSION['asti05']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*')
	                       ->from('astmf as a')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*')
	                       ->from('astmf as a')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['asti05']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('astmf as a');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti05']['search']['where'] = $where;
		$_SESSION['asti05']['search']['order'] = $order;
		$_SESSION['asti05']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mf001"
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
		$_SESSION['asti05']['search']['view'] = $view_array;
		$_SESSION['asti05']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['asti05']['search']['view']);exit;
	}
	
	//資產資料科目(單身)
	function construct_sql_body($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('asti05_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mf001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti05_body']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti05_body']['search']['where'];
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
		
		if(isset($_SESSION['asti05_body']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti05_body']['search']['order'];
		}
		
		if(!isset($_SESSION['asti05_body']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('*')
			->from('astmg')
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('*')
			->from('astmg')
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['asti05_body']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('astmg');
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti05_body']['search']['where'] = $where;
		$_SESSION['asti05_body']['search']['order'] = $order;
		$_SESSION['asti05_body']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//部門代號(單身 用於asti08)
	function construct_sql_body_asti08($seg1,$limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('asti05_asti08_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mg001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti05_asti08_body']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti05_asti08_body']['search']['where'];
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
		
		if(isset($_SESSION['asti05_asti08_body']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti05_asti08_body']['search']['order'];
		}
		
		if(!isset($_SESSION['asti05_asti08_body']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp')
			->from('astmg as a')
			->join('cmsme as b','a.mg002 = b.me001','left')
			->join('cmsmv as c','a.mg003 = c.mv001','left')
			->where('mg001',$seg1)
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp')
			->from('astmg as a')
			->join('cmsme as b','a.mg002 = b.me001','left')
			->join('cmsmv as c','a.mg003 = c.mv001','left')
			->where('mg001',$seg1)
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['asti05_asti08_body']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('astmg')
			->where('mg001',$seg1);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti05_asti08_body']['search']['where'] = $where;
		$_SESSION['asti05_asti08_body']['search']['order'] = $order;
		$_SESSION['asti05_asti08_body']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//部門代號(單身 用於asti09)
	function construct_sql_body_asti09($seg1,$limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('asti05_asti09_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mg001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti05_asti09_body']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti05_asti09_body']['search']['where'];
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
		
		if(isset($_SESSION['asti05_asti09_body']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti05_asti09_body']['search']['order'];
		}
		
		if(!isset($_SESSION['asti05_asti09_body']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp')
			->from('astmg as a')
			->join('cmsme as b','a.mg002 = b.me001','left')
			->join('cmsmv as c','a.mg003 = c.mv001','left')
			->where('mg001',$seg1)
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp')
			->from('astmg as a')
			->join('cmsme as b','a.mg002 = b.me001','left')
			->join('cmsmv as c','a.mg003 = c.mv001','left')
			->where('mg001',$seg1)
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['asti05_asti09_body']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('astmg')
			->where('mg001',$seg1);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti05_asti09_body']['search']['where'] = $where;
		$_SESSION['asti05_asti09_body']['search']['order'] = $order;
		$_SESSION['asti05_asti09_body']['search']['offset'] = $offset;
		
		return $ret;
	}
	//部門代號(單身 用於asti10)
	function construct_sql_body_asti10($seg1,$limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('asti05_asti10_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mg001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti05_asti10_body']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti05_asti10_body']['search']['where'];
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
		
		if(isset($_SESSION['asti05_asti10_body']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti05_asti10_body']['search']['order'];
		}
		
		if(!isset($_SESSION['asti05_asti10_body']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp')
			->from('astmg as a')
			->join('cmsme as b','a.mg002 = b.me001','left')
			->join('cmsmv as c','a.mg003 = c.mv001','left')
			->where('mg001',$seg1)
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp')
			->from('astmg as a')
			->join('cmsme as b','a.mg002 = b.me001','left')
			->join('cmsmv as c','a.mg003 = c.mv001','left')
			->where('mg001',$seg1)
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['asti05_asti10_body']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('astmg')
			->where('mg001',$seg1);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti05_asti10_body']['search']['where'] = $where;
		$_SESSION['asti05_asti10_body']['search']['order'] = $order;
		$_SESSION['asti05_asti10_body']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	
	function construct_sql_body_asti13($seg1,$limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('asti05_asti13_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mg001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti05_asti13_body']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti05_asti13_body']['search']['where'];
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
		
		if(isset($_SESSION['asti05_asti13_body']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti05_asti13_body']['search']['order'];
		}
		
		if(!isset($_SESSION['asti05_asti13_body']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp')
			->from('astmg as a')
			->join('cmsme as b','a.mg002 = b.me001','left')
			->join('cmsmv as c','a.mg003 = c.mv001','left')
			->where('mg001',$seg1)
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp')
			->from('astmg as a')
			->join('cmsme as b','a.mg002 = b.me001','left')
			->join('cmsmv as c','a.mg003 = c.mv001','left')
			->where('mg001',$seg1)
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['asti05_asti13_body']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('astmg')
			->where('mg001',$seg1);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti05_asti13_body']['search']['where'] = $where;
		$_SESSION['asti05_asti13_body']['search']['order'] = $order;
		$_SESSION['asti05_asti13_body']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	function construct_sql_body_asti14($seg1,$seg2,$limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('asti05_asti14_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tg003 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti05_asti14_body']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti05_asti14_body']['search']['where'];
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
		
		if(isset($_SESSION['asti05_asti14_body']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti05_asti14_body']['search']['order'];
		}
		
		if(!isset($_SESSION['asti05_asti14_body']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,c.mf002,c.mf003,e.me002,f.mv002')
			->from('asttg as a')			
			->join('astmf as c','a.tg003 = c.mf001','left')
			->join('cmsme as e','a.tg004 = e.me001','left')
			->join('cmsmv as f','a.tg005 = f.mv001','left')
			->where('tg001',$seg1)
			->where('tg002',$seg2)
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.* ,c.mf002,c.mf003,e.me002,f.mv002')
			->from('asttg as a')			
			->join('astmf as c','a.tg003 = c.mf001','left')
			->join('cmsme as e','a.tg004 = e.me001','left')
			->join('cmsmv as f','a.tg005 = f.mv001','left')
			->where('tg001',$seg1)
			->where('tg002',$seg2)
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
	 //	echo "<pre>";var_dump($this->db);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['asti05_asti14_body']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('asttg as a')
			->join('astmf as c','a.tg003 = c.mf001','left')
			->join('cmsme as e','a.tg004 = e.me001','left')
			->join('cmsmv as f','a.tg005 = f.mv001','left')
			->where('tg001',$seg1)
			->where('tg002',$seg2);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti05_asti14_body']['search']['where'] = $where;
		$_SESSION['asti05_asti14_body']['search']['order'] = $order;
		$_SESSION['asti05_asti14_body']['search']['offset'] = $offset;
		
		
	//	echo "<pre>";var_dump($ret);exit;
		return $ret;
	}
	
	//查詢一筆 修改用   
	function selone($seg1) {
		$this->db->select('a.*');
		 
        $this->db->from('astmf as a');	
        $this->db->join('astmg as b','a.mf001 = b.mg001','left');
		$this->db->where('a.mf001', $seg1); 
	   	$this->db->order_by('mf001 , mf002');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('g.*, h.me001 as cmsi05, h.me002 as cmsi05_me002, i.mv001 as cmsi09_asti05, i.mv002 as cmsi09_asti05_mv002')
			->from('astmg as g')
			->join('cmsme as h','g.mg002 = h.me001','left')
			->join('cmsmv as i','g.mg003 = i.mv001','left')
			->where('g.mg001', $seg1);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS mf001disp, d.mf002 AS mf007disp,e.mf002 AS mf008disp, f.mv002 AS mf006disp,g.na003 AS mf014disp,
		  ,h.ma002 AS mf004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mg001, b.mg002, b.mg003, b.mg004, b.mg005,
		  b.mg006, b.mg007, b.mg008, b.mg009, b.mg010, b.mg011, b.mg012,b.mg013, b.mg014,b.mg016,b.mg020,b.mg030,b.mg031,i.mg002 as mg007disp,j.me002 as mf005disp');
		 
        $this->db->from('astmf as a');	
        $this->db->join('astmg as b', 'a.mf001 = b.mg001  and a.mf002=b.mg002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mf001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mf007 = d.mf001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mf008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mf006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mf014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('astma as h', 'a.mf004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.mg007 = i.mg001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mf005 = j.me001 ','left');   //部門
		$this->db->where('a.mf001', $this->uri->segment(4)); 
	  //  $this->db->where('a.mf002', $this->uri->segment(5)); 
		$this->db->order_by('mf001 , mf002 ,b.mg003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 資產資料(catcomplete)
	function lookupd_catcomplete($keyword){     
      $this->db->select('mf001,mf002,mf003,mf011,mf012,mf020,mf021,mf029')->from('astmf');  
      $this->db->like('mf001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mf002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 下拉視窗查詢類 google 下拉 明細 資產資料(check)	
	function lookupd_check($keyword){     
      $this->db->select('mf001,mf002,mf003,mf011,mf012,mf020,mf021,mf029')->from('astmf');  
      $this->db->where('mf001',urldecode(urldecode($this->uri->segment(4))));
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  
	
	//ajax 下拉視窗查詢類 google 下拉 明細 資產資料單身(catcomplete)
	function lookupd_body_catcomplete($keyword){     
      $this->db->select('*');
	  $this->db->from('astmf');
      $this->db->like('mf001',urldecode(urldecode($this->uri->segment(4))),'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 資產資料單身(check)
	function lookupd_body_check($keyword){     
      $this->db->select('*');
	  $this->db->from('astmf');
      $this->db->where('mf001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `astmf` ";
	      $seq1 = "mf001, mf002, mf003, mf005, mf006, mf047, create_date FROM `astmf` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.mf001 desc' ;
          $seq9 = " ORDER BY a.mf001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.mf001 ";

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
		//下一頁不要跑掉 1050317 1060815
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
	    }
	//	if(@$_SESSION['asti05_sql_term']){$seq32 = $_SESSION['asti05_sql_term'];}
		if ((@$_SESSION['asti05_sql_term']) and ($_SESSION['asti05_sql_term']!="()" )){$seq32 = $_SESSION['asti05_sql_term'];}
		if(@$_SESSION['asti05_sql_sort']){$seq33 = $_SESSION['asti05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.mf001', 'a.mf002', 'a.mf003', 'a.mf005','mf005disp', 'a.mf006', 'a.mf006disp','a.mf047','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.mf001, a.mf002, a.mf003, a.mf005, b.mf002 as mf005disp, a.mf006, c.ma002 as mf006disp,  a.create_date')
	                       ->from('astmf as a')
						   ->join('astmf as b', 'a.mf005 = b.mf001','left')
						   ->join('astma as c', 'a.mf006 = c.ma001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
		
	     $ret['rows'] = $query->get()->result();

	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('astmf as a')
						   ->join('astmf as b', 'a.mf005 = b.mf001','left')
						   ->join('astma as c', 'a.mf006 = c.ma001','left')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//篩選多筆  舊版   
	function filterf1($limit, $offset , $sort_by  , $sort_order)          
	    {    
	      $seq4 = trim(urldecode(urldecode($this->uri->segment(6)))); 	 //解決亂碼          
          $sort_by = $this->uri->segment(4);			
          $sort_order = $this->uri->segment(5);	
	      $offset=$this->uri->segment(8,0);
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('a.mf001', 'a.mf002', 'a.mf003', 'a.mf004', 'b.ma002', 'a.mf029','a.mf030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否為 table
	      $this->db->select('a.mf001, a.mf002, a.mf003, a.mf004,b.ma002,  a.mf029,a.mf030, a.create_date');
	      $this->db->from('astmf as a');
		  $this->db->join('astma as b', 'a.mf004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mf001 asc, mf002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('astmf as a');
		  $this->db->join('astma as b', 'a.mf004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('mf001', $seg1);
		  $this->db->where('mf002', $seg2);
	      $query = $this->db->get('astmf');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('mg001', $seg1);
		  $this->db->where('mg002', $seg2);
		  $this->db->where('mg003', $seg3);
	      $query = $this->db->get('astmg');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  astmf	
	function insertf()    //新增一筆 檔頭  astmf
        {
		    //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('mf002'), $matches);  //處理日期字串
			 $mf002 = implode('',$matches[0]);
			 
			 
			 $mf001=$this->input->post('mf001');
			// $mf002=$this->input->post('mf002');
			 //$mf002no=$mf002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			//  while($this->asti05_model->selone1($mf001,$mf002)>0){
			//	$mf002 = $this->check_title_no($mf001,$mf039);
			//	$mf002no=$mf002;
			//}
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mf001' => $mf001,
		         'mf002' => $mf002,
		         'mf003' => $this->input->post('mf003'),
		         'mf005' => $this->input->post('mf005'),    
		         'mf006' => $this->input->post('mf006')
                );
 	    
             $this->db->insert('astmf', $data);
			 
			$order_product = array();
			if ($this->input->post()){
				extract($this->input->post());
			}
			
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 astmg  
		//      $vmg003='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['cmsi05'] && $val['cmsi09_asti05']){
				        extract($val);
						//preg_match_all('/\d/S',$mg013, $matches);  //處理日期字串
			            //$mg013 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'mg001' => $mf001,
							'mg002' => $cmsi05,
							'mg003' => $cmsi09_asti05
						);
						foreach($val as $k=>$v){
							if($k!="cmsi05"&&$k!="cmsi05_me002"&&$k!="cmsi09_asti05"&&$k!="cmsi09_asti05_mv002"){//主鍵不用更改以及其他外來鍵庫別名稱
							    $data[$k] = $v;
							}
						}
					$this->db->insert('astmg', $data);
					//$mmg003 = (int) $vmg003+10;
			        //$vmg003 =  (string)$mmg003;
				}
			}
		 }
	
    //自動列印	
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('asti03'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
		      echo "<script>window.open('printbb/".$this->input->post('asti03')."/".$this->input->post('mf002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('mf001', $this->input->post('mf001c')); 
          $this->db->where('mf002', $this->input->post('mf002c'));
	      $query = $this->db->get('astmf');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('mf001', $this->input->post('mf001o'));
			$this->db->where('mf002', $this->input->post('mf002o'));
	        $query = $this->db->get('astmf');
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
                $mf003=$row->mf003;$mf004=$row->mf004;$mf005=$row->mf005;$mf006=$row->mf006;$mf007=$row->mf007;$mf008=$row->mf008;$mf009=$row->mf009;$mf010=$row->mf010;
				$mf011=$row->mf011;$mf012=$row->mf012;$mf013=$row->mf013;$mf014=$row->mf014;$mf015=$row->mf015;$mf016=$row->mf016;
				$mf017=$row->mf017;$mf018=$row->mf018;$mf019=$row->mf019;$mf020=$row->mf020;$mf021=$row->mf021;$mf022=$row->mf022;
				$mf023=$row->mf023;$mf024=$row->mf024;$mf025=$row->mf025;$mf026=$row->mf026;$mf027=$row->mf027;$mf028=$row->mf028;
				$mf029=$row->mf029;$mf030=$row->mf030;$mf031=$row->mf031;$mf032=$row->mf032;$mf033=$row->mf033;$mf034=$row->mf034;
				$mf035=$row->mf035;$mf036=$row->mf036;$mf037=$row->mf037;$mf038=$row->mf038;$mf039=$row->mf039;$mf040=$row->mf040;$mf041=$row->mf041;
				$mf042=$row->mf042;$mf043=$row->mf043;$mf044=$row->mf044;$mf045=$row->mf045;$mf046=$row->mf046;$mf047=$row->mf047;
				$mf048=$row->mf048;$mf049=$row->mf049;$mf050=$row->mf050;$mf051=$row->mf051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mf001c');    //主鍵一筆檔頭astmf
			$seq2=$this->input->post('mf002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mf001' => $seq1,'mf002' => $seq2,'mf003' => $mf003,'mf004' => $mf004,'mf005' => $mf005,'mf006' => $mf006,'mf007' => $mf007,'mf008' => $mf008,'mf009' => $mf009,'mf010' => $mf010,
		           'mf011' => $mf011,'mf012' => $mf012,'mf013' => $mf013,'mf014' => $mf014,'mf015' => $mf015,'mf016' => $mf016,'mf017' => $mf017,
				   'mf018' => $mf018,'mf019' => $mf019,'mf020' => $mf020,'mf021' => $mf021,'mf022' => $mf022,'mf023' => $mf023,'mf024' => $mf024,
				   'mf025' => $mf025,'mf026' => $mf026,'mf027' => $mf027,'mf028' => $mf028,'mf029' => $mf029,'mf030' => $mf030,
				   'mf031' => $mf031,'mf032' => $mf032,'mf033' => $mf033,'mf034' => $mf034,'mf035' => $mf035,'mf036' => $mf036,
				   'mf037' => $mf037,'mf038' => $mf038,'mf039' => $mf039,'mf040' => $mf040,'mf041' => $mf041,'mf042' => $mf042,
				   'mf043' => $mf043,'mf044' => $mf044,'mf045' => $mf045,'mf046' => $mf046,'mf047' => $mf047,'mf048' => $mf048,
				   'mf049' => $mf049,'mf050' => $mf050,'mf051' => $mf051
                   );
				   
            $exist = $this->asti05_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('astmf', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('mg001', $this->input->post('mf001o'));
			$this->db->where('mg002', $this->input->post('mf002o'));
	        $query = $this->db->get('astmg');
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
                 $mg003[$i]=$row->mg003;$mg004[$i]=$row->mg004;$mg005[$i]=$row->mg005;$mg006[$i]=$row->mg006;$mg007[$i]=$row->mg007;
				 $mg008[$i]=$row->mg008;$mg009[$i]=$row->mg009;$mg010[$i]=$row->mg010;$mg011[$i]=$row->mg011;$mg012[$i]=$row->mg012;
				 $mg013[$i]=$row->mg013;$mg014[$i]=$row->mg014;$mg015[$i]=$row->mg015;$mg016[$i]=$row->mg016;$mg017[$i]=$row->mg017;
				 $mg018[$i]=$row->mg018;$mg019[$i]=$row->mg019;$mg020[$i]=$row->mg020;$mg021[$i]=$row->mg021;$mg022[$i]=$row->mg022;
			     $mg023[$i]=$row->mg023;$mg024[$i]=$row->mg024;$mg025[$i]=$row->mg025;$mg026[$i]=$row->mg026;$mg027[$i]=$row->mg027;
				 $mg028[$i]=$row->mg028;$mg029[$i]=$row->mg029;$mg030[$i]=$row->mg030;$mg031[$i]=$row->mg031;$mg032[$i]=$row->mg032;
				 $mg033[$i]=$row->mg033;$mg034[$i]=$row->mg034;$mg035[$i]=$row->mg035;$mg036[$i]=$row->mg036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('mf001c');    //主鍵一筆明細astmg
			$seq2=$this->input->post('mf002c'); 
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
                'mg001' => $seq1,'mg002' => $seq2,'mg003' => $mg003[$i],'mg004' => $mg004[$i],'mg005' => $mg005[$i],'mg006' => $mg006[$i],'mg007' => $mg007[$i],
		         'mg008' => $mg008[$i],'mg009' => $mg009[$i],'mg010' => $mg010[$i],'mg011' => $mg011[$i],'mg012' => $mg012[$i],'mg013' => $mg013[$i],
				 'mg014' => $mg014[$i],'mg015' => $mg015[$i],'mg016' => $mg016[$i],'mg017' => $mg017[$i],'mg018' => $mg018[$i],'mg019' => $mg019[$i],
				 'mg020' => $mg020[$i],'mg021' => $mg021[$i],'mg022' => $mg022[$i],'mg023' => $mg023[$i],'mg024' => $mg024[$i],'mg025' => $mg025[$i],
				 'mg026' => $mg026[$i],'mg027' => $mg027[$i],'mg028' => $mg028[$i],'mg029' => $mg029[$i],'mg030' => $mg030[$i],'mg031' => $mg031[$i],'mg032' => $mg032[$i],
				 'mg033' => $mg033[$i],'mg034' => $mg034[$i],'mg035' => $mg035[$i],'mg036' => $mg036[$i]
                ); 
				
             $this->db->insert('astmg', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mf001o');    
	      $seq2=$this->input->post('mf001c');
		  $seq3=$this->input->post('mf002o');    
	      $seq4=$this->input->post('mf002c');
	      $sql = " SELECT mf001,mf002,mf039,mf004,ma002 as mf004disp,mg003,mg004,mg005,mg006,mg010,mg008,mg011,mg012 
		  FROM astmf as a,astmg as b,astma as c WHERE mf001=mg001 and mf002=mg002 and mf004=ma001 and mf001 >= '$seq1'  AND mf001 <= '$seq2' AND  mf002 >= '$seq3'  AND mf002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('mf001o');    
	      $seq2=$this->input->post('mf001c');
		  $seq3=$this->input->post('mf002o');    
	      $seq4=$this->input->post('mf002c');
	      $sql = " SELECT a.mf001,a.mf002,a.mf039,a.mf004,c.ma002 as mf004disp,b.mg003,b.mg004,b.mg005,b.mg006,b.mg010,b.mg008,b.mg011,b.mg012
		  FROM astmf as a,astmg as b,astma as c
		  WHERE mf001=mg001 and mf002=mg002 and mf004=ma001 and mf001 >= '$seq1'  AND mf001 <= '$seq2' AND mf002 >= '$seq3'  AND mf002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
          $seq32 = "mf001 >= '$seq1'  AND mf001 <= '$seq2' AND mf002 >= '$seq3'  AND mf002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('astmf')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS mf001disp, d.me002 AS mf004disp, e.mf002 AS mf010disp, f.mv002 AS mf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mg001, b.mg002, b.mg003, b.mg004, b.mg005,
		  b.mg006, b.mg007, b.mg011, b.mg009, b.mg017, b.mg018, b.mg012');
		 
        $this->db->from('astmf as a');	
        $this->db->join('astmg as b', 'a.mf001 = b.mg001  and a.mf002=b.mg002 ','left');		
		$this->db->join('cmsmq as c', 'a.mf001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mf004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mf010 = e.mf001 ','left');
		$this->db->join('cmsmv as f ', 'a.mf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mf001', $this->uri->segment(4)); 
	    $this->db->where('a.mf002', $this->uri->segment(5)); 
		$this->db->order_by('mf001 , mf002 ,b.mg003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mg001', $this->uri->segment(4));
		$this->db->where('mg002', $this->uri->segment(5));
	    $query = $this->db->get('astmg');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS mf001disp, d.mf002 AS mf007disp,e.mf002 AS mf008disp, f.mv002 AS mf006disp,g.na003 AS mf014disp,
		  ,h.ma002 AS mf004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mg001, b.mg002, b.mg003, b.mg004, b.mg005,
		  b.mg006, b.mg007, b.mg008, b.mg009, b.mg010, b.mg011, b.mg012,b.mg013, b.mg014,b.mg016,b.mg020,b.mg030,b.mg031,i.mg002 as mg007disp,j.me002 as mf005disp');
		 
        $this->db->from('astmf as a');	
        $this->db->join('astmg as b', 'a.mf001 = b.mg001  and a.mf002=b.mg002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mf001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mf007 = d.mf001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mf008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mf006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mf014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('astma as h', 'a.mf004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.mg007 = i.mg001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mf005 = j.me001 ','left');   //部門	
		$this->db->where('a.mf001', $this->input->post('mf001o')); 
	    $this->db->where('a.mf002 >= '.$this->input->post('mf002o').' and a.mf002 <= '.$this->input->post('mf002c')); 
		$this->db->order_by('mf001 , mf002 ,b.mg003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  //印單據筆  半張紙letter1/2 A4half  公司表頭
		function companyf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsml'); 		
		$query = $this->db->get();
	    $result1['rows1'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result1;
		 }	    		
        }
	//  系統參數
		function funsysf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsma'); 		
		$query = $this->db->get();
	    $result2['rows2'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result2;
		 }	    		
        }
		
	//印單據筆  
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS mf001disp, d.mf002 AS mf007disp,e.mf002 AS mf008disp, f.mv002 AS mf006disp,g.na003 AS mf014disp,
		  ,h.ma002 AS mf004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mg001, b.mg002, b.mg003, b.mg004, b.mg005,
		  b.mg006, b.mg007, b.mg008, b.mg009, b.mg010, b.mg011, b.mg012,b.mg013, b.mg014,b.mg016,b.mg020,b.mg030,b.mg031,i.mg002 as mg007disp,j.me002 as mf005disp');
		 
        $this->db->from('astmf as a');	
        $this->db->join('astmg as b', 'a.mf001 = b.mg001  and a.mf002=b.mg002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mf001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mf007 = d.mf001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mf008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mf006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mf014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('astma as h', 'a.mf004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.mg007 = i.mg001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mf005 = j.me001 ','left');   //部門
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
			//substr($this->input->post('mf003'),0,4).substr($this->input->post('mf003'),5,2).substr(rtrim($this->input->post('mf003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $mf002=$this->input->post('mf002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			preg_match_all('/\d/S',$this->input->post('mf002'), $matches);  //處理日期字串
			 $mf002 = implode('',$matches[0]);
			 $mf001=$this->input->post('mf001');
		//	 $mf002=$this->input->post('mf002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'mf002' => $mf002,
		         'mf003' => $this->input->post('mf003'),
		         'mf005' => $this->input->post('mf005'),    
		         'mf006' => $this->input->post('mf006')
                );
            $this->db->where('mf001', $mf001); //單別
			//$this->db->where('mf002', $mf002);
            $this->db->update('astmf',$data);                   //更改一筆
			
			$order_product=array();
			if ($this->input->post()){
				extract($this->input->post());
			}
			
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('mg001', $mf001);
					$this->db->delete('astmg'); //刪除明細 1060809
					
		    //$vmg003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				//preg_match_all('/\d/S',$mg013, $matches);  //處理日期字串
			    //$mg013 = implode('',$matches[0]);
				if($this->seldetail($mf001,$val['cmsi05'],$val['cmsi09_asti05'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'mg002' => $cmsi05,
						'mg003' => $cmsi09_asti05
					);
					foreach($val as $k=>$v){
						if($k!="cmsi05"&&$k!="cmsi05_me002"&&$k!="cmsi09_asti05"&&$k!="cmsi09_asti05_mv002"){//主鍵不用更改以及其他外來鍵庫別名稱 mg013日期等別處理
							$data[$k] = $v;
						}
					}
					$this->db->where('mg001', $mf001);
					$this->db->update('astmg',$data);//更改一筆
				}else{
					if($val['cmsi05'] && $val['cmsi09_asti05']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'mg001' => $mf001,
							'mg002' => $cmsi05,
							'mg003' => $cmsi09_asti05
						);
						foreach($val as $k=>$v){
							if($k!="cmsi05"&&$k!="cmsi05_me002"&&$k!="cmsi09_asti05"&&$k!="cmsi09_asti05_mv002"){//主鍵不用更改以及其他外來鍵庫別名稱
							    $data[$k] = $v;
							}
						}
						$this->db->insert('astmg', $data);
					}
				}
				
			}
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('mg001', $seg1);
			$this->db->where('mg002', $seg2);
	        $this->db->where('mg003', $seg3);
	        $query = $this->db->get('astmg');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mf001', $this->uri->segment(4));
		  $this->db->where('mf002', $this->uri->segment(5));
          $this->db->delete('astmf'); 
		  $this->db->where('mg001', $this->uri->segment(4));
		  $this->db->where('mg002', $this->uri->segment(5));
          $this->db->delete('astmg'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('mg001', $seg1);
	      $this->db->where('mg002', $seg2);
	      $this->db->where('mg003', $seg3);
          $this->db->delete('astmg'); 
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
		    	      list($seq1, $seq2) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
			      $this->db->where('mf001', $seq1);
			      $this->db->where('mf002', $seq2);
                  $this->db->delete('astmf'); 
				  $this->db->where('mg001', $seq1);
                  $this->db->delete('astmg'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	   
	//刪除明細一筆新增修改時使用   
	function del_detail(){
		$this->db->where('mg001', $_POST['del_md001']);
		$this->db->where('mg002', $_POST['del_md002']);
		$this->db->where('mg003', $_POST['del_md003']);
		$this->db->delete('astmg');
	}
	
	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookup_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=15){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('invmb');
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
	
	//取單號 最大值加1
	function check_title_no($asti03,$mf039){
		preg_match_all('/\d/S',$mf039, $matches);  //處理日期字串
		$mf039 = implode('',$matches[0]);
		$this->db->select('MAX(mf002) as max_no')
			->from('astmf')
			->where('mf001', $asti03)
		//	->where('mf039', $mf039);
			->like('mf039', $mf039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $mf039."001";}
		
		return $result[0]->max_no+1;
	}
	
		//ajax 下拉視窗查詢類 google 下拉 明細 員工單身(catcomplete)
	function lookupd_body_catcomplete_asti08($keyword,$seg1){     
      $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp');
	  $this->db->from('astmg as a');
	  $this->db->join('cmsme as b','a.mg002 = b.me001','left');
	  $this->db->join('cmsmv as c','a.mg003 = c.mv001','left');
	  $this->db->where('mg001',$seg1);
      $this->db->like('mg002',urldecode(urldecode($this->uri->segment(4))),'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
	  //echo "<pre>";var_dump($this->db);exit;
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 員工單身(check)
	function lookupd_body_check_asti08($keyword,$seg1){     
      $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp');
	  $this->db->from('astmg as a');
	  $this->db->join('cmsme as b','a.mg002 = b.me001','left');
	  $this->db->join('cmsmv as c','a.mg003 = c.mv001','left');
	  $this->db->where('mg001',$seg1);
      $this->db->where('mg002',$keyword);
      $query = $this->db->get(); 
	  
      return $query->result();
    }  	
	
			//ajax 下拉視窗查詢類 google 下拉 明細 員工單身(catcomplete)
	function lookupd_body_catcomplete_asti09($keyword,$seg1){     
      $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp');
	  $this->db->from('astmg as a');
	  $this->db->join('cmsme as b','a.mg002 = b.me001','left');
	  $this->db->join('cmsmv as c','a.mg003 = c.mv001','left');
	  $this->db->where('mg001',$seg1);
      $this->db->like('mg002',urldecode(urldecode($this->uri->segment(4))),'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
	  //echo "<pre>";var_dump($this->db);exit;
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 員工單身(check)
	function lookupd_body_check_asti09($keyword,$seg1){     
      $this->db->select('a.*, b.me002 as mg002disp, c.mv002 as mg003disp');
	  $this->db->from('astmg as a');
	  $this->db->join('cmsme as b','a.mg002 = b.me001','left');
	  $this->db->join('cmsmv as c','a.mg003 = c.mv001','left');
	  $this->db->where('mg001',$seg1);
      $this->db->where('mg002',$keyword);
      $query = $this->db->get(); 
	  
      return $query->result();
    }  	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>