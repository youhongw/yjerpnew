<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pcli01_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//欄位表頭排序流覽資料
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('pcli01_search', "display_search/" . $offset);
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
		$sql98 = "  SELECT a.* , b.MB002, b.MB003, c.MX003,
						( SELECT TOP 1 bi005 FROM pclbi as d where d.bi001=a.bh001 and d.bi002=a.bh002 and d.bi003=a.bh003 and bi005=1 ) as bi005a,
						( SELECT TOP 1 bi007 FROM pclbi as d where d.bi001=a.bh001 and d.bi002=a.bh002 and d.bi003=a.bh003 and bi005=1 ) as bi007a,
						( SELECT TOP 1 bi008 FROM pclbi as d where d.bi001=a.bh001 and d.bi002=a.bh002 and d.bi003=a.bh003 and bi005=1 ) as bi008a,
						( SELECT TOP 1 bi005 FROM pclbi as d where d.bi001=a.bh001 and d.bi002=a.bh002 and d.bi003=a.bh003 and bi005=2 ) as bi005b,
						( SELECT TOP 1 bi007 FROM pclbi as d where d.bi001=a.bh001 and d.bi002=a.bh002 and d.bi003=a.bh003 and bi005=2 ) as bi007b,
						( SELECT TOP 1 bi008 FROM pclbi as d where d.bi001=a.bh001 and d.bi002=a.bh002 and d.bi003=a.bh003 and bi005=2 ) as bi008b,
						( SELECT TOP 1 bj005 FROM pclbj as d where d.bj001=a.bh001 and d.bj002=a.bh002 and d.bj003=a.bh003 and bj005=1 ) as bj005a,
						( SELECT TOP 1 bj006 FROM pclbj as d where d.bj001=a.bh001 and d.bj002=a.bh002 and d.bj003=a.bh003 and bj005=1 ) as bj006a,
						( SELECT TOP 1 bj007 FROM pclbj as d where d.bj001=a.bh001 and d.bj002=a.bh002 and d.bj003=a.bh003 and bj005=1 ) as bj007a,
						( SELECT TOP 1 bj005 FROM pclbj as d where d.bj001=a.bh001 and d.bj002=a.bh002 and d.bj003=a.bh003 and bj005=2 ) as bj005b,
						( SELECT TOP 1 bj006 FROM pclbj as d where d.bj001=a.bh001 and d.bj002=a.bh002 and d.bj003=a.bh003 and bj005=2 ) as bj006b,
						( SELECT TOP 1 bj007 FROM pclbj as d where d.bj001=a.bh001 and d.bj002=a.bh002 and d.bj003=a.bh003 and bj005=2 ) as bj007b,
						( SELECT TOP 1 bk005 FROM pclbk as d where d.bk001=a.bh001 and d.bk002=a.bh002 and d.bk003=a.bh003 and bk006=1 ) as bk005a,
						( SELECT TOP 1 bk006 FROM pclbk as d where d.bk001=a.bh001 and d.bk002=a.bh002 and d.bk003=a.bh003 and bk006=1 ) as bk006a,
						( SELECT TOP 1 bk007 FROM pclbk as d where d.bk001=a.bh001 and d.bk002=a.bh002 and d.bk003=a.bh003 and bk006=1 ) as bk007a,
						( SELECT TOP 1 bk008 FROM pclbk as d where d.bk001=a.bh001 and d.bk002=a.bh002 and d.bk003=a.bh003 and bk006=1 ) as bk008a,
						( SELECT TOP 1 bk005 FROM pclbk as d where d.bk001=a.bh001 and d.bk002=a.bh002 and d.bk003=a.bh003 and bk006=2 ) as bk005b,
						( SELECT TOP 1 bk006 FROM pclbk as d where d.bk001=a.bh001 and d.bk002=a.bh002 and d.bk003=a.bh003 and bk006=2 ) as bk006b,
						( SELECT TOP 1 bk007 FROM pclbk as d where d.bk001=a.bh001 and d.bk002=a.bh002 and d.bk003=a.bh003 and bk006=2 ) as bk007b,
						( SELECT TOP 1 bk008 FROM pclbk as d where d.bk001=a.bh001 and d.bk002=a.bh002 and d.bk003=a.bh003 and bk006=2 ) as bk008b,
						( SELECT TOP 1 bl005 FROM pclbl as d where d.bl001=a.bh001 and d.bl002=a.bh002 and d.bl003=a.bh003 and bl005=1 ) as bl005a,
						( SELECT TOP 1 bl007 FROM pclbl as d where d.bl001=a.bh001 and d.bl002=a.bh002 and d.bl003=a.bh003 and bl005=1 ) as bl007a,
						( SELECT TOP 1 bl008 FROM pclbl as d where d.bl001=a.bh001 and d.bl002=a.bh002 and d.bl003=a.bh003 and bl005=1 ) as bl008a,
						( SELECT TOP 1 bl005 FROM pclbl as d where d.bl001=a.bh001 and d.bl002=a.bh002 and d.bl003=a.bh003 and bl005=2 ) as bl005b,
						( SELECT TOP 1 bl007 FROM pclbl as d where d.bl001=a.bh001 and d.bl002=a.bh002 and d.bl003=a.bh003 and bl005=2 ) as bl007b,
						( SELECT TOP 1 bl008 FROM pclbl as d where d.bl001=a.bh001 and d.bl002=a.bh002 and d.bl003=a.bh003 and bl005=2 ) as bl008b,
						( SELECT TOP 1 bm005 FROM pclbm as d where d.bm001=a.bh001 and d.bm002=a.bh002 and d.bm003=a.bh003 and bm005=1 ) as bm005a,
						( SELECT TOP 1 bm006 FROM pclbm as d where d.bm001=a.bh001 and d.bm002=a.bh002 and d.bm003=a.bh003 and bm005=1 ) as bm006a,
						( SELECT TOP 1 bm007 FROM pclbm as d where d.bm001=a.bh001 and d.bm002=a.bh002 and d.bm003=a.bh003 and bm005=1 ) as bm007a,
						( SELECT TOP 1 bm005 FROM pclbm as d where d.bm001=a.bh001 and d.bm002=a.bh002 and d.bm003=a.bh003 and bm005=2 ) as bm005b,
						( SELECT TOP 1 bm006 FROM pclbm as d where d.bm001=a.bh001 and d.bm002=a.bh002 and d.bm003=a.bh003 and bm005=2 ) as bm006b,
						( SELECT TOP 1 bm007 FROM pclbm as d where d.bm001=a.bh001 and d.bm002=a.bh002 and d.bm003=a.bh003 and bm005=2 ) as bm007b,
						( SELECT TOP 1 bn005 FROM pclbn as d where d.bn001=a.bh001 and d.bn002=a.bh002 and d.bn003=a.bh003 and bn005=1 ) as bn005a,
						( SELECT TOP 1 bn006 FROM pclbn as d where d.bn001=a.bh001 and d.bn002=a.bh002 and d.bn003=a.bh003 and bn005=1 ) as bn006a,
						( SELECT TOP 1 bn007 FROM pclbn as d where d.bn001=a.bh001 and d.bn002=a.bh002 and d.bn003=a.bh003 and bn005=1 ) as bn007a,
						( SELECT TOP 1 bn005 FROM pclbn as d where d.bn001=a.bh001 and d.bn002=a.bh002 and d.bn003=a.bh003 and bn005=2 ) as bn005b,
						( SELECT TOP 1 bn006 FROM pclbn as d where d.bn001=a.bh001 and d.bn002=a.bh002 and d.bn003=a.bh003 and bn005=2 ) as bn006b,
						( SELECT TOP 1 bn007 FROM pclbn as d where d.bn001=a.bh001 and d.bn002=a.bh002 and d.bn003=a.bh003 and bn005=2 ) as bn007b
					FROM pclbh as a
						LEFT JOIN INVMB as b ON bh002=MB001
						LEFT JOIN CMSMX as c ON bh003=MX001
					where bh001>='$vday'
					order by bh001 desc, bh003, bh002
		 			";

		$query = $this->db->query($sql98);
		$ret['data'] = $query->result();

		//建構暫存view
		$this->construct_view($ret['data']);

		//儲存sql
		$_SESSION['pcli01']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		// $sql = " SELECT count(*) as count from pclbh  
		// 				left join pclbi bh001=bi001 AND bh002=bi002 
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
			"bh001", "bh002", "bh003"
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
		$_SESSION['pcli01']['search']['view'] = $view_array;
		$_SESSION['pcli01']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['pcli01']['search']['view']);exit;

	}



	//查詢修改用 (看資料用)  單別,品號 , 廠別, 庫別, 線別, 加工廠商, 品號,庫别2,幣別
	function selone($seq1, $seq2, $seq3)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select a.*, b.MB002, b.MB003, c.MX003 from pclbh as a
					left join INVMB as b on bh002=MB001
					left join CMSMX as c on bh003=MX001
					where bh001='$seq1' and bh002='$seq2' and bh003='$seq3'
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	function selone1($seq1, $seq2, $seq3)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from pclbi where bi001='$seq1' and bi002='$seq2' and bi003='$seq3' order by bi004
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $row) {
				$row->bi007 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bi007), 'utf-8', 'big-5'), ENT_QUOTES));
				$row->bi008 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bi008), 'utf-8', 'big-5'), ENT_QUOTES));
			}
			return $query->result();
		}
		return array();
	}

	function selone2($seq1, $seq2, $seq3)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from pclbj where bj001='$seq1' and bj002='$seq2' and bj003='$seq3' order by bj004
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $row) {
				$row->bj006 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bj006), 'utf-8', 'big-5'), ENT_QUOTES));
				$row->bj007 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bj007), 'utf-8', 'big-5'), ENT_QUOTES));
			}
			return $query->result();
		}
		return array();
	}

	function selone3($seq1, $seq2, $seq3)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from pclbk where bk001='$seq1' and bk002='$seq2' and bk003='$seq3' order by bk004
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $row) {
				$row->bk005 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bk005), 'utf-8', 'big-5'), ENT_QUOTES));
				$row->bk007 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bk007), 'utf-8', 'big-5'), ENT_QUOTES));
				$row->bk008 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bk008), 'utf-8', 'big-5'), ENT_QUOTES));
			}
			return $query->result();
		}
		return array();
	}

	function selone4($seq1, $seq2, $seq3)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from pclbl where bl001='$seq1' and bl002='$seq2' and bl003='$seq3' order by bl004
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $row) {
				$row->bl007 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bl007), 'utf-8', 'big-5'), ENT_QUOTES));
				$row->bl008 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bl008), 'utf-8', 'big-5'), ENT_QUOTES));
			}
			return $query->result();
		}
		return array();
	}

	function selone5($seq1, $seq2, $seq3)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from pclbm where bm001='$seq1' and bm002='$seq2' and bm003='$seq3' order by bm004
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $row) {
				$row->bm006 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bm006), 'utf-8', 'big-5'), ENT_QUOTES));
				$row->bm007 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bm007), 'utf-8', 'big-5'), ENT_QUOTES));
			}
			return $query->result();
		}
		return array();
	}

	function selone6($seq1, $seq2, $seq3)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from pclbn where bn001='$seq1' and bn002='$seq2' and bn003='$seq3' order by bn004
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $row) {
				$row->bn006 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bn006), 'utf-8', 'big-5'), ENT_QUOTES));
				$row->bn007 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->bn007), 'utf-8', 'big-5'), ENT_QUOTES));
			}
			return $query->result();
		}
		return array();
	}


	//新增一筆 檔頭  mocta	
	function insertf()    //新增一筆 檔頭  mocta
	{
		$bh001 = trim($this->input->post('bh001'));	//日期
		$bh001 = date("Ymd", strtotime($bh001));
		$bh002 = trim($this->input->post('bh002'));	//品　　號
		$bh003 = trim($this->input->post('bh003'));	//機台代號
		$bh004 = trim($this->input->post('bh004'));	//備　　註
		$bh004 = iconv('utf-8', 'BIG5', $bh004);

		$company = 'YJ';
		$creator = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');

		if (!$bh002) {
			return '無資料';
		}

		$exist = $this->pcli01_model->selone($bh001, $bh002, $bh003);
		if ($exist) {
			return 'exist';
		}



		$sql = " INSERT INTO dbo.pclbh
						(company, creator, usr_group, create_date, flag, bh001, bh002, bh003, bh004)
				VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$bh001', '$bh002', '$bh003', '$bh004'); 
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
		if (isset($order_product3)) {
			if (!is_array($order_product3)) {
				$order_product3 = array();
			}
		}
		if (isset($order_product4)) {
			if (!is_array($order_product4)) {
				$order_product4 = array();
			}
		}
		if (isset($order_product5)) {
			if (!is_array($order_product5)) {
				$order_product5 = array();
			}
		}



		if (isset($order_product)) {
			foreach ($order_product as $key => $val) {
				// if ($val['bi003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bi007 = iconv('utf-8', 'BIG5', $bi007);
				$bi008 = iconv('utf-8', 'BIG5', $bi008);
				$sql95 = " INSERT INTO dbo.pclbi
											(company, creator, usr_group, create_date, flag, bi001, bi002, bi003, bi004, bi005, bi006, bi007, bi008)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$bh001', '$bh002', '$bh003', '$key', '$bi005', '$bi006', '$bi007', '$bi008'); 				
									";
				$this->db->query($sql95);
				// }
			}
		}

		if (isset($order_product1)) {
			foreach ($order_product1 as $key => $val) {
				// if ($val['bj003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bj006 = iconv('utf-8', 'BIG5', $bj006);
				$bj007 = iconv('utf-8', 'BIG5', $bj007);
				$sql96 = " INSERT INTO dbo.pclbj
											(company, creator, usr_group, create_date, flag, bj001, bj002, bj003, bj004, bj005, bj006, bj007)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$bh001', '$bh002', '$bh003', '$key', '$bj005', '$bj006', '$bj007'); 				
									";
				$this->db->query($sql96);
				// }
			}
		}

		if (isset($order_product2)) {
			foreach ($order_product2 as $key => $val) {
				// if ($val['bk003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bk005 = iconv('utf-8', 'BIG5', $bk005);
				$bk007 = iconv('utf-8', 'BIG5', $bk007);
				$bk008 = iconv('utf-8', 'BIG5', $bk008);
				$sql96 = " INSERT INTO dbo.pclbk
											(company, creator, usr_group, create_date, flag, bk001, bk002, bk003, bk004, bk005, bk006, bk007, bk008)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$bh001', '$bh002', '$bh003', '$key', '$bk005', '$bk006', '$bk007', '$bk008'); 				
									";
				$this->db->query($sql96);
				// }
			}
		}

		if (isset($order_product3)) {
			foreach ($order_product3 as $key => $val) {
				// if ($val['bi003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bl007 = iconv('utf-8', 'BIG5', $bl007);
				$bl008 = iconv('utf-8', 'BIG5', $bl008);
				$sql95 = " INSERT INTO dbo.pclbl
											(company, creator, usr_group, create_date, flag, bl001, bl002, bl003, bl004, bl005, bl006, bl007, bl008)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$bh001', '$bh002', '$bh003', '$key', '$bl005', '$bl006', '$bl007', '$bl008'); 				
									";
				$this->db->query($sql95);
				// }
			}
		}

		if (isset($order_product4)) {
			foreach ($order_product4 as $key => $val) {
				// if ($val['bj003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bm006 = iconv('utf-8', 'BIG5', $bm006);
				$bm007 = iconv('utf-8', 'BIG5', $bm007);
				$sql96 = " INSERT INTO dbo.pclbm
											(company, creator, usr_group, create_date, flag, bm001, bm002, bm003, bm004, bm005, bm006, bm007)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$bh001', '$bh002', '$bh003', '$key', '$bm005', '$bm006', '$bm007'); 				
									";
				$this->db->query($sql96);
				// }
			}
		}

		if (isset($order_product5)) {
			foreach ($order_product5 as $key => $val) {
				// if ($val['bj003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bn006 = iconv('utf-8', 'BIG5', $bn006);
				$bn007 = iconv('utf-8', 'BIG5', $bn007);
				$sql96 = " INSERT INTO dbo.pclbn
											(company, creator, usr_group, create_date, flag, bn001, bn002, bn003, bn004, bn005, bn006, bn007)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$bh001', '$bh002', '$bh003', '$key', '$bn005', '$bn006', '$bn007'); 				
									";
				$this->db->query($sql96);
				// }
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

		$bh001 = trim($this->input->post('bh001'));	//日期
		$bh001 = date("Ymd", strtotime($bh001));
		$bh002 = trim($this->input->post('bh002'));	//品　　號
		$bh003 = trim($this->input->post('bh003'));	//機台代號
		$bh004 = trim($this->input->post('bh004'));	//備　　註
		$bh004 = iconv('utf-8', 'BIG5', $bh004);

		$company = 'YJ';
		$creator = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');
		$modifier = trim($this->session->userdata('sysuser'));
		$flag = $this->input->post('flag') + 1;

		$sql = " UPDATE dbo.pclbh 
					SET company='$company',usr_group='$usr_group',modifier='$modifier', modi_date='$vtoday', flag='$flag', bh003='$bh003', bh004='$bh004'
					where bh001='$bh001' and bh002='$bh002' and bh003='$bh003'
				";

		$this->db->query($sql);

		$sql98 = " DELETE FROM pclbi WHERE bi001 = '$bh001' and bi002='$bh002' and bi003='$bh003' ";
		$this->db->query($sql98);

		$sql98 = " DELETE FROM pclbj WHERE bj001 = '$bh001' and bj002='$bh002' and bj003='$bh003' ";
		$this->db->query($sql98);

		$sql98 = " DELETE FROM pclbk WHERE bk001 = '$bh001' and bk002='$bh002' and bk003='$bh003' ";
		$this->db->query($sql98);

		$sql98 = " DELETE FROM pclbl WHERE bl001 = '$bh001' and bl002='$bh002' and bl003='$bh003' ";
		$this->db->query($sql98);

		$sql98 = " DELETE FROM pclbm WHERE bm001 = '$bh001' and bm002='$bh002' and bm003='$bh003' ";
		$this->db->query($sql98);

		$sql98 = " DELETE FROM pclbn WHERE bn001 = '$bh001' and bn002='$bh002' and bn003='$bh003' ";
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
		if (isset($order_product3)) {
			if (!is_array($order_product3)) {
				$order_product3 = array();
			}
		}
		if (isset($order_product4)) {
			if (!is_array($order_product4)) {
				$order_product4 = array();
			}
		}
		if (isset($order_product5)) {
			if (!is_array($order_product5)) {
				$order_product5 = array();
			}
		}

		if (isset($order_product)) {
			foreach ($order_product as $key => $val) {
				// if ($val['bi003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bi007 = iconv('utf-8', 'BIG5', $bi007);
				$bi008 = iconv('utf-8', 'BIG5', $bi008);
				$sql95 = " INSERT INTO dbo.pclbi
											(company, modifier, usr_group, modi_date, flag, bi001, bi002, bi003, bi004, bi005, bi006, bi007, bi008)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$bh001', '$bh002', '$bh003', '$key', '$bi005', '$bi006', '$bi007', '$bi008'); 				
									";
				$this->db->query($sql95);
				// }
			}
		}

		if (isset($order_product1)) {
			foreach ($order_product1 as $key => $val) {
				// if ($val['bj003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bj006 = iconv('utf-8', 'BIG5', $bj006);
				$bj007 = iconv('utf-8', 'BIG5', $bj007);
				$sql96 = " INSERT INTO dbo.pclbj
											(company, modifier, usr_group, modi_date, flag, bj001, bj002, bj003, bj004, bj005, bj006, bj007)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$bh001', '$bh002', '$bh003', '$key', '$bj005', '$bj006', '$bj007'); 				
									";
				$this->db->query($sql96);
				// }
			}
		}

		if (isset($order_product2)) {
			foreach ($order_product2 as $key => $val) {
				// if ($val['bk003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bk005 = iconv('utf-8', 'BIG5', $bk005);
				$bk007 = iconv('utf-8', 'BIG5', $bk007);
				$bk008 = iconv('utf-8', 'BIG5', $bk008);
				$sql96 = " INSERT INTO dbo.pclbk
											(company, modifier, usr_group, modi_date, flag, bk001, bk002, bk003, bk004, bk005, bk006, bk007, bk008)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$bh001', '$bh002', '$bh003', '$key', '$bk005', '$bk006', '$bk007', '$bk008'); 				
									";
				$this->db->query($sql96);
				// }
			}
		}

		if (isset($order_product3)) {
			foreach ($order_product3 as $key => $val) {
				// if ($val['bi003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bl007 = iconv('utf-8', 'BIG5', $bl007);
				$bl008 = iconv('utf-8', 'BIG5', $bl008);
				$sql95 = " INSERT INTO dbo.pclbl
											(company, modifier, usr_group, modi_date, flag, bl001, bl002, bl003, bl004, bl005, bl006, bl007, bl008)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$bh001', '$bh002', '$bh003', '$key', '$bl005', '$bl006', '$bl007', '$bl008'); 				
									";
				$this->db->query($sql95);
				// }
			}
		}

		if (isset($order_product4)) {
			foreach ($order_product4 as $key => $val) {
				// if ($val['bj003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bm006 = iconv('utf-8', 'BIG5', $bm006);
				$bm007 = iconv('utf-8', 'BIG5', $bm007);
				$sql96 = " INSERT INTO dbo.pclbm
											(company, modifier, usr_group, modi_date, flag, bm001, bm002, bm003, bm004, bm005, bm006, bm007)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$bh001', '$bh002', '$bh003', '$key', '$bm005', '$bm006', '$bm007'); 				
									";
				$this->db->query($sql96);
				// }
			}
		}

		if (isset($order_product5)) {
			foreach ($order_product5 as $key => $val) {
				// if ($val['bj003']) {
				extract($val);
				$bh001 = trim($this->input->post('bh001'));	//日期
				$bh001 = date("Ymd", strtotime($bh001));
				$bh002 = trim($this->input->post('bh002'));	//品　　號
				$bn006 = iconv('utf-8', 'BIG5', $bn006);
				$bn007 = iconv('utf-8', 'BIG5', $bn007);
				$sql96 = " INSERT INTO dbo.pclbn
											(company, modifier, usr_group, modi_date, flag, bn001, bn002, bn003, bn004, bn005, bn006, bn007)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$bh001', '$bh002', '$bh003', '$key', '$bn005', '$bn006', '$bn007'); 				
									";
				$this->db->query($sql96);
				// }
			}
		}

		return '修改資料成功!';
	}

	//刪除一筆細項	
	function deletedetailf($seg1, $seg2, $seg3, $seg4)
	{
		$sql95 = " DELETE FROM dbo.pclbi
					WHERE bi001 = '$seg1' and bi002='$seg2'	and bi003 ='$seg3' and bi004 ='$seg4'	
					";
		$this->db->query($sql95);

		return true;
	}

	//刪除一筆細項	
	function deletedetailf1($seg1, $seg2, $seg3, $seg4)
	{
		$sql95 = " DELETE FROM dbo.pclbj
					WHERE bj001 = '$seg1' and bj002='$seg2'	and bj003 ='$seg3' and bj004 ='$seg4'		
					";
		$this->db->query($sql95);

		return true;
	}

	//刪除一筆細項	
	function deletedetailf2($seg1, $seg2, $seg3, $seg4)
	{
		$sql95 = " DELETE FROM dbo.pclbk
					WHERE bk001 = '$seg1' and bk002='$seg2'	and bk003 ='$seg3' and bk004 ='$seg4'	 	
					";
		$this->db->query($sql95);

		return true;
	}

	//刪除一筆細項	
	function deletedetailf3($seg1, $seg2, $seg3, $seg4)
	{
		$sql95 = " DELETE FROM dbo.pclbl
					WHERE bl001 = '$seg1' and bl002='$seg2'	and bl003 ='$seg3' and bl004 ='$seg4'	 	
					";
		$this->db->query($sql95);

		return true;
	}

	//刪除一筆細項	
	function deletedetailf4($seg1, $seg2, $seg3, $seg4)
	{
		$sql95 = " DELETE FROM dbo.pclbm
					WHERE bm001 = '$seg1' and bm002='$seg2'	and bm003 ='$seg3' and bm004 ='$seg4'	 	
					";
		$this->db->query($sql95);

		return true;
	}

	//刪除一筆細項	
	function deletedetailf5($seg1, $seg2, $seg3, $seg4)
	{
		$sql95 = " DELETE FROM dbo.pclbn
					WHERE bn001 = '$seg1' and bn002='$seg2'	and bn003 ='$seg3' and bn004 ='$seg4'	 	
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

				list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
				$seq1;
				$seq2;
				$seq3;

				//由製造命令 1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工 		  

				$sql98 = " DELETE FROM pclbh WHERE bh001 = '$seq1' and bh002='$seq2' and bh003='$seq3' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM pclbi WHERE bi001 = '$seq1' and bi002='$seq2' and bi003='$seq3' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM pclbj WHERE bj001 = '$seq1' and bj002='$seq2' and bj003='$seq3' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM pclbk WHERE bk001 = '$seq1' and bk002='$seq2' and bk003='$seq3' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM pclbl WHERE bl001 = '$seq1' and bl002='$seq2' and bl003='$seq3' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM pclbm WHERE bm001 = '$seq1' and bm002='$seq2' and bm003='$seq3' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM pclbn WHERE bn001 = '$seq1' and bn002='$seq2' and bn003='$seq3' ";
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
