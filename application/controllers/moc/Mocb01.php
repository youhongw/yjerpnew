<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mocb02 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
	      $data['systitle'] ='自動領料作業 - 產生';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'moc/mocb01_batch_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//開始計算	
      public function batcha()   
        {
          $this->load->model('moc/mocb02_model','',TRUE);
	      $data['message'] = '計算資料完成!';
          
		  $this->mocb02_model->batchaf();   //帳面及實盤數量
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='自動領料作業 - 產生';
		  $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'moc/mocb02_batch_v';
		  $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
	      public function updform()   //複製資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='訂單更新狀態-轉製令用';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/mocb02_upd_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function updsave()   //複製存檔
        {
		 $ta001o=$this->input->post('ta001o');
		 $ta001c=$this->input->post('ta001c');
		 $ta002o=$this->input->post('ta002o');
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('moc/mocb02_model','',TRUE);
	     $data['message'] = '更新成功!';
         $action = $this->mocb02_model->updf($ta001o,$ta001c,$ta002o);
	     if ($action === '0')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '查無訂單或訂單尚未自動結案，無法更新!';	
		   }
		ELSE
		   {
			 $data['message'] = "更新成功!";		
	       }
	     $data['systitle'] ='訂單更新狀態-轉製令用';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/mocb02_upd_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
		}
}
/* End of file mocb02.php */
/* Location: ./application/controllers/mocb02.php */
?>