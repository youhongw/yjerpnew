<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Login extends CI_Controller
{

	/*

	 * Index Page for this controller.

	 * Maps to the following URL

	 * http://example.com/index.php/login

	 */



	//設置全域程式代碼

	function __construct()

	{

		parent::__construct();

		header('Content-Type: text/html; charset=utf-8');

		$this->load->library("session");      //也可以在 autoload 文件中加載，但閱讀方便放在這里 

		$this->load->helper(array('form', 'url', 'My_captcha'));

		$this->load->library(array('table', 'pagination', 'form_validation'));

		$this->load->helper('news');             //showmessage 直接一個網頁提示

		date_default_timezone_set("Asia/Taipei");  //設置時區

		// $this->output->cache(480);  //緩衝 

	}



	public function index()
	{
		$original_string = array_merge(range(0, 9));
		$original_string = implode("", $original_string);
		$captcha = substr(str_shuffle($original_string), 0, 4);

		$vals = array(
			'word' => $captcha,
			'img_path' => './captcha/',
			'img_url' => base_url() . 'captcha/',
			'font_path' => './captcha/verdana.ttf',
			'img_width' => '120',
			'img_height' => 50,
			'expiration' => 3600
		);


		$this->session->set_userdata('captchaWord', $captcha);

		$this->load->model('login_model');

		$this->login_model->companyf();  //1060908

		$this->session->set_userdata('timestamp', time());
		if ($this->uri->segment(1) == 'login') {
			if (isset($_SESSION['sysuser'])) {
				$this->login_model->logout($_SESSION['sysuser']);
			}
			$this->session->set_userdata('captchaWord', $captcha);
			$this->session->set_userdata('timestamp', time());
		}

		//$data['comp']=this->session->userdata('syscompany');



		$data['err'] = '';

		$data['err1'] = 0;

		$data['query'] = 0;

		$data['systitle'] = '邑得廠條碼PDA版';

		// $data['menu_v'] = 'main_menulogin_v';

		//  $data['menu_v'] = 'blank';

		//  $data['content_v'] = 'login_v';		

		//  $data['foot_v'] ='main_foot_v';

		// $data['foot_v'] ='blank';

		$this->load->vars($data);

		//  $this->load->view('home');
		$this->load->view('login_v');
	}



	function showmessage($message = '', $to = '')

	{

		$message = $message == '' ? '"未定義訊息"' : '"' . $message . '"';

		$to = $to == '' ? 'history.back()' : 'location.href="' . $to . '"';

		echo "<script language='javascript'>alert(" . $message . ");" . $to . ";</script>";
	}



	/* 登入驗證頁面  */

	function check_login()
	{

		$data['username'] = $this->input->post('username');

		$this->load->model('login_model');

		$query = $this->login_model->login_ok();

		$data['query'] = $query;

		//1080926
		if (strcmp(strtoupper($this->input->post('captcha')), strtoupper($this->session->userdata('captchaWord'))) == 0) {
			$data['err'] = '';
			$err1 = 0;
		} else {
			$err1 = 0;
			$data['err'] = '驗證碼輸入錯誤, ';
		}

		if (isset($_SESSION['yjerp_onlinenum'])) {
			if ($_SESSION['yjerp_onlinenum'] > 100) {
				$err1 = 0;
				$data['err'] = '登入人數超過限制！！！, ';
			}
		}

		//1061005

		$userAgent = $_SERVER['HTTP_USER_AGENT'];

		if (preg_match("/(iPod|iPad|iPhone)/", $userAgent)) {
		} elseif (preg_match("/android/i", $userAgent)) {
		} else {

			if (strcmp($this->input->post('captcha'), $this->session->userdata('captchaWord')) == 0) {
				$data['err'] = '';
				$err1 = 0;
			} else {
				$err1 = 1;
				$data['err'] = '驗證碼輸入錯誤, ';
			}
		}


		//$err1=0;  //驗證碼不檢查
		//$query=1;
		if ($query  &&  $err1 == 0) {

			$this->session->set_userdata('manager', trim($this->input->post('username')));



			if (session_status() == PHP_SESSION_NONE) {

				session_start();
			}

			$_SESSION['manager'] = trim($this->input->post('username'));

			//  $this->login_model->companyf();   1060809

			redirect('main/index');
		} else {

			$data['systitle'] = '邑得廠條碼PDA版';

			//  $data['menu_v'] = 'blank';

			//  $data['content_v'] = 'login_v';		

			//  $data['foot_v'] ='blank';

			$this->load->vars($data);

			$this->load->view('login_v');
		}
	}
}



/* End of file login.php */

/* Location: ./application/controllers/login.php */
