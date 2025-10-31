<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class invb01 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
	    }
		
     //計算資料輸入
      public function batch()   
        {
	      //$this->load->helper('url');
	      //$data['date']=date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='帳面數量賦予作業-印明細表';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'inv/invb01_batch_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//開始計算	
      public function batcha()   
        {
          $this->load->model('inv/invb01_model','',TRUE);
	      $data['message'] = '計算資料完成!';
          
		  $this->invb01_model->batchaf();   //帳面及實盤數量
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='帳面數量賦予作業-結轉';
		  $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'inv/invb01_batch_v';
		  $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
}
/* End of file invb01.php */
/* Location: ./application/controllers/invb01.php */
?>