<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -  
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct()
       {
            parent::__construct();      //重載ci底層程式 自動執行父類別S
       }
	
	 function getdata($username)
      {
            
			//$query = $this->db->get('admmf');
			$this->db->set('mf001', $username);
			$query = $this->db->get_where('admmf', array('mf001' => $username));
			return $query;
      }
	  /* 登入驗證  */
	function login_ok()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->query("SELECT * FROM admmf WHERE mf001='$username' and mf003='$password' ");

		return $query->num_rows();
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */