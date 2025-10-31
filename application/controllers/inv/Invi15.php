<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi15 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
          $sort_by= 'tc001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('inv/invi15_model');     // 加載TABLE model 模型		
	      $result= $this->invi15_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tc001,desc
	      $data['results'] = $result['rows'];   // 所有列資料
	      $data['num_results'] = $result['num_rows'];  // 總筆數
	    //$this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];  // 總筆數 
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
	      $config['base_url'] = site_url("inv/invi15/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	   // $this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');  //session 儲存的使用者代號
	    //$data['find05']=$this->session->userdata('find05'); 
	    //$data['find07']=$this->session->userdata('find07');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='盤點流覽建立作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'inv/invi15_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
		
	 //欄位表頭排序 資料流覽 
	  public function display($sort_by = 'tc001,tc002', $sort_order = 'asc', $offset = 0)  
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('inv/invi15_model');// 加載TABLE model 模型		
	      $result= $this->invi15_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tc001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
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
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("inv/invi15/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='盤點流覽建立作業';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'inv/invi15_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		
	//篩選資料 	
	public function filter1($sort_by = 'tc001', $sort_order = 'desc', $offset = 0)   
       {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('inv/invi15_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->invi15_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("inv/invi15/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='盤點流覽建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'inv/invi15_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
	   //$this->load->view('inv/invi15_v', $data);
       }
	   
	//進階查詢輸入資料	
    public function findform()   
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='盤點流覽-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'inv/invi15_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }    
		
	//進階查詢	
	public function findsql($sort_by = 'tc001', $sort_order = 'desc', $offset = 0)  
	    {		
		  if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_POST['find005']){
			$_SESSION['invi15_sql_term'] = $_POST['find005'];
		  }
		  if(@$_POST['find007']){
			$_SESSION['invi15_sql_sort'] = $_POST['find007'];
		  }
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('inv/invi15_model');// 加載TABLE model 模型		
	      $result= $this->invi15_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tc001,desc
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
	      $config['base_url'] = site_url("inv/invi15/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	    //$data['find05']=$this->session->userdata('find05'); 
	    //$data['find07']=$this->session->userdata('find07');
	      $data['systitle'] ='盤點流覽建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'inv/invi15_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		  public function clear_sql_term(){  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_SESSION["invi15_sql_term"]) {unset($_SESSION["invi15_sql_term"]);}
		  if(@$_SESSION["invi15_sql_sort"]) {unset($_SESSION["invi15_sql_sort"]);}
		  $this->display();
	  }
	 //新增輸入資料   
    public function addform()   
      {
	   $data['date']= date("Ymd");
	   $data['message'] = '';
	   $data['username'] = $this->session->userdata('manager');
	   $data['systitle'] ='盤點流覽-新增資料';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'inv/invi15_add_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
	//新增存檔	
    public function addsave()   
      {
	   $data['username'] = $this->session->userdata('manager');
       $this->load->model('inv/invi15_model','',TRUE);
	   $data['message'] = '新增成功!';
	   $action = $this->invi15_model->insertf();
	   if ($action === 'exist')
	     {
	      $data['message'] = '資料重複!';		    
	     }
	   $data['systitle'] ='盤點流覽-新增資料';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'inv/invi15_add_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
	//複製資料輸入	
    public function copyform()   
      {
	   $data['username'] = $this->session->userdata('manager');
	   $data['message'] = '';
	   $data['systitle'] ='盤點流覽-複製資料';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'inv/invi15_copy_v';
	   $data['foot_v'] ='main_foot_v';
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
       $this->load->model('inv/invi15_model','',TRUE);
	   $data['message'] = '複製成功!';
       $action = $this->invi15_model->copyf();
	   if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	     {
	       $data['message'] = '資料重複!';		    
	     }
	   $data['systitle'] ='盤點流覽-複製資料';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'inv/invi15_copy_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
    //轉excel明細輸入起迄資料
    public function exceldetail()   
      {
	   $data['message'] = '';
	   $data['username'] = $this->session->userdata('manager');
	   $data['systitle'] ='盤點流覽-轉excel檔';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'inv/invi15_excel_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
    //轉excel 檔
    public function write()   
      {
       $this->load->model('inv/invi15_model','',TRUE);
	   $data['message'] = '轉檔excel成功!';
	   $data['username'] = $this->session->userdata('manager');
	   $title = array('盤點底稿','底稿流水號','品號','庫別','儲位','實盤數量','盤點日期');  //excel 表頭
       $result1 = $this->invi15_model->excelnewf();	
       $this->excel->writer($title,$result1);    //讀取excel  
      }
	  
    //印明細起迄資料輸入
    public function printdetail()   
      {
	   $data['username'] = $this->session->userdata('manager');
	   $data['message'] = '';
	   $data['systitle'] ='盤點流覽-印明細表';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'inv/invi15_print_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
	//印明細	
    public function printa()   
      {
	      $data['paper9']=$this->input->post('tg009p');	
       $this->load->model('inv/invi15_model','',TRUE);
	   $data['message'] = '列印明細成功!';
       $result = $this->invi15_model->printfd();
	   $data['results'] = $result['rows'];
	   $data['num_results'] = $result['num_rows'];
	  // $this->load->library('pagination');
	   $data['numrow']=$result['num_rows'];// 總筆數 
	   $data['username'] = $this->session->userdata('manager');
	   $data['systitle'] ='盤點流覽-印明細表';
	 //$data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'inv/invi15_printa_v';
	 //$data['foot_v'] ='main_footno_v';
	   $this->load->vars($data);
	   $this->load->view('main_headprint_v');
	 //$this->load->view('inv/invi15_printa_v',$data);  
      }
      
	//修改存檔	
    public function updsave()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
         $this->load->model('inv/invi15_model','',TRUE);
	     $this->load->vars($data);
	     $this->invi15_model->updatef(); 
	     redirect('inv/invi15/'.$this->session->userdata('search'));
        }
		
	//修改輸入資料	
    public function updform()   //修改輸入資料
      {
        $data['seq1'] = $this->uri->segment(4); 
	    $data['seq2'] = $this->uri->segment(5); 
	    $data['message'] = '查詢一筆修改資料!';
	    //$this->db->get('invma');
	    $this->load->model('inv/invi15_model');
	    $data['result'] = $this->invi15_model->selone($this->uri->segment(4));
	    $data['username'] = $this->session->userdata('manager');
	    $data['systitle'] ='盤點流覽-修改資料';
	    $data['menu_v'] = 'main_menuno_v';
	    $data['content_v'] = 'inv/invi15_upd_v';
	    $data['foot_v'] ='main_foot_v';
	    $this->load->vars($data);
	    $this->load->view('main_head_v');
      }
	
    public function see()   //看資料
      {      
	    $data['seq1'] = $this->uri->segment(4); 
	    $data['seq2'] = $this->uri->segment(5); 
	    $data['message'] = '查看一筆資料!';
	    //$this->db->get('invma');
	    $this->load->model('inv/invi15_model');
	    $data['result'] = $this->invi15_model->selone($this->uri->segment(4));
	    $data['username'] = $this->session->userdata('manager');
	    $data['systitle'] ='盤點流覽-查看資料';
	    $data['menu_v'] = 'main_menuno_v';
	    $data['content_v'] = 'inv/invi15_see_v';
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
	    $this->load->model('inv/invi15_model','',TRUE);
	    $this->invi15_model->deletef($seg1,$seg2);
	    $this->display();
       }
	   
    //刪除選取 
    public function updatedelete()   
      {    
	    $data['message'] = '資料成功!';
	    $this->load->model('inv/invi15_model','',TRUE);
	    $this->invi15_model->updatemutif();
	    $this->display();
      }
	//刪除選取 
    public function delete()   
      {    
	    $data['message'] = '刪除資料成功!';
	    $this->load->model('inv/invi15_model','',TRUE);
	    $this->invi15_model->delmutif();
	    $this->display();
      }
	 //選取更新 
	 public function dataupdate()   //提示改輸入資料如 實盤數量 不更新網頁
        {
	      $this->load->model('inv/invi15_model');
	      $data['result'] = $this->invi15_model->ajaxdata($this->uri->segment(4),$this->uri->segment(5));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        } 
	//提示輸入資料重複
	 public function checkkey()  
       {
	     $this->load->model('inv/invi15_model');
	     $data['result'] = $this->invi15_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];		  
	     $this->load->vars($data);
	     echo  $Result;
       }
	   
	   public function datacmsq05a()   //提示改輸入資料如 部門 不更新網頁
        {
	      $this->load->model('inv/invi15_model');
	      $data['result'] = $this->invi15_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	
 
	function rjsi01_print()
	{
		$user_cop = $this->session->user_cop;
		$tot = $this->input->post('total');
		
		$r = 0;
		$data = array();
		$this->load->model('inv/m_rjsi01');
		if ($tot >= 0){
			for ($i=1; $i<=$tot; $i++){
				$ck = $this->input->post('ckbt'.$i);
				if ($ck){
					$r++;
					$data[] = $ck;
				}
			}
		}
		
		$data1 = array();
		if ($r <= 0){
			$this->load->view('inv/v_message'); //載入錯誤訊息
			$this->load->view('inv/v_topmenu'); //載入功能表
			$this->load->view('inv/v_footer'); //載入js檔
		}else{
			$data1['data2'] = $this->m_rjsi01->get_dpt2($user_cop,$data);
            $data1['user_copna'] = $this->session->user_copna;
			$this->load->view('v_RJSI01_print',$data1);
		}
	}
	
	/***************************************************************************/
}
/* End of file invi15.php */
/* Location: ./application/controllers/invi15.php */
?>