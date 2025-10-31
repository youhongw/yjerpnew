<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajsb01 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
          $this->batcha();
	    }
	
		
     //計算資料輸入
      public function batch()   
        {
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='產生分錄底稿-轉入';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ajs/ajsb01_batch_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//開始計算	
      public function batcha()   
        {
		   $mq311=$this->input->post('mq311'); 
		   $mq312=$this->input->post('mq312'); 	
			//var_dump($mq311.'kkkkk'.$mq312);exit;
			
		   $this->load->model('ajs/ajsb01_model','',TRUE);
	      $data['message'] = '計算資料完成!';
		  if ($mq311=='Y') {  $this->ajsb01_model->batchbf();}   //收款
		  if ($mq312=='Y') {  $this->ajsb01_model->batchaf();}   //付款
		  
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='產生分錄底稿-轉入';
		  $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ajs/ajsb01_batch_v';
		  $data['foot_v'] = 'main_foot_v';
		  $data['date'] = $this->input->post('dateyymm');
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
		  //$this->tempfunc();
        }
	  public function transdata($date){
		  $this->load->model('ajs/ajsb01_model','',TRUE);
		  $this->ajsb01_model->batchaf($date);   //invlc 表
	  }	
		
	//提示資料重複 類別代號 key 5	
	 public function checkkey()   
        {
	     $this->load->model('ajs/ajsb01_model');
	     $data['result'] = $this->ajsb01_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];
	     $this->load->vars($data);
	     echo  $Result;
        }
}
/* End of file ajsb01.php */
/* Location: ./application/controllers/ajsb01.php */
?>