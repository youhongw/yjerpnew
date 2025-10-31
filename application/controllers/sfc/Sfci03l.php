<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); //这一句要求此文件必须通过index.php 调用执行

class sfci03l extends CI_Controller
{           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架 第一個字母大寫)

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父類別
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
		date_default_timezone_set("Asia/Taipei");  //設置時區
		//  $this->output->cache(480);  //緩衝 
		$this->no_col = "TE003";	//序號欄位
		$this->detail_col =
			array(
				'TE003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'readonly' => "readonly"
				),
				'cmsi09d' => array(
					'name' => "員工代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "TE004",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi09d(this);",
					'ondblclick' => "search_cmsi09d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'cmsi09ddisp' => array(
					'name' => "員工姓名",
					'title_class' => "center",
					'data_class' => "center",
					'id' => "TE004disp",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'disabled' => "disabled",
					'readonly' => "value"
				),
				'TE005' => array(
					'name' => "機台代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'id' => "cmsi03",
					'maxlength' => "6",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_cmsi03d(this);",
					'ondblclick' => "search_cmsi03d_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE005disp' => array(
					'name' => "機台名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "48",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE006' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_sfcta(this);",
					'onchange' => "check_sfcta(this);",
					'ondblclick' => "search_sfci03a_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'value' => "5103",
					'required' => "required"
				),
				'TE007' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'maxlength' => "11",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE008' => array(
					'name' => "工序",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),

				'TE009' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#F0F0F0",
					'onblur' => "check_cmsi19(this);",
					'ondblclick' => "search_cmsi19_window(this);",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE009disp' => array(
					'name' => "製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "30",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE010' => array(
					'name' => "型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "正常完成", '2' => "重工完成", '3' => "報廢")
				),
				'TE029' => array(
					'name' => "機台樣式",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "單衝(手動)", '2' => "連續")
				),
				'TE011' => array(
					'name' => "數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'required' => "required"
				),
				'TE028' => array(
					'name' => "可返修數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE031' => array(
					'name' => "報廢品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "8",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pcs(this);",
					'value' => "0",
					'required' => "required"
				),
				'TE0311' => array(
					'name' => "不良品數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				),
				'TE0312' => array(
					'name' => "合格數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'value' => "0"
				),
				'TE022' => array(
					'name' => "時段1起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE023' => array(
					'name' => "時段1訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TE024' => array(
					'name' => "時段2起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE025' => array(
					'name' => "時段2訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE026' => array(
					'name' => "時段3起",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE027' => array(
					'name' => "時段3訖",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'placeholder' => "HHmm",
					'maxlength' => "4",
					'onblur' => "count_time(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');"
				),
				'TE012' => array(
					'name' => "使用人時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE013' => array(
					'name' => "使用機時",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
				),
				'TE017' => array(
					'name' => "產品品號",
					'title_class' => "center",
					'type' => "text",
					'size' => "18",
					'value' => "",
					'onblur' => "check_invi02(this);",
					'ondblclick' => "search_invi02_window(this);",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9]/gi,'');this.value=this.value.toLocaleUpperCase();",
					'required' => "required"
				),
				'TE018' => array(
					'name' => "產品品名",
					'title_class' => "center",
					'type' => "text",
					'size' => "50",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'required' => "required"
				),
				'TE019' => array(
					'name' => "產品規格",
					'title_class' => "center",
					'type' => "text",
					'size' => "40",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TE020' => array(
					'name' => "單位",
					'title_class' => "center",
					'type' => "text",
					'size' => "4",
					'value' => "",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),

				'TE030' => array(
					'name' => "多人合作",
					'title_class' => "center",
					'type' => "text",
					'size' => "20",
					'value' => "",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_cmsi09ch_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^A-Z0-9\;]/gi,'');this.value=this.value.toLocaleUpperCase();"
				),
				'TE015' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'value' => "",
					'ondblclick' => ""
				)
			);
	}

	/*'tg024' => array(
					'name' => "急料",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox" */

	public function index()           //自訂類預設執行函數 流覽資料
	{
		$this->display_search();
	}

	public function display($offset = 0, $func = "")    //欄位表頭排序與display_search 同
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['sfci03l']['search']);
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
		$prom = substr($rms, 41, 1);

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
			unset($_SESSION['sfci03l']['search']);
		}

		// echo "<pre>";var_dump($test);exit;

		$limit = 15;    //每頁筆數
		$this->load->model('sfc/sfci03_model'); // 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;

		$result = $this->sfci03_model->constructl_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['sfci03l']['search']['sql'];  //顯示sql語法
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
		$config['base_url'] = site_url("sfc/sfci03l/display_search");   //設定分頁url路徑
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
		$data['systitle'] = '壓框-生產日報單建立作業';
		$data['menu_v'] = 'main_menu_v';
		// $data['content_v'] = 'sfc/sfci03_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('sfc/sfci03l_brow_v');
	}

	public function displayr($offset = 0, $func = "")
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 34, 1);

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
			unset($_SESSION['sfci03l']['search']);
		}

		// echo "<pre>";var_dump($test);exit; 

		$limit = 15;    //每頁筆數
		$this->load->model('sfc/sfci03_model'); // 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;

		$result = $this->sfci03_model->construct_sqlr($limit, $offset, $func, "D%08"); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['sfci03']['search']['sql'];  //顯示sql語法
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
		$config['base_url'] = site_url("sfc/sfci03l/displayr");   //設定分頁url路徑
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
		$data['systitle'] = '壓框-生產工價報表查詢';
		$data['menu_v'] = 'main_menu_v';
		// $data['content_v'] = 'sfc/sfci03l_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('sfc/sfci03l_browr_v');
	}

	public function exceldetailr()   //轉excel明細輸入起迄資料, 改報表轉出
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 34, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '壓框-生產工價報表-列印';
		$this->load->vars($data);
		$this->load->view('sfc/sfci03l_excelr_v');
	}

	public function construct_sql($offset = 0, $func = "")
	{
		$limit = 15;
		$this->load->model('sfc/sfci03_model'); // 加載TABLE model 模型
		$this->sfci03_model->construct_sql($limit, $offset, $func);
	}






	public function addform()   //新增輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 41, 1);

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
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'sfci03');
		// echo "<pre>";var_dump($coldata);exit;
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->TE003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		$data['usecol_array'] = $data['col_array'];
		// $data['date'] = date("Y/m/d");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '壓框-生產日報單-新增資料';
		// //系統參數
		// $this->load->model('sfc/sfci03_model', '', TRUE);
		// $result2 = $this->sfci03_model->funsysf();
		// $data['results2'] = $result2['rows2'];

		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03l_add_v';
		$data['foot_v'] = 'main_foot_v';
		// echo "<pre>";
		// var_dump(mb_convert_encoding($this->session->userdata('sysml002'), "utf-8", "big-5"));
		// var_dump($data);
		// exit;
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function addsave()   //新增存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 41, 1);

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
		// $coldata = $this->seti01_model->get_detail_view(trim($this->input->post('sfci01')), trim($this->input->post('td002')));
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->TE003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }

		$data['usecol_array'] = $data['col_array'];
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('sfc/sfci03_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->sfci03_model->insertf();
		if ($action === 'exist') {
			$data['message'] = '資料重複!';
		}
		//------------凍結日期------------------
		if ($action === '輸入日期資料不可小於庫存現行年月') {
			$data['message'] = '輸入日期資料不可小於庫存現行年月 !';
		}
		if ($action === '輸入日期資料須大於帳務凍結日期') {
			$data['message'] = '輸入日期資料須大於帳務凍結日期 !';
		}
		//------------凍結日期----end--------------
		// else {
		// $this->sfci03_model->auto_print();
		// }

		$data['systitle'] = '壓框-生產日報單-新增';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03l_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}




	public function updsave()   //修改存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 41, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seg1 = $this->input->post('TD001');
		$seg2 = $this->input->post('TD002');

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		$data['usecol_array'] = $data['col_array'];

		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('sfc/sfci03_model', '', TRUE);
		$this->sfci03_model->updatef();

		//回首頁
		// $this->display();
		//改回修改頁
		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;
		$data['result'] = $this->sfci03_model->selone($seg1, $seg2);

		if ($data['result'] == "no_data") {
			redirect('sfc/sfci03l/' . $this->session->userdata('sfci03_search'));
			exit;
		}

		$data['systitle'] = '壓框-生產日報單-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03l_upd_v';
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
		$prom = substr($rms, 41, 1);

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
		$this->load->model('sfc/sfci03_model');
		$data['result'] = $this->sfci03_model->selone($seg1, $seg2);
		if ($data['result'] == "no_data") {
			redirect('sfc/sfci03l/' . $this->session->userdata('sfci03l_search'));
			exit;
		}

		// echo "<pre>";
		// var_dump($data['result']);


		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'sfci03');
		// if ($coldata == "no_data" || strlen($coldata->TE003) < 5) {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->TE003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		$data['usecol_array'] = $data['col_array'];
		// echo "<pre>";		var_dump($data['usecol_array']);		exit;

		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '生產日報單-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci03l_upd_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}



	public function del()   //刪除單筆 暫存 (置於修改右按鈕)
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci03_model', '', TRUE);
		$this->sfci03_model->deletef($seg1, $seg2);
		$this->display();
	}

	public function delete()   //刪除選取
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci03_model', '', TRUE);
		$this->sfci03_model->delmutif();
		$this->display();
	}


	public function delete_detail()
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci03_model', '', TRUE);
		$this->sfci03_model->del_detail();
		redirect('sfc/sfci03/updform/' . $_POST['del_md001'] . '/' . $_POST['del_md002']);   //重新整理
	}

	public function clear_sql_term()
	{  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION["sfci03l_sql_term"]);
		}

		$this->display();
	}

	public function clear_sql()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['sfci03l']['search']);
		}
	}


	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號
	public function check_title_no()
	{
		extract($this->input->get());
		$this->load->model('sfc/sfci03_model', '', TRUE);
		$data = $this->sfci03_model->check_title_no($sfci01, $td008);
		echo $data;
	}

	//刪除單筆細項AJAX
	public function del_detail_ajax()
	{
		// extract($this->input->get());
		$seg1 = $this->input->get('tc001');
		$seg2 = $this->input->get('tc002');
		$seg3 = $this->input->get('tc003');


		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci03_model', '', TRUE);
		echo $this->sfci03_model->deletedetailf($seg1, $seg2, $seg3);
	}
}
/* End of file sfci03.php */
/* Location: ./application/controllers/sfci03.php */
