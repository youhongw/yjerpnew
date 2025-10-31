<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invr19a extends CI_Controller
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
		$this->displaym();
	}

	public function display($offset = 0, $func = "")           //自訂類預設執行函數 流覽資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 23, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------End

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($this->input->post('submit')) {	//如果是由find_v送過來的，reset session
			unset($_SESSION['invr19a']['search']);
		}


		$limit = 15;    //每頁筆數
		$data['message'] = '資料瀏覽成功!';
		$data['sort_order'] = "desc";
		$this->load->model('inv/invr19a_model');     // 加載TABLE model 模型		
		$result = $this->invr19a_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc		$data['results'] = $result['rows'];   // 所有列資料
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['invr19a']['search']['sql'];  //顯示sql語法
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
		$config['base_url'] = site_url("inv/invr19a/display");   //設定分頁url路徑
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
		$data['systitle'] = '配料異動明細查詢';
		$data['menu_v'] = 'main_menu_v';
		// $data['content_v'] = 'inv/invr19a_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('inv/invr19a_brow_v');
	}

	public function displaym($offset = 0, $func = "")           //自訂類預設執行函數 流覽資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 23, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------End

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($this->input->post('submit')) {	//如果是由find_v送過來的，reset session
			unset($_SESSION['invr19a']['search']);
		}


		$limit = 15;    //每頁筆數
		$data['message'] = '資料瀏覽成功!';
		$data['sort_order'] = "desc";
		$this->load->model('inv/invr19a_model');     // 加載TABLE model 模型		
		$result = $this->invr19a_model->construct_sqlm($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc		$data['results'] = $result['rows'];   // 所有列資料
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		$data['sql'] = $_SESSION['invr19a']['search']['sql'];  //顯示sql語法
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
		$config['base_url'] = site_url("inv/invr19a/displaym");   //設定分頁url路徑
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
		$data['systitle'] = '配料進耗存查詢(月報)';
		$data['menu_v'] = 'main_menu_v';
		// $data['content_v'] = 'inv/invr19a_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('inv/invr19a_browm_v');
	}

	public function exceldetail()   //轉excel明細輸入起迄資料, 改報表轉出
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 23, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------End

		// $data['message'] = '';
		// $data['username'] = $this->session->userdata('manager');
		// $data['systitle'] = '移轉單建立-轉excel檔';
		// $data['menu_v'] = 'main_menuno_v';
		// $data['content_v'] = 'inv/invr19a_excel_v';
		// $data['foot_v'] = 'main_foot_v';
		// $this->load->vars($data);
		// $this->load->view('main_head_v');

		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '配料進耗存查詢-轉excel';
		$this->load->vars($data);
		$this->load->view('inv/invr19a_excel_v');
	}

	public function write()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('inv/invr19a_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');

		// $seq1 = trim($this->input->post('td001'));


		$title = array(
			'生產年月', '配料品號', '配料品名', '期初庫存', '本期入庫', '本期耗料', '本期損耗(可回收)', '本期損耗(不可回收)', '本期損耗(調整)', '本期損耗', '本期期末'
		);  //excel 表頭

		if ($this->input->post('action') == "exceletc") {
			$title = array(
				'生產年月日', '品號', '品名', '產生重量', '材料品號', '材料品名', '材料用量'
			);  //excel 表頭 '生產年月日', '品號', '品名', '產生重量', ' 月品號重量合計', '材料品號', '材料品名', '材料用量', '月材料用量合計'
			$result1 = $this->invr19a_model->excelnewf_etc();
			foreach ($result1 as $key => $val) {
				$result1[$key]->ta035 = mb_convert_encoding(trim($val->ta035), "utf-8", "big-5");
				$result1[$key]->MB002 = mb_convert_encoding(trim($val->MB002), "utf-8", "big-5");
			}
		} else {

			$result1 = $this->invr19a_model->excelnewf();
			foreach ($result1 as $key => $val) {
				// $result1[$i][$key] = iconv("big-5", "utf-8", $value);
				$result1[$key]->month = date('Y/m', strtotime(trim($val->month) . '01'));
				$result1[$key]->ra019disp = mb_convert_encoding(trim($val->ra019disp), "utf-8", "big-5");
				$result1[$key]->r001 = round(trim($val->r001), 3);
				$result1[$key]->r002 = round(trim($val->r002), 3);
				$result1[$key]->r003 = round(trim($val->r003), 3);
				$result1[$key]->r004 = round(trim($val->r004), 3);
				$result1[$key]->r005 = round(trim($val->r005), 3);
			}
		}


		$this->excel->writer($title, $result1);    //讀取excel  
	}

	//選取更新 
	public function dataupdate()   //提示改輸入資料如 實盤數量 不更新網頁
	{
		$seq1 = urldecode($this->uri->segment(4));
		$seq2 = $this->uri->segment(5);
		$seq3 = $this->uri->segment(6);
		$seq4 = $this->uri->segment(7);

		$this->load->model('inv/invr19a_model');
		$data['result'] = $this->invr19a_model->ajaxdata($seq1, $seq2, $seq3, $seq4);
		$Result = $data['result'];
		$this->load->vars($data);
		echo  $Result;
	}
}
/* End of file invr19a.php */
/* Location: ./application/controllers/invr19a.php */
