<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Seti01_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();      //重載ci底層程式 自動執行父類別
	}

	function get_detail_view($user, $process)
	{
		// $query = $this->db->select('a.ta001,b.mf002 as ta001disp,a.ta002,c.mb002,a.ta003,a.ta004')
		// 	->from('setta as a')
		// 	->join('admmf as b', 'a.ta001 = b.mf001', 'left')
		// 	->join('admmb as c', 'a.ta002 = c.mb001', 'left')
		// 	->where('ta001', $user)
		// 	->where('ta002', $process);
		$sql98 = " select a.*,b.TD004,c.MQ002 as te001disp,d.MV002 as te004disp, e.MX003 as te005disp,f.MW003 as te009disp
					from SFCTE as a 
						left join SFCTD as b on a.TE001 =b.TD001 and a.TE002 =b.TD002
						left join CMSMQ as c on a.TE001 = c.MQ001
						left join CMSMV as d on a.TE004 = d.MV001
						left join CMSMX as e on a.TE005 = e.MX001 and b.TD004=e.MX002
						left join CMSMW as f on a.TE009 = f.MW001 ";

		$query = $this->db->query($sql98);

		$ret['data'] = $query->result();

		if (count($ret['data']) <= 0) {
			$result = "no_data";
			return $result;
		}
		return $ret['data'][0];
	}

	function save_detail_view($process, $order_str)
	{
		$data = array(
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' => date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'ta001' => $this->session->userdata('manager'),
			'ta002' => $process,
			'ta003' => $order_str
		);
		$exist = $this->selone($this->session->userdata('manager'), $process);
		if (!$exist) {
			return $this->db->insert('setta', $data);
		}

		$data = array(
			'modifier' => $this->session->userdata('manager'),
			'modi_date' => date("Ymd"),
			'ta001' => $this->session->userdata('manager'),
			'ta002' => $process,
			'ta003' => $order_str
		);
		$this->db->where('ta001', $this->session->userdata('manager'));
		$this->db->where('ta002', $process);
		$this->db->update('setta', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}


	//查詢修改用 (看資料用)   
	function selone($seq1, $seq2)
	{
		$query = $this->db->select('a.ta001,b.mf002 as ta001disp,a.ta002,c.mb002,a.ta003,a.ta004')
			->from('setta as a')
			->join('admmf as b', 'a.ta001 = b.mf001', 'left')
			->join('admmb as c', 'a.ta002 = c.mb001', 'left')
			->where('ta001', $seq1)
			->where('ta002', $seq2);
		$ret['data'] = $query->get()->result();

		if (count($ret['data']) <= 0) {
			return false;
		}
		return true;
	}

	//刪除一筆 	
	function deletef($seg1)
	{
		$this->db->where('tc001', $this->uri->segment(4));
		$this->db->where('tc002', $this->uri->segment(5));
		$this->db->delete('purtc');
		$this->db->where('td001', $this->uri->segment(4));
		$this->db->where('td002', $this->uri->segment(5));
		$this->db->delete('purtd');
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
