<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invb03 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		 // $this->firephp->setEnabled(TRUE);
		  
	    }
		
	//自訂類預設執行函數 流覽資料
	  public function index()           
	    {                      
          $limit = 15;    //每頁筆數
	      $sort_order =  'desc';
          $sort_by= 'ma001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('inv/invb03_model');     // 加載TABLE model 模型		
	      $result= $this->invb03_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
	      $config['base_url'] = site_url("inv/invb03/display/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='每月月底統計作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'inv/invb03_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
		
	
	
		
     //計算資料輸入
      public function batch()   
        {
	      //$this->load->helper('url');
	      //$data['date']=date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='每月月底統計-印明細表';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'inv/invb03_batch_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//開始計算	
      public function batcha()   
        {
          $this->load->model('inv/invb03_model','',TRUE);
	      $data['message'] = '計算資料完成!';
          $this->invb03_model->batchaf();   //計算庫存數量
		  $this->invb03_model->batchbf();   //轉入異動庫存明細表
		//  $this->invb03_model->batchcf();   //試算表
		//  $this->invb03_model->batchdf();   //試算表餘額檔
		//  $this->invb03_model->batchef();   //損益表餘額檔
		//  $this->invb03_model->batchff();   //損益表報表檔   --- 1040623
		//  $this->invb03_model->batchgf();   //資產負債表報表檔
	 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='每月月底計算-作業';
		  $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'inv/invb03_batch_v';
		  $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//提示資料重複 類別代號 key 5	
	 public function checkkey()   
        {
	     $this->load->model('inv/invb03_model');
	     $data['result'] = $this->invb03_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];		  
	     $this->load->vars($data);
	     echo  $Result;
        }
}
/* End of file invb03.php */
/* Location: ./application/controllers/invb03.php */
?>