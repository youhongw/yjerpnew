<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class palb03 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  $this->firephp->setEnabled(TRUE);
		  
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
	      $this->load->model('pal/palb03_model');     // 加載TABLE model 模型		
	      $result= $this->palb03_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
	      $config['base_url'] = site_url("pal/palb03/display/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='特休控管計算';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/palb03_brow_v';		
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
	      $data['systitle'] ='特休控管計算-計算';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/palb03_batch_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//開始計算	
      public function batcha()
        {
          $this->load->model('pal/palb03_model','',TRUE);
	      $data['message'] = '計算資料完成!';
		  preg_match_all('/\d/S',$this->input->post('dateym'), $matches);  //處理日期字串
		  $seq1 = implode('',$matches[0]);
          
		 // $data['message'] = $this->palb03_model->batchaf($seq1);   //invlc 表
		  $this->palb03_model->batchaf($seq1); 
		//  echo "<pre>";var_dump($seq1);exit;
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='特休控管-計算';
		  $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/palb03_batch_v';
		  $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v'); 
        }
	public function batch_ajax()
		{
			$this->load->model('pal/palb03_model','',TRUE);
			$data['message'] = '計算資料完成!';
			preg_match_all('/\d/S',$this->input->get('dateym'), $matches);  //處理日期字串
			$seq1 = implode('',$matches[0]);
			$data['message'] = $this->palb03_model->batchaf($seq1);   //invlc 表
			
			echo json_encode($data['message']);
		
		}
	public function check_batch_ajax()
		{
			session_start();
			$percent = round($_SESSION['palb03']['current_num']/$_SESSION['palb03']['total_num'],2);
			echo json_encode($percent);
		}
	
	//提示資料重複 類別代號 key 5	
	 public function checkkey()   
        {
	     $this->load->model('pal/palb03_model');
	     $data['result'] = $this->palb03_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];		  
	     $this->load->vars($data);
	     echo  $Result;
        }
}
/* End of file palb03.php */
/* Location: ./application/controllers/palb03.php */
?>