<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sfci17_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}


	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 10, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfci17_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['sfci17']['search']);
		}

		//SELECT 代號 ,名稱 ,密碼 ,群組代號,超級使用者('N','Y'),備註(改權限使用),部門
		$sql21 = " select a.*,b.MW002 as da013dis FROM molda as a	
					left join CMSMW as b on a.da013 = b.MW001  ";

		$query = $this->db->query($sql21);
		$ret['data'] = $query->result();
		//儲存sql 語法
		$ret['num_sql'] = $this->db->last_query();
		$_SESSION['sfci17']['search']['sql'] = $this->db->last_query();

		$ret['num'] = count($ret['data']);

		return $ret;
	}

	//查詢一筆 修改用	updfrom
	function selone($seq1, $seq2, $seq3)
	{
		$sql98 = " select a.*,b.MW002 as da013dis FROM molda as a	
						left join CMSMW as b on a.da013 = b.MW001  
						where da001 = '$seq1' and da013='$seq2' and da014='$seq3' ";

		$query = $this->db->query($sql98);
		$result = $query->result();

		return $result;
	}

	function selone1($seq1, $seq2, $seq3)
	{
		$sql98 = " select * from dbo.molda where da001 = '$seq1' and da013='$seq2' and da014='$seq3' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	//新增一筆	
	function insertf()
	{
		$creator = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		$vda001 = trim($this->input->post('da001'));
		$vda002 = trim($this->input->post('da002'));
		$vda002 = iconv("utf-8", "BIG5", $vda002);
		$vda003 = str_replace("'", "''", trim($this->input->post('da003'))); // ' 處理'特殊字元錯誤問題
		$vda003 = iconv("utf-8", "BIG5", $vda003);
		$vda004 = trim($this->input->post('da004'));
		$vda005 = trim($this->input->post('da005'));
		$vda006 = trim($this->input->post('da006'));
		$vda007 = trim($this->input->post('da007'));
		$vda008 = trim($this->input->post('da008'));
		$vda009 = trim($this->input->post('da009'));
		$vda010 = trim($this->input->post('da010'));
		$vda011 = trim($this->input->post('da011'));
		$vda012 = trim($this->input->post('da012'));
		$vda012 = iconv("utf-8", "BIG5", $vda012);
		$vda013 = trim($this->input->post('da013'));
		$vda014 = trim($this->input->post('da014'));
		$vda015 = trim($this->input->post('da015'));
		$vda016 = trim($this->input->post('da016'));
		$vda017 = trim($this->input->post('da017'));
		$vda018 = trim($this->input->post('da018'));

		$sqlv = " INSERT INTO dbo.moldav (creator, create_date, flag, da001, da002, da003, da004, da005, da006, da007, da008, da009, da010, da011, da012, da013, da014, da015, da016, da017, da018)
VALUES ('$creator', '$vtoday', '0', '$vda001', '$vda002', '$vda003', '$vda004', '$vda005', '$vda006', '$vda007', '$vda008', '$vda009', '$vda010', '$vda011', '$vda012', '$vda013', '$vda014', '$vda015', '$vda016', '$vda017', '$vda018'); ";

		$this->db->query($sqlv);

		$sqls = " SELECT * from molda 
					where da001 = '$vda001' and da013='$vda013' and da014='$vda014'
				 ";

		$query = $this->db->query($sqls);
		if ($query->num_rows() > 0) {
			$sql = " UPDATE molda 
							SET	modifier='$creator', modi_date='$vtoday', flag=flag+1, da002='$vda002', da003='$vda003', da004='$vda004', da005='$vda005'
								, da006='$vda006', da007='$vda007', da008='$vda008', da009='$vda009', da010='$vda010', da011='$vda011', da012='$vda012', da015='$vda015', da016='$vda016'
								, da017='$vda017', da018='$vda018'
						where da001 = '$vda001' and da013='$vda013' and da014='$vda014'
					";
		} else {
			$sql = " INSERT INTO dbo.molda (creator, create_date, flag, da001, da002, da003, da004, da005, da006, da007, da008, da009, da010, da011, da012, da013, da014, da015, da016, da017, da018)
VALUES ('$creator', '$vtoday', '0', '$vda001', '$vda002', '$vda003', '$vda004', '$vda005', '$vda006', '$vda007', '$vda008', '$vda009', '$vda010', '$vda011', '$vda012', '$vda013', '$vda014', '$vda015', '$vda016', '$vda017', '$vda018'); ";
		}


		return  $this->db->query($sql);
	}

	//轉excel檔	 
	function excelnewf()
	{
		$seq1 = $this->input->post('da001c');    //查詢一筆以上
		$seq2 = $this->input->post('da002c');
		$sql = " SELECT da001,da002,da003,da004,da005,da007,create_date FROM barma WHERE da001 >= '$seq1' AND da001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//印明細表	
	function printfd()
	{
		$seq1 = $this->input->post('da001c');
		$seq2 = $this->input->post('da002c');
		$sql = " SELECT a.*,b.me002 as da004disp,c.me002 as da007disp FROM barma as a left join admme as b on a.da004=b.me001 left join cmsme as c on a.da007=c.me001  WHERE da001 >= '$seq1'  AND da001 <= '$seq2'  ";
		$query = $this->db->query($sql);
		$ret['rows'] = $query->result();

		$seq32 = "da001 >= '$seq1'  AND da001 <= '$seq2'  ";
		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('barma')
			->where($seq32);
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		return $ret;
	}

	//更改一筆	 
	function updatef()
	{
		$modifier = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		$vda001 = trim($this->input->post('da001'));
		$vda002 = trim($this->input->post('da002'));
		$vda002 = iconv("utf-8", "BIG5", $vda002);
		$vda003 = str_replace("'", "''", trim($this->input->post('da003'))); // ' 處理'特殊字元錯誤問題
		$vda003 = iconv("utf-8", "BIG5", $vda003);
		$vda004 = trim($this->input->post('da004'));
		$vda005 = trim($this->input->post('da005'));
		$vda006 = trim($this->input->post('da006'));
		$vda007 = trim($this->input->post('da007'));
		$vda008 = trim($this->input->post('da008'));
		$vda009 = trim($this->input->post('da009'));
		$vda010 = trim($this->input->post('da010'));
		$vda011 = trim($this->input->post('da011'));
		$vda012 = trim($this->input->post('da012'));
		$vda012 = iconv("utf-8", "BIG5", $vda012);
		$vda013 = trim($this->input->post('da013'));
		$vda014 = trim($this->input->post('da014'));
		$vda015 = trim($this->input->post('da015'));
		$vda016 = trim($this->input->post('da016'));
		$vda017 = trim($this->input->post('da017'));
		$vda018 = trim($this->input->post('da018'));
		$vflag = $this->input->post('flag') + 1;

		$sqlv = " SELECT * from moldav 
					where da001 = '$vda001' and da013='$vda013' and da014='$vda014' and da018='$vda018'
				 ";

		$query = $this->db->query($sqlv);
		if ($query->num_rows() > 0) {
			$sqlvd = " UPDATE moldav 
							SET	modifier='$modifier', modi_date='$vtoday', flag=$vflag, da002='$vda002', da003='$vda003', da004='$vda004', da005='$vda005'
								, da006='$vda006', da007='$vda007', da008='$vda008', da009='$vda009', da010='$vda010', da011='$vda011', da012='$vda012', da015='$vda015', da016='$vda016'
								, da017='$vda017', da018='$vda018'
						where da001 = '$vda001' and da013='$vda013' and da014='$vda014' and da018='$vda018'
					";
		} else {
			$sqlvd = " INSERT INTO dbo.moldav (modifier, modi_date, flag, da001, da002, da003, da004, da005, da006, da007, da008, da009, da010, da011, da012, da013, da014, da015, da016, da017, da018)
			VALUES ('$modifier', '$vtoday', '0', '$vda001', '$vda002', '$vda003', '$vda004', '$vda005', '$vda006', '$vda007', '$vda008', '$vda009', '$vda010', '$vda011', '$vda012', '$vda013', '$vda014', '$vda015', '$vda016', '$vda017', '$vda018'); ";
		}

		$this->db->query($sqlvd);



		$sql = " UPDATE molda 
						SET	modifier='$modifier', modi_date='$vtoday', flag=$vflag, da002='$vda002', da003='$vda003', da004='$vda004', da005='$vda005'
						, da006='$vda006', da007='$vda007', da008='$vda008', da009='$vda009', da010='$vda010', da011='$vda011', da012='$vda012', da015='$vda015', da016='$vda016'
						, da017='$vda017', da018='$vda018'
					where da001 = '$vda001' and da013='$vda013' and da014='$vda014' ";


		// echo "<pre>";var_dump($sql);exit;
		return $this->db->query($sql);
	}

	//刪除一筆	
	function deletef($seg1, $seg2, $seg3, $seg4)
	{
		// $seg1=$this->uri->segment(4);
		// $seg2=$this->uri->segment(5);
		//刪轉移資料invlz
		$this->db->where('lz002', $seg2);
		$this->db->where('lz003', $seg3);
		$this->db->where('lz004', $seg4);
		$this->db->delete('invlz');

		$this->db->where('da001', $seg1);
		$this->db->delete('barma');
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
		$relust = false;
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;
				list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
				$seq1;
				$seq2;
				$seq3;

				// $this->db->where('da001', $seq1);
				// $this->db->delete('barma');
				$relust = $this->db->query(" DELETE FROM dbo.molda WHERE da001='$seq1' and da013='$seq2' and da014='$seq3'; ");
			}
		}
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }
		return $relust;
	}

	//ajax 下拉視窗查詢類 實際模穴數(check)
	function lookupd_body_check($seq1, $seq2, $seq3)
	{
		// 因為MV001前後有空白
		$sql98 = " select * from molda where da001='$seq1' and da013='$seq2' and da014='$seq3' ";
		$query = $this->db->query($sql98);
		$result = $query->result();
		//在此只有1筆才正確
		if (count($result) == 1) {
			return trim($result[0]->da005);
		} else {
			return '';
		}
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
