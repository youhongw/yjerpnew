<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Moci02a extends CI_Controller
{           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父類別
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
		date_default_timezone_set("Asia/Taipei");  //設置時區
		$this->no_col = "tb008";	//序號欄位
		$this->detail_col =
			array(
				'tb008' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'readonly' => "readonly"
				),
				'tb003' => array(
					'name' => "品號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "20",
					'id' => "invi02",
					'style' => "background-color:#FFFFE4",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'onchange' => "check_invi02d(this);",
					'ondblclick' => "search_invi02d_window(this);",
					'required' => "required"
				),
				'tb012' => array(
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
				'tb013' => array(
					'name' => "規格",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "50",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),

				'tb007' => array(
					'name' => "單位",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'maxlength' => "4",
					'size' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'tb009' => array(
					'name' => "庫別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'maxlength' => "5",
					'size' => "6",
					'id' => "cmsi03",
					'style' => "background-color:#FFFFE4",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'onchange' => "check_cmsi03d(this);",
					'ondblclick' => "search_cmsi03d_window(this);"
				),
				'tb009disp' => array(
					'name' => "庫別名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				// 'tb006' => array(
				// 	'name' => "製程代號",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'size' => "6",
				// 	'id' => "cmsi03",
				// 	'style' => "background-color:#FFFFE4",
				// 	'onchange' => "check_cmsi19d(this);clear_row(this);",
				// 	'ondblclick' => "search_cmsi19d_window(this);"
				// ),
				// 'tb006disp' => array(
				// 	'name' => "製程名稱",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10"
				// ),

				// 'tb004' => array(
				// 	'name' => "需領用量",
				// 	'title_class' => "center",
				// 	'data_class' => "total_qty",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'id' => "tb008",
				// 	'value' => "0",
				// 	'ondblclick' => ""
				// ),
				'tb005' => array(
					'name' => "使用量",
					'title_class' => "center",
					'data_class' => "right",
					'type' => "text",
					'value' => "",
					'maxlength' => "15",
					'onkeyup' => "value=value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1');",
					'size' => "15",
					'onchange' => "sum_row();",
					'required' => "required"
				),

				// 'tb020' => array(
				// 	'name' => "未領用量",
				// 	'title_class' => "center",
				// 	'data_class' => "total_price",
				// 	'type' => "text",
				// 	'value' => "0",
				// 	'size' => "10"
				// ),
				// 'tb011' => array(
				// 	'name' => "材料型態",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "select",
				// 	'option' => array('1' => "直接材料", '2' => "間接材料", '3' => "廠商供料", '4' => "不發料", '5' => "客戶供料")
				// ),
				// 'tb010' => array(
				// 	'name' => "取替代件",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10"
				// ),
				// 'tb015' => array(
				// 	'name' => "預計領料",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'value' => "0",
				// 	'size' => "10"
				// ),
				'tb017' => array(
					'name' => "備註",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
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
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['moci02a']['search']);
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
		$prom = substr($rms, 9, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($this->input->post('submit')) {	//如果是由find_v送過來的，reset session
			unset($_SESSION['moci02a']['search']);
		}

		// echo "<pre>";var_dump($test);exit;

		$limit = 15;    //每頁筆數
		$this->load->model('moc/moci02a_model'); // 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;

		$result = $this->moci02a_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['moci02a']['search']['sql'];  //顯示sql語法
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
		$config['base_url'] = site_url("moc/moci02a/display_search");   //設定分頁url路徑
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
		$data['systitle'] = '配料單建立作業';
		$data['menu_v'] = 'main_menu_v';

		// $data['content_v'] = 'moc/moci02a_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('moc/moci02a_brow_v');
	}
	// 下拉視窗不更新網頁查 品號品名
	public function clear_sql_term()
	{  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['moci02a']['search']);
		}

		$this->display();
	}
	public function lookup()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('moc/moci02a_model');
		$query = $this->moci02a_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 

		if (!empty($query)) {
			$data['response'] = 'true'; //Set response  
			$data['message'] = array(); //Create array  
			foreach ($query as $row) {
				$data['message'][] = array(
					'category' => '',
					'value' => $row->mb001 . ',' . $row->mb002 . ',' . $row->mb003 . ',' . $row->mb004 . ',' . $row->mb017disp,
					'value1' => $row->mb001,
					'value2' => $row->mb002,
					'value3' => $row->mb003,
					'value4' => $row->mb004,
					'value5' => $row->mb017,
					'value6' => $row->mb017disp,
					''
				);  //Add a row to array  
			}
		}
		if ('IS_AJAX') {
			echo json_encode($data); //echo json string if ajax request

		} else {
			$this->load->view('moc/moci02a_model/lookup', $data);
			// $this->index; //Load html view of search results  
		}
	}

	// 下拉視窗不更新網頁查 交貨庫別

	public function lookupa()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('moc/moci02a_model');
		$query = $this->moci02a_model->lookupa(urldecode(urldecode($this->uri->segment(4)))); //Search DB 

		if (!empty($query)) {
			$data['response'] = 'true'; //Set response  
			$data['message'] = array(); //Create array  
			foreach ($query as $row) {
				$data['message'][] = array(
					'category' => '',
					'value' => $row->mc001 . ',' . $row->mc002,
					'value1' => $row->mc001,
					'value2' => $row->mc002,
					''
				);  //Add a row to array  
			}
		}
		if ('IS_AJAX') {
			echo json_encode($data); //echo json string if ajax request

		} else {
			$this->load->view('moc/moci02a_model/lookupa', $data);
			// $this->index; //Load html view of search results  
		}
	}
	public function datapurq04a()   //提示改輸入資料如 製造命令別   不更新網頁
	{
		$this->load->model('moc/moci02a_model');
		$data['result'] = $this->moci02a_model->ajaxpurq04a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}

	public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
	{
		$this->load->model('moc/moci02a_model');
		$data['result'] = $this->moci02a_model->ajaxcmsq05a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁ta010
	{
		$this->load->model('moc/moci02a_model');
		$data['result'] = $this->moci02a_model->ajaxcmsq02a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁ta012
	{
		$this->load->model('moc/moci02a_model');
		$data['result'] = $this->moci02a_model->ajaxpalq01a($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	public function datachkno1()   //提示改輸入資料如  製造命令號 不更新網頁ta002
	{
		$this->load->model('moc/moci02a_model');
		$data['result'] = $this->moci02a_model->ajaxchkno1($this->uri->segment(4), $this->uri->segment(5));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}


	public function filter1($sort_by = 'ta001', $sort_order = 'desc', $offset = 0)   ////篩選資料
	{
		$limit = 15;
		$data['sort_by'] = $this->uri->segment(4);
		$data['sort_order'] = $this->uri->segment(5);
		$seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
		$seq7 = '1';
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
		$data['sort_order'] = $sort_order;
		$this->load->model('moc/moci02a_model', '', TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
		$result = $this->moci02a_model->filterf1($limit, $offset, $sort_by, $sort_order);
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
		$config['base_url'] = site_url("moc/moci02a/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		$config['per_page'] = $limit;
		$config['uri_segment'] = 8;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(8, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '製造命令資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'moc/moci02a_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function findform()   //進階查詢輸入資料
	{
		$data['date'] = date("Ymd");
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '製造命令資料-進階查詢';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_find_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function findsql($sort_by = 'ta001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	{
		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('moc/moci02a_model'); // 加載TABLE model 模型		
		$result = $this->moci02a_model->findf($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,ta001,desc
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
		$config['base_url'] = site_url("moc/moci02a/findsql/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '製造命令資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'moc/moci02a_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function addform()   //新增輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 9, 1);

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
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci02a');
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->tb008);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }

		// 查群組名稱------------------------
		$this->load->model('bom/bomi02a_model', '', TRUE);
		$data['group'] = $this->bomi02a_model->selectgro();

		$data['usecol_array'] = $data['col_array'];
		// $data['date'] = date("Y/m/d");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '配料單資料-新增';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_add_v';
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
		$prom = substr($rms, 9, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		// $seg1 = $this->input->post('ta001');
		// $seg2 = $this->input->post('ta002');
		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci02a');
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->tb008);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		// 查群組名稱------------------------
		$this->load->model('bom/bomi02a_model', '', TRUE);
		$data['group'] = $this->bomi02a_model->selectgro();

		$data['usecol_array'] = $data['col_array'];
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('moc/moci02a_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->moci02a_model->insertf();
		if ($action === 'exist') {
			$data['message'] = '資料重複!';
		}
		//  else {
		// 	$this->moci02a_model->auto_print($seg1, $seg2);
		// }
		$data['systitle'] = '配料單建立作業-新增';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copyform()   //複製資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '製造命令資料-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copysave()   //複製存檔
	{
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('moc/moci02a_model', '', TRUE);
		$data['message'] = '複製成功!';
		$action = $this->moci02a_model->copyf();
		if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
		{
			$data['message'] = '資料重複!';
		}
		$data['systitle'] = '製造命令資料-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copybefore()   //前置單據存檔 預計生產量,庫別,7 製令別, 單號
	{
		$data['seq1'] = $this->uri->segment(4);
		$data['seq2'] = $this->uri->segment(5);
		$data['seq3'] = $this->uri->segment(6);
		$this->session->set_userdata('vta015', $this->uri->segment(5));
		$this->session->set_userdata('vta009', $this->uri->segment(6));
		$this->session->set_userdata('vta001', $this->uri->segment(7));
		$this->session->set_userdata('vta002', $this->uri->segment(8));
		//  urldecode(urldecode($this->uri->segment(4)));  亂碼
		//  $this->session->set_userdata('vta034', urldecode(urldecode($this->uri->segment(9))));
		//  $this->session->set_userdata('vta035',  urldecode(urldecode($this->uri->segment(10))));
		//  $this->session->set_userdata('vta007',  urldecode(urldecode($this->uri->segment(11))));

		$data['message'] = '查詢一筆資料!';
		$this->load->model('moc/moci02a_model');
		$data['result'] = $this->moci02a_model->selonebefore($this->uri->segment(4), $this->uri->segment(5));
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '製造命令資料-前置單據資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function exceldetail()   //轉excel明細輸入起迄資料
	{
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '製造命令資料-轉excel檔';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_excel_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function write()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('moc/moci02a_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array('製令別單', '製令單號', '開單日期', '加工廠商', '預計產量', '主件品號', '品名', '規格', '單位', '序號', '品號', '品名', '規格', '單位', '需領用量', '已領用量', '未領用量');  //excel 表頭
		$result1 = $this->moci02a_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	public function printdetail()   //印明細起迄資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '製造命令資料-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_print_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}
	public function printdetailc()   //印明細起迄資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '製造命令資料-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_print1_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}
	public function printc()   //印製造命令
	{
		$data['paper9'] = $this->input->post('tl009p');
		$this->load->model('moc/moci02a_model', '', TRUE);
		$data['message'] = '列印製造命令!';
		$result = $this->moci02a_model->printfc();

		$data['results'] = $result['rows'];
		//   $data['num_results'] = $result['num_rows'];
		//   $this->load->library('pagination');
		//   $data['numrow']=$result['num_rows'];// 總筆數 
		//   $data['username'] = $this->session->userdata('manager');
		//   $data['systitle'] ='製造命令資料-印明細表';
		//$data['menu_v'] = 'main_menuno_v';
		//   $data['content_v'] = 'moc/moci02a_printb_v';
		//  $data['foot_v'] ='main_footno_v';
		$this->load->vars($data);
		//  $this->load->view('main_headprint_v');
		$this->load->view('moc/moci02a_printc_v');
	}
	public function printbb()   //印製造命令
	{
		$this->load->model('moc/moci02a_model', '', TRUE);
		$data['message'] = '列印製造命令!';
		$result = $this->moci02a_model->printfb();
		$data['results'] = $result['rows'];
		$this->load->vars($data);
		$this->load->view('moc/moci02a_printb_v');
	}
	public function printa()   //印明細
	{

		$data['paper9'] = $this->input->post('tl009p');
		$data['singing1'] = $this->input->post('singing1');
		$data['singing2'] = $this->input->post('singing2');
		$data['message'] = '列印明細成功!';
		if ($this->input->post('action') == "excel") {
			$this->write();
		}
		$this->load->model('moc/moci02a_model', '', TRUE);
		$data['message'] = '列印明細成功!';
		$result = $this->moci02a_model->printfd();
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '製造命令資料-印明細表';
		//$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_printa_v';
		//$data['foot_v'] ='main_footno_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
		//$this->load->view('moc/moci02a_printa_v',$data);  
	}

	public function updsave()   //修改存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 9, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seg1 = $this->input->post('ta001');
		$seg2 = $this->input->post('ta002');


		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		$data['usecol_array'] = $data['col_array'];

		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('moc/moci02a_model', '', TRUE);

		$this->load->vars($data);
		$this->moci02a_model->updatef();
		//  $data['seq1'] = $this->uri->segment(4); 
		$data['message'] = '修改資料成功!';

		$data['result'] = $this->moci02a_model->selone($seg1, $seg2);
		if ($data['result'] == "no_data") {
			redirect('moc/moci02a/' . $this->session->userdata('moci02a_search'));
			exit;
		}

		// 查群組名稱------------------------
		$this->load->model('bom/bomi02a_model', '', TRUE);
		$data['group'] = $this->bomi02a_model->selectgro();

		$data['systitle'] = '配料單-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_upd_v';
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
		$prom = substr($rms, 9, 1);

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

		$data['message'] = '查詢一筆修改資料!';
		$this->load->model('moc/moci02a_model');
		$data['result'] = $this->moci02a_model->selone($seg1, $seg2);
		if ($data['result'] == "no_data") {
			redirect('moc/moci02a/' . $this->session->userdata('moci02a_search'));
			exit;
		}

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci02a');
		// if ($coldata == "no_data" || strlen($coldata->tb008) < 5) {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->tb008);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		$data['usecol_array'] = $data['col_array'];

		// 查群組名稱------------------------
		$this->load->model('bom/bomi02a_model', '', TRUE);
		$data['group'] = $this->bomi02a_model->selectgro();


		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '配料單-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_upd_v';
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
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['moci02a']['search']) && isset($_SESSION['moci02a']['search']['view'][$view_str])) {
			$current_index = $_SESSION['moci02a']['search']['view'][$view_str];
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['moci02a']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['moci02a']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['moci02a']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('moci02a_search'));
			$this->session->set_userdata('moci02a_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('moci02a_search', "display/ta002/desc/" . $offset);
			}
		}

		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;
		$data['message'] = '查詢一筆資料!';
		$this->load->model('moc/moci02a_model');
		$data['result'] = $this->moci02a_model->selone($seg1, $seg2);
		if ($data['result'] == "no_data") {
			redirect('moc/moci02a/' . $this->session->userdata('moci02a_search'));
			exit;
		}

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		$this->load->model('set/seti01_model');
		$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci02a');
		if ($coldata == "no_data" || strlen($coldata->tb008) < 5) {
			$data['usecol_array'] = $data['col_array'];
		} else {
			$usecol_array = explode(',', $coldata->tb008);
			$data['usecol_array'] = array();
			foreach ($usecol_array as $key => $val) {
				$data['usecol_array'][$val] = $data['col_array'][$val];
			}
		}
		$data['message'] = '查看一筆資料!';
		$this->load->model('moc/moci02a_model');
		$data['result'] = $this->moci02a_model->selone($seg1, $seg2);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '製造命令資料-查看資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'moc/moci02a_see_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function del()   //刪除單筆 暫存
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		$data['message'] = '刪除資料成功!';
		$this->load->model('moc/moci02a_model', '', TRUE);
		$this->moci02a_model->deletef($seg1, $seg2);
		$this->display();
	}

	public function delete()   //刪除選取
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('moc/moci02a_model', '', TRUE);
		$data['message'] = $this->moci02a_model->delmutif();
		$this->display();
	}
	public function printb()   //印單據選取
	{

		$this->load->model('moc/moci02a_model', '', TRUE);
		$data['message'] = '列印單據成功!';
		$result = $this->moci02a_model->printfd1($this->uri->segment(4), $this->uri->segment(5));
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '請  購  單';
		//   $this->load->view('moc/moci02a_printb_v');

		$data['content_v'] = 'moc/moci02a_printb_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');

		//  $this->display();
	}
	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號
	public function check_title_no()
	{
		extract($this->input->get());
		$this->load->model('moc/moci02a_model', '', TRUE);
		$data = $this->moci02a_model->check_title_no($moci01, $ta003);
		echo $data;
	}

	//刪除單筆細項AJAX
	public function del_detail_ajax()
	{
		// $seg1 = $this->input->get('td001');
		// $seg2 = $this->input->get('td002');
		// $seg3 = $this->input->get('td003');
		// $seg4 = $this->input->get('tb005');
		$seg1 = trim($this->uri->segment(4));
		$seg2 = trim($this->uri->segment(5));
		$seg3 = trim($this->uri->segment(6));
		$seg4 = trim($this->uri->segment(7));

		$data['message'] = '刪除資料成功!';
		$this->load->model('moc/moci02a_model', '', TRUE);
		echo $this->moci02a_model->deletedetailf($seg1, $seg2, $seg3, $seg4);
	}
	//查看bom筆數
	public function check_bomi02()
	{
		$num = 0;
		extract($this->input->get());
		$this->load->model('bom/bomi02_model', '', TRUE);
		$num = $this->bomi02_model->check_detail_num($mz001);

		echo $num;
	}
	public function import_bomi02()
	{
		extract($this->input->get());
		$this->load->model('bom/bomi02a_model', '', TRUE);
		// $num = $this->bomi02a_model->check_detail_num($mz001);
		// if ($num == 0) {
		// 	echo $num;
		// 	exit;
		// }

		$data = $this->bomi02a_model->get_detail_data($mz001);
		$num = count($data);
		if ($num == 0) {
			echo $num;
			exit;
		}

		echo json_encode($data);
	}

	public function import_bomi07()
	{
		extract($this->input->get());
		$this->load->model('bom/bomi07_model', '', TRUE);
		// $num = $this->bomi02a_model->check_detail_num($mz001);
		// if ($num == 0) {
		// 	echo $num;
		// 	exit;
		// }

		$data = $this->bomi07_model->get_detail_data($me001, $me002, $me003);
		$num = count($data);
		if ($num == 0) {
			echo $num;
			exit;
		}

		echo json_encode($data);
	}
}
/* End of file moci02a.php */
/* Location: ./application/controllers/moci02a.php */
