<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Login extends CI_Controller {
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
		 // unset($_SESSION['變數名稱']);
		//  session_destroy();
		//刪除公司名稱session
		// clean the output buffer
       //  ob_clean();
	//	$this->session->unset_userdata('sysml002');
		//session_start();
	//	session_destroy();
		 // 釋放結果集 	database.php 1030306	 $db['default']['save_queries'] = FALSE; 
		 //$original_string = array_merge(range(0,9), range('a','z'), range('A', 'Z'));
		$original_string = array_merge(range(0,9));
        $original_string = implode("", $original_string);
        $captcha = substr(str_shuffle($original_string), 0, 4);

        $vals = array(
        'word' => $captcha,
        'img_path' => './captcha/',
        'img_url' => base_url().'captcha/',
        'font_path' => './captcha/verdana.ttf',
        'img_width' => '120',
        'img_height' => 50,
        'expiration' => 3600
         );

      //  $cap = create_captcha($vals);
      //  $data['image']= $cap['image'];
        $this->session->set_userdata('captchaWord', $captcha);
		
		$this->load->model('login_model');
		$this->login_model->companyf();  //1060908
		//$data['comp']=this->session->userdata('syscompany');
		
        $data['err'] ='';	
        $data['err1'] =0;			 
	    $data['query'] = 0;
	    $data['systitle'] ='雲端ERP企業資源管理系統';
	    $data['menu_v'] = 'main_menulogin_v';
	    $data['content_v'] = 'login_v';		
	    $data['foot_v'] ='main_foot_v';
	    $this->load->vars($data);
	    $this->load->view('main_headlogin_v');
	   }
	  
	function showmessage($message = '', $to = '')
	    {
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
		if (strcmp(strtoupper($this->input->post('captcha')),strtoupper($this->session->userdata('captchaWord'))) == 0)
           {$data['err'] =''; $err1=0; } 
	   
	   else {$err1=0;$data['err'] ='驗證碼輸入錯誤, ';}
	           //1061005
			   $userAgent=$_SERVER['HTTP_USER_AGENT'];
	           if (preg_match("/(iPod|iPad|iPhone)/", $userAgent))
               {	
               } elseif (preg_match("/android/i", $userAgent)) {
               } else
               { 
                 if (strcmp($this->input->post('captcha'),$this->session->userdata('captchaWord')) == 0)
				 {$data['err'] =''; $err1=0; } else {$err1=1;$data['err'] ='驗證碼輸入錯誤, ';}
               } 
	   
	   
	 //  if (strcmp($this->input->post('captcha'),$this->session->userdata('captchaWord')) == 0)
     //      {$data['err'] =''; $err1=0; } else {$err1=1;$data['err'] ='驗證碼輸入錯誤, ';}
	    if ($query  &&  $err1==0 ) 
		  {
		    $this->session->set_userdata('manager', $this->input->post('username'));  
			
			if (session_status() == PHP_SESSION_NONE) {
			session_start();
		    }
			$_SESSION['manager'] = $this->input->post('username');
		  //  $this->login_model->companyf();   1060809
		    redirect('main/index');    
		//	 redirect('tree/index');
		  //$this->load->view('main_v',$data);
		  //showmessage('登入成功', 'main/index');
		  }
		else
		  {
		  //showmessage('登入失败，資料輸入錯誤', 'login/index');
		  //$data['username'] = $this->input->post('username');
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['menu_v'] = 'main_menulogin_v';
		  $data['content_v'] = 'login_v';		
		  $data['foot_v'] ='main_foot_v';
		  $this->load->vars($data);
		  $this->load->view('main_headlogin_v');
		 //$this->load->view('login_v',$data);
		 // redirect('login/index');
		  }
	  }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
?>