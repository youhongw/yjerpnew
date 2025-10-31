<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi19 extends CI_Controller
{           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	{
		parent::__construct();        //繼承父庫別
		$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
		$this->load->library("session");
		$this->load->library('excel');
	}

	//自訂類預設執行函數 流覽資料	
	public function index()
	{
		$limit = 15;    //每頁筆數
		$sort_order =  'desc';
		$sort_by = 'mw001';
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('cms/cmsi19_model');     // 加載TABLE model 模型		
		$result = $this->cmsi19_model->search($limit, $offset = 0, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,mw001,desc
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
		$config['base_url'] = site_url("cms/cmsi19/display/$sort_by/$sort_order");   //設定分頁url路徑
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
		$data['systitle'] = '製程代號建立作業';  //網頁抬頭顯示名稱
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'cms/cmsi19_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}

	//欄位表頭排序 資料流覽 
	public function display($sort_by = 'mw001', $sort_order = 'desc', $offset = 0)
	{
		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('cms/cmsi19_model'); // 加載TABLE model 模型		
		$result = $this->cmsi19_model->search($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,mw001,desc
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
		$config['base_url'] = site_url("cms/cmsi19/display/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		//$this->load->library('table');//加載table函數
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '製程代號建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'cms/cmsi19_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}
	//欄位表頭排序  資料流覽
	public function display_child($offset = 0, $func = "")
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('cms/cmsi19_model'); // 加載TABLE model 模型		
		$result = $this->cmsi19_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,mb001,desc
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
		$config['base_url'] = site_url("cms/cmsi19/display_child");   //設定分頁url路徑
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
		$data['systitle'] = '庫別資料建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/cmsi19d_child_v.php';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');
	}
	//篩選資料 	
	public function filter1($sort_by = 'mw001', $sort_order = 'desc', $offset = 0)
	{
		$limit = 15;
		$data['sort_by'] = $this->uri->segment(4);
		$data['sort_order'] = $this->uri->segment(5);
		$seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
		$seq7 = '1';
		$sort_order = (substr($sort_order, 0, 3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
		$data['sort_order'] = $sort_order;
		$this->load->model('cms/cmsi19_model', '', TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
		$result = $this->cmsi19_model->filterf1($limit, $offset, $sort_by, $sort_order);
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
		$config['base_url'] = site_url("cms/cmsi19/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		$config['per_page'] = $limit;
		$config['uri_segment'] = 8;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(8, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '製程代號建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'cms/cmsi19_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
		//$this->load->view('cms/cmsi19_v', $data);
	}

	//進階查詢輸入資料	
	public function findform()
	{
		$data['date'] = date("Ymd");
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '製程代號-進階查詢';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_find_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//進階查詢	
	public function findsql($sort_by = 'mw001', $sort_order = 'desc', $offset = 0)
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_POST['find005']) {
			$_SESSION['cmsi19_sql_term'] = $_POST['find005'];
		} else {
			$_SESSION['cmsi19_sql_term'] = '(mw001="") ';
		}

		if (@$_POST['find007']) {
			$_SESSION['cmsi19_sql_sort'] = $_POST['find007'];
		} else {
			$_SESSION['cmsi19_sql_sort'] = 'mw001';
		}

		$limit = 15;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$this->load->model('cms/cmsi19_model'); // 加載TABLE model 模型		
		$result = $this->cmsi19_model->findf($limit, $offset, $sort_by, $sort_order); //至model 取 mysql 資料 預設 15,0,mw001,desc
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
		$config['base_url'] = site_url("cms/cmsi19/findsql/$sort_by/$sort_order");   //設定分頁url路徑
		$config['total_rows'] = $result['num_rows']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 6;       //當前頁
		//$this->load->library('table');//加載table函數
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(6, 1);   //當前頁
		$data['limit'] = $limit;    //每頁筆數
		//$data['find05']=$this->session->userdata('find05'); 
		//$data['find07']=$this->session->userdata('find07');
		$data['systitle'] = '製程代號建立作業';
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'cms/cmsi19_brow_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
	}
	public function clear_sql_term()
	{  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION["cmsi19_sql_term"]) {
			unset($_SESSION["cmsi19_sql_term"]);
		}
		if (@$_SESSION["cmsi19_sql_sort"]) {
			unset($_SESSION["cmsi19_sql_sort"]);
		}
		$this->display();
	}

	public function clear_sql()
	{  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION["cmsi19_sql_term"]) {
			unset($_SESSION["cmsi19_sql_term"]);
		}
		if (@$_SESSION["cmsi19_sql_sort"]) {
			unset($_SESSION["cmsi19_sql_sort"]);
		}
		$this->display_child();
	}

	//新增輸入資料   
	public function addform()
	{
		$data['date'] = date("Ymd");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '製程代號-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//新增存檔	
	public function addsave()
	{
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('cms/cmsi19_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->cmsi19_model->insertf();
		if ($action === 'exist') {
			$data['message'] = '資料重複!';
		}
		$data['systitle'] = '製程代號-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//複製資料輸入	
	public function copyform()
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '製程代號-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_copy_v';
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
		$this->load->model('cms/cmsi19_model', '', TRUE);
		$data['message'] = '複製成功!';
		$action = $this->cmsi19_model->copyf();
		if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
		{
			$data['message'] = '資料重複!';
		}
		$data['systitle'] = '製程代號-複製資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_copy_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//轉excel明細輸入起迄資料
	public function exceldetail()
	{
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '製程代號-轉excel檔';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_excel_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//轉excel 檔
	public function write()
	{
		$this->load->model('cms/cmsi19_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array('製程代號', '製程名稱', '製程敘述', '性質', '線別代號', '線別名稱', '發包人員', '備註', '建立日期');  //excel 表頭
		$result1 = $this->cmsi19_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	//印明細起迄資料輸入
	public function printdetail()
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '製程代號-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_print_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	//印明細	
	public function printa()
	{
		$data['paper9'] = $this->input->post('tg009p');
		$this->load->model('cms/cmsi19_model', '', TRUE);
		$data['message'] = '列印明細成功!';
		$result = $this->cmsi19_model->printfd();
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '製程代號-印明細表';
		//$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_printa_v';
		//$data['foot_v'] ='main_footno_v';
		$this->load->vars($data);
		$this->load->view('main_headprint_v');
		//$this->load->view('cms/cmsi19_printa_v',$data);  
	}

	//修改存檔	
	public function updsave()
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('cms/cmsi19_model', '', TRUE);
		$this->load->vars($data);
		$this->cmsi19_model->updatef();
		redirect('cms/cmsi19/' . $this->session->userdata('search'));
	}

	//修改輸入資料	
	public function updform()   //修改輸入資料
	{
		$data['seq1'] = $this->uri->segment(4);
		$data['seq2'] = $this->uri->segment(5);
		$data['message'] = '查詢一筆修改資料!';
		//$this->db->get('invma');
		$this->load->model('cms/cmsi19_model');
		$data['result'] = $this->cmsi19_model->selone($this->uri->segment(4));
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '製程代號-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_upd_v';
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
		$this->load->model('cms/cmsi19_model');
		$data['result'] = $this->cmsi19_model->selone($this->uri->segment(4));
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '製程代號-查看資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'cms/cmsi19_see_v';
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
		$this->load->model('cms/cmsi19_model', '', TRUE);
		$this->cmsi19_model->deletef($seg1, $seg2);
		$this->display();
	}

	//刪除選取 
	public function delete()
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('cms/cmsi19_model', '', TRUE);
		$this->cmsi19_model->delmutif();
		$this->display();
	}

	//提示輸入資料重複
	public function checkkey()
	{
		$this->load->model('cms/cmsi19_model');
		$data['result'] = $this->cmsi19_model->ajaxkey($this->uri->segment(4));
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}

	public function check_key()
	{
		// extract($this->input->get());
		$seg1 = trim($this->uri->segment(4));
		if ($seg1 != "") {
			$this->load->model('cms/cmsi19_model', '', TRUE);
			$data = $this->cmsi19_model->ajaxkey1($seg1);
			// $relust = $data ? 'Y' : 'N';
			// echo "<pre>";	var_dump($relust);		exit;
			echo $data;
		} else {
			echo 'E';
		}
	}

	public function check_cmsi04()
	{
		extract($this->input->get());
		// $seg1 = trim($this->uri->segment(4));
		// $seg2 = trim($this->uri->segment(5));

		if ($mb001) {
			$this->load->model('cms/cmsi19_model', '', TRUE);
			$data = $this->cmsi19_model->ajaxkey2($mb001, $mb002);
			// $relust = $data ? 'Y' : 'N';
			// echo "<pre>";	var_dump($relust);		exit;
			echo $data;
		} else {
			echo 'E';
		}
	}
}
/* End of file cmsi19.php */
/* Location: ./application/controllers/cmsi19.php */
