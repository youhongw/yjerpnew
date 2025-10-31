<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Match_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別system
          }
	
	function getdata($username)
          {
	  //$this->db->set('mf001', $username);
	  // $query = $this->db->get_where('admmf', array('mf001' => $username));
	  // return $query;
          }
	  
	function get_match_by_tournament($tnmnt_id)         /* 登入驗證  */
	  {
	   
	    $query = $this->db->query("SELECT * FROM test WHERE name != $tnmnt_id ");
	    return $query->num_rows();
	   }
	   
	function companyf1()     //公司資料名稱 系統變數
          {
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
		  $ml001sys[]=$row->ml001;
		  $ml002sys[]=$row->ml002;
		  $ml003sys[]=$row->ml003;
		  $ml004sys[]=$row->ml004;
		  $ml005sys[]=$row->ml005;
		  $ml006sys[]=$row->ml006;
               }
		  $this->session->set_userdata('syscompany',$companysys[0]);
		  $this->session->set_userdata('syscreator',$creatorsys[0]);
		  $this->session->set_userdata('sysusr_group',$usr_groupsys[0]);
		  $this->session->set_userdata('syscreate_date',$create_datesys[0]);
		  $this->session->set_userdata('sysmodifier',$modifiersys[0]);
		  $this->session->set_userdata('sysmodi_date',$modi_datesys[0]);
		  $this->session->set_userdata('sysflag',$flagsys[0]);
		  $this->session->set_userdata('sysml001',$ml001sys[0]);
		  $this->session->set_userdata('sysml002',$ml002sys[0]);
		  $this->session->set_userdata('sysml003',$ml003sys[0]);
		  $this->session->set_userdata('sysml004',$ml004sys[0]);
		  $this->session->set_userdata('sysml005',$ml005sys[0]);
		  $this->session->set_userdata('sysml006',$ml006sys[0]);
          }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */