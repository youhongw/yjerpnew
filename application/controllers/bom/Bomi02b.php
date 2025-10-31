<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bomi02b extends CI_Controller
{           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父類別
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
		date_default_timezone_set("Asia/Taipei");  //設置時區
		$this->no_col = "md002";	//序號欄位
		$this->detail_col =
			array(
				'md002' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'readonly' => "readonly"
				),
				'md003' => array(
					'name' => "元件品號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "20",
					'id' => "invi02",
					'maxlength' => "20",
					'style' => "background-color:#FFFFE4",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'onchange' => "check_invi02d(this);",
					'ondblclick' => "search_invi02d_window(this);",
					'required' => "required"
				),
				'md003disp' => array(
					'name' => "品名",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "50",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'md003disp1' => array(
					'name' => "規格",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "60",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'md004' => array(
					'name' => "單位",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'maxlength' => "4",
					'size' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),

				// 'md011' => array(
				// 	'name' => "生效日期",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'disabled' => "disabled",
				// 	'style' => "background-color:#FFFFE4",
				// 	'onchange' => "dateformat_ymd(this)",
				// 	'ondblclick' => "scwShow(this,event);"
				// ),
				// 'md012' => array(
				// 	'name' => "失效日期",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'disabled' => "disabled",
				// 	'style' => "background-color:#FFFFE4",
				// 	'onchange' => "dateformat_ymd(this)",
				// 	'ondblclick' => "scwShow(this,event);"
				// ),
				'md006' => array(
					'name' => "組成用量",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'value' => "",
					'maxlength' => "15",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1');",
					'size' => "15",
					'required' => "required"
				),
				// 'md007' => array(
				// 	'name' => "底數",
				// 	'title_class' => "center",
				// 	'data_class' => "right",
				// 	'type' => "text",
				// 	'value' => "1",
				// 	'disabled' => "disabled",
				// 	'size' => "10"
				// ),
				// 'md008' => array(
				// 	'name' => "損耗率",
				// 	'title_class' => "center",
				// 	'data_class' => "right",
				// 	'type' => "text",
				// 	'value' => "0",
				// 	'disabled' => "disabled",
				// 	'size' => "10"
				// ),
				// 'md014' => array(
				// 	'name' => "標準成本",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "select",
				// 	'disabled' => "disabled",
				// 	'option' => array('Y' => "計算", 'N' => "不計算")
				// ),
				// 'md017' => array(
				// 	'name' => "材料型態",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "select",
				// 	'disabled' => "disabled",
				// 	'option' => array('1' => "直接材料", '2' => "間接材料", '3' => "廠商供料", '4' => "不發料", '5' => "客戶供料")
				// ),
				'md016' => array(
					'name' => "備註",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "20"
				)
			);
	}

	public function index()           //自訂類預設執行函數 流覽資料
	{
		$this->display_search();
	}

	public function display($offset = 0, $func = "")    //欄位表頭排序與display_search 同
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['bomi02b']['search']);
		}
		$this->display_search();
	}
	//欄位表頭排序 資料流覽 
	public function display_search($offset = 0, $func = "")
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 40, 1);

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
			unset($_SESSION['bomi02b']['search']);
		}

		// echo "<pre>";var_dump($test);exit;

		$limit = 15;    //每頁筆數
		$this->load->model('bom/bomi02b_model'); // 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;

		$result = $this->bomi02b_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['bomi02b']['search']['sql'];  //顯示sql語法
		// $data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['message'] = '資料瀏覽成功!';
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
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
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1 url第四段無就置放0
		$config['base_url'] = site_url("bom/bomi02b/display_search");   //設定分頁url路徑
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
		$data['systitle'] = '隱藏版-材料BOM建立作業';
		$data['menu_v'] = 'main_menu_v';

		// $data['content_v'] = 'bom/bomi02b_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('bom/bomi02b_brow_v');
	}
	public function edit_child()   //開子視窗
	{
		$data['date'] = date("Y/m/d");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '主件整套展開-作業';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'funnew/bomi02ba_child_v';
		$data['foot_v'] = 'main_footno_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}
	public function editb_child()   //開子視窗
	{
		$data['seq1'] = $this->uri->segment(4);
		$data['seq2'] = $this->uri->segment(5);
		$data['date'] = date("Y/m/d");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '主件整套展開-作業';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'funnew/bomi02b_child_v';
		$data['foot_v'] = 'main_footno_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}
	// 下拉視窗不更新網頁查 品號品名

	public function lookup()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('bom/bomi02b_model');
		$query = $this->bomi02b_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 

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
			$this->load->view('bom/bomi02b_model/lookup', $data);
			// $this->index; //Load html view of search results  
		}
	}


	public function datapurq04a()   //提示改輸入資料如 BOM單別   不更新網頁
	{
		$this->load->model('bom/bomi02b_model');
		$data['result'] = $this->bomi02b_model->ajaxpurq04a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}

	public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
	{
		$this->load->model('bom/bomi02b_model');
		$data['result'] = $this->bomi02b_model->ajaxcmsq05a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁mc010
	{
		$this->load->model('bom/bomi02b_model');
		$data['result'] = $this->bomi02b_model->ajaxcmsq02a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁mc012
	{
		$this->load->model('bom/bomi02b_model');
		$data['result'] = $this->bomi02b_model->ajaxpalq01a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function datachkno1()   //提示改輸入資料如  BOM單號 不更新網頁mc012
	{
		$this->load->model('bom/bomi02b_model');
		$data['result'] = $this->bomi02b_model->ajaxchkno1($this->uri->segment(4), $this->uri->segment(5));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}




	public function filter1($sort_by = 'mc001', $sort_order = 'desc', $offset = 0)   ////篩選資料
	{
		$limit = 15;
		$data['sort_by'] = $this->uri->segment(4);
		$data['sort_order'] = $this->uri->segment(5);
		$seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
		$seq7 = '1';
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
		$data['sort_order'] = $sort_order;
		$this->load->model('bom/bomi02b_model', '', TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
		$result = $this->bomi02b_model->filterf1($limit, $offset, $sort_by, $sort_order);
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
		$config['base_url'] = site_url("bom/bomi02b/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		$config['per_page'] = $limit;
		$config['uri_segment'] = 8;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(8, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = 'BOM單資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'bom/bomi02b_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function findform()   //進階查詢輸入資料
	{
		$data['date'] = date("Ymd");
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = 'BOM單資料-進階查詢';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_find_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function findsql($sort_by = 'mc001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	{
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_POST['find005']) {
			$_SESSION['bomi02b_sql_term'] = $_POST['find005'];
		} else {
			$_SESSION['bomi02b_sql_term'] = '(mc001="") ';
		}
		if (@$_POST['find007']) {
			$_SESSION['bomi02b_sql_sort'] = $_POST['find007'];
		} else {
			$_SESSION['bomi02b_sql_sort'] = 'mc001';
		}

		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('bom/bomi02b_model'); // 加載TABLE model 模型		
		$result = $this->bomi02b_model->findf($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,mc001,desc
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
		$config['base_url'] = site_url("bom/bomi02b/findsql/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = 'BOM單資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'bom/bomi02b_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}
	public function clear_sql_term()
	{  //清除條件
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION["bomi02b_sql_term"]) {
			unset($_SESSION["bomi02b_sql_term"]);
		}
		if (@$_SESSION["bomi02b_sql_sort"]) {
			unset($_SESSION["bomi02b_sql_sort"]);
		}
		$this->display();
	}


	public function addform()   //新增輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 40, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END
		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'bomi02b');
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->mc010);  //加單據日期
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }

		// 查群組名稱------------------------
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['group'] = $this->bomi02b_model->selectgro();

		$data['usecol_array'] = $data['col_array'];
		// $data['date'] = date("Y/m/d");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '隱藏版-材料BOM-新增';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function addsave()   //新增存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 40, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END
		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'bomi02b');
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->md003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		// 查群組名稱------------------------
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['group'] = $this->bomi02b_model->selectgro();

		$data['usecol_array'] = $data['col_array'];
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->bomi02b_model->insertf();

		if ($action === 'exist') {

			$data['message'] = '資料重複!';

			if (isset($_SESSION['message1'])) {
				$data['message'] = $_SESSION['message1'];
				unset($_SESSION['message1']);
			}
		}
		//  else {
		// 	$this->bomi02b_model->auto_print();
		// }
		$data['systitle'] = '配料表-新增';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copyform()   //複製資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = 'BOM單資料-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copysave()   //複製存檔
	{
		$mc001o = $this->input->post('mc001o');
		$mc001c = $this->input->post('mc001c');
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['message'] = '複製成功!';
		$action = $this->bomi02b_model->copyf($mc001o, $mc001c);
		if ($action === '0')      // "=="只比較數值，而"==="數值與類型一起比較
		{
			$data['message'] = '查無品號，無法複製!';
		}
		$data['systitle'] = 'BOM單資料-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function exceldetail()   //轉excel明細輸入起迄資料
	{
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = 'BOM單資料-轉excel檔';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_excel_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function write()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array('主件品號', '品名', '規格', '單位', '標準批量', '元件品號', '序號', '品號', '品名', '規格', '單位', '組成用量', '底數', '損耗率');  //excel 表頭
		$result1 = $this->bomi02b_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	public function printdetail()   //印明細起迄資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = 'BOM單資料-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_print_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}
	public function printdetailc()   //印明細起迄資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = 'BOM單資料-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_print1_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}
	public function printc()   //印BOM單
	{
		$data['paper9'] = $this->input->post('mc009c');
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['message'] = '列印BOM單!';
		$result = $this->bomi02b_model->printfc();

		$data['results'] = $result['rows'];
		//   $data['num_results'] = $result['num_rows'];
		//   $this->load->library('pagination');
		//   $data['numrow']=$result['num_rows'];// 總筆數 
		//   $data['username'] = $this->session->userdata('manager');
		//   $data['systitle'] ='BOM單資料-印明細表';
		//$data['menu_v'] = 'main_menuno_v';
		//   $data['content_v'] = 'bom/bomi02b_printb_v';
		//  $data['foot_v'] ='main_footno_v';
		$this->load->vars($data);
		//  $this->load->view('main_headprint_v');
		$this->load->view('bom/bomi02b_printc_v');
	}
	public function printbb($ta009c)   //印BOM單
	{
		$data['paper9'] = $ta009c;
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['message'] = '列印BOM單!';
		//公司參數
		$result1 = $this->bomi02b_model->companyf();
		$data['results1'] = $result1['rows1'];

		$result = $this->bomi02b_model->printfb();
		$data['results'] = $result['rows'];
		$this->load->vars($data);
		$this->load->view('bom/bomi02b_printb_v');
	}
	public function printa()   //印明細
	{
		$data['paper9'] = $this->input->post('mc009c');
		$data['singing1'] = $this->input->post('singing1');
		$data['singing2'] = $this->input->post('singing2');
		$data['message'] = '列印明細成功!';
		if ($this->input->post('action') == "excel") {
			$this->write();
		}
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['message'] = '列印明細成功!';
		$result = $this->bomi02b_model->printfd();
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = 'BOM單資料-印明細表';
		//$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_printa_v';
		//$data['foot_v'] ='main_footno_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
		//$this->load->view('bom/bomi02b_printa_v',$data);  
	}

	public function updsave()   //修改存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 40, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END
		$seg1 = $this->input->post('mc001');
		$seg2 = $this->input->post('mc002');

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		$data['usecol_array'] = $data['col_array'];

		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$this->bomi02b_model->updatef();

		//回首頁
		// $this->display();
		//改回修改頁
		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;
		$data['result'] = $this->bomi02b_model->selone($seg1);
		if ($data['result'] == "no_data") {
			redirect('bom/bomi02b/' . $this->session->userdata('bomi02b_search'));
			exit;
		}

		// 查群組名稱------------------------
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['group'] = $this->bomi02b_model->selectgro();

		$data['systitle'] = 'BOM單資料-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_upd_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}
	public function updform()   //修改輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 40, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);

		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;
		$data['message'] = '查詢一筆修改資料!';
		$this->load->model('bom/bomi02b_model');
		$data['result'] = $this->bomi02b_model->selone($seg1);
		if ($data['result'] == "no_data") {
			redirect('bom/bomi02b/' . $this->session->userdata('bomi02b_search'));
			exit;
		}

		// 查群組名稱------------------------
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['group'] = $this->bomi02b_model->selectgro();

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'bomi02b');
		// if ($coldata == "no_data" || strlen($coldata->md003) < 5) {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->md003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		$data['usecol_array'] = $data['col_array'];

		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = 'BOM單資料-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_upd_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function see()   //看資料
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		//以下暫存view處理，上一筆下一筆用
		$view_str = $seg1 . "_" . $seg2;
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['bomi02b']['search']) && isset($_SESSION['bomi02b']['search']['view'][$view_str])) {
			$current_index = $_SESSION['bomi02b']['search']['view'][$view_str];
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['bomi02b']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['bomi02b']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['bomi02b']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('bomi02b_search'));
			$this->session->set_userdata('bomi02b_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('bomi02b_search', "display/ta002/desc/" . $offset);
			}
		}

		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;
		$data['message'] = '查詢一筆資料!';
		$this->load->model('bom/bomi02b_model');
		$data['result'] = $this->bomi02b_model->selone($seg1);
		if ($data['result'] == "no_data") {
			redirect('bom/bomi02b/' . $this->session->userdata('bomi02b_search'));
			exit;
		}

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		$this->load->model('set/seti01_model');
		$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'bomi02b');
		if ($coldata == "no_data" || strlen($coldata->md003) < 5) {
			$data['usecol_array'] = $data['col_array'];
		} else {
			$usecol_array = explode(',', $coldata->md003);
			$data['usecol_array'] = array();
			foreach ($usecol_array as $key => $val) {
				$data['usecol_array'][$val] = $data['col_array'][$val];
			}
		}
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = 'BOM單資料-查看資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'bom/bomi02b_see_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function del()   //刪除單筆 暫存
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		$data['message'] = '刪除資料成功!';
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$this->bomi02b_model->deletef($seg1, $seg2);
		$this->display();
	}

	public function delete()   //刪除選取
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$this->bomi02b_model->delmutif();
		$this->display();
	}
	public function printb()   //印單據選取
	{

		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data['message'] = '列印單據成功!';
		$result = $this->bomi02b_model->printfd1($this->uri->segment(4), $this->uri->segment(5));
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '請  購  單';
		//   $this->load->view('bom/bomi02b_printb_v');

		$data['content_v'] = 'bom/bomi02b_printb_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');

		//  $this->display();
	}
	public function delete_detail()
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$this->bomi02b_model->del_detail();
		redirect('bom/bomi02b/updform/' . $_POST['del_md001'] . '/' . $_POST['del_md002']);   //重新整理
	}
	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號
	//提示輸入資料 key 是否重複 	
	public function check_key()
	{
		extract($this->input->get());
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data = $this->bomi02b_model->check_key($mc001);
		//echo "<pre>";var_dump($data);exit;
		// echo $data;
		echo json_encode($data);
	}
	public function check_title_no()
	{
		extract($this->input->get());
		$this->load->model('bom/bomi02b_model', '', TRUE);
		$data = $this->bomi02b_model->check_title_no($invi02);
		echo $data;
	}
	//刪除單筆細項AJAX
	public function del_detail_ajax()
	{
		$seg1 = $this->input->get('md001');
		$seg2 = $this->input->get('md002');
		$seg3 = $this->input->get('md003');
		$data['message'] = '刪除資料成功!';
		$this->load->model('bom/bomi02b_model', '', TRUE);
		echo $this->bomi02b_model->deletedetailf($seg1, $seg2, $seg3);
	}
}
/* End of file bomi02b.php */
/* Location: ./application/controllers/bomi02b.php */
