<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi09_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//查詢 table 表所有資料	 
	function selbrowse($num, $offset)
	{
		$this->db->select('mj001, mj002, mj003, mj004, mj005, mj006, create_date');
		$this->db->from('cmsmj');
		//$this->db->order_by('id', 'DESC');                //排序  單欄
		$this->db->order_by('mj001 desc, mj002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();
		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('cmsmj');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('mj001', 'mj002', 'mj003', 'mj004', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mj001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('mj001, mj002, mj003, mj004,create_date')
			->from('cmsmj')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('cmsmj');
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
		$this->session->set_userdata('cmsi09_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where") {
			unset($_SESSION['cmsi09']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['cmsi09']['search']);
		}
		if (is_array($this->input->get())) {
			extract($this->input->get());
			if (@$val != null) {
				$temp_url = explode(".html", $val);
				$val = "";
				foreach ($temp_url as $k => $v) {
					$val .= $v;
				}
			}
		}
		$default_where = ""; //在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "MV001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['cmsi09']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['cmsi09']['search']['where'];
		}

		if ($this->input->post('find005')) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $this->input->post('find005');
		}

		if ($func == "and_where" && @strlen($key) + @strlen($val) != 0) {
			if ($where) {
				$where .= " and ";
			}
			$key_ary = explode(",", $key);
			$val_ary = explode(",", $val);
			$value = "";
			foreach ($key_ary as $key => $val) {
				if ($value != "") {
					$value .= " and ";
				}
				$value .= $val . " like '%" . $val_ary[$key] . "%' ";
			}
			$where .= "(" . $value . ")";
		}

		if ($func == "or_where" && @strlen($key) + @strlen($val) != 0) {
			if ($where) {
				$where .= " or ";
			}
			$key_ary = explode(",", $key);
			$val_ary = explode(",", $val);
			$value = "";
			foreach ($key_ary as $key => $val) {
				if ($value != "") {
					$value .= " and ";
				}
				$value .= $val . " like '%" . $val_ary[$key] . "%' ";
			}
			$where .= "(" . $value . ")";
		}

		if ($where == "") {
			$where = false;
		}
		/* where end */

		/* order 處理區域 */
		if ($this->input->post('find007')) {
			$order = $this->input->post('find007');
		} else {
			$order = "";
		}

		if ($func == "order" && @strlen($val) != 0) {
			$value = $val;
			$order = $value;
		} else {
			$order = "";
		}

		if (isset($_SESSION['cmsi09']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['cmsi09']['search']['order'];
		}

		if (!isset($_SESSION['cmsi09']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		$query = $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006, create_date')
			->from('cmsmv')
			->order_by($order);
		if ($where) {
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);

		$query = $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006, create_date')
			->from('cmsmv')
			->order_by($order)
			->limit($limit, $offset);
		if ($where) {
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['cmsi09']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsmv');
		if ($where) {
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;

		//儲存where與order
		$_SESSION['cmsi09']['search']['where'] = $where;
		$_SESSION['cmsi09']['search']['order'] = $order;
		$_SESSION['cmsi09']['search']['offset'] = $offset;

		return $ret;
	}
	//員工代號(單身)
	function construct_sql_body($limit = 10, $offset = 0, $func = "")
	{
		$this->session->set_userdata('cmsi09_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where") {
			unset($_SESSION['cmsi09_body']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['cmsi09_body']['search']);
		}
		if ($this->uri->segment(3, 0) == "clear_body_sql") {
			unset($_SESSION['cmsi09_body']['search']);
		}

		if (is_array($this->input->get())) {
			extract($this->input->get());
			if (@$val != null) {
				$temp_url = explode(".html", $val);
				$val = "";
				foreach ($temp_url as $k => $v) {
					$val .= $v;
				}
			}
		}
		$default_where = ""; //在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mv001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['cmsi09_body']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['cmsi09_body']['search']['where'];
		}

		if ($this->input->post('find005')) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $this->input->post('find005');
		}

		if ($func == "and_where" && @strlen($key) + @strlen($val) != 0) {
			if ($where) {
				$where .= " and ";
			}
			$key_ary = explode(",", $key);
			$val_ary = explode(",", $val);
			$value = "";
			foreach ($key_ary as $key => $val) {
				if ($value != "") {
					$value .= " and ";
				}
				$value .= $val . " like '%" . $val_ary[$key] . "%' ";
			}
			$where .= "(" . $value . ")";
		}

		if ($func == "or_where" && @strlen($key) + @strlen($val) != 0) {
			if ($where) {
				$where .= " or ";
			}
			$key_ary = explode(",", $key);
			$val_ary = explode(",", $val);
			$value = "";
			foreach ($key_ary as $key => $val) {
				if ($value != "") {
					$value .= " and ";
				}
				$value .= $val . " like '%" . $val_ary[$key] . "%' ";
			}
			$where .= "(" . $value . ")";
		}

		if ($where == "") {
			$where = false;
		}

		/* where end */

		/* order 處理區域 */
		if ($this->input->post('find007')) {
			$order = $this->input->post('find007');
		} else {
			$order = "";
		}

		if ($func == "order" && @strlen($val) != 0) {
			$value = $val;
			$order = $value;
		} else {
			$order = "";
		}

		if (isset($_SESSION['cmsi09_body']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['cmsi09_body']['search']['order'];
		}

		if (!isset($_SESSION['cmsi09_body']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		// /* Data SQL */
		// $query = $this->db->select('*')
		// 	->from('cmsmv')
		// 	->order_by($order);
		// //$query->where('b.ma001',$sma001);
		// if ($where) {
		// 	//		$query->where($where);
		// }

		// //echo "<pre>";var_dump($query);exit;
		// $ret['data'] = $query->get()->result();
		// //建構暫存view
		// //$this->construct_view($ret['data']);

		// $query = $this->db->select('*')
		// 	->from('cmsmv')
		// 	->order_by($order)
		// 	->limit($limit, $offset);
		// //$query->where('b.ma001',$sma001);
		// if ($where) {
		// 	//	$query->where($where);
		// }

		// //echo "<pre>";var_dump($query);exit;
		// $ret['data'] = $query->get()->result();

		$DB2 = $this->load->database('yjpal', TRUE);

		$sql = " SELECT * from cmsmv 
						left join cmsme on mv004=me001
					WHERE length(mv022)=0 and $where 
					ORDER BY mv004 desc,mv001 ";
		if ($where == "") {
			$sql = " SELECT * from cmsmv 
						left join cmsme on mv004=me001
					WHERE length(mv022)=0 ORDER BY mv004 desc,mv001 ";
		}

		// $query = $this->db->query($sql);
		$query = $DB2->query($sql);

		$ret['data'] = $query->result();
		// echo "<pre>";
		// var_dump($ret['data']);
		// exit;
		/**
		 * MySQL 轉 MSSQL 時limit的替代方式
		 * by Sam 20220415
		 */
		$fori = $offset;
		$formax = $limit + $offset;
		$ret['num'] = count($ret['data']);
		if ($ret['num'] < $formax)
			$formax = $ret['num'];
		for ($fori; $fori < $formax; $fori++) {
			$temp['data'][] = $ret['data'][$fori];
		}
		if (isset($temp['data'])) {
			$ret['data'] = $temp['data'];
		} else {
			$ret['data'] = ''; //找不到
		}
		// limit的替代方式 end----------------

		//儲存sql
		$_SESSION['cmsi09_body']['search']['sql'] = $this->db->last_query();

		// /* Num SQL*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('cmsmv');
		// //$query->where('b.ma001',$sma001);
		// if ($where) {
		// 	//	$query->where($where);
		// }

		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;

		//儲存where與order
		$_SESSION['cmsi09_body']['search']['where'] = $where;
		$_SESSION['cmsi09_body']['search']['order'] = $order;
		$_SESSION['cmsi09_body']['search']['offset'] = $offset;

		return $ret;
	}

	//員工代號(單身) 多選
	function construct_sql_ch($limit = 10, $offset = 0, $func = "")
	{
		$this->session->set_userdata('cmsi09_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where") {
			unset($_SESSION['cmsi09_body']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['cmsi09_body']['search']);
		}
		if ($this->uri->segment(3, 0) == "clear_body_ch") {
			unset($_SESSION['cmsi09_body']['search']);
		}

		if (is_array($this->input->get())) {
			extract($this->input->get());
			if (@$val != null) {
				$temp_url = explode(".html", $val);
				$val = "";
				foreach ($temp_url as $k => $v) {
					$val .= $v;
				}
			}
		}
		$default_where = ""; //在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mv001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['cmsi09_body']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['cmsi09_body']['search']['where'];
		}

		if ($this->input->post('find005')) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $this->input->post('find005');
		}

		if ($func == "and_where" && @strlen($key) + @strlen($val) != 0) {
			if ($where) {
				$where .= " and ";
			}
			$key_ary = explode(",", $key);
			$val_ary = explode(",", $val);
			$value = "";
			foreach ($key_ary as $key => $val) {
				if ($value != "") {
					$value .= " and ";
				}
				$value .= $val . " like '%" . $val_ary[$key] . "%' ";
			}
			$where .= "(" . $value . ")";
		}

		if ($func == "or_where" && @strlen($key) + @strlen($val) != 0) {
			if ($where) {
				$where .= " or ";
			}
			$key_ary = explode(",", $key);
			$val_ary = explode(",", $val);
			$value = "";
			foreach ($key_ary as $key => $val) {
				if ($value != "") {
					$value .= " and ";
				}
				$value .= $val . " like '%" . $val_ary[$key] . "%' ";
			}
			$where .= "(" . $value . ")";
		}

		if ($where == "") {
			$where = false;
		}

		/* where end */

		/* order 處理區域 */
		if ($this->input->post('find007')) {
			$order = $this->input->post('find007');
		} else {
			$order = "";
		}

		if ($func == "order" && @strlen($val) != 0) {
			$value = $val;
			$order = $value;
		} else {
			$order = "";
		}

		if (isset($_SESSION['cmsi09_body']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['cmsi09_body']['search']['order'];
		}

		if (!isset($_SESSION['cmsi09_body']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		// /* Data SQL */
		// $query = $this->db->select('*')
		// 	->from('cmsmv')
		// 	->order_by($order);
		// //$query->where('b.ma001',$sma001);
		// if ($where) {
		// 	//		$query->where($where);
		// }

		// //echo "<pre>";var_dump($query);exit;
		// $ret['data'] = $query->get()->result();
		// //建構暫存view
		// //$this->construct_view($ret['data']);

		// $query = $this->db->select('*')
		// 	->from('cmsmv')
		// 	->order_by($order)
		// 	->limit($limit, $offset);
		// //$query->where('b.ma001',$sma001);
		// if ($where) {
		// 	//	$query->where($where);
		// }

		// //echo "<pre>";var_dump($query);exit;
		// $ret['data'] = $query->get()->result();

		$DB2 = $this->load->database('yjpal', TRUE);

		$sql = " SELECT * from cmsmv 
					left join cmsme on mv004=me001
				WHERE length(mv022)=0 and $where 
				ORDER BY mv004 desc,mv001  ";
		if ($where == "") {
			$sql = " SELECT * from cmsmv 
				left join cmsme on mv004=me001
			WHERE length(mv022)=0 ORDER BY mv004 desc,mv001  ";
		}

		// $query = $this->db->query($sql);
		$query = $DB2->query($sql);
		$ret['data'] = $query->result();
		/**
		 * MySQL 轉 MSSQL 時limit的替代方式
		 * by Sam 20220415
		 */
		$fori = $offset;
		$formax = $limit + $offset;
		$ret['num'] = count($ret['data']);
		if ($ret['num'] < $formax)
			$formax = $ret['num'];
		for ($fori; $fori < $formax; $fori++) {
			$temp['data'][] = $ret['data'][$fori];
		}
		if (isset($temp['data'])) {
			$ret['data'] = $temp['data'];
		} else {
			$ret['data'] = ''; //找不到
		}
		// limit的替代方式 end----------------

		//儲存sql
		$_SESSION['cmsi09_body']['search']['sql'] = $this->db->last_query();

		// /* Num SQL*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('cmsmv');
		// //$query->where('b.ma001',$sma001);
		// if ($where) {
		// 	//	$query->where($where);
		// }

		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;

		//儲存where與order
		$_SESSION['cmsi09_body']['search']['where'] = $where;
		$_SESSION['cmsi09_body']['search']['order'] = $order;
		$_SESSION['cmsi09_body']['search']['offset'] = $offset;

		return $ret;
	}

	//員工代號(單身 用於asti02)
	function construct_sql_body_asti02($seg1, $limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('cmsi09_asti02_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where") {
			unset($_SESSION['cmsi09']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['cmsi09']['search']);
		}
		if (is_array($this->input->get())) {
			extract($this->input->get());
			if (@$val != null) {
				$temp_url = explode(".html", $val);
				$val = "";
				foreach ($temp_url as $k => $v) {
					$val .= $v;
				}
			}
		}
		$default_where = ""; //在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "MV001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['cmsi09_asti02_body']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['cmsi09_asti02_body']['search']['where'];
		}

		if ($this->input->post('find005')) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $this->input->post('find005');
		}

		if ($func == "and_where" && @strlen($key) + @strlen($val) != 0) {
			if ($where) {
				$where .= " and ";
			}
			$key_ary = explode(",", $key);
			$val_ary = explode(",", $val);
			$value = "";
			foreach ($key_ary as $key => $val) {
				if ($value != "") {
					$value .= " and ";
				}
				$value .= $val . " like '%" . $val_ary[$key] . "%' ";
			}
			$where .= "(" . $value . ")";
		}

		if ($func == "or_where" && @strlen($key) + @strlen($val) != 0) {
			if ($where) {
				$where .= " or ";
			}
			$key_ary = explode(",", $key);
			$val_ary = explode(",", $val);
			$value = "";
			foreach ($key_ary as $key => $val) {
				if ($value != "") {
					$value .= " and ";
				}
				$value .= $val . " like '%" . $val_ary[$key] . "%' ";
			}
			$where .= "(" . $value . ")";
		}

		if ($where == "") {
			$where = false;
		}

		/* where end */

		/* order 處理區域 */
		if ($this->input->post('find007')) {
			$order = $this->input->post('find007');
		} else {
			$order = "";
		}

		if ($func == "order" && @strlen($val) != 0) {
			$value = $val;
			$order = $value;
		} else {
			$order = "";
		}

		if (isset($_SESSION['cmsi09_asti02_body']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['cmsi09_asti02_body']['search']['order'];
		}

		if (!isset($_SESSION['cmsi09_asti02_body']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		$query = $this->db->select('*')
			->from('cmsmv')
			->where('mv004', $seg1)
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if ($where) {
			$query->where($where);
		}

		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);

		$query = $this->db->select('*')
			->from('cmsmv')
			->where('mv004', $seg1)
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if ($where) {
			$query->where($where);
		}

		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['cmsi09_asti02_body']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsmv')
			->where('mv004', $seg1);
		//$query->where('b.ma001',$sma001);
		if ($where) {
			$query->where($where);
		}

		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;

		//儲存where與order
		$_SESSION['cmsi09_asti02_body']['search']['where'] = $where;
		$_SESSION['cmsi09_asti02_body']['search']['order'] = $order;
		$_SESSION['cmsi09_asti02_body']['search']['offset'] = $offset;

		return $ret;
	}

	//查詢修改用 (看資料用)   
	function selone($seq1, $seq2)
	{
		$this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mk001, b.mk002, b.mk003, b.mk004, b.mk005');

		$this->db->from('cmsmj as a');
		$this->db->join('cmsmk as b', 'a.mj001 = b.mk001   ', 'left');

		$this->db->where('a.mj001', $this->uri->segment(4));
		//   $this->db->where('a.mj002', $this->uri->segment(5)); 
		$this->db->order_by('mj001 , b.mk002');

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
	}

	//ajax 查詢一筆 顯示 鍵值 
	function ajaxkey($seg1)
	{
		$this->db->set('mj001', $this->uri->segment(4));
		$this->db->where('mj001', $this->uri->segment(4));
		$query = $this->db->get('cmsmj');
		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mj001;
			}
			return $result;
		}
	}

	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword)
	{
		$this->db->select('mv001, mv002, mv003,mv004')->from('cmsmv');
		$this->db->like('mv001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('mv002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('15');
		$query = $this->db->get();
		return $query->result();
	}

	//ajax 查詢 顯示 請購單別 mk001	
	function ajaxpurq04a($seg1)
	{
		$this->db->set('mq001', $this->uri->segment(4));
		$this->db->where('mq003', '31');
		$this->db->where('mq001', $this->uri->segment(4));
		$query = $this->db->get('cmsmq');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mq002;
			}
			return $result;
		}
	}

	//ajax 查詢顯示用 請購部門	
	function ajaxcmsq05a($seg1)
	{
		$this->db->where('me001', $this->uri->segment(4));
		$query = $this->db->get('cmsme');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->me002;
			}
			return $result;
		}
	}

	//ajax 查詢顯示用 廠別 mj010  
	function ajaxcmsq02a($seg1)
	{
		$this->db->where('mb001', $this->uri->segment(4));
		$query = $this->db->get('cmsmb');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mb002;
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

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mv002;
			}
			return $result;
		}
	}

	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)
	{
		$this->db->select_max('mj002');
		$this->db->where('mj001', $this->uri->segment(4));
		$this->db->where('mj013', $this->uri->segment(5));
		$query = $this->db->get('cmsmj');
		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mj002;
			}
			return $result;
		}
	}

	//ajax 查詢 顯示用 明細 品號	
	function ajaxinvq02a4($seg1)
	{
		$this->db->where('mb001', $this->uri->segment(4));
		$query = $this->db->get('invmb');
		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mb001;
			}
			return $result;
		}
	}

	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)
	{
		//$seq5='';$seq51='';$seq7='';$seq71='';		  
		$seq11 = "SELECT COUNT(*) as count  FROM `cmsmj` ";
		$seq1 = "mj001, mj002, mj003, mj004,  create_date FROM `cmsmj` ";
		$seq2 = "WHERE `create_date` >=' ' ";
		$seq32 = "`create_date` >='' ";
		$seq33 = 'mj001 desc';
		$seq9 = " ORDER BY mj001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`create_date` >='' ";
		// $seq5=$this->session->userdata('find05');
		// $seq7=$this->session->userdata('find07');
		$seq7 = "mj001 ";

		if (trim($this->input->post('find005')) != '') {
			$seq5 = $this->input->post('find005');
			$seq2 = "WHERE " . $seq5;
			$seq32 = $seq5;
		}
		if ($seq5 != '') {
			$seq2 = "WHERE " . $seq5;
			$seq32 = $seq5;
		}

		if (trim($this->input->post('find007')) != '') {
			$seq7 = $this->input->post('find007');
			$seq9 = " ORDER BY " . $seq7;
			$seq33 = $seq7;
		}
		if ($seq7 != '') {
			$seq9 = " ORDER BY " . $seq7;
			$seq33 = $seq7;
		}
		//下一頁不會亂跳
		if (@$_SESSION['cmsi09_sql_term']) {
			$seq32 = $_SESSION['cmsi09_sql_term'];
		}
		if (@$_SESSION['cmsi09_sql_sort']) {
			$seq33 = $_SESSION['cmsi09_sql_sort'];
		}

		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('mj001', 'mj002', 'mj003', 'mj004', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mj001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('mj001, mj002, mj003, mj004, create_date')
			->from('cmsmj')
			->where($seq32)
			->order_by($seq33)
			//->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('cmsmj')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//篩選多筆     
	function filterf1($limit, $offset, $sort_by, $sort_order)
	{
		$seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
		$sort_by = $this->uri->segment(4);
		$sort_order = $this->uri->segment(5);
		$offset = $this->uri->segment(8, 0);
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('mj001', 'mj002', 'mj003', 'mj004', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mj001';  //檢查排序欄位是否為 table
		$this->db->select('mj001, mj002, mj003, mj004,  create_date');
		$this->db->from('cmsmj');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		//$this->db->order_by('mj001 asc, mj002 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();

		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('cmsmj');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//查新增資料是否重複 (單頭)  
	function selone1($seg1)
	{
		$this->db->where('mj001', $this->input->post('mj001'));
		//  $this->db->where('mj002', $this->input->post('mj002'));
		$query = $this->db->get('cmsmj');
		return $query->num_rows();
	}

	//查新增資料是否重複 (單身)	
	function selone1d($seg1)
	{
		$this->db->where('mk001', $this->input->post('mj001'));
		$this->db->where('mk002', $this->input->post('mk002'));
		$query = $this->db->get('cmsmk');
		return $query->num_rows();
	}

	//新增一筆 檔頭  cmsmj	
	function insertf()    //新增一筆 檔頭  cmsmj
	{
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'mj001' => $this->input->post('mj001'),
			'mj002' => $this->input->post('mj002'),
			'mj003' => $this->input->post('mj003'),
			'mj004' => $this->input->post('mj004')

		);

		$exist = $this->cmsi09_model->selone1($this->input->post('mj001'));
		if ($exist) {
			return 'exist';
		}
		$this->db->insert('cmsmj', $data);

		// 新增明細 cmsmk

		$n = '0';
		//	while (($_POST['order_product'][  $n  ]['mk004']) > '0' ) {
		while ($_POST['order_product'][$n]['mk002']) {

			//  if  ( $_POST['order_product'][ $n  ]['mk003']='' )  $_POST['order_product'][ $n  ]['mk003']= 0;


			$data_array = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' => date("Ymd"),
				'modifier' => '',
				'modi_date' => '',
				'flag' => 0,
				'mk001' => $this->input->post('mj001'),
				'mk002' =>  $_POST['order_product'][$n]['mk002'],
				'mk003' =>  $_POST['order_product'][$n]['mk003'],
				'mk004' => $_POST['order_product'][$n]['mk004'],
				'mk005' => $_POST['order_product'][$n]['mk005']
			);

			$exist = $this->cmsi09_model->selone1d($this->input->post('mj001'), $this->input->post('mk002'));
			if ($_POST['order_product'][$n]['mk002'] > '') {
				$this->db->insert('cmsmk', $data_array);
			}
			$num =  (int)$n + 1;
			$n =  (string)$num;
		}
		if ($exist) {
			return 'exist';
		}
	}

	//查複製資料是否重複	 
	function selone2($seq1)
	{
		$this->db->where('mj001', $this->input->post('mj001c'));
		$query = $this->db->get('cmsmj');
		return $query->num_rows();
	}

	//複製一筆	
	function copyf()
	{
		$this->db->where('mj001', $this->input->post('mj001o'));
		$query = $this->db->get('cmsmj');
		$exist = $query->num_rows();
		if (!$exist) {
			return 'exist';
		}
		if ($query->num_rows() == 1) {
			$result = $query->result();
			foreach ($result as $row) :
				$mj002 = $row->mj002;
				$mj003 = $row->mj003;
				$mj004 = $row->mj004;

			endforeach;
		}

		$seq1 = $this->input->post('mj001c');    //主鍵一筆檔頭cmsmj
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
			'mj001' => $seq1, 'mj002' => $mj002, 'mj003' => $mj003, 'mj004' => $mj004
		);

		$exist = $this->cmsi09_model->selone2($this->input->post('mj001c'));
		if ($exist) {
			return 'exist';
		}
		$this->db->insert('cmsmj', $data);      //複製一筆  

		//複製一筆明細
		$this->db->where('mk001', $this->input->post('mj001o'));
		$query = $this->db->get('cmsmk');
		$exist = $query->num_rows();
		if (!$exist) {
			return 'exist';
		}
		$num = $query->num_rows();
		if ($query->num_rows() >= 1) {
			$result = $query->result();
			$i = 0;
			foreach ($result as $row) :
				$mk002[$i] = $row->mk002;
				$mk003[$i] = $row->mk003;
				$mk004[$i] = $row->mk004;
				$mk005[$i] = $row->mk005;
				$i++;
			endforeach;
		}
		$seq1 = $this->input->post('mj001c');    //主鍵一筆明細cmsmk
		$i = 0;
		while ($i < $num) {
			$data_array = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' => date("Ymd"),
				'modifier' => '',
				'modi_date' => '',
				'flag' => 0,
				'mk001' => $seq1, 'mk002' => $mk002[$i], 'mk003' => $mk003[$i], 'mk004' => $mk004[$i], 'mk005' => $mk005[$i]
			);

			$this->db->insert('cmsmk', $data_array);      //複製一筆 
			$i++;
		}
		return true;
	}

	//轉excel檔   
	function excelnewf()
	{
		$seq1 = $this->input->post('mj001o');
		$seq2 = $this->input->post('mj001c');
		//  $seq3=$this->input->post('mj002o');    
		//  $seq4=$this->input->post('mj002c');
		$sql = " SELECT mj001,mj002,mj003,mj004,create_date FROM cmsmj WHERE mj001 >= '$seq1'  AND mj001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('mj001o');
		$seq2 = $this->input->post('mj001c');
		//  $seq3=$this->input->post('mj002o');    
		//   $seq4=$this->input->post('mj002c');
		$sql = " SELECT * FROM cmsmj WHERE mj001 >= '$seq1'  AND mj001 <= '$seq2'   ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();
		$seq32 = "mj001 >= '$seq1'  AND mj001 <= '$seq2'   ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('cmsmj')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//選取印單據筆	
	function printfd1()
	{
		$this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mk001, b.mk002, b.mk003, b.mk004, b.mk005,
		  b.mk006');

		$this->db->from('cmsmj as a');
		$this->db->join('cmsmk as b', 'a.mj001 = b.mk001   ', 'left');
		$this->db->where('a.mj001', $this->uri->segment(4));

		$this->db->order_by('mj001 , b.mk002');

		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1 = $this->uri->segment(4);
		$seq2 = $this->uri->segment(5);
		$this->db->where('mk001', $this->uri->segment(4));
		//$this->db->where('mk002', $this->uri->segment(5));
		$query = $this->db->get('cmsmk');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//印單據筆   
	function printfc()
	{
		$this->db->select('a.* ,c.mq002 AS mj001disp, d.me002 AS mj004disp, e.mb002 AS mj010disp, f.mv002 AS mj012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mk001, b.mk002, b.mk003, b.mk004, b.mk005,
		  b.mk006, b.mk007, b.mk011, b.mk009, b.mk017, b.mk018, b.mk012');

		$this->db->from('cmsmj as a');
		$this->db->join('cmsmk as b', 'a.mj001 = b.mk001  and a.mj002=b.mk002 ', 'left');
		$this->db->join('cmsmq as c', 'a.mj001 = c.mq001 and c.mq003="31" ', 'left');
		$this->db->join('cmsme as d', 'a.mj004 = d.me001 ', 'left');
		$this->db->join('cmsmb as e', 'a.mj010 = e.mb001 ', 'left');
		$this->db->join('cmsmv as f ', 'a.mj012 = f.mv001 and f.mv022 = " " ', 'left');
		$this->db->where('a.mj001', $this->input->post('mj001o'));
		$this->db->where('a.mj002', $this->input->post('mj002o'));
		$this->db->order_by('mj001 , mj002 ,b.mk003');

		$query = $this->db->get();
		$result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
			return $result;
		}
	}

	//印單據筆  
	function printfb()
	{
		$this->db->select('a.* ,c.mq002 AS mj001disp, d.me002 AS mj004disp, e.mb002 AS mj010disp, f.mv002 AS mj012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mk001, b.mk002, b.mk003, b.mk004, b.mk005,
		  b.mk006, b.mk007, b.mk011, b.mk009, b.mk017, b.mk018, b.mk012');

		$this->db->from('cmsmj as a');
		$this->db->join('cmsmk as b', 'a.mj001 = b.mk001  and a.mj002=b.mk002 ', 'left');
		$this->db->join('cmsmq as c', 'a.mj001 = c.mq001 and c.mq003="31" ', 'left');
		$this->db->join('cmsme as d', 'a.mj004 = d.me001 ', 'left');
		$this->db->join('cmsmb as e', 'a.mj010 = e.mb001 ', 'left');
		$this->db->join('cmsmv as f ', 'a.mj012 = f.mv001 and f.mv022 = " " ', 'left');
		$this->db->where('a.mj001', $this->uri->segment(4));
		$this->db->where('a.mj002', $this->uri->segment(5));
		$this->db->order_by('mj001 , mj002 ,b.mk003');

		$query = $this->db->get();
		$result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
			return $result;
		}
	}

	//更改一筆	
	function updatef()
	{
		$data = array(
			'modifier' => $this->session->userdata('manager'),
			'modi_date' => date("Ymd"),
			'flag' => $this->input->post('flag') + 1,
			'mj002' => $this->input->post('mj002'),
			'mj003' => $this->input->post('mj003'),
			'mj004' => $this->input->post('mj004')
		);
		$this->db->where('mj001', $this->input->post('mj001'));
		//	$this->db->where('mj002', $this->input->post('mj002'));
		$this->db->update('cmsmj', $data);                   //更改一筆

		//刪除明細
		$this->db->where('mk001', $this->input->post('mj001'));
		$this->db->delete('cmsmk');

		$this->db->flush_cache();
		// 新增明細 cmsmk

		$n = '0';
		//	$mk003='1000';
		while ($_POST['order_product'][$n]['mk002']) {
			$data_array = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' => date("Ymd"),
				'modifier' => $this->session->userdata('manager'),
				'modi_date' => date("Ymd"),
				'flag' => 1,
				'mk001' => $this->input->post('mj001'),
				'mk002' => $_POST['order_product'][$n]['mk002'],
				'mk003' => $_POST['order_product'][$n]['mk003'],
				'mk004' => $_POST['order_product'][$n]['mk004'],
				'mk005' => $_POST['order_product'][$n]['mk005']
			);
			if ($_POST['order_product'][$n]['mk002'] > '') {
				$this->db->insert('cmsmk', $data_array);
			}
			// $mmk003 = (int) $mk003+10;
			// $mk003 =  (string)$mmk003;

			$num =  (int)$n + 1;
			$n =  (string)$num;
		}

		$n = '10';
		$num =  (int)$n;
		$n =  (string)$num;
		while ($_POST['order_product'][$n]['mk004']) {
			$data_array = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' => date("Ymd"),
				'modifier' => $this->session->userdata('manager'),
				'modi_date' => date("Ymd"),
				'flag' => 1,
				'mk001' => $this->input->post('mj001'),
				'mk002' => $_POST['order_product'][$n]['mk002'],
				'mk003' => $_POST['order_product'][$n]['mk003'],
				'mk004' => $_POST['order_product'][$n]['mk004'],
				'mk005' => $_POST['order_product'][$n]['mk005']
			);
			if ($_POST['order_product'][$n]['mk002'] > '') {
				$this->db->insert('cmsmk', $data_array);
			}
			//	$mmk003 = (int) $mk003+10;
			//	$mk003 =  (string)$mmk003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		}
		return true;
	}

	//刪除一筆 	
	function deletef($seg1)
	{
		$this->db->where('mj001', $this->uri->segment(4));
		//	  $this->db->where('mj002', $this->uri->segment(5));
		$this->db->delete('cmsmj');
		$this->db->where('mk001', $this->uri->segment(4));
		//  $this->db->where('mk002', $this->uri->segment(5));
		$this->db->delete('cmsmk');
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	//選取刪除多筆   
	function delmutif()
	{
		$seq[] = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		$x = 0;
		$seq1 = ' ';
		$seq2 = ' ';
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;
				list($seq1) = explode("/", $seq[$x]);
				$seq1;
				$this->db->where('mj001', $seq1);
				//   $this->db->where('mj002', $seq2);
				$this->db->delete('cmsmj');
				$this->db->where('mk001', $seq1);
				//  $this->db->where('mk002', $seq2);
				$this->db->delete('cmsmk');
			}
		}
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}
	function del_detail()
	{
		$this->db->where('mk001', $_POST['del_mv001']);
		$this->db->where('mk002', $_POST['del_mv002']);
		$this->db->delete('cmsmk');
	}
	/*==以下AJAX處理區域==*/
	function ajaxcmsi09($seg1)    //ajax 查詢一筆 顯示用 庫別6
	{
		$this->db->set('mv001', $this->uri->segment(4));
		$this->db->where('mv001', $this->uri->segment(4));
		$query = $this->db->get('cmsmv');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mv002;
			}
			return $result;
		}
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword)
	{
		$this->db->select('mv001, mv002');
		$this->db->from('cmsmv');
		$this->db->like('mv001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('mv002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	function lookup2($keyword)
	{
		$mv001 = urldecode(urldecode($this->uri->segment(4)));
		$this->db->select('mv001, mv002');
		$this->db->from('cmsmv');
		$this->db->where('mv001', $mv001);
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookup_old($select_col = array(), $search_col = array(), $keyword = array(), $limit = 10)
	{
		$sel_col = "";
		foreach ($select_col as $val) {
			if ($sel_col) {
				$sel_col .= ",";
			}
			$sel_col .= $val;
		}
		if ($sel_col == "") {
			$sel_col = "*";
		}
		$this->db->select($sel_col)->from('cmsmv');
		foreach ($search_col as $key => $val) {
			if ($key == "and") {
				$this->db->like($val, $keyword[$val], 'after');
			} elseif ($key == "or") {
				$this->db->or_like($val, $keyword[$val], 'after');
			}
		}
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 員工單身(catcomplete)
	function lookupd_body_catcomplete($keyword)
	{
		$this->db->select('*');
		$this->db->from('cmsmv');
		$this->db->like('mv001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 員工單身(check)
	function lookupd_body_check($keyword)
	{
		// $this->db->select('*');
		// $this->db->from('cmsmv');
		// $this->db->where('mv001', urldecode(urldecode($this->uri->segment(4))));
		// $query = $this->db->get();
		$DB2 = $this->load->database('yjpal', TRUE);
		$sql98 = " select * from cmsmv where mv001 like '%$keyword%'";
		// $query = $this->db->query($sql98);
		$query = $DB2->query($sql98);
		$result = $query->result();
		if (count($result) == 1) {
			// return mb_convert_encoding(trim($result[0]->MV002), "utf-8", "big-5");
			return trim($result[0]->mv002);
		} else {
			return 'N';
		}
	}

	//ajax 下拉視窗查詢類 google 下拉 明細 員工單身(catcomplete)
	function lookupd_body_catcomplete_asti02($keyword, $seg1)
	{
		$this->db->select('*');
		$this->db->from('cmsmv');
		$this->db->where('mv004', $seg1);
		$this->db->like('mv001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 員工單身(check)
	function lookupd_body_check_asti02($keyword, $seg1)
	{
		$this->db->select('*');
		$this->db->from('cmsmv');
		$this->db->where('mv004', $seg1);
		$this->db->where('mv001', $keyword);
		$query = $this->db->get();

		return $query->result();
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
