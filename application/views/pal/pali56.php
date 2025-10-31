<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pali56 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
          $sort_by= 'tf001';		  
	      $data['message'] = '資料瀏覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali56_model');     // 加載TABLE model 模型		
	      $result= $this->pali56_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tf001,desc
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
	   //   $this->pagination->initialize($config);    //分頁初始化 display 3
	      $config['base_url'] = site_url("pal/pali56/display/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='出勤資料管理作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali56_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
		
	 //欄位表頭排序 資料流覽 
	  public function display($sort_by = 'te002', $sort_order = 'desc', $offset = 0)  
	    {
		  if(!@$this->input->get('dateo')){$dateo = date("Ymd");}else{$dateo = $this->input->get('dateo');}
		  if(!@$this->input->get('datec')){$datec = date("Ymd");}else{$datec = $this->input->get('datec');}
		  if(!@$this->input->get('epyo')){$epyo = "";}else{$epyo = $this->input->get('epyo');}
		  if(!@$this->input->get('epyc')){$epyc = "";}else{$epyc = $this->input->get('epyc');}
		  if(!@$this->input->get('type')){$type = "A";}else{$type = $this->input->get('type');}
		  preg_match_all('/\d/S',$dateo, $matches);  //處理日期字串
		  $data['dateo'] = implode('',$matches[0]);
		  preg_match_all('/\d/S',$datec, $matches);  //處理日期字串
		  $data['datec'] = implode('',$matches[0]);
		  $data['type'] = $type;
		  $data['epyo'] = $epyo;
		  $data['epyc'] = $epyc;
	      $limit = 30;    //每頁筆數
	      $data['message'] = '資料瀏覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali56_model');// 加載TABLE model 模型		
	      $result= $this->pali56_model->search($limit, $offset , $sort_by  , $sort_order,$dateo,$datec,$type,$epyo,$epyc); //至model 取 mysql 資料 預設 15,0,tf001,desc
	      $data['results'] = $result['rows'];
	      $this->load->library('pagination');
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = '30';// 每頁筆數 必填
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
	      $config['base_url'] = site_url("pal/pali56/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='出勤資料管理作業';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali56_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    }

	 //欄位表頭排序 隱藏資料瀏覽
	  public function display_bak($sort_by = 'te002', $sort_order = 'desc', $offset = 0)  
	    {
		  if(!@$this->input->get('dateo')){$dateo = date("Ymd");}else{$dateo = $this->input->get('dateo');}
		  if(!@$this->input->get('datec')){$datec = date("Ymd");}else{$datec = $this->input->get('datec');}
		  if(!@$this->input->get('epyo')){$epyo = "";}else{$epyo = $this->input->get('epyo');}
		  if(!@$this->input->get('epyc')){$epyc = "";}else{$epyc = $this->input->get('epyc');}
		  if(!@$this->input->get('type')){$type = "A";}else{$type = $this->input->get('type');}
		  preg_match_all('/\d/S',$dateo, $matches);  //處理日期字串
		  $data['dateo'] = implode('',$matches[0]);
		  preg_match_all('/\d/S',$datec, $matches);  //處理日期字串
		  $data['datec'] = implode('',$matches[0]);
		  $data['type'] = $type;
		  $data['epyo'] = $epyo;
		  $data['epyc'] = $epyc;
	      $limit = 30;    //每頁筆數
	      $data['message'] = '資料瀏覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali56_model');// 加載TABLE model 模型		
	      $result= $this->pali56_model->search_bak($limit, $offset , $sort_by  , $sort_order,$dateo,$datec,$type,$epyo,$epyc); //至model 取 mysql 資料 預設 15,0,tf001,desc
	      $data['results'] = $result['rows'];
	      $this->load->library('pagination');
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = '30';// 每頁筆數 必填
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
	      $config['base_url'] = site_url("pal/pali56/display_bak/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='出勤資料管理作業';
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali56_brow_back_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 		
	//篩選資料 	
	public function filter1($sort_by = 'tf002', $sort_order = 'desc', $offset = 0)   
       {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('pal/pali56_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->pali56_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("pal/pali56/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='出勤資料管理作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'pal/pali56_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
	   //$this->load->view('pal/pali56_v', $data);
       }
	   
	//進階查詢輸入資料	
    public function findform()   
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='出勤資料管理作業-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/pali56_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }    
		
	//進階查詢	
	public function findsql($sort_by = 'tf001', $sort_order = 'desc', $offset = 0)  
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali56_model');// 加載TABLE model 模型		
	      $result= $this->pali56_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tf001,desc
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
	      $config['base_url'] = site_url("pal/pali56/findsql/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='出勤資料管理作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali56_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
	  
    //轉excel明細輸入起迄資料
    public function exceldetail()   
      {
	   $data['message'] = '';
	   $data['username'] = $this->session->userdata('manager');
	   $data['systitle'] ='出勤資料管理作業-轉excel檔';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali56_excel_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
    //轉excel 檔
    public function write()   
      {
       $this->load->model('pal/pali56_model','',TRUE);
	   $data['message'] = '轉檔excel成功!';
	   $data['username'] = $this->session->userdata('manager');
	   $title = array('員工代號','員工姓名','部門代號','部門名稱','刷卡日期','平時加班2小時內','平時加班2小時外','六加班8小時內','六加班8小時外','日加班8小時內','日加班8小時外','備註');  //excel 表頭
       $result1 = $this->pali56_model->excelnewf();	
       $this->excel->writer($title,$result1);    //讀取excel  
      }
	  
    //印明細起迄資料輸入
    public function printdetail()   
      {
	   $data['username'] = $this->session->userdata('manager');
	   $data['message'] = '';
	   $data['systitle'] ='出勤資料管理作業-印明細表';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali56_print_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
	//印明細	
    public function printa()   
      {
		  	$data['paper9']=$this->input->post('tl009c');
       $this->load->model('pal/pali56_model','',TRUE);
	   $data['message'] = '列印明細成功!';
       $result = $this->pali56_model->printfd();
	   $data['results'] = $result['rows'];
	   $data['num_results'] = $result['num_rows'];
	   $this->load->library('pagination');
	   $data['numrow']=$result['num_rows'];// 總筆數 
	   $data['username'] = $this->session->userdata('manager');
	   $data['systitle'] ='出勤資料管理作業-印明細表';
	 //$data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali56_printa_v';
	 //$data['foot_v'] ='main_footno_v';
	   $this->load->vars($data);
	   $this->load->view('main_headprint_v');
	 //$this->load->view('pal/pali56_printa_v',$data);  
      }
      
	//修改存檔	
    public function updsave()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
         $this->load->model('pal/pali56_model','',TRUE);
	     $this->load->vars($data);
	     $this->pali56_model->updatef(); 
	     redirect('pal/pali56/display'/*.$this->session->userdata('search')*/);
        }
		
	//修改輸入資料	
    public function updform()   //修改輸入資料
      {
        $seq2 = $data['seq2'] = urldecode(urldecode($this->uri->segment(4))); 
	    $seq1 = $data['seq1'] = $this->uri->segment(5);
	    $data['message'] = '查詢一筆修改資料!';
	    //$this->db->get('invma');
	    $this->load->model('pal/pali56_model');
	    $data['times'] = $this->pali56_model->get_times($seq1,$seq2);//假日資料
	    $data['result'] = $this->pali56_model->selone(urldecode(urldecode($this->uri->segment(4))),$this->uri->segment(5));
	    $holiday = $this->pali56_model->check_holiday($seq2);//假日資料
	    $data['tf002'] = substr($seq2,0,4)."/".substr($seq2,4,2)."/".substr($seq2,6,2);
	    $data['holiday'] = $holiday;
	    $data['username'] = $this->session->userdata('manager');
	    $data['systitle'] ='出勤資料管理作業-修改資料';
	    $data['menu_v'] = 'main_menuno_v';
	    $data['content_v'] = 'pal/pali56_upd_v';
	    $data['foot_v'] ='main_foot_v';
	    $this->load->vars($data);
	    $this->load->view('main_head_v');
      }
	
    public function see()   //看資料
      {      
	    $seq2 = $data['seq2'] = urldecode(urldecode($this->uri->segment(4)));
	    $seq1 = $data['seq1'] = $this->uri->segment(5);
	    $data['message'] = '查看一筆資料!';
	    $this->load->model('pal/pali56_model');
	    $holiday = $this->pali56_model->check_holiday($seq2);//假日資料
	    $data['tf002'] = substr($seq2,0,4)."/".substr($seq2,4,2)."/".substr($seq2,6,2);
	    $data['holiday'] = $holiday;
	    $data['result'] = $this->pali56_model->selone(urldecode(urldecode($this->uri->segment(4))),$this->uri->segment(5));
	    $data['username'] = $this->session->userdata('manager');
	    $data['systitle'] ='出勤資料管理作業-查看資料';
	    $data['menu_v'] = 'main_menuno_v';
	    $data['content_v'] = 'pal/pali56_see_v';
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
	    $this->load->model('pal/pali56_model','',TRUE);
	    $this->pali56_model->deletef($seg1,$seg2);
	    $this->display();
       }
	   
    //刪除選取 
    public function delete()   
      {
		if(@$this->input->post('selected')){
			$temp_ary = $this->input->post('selected');
			foreach($temp_ary as $key => $val){
				$temp = explode('/',$val);
				$seq1[] = $temp[0];
				$seq2[] = $temp[1];
			}
			$data['message'] = '刪除資料成功!';
			$this->load->model('pal/pali56_model','',TRUE);
			$this->pali56_model->delmutif($seq1,$seq2);
		}
	    $this->display();
      }
	//修改單筆
	public function save_ajax()   
		{
		  $date = $_GET['date'];
		  $epy_no = $_GET['epy_no'];
		  $new_time = $_GET['new_time'];
		  $old_time = $_GET['old_time'];
		  
		  $this->load->model('pal/pali56_model','',TRUE);
		  if($old_time == "new"){
			if($this->pali56_model->insertf($epy_no,$date,$new_time)){
				$message = "success";
			}
			else{
				$message = "fail";
			}
		  }
		  else{
			if($this->pali56_model->updatef($epy_no,$date,$new_time,$old_time)){
				$message = "success";
			}
			else{
				$message = "fail";
			}
		  }
		  
		  echo $message;
		 
		}
	//刪除單筆
	public function del_ajax()   
		{
		  $te001 = $_GET['epy_no'];
		  $te002 = $_GET['date'];
		  $te003 = $_GET['time'];
		  $this->load->model('pal/pali56_model','',TRUE);
		  if($this->pali56_model->deletef($te001,$te002,$te003))
			$message = "刪除資料成功!";
		  else
			$message = "刪除資料失敗!";
		  echo $message;
		}
	
	public function re_ajax()   
		{
		  $te001 = $_GET['epy_no'];
		  $te002 = $_GET['date'];
		  $this->load->model('pal/pali56_model','',TRUE);
		  if($msg=$this->pali56_model->recoverf($te001,$te002))
			$message = $msg;
		  else
			$message = "復原資料失敗!";
		  echo $message;
		}
		
	//提示輸入資料重複
	 public function checkkey()  
       {
	     $this->load->model('pal/pali56_model');
	     $data['result'] = $this->pali56_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];		  
	     $this->load->vars($data);
	     echo  $Result;
       }
}
/* End of file pali56.php */
/* Location: ./application/controllers/pali56.php */
?>