<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invr19a_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}
	//	$sql = " SELECT a.mc001,a.mc002,c.mc002 as mc002disp,a.mc003,b.mb002,b.mb003,b.mb004,a.mc007,a.mc008,

	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('invr19a_search', "display_searchr/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['invr19a']['search']);
		}

		if ($this->uri->segment(3, 0) == "display") {
			unset($_SESSION['invr19a']['search']);
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

		if (isset($_SESSION['invr19a']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['invr19a']['search']['where'];
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

		if (isset($_SESSION['invr19a']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['invr19a']['search']['order'];
		}

		if (!isset($_SESSION['invr19a']['search']['order']) && $default_order) {
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
		// $query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
		// 								left join  CMSMD as b on a.TD004 = b.MD001
		// 								left join  CMSMQ as c on a.TD001 = c.MQ001 
		// 								order by a.TD001, a.TD002 DESC 
		// 								");
		// $ret['data'] = $query->result();

		$vday = date('Ymd', strtotime(' -6 month')); //處理當日前6個月的資料
		$sql = " SELECT ra001,ra004, ra005, ra006, ra007, ra008, ra009, ra010, ra011, ra016, ra017 as ra017dis, d.MB002 as ra001disp, MC002 as ra009disp,  
						(SELECT top 1 da006 from moldav WHERE ra001=da001 and TE009=da013 and TE029=da014 and TD003 >= da018 order by da018 desc) da006, 
						(SELECT top 1 da005 from moldav WHERE ra001=da001 and TE009=da013 and TE029=da014 and TD003 >= da018 order by da018 desc) da005, f.MB002 as ra001disp1,
						(SELECT top 1 da016 from moldav WHERE ra001=da001 and TE009=da013 and TE029=da014 and TD003 >= da018 order by da018 desc) da016, TE032, ra020, ra021
					FROM invra as a
							left join SFCTE as b on ra006=TE001 and ra007=TE002 and ra008=TE003
							left join SFCTD as c on TE001=TD001 and TE002=TD002
							left join INVMB as d on ra001=d.MB001
							left join CMSMC as e on ra009=MC001
							left join INVMB as f on (SELECT top 1 da016 from moldav WHERE ra001=da001 and TE009=da013 and TE029=da014 and TD003 >= da018 order by da018 desc)=f.MB001
				where ra004>='$vday' and ra009='A205'
				order by ra004 desc, ra001
				";
		// echo "<pre>";var_dump($sql);exit;
		$query = $this->db->query($sql);

		$ret['data'] = $query->result();
		if (count($ret['data']) > 0) {
			foreach ($ret['data'] as $key => $val) {

				// if ($val->da0051) {
				if (!$val->da006 || !$val->da005) {
					$val->ra017dis = '0';
					if ($val->da016) {
						$val->ra001 = $val->da016 . '(' . $val->ra001 . ')';
					}
				} else {
					//             = 生產數量 / 實際穴數 * 每模毛重(kg)
					$val->ra017dis = round(floatval($val->ra017dis) / floatval($val->TE032) * floatval($val->da006) / 1000, 3);
					$val->ra001disp = $val->ra001disp1;
					$val->ra001 = $val->da016 . '(' . $val->ra001 . ')';
				}
				// $this->db->query(" UPDATE  invra SET ra018='$val->ra017dis' WHERE ra006='$val->ra006' and ra007='$val->ra007' and ra008='$val->ra008' "); //更新 待計算單據重量:耗料
			}
		}


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
		$_SESSION['invr19a']['search']['sql'] = $this->db->last_query();

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
		$_SESSION['invr19a']['search']['where'] = $where;
		$_SESSION['invr19a']['search']['order'] = $order;
		$_SESSION['invr19a']['search']['offset'] = $offset;

		return $ret;
	}


	function construct_sqlm($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('invr19a_search', "display_searchr/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		{
			unset($_SESSION['invr19a']['search']);
		}

		if ($this->uri->segment(3, 0) == "displaym") {
			unset($_SESSION['invr19a']['search']);
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

		if (isset($_SESSION['invr19a']['search']['where'])) {
			if ($where) {
				$where .= " and ";
			}
			$where .= $_SESSION['invr19a']['search']['where'];
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

		if (isset($_SESSION['invr19a']['search']['order'])) {
			if ($order) {
				$order .= " , ";
			}
			$order .= $_SESSION['invr19a']['search']['order'];
		}

		if (!isset($_SESSION['invr19a']['search']['order']) && $default_order) {
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
		// $query = $this->db->query(" select  a.*,c.MQ002  as td001disp,b.MD002 as td004disp from SFCTD as a 
		// 								left join  CMSMD as b on a.TD004 = b.MD001
		// 								left join  CMSMQ as c on a.TD001 = c.MQ001 
		// 								order by a.TD001, a.TD002 DESC 
		// 								");
		// $ret['data'] = $query->result();

		//更新 待計算單據重量=============================================================
		$vday = date('Ym', strtotime(' -2 month')) . '01'; //處理當日前2個月的資料
		$sql = " SELECT ra001,ra004, ra005, ra006, ra007, ra008, ra009, ra010, ra011, ra016, ra017 as ra017dis, d.MB002 as ra001disp, MC002 as ra009disp,  
						(SELECT top 1 da006 from moldav WHERE ra001=da001 and TE009=da013 and TE029=da014 and TD003 >= da018 order by da018 desc) da006, 
						(SELECT top 1 da005 from moldav WHERE ra001=da001 and TE009=da013 and TE029=da014 and TD003 >= da018 order by da018 desc) da005, f.MB002 as ra001disp1, 
						(SELECT top 1 da016 from moldav WHERE ra001=da001 and TE009=da013 and TE029=da014 and TD003 >= da018 order by da018 desc) da016, ra019, TE032
					FROM invra as a
							left join SFCTE as b on ra006=TE001 and ra007=TE002 and ra008=TE003
							left join SFCTD as c on TE001=TD001 and TE002=TD002
							left join INVMB as d on ra001=d.MB001
							left join CMSMC as e on ra009=MC001
							left join INVMB as f on (SELECT top 1 da016 from moldav WHERE ra001=da001 and TE009=da013 and TE029=da014 and TD003 >= da018 order by da018 desc)=f.MB001
				where ra004>='$vday' and ra009='A205'
				order by ra004 desc, ra001
				";
		$query = $this->db->query($sql);


		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $val) {

				// if ($val->da0051) {
				if (!$val->da006 || !$val->da005) {
					$val->ra017dis = '0';
					if ($val->da016) {
						$val->ra019 = trim($val->da016);
					} else {
						$val->ra019 = trim($val->ra001);
					}
				} else {
					//             = 生產數量 / 實際穴數 * 每模毛重(kg)
					$val->ra017dis = round(floatval($val->ra017dis) / floatval($val->TE032) * floatval($val->da006) / 1000, 3);
					$val->ra001disp = $val->ra001disp1;
					$val->ra019 = trim($val->da016);
				}
				// echo "<pre>";
				// echo " UPDATE  invra SET ra018='$val->ra017dis', ra019='$val->ra019' WHERE ra006='$val->ra006' and ra007='$val->ra007' and ra008='$val->ra008' ";
				$this->db->query(" UPDATE  invra SET ra018='$val->ra017dis', ra019='$val->ra019' WHERE ra006='$val->ra006' and ra007='$val->ra007' and ra008='$val->ra008' and ra001='$val->ra001' "); //更新 待計算單據重量:耗料
			}
		}
		// exit;
		//更新 待計算單據重量=============================================================

		//新增每月沒的品號---------------------------------------------
		$sqlsin = " SELECT MB001 FROM INVMB WHERE MB001 LIKE 'IM%' ";
		$query = $this->db->query($sqlsin);
		foreach ($query->result() as $key => $row) {
			$vday = date("Ymd");
			$vdaym = date("Ym");
			$vdayf = date("Ym") . '01';
			$vra019 = trim($row->MB001);
			# code...
			$sqlin = " SELECT * from invra where ra019='$vra019' and ra004 like '$vdaym%' and ra009='A205' ";
			$query = $this->db->query($sqlin);
			if ($query->num_rows() < 1) {
				$sqlinsert = " INSERT INTO invra(create_date,ra001, ra004, ra005, ra006, ra007, ra008, ra009, ra019) VALUES('$vday','$vra019' , '$vdayf', '1', 'm', '$vdayf', '0001', 'A205', '$vra019' )   ";
				$this->db->query($sqlinsert);
			}
		}
		//新增每月沒的品號---------------------------------------------end

		//  月報表計算-----------------------------------------------------------------------------------

		$arr1 = array();
		$sqlm = " SELECT CONVERT(CHAR(6), ra004, 112) AS month, ra019, RTRIM(MB002) as ra019disp , '0' as r001, sum(convert(float,ra010)) as r002, sum(convert(float,ra018)) as r003 , 
		(sum(convert(float,ra011))+sum(convert(float,ra020))+sum(convert(float,ra021)) ) as r004 ,'0' r005
					from dbo.invra 
						left join INVMB as d on ra019=d.MB001
					WHERE ra009='A205'
					GROUP BY CONVERT(CHAR(6), ra004, 112),ra019 ,MB002
					ORDER BY month DESC,ra019  					
					";

		$query = $this->db->query($sqlm);
		$arr = $query->result();


		for ($i = 0; $i < count($arr); $i++) {

			# code...
			for ($j = 1 + $i; $j < count($arr); $j++) {
				# code...
				if (trim($arr[$i]->ra019) == trim($arr[$j]->ra019)) {
					$arr[$i]->r001 = round($arr[$i]->r001 + $arr[$j]->r002 - $arr[$j]->r003 - $arr[$j]->r004, 3);
				}
			}
			$arr[$i]->r005 = round($arr[$i]->r001 + $arr[$i]->r002 - $arr[$i]->r003 - $arr[$i]->r004, 3);
		}


		$ret['data'] = $arr;

		// echo "<pre>";
		// var_dump($ret);
		// exit;

		// if (count($arr) > 0) {
		// 	$index = 0;

		// 	$mr_arr = array();
		// 	foreach ($arr as $key => $val) {
		// 		$mr_arr[$index]['m001']=
		// 		# code...
		// 	}
		// }

		// echo "<pre>";
		// var_dump($arr);
		// exit;

		//  月報表計算-----------------------------------------------------------------------------------end

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
		$_SESSION['invr19a']['search']['sql'] = $this->db->last_query();

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
		$_SESSION['invr19a']['search']['where'] = $where;
		$_SESSION['invr19a']['search']['order'] = $order;
		$_SESSION['invr19a']['search']['offset'] = $offset;

		return $ret;
	}

	//轉excel檔   
	function excelnewf()
	{
		//刪日期 / 符號
		preg_match_all('/\d/S', $this->input->post('ra004s'), $matches);  //處理日期字串
		$seq1 = implode('', $matches[0]);
		preg_match_all('/\d/S', $this->input->post('ra004d'), $matches);  //處理日期字串
		$seq2 = implode('', $matches[0]);

		$seq3 = trim($this->input->post('ra001'));


		// $seq3 = $this->input->post('td002o');
		// $seq4 = $this->input->post('td002c');
		$sql = " SELECT CONVERT(CHAR(6), ra004, 112) AS month, ra019, RTRIM(MB002) as ra019disp , '0' as r001, sum(convert(float,ra010)) as r002, sum(convert(float,ra018)) as r003 , 
		sum(convert(float,ra020)) as x01 , sum(convert(float,ra021)) as x02 , sum(convert(float,ra011)) as x03 ,
		(sum(convert(float,ra011))+sum(convert(float,ra020))+sum(convert(float,ra021)) ) as r004 ,'0' r005
					from dbo.invra 
						left join INVMB as d on ra019=d.MB001
						WHERE ra009='A205'
					GROUP BY CONVERT(CHAR(6), ra004, 112),ra019 ,MB002
					ORDER BY month DESC,ra019  					
					";

		if ($seq3 != '') {
			$sql = " SELECT CONVERT(CHAR(6), ra004, 112) AS month, ra019, RTRIM(MB002) as ra019disp , '0' as r001, sum(convert(float,ra010)) as r002, sum(convert(float,ra018)) as r003 , 
			sum(convert(float,ra020)) as x01 , sum(convert(float,ra021)) as x02 , sum(convert(float,ra011)) as x03 ,
			(sum(convert(float,ra011))+sum(convert(float,ra020))+sum(convert(float,ra021)) ) as r004 ,'0' r005
						from dbo.invra 
							left join INVMB as d on ra019=d.MB001
						WHERE ra019 = '$seq3' AND ra009='A205'
					GROUP BY CONVERT(CHAR(6), ra004, 112),ra019 ,MB002
					ORDER BY month DESC,ra019  					
						";
		}


		$query = $this->db->query($sql);
		$arr = $query->result();

		for ($i = 0; $i < count($arr); $i++) {
			# code...
			for ($j = 1 + $i; $j < count($arr); $j++) {
				# code...
				if (trim($arr[$i]->ra019) == trim($arr[$j]->ra019)) {
					$arr[$i]->r001 = round($arr[$i]->r001 + $arr[$j]->r002 - $arr[$j]->r003 - $arr[$j]->r004, 3);
				}
			}
			$arr[$i]->r005 = round($arr[$i]->r001 + $arr[$i]->r002 - $arr[$i]->r003 - $arr[$i]->r004, 3);
		}


		$result = array();
		foreach ($arr as $key => $row) {
			# code...
			if ($arr[$key]->month >= $seq1 and $arr[$key]->month <= $seq2) {
				array_push($result, $arr[$key]);
			}
		}

		return $result;
	}

	function excelnewf_etc()
	{
		$vday = $this->input->post('ra004s');
		//刪日期 / 符號
		preg_match_all('/\d/S', $this->input->post('ra004s'), $matches);  //處理日期字串
		$sday = implode('', $matches[0]) . '01';
		preg_match_all('/\d/S', $this->input->post('ra004d'), $matches);  //處理日期字串
		$eday = implode('', $matches[0]) . '31';

		$seq3 = trim($this->input->post('ra001'));


		// $seq3 = $this->input->post('td002o');
		// $seq4 = $this->input->post('td002c');
		//SELECT ta003, CONVERT(CHAR(6), ta003, 112) AS month, ta006, ta035,ta016,'' as sumta,tb003,MB002,tb005,'' as sumtb
		$sql = " SELECT ta003, CONVERT(CHAR(6), ta003, 112) AS month, ta006, ta035,ta016,tb003,MB002,tb005
							FROM dbo.mocta 
						LEFT JOIN dbo.moctb on ta001=tb001 and ta002=tb002
						LEFT JOIN INVMB on tb003=MB001
				where ta003>='$sday' and ta003<='$eday'
				order by month,ta006				
					";

		$query = $this->db->query($sql);
		$data = $query->result();

		// $sql016 = " SELECT CONVERT(CHAR(6), ta003, 112) AS month,MB001, sum(convert(float,ta016)) as sum016  
		// 				FROM mocta as b 
		// 				LEFT JOIN INVMB as c on ta006=MB001
		// 			where ta003>='$sday' and ta003<='$eday'
		// 			GROUP BY CONVERT(CHAR(6), ta003, 112),MB001					
		// 			";

		// $query016 = $this->db->query($sql016);
		// $data016 = $query016->result();

		// $sql005 = " SELECT CONVERT(CHAR(6), ta003, 112) AS month,MB001, sum(convert(float,tb005)) as sum005  FROM dbo.moctb as a
		// 				LEFT JOIN mocta as b on tb001=ta001 and tb002=ta002
		// 				LEFT JOIN INVMB as c on tb003=MB001
		// 			where ta003>='$sday' and ta003<='$eday'
		// 			GROUP BY CONVERT(CHAR(6), ta003, 112),MB001					
		// 			";

		// $query005 = $this->db->query($sql005);
		// $data005 = $query005->result();


		foreach ($data as $key => $row) {

			// foreach ($data016 as $k016 => $r016) {

			// 	if ($row->month == $r016->month && $row->ta006 == $r016->MB001) {
			// 		$row->sumta = round($r016->sum016, 2);
			// 		break;
			// 	}
			// }

			// foreach ($data005 as $k005 => $r005) {
			// 	if ($row->month == $r005->month && $row->tb003 == $r005->MB001) {
			// 		$row->sumtb = round($r005->sum005);
			// 		break;
			// 	}
			// }

			unset($row->month);
		}

		return $data;
	}

	function ajaxdata($seg1, $seg2, $seg3, $seg4)
	{
		$sql99 = " UPDATE  invra   SET ra011='$seg1' 
        			where ra006='$seg2' and ra007='$seg3' and ra008='$seg4'
					";

		return $this->db->query($sql99);
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
