<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Puri14 extends CI_Controller
{           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父廠商
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
	}

	//自訂類預設執行函數 流覽資料	
	public function index()
	{
		$limit = 15;    //每頁筆數
		$sort_order =  'desc';
		$sort_by = 'mc001';
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('pur/puri14_model');     // 加載TABLE model 模型		
		$result = $this->puri14_model->search($limit, $offset = 0, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,mc001,desc
		$data['results'] = $result['rows'];   // 所有列資料
		$data['num_results'] = $result['num_rows'];  // 總筆數
		//$this->load->library('pagination');
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
		$config['base_url'] = site_url("pur/puri14/display/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		// $this->load->library('table');//加載table函數
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');  //session 儲存的使用者代號
		//$data['find05']=$this->session->userdata('find05'); 
		//$data['find07']=$this->session->userdata('find07');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '廠商資料建立作業';  //網頁抬頭顯示名稱
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'pur/puri14_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	//欄位表頭排序 資料流覽 
	public function display($sort_by = 'mc001', $sort_order = 'desc', $offset = 0)
	{
		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('pur/puri14_model'); // 加載TABLE model 模型		
		$result = $this->puri14_model->search($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,mc001,desc
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
		$config['cur_page'] = $this->uri->segment(6, 0);   //當前頁 結合分頁url路徑 +1
		//$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("pur/puri14/display/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		//$this->load->library('table');//加載table函數
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '廠商資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'pur/puri14_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}


	public function clear_sql_term()
	{  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION["puri14_sql_term"]) {
			unset($_SESSION["puri14_sql_term"]);
		}
		if (@$_SESSION["puri14_sql_sort"]) {
			unset($_SESSION["puri14_sql_sort"]);
		}
		$this->display();
	}
	//新增輸入資料   
	public function addform()
	{
		$data['date'] = date("Ymd");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '廠商資料-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pur/puri14_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//新增存檔	
	public function addsave()
	{
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('pur/puri14_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->puri14_model->insertf();
		if ($action === 'exist') {
			$data['message'] = '資料重複!';
		}
		$data['systitle'] = '廠商資料-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pur/puri14_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//複製資料輸入	
	public function copyform()
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '廠商資料-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pur/puri14_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//複製存檔	
	public function copysave()
	{
		$this->load->helper('url');
		//$date=date("Ymd");
		$data['username'] = $this->session->userdata('manager');
		$this->db->get('invma');
		$this->load->model('pur/puri14_model', '', TRUE);
		$data['message'] = '複製成功!';
		$action = $this->puri14_model->copyf();
		if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
		{
			$data['message'] = '資料重複!';
		}
		$data['systitle'] = '廠商資料-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pur/puri14_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//轉excel明細輸入起迄資料
	public function exceldetail()
	{
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '廠商資料-轉excel檔';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pur/puri14_excel_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//轉excel 檔
	public function write()
	{
		$this->load->model('pur/puri14_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array('廠商代號', '廠商名稱', '廠商代號', '廠商性質', '納入MRP計算', '庫存不足准出庫', '備註', '建立日期');  //excel 表頭
		$result1 = $this->puri14_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	//印明細起迄資料輸入
	public function printdetail()
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '廠商資料-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pur/puri14_print_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//印明細	
	public function printa()
	{
		$data['paper9'] = $this->input->post('tg009p');
		$this->load->model('pur/puri14_model', '', TRUE);
		$data['message'] = '列印明細成功!';
		$result = $this->puri14_model->printfd();
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '廠商資料-印明細表';
		//$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pur/puri14_printa_v';
		//$data['foot_v'] ='main_footno_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
		//$this->load->view('pur/puri14_printa_v',$data);  
	}

	//修改存檔	
	public function updsave()
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('pur/puri14_model', '', TRUE);
		$this->load->vars($data);
		$this->puri14_model->updatef();
		redirect('pur/puri14/' . $this->session->userdata('search'));
	}

	//修改輸入資料	
	public function updform()   //修改輸入資料
	{
		$data['seq1'] = $this->uri->segment(4);
		$data['seq2'] = $this->uri->segment(5);
		$data['message'] = '查詢一筆修改資料!';
		//$this->db->get('invma');
		$this->load->model('pur/puri14_model');
		$data['result'] = $this->puri14_model->selone($this->uri->segment(4));
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '廠商資料-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pur/puri14_upd_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function see()   //看資料
	{
		$data['seq1'] = $this->uri->segment(4);
		$data['seq2'] = $this->uri->segment(5);
		$data['message'] = '查看一筆資料!';
		//$this->db->get('invma');
		$this->load->model('pur/puri14_model');
		$data['result'] = $this->puri14_model->selone($this->uri->segment(4));
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '廠商資料-查看資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pur/puri14_see_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//刪除單筆
	public function del()
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		$data['message'] = '刪除資料成功!';
		$this->load->model('pur/puri14_model', '', TRUE);
		$this->puri14_model->deletef($seg1, $seg2);
		$this->display();
	}

	//刪除選取 
	public function delete()
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('pur/puri14_model', '', TRUE);
		$this->puri14_model->delmutif();
		$this->display();
	}

	//提示輸入資料重複
	public function checkkey()
	{
		$this->load->model('pur/puri14_model');
		$data['result'] = $this->puri14_model->ajaxkey($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	//欄位表頭排序  資料流覽
	public function display_child($offset = 0, $func = "")
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('pur/puri14_model'); // 加載TABLE model 模型		
		$result = $this->puri14_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,mb001,desc
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
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("pur/puri14/display_child");   //設定分頁url路徑
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
		$data['systitle'] = '廠商資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/puri14_child_v.php';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');
	}

	public function display_child1($offset = 0, $func = "")
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('pur/puri14_model'); // 加載TABLE model 模型		
		$result = $this->puri14_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,mb001,desc
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
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("pur/puri14/display_child1");   //設定分頁url路徑
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
		$data['systitle'] = '廠商資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/puri14_child1_v.php';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');
	}

	//廠商快速查詢
	public function lookup1_puri14()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('pur/puri14_model');
		/*    $query = $this->puri14_model->lookup(
			array('mc001','mc002'),
			array('and'=>"mc001"),
			array('mc001'=>$keyword),
			10
		); */
		$query = $this->puri14_model->lookup1(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
		if (!empty($query)) {
			$data['response'] = 'true'; //Set response  
			$data['message'] = array(); //Create array  
			foreach ($query as $row) {
				$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
					'category' => '',
					'value' => $row->mc001 . "," . $row->mc002, //顯示用的欄位
					'value1' => $row->mc001,
					'value2' => $row->mc002
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
	//廠商快速查詢
	public function lookup2_puri14()
	{
		$keyword = urldecode(urldecode($this->uri->segment(4)));
		$data['response'] = 'false'; //Set default response 
		$this->load->model('pur/puri14_model');
		/*    $query = $this->puri14_model->lookup(
			array('mc001','mc002'),
			array('and'=>"mc001"),
			array('mc001'=>$keyword),
			10
		); */
		$query = $this->puri14_model->lookup2(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
		if (!empty($query)) {
			$data['response'] = 'true'; //Set response  
			$data['message'] = array(); //Create array  
			foreach ($query as $row) {
				$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
					'category' => '',
					'value' => $row->mc001 . "," . $row->mc002, //顯示用的欄位
					'value1' => $row->mc001,
					'value2' => $row->mc002
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
			unset($_SESSION['puri14']['search']);
		}
		$this->display_child();
	}

	public function clear_sql1()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['puri14']['search']);
		}
		$this->display_child1();
	}


	public function checkpuri14()   //不更改網頁 輸入資料 廠商 6明細
	{
		$this->load->model('pur/puri14_model');
		$data['result'] = $this->puri14_model->ajaxpuri14($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
	//廠商明細快速查詢
	public function lookupd_puri14()
	{
		$seq1 = trim(urldecode($this->uri->segment(4)));
		$seq2 = trim(urldecode($this->uri->segment(5)));
		// $data['response'] = 'false'; //Set default response 

		$this->load->model('pur/puri14_model');

		/*	=== _model->lookup(select_col,search_col,keyword,limit) Parameter 參數 ===
		 *
		 *	select_col = array(str1); str1 = 取得欄位名稱
		 *	search_col = array(str2,str3); str2 = 查詢欄位方法:or,and | str3 = 查詢欄位名稱
		 *	keyword = array(str4,str5); str4 = 查詢欄位名稱 | str5 = 查詢關鍵字
		 *	limit = int1; int1 = 回傳查詢結果筆數
		 */

		/*  $query = $this->invi02_model->lookupd(
			array('a.mc001','a.mc002'),
			array('and'=>"mc001"),
			array('mc001'=>$keyword),
			15
		); */
		$data = $this->puri14_model->lookupd($seq1, $seq2); //Search DB 
		echo $data;
		// if (!empty($query)) {
		// 	$data['response'] = 'true'; //Set response  
		// 	$data['message'] = array(); //Create array  
		// 	foreach ($query as $row) {
		// 		$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
		// 			'category' => '',
		// 			'value' => $row->mc001 . "," . $row->mc002, //顯示用的欄位
		// 			'value1' => $row->mc001,
		// 			'value2' => $row->mc002
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
	}
	public function check_key()
	{
		// extract($this->input->get());
		$seg1 = trim($this->uri->segment(4));
		if ($seg1 != "") {
			$this->load->model('pur/puri14_model', '', TRUE);
			$data = $this->puri14_model->ajaxkey($seg1);
			// $relust = $data ? 'Y' : 'N';
			// echo "<pre>";	var_dump($relust);		exit;
			echo $data;
		} else {
			echo 'E';
		}
	}
}
/* End of file puri14.php */
/* Location: ./application/controllers/puri14.php */
