<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pcli02_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	//欄位表頭排序流覽資料
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('pcli02_search', "display_search/" . $offset);
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
						SUBSTRING(Right('0000' + Cast(sa004 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(sa004 as varchar),4),3,2) as sa004a,
						SUBSTRING(Right('0000' + Cast(sa005 as varchar),4),1,2)+':'+SUBSTRING(Right('0000' + Cast(sa005 as varchar),4),3,2) as sa005a,
						( SELECT TOP 1 sb005 FROM pclsb as d where d.sb001=a.sa001 and d.sb002=a.sa002 and d.sb003=a.sa003 ) as sb005a,
						( SELECT TOP 1 sb006 FROM pclsb as d where d.sb001=a.sa001 and d.sb002=a.sa002 and d.sb003=a.sa003 ) as sb006a,
						( SELECT TOP 1 sb007 FROM pclsb as d where d.sb001=a.sa001 and d.sb002=a.sa002 and d.sb003=a.sa003 ) as sb007a,
						( SELECT sum(convert(int,sb005)) FROM pclsb as d where d.sb001=a.sa001 and d.sb002=a.sa002 and d.sb003=a.sa003 ) as sb005sum
					FROM pclsa as a
						LEFT JOIN INVMB as b ON sa002=MB001
						LEFT JOIN CMSMX as c ON sa003=MX001
					where sa001>='$vday'
					order by sa001 desc, sa003, sa002
		 			";

		$query = $this->db->query($sql98);
		$ret['data'] = $query->result();

		//建構暫存view
		$this->construct_view($ret['data']);

		//儲存sql
		$_SESSION['pcli02']['search']['sql'] = $this->db->last_query();

		/* Num SQL*/
		// $sql = " SELECT count(*) as count from pclsa  
		// 				left join pclsb sa001=sb001 AND sa002=sb002 
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
			"sa001", "sa002", "sa003", "sa008"
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
		$_SESSION['pcli02']['search']['view'] = $view_array;
		$_SESSION['pcli02']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['pcli02']['search']['view']);exit;

	}



	//查詢修改用 (看資料用)  單別,品號 , 廠別, 庫別, 線別, 加工廠商, 品號,庫别2,幣別
	function selone($seq1, $seq2, $seq3, $seq4)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select a.*, b.MB002, b.MB003, c.MX003, 
					( SELECT sum(convert(int,sb005)) FROM pclsb as d where d.sb001=a.sa001 and d.sb002=a.sa002 and d.sb003=a.sa003 ) as sb005sum 
						from pclsa as a
					left join INVMB as b on sa002=MB001
					left join CMSMX as c on sa003=MX001
					where sa001='$seq1' and sa002='$seq2' and sa003='$seq3' and sa008='$seq4'
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	function selone1($seq1, $seq2, $seq3, $seq4)
	{
		$seq1 = date("Ymd", strtotime($seq1));
		$sql98 = " select * from pclsb where sb001='$seq1' and sb002='$seq2' and sb003='$seq3' and sb008='$seq4' order by sb004
					";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $key => $row) {
				$row->sb006 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->sb006), 'utf-8', 'big-5'), ENT_QUOTES));
				$row->sb007 = stripslashes(htmlspecialchars(mb_convert_encoding(trim($row->sb007), 'utf-8', 'big-5'), ENT_QUOTES));
			}
			return $query->result();
		}
		return array();
	}


	//新增一筆 檔頭  mocta	
	function insertf()    //新增一筆 檔頭  mocta
	{
		$sa001 = trim($this->input->post('sa001'));	//日期
		$sa001 = date("Ymd", strtotime($sa001));
		$sa002 = trim($this->input->post('sa002'));	//品　　號
		$sa003 = trim($this->input->post('sa003'));	//機台代號
		$sa004 = trim($this->input->post('sa004'));	//生產起
		$sa005 = trim($this->input->post('sa005'));	//生產迄
		$sa006 = trim($this->input->post('sa006'));	//生產時數
		$sa007 = trim($this->input->post('sa007'));	//備　　註
		$sa007 = iconv('utf-8', 'BIG5', $sa007);
		$sa008 = trim($this->input->post('sa008'));	//次　　數


		$company = 'YJ';
		$creator = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');

		if (!$sa002) {
			return '無資料';
		}

		$exist = $this->pcli02_model->selone($sa001, $sa002, $sa003, $sa008);
		if ($exist) {
			return 'exist';
		}

		$sql = " INSERT INTO dbo.pclsa
						(company, creator, usr_group, create_date, flag, sa001, sa002, sa003, sa004, sa005, sa006, sa007, sa008)
				VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$sa001', '$sa002', '$sa003', '$sa004', '$sa005', '$sa006', '$sa007', '$sa008'); 
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


		if (isset($order_product)) {
			foreach ($order_product as $key => $val) {
				// if ($val['sb003']) {
				extract($val);
				$sa001 = trim($this->input->post('sa001'));	//日期
				$sa001 = date("Ymd", strtotime($sa001));
				$sa002 = trim($this->input->post('sa002'));	//品　　號
				// $sb007 = iconv('utf-8', 'BIG5', $sb007);
				// $sb008 = iconv('utf-8', 'BIG5', $sb008);
				$sql95 = " INSERT INTO dbo.pclsb
											(company, creator, usr_group, create_date, flag, sb001, sb002, sb003, sb004, sb005, sb006, sb007, sb008)
									VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$sa001', '$sa002', '$sa003', '$key', '$sb005', '$sb006', '$sb007', '$sa008'); 				
									";
				$this->db->query($sql95);
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

		$sa001 = trim($this->input->post('sa001'));	//日期
		$sa001 = date("Ymd", strtotime($sa001));
		$sa002 = trim($this->input->post('sa002'));	//品　　號
		$sa003 = trim($this->input->post('sa003'));	//機台代號
		$sa004 = trim($this->input->post('sa004'));	//生產起
		$sa005 = trim($this->input->post('sa005'));	//生產迄
		$sa006 = trim($this->input->post('sa006'));	//生產時數
		$sa007 = trim($this->input->post('sa007'));	//備　　註
		$sa007 = iconv('utf-8', 'BIG5', $sa007);

		$company = 'YJ';
		$creator = trim($this->session->userdata('sysuser'));
		$usr_group = 'A100';
		$vtoday = date('Ymd');
		$modifier = trim($this->session->userdata('sysuser'));
		$flag = $this->input->post('flag') + 1;

		$sql = " UPDATE dbo.pclsa 
					SET company='$company',usr_group='$usr_group',modifier='$modifier', modi_date='$vtoday', flag='$flag', sa003='$sa003', sa004='$sa004',
					sa005='$sa005', sa006='$sa006', sa007='$sa007'
					where sa001='$sa001' and sa002='$sa002' and sa003='$sa003'
				";

		$this->db->query($sql);

		$sql98 = " DELETE FROM pclsb WHERE sb001 = '$sa001' and sb002='$sa002' and sb003='$sa003' ";
		$this->db->query($sql98);


		if ($this->input->post()) {
			extract($this->input->post());
		}


		if (isset($order_product)) {
			if (!is_array($order_product)) {
				$order_product = array();
			}
		}

		if (isset($order_product)) {
			foreach ($order_product as $key => $val) {
				// if ($val['sb003']) {
				extract($val);
				$sa001 = trim($this->input->post('sa001'));	//日期
				$sa001 = date("Ymd", strtotime($sa001));
				$sa002 = trim($this->input->post('sa002'));	//品　　號
				$sb006 = iconv('utf-8', 'BIG5', $sb006);
				$sb007 = iconv('utf-8', 'BIG5', $sb007);
				$sql95 = " INSERT INTO dbo.pclsb
											(company, modifier, usr_group, modi_date, flag, sb001, sb002, sb003, sb004, sb005, sb006, sb007)
									VALUES ('$company', '$modifier', '$usr_group', '$vtoday', '$flag', '$sa001', '$sa002', '$sa003', '$key', '$sb005', '$sb006', '$sb007'); 				
									";
				$this->db->query($sql95);
				// }
			}
		}

		return '修改資料成功!';
	}

	//刪除一筆細項	
	function deletedetailf($seg1, $seg2, $seg3, $seg4)
	{
		$sql95 = " DELETE FROM dbo.pclsb
					WHERE sb001 = '$seg1' and sb002='$seg2'	and sb003 ='$seg3' and sb004 ='$seg4'	
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
		$seq4 = ' ';
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;

				list($seq1, $seq2, $seq3, $seq4) = explode("/", $seq[$x]);
				$seq1;
				$seq2;
				$seq3;
				$seq4;

				//由製造命令 1.未生產、2.已發料、3.生產中、Y.已完工、y.指定完工 		  

				$sql98 = " DELETE FROM pclsa WHERE sa001 = '$seq1' and sa002='$seq2' and sa003='$seq3' and sa008='$seq4' ";
				$this->db->query($sql98);

				$sql98 = " DELETE FROM pclsb WHERE sb001 = '$seq1' and sb002='$seq2' and sb003='$seq3' and sb008='$seq4' ";
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
