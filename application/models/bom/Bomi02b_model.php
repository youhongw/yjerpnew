<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bomi02b_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//查詢 table 表所有資料	 
	function selbrowse($num, $offset)
	{
		$this->db->select('mc001, mc002, mc003, mc004, mc005, mc006,mc008,mc010,mc011,mc013, create_date');
		$this->db->from('bommc');
		//$this->db->order_by('id', 'DESC');                //排序  單欄
		$this->db->order_by('mc001 desc, mc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();
		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('bommc');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('mc001', 'mc002', 'mc003', 'mc004', 'mc005', 'mc007', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('a.mc001, a.mc002, a.mc003, a.mc004,b.ma002 as mc004disp, a.mc005, a.mc007,a.create_date')
			->from('bommc as a')
			->join('purma as b', 'a.mc004 = b.ma001 ', 'left')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('bommc');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('bomi02b_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['bomi02b']['search']);
		}
		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['bomi02b']['search']);
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
		$default_order = "mc002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['bomi02b']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['bomi02b']['search']['where'];
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

		if (isset($_SESSION['bomi02b']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['bomi02b']['search']['order'];
		}

		if (!isset($_SESSION['bomi02b']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		// $query = $this->db->select('a.*,b.mb002,b.mb003,b.mb002 as mc001disp,b.mb003 as mc001disp1')
		// 	->from('bommc as a')
		// 	->join('invmb as b', 'a.mc001 = b.mb001', 'left')
		// 	->order_by($order);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		// //建構暫存view 1060614 上一頁,下一頁使用
		// $this->construct_view($ret['data']);

		// $query = $this->db->select('a.*,b.mb002,b.mb003,b.mb002 as mc001disp,b.mb003 as mc001disp1')
		// 	->from('bommc as a')
		// 	->join('invmb as b', 'a.mc001 = b.mb001', 'left')
		// 	->order_by($order)
		// 	->limit($limit, $offset);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		$vme009 = $this->session->userdata('sysgroup');

		$vsuper = $this->session->userdata('syssuper');

		$sql21 = " select a.*,b.MB002 AS mc01disp, b.MB003 AS mc01disp1, b.MB004 AS mc01disp2,c.me002 as mc009disp 
						FROM dbo.bommc as a
							LEFT JOIN INVMB as b on a.mc001=b.MB001 
							LEFT JOIN admme as c on a.mc009=c.me001	
							where mc009 ='$vme009'
							order by a.mc001
					";

		if ($vme009 != '') {

			$arr = explode(";", $vme009);
			$count_me009 = ($arr[count($arr) - 1]) ? count($arr) : count($arr) - 1;

			$temp_where = ' where ';
			if ($count_me009 > 0) {
				for ($i = 0; $i < $count_me009; $i++) {
					if ($i == 0) {
						$temp_where .= " mc009 = '" . $arr[$i] . "' ";
					} else {
						$temp_where .= " or mc009 = '" . $arr[$i] . "' ";
					}
				}
				$sql21 = " select a.*,b.MB002 AS mc01disp, b.MB003 AS mc01disp1, b.MB004 AS mc01disp2,c.me002 as mc009disp 
						FROM dbo.bommc as a
							LEFT JOIN INVMB as b on a.mc001=b.MB001 
							LEFT JOIN admme as c on a.mc009=c.me001	
					" . $temp_where . " order by a.mc001 ";
			}
		}

		if ($vsuper == 'Y') {
			$sql21 = " select a.*,b.MB002 AS mc01disp, b.MB003 AS mc01disp1, b.MB004 AS mc01disp2,c.me002 as mc009disp 
						FROM dbo.bommc as a
							LEFT JOIN INVMB as b on a.mc001=b.MB001 
							LEFT JOIN admme as c on a.mc009=c.me001	
						order by a.mc001
					";
		}

		$query = $this->db->query($sql21);
		$ret['data'] = $query->result();

		//儲存sql 語法
		$_SESSION['bomi02b']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('bommc as a')
		// 	->join('copmb as b', 'a.mc001 = b.mb001', 'left');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['bomi02b']['search']['where'] = $where;
		$_SESSION['bomi02b']['search']['order'] = $order;
		$_SESSION['bomi02b']['search']['offset'] = $offset;

		return $ret;
	}

	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data)
	{
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mc001", "mc002"
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
		$_SESSION['bomi02b']['search']['view'] = $view_array;
		$_SESSION['bomi02b']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['bomi02b']['search']['view']);exit;
	}
	//查詢修改用 (看資料用)   
	function selone($seq1)
	{
		$sql98 = " select a.*,  b.MB002 AS mc001disp, b.MB003 AS mc001disp1, b.MB004 as mc001disp2, c.me002 as mc009disp					
					from bommc as a
						left join INVMB b on a.mc001 = b.MB001
						left join admme c on a.mc009 = c.me001
					where mc001='$seq1' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() <= 0) {
			return "no_data";
		}

		$result['title_data'] = $query->result();


		$sql99 = " select a.*,  b.MB002 AS md003disp, b.MB003 AS md003disp1,b.MB004 as md003disp2					
					from bommd1 as a
						left join INVMB b on a.md003 = b.MB001
					where md001='$seq1' 
					order by md002 
					";
		$query = $this->db->query($sql99);

		if ($query->num_rows() <= 0) {
			$result['body_data'] = array();
			return $result;
		}

		$result['body_data'] = $query->result();

		return $result;
	}

	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword)
	{
		$this->db->select('mb001, mb002, mb003,mb004')->from('invmb');
		$this->db->like('mb001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('mb002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('15');
		$query = $this->db->get();
		return $query->result();
	}

	//ajax 查詢 顯示 請購單別 md001	
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

	//ajax 查詢顯示用 廠別 mc010  
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
	function ajaxchkno1($seg1, $seg2)
	{
		$this->db->select_max('mc002');
		$this->db->where('mc001', $this->uri->segment(4));
		$this->db->where('mc010', $this->uri->segment(5));
		$query = $this->db->get('bommc');
		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mc002;
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
		$seq11 = "SELECT COUNT(*) as count  FROM `bommc` ";
		$seq1 = "mc001, mc002, mc003, mc004, mc005,mc006, mc010, a.create_date FROM `bommc` as a ";
		$seq2 = "WHERE `a.create_date` >=' ' ";
		$seq32 = "`create_date` >='' ";
		$seq33 = 'mc001 desc';
		$seq9 = " ORDER BY mc001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`a.create_date` >='' ";
		// $seq5=$this->session->userdata('find05');
		// $seq7=$this->session->userdata('find07');
		$seq7 = "mc001 ";

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

		$sort_columns = array('mc001', 'mc002', 'mc003', 'mc004', 'b.mb002', 'mc005', 'mc006', 'mc007', 'mc008', 'mc010', 'a.create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('mc001,c.mq002,c.mq002 as mc005disp, mc002, mc003, mc004,b.mb002,b.mb002 as mc001disp,b.mb003,b.mb003 as mc001disp1, mc005, mc006,mc007,mc010,mc008,mc010, a.create_date')
			->from('bommc as a')
			->join('invmb as b', 'a.mc001 = b.mb001 ', 'left')
			->join('cmsmq as c', 'a.mc005 = c.mq001', 'left')
			->where($seq32)
			->order_by($seq33)
			//->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('bommc as a')
			->join('invmb as b', 'a.mc001 = b.mb001 ', 'left')
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
		$sort_columns = array('mc001', 'mc002', 'b.ma002', 'mc003', 'mc004', 'mc005', 'mc007', 'a.create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否為 table
		$this->db->select('mc001, mc002, mc003, mc004,b.ma002, b.ma002 as mc004disp, mc005,mc007, a.create_date');
		$this->db->from('bommc as a');
		$this->db->join('purma as b', 'a.mc004 = b.ma001 ', 'left');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		//$this->db->order_by('mc001 asc, mc002 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();

		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('bommc as a');
		$this->db->join('purma as b', 'a.mc004 = b.ma001 ', 'left');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//查新增資料是否重複 (單頭)  
	function selone1($seg1)
	{
		$this->db->where('mc001', $this->input->post('mc001'));
		$query = $this->db->get('bommc');
		return $query->num_rows();
	}

	//查新增資料是否重複 (單身)	
	function selone1d($seg1)
	{
		$this->db->where('md001', $this->input->post('mc001'));
		$query = $this->db->get('bommd1');
		return $query->num_rows();
	}
	//查新增品號廠商資料是否重複 	
	function selone2d($seg1, $seg2, $seg3, $seg4, $seg5)
	{
		$this->db->where('mb001', $seg1);
		$this->db->where('mb002', $seg2);
		$this->db->where('mb003', $seg3);
		$this->db->where('mb004', $seg4);
		$this->db->where('mb014', $seg5);
		$query = $this->db->get('purmb');
		return $query->num_rows();
	}

	// 查群組名稱
	function selectg()
	{
		$seq1 = $this->session->userdata('sysgroup');
		$sql98 = " select * from admme where me001 = '$seq1' ";
		$query = $this->db->query($sql98);
		$result = $query->result();

		if (count($result) > 0) {
			return $result[0]->me002;
		} else {
			return '';
		}
	}

	function selectgro()
	{
		$seq1 = $this->session->userdata('sysgroup');
		$sql98 = "  select me001,me002 from admme  ";
		$query = $this->db->query($sql98);

		return $query->result();
	}

	//新增一筆 檔頭  bommc	
	function insertf()    //新增一筆 檔頭  bommc
	{

		$mc001 = $this->input->post('mc001');	//主件品號
		$mc002 = $this->input->post('mc002');	//單位
		$mc002 = iconv("utf-8", "BIG5", $mc002);

		$mc004 = $this->input->post('mc004');	//標準批量
		$mc009 = $this->input->post('mc009');	//群組
		$mc010 = $this->input->post('mc010');	//備註
		$mc010 = iconv("utf-8", "BIG5", $mc010);

		$company = 'YJ';
		$creator = $this->session->userdata('sysuser');
		$usr_group = $this->session->userdata('sysdept');
		$vtoday = date('Ymd');

		//是否已存在-----------------------------------
		$sqls = " SELECT * FROM bommc WHERE mc001='$mc001' ";
		$query = $this->db->query($sqls);
		if ($query->num_rows() > 0) {
			return 'exist';
		}
		//是否已存在-----------------------------------end


		$sql = " INSERT INTO dbo.bommc
		(company, creator, usr_group, create_date, flag, mc001, mc002, mc004, mc009, mc010)
VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$mc001', '$mc002', '$mc004', '$mc009', '$mc010'); ";

		$this->db->query($sql);


		if ($this->input->post()) {
			extract($this->input->post());
		}
		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}

		$erro_msg = '重複：';
		$icount = 0;
		if (isset($order_product)) {
			// 新增明細 bommd1
			// $vmd002 = '1010';		//流水號重新排序
			foreach ($order_product as $key => $val) {
				if ($val['md002'] && $val['md003']) {
					extract($val);
					// preg_match_all('/\d/S', $md011, $matches);  //處理日期字串
					// $md011 = implode('', $matches[0]);
					// preg_match_all('/\d/S', $md012, $matches);  //處理日期字串
					// $md012 = implode('', $matches[0]);
					$sql97 = " select * from dbo.bommd1 where md001='$mc001' and md003='$md003' ";
					$query = $this->db->query($sql97);
					if ($query->num_rows() > 0) {
						$icount++;
						if ($icount === 1) {
							$erro_msg .= $md003;
						} else {
							$erro_msg .= '、' . $md003;
						}
					} else {
						$sql98 = " INSERT INTO dbo.bommd1 
					(company, creator, usr_group, create_date, flag, md001, md002, md003, md004, md006, md007, md016)
			VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$mc001', '$md002', '$md003', '$md004', '$md006', '$mc004', '$md016'); ";

						$this->db->query($sql98);
					}
				}
			}
		}

		if ($icount !== 0) {
			$_SESSION['message1'] = '有' . $icount . '筆元件品號' . $erro_msg . '，未儲存';
			return 'exist';
		}
	}

	function auto_print()
	{
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001", $this->input->post('purq04a32'));
		$query = $this->db->get();
		$tmp = $query->result();
		if (@$tmp[0]->mq016 == "Y") {
			echo "<script>window.open('printbb/" . $this->input->post('purq04a32') . "/" . $this->input->post('mc002') . ".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}
	//查複製資料是否重複	 
	function selone2($seq1)
	{
		$this->db->where('mc001', $seq1);
		$query = $this->db->get('bommc');
		return $query->num_rows();
	}

	//複製一筆	
	function copyf($mc001o, $mc001c)
	{

		$user = $this->session->userdata('sysuser');

		$sql_chk = "SELECT COUNT(*) AS NUM FROM INVMB WHERE MB001 IN ('$mc001o','$mc001c')";
		$query_chk = $this->db->query($sql_chk);
		$num = $query_chk->result();
		$NUM1 = $num[0]->NUM; //輸入的單號是否存在

		//echo $NUM1 ;exit;



		$sql1 = "INSERT INTO BOMMC (COMPANY,CREATOR,USR_GROUP,CREATE_DATE,MODIFIER,MODI_DATE,FLAG,MC001,MC002,MC003,MC004,MC005,MC006,MC007,MC008,MC009,MC010)
			SELECT COMPANY,'$user','A100',convert(varchar, getdate(), 112),'','','1','$mc001c',MC002,MC003,MC004,MC005,MC006,MC007,MC008,'0000',MC010 FROM BOMMC WHERE MC001 = '$mc001o'
			";

		//	echo var_dump($sql1);
		$query1 = $this->db->query($sql1);

		$sql2 = "INSERT INTO BOMMD (COMPANY,CREATOR,USR_GROUP,CREATE_DATE,MODIFIER,MODI_DATE,FLAG,MD001,MD002,MD003,MD004,MD005,MD006,MD007,MD008,MD009,MD010,MD011,MD012,MD013,MD014,MD015,MD016,MD017,MD018,MD019,MD020,MD021,MD022,MD023)
			SELECT COMPANY,'$user','A100',convert(varchar, getdate(), 112),'','','1','$mc001c',MD002,MD003,MD004,MD005,MD006,MD007,MD008,MD009,MD010,convert(varchar, getdate(), 112),'',MD013,MD014,MD015,MD016,MD017,MD018,MD019,MD020,MD021,MD022,MD023 FROM BOMMD WHERE MD001 = '$mc001o'
			";

		//	echo var_dump($sql2);exit;

		$query2 = $this->db->query($sql2);

		//	return $NUM1 ;



		if ($NUM1 < 2) {
			return "0";
		}



		/*
	        $this->db->where('mc001', $this->input->post('mc001o'));
			//$this->db->where('mc002', $this->input->post('mc002o'));
	        $query = $this->db->get('bommc');
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
                $mc002=$row->mc002;$mc003=$row->mc003;$mc004=$row->mc004;$mc005=$row->mc005;$mc006=$row->mc006;$mc007=$row->mc007;$mc008=$row->mc008;$mc009=$row->mc009;$mc010=$row->mc010;
				
				
			endforeach;
		       }   
		  
           $seq1=$this->input->post('mc001c');    //主鍵一筆檔頭bommc
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mc001' => $seq1,'mc002' => $mc002,'mc003' => $mc003,'mc004' => $mc004,'mc005' => $mc005,'mc006' => $mc006,'mc007' => $mc007,'mc008' => $mc008,'mc009' => $mc009,'mc010' => $mc010
		           
                   );
				   
            $exist = $this->bomi02b_model->selone2($seq1);
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('bommc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('md001', $this->input->post('mc001o'));
	        $query = $this->db->get('bommd1');
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
                 $md002[$i]=$row->md002;$md003[$i]=$row->md003;$md004[$i]=$row->md004;$md005[$i]=$row->md005;$md006[$i]=$row->md006;$md007[$i]=$row->md007;
				 $md008[$i]=$row->md008;$md009[$i]=$row->md009;$md010[$i]=$row->md010;$md011[$i]=$row->md011;$md012[$i]=$row->md012;
				 $md013[$i]=$row->md013;$md014[$i]=$row->md014;$md015[$i]=$row->md015;$md016[$i]=$row->md016;$md017[$i]=$row->md017;
				 $md018[$i]=$row->md018;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('mc001c');    //主鍵一筆明細bommd1
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
                'md001' => $seq1,'md002' => $md002[$i],'md003' => $md003[$i],'md004' => $md004[$i],'md005' => $md005[$i],'md006' => $md006[$i],'md007' => $md007[$i],
		        'md008' => $md008[$i],'md009' => $md009[$i],'md010' => $md010[$i],'md011' => $md011[$i],'md012' => $md012[$i],
				'md013' => $md013[$i],'md014' => $md014[$i],'md015' => $md015[$i],'md016' => $md016[$i],'md017' => $md017[$i],'md018' => $md018[$i]
                ); 
				
             $this->db->insert('bommd1', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
			 */
	}

	//轉excel檔   
	function excelnewf()
	{
		$seq1 = $this->input->post('mc001o');
		$seq2 = $this->input->post('mc001c');
		$sql = " SELECT mc001,c.mb002 as mc001disp,c.mb003 as mc001disp1,c.mb004 as mc001disp2,mc004,md003,md002
		           ,d.mb002 as md003disp ,d.mb003 as md003disp1 ,d.mb004 as md003disp2,md006,md007,md008 FROM bommc as a,bommd1 as b,invmb c, invmb d
		  WHERE a.mc001=b.md001 AND  a.mc001=c.mb001 AND b.md003=d.mb001 AND  mc001 >= '$seq1'  AND mc001 <= '$seq2'   ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	

	function printfd()
	{
		$seq1 = $this->input->post('mc001o');
		$seq2 = $this->input->post('mc001c');
		//  $seq3=$this->input->post('mc002o');    
		//  $seq4=$this->input->post('mc002c');
		$sql = " SELECT mc001,mc002,mc003,mc004,c.mb002 as mc001disp,c.mb003 as mc001disp1,c.mb004 as mc001disp2,mc005,md003,md004,md005,md006,md009,md010 
		            md002,md007,md008,d.mb002 as md003disp ,d.mb003 as md003disp1 ,d.mb004 as md003disp2 FROM bommc as a,bommd1 as b,invmb c, invmb d
		  WHERE a.mc001=b.md001 AND  a.mc001=c.mb001 AND b.md003=d.mb001 AND  mc001 >= '$seq1'  AND mc001 <= '$seq2'   ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();
		$seq32 = "mc001 >= '$seq1'  AND mc001 <= '$seq2'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('bommc')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}
	//選取印單據筆	
	function printfd1()
	{
		$this->db->select('a.* ,c.mq002 AS mc001disp, d.me002 AS mc004disp, e.mb002 AS mc010disp, f.mv002 AS mc012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.md001, b.md002, b.md003, b.md004, b.md005,
		  b.md006, b.md007, b.md011, b.md009, b.md017, b.md018, b.md012');

		$this->db->from('bommc as a');
		$this->db->join('bommd1 as b', 'a.mc001 = b.md001  and a.mc002=b.md002 ', 'left');
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="31" ', 'left');
		$this->db->join('cmsme as d', 'a.mc004 = d.me001 ', 'left');
		$this->db->join('cmsmb as e', 'a.mc010 = e.mb001 ', 'left');
		$this->db->join('cmsmv as f ', 'a.mc012 = f.mv001 and f.mv022 = " " ', 'left');
		$this->db->where('a.mc001', $this->uri->segment(4));
		$this->db->where('a.mc002', $this->uri->segment(5));
		$this->db->order_by('mc001 , mc002 ,b.md003');

		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1 = $this->uri->segment(4);
		$seq2 = $this->uri->segment(5);
		$this->db->where('md001', $this->uri->segment(4));
		$this->db->where('md002', $this->uri->segment(5));
		$query = $this->db->get('bommd1');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//印單據筆   
	function printfc()
	{
		$this->db->select('a.* ,c.mq002 AS mc001disp, d.ma002 AS mc004disp, 
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.md001, b.md002, b.md003, b.md004, b.md005,
		  b.md006, b.md007, b.md009, b.md010, b.md014, b.md012');

		$this->db->from('bommc as a');
		$this->db->join('bommd1 as b', 'a.mc001 = b.md001  and a.mc002=b.md002 ', 'left');
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="32" ', 'left');
		$this->db->join('purma as d', 'a.mc004 = d.ma001 ', 'left');
		$this->db->where('a.mc001', $this->input->post('mc001o'));
		$this->db->where('a.mc002', $this->input->post('mc002o'));
		$this->db->order_by('mc001 , mc002 ,b.md003');

		$query = $this->db->get();
		$result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
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
		if ($query->num_rows() > 0) {
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
		if ($query->num_rows() > 0) {
			return $result2;
		}
	}
	//印單據筆  
	function printfb()
	{
		$this->db->select('a.* ,c.mq002 AS mc001disp, d.ma002 AS mc004disp, 
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.md001, b.md002, b.md003, b.md004, b.md005,
		  b.md006, b.md007, b.md009, b.md010, b.md014, b.md012');

		$this->db->from('bommc as a');
		$this->db->join('bommd1 as b', 'a.mc001 = b.md001  and a.mc002=b.md002 ', 'left');
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="32" ', 'left');
		$this->db->join('purma as d', 'a.mc004 = d.ma001 ', 'left');
		$this->db->where('a.mc001', $this->uri->segment(4));
		$this->db->where('a.mc002', $this->uri->segment(5));
		$this->db->order_by('mc001 , mc002 ,b.md003');

		$query = $this->db->get();
		$result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
			return $result;
		}
	}

	//更改一筆	
	function updatef()
	{

		$mc001 = $this->input->post('mc001');	//主件品號
		$mc002 = $this->input->post('mc002');	//單位
		$mc002 = iconv("utf-8", "BIG5", $mc002);

		$mc004 = $this->input->post('mc004');	//標準批量
		$mc009 = $this->input->post('mc009');	//群組
		$mc010 = $this->input->post('mc010');	//備註
		$mc010 = iconv("utf-8", "BIG5", $mc010);

		$company = 'YJ';
		$modifier = $this->session->userdata('sysuser');
		$usr_group = $this->session->userdata('sysdept');
		$vtoday = date('Ymd');
		$flag = $this->input->post('flag') + 1;


		$sql96 = " update dbo.bommc 
						set modifier='$modifier', modi_date='$vtoday', flag='$flag', mc001='$mc001', mc002='$mc002', mc004='$mc004', mc009='$mc009', mc010='$mc010'
					where mc001='$mc001'
					";

		$this->db->query($sql96);


		//刪除明細 
		if ($this->input->post()) {
			extract($this->input->post());
		}
		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}

		if (isset($order_product)) {
			$vmd002 = '1010';   //流水號重新排序
			foreach ($order_product as $key => $val) {
				extract($val);
				// preg_match_all('/\d/S', $md011, $matches);  //處理日期字串
				// $md011 = implode('', $matches[0]);
				// preg_match_all('/\d/S', $md012, $matches);  //處理日期字串
				// $md012 = implode('', $matches[0]);

				// insert 、updata 有就修改，沒有就新增---------------------------------

				$sql97 = " select * from dbo.bommd1 where md001='$mc001' and md003='$md003' ";
				$query = $this->db->query($sql97);

				if ($query->num_rows() > 0) {

					$sql98 = " UPDATE dbo.bommd1 
						SET modifier='$modifier', modi_date='$vtoday', flag='$flag', md002='$md002', md003='$md003', md004='$md004', md006='$md006', md007='$mc004', md016='$md016'
					   where md001='$mc001' and md003='$md003'
					 ";
				} else {

					$sql98 = " INSERT INTO dbo.bommd1 
				  (company, modifier, usr_group, modi_date, flag, md001, md002, md003, md004, md006, md007, md016)
		  VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$mc001', '$md002', '$md003', '$md004', '$md006', '$mc004', '$md016'); ";
				}

				$this->db->query($sql98);
				// insert 、updata 有就修改，沒有就新增-----END----------------------------


			}
		}
	}
	//查複製資料是否重複	 
	function seldetail($seg1, $seg2)
	{
		$this->db->where('md001', $seg1);
		$this->db->where('md002', $seg2);
		$query = $this->db->get('bommd1');
		return $query->num_rows();
	}
	//刪除一筆 	
	function deletef($seg1)
	{
		$this->db->where('mc001', $this->uri->segment(4));
		$this->db->where('mc002', $this->uri->segment(5));
		$this->db->delete('bommc');
		$this->db->where('md001', $this->uri->segment(4));
		$this->db->where('md002', $this->uri->segment(5));
		$this->db->delete('bommd1');
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}
	//刪除一筆細項	
	function deletedetailf($seg1, $seg2, $seg3)
	{
		// $this->db->where('md001', $seg1);
		// $this->db->where('md002', $seg2);
		// $this->db->where('md003', $seg3);
		// $this->db->delete('bommd1');
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }
		// return FALSE;

		$sql97 = " DELETE FROM dbo.bommd1
					where md001='$seg1' and md002='$seg2' and md003='$seg3'
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
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;
				list($seq1) = explode("/", $seq[$x]);
				$seq1;
				// $this->db->where('mc001', $seq1);
				// $this->db->delete('bommc');
				// $this->db->where('md001', $seq1);
				// $this->db->delete('bommd1');
				$querydelmc = $this->db->query(" DELETE FROM bommc WHERE mc001='$seq1' ");
				$querydelmd = $this->db->query(" DELETE FROM bommd1 WHERE md001='$seq1' ");
			}
		}
		return $querydelmd;
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }
		// return FALSE;
	}
	function del_detail()
	{
		$this->db->where('md001', $_POST['del_md001']);
		$this->db->where('md002', $_POST['del_md002']);
		$this->db->where('md003', $_POST['del_md003']);
		$this->db->delete('bommd1');
	}
	//取單號 最大值加1
	//ajax 查詢一筆 廠商代號  
	//ajax 查詢一筆主鍵 有無重複	
	function check_key($mc001)
	{
		//先找bommc看是否已經有此品號的配料表
		$sql97 = " SELECT * FROM bommc	WHERE mc001 = '$mc001' ";
		$query = $this->db->query($sql97);

		$data = array();
		$data['response'] = false;

		if ($query->num_rows() == 1) {
			$data['mc001disp'] = "資料重複!請重新輸入";
		} else {
			//無配料表時，找出該品號的詳細資料
			$sql98 = " SELECT * FROM INVMB	WHERE MB001 = '$mc001' ";
			$query1 = $this->db->query($sql98);

			if ($query1->num_rows() > 0) {
				$result = $query1->result();
				foreach ($result as $key => $val) {
					$data['response'] = true;
					$data['mc001disp'] = mb_convert_encoding(trim($val->MB002), "utf-8", "big-5");
					$data['mc001disp1'] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($val->MB003), 'utf-8', 'big-5'), ENT_QUOTES));
					$data['mc002'] = mb_convert_encoding(trim($val->MB004), "utf-8", "big-5");
				}
			} else {
				$data['mc001disp'] = "資料找不到!請重新輸入";
			}
		}

		return $data;
	}
	function ajaxkey($seg1)
	{
		$this->db->set('mc001', $this->uri->segment(4));
		$this->db->where('mc001', $this->uri->segment(4));
		$query = $this->db->get('bommc');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mc001;
			}
			return $result;
		}
	}

	function check_title_no($invi02)
	{

		$this->db->select('mc001 as max_no')
			->from('bommc')
			->where('mc001', $invi02);

		$query = $this->db->get();
		$result = $query->result();

		if (!$result[0]->max_no) {
			$resu = 'insert';
		} else {
			$resu = '資料重複!,重新輸入主件品號';
		}
		return $resu;
	}
	//import copi05
	function check_detail_num($mz001)
	{

		// $query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		// 	->from('bommd1 as a')
		// 	->where('md001', $mz001);

		// $num = $query->get()->result();

		// return $num[0]->num_count;
		$sql98 = " select * from bommd1 where md001='$mz001' ";
		$query = $this->db->query($sql98);

		return $query->num_rows();
	}

	function get_detail_data($mz001)
	{

		// $query = $this->db->select('a.md001,a.md002,a.md003,b.mb001,b.mb002,b.mb003,a.md004,a.md006')
		// 	->from('bommd1 as a')
		// 	->join('invmb as b', 'a.md003 = b.mb001 ', 'left')
		// 	->where('md001', $mz001);

		// $data = $query->get()->result();

		// return $data;
		$sql98 = " select a.md001,a.md002,a.md003,b.MB002,b.MB003,b.MB017,a.md004,a.md006 ,a.md007, c.MC002 as MB017disp
					 	from bommd1 as a
						left join INVMB as b on a.md003 = b.MB001
						left join CMSMC as c on c.MC001 = b.MB017
				   where md001='$mz001' 
				   order by md002 
				   ";
		$query = $this->db->query($sql98);
		$data = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			foreach ($result as $key => $val) {
				$data[$key]['md001'] = trim($val->md001);
				$data[$key]['md002'] = trim($val->md002);
				$data[$key]['md003'] = trim($val->md003);
				$data[$key]['MB002'] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($val->MB002), 'utf-8', 'big-5'), ENT_QUOTES));
				$data[$key]['MB003'] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($val->MB003), 'utf-8', 'big-5'), ENT_QUOTES));
				$data[$key]['md004'] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($val->md004), 'utf-8', 'big-5'), ENT_QUOTES));
				$data[$key]['md006'] = trim($val->md006);
				$data[$key]['md007'] = trim($val->md007);
				$data[$key]['MB017'] = trim($val->MB017);
				$data[$key]['MB017disp'] = mb_convert_encoding(trim($val->MB017disp), 'utf-8', 'big-5');
			}
		}

		return $data;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
