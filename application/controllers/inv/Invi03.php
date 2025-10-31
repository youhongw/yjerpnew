<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi03 extends CI_Controller {
	
	  public function __construct() 
	    {
     	  parent::__construct();     
	    //$this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");
	    //$this->load->helper('to_excel');
	      $this->load->library('excel');
	 
	      $data['username'] = $this->session->userdata('manager');
	      $data['sort_order'] =  'asc';	
	      $data['sort_by'] =  'ma001';	
	      $data['message'] = '';
	      $sort_order =  'asc';	
	      $sort_by =  'ma001';	
	      $message = ' ';
	    }
		
	  public function index()
	    {                      

	    }
	   
	  public function display($sort_by = 'ma001', $sort_order = 'desc', $offset = 0)  //欄位表頭排序
	    {		
		  $limit = 10;    //每頁筆數		
		  $data['fields'] = array(                                   //table 欄位設定		             
		                           'company' => 'company',
			                       'creator' =>'creator',
			                       'usr_group' => 'usr_group',
			                       'create_date' =>'create_date',
			                       'modifier' => 'modifier',
			                       'modi_date' => 'modi_date',
			                       'flag' => 'flag',
			                       'ma001' => 'ma001',
			                       'ma002' => 'ma002',
			                       'ma003' => 'ma003',
			                       'ma004' => 'ma004',
			                       'ma005' => 'ma005',
			                       'ma006' => 'ma006'			
		                         );
		
		  $this->load->helper('url');
		  $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
		  $data['sort_order'] = $sort_order;
		  $this->load->model('inv/invi03_model');// 加載TABLE model 模型		
		  $result= $this->invi03_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ma001,desc
		  $data['results'] = $result['rows'];
		  $data['num_results'] = $result['num_rows'];
		  $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
		  $data['page']=$result['num_rows']/$limit; // 總頁數 
		  $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
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
	      $config['cur_page'] = $this->uri->segment(6,0);   //當前頁 結合分頁url路徑 +1
	      $this->pagination->initialize($config);    //分頁初始化 display 3
		  $config['base_url'] = site_url("inv/invi03/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
		  $config['uri_segment'] = 6;       //當前頁
		  $this->load->library('table');//加載table函數
		  $this->pagination->initialize($config);
		  $data['pagination'] = $this->pagination->create_links();	
		  $data['username'] = $this->session->userdata('manager');
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_brow_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_headbrow_v');		
	    } 
	 	
	  public function filter1($sort_by = 'ma001', $sort_order = 'desc', $offset = 0)   ////篩選資料
        {
	      $limit = 15;
		  $data['fields'] = array(
		                          'company' => 'company',
			                      'creator' =>'creator',
			                      'usr_group' => 'usr_group',
			                      'create_date' =>'create_date',
			                      'modifier' => 'modifier',
			                      'modi_date' => 'modi_date',
			                      'flag' => 'flag',
			                      'ma001' => 'ma001',
			                      'ma002' => 'ma002',
			                      'ma003' => 'ma003',
			                      'ma004' => 'ma004',
			                      'ma005' => 'ma005',
			                      'ma006' => 'ma006'			
		                         );
		
		  $this->load->helper('url'); 
		  $data['sort_by'] = $this->uri->segment(4);
	  	  $data['sort_order'] = $this->uri->segment(5); 
	      $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
          $seq7 ='1';		  
		  $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
		  $data['sort_order'] = $sort_order;
	      $this->load->model('inv/invi03_model','',TRUE);
	      $result=$this->invi03_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	      $config['display_pages'] = TRUE;  //隐藏數字鏈接
	      $config['full_tag_open'] = '<p>';
	      $config['full_tag_close'] = '</p>'; 
		  $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
          $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	      $config['cur_page'] = $this->uri->segment(8,0);   //當前頁 結合分頁url路徑 +1
	      $this->pagination->initialize($config);//分頁初始化 
		  $config['base_url'] = site_url("inv/invi03/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		  $config['per_page'] = $limit;
		  $config['uri_segment'] = 8;
		  $this->load->library('table');//加載table函數
		  $this->pagination->initialize($config);
		  $data['pagination'] = $this->pagination->create_links();	
		  $data['username'] = $this->session->userdata('manager');
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_brow_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_headbrow_v');
		 //  $this->load->view('inv/invi03_v', $data);
        }
		
      public function findform()   //進階查詢輸入資料
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
		   $data['message'] = '';
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_find_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_head_v');
        }
		
      public function findsql($num = '')   //進階查詢取資料
        {
	      $data['date']= date("Ymd");
	      $data['sort_by'] = 'ma001';  
          $data['sort_order'] = 'desc';	
          $this->load->helper('url'); 		
	      $this->load->model('inv/invi03_model','',TRUE);
		  $result=$this->invi03_model->findf();
          $data['message'] = '進階查詢資料成功!';	
	      $data['results'] = $result['rows'];		
	      $data['num_results'] = $result['num_rows'];
	      $this->load->vars($data);
		  $this->load->library('pagination');
		  $data['numrow']= $result['num_rows'];  // 總筆數 
	      $data['page'] = $result['num_rows']/15;  // 總頁數 	
          $config = array();			
		  $this->load->library('pagination'); // 加載分頁類
          $config['base_url'] = 'findsql';  // 分頁基本 URL
          $config['total_rows'] = $result['num_rows']; // 統計數量
          $config['per_page'] = 15; // 每頁顯示數量
          $config['num_links'] = 3; // 當前頁連接前后顯示頁碼個數
          $config['full_tag_open'] = '<div class="pagination">'; // 分頁開始樣式
          $config['full_tag_close'] = '</div>'; // 分頁結束樣式
          $config['first_link'] = '首页'; // 第一頁顯示
          $config['last_link'] = '末页'; // 最后一頁顯示
          $config['next_link'] = '下一页 >'; // 下一頁顯示
          $config['prev_link'] = '< 上一页'; // 上一頁顯示
		  $config['full_tag_open'] = '<p>';
	      $config['full_tag_close'] = '</p>'; 
          $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
          $config['cur_tag_close'] = '</a>'; // 當前頁結束樣式
		  $config['uri_segment'] = 2;
          $this->pagination->initialize($config); // 配置分頁
          $config['uri_segment'] = 2;
		  $this->load->library('table');//加載table函數
		  $result=$this->invi03_model->findf();
		  $data['results'] =  array_slice($result['rows'], intval($num), $config['per_page']); // 取前分頁數據
		  $data['pagination'] = $this->pagination->create_links();
	      $data['username'] = $this->session->userdata('manager');
		  
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_brow_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_headbrow_v');
		//$this->load->view('inv/invi03_v', $data);
        }  
   
      public function addform()   //新增輸入資料
        {
	      $data['date']= date("Ymd");
	      $data['message'] = '';
	      $data['username'] = $this->session->userdata('manager');
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_add_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_head_v');
        }
		
      public function addsave()   //新增存檔
        {
	      $this->load->helper('url');
	      $date=date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
          $this->db->get('invma');	
          $this->load->model('inv/invi03_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->invi03_model->insertf();
		  if ($action === 'exist')
		    {
		      $data['message'] = '資料重複!';		    
	        }
	      $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_add_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_head_v');
        }
		
      public function copyform()   //複製資料輸入
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
		  $data['message'] = '';
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_copy_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_head_v');
        }
		
      public function copysave()   //複製存檔
        {
	      $this->load->helper('url');
		  $date=date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
          $this->db->get('invma');	
          $this->load->model('inv/invi03_model','',TRUE);
	      $data['message'] = '複製成功!';
          $action = $this->invi03_model->copyf();
	      if ($action === 'exist')
		    {
		      $data['message'] = '資料重複!';		    
	        }
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_copy_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_head_v');
        }
  
      public function exceldetail()   //轉excel明細輸入起迄資料
        {
	      $this->load->helper('url');
		  $data['date']=date("Ymd");
		  $data['message'] = '';
		  $data['username'] = $this->session->userdata('manager');
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_excel_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_head_v');
        }
  
      public function write()   //轉excel 部份資料由 print_v call
        {
	      $this->load->helper('url');
		  $data['date'] = date("Ymd");
          $this->db->get('invma');	
          $this->load->model('inv/invi03_model','',TRUE);
	      $data['message'] = '轉檔excel成功!';
	      $data['username'] = $this->session->userdata('manager');
	      $title = array('ma001','ma002','ma003','ma004','ma005','ma006','create_date');
          $result1 = $this->invi03_model->excelnewf();	
          $this->excel->writer($title,$result1);    //讀取excel  
        }
  
      public function printdetail()   //印明細起迄資料輸入
        {
	      $this->load->helper('url');
		  $data['date']=date("Ymd");
		  $data['username'] = $this->session->userdata('manager');
		  $data['message'] = '';
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_print_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_head_v');
        }
		
      public function printa()   //印明細
        {
	      $this->load->helper('url');
		  $data['date'] = date("Ymd");
          $this->db->get('invma');	
          $this->load->model('inv/invi03_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->invi03_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['username'] = $this->session->userdata('manager');
	      $this->load->view('inv/invi03_printa_v',$data);
        }
		
      public function updsave()   //修改存檔
        {
	      $this->load->helper('url');
		  $date=date("Ymd");
	      $data['message'] = '修改資料成功!';
          $this->db->get('invma');	
          $this->load->model('inv/invi03_model','',TRUE);
	      $this->invi03_model->updatef();  	 
	      $this->display();
        }
		
      public function updform()   //修改輸入資料
        {
          $data['seq1'] = $this->uri->segment(4); 
	      $data['seq2'] = $this->uri->segment(5); 
		  $data['message'] = '查詢一筆修改資料!';
		  $this->db->get('invma');	
		  $this->load->vars($data);
	   	  $this->load->model('inv/invi03_model');
		  $data['result'] = $this->invi03_model->selone($this->uri->segment(4),$this->uri->segment(5));
		  $data['username'] = $this->session->userdata('manager');
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_upd_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_head_v');
        }
		
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	   	  $this->load->model('inv/invi03_model','',TRUE);
		  $this->invi03_model->deletef($seg1,$seg2);
		  $this->display();
        }
		
      public function see()   //看資料
        {      
	      $data['seq1'] = $this->uri->segment(4); 
	      $data['seq2'] = $this->uri->segment(5); 
		  $data['message'] = '查看一筆資料!';
		  $this->db->get('invma');	
		  $this->load->vars($data);
	   	  $this->load->model('inv/invi03_model');
		  $data['result'] = $this->invi03_model->selone($this->uri->segment(4),$this->uri->segment(5));
		  $data['username'] = $this->session->userdata('manager');
		  $data['systitle'] ='雲端ERP企業資源管理系統';
		  $data['content_v'] = 'inv/invi03_see_v';
		  $data['foot_v'] ='inv/invi03_foot_v';
		  $this->load->vars($data);
		  $this->load->view('inv/invi03_head_v');
        }
   
      public function delete()   //刪除選取
        {    
	    $data['message'] = '刪除資料成功!';
	   	$this->load->model('inv/invi03_model','',TRUE);
		$this->invi03_model->delmutif();
		$this->display();
        }
}

/* End of file invi03.php */
/* Location: ./application/controllers/invi03.php */