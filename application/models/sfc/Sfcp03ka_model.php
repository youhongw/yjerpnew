<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sfcp03ka_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}


	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 10, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfcp03ka_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['sfcp03ka']['search']);
		}

		//SELECT 代號 ,名稱 ,密碼 ,群組代號,超級使用者('N','Y'),備註(改權限使用),部門
		$sql21 = " select a.*,b.MW002 as da013dis FROM molda as a	
					left join CMSMW as b on a.da013 = b.MW001  ";

		$query = $this->db->query($sql21);
		$ret['data'] = $query->result();
		//儲存sql 語法
		$ret['num_sql'] = $this->db->last_query();
		$_SESSION['sfcp03ka']['search']['sql'] = $this->db->last_query();

		$ret['num'] = count($ret['data']);

		return $ret;
	}

	function construct_sql_k($limit = 10, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfcp03ka_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['sfcp03ka']['search']);
		}

		$sql21 = " SELECT a.*,b.MB002,b.MB003,b.MB004 FROM sfcpka as a	
					left join INVMB as b on a.pk001 = b.MB001  ";

		$query = $this->db->query($sql21);
		$ret['data'] = $query->result();
		//儲存sql 語法
		$ret['num_sql'] = $this->db->last_query();
		$_SESSION['sfcp03ka']['search']['sql'] = $this->db->last_query();

		$ret['num'] = count($ret['data']);

		return $ret;
	}

	function construct_sql_g($limit = 10, $offset = 0, $func = "")
	{
		$this->session->set_userdata('sfcp03ka_search', "display_search/" . $offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if ($this->uri->segment(3, 0) == "clear_sql_term") {
			unset($_SESSION['sfcp03ka']['search']);
		}

		$sql21 = " SELECT a.*,b.MB002,b.MB003,b.MB004 FROM sfcpg as a	
					left join INVMB as b on a.pg001 = b.MB001  ";

		$query = $this->db->query($sql21);
		$ret['data'] = $query->result();
		//儲存sql 語法
		$ret['num_sql'] = $this->db->last_query();
		$_SESSION['sfcp03ka']['search']['sql'] = $this->db->last_query();

		$ret['num'] = count($ret['data']);
		$sql21a = " select MD013 ,MAX(MD011) AS MD011 from CMSMD WHERE MD001='SW003' GROUP BY MD013  ";
		$query = $this->db->query($sql21a);
        $ret['price'] = $query->result();
		$ret['price'] = $ret['price'][0]->MD013;   
		return $ret;
	}
    function addprice() {
	$sql21a = " select MD013 ,MAX(MD011) AS MD011 from CMSMD WHERE MD001='SW003' GROUP BY MD013  ";
		$query = $this->db->query($sql21a);
        $ret['price'] = $query->result();
		$ret['price'] = $ret['price'][0]->MD013; 
		return $ret;
       // echo $ret['price'];		
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
	function selone_k($seq1)
	{
		$sql98 = " select a.*,b.MB002 as pk001dis FROM sfcpka as a	
						left join INVMB as b on a.pk001 = b.MB001  
						where pk001 = '$seq1'  ";

		$query = $this->db->query($sql98);
		$result = $query->result();

		return $result;
	}

	function selone1_k($seq1)
	{
		$sql98 = " select * from dbo.sfcpka where pk001 = '$seq1' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	function selone_g($seq1, $seq2, $seq3, $seq4)
	{
		$sql98 = " select a.*,b.MB002 as pg001dis FROM sfcpg as a	
						left join INVMB as b on a.pg001 = b.MB001  
						where pg001 = '$seq1' and pg002 = '$seq2' and pg003 = '$seq3'  ";

		$query = $this->db->query($sql98);
		$result = $query->result();

		return $result;
	}

	function selone_gs($seq3)
	{
		$sql98 = " select a.*,b.MB002 as pg001dis FROM sfcpg as a	
						left join INVMB as b on a.pg001 = b.MB001  
						where pg003 = '$seq3' ";

		$query = $this->db->query($sql98);
		$result = $query->result();

		return $result;
	}

	function selone1_g($seq1, $seq2, $seq3)
	{
		$sql98 = " select * from dbo.sfcpg where pg001 = '$seq1' and pg002 = '$seq2' and pg003 = '$seq3' ";
		$query = $this->db->query($sql98);

		if ($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	//新增一筆	
	function insertf_k()
	{
		$creator = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		$vpk001 = trim($this->input->post('da001'));
		$vpk002 = trim($this->input->post('pk002'));
		$vpk003 = trim($this->input->post('pk003'));
		$vpk004 = trim($this->input->post('pk004'));
		$vpk005 = trim($this->input->post('pk005'));
		$vpk005 = trim($this->input->post('pk005'));
		$vpk006 = trim($this->input->post('pk006'));
		$vpk009 = trim($this->input->post('pk009'));
		preg_match_all('/\d/S',$this->input->post('pk008'), $matches);  //處理日期字串
			 $pk008 = implode('',$matches[0]);
			 $vpk008=$pk008;
		//$vpk006 = trim($this->input->post('pk006'));
		$vpk007 = iconv("utf-8", "BIG5", $vpk007);
         
		$sql = " INSERT INTO dbo.sfcpka (creator, create_date, flag, pk001, pk002, pk003, pk004, pk005, pk006, pk007, pk008, pk009)
					VALUES ('$creator', '$vtoday', '0', '$vpk001', '$vpk002', '$vpk003', '$vpk004', '$vpk005', '$vpk006'
					, '$vpk007', '$vpk008', '$vpk009'); ";

		return  $this->db->query($sql);
	}

	function insertf_g()
	{
		$creator = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		$vpg001 = trim($this->input->post('da001'));
		$vpg002 = trim($this->input->post('pg002'));
		$vpg003 = trim($this->input->post('pg003'));
		// $vpg004 = trim($this->input->post('pg004'));
		$vpg005 = trim($this->input->post('pg005'));
		$vpg006 = trim($this->input->post('pg006'));
		$vpg007 = trim($this->input->post('pg007'));
		$vpg008 = trim($this->input->post('pg008'));
		$vpg009 = trim($this->input->post('pg009'));
		$vpg010 = trim($this->input->post('pg010'));
		$vpg011 = trim($this->input->post('pg011'));
		$vpg012 = trim($this->input->post('pg012'));

		$vpg013 = trim($this->input->post('pg013'));
		$vpg013 = iconv("utf-8", "BIG5", $vpg013);
		
		$vpg014 = $this->input->post('pg014');
		
		$vpg019 = $vpg005+$vpg006+$vpg007+$vpg008+$vpg009+$vpg010+$vpg011+$vpg012+$vpg014;
		//$vpg013 = iconv("utf-8", "BIG5", $vpg013);
		
		$vpg0051 = $this->input->post('pg0051');
		$vpg0061 = $this->input->post('pg0061');
		$vpg0071 = $this->input->post('pg0071');
		$vpg0081 = $this->input->post('pg0081');
		$vpg0091 = $this->input->post('pg0091');
		$vpg0101 = $this->input->post('pg0101');
		$vpg0111 = $this->input->post('pg0111');
		$vpg0121 = $this->input->post('pg0121');
		$vpg0141 = $this->input->post('pg0141');
		if ($vpg0051=='') {$vpg0051=0;}
		if ($vpg0061=='') {$vpg0061=0;}
		if ($vpg0071=='') {$vpg0071=0;}
		if ($vpg0081=='') {$vpg0081=0;}
		if ($vpg0091=='') {$vpg0091=0;}
		if ($vpg0101=='') {$vpg0101=0;}
		if ($vpg0111=='') {$vpg0111=0;}
		if ($vpg0121=='') {$vpg0121=0;}
		if ($vpg0141=='') {$vpg0141=0;}
		preg_match_all('/\d/S', $this->input->post('pg0131'), $matches);  //處理日期字串
		$pg0131 = implode('', $matches[0]);	
		$vpg0131 = $pg0131;

		$sql = " INSERT INTO dbo.sfcpg (creator, create_date, flag, pg001, pg002, pg003, pg005, pg006, pg007, pg008, pg009, pg010, pg011, pg012, pg013
		            , pg014, pg019, pg0051 , pg0061 , pg0071 , pg0081, pg0091, pg0101 , pg0111,pg0121, pg0131, pg0141 
		)
					VALUES ('$creator', '$vtoday', '0', '$vpg001', '$vpg002', '$vpg003', '$vpg005'
					, '$vpg006', '$vpg007', '$vpg008', '$vpg009', '$vpg010', '$vpg011', '$vpg012', '$vpg013'
					, '$vpg014', '$vpg019'
						, '$vpg0051','$vpg0061', '$vpg0071'
						, '$vpg0081', '$vpg0091', '$vpg0101', '$vpg0111','$vpg0121'
						, '$vpg0131', '$vpg0141'
					); ";

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
		$vflag = $this->input->post('flag') + 1;

		$sql = " UPDATE molda 
						SET	modifier='$modifier', modi_date='$vtoday', flag=$vflag, da002='$vda002', da003='$vda003', da004='$vda004', da005='$vda005'
						, da006='$vda006', da007='$vda007', da008='$vda008', da009='$vda009', da010='$vda010', da011='$vda011', da012='$vda012', da015='$vda015', da016='$vda016'
					where da001 = '$vda001' and da013='$vda013' and da014='$vda014' ";


		// echo "<pre>";var_dump($sql);exit;
		return $this->db->query($sql);
	}

	function updatef_k()
	{
		$modifier = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		$vpk001 = trim($this->input->post('da001'));
		$vpk002 = trim($this->input->post('pk002'));
		$vpk003 = trim($this->input->post('pk003'));
		$vpk004 = trim($this->input->post('pk004'));
		$vpk005 = trim($this->input->post('pk005'));
		$vpk005 = trim($this->input->post('pk005'));
		$vpk006 = trim($this->input->post('pk006'));
		$vpk009 = trim($this->input->post('pk009'));
		preg_match_all('/\d/S',$this->input->post('pk008'), $matches);  //處理日期字串
			 $pk008 = implode('',$matches[0]);
			 $vpk008=$pk008;
		//$vpk006 = trim($this->input->post('pk006'));
		$vpk007 = iconv("utf-8", "BIG5", $vpk007);

		$vflag = $this->input->post('flag') + 1;

		$sql = " UPDATE sfcpka 
						SET	modifier='$modifier', modi_date='$vtoday', flag=$vflag, pk002='$vpk002', pk003='$vpk003', pk004='$vpk004', pk005='$vpk005'
					, pk006='$vpk006', pk007='$vpk007', pk008='$vpk008', pk009='$vpk009' where pk001 = '$vpk001'  ";


		// echo "<pre>";var_dump($sql);exit;
		return $this->db->query($sql);
	}
	//取單號 最大值加1
	function check_title_no($selval){
		
			$sql = " SELECT MD012,MD013 FROM CMSMD 
						WHERE MD012='$selval'  ";
         $query =   $this->db->query($sql);
		//$query = $this->db->get();
		$result = $query->result();
		
	  //  if (!$result[0]->max_no){return "16.4";}
		
		return $result[0]->MD013;
	}
     // 衝壓鉚合工價1130728
	function updatef_g()
	{
		$modifier = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		$vpg001 = trim($this->input->post('pg001'));
		$vpg002 = trim($this->input->post('pg002'));
		$vpg003 = trim($this->input->post('pg003'));
		// $vpg004 = trim($this->input->post('pg004'));
		$vpg005 = $this->input->post('pg005');
		$vpg006 = $this->input->post('pg006');
		$vpg007 = $this->input->post('pg007');
		$vpg008 = $this->input->post('pg008');
		$vpg009 = $this->input->post('pg009');
		$vpg010 = $this->input->post('pg010');
		$vpg011 = $this->input->post('pg011');
		$vpg012 = $this->input->post('pg012');
		$vpg014 = $this->input->post('pg014');
		$vpg013 = trim($this->input->post('pg013'));
		
		$vpg019 = $vpg005+$vpg006+$vpg007+$vpg008+$vpg009+$vpg010+$vpg011+$vpg012+$vpg014;
		$vpg013 = iconv("utf-8", "BIG5", $vpg013);
		
		$vpg0051 = $this->input->post('pg0051');
		$vpg0061 = $this->input->post('pg0061');
		$vpg0071 = $this->input->post('pg0071');
		$vpg0081 = $this->input->post('pg0081');
		$vpg0091 = $this->input->post('pg0091');
		$vpg0101 = $this->input->post('pg0101');
		$vpg0111 = $this->input->post('pg0111');
		$vpg0121 = $this->input->post('pg0121');
		$vpg0141 = $this->input->post('pg0141');
		if ($vpg0051=='') {$vpg0051=0;}
		if ($vpg0061=='') {$vpg0061=0;}
		if ($vpg0071=='') {$vpg0071=0;}
		if ($vpg0081=='') {$vpg0081=0;}
		if ($vpg0091=='') {$vpg0091=0;}
		if ($vpg0101=='') {$vpg0101=0;}
		if ($vpg0111=='') {$vpg0111=0;}
		if ($vpg0121=='') {$vpg0121=0;}
		if ($vpg0141=='') {$vpg0141=0;}
		preg_match_all('/\d/S', $this->input->post('pg0131'), $matches);  //處理日期字串
		$pg0131 = implode('', $matches[0]);	
		$vpg0131 = $pg0131;
		

		$vflag = $this->input->post('flag') + 1;

		$sql = " UPDATE sfcpg 
						SET	modifier='$modifier', modi_date='$vtoday', flag=$vflag, pg005='$vpg005', pg006='$vpg006', pg007='$vpg007'
						, pg008='$vpg008', pg009='$vpg009', pg010='$vpg010', pg011='$vpg011',pg012='$vpg012'
						, pg013='$vpg013'
						, pg014='$vpg014', pg019='$vpg019'
						, pg0051='$vpg0051', pg0061='$vpg0061', pg0071='$vpg0071'
						, pg0081='$vpg0081', pg0091='$vpg0091', pg0101='$vpg0101', pg0111='$vpg0111',pg0121='$vpg0121'
						, pg0131='$vpg0131', pg0141='$vpg0141'
					where pg001 = '$vpg001' and pg002 = '$vpg002' and pg003 = '$vpg003'   ";


		// echo "<pre>";var_dump($sql);exit;
		return $this->db->query($sql);
	}

	function updatef_gs()
	{
		$modifier = $this->session->userdata('sysuser');
		$vtoday = date('Ymd');
		// $vpg001 = trim($this->input->post('pg001'));
		// $vpg002 = trim($this->input->post('pg002'));
		$vpg003 = trim($this->input->post('pg003'));
		// $vpg004 = trim($this->input->post('pg004'));
		$vpg005 = trim($this->input->post('pg005'));
		$vpg006 = trim($this->input->post('pg006'));
		$vpg007 = trim($this->input->post('pg007'));
		$vpg008 = trim($this->input->post('pg008'));
		$vpg009 = trim($this->input->post('pg009'));
		$vpg010 = trim($this->input->post('pg010'));
		$vpg011 = trim($this->input->post('pg011'));
		$vpg012 = trim($this->input->post('pg012'));
		// $vpg013 = trim($this->input->post('pg013'));
		// $vpg013 = iconv("utf-8", "BIG5", $vpg013);

		// $vflag = $this->input->post('flag') + 1;
		$sql = "";
		$sqltable = " UPDATE sfcpg 
							 ";
		$sqlset = " SET	modifier='$modifier', modi_date='$vtoday', flag=flag+1 ";
		$sqlwhere = " where pg003 = '$vpg003' ";

		if ($vpg005 != '') {
			$sqlset = $sqlset . " , " . " pg005='$vpg005' ";
		}

		if ($vpg006 != '') {
			$sqlset = $sqlset . " , " . " pg006='$vpg006' ";
		}

		if ($vpg007 != '') {
			$sqlset = $sqlset . " , " . " pg007='$vpg007' ";
		}

		if ($vpg008 != '') {
			$sqlset = $sqlset . " , " . " pg008='$vpg008' ";
		}

		if ($vpg009 != '') {
			$sqlset = $sqlset . " , " . " pg009='$vpg009' ";
		}

		if ($vpg010 != '') {
			$sqlset = $sqlset . " , " . " pg010='$vpg010' ";
		}

		if ($vpg011 != '') {
			$sqlset = $sqlset . " , " . " pg011='$vpg011' ";
		}

		if ($vpg012 != '') {
			$sqlset = $sqlset . " , " . " pg012='$vpg012' ";
		}


		// $sql = " UPDATE sfcpg 
		// 				SET	modifier='$modifier', modi_date='$vtoday', flag=flag+1, pg005='$vpg005', pg006='$vpg006', pg007='$vpg007'
		// 				, pg008='$vpg008', pg009='$vpg009', pg010='$vpg010', pg011='$vpg011',pg012='$vpg012'
		// 				, pg013='$vpg013'
		// 			where pg001 = '$vpg001' and pg002 = '$vpg002' and pg003 = '$vpg003' and pg004 = '$vpg004'  ";

		$sql = $sqltable . $sqlset . $sqlwhere;


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
	function delmutif_k()
	{
		$seq[] = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		$x = 0;
		$seq1 = ' ';
		$seq2 = ' ';
		$relust = false;
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;
				list($seq1) = explode("/", $seq[$x]);
				$seq1;

				$relust = $this->db->query(" DELETE FROM dbo.sfcpka WHERE pk001='$seq1' ; ");
			}
		}
		// if ($this->db->affected_rows() > 0) {
		// 	return TRUE;
		// }
		return $relust;
	}

	function delmutif_g()
	{
		$seq[] = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		$x = 0;
		$seq1 = ' ';
		$seq2 = ' ';
		$seq3 = ' ';
		$seq4 = ' ';
		$relust = false;
		if (!empty($_POST['selected'])) {
			foreach ($_POST['selected'] as $check) {
				$seq[$x] = $check;
				list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
				$seq1 = trim($seq1);
				$seq2 = trim($seq2);
				$seq3 = trim($seq3);
				// $seq4 = trim($seq4);

				$relust = $this->db->query(" DELETE FROM dbo.sfcpg WHERE pg001='$seq1' and pg002='$seq2' and pg003='$seq3'  ; ");
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
