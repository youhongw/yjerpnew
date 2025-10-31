<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palr58 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
			
	    }
                      
      public function printdetail()   //印明細起迄資料輸入
        {
	     $this->load->model('pal/palr58_model');
		 $result = $this->palr58_model->printcol();
		 $data['data_col'] = $result;
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='生日名冊列印-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/palr58_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function printa()   //印明細
        {
			$data['paper9']=$this->input->post('mv009p');
			$data['dateo']=$this->input->post('dateo');
			$data['datec']=$this->input->post('datec');
			if($this->input->post('action')=="excel"){
				$this->write();
			}
			$this->load->model('pal/palr58_model','',TRUE);
			$data['message'] = '列印明細成功!';
			$result = $this->palr58_model->printfd();
			$data['results'] = $result['rows'];
			$data['num_results'] = $result['num_rows'];
			$this->load->library('pagination');
			$data['numrow']=$result['num_rows'];// 總筆數 
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='生日名冊列印-印明細表';
			//$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'pal/palr58_printa_v';
			//$data['foot_v'] ='main_footno_v';
			$this->load->vars($data);
			$this->load->view('main_headprint_v');
			//$this->load->view('pal/palr58_printa_v',$data);  
        }
		public function printc()   //印產品銷貨單
        {
		    $data['paper9']=$this->input->post('mv009p');
			$this->load->model('pal/palr58_model','',TRUE);
			$data['message'] = '生日名冊列印!';
			$result = $this->palr58_model->printfc();
		  
			$data['results'] = $result['rows'];
	  
			$this->load->vars($data);
		//  $this->load->view('main_headprint_v');
			$this->load->view('pal/palr58_printc_v');  
        }
		public function printbb()   //印產品銷貨單
        {
			$data['paper9'] = $this->session->userdata('sysma202');
			$this->load->model('pal/palr58_model','',TRUE);
			$data['message'] = '生日名冊列印!';
			$result = $this->palr58_model->printfb();
			$data['results'] = $result['rows'];
			$this->load->vars($data);
			$this->load->view('pal/palr58_printb_v');  
        }
    
	 public function printb()   //印單據選取
        {
			$this->load->model('pal/palr58_model','',TRUE);
			$data['message'] = '列印單據成功!';
			$result = $this->palr58_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
			$data['results'] = $result['rows'];
			$data['num_results'] = $result['num_rows'];
			$this->load->library('pagination');
			$data['numrow']=$result['num_rows'];// 總筆數 
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='生日名冊';	
		//  $this->load->view('pal/palr58_printb_v');
          
			$data['content_v'] = 'pal/palr58_printb_v';	   
			$this->load->vars($data);
			$this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
    //轉excel 檔
    public function write()
      {
       $this->load->model('pal/palr58_model','',TRUE);
	   $data['message'] = '轉檔excel成功!';
	   $data['username'] = $this->session->userdata('manager');
	   $title = array('部門名稱','員工代號','員工姓名','生日日期','到職日','離職日');//excel 表頭
	   $width = array(12,10,12,12,12,12);
       $result = $this->palr58_model->printfd();
	   $result = $result['rows'];
	   foreach($result as $key => $val){
		  $val->mv008 = substr($val->mv008,0,4)."/".substr($val->mv008,4,2)."/".substr($val->mv008,6,2);
		  $val->mv021 = substr($val->mv021,0,4)."/".substr($val->mv021,4,2)."/".substr($val->mv021,6,2);
		  if($val->mv022){$val->mv022 = substr($val->mv022,0,4)."/".substr($val->mv022,4,2)."/".substr($val->mv022,6,2);}
	   }
	   
	   //echo "<pre>";var_dump($width_ary);exit;
       $this->excel->writer_special($title,$result,$this->input->post('dateo')."員工生日名冊",$width);    //讀取excel  
      }
}
/* End of file palr58.php */
/* Location: ./application/controllers/palr58.php */
?>