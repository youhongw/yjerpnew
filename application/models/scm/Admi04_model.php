<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admi04_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//欄位表頭排序流覽資料
	//建構SQL字串
	// function construct_sql($limit = 10, $offset = 0, $func = "")
	// {

	// 	$this->session->set_userdata('admi04_search', "display_search/" . $offset);
	// 	if (session_status() == PHP_SESSION_NONE) {
	// 		session_start();
	// 	}
	// 	$where = '';
	// 	if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
	// 	{
	// 		unset($_SESSION['admi04']['search']);
	// 	}
	// 	if ($this->uri->segment(3, 0) == "clear_sql_term") {
	// 		unset($_SESSION['admi04']['search']);
	// 	}


	// 	if (is_array($this->input->get())) {
	// 		extract($this->input->get());
	// 		//	echo var_dump($val);exit ;    //第一次空白
	// 		if (@$val != null) {
	// 			$temp_url = explode(".html", $val);
	// 			$val = "";
	// 			foreach ($temp_url as $k => $v) {
	// 				$val .= $v;
	// 			}
	// 		}
	// 	}
	// 	$default_where = ""; //在這裡塞入一些預設條件，如不顯示離職員工等等
	// 	$default_order = "A.MB001 asc, A.MB002 desc"; //在這裡塞入一些預設排序

	// 	/* where 處理區域 */
	// 	if ($default_where) {
	// 		$where = "(" . $default_where . ")";
	// 	} else {
	// 		$where = "";
	// 	}

	// 	if (isset($_SESSION['admi04']['search']['where'])) {
	// 		if ($where) {
	// 			$where .= " and ";
	// 		}
	// 		$where .= $_SESSION['admi04']['search']['where'];
	// 	}

	// 	if ($this->input->post('find005')) {
	// 		if ($where) {
	// 			$where .= " and ";
	// 		}
	// 		$where .= $this->input->post('find005');
	// 	}

	// 	$off2 = $this->uri->segment(5);
	// 	if ($off2 == 'and_where') {
	// 		$func = 'and_where';
	// 	}
	// 	if ($off2 == 'or_where') {
	// 		$func = 'or_where';
	// 	}
	// 	//echo var_dump($func,$key,$val);exit ;
	// 	if ($func == "and_where" && @strlen($key) + @strlen($val) != 0) {
	// 		if ($where) {
	// 			$where .= " and ";
	// 		}
	// 		$key_ary = explode(",", $key);
	// 		$val_ary = explode(",", $val);
	// 		$value = "";
	// 		foreach ($key_ary as $key => $val) {
	// 			if ($value != "") {
	// 				$value .= " and ";
	// 			}
	// 			//$value .= $val." like '%".$val_ary[$key]."%' ";

	// 			if ($val != "chkbx") {
	// 				$value .= $val . " like '%" . $val_ary[$key] . "%' ";
	// 			}
	// 			//$value .= $val." like '".$val_ary[$key]."%' ";}
	// 		}
	// 		$where .= "(" . iconv("utf-8", "big-5//IGNORE", $value) . ")";
	// 	}
	// 	//  echo var_dump($where);' WHERE '  iconv("big-5","utf-8//IGNORE", $row->MA027)

	// 	if ($func == "or_where" && @strlen($key) + @strlen($val) != 0) {
	// 		if ($where) {
	// 			$where .= " or ";
	// 		}
	// 		$key_ary = explode(",", $key);
	// 		$val_ary = explode(",", $val);
	// 		$value = "";
	// 		foreach ($key_ary as $key => $val) {
	// 			if ($value != "") {
	// 				$value .= " or ";
	// 			}
	// 			$value .= $val . " like '" . $val_ary[$key] . "%' ";
	// 		}
	// 		$where .= ' WHERE ' . "(" . $value . ")";
	// 	}

	// 	if ($where == "") {
	// 		$where = false;
	// 	}
	// 	/* where end */

	// 	/* order 處理區域 */
	// 	if ($this->input->post('find007')) {
	// 		$order = $this->input->post('find007');
	// 	} else {
	// 		$order = "";
	// 	}

	// 	if ($func == "order" && @strlen($val) != 0) {
	// 		$value = $val;
	// 		$order = $value;
	// 	} else {
	// 		$order = "";
	// 	}

	// 	if (isset($_SESSION['admi04']['search']['order'])) {
	// 		if ($order) {
	// 			$order .= " , ";
	// 		}
	// 		$order .= $_SESSION['admi04']['search']['order'];
	// 	}

	// 	if (!isset($_SESSION['admi04']['search']['order']) && $default_order) {
	// 		if ($order) {
	// 			$order .= " , ";
	// 		}
	// 		$order .= $default_order;
	// 	}
	// 	/* order end */

	// 	/* Data SQL */
	// 	/*$query = $this->db->select('A.MA001,A.MA003,A.MA005,A.MA006,A.MA008,A.MA027')
	// 		->from('dbo.COPMA AS A')
	// 		->order_by($order);
	// 	if($where){
	// 		$query->where($where);
	// 	} */
	// 	$off1 = $this->uri->segment(4);
	// 	$off2 = $this->uri->segment(5);
	// 	if ((!isset($off1)) or ($off1 == '') or ($off1 == '0')) {
	// 		$off1 = " 1 ";
	// 	}

	// 	if ($where >= '') {
	// 		$where = $where . "";
	// 	}
	// 	if ((!isset($where)) or ($where == '')) {
	// 		$where = " WHERE A.MB001>='0' AND B.MA002>='0' AND C.MB002>='0' ";
	// 	}


	// 	ini_set('max_execution_time', 120);
	// 	//	echo var_dump('test');exit;
	// 	$sql21 = " SELECT TOP $limit  A.MB001,B.MA002,B.MA002 AS MB001DISP,A.MB002,C.MB002,C.MB003,C.MB002 AS MB002DISP,
	// 		          C.MB003 AS MB002DISP1,A.MB003,A.MB008,A.MB010,A.MB009
	//                 FROM COPMB AS A LEFT JOIN COPMA AS B ON A.MB001=B.MA001 
	//                LEFT JOIN INVMB AS C ON  A.MB002=C.MB001 
	//                  ";

	// 	$offset1 = "  AND   A.MB001 Not in
	//                   (Select top $off1 MB001 from COPMB order by MB001)					   
	// 				   ORDER BY A.MB001,A.MB002 
	//          ";
	// 	$sql21 = $sql21 . $where . $offset1;
	// 	$query = $this->db->query($sql21);
	// 	//echo var_dump($this->db->last_query());
	// 	//echo var_dump('test');exit;
	// 	$ret['data'] = $query->result();
	// 	//建構暫存view 1060614 上頁下頁使用
	// 	//$this->construct_view($ret['data']);


	// 	$sql21 = " SELECT TOP $limit  A.MB001,B.MA002,B.MA002 AS MB001DISP,A.MB002,C.MB002,C.MB003,C.MB002 AS MB002DISP,
	// 		          C.MB003 AS MB002DISP1,A.MB003,A.MB008,A.MB010,A.MB009
	//                 FROM COPMB AS A LEFT JOIN COPMA AS B ON A.MB001=B.MA001 
	//                LEFT JOIN INVMB AS C ON  A.MB002=C.MB001 
	//                  ";


	// 	$offset1 = "  AND   A.MB001 Not in
	//                   (Select top $off1 MB001 from COPMB order by MB001)					   
	// 				   ORDER BY A.MB001,A.MB002
	//          ";
	// 	$sql21 = $sql21 . $where . $offset1;
	// 	$query = $this->db->query($sql21);

	// 	$ret['data'] = $query->result();
	// 	//儲存sql
	// 	$_SESSION['admi04']['search']['sql'] = $this->db->last_query();

	// 	/* Num SQL*/

	// 	$sql22 = " SELECT  COUNT(*) as total_num FROM  dbo.COPMB AS A
	// 				    ";
	// 	$query = $this->db->query($sql22);
	// 	$ret['num'] = $query->result();
	// 	$ret['num'] = $ret['num'][0]->total_num;

	// 	//儲存where與order
	// 	$_SESSION['admi04']['search']['where'] = $where;
	// 	$_SESSION['admi04']['search']['order'] = $order;
	// 	$_SESSION['admi04']['search']['offset'] = $offset;

	// 	return $ret;
	// }

	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('admi04_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['admi04']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['admi04']['search']);
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
		$default_order = " a.TA002 "; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['admi04']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['admi04']['search']['where'];
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
				$value .= $val . " like '" . $val_ary[$key] . "%' ";  //%% 合部搜尋 先一個 like '%
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

		if (isset($_SESSION['admi04']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['admi04']['search']['order'];
		}

		if (!isset($_SESSION['admi04']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		$order = $default_order;
		/* order end */

		/* Data SQL */
		// $query = $this->db->select('a.*,c.mq002,b.mw002 as td004disp')
		// 	->from('sfctd as a')
		// 	->join('cmsmw as b', 'a.td004 = b.mw001', 'left')
		// 	->join('cmsmq as c', 'a.td001 = c.mq001', 'left')
		// 	->order_by($order);
		// if ($where) {
		// 	$query->where($where);
		// }

		// //建構暫存view 1060614 上一頁,下一頁使用
		// $this->construct_view($ret['data']);

		// $query = $this->db->select('a.*,c.mq002,b.mw002 as td004disp')
		// 	->from('sfctd as a')
		// 	->join('cmsmw as b', 'a.td004 = b.mw001', 'left')
		// 	->join('cmsmq as c', 'a.td001 = c.mq001', 'left')
		// 	->order_by($order)
		// 	->limit($limit, $offset);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();



		$sql = " SELECT *  FROM  admme $where and me001 IN 
			(SELECT TOP $limit me001 FROM admme $where and me001 NOT IN
				(SELECT TOP $offset  me001 FROM admme $where ORDER BY me001)
			ORDER BY me001)
		 ORDER BY me001 
		 ";
		if ($where == "") {
			$sql = " SELECT * FROM admme WHERE me001 IN 
				(SELECT TOP $limit me001 FROM admme WHERE me001 NOT IN
					(SELECT TOP $offset me001 FROM admme ORDER BY me001)
				ORDER BY me001)
			ORDER BY me001
			";
		}

		$query = $this->db->query($sql);
		$ret['data'] = $query->result();


		//儲存sql 語法回傳查詢字串
		$_SESSION['admi04']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('sfctd as a')
		// 	->join('cmsmq as c', 'a.td001 = c.mq001', 'left');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		// $ret['num'] = count($ret['data']);

		$sql = " SELECT count(*) as total_num from admme $where ";
		if ($where == "") {
			$sql = " SELECT count(*) as total_num from admme  ";
		}
		$query = $this->db->query($sql);
		$ret['num'] =  $query->result()[0]->total_num;

		// echo "<pre>";
		// var_dump($ret);
		// exit;

		//儲存where與order
		$_SESSION['admi04']['search']['where'] = $where;
		$_SESSION['admi04']['search']['order'] = $order;
		$_SESSION['admi04']['search']['offset'] = $offset;

		return $ret;
	}

	//***新增暫存view表方法construct_view
	function construct_view($data)
	{
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"MB001"
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
		$_SESSION['admi04']['search']['view'] = $view_array;
		$_SESSION['admi04']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['admi04']['search']['view']);exit;

	}
	//查詢一筆 修改用	
	function selone($seq1)
	{
		/*$this->db->select('a.*,b.me002 as MA004disp,c.me002 as MA007disp');	
		 $this->db->from('barme as a');	
		 $this->db->join('admme as b', 'a.MA004 = b.me001 ','left');
         $this->db->join('cmsme as c', 'a.MA007 = c.me001 ','left');
	     $this->db->where('MA001', $this->uri->segment(4)); */
		// $sql21 = " SELECT  A.CREATE_DATE,A.MA001,A.MA002,A.MA003,A.MA005,A.MA006,A.MA008,A.MA027
		//      		   FROM  dbo.COPMA AS A WHERE MA001='$seq1' ";

		$sql21 = " SELECT * FROM  dbo.admme WHERE me001='$seq1' ";
		$query = $this->db->query($sql21);
		// $query = $this->db->get();
		// if ($query->num_rows() > 0) {
		$result = $query->result();
		return $result;


		// }
	}

	//進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)
	{
		$seq11 = "SELECT COUNT(*) as count  FROM `barme` ";
		$seq1 = " MA001, MA002, MA003,MA004,MA005,MA006,MA007,  create_date FROM `barme` ";
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
		if (@$_SESSION['admi04_sql_term']) {
			$seq32 = $_SESSION['admi04_sql_term'];
		}
		if (@$_SESSION['admi04_sql_sort']) {
			$seq33 = $_SESSION['admi04_sql_sort'];
		}

		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('MA001', 'MA002', 'MA003', 'MA004', 'MA005', 'MA006', 'MA007', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'MA001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('a.*,b.me002 as MA004disp, c.me002 as MA007disp')
			->from('barme as a')
			->join('admme as b', 'a.MA004=b.me001', 'left')
			->join('cmsme as c', 'a.MA007=c.me001', 'left')
			->where($seq32)
			->order_by($seq33)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('barme')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//新增  查詢資料是否重複  
	function CheckRepeat($seq1)
	{
		$this->db->where('MA001', $seq1);
		$query = $this->db->get('barme');
		return $query->num_rows();
	}

	//新增一筆	
	function insertf()
	{
		$creator = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		$vme001 = trim($this->input->post('me001'));
		$vme002 = trim($this->input->post('me002'));
		$vme002 = iconv("utf-8", "BIG5", $vme002);
		$vme003 = trim($this->input->post('me003'));
		$vme004 = trim($this->input->post('me004'));
		$vme004 = iconv("utf-8", "BIG5", $vme004);

		$sql = " INSERT INTO dbo.admme (creator, create_date, flag, me001, me002, me003, me004)
							VALUES ('$creator', '$vtoday', '0', '$vme001', '$vme002', '$vme003', '$vme004')";


		return  $this->db->query($sql);
	}

	//轉excel檔	 
	function excelnewf()
	{
		$seq1 = $this->input->post('MA001c');    //查詢一筆以上
		$seq2 = $this->input->post('MA002c');
		$sql = " SELECT MA001,MA002,MA003,MA004,MA005,MA007,create_date FROM barme WHERE MA001 >= '$seq1' AND MA001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('MA001c');
		$seq2 = $this->input->post('MA002c');
		$sql = " SELECT a.*,b.me002 as MA004disp,c.me002 as MA007disp FROM barme as a left join admme as b on a.MA004=b.me001 left join cmsme as c on a.MA007=c.me001  WHERE MA001 >= '$seq1'  AND MA001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();

		$seq32 = "MA001 >= '$seq1'  AND MA001 <= '$seq2'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('barme')
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
		$vme001 = trim($this->input->post('me001'));
		$vme002 = trim($this->input->post('me002'));
		$vme002 = iconv("utf-8", "BIG5", $vme002);
		$vme003 = trim($this->input->post('me003'));
		$vme004 = trim($this->input->post('me004'));
		$vme004 = iconv("utf-8", "BIG5", $vme004);
		$vflag = trim($this->input->post('flag')) + 1;


		$sql = " UPDATE dbo.admme SET me002='$vme002', me003='$vme003', me004='$vme004', modifier='$vmodifier', modi_date='$vtoday', flag='$vflag'
							where me001='$vme001' ";

		return $this->db->query($sql);
	}

	//刪除一筆	
	function deletef($seg1)
	{
		// $seg1=$this->uri->segment(4);
		// $seg2=$this->uri->segment(5); 
		$this->db->where('MA001', $seg1);
		$this->db->delete('barme');
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
				// $this->db->where('MA001', $seq1);
				// $this->db->delete('barme');
				$relust = $this->db->query(" DELETE FROM dbo.admme WHERE me001='$seq1'; ");
			}
		}
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }
		return $relust;
	}

	//ajax 查詢一筆主鍵 有無重複	
	function check_key($seq1)
	{
		// $this->db->select('MA001,MA002')
		// 	->from('barme')
		// 	->where('MA001', $MA001);
		// $query = $this->db->get();
		// $result = $query->result();
		// //  echo "<pre>";var_dump($result->mg003);exit;	
		// if ($query->num_rows() == 1) {
		// 	return "資料重複!請重新輸入";
		// } else {
		// 	return "";
		// }

		$sql98 = " select * from dbo.admme where me001 = '$seq1' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	function check_admi04($seq)
	{
		$sql = " SELECT * FROM admme WHERE me001='$seq'
				";
		$query = $this->db->query($sql);

		$result = $query->result();

		if (count($result) > 0) {
			return mb_convert_encoding(trim($result[0]->me002), "utf-8", "big-5");
		} else {
			return 'N';
		}
	}

	//ajax 查詢 顯示 使用者權限	1050803 new
	function ajaxadmi04a($seg1)
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
	//取單號 最大值加1
	function check_title_no($vdate)
	{
		preg_match_all('/\d/S', $vdate, $matches);  //處理日期字串
		$vdate = implode('', $matches[0]);
		$this->db->select('MAX(MA001) as max_no')
			->from('barme')
			->where('create_date', $vdate);

		$query = $this->db->get();
		$result = $query->result();

		if (!$result[0]->max_no) {
			return $vdate . "0001";
		}

		return $result[0]->max_no + 1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
