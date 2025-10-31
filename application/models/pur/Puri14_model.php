<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Puri14_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}


	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('MA001', 'MA002', 'MA003', 'MA004', 'MA005', 'MA006', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'MA001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('MA001, MA002, MA003, MA004, MA005, MA006, create_date')
			->from('PURMA')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('PURMA');
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
		$this->session->set_userdata('puri14_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where") {
			unset($_SESSION['puri14']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['puri14']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql") {
			unset($_SESSION['puri14']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql1") {
			unset($_SESSION['puri14']['search']);
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
		$default_order = "MA001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['puri14']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['puri14']['search']['where'];
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

		if (isset($_SESSION['puri14']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['puri14']['search']['order'];
		}

		if (!isset($_SESSION['puri14']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		// /* Data SQL */
		// $query = $this->db->select(' * ')
		// 	->from('PURMA')
		// 	->order_by($order);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		// //建構暫存view
		// //$this->construct_view($ret['data']);

		// $query = $this->db->select(' * ')
		// 	->from('PURMA')
		// 	->order_by($order)
		// 	->limit($limit, $offset);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();



		$sql = " SELECT *  FROM  PURMA WHERE  $where and MA001 IN 
					(SELECT TOP $limit MA001 FROM PURMA WHERE $where and MA001 NOT IN
						(SELECT TOP $offset  MA001 FROM PURMA WHERE $where ORDER BY MA001)
					ORDER BY MA001)
				 ORDER BY MA001 
				 ";
		if ($where == "") {
			$sql = " SELECT *  FROM  PURMA WHERE MA001 IN 
						(SELECT TOP $limit MA001 FROM PURMA WHERE MA001 NOT IN
							(SELECT TOP $offset MA001 FROM PURMA ORDER BY MA001)
						ORDER BY MA001)
					ORDER BY MA001
			 		";
		}


		$query = $this->db->query($sql);
		$ret['data'] = $query->result();



		//儲存sql
		$_SESSION['puri14']['search']['sql'] = $this->db->last_query();

		// /* Num SQL*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('PURMA');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;

		$sql = " SELECT count(*) as total_num from PURMA WHERE $where ";
		if ($where == "") {
			$sql = " SELECT count(*) as total_num from PURMA";
		}
		$query = $this->db->query($sql);
		$ret['num'] =  $query->result()[0]->total_num;


		//儲存where與order
		$_SESSION['puri14']['search']['where'] = $where;
		$_SESSION['puri14']['search']['order'] = $order;
		$_SESSION['puri14']['search']['offset'] = $offset;

		return $ret;
	}


	//ajax 查詢資料重複
	function ajaxkey($seq1)
	{
		$sql98 = " select * from PURMA where MA001 = '$seq1' ";
		$query = $this->db->query($sql98);
		$result = $query->result();

		if (count($result) > 0) {
			return mb_convert_encoding(trim($result[0]->MA002), "utf-8", "big-5");
		} else {
			return 'N';
		}
	}

	//查詢一筆 修改用   
	function selone()
	{
		$this->db->select('PURMA.*, purmb.mb002 as MA003disp');
		$this->db->from('PURMA');
		//$this->db->set('MA001', $this->uri->segment(4)); 
		$this->db->where('MA001', $this->uri->segment(4));
		$this->db->join('purmb', 'PURMA.MA003 = purmb.mb001', 'left');
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
		$seq11 = "SELECT COUNT(*) as count  FROM `PURMA` ";
		$seq1 = " MA001, MA002, MA003, MA004, MA005, MA006,MA007, create_date FROM `PURMA` ";
		$seq2 = "WHERE `create_date` >=' ' ";
		$seq32 = "`create_date` >='' ";
		$seq33 = 'MA001 desc';
		$seq9 = " ORDER BY MA001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`create_date` >='' ";
		$seq7 = "MA001 ";

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
		if (@$_SESSION['puri14_sql_term']) {
			$seq32 = $_SESSION['puri14_sql_term'];
		}
		if (@$_SESSION['puri14_sql_sort']) {
			$seq33 = $_SESSION['puri14_sql_sort'];
		}

		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('MA001', 'MA002', 'MA003', 'MA004', 'MA005', 'MA006', 'MA007', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'MA001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('MA001, MA002, MA003, MA004, MA005, MA006,MA007, create_date')
			->from('PURMA')
			->where($seq32)
			->order_by($seq33)
			//->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('PURMA')
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
		$sort_columns = array('MA001', 'MA002', 'MA003', 'MA004', 'MA005', 'MA006', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'MA001';  //檢查排序欄位是否為 table
		$this->db->select('MA001, MA002, MA003, MA004, MA005, MA006, create_date');
		$this->db->from('PURMA');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		//$this->db->order_by('MA001 asc, MA002 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('PURMA');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//查新增資料是否重複 
	function selone1($seg1)
	{
		$this->db->set('MA001', $this->input->post('MA001'));
		$this->db->where('MA001', $this->input->post('MA001'));
		$query = $this->db->get('PURMA');
		return $query->num_rows();
	}

	//新增一筆	
	function insertf()
	{
		$sMA005 = $this->input->post('MA005');
		if ($sMA005 != 'Y') {
			$sMA005 = 'N';
		}
		$sMA006 = $this->input->post('MA006');
		if ($sMA006 != 'Y') {
			$sMA006 = 'N';
		}
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'MA001' => $this->input->post('MA001'),
			'MA002' => $this->input->post('MA002'),
			'MA003' => $this->input->post('purq02a'),
			'MA004' => $this->input->post('MA004'),
			'MA005' => $sMA005,
			'MA006' => $sMA006,
			'MA007' => $this->input->post('MA007')
		);

		$exist = $this->puri14_model->selone1($this->input->post('MA001'));
		if ($exist) {
			return 'exist';
		}
		return  $this->db->insert('PURMA', $data);
	}

	//查複製資料是否重複	 
	function selone2($seg1)
	{
		$this->db->set('MA001', $this->input->post('MA002c'));
		$this->db->where('MA001', $this->input->post('MA002c'));
		$query = $this->db->get('PURMA');
		return $query->num_rows();
	}

	//複製一筆	
	function copyf()           //複製一筆
	{
		$seq1 = $this->input->post('MA001c');
		$seq2 = $this->input->post('MA002c');
		$this->db->where('MA001', $this->input->post('MA001c'));
		$query = $this->db->get('PURMA');
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
				$MA002 = $row->MA002;
				$MA003 = $row->MA003;
				$MA004 = $row->MA004;
				$MA005 = $row->MA005;
				$MA006 = $row->MA006;
				$MA007 = $row->MA007;
			endforeach;
		}
		$seq3 = $this->input->post('MA002c');    //主鍵一筆

		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
			'MA001' => $seq3,
			'MA002' => $MA002,
			'MA003' => $MA003,
			'MA004' => $MA004,
			'MA005' => $MA005,
			'MA006' => $MA006,
			'MA007' => $MA007
		);
		$exist = $this->puri14_model->selone2($this->input->post('MA002c'));
		if ($exist) {
			return 'exist';
		}
		return $this->db->insert('PURMA', $data);      //複製一筆  
	}

	//轉excel檔	 
	function excelnewf()
	{
		$seq1 = $this->input->post('MA001c');    //查詢一筆以上
		$seq2 = $this->input->post('MA002c');
		$sql = " SELECT MA001,MA002,MA003,MA004,MA005,MA006,MA007,create_date FROM PURMA WHERE MA001 >= '$seq1'  AND MA001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('MA001c');    //查詢一筆以上
		$seq2 = $this->input->post('MA002c');
		$sql = " SELECT * FROM PURMA WHERE MA001 >= '$seq1'  AND MA001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();
		$seq32 = "MA001 >= '$seq1'  AND MA001 <= '$seq2'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('PURMA')
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
			'MA002' => $this->input->post('MA002'),
			'MA003' => $this->input->post('purq02a'),
			'MA004' => $this->input->post('MA004'),
			'MA005' => $this->input->post('MA005'),
			'MA006' => $this->input->post('MA006'),
			'MA007' => $this->input->post('MA007')
		);
		$this->db->where('MA001', $this->input->post('MA001'));

		$this->db->update('PURMA', $data);                   //更改一筆
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	//刪除一筆	
	function deletef($seg1, $seg2)
	{
		$seg1 = $this->uri->segment(4);
		$this->db->where('MA001', $seg1);
		$this->db->delete('PURMA');
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
				$this->db->where('MA001', $seq1);
				$this->db->delete('PURMA');
			}
		}
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}
	/*==以下AJAX處理區域==*/
	function ajaxpuri14($seg1)    //ajax 查詢一筆 顯示用 庫別6
	{
		$this->db->set('MA001', $this->uri->segment(4));
		$this->db->where('MA001', $this->uri->segment(4));
		$query = $this->db->get('PURMA');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->MA002;
			}
			return $result;
		}
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword)
	{
		$this->db->select('MA001, MA002');
		$this->db->from('PURMA');
		$this->db->like('MA001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('MA002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	function lookup2($keyword)
	{
		$MA001 = urldecode(urldecode($this->uri->segment(4)));
		$this->db->select('MA001, MA002');
		$this->db->from('PURMA');
		$this->db->where('MA001', $MA001);
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd($seq1, $seq2)
	{
		// $this->db->select('MA001, MA002');
		// $this->db->from('PURMA');
		// $this->db->like('MA001', urldecode(urldecode($this->uri->segment(4))), 'after');
		// $this->db->or_like('MA002', urldecode(urldecode($this->uri->segment(4))), 'after');
		// $this->db->limit('10');
		// $query = $this->db->get();
		// return $query->result();
		// 因為MV001前後有空白
		$sql98 = " SELECT * from purMX WHERE MX001='$seq1' and MX002='$seq2' ";
		$query = $this->db->query($sql98);
		$result = $query->result();

		//在此只有1筆才正確
		if (count($result) == 1) {
			return mb_convert_encoding(trim($result[0]->MX003), "utf-8", "big-5");
		} else {
			return 'N';
		}
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
		$this->db->select($sel_col)->from('PURMA');
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
