<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi05_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//查詢 table 表所有資料 
	function selbrowse($num, $offset)
	{
		$this->db->select('ME001, ME002, ME003, ME004 create_date');
		$this->db->from('cmsme');
		//$this->db->order_by('id', 'DESC');                //排序  單欄
		$this->db->order_by('ME001 desc, ME002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();

		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('cmsme');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('ME001', 'ME002', 'ME003', 'ME004', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ME001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('ME001, ME002, ME003, ME004,  create_date')
			->from('cmsme')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('cmsme');
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
		$this->session->set_userdata('cmsi05_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($this->uri->segment(3, 0) == "clear_sql") {
			unset($_SESSION['cmsi05']['search']);
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
		$default_order = "ME001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['cmsi05']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['cmsi05']['search']['where'];
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

		if (isset($_SESSION['cmsi05']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['cmsi05']['search']['order'];
		}

		if (!isset($_SESSION['cmsi05']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		// $query = $this->db->select('ME001, ME002, ME003, ME004, create_date')
		// 	->from('cmsme')
		// 	->order_by($order);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		// $sql = " SELECT * from CMSME WHERE $where ORDER BY $order ";
		// if ($where == "") {
		// 	$sql = " SELECT * from CMSME ORDER BY $order ";
		// }

		$sql = " SELECT *  FROM  CMSME WHERE  $where and ME001 IN 
			(SELECT TOP $limit ME001 FROM CMSME WHERE $where and ME001 NOT IN
				(SELECT TOP $offset  ME001 FROM CMSME WHERE $where ORDER BY ME001)
			ORDER BY ME001)
		 ORDER BY ME001 
		 ";
		if ($where == "") {
			$sql = " SELECT *  FROM  CMSME WHERE ME001 IN 
				(SELECT TOP $limit ME001 FROM CMSME WHERE ME001 NOT IN
					(SELECT TOP $offset ME001 FROM CMSME ORDER BY ME001)
				ORDER BY ME001)
			ORDER BY ME001
			";
		}

		$query = $this->db->query($sql);
		$ret['data'] = $query->result();

		//建構暫存view
		//$this->construct_view($ret['data']);

		// $query = $this->db->select('ME001, ME002, ME003, ME004, create_date')
		// 	->from('cmsme')
		// 	->order_by($order)
		// 	->limit($limit, $offset);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['cmsi05']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('cmsme');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		// $ret['num'] = count($ret['data']);
		$sql = " SELECT count(*) as total_num from CMSME WHERE $where ";
		if ($where == "") {
			$sql = " SELECT count(*) as total_num from CMSME";
		}
		$query = $this->db->query($sql);
		$ret['num'] =  $query->result()[0]->total_num;

		//儲存where與order
		$_SESSION['cmsi05']['search']['where'] = $where;
		$_SESSION['cmsi05']['search']['order'] = $order;
		$_SESSION['cmsi05']['search']['offset'] = $offset;

		return $ret;
	}
	//部門代號(單身)
	function construct_sql_body($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('cmsi05_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where") {
			unset($_SESSION['cmsi05']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['cmsi05']['search']);
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
		$default_order = "ME001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['cmsi05_body']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['cmsi05_body']['search']['where'];
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

		if (isset($_SESSION['cmsi05_body']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['cmsi05_body']['search']['order'];
		}

		if (!isset($_SESSION['cmsi05_body']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		$query = $this->db->select('*')
			->from('cmsme')
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
			->from('cmsme')
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if ($where) {
			$query->where($where);
		}

		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['cmsi05_body']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsme');
		//$query->where('b.ma001',$sma001);
		if ($where) {
			$query->where($where);
		}

		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;

		//儲存where與order
		$_SESSION['cmsi05_body']['search']['where'] = $where;
		$_SESSION['cmsi05_body']['search']['order'] = $order;
		$_SESSION['cmsi05_body']['search']['offset'] = $offset;

		return $ret;
	}
	//ajax 查詢資料重複
	function ajaxkey($seg1)
	{
		$this->db->set('ME001', $this->uri->segment(4));
		$this->db->where('ME001', $this->uri->segment(4));
		$query = $this->db->get('cmsme');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->ME002;
			}
			return $result;
		}
	}

	//ajax 查詢 顯示 請購部門  
	function ajaxcmsq05a($seg1)
	{
		$this->db->where('ME001', $this->uri->segment(4));
		$query = $this->db->get('cmsme');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->ME002;
			}
			return $result;
		}
	}

	//查詢一筆 修改用   
	function selone()
	{
		$this->db->select('cmsme.*, a.ma003 as ME004disp');
		$this->db->from('cmsme');
		//$this->db->set('ME001', $this->uri->segment(4)); 
		$this->db->where('ME001', $this->uri->segment(4));
		$this->db->join('actma as a', 'cmsme.ME004 = a.ma001', 'left');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
	}

	//查詢進階查詢 	
	function findf($limit, $offset, $sort_by, $sort_order)
	{
		//$seq5='';$seq51='';$seq7='';$seq71='';		  
		$seq11 = "SELECT COUNT(*) as count  FROM `cmsme` ";
		$seq1 = " ME001, ME002, ME003, ME004,  create_date FROM `cmsme` ";
		$seq2 = "WHERE `create_date` >=' ' ";
		$seq32 = "`create_date` >='' ";
		$seq33 = 'ME001 desc';
		$seq9 = " ORDER BY ME001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`create_date` >='' ";
		$seq7 = "ME001 ";

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
		if (@$_SESSION['cmsi05_sql_term']) {
			$seq32 = $_SESSION['cmsi05_sql_term'];
		}
		if (@$_SESSION['cmsi05_sql_sort']) {
			$seq33 = $_SESSION['cmsi05_sql_sort'];
		}

		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('ME001', 'ME002', 'ME003', 'ME004', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ME001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('ME001, ME002, ME003, ME004, create_date')
			->from('cmsme')
			->where($seq32)
			->order_by($seq33)
			//->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('cmsme')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//篩選多筆    
	function filterf1($limit, $offset, $sort_by, $sort_order)    //篩選多筆        
	{
		$seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
		$sort_by = $this->uri->segment(4);
		$sort_order = $this->uri->segment(5);
		$offset = $this->uri->segment(8, 0);
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('ME001', 'ME002', 'ME003', 'ME004', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ME001';  //檢查排序欄位是否為 table
		$this->db->select('ME001, ME002, ME003, ME004, create_date');
		$this->db->from('cmsme');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		//$this->db->order_by('ME001 asc, ME002 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('cmsme');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//查新增資料是否重複 
	function selone1($seg1)
	{
		$this->db->set('ME001', $this->input->post('ME001'));
		$this->db->where('ME001', $this->input->post('ME001'));
		$query = $this->db->get('cmsme');
		return $query->num_rows();
	}

	//新增一筆	
	function insertf()
	{
		//  $sME005 = $this->input->post('ME005');
		//  if ($sME005 != 'Y') {
		//  $sME005 = 'N';
		//   }

		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'ME001' => $this->input->post('ME001'),
			'ME002' => $this->input->post('ME002'),
			'ME003' => $this->input->post('ME003'),
			'ME004' => $this->input->post('actq03a')
		);

		$exist = $this->cmsi05_model->selone1($this->input->post('ME001'));
		if ($exist) {
			return 'exist';
		}
		return  $this->db->insert('cmsme', $data);
	}

	//查複製資料是否重複	 
	function selone2($seg1)
	{
		$this->db->set('ME001', $this->input->post('ME002c'));
		$this->db->where('ME001', $this->input->post('ME002c'));
		$query = $this->db->get('cmsme');
		return $query->num_rows();
	}

	//複製一筆	
	function copyf()           //複製一筆
	{
		$seq1 = $this->input->post('ME001c');
		$seq2 = $this->input->post('ME002c');
		$this->db->where('ME001', $this->input->post('ME001c'));
		$query = $this->db->get('cmsme');
		$exist = $query->num_rows();
		if (!$exist) {
			return 'exist';
		}
		if ($query->num_rows() != 1) {
			return 'exist';
		}
		if ($query->num_rows() == 1) {
			$result = $query->result();
			foreach ($result as $row) :
				$ME002 = $row->ME002;
				$ME003 = $row->ME003;
				$ME004 = $row->ME004;

			endforeach;
		}
		$seq3 = $this->input->post('ME002c');    //主鍵一筆

		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
			'ME001' => $seq3,
			'ME002' => $ME002,
			'ME003' => $ME003,
			'ME004' => $ME004

		);
		$exist = $this->cmsi05_model->selone2($this->input->post('ME002c'));
		if ($exist) {
			return 'exist';
		}
		return $this->db->insert('cmsme', $data);      //複製一筆  
	}

	//轉excel檔	 
	function excelnewf()
	{
		$seq1 = $this->input->post('ME001c');    //查詢一筆以上
		$seq2 = $this->input->post('ME002c');
		$sql = " SELECT ME001,ME002,ME004,ME003,create_date FROM cmsme WHERE ME001 >= '$seq1'  AND ME001 <= '$seq2' ORDER BY ME001 ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('ME001c');    //查詢一筆以上
		$seq2 = $this->input->post('ME002c');
		$sql = " SELECT * FROM cmsme WHERE ME001 >= '$seq1'  AND ME001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();
		$seq32 = "ME001 >= '$seq1'  AND ME001 <= '$seq2'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('cmsme')
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
			'flag' => $this->input->post('flag') + 1,
			'ME002' => $this->input->post('ME002'),
			'ME003' => $this->input->post('ME003'),
			'ME004' => $this->input->post('actq03a')

		);
		$this->db->where('ME001', $this->input->post('ME001'));

		$this->db->update('cmsme', $data);                   //更改一筆
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	//刪除一筆	
	function deletef($seg1, $seg2)
	{
		$seg1 = $this->uri->segment(4);
		$this->db->where('ME001', $seg1);
		$this->db->delete('cmsme');
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
				//   $seq2;
				$this->db->where('ME001', $seq1);
				$this->db->delete('cmsme');
			}
		}
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	/*==以下AJAX處理區域==*/
	function ajaxcmsi05($seg1)    //ajax 查詢一筆 顯示用 部門6
	{
		$this->db->set('ME001', $this->uri->segment(4));
		$this->db->where('ME001', $this->uri->segment(4));
		$query = $this->db->get('cmsme');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->ME002;
			}
			return $result;
		}
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd($keyword)
	{
		$this->db->select('ME001, ME002');
		$this->db->from('cmsme');
		$this->db->like('ME001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('ME002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword)
	{
		$this->db->select('ME001, ME002');
		$this->db->from('cmsme');
		$this->db->like('ME001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('ME002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	function lookup2($keyword)
	{
		$ME001 = urldecode(urldecode($this->uri->segment(4)));
		$this->db->select('ME001, ME002');
		$this->db->from('cmsme');
		$this->db->where('ME001', $ME001);
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd_catcomplete($keyword)
	{
		$this->db->select('ME001, ME002');
		$this->db->from('cmsme');
		$this->db->like('ME001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('ME002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	function lookupd_check($keyword)
	{
		// $ME001 = urldecode(urldecode($this->uri->segment(4)));
		// $this->db->select('ME001, ME002');
		// $this->db->from('cmsme');
		// $this->db->where('ME001', $ME001);
		// $query = $this->db->get();
		// return $query->result();

		$sql98 = " select ME001, ME002 from dbo.CMSME where ME001 = '$keyword' ";
		$query = $this->db->query($sql98);

		$result = $query->result();

		if (count($result) > 0) {
			return mb_convert_encoding(trim($result[0]->ME002), "utf-8", "big-5");
		} else {
			return 'N';
		}
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 部門
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
		$this->db->select($sel_col)->from('cmsme');
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

	//ajax 下拉視窗查詢類 google 下拉 明細 部門單身(catcomplete)
	function lookupd_body_catcomplete($keyword)
	{
		$this->db->select('*');
		$this->db->from('cmsme');
		$this->db->like('ME001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 部門單身(check)
	function lookupd_body_check($keyword)
	{
		$this->db->select('*');
		$this->db->from('cmsme');
		$this->db->where('ME001', urldecode(urldecode($this->uri->segment(4))));
		$query = $this->db->get();
		return $query->result();
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
