<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別system
	}

	/* 登入驗證  超級使用者mf005 var_dump($row->mf005);exit;*/
	function login_ok()
	{
		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));
		//$captcha = $this->input->post('captcha');
		//取使用者ip
		$ip = $_SERVER['REMOTE_ADDR'];

		//登出未正常登出之使用者 改3天內未正常未登出
		$sql = "UPDATE hack_log SET hl_logout_datetime = " . date('YmdHis') . " 
		where hl_logout_datetime is null and hl_name = '" . $username . "' and hl_date_time < " . date("YmdHis") . " and hl_alive_datetime > " . date('Ymd', strtotime(' -3 day')) . "000000";
		$query = $this->db->query($sql);

		if ($username != '') { //排除空白user
			//記錄登入者資訊------------------------------------------------
			//INSERT INTO        hack_log (hl_name,hl_mail,hl_date_time     ,hl_ip) 
			//                     values ('demo' ,'xxxxx','20220107094017','1.165.12.66') 
			$sql2 = "INSERT INTO  hack_log (hl_name,hl_mail,hl_date_time,hl_ip,hl_alive_datetime) values 
					('" . $username . "','" . $password . "','" . date('YmdHis') . "','" . $ip . "','" . date('YmdHis') . "') ";
			$this->db->query($sql2);
			//--------------------------------------------------------------

			//查詢登入人數-------------------------------------
			// $sql = "select * from hack_log where hl_logout_datetime is null and hl_alive_datetime > " . date("Ymd") . "000000";
			//改30分鐘都沒有更新在線時間（hl_alive_datetime）就不算人數  改4小時
			$sql = "select * from hack_log where hl_logout_datetime is null and hl_alive_datetime > " . date("YmdHis", strtotime("-240 minutes"));
			$query = $this->db->query($sql);

			$this->session->set_userdata('yjerp_onlinenum', $query->num_rows());
			// -------------------------------------------

			// $username = $this->input->post('username');
			// $password = $this->input->post('password');
			//echo var_dump($username,$password);exit;
			//SELECT 代號 ,名稱 ,密碼 ,群組代號,超級使用者('N','Y'),備註(改權限使用),部門 FROM admmf ===> mf006 新增權限管理 by Sam
			$query = $this->db->query("SELECT mf001,mf002,mf003,mf004,mf005,mf006,mf007 FROM dbo.admmf WHERE mf001='$username' and mf003='$password' ");
			//echo var_dump($query->result());exit;
			$num_rows = 0;
			foreach ($query->result() as $row) {
				// $num_rows++;
				$this->session->set_userdata('sysuser', trim($row->mf001));
				$this->session->set_userdata('sysusername', trim($row->mf002));
				$this->session->set_userdata('sysgroup', trim($row->mf004));
				$this->session->set_userdata('syssuper', trim($row->mf005));
				$this->session->set_userdata('sysuserrms', trim($row->mf006)); //mf006 新增權限管理 by Sam
				$this->session->set_userdata('sysdept', trim($row->mf007));
				$num_rows = 1;
				// echo var_dump($num_rows);exit;
			}
			return $num_rows;
		} else {
			return 0;
		}
	}

	function logout($seq1)
	{
		$sql = "UPDATE hack_log SET hl_logout_datetime = " . date('YmdHis') . " 
        where hl_logout_datetime is null and hl_name = '" . $seq1 . "' and hl_date_time < " . date("YmdHis") . " and hl_alive_datetime > " . date("Ymd") . "000000";
		$query = $this->db->query($sql);
	}

	//公司資料名稱 系統變數 
	function companyf()
	{
		//公司參數
		$query = $this->db->query("SELECT * FROM dbo.cmsml  ");
		foreach ($query->result() as $row) {
			$companysys[] = $row->company;
			$creatorsys[] = $row->creator;
			$usr_groupsys[] = $row->usr_group;
			$create_datesys[] = $row->create_date;
			$modifiersys[] = $row->modifier;
			$modi_datesys[] = $row->modi_date;
			$flagsys[] = $row->flag;
			$ml002sys[] = $row->ml002;  //公司簡稱
			$ml003sys[] = $row->ml003;   //公司全稱
			$ml005sys[] = $row->ml005;   //電話
			$ml006sys[] = $row->ml006;   //傳真
			$ml012sys[] = $row->ml012;   //地址
			$ml010sys[] = $row->ml010;    //E-MAIL
			$ml011sys[] = $row->ml011;    //備註  1061005
		}
		if ($query->num_rows() > 0) {
			$this->session->set_userdata('syscompany', trim($companysys[0]));
			$this->session->set_userdata('syscreator', trim($creatorsys[0]));
			$this->session->set_userdata('sysusr_group', trim($usr_groupsys[0]));
			$this->session->set_userdata('syscreate_date', trim($create_datesys[0]));
			$this->session->set_userdata('sysmodifier', trim($modifiersys[0]));
			$this->session->set_userdata('sysmodi_date', trim($modi_datesys[0]));
			$this->session->set_userdata('sysflag', trim($flagsys[0]));
			$this->session->set_userdata('sysml002', trim($ml002sys[0]));
			$this->session->set_userdata('sysml003', trim($ml003sys[0]));
			$this->session->set_userdata('sysml005', trim($ml005sys[0]));
			$this->session->set_userdata('sysml006', trim($ml006sys[0]));
			$this->session->set_userdata('sysml012', trim($ml012sys[0]));
			$this->session->set_userdata('sysml010', trim($ml010sys[0]));
			$this->session->set_userdata('sysml011', trim($ml011sys[0]));
		}

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_SESSION['syscompany'] = trim($companysys[0]);
		$_SESSION['syscreator'] = trim($creatorsys[0]);
		$_SESSION['sysusr_group'] = trim($usr_groupsys[0]);
		$_SESSION['syscreate_date'] = trim($create_datesys[0]);
		$_SESSION['sysmodifier'] = trim($modifiersys[0]);
		$_SESSION['sysmodi_date'] = trim($modi_datesys[0]);
		$_SESSION['sysflag'] = trim($flagsys[0]);
		$_SESSION['sysml002'] = trim($ml002sys[0]);
		$_SESSION['sysml003'] = trim($ml003sys[0]);
		$_SESSION['sysml005'] = trim($ml005sys[0]);
		$_SESSION['sysml006'] = trim($ml006sys[0]);
		$_SESSION['sysml012'] = trim($ml012sys[0]);
		$_SESSION['sysml010'] = trim($ml010sys[0]);
		$_SESSION['sysml011'] = trim($ml011sys[0]);

		//基本參數 本幣, 稅率, 庫別碼數, 品號碼數, 半張紙, 主要庫別, 盤點日,預設簽核1,2
		$query = $this->db->query("SELECT * FROM dbo.cmsma  ");
		foreach ($query->result() as $row) {
			$ma003sys[] = trim($row->ma003);
			$ma004sys[] = trim($row->ma004);
			$ma200sys[] = trim($row->ma200);
			$ma201sys[] = trim($row->ma201);
			$ma202sys[] = trim($row->ma202);
			$ma203sys[] = trim($row->ma203);
			$ma206sys[] = trim($row->ma206);
			$ma207sys[] = trim($row->ma207);
		}
		if ($query->num_rows() > 0) {
			$this->session->set_userdata('sysma003', trim($ma003sys[0]));
			$this->session->set_userdata('sysma004', trim($ma004sys[0]));
			$this->session->set_userdata('sysma200', trim($ma200sys[0]));
			$this->session->set_userdata('sysma201', trim($ma201sys[0]));
			$this->session->set_userdata('sysma202', trim($ma202sys[0]));
			$this->session->set_userdata('sysma203', trim($ma203sys[0]));
			$this->session->set_userdata('singing1', trim($ma206sys[0]));
			$this->session->set_userdata('singing2', trim($ma207sys[0]));
		}
	}
	//使用者權限系統變數
	function admmgf()
	{
		$query = $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008')
			->from('dbo.admmg')
			->where('mg001', $this->session->userdata('manager'));

		foreach ($query->result() as $row) {
			$mg001sys[] = $row->mg001;
			$mg004sys[] = $row->mg004;
			$mg006sys[] = $row->mg006;
		}
		if ($query->num_rows() > 0) {
			$this->session->set_userdata('sysmg001', trim($mg001sys[0]));
			$this->session->set_userdata('sysmg004', trim($mg004sys[0]));
			$this->session->set_userdata('sysmg006', trim($mg006sys[0]));
		}
	}
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
