<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	function __construct()
       {
        parent::__construct();      //重載ci底層程式 自動執行父類別system
       }
	   
	/* 登入驗證  */  
	function login_ok()         
	   {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query = $this->db->query("SELECT mf001,mf002,mf003,mf004,mf005 FROM admmf WHERE mf001='$username' and mf003='$password' ");
		return $query->num_rows();
	   }
	   
	//公司資料名稱 系統變數 
	function companyf()     
       {
	   //公司參數
		$query = $this->db->query("SELECT * FROM cmsml  ");         
		foreach ($query->result() as $row)
            {
            $companysys[]=$row->company;
		    $creatorsys[]=$row->creator;
			$usr_groupsys[]=$row->usr_group;
			$create_datesys[]=$row->create_date;
			$modifiersys[]=$row->modifier;
			$modi_datesys[]=$row->modi_date;
			$flagsys[]=$row->flag;
			$ml002sys[]=$row->ml002;
			$ml003sys[]=$row->ml003;
			$ml005sys[]=$row->ml005;
			$ml006sys[]=$row->ml006;
			$ml006sys[]=$row->ml006;
			$ml012sys[]=$row->ml012;
			$ml010sys[]=$row->ml010;
			$ml011sys[]=$row->ml011;
            }
		
			$this->session->set_userdata('syscompany',$companysys[0]);
			$this->session->set_userdata('syscreator',$creatorsys[0]);
			$this->session->set_userdata('sysusr_group',$usr_groupsys[0]);
			$this->session->set_userdata('syscreate_date',$create_datesys[0]);
			$this->session->set_userdata('sysmodifier',$modifiersys[0]);
			$this->session->set_userdata('sysmodi_date',$modi_datesys[0]);
			$this->session->set_userdata('sysflag',$flagsys[0]);
			$this->session->set_userdata('sysml002',$ml002sys[0]);
			$this->session->set_userdata('sysml003',$ml003sys[0]);
			$this->session->set_userdata('sysml005',$ml005sys[0]);
			$this->session->set_userdata('sysml006',$ml006sys[0]);
			$this->session->set_userdata('sysml012',$ml012sys[0]);
			$this->session->set_userdata('sysml010',$ml010sys[0]);
			$this->session->set_userdata('sysml011',$ml011sys[0]);
       
	    //基本參數 本幣, 稅率
		$query = $this->db->query("SELECT * FROM cmsma  ");         
		foreach ($query->result() as $row)
            {
			$ma003sys[]=$row->ma003;
			$ma004sys[]=$row->ma004;
			$ma200sys[]=$row->ma200;
			$ma201sys[]=$row->ma201;
			$ma202sys[]=$row->ma202;
            }
			$this->session->set_userdata('sysma003',$ma003sys[0]);
			$this->session->set_userdata('sysma004',$ma004sys[0]);
			$this->session->set_userdata('sysma200',$ma200sys[0]);
			$this->session->set_userdata('sysma201',$ma201sys[0]);
			$this->session->set_userdata('sysma202',$ma202sys[0]);
      }
	//使用者權限系統變數
	function admmgf()     
       {
	    $query = $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008')  
		                  ->from('admmg')
		        		  ->where('mg001', $this->session->userdata('manager'));
						  
		foreach ($query->result() as $row)
            {
		    $mg001sys[]=$row->mg001;
			$mg004sys[]=$row->mg004;
			$mg006sys[]=$row->mg006;
			}
			
			$this->session->set_userdata('sysmg001',$mg001sys[0]); 
			$this->session->set_userdata('sysmg004',$mg004sys[0]); 
			$this->session->set_userdata('sysmg006',$mg006sys[0]); 
	    }
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
?>