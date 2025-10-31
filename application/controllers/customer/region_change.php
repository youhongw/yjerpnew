<?php
class Region_change extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
	    }
 
 
public function index()
    {      
     
    }
public function select_children()
{
            $segments = $this->uri->uri_to_assoc();
            //var_dump($segments['parent_id']);
            $this->load->model('region_model');
            $data['children']   = $this->region_model->children_of($segments['parent_id']);
            echo json_encode($data['children']);  //返回json格式的資料
}	
?>