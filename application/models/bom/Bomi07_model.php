<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bomi07_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//查詢 table 表所有資料	 
	function selbrowse($num, $offset)
	{
		$this->db->select('me001, me002, me003, me004,  create_date');
		$this->db->from('bomme');
		//$this->db->order_by('id', 'DESC');                //排序  單欄
		$this->db->order_by('me001 desc, me002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();
		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('bomme');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('me001', 'me002', 'me003', 'me004', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('me001, me002, me003, me004,create_date')
			->from('bomme')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('bomme');
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
		$this->session->set_userdata('bomi07_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where") {
			unset($_SESSION['bomi07']['search']);
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['bomi07']['search']);
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
		$default_order = "me001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['bomi07']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['bomi07']['search']['where'];
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

		if (isset($_SESSION['bomi07']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['bomi07']['search']['order'];
		}

		if (!isset($_SESSION['bomi07']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		//	$query = $this->db->select('me001, me002, me003, me004, create_date')
		//		->from('bomme')
		$query = $this->db->select('mf001, mb002, mb003, mf002, me003')
			->from('bomme')
			->join('bommf', 'bommf.mf001 = bomme.me001', 'left')
			->join('invmb', 'invmb.mb001 = bomme.me001', 'left')
			->order_by($order);
		if ($where) {
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		$query = $this->db->select('mf001, mb002, mb003, mf002, me003')
			->from('bomme')
			->join('bommf', 'bommf.mf001 = bomme.me001', 'left')
			->join('invmb', 'invmb.mb001 = bomme.me001', 'left')
			//	$query = $this->db->select('me001, me002, me003, me004, create_date')
			//		->from('bomme')
			->order_by($order)
			->limit($limit, $offset);
		if ($where) {
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['bomi07']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('bomme');
		if ($where) {
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;

		//儲存where與order
		$_SESSION['bomi07']['search']['where'] = $where;
		$_SESSION['bomi07']['search']['order'] = $order;
		$_SESSION['bomi07']['search']['offset'] = $offset;

		return $ret;
	}
	//查詢修改用 (看資料用)   
	function selone($seq1, $seq2)
	{
		$this->db->select('a.* ,c.mb002 as me001disp,c.mb003 as me001disp1,c.mb004 as me001disp2,b.*,d.mw002 as mf004disp
		  ');

		$this->db->from('bomme as a');
		$this->db->join('bommf as b', 'a.me001 = b.mf001 and a.me002=b.mf002  ', 'left');
		$this->db->join('invmb as c', 'a.me001 = c.mb001   ', 'left');
		$this->db->join('cmsmw as d', 'b.mf004 = d.mw001   ', 'left');
		$this->db->where('a.me001', $this->uri->segment(4));
		$this->db->where('a.me002', $this->uri->segment(5));
		$this->db->order_by('a.me001 , a.me002');

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result;
		}
	}

	//ajax 查詢一筆 顯示 鍵值 
	function ajaxkey($seg1)
	{
		//  $this->db->set('me001', $this->uri->segment(4));
		$this->db->where('me001', $this->uri->segment(4));
		$this->db->where('me002', $this->uri->segment(5));
		$query = $this->db->get('bomme');
		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->me001 . $row->me002;
			}
			return $result;
		}
	}

	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword)
	{
		$this->db->select('mw001, mw002,mw003,mw004,mw005,mw006')->from('cmsmw');
		$this->db->like('mw001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('mw002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('15');
		$query = $this->db->get();
		return $query->result();
	}

	//ajax 查詢 顯示 請購單別 mf001	
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

	//ajax 查詢顯示用 廠別 me010  
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
		$this->db->select_max('me002');
		$this->db->where('me001', $this->uri->segment(4));
		$this->db->where('me013', $this->uri->segment(5));
		$query = $this->db->get('bomme');
		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->me002;
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
		$seq11 = "SELECT COUNT(*) as count  FROM `bomme` ";
		$seq1 = "me001, me002, me003, me004,  create_date FROM `bomme` ";
		$seq2 = "WHERE `create_date` >=' ' ";
		$seq32 = "`create_date` >='' ";
		$seq33 = 'me001 desc';
		$seq9 = " ORDER BY me001 ";
		$seq91 = " limit ";
		$seq92 = ", ";
		$seq5 = "`create_date` >='' ";
		// $seq5=$this->session->userdata('find05');
		// $seq7=$this->session->userdata('find07');
		$seq7 = "me001 ";

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
		if (@$_SESSION['bomi07_sql_term']) {
			$seq32 = $_SESSION['bomi07_sql_term'];
		}
		if (@$_SESSION['bomi07_sql_sort']) {
			$seq33 = $_SESSION['bomi07_sql_sort'];
		}

		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('me001', 'me002', 'me003', 'me004', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('me001, me002, me003, me004, create_date')
			->from('bomme')
			->where($seq32)
			->order_by($seq33)
			//->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('bomme')
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
		$sort_columns = array('me001', 'me002', 'me003', 'me004', 'create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否為 table
		$this->db->select('me001, me002, me003, me004,  create_date');
		$this->db->from('bomme');
		$this->db->like($sort_by, $seq4, 'after');
		$this->db->order_by($sort_by, $sort_order);
		//$this->db->order_by('me001 asc, me002 asc');
		$this->db->limit($limit, $offset);   // 每頁15筆
		$query = $this->db->get();
		$ret['rows'] = $query->result();

		$this->db->select('COUNT(*) as count');    // 計算筆數	
		$this->db->from('bomme');
		$this->db->like($sort_by, $seq4, 'after');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//查新增資料是否重複 (單頭)  
	function selone1($seg1)
	{
		$this->db->where('me001', $this->input->post('invq02a'));
		//  $this->db->where('me002', $this->input->post('me002'));
		$query = $this->db->get('bomme');
		return $query->num_rows();
	}

	//查新增資料是否重複 (單身)	
	function selone1d($seg1)
	{
		$this->db->where('mf001', $this->input->post('invq02a'));
		$this->db->where('mf002', $this->input->post('mf002'));
		$query = $this->db->get('bommf');
		return $query->num_rows();
	}

	//新增一筆 檔頭  bomme	
	function insertf()    //新增一筆 檔頭  bomme
	{
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'me001' => $this->input->post('invq02a'),
			'me002' => $this->input->post('me002'),
			'me003' => $this->input->post('me003'),
			'me004' => $this->input->post('me004')

		);

		$exist = $this->bomi07_model->selone1($this->input->post('invq02a'));
		if ($exist) {
			return 'exist';
		}
		$this->db->insert('bomme', $data);

		// 新增明細 bommf

		$n = '0';
		$mf003 = '1000';
		if (!isset($_POST['order_product'][$n]['mf004'])) {
			$n = '10';
		}
		//	while (($_POST['order_product'][  $n  ]['mf004']) > '0' ) {
		while ($_POST['order_product'][$n]['mf004']) {

			//  if  ( $_POST['order_product'][ $n  ]['mf003']='' )  $_POST['order_product'][ $n  ]['mf003']= 0;


			$data_array = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' => date("Ymd"),
				'modifier' => '',
				'modi_date' => '',
				'flag' => 0,
				'mf001' => $this->input->post('invq02a'),
				'mf002' => $this->input->post('me002'),
				'mf003' =>  $mf003,
				'mf004' => $_POST['order_product'][$n]['mf004'],
				'mf005' =>  $_POST['order_product'][$n]['mf005'],
				'mf006' => $_POST['order_product'][$n]['mf006'],
				'mf007' =>  $_POST['order_product'][$n]['mf007'],
				'mf008' => $_POST['order_product'][$n]['mf008'],
				'mf009' =>  $_POST['order_product'][$n]['mf009'],
				'mf010' => $_POST['order_product'][$n]['mf010'],
				'mf011' =>  $_POST['order_product'][$n]['mf011'],
				'mf012' => $_POST['order_product'][$n]['mf012'],
				'mf013' =>  $_POST['order_product'][$n]['mf013'],
				'mf015' => $_POST['order_product'][$n]['mf015'],
				'mf017' =>  $_POST['order_product'][$n]['mf017'],
				'mf018' => $_POST['order_product'][$n]['mf018'],
				'mf019' =>  $_POST['order_product'][$n]['mf019'],
				'mf022' => $_POST['order_product'][$n]['mf022'],
				'mf023' => $_POST['order_product'][$n]['mf023'],
				'mf024' =>  $_POST['order_product'][$n]['mf024'],
				'mf025' => $_POST['order_product'][$n]['mf025'],
				'mf026' =>  $_POST['order_product'][$n]['mf026']
			);

			$exist = $this->bomi07_model->selone1d($this->input->post('invq02a'), $this->input->post('mf002'));
			if ($_POST['order_product'][$n]['mf004'] > '') {
				$this->db->insert('bommf', $data_array);
			}
			//  $this->db->insert('bommf', $data_array);

			$mmf003 = (int) $mf003 + 10;
			$mf003 =  (string)$mmf003;
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
		$this->db->where('me001', $this->input->post('me001c'));
		$this->db->where('me002', $this->input->post('me002c'));
		$query = $this->db->get('bomme');
		return $query->num_rows();
	}

	//複製一筆	
	function copyf()
	{
		$this->db->where('me001', $this->input->post('me001o'));
		$this->db->where('me002', $this->input->post('me002o'));
		$query = $this->db->get('bomme');
		$exist = $query->num_rows();
		if (!$exist) {
			return 'exist';
		}
		//   if ($query->num_rows() != 1) { return 'exist'; }
		if ($query->num_rows() == 1) {
			$result = $query->result();
			foreach ($result as $row) :
				$me003 = $row->me003;
				$me004 = $row->me004;

			endforeach;
		}

		$seq1 = $this->input->post('me001c');    //主鍵一筆檔頭bomme
		$seq2 = $this->input->post('me002c');
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
			'me001' => $seq1, 'me002' => $seq2, 'me003' => $me003, 'me004' => $me004
		);

		$exist = $this->bomi07_model->selone2($this->input->post('me001c'), $this->input->post('me002c'));
		if ($exist) {
			return 'exist';
		}
		$this->db->insert('bomme', $data);      //複製一筆  

		//複製一筆明細
		$this->db->where('mf001', $this->input->post('me001o'));
		$this->db->where('mf002', $this->input->post('me002o'));
		//	$this->db->where('mf001', $this->uri->segment(4));
		//	$this->db->where('mf002', $this->uri->segment(5));
		//	$this->db->where('mf004 >', '');
		$query = $this->db->get('bommf');
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

				$mf003[$i] = $row->mf003;
				$mf004[$i] = $row->mf004;
				$mf005[$i] = $row->mf005;
				$mf006[$i] = $row->mf006;
				$mf007[$i] = $row->mf007;
				$mf008[$i] = $row->mf008;
				$mf009[$i] = $row->mf009;
				$mf010[$i] = $row->mf010;
				$mf011[$i] = $row->mf011;
				$mf012[$i] = $row->mf012;
				$mf013[$i] = $row->mf013;
				$mf014[$i] = $row->mf014;
				$mf015[$i] = $row->mf015;
				$mf016[$i] = $row->mf016;
				$mf017[$i] = $row->mf017;
				$mf018[$i] = $row->mf018;
				$mf019[$i] = $row->mf019;
				$mf020[$i] = $row->mf020;
				$mf021[$i] = $row->mf021;
				$mf022[$i] = $row->mf022;
				$mf023[$i] = $row->mf023;
				$mf024[$i] = $row->mf024;
				$mf025[$i] = $row->mf025;
				$mf026[$i] = $row->mf026;
				$mf027[$i] = $row->mf027;

				$i++;
			endforeach;
		}
		$seq1 = $this->input->post('me001c');    //主鍵一筆明細bommf
		$seq2 = $this->input->post('me002c');
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

				'mf001' => $seq1, 'mf002' => $seq2, 'mf003' => $mf003[$i], 'mf004' => $mf004[$i], 'mf005' => $mf005[$i], 'mf006' => $mf006[$i],
				'mf007' => $mf007[$i], 'mf008' => $mf008[$i], 'mf009' => $mf009[$i], 'mf010' => $mf010[$i], 'mf011' => $mf011[$i], 'mf012' => $mf012[$i],
				'mf013' => $mf013[$i], 'mf014' => $mf014[$i], 'mf015' => $mf015[$i], 'mf016' => $mf016[$i], 'mf017' => $mf017[$i], 'mf018' => $mf018[$i],
				'mf019' => $mf019[$i], 'mf020' => $mf020[$i], 'mf021' => $mf021[$i], 'mf022' => $mf022[$i], 'mf023' => $mf023[$i], 'mf024' => $mf024[$i],
				'mf025' => $mf025[$i], 'mf026' => $mf026[$i], 'mf027' => $mf027[$i]
			);
			// IF ($mf004[$i]!='') {	
			//  $this->db->insert('bommf', $data_array); }     //複製一筆 
			$this->db->insert('bommf', $data_array);
			$i++;
		}
		return true;
	}

	//轉excel檔   
	function excelnewf()
	{
		$seq1 = $this->input->post('me001o');
		$seq2 = $this->input->post('me001c');
		//  $seq3=$this->input->post('me002o');    
		//  $seq4=$this->input->post('me002c');
		$sql = " SELECT me001,me002,me003,me004,create_date FROM bomme WHERE me001 >= '$seq1'  AND me001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('me001o');
		$seq2 = $this->input->post('me001c');
		//  $seq3=$this->input->post('me002o');    
		//   $seq4=$this->input->post('me002c');
		$sql = " SELECT * FROM bomme WHERE me001 >= '$seq1'  AND me001 <= '$seq2'   ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();
		$seq32 = "me001 >= '$seq1'  AND me001 <= '$seq2'   ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('bomme')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//選取印單據筆	
	function printfd1()
	{
		$this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mf001, b.mf002, b.mf003, b.mf004, b.mf005,
		  b.mf006');

		$this->db->from('bomme as a');
		$this->db->join('bommf as b', 'a.me001 = b.mf001   ', 'left');
		$this->db->where('a.me001', $this->uri->segment(4));

		$this->db->order_by('me001 , b.mf002');

		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1 = $this->uri->segment(4);
		$seq2 = $this->uri->segment(5);
		$this->db->where('mf001', $this->uri->segment(4));
		//$this->db->where('mf002', $this->uri->segment(5));
		$query = $this->db->get('bommf');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//印單據筆   
	function printfc()
	{
		$this->db->select('a.* ,c.mq002 AS me001disp, d.me002 AS me004disp, e.mb002 AS me010disp, f.mv002 AS me012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mf001, b.mf002, b.mf003, b.mf004, b.mf005,
		  b.mf006, b.mf007, b.mf011, b.mf009, b.mf017, b.mf018, b.mf012');

		$this->db->from('bomme as a');
		$this->db->join('bommf as b', 'a.me001 = b.mf001  and a.me002=b.mf002 ', 'left');
		$this->db->join('cmsmq as c', 'a.me001 = c.mq001 and c.mq003="31" ', 'left');
		$this->db->join('cmsme as d', 'a.me004 = d.me001 ', 'left');
		$this->db->join('cmsmb as e', 'a.me010 = e.mb001 ', 'left');
		$this->db->join('cmsmv as f ', 'a.me012 = f.mv001 and f.mv022 = " " ', 'left');
		$this->db->where('a.me001', $this->input->post('me001o'));
		$this->db->where('a.me002', $this->input->post('me002o'));
		$this->db->order_by('me001 , me002 ,b.mf003');

		$query = $this->db->get();
		$result['rows'] = $query->result();
		if ($query->num_rows() > 0) {
			return $result;
		}
	}

	//印單據筆  
	function printfb()
	{
		$this->db->select('a.* ,c.mq002 AS me001disp, d.me002 AS me004disp, e.mb002 AS me010disp, f.mv002 AS me012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mf001, b.mf002, b.mf003, b.mf004, b.mf005,
		  b.mf006, b.mf007, b.mf011, b.mf009, b.mf017, b.mf018, b.mf012');

		$this->db->from('bomme as a');
		$this->db->join('bommf as b', 'a.me001 = b.mf001  and a.me002=b.mf002 ', 'left');
		$this->db->join('cmsmq as c', 'a.me001 = c.mq001 and c.mq003="31" ', 'left');
		$this->db->join('cmsme as d', 'a.me004 = d.me001 ', 'left');
		$this->db->join('cmsmb as e', 'a.me010 = e.mb001 ', 'left');
		$this->db->join('cmsmv as f ', 'a.me012 = f.mv001 and f.mv022 = " " ', 'left');
		$this->db->where('a.me001', $this->uri->segment(4));
		$this->db->where('a.me002', $this->uri->segment(5));
		$this->db->order_by('me001 , me002 ,b.mf003');

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

			'me003' => $this->input->post('me003'),
			'me004' => $this->input->post('me004')
		);
		$this->db->where('me001', $this->input->post('invq02a'));
		$this->db->where('me002', $this->input->post('me002'));
		$this->db->update('bomme', $data);                   //更改一筆

		//刪除明細
		$this->db->where('mf001', $this->input->post('invq02a'));
		$this->db->where('mf002', $this->input->post('me002'));
		$this->db->delete('bommf');

		//	$this->db->flush_cache();  
		// 新增明細 bommf

		$n = '0';
		$mf003 = '1000';
		while ($_POST['order_product'][$n]['mf002']) {
			$data_array = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' => date("Ymd"),
				'modifier' => $this->session->userdata('manager'),
				'modi_date' => date("Ymd"),
				'flag' => 1,
				'mf001' => $this->input->post('invq02a'),
				'mf002' => $this->input->post('me002'),
				'mf003' =>  $mf003,
				'mf004' => $_POST['order_product'][$n]['mf004'],
				'mf005' =>  $_POST['order_product'][$n]['mf005'],
				'mf006' => $_POST['order_product'][$n]['mf006'],
				'mf007' =>  $_POST['order_product'][$n]['mf007'],
				'mf008' => $_POST['order_product'][$n]['mf008'],
				'mf009' =>  $_POST['order_product'][$n]['mf009'],
				'mf010' => $_POST['order_product'][$n]['mf010'],
				'mf011' =>  $_POST['order_product'][$n]['mf011'],
				'mf012' => $_POST['order_product'][$n]['mf012'],
				'mf013' =>  $_POST['order_product'][$n]['mf013'],
				'mf015' => $_POST['order_product'][$n]['mf015'],
				'mf017' =>  $_POST['order_product'][$n]['mf017'],
				'mf018' => $_POST['order_product'][$n]['mf018'],
				'mf019' =>  $_POST['order_product'][$n]['mf019'],
				'mf022' => $_POST['order_product'][$n]['mf022'],
				'mf023' => $_POST['order_product'][$n]['mf023'],
				'mf024' =>  $_POST['order_product'][$n]['mf024'],
				'mf025' => $_POST['order_product'][$n]['mf025'],
				'mf026' =>  $_POST['order_product'][$n]['mf026']
			);
			if ($_POST['order_product'][$n]['mf004'] > '') {
				$this->db->insert('bommf', $data_array);
			}
			//    $this->db->insert('bommf', $data_array);
			$mmf003 = (int) $mf003 + 10;
			$mf003 =  (string)$mmf003;

			$num =  (int)$n + 1;
			$n =  (string)$num;
		}

		$n = '10';
		$num =  (int)$n;
		$n =  (string)$num;

		while ($_POST['order_product'][$n]['mf004']) {
			$data_array = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' => date("Ymd"),
				'modifier' => $this->session->userdata('manager'),
				'modi_date' => date("Ymd"),
				'flag' => 1,
				'mf001' => $this->input->post('invq02a'),
				'mf002' => $this->input->post('me002'),
				'mf003' =>  $mf003,
				'mf004' => $_POST['order_product'][$n]['mf004'],
				'mf005' =>  $_POST['order_product'][$n]['mf005'],
				'mf006' => $_POST['order_product'][$n]['mf006'],
				'mf007' =>  $_POST['order_product'][$n]['mf007'],
				'mf008' => $_POST['order_product'][$n]['mf008'],
				'mf009' =>  $_POST['order_product'][$n]['mf009'],
				'mf010' => $_POST['order_product'][$n]['mf010'],
				'mf011' =>  $_POST['order_product'][$n]['mf011'],
				'mf012' => $_POST['order_product'][$n]['mf012'],
				'mf013' =>  $_POST['order_product'][$n]['mf013'],
				'mf015' => $_POST['order_product'][$n]['mf015'],
				'mf017' =>  $_POST['order_product'][$n]['mf017'],
				'mf018' => $_POST['order_product'][$n]['mf018'],
				'mf019' =>  $_POST['order_product'][$n]['mf019'],
				'mf022' => $_POST['order_product'][$n]['mf022'],
				'mf023' => $_POST['order_product'][$n]['mf023'],
				'mf024' =>  $_POST['order_product'][$n]['mf024'],
				'mf025' => $_POST['order_product'][$n]['mf025'],
				'mf026' =>  $_POST['order_product'][$n]['mf026']
			);
			if ($_POST['order_product'][$n]['mf004'] > '') {
				$this->db->insert('bommf', $data_array);
			}
			//	$this->db->insert('bommf', $data_array);
			$mmf003 = (int) $mf003 + 10;
			$mf003 =  (string)$mmf003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		}
		return true;
	}

	//刪除一筆 	
	function deletef($seg1)
	{
		$this->db->where('me001', $this->uri->segment(4));
		//	  $this->db->where('me002', $this->uri->segment(5));
		$this->db->delete('bomme');
		$this->db->where('mf001', $this->uri->segment(4));
		//  $this->db->where('mf002', $this->uri->segment(5));
		$this->db->delete('bommf');
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
				$this->db->where('me001', $seq1);
				//   $this->db->where('me002', $seq2);
				$this->db->delete('bomme');
				$this->db->where('mf001', $seq1);
				//  $this->db->where('mf002', $seq2);
				$this->db->delete('bommf');
			}
		}
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}
	function del_detail()
	{
		$this->db->where('mf001', $_POST['del_me001']);
		$this->db->where('mf002', $_POST['del_me002']);
		$this->db->where('mf004', $_POST['del_me003']);
		$this->db->delete('bommf');
	}
	/*==以下AJAX處理區域==*/
	function ajaxbomi07($seg1)    //ajax 查詢一筆 顯示用 途程品號
	{
		$this->db->select('mf001, mb002, mb003, mf002, me003');
		$this->db->from('bomme');
		$this->db->join('bommf', 'bommf.mf001 = bomme.me001', 'left');
		$this->db->join('invmb', 'invmb.mb001 = bomme.me001', 'left');
		$this->db->where('me001', $this->uri->segment(4));
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mb002;
			}
			return $result;
		}
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword)
	{
		$this->db->select('mf001, mb002, mb003, mf002, me003');
		$this->db->from('bomme');
		$this->db->join('bommf', 'bommf.mf001 = bomme.me001', 'left');
		$this->db->join('invmb', 'invmb.mb001 = bomme.me001', 'left');
		$this->db->like('mf001', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->or_like('mb002', urldecode(urldecode($this->uri->segment(4))), 'after');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query->result();
	}
	function lookup2($keyword)
	{
		$me001 = urldecode(urldecode($this->uri->segment(4)));
		$this->db->select('mf001, mb002, mb003, mf002, me003');
		$this->db->from('bomme');
		$this->db->join('bommf', 'bommf.mf001 = bomme.me001', 'left');
		$this->db->join('invmb', 'invmb.mb001 = bomme.me001', 'left');
		$this->db->where('mf001', $me001);
		$query = $this->db->get();
		return $query->result();
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 
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
		$this->db->select($sel_col)->from('bomme');
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

	function get_detail_data($me001, $me002, $me003)
	{

		// $query = $this->db->select('a.md001,a.md002,a.md003,b.mb001,b.mb002,b.mb003,a.md004,a.md006')
		// 	->from('bommd as a')
		// 	->join('invmb as b', 'a.md003 = b.mb001 ', 'left')
		// 	->where('md001', $me001);

		// $data = $query->get()->result();

		// return $data;
		$sql98 = " select a.*, b.MW003 as MF004disp, '$me003' as workdate
					 	from BOMMF as a
						left join CMSMW as b on a.MF004 = b.MW001
				   where MF001='$me001' and MF002='$me002'
				   order by MF003 
				   ";
		$query = $this->db->query($sql98);
		$data = array();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			foreach ($result as $key => $val) {
				$data[$key]['TK003'] = trim($val->MF003);
				$data[$key]['TK004'] = trim($val->MF004);
				$data[$key]['TK004disp'] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($val->MF004disp), 'utf-8', 'big-5'), ENT_QUOTES));
				$data[$key]['TK024'] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($val->MF004disp), 'utf-8', 'big-5'), ENT_QUOTES));
				$data[$key]['TK005'] = trim($val->MF005);
				$data[$key]['TK006'] = trim($val->MF006);
				$data[$key]['TK007'] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($val->MF007), 'utf-8', 'big-5'), ENT_QUOTES));
				$data[$key]['TK008'] = date('Ymd', strtotime(' +' . $key . ' day', strtotime($me003)));
				$data[$key]['TK009'] = date('Ymd', strtotime(' +' . $key . ' day', strtotime($me003)));
				$data[$key]['TK010'] = '0';
				$data[$key]['TK011'] = '0';
				$data[$key]['TK012'] = '0';
				$data[$key]['TK013'] = '0';
				$data[$key]['TK014'] = '0';
				$data[$key]['TK015'] = '0';
				$data[$key]['TK016'] = '0';
				$data[$key]['TK017'] = '0';
				$data[$key]['TK018'] = trim($val->MF015);
				$data[$key]['TK019'] = trim($val->MF016);
				$data[$key]['TK020'] = stripslashes(htmlspecialchars(mb_convert_encoding(trim($val->MF017), 'utf-8', 'big-5'), ENT_QUOTES));
				$data[$key]['TK021'] = '0';
				$data[$key]['TK025'] = trim($val->MF011);
				$data[$key]['TK028'] = trim($val->MF019);
				$data[$key]['TK030'] = '';
				$data[$key]['TK031'] = '';
				$data[$key]['TK032'] = 'N';
				$data[$key]['TK034'] = '';
			}
		}

		return $data;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
