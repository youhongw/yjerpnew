<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prsi01_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//欄位表頭排序流覽資料
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('prsi01_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
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

		$vday = date('Ymd', strtotime(' -2 year')); //處理當日前2年的資料
		$sql98 = " SELECT (SELECT top 1  db006 FROM prsda LEFT JOIN prsdb ON da001=db001 AND da002=db002
							where RTRIM(db006)<>'' and da001=a.da001 and da002=a.da002
							) edb006,* 
					FROM prsda a
						LEFT JOIN prsdb ON da001=db001 AND da002=db002
						where RTRIM(db006)='' and da001>='$vday'
						order by da001 desc, da002
		 			";

		$query = $this->db->query($sql98);
		$ret['data'] = $query->result();

		//建構暫存view
		$this->construct_view($ret['data']);

		//儲存sql
		$_SESSION['prsi01']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		// $sql = " SELECT count(*) as count from prsda  
		// 				left join prsdb da001=db001 AND da002=db002 
		// 		";

		// $query = $this->db->query($sql);
		// $ret['num'] =  $query->result()[0]->count;
		$ret['num'] = count($ret['data']);

		return $ret;
	}

	/***新增暫存view表方法construct_view 上一筆,下一筆
	 *	
	 *
	 ***/
	function construct_view($data)
	{
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"da001", "da002"
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
		$_SESSION['prsi01']['search']['view'] = $view_array;
		$_SESSION['prsi01']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['prsi01']['search']['view']);exit;

	}



	//查詢修改用 (看資料用)  單別,品號 , 廠別, 庫別, 線別, 加工廠商, 品號,庫别2,幣別
	function selone($seq1, $seq2)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from prsda where da001='$seq1' and da002='$seq2'
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	function selone1($seq1, $seq2)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from prsdb where db001='$seq1' and db002='$seq2' order by db011
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return array();
	}

	function selone2($seq1, $seq2)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from prsdc where dc001='$seq1' and dc002='$seq2' order by dc008
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return array();
	}

	function selone3($seq1, $seq2)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from prsdd where dd001='$seq1' and dd002='$seq2' order by dd008
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return array();
	}


	//新增一筆 檔頭  mocta	
	function insertf()    //新增一筆 檔頭  mocta
	{
		$da001 = trim($this->input->post('da001'));	//日期
		$da001 = date("Ymd", strtotime($da001));
		$da002 = trim($this->input->post('da002'));	//爐次
		$da003 = trim($this->input->post('da003'));	//材質
		$da004 = trim($this->input->post('da004'));	//CE值
		$da005 = trim($this->input->post('da005'));	//產品名稱
		$da005 = iconv('utf-8', 'BIG5', $da005);
		$da006 = trim($this->input->post('da006'));	//出爐溫度(℃)
		$da007 = trim($this->input->post('da007'));	//電力(開始)
		$da008 = trim($this->input->post('da008'));	//電力(結束)
		$da009 = trim($this->input->post('da009'));	//電力(耗電)
		$da010 = trim($this->input->post('da010'));	//故障記錄
		$da010 = iconv('utf-8', 'BIG5', $da010);
		$da011 = trim($this->input->post('da011'));	//備註
		$da011 = iconv('utf-8', 'BIG5', $da011);
		$company = 'YJ';
		$creator = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');

		if (!$da002) {
			return '無資料';
		}

		$exist = $this->prsi01_model->selone($da001, $da002);
		if ($exist) {
			return 'exist';
		}



		$sql = " INSERT INTO dbo.prsda
						(company, creator, usr_group, create_date, flag, da001, da002, da003, da004, da005, da006, da007, da008, da009, da010, da011)
				VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$da001', '$da002', '$da003', '$da004', '$da005', '$da006', '$da007', '$da008', '$da009', '$da010', '$da011'); 
				";

		$this->db->query($sql);

		if ($this->input->post()) {
			extract($this->input->post());
		}


		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}
		if (isset($order_product1)) {
			if (!is_array($order_product1)) {
				$order_product1 = array();
			}
		}
		if (isset($order_product2)) {
			if (!is_array($order_product2)) {
				$order_product2 = array();
			}
		}



		if (isset($order_product)) {
			foreach ($order_product as $key => $val) {
				if ($val['db003']) {
					extract($val);
					$da001 = trim($this->input->post('da001'));	//日期
					$da001 = date("Ymd", strtotime($da001));
					$da002 = trim($this->input->post('da002'));	//爐次
					$sql95 = " INSERT INTO dbo.prsdb
											(company, creator, usr_group, create_date, flag, db001, db002, db003, db004, db005, db006, db007, db008, db009, db010, db011)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$da001', '$da002', '$db003', '$db004', '$db005', '$db006', '$db007', '$db008', '$db009', '$db010', '$key'); 				
									";
					$this->db->query($sql95);
				}
			}
		}

		if (isset($order_product1)) {
			foreach ($order_product1 as $key => $val) {
				if ($val['dc003']) {
					extract($val);
					$da001 = trim($this->input->post('da001'));	//日期
					$da001 = date("Ymd", strtotime($da001));
					$da002 = trim($this->input->post('da002'));	//爐次
					$sql96 = " INSERT INTO dbo.prsdc
											(company, creator, usr_group, create_date, flag, dc001, dc002, dc003, dc004, dc005, dc006, dc007, dc008)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$da001', '$da002', '$dc003', '$dc004', '$dc005', '$dc006', '$dc007', '$key'); 				
									";
					$this->db->query($sql96);
				}
			}
		}

		if (isset($order_product2)) {
			foreach ($order_product2 as $key => $val) {
				if ($val['dd003']) {
					extract($val);
					$da001 = trim($this->input->post('da001'));	//日期
					$da001 = date("Ymd", strtotime($da001));
					$da002 = trim($this->input->post('da002'));	//爐次
					$sql96 = " INSERT INTO dbo.prsdd
											(company, creator, usr_group, create_date, flag, dd001, dd002, dd003, dd004, dd005, dd006, dd007, dd008)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$da001', '$da002', '$dd003', '$dd004', '$dd005', '$dd006', '$dd007', '$key'); 				
									";
					$this->db->query($sql96);
				}
			}
		}
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
		       FROM mocta as a LEFT JOIN sfcta as b ON  a.ta001=b.tb001 and a.ta002=b.tb002 and  a.ta001 >= '$seq1'  AND a.ta001 <= '$seq2' AND a.ta002 >= '$seq3'  AND a.ta002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.ta006=c.mb001 ";
		//	  FROM mocta as a, sfcta as b WHERE ta001=tb001 and ta002=tb002 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//更改一筆	
	function updatef()
	{

		$da001 = trim($this->input->post('da001'));	//日期
		$da001 = date("Ymd", strtotime($da001));
		$da002 = trim($this->input->post('da002'));	//爐次
		$da003 = trim($this->input->post('da003'));	//材質
		$da004 = trim($this->input->post('da004'));	//CE值
		$da005 = trim($this->input->post('da005'));	//產品名稱
		$da005 = iconv('utf-8', 'BIG5', $da005);
		$da006 = trim($this->input->post('da006'));	//出爐溫度(℃)
		$da007 = trim($this->input->post('da007'));	//電力(開始)
		$da008 = trim($this->input->post('da008'));	//電力(結束)
		$da009 = trim($this->input->post('da009'));	//電力(耗電)
		$da010 = trim($this->input->post('da010'));	//故障記錄
		$da010 = iconv('utf-8', 'BIG5', $da010);
		$da011 = trim($this->input->post('da011'));	//備註
		$da011 = iconv('utf-8', 'BIG5', $da011);
		$company = 'YJ';
		$creator = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');
		$modifier = trim($this->session->userdata('sysuser'));
		$flag = $this->input->post('flag') + 1;

		$sql = " UPDATE dbo.prsda 
					SET company='$company',usr_group='$usr_group',modifier='$modifier', modi_date='$vtoday', flag='$flag', da003='$da003', da004='$da004', da005='$da005',
					da006='$da006', da007='$da007', da008='$da008', da009='$da009', da010='$da010', da011='$da011'
					where da001='$da001' and da002='$da002'
				";

		$this->db->query($sql);

		$sql98 = " DELETE FROM prsdb WHERE db001 = '$da001' and db002='$da002' ";
		$this->db->query($sql98);

		$sql98 = " DELETE FROM prsdc WHERE dc001 = '$da001' and dc002='$da002' ";
		$this->db->query($sql98);

		$sql98 = " DELETE FROM prsdd WHERE dd001 = '$da001' and dd002='$da002' ";
		$this->db->query($sql98);


		if ($this->input->post()) {
			extract($this->input->post());
		}


		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}
		if (isset($order_product1)) {
			if (!is_array($order_product1)) {
				$order_product1 = array();
			}
		}
		if (isset($order_product2)) {
			if (!is_array($order_product2)) {
				$order_product2 = array();
			}
		}



		if (isset($order_product)) {
			foreach ($order_product as $key => $val) {
				if ($val['db003']) {
					extract($val);
					$da001 = trim($this->input->post('da001'));	//日期
					$da001 = date("Ymd", strtotime($da001));
					$da002 = trim($this->input->post('da002'));	//爐次
					$sql95 = " INSERT INTO dbo.prsdb
											(company, modifier, usr_group, modi_date, flag, db001, db002, db003, db004, db005, db006, db007, db008, db009, db010, db011)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$da001', '$da002', '$db003', '$db004', '$db005', '$db006', '$db007', '$db008', '$db009', '$db010', '$key'); 				
									";
					$this->db->query($sql95);
				}
			}
		}

		if (isset($order_product1)) {
			foreach ($order_product1 as $key => $val) {
				if ($val['dc003']) {
					extract($val);
					$da001 = trim($this->input->post('da001'));	//日期
					$da001 = date("Ymd", strtotime($da001));
					$da002 = trim($this->input->post('da002'));	//爐次
					$sql96 = " INSERT INTO dbo.prsdc
											(company, modifier, usr_group, modi_date, flag, dc001, dc002, dc003, dc004, dc005, dc006, dc007, dc008)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$da001', '$da002', '$dc003', '$dc004', '$dc005', '$dc006', '$dc007', '$key'); 				
									";
					$this->db->query($sql96);
				}
			}
		}

		if (isset($order_product2)) {
			foreach ($order_product2 as $key => $val) {
				if ($val['dd003']) {
					extract($val);
					$da001 = trim($this->input->post('da001'));	//日期
					$da001 = date("Ymd", strtotime($da001));
					$da002 = trim($this->input->post('da002'));	//爐次
					$sql96 = " INSERT INTO dbo.prsdd
											(company, modifier, usr_group, modi_date, flag, dd001, dd002, dd003, dd004, dd005, dd006, dd007, dd008)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$da001', '$da002', '$dd003', '$dd004', '$dd005', '$dd006', '$dd007', '$key'); 				
									";
					$this->db->query($sql96);
				}
			}
		}
		return '修改資料成功!';
	}

	//刪除一筆細項	
	function deletedetailf($seg1, $seg2, $seg3)
	{
		$sql95 = " DELETE FROM dbo.prsdb
					WHERE db001 = '$seg1' and db002='$seg2'	and db011 ='$seg3'		
					";
		$this->db->query($sql95);

		return true;
	}

	//刪除一筆細項	
	function deletedetailf1($seg1, $seg2, $seg3)
	{
		$sql95 = " DELETE FROM dbo.prsdc
					WHERE dc001 = '$seg1' and dc002='$seg2'	and dc008 ='$seg3'		
					";
		$this->db->query($sql95);

		return true;
	}

	//刪除一筆細項	
	function deletedetailf2($seg1, $seg2, $seg3)
	{
		$sql95 = " DELETE FROM dbo.prsdd
					WHERE dd001 = '$seg1' and dd002='$seg2'	and dd008 ='$seg3'		
					";
		$this->db->query($sql95);

		return true;
	}

	//選取刪除多筆   
	function delmutif()
	{
		$seq[] = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		$x = 0;
		$seq1 = ' ';
		$seq2 = ' ';
		$seq3 = ' ';
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;

				list($seq1, $seq2) = explode("/", $seq[$x]);
				$seq1;
				$seq2;

				//由製造命令 1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工 		  

				$sql98 = " DELETE FROM prsda WHERE da001 = '$seq1' and da002='$seq2' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM prsdb WHERE db001 = '$seq1' and db002='$seq2' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM prsdc WHERE dc001 = '$seq1' and dc002='$seq2' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM prsdd WHERE dd001 = '$seq1' and dd002='$seq2' ";
				$this->db->query($sql98);
			}
		}
		// if ($this->db->affected_rows() > 0) {
		return TRUE;
		// }
		// return FALSE;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
