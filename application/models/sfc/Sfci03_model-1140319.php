<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class sfci03_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	private $cellArray = array(
		1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E',
		6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J',
		11 => 'K', 12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O',
		16 => 'P', 17 => 'Q', 18 => 'R', 19 => 'S', 20 => 'T',
		21 => 'U', 22 => 'V', 23 => 'W', 24 => 'X', 25 => 'Y',
		26 => 'Z',
		27 => 'AA', 28 => 'AB', 29 => 'AC', 30 => 'AD', 31 => 'AE',
		32 => 'AF', 33 => 'AG', 34 => 'AH', 35 => 'AI', 36 => 'AJ',
		37 => 'AK', 38 => 'AL', 39 => 'AM', 40 => 'AN', 41 => 'AO',
		42 => 'AP', 43 => 'AQ', 44 => 'AR', 45 => 'AS', 46 => 'AT',
		47 => 'AU', 48 => 'AV', 49 => 'AW', 50 => 'AX', 51 => 'AY',
		52 => 'AZ',
		53 => 'BA', 54 => 'BB', 55 => 'BC', 56 => 'BD', 57 => 'BE',
		58 => 'BF', 59 => 'BG', 60 => 'BH', 61 => 'BI', 62 => 'BJ',
		63 => 'BK', 64 => 'BL',	65 => 'BM', 66 => 'BN', 67 => 'BO',
		68 => 'BP', 69 => 'BQ', 70 => 'BR', 71 => 'BS',	72 => 'BT',
		73 => 'BU', 74 => 'BV', 75 => 'BW', 76 => 'BX', 77 => 'BY',
		78 => 'BZ',
		79 => 'CA', 80 => 'CB', 81 => 'CC', 82 => 'CD', 83 => 'CE',
		84 => 'CF', 85 => 'CG',	86 => 'CH', 87 => 'CI', 88 => 'CJ',
		89 => 'CK', 90 => 'CL', 91 => 'CM', 92 => 'CN',	93 => 'CO',
		94 => 'CP', 95 => 'CQ', 96 => 'CR', 97 => 'CS', 98 => 'CT',
		99 => 'CU',	100 => 'CV', 101 => 'CW', 102 => 'CX', 103 => 'CY',
		104 => 'CZ',
		105 => 'DA', 106 => 'DB', 107 => 'DC', 108 => 'DD', 109 => 'DE',
		110 => 'DF', 111 => 'DG', 112 => 'DH', 113 => 'DI', 114 => 'DJ',
		115 => 'DK', 116 => 'DL', 117 => 'DM', 118 => 'DN',	119 => 'DO',
		120 => 'DP', 121 => 'DQ', 122 => 'DR', 123 => 'DS', 124 => 'DT',
		125 => 'DU', 126 => 'DV', 127 => 'DW', 128 => 'DX', 129 => 'DY',
		130 => 'DZ'
	);
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num, $offset)
	{
		$this->db->select('td001, td002, td003, td004, td0011, td0019,td020, create_date');
		$this->db->from('sfctd');
		//$this->db->order_by('id', 'DESC');                //排序  單欄
		$this->db->order_by('td001 desc, td002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();
		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('sfctd');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('a.td001', 'a.td002', 'a.td003', 'a.td004', 'a.td011', 'a.td019', 'a.td030', 'b.ma002', 'a.create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('a.td001, a.td002, a.td003, a.td004, b.ma002,  a.td029, a.td030,a.create_date')
			->from('sfctd as a')
			->join('copma as b', 'a.td004 = b.ma001', 'left')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('sfctd');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03']['search']['where'];
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

		if (isset($_SESSION['sfci03']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03']['search']['order'];
		}

		if (!isset($_SESSION['sfci03']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
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
		$vday = date('Ymd', strtotime(' -180 day')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday'
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();
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
		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('sfctd as a')
		// 	->join('cmsmq as c', 'a.td001 = c.mq001', 'left');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03']['search']['where'] = $where;
		$_SESSION['sfci03']['search']['order'] = $order;
		$_SESSION['sfci03']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 a  鑄造報工
	function constructa_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03a_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03a']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03a']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03a']['search']['where'];
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

		if (isset($_SESSION['sfci03a']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03a']['search']['order'];
		}

		if (!isset($_SESSION['sfci03a']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D401' or a.TD001='D501')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03a']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03a']['search']['where'] = $where;
		$_SESSION['sfci03a']['search']['order'] = $order;
		$_SESSION['sfci03a']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 b  車削報工
	function constructb_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03b_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03b']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03b']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03b']['search']['where'];
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

		if (isset($_SESSION['sfci03b']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03b']['search']['order'];
		}

		if (!isset($_SESSION['sfci03b']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D402' or a.TD001='D502')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03b']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03b']['search']['where'] = $where;
		$_SESSION['sfci03b']['search']['order'] = $order;
		$_SESSION['sfci03b']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 c  橡膠報工
	function constructc_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03c_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03c']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03c']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03c']['search']['where'];
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

		if (isset($_SESSION['sfci03c']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03c']['search']['order'];
		}

		if (!isset($_SESSION['sfci03c']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and a.TD001='D403'
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03c']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03c']['search']['where'] = $where;
		$_SESSION['sfci03c']['search']['order'] = $order;
		$_SESSION['sfci03c']['search']['offset'] = $offset;

		return $ret;
	}

	function constructc1_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03c1_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03c1']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03c1']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03c1']['search']['where'];
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

		if (isset($_SESSION['sfci03c1']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03c1']['search']['order'];
		}

		if (!isset($_SESSION['sfci03c1']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and a.TD001='D503'
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03c1']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03c1']['search']['where'] = $where;
		$_SESSION['sfci03c1']['search']['order'] = $order;
		$_SESSION['sfci03c1']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 d  注塑報工
	function constructd_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03d_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03d']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03d']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03d']['search']['where'];
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

		if (isset($_SESSION['sfci03d']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03d']['search']['order'];
		}

		if (!isset($_SESSION['sfci03d']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D404' or a.TD001='D504')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03d']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03d']['search']['where'] = $where;
		$_SESSION['sfci03d']['search']['order'] = $order;
		$_SESSION['sfci03d']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 e  PU報工
	function constructe_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03e_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03e']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03e']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03e']['search']['where'];
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

		if (isset($_SESSION['sfci03e']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03e']['search']['order'];
		}

		if (!isset($_SESSION['sfci03e']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D405' or a.TD001='D505')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03e']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03e']['search']['where'] = $where;
		$_SESSION['sfci03e']['search']['order'] = $order;
		$_SESSION['sfci03e']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 f  噴漆報工
	function constructf_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03f_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03f']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03f']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03f']['search']['where'];
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

		if (isset($_SESSION['sfci03f']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03f']['search']['order'];
		}

		if (!isset($_SESSION['sfci03f']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D406' or a.TD001='D506')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03f']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03f']['search']['where'] = $where;
		$_SESSION['sfci03f']['search']['order'] = $order;
		$_SESSION['sfci03f']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 g  衝壓報工
	function constructg_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03g_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03g']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03g']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03g']['search']['where'];
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

		if (isset($_SESSION['sfci03g']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03g']['search']['order'];
		}

		if (!isset($_SESSION['sfci03g']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */
        $vday ='20250101';
		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D407' or a.TD001='D507')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03g']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03g']['search']['where'] = $where;
		$_SESSION['sfci03g']['search']['order'] = $order;
		$_SESSION['sfci03g']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 h  緊固件
	function constructh_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03h_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03h']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03h']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03h']['search']['where'];
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

		if (isset($_SESSION['sfci03h']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03h']['search']['order'];
		}

		if (!isset($_SESSION['sfci03h']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D408' or a.TD001='D508')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03h']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03h']['search']['where'] = $where;
		$_SESSION['sfci03h']['search']['order'] = $order;
		$_SESSION['sfci03h']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 i  衝壓報工
	function constructi_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03i_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03i']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03i']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03i']['search']['where'];
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

		if (isset($_SESSION['sfci03i']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03i']['search']['order'];
		}

		if (!isset($_SESSION['sfci03i']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D409' or a.TD001='D509')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03i']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03i']['search']['where'] = $where;
		$_SESSION['sfci03i']['search']['order'] = $order;
		$_SESSION['sfci03i']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 j  鉚合報工
	function constructj_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03j_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03j']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03j']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03j']['search']['where'];
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

		if (isset($_SESSION['sfci03j']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03j']['search']['order'];
		}

		if (!isset($_SESSION['sfci03j']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D410' or a.TD001='D510')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03j']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03j']['search']['where'] = $where;
		$_SESSION['sfci03j']['search']['order'] = $order;
		$_SESSION['sfci03j']['search']['offset'] = $offset;

		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法 k  裝配報工
	function constructk_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03k_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03k']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03k']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03k']['search']['where'];
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

		if (isset($_SESSION['sfci03k']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03k']['search']['order'];
		}

		if (!isset($_SESSION['sfci03k']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D411' or a.TD001='D511')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03k']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03k']['search']['where'] = $where;
		$_SESSION['sfci03k']['search']['order'] = $order;
		$_SESSION['sfci03k']['search']['offset'] = $offset;

		return $ret;
	}
	
	//建構SQL字串 新增純粹以sql做查詢的方法 h  緊固件
	function constructl_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03l_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03l']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03l']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03l']['search']['where'];
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

		if (isset($_SESSION['sfci03l']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03l']['search']['order'];
		}

		if (!isset($_SESSION['sfci03l']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
										left join  CMSMD as b on a.TD004 = b.MD001
										left join  CMSMQ as c on a.TD001 = c.MQ001 
										where a.TD003 >='$vday' and (a.TD001='D412' or a.TD001='D512')
										order by a.TD002 DESC 
										");
		$ret['data'] = $query->result();

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03l']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/

		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03l']['search']['where'] = $where;
		$_SESSION['sfci03l']['search']['order'] = $order;
		$_SESSION['sfci03l']['search']['offset'] = $offset;

		return $ret;
	}

    function sqlrd()
	{
     $sqla = "DELETE FROM SFCI03GP WHERE 1=1 ";
		$this->db->query($sqla);
	$sqlb = "SELECT *  FROM CMSMDD WHERE convert(float,MD013)>0 
	              ORDER BY MD001,MD011  ";
		$query = $this->db->query($sqlb);
		foreach ($query->result() as $row) {
			 $MD001=$row->MD001;
			 $MD011=$row->MD011;
			 $MD013=$row->MD013;
			 $sql21= "UPDATE  SFCTD set TD011='$MD013'
					    where  TD004='$MD001'  and TD008>='$MD011'   ";
				$this->db->query($sql21);
		}
		
	}
	function construct_sqlr($limit = 15, $offset = 0, $func = "", $vno = "%")
	{
		$this->session->set_userdata('sfci03_searchr', "display_searchr/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03']['search']['where'];
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

		if (isset($_SESSION['sfci03']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03']['search']['order'];
		}

		if (!isset($_SESSION['sfci03']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */

		$vday = date('Ymd', strtotime(' -60 day')); //處理當日前3個月的資料 TD008 生產日期
		//$sqla = "DELETE FROM SFCI03GP WHERE 1=1 ";
		//$this->db->query($sqla); TD011 AS MD013m  i.MD013 as MD13m
		/*$sql = " insert into SFCI03GP 
		select b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,
						a.TE017, a.TE018, a.TE019,f.MW001,f.MW003 as TE009disp,(rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
						CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
						SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2) as TE013,
						convert(varchar(25),convert(int,a.TE011)) as TE011, 
						convert(varchar(25),convert(int,c.TA015)) as TA015,
						convert(varchar(25),(select sum(TE011) FROM SFCTE	WHERE TE006=a.TE006 and TE007=a.TE007 and TE008=a.TE008 and TE002 <=a.TE002)) as TA011, 
						convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312, 
						convert(int,a.TE028)+convert(int,a.TE031) as TE0311,
						a.TE028,a.TE031,g.da005, g.da004,
						N'產能85%' as da0051, N'生產效率' as da0052, i.MD001 ,i.MD002,a.TE030 AS TE030dispN,b.TD011 as MD013m, a.TE001, g.da015,g.da010, a.TE029,a.TE040					
					from SFCTE	as a
						left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
						left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
						left join CMSMV as d on a.TE004=d.MV001
						left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
						left join CMSMW as f on a.TE009=f.MW001 
						left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
						left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
						left JOIN CMSMD as i on b.TD004=i.MD001
					where b.TD008>='$vday' and a.TE001 like '$vno'
					order by b.TD008 desc, e.MX001
				";*/
/*	$sql = "			INSERT INTO SFCI03GP
SELECT
    b.TD008,
    e.MX001,
    e.MX003 AS TE005disp,
    a.TE004 AS TE004disp,
    (LEN(a.TE030) - LEN(REPLACE(a.TE030, ';', ''))) / LEN(';') + 1 AS TE030disp,
    a.TE017,
    a.TE018,
    a.TE019,
    f.MW001,
    f.MW003 AS TE009disp,
    (RTRIM(a.TE022) + '~' + COALESCE(
        CASE WHEN a.TE027 = '' THEN NULL ELSE RTRIM(a.TE027) END,
        CASE WHEN a.TE025 = '' THEN NULL ELSE RTRIM(a.TE025) END,
        RTRIM(a.TE023)
    )) AS TE012disp,
    SUBSTRING(RIGHT('0000' + CAST(a.TE013 AS VARCHAR), 4), 1, 2) + ':' + SUBSTRING(RIGHT('0000' + CAST(a.TE013 AS VARCHAR), 4), 3, 2) AS TE013,
    CONVERT(VARCHAR(25), CONVERT(INT, a.TE011)) AS TE011,
    CONVERT(VARCHAR(25), CONVERT(INT, c.TA015)) AS TA015,
    CONVERT(VARCHAR(25), (SELECT SUM(TE011) FROM SFCTE WHERE TE006 = a.TE006 AND TE007 = a.TE007 AND TE008 = a.TE008 AND TE002 <= a.TE002)) AS TA011,
    CONVERT(INT, a.TE011) - CONVERT(INT, a.TE028) - CONVERT(INT, a.TE031) AS TE0312,
    CONVERT(INT, a.TE028) + CONVERT(INT, a.TE031) AS TE0311,
    a.TE028,
    a.TE031,
    g.da005,
    g.da004,
    N'產能85%' AS da0051,
    N'生產效率' AS da0052,
    i.MD001,
    i.MD002,
    a.TE030 AS TE030dispN,
    b.TD011 AS MD013m,
    a.TE001,
    g.da015,
    g.da010,
    a.TE029,
    a.TE040
FROM
    SFCTE AS a
    LEFT JOIN SFCTD AS b ON a.TE001 = b.TD001 AND a.TE002 = b.TD002
    LEFT JOIN MOCTA AS c ON a.TE006 = c.TA001 AND a.TE007 = c.TA002
    LEFT JOIN CMSMV AS d ON a.TE004 = d.MV001
    LEFT JOIN CMSMX AS e ON a.TE005 = e.MX001 AND b.TD004 = e.MX002
    LEFT JOIN CMSMW AS f ON a.TE009 = f.MW001
    LEFT JOIN molda AS g ON a.TE017 = g.da001 AND a.TE009 = g.da013 AND a.TE029 = g.da014
    LEFT JOIN SFCTA AS h ON a.TE006 = h.TA001 AND a.TE007 = h.TA002 AND a.TE009 = h.TA004
    LEFT JOIN CMSMD AS i ON b.TD004 = i.MD001
WHERE
    b.TD008 >= '20240812'
    AND a.TE001 LIKE 'D%02'
ORDER BY
    b.TD008 DESC,
    e.MX001; "; */
	$vday='20250101';
	$da0051='產能85%';
	$da0052='生產效率';
	$da0051=iconv("utf-8", "BIG5//IGNORE", '產能85%');
	$da0052=iconv("utf-8", "BIG5//IGNORE", '生產效率');
	
$sql = "	INSERT INTO SFCI03GP
SELECT
    b.TD008,
    e.MX001,
    e.MX003 AS TE005disp,
    a.TE004 AS TE004disp,
    (LEN(a.TE030) - LEN(REPLACE(a.TE030, ';', ''))) / LEN(';') + 1 AS TE030disp,
    a.TE017,
    a.TE018,
    a.TE019,
    f.MW001,
    f.MW003 AS TE009disp,
    (RTRIM(a.TE022) + '~' + COALESCE(
        CASE WHEN a.TE027 = '' THEN NULL ELSE RTRIM(a.TE027) END,
        CASE WHEN a.TE025 = '' THEN NULL ELSE RTRIM(a.TE025) END,
        RTRIM(a.TE023)
    )) AS TE012disp,
    SUBSTRING(RIGHT('0000' + CAST(a.TE013 AS VARCHAR), 4), 1, 2) + ':' + SUBSTRING(RIGHT('0000' + CAST(a.TE013 AS VARCHAR), 4), 3, 2) AS TE013,
    CASE
        WHEN ISNUMERIC(a.TE011) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE011)
        ELSE 0
    END AS TE011,
    CASE
        WHEN ISNUMERIC(c.TA015) = 1 THEN CONVERT(DECIMAL(16, 0), c.TA015)
        ELSE 0
    END AS TA015,
    CASE
        WHEN ISNUMERIC((SELECT SUM(TE011) FROM SFCTE WHERE TE006 = a.TE006 AND TE007 = a.TE007 AND TE008 = a.TE008 AND TE002 <= a.TE002)) = 1 THEN CONVERT(DECIMAL(16, 3), (SELECT SUM(TE011) FROM SFCTE WHERE TE006 = a.TE006 AND TE007 = a.TE007 AND TE008 = a.TE008 AND TE002 <= a.TE002))
        ELSE 0
    END AS TA011,
    CASE
        WHEN ISNUMERIC(a.TE011) = 1 AND ISNUMERIC(a.TE028) = 1 AND ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE011) - CONVERT(DECIMAL(16, 0), a.TE028) - CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE0312,
    CASE
        WHEN ISNUMERIC(a.TE028) = 1 AND ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE028) + CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE0311,
    CASE
        WHEN ISNUMERIC(a.TE028) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE028)
        ELSE 0
    END AS TE028,
    CASE
        WHEN ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE031,
    CASE
        WHEN ISNUMERIC(g.da005) = 1 THEN CONVERT(DECIMAL(16, 0), g.da005)
        ELSE 0
    END AS da005,
    CASE
        WHEN ISNUMERIC(g.da004) = 1 THEN CONVERT(DECIMAL(16, 0), g.da004)
        ELSE 0
    END AS da004,
    '$da0051' AS da0051,
    '$da0052' AS da0052,
    i.MD001,
    i.MD002,
    a.TE030 AS TE030dispN,
    CASE
        WHEN ISNUMERIC(b.TD011) = 1 THEN CONVERT(DECIMAL(16, 4), b.TD011)
        ELSE 0
    END AS MD013m,
    a.TE001,
    g.da015,
    g.da010,
    a.TE029,
    a.TE040
FROM
    SFCTE AS a
    LEFT JOIN SFCTD AS b ON a.TE001 = b.TD001 AND a.TE002 = b.TD002
    LEFT JOIN MOCTA AS c ON a.TE006 = c.TA001 AND a.TE007 = c.TA002
    LEFT JOIN CMSMV AS d ON a.TE004 = d.MV001
    LEFT JOIN CMSMX AS e ON a.TE005 = e.MX001 AND b.TD004 = e.MX002
    LEFT JOIN CMSMW AS f ON a.TE009 = f.MW001
    LEFT JOIN molda AS g ON a.TE017 = g.da001 AND a.TE009 = g.da013 AND a.TE029 = g.da014
    LEFT JOIN SFCTA AS h ON a.TE006 = h.TA001 AND a.TE007 = h.TA002 AND a.TE009 = h.TA004
    LEFT JOIN CMSMD AS i ON b.TD004 = i.MD001
WHERE
    b.TD008>='$vday' and (b.TD001='D407' or b.TD001='D507') and a.TE001 like '$vno'
ORDER BY
    b.TD008 DESC,
    e.MX001; ";
		// echo "<pre>";var_dump($sql);exit;
		$this->db->query($sql);
		$sql = "select * from SFCI03GP ";
		$query = $this->db->query($sql);

		$ret['data'] = $query->result();
		if (count($ret['data']) > 0) {
			$DB2 = $this->load->database('yjpal', TRUE);
			foreach ($ret['data'] as $key => $val) {
				$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004disp' ");
				if ($query82->num_rows() > 0)
					$val->TE004disp = $query82->result()[0]->mv002;

				$workhour = round((floatval(substr($val->TE013, 0, 2)) * 60 + floatval(substr($val->TE013, -2))) / 60, 1);

				// if ($val->da0051) {
				if (!$val->da004 || !$val->da005 || !$val->da015) {
					$val->da0051 = '';
				} else {
					$val->da0051 = round(60 * 85 * floatval($val->da004) * floatval($val->da005) / 100 / floatval($val->da015), 0);
				}
				// }
				if ($workhour <= 0) {
					$val->da0052 = '工作時間必須大於0';
				} else {
					if (!$val->da0051 || !$val->TE011) {
						$val->da0052 = '';
					} else {
						$val->da0052 = round($val->TE011 / $workhour / $val->TE030disp / $val->da0051 * 100, 0) . '%';
					}
				}

				if ($val->TE001 == 'D404' || $val->TE001 == 'D504') { //注塑 計算方式					
					if (!$val->da005) {
						$val->MD013m = '無標準模穴數';
					} else if ($val->TE029 == '1') { //半自動
						//注塑是(時薪*週期時間)/模穴數*作業人數 20220912 Wechat
						//              注塑是(時薪  MD013m         * 週期時間  da010   )        /理論模穴數  da005 * 作業人數  da015
						$val->MD013m =  round((floatval($val->MD013m) * floatval($val->da010) / 3600) / floatval($val->da005) * floatval($val->da015), 3);
					} else { //自動
						//              注塑是(時薪  MD013m-3.6         * 週期時間  da010   )        /理論模穴數  da005 * 作業人數  da015
						$val->MD013m =  round(((floatval($val->MD013m) - 3.6) * floatval($val->da010) / 3600) / floatval($val->da005) * floatval($val->da015), 3);
					}

					$val->TE0312 = $val->TE040; // 合格數量
				} else {
					if (!$val->da0051) {
						$val->MD013m = '';
					} else {
						$val->MD013m =  round(floatval($val->MD013m) / floatval($val->da0051), 3);
					}
				}



				if ($val->TE030dispN != '') {

					$arr = explode(";", $val->TE030dispN);
					$val->TE030dispN = '';

					foreach ($arr as $k => $v) {
						if ($arr[$k]) {
							$vmv001 = $arr[$k];
							$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$vmv001' ");
							if ($query82->num_rows() > 0)
								$val->TE030dispN .= $query82->result()[0]->mv002 . ';';
						}
					}
				}
			}
		}


		// //建構暫存view 1060614 上一頁,下一頁使用
		// $this->construct_view($ret['data']);

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('sfctd as a')
		// 	->join('cmsmq as c', 'a.td001 = c.mq001', 'left');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03']['search']['where'] = $where;
		$_SESSION['sfci03']['search']['order'] = $order;
		$_SESSION['sfci03']['search']['offset'] = $offset;

		return $ret;
	}
function construct_sqlrnew($limit = 15, $offset = 0, $func = "", $vno = "%")
	{
		$this->session->set_userdata('sfci03_searchr', "display_searchr/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03']['search']);
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
		$default_order = "TD008 DESC"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03']['search']['where'];
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

		if (isset($_SESSION['sfci03']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03']['search']['order'];
		}

		if (!isset($_SESSION['sfci03']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
         //1140129  -40 day modi 30
		$vday = date('Ymd', strtotime(' -20 day')); //處理當日前3個月的資料 TD008 生產日期
		
	$da0051='產能85%';
	$da0052='生產效率';
	$da0051=iconv("utf-8", "BIG5//IGNORE", '產能85%');
	$da0052=iconv("utf-8", "BIG5//IGNORE", '生產效率');
	
/*$sql = "	INSERT INTO SFCI03GP
SELECT
    b.TD008,
    e.MX001,
    e.MX003 AS TE005disp,
    a.TE004 AS TE004disp,
    (LEN(a.TE030) - LEN(REPLACE(a.TE030, ';', ''))) / LEN(';') + 1 AS TE030disp,
    a.TE017,
    a.TE018,
    a.TE019,
    f.MW001,
    f.MW003 AS TE009disp,
    (RTRIM(a.TE022) + '~' + COALESCE(
        CASE WHEN a.TE027 = '' THEN NULL ELSE RTRIM(a.TE027) END,
        CASE WHEN a.TE025 = '' THEN NULL ELSE RTRIM(a.TE025) END,
        RTRIM(a.TE023)
    )) AS TE012disp,
    SUBSTRING(RIGHT('0000' + CAST(a.TE013 AS VARCHAR), 4), 1, 2) + ':' + SUBSTRING(RIGHT('0000' + CAST(a.TE013 AS VARCHAR), 4), 3, 2) AS TE013,
    CASE
        WHEN ISNUMERIC(a.TE011) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE011)
        ELSE 0
    END AS TE011,
    CASE
        WHEN ISNUMERIC(c.TA015) = 1 THEN CONVERT(DECIMAL(16, 0), c.TA015)
        ELSE 0
    END AS TA015,
    CASE
        WHEN ISNUMERIC((SELECT SUM(TE011) FROM SFCTE WHERE TE006 = a.TE006 AND TE007 = a.TE007 AND TE008 = a.TE008 AND TE002 <= a.TE002)) = 1 THEN CONVERT(DECIMAL(16, 3), (SELECT SUM(TE011) FROM SFCTE WHERE TE006 = a.TE006 AND TE007 = a.TE007 AND TE008 = a.TE008 AND TE002 <= a.TE002))
        ELSE 0
    END AS TA011,
    CASE
        WHEN ISNUMERIC(a.TE011) = 1 AND ISNUMERIC(a.TE028) = 1 AND ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE011) - CONVERT(DECIMAL(16, 0), a.TE028) - CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE0312,
    CASE
        WHEN ISNUMERIC(a.TE028) = 1 AND ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE028) + CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE0311,
    CASE
        WHEN ISNUMERIC(a.TE028) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE028)
        ELSE 0
    END AS TE028,
    CASE
        WHEN ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE031,
    CASE
        WHEN ISNUMERIC(g.da005) = 1 THEN CONVERT(DECIMAL(16, 0), g.da005)
        ELSE 0
    END AS da005,
    CASE
        WHEN ISNUMERIC(g.da004) = 1 THEN CONVERT(DECIMAL(16, 0), g.da004)
        ELSE 0
    END AS da004,
    '$da0051' AS da0051,
    '$da0052' AS da0052,
    i.MD001,
    i.MD002,
    a.TE030 AS TE030dispN,
    CASE
        WHEN ISNUMERIC(b.TD011) = 1 THEN CONVERT(DECIMAL(16, 4), b.TD011)
        ELSE 0
    END AS MD013m,
    a.TE001,
    g.da015,
    g.da010,
    a.TE029,
    a.TE040
FROM
    SFCTE AS a
    LEFT JOIN SFCTD AS b ON a.TE001 = b.TD001 AND a.TE002 = b.TD002
    LEFT JOIN MOCTA AS c ON a.TE006 = c.TA001 AND a.TE007 = c.TA002
    LEFT JOIN CMSMV AS d ON a.TE004 = d.MV001
    LEFT JOIN CMSMX AS e ON a.TE005 = e.MX001 AND b.TD004 = e.MX002
    LEFT JOIN CMSMW AS f ON a.TE009 = f.MW001
    LEFT JOIN molda AS g ON a.TE017 = g.da001 AND a.TE009 = g.da013 AND a.TE029 = g.da014
    LEFT JOIN SFCTA AS h ON a.TE006 = h.TA001 AND a.TE007 = h.TA002 AND a.TE009 = h.TA004
    LEFT JOIN CMSMD AS i ON b.TD004 = i.MD001
WHERE
    b.TD008>='$vday' and a.TE001 like '$vno'
ORDER BY
    b.TD008 DESC,
    e.MX001; ";*/
	//1140130 
/*	$sql = "	
SELECT a.TE001,a.TE002,b.TD008,a.TE006,a.TE007,a.TE017,a.TE018,a.TE019,a.TE029,a.TE004 AS TE004disp,a.TE040,
 (LEN(a.TE030) - LEN(REPLACE(a.TE030, ';', ''))) / LEN(';') + 1 AS TE030disp,
 a.TE013,a.TE011,isnull(da005,4.9) as da005, isnull(da015,1.4) as da015, isnull(da010,1.3) as da010,isnull(da004,1.1) as da004,
CASE
        WHEN ISNUMERIC(a.TE011) = 1 AND ISNUMERIC(a.TE028) = 1 AND ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE011) - CONVERT(DECIMAL(16, 0), a.TE028) - CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE0312,CASE
        WHEN ISNUMERIC(b.TD011) = 1 THEN CONVERT(DECIMAL(16, 4), b.TD011)
        ELSE 0
    END AS MD013m
	 FROM SFCTE as a
LEFT JOIN  SFCTD as b ON  a.TE001=b.TD001 AND a.TE002=b.TD002
LEFT JOIN molda AS g ON a.TE017 = g.da001 AND a.TE009 = g.da013 AND a.TE029 = g.da014
WHERE b.TD008>='$vday' AND (a.TE001='D411' OR a.TE001='D511')
ORDER BY b.TD008 DESC 
; "; */
$sql = "	
SELECT a.TC001 AS TE001,a.TC002  AS TE002,b.TB003 AS TD008,a.TC004 AS TE006,a.TC005 AS TE007,a.TC047 AS TE017,a.TC048 AS TE018,a.TC049 AS TE019,a.TC013 AS TE029,a.TC015 AS TE004disp,a.TC014 AS TE040,
 TC013 AS TE030disp,
 a.TC014 AS TE013,a.TC015 AS TE011,isnull(pk002,4.9) as da005, isnull(pk003,1.4) as da015, isnull(pk003,1.3) as da010,isnull(pk004,1.1) as da004,
TC036 AS TE0312, isnull(pk004,1.4) AS MD013m
 FROM SFCTC as a
LEFT JOIN  SFCTB as b ON  a.TC001=b.TB001 AND a.TC002=b.TB002
LEFT JOIN sfcpk AS g ON a.TC047 = g.pk001 
WHERE b.TB003>='$vday' and a.TC001='D311'
ORDER BY b.TB003 DESC 
; ";

		//1140129 (a.TE001='D411' OR a.TE001='D511')TC006 AS MD013m
		// echo "<pre>";var_dump($sql);exit;
		$this->db->query($sql);
	//	$sql = "select * from SFCI03GP ";
		$query = $this->db->query($sql);

		$ret['data'] = $query->result();
	/*	if (count($ret['data']) > 0) {
			$DB2 = $this->load->database('yjpal', TRUE);
			foreach ($ret['data'] as $key => $val) {
				$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004disp' ");
				if ($query82->num_rows() > 0)
					$val->TE004disp = $query82->result()[0]->mv002;

				$workhour = round((floatval(substr($val->TE013, 0, 2)) * 60 + floatval(substr($val->TE013, -2))) / 60, 1);

				
				if (!$val->da004 || !$val->da005 || !$val->da015) {
					$val->da0051 = '';
				} else {
					$val->da0051 = round(60 * 85 * floatval($val->da004) * floatval($val->da005) / 100 / floatval($val->da015), 0);
				}
				
				if ($workhour <= 0) {
					$val->da0052 = '工作時間必須大於0';
				} else {
					if (!$val->da0051 || !$val->TE011) {
						$val->da0052 = '';
					} else {
						$val->da0052 = round($val->TE011 / $workhour / $val->TE030disp / $val->da0051 * 100, 0) . '%';
					}
				}
               //1140129 ($val->TE001 == 'D404' || $val->TE001 == 'D504') D311
				if ($val->TE001 == 'D404' || $val->TE001 == 'D504') { //注塑 D411,D511 D404,D504計算方式					
					if (!$val->da005) {
						$val->MD013m = '無標準模穴數';
					} else if ($val->TE029 == '1') { //半自動
						$val->MD013m =  round((floatval($val->MD013m) * floatval($val->da010) / 3600) / floatval($val->da005) * floatval($val->da015), 3);
					} else { //自動
						$val->MD013m =  round(((floatval($val->MD013m) - 3.6) * floatval($val->da010) / 3600) / floatval($val->da005) * floatval($val->da015), 3);
					}

					$val->TE0312 = $val->TE040; // 合格數量
				} else {
					if (!$val->da0051) {
						$val->MD013m = '';
					} else {
						$val->MD013m =  round(floatval($val->MD013m) / floatval($val->da0051), 3);
					}
				}
			}
		} */


		// //建構暫存view 1060614 上一頁,下一頁使用
		// $this->construct_view($ret['data']);

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('sfctd as a')
		// 	->join('cmsmq as c', 'a.td001 = c.mq001', 'left');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03']['search']['where'] = $where;
		$_SESSION['sfci03']['search']['order'] = $order;
		$_SESSION['sfci03']['search']['offset'] = $offset;

		return $ret;
	}
	function constructgj_sqlr($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03_searchr', "display_searchr/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03']['search']);
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
		$default_order = "td001 asc,td002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03']['search']['where'];
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

		if (isset($_SESSION['sfci03']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03']['search']['order'];
		}

		if (!isset($_SESSION['sfci03']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */

		$vday = date('Ymd', strtotime(' -90 day')); //處理當日前3個月的資料
		$sql = " SELECT *, '' as MD013m
		-- TE013,da004,da005,da015,TE011,pg005,pg006,pg007,pg008,pg009,pg010,pg011,pg012,TB003,
		-- 				TC001,TE001,MX001,TE017,TE018,MW001,TE029,TC014,
		-- 				TE004 as TE004disp,(LEN(TE030) - LEN(REPLACE(TE030,';',''))) / LEN(';')+1 AS TE030disp,
		-- 				TE030 AS TE030dispN , MW003 as TE009disp,convert(int,TE011)-convert(int,TE028)-convert(int,TE031) as TE0312
				 FROM SFCTC 
					LEFT JOIN SFCTB ON TC001=TB001 AND TC002=TB002
					-- LEFT JOIN SFCTE ON TC004=TE006 AND TC005=TE007
					LEFT JOIN sfcpg ON TC047=pg001 AND TC201=pg002
					-- left join molda on TE017=da001 and TE009=da013 and TE029=da014
					-- left join CMSMW on TE009=MW001 
					-- left join SFCTD on TE001=TD001 and TE002=TD002 		
					-- left join CMSMX on TE005=MX001 and TD004=MX002
				 WHERE TB001='D310' and TB003>='$vday'
					order by TB003 desc, TC047
				";
		// echo "<pre>";var_dump($sql);exit;
		$query = $this->db->query($sql);

		$ret['data'] = $query->result();
		if (count($ret['data']) > 0) {
			// $DB2 = $this->load->database('yjpal', TRUE);
			foreach ($ret['data'] as $key => $val) {
				$val->MD013m = round($val->pg005 + $val->pg006 + $val->pg007 + $val->pg008 + $val->pg009 + $val->pg010 + $val->pg011 + $val->pg012, 3);
			}
		}


		// //建構暫存view 1060614 上一頁,下一頁使用
		// $this->construct_view($ret['data']);

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('sfctd as a')
		// 	->join('cmsmq as c', 'a.td001 = c.mq001', 'left');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci03']['search']['where'] = $where;
		$_SESSION['sfci03']['search']['order'] = $order;
		$_SESSION['sfci03']['search']['offset'] = $offset;

		return $ret;
	}


	function construct_sql_sfcta($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_sfcta") {
			unset($_SESSION['sfci03']['search']);
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
		if ($this->uri->segment(6)) {
			$seq1 = trim($this->uri->segment(6));
			$_SESSION['sfci03']['search']['seq1'] = trim($this->uri->segment(6));
		} else {
			if (isset($_SESSION['sfci03']['search']['seq1']))
				$seq1 = $_SESSION['sfci03']['search']['seq1'];
			else
				$seq1 = '';
		}
		if ($this->uri->segment(7)) {
			$seq2 = trim($this->uri->segment(7));
			$_SESSION['sfci03']['search']['seq2'] = trim($this->uri->segment(7));
		} else {
			if (isset($_SESSION['sfci03']['search']['seq2']))
				$seq2 = $_SESSION['sfci03']['search']['seq2'];
			else
				$seq2 = '';
		}

		// echo var_dump($seq1, $seq2, $this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), $this->uri->segment(4), $this->uri->segment(5), $this->uri->segment(6), $this->uri->segment(7));




		$default_where = ""; //在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = " a.TA002 "; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03']['search']['where'];
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

		if (isset($_SESSION['sfci03']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03']['search']['order'];
		}

		if (!isset($_SESSION['sfci03']['search']['order']) && $default_order) {
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



		$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,a.TA010-a.TA011-a.TA012 as TA0101,a.TA008 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
					WHERE b.TA013 !='V' and $where and a.TA002 IN 
				(SELECT TOP $limit a.TA002 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001 
						WHERE b.TA013 !='V' and $where and a.TA002 NOT IN
					(SELECT TOP $offset a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001 
								WHERE b.TA013 !='V' and $where ORDER BY a.TA002, a.TA003)
					ORDER BY a.TA002, a.TA003)
				ORDER BY a.TA002, a.TA003 
		 ";
		if ($where == "") {
			$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,a.TA010-a.TA011-a.TA012 as TA0101,a.TA008 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001 
					WHERE b.TA013 !='V' and a.TA002 IN 
						(SELECT TOP $limit a.TA002 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001  
							WHERE b.TA013 !='V' and a.TA002 NOT IN
							(SELECT TOP $offset a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001 
									WHERE b.TA013 !='V' ORDER BY a.TA002, a.TA003)
						ORDER BY a.TA002, a.TA003)
					ORDER BY a.TA002, a.TA003
			";
		}

		if ($this->uri->segment(3) == "display_child" && ($seq1)) {
			$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,a.TA010-a.TA011-a.TA012 as TA0101,a.TA008 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
						where b.TA013 !='V' and $where and a.TA001 = '$seq1' and a.TA002 IN 
						(SELECT TOP $limit a.TA002 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001  
							WHERE b.TA013 !='V' and $where and a.TA001 = '$seq1' and a.TA002 NOT IN
							(SELECT TOP $offset a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001 
									WHERE b.TA013 !='V' and $where and a.TA001 = '$seq1' ORDER BY a.TA002, a.TA003)
							ORDER BY a.TA002, a.TA003)
						ORDER BY a.TA002, a.TA003
						";
			if ($where == "") {
				$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,a.TA010-a.TA011-a.TA012 as TA0101,a.TA008 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
						where b.TA013 !='V' and a.TA001 = '$seq1' and a.TA002 IN 
						(SELECT TOP $limit a.TA002 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001  
							WHERE b.TA013 !='V' and a.TA001 = '$seq1' and a.TA002 NOT IN
							(SELECT TOP $offset a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001 
									WHERE b.TA013 !='V' and a.TA001 = '$seq1' ORDER BY a.TA002, a.TA003)
							ORDER BY a.TA002, a.TA003)
						ORDER BY a.TA002, a.TA003
						";
			}
			if ($seq2) {
				$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,a.TA010-a.TA011-a.TA012 as TA0101,a.TA008 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001
								where b.TA013 !='V' and $where and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and a.TA002 IN 
							(SELECT TOP $limit a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001  
									WHERE b.TA013 !='V' and $where and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and a.TA002 NOT IN
								(SELECT TOP $offset a.TA002 from  SFCTA as a 
									left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
									left join INVMB as c on b.TA006 = c.MB001
									left join CMSMW as d on a.TA004 = d.MW001 
											WHERE b.TA013 !='V' and $where and a.TA001 = '$seq1' and a.TA002 like '%$seq2%'   ORDER BY a.TA002, a.TA003)
								ORDER BY a.TA002, a.TA003)
							ORDER BY a.TA002, a.TA003
						";
				if ($where == "") {
					$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,a.TA010-a.TA011-a.TA012 as TA0101,a.TA008 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001
								where b.TA013 !='V' and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and a.TA002 IN 
							(SELECT TOP $limit a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001  
									WHERE b.TA013 !='V' and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and a.TA002 NOT IN
								(SELECT TOP $offset a.TA002 from  SFCTA as a 
									left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
									left join INVMB as c on b.TA006 = c.MB001
									left join CMSMW as d on a.TA004 = d.MW001 
											WHERE b.TA013 !='V' and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' ORDER BY a.TA002, a.TA003)
								ORDER BY a.TA002, a.TA003)
							ORDER BY a.TA002, a.TA003
						";
				}
			}
		}

		$query = $this->db->query($sql);
		$ret['data'] = $query->result();

		// echo "<pre>";
		// var_dump($ret);
		// exit;

		// if (!($this->uri->segment(3) == "display_child" && ($seq1) && strlen($seq1) > 3)) {
		// 	/**
		// 	 * MySQL 轉 MSSQL 時limit的替代方式
		// 	 * by Sam
		// 	 */
		// 	$fori = $offset;
		// 	$formax = $limit + $offset;
		// 	// $ret['num'] = count($ret['data']);
		// 	if ($ret['num'] < $formax)
		// 		$formax = $ret['num'];
		// 	for ($fori; $fori < $formax; $fori++) {
		// 		$temp['data'][] = $ret['data'][$fori];
		// 	}

		// 	if (isset($temp['data'])) {
		// 		$ret['data'] = $temp['data'];
		// 	} else {
		// 		$ret['data'] = ''; //找不到
		// 	}
		// 	// limit的替代方式 end----------------
		// }

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03']['search']['sql'] = $this->db->last_query();

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

		$sql = " SELECT count(*) as total_num from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
				WHERE b.TA013 !='V' and $where
		 ";
		if ($where == "") {
			$sql = " SELECT count(*) as total_num from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001 
					WHERE b.TA013 !='V'
			";
		}

		if ($this->uri->segment(3) == "display_child" && ($seq1)) {
			$sql = " SELECT count(*) as total_num from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
						where b.TA013 !='V' and $where and a.TA001 = '$seq1'
						";
			if ($where == "") {
				$sql = " SELECT count(*) as total_num from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
						where b.TA013 !='V' and a.TA001 = '$seq1'
						";
			}
			if ($seq2) {
				$sql = " SELECT count(*) as total_num from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001
							where b.TA013 !='V' and $where and a.TA001 = '$seq1' and a.TA002 like '%$seq2%'
						";
				if ($where == "") {
					$sql = " SELECT count(*) as total_num from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001
							where b.TA013 !='V' and a.TA001 = '$seq1' and a.TA002 like '%$seq2%'
						";
				}
			}
		}



		$query = $this->db->query($sql);
		$ret['num'] = intval($query->result()[0]->total_num);

		//儲存where與order
		$_SESSION['sfci03']['search']['where'] = $where;
		$_SESSION['sfci03']['search']['order'] = $order;
		$_SESSION['sfci03']['search']['offset'] = $offset;

		return $ret;
	}

	function construct_sqla($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci03_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci03']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sqla") {
			unset($_SESSION['sfci03']['search']);
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
		if ($this->uri->segment(6)) {
			$seq1 = trim($this->uri->segment(6));
			$_SESSION['sfci03']['search']['seq1'] = trim($this->uri->segment(6));
		} else {
			if (isset($_SESSION['sfci03']['search']['seq1']))
				$seq1 = $_SESSION['sfci03']['search']['seq1'];
			else
				$seq1 = '';
		}
		if ($this->uri->segment(7) != 'a') {
			// var_dump('comein 1');
			$seq2 = trim($this->uri->segment(7));
			$_SESSION['sfci03']['search']['seq2'] = trim($this->uri->segment(7));
		} else {
			// var_dump('comein 2');
			if (isset($_SESSION['sfci03']['search']['seq2']))
				$seq2 = $_SESSION['sfci03']['search']['seq2'];
			else
				$seq2 = '';
		}

		if (substr($this->uri->segment(8), 0, 2) == 'D1') {
			$seq3 = 'a.TA010';
		} else {
			$seq3 = 'a.TA011';
		}

		// echo "<pre>";
		// var_dump($seq1);
		// var_dump($seq2);
		// var_dump($seq3);

		// echo var_dump($seq1, $seq2, $this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), $this->uri->segment(4), $this->uri->segment(5), $this->uri->segment(6), $this->uri->segment(7));




		$default_where = ""; //在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = " a.TA002 "; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci03']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci03']['search']['where'];
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

		if (isset($_SESSION['sfci03']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci03']['search']['order'];
		}

		if (!isset($_SESSION['sfci03']['search']['order']) && $default_order) {
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



		$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,b.TA015-$seq3 as TA0101,a.TA008 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
				WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and b.TA013 !='V' and a.TA002 IN 
				(SELECT TOP $limit a.TA002 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001 WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and b.TA013 !='V' and a.TA002 NOT IN
					(SELECT TOP $offset a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001 WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and b.TA013 !='V' ORDER BY a.TA002 )
					ORDER BY a.TA002 )
				ORDER BY a.TA002  
		 ";
		if ($where == "") {
			$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,b.TA015-$seq3 as TA0101,a.TA008 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001 
					WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and b.TA013 !='V' and a.TA002 IN 
						(SELECT TOP $limit a.TA002 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001  WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and b.TA013 !='V' and a.TA002 NOT IN
							(SELECT TOP $offset a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001 WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and b.TA013 !='V' ORDER BY a.TA002 )
						ORDER BY a.TA002 )
					ORDER BY a.TA002 
			";
		}

		if ($this->uri->segment(3) == "display_childa" && ($seq1)) {
			$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,b.TA015-$seq3 as TA0101,a.TA008 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
						where b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and b.TA013 !='V' and a.TA001 = '$seq1' and a.TA002 IN 
						(SELECT TOP $limit a.TA002 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001  WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and b.TA013 !='V' and a.TA001 = '$seq1' and a.TA002 NOT IN
							(SELECT TOP $offset a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001 WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and b.TA013 !='V' and a.TA001 = '$seq1' ORDER BY a.TA002 )
							ORDER BY a.TA002 )
						ORDER BY a.TA002 
						";
			if ($where == "") {
				$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,b.TA015-$seq3 as TA0101,a.TA008 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
						where b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and a.TA001 = '$seq1' and b.TA013 !='V' and a.TA002 IN 
						(SELECT TOP $limit a.TA002 from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001  WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and a.TA001 = '$seq1' and b.TA013 !='V' and a.TA002 NOT IN
							(SELECT TOP $offset a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001 WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and a.TA001 = '$seq1' and b.TA013 !='V' ORDER BY a.TA002 )
							ORDER BY a.TA002 )
						ORDER BY a.TA002 
						";
			}
			if ($seq2) {
				$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,b.TA015-$seq3 as TA0101,a.TA008 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001
							where b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and b.TA013 !='V' and a.TA002 IN 
							(SELECT TOP $limit a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001  WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and b.TA013 !='V' and a.TA002 NOT IN
								(SELECT TOP $offset a.TA002 from  SFCTA as a 
									left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
									left join INVMB as c on b.TA006 = c.MB001
									left join CMSMW as d on a.TA004 = d.MW001 WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and b.TA013 !='V'  ORDER BY a.TA002 )
								ORDER BY a.TA002 )
							ORDER BY a.TA002 
						";
				if ($where == "") {
					$sql = " SELECT a.TA001, a.TA002, a.TA003,b.TA006,c.MB002,c.MB003,c.MB004,a.TA004,d.MW003,b.TA015,b.TA015-$seq3 as TA0101,a.TA008 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001
							where b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and b.TA013 !='V' and a.TA002 IN 
							(SELECT TOP $limit a.TA002 from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001  WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and b.TA013 !='V' and a.TA002 NOT IN
								(SELECT TOP $offset a.TA002 from  SFCTA as a 
									left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
									left join INVMB as c on b.TA006 = c.MB001
									left join CMSMW as d on a.TA004 = d.MW001 WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and b.TA013 !='V' ORDER BY a.TA002 )
								ORDER BY a.TA002 )
							ORDER BY a.TA002 
						";
				}
			}
		}

		$query = $this->db->query($sql);
		$ret['data'] = $query->result();

		// echo "<pre>";
		// var_dump($sql);
		// exit;

		// if (!($this->uri->segment(3) == "display_child" && ($seq1) && strlen($seq1) > 3)) {
		// 	/**
		// 	 * MySQL 轉 MSSQL 時limit的替代方式
		// 	 * by Sam
		// 	 */
		// 	$fori = $offset;
		// 	$formax = $limit + $offset;
		// 	// $ret['num'] = count($ret['data']);
		// 	if ($ret['num'] < $formax)
		// 		$formax = $ret['num'];
		// 	for ($fori; $fori < $formax; $fori++) {
		// 		$temp['data'][] = $ret['data'][$fori];
		// 	}

		// 	if (isset($temp['data'])) {
		// 		$ret['data'] = $temp['data'];
		// 	} else {
		// 		$ret['data'] = ''; //找不到
		// 	}
		// 	// limit的替代方式 end----------------
		// }

		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03']['search']['sql'] = $this->db->last_query();

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

		$sql = " SELECT count(*) as total_num from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
				WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and b.TA013 !='V'
		 ";
		if ($where == "") {
			$sql = " SELECT count(*) as total_num from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001 
					WHERE b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and b.TA013 !='V'
			";
		}

		if ($this->uri->segment(3) == "display_childa" && ($seq1)) {
			$sql = " SELECT count(*) as total_num from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
						where b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and a.TA001 = '$seq1' and b.TA013 !='V'
						";
			if ($where == "") {
				$sql = " SELECT count(*) as total_num from  SFCTA as a 
							left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
							left join INVMB as c on b.TA006 = c.MB001
							left join CMSMW as d on a.TA004 = d.MW001
						where b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and a.TA001 = '$seq1' and b.TA013 !='V'
						";
			}
			if ($seq2) {
				$sql = " SELECT count(*) as total_num from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001
							where b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and $where and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and b.TA013 !='V'
						";
				if ($where == "") {
					$sql = " SELECT count(*) as total_num from  SFCTA as a 
								left join MOCTA as b on a.TA001 = b.TA001 and a.TA002 = b.TA002 
								left join INVMB as c on b.TA006 = c.MB001
								left join CMSMW as d on a.TA004 = d.MW001
							where b.TA011 !='Y' and b.TA011 !='y' and b.TA013 ='Y' and a.TA001 = '$seq1' and a.TA002 like '%$seq2%' and b.TA013 !='V'
						";
				}
			}
		}



		$query = $this->db->query($sql);
		$ret['num'] = intval($query->result()[0]->total_num);

		//儲存where與order
		$_SESSION['sfci03']['search']['where'] = $where;
		$_SESSION['sfci03']['search']['order'] = $order;
		$_SESSION['sfci03']['search']['offset'] = $offset;

		return $ret;
	}

	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data)
	{
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"td001", "td002"
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
		$_SESSION['sfci03']['search']['view'] = $view_array;
		$_SESSION['sfci03']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['sfci03']['search']['view']);exit;
	}

	//查詢一筆 修改用   
	function selone($seq1, $seq2)
	{
		// $this->db->select('a.TD001,a.TD002,a.TD003,a.TD004,a.TD005,a.TD006,a.TD007,a.TD008,a.TD009,a.TD010,
		//                d.MD002 as td004disp,c.MQ002 AS td001disp,e.MV002 as cmsi09ddisp,f.MX003 as te005disp,
		//                g.MW002 as te009disp,b.* ');

		// $this->db->from('SFCTD as a');
		// $this->db->join('SFCTE as b', 'a.TD001 = b.TE001  and a.TD002=b.TE002 ', 'left');	//單身	
		// $this->db->join('CMSMQ as c', 'a.TD001 = c.MQ001  ', 'left');  //單別sfci01
		// $this->db->join('CMSMD as d', 'a.TD004 = d.MD001 ', 'left');   //生產線別 cmsi04 
		// $this->db->join('CMSMV as e', 'b.TE004 = e.MV001 ', 'left');   //員工
		// $this->db->join('CMSMX as f', 'b.TE005 = f.MX001 ', 'left');   //機台
		// $this->db->join('CMSMW as g', 'b.TE009 = g.MW001 ', 'left');   //製程 cmsi19 TE007,9
		// $this->db->where('a.TD001', $seg1);
		// $this->db->where('a.TD002', $seg2);
		// $this->db->order_by('TD001 , TD002 ,b.TE003');

		// $query = $this->db->get();

		$sql98 = " select a.TD001,b.MQ002 AS TD001disp ,a.TD002,a.TD003,a.TD004,c.MD002 as TD004disp,a.TD005,a.TD006,a.TD007,a.TD008,a.TD009,a.TD010,a.FLAG
					from SFCTD as a
					left join CMSMQ as b on a.TD001 = b.MQ001 
					left join CMSMD as c on a.TD004 = c.MD001 
					where a.TD001 ='$seq1' and a.TD002='$seq2' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() <= 0) {
			return "no_data";
		}

		$result['title_data'] = $query->result();

		// $this->db->select('b.*,b.te004 as cmsi09d,e.mv002 as cmsi09ddisp,f.mx003 as te005disp,
		//                g.mw002 as te009disp')
		// 	->from('sfcte as b')
		// 	->join('cmsmv as e', 'b.te004 = e.mv001 ', 'left')
		// 	->join('cmsmx as f', 'b.te005 = f.mx001 ', 'left')
		// 	->join('cmsmw as g', 'b.te009 = g.mw001 ', 'left')
		// 	->where('b.te001', $seq1)
		// 	->where('b.te002', $seq2);
		// $query = $this->db->get();
		//Right('000000' + Cast(123 as varchar),6) 補0用法


		$sql99 = " select a.TE001,a.TE002,a.TE003,a.TE004,a.TE005,a.TE006,a.TE007,a.TE008,a.TE009,a.TE010,
						  convert(varchar(25),convert(int,a.TE011)) as TE011,Right('0000' + Cast(a.TE012 as varchar),4) as TE012,
						  Right('0000' + Cast(a.TE013 as varchar),4) as TE013,a.TE014,a.TE015,a.TE016,a.TE017,a.TE018,a.TE019,a.TE020,
						  a.TE021,a.TE022,a.TE023,a.TE024,a.TE025,a.TE026,a.TE027,a.TE028,a.TE029,a.TE030,
						  a.TE004 as cmsi09d, c.MV002 as cmsi09ddisp, d.MX003 as TE005disp, e.MW003 as TE009disp,a.TE031, a.TE032, a.TE033,
						  a.TE034, a.TE035, a.TE036, a.TE037, a.TE038, a.TE039, a.TE040, a.TE041, a.TE042, a.TE043, a.TE044, a.TE045,
						  a.TE046, a.TE047, a.TE048, a.TE049, a.TE050, a.TE051, a.TE052, a.TE053, a.TE054, a.TE055, a.TE056, a.TE057, a.TE058,
						  a.TE059, a.TE060, a.TE061, a.TE062, a.TE063, a.TE064, a.TE065
					from SFCTE as a 
					left join SFCTD as b on a.TE001 =b.TD001 and a.TE002 =b.TD002
					left join CMSMV as c on a.TE004 = c.MV001
					left join CMSMX as d on a.TE005 = d.MX001 and b.TD004=d.MX002
					left join CMSMW as e on a.TE009 = e.MW001 
					where a.TE001 ='$seq1' and a.TE002='$seq2' ";
		$query = $this->db->query($sql99);

		if ($query->num_rows() <= 0) {
			$result['body_data'] = array();
			return $result;
		}

		$result['body_data'] = $query->result();

		if (count($result['body_data']) > 0) {
			$DB2 = $this->load->database('yjpal', TRUE);
			foreach ($result['body_data'] as $key => $val) {
				$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->cmsi09d' ");
				if ($query82->num_rows() > 0)
					$val->cmsi09ddisp = $query82->result()[0]->mv002;
			}
		}


		return $result;
	}

	//查詢修改用 (看資料用)   
	function selone_old($seq1, $seq2)
	{
		$this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td007disp,e.mf002 AS td008disp, f.mv002 AS td006disp,g.na003 AS td014disp,
		  ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013, b.te014,b.te016,b.te020,b.te030,b.te031,i.mc002 as te007disp,j.me002 as td005disp');

		$this->db->from('sfctd as a');
		$this->db->join('sfcte as b', 'a.td001 = b.te001  and a.td002=b.te002 ', 'left');	//單身	
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="22" ', 'left');  //單別
		$this->db->join('cmsmb as d', 'a.td007 = d.mb001 ', 'left');    //廠別
		$this->db->join('cmsmf as e', 'a.td008 = e.mf001 ', 'left');		//幣別
		$this->db->join('cmsmv as f ', 'a.td006 = f.mv001 and f.mv022 = " " ', 'left');  //業務人員
		$this->db->join('cmsna as g ', 'a.td014 = g.na002 and g.na001= "1" ', 'left');    //付款條件
		$this->db->join('copma as h', 'a.td004 = h.ma001 ', 'left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.te007 = i.mc001 ', 'left');   //庫別
		$this->db->join('cmsme as j', 'a.td005 = j.me001 ', 'left');   //部門
		$this->db->where('a.td001', $this->uri->segment(4));
		$this->db->where('a.td002', $this->uri->segment(5));
		$this->db->order_by('td001 , td002 ,b.te003');

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
	}

	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword)
	{
		$this->db->select('mb001, mb002, mb003,mb004')->from('sfctd');
		$this->db->like('mb001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('mb002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}

	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword)
	{
		$this->db->select('mc001, mc002')->from('cmsmc');
		$this->db->like('mc001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('mc002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}

	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)
	{
		//$seq5='';$seq51='';$seq7='';$seq71='';		  
		$seq11 = "SELECT COUNT(*) as count  FROM `sfctd` ";
		$seq1 = "td001, td002, td003, td004, td004 as td004disp,td005, td006,td007,td08,td010,td011,td012,td029,td030, create_date FROM `sfctd` ";
		$seq2 = "WHERE `a.create_date` >=' ' ";
		$seq32 = "`a.create_date` >='' ";
		$seq33 = 'a.td001 desc';
		$seq9 = " ORDER BY a.td001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`a.create_date` >='' ";

		$seq7 = "a.td001 ";

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
		//下一頁不要跑掉 1050317 1060815
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION['sfci03_sql_term']) {
			$seq32 = $_SESSION['sfci03_sql_term'];
		}
		if (@$_SESSION['sfci03_sql_sort']) {
			$seq33 = $_SESSION['sfci03_sql_sort'];
		}

		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('td001', 'td002', 'td003', 'td004', 'td004disp', 'b.ma002', 'td005', 'td006', 'td007', 'td008', 'td010', 'td011', 'td012', 'td019', 'td027', 'a.create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select(' a.*,e.mw002 as td004disp')
			->from('sfctd as a')
			->join('sfcte as b', 'a.td001 = b.te001 and a.td002 = b.te002', 'left')
			->join('cmsmw as e', 'a.td004 = e.mw001 ', 'left')
			->where($seq32)
			->order_by($seq33)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('sfctd as a')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//篩選多筆  舊版   
	function filterf1($limit, $offset, $sort_by, $sort_order)
	{
		$seq4 = trim(urldecode(urldecode($this->uri->segment(6)))); 	 //解決亂碼          
		$sort_by = $this->uri->segment(4);
		$sort_order = $this->uri->segment(5);
		$offset = $this->uri->segment(8, 0);
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('a.td001', 'a.td002', 'a.td003', 'a.td004', 'b.ma002', 'a.td029', 'a.td030', 'a.create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否為 table
		$this->db->select('a.td001, a.td002, a.td003, a.td004,b.ma002,  a.td029,a.td030, a.create_date');
		$this->db->from('sfctd as a');
		$this->db->join('copma as b', 'a.td004 = b.ma001 ', 'left');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		//$this->db->order_by('td001 asc, td002 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();

		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('sfctd as a');
		$this->db->join('copma as b', 'a.td004 = b.ma001 ', 'left');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//查新增資料是否重複 (單頭)  
	function selone1($seq1, $seq2)
	{
		// $this->db->where('td001', $seg1);
		// $this->db->where('td002', $seg2);
		// $query = $this->db->get('sfctd');
		// return $query->num_rows();
		$sql98 = " select * from SFCTD where TD001='$seq1' and TD002='$seq2' ";
		$query = $this->db->query($sql98);
		return $query->num_rows();
	}

	//查新增資料是否重複 (單身)	
	function selone1d($seg1, $seg2, $seg3)
	{
		$this->db->where('te001', $seg1);
		$this->db->where('te002', $seg2);
		$this->db->where('te003', $seg3);
		$query = $this->db->get('sfcte');
		return $query->num_rows();
	}

	//新增一筆 檔頭  sfctd	
	function insertf()    //新增一筆 檔頭  sfctd
	{
		//刪日期 / 符號
		preg_match_all('/\d/S', $this->input->post('td003'), $matches);  //處理日期字串
		$td003 = implode('', $matches[0]);
		preg_match_all('/\d/S', $this->input->post('td008'), $matches);  //處理日期字串
		$td008 = implode('', $matches[0]);
		$td003 = $td008;

		//------------凍結日期------------------
		$query = $this->db->query(" select MA011, MA013 from CMSMA ");
		foreach ($query->result() as $row) {
			$vma011 = $row->MA011;
			$vma013 = $row->MA013;
			if (substr($td003, 0, 6) < $vma011) {
				return '輸入日期資料不可小於庫存現行年月';
			}
			if ($td003 <= $vma013) {
				return '輸入日期資料須大於帳務凍結日期';
			}
		}
		//------------凍結日期----end--------------

		$td001 = trim($this->input->post('td001'));
		$td002 = trim($this->input->post('td002'));
		// $td002no = $td002;   //明細用再新增一筆時加1
		//檢查資料是否已存在 若存在加1
		// while ($this->sfci03_model->selone1($td001, $td002) > 0) {
		$TD002 = $this->check_title_no($td001, $td008);
		// $td002no = $td002;
		// }

		// $company = $this->session->userdata('syscompany');
		$company = 'YJ';
		$creator = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');
		// $vtd003 = iconv("utf-8", "BIG5", $vtd003);
		$td004 = trim($this->input->post('td004'));
		$td005 = trim($this->input->post('td005'));
		$td006 = trim($this->input->post('td006'));
		$td006 = iconv("utf-8", "BIG5", $td006);
		$td007 = trim($this->input->post('td007'));

		$td009 = trim($this->input->post('td009'));
		$td010 = trim($this->input->post('td010'));
		$cmsi04 = trim($this->input->post('cmsi04'));

		$sql = " INSERT INTO dbo.SFCTD
		(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TD001, TD002, TD003, TD004, TD005, TD006, TD007, TD008, TD009, TD010)
VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td001', '$TD002', '$td003', '$td004', '$td005', '$td006', '$td007', '$td008', '$td009', '$td010'); ";

		$this->db->query($sql);

		if ($this->input->post()) {
			extract($this->input->post());
		}


		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}

		// 新增明細 sfcte  
		// $vte003 = '0010';   //流水號重新排序
		if (isset($order_product)) {
			foreach ($order_product as $key => $val) {
				if ($val['TE003']) {
					extract($val);

					// $TE018 = iconv("utf-8", "BIG5", $TE018);		//產品品名
					// $TE019 = iconv("utf-8", "BIG5", $TE019);		//產品規格
					// $TE020 = iconv("utf-8", "BIG5", $TE020);		//單位
					$TE015 = iconv("utf-8", "BIG5", $TE015);		//備註
					$td003 = date('Ymd', strtotime($td003));         //日期處理

					if ($td001 == 'D404' || $td001 == 'D504') {
						$sql98 = " INSERT INTO dbo.SFCTE 
								(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
								TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, TE029, TE030,
								TE032, TE033, TE034, TE035, TE036, TE037, TE038, TE039, TE040, TE041, TE042, TE043, TE044, TE045, TE049, TE052,
									TE053, TE054, TE055, TE056, TE057, TE058, TE059, TE060, TE061, TE062, TE063, TE064)
						VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
								'$TE012', '$TE013', '$td005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027',
								'$TE029', '$TE030', '$TE032', '$TE033', '$TE034', '$TE035', '$TE036', '$TE037', '$TE038', '$TE039', '$TE040', '$TE041', 
								'$TE042', '$TE043', '$TE044', '$TE045', '$TE049', '$TE052', 
								'$TE053', '$TE054', '$TE055', '$TE056', '$TE057', '$TE058', '$TE059', '$TE060', '$TE061', '$TE062', '$TE063', '$TE064'); ";

						//invra 異動  配料  明細資料檔---------------------------

						//過管料=過管料可回收數量-過管料可回收已粉碎+過管料可回收未粉碎+過管料不可回收數量
						//過管料= 過管料可回收数量+過管料不可回收數量，過管料可回收数量是已粉碎和未粉碎的总数量
						// $vra011 = round($TE042 - $TE043 + $TE044 + $TE045, 3);
						$vra011 = round($TE042 + $TE045, 3);
						$vra011 = 0;
						$sql95 = " INSERT INTO dbo.invra
											(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra011, ra014, ra016, ra017, ra020, ra021)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$TE017', '$td003', '-1', '$td001', '$TD002', '$TE003', 'A205', '$vra011', '3', '$TE015', '$TE0333', '$TE042', '$TE045'); 				
									";
						$this->db->query($sql95);
						//invra 異動明細資料檔---------------------------end
					} else if ($td001 == 'D403') {	//橡膠
						$sql98 = " INSERT INTO dbo.SFCTE 
											(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
											TE011,TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, 
											TE029, TE030, TE032, TE035, TE040, TE041, TE050, TE051)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
											'$TE0333','$TE012', '$TE013', '$td005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', 
											'$TE029', '$TE030', '$TE032', '$TE035', '$TE040', '$TE041', '$TE050', '$TE051'); ";

						//invra 異動  配料  明細資料檔---------------------------

						$sql95 = " INSERT INTO dbo.invra
											(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra014, ra016, ra017)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$TE017', '$td003', '-1', '$td001', '$TD002', '$TE003', 'A203', '3', '$TE015', '$TE0333'); 				
									";
						$this->db->query($sql95);
						//invra 異動明細資料檔---------------------------end		
					} else if ($td001 == 'D503') {	//萬馬力
						$sql98 = " INSERT INTO dbo.SFCTE 
											(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
											TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, 
											TE029, TE032)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
											'$TE012', '$TE013', '$td005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', 
											'$TE029', '$TE032'); ";

						//invra 異動  配料  明細資料檔---------------------------

						$sql95 = " INSERT INTO dbo.invra
											(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra014, ra016, ra017)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$TE017', '$td003', '-1', '$td001', '$TD002', '$TE003', 'A203', '3', '$TE015', 'D503'); 				
									";
						$this->db->query($sql95);
						//invra 異動明細資料檔---------------------------end				
					} else if ($td001 == 'D401' || $td001 == 'D501') {
						$sql98 = " INSERT INTO dbo.SFCTE 
						(COMPANY, MODIFIER, USR_GROUP, MODI_DATE, FLAG, TE001, TE002, TE003, TE005, TE006, TE007, TE008, TE009, TE010,
						 TE014, TE015, TE017, TE018, TE019, TE020, TE029, TE032, TE046, TE047)
				VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td001', '$TD002', '$TE003', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
						 '$td005', '$TE015', '$TE017', '', '', '', '$TE029', '$TE032', '$TE046', '$TE047'); ";
					} else if ($td001 == 'D402' || $td001 == 'D502') {

						if ($td004 == 'CR004') {
							$td003 = trim($td003);
							$TE017 = trim($TE017);
							$TE005 = trim($TE005);
							$sql = " SELECT * FROM pclbh WHERE bh001='$td003' and bh002='$TE017' and bh003='$TE005' ";
							if ($this->db->query($sql)->num_rows() == 0) {
								$sqlin = " INSERT INTO dbo.pclbh 
											(company, creator, usr_group, create_date, flag, bh001, bh002, bh003)
										VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td003', '$TE017', '$TE005')
										";
								$this->db->query($sqlin);
							}
						}

						// if ($td001 == 'D402') {
						// $sql98 = " INSERT INTO dbo.SFCTE 
						// 		(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
						// 		TE011, TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, TE028, TE029, TE030, TE031, TE040, TE041, TE049)
						// VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
						// 		'$TE011', '$TE012', '$TE013', '$td005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', '$TE028',
						// 		'$TE029', '$TE030', '$TE031', '$TE0312', '$TE041', '$TE049'); ";
						// } else {
						$sql98 = " INSERT INTO dbo.SFCTE 
									(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010, TE041,
									TE011, TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, TE028, TE029, TE030, TE031, TE040, TE049, TE052,
									TE053, TE054, TE055, TE056, TE057, TE058, TE059, TE060, TE061, TE062, TE063, TE064, TE065)
							VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010',  '$TE041',
									'$TE011', '$TE012', '$TE013', '$td005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', '$TE028',
									'$TE029', '$TE030', '$TE031', '$TE0312', '$TE049', '$TE052', '$TE053', '$TE054', '$TE055', '$TE056', '$TE057', '$TE058', '$TE059', '$TE060', '$TE061',
									'$TE062', '$TE063', '$TE064', '$TE065'); ";
						// }
					} else {
						$sql98 = " INSERT INTO dbo.SFCTE 
									(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
									TE011, TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, TE028, TE029, TE030, TE031, TE040)
							VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
									'$TE011', '$TE012', '$TE013', '$td005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', '$TE028',
									'$TE029', '$TE030', '$TE031', '$TE0312'); ";
					}

					// echo "<pre>";
					// var_dump($sql98);
					// exit;
					$this->db->query($sql98);

					$sql99 = " UPDATE  SFCTE
									SET  SFCTE.TE018 = t.MB002,SFCTE.TE019 = t.MB003,SFCTE.TE020 = t.MB004
								FROM SFCTE c 
									INNER JOIN INVMB t
										ON c.TE017=t.MB001
								WHERE c.TE001 ='$td001' and c.TE002='$TD002' and c.TE003='$TE003'				
					";
					$this->db->query($sql99);
				}
			}
		}
	}

	//自動列印	
	function auto_print()
	{
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001", $this->input->post('sfci01'));
		$query = $this->db->get();
		$tmp = $query->result();
		if ($tmp[0]->mq016 == "Y") {
			echo "<script>window.open('printbb/" . $this->input->post('sfci01') . "/" . $this->input->post('td002') . ".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}

	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('td001', $this->input->post('td001c')); 
          $this->db->where('td002', $this->input->post('td002c'));
	      $query = $this->db->get('sfctd');
	      return $query->num_rows() ; 
	    } */

	//複製一筆	
	function copyf()
	{
		$this->db->where('td001', $this->input->post('td001o'));
		$this->db->where('td002', $this->input->post('td002o'));
		$query = $this->db->get('sfctd');
		$exist = $query->num_rows();
		if (!$exist) {
			return 'exist';
		}
		//   if ($query->num_rows() != 1) { return 'exist'; }
		if ($query->num_rows() == 1) {
			$result = $query->result();
			foreach ($result as $row) :
				$td003 = $row->td003;
				$td004 = $row->td004;
				$td005 = $row->td005;
				$td006 = $row->td006;
				$td007 = $row->td007;
				$td008 = $row->td008;
				$td009 = $row->td009;
				$td010 = $row->td010;
				$td011 = $row->td011;
				$td012 = $row->td012;
				$td013 = $row->td013;
				$td014 = $row->td014;
				$td015 = $row->td015;
				$td016 = $row->td016;
				$td017 = $row->td017;
				$td018 = $row->td018;
				$td019 = $row->td019;
				$td020 = $row->td020;
				$td021 = $row->td021;
				$td022 = $row->td022;
				$td023 = $row->td023;
				$td024 = $row->td024;
				$td025 = $row->td025;
				$td026 = $row->td026;
				$td027 = $row->td027;
				$td028 = $row->td028;
				$td029 = $row->td029;
				$td030 = $row->td030;
				$td031 = $row->td031;
				$td032 = $row->td032;
				$td033 = $row->td033;
				$td034 = $row->td034;
				$td035 = $row->td035;
				$td036 = $row->td036;
				$td037 = $row->td037;
				$td038 = $row->td038;
				$td039 = $row->td039;
				$td040 = $row->td040;
				$td041 = $row->td041;
				$td042 = $row->td042;
				$td043 = $row->td043;
				$td044 = $row->td044;
				$td045 = $row->td045;
				$td046 = $row->td046;
				$td047 = $row->td047;
				$td048 = $row->td048;
				$td049 = $row->td049;
				$td050 = $row->td050;
				$td051 = $row->td051;
			endforeach;
		}

		$seq1 = $this->input->post('td001c');    //主鍵一筆檔頭sfctd
		$seq2 = $this->input->post('td002c');
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
			'td001' => $seq1, 'td002' => $seq2, 'td003' => $td003, 'td004' => $td004, 'td005' => $td005, 'td006' => $td006, 'td007' => $td007, 'td008' => $td008, 'td009' => $td009, 'td010' => $td010,
			'td011' => $td011, 'td012' => $td012, 'td013' => $td013, 'td014' => $td014, 'td015' => $td015, 'td016' => $td016, 'td017' => $td017,
			'td018' => $td018, 'td019' => $td019, 'td020' => $td020, 'td021' => $td021, 'td022' => $td022, 'td023' => $td023, 'td024' => $td024,
			'td025' => $td025, 'td026' => $td026, 'td027' => $td027, 'td028' => $td028, 'td029' => $td029, 'td030' => $td030,
			'td031' => $td031, 'td032' => $td032, 'td033' => $td033, 'td034' => $td034, 'td035' => $td035, 'td036' => $td036,
			'td037' => $td037, 'td038' => $td038, 'td039' => $td039, 'td040' => $td040, 'td041' => $td041, 'td042' => $td042,
			'td043' => $td043, 'td044' => $td044, 'td045' => $td045, 'td046' => $td046, 'td047' => $td047, 'td048' => $td048,
			'td049' => $td049, 'td050' => $td050, 'td051' => $td051
		);

		$exist = $this->sfci03_model->selone1($seq1, $seq2);  //檢查單頭是否重複
		if ($exist) {
			return 'exist';
		}
		$this->db->insert('sfctd', $data);      //複製一筆  

		//複製一筆明細
		$this->db->where('te001', $this->input->post('td001o'));
		$this->db->where('te002', $this->input->post('td002o'));
		$query = $this->db->get('sfcte');
		$exist = $query->num_rows();
		if (!$exist) {
			return 'exist';
		}
		$num = $query->num_rows();
		//  if ($query->num_rows() != 1) { return 'exist'; }
		if ($query->num_rows() >= 1) {
			$result = $query->result();
			$i = 0;
			foreach ($result as $row) :
				$te003[$i] = $row->te003;
				$te004[$i] = $row->te004;
				$te005[$i] = $row->te005;
				$te006[$i] = $row->te006;
				$te007[$i] = $row->te007;
				$te008[$i] = $row->te008;
				$te009[$i] = $row->te009;
				$te010[$i] = $row->te010;
				$te011[$i] = $row->te011;
				$te012[$i] = $row->te012;
				$te013[$i] = $row->te013;
				$te014[$i] = $row->te014;
				$te015[$i] = $row->te015;
				$te016[$i] = $row->te016;
				$te017[$i] = $row->te017;
				$te018[$i] = $row->te018;
				$te019[$i] = $row->te019;
				$te020[$i] = $row->te020;
				$te021[$i] = $row->te021;
				$te022[$i] = $row->te022;
				$te023[$i] = $row->te023;
				$te024[$i] = $row->te024;
				$te025[$i] = $row->te025;
				$te026[$i] = $row->te026;
				$te027[$i] = $row->te027;
				$te028[$i] = $row->te028;
				$te029[$i] = $row->te029;
				$te030[$i] = $row->te030;
				$te031[$i] = $row->te031;
				$te032[$i] = $row->te032;
				$te033[$i] = $row->te033;
				$te034[$i] = $row->te034;
				$te035[$i] = $row->te035;
				$te036[$i] = $row->te036;
				$i++;
			endforeach;
		}
		$seq1 = $this->input->post('td001c');    //主鍵一筆明細sfcte
		$seq2 = $this->input->post('td002c');
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
				'te001' => $seq1, 'te002' => $seq2, 'te003' => $te003[$i], 'te004' => $te004[$i], 'te005' => $te005[$i], 'te006' => $te006[$i], 'te007' => $te007[$i],
				'te008' => $te008[$i], 'te009' => $te009[$i], 'te010' => $te010[$i], 'te011' => $te011[$i], 'te012' => $te012[$i], 'te013' => $te013[$i],
				'te014' => $te014[$i], 'te015' => $te015[$i], 'te016' => $te016[$i], 'te017' => $te017[$i], 'te018' => $te018[$i], 'te019' => $te019[$i],
				'te020' => $te020[$i], 'te021' => $te021[$i], 'te022' => $te022[$i], 'te023' => $te023[$i], 'te024' => $te024[$i], 'te025' => $te025[$i],
				'te026' => $te026[$i], 'te027' => $te027[$i], 'te028' => $te028[$i], 'te029' => $te029[$i], 'te030' => $te030[$i], 'te031' => $te031[$i], 'te032' => $te032[$i],
				'te033' => $te033[$i], 'te034' => $te034[$i], 'te035' => $te035[$i], 'te036' => $te036[$i]
			);

			$this->db->insert('sfcte', $data_array);      //複製一筆 
			$i++;
		}
		return true;
	}

	//轉excel檔   
	function excelnewf()
	{
		//刪日期 / 符號
		preg_match_all('/\d/S', $this->input->post('TD008s'), $matches);  //處理日期字串
		$seq1 = implode('', $matches[0]);
		preg_match_all('/\d/S', $this->input->post('TD008d'), $matches);  //處理日期字串
		$seq2 = implode('', $matches[0]);

		$seq3 = trim($this->input->post('td001'));
        //1130708
      //  $this->sqlrd();
		// $seq3 = $this->input->post('td002o');
		// $seq4 = $this->input->post('td002c');
		$sql = " select b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,
						a.TE017, a.TE018, a.TE019, g.da002,f.MW003 as TE009disp, g.da005, g.da004,(rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
						CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
						SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2)
						as TE013, '生產衝次' as TE0131,'產能85%' as da0051, a.TE011, '累積衝次' as TE0132, 
						(select sum(TE011) FROM SFCTE	WHERE TE006 <> '' and  TE006=a.TE006 and TE007=a.TE007 and TE008=a.TE008 and TE017=a.TE017 and TE002 <=a.TE002) as TA011dis, c.TA015, 
						convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312, convert(int,a.TE028)+convert(int,a.TE031) as TE0311,
						a.TE028,a.TE031, '生產效率' as da0052, g.da015, a.TE015
					
					from SFCTE	as a
						left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
						left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
						left join CMSMV as d on a.TE004=d.MV001
						left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
						left join CMSMW as f on a.TE009=f.MW001 
						left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
						left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
					where b.TD008>='$seq1' and b.TD008<='$seq2' 
					order by b.TD008,e.MX001
				";

		if ($seq3 != '') {

			if ($seq3 == 'D404' || $seq3 == 'D504') { //注塑
		   
				//left join MOCTB as d on a.TE006=d.TB001 and a.TE007=d.TB002 and a.TE017=d.TB003
				// 	left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004 
				// 	left join BOMMD as i on a.TE017=i.MD001 and MD002 like 'IM%'
				// 	left join INVMB as j on i.MD003 = j.MB001
				// j.MB002 1140306 MOID D407 D404
				$sql = " SELECT (CASE when TE022>='0800'and TE022<'2000' then '1' else '2' END) as TE022disp,
								b.TD008, a.TE022, e.MX003 as TE005disp, a.TE049, a.TE007, a.TE017, a.TE018, a.TE019, c.TA015, 
									(select sum(convert(int,TE040)) FROM SFCTE	
											left join SFCTD on TE001=TD001 and TE002=TD002
										WHERE TE006 <> '' and  TE006=a.TE006 and TE007=a.TE007 and TE008=a.TE008 and TE017=a.TE017 and TD008 <=b.TD008) as TA011dis,
									'aaa' as TA011div, h.MB002, g.da005, a.TE032, g.da010, g.da006, g.da007, a.TE033, a.TE034, 'bbb' as TE033dis, 'ccc' as TE033mul, 
									a.TE004 as TE004disp, (rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
									CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
									SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2) as TE013,
									'dddd' as TE0133, 'eeee' as TE0135, 'ffff' as TE0136, 'gggg' as TE0137, a.TE035, a.TE036, TE037, a.TE038, a.TE039,
									'' as TE0421, a.TE042, a.TE043, a.TE044, a.TE045,
									'hhhh' as TE0351, 'iiii' as TE0352, 'jjjj' as TE0353, a.TE041, a.TE015, a.TE040						
								from SFCTE as a
									left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
									left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
									
									left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
									left join CMSMW as f on a.TE009=f.MW001 
									left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
									left join INVMB as h on g.da016=h.MB001									
								where b.TD008>='$seq1' and b.TD008<='$seq2' and a.TE001='$seq3'  and b.TD001='D404'
								order by b.TD008, TE022disp, e.MX001
								";
			} else if ($seq3 == 'D401' || $seq3 == 'D501') { //鑄造

				$sql = " SELECT b.TD008,a.TE017, h.MB002, h.MB003, a.TE046, a.TE047, a.TE032, 'aaaa' as TE0461, g.da006, g.da008, a.TE048, 'bbbb' as TE0471, 'cccc' as TE0472,
									'dddd' as TE0473, 'eeee' as TE0474,	'ffff' as TE0475, a.TE029, g.da005, g.da014, g.da007
								from SFCTE as a
									left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
									left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
									
									left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
									left join CMSMW as f on a.TE009=f.MW001 
									left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
									left join INVMB as h on a.TE017=h.MB001									
								where b.TD008>='$seq1' and b.TD008<='$seq2' and (a.TE001='D401' or a.TE001='D501')
								order by b.TD008, a.TE022, e.MX001
								";
			} else if ($seq3 == 'D407' || $seq3 == 'D507') { //衝壓 1.單衝 2.連續
				$sql = " SELECT b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,
							a.TE017, a.TE018, a.TE019, g.da002,f.MW003 as TE009disp, g.da005, g.da004,(rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
							CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
							SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2)
							as TE013, '生產衝次' as TE0131,'產能85%' as da0051, a.TE011, '累積衝次' as TE0132, 
							(select sum(TE011) FROM SFCTE	WHERE TE006 <> '' and  TE006=a.TE006 and TE007=a.TE007 and TE008=a.TE008 and TE002 <=a.TE002) as TA011dis, c.TA015, 
							convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312, convert(int,a.TE028)+convert(int,a.TE031) as TE0311,
							a.TE028,a.TE031, '生產效率' as da0052, g.da015, a.TE015, a.TE029						
						from SFCTE	as a
							left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
							left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
							left join CMSMV as d on a.TE004=d.MV001
							left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
							left join CMSMW as f on a.TE009=f.MW001 
							left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
							left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
						where b.TD008>='$seq1' and b.TD008<='$seq2' and a.TE001='$seq3' and (b.TD001='D407' or b.TD001='D507')
						order by b.TD008,e.MX001
					";
			} else if ($seq3 == 'D411' || $seq3 == 'D511') { //裝配--------------------
				$sql = " SELECT b.TD008,   e.MX001, e.MX003 as TE005disp,(a.TE004 +';'+a.TE030) as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,
											a.TE017, a.TE018, a.TE019,f.MW003 as TE009disp,(rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
											CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
											SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2)
											as TE013, a.TE011, '標準時間' as stime, '生產效率' as pt, a.TE015,
											TE002,TE005,TE022,TE023,TE024,TE025,TE026,TE027, g.da004						
										from SFCTE	as a
											left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 
											left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
											left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
											left join CMSMW as f on a.TE009=f.MW001 
											left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
						where b.TD008>='$seq1' and b.TD008<='$seq2' and a.TE001='$seq3'
						order by b.TD008,e.MX001
					";
			} else {

				$sql = " SELECT b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,
							a.TE017, a.TE018, a.TE019, g.da002,f.MW003 as TE009disp, g.da005, g.da004,(rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
							CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
							SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2)
							as TE013, '生產衝次' as TE0131,'產能85%' as da0051, a.TE011, '累積衝次' as TE0132, 
							(select sum(TE011) FROM SFCTE	WHERE TE006 <> '' and  TE006=a.TE006 and TE007=a.TE007 and TE008=a.TE008 and TE002 <=a.TE002) as TA011dis, c.TA015, 
							convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312, convert(int,a.TE028)+convert(int,a.TE031) as TE0311,
							a.TE028,a.TE031, '生產效率' as da0052, g.da015, a.TE015						
						from SFCTE	as a
							left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
							left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
							left join CMSMV as d on a.TE004=d.MV001
							left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
							left join CMSMW as f on a.TE009=f.MW001 
							left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
							left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
						where b.TD008>='$seq1' and b.TD008<='$seq2' and a.TE001='$seq3' 
						order by b.TD008,e.MX001
					";
			}
		}


		$query = $this->db->query($sql);
		$result = $query->result();
		if (count($result) > 0) {
			$DB2 = $this->load->database('yjpal', TRUE);
			foreach ($result as $key => $val) {

				if ($seq3 == 'D401' || $seq3 == 'D501') { //鑄造----------------------

					if ($key == 0) {
						// 總出水量
						$sqlow = " SELECT sum(convert(int,dd004)) as ow FROM prsdd WHERE dd001='$val->TD008' ";
						$queryow = $this->db->query($sqlow);
						$sum_ow = 0;
						if ($queryow->num_rows() > 0) {
							$sum_ow = $queryow->result()[0]->ow;
						}

						//總浇注重量
						// $sqlpo = " SELECT sum(convert(float,da006)*convert(float,TE047)) as po FROM SFCTE 
						// 			left join SFCTD on TD001=TE001 and TD002=TE002
						// 			left join molda on TE017=da001 and TE009=da013 and TE029=da014
						// 			WHERE TE001 like 'D%01' and TD008='$val->TD008' 
						// 			";
						$sqlpo = " SELECT da014,TE032,da007,TE047,da006 
										FROM SFCTE 
									left join SFCTD on TD001=TE001 and TD002=TE002
									left join molda on TE017=da001 and TE009=da013 and TE029=da014
									WHERE TE001 like 'D%01' and TD008='$val->TD008'
									";
						$querypo = $this->db->query($sqlpo);
						$sum_po = 0;
						if ($querypo->num_rows() > 0) {
							foreach ($querypo->result() as $k1 => $v1) {
								if ($v1->da014 == '1') {
									$sum_po = round($sum_po + ($v1->TE032 * $v1->da007 * $v1->TE047), 2);
								} else {
									$sum_po = round($sum_po + ($v1->da006 * $v1->TE047), 2);
								}
							}
						}
					}


					// 整模單重(含水口)/g = 整模重 / 每模个数 da008
					// $val->da007 = round($val->da006 / $val->da005, 2);


					//空模率 = (造型数 -  浇注数) / 造型数 * 100%
					$val->TE0461 = round(($val->TE046 - $val->TE047) / $val->TE046 * 100, 2) . '%';

					if ($val->da014 == 1) {
						//每模毛重=穴數*每模淨重
						$val->da006 = round($val->TE032 * $val->da007, 2);
					}

					//浇注重量 = 模重 * 浇注数
					$val->TE0471 = round($val->da006 * $val->TE047, 2);



					if ($sum_ow == 0) {
						//出水重量  = 
						$val->TE048 = '未找到出水量';
					} else if ($sum_po == 0) {
						//出水重量  = 
						$val->TE048 = '未找到浇注重量';
					} else if ($val->TE0471 == '未到到模重') {
					} else {

						//出水重量(KG) = (總出水重量 / 總浇注重量) *浇注重量
						$vTE048 = round(($sum_ow / $sum_po) * $val->TE0471, 0);
						$val->TE048 = $vTE048;

						//铁水损耗率 = (出水重量 - 浇注重量) / 出水重量 * 100%
						$val->TE0472 = round(($val->TE048 - $val->TE0471) / $val->TE048 * 100, 2) . '%';

						if (trim($val->TE029) == '2') {	//'1' => "合模", '2' => "單模"
							//毛坯数 = 浇注数 * 每模个数
							$val->TE0473 = round($val->TE047 * $val->da005, 0);
						} else {
							//毛坯数 = 浇注数 * 實際模穴數
							$val->TE0473 = round($val->TE047 * $val->TE032, 0);
						}

						if ($val->da008) {
							//毛坯总重 = 毛坯数 * 毛坯单重
							$val->TE0474 = round($val->TE0473 * $val->da008, 2);
							//得料率 = 毛坯总重 / 出水重量 * 100%
							$val->TE0475 = round($val->TE0474 / $vTE048 * 100, 0) . '%';
						} else {
							$val->TE0474 = '未設定毛坯单重';
						}
					}
					unset($val->da005);
					unset($val->da007);
					unset($val->da014);
					unset($val->TE029);
				} else if ($seq3 == 'D404' || $seq3 == 'D504') { //注塑--------------------------------------
					//使用pal DB 找到使用者--------------------------------------------------------------------
					$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004disp' ");
					if ($query82->num_rows() > 0)
						$val->TE004disp = $query82->result()[0]->mv002;
					//使用pal DB 找到使用者------------------------------------end--------------------------------

					//算時數
					$workhour = round((floatval(substr($val->TE013, 0, 2)) * 60 + floatval(substr($val->TE013, -2))) / 60, 2);


					//班別 0800~2000 日班， 其他 夜班
					// $val->TE022 = ($val->TE022 >= '0800' && $val->TE022 < '2000') ? '日班' : '夜班';
					$val->TE022 = ($val->TE022disp == '1') ? '日班' : '夜班';

					//總合==========處理同天無法分辨日夜班 加總問題
					// if ($val->TE022 == '日班') {
					for ($i = $key + 1; $i < count($result); $i++) {
						if ($result[$key]->TD008 == $result[$i]->TD008 && $result[$key]->TE017 == $result[$i]->TE017 && $result[$key]->TE007 == $result[$i]->TE007) {
							$val->TA011dis = round($val->TA011dis -  $result[$i]->TE040, 0);
						}
					}
					// }

					//a.TE049 是否使用機械手
					if ($val->TE049 == '2') {
						$val->TE049 = '';
					} else {
						$val->TE049 = '是';
					}

					//訂單完成率% ='累計產量' / '訂單數量' * 100%
					$val->TA011div = round($val->TA011dis / $val->TA015 * 100, 2) . '%';

					//模次數 ='結束模數' - '起始模數'
					$val->TE033dis = round($val->TE034 - $val->TE033, 0);

					//折合生產數 ='實際模穴數' * 模次數
					$val->TE033mul = round($val->TE032 * $val->TE033dis, 0);

					if ($val->da005) {
						if ($val->da010) {
							//標準生產數量 =workhour * 3600 /'生產週期' * '理論模穴數' 
							$val->TE0133 = round($workhour * 3600 / $val->da010 * $val->da005, 0);
						} else {
							$val->TE0133 = '未設定生產週期';
						}
					} else {
						$val->TE0133 = '未設定模穴數';
					}

					//生產數量 = 實際模穴數 * 模次數 = 折合生產數
					$val->TE0135 = $val->TE033mul;

					if ($val->TE0133 == '未設定生產週期' or $val->TE0133 == '未設定模穴數') {
						$val->TE0136 = $val->TE0133;
					} else {
						//產量達標率 = 生產數量 / 標準生產數量 * 100%
						$val->TE0136 = round($val->TE0135 / $val->TE0133 * 100, 0) . '%';
					}

					//合格數量 = 生產數量 - 不良總數 ／／- 待粉碎量 - 不可粉碎- $val->TE037 - $val->TE038
					$val->TE0137 = round($val->TE0135 - $val->TE035, 0);

					//可回收未粉碎=可回收數量-可回收已粉碎
					$val->TE0421 = round($val->TE042 - $val->TE043, 1);

					//良品率 =合格數量 / 生產數量
					$val->TE0351 = round($val->TE0137 / $val->TE0135 * 100, 2) . '%';

					//總不良率 =不良總數 / 生產數量
					$val->TE0352 = round($val->TE035 / $val->TE0135 * 100, 2) . '%';

					//不可粉碎率 = 不可粉碎 / 生產數量
					$val->TE0353 = round($val->TE038 / $val->TE0135 * 100, 2) . '%';


					//不良原因
					if ($val->TE041) {
						$arr = explode(';', $val->TE041);
						$vTE041 = '';
						foreach ($arr as $k => $v) {
							if ($arr[$k]) {
								$vmm001 = $arr[$k];
								$query = $this->db->query(" select mm002 from cmsmm1 where mm001='$vmm001' ");
								if ($query->num_rows() > 0)
									$vTE041 .= mb_convert_encoding(trim($query->result()[0]->mm002), 'utf-8', 'big-5') . ';';
							}
						}
						$val->TE041 = $vTE041;
					}
					unset($val->TE022disp);
					unset($val->TE040);
					//注塑--------------------------------------end
				} else if ($seq3 == 'D411' || $seq3 == 'D511') { //裝配--------------------
					//使用pal DB 找到使用者--------------------------------------------------------------------
					if ($val->TE004disp != '') {

						$arr = explode(";", $val->TE004disp);
						$val->TE004disp = '';

						foreach ($arr as $k => $v) {
							if ($arr[$k]) {
								$vmv001 = $arr[$k];
								$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$vmv001' ");
								if ($query82->num_rows() > 0)
									$val->TE004disp .= $query82->result()[0]->mv002 . ';';
							}
						}
					}
					//使用pal DB 找到使用者------------------------------------end--------------------------------

					//算時數
					$workhour = round((floatval(substr($val->TE013, 0, 2)) * 60 + floatval(substr($val->TE013, -2))) / 60, 2);

					if (!$val->da004) {
						$val->stime = '未對應到產能';		//標準時間
						$val->pt = '';						//生產效率
					} else {
						//ROUND(生產數量/衝次（產能）/作業人數/60分鐘,2)
						$val->stime = round($val->TE011 / $val->da004 / $val->TE030disp / 60, 2);	//標準時間

						//生產效率------------------------
						$sql83 = " SELECT TE002,TD003,TE005,TE022,TE023,TE024,TE025,TE026,TE027,
											SUM( ROUND( CONVERT(float,TE011)/ CONVERT(float,ISNULL(da004,1))/((LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1)/60,2)   ) as te111
									FROM SFCTE	as a
								left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002
								left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
							WHERE b.TD008>='$seq1' and b.TD008<='$seq2' and a.TE001='$seq3'
							GROUP by TE002,TD003,TE005,TE022,TE023,TE024,TE025,TE026,TE027
							ORDER BY TE002 
							";
						$query83 = $this->db->query($sql83);
						foreach ($query83->result() as $k => $r) {

							if (
								($val->TE002 == $r->TE002) && ($val->TE005 == $r->TE005) && ($val->TE022 == $r->TE022) && ($val->TE023 == $r->TE023)
								&& ($val->TE024 == $r->TE024) && ($val->TE025 == $r->TE025) && ($val->TE026 == $r->TE026) && ($val->TE027 == $r->TE027)
							) {
								$val->pt = round($r->te111 / $workhour * 100, 2) . '%';
								break;
							} else {
								$val->pt = round($val->stime / $workhour * 100, 2) . '%';
							}
						}

						//生產效率------------------------end
					}
					unset($val->TE002);
					unset($val->TE005);
					unset($val->TE022);
					unset($val->TE023);
					unset($val->TE024);
					unset($val->TE025);
					unset($val->TE026);
					unset($val->TE027);
					unset($val->da004);
				} else if ($seq3 == 'D407' || $seq3 == 'D507' || $seq3 == 'D410' || $seq3 == 'D510' || $seq3 == 'D409' || $seq3 == 'D509') {
					//使用pal DB 找到使用者--------------------------------------------------------------------
					$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004disp' ");
					if ($query82->num_rows() > 0)
						$val->TE004disp = $query82->result()[0]->mv002;
					//使用pal DB 找到使用者------------------------------------end--------------------------------


					//算時數
					$workhour = round((floatval(substr($val->TE013, 0, 2)) * 60 + floatval(substr($val->TE013, -2))) / 60, 2);


					if (!$val->da005) {
						$val->TE0131 = '';
						$val->TE0132 = '';
					} else {
						$val->TE0131 =  round(floatval($val->TE011) / floatval($val->da005), 0);	//生產衝次
						$val->TE0132 =  round(floatval($val->TA011dis) / floatval($val->da005), 0);	//累積衝次
					}


					// if ($val->da0051) {
					if (!$val->da004 || !$val->da005 || !$val->da015) {
						$val->da0051 = '';
					} else {
						//$val->da0051 = round(60 * 85 * floatval($val->da004) * floatval($val->da005) / 100 / floatval($val->da015), 0);
						//60*0.85*標準沖次*實際生產時間/人數 $val->da015
						//目標產能=生產用時*60分*85%*模具標準衝次*模穴數 20230907
						//目標產能=生產用時*60分*85%*模具標準衝次*模穴數 20240110 上一批少乘 模穴數
						$val->da0051 = round(60 * 85 * floatval($val->da004) * floatval($val->da005) * $workhour / 100, 0);
					}
					// }
					if ($workhour <= 0) {
						$val->da0052 = '工作時間必須大於0';
					} else {
						if (!$val->da0051 || !$val->TE011) {
							$val->da0052 = '';
						} else {
							// $val->da0052 = round($val->TE011 / $workhour / $val->TE030disp / $val->da0051 * 100, 0) . '%';
							// 合格/目標*100%
							$val->da0052 = round($val->TE0312 / $val->da0051 * 100, 0) . '%';
						}
					}

					unset($val->da015);
				} else {

					//使用pal DB 找到使用者--------------------------------------------------------------------
					$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004disp' ");
					if ($query82->num_rows() > 0)
						$val->TE004disp = $query82->result()[0]->mv002;
					//使用pal DB 找到使用者------------------------------------end--------------------------------


					//算時數
					$workhour = round((floatval(substr($val->TE013, 0, 2)) * 60 + floatval(substr($val->TE013, -2))) / 60, 2);


					if (!$val->da005) {
						$val->TE0131 = '';
						$val->TE0132 = '';
					} else {
						$val->TE0131 =  round(floatval($val->TE011) / floatval($val->da005), 0);	//生產衝次
						$val->TE0132 =  round(floatval($val->TA011dis) / floatval($val->da005), 0);	//累積衝次
					}


					// if ($val->da0051) {
					if (!$val->da004 || !$val->da005 || !$val->da015) {
						$val->da0051 = '';
					} else {
						//$val->da0051 = round(60 * 85 * floatval($val->da004) * floatval($val->da005) / 100 / floatval($val->da015), 0);
						//60*0.85*標準沖次*實際生產時間/人數
						$val->da0051 = round(60 * 85 * floatval($val->da004) * $workhour / $val->da015 / 100, 0);
					}
					// }
					if ($workhour <= 0) {
						$val->da0052 = '工作時間必須大於0';
					} else {
						if (!$val->da0051 || !$val->TE011) {
							$val->da0052 = '';
						} else {
							// $val->da0052 = round($val->TE011 / $workhour / $val->TE030disp / $val->da0051 * 100, 0) . '%';
							// 合格/目標*100%
							$val->da0052 = round($val->TE0312 / $val->da0051 * 100, 0) . '%';
						}
					}

					unset($val->da015);
				}
			}
		}

		return $result;
	}

	//轉excel檔_月報表   
	function excelnewf_month($filename = '')
	{
		$TD008 = date("Ym", strtotime(trim($this->input->post('TD008s'))));
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));	//起始日期
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));	//到期日期

		$seq1 = trim($this->input->post('td001'));

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		if ($seq1 == 'D404') {

			//月報表---------產生---D404--注塑報工---------------------------------------------------------------------------------------------------------------------------------------------
			$title = array(
				'品號', '品名', '規格', '配方', '總產量', '產品毛重/g', '產品淨重/g', '耗料', '良品數量合計', '不良數量合計', '合格率（%）', '不良率（%）', '其中：按不良原因分類',
				'', '', '', '', '', '', '', '', '', '', '', '', ''
			);

			$HVrow = 1;
			//表頭循環
			foreach ($title as $tkey => $tvalue) {
				$tkey = $tkey + 1;
				$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
				// Add some data  //表頭
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
				$HVrow = $tkey;
			}

			$title = array(
				'品號', '品名', '規格', '配方', '總產量', '產品' . PHP_EOL . '毛重/g', '產品' . PHP_EOL . '淨重/g', '耗料', '良品數' . PHP_EOL . '量合計',
				'不良數' . PHP_EOL . '量合計', '合格率' . PHP_EOL . '（%）', '不良率' . PHP_EOL . '（%）', '雜色',
				'油污', '缺膠', '外觀不良', '調機', '黑點', '料花', '漏膠', '縮水', '孔大', '起泡', '頂白', '其他', '合計'
			);


			$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[6] . '1')->getAlignment()->setWrapText(true); //設定換行
			$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[7] . '1')->getAlignment()->setWrapText(true); //設定換行
			$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[9] . '1')->getAlignment()->setWrapText(true); //設定換行
			$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[10] . '1')->getAlignment()->setWrapText(true); //設定換行
			$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[11] . '1')->getAlignment()->setWrapText(true); //設定換行
			$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[12] . '1')->getAlignment()->setWrapText(true); //設定換行

			$HVrow = 1;
			//表頭循環
			foreach ($title as $tkey => $tvalue) {
				$tkey = $tkey + 1;
				$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
				// Add some data  //表頭
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
				$HVrow = $tkey;
			}

			//設置欄寛-------------------------------------------------------
			$width_ary = array(
				'16', '26', '30', '8', '8', '8', '8', '8', '8', '8', '8', '8', '5',
				'5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5'
			);  //excel 表頭	
			foreach ($width_ary as $k => $v) {
				$tkey = $k + 1;
				if (@$width_ary[$k] && $width_ary[$k] > 0) {
					$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
					//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
				} else {
					$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
				}
			}
			//設置欄寛----------------end---------------------------------------
			$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
			$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中

			$k = 1;
			for ($i = $k; $i < 13; $i++) { // 合併儲存格  測量日期、機台名稱、品號、品名、規格
				$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
				$k = $i + 1;
			}
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$k] . '1:' . $this->cellArray[26] . '1');

			$sql98 = " SELECT TE017,TE018,TE019,da016,SUM( convert(int,TE040))+SUM( convert(int,TE035)) as sumqty,da005,
							da006,da007, '' as con,
							SUM( convert(int,TE040)) as sumg , SUM( convert(int,TE035)) as sumb , '' as pr, '' as dr,
							SUM(convert(int,TE052)) as TE052,
							SUM(convert(int,TE053)) as TE053,
							SUM(convert(int,TE054)) as TE054,
							SUM(convert(int,TE055)) as TE055,
							SUM(convert(int,TE056)) as TE056,
							SUM(convert(int,TE057)) as TE057,
							SUM(convert(int,TE058)) as TE058,
							SUM(convert(int,TE059)) as TE059,
							SUM(convert(int,TE060)) as TE060,
							SUM(convert(int,TE061)) as TE061,
							SUM(convert(int,TE062)) as TE062,
							SUM(convert(int,TE063)) as TE063,
							SUM(convert(int,TE064)) as TE064,
							'' as isum
						FROM SFCTE
							left join SFCTD on TD001=TE001 and TD002=TE002
							left join molda on da001=TE017 and da013=TE009 and da014=TE029
						where TD008>='$TD008s' and TD008<='$TD008d' and TD001='D404'
						GROUP by TE017,TE018,TE019,da016,da005,da006,da007
						";
			$query = $this->db->query($sql98);

			$query = $this->db->query($sql98);
			if ($query->num_rows() > 0) {
				$results = $query->result();

				$ro = 3;
				foreach ($results as $key => $val) {
					$col = 1;

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE017);	//品號
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE018), 'utf-8', 'big-5'));	//品名
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE019), 'utf-8', 'big-5'));	//規格
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->da016));	//配方
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->sumqty));	//總產量
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->da006));	//'產品' . PHP_EOL . '毛重/g'
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->da007));	//'產品' . PHP_EOL . '淨重/g'
					//耗料 = round(毛重 * 總量 / 1000,2)
					//耗料 = round(毛重/理論穴數 * 總量 / 1000,3) 20240201改
					$val->con = round(floatval($val->da006) / floatval($val->da005) * $val->sumqty / 1000, 3);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->con);		//耗料

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->sumg);		//'良品數' . PHP_EOL . '量合計'
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->sumb);		//'不良數' . PHP_EOL . '量合計'
					//'合格率（%）'= 良品數 / 總產量 *100%
					$val->pr = round($val->sumg / $val->sumqty * 100, 2) . '%';
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->pr);	//合格率

					//不良率 = 不良數 / 總產量 *100%
					$val->dr = round($val->sumb / $val->sumqty * 100, 2) . '%';
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->dr);	//不良率

					// if ($val->TE041) {
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i01 == 0) ? '' : $val->i01);	//雜色
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i02 == 0) ? '' : $val->i02);	//油污
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i03 == 0) ? '' : $val->i03);	//缺膠
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i04 == 0) ? '' : $val->i04);	//外觀不良
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i05 == 0) ? '' : $val->i05);	//調機
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i06 == 0) ? '' : $val->i06);	//黑點
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i07 == 0) ? '' : $val->i07);	//料花
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i08 == 0) ? '' : $val->i08);	//漏膠
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i09 == 0) ? '' : $val->i09);	//縮水
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i10 == 0) ? '' : $val->i10);	//孔大
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i11 == 0) ? '' : $val->i11);	//起泡
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i12 == 0) ? '' : $val->i12);	//頂白
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->i13 == 0) ? '' : $val->i13);	//其他
					// 	$isum = ($val->i01 + $val->i02 + $val->i03 + $val->i04 + $val->i05 + $val->i06 + $val->i07 + $val->i08 + $val->i09
					// 		+ $val->i10 + $val->i11 + $val->i12 + $val->i13);
					// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, $isum);	//合計
					// } else {

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE052));	//雜色
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE053));	//油污
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE054));	//缺膠
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE055));	//外觀不良
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE056));	//調機
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE057));	//黑點
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE058));	//料花
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE059));	//漏膠
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE060));	//縮水
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE061));	//孔大
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE062));	//起泡
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE063));	//頂白
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE064));	//其他

					$i01 = ($val->TE052) ? intval($val->TE052) : 0;
					$i02 = ($val->TE053) ? intval($val->TE053) : 0;
					$i03 = ($val->TE054) ? intval($val->TE054) : 0;
					$i04 = ($val->TE055) ? intval($val->TE055) : 0;
					$i05 = ($val->TE056) ? intval($val->TE056) : 0;
					$i06 = ($val->TE057) ? intval($val->TE057) : 0;
					$i07 = ($val->TE058) ? intval($val->TE058) : 0;
					$i08 = ($val->TE059) ? intval($val->TE059) : 0;
					$i09 = ($val->TE060) ? intval($val->TE060) : 0;
					$i10 = ($val->TE061) ? intval($val->TE061) : 0;
					$i11 = ($val->TE062) ? intval($val->TE062) : 0;
					$i12 = ($val->TE063) ? intval($val->TE063) : 0;
					$i13 = ($val->TE064) ? intval($val->TE064) : 0;

					$isum = ($i01 + $i02 + $i03 + $i04 + $i05 + $i06 + $i07 + $i08 + $i09
						+ $i10 + $i11 + $i12 + $i13);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, $isum);	//合計

					// }
				}
			}

			//月報表---------產生----D404-END---------------------------------------------------------------------------------------------------------------------------------------------
		} else {

			//月報表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------

			$title = array(
				'生產年月', '品號', '品名', '規格', '生產數量', '入庫數量', '工令', '工序序號1', '工序代號1', '工序名稱1', '合格數量1', '工序序號2', '工序代號2', '工序名稱2', '合格數量2',
				'工序序號3', '工序代號3', '工序名稱3', '合格數量3', '工序序號4', '工序代號4', '工序名稱4', '合格數量4', '工序序號5', '工序代號5', '工序名稱5', '合格數量5',
				'工序序號6', '工序代號6', '工序名稱6', '合格數量6', '工序序號7', '工序代號7', '工序名稱7', '合格數量7'
			);  //excel 表頭		

			$HVrow = 1;
			//表頭循環
			foreach ($title as $tkey => $tvalue) {
				$tkey = $tkey + 1;
				$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
				// Add some data  //表頭
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
				$HVrow = $tkey;
			}
			$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
			$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中


			$sTG002 = $TD008s . '001'; //起 製令
			$eTG002 = $TD008d . '999'; //訖 製令

			$sql98 = " SELECT TE017,TE018,TE019, TE006, TE007, TE008, TE009, a.TA015 , MW003, --sum(convert(int,TE040)), (sum(TE011)-sum(convert(int,TE028))-sum(convert(int,TE031))) as TE011dis,
						--CASE when TE001='D404' or TE001='D504' then sum(convert(int,TE040)) else sum(TE011)-sum(convert(int,TE028))-sum(convert(int,TE031)) END as TE011dis,
						CASE when TE001='D404' or TE001='D504' then sum(convert(int,TE040)) else  ( CASE when TE001='D401' then sum(convert(int,TE032)*convert(int,TE047)) else sum(TE011)-sum(convert(int,TE028))-sum(convert(int,TE031)) END )  END as TE011dis, 
						( SELECT ISNULL(SUM(TG013),0)  from MOCTG as b WHERE b.TG014=TE006  and b.TG015=TE007 AND b.TG002 >='$sTG002' AND b.TG002 <='$eTG002' ) as TA011
						FROM SFCTE 
						left join SFCTD on TD001=TE001 and TD002=TE002
						left join MOCTA as a on a.TA001=TE006 and a.TA002=TE007 
						left join CMSMW on MW001=TE009 
						--left join SFCTA as b on b.TA001=TE006  and b.TA002=TE007
						";


			$swhere = "	where TD008>='$TD008s' and TD008<='$TD008d' ";
			$sGROUP = "	GROUP by TE001,TE017,TE018,TE019, TE006, TE007, TE008,TE009, a.TA015, MW003, TA011 ";
			$sorder = "	order by TE017, TE006, TE007, TE008 ";

			if ($seq1) {
				$swhere = " where TD008>='$TD008s' and TD008<='$TD008d'	and TD001='$seq1' ";
				if ($seq1 == 'D401') { //合併D401=D401+D402
					$swhere = " where TD008>='$TD008s' and TD008<='$TD008d'	and (TD001='D401' or TD001='D402') ";
				}
				if ($seq1 == 'D407') { //合併D407=D407+D409+D410
					$swhere = " where TD008>='$TD008s' and TD008<='$TD008d'	and (TD001='D407' or TD001='D409' or TD001='D410') ";
				}
			}

			$sql98 = $sql98 . $swhere . $sGROUP . $sorder;


			$query = $this->db->query($sql98);
			if ($query->num_rows() > 0) {
				$results = $query->result();
				$ro = 2;
				$col = 1;
				foreach ($results as $key => $val) {
					$TD008e = date("Y/m", strtotime(trim($this->input->post('TD008s'))));
					if ($key == 0) {
						$TD008e = date('Y/m', strtotime(trim(substr($val->TE007, 0, 8))));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $TD008e);		//生產年月
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE017);	//品號
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE018), 'utf-8', 'big-5'));	//品名
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE019), 'utf-8', 'big-5'));	//規格
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TA015);	//生產數量
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TA011);	//入庫數量
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE006 . '-' . $val->TE007);	//工令
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE008);	//工序序號
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE009);	//工序代號
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->MW003), 'utf-8', 'big-5'));	//工序名稱					
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE011dis);	//合格數量
					} else if (($results[$key - 1]->TE017 == $results[$key]->TE017) && ($results[$key - 1]->TE007 == $results[$key]->TE007)) {
						if (($results[$key - 1]->TE008 != $results[$key]->TE008)) {
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $ro, $val->TA011);	//入庫數量
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE008);	//工序序號
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE009);	//工序代號
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->MW003), 'utf-8', 'big-5'));	//工序名稱
							// $objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TA015);	//生產數量
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE011dis);	//合格數量
						}
					} else {
						$ro++;
						$col = 1;
						$TD008e = date('Y/m', strtotime(trim(substr($val->TE007, 0, 8))));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $TD008e);		//生產年月
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE017);	//品號
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE018), 'utf-8', 'big-5'));	//品名
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE019), 'utf-8', 'big-5'));	//規格
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TA015);	//生產數量
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TA011);	//入庫數量
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE006 . '-' . $val->TE007);	//工令
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE008);	//工序序號
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE009);	//工序代號
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->MW003), 'utf-8', 'big-5'));	//工序名稱
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE011dis);	//合格數量
					}
				}
			}


			//月報表---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------
		}
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($TD008);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "月報表_" . date('Ymd');
		} else {
			if ($seq1) {
				$filename = $TD008 . '月報表_' . $seq1;
			} else {
				$filename = $TD008 . '月報表';
			}
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//   $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	//溶解生產記錄表
	function excelnewf_prs($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//溶解生產記錄表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$objPHPExcel->getActiveSheet()->getStyle('A1:BL17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:BL17')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->mergeCells('A1:A2'); //合併儲存格 最左上 空白  
		$col = 1;
		$objPHPExcel->getActiveSheet()->mergeCells('A3:A6'); //合併儲存格 最左 加料記錄  
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '加料記錄');
		$objPHPExcel->getActiveSheet()->mergeCells('A7:A11'); //合併儲存格 最左 光譜記錄  
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', '光譜記錄');
		$objPHPExcel->getActiveSheet()->mergeCells('A12:A16'); //合併儲存格 最左 出湯記錄  
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', '出湯記錄');
		$objPHPExcel->getActiveSheet()->mergeCells('A17:A19'); //合併儲存格 最左 其他  
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A17', '其他');

		$sql98 = " SELECT a.* ,
						( SELECT TOP 1 dc003 FROM prsdc as b where b.dc001=a.da001 and b.dc002=a.da002 order by b.dc008) as dc003,
						( SELECT TOP 1 dc004 FROM prsdc as b where b.dc001=a.da001 and b.dc002=a.da002 order by b.dc008) as dc004
					FROM dbo.prsda as a
					WHERE da001 ='$TD008s' ORDER BY da002 ";
		$queryda = $this->db->query($sql98);

		if ($queryda->num_rows() > 0) {
			$resultda = $queryda->result();
			foreach ($resultda as $key => $val) {

				$col++;
				$row  = $this->cellArray[$col] . '1';     //B1位置
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, '爐次');
				$row  = $this->cellArray[$col] . '2';     //B2位置
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, '產品名稱');
				$row  = $this->cellArray[$col] . '17';     //B17位置
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, '電力');
				$row  = $this->cellArray[$col] . '18';     //B18位置
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, '故障記錄');
				$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col + 1] . '18' . ':' . $this->cellArray[$col + 8] . '18'); //合併儲存格  
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col + 1] . '18', mb_convert_encoding(trim($val->da010), 'utf-8', 'big-5'));
				$row  = $this->cellArray[$col] . '19';     //B19位置
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, '備註');
				$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col + 1] . '19' . ':' . $this->cellArray[$col + 8] . '19'); //合併儲存格  
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col + 1] . '19', mb_convert_encoding(trim($val->da011), 'utf-8', 'big-5'));


				$col++;
				$col_m = $col + 1;
				$row  = $this->cellArray[$col] . '1';     //C1位置
				$objPHPExcel->getActiveSheet()->mergeCells($row . ':' . $this->cellArray[$col_m] . '1'); //合併儲存格   
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $val->da002);
				$row  = $this->cellArray[$col] . '2';     //C2位置
				$objPHPExcel->getActiveSheet()->mergeCells($row . ':' . $this->cellArray[$col_m] . '2'); //合併儲存格   
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, mb_convert_encoding(trim($val->da005), 'utf-8', 'big-5'));
				$row  = $this->cellArray[$col] . '17';     //C17位置
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, '開始');
				$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col + 1] . '17' . ':' . $this->cellArray[$col_m + 1] . '17'); //合併儲存格   
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col + 1] . '17', $val->da007);
				$col++;									 //D1位置

				$col++;
				$row  = $this->cellArray[$col] . '1';     //E1位置
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, '材質');
				$row  = $this->cellArray[$col] . '2';     //E2位置
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, '出爐溫度');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col + 1] . '17', '結束'); // F17位置

				$col++;
				$col_m = $col + 1;
				$row  = $this->cellArray[$col] . '1';     //F1位置
				$objPHPExcel->getActiveSheet()->mergeCells($row . ':' . $this->cellArray[$col_m] . '1'); //合併儲存格  
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $val->da003);
				$row  = $this->cellArray[$col] . '2';     //F2位置
				$objPHPExcel->getActiveSheet()->mergeCells($row . ':' . $this->cellArray[$col_m] . '2'); //合併儲存格  
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $val->da006 . '℃');
				$row  = $this->cellArray[$col] . '17';     //F17位置
				$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col + 1] . '17' . ':' . $this->cellArray[$col_m + 1] . '17'); //合併儲存格  
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col + 1] . '17', $val->da008);
				$col++;									 //G1位置

				$col++;
				$row  = $this->cellArray[$col] . '1';     //H1位置
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, 'CE值');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col + 1] . '17', '耗電'); // I17位置

				$col++;
				$col_m = $col + 1;
				$row  = $this->cellArray[$col] . '1';     //I1位置
				$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col] . '1' . ':' . $this->cellArray[$col_m] . '1'); //合併儲存格   
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $val->da004);
				$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col - 1] . '2' . ':' . $this->cellArray[$col_m] . '2'); //合併儲存格   
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col - 1] . '2', 'C:' . $val->dc003 . ' Si:' . $val->dc004);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col_m] . '17', $val->da009); // J17位置
				$col++;									 //J1位置
			}

			$countda = count($resultda);

			$sql98 = " SELECT *  FROM dbo.prsdb
						WHERE db001 ='$TD008s' order by db002, db011 ";
			$querydb = $this->db->query($sql98);
			if ($querydb->num_rows() > 0) {
				$resultdb = $querydb->result();
				$ida = 0;
				$col = 1;
				$col1 = 2;
				$col2 = 2;
				$ro = 4;
				foreach ($resultdb as $key => $val) {
					if ($key == 0) {
						$col++;
						for ($i = 0; $i < $countda; $i++) {
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '3', '時間');				//B3位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '3', '生鐵' . PHP_EOL . '(鋼水)');		//B3位置 PHP_EOL 換行 
							$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col++] . '3')->getAlignment()->setWrapText(true); //設定換行
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '3', '廢鋼');				//B3位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '3', '回爐');				//B3位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '3', '增碳劑');			//B3位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '3', '矽鐵');				//B3位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '3', '錳鐵');				//B3位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '3', '硫化鐵');			//B3位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '3', '');					//B3位置
						}
					} else {
						if ($resultda[$ida]->da002 != $resultdb[$key]->db002) { //不相等就換下一列
							$ida++;
							$ro = 4;	//初始值
						}
					}


					if ($resultda[$ida]->da002 == $resultdb[$key]->db002) {
						if ($ro == 4) {
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, substr_replace($val->db003, ":", 2, 0));				//B4位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->db004);				//B4位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->db005);				//B4位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->db006);				//B4位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->db007);				//B4位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->db008);				//B4位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->db009);				//B4位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->db010);				//B4位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro++, '');						//B4位置
						} else {
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col2++] . $ro, substr_replace($val->db003, ":", 2, 0));				//B5位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col2++] . $ro, $val->db004);				//B5位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col2++] . $ro, $val->db005);				//B5位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col2++] . $ro, $val->db006);				//B5位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col2++] . $ro, $val->db007);				//B5位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col2++] . $ro, $val->db008);				//B5位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col2++] . $ro, $val->db009);				//B5位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col2++] . $ro, $val->db010);				//B5位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col2++] . $ro++, '');						//B5位置
						}
					}
				}
			}

			$sql98 = " SELECT *  FROM dbo.prsdc
						WHERE dc001 ='$TD008s' ORDER BY dc002, dc008 ";
			$querydc = $this->db->query($sql98);
			if ($querydc->num_rows() > 0) {
				$resultdc = $querydc->result();
				$ida = 0;
				$col = 1;
				$col1 = 2;
				$col2 = 3;
				$col3 = 3;
				$ro = 9;
				foreach ($resultdc as $key => $val) {
					if ($key == 0) {
						$col++;
						for ($i = 0; $i < $countda; $i++) {
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '7', '光譜');				//B7位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '8', '標準');				//B8位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '7', 'C');					//B7位置 
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '8', '3.6~3.85');			//B8位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '7', 'Si');					//B7位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '8', '2.3~2.5');			//B8位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '7', 'Mn');					//B7位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '8', '0.6↓');				//B8位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '7', 'P');					//B7位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '8', '0.15↓');			//B8位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '7', 'S');					//B7位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '8', '0.05~0.12');		//B8位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '7', '');					//B7位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '8', '');					//B8位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '7', '');					//B7位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '8', '');					//B8位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . '7', '');					//B7位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . '8', '');					//B8位置
						}
					} else {
						if ($resultda[$ida]->da002 != $resultdc[$key]->dc002) { //不相等就換下一列
							$ida++;
							$ro = 9;	//初始值
						}
					}


					if ($resultda[$ida]->da002 == $resultdc[$key]->dc002) {
						if ($ro == 9) {
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1] . $ro, '實際1');						//B9位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1] . ($ro + 1), '實際2');				//B9位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . ($ro + 2), '實際3');				//B9位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->dc003);				//B9位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->dc004);				//B9位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->dc005);				//B9位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->dc006);				//B9位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, $val->dc007);				//B9位置							
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, '');						//B9位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro, '');						//B9位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1++] . $ro++, '');						//B9位置
						} else if ($ro == 10) {
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col2++ + $ida)] . $ro, $val->dc003);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col2++ + $ida)] . $ro, $val->dc004);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col2++ + $ida)] . $ro, $val->dc005);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col2++ + $ida)] . $ro, $val->dc006);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col2++ + $ida)] . $ro, $val->dc007);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col2++ + $ida)] . $ro, '');						//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col2++ + $ida)] . $ro, '');						//B10位置							
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col2++ + $ida)] . $ro++, '');						//B10位置
						} else {
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col3++ + $ida)] . $ro, $val->dc003);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col3++ + $ida)] . $ro, $val->dc004);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col3++ + $ida)] . $ro, $val->dc005);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col3++ + $ida)] . $ro, $val->dc006);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col3++ + $ida)] . $ro, $val->dc007);				//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col3++ + $ida)] . $ro, '');						//B10位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col3++ + $ida)] . $ro, '');						//B10位置							
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col3++ + $ida)] . $ro++, '');						//B10位置
						}
					}
				}
			}

			$sql98 = "  SELECT *  FROM dbo.prsdd
						WHERE dd001 ='$TD008s' ORDER BY dd002, dd008 ";
			$querydd = $this->db->query($sql98);
			if ($querydd->num_rows() > 0) {
				$resultdd = $querydd->result();
				$ida = 0;
				$col = 2;
				$count = 0;
				$ro = 12;
				foreach ($resultdd as $key => $val) {
					if ($key == 0) {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, '出鐵水' . PHP_EOL . '時間');	//B12位置
						$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro++)->getAlignment()->setWrapText(true); //設定換行
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, '出鐵量' . PHP_EOL . '(kg)');	//B13位置
						$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro++)->getAlignment()->setWrapText(true); //設定換行
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, '孕育劑');						//B14位置
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, '錳鐵');							//B15位置
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, '銅');							//B16位置
					} else {
						if ($resultda[$ida]->da002 != $resultdd[$key]->dd002) { //不相等就換下一列
							$ida++;
							for ($i = $count; $i < 8; $i++) {
								$ro = 12;
								$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, '');	//B12位置
								$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, '');	//B13位置
								$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, '');						//B14位置
								$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, '');							//B15位置
								$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, '');							//B16位置
							}
							$ro = 12;
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, '出鐵水' . PHP_EOL . '時間');	//B12位置
							$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro++)->getAlignment()->setWrapText(true); //設定換行
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, '出鐵量' . PHP_EOL . '(kg)');	//B13位置
							$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro++)->getAlignment()->setWrapText(true); //設定換行
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, '孕育劑');						//B14位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, '錳鐵');							//B15位置
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, '銅');							//B16位置
							$count = 0;
						}
					}

					if ($resultda[$ida]->da002 == $resultdd[$key]->dd002) {
						$ro = 12;
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, substr_replace($val->dd003, ":", 2, 0));	//B12位置
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, $val->dd004);	//B13位置
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, $val->dd005);						//B14位置
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro++, $val->dd006);							//B15位置
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, $val->dd007);							//B16位置
						$count++;
					}
				}
			}

			$sql98 = "  SELECT sum(convert(float,db004)) as db004 , sum(convert(float,db005)) as db005, 
								(SELECT sum(convert(float,dd004))  FROM dbo.prsdd WHERE dd001 ='$TD008s')  as db006,
								sum(convert(float,db007)) as db007, sum(convert(float,db008)) as db008, sum(convert(float,db009)) as db009,
								sum(convert(float,db010)) as db010
						FROM dbo.prsdb
						WHERE db001 ='$TD008s'  ";
			$querysum = $this->db->query($sql98);
			$resultsum = $querysum->result();

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[1] . '22', '生鐵');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[1] . '23', '廢鋼');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[1] . '24', '鐵水');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[1] . '25', '增碳劑');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[1] . '26', '硅鐵');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[1] . '27', '錳鐵');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[1] . '28', '硫化鐵');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[2] . '22', $resultsum[0]->db004);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[2] . '23', $resultsum[0]->db005);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[2] . '24', $resultsum[0]->db006);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[2] . '25', $resultsum[0]->db007);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[2] . '26', $resultsum[0]->db008);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[2] . '27', $resultsum[0]->db009);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[2] . '28', $resultsum[0]->db010);
		}
		//溶解生產記錄表---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($TD008s);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//   $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	//軸承孔檢查表
	function excelnewf_pcl($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//軸承孔檢查表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$title = array(
			'測量日期', '機台代號', '機台名稱', '品號', '品名', '規格', '三點量測軸承孔', '三點量測軸承孔', '三點量測軸承孔', '三點量測軸承孔', '換線首樣', '換線首樣', '換線首樣', '換線首樣', '換線首樣',
			'換線首樣', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀',	'換刀',
			'換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '備註'
		);  //excel 表頭		

		//表頭循環=============================================================================================================
		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$title = array(
			'測量日期', '機台代號', '機台名稱', '品號', '品名', '規格', '早班', '早班', '晚班', '晚班', '1', '1', '2', '2', '3', '3',
			'1', '1', '1', '2', '2', '2', '3', '3', '3', '4', '4', '4', '5', '5', '5', '6', '6', '6', '7', '7', '7', '8', '8', '8',
			'9', '9', '9', '10', '10', '10', '11', '11', '11', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$title = array(
			'測量日期', '機台代號', '機台名稱', '品號', '品名', '規格', '1', '2', '1', '2', '輪寬', '軸承孔', '輪寬', '軸承孔', '輪寬',	'軸承孔',
			'刀具名稱', '邊寬', '軸承孔', '刀具名稱', '邊寬', '軸承孔', '刀具名稱', '邊寬', '軸承孔', '刀具名稱', '邊寬', '軸承孔', '刀具名稱', '邊寬', '軸承孔',
			'刀具名稱', '邊寬', '軸承孔', '刀具名稱', '邊寬', '軸承孔', '刀具名稱', '邊寬', '軸承孔', '刀具名稱', '邊寬', '軸承孔', '刀具名稱', '邊寬', '軸承孔',
			'刀具名稱', '邊寬', '軸承孔', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '3';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:A999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:A999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中

		$k = 1;
		for ($i = $k; $i < 7; $i++) { // 合併儲存格  測量日期、機台名稱、品號、品名、規格
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '3');
			$k = $i + 1;
		}

		$objPHPExcel->getActiveSheet()->mergeCells('G1:J1');	// 合併儲存格  三點量測軸承孔	
		$objPHPExcel->getActiveSheet()->mergeCells('K1:P1');	// 合併儲存格  換線首樣	
		for ($i = $k; $i < 17; $i++) { // 合併儲存格  早班、晚班、1、2、3 
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i++] . '2:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}

		$objPHPExcel->getActiveSheet()->mergeCells('Q1:AW1');	// 合併儲存格  換刀	
		$objPHPExcel->getActiveSheet()->mergeCells('AX1:AX3');	// 合併儲存格  備註
		for ($i = $k; $i < 50; $i = $i + 2) { // 合併儲存格   邊寬、軸承孔 		
			$k = $i + 2;
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i++] . '2:' . $this->cellArray[$k] . '2');
		}

		// 註解-----------------------------------------------------------------------------------------------------------------
		$objPHPExcel->getActiveSheet()->getComment('G3')->setAuthor('Kiki Chiu');
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('G3')->getText()->createTextRun('Kiki Chiu:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('G3')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('G3')->getText()->createTextRun("班別分上半段與下半段，每班12小時，以中間6小時算，2點前是上半段，2點後是下半段，1代表上半段，2代表下半段");
		$objPHPExcel->getActiveSheet()->getComment('G3')->setHeight(200);
		// 註解----------------------end-------------------------------------------------------------------------------------------
		//表頭循環====================end=========================================================================================

		//設置欄寛-------------------------------------------------------
		$width_ary = array(
			'10', '10', '18', '16', '33', '25', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14',
			'14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '20'
		);  //excel 表頭	
		foreach ($width_ary as $k => $v) {
			$tkey = $k + 1;
			if (@$width_ary[$k] && $width_ary[$k] > 0) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
				//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
			}
		}
		//設置欄寛----------------end---------------------------------------

		$sql98 = " SELECT a.*, ( SELECT count(*) FROM pclbh WHERE bh001=a.bh001  ) as count, MX003,MB002,MB003
					FROM dbo.pclbh as a
						LEFT JOIN CMSMX ON bh003 = MX001
						LEFT JOIN INVMB  ON bh002 = MB001
					WHERE bh001>='$TD008s' and bh001<='$TD008d' ORDER BY bh001 desc,bh003, bh002 ";
		$querybh = $this->db->query($sql98);

		if ($querybh->num_rows() > 0) {
			$resultbh = $querybh->result();
			$ro = 4;
			$mr = 4;
			$mc = 0;
			foreach ($resultbh as $key => $val) {
				$col = 1;
				// echo "<pre>";
				if ($key == 0) {
					$mc = $val->count;
					// var_dump($this->cellArray[$col] . $mr . ':' . $this->cellArray[$col] . ($mr + $val->count - 1));
					$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col] . $mr . ':' . $this->cellArray[$col] . ($mr + $val->count - 1));
					$mr = $mr + $val->count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->bh001);
				} else if ($key == $mc) {
					$mc += $val->count;
					// var_dump($this->cellArray[$col] . $mr . ':' . $this->cellArray[$col] . ($mr + $val->count - 1));
					$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col] . $mr . ':' . $this->cellArray[$col] . ($mr + $val->count - 1));
					$mr = $mr + $val->count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->bh001);
				} else {
					$col = 2;
				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->bh003);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->MX003), 'utf-8', 'big-5'));
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . $ro, $val->bh002, PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->MB002), 'utf-8', 'big-5'));
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, mb_convert_encoding(trim($val->MB003), 'utf-8', 'big-5'));
			}


			$sql98 = " SELECT *  FROM dbo.pclbi
							WHERE bi001>='$TD008s' and bi001<='$TD008d' order by bi001 desc,bi003, bi002 ";
			$querybi = $this->db->query($sql98);

			if ($querybi->num_rows() > 0) {
				$resultbi = $querybi->result();
				foreach ($resultbh as $keyh => $valh) {
					foreach ($resultbi as $keyi => $vali) {
						if ((trim($resultbh[$keyh]->bh001) . trim($resultbh[$keyh]->bh002) . trim($resultbh[$keyh]->bh003)) == (trim($resultbi[$keyi]->bi001) . trim($resultbi[$keyi]->bi002) . trim($resultbi[$keyi]->bi003))) { //相等就執行
							$ro = 4 + $keyh;

							$vstring = '';
							if ($vali->bi007) {
								$vstring = 'A面：' . mb_convert_encoding(trim($vali->bi007), 'utf-8', 'big-5') . PHP_EOL;
							}
							if ($vali->bi008) {
								$vstring .= 'B面：' . mb_convert_encoding(trim($vali->bi008), 'utf-8', 'big-5');
							}

							if (trim($resultbi[$keyi]->bi005) == 1) { //早班
								if (trim($resultbi[$keyi]->bi006) == 1) { //上半
									$col = 7;
								} else { //下半
									$col = 8;
								}
							} else { //晚班
								if (trim($resultbi[$keyi]->bi006) == 1) { //上半
									$col = 9;
								} else { //下半
									$col = 10;
								}
							}

							$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro)->getAlignment()->setWrapText(true); //設定換行

							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, $vstring);				//B4位置

						}
					}
				}
			}


			$sql98 = " SELECT *  FROM dbo.pclbj
							WHERE bj001>='$TD008s' and bj001<='$TD008d' order by bj001 desc,bj003, bj002 ";
			$querybj = $this->db->query($sql98);

			if ($querybj->num_rows() > 0) {
				$resultbj = $querybj->result();
				foreach ($resultbh as $keyh => $valh) {
					$col1 = 11;
					$col2 = 12;
					foreach ($resultbj as $keyj => $valj) {
						if ((trim($resultbh[$keyh]->bh001) . trim($resultbh[$keyh]->bh002) . trim($resultbh[$keyh]->bh003)) == (trim($resultbj[$keyj]->bj001) . trim($resultbj[$keyj]->bj002) . trim($resultbj[$keyj]->bj003))) { //相等就執行
							$ro = 4 + $keyh;

							$vstring = '';
							if ($valj->bj006) {
								$vstring = 'A面：' . mb_convert_encoding(trim($valj->bj006), 'utf-8', 'big-5') . PHP_EOL;
							}
							if ($valj->bj007) {
								$vstring .= 'B面：' . mb_convert_encoding(trim($valj->bj007), 'utf-8', 'big-5');
							}

							if (trim($resultbj[$keyj]->bj005) == 1) { //輪寬								
								$col = $col1;
							} else { //軸承孔
								$col = $col2;
							}

							$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro)->getAlignment()->setWrapText(true); //設定換行

							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, $vstring);				//B4位置

							if (trim($resultbj[$keyj]->bj005) == 1) { //輪寬								
								$col1 = $col1 + 2;
							} else { //軸承孔
								$col2 = $col2 + 2;
							}
						}
					}
				}
			}


			$sql98 = " SELECT *  FROM dbo.pclbk
							WHERE bk001>='$TD008s' and bk001<='$TD008d' order by bk001 desc,bk003, bk002 ";
			$querybk = $this->db->query($sql98);

			if ($querybk->num_rows() > 0) {
				$resultbk = $querybk->result();
				foreach ($resultbh as $keyh => $valh) {
					$col1 = 17;
					$col2 = 18;
					$col3 = 19;
					foreach ($resultbk as $keyk => $valk) {
						if ((trim($resultbh[$keyh]->bh001) . trim($resultbh[$keyh]->bh002) . trim($resultbh[$keyh]->bh003)) == (trim($resultbk[$keyk]->bk001) . trim($resultbk[$keyk]->bk002) . trim($resultbk[$keyk]->bk003))) { //相等就執行
							$ro = 4 + $keyh;

							$vstring = '';
							if ($valk->bk005) {
								$vname = mb_convert_encoding(trim($valk->bk005), 'utf-8', 'big-5');
							}
							if ($valk->bk007) {
								$vstring .= 'A面：' . mb_convert_encoding(trim($valk->bk007), 'utf-8', 'big-5') . PHP_EOL;
							}
							if ($valk->bk008) {
								$vstring .= 'B面：' . mb_convert_encoding(trim($valk->bk008), 'utf-8', 'big-5');
							}

							if (trim($resultbk[$keyk]->bk006) == 1) { //邊寬								
								$col = $col2;
							} else { //軸承孔
								$col = $col3;
							}

							$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro)->getAlignment()->setWrapText(true); //設定換行
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col1] . $ro, $vname);				//B4位置

							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, $vstring);				//B4位置

							$col1 = $col1 + 3;
							// if (trim($resultbk[$keyk]->bk006) == 1) { //邊寬								
							$col2 = $col2 + 3;
							// } else { //軸承孔
							$col3 = $col3 + 3;
							// }
						}
					}
				}
			}
		}
		//軸承孔檢查表---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($filename);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s . '~' . $TD008d;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	//端面粗糙度檢查
	function excelnewf_pclmn($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//端面粗糙度檢查---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$title = array(
			'測量日期', '機台代號', '機台名稱', '品號', '品名', '規格', '換班', '換班', '換班', '換班', '換線首樣', '換線首樣', '換線首樣', '換線首樣', '換線首樣',	'換線首樣',
			'換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀', '換刀',	'換刀', '備註'
		);  //excel 表頭		

		//表頭循環=============================================================================================================
		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$title = array(
			'測量日期', '機台代號', '機台名稱', '品號', '品名', '規格', '早班', '早班', '晚班', '晚班', '1', '1', '2', '2', '3', '3',
			'1', '1', '2', '2', '3', '3', '4', '4', '5', '5', '6', '6', '7', '7', '8', '8', '9', '9', '10', '10', '11', '11', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$title = array(
			'測量日期', '機台代號', '機台名稱', '品號', '品名', '規格', '外端面', '中端面', '外端面', '中端面', '外端面', '中端面', '外端面', '中端面', '外端面', '中端面',
			'外端面', '中端面', '外端面', '中端面', '外端面', '中端面', '外端面', '中端面', '外端面', '中端面', '外端面', '中端面', '外端面', '中端面',	'外端面', '中端面',
			'外端面', '中端面', '外端面', '中端面', '外端面', '中端面', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '3';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:A999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:A999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中

		$k = 1;
		for ($i = $k; $i < 7; $i++) { // 合併儲存格  測量日期、機台名稱、品號、品名、規格
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '3');
			$k = $i + 1;
		}

		$objPHPExcel->getActiveSheet()->mergeCells('G1:J1');	// 合併儲存格  三點量測軸承孔	
		$objPHPExcel->getActiveSheet()->mergeCells('K1:P1');	// 合併儲存格  換線首樣	
		for ($i = $k; $i < 38; $i++) { // 合併儲存格  早班、晚班、1、2、3 
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i++] . '2:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}

		$objPHPExcel->getActiveSheet()->mergeCells('Q1:AL1');	// 合併儲存格  換刀	
		$objPHPExcel->getActiveSheet()->mergeCells('AM1:AM3');	// 合併儲存格  備註
		// for ($i = $k; $i < 38; $i = $i++) { // 合併儲存格   邊寬、軸承孔 			
		// 	$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i++] . '2:' . $this->cellArray[$k] . '2');
		// 	$k = $i + 1;
		// }

		// 註解-----------------------------------------------------------------------------------------------------------------
		$objPHPExcel->getActiveSheet()->getComment('F1')->setAuthor('Beyond');
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('F1')->getText()->createTextRun('Beyond:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('F1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('F1')->getText()->createTextRun("所有的鑄件粗糙度要在3.5以上");
		$objPHPExcel->getActiveSheet()->getComment('F1')->setHeight(200);
		// 註解----------------------end-------------------------------------------------------------------------------------------
		//表頭循環====================end=========================================================================================

		//設置欄寛-------------------------------------------------------
		$width_ary = array(
			'10', '10', '18', '16', '33', '25', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '14',
			'14', '14', '14', '14', '14', '14', '14', '14', '14', '14', '20'
		);  //excel 表頭	
		foreach ($width_ary as $k => $v) {
			$tkey = $k + 1;
			if (@$width_ary[$k] && $width_ary[$k] > 0) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
				//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
			}
		}
		//設置欄寛----------------end---------------------------------------

		$sql98 = " SELECT a.*, ( SELECT count(*) FROM pclbh WHERE bh001=a.bh001  ) as count, MX003,MB002,MB003
					FROM dbo.pclbh as a
						LEFT JOIN CMSMX ON bh003 = MX001
						LEFT JOIN INVMB  ON bh002 = MB001
					WHERE bh001>='$TD008s' and bh001<='$TD008d' ORDER BY bh001 desc,bh003, bh002 ";
		$querybh = $this->db->query($sql98);

		if ($querybh->num_rows() > 0) {
			$resultbh = $querybh->result();
			$ro = 4;
			$mr = 4;
			$mc = 0;
			foreach ($resultbh as $key => $val) {
				$col = 1;
				// echo "<pre>";
				if ($key == 0) {
					$mc = $val->count;
					// var_dump($this->cellArray[$col] . $mr . ':' . $this->cellArray[$col] . ($mr + $val->count - 1));
					$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col] . $mr . ':' . $this->cellArray[$col] . ($mr + $val->count - 1));
					$mr = $mr + $val->count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->bh001);
				} else if ($key == $mc) {
					$mc += $val->count;
					// var_dump($this->cellArray[$col] . $mr . ':' . $this->cellArray[$col] . ($mr + $val->count - 1));
					$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$col] . $mr . ':' . $this->cellArray[$col] . ($mr + $val->count - 1));
					$mr = $mr + $val->count;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->bh001);
				} else {
					$col = 2;
				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->bh003);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->MX003), 'utf-8', 'big-5'));
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . $ro, $val->bh002, PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->MB002), 'utf-8', 'big-5'));
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, mb_convert_encoding(trim($val->MB003), 'utf-8', 'big-5'));
			}


			$sql98 = " SELECT *  FROM dbo.pclbl
							WHERE bl001>='$TD008s' and bl001<='$TD008d' order by bl001 desc,bl003, bl002 ";
			$querybl = $this->db->query($sql98);

			if ($querybl->num_rows() > 0) {
				$resultbl = $querybl->result();
				foreach ($resultbh as $keyh => $valh) {
					foreach ($resultbl as $keyi => $vali) {
						if ((trim($resultbh[$keyh]->bh001) . trim($resultbh[$keyh]->bh002) . trim($resultbh[$keyh]->bh003)) == (trim($resultbl[$keyi]->bl001) . trim($resultbl[$keyi]->bl002) . trim($resultbl[$keyi]->bl003))) { //相等就執行
							$ro = 4 + $keyh;

							$vstring = '';
							if ($vali->bl007) {
								$vstring = 'A面：' . mb_convert_encoding(trim($vali->bl007), 'utf-8', 'big-5') . PHP_EOL;
							}
							if ($vali->bl008) {
								$vstring .= 'B面：' . mb_convert_encoding(trim($vali->bl008), 'utf-8', 'big-5');
							}

							if (trim($resultbl[$keyi]->bl005) == 1) { //早班
								if (trim($resultbl[$keyi]->bl006) == 1) { //外端面
									$col = 7;
								} else { //中端面
									$col = 8;
								}
							} else { //晚班
								if (trim($resultbl[$keyi]->bl006) == 1) { //外端面
									$col = 9;
								} else { //中端面
									$col = 10;
								}
							}

							$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro)->getAlignment()->setWrapText(true); //設定換行

							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, $vstring);				//B4位置

						}
					}
				}
			}


			$sql98 = " SELECT *  FROM dbo.pclbm
							WHERE bm001>='$TD008s' and bm001<='$TD008d' order by bm001 desc,bm003, bm002 ";
			$querybm = $this->db->query($sql98);

			if ($querybm->num_rows() > 0) {
				$resultbm = $querybm->result();
				foreach ($resultbh as $keyh => $valh) {
					$col1 = 11;
					$col2 = 12;
					foreach ($resultbm as $keyj => $valj) {
						if ((trim($resultbh[$keyh]->bh001) . trim($resultbh[$keyh]->bh002) . trim($resultbh[$keyh]->bh003)) == (trim($resultbm[$keyj]->bm001) . trim($resultbm[$keyj]->bm002) . trim($resultbm[$keyj]->bm003))) { //相等就執行
							$ro = 4 + $keyh;

							$vstring = '';
							if ($valj->bm006) {
								$vstring = 'A面：' . mb_convert_encoding(trim($valj->bm006), 'utf-8', 'big-5') . PHP_EOL;
							}
							if ($valj->bm007) {
								$vstring .= 'B面：' . mb_convert_encoding(trim($valj->bm007), 'utf-8', 'big-5');
							}

							if (trim($resultbm[$keyj]->bm005) == 1) { //外端面								
								$col = $col1;
							} else { //中端面
								$col = $col2;
							}

							$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro)->getAlignment()->setWrapText(true); //設定換行

							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, $vstring);				//B4位置

							if (trim($resultbm[$keyj]->bm005) == 1) { //外端面								
								$col1 = $col1 + 2;
							} else { //中端面
								$col2 = $col2 + 2;
							}
						}
					}
				}
			}


			$sql98 = " SELECT *  FROM dbo.pclbn
							WHERE bn001>='$TD008s' and bn001<='$TD008d' order by bn001 desc,bn003, bn002 ";
			$querybn = $this->db->query($sql98);

			if ($querybn->num_rows() > 0) {
				$resultbn = $querybn->result();
				foreach ($resultbh as $keyh => $valh) {
					$col1 = 17;
					$col2 = 18;
					foreach ($resultbn as $keyk => $valk) {
						if ((trim($resultbh[$keyh]->bh001) . trim($resultbh[$keyh]->bh002) . trim($resultbh[$keyh]->bh003)) == (trim($resultbn[$keyk]->bn001) . trim($resultbn[$keyk]->bn002) . trim($resultbn[$keyk]->bn003))) { //相等就執行
							$ro = 4 + $keyh;

							$vstring = '';
							// if ($valk->bn005) {
							// 	$vstring = mb_convert_encoding($valk->bn005, 'utf-8', 'big-5') . PHP_EOL;
							// }
							if ($valk->bn006) {
								$vstring .= 'A面：' . mb_convert_encoding(trim($valk->bn006), 'utf-8', 'big-5') . PHP_EOL;
							}
							if ($valk->bn007) {
								$vstring .= 'B面：' . mb_convert_encoding(trim($valk->bn007), 'utf-8', 'big-5');
							}

							if (trim($resultbn[$keyk]->bn005) == 1) { //外端面								
								$col = $col1;
							} else { //中端面
								$col = $col2;
							}

							$objPHPExcel->getActiveSheet()->getStyle($this->cellArray[$col] . $ro)->getAlignment()->setWrapText(true); //設定換行

							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col] . $ro, $vstring);				//B4位置

							if (trim($resultbn[$keyk]->bn005) == 1) { //外端面								
								$col1 = $col1 + 2;
							} else { //中端面
								$col2 = $col2 + 2;
							}
						}
					}
				}
			}
		}
		//端面粗糙度檢查---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($filename);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s . '~' . $TD008d;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	//健溢CNC日報表
	function excelnewf_cnc04($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//健溢CNC日報表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$title = array(
			'生產日期', '機台代號', '機台名稱', '操作員', '班別', '品號', '品名', '規格', '生產週期(秒/PCS)', '生產起~迄時間', '生產時數(H)', '標準產量(PCS/天)',
			'生產數量(PCS/天)', '生產效率(%)', '合格數量(PCS)', '不良狀況', '不良狀況', '不良狀況', '不良率(%)', '不良原因', '不良原因', '不良原因', '不良原因',
			'不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '異常分析解決方案', '備註'
		);  //excel 表頭		

		//表頭循環=============================================================================================================
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
		}

		$title = array(
			'生產日期', '機台代號', '機台名稱', '操作員', '班別', '品號', '品名', '規格', '生產週期' . PHP_EOL . '(秒/PCS)', '生產起~' . PHP_EOL . '迄時間', '生產時數' . PHP_EOL . '(H)', '標準產量' . PHP_EOL . '(PCS/天)',
			'生產數量' . PHP_EOL . '(PCS/天)', '生產效率' . PHP_EOL . '(%)', '合格數量' . PHP_EOL . '(PCS)', '不良總數', '可返修量', '不可返修', '不良率' . PHP_EOL . '(%)', '孔小', '孔大', '氣孔', '偏模',
			'白口', '冷隔', '掉砂', '車壞', '燒砂', '缺邊', '綻模', '打壞', '澆水不足', '其他', '異常分析解決方案', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}
		$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setWrapText(true); //設定換行 '生產週期' . PHP_EOL . '(秒/PCS)'
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setWrapText(true); //設定換行 '生產起~' . PHP_EOL . '迄時間'
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setWrapText(true); //設定換行 '生產時數' . PHP_EOL . '(H)'
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setWrapText(true); //設定換行 '標準產量' . PHP_EOL . '(PCS/天)'
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setWrapText(true); //設定換行 '生產數量' . PHP_EOL . '(PCS/天)'
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setWrapText(true); //設定換行 '生產效率' . PHP_EOL . '(%)'
		$objPHPExcel->getActiveSheet()->getStyle('O1')->getAlignment()->setWrapText(true); //設定換行 '合格數量' . PHP_EOL . '(PCS)'
		$objPHPExcel->getActiveSheet()->getStyle('S1')->getAlignment()->setWrapText(true); //設定換行 '不良率' . PHP_EOL . '(%)'
		// $objPHPExcel->getActiveSheet()->getStyle('AH1')->getAlignment()->setWrapText(true); //設定換行 '異常分析' . PHP_EOL . '解決方案'


		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中		
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:A999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:A999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:E999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:E999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('J1:J999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('J1:J999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('N1:N999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('N1:N999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('S1:S999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('S1:S999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中

		$k = 1;
		for ($i = $k; $i < 16; $i++) { // 合併儲存格  '生產日期', '機台代號', '機台名稱', '操作員', '班別', '品號', '品名', '規格', '生產週期(秒/PCS)', '生產起~迄時間', '生產時數(H)', '標準產量(PCS/天)','生產數量(PCS/天)', '生產效率(%)', '合格數量(PCS)', '不良總數', '可返修量', '不可返修'
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}

		$objPHPExcel->getActiveSheet()->mergeCells('P1:R1');	// 合併儲存格  不良狀況			
		$objPHPExcel->getActiveSheet()->mergeCells('S1:S2');	// 合併儲存格  不良率(%)	
		$objPHPExcel->getActiveSheet()->mergeCells('T1:AG1');	// 合併儲存格  不良原因	



		$objPHPExcel->getActiveSheet()->mergeCells('AH1:AH2');	// 合併儲存格  異常分析解決方案	
		$objPHPExcel->getActiveSheet()->mergeCells('AI1:AI2');	// 合併儲存格  備  註


		// 註解-----------------------------------------------------------------------------------------------------------------
		$objPHPExcel->getActiveSheet()->getComment('J1')->setAuthor('wendy');
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun('wendy:2018/11/06');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("日班休息時間：12:00-13:00/17:00-17:30,計1.5H");
		$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("夜班休息時間：24:00-24:30/04:00-04:30,計1H");
		$objPHPExcel->getActiveSheet()->getComment('J1')->setHeight(200);
		//===============================================
		$objPHPExcel->getActiveSheet()->getComment('L1')->setAuthor('wang');
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('L1')->getText()->createTextRun('wang:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('L1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('L1')->getText()->createTextRun("生產時數/生產週期=標準產量");
		$objPHPExcel->getActiveSheet()->getComment('L1')->setHeight(200);
		//===============================================
		$objPHPExcel->getActiveSheet()->getComment('O1')->setAuthor('MC SYSTEM');
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('O1')->getText()->createTextRun('MC SYSTEM:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('O1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('O1')->getText()->createTextRun("從2015-04-14開始改公式：合格數量=生產數量—不良品數量");
		$objPHPExcel->getActiveSheet()->getComment('O1')->setHeight(200);
		// 註解----------------------end-------------------------------------------------------------------------------------------
		//表頭循環====================end=========================================================================================

		//設置欄寛-------------------------------------------------------
		$width_ary = array(
			'10', '10', '30', '10', '10', '16', '33', '25', '10', '20', '10', '10',
			'10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10',
			'10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '30', '20'
		);  //excel 表頭	
		foreach ($width_ary as $k => $v) {
			$tkey = $k + 1;
			if (@$width_ary[$k] && $width_ary[$k] > 0) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
				//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
			}
		}
		//設置欄寛----------------end---------------------------------------

		$sql98 = "  SELECT a.*, TD003 , MX003, da010, (rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
							CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
							SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2) as TE013
						FROM SFCTE as a
							LEFT JOIN SFCTD ON TD001=TE001 AND TD002=TE002 
							LEFT JOIN CMSMX ON MX001=TE005
							LEFT JOIN molda on TE017=da001 and TE009=da013 and TE029=da014
					WHERE TE001 LIKE 'D%02' and TD004='CR004' and TD003>='$TD008s' and TD003<='$TD008d'
					ORDER BY TE002,TE005,TE022
					";
		$querydd = $this->db->query($sql98);
		if ($querydd->num_rows() > 0) {
			$DB2 = $this->load->database('yjpal', TRUE);
			$resultdd = $querydd->result();
			$ro = 3;
			foreach ($resultdd as $key => $val) {
				$col = 1;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TD003);											//A3位置	生產日期
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE005);											//B3位置	機台代號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->MX003), 'utf-8', 'big-5'));		//C3位置	機台名稱

				$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004' ");
				if ($query82->num_rows() > 0)
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $query82->result()[0]->mv002);						//D3位置	操作員

				//班別 0800~2000 日班， 其他 夜班
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE022 >= '0800' && $val->TE022 < '2000') ? '日' : '夜'); //E3位置	班別

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE017);											//F3位置	品號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE018), 'utf-8', 'big-5'));		//G3位置	品名
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE019), 'utf-8', 'big-5'));		//H3位置	規格
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->da010);											//I3位置	生產週期(秒/PCS)
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE012disp);										//J3位置	生產起~迄時間

				//算時數
				$workhour = round((floatval(substr($val->TE013, 0, 2)) * 60 + floatval(substr($val->TE013, -2))) / 60, 1);


				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $workhour);												//K3位置	生產時數(H)

				if ($val->da010) {
					if ($workhour <= 0) {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, '工作時間必須大於0');
					} else {
						//標準產量 = 生產時數(H) * 3600 /生產週期(秒/PCS)
						$standard = round($workhour * 3600 / $val->da010, 0);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $standard);
					}
					//L3位置	標準產量(PCS/天)
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE011);											//M3位置	生產數量(PCS/天)
				} else {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, '生產週期未設定');
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, '生產週期未設定');
				}

				//生產效率(%) = 生產數量(PCS/天) / 標準產量(PCS/天)
				$productivity = sprintf("%.1f", $val->TE011 / $standard * 100) . '%';
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $productivity);											//N3位置	生產效率(%)

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE040);											//O3位置	合格數量(PCS)
				//不良總數 = 可返修量 + 不可返修
				$badtotal = $val->TE028 + $val->TE031;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $badtotal);												//P3位置	不良總數
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE028);											//Q3位置	可返修量
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE031);											//R3位置	不可返修
				//不良率(%) = 不良總數 / 生產數量(PCS/天)
				$defectiver = round($badtotal / $val->TE011 * 100, 2) . '%';
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $defectiver);											//S3位置	不良率(%)
				//不良原因
				// if ($val->TE041) {
				// 	$arr = explode(';', $val->TE041);
				// 	foreach ($arr as $k => $v) {
				// 		if ($k == 0) {
				// 			$vmm001 = intval(substr($arr[$k], -2));
				// 			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col + $vmm001 - 1] . $ro, $badtotal);							//S3位置	不良原因
				// 		}
				// 	}
				// }
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE052));											//	孔小
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE053));											//	孔大
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE054));											//	氣孔
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE055));											//	偏模
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE056));											//	白口
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE057));											//	冷隔
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE058));											//	掉砂
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE059));											//	車壞
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE060));											//	燒砂
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE061));											//	缺邊
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE062));											//	綻模
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE063));											//	打壞
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE064));											//	澆水不足
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE065));											//	其他

				$col = 34;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE015), 'utf-8', 'big-5'));		//AH3位置	異常分析' . PHP_EOL . '解決方案
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, '');													//AI3位置	備註
			}
		}

		//健溢CNC日報表---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($filename);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s . '~' . $TD008d;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	//機加工生產日報表
	function excelnewf_cnc05($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//機加工生產日報表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$title = array(
			'生產日期', '機台代號', '機台名稱', '操作員', '班別', '品號', '品名', '規格', '生產週期(秒/PCS)', '生產起~迄時間', '生產時數(H)', '標準產量(PCS/天)',
			'生產數量(PCS/天)', '生產效率(%)', '合格數量(PCS)', '不良狀況', '不良狀況', '不良狀況', '不良率(%)', '不良原因', '不良原因', '不良原因', '不良原因',
			'不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '不良原因', '異常分析解決方案', '備註'
		);  //excel 表頭		

		//表頭循環=============================================================================================================
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
		}

		$title = array(
			'日期', '機台代號', '機台名稱', '操作員', '班別', '品號', '品名', '規格', '生產週期' . PHP_EOL . '(秒/PCS)', '生產起~' . PHP_EOL . '迄時間', '生產時數' . PHP_EOL . '(H)', '標準產量' . PHP_EOL . '(PCS/天)',
			'生產數量' . PHP_EOL . '(PCS/天)', '生產效率' . PHP_EOL . '(%)', '合格數量' . PHP_EOL . '(PCS)', '不良總數', '可返修量', '不可返修', '不良率' . PHP_EOL . '(%)', '孔小', '孔大', '氣孔', '偏模',
			'白口', '冷隔', '掉砂', '車壞', '燒砂', '缺邊', '綻模', '打壞', '澆水不足', '其他', '異常分析解決方案', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}
		$objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setWrapText(true); //設定換行 '生產週期' . PHP_EOL . '(秒/PCS)'
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setWrapText(true); //設定換行 '生產起~' . PHP_EOL . '迄時間'
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setWrapText(true); //設定換行 '生產時數' . PHP_EOL . '(H)'
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setWrapText(true); //設定換行 '標準產量' . PHP_EOL . '(PCS/天)'
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setWrapText(true); //設定換行 '生產數量' . PHP_EOL . '(PCS/天)'
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setWrapText(true); //設定換行 '生產效率' . PHP_EOL . '(%)'
		$objPHPExcel->getActiveSheet()->getStyle('O1')->getAlignment()->setWrapText(true); //設定換行 '合格數量' . PHP_EOL . '(PCS)'
		$objPHPExcel->getActiveSheet()->getStyle('S1')->getAlignment()->setWrapText(true); //設定換行 '不良率' . PHP_EOL . '(%)'
		// $objPHPExcel->getActiveSheet()->getStyle('AH1')->getAlignment()->setWrapText(true); //設定換行 '異常分析' . PHP_EOL . '解決方案'


		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中		
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:A999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:A999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:E999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:E999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('J1:J999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('J1:J999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('N1:N999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('N1:N999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('S1:S999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('S1:S999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中

		$k = 1;
		for ($i = $k; $i < 16; $i++) { // 合併儲存格  '生產日期', '機台代號', '機台名稱', '操作員', '班別', '品號', '品名', '規格', '生產週期(秒/PCS)', '生產起~迄時間', '生產時數(H)', '標準產量(PCS/天)','生產數量(PCS/天)', '生產效率(%)', '合格數量(PCS)', '不良總數', '可返修量', '不可返修'
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}

		$objPHPExcel->getActiveSheet()->mergeCells('P1:R1');	// 合併儲存格  不良狀況			
		$objPHPExcel->getActiveSheet()->mergeCells('S1:S2');	// 合併儲存格  不良率(%)	
		$objPHPExcel->getActiveSheet()->mergeCells('T1:AG1');	// 合併儲存格  不良原因	



		$objPHPExcel->getActiveSheet()->mergeCells('AH1:AH2');	// 合併儲存格  異常分析解決方案	
		$objPHPExcel->getActiveSheet()->mergeCells('AI1:AI2');	// 合併儲存格  備  註


		// 註解-----------------------------------------------------------------------------------------------------------------
		// $objPHPExcel->getActiveSheet()->getComment('J1')->setAuthor('wendy');
		// $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun('wendy:2018/11/06');
		// $objCommentRichText->getFont()->setBold(true);
		// $objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
		// $objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("日班休息時間：12:00-13:00/17:00-17:30,計1.5H");
		// $objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
		// $objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
		// $objPHPExcel->getActiveSheet()->getComment('J1')->getText()->createTextRun("夜班休息時間：24:00-24:30/04:00-04:30,計1H");
		// $objPHPExcel->getActiveSheet()->getComment('J1')->setHeight(200);
		// //===============================================
		// $objPHPExcel->getActiveSheet()->getComment('L1')->setAuthor('wang');
		// $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('L1')->getText()->createTextRun('wang:');
		// $objCommentRichText->getFont()->setBold(true);
		// $objPHPExcel->getActiveSheet()->getComment('L1')->getText()->createTextRun("\r\n");
		// $objPHPExcel->getActiveSheet()->getComment('L1')->getText()->createTextRun("生產時數/生產週期=標準產量");
		// $objPHPExcel->getActiveSheet()->getComment('L1')->setHeight(200);
		// //===============================================
		// $objPHPExcel->getActiveSheet()->getComment('O1')->setAuthor('MC SYSTEM');
		// $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('O1')->getText()->createTextRun('MC SYSTEM:');
		// $objCommentRichText->getFont()->setBold(true);
		// $objPHPExcel->getActiveSheet()->getComment('O1')->getText()->createTextRun("\r\n");
		// $objPHPExcel->getActiveSheet()->getComment('O1')->getText()->createTextRun("從2015-04-14開始改公式：合格數量=生產數量—不良品數量");
		// $objPHPExcel->getActiveSheet()->getComment('O1')->setHeight(200);
		// // 註解----------------------end-------------------------------------------------------------------------------------------
		//表頭循環====================end=========================================================================================

		//設置欄寛-------------------------------------------------------
		$width_ary = array(
			'10', '10', '30', '10', '10', '16', '33', '25', '10', '20', '10', '10',
			'10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10',
			'10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '30', '20'
		);  //excel 表頭	
		foreach ($width_ary as $k => $v) {
			$tkey = $k + 1;
			if (@$width_ary[$k] && $width_ary[$k] > 0) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
				//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
			}
		}
		//設置欄寛----------------end---------------------------------------

		$sql98 = "  SELECT a.*, TD003 , MX003, da010, (rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
							CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
							SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2) as TE013
						FROM SFCTE as a
							LEFT JOIN SFCTD ON TD001=TE001 AND TD002=TE002 
							LEFT JOIN CMSMX ON MX001=TE005
							LEFT JOIN molda on TE017=da001 and TE009=da013 and TE029=da014
					WHERE TE001 LIKE 'D%02' and TD004='CR005' and TD003>='$TD008s' and TD003<='$TD008d'
					ORDER BY TE002,TE005,TE022
					";
		$querydd = $this->db->query($sql98);
		if ($querydd->num_rows() > 0) {
			$DB2 = $this->load->database('yjpal', TRUE);
			$resultdd = $querydd->result();
			$ro = 3;
			foreach ($resultdd as $key => $val) {
				$col = 1;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TD003);											//A3位置	生產日期
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE005);											//B3位置	機台代號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->MX003), 'utf-8', 'big-5'));		//C3位置	機台名稱

				$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004' ");
				if ($query82->num_rows() > 0)
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $query82->result()[0]->mv002);						//D3位置	操作員

				//班別 0800~2000 日班， 其他 夜班
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, ($val->TE022 >= '0800' && $val->TE022 < '2000') ? '日' : '夜'); //E3位置	班別

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE017);											//F3位置	品號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE018), 'utf-8', 'big-5'));		//G3位置	品名
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE019), 'utf-8', 'big-5'));		//H3位置	規格
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->da010);											//I3位置	生產週期(秒/PCS)
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE012disp);										//J3位置	生產起~迄時間

				$workhour = round((floatval(substr($val->TE013, 0, 2)) * 60 + floatval(substr($val->TE013, -2))) / 60, 1);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $workhour);												//K3位置	生產時數(H)

				//標準產量 = 生產時數(H) * 3600 /生產週期(秒/PCS)
				$standard = round($workhour * 3600 / $val->da010, 0);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $standard);												//L3位置	標準產量(PCS/天)
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE011);											//M3位置	生產數量(PCS/天)

				//生產效率(%) = 生產數量(PCS/天) / 標準產量(PCS/天)
				$productivity = sprintf("%.1f", $val->TE011 / $standard * 100) . '%';
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $productivity);											//N3位置	生產效率(%)

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE040);											//O3位置	合格數量(PCS)
				//不良總數 = 可返修量 + 不可返修
				$badtotal = $val->TE028 + $val->TE031;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $badtotal);												//P3位置	不良總數
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE028);											//Q3位置	可返修量
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $val->TE031);											//R3位置	不可返修
				//不良率(%) = 不良總數 / 生產數量(PCS/天)
				$defectiver = round($badtotal / $val->TE011 * 100, 2) . '%';
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, $defectiver);											//S3位置	不良率(%)
				//不良原因
				// if ($val->TE041) {
				// 	$arr = explode(';', $val->TE041);
				// 	foreach ($arr as $k => $v) {
				// 		if ($k == 0) {
				// 			$vmm001 = intval(substr($arr[$k], -2));
				// 			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col + $vmm001 - 1] . $ro, $badtotal);							//S3位置	不良原因
				// 		}
				// 	}
				// }
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE052));											//	孔小
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE053));											//	孔大
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE054));											//	氣孔
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE055));											//	偏模
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE056));											//	白口
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE057));											//	冷隔
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE058));											//	掉砂
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE059));											//	車壞
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE060));											//	燒砂
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE061));											//	缺邊
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE062));											//	綻模
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE063));											//	打壞
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE064));											//	澆水不足
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, trim($val->TE065));											//	其他
				$col = 34;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro, mb_convert_encoding(trim($val->TE015), 'utf-8', 'big-5'));		//AH3位置	異常分析' . PHP_EOL . '解決方案
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . $ro++, '');													//AI3位置	備註
			}
		}

		//機加工生產日報表---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($filename);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s . '~' . $TD008d;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	//拋丸粗糙度測量表
	function excelnewf_pclsa($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//拋丸粗糙度測量表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$title = array(
			'生產日期', '品號', '品名', '規格', '生產起~迄時間', '生產時數' . PHP_EOL . '(H)', '生產總數' . PHP_EOL . '(PCS)', '粗度儀量測數據', '', '', '',
			'粗度儀量測數據', '', '', '', '粗度儀量測數據', '', '', '', '粗度儀量測數據', '', '', '', '粗度儀量測數據', '', '', '', '粗度儀量測數據', '', '', '',
			'粗度儀量測數據', '', '', '', '粗度儀量測數據', '', '', '', '備註'
		);  //excel 表頭		

		$objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setWrapText(true); //設定換行 '生產時數' . PHP_EOL . '(H)'
		$objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setWrapText(true); //設定換行 '生產總數' . PHP_EOL . '(PCS)'

		//表頭循環=============================================================================================================
		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$title = array(
			'生產日期', '品號', '品名', '規格', '生產起~迄時間', '生產時數' . PHP_EOL . '(H)', '生產總數' . PHP_EOL . '(PCS)', '第一爐次', '', '', '',
			'第二爐次', '', '', '', '第三爐次', '', '', '', '第四爐次', '', '', '', '第五爐次', '', '', '', '第六爐次', '', '', '', '第七爐次', '', '', '',
			'第八爐次', '', '', '', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$title = array(
			'生產日期', '品號', '品名', '規格', '生產起~迄時間', '生產時數' . PHP_EOL . '(H)', '生產總數' . PHP_EOL . '(PCS)', '機型', '數量', '拋丸時間', '粗糙度',
			'機型', '數量', '拋丸時間', '粗糙度', '機型', '數量', '拋丸時間', '粗糙度', '機型', '數量', '拋丸時間', '粗糙度', '機型', '數量', '拋丸時間', '粗糙度',
			'機型', '數量', '拋丸時間', '粗糙度', '機型', '數量', '拋丸時間', '粗糙度', '機型', '數量', '拋丸時間', '粗糙度', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '3';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}


		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中


		$k = 1;
		for ($i = $k; $i < 8; $i++) { // 合併儲存格  '生產日期', '品號', '品名', '規格', '生產起~迄時間', '生產時數(H)', '生產總數(PCS)'
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '3');
			$k = $i + 1;
		}
		$objPHPExcel->getActiveSheet()->mergeCells('AN1:AN3'); // 合併儲存格 備註

		$objPHPExcel->getActiveSheet()->mergeCells('H1:AM1');	// 合併儲存格  粗度儀量測數據	

		for ($i = $k; $i < 38; $i = $i + 3) { // 合併儲存格  爐次 
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i++] . '2:' . $this->cellArray[($i + 2)] . '2');
		}


		// 註解-----------------------------------------------------------------------------------------------------------------
		$objPHPExcel->getActiveSheet()->getComment('H3')->setAuthor('Beyond');
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('H3')->getText()->createTextRun('Beyond:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('H3')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('H3')->getText()->createTextRun("新機：威鐵\r\n");
		$objPHPExcel->getActiveSheet()->getComment('H3')->getText()->createTextRun("舊機：春江\r\n開泰");
		$objPHPExcel->getActiveSheet()->getComment('H3')->setHeight(100);

		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("以下产品不用测粗糙度\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("所有的铣轮，铣框，铣架，铝轮，VG轮，SS铁轮，XPU轮，威卡，丰田，都不用测粗糙度\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("1.PU3\"（01孔）\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("2.PU3\"（8510）（8590）\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("3.VG4*2.5*2.6*2.8*2長株\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("4.EPU5\"1340(03孔)弧形  弧度太大測試不了  17/9/18\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("5.EPU6\"(1542E)(ψ150*42-03孔）\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("6.EPU8\"2050(04孔)弧形\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("7.EPU5*2(6301孔)弧形\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("8.EPU6*2(6301孔)弧形\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("9.EPU8*2(6301孔)弧形\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("10.RS12*4（06）\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("11.RS12*3（06）\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("12.RS12*6（07孔）\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("13.永恒力轮、林德轮、奔騰B  外徑太大測試不了  17/09/15\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("14.VPU12\"（07） 17/09/06外徑太大測試不了\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("15.pu12\"\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("16.VPU10\"(06)輪寬太大測試不了 17/9/18\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("17、VPU14\"\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('D1')->getText()->createTextRun("注：NBR10*2-1/2，边较厚可以在新机上喷砂");
		$objPHPExcel->getActiveSheet()->getComment('D1')->setHeight(500);
		$objPHPExcel->getActiveSheet()->getComment('D1')->setWidth(500);
		$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setSize(8);
		// 註解----------------------end-------------------------------------------------------------------------------------------
		//表頭循環====================end=========================================================================================  
		//設置欄寛-------------------------------------------------------
		$width_ary = array(
			'10', '16', '33', '25', '15', '10', '10', '10', '10', '10', '10',
			'10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10',
			'10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '30'
		);  //excel 表頭	
		foreach ($width_ary as $k => $v) {
			$tkey = $k + 1;
			if (@$width_ary[$k] && $width_ary[$k] > 0) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
				//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
			}
		}
		//設置欄寛----------------end---------------------------------------


		$sql98 = " SELECT a.*, b.MB002, b.MB003, SUBSTRING(Right('0000' + Cast(sa004 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(sa004 as varchar),4),3,2) as sa004a,
												 SUBSTRING(Right('0000' + Cast(sa005 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(sa005 as varchar),4),3,2) as sa005a,
						( SELECT sum(convert(int,sb005)) FROM pclsb as d where d.sb001=a.sa001 and d.sb002=a.sa002 and d.sb003=a.sa003 ) as sb005sum 
					FROM pclsa as a
						left join INVMB as b on sa002=MB001
					WHERE sa001>='$TD008s' and sa001<='$TD008d' ORDER BY sa001 desc ";
		$querysa = $this->db->query($sql98);


		if ($querysa->num_rows() > 0) {
			$resultsa = $querysa->result();
			$ro = 4;
			foreach ($resultsa as $key => $val) {
				$col = 1;
				$ros = $ro + $key * 3;
				$roe = $ro + $key * 3 + 2;

				$mergerow = $this->cellArray[$col] . ($ros) . ':' . $this->cellArray[$col] . ($roe);
				$objPHPExcel->getActiveSheet()->mergeCells($mergerow); // 合併儲存格 日期
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->sa001);

				$mergerow = $this->cellArray[$col] . ($ros) . ':' . $this->cellArray[$col] . ($roe);
				$objPHPExcel->getActiveSheet()->mergeCells($mergerow); // 合併儲存格 品號	
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . ($ros), $val->sa002, PHPExcel_Cell_DataType::TYPE_STRING);

				$mergerow = $this->cellArray[$col] . ($ros) . ':' . $this->cellArray[$col] . ($roe);
				$objPHPExcel->getActiveSheet()->mergeCells($mergerow); // 合併儲存格 品名
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->MB002), 'utf-8', 'big-5'));

				$mergerow = $this->cellArray[$col] . ($ros) . ':' . $this->cellArray[$col] . ($roe);
				$objPHPExcel->getActiveSheet()->mergeCells($mergerow); // 合併儲存格 規格
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->MB003), 'utf-8', 'big-5'));

				$mergerow = $this->cellArray[$col] . ($ros) . ':' . $this->cellArray[$col] . ($roe);
				$objPHPExcel->getActiveSheet()->mergeCells($mergerow); // 合併儲存格 生產起~迄時間
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), trim($val->sa004a) . '~' . trim($val->sa005a));

				$mergerow = $this->cellArray[$col] . ($ros) . ':' . $this->cellArray[$col] . ($roe);
				$objPHPExcel->getActiveSheet()->mergeCells($mergerow); // 合併儲存格 生產時數
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), trim($val->sa006));

				$mergerow = $this->cellArray[$col] . ($ros) . ':' . $this->cellArray[$col] . ($roe);
				$objPHPExcel->getActiveSheet()->mergeCells($mergerow); // 合併儲存格 生產總數
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), trim($val->sb005sum));


				for ($i = 0; $i < 8; $i++) {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col + $i * 4)] . ($ros), '威鐵');
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col + $i * 4)] . ($ros + 1), '春江');
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[($col + $i * 4)] . ($ros + 2), '開泰');
				}

				$sql97 = " SELECT *
							FROM pclsb 
					WHERE sb001='$val->sa001' and sb002='$val->sa002' and sb003='$val->sa003' ORDER BY sb001 desc ";
				$querysb = $this->db->query($sql97);
				if ($querysb->num_rows() > 0) {
					$resultsb = $querysb->result();
					$colsb = 0;
					$rosb = 0;
					if (trim($val->sa003) == 'CRD001') { //威鐵
						$rosb = $ros;
					} else if (trim($val->sa003) == 'CRD002') { //開泰
						$rosb = $ros + 2;
					} else { //春江
						$rosb = $ros + 1;
					}
					foreach ($resultsb as $ksb => $vsb) {
						$colsb = $col + 1 + $ksb * 4;
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$colsb++] . ($rosb), $vsb->sb005);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$colsb++] . ($rosb), $vsb->sb006);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$colsb++] . ($rosb), $vsb->sb007);
					}
				}
			}
		}
		//拋丸粗糙度測量表---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($TD008s);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//   $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	//拋丸打磨不良報表
	function excelnewf_cnc06($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//拋丸粗糙度測量表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$title = array(
			'生產日期', '品號', '品名', '規格', '生產總數', '良品', '不良品', '不良率' . PHP_EOL . '(%)',
			'不良原因', '', '', '', '', '', '', '', '', '', '', '', '', ''
		);  //excel 表頭		

		//表頭循環=============================================================================================================
		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$title = array(
			'生產日期', '品號', '品名', '規格', '生產總數', '良品', '不良品', '不良率(%)',
			'孔小', '孔大', '氣孔', '偏模', '白口', '冷隔', '掉砂', '車壞', '燒砂', '缺邊', '綻模', '打壞', '澆水不足', '其他'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}

		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中

		$k = 1;
		for ($i = $k; $i < 9; $i++) { // 合併儲存格  '生產日期', '品號', '品名', '規格', '生產起~迄時間', '生產時數(H)', '生產總數(PCS)'
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[9] . '1:' . $this->cellArray[22] . '1');	//不良品

		$objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setWrapText(true); //設定換行 '生產時數' . PHP_EOL . '(H)'

		//設置欄寛-------------------------------------------------------
		$width_ary = array(
			'10', '20', '20', '30', '8', '8', '8', '8',
			'8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8'
		);  //excel 表頭	
		foreach ($width_ary as $k => $v) {
			$tkey = $k + 1;
			if (@$width_ary[$k] && $width_ary[$k] > 0) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
				//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
			}
		}
		//設置欄寛----------------end---------------------------------------



		$sql = " SELECT TD003, TE017, MB002, MB003, (select sum(TE011) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA011,
																		(select sum(convert(int,TE040)) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA040,
																		'' as sTA035, '' as dTA040,
																		(select sum(convert(int,ISNULL(TE052,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA052,
																		(select sum(convert(int,ISNULL(TE053,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA053,
																		(select sum(convert(int,ISNULL(TE054,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA054,
																		(select sum(convert(int,ISNULL(TE055,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA055,
																		(select sum(convert(int,ISNULL(TE056,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA056,
																		(select sum(convert(int,ISNULL(TE057,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA057,
																		(select sum(convert(int,ISNULL(TE058,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA058,
																		(select sum(convert(int,ISNULL(TE059,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA059,
																		(select sum(convert(int,ISNULL(TE060,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA060,
																		(select sum(convert(int,ISNULL(TE061,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA061,
																		(select sum(convert(int,ISNULL(TE062,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA062,
																		(select sum(convert(int,ISNULL(TE063,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA063,
																		(select sum(convert(int,ISNULL(TE064,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA064,
																		(select sum(convert(int,ISNULL(TE065,0))) FROM SFCTE WHERE TE001=a.TE001 and TE002=a.TE002 and TE017=a.TE017 ) as sTA065				
					FROM SFCTE as a
						LEFT JOIN SFCTD ON TE001=TD001 AND TE002=TD002 	
						LEFT JOIN INVMB ON TE017=MB001
					WHERE TE001 LIKE 'D%02' AND TD004='CR006' AND TD003>='$TD008s' AND TD003<='$TD008d'
					GROUP by TD003,TE017, MB002, MB003,TE006,TE007,TE008,TE001,TE002
					order by TD003
				";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$resultsa = $query->result();
			$sumTA011 = 0; //sum生產總數
			$sumTA035 = 0; //sum不良總數
			$ro = 3; //第幾行開始
			foreach ($resultsa as $key => $val) {
				$col = 1;
				$ros = $ro + $key;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TD003);		//生產日期
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . ($ros), trim($val->TE017), PHPExcel_Cell_DataType::TYPE_STRING);	//品號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->MB002), 'utf-8', 'big-5'));		//品名
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->MB003), 'utf-8', 'big-5'));		//規格
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->sTA011);			//生產總數
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->sTA040);			//良品

				//不良總數 = 總數 - 合格總數
				$val->sTA035 = round($val->sTA011 - $val->sTA040, 0);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->sTA035);			//不良總數

				$sumTA011 = round($sumTA011 + intval($val->sTA011), 0);
				$sumTA035 = round($sumTA035 + intval($val->sTA035), 0);

				//不良率 = 不良總數 / 總數 
				$val->dTA040 = round($val->sTA035 / $val->sTA011 * 100, 2) . '%';
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->dTA040);			//不良率

				//不良
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA052 == 0) ? '' : $val->sTA052);			//孔小
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA053 == 0) ? '' : $val->sTA053);			//孔大
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA054 == 0) ? '' : $val->sTA054);			//氣孔
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA055 == 0) ? '' : $val->sTA055);			//偏模
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA056 == 0) ? '' : $val->sTA056);			//白口
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA057 == 0) ? '' : $val->sTA057);			//冷隔
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA058 == 0) ? '' : $val->sTA058);			//掉砂
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA059 == 0) ? '' : $val->sTA059);			//車壞
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA060 == 0) ? '' : $val->sTA060);			//燒砂
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA061 == 0) ? '' : $val->sTA061);			//缺邊
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA062 == 0) ? '' : $val->sTA062);			//綻模
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA063 == 0) ? '' : $val->sTA063);			//打壞
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA064 == 0) ? '' : $val->sTA064);			//澆水不足
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), ($val->sTA065 == 0) ? '' : $val->sTA065);			//其他

			}
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[24] . '2', '總不良率');			//總不良率
			//總不良率 = sum不良總數 / sum生產總數
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[25] . '2', round($sumTA035 / $sumTA011 * 100, 2) . '%');			//總不良率
		}





		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($TD008s);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//   $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	//實心胎一次硫化日報表
	function excelnewf_rw001($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//實心胎一次硫化日報表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$title = array(
			'生產日期', '班別', '機台', '操作員', '製令單號', '計畫產量', '品號', '產品名稱', '規格', '累計產量',
			'訂單完成率%', '橡膠膠料', '溫度(℃)', '加硫時間(秒/模)', '上下料時間(秒/模)', '週期時間(秒/模)', '標           准',
			'', '', '', '生產起~迄時間',
			'生產時間' . PHP_EOL . '(H)', '標準生產數量', '實際生產數量', '產量' . PHP_EOL . '達標率', '合格數量', '不良總數', '',
			'毛邊數量(單位:KG)', '良品率', '不良品不良原因', '備註'
		);  //excel 表頭		

		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true); //設定換行 '訂單' . PHP_EOL . '完成率%'
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setWrapText(true); //設定換行 
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setWrapText(true); //設定換行 '加硫時間' . PHP_EOL . '(秒/模)'
		$objPHPExcel->getActiveSheet()->getStyle('O1')->getAlignment()->setWrapText(true); //設定換行 '上下料時間' . PHP_EOL . '(秒/模)'
		$objPHPExcel->getActiveSheet()->getStyle('P1')->getAlignment()->setWrapText(true); //設定換行 '週期時間' . PHP_EOL . '(秒/模)'
		$objPHPExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setWrapText(true); //設定換行 '理論' . PHP_EOL . '模穴數'
		$objPHPExcel->getActiveSheet()->getStyle('R2')->getAlignment()->setWrapText(true); //設定換行 '實際' . PHP_EOL . '模穴數'
		$objPHPExcel->getActiveSheet()->getStyle('S2')->getAlignment()->setWrapText(true); //設定換行 '每模毛重' . PHP_EOL . '(單位:G)'
		$objPHPExcel->getActiveSheet()->getStyle('T2')->getAlignment()->setWrapText(true); //設定換行 '每模凈重' . PHP_EOL . '(單位:G)'
		$objPHPExcel->getActiveSheet()->getStyle('V1')->getAlignment()->setWrapText(true); //設定換行 '生產時間' . PHP_EOL . '(H)'
		$objPHPExcel->getActiveSheet()->getStyle('W1')->getAlignment()->setWrapText(true); //設定換行 
		$objPHPExcel->getActiveSheet()->getStyle('X1')->getAlignment()->setWrapText(true); //設定換行 
		$objPHPExcel->getActiveSheet()->getStyle('Y1')->getAlignment()->setWrapText(true); //設定換行 '產量' . PHP_EOL . '達標率'
		$objPHPExcel->getActiveSheet()->getStyle('AC1')->getAlignment()->setWrapText(true); //設定換行

		//表頭循環=============================================================================================================
		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);

			$HVrow = $tkey;
		}

		$title = array(
			'生產日期', '班別', '機台', '操作員', '製令單號', '計畫產量', '品號', '產品名稱', '規格', '累計產量',
			'訂單' . PHP_EOL . '完成率%', '橡膠膠料', '溫度(℃)', '加硫時間' . PHP_EOL . '(秒/模)', '上下料時間' . PHP_EOL . '(秒/模)', '週期時間' . PHP_EOL . '(秒/模)', '理論' . PHP_EOL . '模穴數',
			'實際' . PHP_EOL . '模穴數', '每模毛重' . PHP_EOL . '(單位:G)', '每模凈重' . PHP_EOL . '(單位:G)', '生產起~迄時間',
			'生產時間' . PHP_EOL . '(H)', '標準' . PHP_EOL . '生產數量', '實際' . PHP_EOL . '生產數量', '產量' . PHP_EOL . '達標率', '合格數量', '次品總數', '不良總數',
			'毛邊數量' . PHP_EOL . '(單位:KG)', '良品率', '不良品不良原因', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}




		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中


		$k = 1;
		for ($i = $k; $i < 17; $i++) { // 合併儲存格  
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}
		$objPHPExcel->getActiveSheet()->mergeCells('Q1:T1'); // 合併儲存格 標           准

		$k = 21;
		for ($i = $k; $i < 27; $i++) { // 合併儲存格  
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}
		$objPHPExcel->getActiveSheet()->mergeCells('AA1:AB1'); // 合併儲存格 不良總數

		$k = 29;
		for ($i = $k; $i < 33; $i++) { // 合併儲存格  
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}


		// 註解-----------------------------------------------------------------------------------------------------------------		
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('V1')->getText()->createTextRun('作者:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('V1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('V1')->getText()->createTextRun("例:9點~10點10分\r\n");
		$objPHPExcel->getActiveSheet()->getComment('V1')->setHeight(100);

		$objPHPExcel->getActiveSheet()->getComment('X1')->getText()->createTextRun("標準產量和周期有很大關系。\r\n");
		$objPHPExcel->getActiveSheet()->getComment('X1')->getText()->createTextRun("但周期因自動和半自動的區別，會有操作員動作快慢的時差，且周期一般以整數記錄，也是會讓標準產量和生產數量有輕微的差別。");
		$objPHPExcel->getActiveSheet()->getComment('X1')->setHeight(150);
		$objPHPExcel->getActiveSheet()->getComment('X1')->setWidth(300);
		// 註解----------------------end-------------------------------------------------------------------------------------------
		//表頭循環====================end=========================================================================================  
		//設置欄寛-------------------------------------------------------
		$width_ary = array(
			'10', '10', '10', '10', '15', '10', '20', '20', '20', '10',
			'10', '10', '8', '10', '10', '10', '10',
			'10', '10', '10', '20',
			'10', '10', '10', '10', '10', '10', '10',
			'10', '10', '20', '30'
		);  //excel 表頭	
		foreach ($width_ary as $k => $v) {
			$tkey = $k + 1;
			if (@$width_ary[$k] && $width_ary[$k] > 0) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
				//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
			}
		}
		//設置欄寛----------------end---------------------------------------

		// TA011dis 以當日 合格數量 之班次累計 20230503
		$sql98 = " SELECT * ,(select sum(convert(int,TE040)) FROM SFCTE	
									left join SFCTD on TE001=TD001 and TE002=TD002
								WHERE TE006 <> ''  and  TE006=a.TE006 and TE007=a.TE007 and TE008=a.TE008 and TE017=a.TE017 							
								and TD008 <=b.TD008 
								and (CASE when TE022>='0800'and TE022<'1600' then TD008+'1'
									when TE022='0000' then TD008+'3'
									when TE002>='1600' and TE022<'2000' then TD008+'2' else TD008+'3' END)<=(CASE when a.TE022>='0800'and a.TE022<'1600' then b.TD008+'1'
									when a.TE022='0000' then b.TD008+'3'
									when a.TE002>='1600' and a.TE022<'2000' then b.TD008+'2' else b.TD008+'3' END) ) as TA011dis,
							(rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
							CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
							SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2) as TE013time,
							(CASE when TE022>='0800'and TE022<'1600' then '1'
								when TE022='0000' then '3'
								when TE002>='1600' and TE022<'2000' then '2' else '3' END) as TE022disp
					FROM dbo.SFCTE AS a
						LEFT JOIN SFCTD as b ON TE001=TD001 AND TE002=TD002
						LEFT JOIN dbo.molda as c on TE017=da001 and TE009=da013 and TE029=da014
						LEFT JOIN MOCTA as d on TA001=TE006 AND TA002=TE007
						LEFT JOIN INVMB as e ON MB001=da016
						WHERE TD001='D403' AND TD004='RW001' and TD003>='$TD008s' and TD003<='$TD008d' 
					ORDER BY TD003,(CASE when TE022>='0800'and TE022<'1600' then '1'
								when TE022='0000' then '3'
								when TE002>='1600' and TE022<'2000' then '2' else '3' END),TE005 
					";
		$querysa = $this->db->query($sql98);


		if ($querysa->num_rows() > 0) {
			$resultsa = $querysa->result();
			$ro = 3; //第幾行開始
			foreach ($resultsa as $key => $val) {
				$col = 1;
				$ros = $ro + $key;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TD003);		//日期

				//班別 0800~1600 早班、1600~2000中班、2000~ 晚班

				if ($val->TE022disp == '1') {
					$val->TE022 = '早班';
				} else if ($val->TE022disp == '2') {
					$val->TE022 = '中班';
				} else {
					$val->TE022 = '晚班';
				}

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE022);		//班別
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE005);		//機台

				$DB2 = $this->load->database('yjpal', TRUE);
				$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004' ");
				if ($query82->num_rows() > 0)
					$val->TE004 = $query82->result()[0]->mv002;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE004);		//操作員

				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . ($ros), trim($val->TE007), PHPExcel_Cell_DataType::TYPE_STRING);		//製令單號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TA015);		//計畫產量
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . ($ros), trim($val->TE017), PHPExcel_Cell_DataType::TYPE_STRING);		//品號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->TE018), 'utf-8', 'big-5'));		//產品名稱
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->TE019), 'utf-8', 'big-5'));		//規格
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TA011dis);		//累計產量

				$ocr = round($val->TA011dis / $val->TA015 * 100, 0) . '%';	//'訂單' . PHP_EOL . '完成率%'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $ocr);			//'訂單' . PHP_EOL . '完成率%'

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->MB002), 'utf-8', 'big-5'));		//橡膠膠料
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da017);		//溫度(℃)
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE050);		//'加硫時間' . PHP_EOL . '(秒/模)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE051);		//'上下料時間' . PHP_EOL . '(秒/模)'

				$ptime = round($val->TE050 + $val->TE051, 0);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $ptime);		//'週期時間' . PHP_EOL . '(秒/模)'

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da005);		//'理論' . PHP_EOL . '模穴數'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE032);		//'實際' . PHP_EOL . '模穴數'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da008);		//'每模毛重' . PHP_EOL . '(單位:G)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da009);		//'每模凈重' . PHP_EOL . '(單位:G)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE012disp);		//'生產起~迄時間'

				$workhour = round((floatval(substr($val->TE013time, 0, 2)) * 60 + floatval(substr($val->TE013time, -2))) / 60, 1);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $workhour);			//K3位置	生產時數(H)

				//標準生產數量 = 生產時數(H)*3600/ 週期時間 * 理論模穴數
				// $spq = round($workhour * 3600 / $ptime * $val->da005, 0);
				//標準生產數量 = 生產時數(H)*3600/ 週期時間 * 實際模穴數  2023/07/10 改實際
				$spq = round($workhour * 3600 / $ptime * $val->TE032, 0);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $spq);		//'標準' . PHP_EOL . '生產數量'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE011);		//'實際' . PHP_EOL . '生產數量'

				//產量達標率 = 實際 / 標準 *100
				if ($spq == 0) {
					$ycr = '0%';
				} else {
					$ycr = round($val->TE011 / $spq * 100, 0) . '%';
				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $ycr);		//產量達標率

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE040);		//'合格數量
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), '');				//'次品總數
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE035);		//'不良總數

				//'毛邊數量'=(每模毛重 - 每模凈重) / '實際' . PHP_EOL . '實際模穴數' * '實際' . PHP_EOL . '生產數量' /1000
				$nor = round(($val->da008 - $val->da009) / $val->TE032 * $val->TE011 / 100, 1);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $nor);			//毛邊數量

				//良品率 = 合格數量 /'實際' . PHP_EOL . '生產數量'
				$yr = round($val->TE040 / $val->TE011 * 100, 2);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $yr);			//良品率

				//不良原因
				if ($val->TE041) {
					$arr = explode(';', $val->TE041);
					$vTE041 = '';
					foreach ($arr as $k => $v) {
						if ($arr[$k]) {
							$vmm001 = $arr[$k];
							$query = $this->db->query(" select mm002 from cmsmm1 where mm001='$vmm001' ");
							if ($query->num_rows() > 0)
								$vTE041 .= mb_convert_encoding(trim($query->result()[0]->mm002), 'utf-8', 'big-5') . ';';
						}
					}
					$val->TE041 = $vTE041;
				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE041);			//不良原因

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->TE015), 'utf-8', 'big-5'));			//備註

			}
		}
		//實心胎一次硫化日報表---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($TD008s);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//   $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	//空心胎硫化日報表
	function excelnewf_rw002($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//空心胎硫化日報表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$title = array(
			'生產日期', '班別', '機台', '操作員', '製令單號', '計畫產量', '品號', '產品名稱', '規格', '累計產量',
			'製令完成率%', '橡膠膠料', '溫度(℃)', '加硫時間(秒/模)', '上下料時間(秒/模)', '週期時間(秒/模)', '標           准',
			'', '', '', '生產起~迄時間',
			'生產時間' . PHP_EOL . '(H)', '標準生產數量', '實際生產數量', '產量' . PHP_EOL . '達標率', '合格數量', '不良總數', '',
			'毛邊數量(單位:KG)', '良品率', '不良品不良原因', '備註'
		);  //excel 表頭		

		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true); //設定換行 '訂單' . PHP_EOL . '完成率%'
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setWrapText(true); //設定換行 
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setWrapText(true); //設定換行 '加硫時間' . PHP_EOL . '(秒/模)'
		$objPHPExcel->getActiveSheet()->getStyle('O1')->getAlignment()->setWrapText(true); //設定換行 '上下料時間' . PHP_EOL . '(秒/模)'
		$objPHPExcel->getActiveSheet()->getStyle('P1')->getAlignment()->setWrapText(true); //設定換行 '週期時間' . PHP_EOL . '(秒/模)'
		$objPHPExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setWrapText(true); //設定換行 '理論' . PHP_EOL . '模穴數'
		$objPHPExcel->getActiveSheet()->getStyle('R2')->getAlignment()->setWrapText(true); //設定換行 '實際' . PHP_EOL . '模穴數'
		$objPHPExcel->getActiveSheet()->getStyle('S2')->getAlignment()->setWrapText(true); //設定換行 '每模毛重' . PHP_EOL . '(單位:G)'
		$objPHPExcel->getActiveSheet()->getStyle('T2')->getAlignment()->setWrapText(true); //設定換行 '每模凈重' . PHP_EOL . '(單位:G)'
		$objPHPExcel->getActiveSheet()->getStyle('V1')->getAlignment()->setWrapText(true); //設定換行 '生產時間' . PHP_EOL . '(H)'
		$objPHPExcel->getActiveSheet()->getStyle('W1')->getAlignment()->setWrapText(true); //設定換行 
		$objPHPExcel->getActiveSheet()->getStyle('X1')->getAlignment()->setWrapText(true); //設定換行 
		$objPHPExcel->getActiveSheet()->getStyle('Y1')->getAlignment()->setWrapText(true); //設定換行 '產量' . PHP_EOL . '達標率'
		$objPHPExcel->getActiveSheet()->getStyle('AC1')->getAlignment()->setWrapText(true); //設定換行

		//表頭循環=============================================================================================================
		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);

			$HVrow = $tkey;
		}

		$title = array(
			'生產日期', '班別', '機台', '操作員', '製令單號', '計畫產量', '品號', '產品名稱', '規格', '累計產量',
			'訂單' . PHP_EOL . '完成率%', '橡膠膠料', '溫度(℃)', '加硫時間' . PHP_EOL . '(秒/模)', '上下料時間' . PHP_EOL . '(秒/模)', '週期時間' . PHP_EOL . '(秒/模)', '理論' . PHP_EOL . '模穴數',
			'實際' . PHP_EOL . '模穴數', '每模毛重' . PHP_EOL . '(單位:G)', '每模凈重' . PHP_EOL . '(單位:G)', '生產起~迄時間',
			'生產時間' . PHP_EOL . '(H)', '標準' . PHP_EOL . '生產數量', '實際' . PHP_EOL . '生產數量', '產量' . PHP_EOL . '達標率', '合格數量', '次品總數', '不良總數',
			'毛邊數量' . PHP_EOL . '(單位:KG)', '良品率', '不良品不良原因', '備註'
		);  //excel 表頭		

		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
			$HVrow = $tkey;
		}




		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中


		$k = 1;
		for ($i = $k; $i < 17; $i++) { // 合併儲存格  
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}
		$objPHPExcel->getActiveSheet()->mergeCells('Q1:T1'); // 合併儲存格 標           准

		$k = 21;
		for ($i = $k; $i < 27; $i++) { // 合併儲存格  
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}
		$objPHPExcel->getActiveSheet()->mergeCells('AA1:AB1'); // 合併儲存格 不良總數

		$k = 29;
		for ($i = $k; $i < 33; $i++) { // 合併儲存格  
			$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
			$k = $i + 1;
		}


		// 註解-----------------------------------------------------------------------------------------------------------------		
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('V1')->getText()->createTextRun('作者:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('V1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('V1')->getText()->createTextRun("例:9點~10點10分\r\n");
		$objPHPExcel->getActiveSheet()->getComment('V1')->setHeight(100);

		$objPHPExcel->getActiveSheet()->getComment('X1')->getText()->createTextRun("標準產量和周期有很大關系。\r\n");
		$objPHPExcel->getActiveSheet()->getComment('X1')->getText()->createTextRun("但周期因自動和半自動的區別，會有操作員動作快慢的時差，且周期一般以整數記錄，也是會讓標準產量和生產數量有輕微的差別。");
		$objPHPExcel->getActiveSheet()->getComment('X1')->setHeight(150);
		$objPHPExcel->getActiveSheet()->getComment('X1')->setWidth(300);
		// 註解----------------------end-------------------------------------------------------------------------------------------
		//表頭循環====================end=========================================================================================  
		//設置欄寛-------------------------------------------------------
		$width_ary = array(
			'10', '10', '10', '10', '15', '10', '20', '20', '20', '10',
			'10', '10', '8', '10', '10', '10', '10',
			'10', '10', '10', '20',
			'10', '10', '10', '10', '10', '10', '10',
			'10', '10', '20', '30'
		);  //excel 表頭	
		foreach ($width_ary as $k => $v) {
			$tkey = $k + 1;
			if (@$width_ary[$k] && $width_ary[$k] > 0) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
				//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
			}
		}
		//設置欄寛----------------end---------------------------------------

		// TA011dis 以當日 合格數量 之班次累計 加順序 20230503
		$sql98 = " SELECT * ,(select sum(convert(int,TE040)) FROM SFCTE	
									left join SFCTD on TE001=TD001 and TE002=TD002
								WHERE TE006 <> ''  and  TE006=a.TE006 and TE007=a.TE007 and TE008=a.TE008 and TE017=a.TE017 							
								and TD008 <=b.TD008 
								and (CASE when TE022>='0800'and TE022<'1600' then TD008+TE003+'1'
									when TE022='0000' then TD008+TE003+'3'
									when TE002>='1600' and TE022<'2000' then TD008+TE003+'2' else TD008+TE003+'3' END)<=(CASE when a.TE022>='0800'and a.TE022<'1600' then b.TD008+a.TE003+'1'
									when a.TE022='0000' then b.TD008+a.TE003+'3'
									when a.TE002>='1600' and a.TE022<'2000' then b.TD008+a.TE003+'2' else b.TD008+a.TE003+'3' END) ) as TA011dis,
							(rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
							CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
							SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2) as TE013time,
							(CASE when TE022>='0800'and TE022<'1600' then '1'
								when TE022='0000' then '3'
								when TE002>='1600' and TE022<'2000' then '2' else '3' END) as TE022disp
					FROM dbo.SFCTE AS a
						LEFT JOIN SFCTD as b ON TE001=TD001 AND TE002=TD002
						LEFT JOIN dbo.molda as c on TE017=da001 and TE009=da013 and TE029=da014
						LEFT JOIN MOCTA as d on TA001=TE006 AND TA002=TE007
						LEFT JOIN INVMB as e ON MB001=da016
						WHERE TD001='D403' AND TD004='RW002' and TD003>='$TD008s' and TD003<='$TD008d' 
					ORDER BY TD003,(CASE when TE022>='0800'and TE022<'1600' then '1'
									when TE022='0000' then '3'
									when TE002>='1600' and TE022<'2000' then '2' else '3' END),TE005 
					";
		$querysa = $this->db->query($sql98);


		if ($querysa->num_rows() > 0) {
			$resultsa = $querysa->result();
			$ro = 3; //第幾行開始
			foreach ($resultsa as $key => $val) {
				$col = 1;
				$ros = $ro + $key;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TD003);		//日期

				//班別 0800~1600 早班、1600~2000中班、2000~ 晚班

				if ($val->TE022disp == '1') {
					$val->TE022 = '早班';
				} else if ($val->TE022disp == '2') {
					$val->TE022 = '中班';
				} else {
					$val->TE022 = '晚班';
				}

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE022);		//班別
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE005);		//機台

				$DB2 = $this->load->database('yjpal', TRUE);
				$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004' ");
				if ($query82->num_rows() > 0)
					$val->TE004 = $query82->result()[0]->mv002;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE004);		//操作員

				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . ($ros), trim($val->TE007), PHPExcel_Cell_DataType::TYPE_STRING);		//製令單號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TA015);		//計畫產量
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . ($ros), trim($val->TE017), PHPExcel_Cell_DataType::TYPE_STRING);		//品號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->TE018), 'utf-8', 'big-5'));		//產品名稱
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->TE019), 'utf-8', 'big-5'));		//規格
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TA011dis);		//累計產量

				$ocr = round($val->TA011dis / $val->TA015 * 100, 0) . '%';	//'訂單' . PHP_EOL . '完成率%'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $ocr);			//'訂單' . PHP_EOL . '完成率%'

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->MB002), 'utf-8', 'big-5'));		//橡膠膠料
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da017);		//溫度(℃)
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE050);		//'加硫時間' . PHP_EOL . '(秒/模)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE051);		//'上下料時間' . PHP_EOL . '(秒/模)'

				$ptime = round($val->TE050 + $val->TE051, 0);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $ptime);		//'週期時間' . PHP_EOL . '(秒/模)'

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da005);		//'理論' . PHP_EOL . '模穴數'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE032);		//'實際' . PHP_EOL . '模穴數'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da008);		//'每模毛重' . PHP_EOL . '(單位:G)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da009);		//'每模凈重' . PHP_EOL . '(單位:G)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE012disp);		//'生產起~迄時間'

				$workhour = round((floatval(substr($val->TE013time, 0, 2)) * 60 + floatval(substr($val->TE013time, -2))) / 60, 1);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $workhour);			//K3位置	生產時數(H)

				//標準生產數量 = 生產時數(H)*3600/ 週期時間 * 實際模穴數
				$spq = round($workhour * 3600 / $ptime * $val->TE032, 0);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $spq);		//'標準' . PHP_EOL . '生產數量'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE011);		//'實際' . PHP_EOL . '生產數量'

				//產量達標率 = 實際 / 標準 *100
				if ($spq == 0) {
					$ycr = '0%';
				} else {
					$ycr = round($val->TE011 / $spq * 100, 0) . '%';
				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $ycr);		//產量達標率

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE040);		//'合格數量
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), '');				//'次品總數
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE035);		//'不良總數

				//'毛邊數量'=(每模毛重 - 每模凈重) / '實際' . PHP_EOL . '實際模穴數' * '實際' . PHP_EOL . '生產數量' /1000
				$nor = round(($val->da008 - $val->da009) / $val->TE032 * $val->TE011 / 100, 1);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $nor);			//毛邊數量

				//良品率 = 合格數量 /'實際' . PHP_EOL . '生產數量'
				$yr = round($val->TE040 / $val->TE011 * 100, 2);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $yr);			//良品率

				//不良原因
				if ($val->TE041) {
					$arr = explode(';', $val->TE041);
					$vTE041 = '';
					foreach ($arr as $k => $v) {
						if ($arr[$k]) {
							$vmm001 = $arr[$k];
							$query = $this->db->query(" select mm002 from cmsmm1 where mm001='$vmm001' ");
							if ($query->num_rows() > 0)
								$vTE041 .= mb_convert_encoding(trim($query->result()[0]->mm002), 'utf-8', 'big-5') . ';';
						}
					}
					$val->TE041 = $vTE041;
				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE041);			//不良原因

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->TE015), 'utf-8', 'big-5'));			//備註

			}
		}
		//空心胎硫化日報表---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($TD008s);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//   $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}


	//萬馬力日報表
	function excelnewf_rw003($filename = '')
	{
		$TD008s = date("Ymd", strtotime(trim($this->input->post('TD008s'))));
		$TD008d = date("Ymd", strtotime(trim($this->input->post('TD008d'))));
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Dersheng")
			->setLastModifiedBy("Dersheng")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Dersheng document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Dersheng report");

		//萬馬力日報表---------產生--------------------------------------------------------------------------------------------------------------------------------------------------
		$title = array(
			'生產' . PHP_EOL . '日期', '班別', '機台', '操作員', '製令單號', '品號', '產品名稱', '規格',
			'配方', '預定數' . PHP_EOL . '(首)', '實際完' . PHP_EOL . '成數(首)', '每首料理' . PHP_EOL . '論重量(kg)', '理論總' . PHP_EOL . '重量(kg)',
			'實際總' . PHP_EOL . '重量(kg)', '生產週期' . PHP_EOL . '(秒/PCS)', '生產起~' . PHP_EOL . '迄時間', '生產' . PHP_EOL . '時間(H)',
			'報廢' . PHP_EOL . '數量(kg)', '報廢' . PHP_EOL . '原因', '異常分析' . PHP_EOL . '解決方案', '備註'
		);  //excel 表頭		

		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true); //設定換行 '訂單' . PHP_EOL . '完成率%'
		$objPHPExcel->getActiveSheet()->getStyle('J1')->getAlignment()->setWrapText(true); //設定換行 
		$objPHPExcel->getActiveSheet()->getStyle('K1')->getAlignment()->setWrapText(true); //設定換行 
		$objPHPExcel->getActiveSheet()->getStyle('L1')->getAlignment()->setWrapText(true); //設定換行 '加硫時間' . PHP_EOL . '(秒/模)'
		$objPHPExcel->getActiveSheet()->getStyle('M1')->getAlignment()->setWrapText(true); //設定換行 '上下料時間' . PHP_EOL . '(秒/模)'
		$objPHPExcel->getActiveSheet()->getStyle('N1')->getAlignment()->setWrapText(true); //設定換行 '週期時間' . PHP_EOL . '(秒/模)'
		$objPHPExcel->getActiveSheet()->getStyle('O1')->getAlignment()->setWrapText(true); //設定換行 '理論' . PHP_EOL . '模穴數'
		$objPHPExcel->getActiveSheet()->getStyle('P1')->getAlignment()->setWrapText(true); //設定換行 '實際' . PHP_EOL . '模穴數'
		$objPHPExcel->getActiveSheet()->getStyle('Q1')->getAlignment()->setWrapText(true); //設定換行 '每模毛重' . PHP_EOL . '(單位:G)'
		$objPHPExcel->getActiveSheet()->getStyle('R1')->getAlignment()->setWrapText(true); //設定換行 '每模凈重' . PHP_EOL . '(單位:G)'
		$objPHPExcel->getActiveSheet()->getStyle('S1')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('T1')->getAlignment()->setWrapText(true);



		//表頭循環=============================================================================================================
		$HVrow = 1;
		foreach ($title as $tkey => $tvalue) {
			$tkey = $tkey + 1;
			$row  = $this->cellArray[$tkey] . '1';     //组合行數（开始是第一行）
			// Add some data  //表頭
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);

			$HVrow = $tkey;
		}

		// $title = array(
		// 	'生產日期', '班別', '機台', '操作員', '製令單號', '品號', '產品名稱', '規格', '累計產量',
		// 	'訂單' . PHP_EOL . '完成率%', '橡膠膠料', '溫度(℃)', '加硫時間' . PHP_EOL . '(秒/模)', '上下料時間' . PHP_EOL . '(秒/模)', '週期時間' . PHP_EOL . '(秒/模)', '理論' . PHP_EOL . '模穴數',
		// 	'實際' . PHP_EOL . '模穴數', '每模毛重' . PHP_EOL . '(單位:G)', '每模凈重' . PHP_EOL . '(單位:G)', '生產起~迄時間',
		// 	'生產時間' . PHP_EOL . '(H)', '標準' . PHP_EOL . '生產數量', '實際' . PHP_EOL . '生產數量', '產量' . PHP_EOL . '達標率', '合格數量', '次品總數', '不良總數',
		// 	'毛邊數量' . PHP_EOL . '(單位:KG)', '良品率', '不良品不良原因', '備註'
		// );  //excel 表頭		

		// $HVrow = 1;
		// foreach ($title as $tkey => $tvalue) {
		// 	$tkey = $tkey + 1;
		// 	$row  = $this->cellArray[$tkey] . '2';     //组合行數（开始是第一行）
		// 	// Add some data  //表頭
		// 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($row, $tvalue);
		// 	$HVrow = $tkey;
		// }




		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $this->cellArray[$HVrow] . '999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('A1:B999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //水平置中
		$objPHPExcel->getActiveSheet()->getStyle('E1:AM999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直置中


		// $k = 1;
		// for ($i = $k; $i < 17; $i++) { // 合併儲存格  
		// 	$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
		// 	$k = $i + 1;
		// }
		// $objPHPExcel->getActiveSheet()->mergeCells('Q1:T1'); // 合併儲存格 標           准

		// $k = 21;
		// for ($i = $k; $i < 27; $i++) { // 合併儲存格  
		// 	$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
		// 	$k = $i + 1;
		// }
		// $objPHPExcel->getActiveSheet()->mergeCells('AA1:AB1'); // 合併儲存格 不良總數

		// $k = 29;
		// for ($i = $k; $i < 33; $i++) { // 合併儲存格  
		// 	$objPHPExcel->getActiveSheet()->mergeCells($this->cellArray[$i] . '1:' . $this->cellArray[$i] . '2');
		// 	$k = $i + 1;
		// }


		// 註解-----------------------------------------------------------------------------------------------------------------		
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('K1')->getText()->createTextRun('ACER_XP:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('K1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('K1')->getText()->createTextRun("依製令重量換算幾首料\r\n");
		$objPHPExcel->getActiveSheet()->getComment('K1')->getText()->createTextRun("例：500kg換算為5首料，則填5\r\n");
		$objPHPExcel->getActiveSheet()->getComment('K1')->setHeight(100);

		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('P1')->getText()->createTextRun('作者:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('P1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('P1')->getText()->createTextRun("例:9點~10點10分\r\n");
		$objPHPExcel->getActiveSheet()->getComment('P1')->setHeight(100);

		// 註解----------------------end-------------------------------------------------------------------------------------------
		//表頭循環====================end=========================================================================================  
		//設置欄寛-------------------------------------------------------
		$width_ary = array(
			'10', '10', '10', '10', '15', '20', '20', '15',
			'15', '10', '10', '10', '10', '10',
			'10', '20', '10',
			'8', '10', '10', '10'
		);  //excel 表頭	
		foreach ($width_ary as $k => $v) {
			$tkey = $k + 1;
			if (@$width_ary[$k] && $width_ary[$k] > 0) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setWidth($width_ary[$k]);
				//$objPHPExcel->getActiveSheet()->getComment('F22')->setHeight('20');
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($this->cellArray[$tkey])->setAutoSize(true);
			}
		}
		//設置欄寛----------------end---------------------------------------

		// TA011dis 以當日 合格數量 之班次累計 加順序 20230503
		$sql98 = " SELECT * ,(select sum(convert(int,TE040)) FROM SFCTE	
									left join SFCTD on TE001=TD001 and TE002=TD002
								WHERE TE006 <> ''  and  TE006=a.TE006 and TE007=a.TE007 and TE008=a.TE008 and TE017=a.TE017 							
								and TD008 <=b.TD008 
								and (CASE when TE022>='0800'and TE022<'1600' then TD008+TE003+'1'
									when TE022='0000' then TD008+TE003+'3'
									when TE002>='1600' and TE022<'2000' then TD008+TE003+'2' else TD008+TE003+'3' END)<=(CASE when a.TE022>='0800'and a.TE022<'1600' then b.TD008+a.TE003+'1'
									when a.TE022='0000' then b.TD008+a.TE003+'3'
									when a.TE002>='1600' and a.TE022<'2000' then b.TD008+a.TE003+'2' else b.TD008+a.TE003+'3' END) ) as TA011dis,
							(rtrim(a.TE022)+'~'+ COALESCE( CASE when a.TE027='' then null else rtrim(a.TE027) END ,
							CASE when a.TE025='' then null else rtrim(a.TE025) END , rtrim(a.TE023) )) as TE012disp,
							SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(a.TE013 as varchar),4),3,2) as TE013time,
							(CASE when TE022>='0800'and TE022<'1600' then '1'
								when TE022='0000' then '3'
								when TE002>='1600' and TE022<'2000' then '2' else '3' END) as TE022disp
					FROM dbo.SFCTE AS a
						LEFT JOIN SFCTD as b ON TE001=TD001 AND TE002=TD002
						LEFT JOIN dbo.molda as c on TE017=da001 and TE009=da013 and TE029=da014
						LEFT JOIN MOCTA as d on TA001=TE006 AND TA002=TE007
						LEFT JOIN INVMB as e ON MB001=da016
						WHERE TD001='D503' AND TD004='RW003' and TD003>='$TD008s' and TD003<='$TD008d' 
					ORDER BY TD003,(CASE when TE022>='0800'and TE022<'1600' then '1'
									when TE022='0000' then '3'
									when TE002>='1600' and TE022<'2000' then '2' else '3' END),TE005,TE004
					";
		$querysa = $this->db->query($sql98);


		if ($querysa->num_rows() > 0) {
			$resultsa = $querysa->result();
			$ro = 3; //第幾行開始
			foreach ($resultsa as $key => $val) {
				$col = 1;
				$ros = $ro + $key;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TD003);		//日期

				//班別 0800~1600 早班、1600~2000中班、2000~ 晚班

				if ($val->TE022disp == '1') {
					$val->TE022 = '早班';
				} else if ($val->TE022disp == '2') {
					$val->TE022 = '中班';
				} else {
					$val->TE022 = '晚班';
				}

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE022);		//班別
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE005);		//機台

				$DB2 = $this->load->database('yjpal', TRUE);
				$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004' ");
				if ($query82->num_rows() > 0)
					$val->TE004 = $query82->result()[0]->mv002;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE004);		//操作員

				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . ($ros), trim($val->TE007), PHPExcel_Cell_DataType::TYPE_STRING);		//製令單號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TA015);		//計畫產量
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($this->cellArray[$col++] . ($ros), trim($val->TE017), PHPExcel_Cell_DataType::TYPE_STRING);		//品號
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->TE018), 'utf-8', 'big-5'));		//產品名稱
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->TE019), 'utf-8', 'big-5'));		//規格

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->MB002), 'utf-8', 'big-5'));		//配方


				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da005);			//'預定數' . PHP_EOL . '(首)'				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE032);			//'實際完' . PHP_EOL . '成數(首)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da006);		//'每首料理' . PHP_EOL . '論重量(kg)'

				$sumg = round($val->TE032 * $val->da006, 3);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $sumg);		//'理論總' . PHP_EOL . '重量(kg)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $sumg);		//'實際總' . PHP_EOL . '重量(kg)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->da010);		//'生產週期' . PHP_EOL . '(秒/PCS)'


				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $val->TE012disp);		//'生產起~' . PHP_EOL . '迄時間'

				$workhour = round((floatval(substr($val->TE013time, 0, 2)) * 60 + floatval(substr($val->TE013time, -2))) / 60, 1);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), $workhour);		//'生產' . PHP_EOL . '時間(H)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), '');		//'報廢' . PHP_EOL . '數量(kg)'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), '');		//'報廢' . PHP_EOL . '原因'
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), '');		//'異常分析' . PHP_EOL . '解決方案'


				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($this->cellArray[$col++] . ($ros), mb_convert_encoding(trim($val->TE015), 'utf-8', 'big-5'));			//備註

			}
		}
		//萬馬力日報表---------產生--------END------------------------------------------------------------------------------------------------------------------------------------------

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($TD008s);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		if (!@$filename) {
			$filename = "Excel_" . date('Ymd');
		} else {
			$filename .= '_' . $TD008s;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//   $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}
    //1140129 excle 裝配
	function excelnewfr()
	{
		//刪日期 / 符號
		preg_match_all('/\d/S', $this->input->post('TD008s'), $matches);  //處理日期字串
		$seq1 = implode('', $matches[0]);
		preg_match_all('/\d/S', $this->input->post('TD008d'), $matches);  //處理日期字串
		$seq2 = implode('', $matches[0]);

		$seq3 = trim($this->input->post('td001'));

		/*$sql = " select b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,a.TE030 AS TE030dispN,
					a.TE017, a.TE018, a.TE019,f.MW001,f.MW003 as TE009disp,					
					convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312,
					'產能85%' as da0051, i.MD013 as MD013m, a.TE001, g.da005, g.da015,g.da010, a.TE029, g.da004, a.TE040				
				from SFCTE	as a
					left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
					left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
					left join CMSMV as d on a.TE004=d.MV001
					left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
					left join CMSMW as f on a.TE009=f.MW001 
					left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
					left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
					left JOIN CMSMD as i on b.TD004=i.MD001
				where b.TD008>='$seq1' and b.TD008<='$seq2'
				order by b.TD008,e.MX001
		  "; */
        // $this->sqlrd();
		 //1140130
		/* $sql = "  
		select b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,a.TE030 AS TE030dispN,
					a.TE017, a.TE018, a.TE019,f.MW001,f.MW003 as TE009disp,					
					convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312,
					'產能85%' as da0051, b.TD011 as MD013m, a.TE001, g.da005, g.da015,g.da010, a.TE029, g.da004, a.TE040				
				from SFCTE	as a
					left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
					left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
					left join CMSMV as d on a.TE004=d.MV001
					left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
					left join CMSMW as f on a.TE009=f.MW001 
					left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
					left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
					left JOIN CMSMD as i on b.TD004=i.MD001
				where b.TD008>='$seq1' and b.TD008<='$seq2'
				order by b.TD008,e.MX001
				"; */
			/*	$sql = "  
		select b.TB003, e.MX001, e.MX003 as TE005disp,a.TC015 AS  TE004disp,TC013  AS TE030disp,a.TC030 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,f.MW001,f.MW003 as TE009disp,					
					TC036  as TE0312,
					'產能85%' as da0051, isnull(pk003,1.4) as MD013m, a.TC001 AS TE001, isnull(pk002,4.9) as da005, isnull(pk003,1.4) as da015, isnull(pk003,1.3) as da010, a.TC013 AS TE029, isnull(pk004,1.1) as da004, a.TC040 AS TE040				
				from SFCTC	as a
					left join SFCTB as b on a.TC001=b.TB001 and a.TC002=b.TB002 	
					left JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					left join CMSMV as d on a.TC047=d.MV001
					left join CMSMX as e on a.TC023=e.MX001 and b.TB005=e.MX002
					left join CMSMW as f on a.TC009=f.MW001 
					LEFT JOIN sfcpk AS g ON a.TC047 = g.pk001 
					left JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					left JOIN CMSMD as i on b.TB005=i.MD001
				where b.TB003>='$seq1' and b.TB003<='$seq2' and a.TC001='D311'
				order by b.TB003,e.MX001
				"; */
		// echo "<pre>";var_dump($sql);exit;
		//$this->db->query($sql);
		//$sql = "select * from SFCI03GP ";
		//$query = $this->db->query($sql);
		//有輸入單別時執行下列
		//1140130
	/*	if ($seq3) {
			//字串分割用原 "D401;D402;D403" ==> $sql88 = " ( a.TE001='D401' or a.TE001='D402' or a.TE001='D403' ) "
			$sql88 = " ( a.TE001='";
			if (strpos($seq3, ';')) {
				$arr = explode(";", $seq3);

				foreach ($arr as $key => $val) {
					if ($arr[$key]) {
						if ($key != 0) {
							$sql88 .= " or a.TE001='";
						}
						$sql88 .= $arr[$key] . "' ";
					}
				}

				$sql88 .= ' ) ';
			} else {
				$sql88 = " a.TE001='$seq3' ";
			} */
         //1140130
			/* $sql = " select b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,a.TE030 AS TE030dispN,
					a.TE017, a.TE018, a.TE019, a.TE029,f.MW001,f.MW003 as TE009disp,					
					convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312,
					'aaaa' as da0051, b.TD011 as MD013m, a.TE001, g.da005, g.da015,g.da010, g.da004, a.TE040
				
				from SFCTE	as a
					left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
					left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
					left join CMSMV as d on a.TE004=d.MV001
					left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
					left join CMSMW as f on a.TE009=f.MW001 
					left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
					left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
					left JOIN CMSMD as i on b.TD004=i.MD001
				where b.TD008>='$seq1' and b.TD008<='$seq2' and $sql88
				order by b.TD008,e.MX001
		  "; */
	//	}
      /*  $sql = "  
		select b.TB003, e.MX001, e.MX003 as TE005disp,a.TC015 AS  TE004disp,TC013  AS TE030disp,a.TC030 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,f.MW001,f.MW003 as TE009disp,					
					TC036  as TE0312,
					'產能85%' as da0051, isnull(pk003,1.4) as MD013m, a.TC001 AS TE001, isnull(pk002,4.9) as da005, isnull(pk003,1.4) as da015, isnull(pk003,1.3) as da010, a.TC013 AS TE029, isnull(pk004,1.1) as da004, a.TC040 AS TE040				
				from SFCTC	as a
					left join SFCTB as b on a.TC001=b.TB001 and a.TC002=b.TB002 	
					left JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					left join CMSMV as d on a.TC047=d.MV001
					left join CMSMX as e on a.TC023=e.MX001 and b.TB005=e.MX002
					left join CMSMW as f on a.TC009=f.MW001 
					LEFT JOIN sfcpk AS g ON a.TC047 = g.pk001 
					left JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					left JOIN CMSMD as i on b.TB005=i.MD001
				where b.TB003>='$seq1' and b.TB003<='$seq2' and a.TC001='D311'
				order by b.TB003,e.MX001
				"; */
				//1140130 a.TC001 AS TE001, isnull(pk002,4.9) as da005,
				//	isnull(pk003,1.4) as da015, isnull(pk003,1.3) as da010, a.TC013 AS TE029, isnull(pk004,1.1) as da004, a.TC040 AS TE040	
		 $seq2=$seq2.'99999';
		/* $sql = "  
		select b.TB003, e.MX001, e.MX003 as TE005disp,a.TC023 AS  TE004disp,TC013  AS TE030disp,MV002 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,f.MW001,f.MW003 as TE009disp,					
					TC015  as TE0312,
					TC036 as da0051, isnull(pk004,1.4) as MD013m				
				from SFCTC	as a
					left join SFCTB as b on a.TC001=b.TB001 and a.TC002=b.TB002 	
					left JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					left join CMSMV as d on a.TC047=d.MV001
					left join CMSMX as e on a.TC023=e.MX002 
					left join CMSMW as f on a.TC041=f.MW001 
					LEFT JOIN sfcpk AS g ON a.TC047 = g.pk001 
					left JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					left JOIN CMSMD as i on b.TB005=i.MD001
				where a.TC002>='$seq1' and a.TC002<='$seq2' and a.TC001='D311'
				order by b.TB003,e.MX001
				";
		$query = $this->db->query($sql);*/
		
	/*	 $sql = "  
		select b.TB003, e.MX001, e.MX003 as TE005disp,a.TC023 AS  TE004disp,TC013  AS TE030disp,MV002 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,f.MW001,f.MW003 as TE009disp,					
					TC015  as TE0312,
					TC036 as da0051, isnull(pk004,1.4) as MD013m				
				from SFCTC	as a
					left join SFCTB as b on a.TC001=b.TB001 and a.TC002=b.TB002 	
					left JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					left join CMSMV as d on a.TC047=d.MV001
					left join CMSMX as e on a.TC023=e.MX002 
					left join CMSMW as f on a.TC041=f.MW001 
					LEFT JOIN sfcpk AS g ON a.TC047 = g.pk001 
					left JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					left JOIN CMSMD as i on b.TB005=i.MD001
				where b.TB003>='$seq1' and b.TB003<='$seq2' and a.TC001='D311'
				order by b.TB003,e.MX001
				"; */
		/*select b.TB003, e.MX001, e.MX003 as TE005disp,a.TC023 AS  TE004disp,TC013  AS TE030disp,MV002 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,f.MW001,f.MW003 as TE009disp,					
					TC015  as TE0312,
					 isnull(pk004,1.4) as MD013m */
	 /*SELECT a.TC001 AS TE001,a.TC002  AS TE002,b.TB003 AS TD008,a.TC004 AS TE006,a.TC005 AS TE007,a.TC047 AS TE017,a.TC048 AS TE018,a.TC049 AS TE019,a.TC013 AS TE029,a.TC015 AS TE004disp,a.TC014 AS TE040,
 TC013 AS TE030disp,
 a.TC014 AS TE013,a.TC015 AS TE011,isnull(pk002,4.9) as da005, isnull(pk003,1.4) as da015, isnull(pk003,1.3) as da010,isnull(pk004,1.1) as da004,
TC036 AS TE0312, isnull(pk004,1.4) AS MD013m
	 	 */
		
		/*$sql = "  
		select b.TB003, e.MX001, e.MX003 as TE005disp,a.TC023 AS  TE004disp,TC013  AS TE030disp,MV002 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,f.MW001,f.MW003 as TE009disp,					
					TC015  as TE0312,
					TC036 as da0051, isnull(pk002,4.9) as MD013m
 FROM SFCTC as a
LEFT JOIN  SFCTB as b ON  a.TC001=b.TB001 AND a.TC002=b.TB002
left JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					left join CMSMV as d on a.TC047=d.MV001
					left join CMSMX as e on a.TC023=e.MX002 
					left join CMSMW as f on a.TC041=f.MW001
LEFT JOIN sfcpk AS g ON a.TC047 = g.pk001 
left JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					left JOIN CMSMD as i on b.TB005=i.MD001
WHERE b.TB003>='$seq1' and b.TB003<='$seq2' and a.TC001='D311'
ORDER BY b.TB003 DESC f.MW001,f.MW003 
				"; */
				$sqla1 = " delete from  sfctca where 1=1 ";
				$this->db->query($sqla1);
				$sqla2 = " delete from  sfctcb where 1=1 ";
				$this->db->query($sqla2);
				$sqla = " insert into sfctca 
		select DISTINCT b.TB003, '' as MX001 , ''  as TE005disp,a.TC023 AS  TE004disp,TC013  AS TE030disp,TC005 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,h.TA004,h.TA024 as TE009disp,					
					TC015  as TE0312,
					TC036 as da0051, isnull(pk002,4.9) as MD013m	
 FROM SFCTC as a
inner JOIN  SFCTB as b ON  a.TC001=b.TB001 AND a.TC002=b.TB002
inner JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					
					inner join CMSMX as e on a.TC023=e.MX002 
					inner join CMSMW as f on a.TC041=f.MW001
inner JOIN sfcpk AS g ON a.TC047 = g.pk001 
inner JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					inner JOIN CMSMD as i on b.TB005=i.MD001
WHERE b.TB003>='$seq1' and b.TB003<='$seq2' AND TB001='D311' AND  h.TA006='AW001'   AND TC001='D311'
ORDER BY b.TB003 DESC 

				";
				$this->db->query($sqla);
					$sqlb = " insert into sfctcb 
		select DISTINCT b.TB003, e.MX001, e.MX003 as TE005disp,a.TC023 AS  TE004disp,TC013  AS TE030disp,TC005 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,h.TA004,h.TA024 as TE009disp ,					
					TC015  as TE0312,
					TC036 as da0051, isnull(pk002,4.9) as MD013m	
 FROM SFCTC as a
inner JOIN  SFCTB as b ON  a.TC001=b.TB001 AND a.TC002=b.TB002
inner JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					
					inner join CMSMX as e on a.TC023=e.MX002 
					inner join CMSMW as f on a.TC041=f.MW001
inner JOIN sfcpk AS g ON a.TC047 = g.pk001 
inner JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					inner JOIN CMSMD as i on b.TB005=i.MD001
WHERE b.TB003>='$seq1' and b.TB003<='$seq2' AND TB001='D311'
ORDER BY b.TB003 DESC 
				";
				$this->db->query($sqlb);
$sqly = " 		
UPDATE a
SET a.tc002 = b.tc002, 
    a.tc003 = b.tc003
FROM sfctca AS a
INNER JOIN sfctcb AS b
ON a.tc004 = b.tc004 
   AND a.tc006 = b.tc006 
   AND a.tc007 = b.tc007 ";
$this->db->query($sqly);
		
		$sql = "  
		select * from sfctca 
ORDER BY tc001 DESC 
				";		
		$query = $this->db->query($sql);

		$result = $query->result();
		

				/*unset($val->TE001);
				//unset($val->da005);
				unset($val->da015);
				unset($val->da010);
				// unset($val->TE029);
				unset($val->da004);
				unset($val->TE040);*/
		//	} 
	//	}


		return $query->result_array();
	}
	function excelnewfr_oldxxx()
	{
		//刪日期 / 符號
		preg_match_all('/\d/S', $this->input->post('TD008s'), $matches);  //處理日期字串
		$seq1 = implode('', $matches[0]);
		preg_match_all('/\d/S', $this->input->post('TD008d'), $matches);  //處理日期字串
		$seq2 = implode('', $matches[0]);

		$seq3 = trim($this->input->post('td001'));

		/*$sql = " select b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,a.TE030 AS TE030dispN,
					a.TE017, a.TE018, a.TE019,f.MW001,f.MW003 as TE009disp,					
					convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312,
					'產能85%' as da0051, i.MD013 as MD013m, a.TE001, g.da005, g.da015,g.da010, a.TE029, g.da004, a.TE040				
				from SFCTE	as a
					left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
					left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
					left join CMSMV as d on a.TE004=d.MV001
					left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
					left join CMSMW as f on a.TE009=f.MW001 
					left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
					left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
					left JOIN CMSMD as i on b.TD004=i.MD001
				where b.TD008>='$seq1' and b.TD008<='$seq2'
				order by b.TD008,e.MX001
		  "; */
        // $this->sqlrd();
		 //1140130
		/* $sql = "  
		select b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,a.TE030 AS TE030dispN,
					a.TE017, a.TE018, a.TE019,f.MW001,f.MW003 as TE009disp,					
					convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312,
					'產能85%' as da0051, b.TD011 as MD013m, a.TE001, g.da005, g.da015,g.da010, a.TE029, g.da004, a.TE040				
				from SFCTE	as a
					left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
					left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
					left join CMSMV as d on a.TE004=d.MV001
					left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
					left join CMSMW as f on a.TE009=f.MW001 
					left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
					left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
					left JOIN CMSMD as i on b.TD004=i.MD001
				where b.TD008>='$seq1' and b.TD008<='$seq2'
				order by b.TD008,e.MX001
				"; */
			/*	$sql = "  
		select b.TB003, e.MX001, e.MX003 as TE005disp,a.TC015 AS  TE004disp,TC013  AS TE030disp,a.TC030 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,f.MW001,f.MW003 as TE009disp,					
					TC036  as TE0312,
					'產能85%' as da0051, isnull(pk003,1.4) as MD013m, a.TC001 AS TE001, isnull(pk002,4.9) as da005, isnull(pk003,1.4) as da015, isnull(pk003,1.3) as da010, a.TC013 AS TE029, isnull(pk004,1.1) as da004, a.TC040 AS TE040				
				from SFCTC	as a
					left join SFCTB as b on a.TC001=b.TB001 and a.TC002=b.TB002 	
					left JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					left join CMSMV as d on a.TC047=d.MV001
					left join CMSMX as e on a.TC023=e.MX001 and b.TB005=e.MX002
					left join CMSMW as f on a.TC009=f.MW001 
					LEFT JOIN sfcpk AS g ON a.TC047 = g.pk001 
					left JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					left JOIN CMSMD as i on b.TB005=i.MD001
				where b.TB003>='$seq1' and b.TB003<='$seq2' and a.TC001='D311'
				order by b.TB003,e.MX001
				"; */
		// echo "<pre>";var_dump($sql);exit;
		//$this->db->query($sql);
		//$sql = "select * from SFCI03GP ";
		//$query = $this->db->query($sql);
		//有輸入單別時執行下列
		//1140130
	/*	if ($seq3) {
			//字串分割用原 "D401;D402;D403" ==> $sql88 = " ( a.TE001='D401' or a.TE001='D402' or a.TE001='D403' ) "
			$sql88 = " ( a.TE001='";
			if (strpos($seq3, ';')) {
				$arr = explode(";", $seq3);

				foreach ($arr as $key => $val) {
					if ($arr[$key]) {
						if ($key != 0) {
							$sql88 .= " or a.TE001='";
						}
						$sql88 .= $arr[$key] . "' ";
					}
				}

				$sql88 .= ' ) ';
			} else {
				$sql88 = " a.TE001='$seq3' ";
			} */
         //1140130
			/* $sql = " select b.TD008, e.MX001, e.MX003 as TE005disp,a.TE004 as TE004disp,(LEN(a.TE030) - LEN(REPLACE(a.TE030,';',''))) / LEN(';')+1 AS TE030disp,a.TE030 AS TE030dispN,
					a.TE017, a.TE018, a.TE019, a.TE029,f.MW001,f.MW003 as TE009disp,					
					convert(int,a.TE011)-convert(int,a.TE028)-convert(int,a.TE031) as TE0312,
					'aaaa' as da0051, b.TD011 as MD013m, a.TE001, g.da005, g.da015,g.da010, g.da004, a.TE040
				
				from SFCTE	as a
					left join SFCTD as b on a.TE001=b.TD001 and a.TE002=b.TD002 	
					left JOIN MOCTA as c on a.TE006=c.TA001 and a.TE007=c.TA002 
					left join CMSMV as d on a.TE004=d.MV001
					left join CMSMX as e on a.TE005=e.MX001 and b.TD004=e.MX002
					left join CMSMW as f on a.TE009=f.MW001 
					left join molda as g on a.TE017=g.da001 and a.TE009=g.da013 and a.TE029=g.da014
					left JOIN SFCTA as h on a.TE006=h.TA001 and a.TE007=h.TA002 and a.TE009=h.TA004
					left JOIN CMSMD as i on b.TD004=i.MD001
				where b.TD008>='$seq1' and b.TD008<='$seq2' and $sql88
				order by b.TD008,e.MX001
		  "; */
	//	}
      /*  $sql = "  
		select b.TB003, e.MX001, e.MX003 as TE005disp,a.TC015 AS  TE004disp,TC013  AS TE030disp,a.TC030 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,f.MW001,f.MW003 as TE009disp,					
					TC036  as TE0312,
					'產能85%' as da0051, isnull(pk003,1.4) as MD013m, a.TC001 AS TE001, isnull(pk002,4.9) as da005, isnull(pk003,1.4) as da015, isnull(pk003,1.3) as da010, a.TC013 AS TE029, isnull(pk004,1.1) as da004, a.TC040 AS TE040				
				from SFCTC	as a
					left join SFCTB as b on a.TC001=b.TB001 and a.TC002=b.TB002 	
					left JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					left join CMSMV as d on a.TC047=d.MV001
					left join CMSMX as e on a.TC023=e.MX001 and b.TB005=e.MX002
					left join CMSMW as f on a.TC009=f.MW001 
					LEFT JOIN sfcpk AS g ON a.TC047 = g.pk001 
					left JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					left JOIN CMSMD as i on b.TB005=i.MD001
				where b.TB003>='$seq1' and b.TB003<='$seq2' and a.TC001='D311'
				order by b.TB003,e.MX001
				"; */
				//1140130 a.TC001 AS TE001, isnull(pk002,4.9) as da005,
				//	isnull(pk003,1.4) as da015, isnull(pk003,1.3) as da010, a.TC013 AS TE029, isnull(pk004,1.1) as da004, a.TC040 AS TE040	
//1140210 modi		
	/*	$sql = "  
		select b.TB003, e.MX001, e.MX003 as TE005disp,a.TC023 AS  TE004disp,TC013  AS TE030disp,MV002 AS TE030dispN,
					a.TC047 AS TE017, a.TC048 AS TE018, a.TC049 AS TE019,f.MW001,f.MW003 as TE009disp,					
					TC015  as TE0312,
					TC036 as da0051, isnull(pk004,1.4) as MD013m				
				from SFCTC	as a
					left join SFCTB as b on a.TC001=b.TB001 and a.TC002=b.TB002 	
					left JOIN MOCTA as c on a.TC004=c.TA001 and a.TC005=c.TA002 
					left join CMSMV as d on a.TC047=d.MV001
					left join CMSMX as e on a.TC023=e.MX002 
					left join CMSMW as f on a.TC041=f.MW001 
					LEFT JOIN sfcpk AS g ON a.TC047 = g.pk001 
					left JOIN SFCTA as h on a.TC004=h.TA001 and a.TC005=h.TA002 and a.TC007=h.TA004
					left JOIN CMSMD as i on b.TB005=i.MD001
				where b.TB003>='$seq1' and b.TB003<='$seq2' and a.TC001='D311'
				order by b.TB003,e.MX001
				";
		$query = $this->db->query($sql);

		$result = $query->result();
		

				/*unset($val->TE001);
				//unset($val->da005);
				unset($val->da015);
				unset($val->da010);
				// unset($val->TE029);
				unset($val->da004);
				unset($val->TE040);*/
		//	} 
	//	} */
		$da0051='產能85%';
	$da0052='生產效率';
	$da0051=iconv("utf-8", "BIG5//IGNORE", '產能85%');
	$da0052=iconv("utf-8", "BIG5//IGNORE", '生產效率');
	
$sql = "	INSERT INTO SFCI03GP
SELECT
    b.TD008,
    e.MX001,
    e.MX003 AS TE005disp,
    a.TE004 AS TE004disp,
    (LEN(a.TE030) - LEN(REPLACE(a.TE030, ';', ''))) / LEN(';') + 1 AS TE030disp,
    a.TE017,
    a.TE018,
    a.TE019,
    f.MW001,
    f.MW003 AS TE009disp,
    (RTRIM(a.TE022) + '~' + COALESCE(
        CASE WHEN a.TE027 = '' THEN NULL ELSE RTRIM(a.TE027) END,
        CASE WHEN a.TE025 = '' THEN NULL ELSE RTRIM(a.TE025) END,
        RTRIM(a.TE023)
    )) AS TE012disp,
    SUBSTRING(RIGHT('0000' + CAST(a.TE013 AS VARCHAR), 4), 1, 2) + ':' + SUBSTRING(RIGHT('0000' + CAST(a.TE013 AS VARCHAR), 4), 3, 2) AS TE013,
    CASE
        WHEN ISNUMERIC(a.TE011) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE011)
        ELSE 0
    END AS TE011,
    CASE
        WHEN ISNUMERIC(c.TA015) = 1 THEN CONVERT(DECIMAL(16, 0), c.TA015)
        ELSE 0
    END AS TA015,
    CASE
        WHEN ISNUMERIC((SELECT SUM(TE011) FROM SFCTE WHERE TE006 = a.TE006 AND TE007 = a.TE007 AND TE008 = a.TE008 AND TE002 <= a.TE002)) = 1 THEN CONVERT(DECIMAL(16, 3), (SELECT SUM(TE011) FROM SFCTE WHERE TE006 = a.TE006 AND TE007 = a.TE007 AND TE008 = a.TE008 AND TE002 <= a.TE002))
        ELSE 0
    END AS TA011,
    CASE
        WHEN ISNUMERIC(a.TE011) = 1 AND ISNUMERIC(a.TE028) = 1 AND ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE011) - CONVERT(DECIMAL(16, 0), a.TE028) - CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE0312,
    CASE
        WHEN ISNUMERIC(a.TE028) = 1 AND ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE028) + CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE0311,
    CASE
        WHEN ISNUMERIC(a.TE028) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE028)
        ELSE 0
    END AS TE028,
    CASE
        WHEN ISNUMERIC(a.TE031) = 1 THEN CONVERT(DECIMAL(16, 0), a.TE031)
        ELSE 0
    END AS TE031,
    CASE
        WHEN ISNUMERIC(g.da005) = 1 THEN CONVERT(DECIMAL(16, 0), g.da005)
        ELSE 0
    END AS da005,
    CASE
        WHEN ISNUMERIC(g.da004) = 1 THEN CONVERT(DECIMAL(16, 0), g.da004)
        ELSE 0
    END AS da004,
    '$da0051' AS da0051,
    '$da0052' AS da0052,
    i.MD001,
    i.MD002,
    a.TE030 AS TE030dispN,
    CASE
        WHEN ISNUMERIC(b.TD011) = 1 THEN CONVERT(DECIMAL(16, 4), b.TD011)
        ELSE 0
    END AS MD013m,
    a.TE001,
    g.da015,
    g.da010,
    a.TE029,
    a.TE040
FROM
    SFCTE AS a
    LEFT JOIN SFCTD AS b ON a.TE001 = b.TD001 AND a.TE002 = b.TD002
    LEFT JOIN MOCTA AS c ON a.TE006 = c.TA001 AND a.TE007 = c.TA002
    LEFT JOIN CMSMV AS d ON a.TE004 = d.MV001
    LEFT JOIN CMSMX AS e ON a.TE005 = e.MX001 AND b.TD004 = e.MX002
    LEFT JOIN CMSMW AS f ON a.TE009 = f.MW001
    LEFT JOIN molda AS g ON a.TE017 = g.da001 AND a.TE009 = g.da013 AND a.TE029 = g.da014
    LEFT JOIN SFCTA AS h ON a.TE006 = h.TA001 AND a.TE007 = h.TA002 AND a.TE009 = h.TA004
    LEFT JOIN CMSMD AS i ON b.TD004 = i.MD001
WHERE
    b.TD008>='$seq1' and b.TD008<='$seq2' and b.TD001='D404' AND a.TE001='D404'
ORDER BY
    b.TD008 DESC,
    e.MX001; ";
		// echo "<pre>";var_dump($sql);exit; and a.TE001 like '$vno' 1140210
		//,da015,TE013,da005,da004,TE011,da010,TE029,TE001,MD013m,TA015 D404
		$this->db->query($sql);
		//$sql = "select * from SFCI03GP ";
		 $sql = "select  TD008,MX001,TE005disp,TE004disp,TE030disp,TE030dispN,TE017,
	TE018,TE019,MW001,TE009disp,TE040,TE029,da015,TE013,da005,da004,TE011,da010,TE029,TE001,MD013m,TA015
		 from SFCI03GP where TD008>='$seq1' AND TD008<='$seq2' AND TE001='D404' ORDER BY TD008; ";

		$query = $this->db->query($sql);

		$ret['data'] = $query->result();
		if (count($ret['data']) > 0) {
			$DB2 = $this->load->database('yjpal', TRUE);
			foreach ($ret['data'] as $key => $val) {
				$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$val->TE004disp' ");
				if ($query82->num_rows() > 0)
					$val->TE004disp = $query82->result()[0]->mv002;

				$workhour = round((floatval(substr($val->TE013, 0, 2)) * 60 + floatval(substr($val->TE013, -2))) / 60, 1);

				// if ($val->da0051) {
				if (!$val->da004 || !$val->da005 || !$val->da015) {
					$val->da0051 = '';
				} else {
					$val->da0051 = round(60 * 85 * floatval($val->da004) * floatval($val->da005) / 100 / floatval($val->da015), 0);
				}
				// }
				if ($workhour <= 0) {
					$val->da0052 = '工作時間必須大於0';
				} else {
					if (!$val->da0051 || !$val->TE011) {
						$val->da0052 = '';
					} else {
						$val->da0052 = round($val->TE011 / $workhour / $val->TE030disp / $val->da0051 * 100, 0) . '%';
					}
				}

				if ($val->TE001 == 'D404' || $val->TE001 == 'D504') { //注塑 計算方式					
					if (!$val->da005) {
						$val->MD013m = '無標準模穴數';
					} else if ($val->TE029 == '1') { //半自動
						//注塑是(時薪*週期時間)/模穴數*作業人數 20220912 Wechat
						//              注塑是(時薪  MD013m         * 週期時間  da010   )        /理論模穴數  da005 * 作業人數  da015
						$val->MD013m =  round((floatval($val->MD013m) * floatval($val->da010) / 3600) / floatval($val->da005) * floatval($val->da015), 3);
					} else { //自動
						//              注塑是(時薪  MD013m-3.6         * 週期時間  da010   )        /理論模穴數  da005 * 作業人數  da015
						$val->MD013m =  round(((floatval($val->MD013m) - 3.6) * floatval($val->da010) / 3600) / floatval($val->da005) * floatval($val->da015), 3);
					}

					$val->TE0312 = $val->TE040; // 合格數量
				} else {
					if (!$val->da0051) {
						$val->MD013m = '';
					} else {
						$val->MD013m =  round(floatval($val->MD013m) / floatval($val->da0051), 3);
					}
				}



				if ($val->TE030dispN != '') {

					$arr = explode(";", $val->TE030dispN);
					$val->TE030dispN = '';

					foreach ($arr as $k => $v) {
						if ($arr[$k]) {
							$vmv001 = $arr[$k];
							$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$vmv001' ");
							if ($query82->num_rows() > 0)
								$val->TE030dispN .= $query82->result()[0]->mv002 . ';';
						}
					}
				}
			}
		}
	

      //  return $ret;
		return $query->result_array(); 
	}

	function excelnewfr_gj()
	{
		//刪日期 / 符號
		preg_match_all('/\d/S', $this->input->post('TD008s'), $matches);  //處理日期字串
		$seq1 = implode('', $matches[0]);
		preg_match_all('/\d/S', $this->input->post('TD008d'), $matches);  //處理日期字串
		$seq2 = implode('', $matches[0]);
        //1130731 modi (pg005+pg006+pg007+pg008+pg009+pg010+pg011+pg012)
  //CASE    
//	WHEN pg002=''  THEN TC201
 //   ELSE pg002 END
		$sql = " SELECT TC001,TC002,TB003,TC004,TC005,TC047,TC048,TC049,
 CASE    
	WHEN pg002 is NULL  THEN TC201
    ELSE pg002 END as pg002,TC201,TC014, 
					sfcpg.pg019 as MD013m
				 FROM SFCTC 
					LEFT JOIN SFCTB ON TC001=TB001 AND TC002=TB002
					LEFT JOIN sfcpg ON TC047=pg001 AND TC201=pg002
				where TB001='D310' and TB003>='$seq1' and TB003<='$seq2'
				order by TB003, TC047
		  ";


		$query = $this->db->query($sql);

		// $result = $query->result();
		// if (count($result) > 0) {

		// 	foreach ($result as $key => $val) {


		// 		if (!$val->da004 || !$val->da005 || !$val->da015) {
		// 			$val->da0051 = '';
		// 		} else {
		// 			$val->da0051 = round(60 * 85 * floatval($val->da004) * floatval($val->da005) / 100 / floatval($val->da015), 0);
		// 		}
		// 		// }

		// 		if ($val->TE001 == 'D404' || $val->TE001 == 'D504') { //注塑 計算方式					
		// 			if (!$val->da005) {
		// 				$val->MD013m = '無標準模穴數';
		// 			} else if (!$val->da010) {
		// 				$val->MD013m = '無週期時間';
		// 			} else if ($val->TE029 == '1') { //半自動
		// 				//注塑是(時薪*週期時間)/模穴數*作業人數 20220912 Wechat
		// 				//              注塑是(時薪  MD013m         * 週期時間  da010   )        /模穴數  da005 * 作業人數  da015
		// 				$val->MD013m =  round((floatval($val->MD013m) * floatval($val->da010) / 3600) / floatval($val->da005) * floatval($val->da015), 3);
		// 			} else { //自動
		// 				//              注塑是(時薪  MD013m-3.6         * 週期時間  da010   )        /模穴數  da005 * 作業人數  da015
		// 				$val->MD013m =  round(((floatval($val->MD013m) - 3.6) * floatval($val->da010) / 3600) / floatval($val->da005) * floatval($val->da015), 3);
		// 			}

		// 			$val->TE0312 = $val->TE040; // 合格數量
		// 		} else {
		// 			if (!$val->da0051) {
		// 				$val->MD013m = '';
		// 			} else {
		// 				$val->MD013m =  round(floatval($val->MD013m) / floatval($val->da0051), 3);
		// 			}
		// 		}

		// 		if ($val->TE030dispN != '') {

		// 			$arr = explode(";", $val->TE030dispN);
		// 			$val->TE030dispN = '';

		// 			foreach ($arr as $k => $v) {
		// 				if ($arr[$k]) {
		// 					$vmv001 = $arr[$k];
		// 					$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$vmv001' ");
		// 					if ($query82->num_rows() > 0)
		// 						$val->TE030dispN .= $query82->result()[0]->mv002 . ';';
		// 				}
		// 			}

		// 			// for ($i = 0; $i < count($arr) - 1; $i++) {
		// 			// 	$vmv001 = $arr[$i];
		// 			// 	$query82 = $DB2->query(" select mv002 from cmsmv where mv001='$vmv001' ");
		// 			// 	$val->TE030dispN .= $query82->result()[0]->mv002 . ';';
		// 			// }
		// 		}

		// 		unset($val->TE001);
		// 		unset($val->da005);
		// 		unset($val->da015);
		// 		unset($val->da010);
		// 		// unset($val->TE029);
		// 		unset($val->da004);
		// 		unset($val->TE040);
		// 	}
		// }


		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('td001o');
		$seq2 = $this->input->post('td001c');
		$seq3 = $this->input->post('td002o');
		$seq4 = $this->input->post('td002c');
		$sql = " SELECT a.td001,a.td002,a.td039,a.td004,c.ma002 as td004disp,b.te003,b.te004,b.te005,b.te006,b.te010,b.te008,b.te011,b.te012
		  FROM sfctd as a,sfcte as b,copma as c
		  WHERE td001=te001 and td002=te002 and td004=ma001 and td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();

		$seq32 = "td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('sfctd')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//選取印單據筆	
	function printfd1()
	{
		$this->db->select('a.* ,c.mq002 AS td001disp, d.me002 AS td004disp, e.mb002 AS td010disp, f.mv002 AS td012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te011, b.te009, b.te017, b.te018, b.te012');

		$this->db->from('sfctd as a');
		$this->db->join('sfcte as b', 'a.td001 = b.te001  and a.td002=b.te002 ', 'left');
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="31" ', 'left');
		$this->db->join('cmsme as d', 'a.td004 = d.me001 ', 'left');
		$this->db->join('cmsmb as e', 'a.td010 = e.mb001 ', 'left');
		$this->db->join('cmsmv as f ', 'a.td012 = f.mv001 and f.mv022 = " " ', 'left');
		$this->db->where('a.td001', $this->uri->segment(4));
		$this->db->where('a.td002', $this->uri->segment(5));
		$this->db->order_by('td001 , td002 ,b.te003');

		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1 = $this->uri->segment(4);
		$seq2 = $this->uri->segment(5);
		$this->db->where('te001', $this->uri->segment(4));
		$this->db->where('te002', $this->uri->segment(5));
		$query = $this->db->get('sfcte');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//印單據筆   一次多筆列印
	function printfc()
	{
		// $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td007disp,e.mf002 AS td008disp, f.mv002 AS td006disp,g.na003 AS td014disp,
		//   ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		//   b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013, b.te014,b.te016,b.te020,b.te030,b.te031,i.mc002 as te007disp,j.me002 as td005disp');

		// $this->db->from('sfctd as a');
		// $this->db->join('sfcte as b', 'a.td001 = b.te001  and a.td002=b.te002 ', 'left');	//單身	
		// $this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="22" ', 'left');  //單別
		// $this->db->join('cmsmb as d', 'a.td007 = d.mb001 ', 'left');    //廠別
		// $this->db->join('cmsmf as e', 'a.td008 = e.mf001 ', 'left');		//幣別
		// $this->db->join('cmsmv as f ', 'a.td006 = f.mv001 and f.mv022 = " " ', 'left');  //業務人員
		// $this->db->join('cmsna as g ', 'a.td014 = g.na002 and g.na001= "1" ', 'left');    //付款條件
		// $this->db->join('copma as h', 'a.td004 = h.ma001 ', 'left');  //客戶代號
		// $this->db->join('cmsmc as i', 'b.te007 = i.mc001 ', 'left');   //庫別
		// $this->db->join('cmsme as j', 'a.td005 = j.me001 ', 'left');   //部門	
		// $this->db->where('a.td001', $this->input->post('td001o'));
		// $this->db->where('a.td002 >= ' . $this->input->post('td002o') . ' and a.td002 <= ' . $this->input->post('td002c'));
		// $this->db->order_by('td001 , td002 ,b.te003');

		$ta001 = $this->input->post('mq001');
		$ta002 = $this->input->post('mq002');
		$process = $this->input->post('process');

		$sql = " SELECT a.TA002 , a.TA006 ,a.TA034,a.TA035,convert(varchar(25),a.TA015) as TA015,b.TA003,b.TA004,b.TA024
				FROM MOCTA as a 
					left join SFCTA as b on a.TA001 =b.TA001 and a.TA002 =b.TA002 						
				";
		$where = " WHERE a.TA001='$ta001' and  a.TA002='$ta002' ";
		if ($process != '') {
			$sql = $sql . " and b.TA003='$process' ";
		}

		$query = $this->db->query($sql . $where);
		// $result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}
	//印單據筆  半張紙letter1/2 A4half  公司表頭
	function companyf()
	{
		// $this->db->select(' * ');
		// $this->db->from('cmsml');
		$sql = " SELECT * FROM cmsml ";
		$query = $this->db->query($sql);
		// $query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}
	//  系統參數
	function funsysf()
	{
		// $this->db->select(' * ');
		// $this->db->from('cmsma');
		// $query = $this->db->get();
		$sql = " SELECT * FROM CMSMA ";
		$query = $this->db->query($sql);
		$result2['rows2'] = $query->result();
		if ($query->num_rows() > 0) {
			return $result2;
		}
	}

	//印單據筆  
	function printfb()
	{
		$this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td007disp,e.mf002 AS td008disp, f.mv002 AS td006disp,g.na003 AS td014disp,
		  ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013, b.te014,b.te016,b.te020,b.te030,b.te031,i.mc002 as te007disp,j.me002 as td005disp');

		$this->db->from('sfctd as a');
		$this->db->join('sfcte as b', 'a.td001 = b.te001  and a.td002=b.te002 ', 'left');	//單身	
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="22" ', 'left');  //單別
		$this->db->join('cmsmb as d', 'a.td007 = d.mb001 ', 'left');    //廠別
		$this->db->join('cmsmf as e', 'a.td008 = e.mf001 ', 'left');		//幣別
		$this->db->join('cmsmv as f ', 'a.td006 = f.mv001 and f.mv022 = " " ', 'left');  //業務人員
		$this->db->join('cmsna as g ', 'a.td014 = g.na002 and g.na001= "1" ', 'left');    //付款條件
		$this->db->join('copma as h', 'a.td004 = h.ma001 ', 'left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.te007 = i.mc001 ', 'left');   //庫別
		$this->db->join('cmsme as j', 'a.td005 = j.me001 ', 'left');   //部門
		$this->db->where('a.td001', $this->uri->segment(4));
		$this->db->where('a.td002', $this->uri->segment(5));
		$this->db->order_by('td001 , td002 ,b.te003');

		$query = $this->db->get();
		$result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
			return $result;
		}
	}

	//更改一筆	
	function updatef()
	{
		//substr($this->input->post('td003'),0,4).substr($this->input->post('td003'),5,2).substr(rtrim($this->input->post('td003')),8,2),
		//extract() 函数从数组中将变量导入到当前的符号表。相當於  $td002=$this->input->post('td002');
		//该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
		// if ($this->input->post()){
		//	extract($this->input->post());
		// }
		preg_match_all('/\d/S', $this->input->post('TD003'), $matches);  //處理日期字串
		$TD003 = implode('', $matches[0]);
		preg_match_all('/\d/S', $this->input->post('TD008'), $matches);  //處理日期字串
		$TD008 = implode('', $matches[0]);
		$TD003 = $TD008;

		$TD001 = trim($this->input->post('TD001'));
		$TD002 = trim($this->input->post('TD002'));

		$company = 'YJ';
		$modifier = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');
		$flag = $this->input->post('FLAG') + 1;
		$TD004 = trim($this->input->post('TD004'));
		$TD005 = trim($this->input->post('TD005'));
		$TD006 = trim($this->input->post('TD006'));
		$TD006 = iconv("utf-8", "BIG5", $TD006);
		$TD007 = trim($this->input->post('TD007'));

		$TD009 = trim($this->input->post('TD009'));
		$TD010 = trim($this->input->post('TD010'));

		$sql96 = " update dbo.SFCTD 
					set MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TD003='$TD003', TD004='$TD004', TD005='$TD005',
					TD006='$TD006', TD007='$TD007', TD008='$TD008', TD009='$modifier', TD010='$TD010'
					where TD001='$TD001' and TD002='$TD002'
					";

		$this->db->query($sql96);

		if ($this->input->post()) {
			extract($this->input->post());
		}
		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}

		// $sql97 = " DELETE FROM dbo.SFCTE
		// 			where TE001='$TD001' and TE002='$TD002'
		// 		  ";
		// $this->db->query($sql97);

		if (isset($order_product)) {
			// $vte003 = '0010';   //流水號重新排序
			foreach ($order_product as $key => $val) {
				extract($val);
				// $TE018 = iconv("utf-8", "BIG5", $TE018);
				// if ($TE019) {
				// 	$TE019 = iconv("utf-8", "BIG5", $TE019);
				// }
				// $TE020 = iconv("utf-8", "BIG5", $TE020);
				$TE015 = iconv("utf-8", "BIG5", $TE015);		//備註
				$TD003 = date('Ymd', strtotime($TD003));         //日期處理



				// insert 、updata 有就修改，沒有就新增---------------------------------

				$sql97 = " select * from SFCTE where TE001='$TD001' and TE002='$TD002' and TE003='$TE003' ";
				$query = $this->db->query($sql97);

				if ($query->num_rows() > 0) {
					if ($TD001 == 'D404' || $TD001 == 'D504') {
						$sql98 = " UPDATE dbo.SFCTE 
							SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TE004='$cmsi09d', TE005='$TE005', TE006='$TE006', TE007='$TE007', TE008='$TE008', TE009='$TE009',
								TE010='$TE010', TE012='$TE012', TE013='$TE013', TE014='$TD005', TE015='$TE015', TE017='$TE017', TE022='$TE022', TE023='$TE023', TE024='$TE024',
								TE025='$TE025', TE026='$TE026', TE027='$TE027', TE029='$TE029', TE030='$TE030', TE032='$TE032', TE033='$TE033', TE034='$TE034', TE035='$TE035', 
								TE036='$TE036', TE037='$TE037', TE038='$TE038', TE039='$TE039', TE040='$TE040', TE041='$TE041', TE042='$TE042', TE043='$TE043', TE044='$TE044', TE045='$TE045', 
								TE049='$TE049', TE052='$TE052',
								TE053='$TE053', TE054='$TE054', TE055='$TE055', TE056='$TE056', TE057='$TE057', TE058='$TE058', TE059='$TE059', TE060='$TE060', TE061='$TE061', TE062='$TE062',
								TE063='$TE063', TE064='$TE064'
						   where TE001='$TD001' and TE002='$TD002' and TE003='$TE003'
						 ";

						//invra 異動  配料  明細資料檔---------------------------						

						//過管料=過管料可回收數量-過管料可回收已粉碎+過管料可回收未粉碎+過管料不可回收數量
						//過管料= 過管料可回收数量+過管料不可回收數量，過管料可回收数量是已粉碎和未粉碎的总数量
						// $vra011 = round($TE042 - $TE043 + $TE044 + $TE045, 3);
						$vra011 = round($TE042 + $TE045, 3);
						$vra011 = 0;
						$sql955 = " SELECT * FROM invra WHERE ra006='$TD001' and ra007='$TD002'	and ra008 ='$TE003'	 ";
						$query555 = $this->db->query($sql955);

						if ($query555->num_rows() > 0) {
							$sql95 = " UPDATE dbo.invra
								SET modifier='$modifier', modi_date='$vtoday', flag='$flag', ra001='$TE017', ra004='$TD003', ra011='$vra011', ra016='$TE015', ra017='$TE0333', ra020='$TE042', ra021='$TE045'
									WHERE ra006='$TD001' and ra007='$TD002'	and ra008 ='$TE003'		
									";
							$this->db->query($sql95);
						} else {
							$sql95 = " INSERT INTO dbo.invra
											(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra011, ra014, ra016, ra017, ra020, ra021)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TE017', '$TD003', '-1', '$TD001', '$TD002', '$TE003', 'A205', '$vra011', '3', '$TE015', '$TE0333', '$TE042', '$TE045'); 				
									";
							$this->db->query($sql95);
						}
						//invra 異動明細資料檔---------------------------end
					} else if ($TD001 == 'D403') {	//橡膠
						$sql98 = " UPDATE dbo.SFCTE 
									SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TE004='$cmsi09d', TE005='$TE005', TE006='$TE006', TE007='$TE007', TE008='$TE008', TE009='$TE009',
										TE010='$TE010', TE011='$TE0333', TE012='$TE012', TE013='$TE013', TE014='$TD005', TE015='$TE015', TE017='$TE017', TE022='$TE022', TE023='$TE023', TE024='$TE024',
										TE025='$TE025', TE026='$TE026', TE027='$TE027', TE029='$TE029', TE030='$TE030', TE032='$TE032', TE035='$TE035', TE040='$TE040', TE041='$TE041', TE050='$TE050', 
										TE051='$TE051'
								where TE001='$TD001' and TE002='$TD002' and TE003='$TE003'
								";
						//invra 異動  配料  明細資料檔---------------------------	
						$sql955 = " SELECT * FROM invra WHERE ra006='$TD001' and ra007='$TD002'	and ra008 ='$TE003'	 ";
						$query555 = $this->db->query($sql955);

						if ($query555->num_rows() > 0) {
							$sql95 = " UPDATE dbo.invra
								SET modifier='$modifier', modi_date='$vtoday', flag='$flag', ra001='$TE017', ra004='$TD003', ra016='$TE015', ra017='$TE0333'
									WHERE ra006='$TD001' and ra007='$TD002'	and ra008 ='$TE003'		
									";
							$this->db->query($sql95);
						} else {
							$sql95 = " INSERT INTO dbo.invra
											(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra014, ra016, ra017)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TE017', '$TD003', '-1', '$TD001', '$TD002', '$TE003', 'A203', '3', '$TE015', '$TE0333'); 				
									";
							$this->db->query($sql95);
						}
						//invra 異動明細資料檔---------------------------end
					} else if ($TD001 == 'D503') {	//萬馬力
						$sql98 = " UPDATE dbo.SFCTE 
									SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TE004='$cmsi09d', TE005='$TE005', TE006='$TE006', TE007='$TE007', TE008='$TE008', TE009='$TE009',
										TE010='$TE010', TE012='$TE012', TE013='$TE013', TE014='$TD005', TE015='$TE015', TE017='$TE017', TE022='$TE022', TE023='$TE023', TE024='$TE024',
										TE025='$TE025', TE026='$TE026', TE027='$TE027', TE029='$TE029', TE032='$TE032'
								where TE001='$TD001' and TE002='$TD002' and TE003='$TE003'
								";
						//invra 異動  配料  明細資料檔---------------------------	
						$sql955 = " SELECT * FROM invra WHERE ra006='$TD001' and ra007='$TD002'	and ra008 ='$TE003'	 ";
						$query555 = $this->db->query($sql955);

						if ($query555->num_rows() > 0) {
							$sql95 = " UPDATE dbo.invra
								SET modifier='$modifier', modi_date='$vtoday', flag='$flag', ra001='$TE017', ra004='$TD003', ra016='$TE015', ra017='D503'
									WHERE ra006='$TD001' and ra007='$TD002'	and ra008 ='$TE003'		
									";
							$this->db->query($sql95);
						} else {
							$sql95 = " INSERT INTO dbo.invra
											(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra014, ra016, ra017)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TE017', '$TD003', '-1', '$TD001', '$TD002', '$TE003', 'A203', '3', '$TE015', 'D503'); 				
									";
							$this->db->query($sql95);
						}
						//invra 異動明細資料檔---------------------------end
					} else if ($TD001 == 'D401' || $TD001 == 'D501') {
						$sql98 = " UPDATE dbo.SFCTE 
						SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TE005='$TE005', TE006='$TE006', TE007='$TE007', TE008='$TE008', TE009='$TE009',
							TE010='$TE010', TE014='$TD005', TE015='$TE015', TE017='$TE017',
							TE029='$TE029', TE032='$TE032', TE046='$TE046', TE047='$TE047' 
					   where TE001='$TD001' and TE002='$TD002' and TE003='$TE003'
					 ";
					} else if ($TD001 == 'D402' || $TD001 == 'D502') {

						if ($TD004 == 'CR004') {
							$TD003 = trim($TD003);
							$TE017 = trim($TE017);
							$TE005 = trim($TE005);
							$sql = " SELECT * FROM pclbh WHERE bh001='$TD003' and bh002='$TE017' and bh003='$TE005' ";
							if ($this->db->query($sql)->num_rows() == 0) {
								$sqlin = " INSERT INTO dbo.pclbh 
												(company, creator, usr_group, create_date, flag, bh001, bh002, bh003)
											VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TD003', '$TE017', '$TE005')
											";
								$this->db->query($sqlin);
							}
						}


						// 	$sql98 = " UPDATE dbo.SFCTE 
						// 				SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TE004='$cmsi09d', TE005='$TE005', TE006='$TE006', TE007='$TE007', TE008='$TE008', TE009='$TE009',
						// 					TE010='$TE010', TE011='$TE011', TE012='$TE012', TE013='$TE013', TE014='$TD005', TE015='$TE015', TE017='$TE017', TE022='$TE022', TE023='$TE023', TE024='$TE024',
						// 					TE025='$TE025', TE026='$TE026', TE027='$TE027', TE028='$TE028', TE029='$TE029', TE030='$TE030', TE031='$TE031', TE040='$TE0312', TE041='$TE041', TE049='$TE049'
						// 			where TE001='$TD001' and TE002='$TD002' and TE003='$TE003'
						// 			";

						$sql98 = " UPDATE dbo.SFCTE 
										SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TE004='$cmsi09d', TE005='$TE005', TE006='$TE006', TE007='$TE007', TE008='$TE008', TE009='$TE009',
											TE010='$TE010', TE011='$TE011', TE012='$TE012', TE013='$TE013', TE014='$TD005', TE015='$TE015', TE017='$TE017', TE022='$TE022', TE023='$TE023', TE024='$TE024',
											TE025='$TE025', TE026='$TE026', TE027='$TE027', TE028='$TE028', TE029='$TE029', TE030='$TE030', TE031='$TE031', TE040='$TE0312', TE049='$TE049', TE052='$TE052',
											TE053='$TE053', TE054='$TE054', TE055='$TE055', TE056='$TE056', TE057='$TE057', TE058='$TE058', TE059='$TE059', TE060='$TE060', TE061='$TE061', TE062='$TE062',
											TE063='$TE063', TE064='$TE064', TE065='$TE065', TE041='$TE041'
									where TE001='$TD001' and TE002='$TD002' and TE003='$TE003'
									";
					} else {
						$sql98 = " UPDATE dbo.SFCTE 
						SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TE004='$cmsi09d', TE005='$TE005', TE006='$TE006', TE007='$TE007', TE008='$TE008', TE009='$TE009',
							TE010='$TE010', TE011='$TE011', TE012='$TE012', TE013='$TE013', TE014='$TD005', TE015='$TE015', TE017='$TE017', TE022='$TE022', TE023='$TE023', TE024='$TE024',
							TE025='$TE025', TE026='$TE026', TE027='$TE027', TE028='$TE028', TE029='$TE029', TE030='$TE030', TE031='$TE031', TE040='$TE0312'
					   where TE001='$TD001' and TE002='$TD002' and TE003='$TE003'
					 ";
					}
				} else {
					if ($TD001 == 'D404' || $TD001 == 'D504') {
						$sql98 = " INSERT INTO dbo.SFCTE 
								(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
								TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, TE029, TE030,
								TE032, TE033, TE034, TE035, TE036, TE037, TE038, TE039, TE040, TE041, TE042, TE043, TE044, TE045, TE049,
								TE052, TE053, TE054, TE055, TE056, TE057, TE058, TE059, TE060, TE061, TE062, TE063, TE064)
						VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TD001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
								'$TE012', '$TE013', '$TD005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027',
								'$TE029', '$TE030', '$TE032', '$TE033', '$TE034', '$TE035', '$TE036', '$TE037', '$TE038', '$TE039', '$TE040', '$TE041',
								'$TE042', '$TE043', '$TE044', '$TE045', '$TE049',
								'$TE052', '$TE053', '$TE054', '$TE055', '$TE056', '$TE057', '$TE058', '$TE059', '$TE060', '$TE061', '$TE062', '$TE063', '$TE064'); ";

						//invra 異動  配料  明細資料檔---------------------------

						//過管料=過管料可回收數量-過管料可回收已粉碎+過管料可回收未粉碎+過管料不可回收數量
						//過管料= 過管料可回收数量+過管料不可回收數量，過管料可回收数量是已粉碎和未粉碎的总数量
						// $vra011 = round($TE042 - $TE043 + $TE044 + $TE045, 3);
						$vra011 = round($TE042 + $TE045, 3);
						$vra011 = 0;
						$sql95 = " INSERT INTO dbo.invra
											(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra011, ra014, ra016, ra017, ra020, ra021)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TE017', '$TD003', '-1', '$TD001', '$TD002', '$TE003', 'A205', '$vra011', '3', '$TE015', '$TE0333', '$TE042', '$TE045'); 				
									";
						$this->db->query($sql95);
						//invra 異動明細資料檔---------------------------end
					} else if ($TD001 == 'D403') {	//橡膠

						$sql98 = "  INSERT INTO dbo.SFCTE 
												(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
												TE011,TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, 
												TE029, TE030, TE032, TE035, TE040, TE041, TE050, TE051)
										VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TD001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
												'$TE0333','$TE012', '$TE013', '$TD005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', 
												'$TE029', '$TE030', '$TE032', '$TE035', '$TE040', '$TE041', '$TE050', '$TE051');  ";
						//invra 異動  配料  明細資料檔---------------------------

						$sql95 = " INSERT INTO dbo.invra
											(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra014, ra016, ra017)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TE017', '$TD003', '-1', '$TD001', '$TD002', '$TE003', 'A203', '3', '$TE015', '$TE0333'); 				
									";
						$this->db->query($sql95);
						//invra 異動明細資料檔---------------------------end
					} else if ($TD001 == 'D503') {	//萬馬力

						$sql98 = "  INSERT INTO dbo.SFCTE 
												(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
												TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, 
												TE029, TE032)
										VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TD001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
												'$TE012', '$TE013', '$TD005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', 
												'$TE029', '$TE032');  ";
						//invra 異動  配料  明細資料檔---------------------------

						$sql95 = " INSERT INTO dbo.invra
											(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra014, ra016, ra017)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TE017', '$TD003', '-1', '$TD001', '$TD002', '$TE003', 'A203', '3', '$TE015', 'D503'); 				
									";
						$this->db->query($sql95);
						//invra 異動明細資料檔---------------------------end

					} else if ($TD001 == 'D401' || $TD001 == 'D501') {
						$sql98 = " INSERT INTO dbo.SFCTE 
						(COMPANY, MODIFIER, USR_GROUP, MODI_DATE, FLAG, TE001, TE002, TE003, TE005, TE006, TE007, TE008, TE009, TE010,
						 TE014, TE015, TE017, TE018, TE019, TE020, TE029, TE032, TE046, TE047)
				VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$TD001', '$TD002', '$TE003', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
						 '$TD005', '$TE015', '$TE017', '', '', '', '$TE029', '$TE032', '$TE046', '$TE047'); ";
					} else if ($TD001 == 'D402' || $TD001 == 'D502') {
						// 		$sql98 = " INSERT INTO dbo.SFCTE 
						// 		(COMPANY, MODIFIER, USR_GROUP, MODI_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
						// 		 TE011, TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, TE028, TE029, TE030, TE031, TE040, TE041, TE049)
						// VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$TD001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
						// 		 '$TE011', '$TE012', '$TE013', '$TD005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', '$TE028',
						// 		  '$TE029', '$TE030', '$TE031', '$TE0312', '$TE041', '$TE049'); ";

						$sql98 = " INSERT INTO dbo.SFCTE 
								(COMPANY, MODIFIER, USR_GROUP, MODI_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
								TE011, TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, TE028, TE029, TE030, TE031, TE040, TE041, TE049,
								TE052, TE053, TE054, TE055, TE056, TE057, TE058, TE059, TE060, TE061, TE062, TE063, TE064, TE065)
							VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$TD001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
								'$TE011', '$TE012', '$TE013', '$TD005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', '$TE028',
								'$TE029', '$TE030', '$TE031', '$TE0312', '$TE041',  '$TE049', 
								'$TE052', '$TE053', '$TE054', '$TE055', '$TE056', '$TE057', '$TE058', '$TE059', '$TE060', '$TE061', '$TE062', '$TE063', '$TE064', '$TE065'); ";
					} else {
						$sql98 = " INSERT INTO dbo.SFCTE 
						(COMPANY, MODIFIER, USR_GROUP, MODI_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010,
						 TE011, TE012, TE013, TE014, TE015, TE017, TE018, TE019, TE020, TE022, TE023, TE024, TE025, TE026, TE027, TE028, TE029, TE030, TE031, TE040)
				VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$TD001', '$TD002', '$TE003', '$cmsi09d', '$TE005', '$TE006', '$TE007', '$TE008', '$TE009', '$TE010', 
						 '$TE011', '$TE012', '$TE013', '$TD005', '$TE015', '$TE017', '', '', '', '$TE022', '$TE023', '$TE024', '$TE025', '$TE026', '$TE027', '$TE028',
						  '$TE029', '$TE030', '$TE031', '$TE0312'); ";
					}
				}


				$this->db->query($sql98);
				// insert 、updata 有就修改，沒有就新增-----END----------------------------

				$sql99 = " UPDATE  SFCTE
									SET  SFCTE.TE018 = t.MB002,SFCTE.TE019 = t.MB003,SFCTE.TE020 = t.MB004
								FROM SFCTE c 
									INNER JOIN INVMB t
										ON c.TE017=t.MB001
								WHERE c.TE001 ='$TD001' and c.TE002='$TD002' and c.TE003='$TE003'				
					";
				$this->db->query($sql99);
			}
			// exit;
		}
	}

	//查複製資料是否重複	 
	function seldetail($seg1, $seg2, $seg3)
	{
		$this->db->where('te001', $seg1);
		$this->db->where('te002', $seg2);
		$this->db->where('te003', $seg3);
		$query = $this->db->get('sfcte');
		return $query->num_rows();
	}

	//刪除一筆 	
	function deletef($seg1)
	{
		$this->db->where('td001', $this->uri->segment(4));
		$this->db->where('td002', $this->uri->segment(5));
		$this->db->delete('sfctd');
		$this->db->where('te001', $this->uri->segment(4));
		$this->db->where('te002', $this->uri->segment(5));
		$this->db->delete('sfcte');
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	//刪除一筆細項	
	function deletedetailf($seg1, $seg2, $seg3)
	{
		// $this->db->where('te001', $seg1);
		// $this->db->where('te002', $seg2);
		// $this->db->where('te003', $seg3);
		// $this->db->delete('sfcte');
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }
		// return FALSE;
		//INVLA 異動  配料  明細資料檔---------------------------	

		$sql95 = " DELETE FROM dbo.invra
					WHERE ra006='$seg1' and ra007='$seg2'	and ra008 ='$seg3'		
					";
		$this->db->query($sql95);
		//INVLA 異動明細資料檔---------------------------end

		$sql97 = " DELETE FROM dbo.SFCTE
					where TE001='$seg1' and TE002='$seg2' and TE003='$seg3'
				  ";

		return $this->db->query($sql97);
	}

	//選取刪除多筆   
	function delmutif()
	{
		$seq[] = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		$x = 0;
		$seq1 = ' ';
		$seq2 = ' ';
		$querydelTD = false;
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;
				list($seq1, $seq2) = explode("/", $seq[$x]);
				$seq1;
				$seq2;
				//只要有一筆Y就不能刪除
				// $query6c = $this->db->query("SELECT UPPER(te016) as te0161 FROM sfcte WHERE te001='$seq1' AND te002='$seq2' AND ( UPPER(te016)='Y' or te009>0 ) ");
				$querydelTE = $this->db->query(" DELETE FROM SFCTE WHERE TE001='$seq1' AND TE002='$seq2' ");
				$querydelTD = $this->db->query(" DELETE FROM SFCTD WHERE TD001='$seq1' AND TD002='$seq2' ");

				//INVLA 異動  配料  明細資料檔---------------------------	
				$this->db->query(" DELETE FROM dbo.invra WHERE ra006='$seq1' AND ra007='$seq2' ");
				//INVLA 異動明細資料檔---------------------------end

				// foreach ($query6c->result() as $row) {
				// 	$te0161[] = $row->te0161;
				// }
				// if (isset($te0161[0])) {
				// 	$vte0161 = $te0161[0];
				// } else {
				// 	$vte0161 = 'N';
				// }    //結案碼


				// if ($vte0161 != 'Y') {
				// 	$this->db->where('td001', $seq1);
				// 	$this->db->where('td002', $seq2);
				// 	$this->db->delete('sfctd');
				// 	$this->db->where('te001', $seq1);
				// 	$this->db->where('te002', $seq2);
				// 	$this->db->delete('sfcte');
				// 	$this->session->set_userdata('msg1', "未出貨已刪除");
				// } else {
				// 	$this->session->set_userdata('msg1', "已出貨不可刪除");
				// }
			}
		}
		return $querydelTD;
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }
		// return FALSE;
	}

	//刪除明細一筆新增修改時使用   
	function del_detail()
	{
		$this->db->where('te001', $_POST['del_md001']);
		$this->db->where('te002', $_POST['del_md002']);
		$this->db->where('te003', $_POST['del_md003']);
		$this->db->delete('sfcte');
	}

	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookup_old($select_col = array(), $search_col = array(), $keyword = array(), $limit = 15)
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
		$this->db->select($sel_col)->from('invmb');
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

	//取單號 最大值加1
	function check_title_no($sfci01, $td008)
	{
		preg_match_all('/\d/S', $td008, $matches);  //處理日期字串
		$td008 = implode('', $matches[0]);
		// $this->db->select('MAX(td002) as max_no')
		// 	->from('sfctd')
		// 	->where('td001', $sfci01)
		// 	->like('td008', $td008, "after");

		// $query = $this->db->get();
		$sql98 = " select MAX(TD002) as max_no from SFCTD where TD001='$sfci01' AND TD002 LIKE '$td008%' ";
		$query = $this->db->query($sql98);

		$result = $query->result();

		if (!$result[0]->max_no) {
			return $td008 . "001";
		}

		return $result[0]->max_no + 1;
	}
	function check_vno_no()
	{

		$this->db->select('MAX(id) as max_no')
			->from('invoice');
		//	->where('td039', $td039);
		//	->like('td039', $td039, "after");

		$query = $this->db->get();
		$result = $query->result();

		// if (!$result[0]->max_no){return $td039."001";}

		return $result[0]->max_no;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
