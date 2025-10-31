<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main4 extends CI_Controller {

	public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	parent::__construct();        //繼承父類別
	    $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	    $this->load->library("session");	  
	    $this->load->library('excel');
	    }
	
	public function index()
	   {
	    $data['username'] = $this->session->userdata('manager');
        $data['systitle'] ='雲端ERP企業資源管理系統';
	    $data['menu_v'] = 'main_menu_v';
	    $data['content_v'] = 'main4_v';		
	    $data['foot_v'] ='main_foot_v';
	    $this->load->vars($data);
	    $this->load->view('main_headbrow_v');
	   }
	   
	//不更新網頁   權限Y 
	public function dataadmq05a()   
        {
	    $this->load->model('main_model');
		$data['result'] = $this->main_model->ajaxamdq04a($this->uri->segment(3));
        $Result = $data['result'];	
		$data['sysmg001'] = $this->session->userdata('sysmg001');
		$data['sysmg004'] = $this->session->userdata('sysmg004');
		$data['sysmg006'] = $this->session->userdata('sysmg006');
	    $this->load->vars($data);
	    echo  $Result;
        }
	
      //不更新網頁	使用者權限
	  public function datacmsq05a()   
        {
	    $this->load->model('adm/admi10_model');
	    $data['result'] = $this->admi10_model->ajaxadmi10a($this->uri->segment(4));
        $Result = $data['result'];		  
	    $this->load->vars($data);
	    echo  $Result;
        }
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
?>