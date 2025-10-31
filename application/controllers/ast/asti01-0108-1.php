<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asti01 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
		  header("Content-type: text/html; charset=utf-8");
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		//  $this->output->cache(480);  //緩衝 
		//  $this->load->library('upload');
	    }
		
	//自訂類預設執行函數 流覽資料	
	public function index()           
	    {                      
           $this->display_search();
	    }
	public function display($offset = 0,$func = "")  
	  {
		  //session_status() is used to return the current session status.
		  //PHP_SESSION_NONE if sessions are enabled, but none exists. PHP_SESSION_ACTIVE if sessions are enabled, and one exists.
		 // 設定 $_SESSION["a"][0][50]像這個樣子。 然後可以用變數$a[0][50]的方式來取得。 
		 if (session_status() == PHP_SESSION_NONE) {
				session_start();
				unset($_SESSION['asti01']['search']);
			}
		  $this->display_search();
		
	  }
	  
	 //欄位表頭排序 資料流覽 
	public function display_search($offset = 0,$func = "")  
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
			unset($_SESSION['asti01']['search']);
		}
		$limit = 15;    //每頁筆數
		$this->load->model('ast/asti01_model');// 加載TABLE model 模型
		$result= $this->asti01_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['asti01']['search']['sql'];
		// $data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['message'] = '資料瀏覽成功!';
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
		$config = array();
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
		$config['per_page'] = '15';// 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config ['next_link'] = '下一頁>';
		$config ['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4,0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("ast/asti01/display_search");   //設定分頁url路徑
		/* 網址去除".html" 字串進行切割 陣列,  */
		$temp_url = explode(".html",$config['base_url']);
		$config['base_url'] = "";
		foreach($temp_url as $key => $val){$config['base_url'].=$val;}
		
		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();	
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4,1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit ;    //每頁筆數
		$data['systitle'] ='資產類別建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'ast/asti01_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	  
	  public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('ast/asti01_model');// 加載TABLE model 模型
		$this->asti01_model->construct_sql($limit, $offset ,$func);
	}
		
	//篩選資料	
	public function filter1($sort_by = 'ma001', $sort_order = 'desc', $offset = 0)   
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('ast/asti01_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->asti01_model->filterf1($limit, $offset , $sort_by  , $sort_order);
	     $data['message'] = '篩選資料成功!';	
	     $data['results'] = $result['rows'];
	     $data['num_results'] = $result['num_rows'];
	     $this->load->library('pagination');
	     $data['numrow']= $result['num_rows'];  // 總筆數 
	     $data['page'] = $result['num_rows']/$limit;  // 總頁數 
	     $config = array();
         $config['per_page'] = $limit;// 每頁筆數
	     $config['total_rows'] = $result['num_rows'];  // 總筆數 
	     $config['first_link'] = '首頁';
	     $config['last_link'] = '尾頁';
	     $config ['next_link'] = '下一頁>';
         $config ['prev_link'] = '<上一頁';
	     $config['display_pages'] = TRUE;  //顯示數字鏈接
	     $config['full_tag_open'] = '<p>';
	     $config['full_tag_close'] = '</p>'; 
	     $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
         $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	     $config['cur_page'] = $this->uri->segment(8,0);   //當前頁 結合分頁url路徑 +1
	     $config['base_url'] = site_url("ast/asti01/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='資產類別建立建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'ast/asti01_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
	   //$this->load->view('ast/asti01_v', $data);
        }
		
	//進階查詢輸入資料	
    public function findform()   
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='資產類別建立-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ast/asti01_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
    //進階查詢流覽資料 
	public function findsql($sort_by = 'ma001', $sort_order = 'desc', $offset = 0)  
	    {		
		   if (session_status() == PHP_SESSION_NONE) {
			session_start();
		   }
		  if(@$_POST['find005']){
			$_SESSION['asti01_sql_term'] = $_POST['find005'];
		  }
		  if(@$_POST['find007']){
			$_SESSION['asti01_sql_sort'] = $_POST['find007'];
		  }
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('ast/asti01_model');// 加載TABLE model 模型		
	      $result= $this->asti01_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ma001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
	      $config['per_page'] = '15';// 每頁筆數 必填
	      $config['first_link'] = '首頁';
	      $config['last_link'] = '尾頁';
	      $config ['next_link'] = '下一頁>';
          $config ['prev_link'] = '<上一頁';
	      $config['display_pages'] = TRUE;  //顯示數字鏈接 
	      $config['full_tag_open'] = '<p>';  // 分頁開始樣式
	      $config['full_tag_close'] = '</p>';   // 分頁结束樣式	
	      $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
          $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	      $config['cur_page'] = $this->uri->segment(6,0);   //當前頁 結合分頁url路徑 +1
	      $this->pagination->initialize($config);    //分頁初始化 display 3
	      $config['base_url'] = site_url("ast/asti01/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='資產類別建立建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'ast/asti01_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		
		 public function clear_sql_term(){  //清除條件
		  if (session_status() == PHP_SESSION_NONE) {
			session_start();
		   }
		  if(@$_SESSION["asti01_sql_term"]) {unset($_SESSION["asti01_sql_term"]);}
		  if(@$_SESSION["asti01_sql_sort"]) {unset($_SESSION["asti01_sql_sort"]);}
		  $this->display();
	  }
	  
	//新增輸入資料    
    public function addform()   
        {
		 $data['uploadfile'] = 'image.jpg';
	     $data['date']= date("Ymd");
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='資產類別建立-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ast/asti01_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	  
	// upload 圖片new
	public  function img_upload()
      {  
	    $userfile=$this->uri->segment(4);
	 //  $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/UploadFiles/";  //上傳文件的路徑 
	    $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/assets/image/jpg/";  //上傳文件的路徑 
		$filename = iconv("UTF-8","big5",$_FILES['userfile']['name']);    //上傳文件的名稱
    //  $this->issetFile($filePath,$filename);
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 0;
        $type = $_FILES['userfile']['type'];
		$this->load->vars($config);
        $this->load->library('upload', $config);   
		//$msg2=$this->upload->do_upload('userfile');
		$data['result']=move_uploaded_file($_FILES['userfile']['tmp_name'],$filePath.$_FILES['userfile']['name']);
		$Result = $data['result'];		  
	    $this->load->vars($data);
	     echo  $Result;
	   }
	   
	//新增存檔	
    public function addsave()   
        {
		
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('ast/asti01_model','',TRUE);
	     $data['message'] = '新增成功!';
		 
		// $this->asti01_model->uploadf();   //檔案上傳
	     $action = $this->asti01_model->insertf();
	     if ($action === 'exist')
	      {
	       $data['message'] = '資料重複!';		    
	      }
	     $data['systitle'] ='資產類別建立-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ast/asti01_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//複製資料輸入	
    public function copyform()   //複製資料輸入
       {
	    $data['username'] = $this->session->userdata('manager');
	    $data['message'] = '';
	    $data['systitle'] ='資產類別建立-複製資料';
	    $data['menu_v'] = 'main_menuno_v';
	    $data['content_v'] = 'ast/asti01_copy_v';
	    $data['foot_v'] ='main_foot_v';
	    $this->load->vars($data);
	    $this->load->view('main_head_v');
       }
	   
	//複製存檔	
    public function copysave()   
       {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('ast/asti01_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->asti01_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	      {
	       $data['message'] = '資料重複!';		    
	      }
	     $data['systitle'] ='資產類別建立-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ast/asti01_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
       }
	   
    //轉excel輸入起迄資料
    public function exceldetail()  
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='資產類別建立-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ast/asti01_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
    //轉excel 檔
    public function write()   
        {
		
         $this->load->model('ast/asti01_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('資產類別代號','資產類別名稱','資產科目','累計折舊科目','折舊科目','折舊方法','耐用月數','折畢續提','折畢續提耐用月數');  //excel 表頭
         $result1 = $this->asti01_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
		
    //印明細起迄資料輸入
    public function printdetail()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='資產類別建立-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ast/asti01_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//印明細	
    public function printa()   
        {
		   $data['paper9']=$this->input->post('tg009p');
          if($this->input->post('action')=="excel"){
			  $this->write();
		  }		   
         $this->load->model('ast/asti01_model','',TRUE);
	     $data['message'] = '列印明細成功!';
         $result = $this->asti01_model->printfd();
	     $data['results'] = $result['rows'];
	     $data['num_results'] = $result['num_rows'];
	     $this->load->library('pagination');
	     $data['numrow']=$result['num_rows'];// 總筆數 
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='資產類別建立-印明細表';
	     $data['content_v'] = 'ast/asti01_printa_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
        }
      
	//修改存檔	
    public function updsave()   
        {
		  $seq1 = $this->uri->segment(4);
		  $seq9 = $seq1;
		// $seq9 = $seq1.'_'.$seq2.'_'.$seq3.'_'.$seq4;
		// var_dump($seq4);exit;
			//以下暫存view處理，上一筆下一筆用
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['asti01']['search'])){
				$current_index = $_SESSION['asti01']['search']['view'][$seq9];
				if($current_index!=0){
					$data['prev'] = $_SESSION['asti01']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['asti01']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['asti01']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$this->session->set_userdata('asti01_search',"display_search/".$offset);
				if($this->uri->segment(3)=="display" || $this->uri->segment(3)=="display_leave"){
					$this->session->set_userdata('asti01_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$offset);
				}
			}	
			
		
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
         $this->load->model('ast/asti01_model','',TRUE);
	     $this->load->vars($data);
	     $this->asti01_model->updatef();
		 $data['seq1'] = $this->uri->segment(4); 
	      $data['message'] = '儲存完畢!';
	      $this->load->model('ast/asti01_model');
	      $data['result'] = $this->asti01_model->selone($seq1,$seq2,$seq3,$seq4);
		 $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='資產類別建立-修改';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ast/asti01_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v'); 
		// redirect('ast/asti01/'.$this->session->userdata('asti01_search'));
	    // redirect('ast/asti01/'.$this->session->userdata('search1'));
        }
		
	//修改輸入資料	
    public function updform()   
        {
          
		 $data['seq1'] = $this->uri->segment(4);
		 $seq1 = $this->uri->segment(4);
		// $seq2 = $this->uri->segment(5);
		   $seq9 = $seq1;
		// $seq9 = $seq1.'_'.$seq2.'_'.$seq3.'_'.$seq4;
		 //以下暫存view處理，上一筆下一筆用
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['asti01']['search'])){
				$current_index = $_SESSION['asti01']['search']['view'][$seq9];
				if($current_index!=0){
					$data['prev'] = $_SESSION['asti01']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['asti01']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['asti01']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('asti01_search'));
				$this->session->set_userdata('asti01_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('asti01_search',"display/ma001/asc/".$offset);
				}
				if($temp_ident[0]=="display_leave"){
					$this->session->set_userdata('asti01_search',"display_leave/ma001/asc/".$offset);
				}
			} 
		 
	     $data['message'] = '查詢一筆修改資料!';
	     $this->load->model('ast/asti01_model');
	     $data['result'] = $this->asti01_model->selone($seq1);
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='資產類別建立-修改資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ast/asti01_upd_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//看資料
    public function see()   
        {      
	     $data['seq1'] = $this->uri->segment(4);
	//	 $seq9 = $this->uri->segment(4).$this->uri->segment(5)).$this->uri->segment(6)).$this->uri->segment(7);
		 $seq1 = $this->uri->segment(4);
		 $seq9 = $seq1;
		// $seq9 = $seq1.'_'.$seq2.'_'.$seq3.'_'.$seq4;
		 //以下暫存view處理，上一筆下一筆用
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['asti01']['search'])){
				
			//echo "<pre>";var_dump($_SESSION['asti01']['search']['index']);exit;
				
				$current_index = $_SESSION['asti01']['search']['view'][$seq9];
				
				//echo "<pre>";var_dump($_SESSION['asti01']['search']);exit;
				
				if($current_index!=0){
					$data['prev'] = $_SESSION['asti01']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['asti01']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['asti01']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('asti01_search'));
				$this->session->set_userdata('asti01_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('asti01_search',"display/ma001/asc/".$offset);  //品號
				}
				if($temp_ident[0]=="display_leave"){
					$this->session->set_userdata('asti01_search',"display_leave/ma001/asc/".$offset);
				}
			}
		 
		 
	     $data['message'] = '查看一筆資料!';
	     $this->load->model('ast/asti01_model');
	     $data['result'] = $this->asti01_model->selone($seq1);
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='資產類別建立-查看資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ast/asti01_see_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//刪除單筆
    public function del()   
        {      
       	 $seg1=$this->uri->segment(4);
         $seg2=$this->uri->segment(5); 
	     $data['message'] = '刪除資料成功!';
	     $this->load->model('ast/asti01_model','',TRUE);
	     $this->asti01_model->deletef($seg1,$seg2);
	     $this->display();
        }
		
    //刪除選取
    public function delete()   
        {    
	     $data['message'] = '刪除資料成功!';
	     $this->load->model('ast/asti01_model','',TRUE);
	     $this->asti01_model->delmutif();
	     $this->display();
        }
		
	//欄位表頭排序   資料流覽 開視窗用
	public function display_child($offset = 0,$func = "")  
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('ast/asti01_model');// 加載TABLE model 模型
		$result= $this->asti01_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,ma001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow']=$result['num'];// 總筆數 
		$data['page']=$result['num']/$limit; // 總頁數 
		$config = array();
		$config['per_page'] = '10';// 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['last_link'] = '尾頁';
		$config ['next_link'] = '下一頁>';
		$config ['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4,0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("ast/asti01/display_child");   //設定分頁url路徑
		/* 網址去除".html" */
		$temp_url = explode(".html",$config['base_url']);
		$config['base_url'] = "";
		foreach($temp_url as $key => $val){$config['base_url'].=$val;}
		
		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();	
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4,1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit ;    //每頁筆數
		$data['systitle'] ='廠商基本資料建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/asti01d_child_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }
	public function clear_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			//unset($_SESSION['asti01']['search']);
		}
		unset($_SESSION['asti01']['search']);
	  }
	  
	public function clearall_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			//unset($_SESSION['asti01']['search']);
		}
		unset($_SESSION['asti01']['search']);
		$this->display_child();
	  }
	  
	//品號快速查詢
	public function lookupd_asti01(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
		
        $this->load->model('ast/asti01_model');
		
		/*	=== _model->lookup(select_col,search_col,keyword,limit) Parameter 參數 ===
		 *
		 *	select_col = array(str1); str1 = 取得欄位名稱
		 *	search_col = array(str2,str3); str2 = 查詢欄位方法:or,and | str3 = 查詢欄位名稱
		 *	keyword = array(str4,str5); str4 = 查詢欄位名稱 | str5 = 查詢關鍵字
		 *	limit = int1; int1 = 回傳查詢結果筆數
		 */
		 
     /*   $query = $this->asti01_model->lookupd(
			array('a.ma001','a.ma002','a.ma003','a.ma004'),
			array('and'=>"ma001"),
			array('ma001'=>$keyword),
			15
		); */
      $query = $this->asti01_model->lookupd(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->ma001.",".$row->ma002.",".$row->ma003.",".$row->ma004,//顯示用的欄位
				  'value1' => $row->ma001,
				  'value2' => $row->ma002,
				  'value3' => $row->ma003,
				  'value4' => $row->ma004,
				  'value5' => $row->ma017,
				  'value6' => $row->ma017disp
				);  //Add a row to array  
              }
          }
		  else
		  {
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array
			$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
			  'category' => '', 
			  'value' => "查無資料"//顯示用的欄位
			);  //Add a row to array  
		  }
		echo json_encode($data); //echo json string if ajax request
	}
	
	//品號快速查詢
	public function lookupd2_asti01(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
		
        $this->load->model('ast/asti01_model');
		
		/*	=== _model->lookup(select_col,search_col,keyword,limit) Parameter 參數 ===
		 *
		 *	select_col = array(str1); str1 = 取得欄位名稱
		 *	search_col = array(str2,str3); str2 = 查詢欄位方法:or,and | str3 = 查詢欄位名稱
		 *	keyword = array(str4,str5); str4 = 查詢欄位名稱 | str5 = 查詢關鍵字
		 *	limit = int1; int1 = 回傳查詢結果筆數
		 */
		 
     /*   $query = $this->asti01_model->lookupd(
			array('a.ma001','a.ma002','a.ma003','a.ma004'),
			array('and'=>"ma001"),
			array('ma001'=>$keyword),
			15
		); */
      $query = $this->asti01_model->lookupd2(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->ma001.",".$row->ma002.",".$row->ma003.",".$row->ma004,//顯示用的欄位
				  'value1' => $row->ma001,
				  'value2' => $row->ma002,
				  'value3' => $row->ma003,
				  'value4' => $row->ma004,
				  'value5' => $row->ma017,
				  'value6' => $row->ma017disp
				);  //Add a row to array  
              }
          }
		  else
		  {
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array
			$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
			  'category' => '', 
			  'value' => "查無資料"//顯示用的欄位
			);  //Add a row to array  
		  }
		echo json_encode($data); //echo json string if ajax request
	}
	//不更新網頁 提示資料 品號 
	public function checkkey()   
        {
	     $this->load->model('ast/asti01_model');
	     $data['result'] = $this->asti01_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];		  
	     $this->load->vars($data);
	     echo  $Result;
        }
}
/* End of file asti01.php */
/* Location: ./application/controllers/asti01.php */
?>