<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pcli02 extends CI_Controller
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
		$this->display_search();
	}

	public function display($offset = 0, $func = "")    //欄位表頭排序與display_search 同
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['pcli02']['search']);
		}
		$this->display_search();
	}

	public function display_search($offset = 0, $func = "")  //欄位表頭排序
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 26, 1);

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
			unset($_SESSION['pcli02']['search']);
		}

		$limit = 15;    //每頁筆數	
		$this->load->model('pcl/pcli02_model'); // 加載TABLE model 模型		
		$result = $this->pcli02_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,ta001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數 
		$data['sql'] = $_SESSION['pcli02']['search']['sql'];
		$data['message'] = '資料流覽成功!';
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
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
		$config['cur_page'] = $this->uri->segment(4, 0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("pcl/pcli02/display_search");   //設定分頁url路徑
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
		$data['curpage'] = $this->uri->segment(4, 1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit;    //每頁筆數
		$data['systitle'] = '拋丸粗糙度測量表-流覽';
		$data['menu_v'] = 'main_menu_v';
		// $data['content_v'] = 'pcl/pcli02_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('pcl/pcli02_brow_v');
	}

	public function clear_sql_term()
	{  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$this->display();
	}

	public function addform()   //新增輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 26, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$data['date'] = date("Y/m/d");
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '拋丸粗糙度測量表-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pcl/pcli02_add_v';
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
		$prom = substr($rms, 26, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$data['username'] = $this->session->userdata('manager');
		$this->load->model('pcl/pcli02_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->pcli02_model->insertf();
		if ($action === '無資料') {
			return redirect('pcl/pcli02/addform');   //重新整理
		}
		if ($action === 'exist') {
			$data['message'] = '資料重複!';
		}

		$data['systitle'] = '拋丸粗糙度測量表-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pcl/pcli02_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}


	public function exceldetail()   //轉excel明細輸入起迄資料
	{
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '拋丸粗糙度測量表-轉excel檔';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pcl/pcli02_excel_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function write()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('pcl/pcli02_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array('製令別單', '製令單號', '開單日期', '加工廠商', '預計產量', '主件品號', '品名', '規格', '單位', '序號', '品號', '品名', '規格', '單位', '需領用量', '已領用量', '未領用量');  //excel 表頭
		$result1 = $this->pcli02_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	public function updsave()   //修改存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 26, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seq1 = trim($this->input->post('sa001'));
		$seq1 = date("Ymd", strtotime($seq1));
		$seq2 = trim($this->input->post('sa002')); //2個Key使用
		$seq3 = trim($this->input->post('sa003')); //2個Key使用

		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('pcl/pcli02_model', '', TRUE);
		$this->load->vars($data);
		$_SESSION['message1'] = $this->pcli02_model->updatef();

		redirect('pcl/pcli02/updform/' . $seq1 . '/' . $seq2 . '/' . $seq3 . '/');
	}

	public function updform()   //修改輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 26, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$data['seq1'] = $this->uri->segment(4);
		$data['seq2'] = $this->uri->segment(5);
		$data['seq3'] = $this->uri->segment(6);
		$data['seq4'] = $this->uri->segment(7);

		$seq1 = $data['seq1'];
		$seq2 = $data['seq2']; //2個Key使用
		$seq3 = $data['seq3']; //2個Key使用
		$seq4 = $data['seq4']; //2個Key使用
		//以下暫存view處理，上一筆下一筆用
		$view_str = $seq1 . "_" . $seq2 . "_" . $seq3 . "_" . $seq4; //2個Key使用
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['pcli02']['search'])) {
			$current_index = $_SESSION['pcli02']['search']['view'][$view_str]; //2個Key使用$view_str
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['pcli02']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['pcli02']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['pcli02']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('pcli02_search'));
			$this->session->set_userdata('pcli02_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('pcli02_search', "display/" . $offset);
			}
			if ($temp_ident[0] == "display_leave") {
				$this->session->set_userdata('pcli02_search', "display_leave/" . $offset);
			}
		}

		$data['message'] = '查詢一筆修改資料!';

		if (isset($_SESSION['message1'])) {
			$data['message'] = $_SESSION['message1'];
			unset($_SESSION['message1']);
		}


		$this->load->model('pcl/pcli02_model');
		$data['result'] = $this->pcli02_model->selone($seq1, $seq2, $seq3, $seq4);
		if (!$data['result']) {
			redirect('pcl/pcli02/' . $this->session->userdata('pcli02_search'));
		}
		$data['result1'] = $this->pcli02_model->selone1($seq1, $seq2, $seq3, $seq4);

		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '拋丸粗糙度測量表-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pcl/pcli02_upd_v';
		$data['foot_v'] = 'main_foot_v';

		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function see()   //看資料
	{
		$data['seq1'] = $this->uri->segment(4);
		$data['seq2'] = $this->uri->segment(5);

		$seq1 = $data['seq1'];
		$seq2 = $data['seq2']; //2個Key使用
		//以下暫存view處理，上一筆下一筆用
		$view_str = $seq1 . "_" . $seq2; //2個Key使用
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['pcli02']['search'])) {
			$current_index = $_SESSION['pcli02']['search']['view'][$view_str]; //2個Key使用$view_str
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['pcli02']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['pcli02']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['pcli02']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('pcli02_search'));
			$this->session->set_userdata('pcli02_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('pcli02_search', "display/" . $offset);
			}
			if ($temp_ident[0] == "display_leave") {
				$this->session->set_userdata('pcli02_search', "display_leave/" . $offset);
			}
		}

		$data['message'] = '查看一筆資料!';
		$this->load->model('pcl/pcli02_model');
		$data['result'] = $this->pcli02_model->selone($seq1, $seq2);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '拋丸粗糙度測量表-查看資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pcl/pcli02_see_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function del()   //刪除單筆 暫存
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		$data['message'] = '刪除資料成功!';
		$this->load->model('pcl/pcli02_model', '', TRUE);
		$this->pcli02_model->deletef($seg1, $seg2);
		$this->display();
	}

	public function delete()   //刪除選取
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('pcl/pcli02_model', '', TRUE);
		$data['message'] = $this->pcli02_model->delmutif();
		$this->display();
	}

	public function del_detail_ajax()
	{
		// extract($this->input->get());
		$seg1 = $this->input->get('sb001');
		$seg1 = date("Ymd", strtotime($seg1));
		$seg2 = $this->input->get('sb002');
		$seg3 = $this->input->get('sb003');
		$seg4 = $this->input->get('sb004');



		$data['message'] = '刪除資料成功!';
		$this->load->model('pcl/pcli02_model', '', TRUE);
		echo $this->pcli02_model->deletedetailf($seg1, $seg2, $seg3, $seg4);
	}
}
/* End of file pcli02.php */
/* Location: ./application/controllers/pcli02.php */
