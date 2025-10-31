<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class sfci05_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num, $offset)
	{
		$this->db->select('TB001, TB002, TB003, TB004, TB0011, TB0019,TB020, create_date');
		$this->db->from('sfctb');
		//$this->db->order_by('id', 'DESC');                //排序  單欄
		$this->db->order_by('TB001 desc, TB002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();
		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('sfctb');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('a.TB001', 'a.TB002', 'a.TB003', 'a.TB004', 'a.TB011', 'a.TB019', 'a.TB030', 'b.ma002', 'a.create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'TB001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('a.TB001, a.TB002, a.TB003, a.TB004, b.ma002,  a.TB029, a.TB030,a.create_date')
			->from('sfctb as a')
			->join('copma as b', 'a.TB004 = b.ma001', 'left')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('sfctb');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci05_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['sfci05']['search']);
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
		$default_order = "TB001 asc,TB002 desc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['sfci05']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['sfci05']['search']['where'];
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

		if (isset($_SESSION['sfci05']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['sfci05']['search']['order'];
		}

		if (!isset($_SESSION['sfci05']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		// $query = $this->db->select('a.*,c.mq002')
		// 	->from('sfctb as a')
		// 	->join('cmsmq as c', 'a.TB001 = c.mq001', 'left')
		// 	->order_by($order);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();

		$vday = date('Ymd', strtotime(' -180 day')); //處理當日前6個月的資料
		$query = $this->db->query(" select  a.*,c.MQ002
										from SFCTB as a 
										left join  CMSMQ as c on a.TB001 = c.MQ001 
										where a.TB003 >='$vday'
										order by a.TB002 DESC,a.TB001 DESC 
										");
		$ret['data'] = $query->result();


		//建構暫存view 1060614 上一頁,下一頁使用
		// $this->construct_view($ret['data']);

		// $query = $this->db->select('a.*,c.mq002')
		// 	->from('sfctb as a')
		// 	->join('cmsmq as c', 'a.TB001 = c.mq001', 'left')
		// 	->order_by($order)
		// 	->limit($limit, $offset);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci05']['search']['sql'] = $this->db->last_query();

		/* Num SQL 1060803*/
		// $query = $this->db->select('COUNT(*) as total_num')
		// 	->from('sfctb as a')
		// 	->join('cmsmq as c', 'a.TB001 = c.mq001', 'left');
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['num'] = $query->get()->result();
		// $ret['num'] = $ret['num'][0]->total_num;
		$ret['num'] = count($ret['data']);

		//儲存where與order
		$_SESSION['sfci05']['search']['where'] = $where;
		$_SESSION['sfci05']['search']['order'] = $order;
		$_SESSION['sfci05']['search']['offset'] = $offset;

		return $ret;
	}

	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data)
	{
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"TB001", "TB002"
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
		$_SESSION['sfci05']['search']['view'] = $view_array;
		$_SESSION['sfci05']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['sfci05']['search']['view']);exit;
	}

	//查詢一筆 修改用   
	function selone($seg1, $seg2)
	{
		// $this->db->select('a.* ,c.mq002 AS TB001disp,e.me002 as TB005disp,f.me002 as TB008disp, d.mb002 AS TB010disp,
		//   g.mw002 as tc007disp,g.mw003 as tc007disp1,h.mw002 as tc009disp,h.mw003 as tc009disp1, b.company, 
		//   b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		//   b.tc006, b.tc007, b.tc008, b.tc009, b.tc010, b.tc011, b.tc012,b.tc013, b.tc014, b.tc015,b.tc016,b.tc020,
		//   b.tc021,b.tc022,b.tc023,b.tc024,b.tc025,b.tc026,b.tc027,b.tc028,b.tc029,b.tc030,b.tc031,b.tc032,b.tc033,b.tc034,b.tc035,
		//   b.tc036,b.tc037,b.tc038,b.tc039,b.tc040,b.tc041,b.tc042,b.tc043,b.tc044,b.tc045,b.tc046,b.tc047,b.tc048,b.tc049,b.tc050');

		// $this->db->from('sfctb as a');
		// $this->db->join('sfctc as b', 'a.TB001 = b.tc001  and a.TB002=b.tc002 ', 'left');	//單身	
		// $this->db->join('cmsmq as c', 'a.TB001 = c.mq001  ', 'left');  //單別sfci01
		// $this->db->join('cmsmb as d', 'a.TB010 = d.mb001 ', 'left');    //廠別cmsi02
		// $this->db->join('cmsme as e', 'a.TB005 = e.me001 ', 'left');   //部門cmsi05 TB005
		// $this->db->join('cmsme as f', 'a.TB008 = f.me001 ', 'left');   //部門cmsi05 TB005
		// $this->db->join('cmsmw as g', 'b.tc007 = g.mw001 ', 'left');   //製程 cmsi19 tc007,9
		// $this->db->join('cmsmw as h', 'b.tc007 = h.mw001 ', 'left');   //製程 cmsi19 tc007,9
		// $this->db->where('a.TB001', $seg1);
		// $this->db->where('a.TB002', $seg2);
		// $this->db->order_by('TB001 , TB002 ,b.tc003');

		// $query = $this->db->get();

		$sql98 = " select b.MQ002 AS TB001disp, c.MB002 AS TB010disp, a.*
					from SFCTB as a
					left join CMSMQ as b on a.TB001 = b.MQ001 
					left join CMSMB as c on a.TB010 = c.MB001 
					where a.TB001 ='$seg1' and a.TB002='$seg2' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() <= 0) {
			return "no_data";
		}

		$result['title_data'] = $query->result();

		// $this->db->select('b.*')
		// 	->from('sfctc as b')
		// 	//	->join('cmsmc as i', 'b.tc007 = i.mc001 ','left')   //庫別
		// 	->where('b.tc001', $seg1)
		// 	->where('b.tc002', $seg2);
		// $query = $this->db->get();

		$sql99 = " select a.*, convert(int,a.TC036) as TC036, convert(int,a.TC014) as TC014, convert(int,a.TC016) as TC016, convert(int,a.TC037) as TC037, b.MW003 as TC007disp, c.MW003 as TC009disp
						from SFCTC as a 
						left join CMSMW as b on a.TC007 = b.MW001
						left join CMSMW as c on a.TC009 = c.MW001
					where a.TC001 ='$seg1' and a.TC002='$seg2' ";
		$query = $this->db->query($sql99);

		if ($query->num_rows() <= 0) {
			$result['body_data'] = array();
			return $result;
		}

		$result['body_data'] = $query->result();

		return $result;
	}

	//查詢修改用 (看資料用)   
	function selone_old($seq1, $seq2)
	{
		$this->db->select('a.* ,c.mq002 AS TB001disp, d.mb002 AS TB007disp,e.mf002 AS TB008disp, f.mv002 AS TB006disp,g.na003 AS TB014disp,
		  ,h.ma002 AS TB004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		  b.tc006, b.tc007, b.tc008, b.tc009, b.tc010, b.tc011, b.tc012,b.tc013, b.tc014,b.tc016,b.tc020,b.tc030,b.tc031,i.mc002 as tc007disp,j.me002 as TB005disp');

		$this->db->from('sfctb as a');
		$this->db->join('sfctc as b', 'a.TB001 = b.tc001  and a.TB002=b.tc002 ', 'left');	//單身	
		$this->db->join('cmsmq as c', 'a.TB001 = c.mq001 and c.mq003="22" ', 'left');  //單別
		$this->db->join('cmsmb as d', 'a.TB007 = d.mb001 ', 'left');    //廠別
		$this->db->join('cmsmf as e', 'a.TB008 = e.mf001 ', 'left');		//幣別
		$this->db->join('cmsmv as f ', 'a.TB006 = f.mv001 and f.mv022 = " " ', 'left');  //業務人員
		$this->db->join('cmsna as g ', 'a.TB014 = g.na002 and g.na001= "1" ', 'left');    //付款條件
		$this->db->join('copma as h', 'a.TB004 = h.ma001 ', 'left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tc007 = i.mc001 ', 'left');   //庫別
		$this->db->join('cmsme as j', 'a.TB005 = j.me001 ', 'left');   //部門
		$this->db->where('a.TB001', $this->uri->segment(4));
		$this->db->where('a.TB002', $this->uri->segment(5));
		$this->db->order_by('TB001 , TB002 ,b.tc003');

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
	}

	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword)
	{
		$this->db->select('mb001, mb002, mb003,mb004')->from('sfctb');
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
		$seq11 = "SELECT COUNT(*) as count  FROM `sfctb` ";
		$seq1 = "TB001, TB002, TB003, TB004, TB004 as TB004disp,TB005, TB006,TB007,TB08,TB010,TB011,TB012,TB029,TB030, create_date FROM `sfctb` ";
		$seq2 = "WHERE `a.create_date` >=' ' ";
		$seq32 = "`a.create_date` >='' ";
		$seq33 = 'a.TB001 desc';
		$seq9 = " ORDER BY a.TB001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`a.create_date` >='' ";

		$seq7 = "a.TB001 ";

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
		if (@$_SESSION['sfci05_sql_term']) {
			$seq32 = $_SESSION['sfci05_sql_term'];
		}
		if (@$_SESSION['sfci05_sql_sort']) {
			$seq33 = $_SESSION['sfci05_sql_sort'];
		}

		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('TB001', 'TB002', 'TB003', 'TB004', 'b.ma002', 'TB005', 'TB006', 'TB007', 'TB008', 'TB010', 'TB011', 'TB012', 'TB019', 'TB027', 'a.create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'TB001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select(' a.*')
			->from('sfctb as a')
			->join('sfctc as b', 'a.TB001 = b.tc001 and a.TB002 = b.tc002', 'left')
			->where($seq32)
			->order_by($seq33)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('sfctb as a')
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
		$sort_columns = array('a.TB001', 'a.TB002', 'a.TB003', 'a.TB004', 'b.ma002', 'a.TB029', 'a.TB030', 'a.create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'TB001';  //檢查排序欄位是否為 table
		$this->db->select('a.TB001, a.TB002, a.TB003, a.TB004,b.ma002,  a.TB029,a.TB030, a.create_date');
		$this->db->from('sfctb as a');
		$this->db->join('copma as b', 'a.TB004 = b.ma001 ', 'left');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		//$this->db->order_by('TB001 asc, TB002 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();

		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('sfctb as a');
		$this->db->join('copma as b', 'a.TB004 = b.ma001 ', 'left');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//查新增資料是否重複 (單頭)  
	function selone1($seq1, $seq2)
	{
		// $this->db->where('TB001', $seg1);
		// $this->db->where('TB002', $seg2);
		// $query = $this->db->get('sfctb');
		$sql98 = " select * from SFCTB where TB001='$seq1' and TB002='$seq2' ";
		$query = $this->db->query($sql98);
		return $query->num_rows();
	}

	//查新增資料是否重複 (單身)	
	function selone1d($seg1, $seg2, $seg3)
	{
		$this->db->where('tc001', $seg1);
		$this->db->where('tc002', $seg2);
		$this->db->where('tc003', $seg3);
		$query = $this->db->get('sfctc');
		return $query->num_rows();
	}

	//新增一筆 檔頭  sfctb	
	function insertf()    //新增一筆 檔頭  sfctb
	{
		$insert_TG = 'N';
		//刪日期 / 符號
		preg_match_all('/\d/S', $this->input->post('TB015'), $matches);  //處理日期字串
		$TB015 = implode('', $matches[0]);												//移轉日期
		preg_match_all('/\d/S', $this->input->post('TB003'), $matches);  //處理日期字串
		$TB003 = implode('', $matches[0]);												//單據日期
		$TB015 = $TB003; //理論上要一致

		// echo "<pre>";
		// var_dump($TB003);
		// exit;

		//------------凍結日期------------------
		$query = $this->db->query(" select MA011, MA013 from CMSMA ");
		foreach ($query->result() as $row) {
			$vma011 = $row->MA011;
			$vma013 = $row->MA013;
			if (substr($TB015, 0, 6) < $vma011) {
				return '輸入日期資料不可小於庫存現行年月';
			}
			if ($TB015 <= $vma013) {
				return '輸入日期資料須大於帳務凍結日期';
			}
		}
		//------------凍結日期----end--------------

		$TB001 = trim($this->input->post('TB001'));			//移轉單別
		$TB002 = trim($this->input->post('TB002'));			//移轉單號
		// $TB002no = $TB002;   //明細用再新增一筆時加1
		//檢查資料是否已存在 若存在加1
		// while ($this->sfci05_model->selone1($TB001, $TB002) > 0) {
		$TB002 = $this->check_title_no($TB001, $TB003);
		// $TB002no = $TB002;
		// }
		$company = 'YJ';
		$creator = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');
		$TB010 = trim($this->input->post('TB010'));		//廠別代號
		$TB012 = trim($this->input->post('TB012'));		//更新碼
		$TB014 = trim($this->input->post('TB014'));		//備註
		$TB014 = iconv("utf-8", "BIG5", $TB014);		//備註 轉換big5
		$TB004 = trim($this->input->post('TB004'));		//移出類別
		$TB005 = trim($this->input->post('TB005'));		//移出部門
		$TB006 = trim($this->input->post('TB006'));		//移出部門名稱
		$TB006 = iconv("utf-8", "BIG5", $TB006);		//移出部門名稱 轉換big5

		$TB007 = trim($this->input->post('TB007'));		//移入類別
		$TB008 = trim($this->input->post('TB008'));		//移入部門
		$TB009 = trim($this->input->post('TB009'));		//移入部門名稱
		$TB009 = iconv("utf-8", "BIG5", $TB009);		//移入部門名稱 轉換big5
		$TB017 = 'N';									//簽核狀態
		$TB016 = trim($this->input->post('TB016'));		//確認者
		$TB011 = trim($this->input->post('TB011'));		//列印次數
		$TB013 = trim($this->input->post('TB013'));		//確認碼


		$sql = " INSERT INTO dbo.SFCTB
		(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TB001, TB002, TB003, TB004, TB005, TB006, TB007, TB008, TB009, TB010, TB011, TB012, TB013, TB014, TB015, TB016, TB017)
VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$TB001', '$TB002', '$TB003', '$TB004', '$TB005', '$TB006', '$TB007', '$TB008', '$TB009', '$TB010', '$TB011', '$TB012'
		, '$TB013', '$TB014', '$TB015', '$TB016', '$TB017'); ";

		$this->db->query($sql);

		if ($this->input->post()) {
			extract($this->input->post());
		}

		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}




		// 新增明細 sfctc  
		// $vtc003 = '1010';   //流水號重新排序
		if (isset($order_product)) {
			foreach ($order_product as $key => $val) {
				if ($val['TC003'] && $val['TC004']) {
					extract($val);
					preg_match_all('/\d/S', $TC038, $matches);  //處理日期字串
					$TC038 = implode('', $matches[0]);

					// preg_match_all('/\d/S', $TC033, $matches);  //處理日期字串
					// $TC033 = implode('', $matches[0]);
					// preg_match_all('/\d/S', $TC034, $matches);  //處理日期字串
					// $TC034 = implode('', $matches[0]);

					// $TC048 = iconv("utf-8", "BIG5", $TC048);		//產品品名
					// $TC049 = iconv("utf-8", "BIG5", $TC049);		//產品規格
					// $TC010 = iconv("utf-8", "BIG5", $TC010);		//單位
					$TC031 = iconv("utf-8", "BIG5", $TC031);		//備註
					if (substr($TB001, 0, 2) == 'D1') {
						$TC013 = '6';								//型態
						if ($TB013 == 'Y') {
							$sql96 = " UPDATE  SFCTA
										SET  TA010 = TA010 + '$TC014'
									WHERE TA001 ='$TC004' and TA002='$TC005' and TA003='$TC008'				
							";
							$this->db->query($sql96);
						}
					} else if (substr($TB001, 0, 2) == 'D2') {
						if ($TB013 == 'Y') {
							$sql95 = " UPDATE  SFCTA
										SET  TA011 = TA011 + '$TC014', TA012 = TA012 + '$TC016'
									WHERE TA001 ='$TC004' and TA002='$TC005' and TA003='$TC006'				
							";
							$this->db->query($sql95);


							$sql96 = " UPDATE  SFCTA
										SET  TA010 = TA010 + '$TC014'
									WHERE TA001 ='$TC004' and TA002='$TC005' and TA003='$TC008'				
							";
							$this->db->query($sql96);
						}
					} else if (substr($TB001, 0, 2) == 'D3') {
						if ($TB013 == 'Y') {
							$sql95 = " UPDATE  SFCTA
										SET  TA011 = TA011 + '$TC014', TA012 = TA012 + '$TC016'
									WHERE TA001 ='$TC004' and TA002='$TC005' and TA003='$TC006'				
							";
							$this->db->query($sql95);

							if ($TB004 == '1' && $TB007 == '3' && ($TC013 == '1' || $TC013 == '2') && $TC036 != '0') {
								$insert_TG = 'Y';

								$sql90 = " UPDATE  MOCTA
										SET  TA017 = TA017 + '$TC014', TA018 = TA018 + '$TC016'
									WHERE TA001 ='$TC004' and TA002='$TC005'				
							";
								$this->db->query($sql90);

								//修改製令狀態碼-------------------------------
								//1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工
								$sql89 = " UPDATE  MOCTA
										SET  TA011 = 'Y'
									WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 >= TA015				
							";
								$this->db->query($sql89);

								$sql88 = " UPDATE  MOCTA
										SET  TA011 = '2'
									WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 < TA015				
							";
								$this->db->query($sql88);

								$sql87 = " UPDATE  MOCTA
													SET  TA011 = '1'
												WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 =0				
											";
								$this->db->query($sql87);
								//修改製令狀態碼-------------------------------END
							}

							//更新製令開工日期----------------------------------------
							preg_match_all('/\d/S', $this->input->post('TB003'), $matches);  //處理日期字串
							$TB003 = implode('', $matches[0]);												//單據日期
							$SQL96 = " UPDATE  MOCTA 
											SET TA012='$TB003'
										WHERE TA001 ='$TC004' and TA002='$TC005' AND TA012=''
										";
							$this->db->query($SQL96);
							//更新製令開工日期-------------END---------------------------

							//更新製令完工日期----------------------------------------

							$SQL97 = " UPDATE  MOCTA 
											SET TA014='$TB003'
										WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 >= TA015
										";
							$this->db->query($SQL97);
							//更新製令完工日期-------------END---------------------------
						}
					}

					$sql98 = " INSERT INTO dbo.SFCTC 
				(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TC001, TC002, TC003, TC004, TC005, TC006, TC007, TC008, TC009, TC010,
				 TC013, TC014, TC015, TC016, TC022, TC023, TC026, TC027, TC031, TC035, TC036, TC037, TC038, TC039, TC041, TC047, TC048, TC049, TC201)
		VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$TB001', '$TB002', '$TC003', '$TC004', '$TC005', '$TC006', '$TC007', '$TC008', '$TC009', '', 
				 '$TC013', '$TC014', '$TC014', '$TC016', '$TB013', '$TB005', 'N', 'N', '$TC031', '$TC035', '$TC036', '$TC037', '$TC038', '$TC039', '$TB008', '$TC047', '', '', '$TC201'); 
				 ";

					$this->db->query($sql98);


					$sql99 = " UPDATE  SFCTC
								SET  SFCTC.TC048 = t.MB002,SFCTC.TC049 = t.MB003,SFCTC.TC010 = t.MB004
							FROM SFCTC c 
								INNER JOIN INVMB t
									ON c.TC047=t.MB001
							WHERE c.TC001 ='$TB001' and c.TC002='$TB002' and c.TC003='$TC003'				
							";
					$this->db->query($sql99);

					if ($insert_TG == 'Y') {
						//生產入庫單身檔---------------------------------
						$sql91 = " INSERT INTO dbo.MOCTG 
								(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TG001, TG002, TG003, TG004, TG005, TG006, TG007, TG008, TG009, TG010,
										TG011, TG012, TG013, TG014, TG015, TG016, TG017, TG018, TG019, TG020, TG021, TG022, TG023, TG024)
								VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$TB001', '$TB002', '$TC003', '$TC047', '', '', '', '', '1', '$TB008', 
										'$TC036', '$TC016', '$TC014', '$TC004', '$TC005', '$TC039', '', '', '', '$TC007', '', 'Y', '$TC037', '$TC035');
								";

						$this->db->query($sql91);

						$sql92 = " UPDATE  MOCTG
								SET  MOCTG.TG005 = t.MB002,MOCTG.TG006 = t.MB003,MOCTG.TG007 = t.MB004
							FROM MOCTG c 
								INNER JOIN INVMB t
									ON c.TG004=t.MB001
							WHERE c.TG001 ='$TB001' and c.TG002='$TB002' and c.TG003='$TC003'				
							";
						$this->db->query($sql92);
						//生產入庫單身檔---------------------------------end




						//INVLA 異動明細資料檔---------------------------						
						preg_match_all('/\d/S', $this->input->post('TB015'), $matches);  //處理日期字串
						$TB015 = implode('', $matches[0]);												//單據日期
						$vLA010 = $TC004 . '-' . $TC005;
						$sql93 = " INSERT INTO dbo.INVLA
										(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, LA001, LA004, LA005, LA006, LA007, LA008, LA009, LA010, LA011, LA014, LA015)
								VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$TC047', '$TB015', '1', '$TB001', '$TB002', '$TC003', '$TB008', '$vLA010', '$TC014', '1', 'Y'); 				
							";
						$this->db->query($sql93);
						//INVLA 異動明細資料檔---------------------------end

						//自動生成領料=======================================================================================
						$vTC = false;
						$vTC001 = '';
						$vTC002 = '';
						// if ($TB001 == 'D307') { //衝壓入庫
						// 	$vTC = true;
						// 	$vTC001 = '5407';
						// } else 
						if ($TB001 == 'D309') { //電焊入庫
							$vTC = true;
							$vTC001 = '5409';
						} else if ($TB001 == 'D310') { //鉚合入庫 
							$vTC = true;
							$vTC001 = '5410';
						} else if ($TB001 == 'D311') { //裝配入庫 
							$vTC = true;
							$vTC001 = '5411';
						}

						if ($vTC) {
							//自動生成領料 單頭----------------------------------
							$TB003 = date("Ymd", strtotime($TB003)); //處理日期
							$vTC002 = $this->check_vno_no($vTC001, $TB003);

							$sql89 = " INSERT INTO dbo.MOCTC
												(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TC001, TC002, TC003, TC004, TC005, 
												TC007, TC008, TC009, TC010, TC011, TC012, TC013, TC014, TC015, TC016, TC017, TC018, TC019)
										VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$vTC001', '$vTC002', '$TB003', '$TB010', '$TB005', 
												'$TC031', '54', 'N', '0', 'N', '1', 'Y', '$TB003', '$TB016', 'N', '$TB001', '$TB002', '$TC003'); 
										";

							$this->db->query($sql89);
							//自動生成領料 單頭----------------------------------END




							//自動生成領料 單身----------------------------------
							// //------------以BOM------------------------------------------------
							// $sql89a = " SELECT MC004,MD001,MD002,MD003,MD006 FROM BOMMC 
							// 				LEFT JOIN BOMMD ON MC001=MD001
							// 			WHERE MD001 IS NOT NULL AND MD001='$TC047'
							// 			ORDER BY MD001,MD002 ";
							// $query = $this->db->query($sql89a);

							// if ($query->num_rows() > 0) {

							// 	$sql901 = " INSERT INTO dbo.MOCTD
							// 							(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TD001, TD002, TD003, TD004, TD005, 
							// 							TD006, TD008, TD013, TD015, TD017)
							// 					VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0','$vTC001', '$vTC002', '$TC004', '$TC005', '1',
							// 							'$TC036', '1', 'N', '1', '1'); 
							// 			";
							// 	$this->db->query($sql901);

							// 	$vTE003 = 0;
							// 	foreach ($query->result() as $k => $v) {
							// 		$vTE003++;
							// 		$vTE005 = round($TC014 * $v->MD006 / $v->MC004, 0);
							// 		$vTE003 = str_pad($vTE003, 4, "0", STR_PAD_LEFT);
							// 		$vTE004 = trim($v->MD003);

							// 		$sqlE8 = " SELECT * FROM INVMB WHERE MB001='$vTE004' ";
							// 		$query = $this->db->query($sqlE8);
							// 		if ($query->num_rows() > 0) {
							// 			$vTE008 = trim($query->result()[0]->MB017);
							// 		}

							// 		$sql90 = " INSERT INTO dbo.MOCTE
							// 					(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, 
							// 					TE006, TE007, TE008, TE009, TE010, TE011, TE012, TE013, TE014, TE015, TE016, TE017, TE018, TE019)
							// 			VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$vTC001', '$vTC002', '$vTE003', '$vTE004', '$vTE005', 
							// 					'', '', '$vTE008', '****', '', '$TC004', '$TC005', '', '$TC031', '', '1', '', '', 'N'); 
							// 			";

							// 		$this->db->query($sql90);

							// 		$sql95 = " UPDATE  MOCTE
							// 				SET  MOCTE.TE017 = t.MB002,MOCTE.TE018 = t.MB003,MOCTE.TE006 = t.MB004
							// 			FROM MOCTE c 
							// 				INNER JOIN INVMB t
							// 					ON c.TE004=t.MB001
							// 			WHERE c.TE001 ='$vTC001' and c.TE002='$vTC002' and c.TE003='$vTE003'				
							// 			";
							// 		$this->db->query($sql95);



							// 		// //INVLA 異動明細資料檔-自動生成領料--------------------------
							// 		// $vLA010 = $TC004 . '-' . $TC005;
							// 		// $sql93 = " INSERT INTO dbo.INVLA
							// 		// 			(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, LA001, LA004, LA005, LA006, LA007, 
							// 		// 			LA008, LA009, LA010, LA011, LA014, LA015)
							// 		// 	VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$vTE004', '$TB003', '-1', '$vTC001', '$vTC002', 
							// 		// 			'$vTE003', '$vTE008', '$vLA010', '$vTE005', '3', 'Y'); 				
							// 		// 	";
							// 		// $this->db->query($sql93);
							// 		// //INVLA 異動明細資料檔-自動生成領料--------------------------end
							// 	}
							// }
							// //------------以BOM----------------END--------------------------------

							//------------以製令------------------------------------------------
							$sql89a = " SELECT * FROM MOCTA 
											left join MOCTB on TA001=TB001 and TA002=TB002										
										WHERE TA001='$TC004' AND TA002='$TC005' AND TA006='$TC047'
										";
							$query = $this->db->query($sql89a);

							if ($query->num_rows() > 0) {

								$sql901 = " INSERT INTO dbo.MOCTD
														(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TD001, TD002, TD003, TD004, TD005, 
														TD006, TD008, TD013, TD015, TD017)
												VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0','$vTC001', '$vTC002', '$TC004', '$TC005', '1',
														'$TC036', '1', 'N', '1', '1'); 
										";
								$this->db->query($sql901);

								$vTE003 = 0;
								foreach ($query->result() as $k => $v) {
									$vTE003++;
									// $vTE005 =  round($TC014 * $v->TA015 / ($v->TB004 == 0 ? 1 : $v->TB004), 3);
									$vTE005 =  round($TC014 * $v->TB004 / ($v->TA015 == 0 ? 1 : $v->TA015), 3);
									$vTE003 = str_pad($vTE003, 4, "0", STR_PAD_LEFT);
									$vTE004 = trim($v->TB003);
									$vTE008 = $v->TB009;



									$sql90 = " INSERT INTO dbo.MOCTE
												(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, 
												TE006, TE007, TE008, TE009, TE010, TE011, TE012, TE013, TE014, TE015, TE016, TE017, TE018, TE019)
										VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$vTC001', '$vTC002', '$vTE003', '$vTE004', '$vTE005', 
												'', '', '$vTE008', '****', '', '$TC004', '$TC005', '', '$TC031', '', '1', '', '', 'N'); 
										";

									$this->db->query($sql90);

									$sql95 = " UPDATE  MOCTE
											SET  MOCTE.TE017 = t.MB002,MOCTE.TE018 = t.MB003,MOCTE.TE006 = t.MB004
										FROM MOCTE c 
											INNER JOIN INVMB t
												ON c.TE004=t.MB001
										WHERE c.TE001 ='$vTC001' and c.TE002='$vTC002' and c.TE003='$vTE003'				
										";
									$this->db->query($sql95);
								}
							}
							//------------以製令----------------END--------------------------------

							//自動生成領料 單身----------------------------------END



						}
						//自動生成領料=======================================================================================END
					}
				}
			}
		}
		if ($insert_TG == 'Y') {
			preg_match_all('/\d/S', $this->input->post('TB003'), $matches);  //處理日期字串
			$TB003 = implode('', $matches[0]);
			//生產入庫單頭檔---------------------------------
			$sql90 = " INSERT INTO dbo.MOCTF
								(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TF001, TF002, TF003, TF004, TF005, TF006, TF007, TF008, TF009, TF010, TF011, TF012, TF013, TF014)
						VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$TB001', '$TB002', '$TB003', '$TB010', '', 'Y', 'N', '0', 'N', 'N', '$TB005', '$TB003', '$creator', 'N'); 
					";

			$this->db->query($sql90);
			//生產入庫單頭檔---------------------------------end
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
			echo "<script>window.open('printbb/" . $this->input->post('sfci01') . "/" . $this->input->post('TB002') . ".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}

	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('TB001', $this->input->post('TB001c')); 
          $this->db->where('TB002', $this->input->post('TB002c'));
	      $query = $this->db->get('sfctb');
	      return $query->num_rows() ; 
	    } */

	//複製一筆	
	function copyf()
	{
		$this->db->where('TB001', $this->input->post('TB001o'));
		$this->db->where('TB002', $this->input->post('TB002o'));
		$query = $this->db->get('sfctb');
		$exist = $query->num_rows();
		if (!$exist) {
			return 'exist';
		}
		//   if ($query->num_rows() != 1) { return 'exist'; }
		if ($query->num_rows() == 1) {
			$result = $query->result();
			foreach ($result as $row) :
				$TB003 = $row->TB003;
				$TB004 = $row->TB004;
				$TB005 = $row->TB005;
				$TB006 = $row->TB006;
				$TB007 = $row->TB007;
				$TB008 = $row->TB008;
				$TB009 = $row->TB009;
				$TB010 = $row->TB010;
				$TB011 = $row->TB011;
				$TB012 = $row->TB012;
				$TB013 = $row->TB013;
				$TB014 = $row->TB014;
				$TB015 = $row->TB015;
				$TB016 = $row->TB016;
				$TB017 = $row->TB017;
				$TB018 = $row->TB018;
				$TB019 = $row->TB019;
				$TB020 = $row->TB020;
				$TB021 = $row->TB021;
				$TB022 = $row->TB022;
				$TB023 = $row->TB023;
				$TB024 = $row->TB024;
				$TB025 = $row->TB025;
				$TB026 = $row->TB026;
				$TB027 = $row->TB027;
				$TB028 = $row->TB028;
				$TB029 = $row->TB029;
				$TB030 = $row->TB030;
				$TB031 = $row->TB031;
				$TB032 = $row->TB032;
				$TB033 = $row->TB033;
				$TB034 = $row->TB034;
				$TB035 = $row->TB035;
				$TB036 = $row->TB036;
				$TB037 = $row->TB037;
				$TB038 = $row->TB038;
				$TB039 = $row->TB039;
				$TB040 = $row->TB040;
				$TB041 = $row->TB041;
				$TB042 = $row->TB042;
				$TB043 = $row->TB043;
				$TB044 = $row->TB044;
				$TB045 = $row->TB045;
				$TB046 = $row->TB046;
				$TB047 = $row->TB047;
				$TB048 = $row->TB048;
				$TB049 = $row->TB049;
				$TB050 = $row->TB050;
				$TB051 = $row->TB051;
			endforeach;
		}

		$seq1 = $this->input->post('TB001c');    //主鍵一筆檔頭sfctb
		$seq2 = $this->input->post('TB002c');
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
			'TB001' => $seq1, 'TB002' => $seq2, 'TB003' => $TB003, 'TB004' => $TB004, 'TB005' => $TB005, 'TB006' => $TB006, 'TB007' => $TB007, 'TB008' => $TB008, 'TB009' => $TB009, 'TB010' => $TB010,
			'TB011' => $TB011, 'TB012' => $TB012, 'TB013' => $TB013, 'TB014' => $TB014, 'TB015' => $TB015, 'TB016' => $TB016, 'TB017' => $TB017,
			'TB018' => $TB018, 'TB019' => $TB019, 'TB020' => $TB020, 'TB021' => $TB021, 'TB022' => $TB022, 'TB023' => $TB023, 'TB024' => $TB024,
			'TB025' => $TB025, 'TB026' => $TB026, 'TB027' => $TB027, 'TB028' => $TB028, 'TB029' => $TB029, 'TB030' => $TB030,
			'TB031' => $TB031, 'TB032' => $TB032, 'TB033' => $TB033, 'TB034' => $TB034, 'TB035' => $TB035, 'TB036' => $TB036,
			'TB037' => $TB037, 'TB038' => $TB038, 'TB039' => $TB039, 'TB040' => $TB040, 'TB041' => $TB041, 'TB042' => $TB042,
			'TB043' => $TB043, 'TB044' => $TB044, 'TB045' => $TB045, 'TB046' => $TB046, 'TB047' => $TB047, 'TB048' => $TB048,
			'TB049' => $TB049, 'TB050' => $TB050, 'TB051' => $TB051
		);

		$exist = $this->sfci05_model->selone1($seq1, $seq2);  //檢查單頭是否重複
		if ($exist) {
			return 'exist';
		}
		$this->db->insert('sfctb', $data);      //複製一筆  

		//複製一筆明細
		$this->db->where('tc001', $this->input->post('TB001o'));
		$this->db->where('tc002', $this->input->post('TB002o'));
		$query = $this->db->get('sfctc');
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
				$tc003[$i] = $row->tc003;
				$tc004[$i] = $row->tc004;
				$tc005[$i] = $row->tc005;
				$tc006[$i] = $row->tc006;
				$tc007[$i] = $row->tc007;
				$tc008[$i] = $row->tc008;
				$tc009[$i] = $row->tc009;
				$tc010[$i] = $row->tc010;
				$tc011[$i] = $row->tc011;
				$tc012[$i] = $row->tc012;
				$tc013[$i] = $row->tc013;
				$tc014[$i] = $row->tc014;
				$tc015[$i] = $row->tc015;
				$tc016[$i] = $row->tc016;
				$tc017[$i] = $row->tc017;
				$tc018[$i] = $row->tc018;
				$tc019[$i] = $row->tc019;
				$tc020[$i] = $row->tc020;
				$tc021[$i] = $row->tc021;
				$tc022[$i] = $row->tc022;
				$tc023[$i] = $row->tc023;
				$tc024[$i] = $row->tc024;
				$tc025[$i] = $row->tc025;
				$tc026[$i] = $row->tc026;
				$tc027[$i] = $row->tc027;
				$tc028[$i] = $row->tc028;
				$tc029[$i] = $row->tc029;
				$tc030[$i] = $row->tc030;
				$tc031[$i] = $row->tc031;
				$tc032[$i] = $row->tc032;
				$tc033[$i] = $row->tc033;
				$tc034[$i] = $row->tc034;
				$tc035[$i] = $row->tc035;
				$tc036[$i] = $row->tc036;
				$i++;
			endforeach;
		}
		$seq1 = $this->input->post('TB001c');    //主鍵一筆明細sfctc
		$seq2 = $this->input->post('TB002c');
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
				'tc001' => $seq1, 'tc002' => $seq2, 'tc003' => $tc003[$i], 'tc004' => $tc004[$i], 'tc005' => $tc005[$i], 'tc006' => $tc006[$i], 'tc007' => $tc007[$i],
				'tc008' => $tc008[$i], 'tc009' => $tc009[$i], 'tc010' => $tc010[$i], 'tc011' => $tc011[$i], 'tc012' => $tc012[$i], 'tc013' => $tc013[$i],
				'tc014' => $tc014[$i], 'tc015' => $tc015[$i], 'tc016' => $tc016[$i], 'tc017' => $tc017[$i], 'tc018' => $tc018[$i], 'tc019' => $tc019[$i],
				'tc020' => $tc020[$i], 'tc021' => $tc021[$i], 'tc022' => $tc022[$i], 'tc023' => $tc023[$i], 'tc024' => $tc024[$i], 'tc025' => $tc025[$i],
				'tc026' => $tc026[$i], 'tc027' => $tc027[$i], 'tc028' => $tc028[$i], 'tc029' => $tc029[$i], 'tc030' => $tc030[$i], 'tc031' => $tc031[$i], 'tc032' => $tc032[$i],
				'tc033' => $tc033[$i], 'tc034' => $tc034[$i], 'tc035' => $tc035[$i], 'tc036' => $tc036[$i]
			);

			$this->db->insert('sfctc', $data_array);      //複製一筆 
			$i++;
		}
		return true;
	}

	//轉excel檔   
	function excelnewf()
	{
		$seq1 = $this->input->post('TB001o');
		$seq2 = $this->input->post('TB001c');
		$seq3 = $this->input->post('TB002o');
		$seq4 = $this->input->post('TB002c');
		$sql = " SELECT TB001,TB002,TB039,TB004,ma002 as TB004disp,tc003,tc004,tc005,tc006,tc010,tc008,tc011,tc012 
		  FROM sfctb as a,sfctc as b,copma as c WHERE TB001=tc001 and TB002=tc002 and TB004=ma001 and TB001 >= '$seq1'  AND TB001 <= '$seq2' AND  TB002 >= '$seq3'  AND TB002 <= '$seq4'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('TB001o');
		$seq2 = $this->input->post('TB001c');
		$seq3 = $this->input->post('TB002o');
		$seq4 = $this->input->post('TB002c');
		$sql = " SELECT a.TB001,a.TB002,a.TB039,a.TB004,c.ma002 as TB004disp,b.tc003,b.tc004,b.tc005,b.tc006,b.tc010,b.tc008,b.tc011,b.tc012
		  FROM sfctb as a,sfctc as b,copma as c
		  WHERE TB001=tc001 and TB002=tc002 and TB004=ma001 and TB001 >= '$seq1'  AND TB001 <= '$seq2' AND TB002 >= '$seq3'  AND TB002 <= '$seq4'  ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();

		$seq32 = "TB001 >= '$seq1'  AND TB001 <= '$seq2' AND TB002 >= '$seq3'  AND TB002 <= '$seq4'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('sfctb')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//選取印單據筆	
	function printfd1()
	{
		$this->db->select('a.* ,c.mq002 AS TB001disp, d.me002 AS TB004disp, e.mb002 AS TB010disp, f.mv002 AS TB012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		  b.tc006, b.tc007, b.tc011, b.tc009, b.tc017, b.tc018, b.tc012');

		$this->db->from('sfctb as a');
		$this->db->join('sfctc as b', 'a.TB001 = b.tc001  and a.TB002=b.tc002 ', 'left');
		$this->db->join('cmsmq as c', 'a.TB001 = c.mq001 and c.mq003="31" ', 'left');
		$this->db->join('cmsme as d', 'a.TB004 = d.me001 ', 'left');
		$this->db->join('cmsmb as e', 'a.TB010 = e.mb001 ', 'left');
		$this->db->join('cmsmv as f ', 'a.TB012 = f.mv001 and f.mv022 = " " ', 'left');
		$this->db->where('a.TB001', $this->uri->segment(4));
		$this->db->where('a.TB002', $this->uri->segment(5));
		$this->db->order_by('TB001 , TB002 ,b.tc003');

		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1 = $this->uri->segment(4);
		$seq2 = $this->uri->segment(5);
		$this->db->where('tc001', $this->uri->segment(4));
		$this->db->where('tc002', $this->uri->segment(5));
		$query = $this->db->get('sfctc');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//印單據筆   一次多筆列印
	function printfc()
	{
		$this->db->select('a.* ,c.mq002 AS TB001disp, d.mb002 AS TB007disp,e.mf002 AS TB008disp, f.mv002 AS TB006disp,g.na003 AS TB014disp,
		  ,h.ma002 AS TB004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		  b.tc006, b.tc007, b.tc008, b.tc009, b.tc010, b.tc011, b.tc012,b.tc013, b.tc014,b.tc016,b.tc020,b.tc030,b.tc031,i.mc002 as tc007disp,j.me002 as TB005disp');

		$this->db->from('sfctb as a');
		$this->db->join('sfctc as b', 'a.TB001 = b.tc001  and a.TB002=b.tc002 ', 'left');	//單身	
		$this->db->join('cmsmq as c', 'a.TB001 = c.mq001 and c.mq003="22" ', 'left');  //單別
		$this->db->join('cmsmb as d', 'a.TB007 = d.mb001 ', 'left');    //廠別
		$this->db->join('cmsmf as e', 'a.TB008 = e.mf001 ', 'left');		//幣別
		$this->db->join('cmsmv as f ', 'a.TB006 = f.mv001 and f.mv022 = " " ', 'left');  //業務人員
		$this->db->join('cmsna as g ', 'a.TB014 = g.na002 and g.na001= "1" ', 'left');    //付款條件
		$this->db->join('copma as h', 'a.TB004 = h.ma001 ', 'left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tc007 = i.mc001 ', 'left');   //庫別
		$this->db->join('cmsme as j', 'a.TB005 = j.me001 ', 'left');   //部門	
		$this->db->where('a.TB001', $this->input->post('TB001o'));
		$this->db->where('a.TB002 >= ' . $this->input->post('TB002o') . ' and a.TB002 <= ' . $this->input->post('TB002c'));
		$this->db->order_by('TB001 , TB002 ,b.tc003');

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
		$this->db->select('a.* ,c.mq002 AS TB001disp, d.mb002 AS TB007disp,e.mf002 AS TB008disp, f.mv002 AS TB006disp,g.na003 AS TB014disp,
		  ,h.ma002 AS TB004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		  b.tc006, b.tc007, b.tc008, b.tc009, b.tc010, b.tc011, b.tc012,b.tc013, b.tc014,b.tc016,b.tc020,b.tc030,b.tc031,i.mc002 as tc007disp,j.me002 as TB005disp');

		$this->db->from('sfctb as a');
		$this->db->join('sfctc as b', 'a.TB001 = b.tc001  and a.TB002=b.tc002 ', 'left');	//單身	
		$this->db->join('cmsmq as c', 'a.TB001 = c.mq001 and c.mq003="22" ', 'left');  //單別
		$this->db->join('cmsmb as d', 'a.TB007 = d.mb001 ', 'left');    //廠別
		$this->db->join('cmsmf as e', 'a.TB008 = e.mf001 ', 'left');		//幣別
		$this->db->join('cmsmv as f ', 'a.TB006 = f.mv001 and f.mv022 = " " ', 'left');  //業務人員
		$this->db->join('cmsna as g ', 'a.TB014 = g.na002 and g.na001= "1" ', 'left');    //付款條件
		$this->db->join('copma as h', 'a.TB004 = h.ma001 ', 'left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tc007 = i.mc001 ', 'left');   //庫別
		$this->db->join('cmsme as j', 'a.TB005 = j.me001 ', 'left');   //部門
		$this->db->where('a.TB001', $this->uri->segment(4));
		$this->db->where('a.TB002', $this->uri->segment(5));
		$this->db->order_by('TB001 , TB002 ,b.tc003');

		$query = $this->db->get();
		$result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
			return $result;
		}
	}

	//更改一筆	
	function updatef()
	{
		$insert_TG = 'N';
		//substr($this->input->post('TB003'),0,4).substr($this->input->post('TB003'),5,2).substr(rtrim($this->input->post('TB003')),8,2),
		//extract() 函数从数组中将变量导入到当前的符号表。相當於  $TB002=$this->input->post('TB002');
		//该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
		// if ($this->input->post()){
		//	extract($this->input->post());
		// }
		preg_match_all('/\d/S', $this->input->post('TB003'), $matches);  //處理日期字串
		$TB003 = implode('', $matches[0]);												//移轉日期
		preg_match_all('/\d/S', $this->input->post('TB015'), $matches);  //處理日期字串
		$TB015 = implode('', $matches[0]);												//單據日期
		$TB015 = $TB003; //理論上要一致

		$TB001 = trim($this->input->post('TB001'));		//移轉單別
		$TB002 = trim($this->input->post('TB002'));		//移轉單號

		$company = 'YJ';
		$modifier = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');
		$flag = $this->input->post('FLAG') + 1;

		$TB010 = trim($this->input->post('TB010'));		//廠別代號
		$TB012 = trim($this->input->post('TB012'));		//更新碼
		$TB014 = trim($this->input->post('TB014'));		//備註
		$TB014 = iconv("utf-8", "BIG5", $TB014);		//備註 轉換big5
		$TB004 = trim($this->input->post('TB004'));		//移出類別
		$TB005 = trim($this->input->post('TB005'));		//移出部門
		$TB006 = trim($this->input->post('TB006'));		//移出部門名稱
		$TB006 = iconv("utf-8", "BIG5", $TB006);		//移出部門名稱 轉換big5

		$TB007 = trim($this->input->post('TB007'));		//移入類別
		$TB008 = trim($this->input->post('TB008'));		//移入部門
		$TB009 = trim($this->input->post('TB009'));		//移入部門名稱
		$TB009 = iconv("utf-8", "BIG5", $TB009);		//移入部門名稱 轉換big5

		$TB013 = trim($this->input->post('TB013'));		//確認碼

		//取原本是否有確認 $oTB013----------------------
		$sql92 = " SELECT TB013 FROM  SFCTB
								where TB001='$TB001' and TB002='$TB002' 				
							";
		$query = $this->db->query($sql92);
		$oTB013 = $query->result()[0]->TB013;
		//取原本是否有確認 $oTB013----------------------END

		//原本有確認過就先刪除  生產入庫單---------------------------
		if ($oTB013 == 'Y') {
			//生產入庫單頭檔---------------------------------
			$sql92 = " DELETE FROM  MOCTG
							WHERE TG001 ='$TB001' and TG002='$TB002'				
							";
			$this->db->query($sql92);
			//生產入庫單頭檔---------------------------------end

			$sql90 = " DELETE FROM dbo.MOCTF
							WHERE TF001 ='$TB001' and TF002='$TB002'	
					";

			$this->db->query($sql90);
		}
		//原本有確認過就先刪除  生產入庫單---------------------------END

		//先刪除  異動明細資料檔---------------------------
		$sql92 = " DELETE FROM  INVLA
						WHERE LA006='$TB001' and LA007='$TB002'						
						";
		$this->db->query($sql92);
		//先刪除  異動明細資料檔---------------------------END


		$sql96 = " UPDATE dbo.SFCTB 
					set MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TB010='$TB010', TB012='$TB012', TB013='$TB013', TB014='$TB014',
					TB004='$TB004', TB005='$TB005', TB006='$TB006', TB007='$TB007', TB008='$TB008', TB009='$TB009', TB016='$modifier'
					where TB001='$TB001' and TB002='$TB002'
					";

		$this->db->query($sql96);
		//先刪除  自動生成領料======-----------
		$sqlauto = " SELECT DISTINCT TC001,TC002 FROM MOCTC
						WHERE RTRIM(TC017) <>'' AND TC017='$TB001' AND TC018='$TB002'
						ORDER BY TC002  ";
		$query = $this->db->query($sqlauto);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $r) {
				//更新製令單身 已領料數量-------------------------
				$sqld0 = " UPDATE MOCTB 
								SET TB005 = TB005 - (SELECT TE005 FROM MOCTE WHERE TE001=TD001 AND TE002=TD002 AND TE004=TB003) 
							FROM MOCTB
								INNER JOIN MOCTD ON TB001=TD003 AND TB002=TD004
								INNER JOIN MOCTC ON TD001=TC001 AND TD002=TC002
									WHERE TD001='$r->TC001' AND TD002='$r->TC002' AND TC009='Y'	
									 ";
				$this->db->query($sqld0);
				//更新製令單身 已領料數量------END-------------------		

				//更新製令單頭 已領料數量-------------------------
				$sqld0 = " UPDATE MOCTA 
									SET TA016 = TA016 - TD006   
								FROM MOCTA
									LEFT JOIN MOCTD ON TA001=TD003 AND TA002=TD004
									LEFT JOIN MOCTC ON TD001=TC001 AND TD002=TC002
										WHERE TC009='Y' AND TD001='$r->TC001' AND TD002='$r->TC002' 	
						";
				$this->db->query($sqld0);

				//更新製令單頭 已領料數量-------END------------------

				$sqld11 = " DELETE FROM MOCTD   
									WHERE TD001='$r->TC001' and TD002='$r->TC002'
							";
				$this->db->query($sqld11);

				$sqld1 = " DELETE FROM MOCTE   
									WHERE TE001='$r->TC001' and TE002='$r->TC002'
				";
				$this->db->query($sqld1);

				$sqld2 = " DELETE FROM INVLA   
									WHERE LA006='$r->TC001' and LA007='$r->TC002'
				";
				$this->db->query($sqld2);
			}
		}
		$sqld3 = " DELETE FROM MOCTC   
						WHERE TC017='$TB001' AND TC018='$TB002'
				";
		$this->db->query($sqld3);

		//先刪除  自動生成領料======-----------end

		if ($this->input->post()) {
			extract($this->input->post());
		}
		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}
		// $this->db->where('tc001', $TB001);
		// $this->db->where('tc002', $TB002);
		// $this->db->delete('sfctc'); //刪除明細 1060809
		// $sql97 = " DELETE FROM dbo.SFCTC
		// 			where TC001='$TB001' and TC002='$TB002'
		// 		  ";
		// $this->db->query($sql97);

		if (isset($order_product)) {
			// $vtc003 = '1010';   //流水號重新排序
			$doOne = 'Y';
			foreach ($order_product as $key => $val) {
				extract($val);
				preg_match_all('/\d/S', $TC038, $matches);  //處理日期字串
				$TC038 = implode('', $matches[0]);

				// preg_match_all('/\d/S', $TC033, $matches);  //處理日期字串
				// $TC033 = implode('', $matches[0]);
				// preg_match_all('/\d/S', $TC034, $matches);  //處理日期字串
				// $TC034 = implode('', $matches[0]);

				// $TC048 = iconv("utf-8", "BIG5", $TC048);		//產品品名
				// $TC049 = iconv("utf-8", "BIG5", $TC049);		//產品規格
				// $TC010 = iconv("utf-8", "BIG5", $TC010);		//單位
				$TC031 = iconv("utf-8", "BIG5", $TC031);		//備註
				// doOne 只做一次的意思 --------下面指先扣TC014後  看後面insert or updata 就直接加---------------
				if ($doOne == 'Y' && $oTB013 == 'Y') {
					$sql95 = " SELECT *
									FROM  SFCTC
								where TC001='$TB001' and TC002='$TB002' 				
							";
					$query = $this->db->query($sql95);
					$doOne = 'N';

					if ($query->num_rows() > 0) {
						$aSFCTC = $query->result();

						foreach ($aSFCTC as $key => $val) {
							# code...
							$vTC001 = $val->TC001;
							$vTC014 = $val->TC014;
							$vTC008 = $val->TC008;
							$vTC004 = $val->TC004;
							$vTC005 = $val->TC005;
							$vTC006 = $val->TC006;
							$vTC016 = $val->TC016;

							if ($vTC008) {
								if (substr($TB001, 0, 2) == 'D2') {
									$sql93 = " UPDATE  SFCTA
														SET  TA010 = TA010 - '$vTC014'
													WHERE TA001 ='$vTC004' and TA002='$vTC005' and TA003='$vTC008'	 
													";
									$this->db->query($sql93);
								} else {
									$sql93 = " UPDATE  SFCTA
														SET  TA010 = TA010 - '$vTC014', TA012 = TA012 - '$vTC016'
													WHERE TA001 ='$vTC004' and TA002='$vTC005' and TA003='$vTC008'	 
													";
									$this->db->query($sql93);
								}
							}
							if ($vTC006) {

								$sql92 = " UPDATE  SFCTA
												SET  TA011 = TA011 - '$vTC014', TA012 = TA012 - '$vTC016'
											WHERE TA001 ='$vTC004' and TA002='$vTC005' and TA003='$vTC006'	 
											";


								$this->db->query($sql92);

								if (substr($vTC001, 0, 2) == 'D3') {
									$sql90 = " UPDATE  MOCTA
														SET  TA017 = TA017 - '$vTC014' --, TA018 = TA018 - '$vTC016'
													WHERE TA001 ='$vTC004' and TA002='$vTC005'				
												";
									$this->db->query($sql90);

									//修改製令狀態碼-------------------------------
									//1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工
									$sql89 = " UPDATE  MOCTA
															SET  TA011 = 'Y'
														WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 >= TA015				
												";
									$this->db->query($sql89);

									$sql88 = " UPDATE  MOCTA
															SET  TA011 = '2'
														WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 < TA015				
												";
									$this->db->query($sql88);

									$sql87 = " UPDATE  MOCTA
													SET  TA011 = '1'
												WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 =0				
											";
									$this->db->query($sql87);
									//修改製令狀態碼-------------------------------END


								}
							}
						}
					}
				}
				// doOne 只做一次的意思 --------下面指先扣TC014後  看後面insert or updata 就直接加---------------END

				if (substr($TB001, 0, 2) == 'D3') {
					if ($TB013 == 'Y') {
						if ($TB004 == '1' && $TB007 == '3' && ($TC013 == '1' || $TC013 == '2') && $TC036 != '0') {
							$insert_TG = 'Y';
						}
					}
				}

				if (substr($TB001, 0, 2) == 'D1') { //D1 固定是 6.投入
					$TC013 = '6';
				}

				// insert 、updata 有就修改，沒有就新增---------------------------------
				$sql97 = " select * from SFCTC where TC001='$TB001' and TC002='$TB002' and TC003='$TC003' ";
				$query = $this->db->query($sql97);

				if ($query->num_rows() > 0) {

					$sql98 = " UPDATE  dbo.SFCTC 
							SET	MODIFIER='$modifier', MODI_DATE='$vtoday', FLAG='$flag', TC004='$TC004', TC005='$TC005', TC006='$TC006', TC007='$TC007', TC008='$TC008', TC009='$TC009',
								TC013='$TC013', TC014='$TC014', TC015='$TC014', TC016='$TC016', TC022='$TB013', TC023='$TB005', TC031='$TC031', TC035='$TC035', TC036='$TC036', TC037='$TC037', TC038='$TC038',
								TC039='$TC039', TC041='$TB008', TC047='$TC047', TC201='$TC201'
						   where TC001='$TB001' and TC002='$TB002' and TC003='$TC003' 
						   ";
				} else {
					$sql98 = " INSERT INTO dbo.SFCTC 
					(COMPANY, MODIFIER, USR_GROUP, MODI_DATE, FLAG, TC001, TC002, TC003, TC004, TC005, TC006, TC007, TC008, TC009, TC010,
					 TC013, TC014, TC015, TC016, TC022, TC023, TC026, TC027, TC031, TC035, TC036, TC037, TC038, TC039, TC041, TC047, TC048, TC049, TC201)
			VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TB001', '$TB002', '$TC003', '$TC004', '$TC005', '$TC006', '$TC007', '$TC008', '$TC009', '', 
					 '$TC013', '$TC014', '$TC014', '$TC016', '$TB013', '$TB005', 'N', 'N', '$TC031', '$TC035', '$TC036', '$TC037', '$TC038', '$TC039', '$TB008', '$TC047', '', '', '$TC201'); ";
				}

				$this->db->query($sql98);
				// insert 、updata 有就修改，沒有就新增-------END--------------------------

				if ($insert_TG == 'Y') {
					$sql90 = " UPDATE  MOCTA
									SET  TA017 = TA017 + '$TC014', TA018 = TA018 + '$TC016'
								WHERE TA001 ='$TC004' and TA002='$TC005'				
							";
					$this->db->query($sql90);

					//修改製令狀態碼-------------------------------
					//1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工
					$sql89 = " UPDATE  MOCTA
										SET  TA011 = 'Y'
									WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 >= TA015				
							";
					$this->db->query($sql89);

					$sql88 = " UPDATE  MOCTA
										SET  TA011 = '2'
									WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 < TA015				
							";
					$this->db->query($sql88);

					$sql87 = " UPDATE  MOCTA
										SET  TA011 = '1'
									WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 =0				
								";
					$this->db->query($sql87);
					//修改製令狀態碼-------------------------------END
				}




				if ($TC008) {
					if (substr($TB001, 0, 2) == 'D2') {
						if ($TB013 == 'Y') {
							$sql96 = " UPDATE  SFCTA
											SET  TA010 = TA010 + '$TC014'
										WHERE TA001 ='$TC004' and TA002='$TC005' and TA003='$TC008'				
								";
							$this->db->query($sql96);
						}
					} else {
						if ($TB013 == 'Y') {
							$sql96 = " UPDATE  SFCTA
											SET  TA010 = TA010 + '$TC014', TA012 = TA012 + '$TC016'
										WHERE TA001 ='$TC004' and TA002='$TC005' and TA003='$TC008'				
								";
							$this->db->query($sql96);
						}
					}
				}

				if ($TC006) {
					if ($TB013 == 'Y') {
						$sql95 = " UPDATE  SFCTA
											SET  TA011 = TA011 + '$TC014', TA012 = TA012 + '$TC016'
										WHERE TA001 ='$TC004' and TA002='$TC005' and TA003='$TC006'				
								";
						$this->db->query($sql95);
					}
				}



				$sql99 = " UPDATE  SFCTC
								SET  SFCTC.TC048 = t.MB002,SFCTC.TC049 = t.MB003,SFCTC.TC010 = t.MB004
							FROM SFCTC c 
								INNER JOIN INVMB t
									ON c.TC047=t.MB001
							WHERE c.TC001 ='$TB001' and c.TC002='$TB002' and c.TC003='$TC003'				
							";
				$this->db->query($sql99);

				if ($insert_TG == 'Y') {
					//生產入庫單身檔---------------------------------
					$sql91 = " INSERT INTO dbo.MOCTG 
									(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TG001, TG002, TG003, TG004, TG005, TG006, TG007, TG008, TG009, TG010,
											TG011, TG012, TG013, TG014, TG015, TG016, TG017, TG018, TG019, TG020, TG021, TG022, TG023, TG024)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TB001', '$TB002', '$TC003', '$TC047', '', '', '', '', '1', '$TB008', 
											'$TC036', '$TC016', '$TC014', '$TC004', '$TC005', '$TC039', '', '', '', '$TC007', '', 'Y', '$TC037', '$TC035');
							";

					$this->db->query($sql91);

					$sql92 = " UPDATE  MOCTG
								SET  MOCTG.TG005 = t.MB002,MOCTG.TG006 = t.MB003,MOCTG.TG007 = t.MB004
							FROM MOCTG c 
								INNER JOIN INVMB t
									ON c.TG004=t.MB001
							WHERE c.TG001 ='$TB001' and c.TG002='$TB002' and c.TG003='$TC003'				
							";
					$this->db->query($sql92);
					//生產入庫單身檔---------------------------------end


					$sql90 = " UPDATE  MOCTA
											SET  TA017 = TA017 + '$TC014', TA018 = TA018 + '$TC016'
										WHERE TA001 ='$TB001' and TA002='$TB002'				
									";
					$this->db->query($sql90);

					//修改製令狀態碼-------------------------------
					//1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工
					$sql89 = " UPDATE  MOCTA
										SET  TA011 = 'Y'
									WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 >= TA015				
							";
					$this->db->query($sql89);

					$sql88 = " UPDATE  MOCTA
										SET  TA011 = '2'
									WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 < TA015				
							";
					$this->db->query($sql88);

					$sql87 = " UPDATE  MOCTA
										SET  TA011 = '1'
									WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 =0				
								";
					$this->db->query($sql87);
					//修改製令狀態碼-------------------------------END

					preg_match_all('/\d/S', $this->input->post('TB003'), $matches);  //處理日期字串
					$TB003 = implode('', $matches[0]);

					//更新製令完工日期----------------------------------------
					$SQL97 = " UPDATE  MOCTA 
									SET TA014='$TB003'
								WHERE TA001 ='$TC004' and TA002='$TC005' AND TA017 >= TA015
								";
					$this->db->query($SQL97);
					//更新製令完工日期-------------END---------------------------

					//INVLA 異動明細資料檔
					$vLA010 = $TC004 . '-' . $TC005;
					$sql93 = " INSERT INTO dbo.INVLA
										(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, LA001, LA004, LA005, LA006, LA007, LA008, LA009, LA010, LA011, LA014, LA015)
								VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TC047', '$TB003', '1', '$TB001', '$TB002', '$TC003', '$TB008', '$vLA010', '$TC014', '1', 'Y'); 				
							";
					$this->db->query($sql93);

					//自動生成領料=======================================================================================
					$vTC = false;
					$vTC001 = '';
					$vTC002 = '';

					// if ($TB001 == 'D307') { //衝壓入庫
					// 	$vTC = true;
					// 	$vTC001 = '5407';
					// } else 
					if ($TB001 == 'D309') { //電焊入庫
						$vTC = true;
						$vTC001 = '5409';
					} else if ($TB001 == 'D310') { //鉚合入庫 
						$vTC = true;
						$vTC001 = '5410';
					} else if ($TB001 == 'D311') { //裝配入庫 
						$vTC = true;
						$vTC001 = '5411';
					}

					if ($vTC) {
						//自動生成領料 單頭----------------------------------
						$TB003 = date("Ymd", strtotime($TB003)); //處理日期
						$vTC002 = $this->check_vno_no($vTC001, $TB003);

						$sql89 = " INSERT INTO dbo.MOCTC
											(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TC001, TC002, TC003, TC004, TC005, 
											TC007, TC008, TC009, TC010, TC011, TC012, TC013, TC014, TC015, TC016, TC017, TC018, TC019)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$vTC001', '$vTC002', '$TB003', '$TB010', '$TB005', 
											'$TC031', '54', 'N', '0', 'N', '1', 'Y', '$TB003', '$TB016', 'N', '$TB001', '$TB002', '$TC003'); 
									";

						// echo "<pre>";var_dump($sql89);exit;
						$this->db->query($sql89);
						//自動生成領料 單頭----------------------------------END

						//自動生成領料 單身----------------------------------
						// //------------以BOM------------------------------------------------

						// $sql89a = " SELECT MC004,MD001,MD002,MD003,MD006 FROM BOMMC 
						// 				LEFT JOIN BOMMD ON MC001=MD001
						// 			WHERE MD001 IS NOT NULL AND MD001='$TC047'
						// 			ORDER BY MD001,MD002 ";
						// $query = $this->db->query($sql89a);

						// if ($query->num_rows() > 0) {

						// 	$sql901 = " INSERT INTO dbo.MOCTD
						// 								(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TD001, TD002, TD003, TD004, TD005, 
						// 								TD006, TD008, TD013, TD015, TD017)
						// 						VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$vTC001', '$vTC002', '$TC004', '$TC005', '1',
						// 								'$TC036', '1', 'N', '1', '1'); 
						// 				";
						// 	$this->db->query($sql901);

						// 	$vTE003 = 0;
						// 	foreach ($query->result() as $k => $v) {
						// 		$vTE003++;
						// 		$vTE005 = round($TC014 * $v->MD006 / $v->MC004, 3);
						// 		$vTE003 = str_pad($vTE003, 4, "0", STR_PAD_LEFT);
						// 		$vTE004 = trim($v->MD003);


						// 		$sqlE8 = " SELECT * FROM INVMB WHERE MB001='$vTE004' ";
						// 		$query = $this->db->query($sqlE8);
						// 		if ($query->num_rows() > 0) {
						// 			$vTE008 = trim($query->result()[0]->MB017);
						// 		}

						// 		# code...
						// 		$sql90 = " INSERT INTO dbo.MOCTE
						// 					(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, 
						// 					TE006, TE007, TE008, TE009, TE010, TE011, TE012, TE013, TE014, TE015, TE016, TE017, TE018, TE019)
						// 			VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$vTC001', '$vTC002', '$vTE003', '$vTE004', '$vTE005', 
						// 					'', '', '$vTE008', '****', '', '$TC004', '$TC005', '', '$TC031', '', '1', '', '', 'N'); 
						// 			";

						// 		$this->db->query($sql90);

						// 		$sql95 = " UPDATE  MOCTE
						// 				SET  MOCTE.TE017 = t.MB002,MOCTE.TE018 = t.MB003,MOCTE.TE006 = t.MB004
						// 			FROM MOCTE c 
						// 				INNER JOIN INVMB t
						// 					ON c.TE004=t.MB001
						// 			WHERE c.TE001 ='$vTC001' and c.TE002='$vTC002' and c.TE003='$vTE003'				
						// 			";
						// 		$this->db->query($sql95);

						// 		// //INVLA 異動明細資料檔-自動生成領料--------------------------
						// 		// $vLA010 = $TC004 . '-' . $TC005;
						// 		// $sql93 = " INSERT INTO dbo.INVLA
						// 		// 			(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, LA001, LA004, LA005, LA006, LA007, 
						// 		// 			LA008, LA009, LA010, LA011, LA014, LA015)
						// 		// 	VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$vTE004', '$TB003', '-1', '$vTC001', '$vTC002', 
						// 		// 			'$vTE003', '$vTE008', '$vLA010', '$vTE005', '3', 'Y'); 				
						// 		// 	";
						// 		// $this->db->query($sql93);
						// 		// //INVLA 異動明細資料檔-自動生成領料--------------------------end
						// 	}
						// }
						// //------------以BOM----------------END--------------------------------

						//自動生成領料 單身----------------------------------END

						//------------以製令------------------------------------------------
						$sql89a = " SELECT * FROM MOCTA 
									left join MOCTB on TA001=TB001 and TA002=TB002										
								WHERE TA001='$TC004' AND TA002='$TC005' AND TA006='$TC047'
								";
						$query = $this->db->query($sql89a);

						// echo "<pre>";var_dump($sql89a);exit;

						if ($query->num_rows() > 0) {

							$sql901 = " INSERT INTO dbo.MOCTD
													(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TD001, TD002, TD003, TD004, TD005, 
													TD006, TD008, TD013, TD015, TD017)
											VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0','$vTC001', '$vTC002', '$TC004', '$TC005', '1',
													'$TC036', '1', 'N', '1', '1'); 
									";
							$this->db->query($sql901);

							$vTE003 = 0;
							foreach ($query->result() as $k => $v) {
								$vTE003++;
								// $vTE005 =  round($TC014 * $v->TA015 / ($v->TB004 == 0 ? 1 : $v->TB004), 3);
								$vTE005 =  round($TC014 * $v->TB004 / ($v->TA015 == 0 ? 1 : $v->TA015), 3);
								$vTE003 = str_pad($vTE003, 4, "0", STR_PAD_LEFT);
								$vTE004 = trim($v->TB003);
								$vTE008 = $v->TB009;



								$sql90 = " INSERT INTO dbo.MOCTE
												(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TE001, TE002, TE003, TE004, TE005, 
												TE006, TE007, TE008, TE009, TE010, TE011, TE012, TE013, TE014, TE015, TE016, TE017, TE018, TE019)
										VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$vTC001', '$vTC002', '$vTE003', '$vTE004', '$vTE005', 
												'', '', '$vTE008', '****', '', '$TC004', '$TC005', '', '$TC031', '', '1', '', '', 'N'); 
										";

								$this->db->query($sql90);

								$sql95 = " UPDATE  MOCTE
											SET  MOCTE.TE017 = t.MB002,MOCTE.TE018 = t.MB003,MOCTE.TE006 = t.MB004
										FROM MOCTE c 
											INNER JOIN INVMB t
												ON c.TE004=t.MB001
										WHERE c.TE001 ='$vTC001' and c.TE002='$vTC002' and c.TE003='$vTE003'				
										";
								$this->db->query($sql95);
							}
						}
						//------------以製令----------------END--------------------------------



					}
					//自動生成領料=======================================================================================END
				}
			}
			if ($insert_TG == 'Y') {
				preg_match_all('/\d/S', $this->input->post('TB003'), $matches);  //處理日期字串
				$TB003 = implode('', $matches[0]);
				$sql90 = " INSERT INTO dbo.MOCTF
									(COMPANY, CREATOR, USR_GROUP, CREATE_DATE, FLAG, TF001, TF002, TF003, TF004, TF005, TF006, TF007, TF008, TF009, TF010, TF011, TF012, TF013, TF014)
							VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '0', '$TB001', '$TB002', '$TB003', '$TB010', '', 'Y', 'N', '0', 'N', 'N', '$TB005', '$TB003', '$modifier', 'N'); 
						";

				$this->db->query($sql90);
			}
		}
	}

	//查複製資料是否重複	 
	function seldetail($seg1, $seg2, $seg3)
	{
		$this->db->where('tc001', $seg1);
		$this->db->where('tc002', $seg2);
		$this->db->where('tc003', $seg3);
		$query = $this->db->get('sfctc');
		return $query->num_rows();
	}

	//刪除一筆 	
	function deletef($seg1)
	{
		$this->db->where('TB001', $this->uri->segment(4));
		$this->db->where('TB002', $this->uri->segment(5));
		$this->db->delete('sfctb');
		$this->db->where('tc001', $this->uri->segment(4));
		$this->db->where('tc002', $this->uri->segment(5));
		$this->db->delete('sfctc');
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	//刪除一筆細項	
	function deletedetailf($seg1, $seg2, $seg3)
	{
		// $this->db->where('tc001', $seg1);
		// $this->db->where('tc002', $seg2);
		// $this->db->where('tc003', $seg3);
		// $this->db->delete('sfctc');
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }

		//先刪除  自動生成領料======-----------
		$sqlauto = " SELECT DISTINCT TC001,TC002 FROM MOCTC
						WHERE RTRIM(TC017) <>'' AND TC017='$seg1' AND TC018='$seg2' AND TC019='$seg3'
						";
		$query = $this->db->query($sqlauto);
		$onetime = 'Y';
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $r) {
				//更新製令單身 已領料數量-------------------------
				$sqld0 = " UPDATE MOCTB 
								SET TB005 = TB005 - (SELECT TE005 FROM MOCTE WHERE TE001=TD001 AND TE002=TD002 AND TE004=TB003) 
							FROM MOCTB
								INNER JOIN MOCTD ON TB001=TD003 AND TB002=TD004
								INNER JOIN MOCTC ON TD001=TC001 AND TD002=TC002
									WHERE TD001='$r->TC001' AND TD002='$r->TC002' AND TC009='Y'	
									 ";
				$this->db->query($sqld0);
				//更新製令單身 已領料數量------END-------------------	

				//更新製令單頭 已領料數量-------------------------
				$sqld0 = " UPDATE MOCTA 
									SET TA016 = TA016 - TD006 
								FROM MOCTA
									LEFT JOIN MOCTD ON TA001=TD003 AND TA002=TD004
									LEFT JOIN MOCTC ON TD001=TC001 AND TD002=TC002
										WHERE TC009='Y' AND TD001='$r->TC001' AND TD002='$r->TC002'	
									";
				$this->db->query($sqld0);
				//更新製令單頭 已領料數量-------END------------------

				$sqld11 = " DELETE FROM MOCTD   
								WHERE TD001='$r->TC001' and TD002='$r->TC002'
						";
				$this->db->query($sqld11);

				$sqld1 = " DELETE FROM MOCTE   
								WHERE TE001='$r->TC001' and TE002='$r->TC002'
						";
				$this->db->query($sqld1);

				$sqld2 = " DELETE FROM INVLA   
								WHERE LA006='$r->TC001' and LA007='$r->TC002'
						";
				$this->db->query($sqld2);
			}
		}
		$sqld3 = " DELETE FROM MOCTC   
						WHERE TC017='$seg1' AND TC018='$seg2' AND TC019='$seg3'
				";
		$this->db->query($sqld3);

		//先刪除  自動生成領料======-----------end

		//刪除  生產入庫單---------------------------

		$sql92 = " DELETE FROM  MOCTG
							WHERE TG001 ='$seg1' and TG002='$seg2' and TG003='$seg3' 				
							";
		$this->db->query($sql92);

		//刪除  生產入庫單---------------------------END


		$sql95 = " SELECT *
						FROM  SFCTC
					where TC001='$seg1' and TC002='$seg2' and TC003='$seg3' 				
				";
		$query = $this->db->query($sql95);

		if ($query->num_rows() > 0) {
			$aSFCTC = $query->result();

			foreach ($aSFCTC as $key => $val) {
				# code...
				$vTC001 = $val->TC001;
				$vTC002 = $val->TC002;
				$vTC003 = $val->TC003;
				$vTC014 = $val->TC014;
				$vTC008 = $val->TC008;
				$vTC004 = $val->TC004;
				$vTC005 = $val->TC005;
				$vTC006 = $val->TC006;
				$vTC016 = $val->TC016;
				$vTC047 = $val->TC047;
				$vTC036 = $val->TC036;
				$vTC039 = $val->TC039;
				$vTC007 = $val->TC007;
				$vTC037 = $val->TC037;
				$vTC035 = $val->TC035;
				$mTE005 = $vTC014;

				//取原本是否有確認 $oTB013----------------------
				$sql92 = " SELECT TB013 FROM  SFCTB
									where TB001='$vTC001' and TB002='$vTC002' 				
								";
				$query = $this->db->query($sql92);
				$oTB013 = $query->result()[0]->TB013;
				//取原本是否有確認 $oTB013----------------------END

				if ($oTB013 = 'Y') {
					if ($vTC008) {
						//
						if (substr($vTC001, 0, 2) == 'D2') {
							$sql93 = " UPDATE  SFCTA
												SET  TA010 = TA010 - '$vTC014'
											WHERE TA001 ='$vTC004' and TA002='$vTC005' and TA003='$vTC008'
											";
							$this->db->query($sql93);
						} else {
							$sql93 = " UPDATE  SFCTA
												SET  TA010 = TA010 - '$vTC014', TA012 = TA012 - '$vTC016'
											WHERE TA001 ='$vTC004' and TA002='$vTC005' and TA003='$vTC008'
											";
							$this->db->query($sql93);
						}
					}
					if ($vTC006) {
						$sql92 = " UPDATE  SFCTA
												SET  TA011 = TA011 - '$vTC014', TA012 = TA012 - '$vTC016'
											WHERE TA001 ='$vTC004' and TA002='$vTC005' and TA003='$vTC006'	 
											";
						$this->db->query($sql92);

						if (substr($vTC001, 0, 2) == 'D3') {
							$sql90 = " UPDATE  MOCTA
												SET  TA017 = TA017 - '$vTC014' --, TA018 = TA018 - '$vTC016'
											WHERE TA001 ='$vTC004' and TA002='$vTC005'				
										";
							$this->db->query($sql90);

							//修改製令狀態碼-------------------------------
							//1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工
							$sql89 = " UPDATE  MOCTA
										SET  TA011 = 'Y'
									WHERE TA001 ='$vTC004' and TA002='$vTC005' AND TA017 >= TA015				
							";
							$this->db->query($sql89);

							$sql88 = " UPDATE  MOCTA
										SET  TA011 = '2'
									WHERE TA001 ='$vTC004' and TA002='$vTC005' AND TA017 < TA015				
							";
							$this->db->query($sql88);

							$sql87 = " UPDATE  MOCTA
										SET  TA011 = '1'
									WHERE TA001 ='$vTC004' and TA002='$vTC005' AND TA017 =0				
							";
							$this->db->query($sql87);
							//修改製令狀態碼-------------------------------END

							//刪除  異動明細資料檔---------------------------
							$sql92 = " DELETE FROM  INVLA
											WHERE LA006 ='$seg1' and LA007='$seg2' and LA008='$seg3'				
									";
							$this->db->query($sql92);
							//刪除  異動明細資料檔---------------------------END


						}
					}
				}
			}
		}

		$sql97 = " DELETE FROM dbo.SFCTC
					where TC001='$seg1' and TC002='$seg2' and TC003='$seg3'
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
		$querydelTC = true;
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;
				list($seq1, $seq2) = explode("/", $seq[$x]);
				$seq1;
				$seq2;
				//只要有一筆Y就不能刪除
				// $query6c = $this->db->query("SELECT UPPER(TC026) as TC0261 FROM SFCTC WHERE TC001='$seq1' AND TC002='$seq2' AND ( UPPER(TC026)='Y' or TC009>'0' ) ");				
				// $query6c = $this->db->query("SELECT UPPER(TC022) as TC0221 FROM SFCTC WHERE TC001='$seq1' AND TC002='$seq2' AND UPPER(TC022)='Y' ");
				$query6c = $this->db->query("SELECT UPPER(TB013) as TB0131 FROM SFCTB WHERE TB001='$seq1' AND TB002='$seq2' AND UPPER(TB013)='Y' ");
				foreach ($query6c->result() as $row) {
					$tb0131[] = $row->TB0131;
				}
				if (isset($tb0131[0])) {
					$vtb0131 = $tb0131[0];
				} else {
					$vtb0131 = 'N';
				}    //確認碼


				if ($vtb0131 != 'Y') {
					// $this->db->where('TB001', $seq1);
					// $this->db->where('TB002', $seq2);
					// $this->db->delete('SFCTB');

					//先刪除  自動生成領料======-----------
					$sqlauto = " SELECT DISTINCT TC001,TC002 FROM MOCTC
									WHERE RTRIM(TC017) <>'' AND TC017='$seq1' AND TC018='$seq2'
									ORDER BY TC002  ";
					$query = $this->db->query($sqlauto);
					$onetime = 'Y';
					if ($query->num_rows() > 0) {
						foreach ($query->result() as $r) {
							//更新製令單身 已領料數量-------------------------
							$sqld0 = " UPDATE MOCTB 
											SET TB005 = TB005 - (SELECT TE005 FROM MOCTE WHERE TE001=TD001 AND TE002=TD002 AND TE004=TB003) 
										FROM MOCTB
											INNER JOIN MOCTD ON TB001=TD003 AND TB002=TD004
											INNER JOIN MOCTC ON TD001=TC001 AND TD002=TC002
												WHERE TD001='$r->TC001' AND TD002='$r->TC002' AND TC009='Y'
												";
							$this->db->query($sqld0);
							//更新製令單身 已領料數量------END-------------------	

							//更新製令單頭 已領料數量-------------------------
							$sqld0 = " UPDATE MOCTA 
												SET TA016 = TA016 - TD006  
											FROM MOCTA
												LEFT JOIN MOCTD ON TA001=TD003 AND TA002=TD004
												LEFT JOIN MOCTC ON TD001=TC001 AND TD002=TC002
													WHERE TC009='Y' AND TD001='$r->TC001' AND TD002='$r->TC002' 
												";
							$this->db->query($sqld0);
							//更新製令單頭 已領料數量-------END------------------

							$sqld11 = " DELETE FROM MOCTD   
											WHERE TD001='$r->TC001' and TD002='$r->TC002'
									";
							$this->db->query($sqld11);

							$sqld1 = " DELETE FROM MOCTE   
											WHERE TE001='$r->TC001' and TE002='$r->TC002'
									";
							$this->db->query($sqld1);

							$sqld2 = " DELETE FROM INVLA   
											WHERE LA006='$r->TC001' and LA007='$r->TC002'
									";
							$this->db->query($sqld2);
						}
					}
					$sqld3 = " DELETE FROM MOCTC   
									WHERE TC017='$seq1' AND TC018='$seq2'
							";
					$this->db->query($sqld3);



					//先刪除  自動生成領料======-----------end

					//刪除  生產入庫單---------------------------

					$sql92 = " DELETE FROM  MOCTG
									WHERE TG001 ='$seq1' and TG002='$seq2'				
							";
					$this->db->query($sql92);

					$sql90 = " DELETE FROM dbo.MOCTF
									WHERE TF001 ='$seq1' and TF002='$seq2'	
							";

					$this->db->query($sql90);

					//刪除  生產入庫單---------------------------END

					//刪除  異動明細資料檔---------------------------
					$sql92 = " DELETE FROM  INVLA
									WHERE LA006 ='$seq1' and LA007='$seq2'				
							";
					$this->db->query($sql92);
					//刪除  異動明細資料檔---------------------------END

					//取原本是否有確認 $oTB013----------------------
					$sql92 = " SELECT TB013 FROM  SFCTB
									where TB001='$seq1' and TB002='$seq2' 				
								";
					$query = $this->db->query($sql92);
					$oTB013 = $query->result()[0]->TB013;
					//取原本是否有確認 $oTB013----------------------END

					$this->db->query(" DELETE FROM SFCTB WHERE TB001='$seq1' AND TB002='$seq2' ");

					$sql95 = " SELECT *
									FROM  SFCTC
								where TC001='$seq1' and TC002='$seq2' 				
							";
					$query = $this->db->query($sql95);
					if ($query->num_rows() > 0) {
						$aSFCTC = $query->result();

						foreach ($aSFCTC as $key => $val) {
							# code...
							$vTC001 = $val->TC001;
							$vTC014 = $val->TC014;
							$vTC008 = $val->TC008;
							$vTC004 = $val->TC004;
							$vTC005 = $val->TC005;
							$vTC006 = $val->TC006;
							$vTC016 = $val->TC016;
							$vTC047 = $val->TC047;


							if ($oTB013 == 'Y') {
								if ($vTC008) {
									if (substr($vTC001, 0, 2) == 'D2') {
										$sql93 = " UPDATE  SFCTA
															SET  TA010 = TA010 - '$vTC014'
														WHERE TA001 ='$vTC004' and TA002='$vTC005' and TA003='$vTC008'	 
														";
										$this->db->query($sql93);
									} else {
										$sql93 = " UPDATE  SFCTA
															SET  TA010 = TA010 - '$vTC014', TA012 = TA012 - '$vTC016'
														WHERE TA001 ='$vTC004' and TA002='$vTC005' and TA003='$vTC008'	 
														";
										$this->db->query($sql93);
									}
								}
								if ($vTC006) {
									$sql92 = " UPDATE  SFCTA
															SET  TA011 = TA011 - '$vTC014', TA012 = TA012 - '$vTC016'
														WHERE TA001 ='$vTC004' and TA002='$vTC005' and TA003='$vTC006'	 
														";
									$this->db->query($sql92);

									if (substr($vTC001, 0, 2) == 'D3') {
										$sql90 = " UPDATE  MOCTA
															SET  TA017 = TA017 - '$vTC014' --, TA018 = TA018 - '$vTC016'
														WHERE TA001 ='$vTC004' and TA002='$vTC005'				
													";
										$this->db->query($sql90);

										//修改製令狀態碼-------------------------------
										//1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工
										$sql89 = " UPDATE  MOCTA
																SET  TA011 = 'Y'
															WHERE TA001 ='$vTC004' and TA002='$vTC005' AND TA017 >= TA015				
													";
										$this->db->query($sql89);

										$sql88 = " UPDATE  MOCTA
																SET  TA011 = '2'
															WHERE TA001 ='$vTC004' and TA002='$vTC005' AND TA017 < TA015				
													";
										$this->db->query($sql88);

										$sql87 = " UPDATE  MOCTA
															SET  TA011 = '1'
														WHERE TA001 ='$vTC004' and TA002='$vTC005' AND TA017 =0				
													";
										$this->db->query($sql87);
										//修改製令狀態碼-------------------------------END
									}
								}
							}
						}
					}


					// $this->db->where('TC001', $seq1);
					// $this->db->where('TC002', $seq2);
					// $this->db->delete('SFCTC');

					$querydelTC = $this->db->query(" DELETE FROM SFCTC WHERE TC001='$seq1' AND TC002='$seq2' ");

					$this->session->set_userdata('msg1', "未確認已刪除");
				} else {
					$this->session->set_userdata('msg1', "已確認不可刪除");
					$_SESSION['message1'] = "已確認不可刪除";
				}
			}
		}
		return $querydelTC;
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }
		// return FALSE;
	}

	//刪除明細一筆新增修改時使用   
	function del_detail()
	{
		$this->db->where('tc001', $_POST['del_md001']);
		$this->db->where('tc002', $_POST['del_md002']);
		$this->db->where('tc003', $_POST['del_md003']);
		$this->db->delete('sfctc');
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
	function check_title_no($sfci01m, $TB003)
	{
		preg_match_all('/\d/S', $TB003, $matches);  //處理日期字串
		$TB003 = implode('', $matches[0]);
		// $this->db->select('MAX(TB002) as max_no')
		// 	->from('sfctb')
		// 	->where('TB001', $sfci01)
		// 	->like('TB015', $TB015, "after");

		$sql98 = " select MAX(TB002) as max_no from SFCTB where TB001='$sfci01m' AND TB002 LIKE '$TB003%' ";

		$query = $this->db->query($sql98);
		$result = $query->result();

		if (!$result[0]->max_no) {
			return $TB003 . "001";
		}

		return $result[0]->max_no + 1;
	}
	function check_vno_no($TC001, $TC002)
	{
		$TC002 = date("Ymd", strtotime($TC002));  //處理日期字串

		$sql98 = " select MAX(TC002) as max_no from MOCTC where TC001='$TC001' AND TC002 LIKE '$TC002%' ";
		// $this->db->select('MAX(id) as max_no')
		// 	->from('invoice');
		//	->where('TB039', $TB039);
		//	->like('TB039', $TB039, "after");

		$query = $this->db->query($sql98);
		$result = $query->result();

		if (!$result[0]->max_no) {
			return $TC002 . "001";
		}

		return $result[0]->max_no + 1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
