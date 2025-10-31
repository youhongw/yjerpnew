<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi02_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//查詢 table 表所有資料 
	function selbrowse($num, $offset)
	{
		$this->db->select('MB001, MB002, MB003, MB004, MB005, MB006,MB007,MB008,MB009,MB010, create_date');
		$this->db->from('CMSMB');
		//$this->db->order_by('id', 'DESC');                //排序  單欄
		$this->db->order_by('MB001 desc, MB002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();

		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('CMSMB');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('MB001', 'MB002', 'MB003', 'MB004', 'MB005', 'MB006', 'MB007', 'MB008', 'MB009', 'MB010', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'MB001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('MB001, MB002, MB003, MB004, MB005, MB006,MB007,MB008,MB009,MB010, create_date')
			->from('CMSMB')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('CMSMB');
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
		$this->session->set_userdata('cmsi02_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where") {
			unset($_SESSION['cmsi02']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['cmsi02']['search']);
		}
		if ($this->uri->segment(3, 0) == "clear_sql") {
			unset($_SESSION['cmsi02']['search']);
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
		$default_order = "MB001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['cmsi02']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['cmsi02']['search']['where'];
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

		if (isset($_SESSION['cmsi02']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['cmsi02']['search']['order'];
		}

		if (!isset($_SESSION['cmsi02']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		// $query = $this->db->select('MB001, MB002, MB003, MB004, MB005, MB006, MB008, MB010, create_date')
		// 	->from('CMSMB')
		// 	->order_by($order);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);

		$sql = " SELECT * from CMSMB WHERE $where ORDER BY $order ";
		if ($where == "") {
			$sql = " SELECT * from CMSMB ORDER BY $order ";
		}

		$query = $this->db->query($sql);
		$ret['data'] = $query->result();

		// $query = $this->db->select('MB001, MB002, MB003, MB004, MB005, MB006, MB008, MB010, create_date')
		// 	->from('CMSMB')
		// 	->order_by($order)
		// 	->limit($limit, $offset);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['cmsi02']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('CMSMB');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['cmsi02']['search']['where'] = $where;
		$_SESSION['cmsi02']['search']['order'] = $order;
		$_SESSION['cmsi02']['search']['offset'] = $offset;

		return $ret;
	}

	//ajax 檢查資料重覆 
	function ajaxkey($seg1)
	{
		$this->db->set('MB001', $this->uri->segment(4));
		$this->db->where('MB001', $this->uri->segment(4));
		$query = $this->db->get('CMSMB');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->MB002;
			}
			return $result;
		}
	}

	//查詢一筆 修改用   
	function selone()
	{
		$this->db->select('*');
		$this->db->from('CMSMB');
		$this->db->where('MB001', $this->uri->segment(4));
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
	}

	//進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)
	{
		//$seq5='';$seq51='';$seq7='';$seq71='';		  
		$seq11 = "SELECT COUNT(*) as count  FROM `CMSMB` ";
		$seq1 = " MB001, MB002, MB003, MB004, MB005, MB006,MB007,MB008,MB009,MB010, create_date FROM `CMSMB` ";
		$seq2 = "WHERE `create_date` >=' ' ";
		$seq32 = "`create_date` >='' ";
		$seq33 = 'MB001 desc';
		$seq9 = " ORDER BY MB001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`create_date` >='' ";
		// $seq5=$this->session->userdata('find05');
		//  $seq7=$this->session->userdata('find07');
		$seq7 = "MB001 ";

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
		if (@$_SESSION['cmsi02_sql_term']) {
			$seq32 = $_SESSION['cmsi02_sql_term'];
		}
		if (@$_SESSION['cmsi02_sql_sort']) {
			$seq33 = $_SESSION['cmsi02_sql_sort'];
		}

		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('MB001', 'MB002', 'MB003', 'MB004', 'MB005', 'MB006', 'MB007', 'MB008', 'MB009', 'MB010', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'MB001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('MB001, MB002, MB003, MB004, MB005, MB006,MB007,MB008,MB009,MB010, create_date')
			->from('CMSMB')
			->where($seq32)
			->order_by($seq33)
			//->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('CMSMB')
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
		$sort_columns = array('MB001', 'MB002', 'MB003', 'MB004', 'MB005', 'MB006', 'MB007', 'MB008', 'MB009', 'MB010', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'MB001';  //檢查排序欄位是否為 table

		$this->db->select('MB001, MB002, MB003, MB004, MB005, MB006,MB007,MB008,MB009,MB010, create_date');
		$this->db->from('CMSMB');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		//$this->db->order_by('MB001 asc, MB002 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('CMSMB');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//查新增是否重複  
	function selone1($seg1)
	{
		$this->db->set('MB001', $this->input->post('MB001'));
		$this->db->where('MB001', $this->input->post('MB001'));
		$query = $this->db->get('CMSMB');
		return $query->num_rows();
	}

	//新增一筆	
	function insertf()
	{
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'MB001' => $this->input->post('MB001'),
			'MB002' => $this->input->post('MB002'),
			'MB003' => $this->input->post('MB003'),
			'MB004' => $this->input->post('MB004'),
			'MB005' => $this->input->post('MB005'),
			'MB006' => $this->input->post('MB006'),
			'MB007' => $this->input->post('MB007'),
			'MB008' => $this->input->post('MB008'),
			'MB009' => $this->input->post('MB009'),
			'MB010' => $this->input->post('MB010')
		);

		$exist = $this->cmsi02_model->selone1($this->input->post('MB001'));
		if ($exist) {
			return 'exist';
		}
		return  $this->db->insert('CMSMB', $data);
	}

	//查複製資料是否重複	 
	function selone2($seg1)
	{
		$this->db->set('MB001', $this->input->post('MB002c'));
		$this->db->where('MB001', $this->input->post('MB002c'));
		$query = $this->db->get('CMSMB');
		return $query->num_rows();
	}

	function copyf()           //複製一筆
	{
		$seq1 = $this->input->post('MB001c');
		$seq2 = $this->input->post('MB002c');
		$this->db->set('MB001', $this->input->post('MB001c'));
		$this->db->where('MB001', $this->input->post('MB001c'));

		$query = $this->db->get('CMSMB');
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
				$MB002 = $row->MB002;
				$MB003 = $row->MB003;
				$MB004 = $row->MB004;
				$MB005 = $row->MB005;
				$MB006 = $row->MB006;
				$MB007 = $row->MB007;
				$MB008 = $row->MB008;
				$MB009 = $row->MB009;
				$MB010 = $row->MB010;
			endforeach;
		}

		$seq3 = $this->input->post('MB002c');    //主鍵一筆
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
			'MB001' => $seq3,
			'MB002' => $MB002,
			'MB003' => $MB003,
			'MB004' => $MB004,
			'MB005' => $MB005,
			'MB006' => $MB006,
			'MB007' => $MB007,
			'MB008' => $MB008,
			'MB009' => $MB009,
			'MB010' => $MB010
		);
		$exist = $this->cmsi02_model->selone2($this->input->post('MB002c'));
		if ($exist) {
			return 'exist';
		}
		return $this->db->insert('CMSMB', $data);      //複製一筆  
	}

	//轉excel檔	 
	function excelnewf()
	{
		$seq1 = $this->input->post('MB001c');
		$seq2 = $this->input->post('MB002c');
		$sql = " SELECT MB001,MB002,MB003,MB004,MB005,MB008,create_date FROM CMSMB WHERE MB001 >= '$seq1'  AND MB001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('MB001c');
		$seq2 = $this->input->post('MB002c');
		$sql = " SELECT * FROM CMSMB WHERE MB001 >= '$seq1'  AND MB001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();

		$seq32 = "MB001 >= '$seq1'  AND MB001 <= '$seq2'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('CMSMB')
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
			'MB002' => $this->input->post('MB002'),
			'MB003' => $this->input->post('MB003'),
			'MB004' => $this->input->post('MB004'),
			'MB005' => $this->input->post('MB005'),
			'MB006' => $this->input->post('MB006'),
			'MB007' => $this->input->post('MB007'),
			'MB008' => $this->input->post('MB008'),
			'MB009' => $this->input->post('MB009'),
			'MB010' => $this->input->post('MB010')
		);
		$this->db->where('MB001', $this->input->post('MB001'));

		$this->db->update('CMSMB', $data);                   //更改一筆
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	//刪除一筆	
	function deletef($seg1, $seg2)
	{
		$seg1 = $this->uri->segment(4);
		$this->db->where('MB001', $seg1);
		$this->db->delete('CMSMB');
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	//選取刪除  
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
				//$seq2;
				$this->db->where('MB001', $seq1);
				$this->db->delete('CMSMB');
			}
		}
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	/*==以下AJAX處理區域==*/
	/*==以下AJAX處理區域==*/
	function ajaxcmsi03($seg1)    //ajax 查詢一筆 顯示用 廠別6
	{
		$this->db->set('MB001', $this->uri->segment(4));
		$this->db->where('MB001', $this->uri->segment(4));
		$query = $this->db->get('CMSMB');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->MB002;
			}
			return $result;
		}
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword)
	{
		$this->db->select('MB001, MB002');
		$this->db->from('CMSMB');
		$this->db->like('MB001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('MB002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	function lookup2($keyword)
	{
		// $MB001 = urldecode(urldecode($this->uri->segment(4)));
		// $this->db->select('MB001, MB002');
		// $this->db->from('CMSMB');
		// $this->db->where('MB001', $keyword);
		// $query = $this->db->get();
		// return $query->result();
		$sql98 = " select * from dbo.CMSMB where MB001 = '$keyword' ";
		$query = $this->db->query($sql98);

		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 廠別
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
		$this->db->select($sel_col)->from('CMSMB');
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
}
/* End of file model.php */
/* Location: ./application/model/model.php */
