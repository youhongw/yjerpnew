<?php
class Info extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
	    }
 
 
public function index()
    {      
       $data = array();
    $data['css'][0] = "<link type='text/css' rel='stylesheet' href='<?=base_url()?>assets/css/userhome.css'>";
    $data['css'][1] = "<link type='text/css' rel='stylesheet' href='<?=base_url()?>assets/css/user_userinfo.css'>";
    $data['title'] = '個人資料';
    $this->load->model('customer_model');
           //從session中取出用戶(用戶管理中心)對應的id，然後通過此id來取出對應的使用者的相關資料資訊
    $data['customer'] = $this->customer_model->load($this->session->userdata('user_id'));
           $this->load->model('customer_address_model');
           //通過取出來的id來到customer_address表中相關的資訊
    $data['address'] = $this->customer_address_model->load($data['customer']['id']);
           //var_dump($data['address']);
           //為空的話，說明此用戶還沒有添加自己的相關資料資訊
    if (empty($data['address'])){
           $data['address'] = array(
                'id' => null,
                'address_name' => null,
    'consignee' => null,
    'phone' => null,
    'mobile' => null,
    'invoice_head' => null,
    'province_id' => null,
    'city_id' => null,
    'district_id' => null,
    'address' => null,
    'postcode' => null,
    'fax' => null,
    'remark' => null,
    'is_default' => null,
            );
    }
          //如果不為空的話，說明用戶已經添加了 自己的相關資料資訊
          //將資訊傳給視圖
    $this->load->view('customer/district_select',$data);
    }
	
?>