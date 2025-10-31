<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	function updatetime($seq1)
	{
		//空白user登出
		$sql = "UPDATE hack_log SET hl_logout_datetime = " . date('YmdHis') . " 
        where hl_logout_datetime is null and hl_name='' ";
		$query = $this->db->query($sql);
		//4小時內還未登出全登出
		$sql = "UPDATE hack_log SET hl_logout_datetime = " . date('YmdHis') . " 
        where hl_logout_datetime is null and hl_alive_datetime < " . date("YmdHis", strtotime("-240 minutes"));
		$query = $this->db->query($sql);
		//4小時內還未登出者 更新 alive_time
		$sql = "UPDATE hack_log SET hl_alive_datetime = " . date('YmdHis') . " 
        where hl_logout_datetime is null and hl_name = '" . $seq1 . "' and hl_alive_datetime > " . date("YmdHis", strtotime("-240 minutes"));
		$query = $this->db->query($sql);
		//4小時內還未登出者 自己有幾筆在線上
		$sql = "select * from hack_log where hl_logout_datetime is null and hl_name = '" . $seq1 . "' and hl_alive_datetime > " . date("YmdHis", strtotime("-240 minutes"));
		$query = $this->db->query($sql);
		$data['yjerp_impact'] = $query->num_rows();
		// $sql = "select * from hack_log where hl_logout_datetime is null and hl_alive_datetime > " . date("Ymd") . "000000";
		//改30分鐘都沒有更新在線時間（hl_alive_datetime）就不算人數 改4小時
		$sql = "select * from hack_log where hl_logout_datetime is null and hl_alive_datetime > " . date("YmdHis", strtotime("-240 minutes"));
		$query = $this->db->query($sql);
		$data['yjerp_onlinenum'] = $query->num_rows();
		$this->session->set_userdata('yjerp_onlinenum', $data['yjerp_onlinenum']);
		$this->session->set_userdata('yjerp_impact', $data['yjerp_impact']);
		return $data;
	}

	//ajax 查詢一筆 顯示 部門代號
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

	//ajax 查詢一筆 顯示 使用者權限	 有使用 main_funtree 1050223$this->session->set_userdata('sysmg006',$row->mg006);
	function ajaxadmi10a($seg1)
	{
		$this->db->where('mg001', $this->session->userdata('manager'));
		$this->db->where('mg002', $this->uri->segment(3));
		$query = $this->db->get('admmg');
		//echo var_dump($query);exit;

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mg004;
				$this->session->set_userdata('sysmg006', trim($row->mg006));
			}
			return $result;
		}
	}

	//ajax 查詢一筆 顯示 	保留89044 MODI 1050223 ajaxadmq04a
	function ajaxadmq04a($seg1)
	{
		$this->db->where('mg001', $this->session->userdata('manager'));
		$this->db->where('mg002', $this->uri->segment(3));
		$query = $this->db->get('admmg');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mg004;
				$this->session->set_userdata('sysmg006', trim($row->mg006));
			}
			if ($this->session->userdata('syssuper') == 'Y') {
				$result = 'Y';
				$this->session->set_userdata('sysmg006', "YYYYYYYYYYYY");
			}
			return $result;
		}
		//  if  ($this->session->userdata('syssuper')=='Y') {$result='Y';$this->session->set_userdata('sysmg006',"YYYYYYYYYYYY");}
	}

	//ajax 查詢一筆 顯示 群組代號 (程式代號及使用者)89044 INVI01
	function ajaxamdq05a($seg1, $seg2)
	{
		$this->db->where('mg001', $seg1);
		$this->db->where('mg002', $seg2);
		$query = $this->db->get('admmg');

		if ($query->num_rows() > 0) {
			$res = $query->result();
			foreach ($query->result() as $row) {
				$result = $row->mg004;
				$mg001sys[] = $row->mg001;
				$mg004sys[] = $row->mg004;
				$mg006sys[] = $row->mg006;
			}
			$this->session->set_userdata('sysmg001', trim($mg001sys[0]));
			$this->session->set_userdata('sysmg004', trim($mg004sys[0]));
			$this->session->set_userdata('sysmg006', trim($mg006sys[0]));
			return $result;
		}
	}

	//使用者權限系統變數
	function admmgf($seg1)
	{
		$query = $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008')
			->from('dbo.admmg')
			->where('mg001', '89044')
			->where('mg002', 'INVI01');
		foreach ($query->result() as $row) {
			$mg001sys[] = $row->mg001;
			$mg004sys[] = $row->mg004;
			$mg006sys[] = $row->mg006;
		}
		$this->session->set_userdata('sysmg001', trim($mg001sys[0]));
		$this->session->set_userdata('sysmg004', trim($mg004sys[0]));
		$this->session->set_userdata('sysmg006', trim($mg006sys[0]));
		return $mg004sys[0];
	}
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
