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
			//設置全域編碼
	    	header('Content-Type: text/html; charset=utf-8');
		 $this->load->library("session");
		//可以在 autoload 文件中加載，但為了說明方便先放在這里
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('table', 'pagination', 'form_validation'));
		$this->load->helper('news');
		date_default_timezone_set("Asia/Taipei");  //設置時區
       }
	public function index()
	{
	    $username=$this->input->post('username');
	   	$this->load->model('login_model');
		//$data['query'] = $this->login_model->getdata($username); 
			$query = $this->login_model->login_ok();
        $data['query'] = $query;
		$this->load->view('login_v',$data);
		
	}
	function showmessage($message = '', $to = ''){
                $message = $message == '' ? '"未定義訊息"' : '"' . $message . '"';
                $to = $to == '' ? 'history.back()' : 'location.href="' . $to . '"';
                echo "<script language='javascript'>alert(" . $message . ");". $to .";</script>";
        }

	/* 登入驗證頁面  */
	function check_login()
	{
		 $data['username'] = $this->input->post('username');
		$this->load->model('login_model');
       	$query = $this->login_model->login_ok();
        $data['query'] = $query;
		
		if ($query) 
		{
			$this->session->set_userdata('manager', $this->input->post('username'));
		//	$data['username'] = $this->input->post('username');
		      redirect('main/index');
		//	$this->load->view('main_v',$data);
		 //	showmessage('登入成功', 'main/index');
		}
		else
		{
		  //	showmessage('登入失败，資料輸入錯誤', 'login/index');
		//  $data['username'] = $this->input->post('username');
		  $this->load->view('login_v',$data);
		//	redirect('login/index');
		}
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */