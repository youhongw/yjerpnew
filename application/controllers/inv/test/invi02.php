<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi02 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -  
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() 
	  { parent::__construct();     
	  //$this->load->helper('url');   //載入預設url 庫函數及數据庫配置 
	 // $this->load->database(); 
	 $this->load->library("session");
	// $this->load->helper('to_excel');
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
	  $data['fields'] = array(
		   
			'ma001' => 'ma001',
			'ma002' => 'ma002',
			'ma003' => 'ma003',
			'ma004' => 'ma004',
			'ma005' => 'ma005',
			'ma006' => 'ma006'
			
		);
	
	  $data['message'] = '';
      $data['sort_order'] =  'asc';	
	  $data['sort_by'] =  'ma001';	
	  $data['date']= date("Y/m/d");
	  $data['numrow']=$this->db->count_all_results('invma');// 總筆數 
	  $data['page']=$this->db->count_all_results('invma')/15; // 總頁數 
      $this->load->helper('url'); 
	  $this->load->library('pagination');//加載分頁類 
	  $this->load->model('inv/invi02_model');// 加載TABLE model 模型 
	  $config['base_url'] = base_url().'index.php/inv/invi02/index';//設定分頁url路徑
	  $config['total_rows'] = $this->db->count_all_results('invma');// 總筆數 
	  $config ['uri_segment'] = 4; //設置url上第几段用于傳分頁器的偏移量
	  $config['per_page'] = '15';// 每頁筆數
	  $config['first_link'] = '首頁';
	  $config['last_link'] = '尾頁';
	  $config ['next_link'] = '下一頁>';
      $config ['prev_link'] = '<上一頁';
	  $config['display_pages'] = TRUE;  //隐藏數字鏈接
	//  $config['num_links']=3;  //當前頁碼前後數字鏈結數量
	//  $config['last_tag_open'] = '';  //最後一頁鏈結打開標簽。
	//  $config['cur_tag_open'] = '<li>';//當前鏈結打開標簽。
	  $config['full_tag_open'] = '<p>';
	  $config['full_tag_close'] = '</p>'; 
	  $this->pagination->initialize($config);//分頁初始化 
	 // $data['results']=  $this->invi02_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄 
	  $result=  $this->invi02_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄 
	  $data['results'] = $result['rows'];
	  $this->load->library('table');//加載table函數	  
	   $this->pagination->initialize($config);//初始化 
	    $data['username'] = $this->session->userdata('manager');
      $this->load->view('inv/invi02_v',$data);   
	  
	  //允許你檢索特定的區段部份。n 是您想檢索的特定區段，區段是由左到右順序排列，底下簡單來說，假設您的 URL 網址如下：
	  //http://example.com/index.php/news/local/metro/crime_is_up  全部的區段分別是：news,local,metro,crime_is_up  
	 // $data['results']=  $this->invi02_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄                          
	 
	    
	}
	   //表頭排序
	 public function display($sort_by = 'ma001', $sort_order = 'desc', $offset = 0) {
		
		$limit = 15;    //每頁筆數
		
		$data['fields'] = array(               //table 欄位設定
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
	  
		$this->load->model('inv/invi02_model');// 加載TABLE model 模型		
		$result= $this->invi02_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ma001,desc
		
		$data['results'] = $result['rows'];
		$data['num_results'] = $result['num_rows'];		
		
		$this->load->library('pagination');
	    $data['numrow']=$result['num_rows'];// 總筆數 
		$data['page']=$result['num_rows']/15; // 總頁數 
		
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
		 $config['base_url'] = site_url("inv/invi02/display/$sort_by/$sort_order");   //設定分頁url路徑
	
	     $config['total_rows'] = $result['num_rows']; // 總筆數
	     $config['per_page'] = $limit;                //每頁筆數
		 $config['uri_segment'] = 6;       //當前頁
		 $this->load->library('table');//加載table函數
		 $this->pagination->initialize($config);
		 $data['pagination'] = $this->pagination->create_links();	
		 $data['username'] = $this->session->userdata('manager');
		 $this->load->view('inv/invi02_v', $data);
	} 
	
	 //篩選資料
	 	
	 public function filter1($sort_by = 'ma001', $sort_order = 'desc', $offset = 0)   //篩選
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
	    $this->load->model('inv/invi02_model','',TRUE);
	    $result=$this->invi02_model->filterf1($limit, $offset , $sort_by  , $sort_order);
	
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
	 
		$config['base_url'] = site_url("inv/invi02/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
		$config['per_page'] = $limit;
		$config['uri_segment'] = 8;
		 $this->load->library('table');//加載table函數
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();	
		 $data['username'] = $this->session->userdata('manager');
		$this->load->view('inv/invi02_v', $data);
	   	
   }
   
    
    public function seeform()   //看資料 
    {
	   
	   $data['date']= date("Ymd");
	    $data['username'] = $this->session->userdata('manager');
       $this->load->view('inv/invi02_see_v',$data);
				
   }
     public function findform()   //進階查詢輸入資料
    {
	   
	   $data['date']= date("Ymd");
	    $data['username'] = $this->session->userdata('manager');
       $this->load->view('inv/invi02_find_v',$data);
				
   }
    public function findsql($num = '')   //進階查詢資料
    {
	    $data['date']= date("Ymd");
	    $data['sort_by'] = 'ma001';  
        $data['sort_order'] = 'desc';	
        $this->load->helper('url'); 		
		$this->load->model('inv/invi02_model','',TRUE);
		$result=$this->invi02_model->findf();
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
		 $result=$this->invi02_model->findf();
		 $data['results'] =  array_slice($result['rows'], intval($num), $config['per_page']); // 取前分頁數據
       		
		$data['pagination'] = $this->pagination->create_links();
	     $data['username'] = $this->session->userdata('manager');
		$this->load->view('inv/invi02_v', $data);
	   	
   }
   
    public function findsqlold($num = '', $sort_by = 'create_date', $sort_order = 'desc', $offset = 0)   //篩選
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
        $data['sort_by'] = $sort_by;
		$data['sort_order'] = 'asc' ;		
	      $offset=$this->uri->segment(5)?$this->uri->segment(5):0;
	     $this->load->model('inv/invi02_model','',TRUE);
	     $result=$this->invi02_model->findf($offset,$limit); 
		$data['message'] = '進階查詢資料成功!';	
	    $data['results'] = $result['rows'];
		
	    $data['num_results'] = $result['num_rows'];
	//	$num = '15';    //總筆數
		$this->load->library('pagination');
		$data['numrow']= $result['num_rows'];  // 總筆數 
	    $data['page'] = $result['num_rows']/15;  // 總頁數 
	   
		$config = array();		
		$config['per_page'] = '15';// 每頁筆數
	    $config['total_rows'] = $result['num_rows'];  // 總筆數 
		
	    $config['first_link'] = '首頁';
	    $config['last_link'] = '尾頁';
	    $config ['next_link'] = '下一頁>';
        $config ['prev_link'] = '<上一頁';
	    $config['display_pages'] = TRUE;  //隐藏數字鏈接
		$config['full_tag_open'] = '<p>';
	    $config['full_tag_close'] = '</p>'; 
			 $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>'; // 当前页结束样式
		$config['cur_page'] = $this->uri->segment(5);   //當前頁
	    $this->pagination->initialize($config);//分頁初始化 
	 //   $config['base_url'] = site_url("inv/invi02/findsql");  //設定分頁url路徑		
        $config['base_url'] = '/index.php/inv/invi02/findsql/';  // 設定分頁url路徑		
	//	$config['base_url'] = site_url("inv/invi02/findsql/$sort_by/$sort_order");  //設定分頁url路徑	
        $config['per_page'] = $limit;	
		$config['uri_segment'] = 5;
		 $this->load->library('table');//加載table函數
		$this->pagination->initialize($config);	
		
		 $result=$this->invi02_model->findf($offset,$limit); 
        $data['results'] =  array_slice($result['rows'], intval($num), $config['per_page']); // 获取前分页数据	
		
		$data['pagination'] = $this->pagination->create_links();
	     $data['username'] = $this->session->userdata('manager');
		$this->load->view('inv/invi02_v', $data);
	   	
   }
   
   
      public function addform()   //新增
    {
	   
	   $data['date']= date("Ymd");
	   $data['message'] = '';
	    $data['username'] = $this->session->userdata('manager');
		 $data['include'] = 'test1_add5';
		 $this->load->vars($data);
	//	$this->load->view('inv/test1_template5',$data);
       $this->load->view('inv/invi02_add_v',$data);
				
   } 
    public function addsave()   //新增存檔
    {
	   $this->load->helper('url');
	   $date=date("Ymd");
	   $data['username'] = $this->session->userdata('manager');
       $this->db->get('invma');	
       $this->load->model('inv/invi02_model','',TRUE);
	   $data['message'] = '新增成功!';
	    $action = $this->invi02_model->insertf();
		if($action === 'exist')
		{
		     $data['message'] = '資料重複!';		    
	    }
	    $this->load->view('inv/invi02_add_v',$data); 
		
	
  }
  public function copyform()   //複製
    {
	   
	   $data['date']= date("Ymd");
	    $data['username'] = $this->session->userdata('manager');
		$data['message'] = '';
       $this->load->view('inv/invi02_copy_v',$data);
				
   }
   public function copysave()   //複製存檔
    {
	   $this->load->helper('url');
		$date=date("Ymd");
	   $data['username'] = $this->session->userdata('manager');
       $this->db->get('invma');	
       $this->load->model('inv/invi02_model','',TRUE);
	   $data['message'] = '複製成功!';
       $action = $this->invi02_model->copyf();
	   if($action === 'exist')
		{
		     $data['message'] = '資料重複!';		    
	    }
		$this->load->view('inv/invi02_copy_v',$data); 
	  
  }
  
   public function exceldetail()   //轉excel明細
    {
	    
	   $this->load->helper('url');
		$data['date']=date("Ymd");
		 $data['message'] = '';
		 $data['username'] = $this->session->userdata('manager');
	   $this->load->view('inv/invi02_excel_v',$data);
	        
    
  }

  
   public function write()   //轉excel 部份資料由 print_v call
    {
	    
	   $this->load->helper('url');
		$data['date'] = date("Ymd");
	     
       $this->db->get('invma');	
       $this->load->model('inv/invi02_model','',TRUE);
	   $data['message'] = '轉檔excel成功!';
	   $data['username'] = $this->session->userdata('manager');
	   $title = array('ma001','ma002','ma003','ma004','ma005','ma006','create_date');
       	
        $result1 = $this->invi02_model->excelnewf();	 
      	
        $this->excel->writer($title,$result1);    //讀取excel         
	  
  }
  
   public function printdetail()   //印明細
    {
	    
	   $this->load->helper('url');
		$data['date']=date("Ymd");
		 $data['username'] = $this->session->userdata('manager');
		 $data['message'] = '';
	   $this->load->view('inv/invi02_print_v',$data);
	
  }
  public function printa()   //印明細
    {
	    
	   $this->load->helper('url');
		$data['date'] = date("Ymd");
	     
       $this->db->get('invma');	
       $this->load->model('inv/invi02_model','',TRUE);
	   $data['message'] = '列印明細成功!';
         $result = $this->invi02_model->printfd();
	   $data['results'] = $result['rows'];
	    $data['username'] = $this->session->userdata('manager');
	   $this->load->view('inv/invi02_printa_v',$data);
     
  }
   public function updsave()   //修改存檔
    {
	   $this->load->helper('url');
		$date=date("Ymd");
	   $data['message'] = '修改資料成功!';
       $this->db->get('invma');	
       $this->load->model('inv/invi02_model','',TRUE);
	   $this->invi02_model->updatef();  	 
	   $this->display();
 
  }
   

   
    public function editform()    //修改
    {
	   $data['seq1'] = $this->uri->segment(4); 
	   $data['seq2'] = $this->uri->segment(5); 
      
		$data['message'] = '查詢一筆修改資料!';
		$this->db->get('invma');	
		$this->load->vars($data);
	   	$this->load->model('inv/invi02_model');
		$data['result'] = $this->invi02_model->selone($this->uri->segment(4),$this->uri->segment(5));
		$this->load->view('inv/invi02_upd_v',$data);
	
	     //$this->load->view('test2_edit',$data);  
		
		
   }
    public function updform()
    {
       if ($this->input->post('ma002')){
      $seg1=$this->uri->segment(4);
      $seg2=$this->uri->segment(5); 	  
     $this->db->get('invmb');
	 $this->load->model('inv/invi02_model','',TRUE);
    $this->invi02_model->updatef($seg1,$seg2);
	
	$this->load->model('inv/invi02_model','',TRUE);
    $data['result']=$this->invi02_model->selone($seg1,$seg2);
	$this->load->view('inv/invi02_upd_v',$data); 
	
	 }	
   }
    public function del()   //刪除
    {      
       	$seg1=$this->uri->segment(4);
        $seg2=$this->uri->segment(5); 
      
	    $data['message'] = '刪除資料成功!';
	   	$this->load->model('inv/invi02_model','',TRUE);
		$this->invi02_model->deletef($seg1,$seg2);
		$this->display();
      
   }
   public function see()   //看資料
    {      
	  $data['seq1'] = $this->uri->segment(4); 
	   $data['seq2'] = $this->uri->segment(5); 
       
		$data['message'] = '查看一筆資料!';
		$this->db->get('invma');	
		$this->load->vars($data);
	   	$this->load->model('inv/invi02_model');
		$data['result'] = $this->invi02_model->selone($this->uri->segment(4),$this->uri->segment(5));
		$this->load->view('inv/invi02_see_v',$data);
      
   }
   
    public function delete()   //刪除選取
    {            	 
      
	    $data['message'] = '刪除資料成功!';
		
	   	$this->load->model('inv/invi02_model','',TRUE);
		$this->invi02_model->delmutif();
	 //   sleep(1);   //暫停10秒
		$this->display();
      
   }
// 產生： INSERT INTO mytable (title，name，date) VALUES ('{$title}'，'{$name}'，'{$date}')
 


}

/* End of file login.php */
/* Location: ./application/controllers/login.php */