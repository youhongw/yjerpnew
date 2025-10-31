<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi04 extends CI_Controller
{           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父類別
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
		date_default_timezone_set("Asia/Taipei");  //設置時區
	}

	public function index()           //自訂類預設執行函數 流覽資料
	{
		$limit = 15;    //每頁筆數
		$sort_order =  'desc';
		$sort_by = 'md001';
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('cms/cmsi04_model');     // 加載TABLE model 模型		
		$result = $this->cmsi04_model->search($limit, $offset = 0, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,md001,desc
		$data['results'] = $result['rows'];   // 所有列資料
		$data['num_results'] = $result['num_rows'];  // 總筆數
		$data['numrow'] = $result['num_rows'];  // 總筆數 
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
		$config['base_url'] = site_url("cms/cmsi04/display/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');  //session 儲存的使用者代號
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '生產線別資料建立作業';  //網頁抬頭顯示名稱
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'cms/cmsi04_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function display($sort_by = 'md001', $sort_order = 'desc', $offset = 0)  //欄位表頭排序
	{
		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('cms/cmsi04_model'); // 加載TABLE model 模型		
		$result = $this->cmsi04_model->search($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,md001,desc
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['page'] = $result['num_rows'] / $limit; // 總頁數 
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
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
		$config['cur_page'] = $this->uri->segment(6, 0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("cms/cmsi04/display/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '生產線別資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'cms/cmsi04_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function displayr($offset = 0, $func = "")  //欄位表頭排序
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 5, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($this->input->post('submit')) {	//如果是由find_v送過來的，reset session
			unset($_SESSION['cmsi04']['search']);
		}

		$limit = 15;    //每頁筆數
		$this->load->model('cms/cmsi04_model'); // 加載TABLE model 模型		
		$result = $this->cmsi04_model->construct_sqlr($limit = 15, $offset = 0, $func = ""); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數 
		$data['sql'] = $_SESSION['cmsi04']['search']['sql'];  //顯示sql語法

		$data['message'] = '資料流覽成功!';
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
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
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("cms/cmsi04/displayr");   //設定分頁url路徑
		/* 網址去除".html" explode 字串進行切割 陣列,  */
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
		$data['curpage'] = $this->uri->segment(4, 1);   //當前頁第4無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '生產線別時薪設定';
		$data['menu_v'] = 'main_menu_v';
		// $data['content_v'] = 'cms/cmsi04_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('cms/cmsi04_browr_v');
	}

	//選取更新 
	public function dataupdate()   //提示改輸入資料如 實盤數量 不更新網頁
	{
		$seq1 = urldecode($this->uri->segment(4));
		$seq2 = $this->uri->segment(5);

		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->ajaxdata($seq1, $seq2);
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
    //選取更新 
	public function dataupdatea()   //提示改輸入資料如 實盤數量 不更新網頁
	{
		$seq1 = urldecode($this->uri->segment(4));
		$seq2 = $this->uri->segment(5);
        echo var_dump($seq1);
		echo var_dump($seq2);
		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->ajaxdataa($seq1, $seq2);
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function CuttingStr($str, $strlen)
	{
		//把'&nbsp;'先轉成空白
		$str = str_replace('&nbsp;', ' ', $str);
		$output_str_len = 0; //累計要輸出的擷取字串長度
		$output_str = ''; //要輸出的擷取字串

		//逐一讀出原始字串每一個字元
		for ($i = 0; $i < strlen($str); $i++) {
			//擷取字數已達到要擷取的字串長度，跳出回圈
			if ($output_str_len >= $strlen) {
				break;
			}

			//取得目前字元的ASCII碼
			$str_bit = ord(substr($str, $i, 1));

			if ($str_bit  <  128) {
				//ASCII碼小於 128 為英文或數字字符
				$output_str_len += 1; //累計要輸出的擷取字串長度，英文字母算一個字數
				$output_str .= substr($str, $i, 1); //要輸出的擷取字串

			} elseif ($str_bit  >  191  &&  $str_bit  <  224) {
				//第一字節為落於192~223的utf8的中文字(表示該中文為由2個字節所組成utf8中文字)
				$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
				$output_str .= substr($str, $i, 2); //要輸出的擷取字串
				$i++;
			} elseif ($str_bit  >  223  &&  $str_bit  <  240) {
				//第一字節為落於223~239的utf8的中文字(表示該中文為由3個字節所組成的utf8中文字)
				$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
				$output_str .= substr($str, $i, 3); //要輸出的擷取字串
				$i += 2;
			} elseif ($str_bit  >  239  &&  $str_bit  <  248) {
				//第一字節為落於240~247的utf8的中文字(表示該中文為由4個字節所組成的utf8中文字)
				$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
				$output_str .= substr($str, $i, 4); //要輸出的擷取字串
				$i += 3;
			}
		}

		//要輸出的擷取字串為空白時，輸出原始字串
		return ($output_str == '') ? $str : $output_str;
	}

	// 下拉視窗不更新網頁查 品號品名

	public function lookup()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('cms/cmsi04_model');
		$query = $this->cmsi04_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 

		if (!empty($query)) {
			$data['response'] = 'true'; //Set response  
			$data['message'] = array(); //Create array  
			foreach ($query as $row) {
				$data['message'][] = array(
					'category' => '',
					'value' => $row->mb001 . ',' . $row->mb002 . ',' . $row->mb003 . ',' . $row->mb004,
					'value1' => $row->mb001,
					'value2' => $row->mb002,
					'value3' => $row->mb003,
					'value4' => $row->mb004,
					''
				);  //Add a row to array  
			}
		}
		if ('IS_AJAX') {
			echo json_encode($data); //echo json string if ajax request

		} else {
			$this->load->view('cms/cmsi04_model/lookup', $data);
			// $this->index; //Load html view of search results  
		}
	}


	public function datapurq04a()   //提示改輸入資料如 生產線別別   不更新網頁
	{
		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->ajaxpurq04a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}

	public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
	{
		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->ajaxcmsq05a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁md010
	{
		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->ajaxcmsq02a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁md012
	{
		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->ajaxpalq01a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function datachkno1()   //提示改輸入資料如  生產線別號 不更新網頁md012
	{
		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->ajaxchkno1($this->uri->segment(4), $this->uri->segment(5));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}




	public function filter1($sort_by = 'md001', $sort_order = 'desc', $offset = 0)   ////篩選資料
	{
		$limit = 15;
		$data['sort_by'] = $this->uri->segment(4);
		$data['sort_order'] = $this->uri->segment(5);
		$seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
		$seq7 = '1';
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
		$data['sort_order'] = $sort_order;
		$this->load->model('cms/cmsi04_model', '', TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
		$result = $this->cmsi04_model->filterf1($limit, $offset, $sort_by, $sort_order);
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
		$config['base_url'] = site_url("cms/cmsi04/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		$config['per_page'] = $limit;
		$config['uri_segment'] = 8;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(8, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '生產線別資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'cms/cmsi04_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function findform()   //進階查詢輸入資料
	{
		$data['date'] = date("Ymd");
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '生產線別資料-進階查詢';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_find_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function findsql($sort_by = 'md001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_POST['find005']) {
			$_SESSION['cmsi04_sql_term'] = $_POST['find005'];
		} else {
			$_SESSION['cmsi04_sql_term'] = '(md001="") ';
		}

		if (@$_POST['find007']) {
			$_SESSION['cmsi04_sql_sort'] = $_POST['find007'];
		} else {
			$_SESSION['cmsi04_sql_sort'] = 'md001';
		}

		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('cms/cmsi04_model'); // 加載TABLE model 模型		
		$result = $this->cmsi04_model->findf($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,md001,desc
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
		$config['base_url'] = site_url("cms/cmsi04/findsql/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '生產線別資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'cms/cmsi04_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}
	public function clear_sql_term()
	{  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION["cmsi04_sql_term"]) {
			unset($_SESSION["cmsi04_sql_term"]);
		}
		if (@$_SESSION["cmsi04_sql_sort"]) {
			unset($_SESSION["cmsi04_sql_sort"]);
		}
		$this->display();
	}
	public function addform()   //新增輸入資料
	{
		$data['date'] = date("Y/m/d");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '生產線別資料-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function addsave()   //新增存檔
	{
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->cmsi04_model->insertf();
		if ($action === 'exist') {
			$data['message'] = '資料重複!';
		}
		$data['systitle'] = '生產線別資料-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copyform()   //複製資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '生產線別資料-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copysave()   //複製存檔
	{
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$data['message'] = '複製成功!';
		$action = $this->cmsi04_model->copyf();
		if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
		{
			$data['message'] = '資料重複!';
		}
		$data['systitle'] = '生產線別資料-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function exceldetail()   //轉excel明細輸入起迄資料
	{
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '生產線別資料-轉excel檔';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_excel_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function write()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array('生產線別', '生產線別名稱', '每日人工產能', '每日機器產能', '標準人工效能', '標準機器負荷', '製造費用分攤', '建立日期');  //excel 表頭
		$result1 = $this->cmsi04_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	public function printdetail()   //印明細起迄資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '生產線別資料-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_print_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}
	public function printdetailc()   //印明細起迄資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '生產線別資料-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_print1_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}
	public function printc()   //印生產線別
	{
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$data['message'] = '列印生產線別!';
		$result = $this->cmsi04_model->printfc();

		$data['results'] = $result['rows'];
		//   $data['num_results'] = $result['num_rows'];
		//   $this->load->library('pagination');
		//   $data['numrow']=$result['num_rows'];// 總筆數 
		//   $data['username'] = $this->session->userdata('manager');
		//   $data['systitle'] ='生產線別資料-印明細表';
		//$data['menu_v'] = 'main_menuno_v';
		//   $data['content_v'] = 'cms/cmsi04_printb_v';
		//  $data['foot_v'] ='main_footno_v';
		$this->load->vars($data);
		//  $this->load->view('main_headprint_v');
		$this->load->view('cms/cmsi04_printc_v');
	}
	public function printbb()   //印生產線別
	{
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$data['message'] = '列印生產線別!';
		$result = $this->cmsi04_model->printfb();
		$data['results'] = $result['rows'];
		$this->load->vars($data);
		$this->load->view('cms/cmsi04_printb_v');
	}
	public function printa()   //印明細
	{
		$data['paper9'] = $this->input->post('tg009p');
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$data['message'] = '列印明細成功!';
		$result = $this->cmsi04_model->printfd();
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '生產線別資料-印明細表';
		//$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_printa_v';
		//$data['foot_v'] ='main_footno_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
		//$this->load->view('cms/cmsi04_printa_v',$data);  
	}

	public function updsave()   //修改存檔
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$this->load->vars($data);
		$this->cmsi04_model->updatef();
		redirect('cms/cmsi04/' . $this->session->userdata('search1'));
	}

	public function updform()   //修改輸入資料
	{
		$data['seq1'] = $this->uri->segment(4);
		$data['seq2'] = $this->uri->segment(4);
		$data['message'] = '查詢一筆修改資料!';
		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->selone($this->uri->segment(4), $this->uri->segment(5));
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '生產線別資料-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_upd_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function see()   //看資料
	{
		$data['seq1'] = $this->uri->segment(4);
		$data['seq2'] = $this->uri->segment(5);
		$data['message'] = '查看一筆資料!';
		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->selone($this->uri->segment(4), $this->uri->segment(5));
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '生產線別資料-查看資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi04_see_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function del()   //刪除單筆 暫存
	{
		$seg1 = $this->uri->segment(4);
		//   $seg2=$this->uri->segment(5); 
		$data['message'] = '刪除資料成功!';
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$this->cmsi04_model->deletef($seg1);
		$this->display();
	}

	public function delete()   //刪除選取
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$this->cmsi04_model->delmutif();
		$this->display();
	}
	public function printb()   //印單據選取
	{

		$this->load->model('cms/cmsi04_model', '', TRUE);
		$data['message'] = '列印單據成功!';
		$result = $this->cmsi04_model->printfd1($this->uri->segment(4), $this->uri->segment(5));
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '請  購  單';
		//   $this->load->view('cms/cmsi04_printb_v');

		$data['content_v'] = 'cms/cmsi04_printb_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');

		//  $this->display();
	}
	public function delete_detail()
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('cms/cmsi04_model', '', TRUE);
		$this->cmsi04_model->del_detail();
		redirect('cms/cmsi04/updform/' . $_POST['del_md001'] . '/' . $_POST['del_md002']);   //重新整理
	}

	public function display_child($offset = 0, $func = "")  //欄位表頭排序
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('cms/cmsi04_model'); // 加載TABLE model 模型		
		$result = $this->cmsi04_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,md001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數 
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
		$config['per_page'] = '10'; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("cms/cmsi04/display_child");   //設定分頁url路徑
		/* 網址去除".html" */
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
		$data['systitle'] = '生產線別資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/cmsi04_child_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');
	}

	public function display_child1($offset = 0, $func = "")  //欄位表頭排序
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('cms/cmsi04_model'); // 加載TABLE model 模型		
		$result = $this->cmsi04_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,md001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數 
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
		$config['per_page'] = '10'; // 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config['next_link'] = '下一頁>';
		$config['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("cms/cmsi04/display_child1");   //設定分頁url路徑
		/* 網址去除".html" */
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
		$data['systitle'] = '生產線別資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/cmsi04a_child_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');
	}

	//庫別快速查詢
	public function lookup1_cmsi04()
	{
		$keyword = urldecode($this->uri->segment(4));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('cms/cmsi04_model');
		/*    $query = $this->cmsi04_model->lookup(
			array('md001','md002'),
			array('and'=>"md001"),
			array('md001'=>$keyword),
			10
		); */
		$query = $this->cmsi04_model->lookup1($keyword); //Search DB 
		// if (!empty($query)) {
		// 	$data['response'] = 'true'; //Set response  
		// 	$data['message'] = array(); //Create array  
		// 	foreach ($query as $row) {
		// 		$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
		// 			'category' => '',
		// 			'value' => $row->md001 . "," . $row->md002, //顯示用的欄位
		// 			'value1' => $row->md001,
		// 			'value2' => $row->md002
		// 		);  //Add a row to array  
		// 	}
		// } else {
		// 	$data['response'] = 'true'; //Set response  
		// 	$data['message'] = array(); //Create array
		// 	$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
		// 		'category' => '',
		// 		'value' => "查無資料" //顯示用的欄位
		// 	);  //Add a row to array  
		// }
		// echo json_encode($data); //echo json string if ajax request

		if (count($query) > 0) {
			$result = mb_convert_encoding($query[0]->MD002, "utf-8", "big-5");
			//$result = 'DDD查無資料';
		} else {
			$result = '查無資料';
		}
		echo $result;
	}
	//庫別快速查詢
	public function lookup2_cmsi04()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('cms/cmsi04_model');
		/*    $query = $this->cmsi04_model->lookup(
			array('md001','md002'),
			array('and'=>"md001"),
			array('md001'=>$keyword),
			10
		); */
		$query = $this->cmsi04_model->lookup2(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
		if (!empty($query)) {
			$data['response'] = 'true'; //Set response  
			$data['message'] = array(); //Create array  
			foreach ($query as $row) {
				$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
					'category' => '',
					'value' => $row->md001 . "," . $row->md002, //顯示用的欄位
					'value1' => $row->md001,
					'value2' => $row->md002
				);  //Add a row to array  
			}
		} else {
			$data['response'] = 'true'; //Set response  
			$data['message'] = array(); //Create array
			$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				'category' => '',
				'value' => "查無資料" //顯示用的欄位
			);  //Add a row to array  
		}
		echo json_encode($data); //echo json string if ajax request
	}
	public function clear_sql()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['cmsi04']['search']);
		}
		$this->display_child();
	}
	public function clear_sql1()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['cmsi04']['search']);
		}
		$this->display_child1();
	}

	public function checkcmsi04()   //不更改網頁 輸入資料 庫別 6明細
	{
		$this->load->model('cms/cmsi04_model');
		$data['result'] = $this->cmsi04_model->ajaxcmsi04($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}

	public function check_key()
	{
		// extract($this->input->get());
		$seg1 = trim($this->uri->segment(4));
		if ($seg1 != "") {
			$this->load->model('cms/cmsi04_model', '', TRUE);
			$data = $this->cmsi04_model->ajaxkey($seg1);
			// $relust = $data ? 'Y' : 'N';
			// echo "<pre>";	var_dump($relust);		exit;
			echo $data;
		} else {
			echo 'E';
		}
	}
}
/* End of file cmsi04.php */
/* Location: ./application/controllers/cmsi04.php */
