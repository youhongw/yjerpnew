<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit', '512M');
ini_set("max_execution_time", 300000);
class pali11_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//查詢 table 表所有資料 
	function selbrowse($num, $offset)
	{
		$this->db->select('md001, md002, md003, md004, md005, md006, create_date');
		$this->db->from('palmt');
		//$this->db->order_by('id', 'DESC');                //排序  單欄
		$this->db->order_by('md001 desc, md002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
		$this->db->limit($num, $offset);   // 每頁15筆
		$ret['rows'] = $this->db->get()->result();

		$this->db->select('COUNT(*) as count');    //查詢總筆數
		$this->db->from('palmt');
		$query = $this->db->get();
		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		return $ret;
	}

	//欄位表頭排序流覽資料
	function search($select_col = array(), $join = array(), $where = array())
	{

		$select = "";
		foreach ($select_col as $val) {
			$select .= $val . ", ";
		}
		$this->db->select($select);
		$this->db->from('palmt');
		foreach ($join as $key => $val) {
			$this->db->join($val['table'] . ' as ' . $key, $val['term'], $val['method']);
		}
		foreach ($where as $key => $val) {
			if ($val['method'] == "is") {
				$this->db->where($val['name'], $val['value']);
			} else if ($val['method'] == "like") {
				$this->db->like($val['name'], $val['value'], "left");
			} else if ($val['method'] == "bigger") {
				$this->db->where($val['name'] . " >= " . $val['value']);
			} else if ($val['method'] == "less") {
				$this->db->where($val['name'] . " <= " . $val['value']);
			}
		}
		$query = $this->db->get();

		return $query->result();
	}

	//Talence Editor 2017.03.21
	/***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('pali11_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if (is_array($this->input->get())) {
			extract($this->input->get());
			if (!isset($val)) {
				$val = "";
			}
			$temp_url = explode(".html", $val);
			$val = "";
			foreach ($temp_url as $k => $v) {
				$val .= $v;
			}
		}

		$default_where = ""; //在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mt001 asc"; //在這裡塞入一些預設排序

		/* where 處理區域 */
		if ($default_where) {
			$where = "(" . $default_where . ")";
		} else {
			$where = "";
		}

		if (isset($_SESSION['pali11']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['pali11']['search']['where'];
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

		if (isset($_SESSION['pali11']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['pali11']['search']['order'];
		}

		if (!isset($_SESSION['pali11']['search']['order']) && $default_order) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $default_order;
		}
		/* order end */

		/* Data SQL */
		// $query = $this->db->select('mt001, mt002, mt003, mt004, mt005, mt006, mt007, create_date')
		// 	->from('palmt')
		// 	->order_by($order);
		// if ($where) {
		// 	$query->where($where);
		// }
		// $ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);

		$query = $this->db->select('mt001, mt002, mt003, mt004, mt005, mt006, mt007, create_date')
			->from('palmt')
			->order_by($order)
			->limit($limit, $offset);
		if ($where) {
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['pali11']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('palmt');
		if ($where) {
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;

		//儲存where與order
		$_SESSION['pali11']['search']['where'] = $where;
		$_SESSION['pali11']['search']['order'] = $order;
		$_SESSION['pali11']['search']['offset'] = $offset;

		return $ret;
	}


	//ajax 查詢資料重複
	function ajaxkey($seg1)
	{
		$this->db->set('mt001', $this->uri->segment(4));
		$this->db->where('mt001', $this->uri->segment(4));
		$query = $this->db->get('palmt');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mt002;
			}
			return $result;
		}
	}

	//查詢一筆 修改用   
	function selone($select_col = array(), $join = array(), $where = array())
	{
		$select = "";
		foreach ($select_col as $val) {
			$select .= $val . ", ";
		}
		$this->db->select($select);
		$this->db->from('palmt');
		foreach ($join as $key => $val) {
			$this->db->join($val['table'] . ' as ' . $key, $val['term'], $val['method']);
		}
		foreach ($where as $key => $val) {
			if ($val['method'] == "is") {
				$this->db->where($val['name'], $val['value']);
			} else if ($val['method'] == "like") {
				$this->db->like($val['name'], $val['value'], "left");
			} else if ($val['method'] == "bigger") {
				$this->db->where($val['name'] . " >= " . $val['value']);
			} else if ($val['method'] == "less") {
				$this->db->where($val['name'] . " <= " . $val['value']);
			}
		}
		$query = $this->db->get();

		return $query->result();
	}

	//查新增資料是否重複 
	function selone1($seg1, $seg2, $seg3)
	{
		// $this->db->where('mt001', $seg1);
		$this->db->where('mt002', $seg2);
		$this->db->where('mt003', $seg3);
		$query = $this->db->get('palmt');
		return $query->num_rows();
	}

	function selone3($seg1, $seg2, $seg3)
	{
		//以班別、人員查看是否設定 $query >0 
		$this->db->where('mt001', $seg1);
		$this->db->where('mt002', $seg2);
		$query = $this->db->get('palmt');

		//以班別、人員、日期查看是否有資料 qcount=0 無資料 
		$this->db->where('mt001', $seg1);
		$this->db->where('mt002', $seg2);
		$this->db->where('mt003', $seg3);
		$query1 = $this->db->get('palmt');

		$qcount = $query1->num_rows();

		if ($query->num_rows() != 0) {
			if ($qcount == 0)
				$qcount = 1;
		}

		return $qcount;
	}


	//新增一筆	
	function insertf()
	{
		preg_match_all('/\d/S', $this->input->post('mt003'), $matches);  //處理日期字串
		$mt003 = implode('', $matches[0]);

		preg_match_all('/\d/S', $this->input->post('mt003d'), $matches);  //處理日期字串
		$mt003d = implode('', $matches[0]);

		$mt002 = $this->input->post('mt002');

		$mt003sToint = intval($mt003);
		$mt003dToint = intval($mt003d);
		if ($mt003dToint >= $mt003sToint && ($mt003dToint - $mt003sToint) < 30 && strlen($mt003) == 8 && strlen($mt003d) == 8) {
			//依班別、員工代號新增or修改各資料
			for ($i = $mt003sToint; $i <= $mt003dToint; $i++) {
				$data = array(
					'company' => $this->session->userdata('syscompany'),
					'creator' => $this->session->userdata('manager'),
					'usr_group' => 'A100',
					'create_date' => date("Ymd"),
					'modifier' => '',
					'modi_date' => '',
					'flag' => 0,
					'mt001' => $this->input->post('mt001'),
					'mt002' => $this->input->post('mt002'),
					'mt003' => strval($i),
					'mt004' => $this->input->post('mt004'),
					'mt005' => $this->input->post('mt005'),
					'mt006' => $this->input->post('mt006'),
					'mt007' => $this->input->post('mt007'),
					'mt008' => $this->input->post('mt008'),
					'mt009' => $this->input->post('mt009')
				);
				if (!$data['mt002']) {
					$data['mt002'] = 0;
				}

				$exist = $this->pali11_model->selone1($this->input->post('mt001'), $this->input->post('mt002'), strval($i));
				if ($exist) {
					//存在則修改
					// $this->db->where('mt001', $this->input->post('mt001'));
					$mt003 = strval($i);
					$this->db->where('mt002', $mt002);
					$this->db->where('mt003', $mt003);
					$this->db->update('palmt', $data);                   //更改一筆
					if ($this->db->affected_rows() > 0) {
						//新增 palte 異動碼(N/Y)-----------------------------
						// $sql97 = " update palte set te008='Y' where te001='$mt002' and te002='" . date("Ymd", strtotime("-1 day", strtotime($mt003))) . "' ";
						$sql97 = " update palte set te008='Y' where te001='$mt002' and te002>='" . date("Ymd", strtotime("-1 day", strtotime($mt003))) . "' and te002<='$mt003d' ";
						$this->db->query($sql97);

						//end--新增 palte 異動碼(N/Y)------------------------

						// return TRUE;
					} else {
						return FALSE;
					}
				} else {
					//不存在則新增
					if ($this->db->insert('palmt', $data)) {
						//新增 palte 異動碼(N/Y)-----------------------------
						// $sql97 = " update palte set te008='Y' where te001='$mt002' and te002='" . date("Ymd", strtotime("-1 day", strtotime($mt003))) . "' ";
						$sql97 = " update palte set te008='Y' where te001='$mt002' and te002>='" . date("Ymd", strtotime("-1 day", strtotime($mt003))) . "' and te002<='$mt003d' ";
						$this->db->query($sql97);

						//end--新增 palte 異動碼(N/Y)------------------------
						// return TRUE;
					} else {
						return FALSE;
					}
				}
			}
		} else {
			return 'fdate';
		}

		return TRUE;
	}

	//查複製資料是否重複	 
	function selone2($seg2, $seq4)
	{
		$this->db->where('md001', $this->input->post('md001c'));
		$this->db->where('md014', $seq4);
		$query = $this->db->get('palmt');
		return $query->num_rows();
	}

	//刪除資料	
	function delf()
	{
		$mt002 = $this->input->post('mt002');
		preg_match_all('/\d/S', $this->input->post('mt003'), $matches);  //處理日期字串
		$mt003 = implode('', $matches[0]);

		preg_match_all('/\d/S', $this->input->post('mt003d'), $matches);  //處理日期字串
		$mt003d = implode('', $matches[0]);

		$this->db->where('mt001', $this->input->post('mt001'));
		$this->db->where('mt002', $mt002);
		$this->db->where('mt003 >=', $mt003);
		$this->db->where('mt003 <=', $mt003d);
		$this->db->delete('palmt');
		// if ($this->db->affected_rows() > 0) {
		// 	return '成功刪除 '.$this->db->affected_rows().' 筆資料';
		// }

		//新增 palte 異動碼(N/Y)-----------------------------
		$sql97 = " update palte set te008='Y' where te001='$mt002' and te002>='" . date("Ymd", strtotime("-1 day", strtotime($mt003))) . "' and te002<='$mt003d' ";
		$this->db->query($sql97);

		//end--新增 palte 異動碼(N/Y)------------------------

		return '成功刪除 ' . $this->db->affected_rows() . ' 筆資料';
	}

	//複製一筆	
	function copyf()           //複製一筆
	{
		preg_match_all('/\d/S', $this->input->post('mt003'), $matches);  //處理日期字串
		$mt003 = implode('', $matches[0]);

		preg_match_all('/\d/S', $this->input->post('mt003d'), $matches);  //處理日期字串
		$mt003d = implode('', $matches[0]);

		$mt003sToint = intval($mt003);
		$mt003dToint = intval($mt003d);
		//確認資料
		for ($i = $mt003sToint; $i <= $mt003dToint; $i++) {
			$exist = $this->pali11_model->selone3($this->input->post('mt001'), $this->input->post('mt002'), strval($i));

			if ($exist == 0) {
				return '0';
			}
			// if (!$exist) {
			// 	return 'exist';
			// }
			if ($exist != 1) {
				return 'exist';
			}
		}

		$count = 0;
		$allcount = 0;
		//依新增資料
		for ($i = $mt003sToint; $i <= $mt003dToint; $i++) {
			$this->db->where('mt001', $this->input->post('mt001'));
			$this->db->where('mt002', $this->input->post('mt002'));
			$this->db->where('mt003', strval($i));
			$query = $this->db->get('palmt');
			if ($query->num_rows() == 1) {
				$result = $query->result();
				foreach ($result as $row) :
					$mt003 = $row->mt003;
					$mt004 = $row->mt004;
					$mt005 = $row->mt005;
					$mt007 = $row->mt007;
				endforeach;
			}

			if ($query->num_rows() == 1) {


				if ($this->input->post('mt002c')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data);
						$count++;
					}
				}




				if ($this->input->post('mt002c1')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c1'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data1 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c1'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data1);
						$count++;
					}
				}

				if ($this->input->post('mt002c2')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c2'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data2 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c2'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data2);
						$count++;
					}
				}

				if ($this->input->post('mt002c3')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c3'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data3 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c3'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data3);
						$count++;
					}
				}

				if ($this->input->post('mt002c4')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c4'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data4 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c4'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data4);
						$count++;
					}
				}

				if ($this->input->post('mt002c5')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c5'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data5 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c5'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data5);
						$count++;
					}
				}

				if ($this->input->post('mt002c6')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c6'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data6 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c6'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data6);
						$count++;
					}
				}

				if ($this->input->post('mt002c7')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c7'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data7 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c7'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data7);
						$count++;
					}
				}

				if ($this->input->post('mt002c8')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c8'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data8 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c8'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data8);
						$count++;
					}
				}

				if ($this->input->post('mt002c9')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c9'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data9 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c9'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data9);
						$count++;
					}
				}

				if ($this->input->post('mt002c10')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c10'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data10 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c10'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data10);
						$count++;
					}
				}

				if ($this->input->post('mt002c11')) {
					$this->db->where('mt001', $this->input->post('mt001'));
					$this->db->where('mt002', $this->input->post('mt002c11'));
					$this->db->where('mt003', strval($i));
					$query = $this->db->get('palmt');
					$allcount++;
					if ($query->num_rows() == 0) {
						$data11 = array(
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' => date("Ymd"),
							'modifier' => ' ',
							'modi_date' => ' ',
							'flag' => 0,
							'mt001' => $this->input->post('mt001'),
							'mt002' => $this->input->post('mt002c11'),
							'mt003' => strval($i),
							'mt004' => $mt004,
							'mt005' => $mt005,
							'mt007' => $mt007
						);
						$this->db->insert('palmt', $data11);
						$count++;
					}
				}
			}
		}

		return '成功複製 ' . strval($count) . ' 筆資料,重複資料 ' . strval($allcount - $count) . ' 筆資料';      //複製一筆   
	}

	//轉excel檔	 
	function excelnewf()
	{
		preg_match_all('/\d/S', $this->input->post('mt003'), $matches);  //處理日期字串
		$seq1 = implode('', $matches[0]);

		preg_match_all('/\d/S', $this->input->post('mt003d'), $matches);  //處理日期字串
		$seq2 = implode('', $matches[0]);
		$sql = " SELECT b.mo002 ,c.mv002, a.mt003, a.mt005, a.mt006, a.mt007, a.create_date FROM palmt as a,palmo as b, cmsmv as c WHERE a.mt003 >= '$seq1' AND a.mt003 <= '$seq2'  and  a.mt001  = b.mo001 and a.mt002 =c.mv001  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		preg_match_all('/\d/S', $this->input->post('mt003'), $matches);  //處理日期字串
		$seq1 = implode('', $matches[0]);

		preg_match_all('/\d/S', $this->input->post('mt003d'), $matches);  //處理日期字串
		$seq2 = implode('', $matches[0]);
		$sql = " SELECT a.*, b.mo002 ,c.mv002 FROM palmt as a,palmo as b, cmsmv as c WHERE a.mt003 >= '$seq1'  AND a.mt003 <= '$seq2' and a.mt001  = b.mo001 and a.mt002 =c.mv001 ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();

		$seq32 = "mt003 >= '$seq1'  AND mt003 <= '$seq2'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('palmt')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//更改一筆	 
	function updatef()   //更改一筆
	{

		if (!empty($this->input->post())) {
			extract($this->input->post());
			preg_match_all('/\d/S', $mt003, $matches);  //處理日期字串
			$mt003 = implode('', $matches[0]);

			preg_match_all('/\d/S', $this->input->post('mt003d'), $matches);  //處理日期字串
			$mt003d = implode('', $matches[0]);
		} else {
			return FALSE;
		}

		$mt003sToint = intval($mt003);
		$mt003dToint = intval($mt003d);

		//依班別、員工代號修改各資料
		for ($i = $mt003sToint; $i <= $mt003dToint; $i++) {
			$data = array(
				'modifier' => $this->session->userdata('manager'),
				'modi_date' => date("Ymd"),
				'flag' => $this->input->post('flag') + 1,
				'mt001' => $mt001,
				'mt003' => strval($i),
				'mt004' => $mt004,
				'mt005' => $mt005,
				'mt006' => $mt006,
				'mt007' => $mt007,
				'mt008' => $mt008,
				'mt009' => $mt009
			);

			// $this->db->where('mt001', $mt001);
			$mt003 = strval($i);
			$this->db->where('mt002', $mt002);
			$this->db->where('mt003', $mt003);
			$this->db->update('palmt', $data);                   //更改一筆
			if ($this->db->affected_rows() > 0) {
				//新增 palte 異動碼(N/Y)-----------------------------
				// $sql97 = " update palte set te008='Y' where te001='" . date("Ymd", strtotime("-1 day", strtotime($mt003))) . "' and te002='$mt003' ";
				// $sql97 = " update palte set te008='Y' where te001='$mt002' and te002>='" . date("Ymd", strtotime("-1 day", strtotime($mt003))) . "' and te002<='$mt003d' ";
				$sql97 = " update palte set te008='Y' where te001='$mt002' and te002>='" . date("Ymd", strtotime("-1 day", strtotime($mt003))) . "' and te002<='$mt003' ";
				$this->db->query($sql97);

				//end--新增 palte 異動碼(N/Y)------------------------
				// return TRUE;
			} else {
				return FALSE;
			}
		}
		return TRUE;
	}

	//刪除一筆	
	function deletef($mt001, $mt002, $mt003)
	{
		$this->db->where('mt001', $mt001);
		$this->db->where('mt002', $mt002);
		$this->db->where('mt003', $mt003);
		$this->db->delete('palmt');
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
				list($seq1, $seq2) = explode("/", $seq[$x]);
				$seq1;
				$seq2;
				$this->db->where('md001', $seq1);
				$this->db->where('md014', $seq2);
				$this->db->delete('palmt');
			}
		}
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	function get_pali16($select_col = array(), $join = array(), $where = array())
	{
		$select = "";
		foreach ($select_col as $val) {
			$select .= $val . ", ";
		}
		$this->db->select($select);
		$this->db->from('palmo');
		foreach ($join as $key => $val) {
			$this->db->join($val['table'] . ' as ' . $key, $val['term'], $val['method']);
		}
		foreach ($where as $key => $val) {
			if ($val['method'] == "is") {
				$this->db->where($val['name'], $val['value']);
			} else if ($val['method'] == "like") {
				$this->db->like($val['name'], $val['value'], "left");
			} else if ($val['method'] == "bigger") {
				$this->db->where($val['name'] . " >= " . $val['value']);
			} else if ($val['method'] == "less") {
				$this->db->where($val['name'] . " <= " . $val['value']);
			}
		}
		$query = $this->db->get();
		return $query->result();
	}

	function get_pali11($select_col = array(), $join = array(), $where = array())
	{
		// //刪除3個月前、後的排班----------------------
		// $this->db->where('mt003 <', (int)date('Ymd', strtotime("-3 month")));
		// $this->db->or_where('mt003 >', (int)date('Ymd', strtotime("+3 month")));
		// $this->db->delete('palmt');



		// //刪除3個月前的排班end-----------------------
		$select = "";
		foreach ($select_col as $val) {
			$select .= $val . ", ";
		}
		$this->db->select($select);
		$this->db->from('palmt');
		foreach ($join as $key => $val) {
			$this->db->join($val['table'] . ' as ' . $key, $val['term'], $val['method']);
		}
		foreach ($where as $key => $val) {
			if ($val['method'] == "is") {
				$this->db->where($val['name'], $val['value']);
			} else if ($val['method'] == "like") {
				$this->db->like($val['name'], $val['value'], "left");
			} else if ($val['method'] == "bigger") {
				$this->db->where($val['name'] . " >= " . $val['value']);
			} else if ($val['method'] == "less") {
				$this->db->where($val['name'] . " <= " . $val['value']);
			}
		}
		$query = $this->db->get();

		return $query->result();
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
