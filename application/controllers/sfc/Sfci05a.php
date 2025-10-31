<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); //这一句要求此文件必须通过index.php 调用执行

class sfci05a extends CI_Controller
{           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架 第一個字母大寫)

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父類別
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
		date_default_timezone_set("Asia/Taipei");  //設置時區
		//  $this->output->cache(480);  //緩衝 
		$this->no_col = "TC003";	//序號欄位
		$this->detail_col =
			array(
				'TC003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'disabled' => "disabled",
					'readonly' => "readonly"
				),
				'TC004' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'style' => "background-color:#FFFFE4",
					'onblur' => "check_sfcta(this)",
					'ondblclick' => "search_sfci03a_window(this);",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'required' => "required"
				),
				'TC005' => array(
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
				'TC047' => array(
					'name' => "產品品號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'size' => "18"
				),
				'TC048' => array(
					'name' => "產品品名",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'size' => "50"
				),
				'TC049' => array(
					'name' => "產品規格",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'size' => "40"
				),
				'TC035' => array(
					'name' => "急料",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'value' => "N",
					'option' => array('N' => "非急料", 'Y' => "急料")
				),
				'TC010' => array(
					'name' => "單位",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'size' => "4"
				),
				'TC006' => array(
					'name' => "移出工序",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'value' => "",
					'maxlength' => "4",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03_window(this);"
				),
				'TC007' => array(
					'name' => "移出製程",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'id' => "cmsi03",
					'readonly' => "value",
					'style' => "background-color:#F0F0F0",
				),
				'TC007disp' => array(
					'name' => "移出製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'size' => "30"
				),
				// 'TC007disp1' => array(
				// 	'name' => "移出製程敘述",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'style' => "background-color:#F0F0F0",
				// 	'readonly' => "value",
				// 	'size' => "10"
				// ),
				'TC008' => array(
					'name' => "移入工序",
					'title_class' => "center",
					'type' => "text",
					'size' => "8",
					'maxlength' => "4",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'style' => "background-color:#FFFFE4",
					'ondblclick' => "search_sfci03_window(this,1);"
				),
				'TC009' => array(
					'name' => "移入製程",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'id' => "cmsi03",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value"
				),
				'TC009disp' => array(
					'name' => "移入製程名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'size' => "30"
				),
				// 'TC009disp1' => array(
				// 	'name' => "移入製程敘述",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'style' => "background-color:#F0F0F0",
				// 	'readonly' => "value",
				// 	'size' => "10"
				// ),
				'TC013' => array(
					'name' => "型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('1' => "正常完成", '2' => "重工完成", '3' => "退回重工", '4' => "撥轉", '5' => "盤盈損", '6' => "投入")
				),
				'TC036' => array(
					'name' => "數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pre(1,this);",
					'required' => "required"
				),
				'TC038' => array(
					'name' => "驗收日期",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'style' => "background-color:#FFFFE4",
					'onchange' => "dateformat_ymd(this)",
					'ondblclick' => "scwShow(this,event);",
					'placeholder' => "yyyy/mm/dd"
				),
				'TC014' => array(
					'name' => "驗收數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pre(2,this);",
					'required' => "required"
				),
				'TC016' => array(
					'name' => "報廢數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pre(3,this);",
					'required' => "required"
				),
				'TC037' => array(
					'name' => "驗退數量",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'value' => "0",
					'onkeyup' => "this.value=this.value.replace(/[^0-9]/gi,'');",
					'onchange' => "count_pre(4,this);",
					'required' => "required"
				),
				// 'TC020' => array(
				// 	'name' => "使用人時",
				// 	'title_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'value' => "0",
				// 	'style' => "background-color:#F0F0F0",
				// 	'readonly' => "value",
				// 	'ondblclick' => ""
				// ),
				// 'TC021' => array(
				// 	'name' => "使用機時",
				// 	'title_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'value' => "0",
				// 	'style' => "background-color:#F0F0F0",
				// 	'readonly' => "value",
				// 	'ondblclick' => ""
				// ),
				'TC039' => array(
					'name' => "檢驗狀態",
					'title_class' => "center",
					'type' => "select",
					'style' => "background-color:#EEF1CE",
					'option' => array('0' => "免檢", '1' => "待驗", '2' => "合格", '3' => "不良", '4' => "特採")
				),
				// 'TC032' => array(
				// 	'name' => "批號",
				// 	'title_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'value' => "",
				// 	'disabled' => "disabled",
				// 	'ondblclick' => ""
				// ),
				// 'TC033' => array(
				// 	'name' => "有效日期",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'disabled' => "disabled",
				// 	'style' => "background-color:#FFFFE4",
				// 	'onchange' => "dateformat_ymd(this)",
				// 	'ondblclick' => "scwShow(this,event);"
				// ),
				// 'TC034' => array(
				// 	'name' => "複驗日期",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'disabled' => "disabled",
				// 	'style' => "background-color:#FFFFE4",
				// 	'onchange' => "dateformat_ymd(this)",
				// 	'ondblclick' => "scwShow(this,event);"
				// ),
				'TC201' => array(
					'name' => "機台樣式",
					'title_class' => "center",
					'type' => "text",
					'size' => "1",
					'value' => "",
					'onkeyup' => "this.value=this.value.replace(/[^1-2]/gi,'');",
					'style' => "background-color:#FFFFE4",
					'required' => "required"
				),
				'TC031' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'value' => "",
					'ondblclick' => ""
				),
				// 'TC024' => array(
				// 	'name' => "預交日期",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'disabled' => "disabled",
				// 	'style' => "background-color:#FFFFE4",
				// 	'onchange' => "dateformat_ymd(this)",
				// 	'ondblclick' => "scwShow(this,event);"
				// ),

				// 'TC025' => array(
				// 	'name' => "已交數量",
				// 	'title_class' => "center",
				// 	'type' => "text",
				// 	'size' => "10",
				// 	'value' => "0",
				// 	'disabled' => "disabled",
				// 	'ondblclick' => ""
				// ),
				// 'TC026' => array(
				// 	'name' => "結案碼",
				// 	'title_class' => "center",
				// 	'data_class' => "center",
				// 	'type' => "select",
				// 	'style' => "background-color:#F0F0F0",
				// 	'disabled' => "disabled",
				// 	'value' => "N",
				// 	'option' => array('N' => "未結案", 'Y' => "自動結案", 'y' => "指定結案")
				// )
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
			unset($_SESSION['sfci05a']['search']);
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
		$prom = substr($rms, 6, 1);

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
			unset($_SESSION['sfci05a']['search']);
		}

		// echo "<pre>";var_dump($test);exit;

		$limit = 15;    //每頁筆數
		$this->load->model('sfc/sfci05a_model'); // 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;

		$result = $this->sfci05a_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['sfci05a']['search']['sql'];  //顯示sql語法
		// $data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['message'] = '資料瀏覽成功!';

		if (isset($_SESSION['message1'])) {
			$data['message'] = $_SESSION['message1'];
			unset($_SESSION['message1']);
		}
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
		$config['base_url'] = site_url("sfc/sfci05a/display_search");   //設定分頁url路徑
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
		$data['systitle'] = '移轉單建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'sfc/sfci05a_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
		// $this->load->view('sfc/sfci05a_brow_v');
	}

	public function construct_sql($offset = 0, $func = "")
	{
		$limit = 15;
		$this->load->model('sfc/sfci05a_model'); // 加載TABLE model 模型
		$this->sfci05a_model->construct_sql($limit, $offset, $func);
	}


	//iconv_substr('字串', 0, 20, 'utf-8'); 擷取字串前幾個字並避免截掉半個中文字

	// 下拉視窗不更新網頁查 品號品名
	public function lookup()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('sfc/sfci05a_model');
		$query = $this->sfci05a_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 

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
			echo json_encode($data); //echo json string if ajax request 指定回傳格式 字串陣列
		} else {
			$this->load->view('sfc/sfci05a_model/lookup', $data);
			// $this->index; //Load html view of search results  
		}
	}

	// 下拉視窗不更新網頁查 交貨庫別
	public function lookupa()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('sfc/sfci05a_model');
		$query = $this->sfci05a_model->lookupa(urldecode(urldecode($this->uri->segment(4)))); //Search DB 

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
			$this->load->view('sfc/sfci05a_model/lookupa', $data);
			// $this->index; //Load html view of search results  
		}
	}

	/* 不用此功能 1060814	
	  public function datapurq04a()   //提示改輸入資料如 移轉單別   不更新網頁
          {
	        $this->load->model('sfc/sfci05a_model');
	        $data['result'] = $this->sfci05a_model->ajaxpurq04a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }
		
	  public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
        {
	      $this->load->model('sfc/sfci05a_model');
	      $data['result'] = $this->sfci05a_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	  public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁tb010
        {
	      $this->load->model('sfc/sfci05a_model');
	      $data['result'] = $this->sfci05a_model->ajaxcmsq02a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	  public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁tb012
        {
	      $this->load->model('sfc/sfci05a_model');
	      $data['result'] = $this->sfci05a_model->ajaxpalq01a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	  public function datachkno1()   //提示改輸入資料如  移轉單號 不更新網頁tb012
        {
	      $this->load->model('sfc/sfci05a_model');
	      $data['result'] = $this->sfci05a_model->ajaxchkno1($this->uri->segment(4),$this->uri->segment(5));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }  */

	//篩選資料舊版 單一選項無and or
	public function filter1($sort_by = 'tb001', $sort_order = 'desc', $offset = 0)
	{
		$limit = 15;
		$data['sort_by'] = $this->uri->segment(4);
		$data['sort_order'] = $this->uri->segment(5);
		$seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
		$seq7 = '1';
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
		$data['sort_order'] = $sort_order;
		$this->load->model('sfc/sfci05a_model', '', TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
		$result = $this->sfci05a_model->filterf1($limit, $offset, $sort_by, $sort_order);
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
		$config['base_url'] = site_url("sfc/sfci05a/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		$config['per_page'] = $limit;
		$config['uri_segment'] = 8;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(8, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '移轉單建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'sfc/sfci05a_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function findform()   //進階查詢輸入資料
	{
		$data['date'] = date("Ymd");
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '移轉單建立-進階查詢';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_find_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function findsql($sort_by = 'tb001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	{
		//下一頁不跑版
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_POST['find005']) {
			$_SESSION['sfci05a_sql_term'] = $_POST['find005'];
		}
		if (@$_POST['find007']) {
			$_SESSION['sfci05a_sql_sort'] = $_POST['find007'];
		}
		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('sfc/sfci05a_model'); // 加載TABLE model 模型		
		$result = $this->sfci05a_model->findf($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,tb001,desc
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
		$config['cur_page'] = $this->uri->segment(6, 0);   //當前頁 結合分頁url路徑 5+1=6
		$this->pagination->initialize($config);    //分頁初始化 display 3
		$config['base_url'] = site_url("sfc/sfci05a/findsql/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '移轉單建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'sfc/sfci05a_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	public function clear_sql_term()
	{  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION["sfci05a_sql_term"]) {
			unset($_SESSION["sfci05a_sql_term"]);
		}
		if (@$_SESSION["sfci05a_sql_sort"]) {
			unset($_SESSION["sfci05a_sql_sort"]);
		}
		//1060809
		unset($_SESSION['sfci05a']['search']['where']);
		unset($_SESSION['sfci05a']['search']['order']);
		unset($_SESSION['sfci05a']['search']['offset']);
		$this->display();
	}

	public function addform()   //新增輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 6, 1);

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
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'sfci05a');
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->ta003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }

		$data['usecol_array'] = $data['col_array'];

		// $data['date'] = date("Y/m/d");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '移轉單建立-新增資料';
		//系統參數
		// $this->load->model('sfc/sfci05a_model','',TRUE);
		// $result2 = $this->sfci05a_model->funsysf();
		//  $data['results2'] = $result2['rows2'];

		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_add_v';
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
		$prom = substr($rms, 6, 1);

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
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'sfci05a');
		// if ($coldata == "no_data") {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->TC003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		$data['usecol_array'] = $data['col_array'];
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->sfci05a_model->insertf();
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
		// 	$this->sfci05a_model->auto_print();
		// }

		$data['systitle'] = '移轉單建立-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copyform()   //複製資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '移轉單建立-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function copysave()   //複製存檔
	{
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$data['message'] = '複製成功!';
		$action = $this->sfci05a_model->copyf();
		if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
		{
			$data['message'] = '資料重複!';
		}
		$data['systitle'] = '移轉單建立-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	/*	 
      public function exceldetail()   //轉excel明細輸入起迄資料, 改報表轉出
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='移轉單建立-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'sfc/sfci05a_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        } */

	public function write()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array('移轉單別', '移轉單號', '訂單日期', '客戶代號', '客戶名稱', '序號', '品號', '品名', '規格', '單位', '數量', '單價', '金額');  //excel 表頭
		$result1 = $this->sfci05a_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	public function printdetail()   //印明細起迄資料輸入
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '移轉單建立-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_print_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function printdetailc()   //印明細起迄資料輸入(訂單一次筆列印)
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '移轉單建立-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_print1_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function printc()   //印移轉單 訂單一次多筆列印
	{
		$data['paper9'] = $this->input->post('ta009c');
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$data['message'] = '列印移轉單!';
		//公司參數
		$result1 = $this->sfci05a_model->companyf();
		$data['results1'] = $result1['rows1'];

		$result = $this->sfci05a_model->printfc();
		$data['results'] = $result['rows'];
		$this->load->vars($data);
		$this->load->view('sfc/sfci05a_printc_v');
	}

	public function printbb($ta009c)   //印移轉單
	{
		$data['paper9'] = $ta009c;
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$data['message'] = '列印移轉單!';
		//公司參數
		$result1 = $this->sfci05a_model->companyf();
		$data['results1'] = $result1['rows1'];

		$result = $this->sfci05a_model->printfb();
		$data['results'] = $result['rows'];
		$this->load->vars($data);
		$this->load->view('sfc/sfci05a_printb_v');
	}

	public function auto_printbb()
	{    //自動列印
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$data['message'] = '列印移轉單!';

		$result = $this->sfci05a_model->printfb();
		$data['results'] = $result['rows'];
		$this->load->vars($data);
		$this->load->view('sfc/sfci05a_printb_v');
	}

	public function printa()   //印明細
	{
		$data['paper9'] = $this->input->post('ta009c');
		if ($this->input->post('action') == "excel") {
			$this->write();                          //轉excel
		}

		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$data['message'] = '列印明細成功!';
		$result = $this->sfci05a_model->printfd();
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		//$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '移轉單建立-印明細表';
		$data['content_v'] = 'sfc/sfci05a_printa_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
	}

	public function updsave()   //修改存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 6, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seg1 = $this->input->post('TB001');
		$seg2 = $this->input->post('TB002');

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		$data['usecol_array'] = $data['col_array'];

		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('sfc/sfci05a_model', '', TRUE);

		$this->sfci05a_model->updatef();

		//回首頁
		// $this->display();
		//改回修改頁
		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;

		$data['result'] = $this->sfci05a_model->selone($seg1, $seg2);
		if ($data['result'] == "no_data") {
			redirect('sfc/sfci05a/' . $this->session->userdata('sfci05a_search'));
			exit;
		}

		$data['systitle'] = '移轉單建立-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_upd_v';
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
		$prom = substr($rms, 6, 1);

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
		$this->load->model('sfc/sfci05a_model');
		$data['result'] = $this->sfci05a_model->selone($seg1, $seg2);
		if ($data['result'] == "no_data") {
			redirect('sfc/sfci05a/' . $this->session->userdata('sfci05a_search'));
			exit;
		}

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		// $this->load->model('set/seti01_model');
		// $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'sfci05a');
		// if ($coldata == "no_data" || strlen($coldata->TC003) < 5) {
		// 	$data['usecol_array'] = $data['col_array'];
		// } else {
		// 	$usecol_array = explode(',', $coldata->TC003);
		// 	$data['usecol_array'] = array();
		// 	foreach ($usecol_array as $key => $val) {
		// 		$data['usecol_array'][$val] = $data['col_array'][$val];
		// 	}
		// }
		$data['usecol_array'] = $data['col_array'];

		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '移轉單建立-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_upd_v';
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
		if (isset($_SESSION['sfci05a']['search']) && isset($_SESSION['sfci05a']['search']['view'][$view_str])) {
			$current_index = $_SESSION['sfci05a']['search']['view'][$view_str];
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['sfci05a']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['sfci05a']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['sfci05a']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('sfci05a_search'));
			$this->session->set_userdata('sfci05a_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('sfci05a_search', "display/tb002/desc/" . $offset);
			}
		}

		$data['seg1'] = $seg1;
		$data['seg2'] = $seg2;
		$data['message'] = '查詢一筆資料!';
		$this->load->model('sfc/sfci05a_model');
		$data['result'] = $this->sfci05a_model->selone($seg1, $seg2);
		if ($data['result'] == "no_data") {
			redirect('sfc/sfci05a/' . $this->session->userdata('sfci05a_search'));
			exit;
		}

		//Default columns 檢視明細設定
		$data['no_col'] = $this->no_col;
		$data['col_array'] = $this->detail_col;
		$this->load->model('set/seti01_model');
		$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'sfci05a');
		if ($coldata == "no_data" || strlen($coldata->TC003) < 5) {
			$data['usecol_array'] = $data['col_array'];
		} else {
			$usecol_array = explode(',', $coldata->TC003);
			$data['usecol_array'] = array();
			foreach ($usecol_array as $key => $val) {
				$data['usecol_array'][$val] = $data['col_array'][$val];
			}
		}

		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '移轉單建立-查看資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfci05a_see_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function del()   //刪除單筆 暫存 (置於修改右按鈕)
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$this->sfci05a_model->deletef($seg1, $seg2);
		$this->display();
	}

	public function delete()   //刪除選取
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$this->sfci05a_model->delmutif();
		$this->display();
	}

	public function printb()   //印單據選取
	{
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$data['message'] = '列印單據成功!';
		$result = $this->sfci05a_model->printfd1($this->uri->segment(4), $this->uri->segment(5));
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '移轉單';
		$data['content_v'] = 'sfc/sfci05a_printb_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
	}

	public function delete_detail()
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$this->sfci05a_model->del_detail();
		redirect('sfc/sfci05a/updform/' . $_POST['del_md001'] . '/' . $_POST['del_md002']);   //重新整理
	}

	//欄位表頭排序   資料流覽 開視窗
	public function display_child($offset = 0, $func = "")
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('sfc/sfci05a_model'); // 加載TABLE model 模型
		$result = $this->sfci05a_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,ma001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數 
		$config = array();
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
		$config['base_url'] = site_url("sfc/sfci05a/display_child");   //設定分頁url路徑
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
		$data['systitle'] = '廠商基本資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'sfc/sfci05a_child_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');
	}

	public function clear_sql()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['sfci05a']['search']);
		}
	}

	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號
	public function check_title_no()
	{
		extract($this->input->get());
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		$data = $this->sfci05a_model->check_title_no($sfci01m, $TB015);
		echo $data;
	}

	//刪除單筆細項AJAX
	public function del_detail_ajax()
	{
		$seg1 = $this->input->get('TC001');
		$seg2 = $this->input->get('TC002');
		$seg3 = $this->input->get('TC003');
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfci05a_model', '', TRUE);
		echo $this->sfci05a_model->deletedetailf($seg1, $seg2, $seg3);
	}
}
/* End of file sfci05a.php */
/* Location: ./application/controllers/sfci05a.php */
