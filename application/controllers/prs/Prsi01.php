<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prsi01 extends CI_Controller
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
			unset($_SESSION['prsi01']['search']);
		}
		$this->display_search();
	}

	public function display_search($offset = 0, $func = "")  //欄位表頭排序
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 24, 1);

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
			unset($_SESSION['prsi01']['search']);
		}

		$limit = 15;    //每頁筆數	
		$this->load->model('prs/prsi01_model'); // 加載TABLE model 模型		
		$result = $this->prsi01_model->construct_sql($limit, $offset, $func); //至model 取 mysql 資料 預設 15,0,ta001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow'] = $result['num']; // 總筆數 
		$data['page'] = $result['num'] / $limit; // 總頁數 
		$data['sql'] = $_SESSION['prsi01']['search']['sql'];
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
		$config['base_url'] = site_url("prs/prsi01/display_search");   //設定分頁url路徑
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
		$data['systitle'] = '溶解生產記錄表-流覽';
		$data['menu_v'] = 'main_menu_v';
		// $data['content_v'] = 'prs/prsi01_brow_v';
		// $data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		// $this->load->view('main_headbrow_v');
		$this->load->view('prs/prsi01_brow_v');
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
		$prom = substr($rms, 24, 1);

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
		$data['systitle'] = '溶解生產記錄表-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'prs/prsi01_add_v';
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
		$prom = substr($rms, 24, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$data['username'] = $this->session->userdata('manager');
		$this->load->model('prs/prsi01_model', '', TRUE);
		$data['message'] = '新增成功!';
		$action = $this->prsi01_model->insertf();
		if ($action === '無資料') {
			return redirect('prs/prsi01/addform');   //重新整理
		}
		if ($action === 'exist') {
			$data['message'] = '資料重複!';
		}

		$data['systitle'] = '溶解生產記錄表-新增資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'prs/prsi01_add_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}


	public function exceldetail()   //轉excel明細輸入起迄資料
	{
		$data['message'] = '';
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '溶解生產記錄表-轉excel檔';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'prs/prsi01_excel_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function write()   //轉excel 部份資料由 print_v call
	{
		$this->load->model('prs/prsi01_model', '', TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$title = array('製令別單', '製令單號', '開單日期', '加工廠商', '預計產量', '主件品號', '品名', '規格', '單位', '序號', '品號', '品名', '規格', '單位', '需領用量', '已領用量', '未領用量');  //excel 表頭
		$result1 = $this->prsi01_model->excelnewf();
		$this->excel->writer($title, $result1);    //讀取excel  
	}

	public function updsave()   //修改存檔
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 24, 1);

		if (!$user) {
			redirect('/login/');
		}
		if (!($super == 'Y' || $prom == 'Y')) {
			$_SESSION['rms'] = 'N';
			redirect('/main'); //跳回首頁
		}
		//權限控管--------------------------------END

		$seq1 = trim($this->input->post('da001'));
		$seq1 = date("Ymd", strtotime($seq1));
		$seq2 = trim($this->input->post('da002')); //2個Key使用


		$data['username'] = $this->session->userdata('manager');
		$data['message'] = '修改資料成功!';
		$this->load->model('prs/prsi01_model', '', TRUE);
		$this->load->vars($data);
		$_SESSION['message1'] = $this->prsi01_model->updatef();

		redirect('prs/prsi01/updform/' . $seq1 . '/' . $seq2 . '/');
	}

	public function updform()   //修改輸入資料
	{
		//權限控管--------------------------------
		$user = trim($this->session->userdata('sysuser'));
		$super = trim($this->session->userdata('syssuper'));
		$rms = trim($this->session->userdata('sysuserrms'));
		$prom = substr($rms, 24, 1);

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

		$seq1 = $data['seq1'];
		$seq2 = $data['seq2']; //2個Key使用
		//以下暫存view處理，上一筆下一筆用
		$view_str = $seq1 . "_" . $seq2; //2個Key使用
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['prsi01']['search'])) {
			$current_index = $_SESSION['prsi01']['search']['view'][$view_str]; //2個Key使用$view_str
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['prsi01']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['prsi01']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['prsi01']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('prsi01_search'));
			$this->session->set_userdata('prsi01_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('prsi01_search', "display/" . $offset);
			}
			if ($temp_ident[0] == "display_leave") {
				$this->session->set_userdata('prsi01_search', "display_leave/" . $offset);
			}
		}

		$data['message'] = '查詢一筆修改資料!';

		if (isset($_SESSION['message1'])) {
			$data['message'] = $_SESSION['message1'];
			unset($_SESSION['message1']);
		}


		$this->load->model('prs/prsi01_model');
		$data['result'] = $this->prsi01_model->selone($seq1, $seq2);
		if (!$data['result']) {
			redirect('prs/prsi01/' . $this->session->userdata('prsi01_search'));
		}
		$data['result1'] = $this->prsi01_model->selone1($seq1, $seq2);
		$data['result2'] = $this->prsi01_model->selone2($seq1, $seq2);
		$data['result3'] = $this->prsi01_model->selone3($seq1, $seq2);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '溶解生產記錄表-修改資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'prs/prsi01_upd_v';
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
		if (isset($_SESSION['prsi01']['search'])) {
			$current_index = $_SESSION['prsi01']['search']['view'][$view_str]; //2個Key使用$view_str
			if ($current_index != 0) {
				$data['prev'] = $_SESSION['prsi01']['search']['index'][$current_index - 1];
			}
			if (isset($_SESSION['prsi01']['search']['index'][$current_index + 1])) {
				$data['next'] = $_SESSION['prsi01']['search']['index'][$current_index + 1];
			}
			$offset = floor($current_index / 15) * 15;
			$temp_ident = explode('/', $this->session->userdata('prsi01_search'));
			$this->session->set_userdata('prsi01_search', "display_search/" . $offset);
			if ($temp_ident[0] == "display") {
				$this->session->set_userdata('prsi01_search', "display/" . $offset);
			}
			if ($temp_ident[0] == "display_leave") {
				$this->session->set_userdata('prsi01_search', "display_leave/" . $offset);
			}
		}

		$data['message'] = '查看一筆資料!';
		$this->load->model('prs/prsi01_model');
		$data['result'] = $this->prsi01_model->selone($seq1, $seq2);
		$data['username'] = $this->session->userdata('manager');
		$data['systitle'] = '溶解生產記錄表-查看資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'prs/prsi01_see_v';
		$data['foot_v'] = 'main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
	}

	public function del()   //刪除單筆 暫存
	{
		$seg1 = $this->uri->segment(4);
		$seg2 = $this->uri->segment(5);
		$data['message'] = '刪除資料成功!';
		$this->load->model('prs/prsi01_model', '', TRUE);
		$this->prsi01_model->deletef($seg1, $seg2);
		$this->display();
	}

	public function delete()   //刪除選取
	{
		$data['message'] = '刪除資料成功!';
		$this->load->model('prs/prsi01_model', '', TRUE);
		$data['message'] = $this->prsi01_model->delmutif();
		$this->display();
	}

	public function del_detail_ajax()
	{
		// extract($this->input->get());
		$seg1 = $this->input->get('db001');
		$seg1 = date("Ymd", strtotime($seg1));
		$seg2 = $this->input->get('db002');
		$seg3 = $this->input->get('db003');


		$data['message'] = '刪除資料成功!';
		$this->load->model('prs/prsi01_model', '', TRUE);
		echo $this->prsi01_model->deletedetailf($seg1, $seg2, $seg3);
	}

	public function del_detail_ajax1()
	{
		// extract($this->input->get());
		$seg1 = $this->input->get('dc001');
		$seg1 = date("Ymd", strtotime($seg1));
		$seg2 = $this->input->get('dc002');
		$seg3 = $this->input->get('dc003');


		$data['message'] = '刪除資料成功!';
		$this->load->model('prs/prsi01_model', '', TRUE);
		echo $this->prsi01_model->deletedetailf1($seg1, $seg2, $seg3);
	}

	public function del_detail_ajax2()
	{
		// extract($this->input->get());
		$seg1 = $this->input->get('dd001');
		$seg1 = date("Ymd", strtotime($seg1));
		$seg2 = $this->input->get('dd002');
		$seg3 = $this->input->get('dd003');


		$data['message'] = '刪除資料成功!';
		$this->load->model('prs/prsi01_model', '', TRUE);
		echo $this->prsi01_model->deletedetailf2($seg1, $seg2, $seg3);
	}
}
/* End of file prsi01.php */
/* Location: ./application/controllers/prsi01.php */
