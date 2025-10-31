<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admi00 extends CI_Controller
{           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父類別
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
	}

	//自訂類預設執行函數 流覽資料
	public function index()
	{
		$this->display_search();
	}
	public function display_sql()
	{
		$this->load->model('scm/admi00_model'); // 加載TABLE model 模型
		// $result = $this->admi00_model->temp_sql(); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$this->display();
	}
	//欄位表頭排序資料流覽 	  
	public function display($sort_by = 'mf001', $sort_order = 'desc', $offset = 0)
	{
		//session_status() is used to return the current session status.
		//PHP_SESSION_NONE if sessions are enabled, but none exists. PHP_SESSION_ACTIVE if sessions are enabled, and one exists.
		// 設定 $_SESSION["a"][0][50]像這個樣子。 然後可以用變數$a[0][50]的方式來取得。 
		if (@session_status() == PHP_SESSION_NONE) {
			@session_start();
			unset($_SESSION['admi00']['search']);
		}
		unset($_SESSION['admi00']['search']);
		$this->display_search();
	}

	//欄位表頭排序 資料流覽1 
	public function display_search($offset = 0, $func = "")
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));

		if (!$user) {
			redirect('/login/');
		}
		if ($super != 'Y') {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		if (@session_status() == PHP_SESSION_NONE) {
			@session_start();
		}
		if ($this->input->post('submit')) {	//如果是由find_v送過來的，reset session
			unset($_SESSION['admi00']['search']);
		}
		$limit = 50000;    //每頁筆數
		$this->load->model('scm/admi00_model'); // 加載TABLE model 模型
		$result = $this->admi00_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		//$data['sql'] = $_SESSION['admi00']['search']['sql'];
		// $data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['message'] = '資料瀏覽成功!';
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
		$config['per_page'] = $limit; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("scm/admi00/display_search");   //設定分頁url路徑
		/* 網址去除".html" 字串進行切割 陣列,  */
		$temp_url = explode(".html", $config['base_url']);
		$config['base_url'] = "";
		foreach ($temp_url as $key => $val) {
			$config['base_url'] .= $val;
		}

		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4, 1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['sql'] = $result['num_sql'];   //顯示sql語法
		$data['systitle'] = '權限管理';
		$data['menu_v'] = 'main_menu_v';

		$this->load->vars($data);
		$this->load->view('scm/admi00_brow_v');
	}

	//暫時沒使用
	/*  public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('scm/admi00_model');// 加載TABLE model 模型
		$this->admi00_model->construct_sql($limit, $offset ,$func);
	  } */
	//篩選資料	

	public function filter1($sort_by = 'mf001', $sort_order = 'desc', $offset = 0)   ////篩選資料
	{
		$limit = 10;
		$data['sort_by'] = $this->uri->segment(4);
		$data['sort_order'] = $this->uri->segment(5);
		$seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
		$seq7 = '1';
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
		$data['sort_order'] = $sort_order;
		$this->load->model('scm/admi00_model', '', TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
		$result = $this->moci02_model->filterf1($limit, $offset, $sort_by, $sort_order);
		$data['message'] = '篩選資料成功!';
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$data['sql'] = $result['num_sql'];   //顯示sql語法

		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows'];  // 總筆數 
		$data['page'] = $result['num_rows'] / $limit;  // 總頁數 
		$config = array();
		$config['per_page'] = $limit; // 每頁筆數
		$config['total_rows'] = $result['num_rows'];  // 總筆數 
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(8, 0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("scm/admi00/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		$config['per_page'] = $limit;
		$config['uri_segment'] = 8;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(8, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '進貨入庫明細';
		$this->load->vars($data);
		$this->load->view('scm/admi00_brow_v');
	}
	public function filter1test($sort_by = 'lz004', $sort_order = 'desc', $offset = 0)
	{
		$limit = 15;
		$data['sort_by'] = $this->uri->segment(4);
		$data['sort_order'] = $this->uri->segment(5);
		$seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
		$seq7 = '1';
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
		$data['sort_order'] = $sort_order;
		$this->load->model('scm/admi00_model', '', TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
		$result = $this->admi00_model->filterf1($limit, $offset, $sort_by, $sort_order);
		$data['message'] = '篩選資料成功!';
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows'];  // 總筆數 
		$data['page'] = $result['num_rows'] / $limit;  // 總頁數 
		$config = array();
		$config['per_page'] = $limit; // 每頁筆數
		$config['total_rows'] = $result['num_rows'];  // 總筆數 
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(8, 0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("scm/admi00/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		$config['per_page'] = $limit;
		$config['uri_segment'] = 8;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(8, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '進貨入庫明細';
		//  $data['menu_v'] = 'main_menu_v';
		//  $data['content_v'] = 'scm/admi00_brow_v';
		// $data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('scm/admi00_brow_v');
		//$this->load->view('scm/admi00_v', $data);
	}
	//進階查詢輸入資料
	public function findform()
	{
		$data['date'] = date("Ymd");
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '進貨入庫-進階查詢';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'scm/admi00_find_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//進階查詢流覽資料
	public function findsql($sort_by = 'mf001', $sort_order = 'desc', $offset = 0)
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_POST['find005']) {
			$_SESSION['admi00_sql_term'] = $_POST['find005'];
		} else {
			$_SESSION['admi00_sql_term'] = '(mf001="") ';
		}

		if (@$_POST['find007']) {
			$_SESSION['admi00_sql_sort'] = $_POST['find007'];
		} else {
			$_SESSION['admi00_sql_sort'] = 'mf001';
		}
		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('scm/admi00_model'); // 加載TABLE model 模型		
		$result = $this->admi00_model->findf($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,mf001,desc
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['page'] = $result['num_rows'] / $limit; // 總頁數 
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
		$config['per_page'] = '15'; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(6, 0);   //當前頁 結合分頁url路徑 +1
		$this->pagination->initialize($config);    //分頁初始化 display 3
		$config['base_url'] = site_url("scm/admi00/findsql/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '請假單 - 建立申請';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'scm/admi00_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	//清除條件
	/*    public function clear_sql_term(){  
		session_start();
		  if(@$_SESSION["admi00_sql_term"]) {unset($_SESSION["admi00_sql_term"]);}
		  if(@$_SESSION["admi00_sql_sort"]) {unset($_SESSION["admi00_sql_sort"]);}
		  $this->display();
	    }  */

	//新增輸入資料
	public function addform()
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));

		if (!$user) {
			redirect('/login/');
		}
		if ($super != 'Y') {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '使用者-新增';

		$this->load->vars($data);
		$this->load->view('scm/admi00_add_v');
	}

	//新增存檔
	public function addsave()
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));

		if (!$user) {
			redirect('/login/');
		}
		if ($super != 'Y') {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('scm/admi00_model', '', TRUE);
		$action = $this->admi00_model->selone2(trim($this->input->post('mf001')));

		if ($action) {
			if ($this->admi00_model->insertf()) {
				$data['message'] = '使用者代號-新增成功!';
				redirect('scm/admi00/display');
			}
			$data['message'] = '使用者代號-新增失敗!';
		} else {
			$data['message'] = '使用者代號-重複!';
		}

		$data['systitle'] = '使用者-新增';
		$this->load->vars($data);
		$this->load->view('scm/admi00_add_v');
	}

	//轉excel 部份資料由 print_v call
	public function write()
	{
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('scm/admi00_model', '', TRUE);
		$title = array('進貨入庫代號', '進貨入庫名稱', '進貨入庫密碼', '群組代號', '超級進貨入庫', '部門代號', '建立日期');  //excel 表頭
		$result1 = $this->admi00_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	//印明細起迄資料輸入
	public function printdetail()
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '進貨入庫-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'scm/admi00_print_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//印明細
	public function printa()
	{
		$data['paper9'] = $this->input->post('tg009p');
		$data['singing1'] = $this->input->post('singing1');
		$data['singing2'] = $this->input->post('singing2');
		$data['message'] = '列印明細成功!';
		if ($this->input->post('action') == "excel") {
			$this->write();
		}
		$this->load->model('scm/admi00_model', '', TRUE);
		$result = $this->admi00_model->printfd();
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '進貨入庫-印明細表';
		$data['content_v'] = 'scm/admi00_printa_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
	}

	//修改存檔	
	public function updsave()
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));

		if (!$user) {
			redirect('/login/');
		}
		if ($super != 'Y') {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$this->load->model('scm/admi00_model', '', TRUE);

		if ($this->admi00_model->updatef()) {
			$data['message'] = '使用者代號-修改成功!';
			redirect('scm/admi00/display');
		}

		$seq1 = trim($this->input->post('mf001'));
		$data['result'] = $this->admi00_model->selone($seq1);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '使用者-修改';

		$this->load->vars($data);
		$this->load->view('scm/admi00_upd_v');
	}

	//修改輸入資料
	public function updform()
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));

		if (!$user) {
			redirect('/login/');
		}
		if ($super != 'Y') {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seq1 = $this->uri->segment(4);

		$data['message'] = '查詢一筆修改資料!';
		$this->load->model('scm/admi00_model');
		$data['result'] = $this->admi00_model->selone($seq1);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '使用者-修改';
		// echo "<pre>";var_dump($data);exit;
		$this->load->vars($data);
		$this->load->view('scm/admi00_upd_v');
	}

	public function selfupdsave()
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('scm/admi00_model');

		$seq1 = $this->input->post('mf001'); //帳號
		$seq2 = $this->input->post('mf003'); //原密碼
		$seq3 = $this->input->post('mf003new'); //輸入新密碼
		$seq4 = $this->input->post('mf003newc'); //mf003newc

		if ($seq3 == $seq4) {

			$data['result'] = $this->admi00_model->selone1($seq1, $seq2, $seq3);

			if ($data['result'] == '0') {
				$data['message'] = '原密碼輸入錯誤!!!';
			} else if ($data['result']) {
				redirect('main');
				$data['message'] = '修改成功~';
			} else {
				$data['message'] = '修改失敗!!!';
			}
		} else {
			$data['message'] = '新密碼2次輸入不同!!!';
		}

		$data['results'] = $this->admi00_model->selone($seq1);
		$data['systitle'] = '使用者-修改密碼';

		$this->load->vars($data);
		$this->load->view('scm/admi00_self_upd_v');
	}

	public function selfupdform()
	{
		$seq1 = $this->session->userdata('sysuser');

		$data['message'] = '查詢一筆修改資料!';
		$this->load->model('scm/admi00_model');
		$data['results'] = $this->admi00_model->selone($seq1);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '使用者-修改密碼';
		// echo "<pre>";var_dump($data);exit;
		$this->load->vars($data);
		$this->load->view('scm/admi00_self_upd_v');
	}

	//看資料
	public function see()
	{   //看資料
		$seq1 = $this->uri->segment(4);
		//以下暫存view處理，上一筆下一筆用
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['admi00']['search'])) {
			$current_index = $_SESSION['admi00']['search']['view'][$seq1];
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['admi00']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['admi00']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['admi00']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('admi00_search'));
			$this->session->set_userdata('admi00_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('admi00_search', "display/mf001/asc/" . $offset);
			}
			if ($temp_ident[0] == "display_leave") {
				$this->session->set_userdata('admi00_search', "display_leave/mf001/asc/" . $offset);
			}
		}
		$data['message'] = '查看一筆資料!';
		$this->load->model('scm/admi00_model');
		$data['result'] = $this->admi00_model->selone($seq1);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '進貨入庫-查看資料';
		//  $data['menu_v'] = 'main_menuno_v';
		//  $data['content_v'] = 'scm/admi00_see_v';
		//  $data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		//  $this->load->view('main_head_v');
		$this->load->view('scm/admi00_upd_v');
	}

	//刪除單筆 暫存
	public function del()
	{
		$seg1 = $this->uri->segment(4);

		$seg2 = $this->uri->segment(5);
		$seg3 = $this->uri->segment(6);
		$seg4 = $this->uri->segment(7);
		$data['message'] = '刪除資料成功!';
		$this->load->model('scm/admi00_model', '', TRUE);
		$this->admi00_model->deletef($seg1, $seg2, $seg3, $seg4);
		$this->display();
	}

	//刪除選取
	public function delete()
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('scm/admi00_model', '', TRUE);
		$this->admi00_model->delmutif();
		$this->display();
	}
	//清除查詢條件
	public function clear_sql_term()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION["admi00_sql_term"]) {
			unset($_SESSION["admi00_sql_term"]);
		}
		if (@$_SESSION["admi00_sql_sort"]) {
			unset($_SESSION["admi00_sql_sort"]);
		}
		// $this->display_sql();
		$this->display();
	}


	//提示改輸入資料重複 進貨入庫代號  mf001
	public function check_key()
	{
		// extract($this->input->get());
		$seg1 = trim($this->uri->segment(4));
		if ($seg1 != '') {
			$this->load->model('scm/admi00_model', '', TRUE);
			$data = $this->admi00_model->selone2($seg1);
			$relust = $data ? 'Y' : 'N';

			echo $relust;
		} else {
			// echo "<pre>";	var_dump($relust);		exit;
			echo 'E';
		}
	}
	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號


}

/* End of file admi00.php */
/* Location: ./application/controllers/admi00.php */