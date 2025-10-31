<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
            parent::__construct();
       }
	public function index()
	{
	    
		$this->load->model('login_model');
		$data['query'] = $this->login_model->getdata(); 
		
		$this->load->view('login_v',$data);
		
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */