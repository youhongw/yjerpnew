<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajsb22 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		//  $this->firephp->setEnabled(TRUE);  //PHP 除錯工具 FirePHP，它可以輸出 PHP 資料到 FireBug console 介面，方便解決 PHP 相關問題，而不會去影響線上網站的畫面，安裝方式非常簡單，請先安裝 FireFox addon for FirePHP，重新啟動 FireFox 這樣就安裝成功了，接下來就是 include FirePHP Library 檔案，就可以正常使用了
		  
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
	      $data['systitle'] ='還原會計傳票作業 - 還原';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ajs/ajsb22_batch_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//開始計算	
      public function batcha()   
        {
          $this->load->model('ajs/ajsb22_model','',TRUE);
	      $data['message'] = '計算資料完成!';
          
		  $this->ajsb22_model->batchaf();   //刪除傳票
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='還原會計傳票作業 - 還原';
		  $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ajs/ajsb22_batch_v';
		  $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
}
/* End of file ajsb22.php */
/* Location: ./application/controllers/ajsb22.php */
?>