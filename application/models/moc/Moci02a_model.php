<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Moci02a_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//查詢 table 表所有資料	 
	function selbrowse($num, $offset)
	{
		$this->db->select('ta001, ta002, ta003, ta004, ta0011, ta0019,ta020, create_date');
		$this->db->from('mocta');
		//$this->db->order_by('id', 'DESC');                //排序  單欄
		$this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();
		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('mocta');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('ta001', 'ta002', 'ta003', 'ta005', 'ta021', 'ta031', 'ta019', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('ta001, ta002, ta003, ta006,b.mb002 as ta006disp,b.mb003 as ta006disp1, ta015, ta011, a.create_date')
			->from('mocta as a')
			->join('invmb as b', 'a.ta006 = b.mb001 ', 'left')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('mocta');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('moci02a_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['moci02a']['search']);
		}
		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['moci02a']['search']);
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
		$default_order = "ta001 asc,ta002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['moci02a']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['moci02a']['search']['where'];
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

		if (isset($_SESSION['moci02a']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['moci02a']['search']['order'];
		}

		if (!isset($_SESSION['moci02a']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		// $query = $this->db->select('ta001, ta002, ta003,d.mq002, ta006,b.mb002 as ta006disp,b.mb003 as ta006disp1, ta015, ta011, a.create_date')
		// 	->from('mocta as a')
		// 	->join('invmb as b', 'a.ta006 = b.mb001 ', 'left')
		// 	->join('cmsmq as d', 'a.ta001 = d.mq001', 'left')
		// 	->order_by($order);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		// //建構暫存view 1060614 上一頁,下一頁使用
		// $this->construct_view($ret['data']);

		// $query = $this->db->select('ta001, ta002, ta003,d.mq002, ta006,b.mb002 as ta006disp,b.mb003 as ta006disp1, ta015, ta011, a.create_date')
		// 	->from('mocta as a')
		// 	->join('invmb as b', 'a.ta006 = b.mb001 ', 'left')
		// 	->join('cmsmq as d', 'a.ta001 = d.mq001', 'left')
		// 	->order_by($order)
		// 	->limit($limit, $offset);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();

		$vta008 = $this->session->userdata('sysgroup');

		$vsuper = $this->session->userdata('syssuper');

		$sql21 = " select b.me002 as ta008disp,a.* FROM dbo.mocta as a
						LEFT JOIN admme as b on a.ta008=b.me001	
						WHERE ta008 ='$vta008'
					order by ta003 desc ,ta002
					";


		if ($vta008 != '') {

			$arr = explode(";", $vta008);
			$count_vta008 = ($arr[count($arr) - 1]) ? count($arr) : count($arr) - 1;

			$temp_where = ' where ';
			if ($count_vta008 > 0) {
				for ($i = 0; $i < $count_vta008; $i++) {
					if ($i == 0) {
						$temp_where .= " a.ta008 = '" . $arr[$i] . "' ";
					} else {
						$temp_where .= " or a.ta008 = '" . $arr[$i] . "' ";
					}
				}
				$sql21 = " select b.me002 as ta008disp,a.* FROM dbo.mocta as a
								LEFT JOIN admme as b on a.ta008=b.me001	 "
					. $temp_where . " order by ta003 desc ,ta002 ";
			}
		}

		if ($vsuper == 'Y') {
			$sql21 = " select b.me002 as ta008disp,a.* FROM dbo.mocta as a
							LEFT JOIN admme as b on a.ta008=b.me001
						order by ta003 desc ,ta002
					";
		}

		$query = $this->db->query($sql21);
		$ret['data'] = $query->result();


		//儲存sql 語法
		$_SESSION['moci02a']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('mocta as a')
		// 	->join('invmb as b', 'a.ta006 = b.mb001 ', 'left')
		// 	->join('cmsmq as d', 'a.ta001 = d.mq001', 'left');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['moci02a']['search']['where'] = $where;
		$_SESSION['moci02a']['search']['order'] = $order;
		$_SESSION['moci02a']['search']['offset'] = $offset;

		return $ret;
	}

	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data)
	{
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"ta001", "ta002"
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
		$_SESSION['moci02a']['search']['view'] = $view_array;
		$_SESSION['moci02a']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['moci02a']['search']['view']);exit;
	}
	//查詢前置單據用 ()   
	function selonebefore($seq1, $seq2)
	{
		$this->db->select('a.* ,d.mb002 as md001disp,d.mb003 as md001disp1,d.mb004 as md001disp2,b.md001,b.md002,b.md003,b.md004,b.md006,b.md007,b.md008,b.md016,b.md017,c.mb002 as md003disp, c.mb003 as md003disp1, c.mb004 as md003disp2');

		$this->db->from('bommc as a');
		$this->db->join('bommd as b', 'a.mc001 = b.md001  ', 'left'); //沒有不要出現		
		$this->db->join('invmb  as c', 'b.md003 = c.mb001  ', 'left');

		$this->db->join('invmb  as d', 'a.mc001 = d.mb001  ', 'left');
		$this->db->where('a.mc001', $this->uri->segment(4));
		$this->db->order_by('md001 , md002, md003 ');

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
	}

	//查詢修改用 (看資料用)  單別,品號 , 廠別, 庫別, 線別, 加工廠商, 品號,庫别2,幣別
	function selone($seq1, $seq2)
	{
		// $this->db->select('a.* ,a.ta034 as ta006disp,a.ta035 as ta006disp1,a.ta007 as ta006disp2,c.mq002 AS ta001disp, d.mb002 AS ta019disp,e.mc002 AS ta020disp, g.ma002 AS ta032disp,j.mq002 as ta026disp
		//   ,h.mc002 AS tb009disp,i.mf002 as ta042disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		//   b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016, b.tb017, b.tb018,b.tb019,b.tb020,b.tb021');

		// $this->db->from('mocta as a');
		// $this->db->join('moctb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ', 'left');
		// $this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="51" ', 'left');
		// $this->db->join('cmsmb as d', 'a.ta019 = d.mb001 ', 'left');
		// $this->db->join('cmsmc as e', 'a.ta020 = e.mc001 ', 'left');
		// $this->db->join('cmsmd as f', 'a.ta021 = f.md001 ', 'left');
		// $this->db->join('purma as g', 'a.ta032 = g.ma001 ', 'left');
		// $this->db->join('cmsmc as h', 'b.tb009 = h.mc001 ', 'left');
		// $this->db->join('cmsmf as i', 'a.ta042 = i.mf001 ', 'left');
		// $this->db->join('cmsmq as j', 'a.ta026 = j.mq001 and j.mq003="22"', 'left');
		// $this->db->where('a.ta001', $seq1);
		// $this->db->where('a.ta002', $seq2);
		// $this->db->order_by('ta001 , ta002 ,b.tb003');

		// $query = $this->db->get();

		$sql98 = " select a.*, b.MQ002 as ta001disp, a.ta006 as ta006disp, me001, me002
							from mocta as a
						left join CMSMQ as b on a.ta001 = b.MQ001
						left join admme as c on a.ta008 = c.me001
					where a.ta001 ='$seq1' and a.ta002='$seq2' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() <= 0) {
			return "no_data";
		}

		$result['title_data'] = $query->result();

		// $this->db->select('b.*,i.mc002 as tb009disp,k.mw002 as tb006disp')
		// 	->from('moctb as b')
		// 	->join('cmsmc as i', 'b.tb009 = i.mc001 ', 'left')   //庫別
		// 	->join('cmsmw as k', 'b.tb006 = k.mw001 ', 'left')   //製程
		// 	->where('b.tb001', $seq1)
		// 	->where('b.tb002', $seq2);
		// $query = $this->db->get();

		$sql99 = " select a.*,b.MC002 as tb009disp, c.MB002 as tb012, c.MB003 as tb013, c.MB004 as tb007
							from moctb as a 
						left join CMSMC as b on a.tb009 = b.MC001
						left join INVMB as c on a.tb003 = c.MB001
					where a.tb001 ='$seq1' and a.tb002='$seq2' 
					order by a.tb008
					";
		$query = $this->db->query($sql99);

		if ($query->num_rows() <= 0) {
			$result['body_data'] = array();
			return $result;
		}

		$result['body_data'] = $query->result();

		return $result;
	}

	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	規格單位庫別代號名稱
	function lookup($keyword)
	{
		$this->db->select('mb001, mb002, mb003,mb004,mb017,b.mc002 as mb017disp');
		$this->db->from('invmb as a');
		$this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ', 'left');
		$this->db->like('mb001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('mb002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('15');
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword)
	{
		$this->db->select('mc001, mc002')->from('cmsmc');
		$this->db->like('mc001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('mc002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('15');
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 查詢 顯示 請購單別 tb001	
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

	//ajax 查詢顯示用 廠別 ta010  
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

	//ajax 查詢 顯示用 製令單號	
	function ajaxchkno1($seg1)
	{
		$this->db->select_max('ta002');
		$this->db->where('ta001', $this->uri->segment(4));
		$this->db->where('ta003', $this->uri->segment(5));
		$query = $this->db->get('mocta');
		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->ta002;
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
		$seq11 = "SELECT COUNT(*) as count  FROM `mocta` ";
		$seq1 = "ta001, ta002, ta003, ta004, ta005, ta006,ta007,ta08,ta010,ta011,ta021,ta031,ta019,ta015, create_date FROM `mocta` ";
		$seq2 = "WHERE `a.create_date` >=' ' ";
		$seq32 = "`a.create_date` >='' ";
		$seq33 = 'ta001 desc';
		$seq9 = " ORDER BY ta001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`a.create_date` >='' ";
		// $seq5=$this->session->userdata('find05');
		// $seq7=$this->session->userdata('find07');
		$seq7 = "ta001 ";

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
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta005', 'ta006', 'ta007', 'ta008', 'ta010', 'ta011', 'ta021', 'ta031', 'ta019', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('ta001, ta002,d.mq002, ta003, ta004, ta006,b.ma002 as ta006disp,b.ma003 as ta006disp1,b.ma004 as ta006disp2,ta015,ta011, a.create_date')
			->from('mocta as a')
			->join('purma as b', 'a.ta006 = b.ma001 ', 'left')
			->join('cmsmq as d', 'a.ta001 = d.mq001', 'left')
			->where($seq32)
			->order_by($seq33)
			//->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('mocta as a')
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
		$sort_columns = array('ta001', 'ta002', 'ta003', 'ta005', 'ta021', 'ta031', 'ta019', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
		$this->db->select('ta001, ta002,d.mq002, ta003, ta006,b.ma002 as ta006disp,b.ma003 as ta006disp1,b.ma004 as ta006disp2, ta015, ta011, a.create_date');
		$this->db->from('mocta as a');
		$this->db->join('purma as b', 'a.ta006 = b.ma001 ', 'left');
		$this->db->join('cmsmq as d', 'a.ta001 = d.mq001', 'left');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		//$this->db->order_by('ta001 asc, ta002 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();

		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('mocta');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//查新增資料是否重複 (單頭)  
	function selone1($seg1, $seg2)
	{
		// $this->db->where('ta001', $seg1);
		// $this->db->where('ta002', $seg2);
		// $query = $this->db->get('mocta');
		$sql98 = " select * from mocta where ta001='$seg1' and ta002='$seg2' ";
		$query = $this->db->query($sql98);
		return $query->num_rows();
	}

	//查新增資料是否重複 (單身)	
	function selone1d($seg1)
	{
		$this->db->where('tb001', $this->input->post('mocq01a51'));
		$this->db->where('tb002', $this->input->post('ta002'));
		$query = $this->db->get('moctb');
		return $query->num_rows();
	}
	//查新增資料是否重複 (庫別)	
	function selone2d($seg1, $seg2)
	{
		$this->db->where('mc001', $seg1);
		$this->db->where('mc002', $seg2);
		$query = $this->db->get('invmc');
		return $query->num_rows();
	}

	//查採購單是否存在 	
	function selone3d($seg1, $seg2, $seg3)
	{
		$this->db->where('tb001', $seg1);
		$this->db->where('tb002', $seg2);
		$this->db->where('tb003', $seg3);
		$query = $this->db->get('moctb');
		return $query->num_rows();
	}

	//新增一筆 檔頭  mocta	
	function insertf()    //新增一筆 檔頭  mocta
	{
		preg_match_all('/\d/S', $this->input->post('ta003'), $matches);  //處理日期字串
		$ta003 = implode('', $matches[0]);				//開單日期
		// preg_match_all('/\d/S', $this->input->post('ta004'), $matches);  //處理日期字串
		// $ta004 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta009'), $matches);  //處理日期字串
		// $ta009 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta010'), $matches);  //處理日期字串
		// $ta010 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta012'), $matches);  //處理日期字串
		// $ta012 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta014'), $matches);  //處理日期字串
		// $ta014 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta040'), $matches);  //處理日期字串
		// $ta040 = implode('', $matches[0]);
		$ta001 = trim($this->input->post('ta001'));			//單別
		$TA002 = trim($this->input->post('ta002'));			//單號
		// $ta002no = $ta002;   //明細用再新增一筆時加1
		//檢查資料是否已存在 若存在加1
		// while ($this->moci02a_model->selone1($ta001, $ta002) > 0) {
		$TA002 = $this->check_title_no($ta001, $ta003);
		// $ta002no = $ta002;
		// }

		$company = 'YJ';
		$creator = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');

		$ta006 = trim($this->input->post('ta006'));		//產品品號
		$ta007 = '';									//單位

		$ta008 = trim($this->input->post('ta008'));		//群組	
		$ta011 = 'Y';									//狀態碼
		$ta015 = round(trim($this->input->post('ta015')), 3);		//成本
		$ta016 = round(trim($this->input->post('ta016')), 3);		//重量
		$ta017 = trim($this->input->post('ta017'));		//產量
		$ta019 = 'DY';									//廠別代號
		$ta020 = trim($this->input->post('ta020'));		//入庫庫別
		$ta029 = trim($this->input->post('ta029'));		//備註
		$ta029 = iconv("utf-8", "BIG5", $ta029);		//備註 轉換big5

		$ta034 = '';									//產品品名
		$ta035 = '';									//產品規格
		$ta040 = $vtoday;								//確認日
		$ta041 = $creator;								//確認者
		$ta049 = 'N';									//簽核狀態碼


		$sql = " INSERT INTO dbo.mocta
				(company, creator, usr_group, create_date, flag, ta001, ta002, ta003, ta006, ta007, ta008, ta011, ta015, ta016, ta017, ta019, ta020, ta029, ta034, ta035, ta040, ta041, ta049)
		VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$ta001', '$TA002', '$ta003', '$ta006', '$ta007', '$ta008', '$ta011', '$ta015', '$ta016', '$ta017', '$ta019', '$ta020', '$ta029', '$ta034', '$ta035'
				, '$ta040', '$ta041', '$ta049'); ";

		$this->db->query($sql);

		//更新 品名、規格、單位------------------------------
		$sql01 = " UPDATE  mocta
								SET  mocta.ta034 = t.MB002,mocta.ta035 = t.MB003,mocta.ta007 = t.MB004
							FROM mocta c 
								INNER JOIN INVMB t
									ON c.ta006=t.MB001
							WHERE c.ta001 ='$ta001' and c.ta002='$TA002'				
							";
		$this->db->query($sql01);
		//更新 品名、規格、單位------------------------------end

		//生產入庫單頭檔---------------------------------
		$sql88 = " INSERT INTO dbo.MOCTF
							(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TF001, TF002, TF003, TF004, TF005, TF006, TF007, TF008, TF009, TF010, TF011, TF012, TF013, TF014)
					VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', 'I13', '$TA002', '$ta003', '$ta019', '$ta029', 'Y', 'N', '0', 'N', 'N', '', '$ta003', '$ta041', 'N'); 
					";

		$this->db->query($sql88);
		//生產入庫單頭檔---------------------------------end

		//生產入庫單身檔---------------------------------
		$sql91 = " INSERT INTO dbo.MOCTG 
		(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TG001, TG002, TG003, TG004, TG005, TG006, TG007, TG008, TG009, TG010,
				TG011, TG012, TG013, TG014, TG015, TG016, TG017, TG018, TG019, TG020, TG021, TG022, TG023, TG024)
		VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', 'I13', '$TA002', '0001', '$ta006', '', '', '', '', '1', '$ta020', 
				'$ta016', '0', '$ta016', '', '', 'Y', '', '', '', '$ta029', '', 'Y', '0', 'N');
		";

		$this->db->query($sql91);

		$sql92 = " UPDATE  MOCTG
						SET  MOCTG.TG005 = t.MB002,MOCTG.TG006 = t.MB003,MOCTG.TG007 = t.MB004
					FROM MOCTG c 
						INNER JOIN INVMB t
							ON c.TG004=t.MB001
					WHERE c.TG001 ='I13' and c.TG002='$TA002'				
					";
		$this->db->query($sql92);
		//生產入庫單身檔---------------------------------end

		if (substr($ta006, 0, 2) == 'IM') { //注塑車間
			$vLA009 = 'A205';
		} else if (substr($ta006, 0, 2) == 'CR') {	//鑄造車間
			$vLA009 = 'A202';
		} else if (substr($ta006, 0, 2) == 'RW') {	//橡膠車間
			$vLA009 = 'A203';
		} else if (substr($ta006, 0, 2) == 'PU') {	//PU車間
			$vLA009 = 'A204';
		} else if (substr($ta006, 0, 2) == 'FW') {	//緊固件車間
			$vLA009 = 'A207';
		} else if (substr($ta006, 0, 2) == 'AW') {	//裝配車間
			$vLA009 = 'A208';
		} else if (substr($ta006, 0, 2) == 'DS') {	//模具車間
			$vLA009 = 'A201';
		} else {
			$vLA009 = '';
		}

		//INVLA 異動明細資料檔---------------------------
		$sql93 = " INSERT INTO dbo.INVLA
						(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, LA001, LA004, LA005, LA006, LA007, LA008, LA009, LA010, LA011, LA014, LA015)
				VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$ta006', '$ta003', '1', 'I13', '$TA002', '0001', '$vLA009', '$ta029', '$ta016', '1', 'Y'); 				
				";
		$this->db->query($sql93);
		//INVLA 異動明細資料檔---------------------------end

		//INVLA 異動  配料  明細資料檔---------------------------
		$sql95 = " INSERT INTO dbo.invra
						(company, creator, usr_group, create_date, flag, ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra010, ra011, ra012, ra014, ra016)
				VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$ta006', '$ta003', '1', 'I11', '$TA002', '0001', '$vLA009', '$ta016', '0', '$ta015', '1', '$ta029'); 				
				";
		$this->db->query($sql95);
		//INVLA 異動明細資料檔---------------------------end

		//領料單頭檔---------------------------------
		$sql89 = " INSERT INTO dbo.MOCTC
							(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TC001, TC002, TC003, TC004, TC007, TC008, TC009, TC010, TC011, TC012, TC013, TC014, TC015, TC016)
					VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', 'I12', '$TA002', '$ta003', '$ta019', '$ta029', '54', 'Y', '0', 'N', '1', 'Y', '$ta003', '$ta041', 'N'); 
					";

		$this->db->query($sql89);
		//領料單頭檔---------------------------------end

		if ($this->input->post()) {
			extract($this->input->post());
		}

		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}

		if (isset($order_product)) {
			// 新增明細 moctb
			// $vtb008 = '1010';   //流水號重新排序
			foreach ($order_product as $key => $val) {
				if ($val['tb008'] && $val['tb003']) {
					extract($val);
					//preg_match_all('/\d/S',$tb012, $matches);  //處理日期字串
					//$tb012 = implode('',$matches[0]);
					$tb007 = iconv("utf-8", "BIG5", $tb007);		//單位

					$sql98 = " INSERT INTO dbo.moctb 
				(company, creator, usr_group, create_date, flag, tb001, tb002, tb003, tb005, tb006, tb007, tb008, tb009, tb017)
		VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$ta001', '$TA002', '$tb003', '$tb005', '', '$tb007', '$tb008', '$tb009', '$tb017'); 
				 ";

					$this->db->query($sql98);


					//領料單身檔---------------------------------
					$sql90 = " INSERT INTO dbo.MOCTE
								(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010, TE011, TE012, TE013, TE014, TE015, TE016, TE017, TE018, TE019)
						VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', 'I12', '$TA002', '$tb008', '$tb003', '$tb005', '', '', '$tb009', '****', '', '', '', '', '$tb017', '', '1', '', '', 'Y'); 
						";

					$this->db->query($sql90);

					$sql95 = " UPDATE  MOCTE
								SET  MOCTE.TE017 = t.MB002,MOCTE.TE018 = t.MB003,MOCTE.TE006 = t.MB004
							FROM MOCTE c 
								INNER JOIN INVMB t
									ON c.TE004=t.MB001
							WHERE c.TE001 ='I12' and c.TE002='$TA002' and c.TE003='$tb008'				
							";
					$this->db->query($sql95);


					//領料單身檔---------------------------------end

					//INVLA 異動明細資料檔---------------------------
					preg_match_all('/\d/S', $this->input->post('ta003'), $matches);  //處理日期字串
					$ta003 = implode('', $matches[0]);				//開單日期
					$vla010 = '';
					$sql93 = " INSERT INTO dbo.INVLA
								(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, LA001, LA004, LA005, LA006, LA007, LA008, LA009, LA010, LA011, LA014, LA015)
						VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$tb003', '$ta003', '-1', 'I12', '$TA002', '$tb008', '$tb009', '$vla010', '$tb005', '3', 'Y'); 				
						";
					$this->db->query($sql93);
					//INVLA 異動明細資料檔---------------------------end


					// foreach ($val as $k => $v) {
					// 	if ($k != "tb001" && $k != "tb002" && $k != "tb009disp" && $k != "tb006disp") { //主鍵不用更改以及其他外來鍵庫別名稱
					// 		if ($k == "tb008") {
					// 			$data[$k] = $vtb008;
					// 		} else {
					// 			$data[$k] = $v;
					// 		}
					// 	}
					// }
					// $this->db->insert('moctb', $data);
					// $mtb008 = (int) $vtb008 + 10;
					// $vtb008 =  (string)$mtb008;
				}
			}
		}
	}
	function auto_print($seg1, $seg2)
	{
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001", $seg1);
		$query = $this->db->get();
		$tmp = $query->result();
		if (@$tmp[0]->mq016 == "Y") {
			echo "<script>window.open('printbb/" . $seg1 . "/" . $seg2 . ".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}
	//查複製資料是否重複	 
	function selone2($seq1, $seq2)
	{
		$this->db->where('ta001', $this->input->post('ta001c'));
		$this->db->where('ta002', $this->input->post('ta002c'));
		$query = $this->db->get('mocta');
		return $query->num_rows();
	}

	//複製前置單據	
	function copybefore()
	{
		$this->db->where('ta001', $this->input->post('ta001o'));
		$this->db->where('ta002', $this->input->post('ta002o'));
		$query = $this->db->get('mocta');
		$exist = $query->num_rows();
		if (!$exist) {
			return 'exist';
		}
		//   if ($query->num_rows() != 1) { return 'exist'; }
		if ($query->num_rows() == 1) {
			$result = $query->result();
			foreach ($result as $row) :
				$ta003 = $row->ta003;
				$ta004 = $row->ta004;
				$ta005 = $row->ta005;
				$ta006 = $row->ta006;
				$ta007 = $row->ta007;
				$ta008 = $row->ta008;
				$ta009 = $row->ta009;
				$ta010 = $row->ta010;
				$ta011 = $row->ta011;
				$ta012 = $row->ta012;
				$ta013 = $row->ta013;
				$ta014 = $row->ta014;
				$ta015 = $row->ta015;
				$ta016 = $row->ta016;
				$ta017 = $row->ta017;
				$ta018 = $row->ta018;
				$ta019 = $row->ta019;
				$ta020 = $row->ta020;
				$ta021 = $row->ta021;
				$ta022 = $row->ta022;
				$ta023 = $row->ta023;
				$ta024 = $row->ta024;
				$ta025 = $row->ta025;
				$ta026 = $row->ta026;
				$ta027 = $row->ta027;
				$ta028 = $row->ta028;
				$ta029 = $row->ta029;
				$ta030 = $row->ta030;
			endforeach;
		}

		$seq1 = $this->input->post('ta001c');    //主鍵一筆檔頭mocta
		$seq2 = $this->input->post('ta002c');
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
			'ta001' => $seq1, 'ta002' => $seq2, 'ta003' => $ta003, 'ta004' => $ta004, 'ta005' => $ta005, 'ta006' => $ta006, 'ta007' => $ta007, 'ta008' => $ta008, 'ta009' => $ta009, 'ta010' => $ta010,
			'ta011' => $ta011, 'ta012' => $ta012, 'ta013' => $ta013, 'ta014' => $ta014, 'ta015' => $ta015, 'ta016' => $ta016, 'ta017' => $ta017,
			'ta018' => $ta018, 'ta019' => $ta019, 'ta020' => $ta020, 'ta021' => $ta021, 'ta022' => $ta022, 'ta023' => $ta023, 'ta024' => $ta024,
			'ta025' => $ta025, 'ta026' => $ta026, 'ta027' => $ta027, 'ta028' => $ta028, 'ta029' => $ta029, 'ta030' => $ta030
		);

		$exist = $this->moci02a_model->selone2($this->input->post('ta001c'), $this->input->post('ta002c'));
		if ($exist) {
			return 'exist';
		}
		$this->db->insert('mocta', $data);      //複製一筆  

		//複製一筆明細
		$this->db->where('tb001', $this->input->post('ta001o'));
		$this->db->where('tb002', $this->input->post('ta002o'));
		$query = $this->db->get('moctb');
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
				$tb003[$i] = $row->tb003;
				$tb004[$i] = $row->tb004;
				$tb005[$i] = $row->tb005;
				$tb006[$i] = $row->tb006;
				$tb007[$i] = $row->tb007;
				$tb008[$i] = $row->tb008;
				$tb009[$i] = $row->tb009;
				$tb010[$i] = $row->tb010;
				$tb011[$i] = $row->tb011;
				$tb012[$i] = $row->tb012;
				$tb013[$i] = $row->tb013;
				$tb014[$i] = $row->tb014;
				$tb015[$i] = $row->tb015;
				$tb016[$i] = $row->tb016;
				$tb017[$i] = $row->tb017;
				$tb018[$i] = $row->tb018;
				$tb019[$i] = $row->tb019;
				$tb020[$i] = $row->tb020;
				$tb021[$i] = $row->tb021;
				$i++;
			endforeach;
		}
		$seq1 = $this->input->post('ta001c');    //主鍵一筆明細moctb
		$seq2 = $this->input->post('ta002c');
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
				'tb001' => $seq1, 'tb002' => $seq2, 'tb003' => $tb003[$i], 'tb004' => $tb004[$i], 'tb005' => $tb005[$i], 'tb006' => $tb006[$i], 'tb007' => $tb007[$i],
				'tb008' => $tb008[$i], 'tb009' => $tb009[$i], 'tb010' => $tb010[$i], 'tb011' => $tb011[$i], 'tb012' => $tb012[$i], 'tb013' => $tb013[$i],
				'tb014' => $tb014[$i], 'tb015' => $tb015[$i], 'tb016' => $tb016[$i], 'tb017' => $tb017[$i], 'tb018' => $tb018[$i], 'tb019' => $tb019[$i],
				'tb020' => $tb020[$i], 'tb021' => $tb021[$i]
			);

			$this->db->insert('moctb', $data_array);      //複製一筆 
			$i++;
		}
		return true;
	}
	//複製一筆	
	function copyf()
	{
		$this->db->where('ta001', $this->input->post('ta001o'));
		$this->db->where('ta002', $this->input->post('ta002o'));
		$query = $this->db->get('mocta');
		$exist = $query->num_rows();
		if (!$exist) {
			return 'exist';
		}
		//   if ($query->num_rows() != 1) { return 'exist'; }
		if ($query->num_rows() == 1) {
			$result = $query->result();
			foreach ($result as $row) :
				$ta003 = $row->ta003;
				$ta004 = $row->ta004;
				$ta005 = $row->ta005;
				$ta006 = $row->ta006;
				$ta007 = $row->ta007;
				$ta008 = $row->ta008;
				$ta009 = $row->ta009;
				$ta010 = $row->ta010;
				$ta011 = $row->ta011;
				$ta012 = $row->ta012;
				$ta013 = $row->ta013;
				$ta014 = $row->ta014;
				$ta015 = $row->ta015;
				$ta016 = $row->ta016;
				$ta017 = $row->ta017;
				$ta018 = $row->ta018;
				$ta019 = $row->ta019;
				$ta020 = $row->ta020;
				$ta021 = $row->ta021;
				$ta022 = $row->ta022;
				$ta023 = $row->ta023;
				$ta024 = $row->ta024;
				$ta025 = $row->ta025;
				$ta026 = $row->ta026;
				$ta027 = $row->ta027;
				$ta028 = $row->ta028;
				$ta029 = $row->ta029;
				$ta030 = $row->ta030;
				$ta031 = $row->ta031;
				$ta032 = $row->ta032;
				$ta033 = $row->ta033;
				$ta034 = $row->ta034;
				$ta035 = $row->ta035;
				$ta036 = $row->ta036;
				$ta037 = $row->ta037;
				$ta038 = $row->ta038;
				$ta039 = $row->ta039;
				$ta040 = $row->ta040;
				$ta041 = $row->ta041;
				$ta042 = $row->ta042;
				$ta043 = $row->ta043;
				$ta044 = $row->ta044;
				$ta045 = $row->ta045;
				$ta046 = $row->ta046;
				$ta047 = $row->ta047;
				$ta048 = $row->ta048;
				$ta049 = $row->ta049;
			endforeach;
		}

		$seq1 = $this->input->post('ta001c');    //主鍵一筆檔頭mocta
		$seq2 = $this->input->post('ta002c');
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
			'ta001' => $seq1, 'ta002' => $seq2, 'ta003' => $ta003, 'ta004' => $ta004, 'ta005' => $ta005, 'ta006' => $ta006, 'ta007' => $ta007, 'ta008' => $ta008, 'ta009' => $ta009, 'ta010' => $ta010,
			'ta011' => $ta011, 'ta012' => $ta012, 'ta013' => $ta013, 'ta014' => $ta014, 'ta015' => $ta015, 'ta016' => $ta016, 'ta017' => $ta017,
			'ta018' => $ta018, 'ta019' => $ta019, 'ta020' => $ta020, 'ta021' => $ta021, 'ta022' => $ta022, 'ta023' => $ta023, 'ta024' => $ta024,
			'ta025' => $ta025, 'ta026' => $ta026, 'ta027' => $ta027, 'ta028' => $ta028, 'ta029' => $ta029, 'ta030' => $ta030,
			'ta031' => $ta031, 'ta032' => $ta032, 'ta033' => $ta033, 'ta034' => $ta034, 'ta035' => $ta035, 'ta036' => $ta036, 'ta037' => $ta037,
			'ta038' => $ta038, 'ta039' => $ta039, 'ta040' => $ta040, 'ta041' => $ta041, 'ta042' => $ta042, 'ta043' => $ta043,
			'ta044' => $ta044, 'ta045' => $ta045, 'ta046' => $ta046, 'ta047' => $ta047, 'ta048' => $ta048, 'ta049' => $ta049
		);

		$exist = $this->moci02a_model->selone2($this->input->post('ta001c'), $this->input->post('ta002c'));
		if ($exist) {
			return 'exist';
		}
		$this->db->insert('mocta', $data);      //複製一筆  

		//複製一筆明細
		$this->db->where('tb001', $this->input->post('ta001o'));
		$this->db->where('tb002', $this->input->post('ta002o'));
		$query = $this->db->get('moctb');
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
				$tb003[$i] = $row->tb003;
				$tb004[$i] = $row->tb004;
				$tb005[$i] = $row->tb005;
				$tb006[$i] = $row->tb006;
				$tb007[$i] = $row->tb007;
				$tb008[$i] = $row->tb008;
				$tb009[$i] = $row->tb009;
				$tb010[$i] = $row->tb010;
				$tb011[$i] = $row->tb011;
				$tb012[$i] = $row->tb012;
				$tb013[$i] = $row->tb013;
				$tb014[$i] = $row->tb014;
				$tb015[$i] = $row->tb015;
				$tb016[$i] = $row->tb016;
				$tb017[$i] = $row->tb017;
				$tb018[$i] = $row->tb018;
				$tb019[$i] = $row->tb019;
				$tb020[$i] = $row->tb020;
				$tb021[$i] = $row->tb021;
				$i++;
			endforeach;
		}
		$seq1 = $this->input->post('ta001c');    //主鍵一筆明細moctb
		$seq2 = $this->input->post('ta002c');
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
				'tb001' => $seq1, 'tb002' => $seq2, 'tb003' => $tb003[$i], 'tb004' => $tb004[$i], 'tb005' => $tb005[$i], 'tb006' => $tb006[$i], 'tb007' => $tb007[$i],
				'tb008' => $tb008[$i], 'tb009' => $tb009[$i], 'tb010' => $tb010[$i], 'tb011' => $tb011[$i], 'tb012' => $tb012[$i], 'tb013' => $tb013[$i],
				'tb014' => $tb014[$i], 'tb015' => $tb015[$i], 'tb016' => $tb016[$i], 'tb017' => $tb017[$i], 'tb018' => $tb018[$i], 'tb019' => $tb019[$i],
				'tb020' => $tb020[$i], 'tb021' => $tb021[$i]
			);

			$this->db->insert('moctb', $data_array);      //複製一筆 
			$i++;
		}
		return true;
	}
	//轉excel檔   
	function excelnewf()
	{

		$seq1 = $this->input->post('ta001o');
		$seq2 = $this->input->post('ta001c');
		$seq3 = $this->input->post('ta002o');
		$seq4 = $this->input->post('ta002c');
		$sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta032,a.ta015,a.ta006,c.mb002 as ta006disp,c.mb003 as ta006disp1,a.ta007,
		           b.tb008,b.tb003,b.tb012,b.tb013,b.tb007,b.tb004,b.tb005,b.tb016
		       FROM mocta as a LEFT JOIN moctb as b ON  a.ta001=b.tb001 and a.ta002=b.tb002 and  a.ta001 >= '$seq1'  AND a.ta001 <= '$seq2' AND a.ta002 >= '$seq3'  AND a.ta002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.ta006=c.mb001 ";
		//	  FROM mocta as a, moctb as b WHERE ta001=tb001 and ta002=tb002 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('ta001o');
		$seq2 = $this->input->post('ta001c');
		$seq3 = $this->input->post('ta002o');
		$seq4 = $this->input->post('ta002c');
		$sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta032,a.ta006,c.mb002 as ta006disp, c.mb003 as ta006disp1,a.ta007,
		              b.tb008,b.tb003,b.tb012,b.tb013,b.tb007,b.tb004,b.tb005,b.tb016
		  FROM mocta as a left join moctb as b on a.ta001=b.tb001 and a.ta002=b.tb002 and  a.ta001 >= '$seq1'  AND a.ta001 <= '$seq2' AND a.ta002 >= '$seq3'  AND a.ta002 <= '$seq4' 
		                  left join invmb as c on a.ta006=c.mb001  ";

		//	  FROM mocta as a, moctb as b WHERE ta001=tb001 and ta002=tb002 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();
		$seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('mocta')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//選取印單據筆	
	function printfd1()
	{
		$this->db->select('a.* ,c.mq002 AS ta001disp, d.me002 AS ta004disp, e.mb002 AS ta010disp, f.mv002 AS ta012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb011, b.tb009, b.tb017, b.tb018, b.tb012');

		$this->db->from('mocta as a');
		$this->db->join('moctb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ', 'left');
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="31" ', 'left');
		$this->db->join('cmsme as d', 'a.ta004 = d.me001 ', 'left');
		$this->db->join('cmsmb as e', 'a.ta010 = e.mb001 ', 'left');
		$this->db->join('cmsmv as f ', 'a.ta012 = f.mv001 and f.mv022 = " " ', 'left');
		$this->db->where('a.ta001', $this->uri->segment(4));
		$this->db->where('a.ta002', $this->uri->segment(5));
		$this->db->order_by('ta001 , ta002 ,b.tb003');

		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1 = $this->uri->segment(4);
		$seq2 = $this->uri->segment(5);
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
		$query = $this->db->get('moctb');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//印單據筆   
	function printfc()
	{
		$this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta019disp,e.mc002 AS ta020disp, g.ma002 AS ta032disp,j.mq002 as ta026disp
		  ,h.mc002 AS tb009disp,i.mf002 as ta042disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016, b.tb017, b.tb018,b.tb019,b.tb020,b.tb021');

		$this->db->from('mocta as a');
		$this->db->join('moctb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ', 'left');
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="51" ', 'left');
		$this->db->join('cmsmb as d', 'a.ta019 = d.mb001 ', 'left');
		$this->db->join('cmsmc as e', 'a.ta020 = e.mc001 ', 'left');
		$this->db->join('cmsmd as f', 'a.ta021 = f.md001 ', 'left');
		$this->db->join('purma as g', 'a.ta032 = g.ma001 ', 'left');
		$this->db->join('cmsmc as h', 'b.tb009 = h.mc001 ', 'left');
		$this->db->join('cmsmf as i', 'a.ta042 = i.mf001 ', 'left');
		$this->db->join('cmsmq as j', 'a.ta026 = j.mq001 and j.mq003="22"', 'left');
		$this->db->where('a.ta001', $this->input->post('ta001o'));
		$this->db->where('a.ta002', $this->input->post('ta002o'));
		$this->db->order_by('ta001 , ta002 ,b.tb003');

		$query = $this->db->get();
		$result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
			return $result;
		}
	}

	//印單據筆  
	function printfb()
	{
		$this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta019disp,e.mc002 AS ta020disp, g.ma002 AS ta032disp,j.mq002 as ta026disp
		  ,h.mc002 AS tb009disp,i.mf002 as ta042disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016, b.tb017, b.tb018,b.tb019,b.tb020,b.tb021');

		$this->db->from('mocta as a');
		$this->db->join('moctb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ', 'left');
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="51" ', 'left');
		$this->db->join('cmsmb as d', 'a.ta019 = d.mb001 ', 'left');
		$this->db->join('cmsmc as e', 'a.ta020 = e.mc001 ', 'left');
		$this->db->join('cmsmd as f', 'a.ta021 = f.md001 ', 'left');
		$this->db->join('purma as g', 'a.ta032 = g.ma001 ', 'left');
		$this->db->join('cmsmc as h', 'b.tb009 = h.mc001 ', 'left');
		$this->db->join('cmsmf as i', 'a.ta042 = i.mf001 ', 'left');
		$this->db->join('cmsmq as j', 'a.ta026 = j.mq001 and j.mq003="22"', 'left');
		$this->db->where('a.ta001', $this->uri->segment(4));
		$this->db->where('a.ta002', $this->uri->segment(5));
		$this->db->order_by('ta001 , ta002 ,b.tb003');

		$query = $this->db->get();
		$result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
			return $result;
		}
	}

	//更改一筆	
	function updatef()
	{
		preg_match_all('/\d/S', $this->input->post('ta003'), $matches);  //處理日期字串
		$ta003 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta004'), $matches);  //處理日期字串
		// $ta004 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta009'), $matches);  //處理日期字串
		// $ta009 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta010'), $matches);  //處理日期字串
		// $ta010 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta012'), $matches);  //處理日期字串
		// $ta012 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta014'), $matches);  //處理日期字串
		// $ta014 = implode('', $matches[0]);
		// preg_match_all('/\d/S', $this->input->post('ta040'), $matches);  //處理日期字串
		// $ta040 = implode('', $matches[0]);
		$ta001 = trim($this->input->post('ta001'));			//單別
		$TA002 = trim($this->input->post('ta002'));			//單號

		$company = 'YJ';
		$modifier = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');

		$ta006 = trim($this->input->post('ta006'));		//產品品號
		// $ta007 = '';									//單位

		$ta008 = trim($this->input->post('ta008'));		//群組	
		$ta011 = 'Y';									//狀態碼
		$ta015 = round(trim($this->input->post('ta015')), 3);		//成本
		$ta016 = trim($this->input->post('ta016'));		//重量
		$ta017 = trim($this->input->post('ta017'));		//產量
		$ta019 = 'DY';									//廠別代號
		$ta020 = trim($this->input->post('ta020'));		//入庫庫別
		$ta029 = trim($this->input->post('ta029'));		//備註
		$ta029 = iconv("utf-8", "BIG5", $ta029);		//備註 轉換big5

		// $ta034 = '';									//產品品名
		// $ta035 = '';									//產品規格
		$ta040 = $vtoday;								//確認日
		$ta041 = $modifier;								//確認者
		// $ta049 = 'N';									//簽核狀態碼
		$flag = trim($this->input->post('flag')) + 1;		//flag



		$sql = " UPDATE dbo.mocta
						SET modifier='$modifier', modi_date='$vtoday', flag='$flag', ta003='$ta003', ta006='$ta006', ta008='$ta008', ta016='$ta016', ta017='$ta017', ta019='$ta019', ta020='$ta020', ta029='$ta029', ta040='$ta040', ta041='$ta041' 
				WHERE ta001 ='$ta001' and ta002='$TA002'
		 ";

		$this->db->query($sql);

		//更新 品名、規格、單位------------------------------
		$sql01 = " UPDATE  mocta
								SET  mocta.ta034 = t.MB002,mocta.ta035 = t.MB003,mocta.ta007 = t.MB004
							FROM mocta c 
								INNER JOIN INVMB t
									ON c.ta006=t.MB001
							WHERE c.ta001 ='$ta001' and c.ta002='$TA002'				
							";
		$this->db->query($sql01);
		//更新 品名、規格、單位------------------------------end

		//生產入庫單頭檔---------------------------------
		$sql88 = " UPDATE dbo.MOCTF
							SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TF003='$ta003', TF004='$ta019', TF005='$ta029', TF012='$ta003', TF013='$ta041'
					WHERE TF001 ='I13' and TF002='$TA002'
					";

		$this->db->query($sql88);
		//生產入庫單頭檔---------------------------------end

		//生產入庫單身檔---------------------------------
		$sql91 = " UPDATE dbo.MOCTG 
							SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TG004='$ta006', TG010='$ta020', TG011='$ta016', TG013='$ta016', TG020='$ta029'
							WHERE TG001 ='I13' and TG002='$TA002'
		";

		$this->db->query($sql91);

		$sql92 = " UPDATE  MOCTG
						SET  MOCTG.TG005 = t.MB002,MOCTG.TG006 = t.MB003,MOCTG.TG007 = t.MB004
					FROM MOCTG c 
						INNER JOIN INVMB t
							ON c.TG004=t.MB001
					WHERE c.TG001 ='I13' and c.TG002='$TA002'				
					";
		$this->db->query($sql92);
		//生產入庫單身檔---------------------------------end

		//INVLA 異動明細資料檔---------------------------
		$sql93 = " UPDATE dbo.INVLA
							SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', LA001='$ta006', LA004='$ta003', LA010='$ta029', LA011='$ta016'
					WHERE LA006 ='I13' and LA007='$TA002' and LA008='0001'				
				";
		$this->db->query($sql93);
		//INVLA 異動明細資料檔---------------------------end

		//INVLA 異動  配料  明細資料檔---------------------------
		$sql95 = " UPDATE dbo.invra
						SET modifier='$modifier', modi_date='$vtoday', flag='$flag', ra001='$ta006', ra004='$ta003', ra010='$ta016', ra016='$ta029', ra012='$ta015'
					WHERE ra006 ='I11' and ra007='$TA002' and ra008='0001'					
				";
		$this->db->query($sql95);
		//INVLA 異動明細資料檔---------------------------end

		//領料單頭檔---------------------------------
		$sql89 = " UPDATE dbo.MOCTC
							SET MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TC003='$ta003', TC004='$ta019', TC007='$ta029', TC014='$ta003', TC015='$ta041'
					WHERE TC001 ='I12' and TC002='$TA002'
					";

		$this->db->query($sql89);
		//領料單頭檔---------------------------------end

		if ($this->input->post()) {
			extract($this->input->post());
		}
		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}


		// $this->db->where('tb001', $ta001);
		// $this->db->where('tb002', $ta002);
		// $this->db->delete('moctb'); //刪除明細 1060809 
		//刪除  配料單單身---------------------------
		$sql91 = " DELETE FROM dbo.moctb
						WHERE tb001 ='$ta001' and tb002='$TA002'	
				";
		$this->db->query($sql91);
		//刪除  配料單單身---------------------------END

		//刪除  生產入庫單單身---------------------------
		$sql95 = " DELETE FROM  MOCTG
					WHERE TG001 ='I13' and TG002='$TA002'				
				";
		$this->db->query($sql95);
		//刪除  生產入庫單單身---------------------------END

		//刪除  領料單單身---------------------------
		$sql96 = " DELETE FROM dbo.MOCTE
						WHERE TE001 ='I12' and TE002='$TA002'
				";
		$this->db->query($sql96);
		//刪除  領料單單身---------------------------END


		//刪除  異動明細資料檔---------------------------
		$sql96 = " DELETE FROM dbo.INVLA
						WHERE LA006 ='I12' and LA007='$TA002'
					";
		$this->db->query($sql96);
		//刪除  異動明細資料檔---------------------------END


		if (isset($order_product)) {
			//	$this->db->flush_cache();  
			// 新增明細 moctb
			// $vtb008 = '1010';   //流水號重新排序
			foreach ($order_product as $key => $val) {
				extract($val);
				//preg_match_all('/\d/S',$tb012, $matches);  //處理日期字串
				//$tb012 = implode('',$matches[0]);
				$tb007 = iconv("utf-8", "BIG5", $tb007);		//單位

				$sql98 = " INSERT INTO dbo.moctb 
				(company, modifier, usr_group, modi_date, flag, tb001, tb002, tb003, tb005, tb006, tb007, tb008, tb009, tb017)
		VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$ta001', '$TA002', '$tb003', '$tb005', '', '$tb007', '$tb008', '$tb009', '$tb017'); 
				 ";

				$this->db->query($sql98);




				//領料單身檔---------------------------------
				$sql90 = " INSERT INTO dbo.MOCTE
								(COMPANY, MODIFIER, USR_GROUP, MODI_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008, TE009, TE010, TE011, TE012, TE013, TE014, TE015, TE016, TE017, TE018, TE019)
						VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', 'I12', '$TA002', '$tb008', '$tb003', '$tb005', '', '', '$tb009', '****', '', '', '', '', '$tb017', '', '1', '', '', 'Y'); 
						";

				$this->db->query($sql90);

				$sql95 = " UPDATE  MOCTE
								SET  MOCTE.TE017 = t.MB002,MOCTE.TE018 = t.MB003,MOCTE.TE006 = t.MB004
							FROM MOCTE c 
								INNER JOIN INVMB t
									ON c.TE004=t.MB001
							WHERE c.TE001 ='I12' and c.TE002='$TA002' and c.TE003='$tb008'				
							";
				$this->db->query($sql95);


				//領料單身檔---------------------------------end

				//INVLA 異動明細資料檔---------------------------
				preg_match_all('/\d/S', $this->input->post('ta003'), $matches);  //處理日期字串
				$ta003 = implode('', $matches[0]);				//開單日期
				$vla010 = '';
				$sql93 = " INSERT INTO dbo.INVLA
								(COMPANY, MODIFIER, USR_GROUP, MODI_DATE, FLAG, LA001, LA004, LA005, LA006, LA007, LA008, LA009, LA010, LA011, LA014, LA015)
						VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$tb003', '$ta003', '-1', 'I12', '$TA002', '$tb008', '$tb009', '$vla010', '$tb005', '3', 'Y'); 				
						";
				$this->db->query($sql93);
				//INVLA 異動明細資料檔---------------------------end

			}
		}
	}
	//查複製資料是否重複	 
	function seldetail($seg1, $seg2, $seg3)
	{
		$this->db->where('tb001', $seg1);
		$this->db->where('tb002', $seg2);
		$this->db->where('tb008', $seg3);
		$query = $this->db->get('moctb');
		return $query->num_rows();
	}
	//刪除一筆 	
	function deletef($seg1)
	{
		$this->db->where('ta001', $this->uri->segment(4));
		$this->db->where('ta002', $this->uri->segment(5));
		$this->db->delete('mocta');
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
		$this->db->delete('moctb');
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	//刪除一筆細項	
	function deletedetailf($seq1, $seq2, $seq3, $seq4)
	{

		//更新  配料單單頭---------------------------
		$modifier = trim($this->session->userdata('sysuser'));

		$vtoday = date('Ymd');
		$tb005 = trim($seq4);		//重量
		$sql = " UPDATE dbo.mocta
						SET modifier='$modifier', modi_date='$vtoday',ta016= convert(varchar(25),convert(float,ta016)-$tb005) 
				WHERE ta001 ='$seq1' and ta002='$seq2'
		 ";

		$this->db->query($sql);
		//更新  配料單單頭---------------------------

		//更新 INVLA 異動  配料  明細資料檔---------------------------
		$sql95 = " UPDATE dbo.invra
							SET modifier='$modifier', modi_date='$vtoday',ra010= convert(varchar(15),convert(float,ra010)-$tb005)
						WHERE ra006 ='$seq1' and ra007='$seq2'			
				";
		$this->db->query($sql95);
		//更新 INVLA 異動明細資料檔---------------------------end


		//刪除  配料單單身---------------------------
		$sql91 = " DELETE FROM dbo.moctb
						WHERE tb001 ='$seq1' and tb002='$seq2' and tb008='$seq3'	
				";
		$this->db->query($sql91);
		//刪除  配料單單身---------------------------END

		//刪除  領料單單身---------------------------
		$sql96 = " DELETE FROM dbo.MOCTE
						WHERE TE001 ='I12' and TE002='$seq2' and TE003='$seq3'
				";
		$this->db->query($sql96);
		//刪除  領料單單身---------------------------END

		//刪除  生產入庫單單身---------------------------
		// $sql95 = " DELETE FROM  MOCTG
		// 				WHERE TG001 ='I13' and TG002='$seq2' and TG003='$seq3'				
		// 			";
		// $this->db->query($sql95);
		//刪除  生產入庫單單身---------------------------END

		//刪除  異動明細資料檔---------------------------
		$sql97 = " DELETE FROM  INVLA
						WHERE LA006 ='I12' and LA007='$seq2' and LA008='$seq3'				
					";
		$this->db->query($sql97);
		//刪除  異動明細資料檔---------------------------END



		return true;
	}

	//選取刪除多筆   
	function delmutif()
	{
		$seq[] = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		$x = 0;
		$seq1 = ' ';
		$seq2 = ' ';
		// $seq3 = ' ';
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;
				// list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
				list($seq1, $seq2) = explode("/", $seq[$x]);
				$seq1;
				$seq2;
				// $seq3;

				//刪除  配料單---------------------------
				$sql90 = " DELETE FROM  mocta
								WHERE ta001 ='$seq1' and ta002='$seq2'				
						";
				$this->db->query($sql90);

				$sql91 = " DELETE FROM dbo.moctb
								WHERE tb001 ='$seq1' and tb002='$seq2'	
						";
				$this->db->query($sql91);
				//刪除  配料單---------------------------END

				//刪除  領料單---------------------------
				$sql95 = " DELETE FROM  MOCTC
								WHERE TC001 ='I12' and TC002='$seq2'				
						";
				$this->db->query($sql95);

				$sql96 = " DELETE FROM dbo.MOCTE
								WHERE TE001 ='I12' and TE002='$seq2'	
						";
				$this->db->query($sql96);
				//刪除  領料單---------------------------END

				//刪除  生產入庫單---------------------------
				$sql95 = " DELETE FROM  MOCTG
								WHERE TG001 ='I13' and TG002='$seq2'				
						";
				$this->db->query($sql95);

				$sql96 = " DELETE FROM dbo.MOCTF
								WHERE TF001 ='I13' and TF002='$seq2'	
						";
				$this->db->query($sql96);
				//刪除  生產入庫單---------------------------END

				//刪除  異動明細資料檔---------------------------
				$sql97 = " DELETE FROM  INVLA
							WHERE LA006 ='I13' and LA007='$seq2'				
						";
				$this->db->query($sql97);
				$sql98 = " DELETE FROM  INVLA
							WHERE LA006 ='I12' and LA007='$seq2'				
						";
				$this->db->query($sql98);
				//刪除  異動明細資料檔---------------------------END

				//更新 INVLA 異動  配料  明細資料檔---------------------------
				$sql95 = " DELETE FROM dbo.invra
							WHERE ra006 ='$seq1' and ra007='$seq2'	
							";

				$this->db->query($sql95);
				//更新 INVLA 異動明細資料檔---------------------------end

				$this->session->set_userdata('msg1', "未生產已刪除");
			}
			return TRUE;
		}
		$this->session->set_userdata('msg1', "未選取");
		return FALSE;
	}

	function check_detail_num($tb001, $tb002)
	{

		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('moctb')
			->where('tb001', $tb001)
			->where('tb002', $tb002);

		$num = $query->get()->result();

		return $num[0]->num_count;
	}

	function get_detail_data($tb001, $tb002)
	{

		$query = $this->db->select('*')
			->from('moctb')
			->where('tb001', $tb001)
			->where('tb002', $tb002);

		$data = $query->get()->result();

		return $data;
	}
	//取單號 最大值加1
	function check_title_no($moci01, $ta003)
	{
		preg_match_all('/\d/S', $ta003, $matches);  //處理日期字串
		$ta003 = implode('', $matches[0]);
		// $this->db->select('MAX(ta002) as max_no')
		// 	->from('mocta')
		// 	->where('ta001', $moci01)
		// 	//	->where('ta024', $ta024);
		// 	->like('ta003', $ta003, "after");

		// $query = $this->db->get();
		// $result = $query->result();

		$sql98 = " select MAX(ta002) as max_no from mocta where ta001='$moci01' AND ta002 LIKE '$ta003%' ";
		$query = $this->db->query($sql98);

		$result = $query->result();


		if (!$result[0]->max_no) {
			return $ta003 . "001";
		}

		return $result[0]->max_no + 1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
