<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admi00_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}


	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 10, $offset = 0, $func = "")
	{
		$this->session->set_userdata('admi00_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['admi00']['search']);
		}

		//SELECT 代號 ,名稱 ,密碼 ,群組代號,超級使用者('N','Y'),備註(改權限使用),部門
		$sql21 = " select a.*,b.me002 as mf004disp,c.ME002 as mf007disp 
						FROM dbo.admmf as a
							LEFT JOIN admme as b on a.mf004=b.me001 
							LEFT JOIN CMSME as c on a.mf007=c.ME001
				 ";

		$query = $this->db->query($sql21);
		$ret['data'] = $query->result();
		//儲存sql 語法
		$ret['num_sql'] = $this->db->last_query();
		$_SESSION['admi00']['search']['sql'] = $this->db->last_query();

		$ret['num'] = count($ret['data']);

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
		$sort_columns = array('mf001', 'mf002', 'mf003', 'mf004', 'mf005', 'mf006', 'mf007', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'TA001';  //檢查排序欄位是否為 table
		$this->db->select('b.idno,a.mf001, a.mf002,a.mf003, a.mf004, a.mf005,a.mf006,a.mf007,a.mf008, a.create_date');
		$this->db->from('barma as a');
		$this->db->join('barma_temp as b', 'a.mf001 = b.mf001 ', 'left');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		// $this->db->order_by('mf001 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();

		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('barma');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}
	//篩選多筆    
	function filterf1test($limit = 10, $offset, $sort_by, $sort_order)
	{
		$seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼  
		if (substr($seq4, 0, 4) == '2021' and substr($seq4, 6, 2) != '') {
			$seq4 = substr($seq4, 0, 4) . '/' . substr($seq4, 4, 2) . '/' . substr($seq4, 6, 2);
		}
		$sort_by = $this->uri->segment(4);
		$sort_order = $this->uri->segment(5);
		$offset = $this->uri->segment(8, 0);
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('mf001', 'mf002', 'mf003', 'mf004', 'mf005', 'mf006', 'mf008');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否為 table


		$sql21 = " select top $limit a.create_date,a.mf001,a.mf002,a.mf003,a.mf004,a.mf005,a.mf006,
			           a.mf007,a.mf008
			           from  barma AS a where $sort_by like '$seq4'  
					    ";
		$query = $this->db->query($sql21);
		$ret['rows'] = $query->result();

		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('barma');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}
	//建構SQL字串
	function construct_sqltest($limit = 15, $offset = 0, $func = "")
	{
		$sql98a = " delete from invlz where lz005=0 and lz002>='0' and lz013!='3498' and lz013!='580' ";
		$this->db->query($sql98a);


		$this->session->set_userdata('admi00_search', "display_search/" . $offset);
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		{
			unset($_SESSION['admi00']['search']);
		}
		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['admi00']['search']);
		}


		if (is_array($this->input->get())) {
			extract($this->input->get());
			//	echo var_dump($val);exit ;    //第一次空白
			if (@$val != null) {
				$temp_url = explode(".html", $val);
				$val = "";
				foreach ($temp_url as $k => $v) {
					$val .= $v;
				}
			}
		}
		$default_where = ""; //在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mf001 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['admi00']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['admi00']['search']['where'];
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
				//$value .= $val." like '%".$val_ary[$key]."%' ";

				if ($val != "chkbx") {
					$value .= $val . " like '" . $val_ary[$key] . "%' ";
				}
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
					$value .= " or ";
				}
				$value .= $val . " like '" . $val_ary[$key] . "%' ";
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

		if (isset($_SESSION['admi00']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['admi00']['search']['order'];
		}

		if (!isset($_SESSION['admi00']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */
		$zdate = date('Ymd', strtotime(' -100 day'));
		/* Data SQL */
		$query = $this->db->select('a.*')
			->from('barma as a')
			->where('create_date >=', $zdate)
			->order_by($order)
			->limit($limit, $offset);
		if ($where) {
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);

		$query = $this->db->select('a.*')
			->from('barma as a')
			->where('create_date >=', $zdate)
			->order_by($order)
			->limit($limit, $offset);
		if ($where) {
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['admi00']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('barma as a');
		//if($where){
		//	$query->where($where);
		//}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;

		//儲存where與order
		$_SESSION['admi00']['search']['where'] = $where;
		$_SESSION['admi00']['search']['order'] = $order;
		$_SESSION['admi00']['search']['offset'] = $offset;

		return $ret;
	}

	//***新增暫存view表方法construct_view
	function construct_view($data)
	{
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mf001"
		);
		$view_array = array();
		$index_array = array();

		foreach ($data as $key => $val) {
			$key_str = "";
			foreach ($pk_array as $pk_k => $pk_v) {
				if ($key_str) {
					$key_str .= "_";
				}
				$key_str .= $val->$pk_v;
			}
			$view_array[$key_str] = $key;
			$index_array[$key] = $key_str;
		}
		$_SESSION['admi00']['search']['view'] = $view_array;
		$_SESSION['admi00']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['admi00']['search']['view']);exit;

	}
	//查詢一筆 修改用	
	function selone($seq1)
	{
		$sql98 = " select * from dbo.admmf where mf001 = '$seq1' ";
		$query = $this->db->query($sql98);
		$result = $query->result();

		return $result;
	}

	function selone1($seq1, $seq2, $seq3)
	{
		$sql98 = " select * from dbo.admmf where mf001='$seq1' and mf003='$seq2' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() == 1) {
			$vflag = $this->input->post('flag') + 1;
			$vmf003 = $seq3;

			$sql97 = " update dbo.admmf set flag='$vflag', mf003='$vmf003' where mf001='$seq1' and mf003='$seq2' ";
			$query = $this->db->query($sql97);

			return $query;
		} else {
			return '0'; //原密碼輸入錯誤!!!
		}
	}

	function selone2($seq1)
	{
		$sql98 = " select * from dbo.admmf where mf001 = '$seq1' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	//進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)
	{
		$seq11 = "SELECT COUNT(*) as count  FROM `barma` ";
		$seq1 = " mf001, mf002, mf003,mf004,mf005,mf006,mf007,  create_date FROM `barma` ";
		$seq2 = "WHERE `create_date` >=' ' ";
		$seq32 = "`create_date` >='' ";
		$seq33 = 'mf001 desc';
		$seq9 = " ORDER BY mf001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`create_date` >='' ";
		$seq7 = "mf001 ";

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
		if (@$_SESSION['admi00_sql_term']) {
			$seq32 = $_SESSION['admi00_sql_term'];
		}
		if (@$_SESSION['admi00_sql_sort']) {
			$seq33 = $_SESSION['admi00_sql_sort'];
		}

		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('mf001', 'mf002', 'mf003', 'mf004', 'mf005', 'mf006', 'mf007', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('a.*,b.me002 as mf004disp, c.me002 as mf007disp')
			->from('barma as a')
			->join('admme as b', 'a.mf004=b.me001', 'left')
			->join('cmsme as c', 'a.mf007=c.me001', 'left')
			->where($seq32)
			->order_by($seq33)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('barma')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}



	//新增一筆	
	function insertf()
	{
		$creator = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		$vmf001 = trim($this->input->post('mf001'));
		$vmf002 = trim($this->input->post('mf002'));
		$vmf002 = iconv("utf-8", "BIG5", $vmf002);
		$vmf003 = trim($this->input->post('mf003'));
		$vmf004 = trim($this->input->post('admi04'));	//群組
		$vmf005 = trim($this->input->post('mf005'));

		$vmf006 = $this->input->post('mf611') . $this->input->post('mf612') . $this->input->post('mf613') . $this->input->post('mf614') . $this->input->post('mf615')
			. $this->input->post('mf616') .	$this->input->post('mf617') . $this->input->post('mf618') . $this->input->post('mf619') . $this->input->post('mf620')
			. $this->input->post('mf621') . $this->input->post('mf622') . $this->input->post('mf623') . $this->input->post('mf624') . $this->input->post('mf625')
			. $this->input->post('mf626') .	$this->input->post('mf627') . $this->input->post('mf628') . $this->input->post('mf629') . $this->input->post('mf630')
			. $this->input->post('mf631') . $this->input->post('mf632') . $this->input->post('mf633') . $this->input->post('mf634') . $this->input->post('mf635')
			. $this->input->post('mf636') .	$this->input->post('mf637') . $this->input->post('mf638') . $this->input->post('mf639') . $this->input->post('mf640')
			. $this->input->post('mf641') . $this->input->post('mf642') . $this->input->post('mf643') . $this->input->post('mf644') . $this->input->post('mf645')
			. $this->input->post('mf646') . $this->input->post('mf647') . $this->input->post('mf648') . $this->input->post('mf649') . $this->input->post('mf650')
			. $this->input->post('mf651') . $this->input->post('mf652') . $this->input->post('mf653') . $this->input->post('mf654') . $this->input->post('mf655')
			. $this->input->post('mf656') . $this->input->post('mf657') . $this->input->post('mf658');


		$vmf007 = trim($this->input->post('cmsi05'));	//部門


		$sql = " INSERT INTO dbo.admmf (creator, create_date, flag, mf001, mf002, mf003, mf004, mf005, mf006, mf007)
							VALUES ('$creator', '$vtoday', '0', '$vmf001', '$vmf002', '$vmf003', '$vmf004', '$vmf005', '$vmf006', '$vmf007'); ";


		return  $this->db->query($sql);
	}

	//轉excel檔	 
	function excelnewf()
	{
		$seq1 = $this->input->post('mf001c');    //查詢一筆以上
		$seq2 = $this->input->post('mf002c');
		$sql = " SELECT mf001,mf002,mf003,mf004,mf005,mf007,create_date FROM barma WHERE mf001 >= '$seq1' AND mf001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('mf001c');
		$seq2 = $this->input->post('mf002c');
		$sql = " SELECT a.*,b.me002 as mf004disp,c.me002 as mf007disp FROM barma as a left join admme as b on a.mf004=b.me001 left join cmsme as c on a.mf007=c.me001  WHERE mf001 >= '$seq1'  AND mf001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();

		$seq32 = "mf001 >= '$seq1'  AND mf001 <= '$seq2'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('barma')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//更改一筆	 
	function updatef()
	{
		$vmodifier = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		$vmf001 = trim($this->input->post('mf001'));
		$vmf002 = trim($this->input->post('mf002'));
		$vmf002 = iconv("utf-8", "BIG5", $vmf002);
		$vmf003 = trim($this->input->post('mf003'));
		$vmf004 = trim($this->input->post('admi04'));
		$vmf005 = trim($this->input->post('mf005'));

		$vmf006 = $this->input->post('mf611') . $this->input->post('mf612') . $this->input->post('mf613') . $this->input->post('mf614') . $this->input->post('mf615')
			. $this->input->post('mf616') .	$this->input->post('mf617') . $this->input->post('mf618') . $this->input->post('mf619') . $this->input->post('mf620')
			. $this->input->post('mf621') . $this->input->post('mf622') . $this->input->post('mf623') . $this->input->post('mf624') . $this->input->post('mf625')
			. $this->input->post('mf626') .	$this->input->post('mf627') . $this->input->post('mf628') . $this->input->post('mf629') . $this->input->post('mf630')
			. $this->input->post('mf631') . $this->input->post('mf632') . $this->input->post('mf633') . $this->input->post('mf634') . $this->input->post('mf635')
			. $this->input->post('mf636') .	$this->input->post('mf637') . $this->input->post('mf638') . $this->input->post('mf639') . $this->input->post('mf640')
			. $this->input->post('mf641') . $this->input->post('mf642') . $this->input->post('mf643') . $this->input->post('mf644') . $this->input->post('mf645')
			. $this->input->post('mf646') . $this->input->post('mf647') . $this->input->post('mf648') . $this->input->post('mf649') . $this->input->post('mf650')
			. $this->input->post('mf651') . $this->input->post('mf652') . $this->input->post('mf653') . $this->input->post('mf654') . $this->input->post('mf655')
			. $this->input->post('mf656') . $this->input->post('mf657') . $this->input->post('mf658');


		$vmf007 = trim($this->input->post('cmsi05'));
		$vflag = $this->input->post('flag') + 1;

		$sql = " UPDATE dbo.admmf SET mf002='$vmf002', mf003='$vmf003', mf004='$vmf004', mf005='$vmf005', mf006='$vmf006', mf007='$vmf007', modifier='$vmodifier', modi_date='$vtoday', flag='$vflag'
							where mf001='$vmf001' ";

		// echo "<pre>";var_dump($sql);exit;
		return $this->db->query($sql);
	}

	//刪除一筆	
	function deletef($seg1, $seg2, $seg3, $seg4)
	{
		// $seg1=$this->uri->segment(4);
		// $seg2=$this->uri->segment(5);
		//刪轉移資料invlz
		$this->db->where('lz002', $seg2);
		$this->db->where('lz003', $seg3);
		$this->db->where('lz004', $seg4);
		$this->db->delete('invlz');

		$this->db->where('mf001', $seg1);
		$this->db->delete('barma');
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
		$relust = false;
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;
				list($seq1) = explode("/", $seq[$x]);
				$seq1;
				// $this->db->where('mf001', $seq1);
				// $this->db->delete('barma');
				$relust = $this->db->query(" DELETE FROM dbo.admmf WHERE mf001='$seq1'; ");
			}
		}
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }
		return $relust;
	}



	//ajax 查詢 顯示 使用者權限	1050803 new
	function ajaxadmi00a($seg1)
	{
		if ($this->session->userdata('syssuper') == 'Y') {
			$this->db->where('mg001', $this->session->userdata('manager'));
		} else {
			$this->db->where('mg001', $this->session->userdata('manager'));
			$this->db->where('mg002', $this->uri->segment(3));
		}
		$query = $this->db->get('admmg');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mg004;
				$this->session->set_userdata('sysmg006', $row->mg006);
			}

			if ($this->session->userdata('syssuper') == 'Y') {
				$result = 'Y';
				$this->session->set_userdata('sysmg006', "YYYYYYYYYYYY");
			}
			return $result;
		}
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
