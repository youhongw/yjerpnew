<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sfcp03k extends CI_Controller
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

	//欄位表頭排序資料流覽 	  
	public function display($sort_by = 'da001', $sort_order = 'desc', $offset = 0)
	{
		$this->display_search();
	}

	//欄位表頭排序 資料流覽1 
	public function display_search($offset = 0, $func = "")
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 38, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		if (@session_status() == PHP_SESSION_NONE) {
			@session_start();
		}
		if ($this->input->post('submit')) {	//如果是由find_v送過來的，reset session
			unset($_SESSION['sfcp03']['search']);
		}
		$limit = 10;    //每頁筆數
		$this->load->model('sfc/sfcp03_model'); // 加載TABLE model 模型
		$result = $this->sfcp03_model->construct_sql_k($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數
		//$data['sql'] = $_SESSION['sfcp03']['search']['sql'];
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
		$config['base_url'] = site_url("sfc/sfcp03k/display_search");   //設定分頁url路徑
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
		$data['systitle'] = '裝配工價表';
		$data['menu_v'] = 'main_menu_v';

		$this->load->vars($data);
		$this->load->view('sfc/sfcp03k_brow_v');
	}


	//新增輸入資料
	public function addform()
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 38, 1);

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
		$data['systitle'] = '裝配工價-新增';

		$this->load->vars($data);
		$this->load->view('sfc/sfcp03k_add_v');
	}

	//新增存檔
	public function addsave()
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 38, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$data['username'] = $this->session->userdata('manager');
		$this->load->model('sfc/sfcp03_model', '', TRUE);
		$action = $this->sfcp03_model->selone1_k(trim($this->input->post('da001')));

		if ($action) {
			if ($this->sfcp03_model->insertf_k()) {
				$data['message'] = '裝配工價-新增成功!';
				redirect('sfc/sfcp03k/display');
			}
			$data['message'] = '裝配工價-新增失敗!';
		} else {
			$data['message'] = '裝配工價-重複!';
		}

		$data['systitle'] = '裝配工價-新增';
		$this->load->vars($data);
		$this->load->view('sfc/sfcp03k_add_v');
	}

	//轉excel 部份資料由 print_v call
	public function write()
	{
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('sfc/sfcp03_model', '', TRUE);
		$title = array('進貨入庫代號', '進貨入庫名稱', '進貨入庫密碼', '群組代號', '超級進貨入庫', '部門代號', '建立日期');  //excel 表頭
		$result1 = $this->sfcp03_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	//印明細起迄資料輸入
	public function printdetail()
	{
		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
		$data['systitle'] = '進貨入庫-印明細表';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'sfc/sfcp03k_print_v';
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
		$this->load->model('sfc/sfcp03_model', '', TRUE);
		$result = $this->sfcp03_model->printfd();
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];
		$data['numrow'] = $result['num_rows']; // 總筆數 
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '進貨入庫-印明細表';
		$data['content_v'] = 'sfc/sfcp03k_printa_v';
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
		$prom = substr($rms, 38, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$data['username'] = $this->session->userdata('manager');
		$this->load->model('sfc/sfcp03_model', '', TRUE);

		$seq1 = trim($this->input->post('pk001'));
		$data['result'] = $this->sfcp03_model->selone_k($seq1);

		if (count($data['result']) > 0) {
			if ($this->sfcp03_model->updatef_k()) {
				$_SESSION['message1'] = '裝配工價-修改成功!';
				// $data['result'] = $this->sfcp03_model->selone_k($seq1);
				redirect('sfc/sfcp03k/updform/' . $seq1);
			} else {
				$_SESSION['message1'] = '裝配工價-修改失敗!';
			}
		} else {
			$_SESSION['message1'] = '裝配工價-找不到工價!';
		}

		$data['systitle'] = '裝配工價-修改';

		$this->load->vars($data);
		$this->load->view('sfc/sfcp03k_upd_v');
	}

	//修改輸入資料
	public function updform()
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 38, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seq1 = trim($this->uri->segment(4));


		$data['message'] = '查詢一筆修改資料!';

		if (isset($_SESSION['message1'])) {
			$data['message'] = $_SESSION['message1'];
			unset($_SESSION['message1']);
		}
		$this->load->model('sfc/sfcp03_model');
		$data['result'] = $this->sfcp03_model->selone_k($seq1);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '裝配工價-修改';
		// echo "<pre>";var_dump($data);exit;
		$this->load->vars($data);
		$this->load->view('sfc/sfcp03k_upd_v');
	}


	//看資料
	public function see()
	{   //看資料
		$seq1 = $this->uri->segment(4);
		//以下暫存view處理，上一筆下一筆用
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['sfcp03k']['search'])) {
			$current_index = $_SESSION['sfcp03k']['search']['view'][$seq1];
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['sfcp03k']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['sfcp03k']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['sfcp03k']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('sfcp03k_search'));
			$this->session->set_userdata('sfcp03k_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('sfcp03k_search', "display/da001/asc/" . $offset);
			}
			if ($temp_ident[0] == "display_leave") {
				$this->session->set_userdata('sfcp03k_search', "display_leave/da001/asc/" . $offset);
			}
		}
		$data['message'] = '查看一筆資料!';
		$this->load->model('sfc/sfcp03_model');
		$data['result'] = $this->sfcp03_model->selone($seq1);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '進貨入庫-查看資料';
		//  $data['menu_v'] = 'main_menuno_v';
		//  $data['content_v'] = 'sfc/sfcp03k_see_v';
		//  $data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		//  $this->load->view('main_head_v');
		$this->load->view('sfc/sfcp03k_upd_v');
	}

	//刪除單筆 暫存
	public function del()
	{
		$seg1 = $this->uri->segment(4);

		$seg2 = $this->uri->segment(5);
		$seg3 = $this->uri->segment(6);
		$seg4 = $this->uri->segment(7);
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfcp03_model', '', TRUE);
		$this->sfcp03_model->deletef($seg1, $seg2, $seg3, $seg4);
		$this->display();
	}

	//刪除選取
	public function delete()
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('sfc/sfcp03_model', '', TRUE);
		$this->sfcp03_model->delmutif_k();
		$this->display();
	}
	//清除查詢條件
	public function clear_sql_term()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (@$_SESSION["sfcp03k_sql_term"]) {
			unset($_SESSION["sfcp03k_sql_term"]);
		}
		if (@$_SESSION["sfcp03k_sql_sort"]) {
			unset($_SESSION["sfcp03k_sql_sort"]);
		}
		// $this->display_sql();
		$this->display();
	}


	//提示改輸入資料重複 進貨入庫代號  da001
	public function check_key()
	{
		// extract($this->input->get());


		$seg1 = trim($this->uri->segment(4));
		if ($seg1 != "") {
			$this->load->model('sfc/sfcp03_model', '', TRUE);
			$data = $this->sfcp03_model->selone2($seg1);
			$relust = $data ? 'Y' : 'N';
			// echo "<pre>";	var_dump($relust);		exit;

			echo $relust;
		} else {
			echo 'E';
		}
	}
	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號

	//實際模穴數快速查詢
	public function lookup_body_check()
	{
		extract($this->input->get());
		$seq1 = urldecode($this->uri->segment(4));
		$seq2 = urldecode($this->uri->segment(5));
		$seq3 = urldecode($this->uri->segment(6));
		// $data['response'] = 'false'; //Set default response 
		$this->load->model('sfc/sfcp03_model', '', TRUE);
		$data = $this->sfcp03_model->lookupd_body_check($seq1, $seq2, $seq3); //Search DB 
		echo $data;
	}
}

/* End of file sfcp03k.php */
/* Location: ./application/controllers/sfcp03k.php */