<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi01 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -  
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() 
	  { parent::__construct();     
	  //$this->load->helper('url');   //載入預設url 庫函數及數据庫配置 
	 // $this->load->database(); 
	 
	  }
	public function index()
	{   	
	  $data['fields'] = array(
		   
			'ma001' => 'ma001',
			'ma002' => 'ma002',
			'ma003' => 'ma003',
			'ma004' => 'ma004',
			'ma005' => 'ma005',
			'ma006' => 'ma006'
			
		);
      $data['sort_order'] =  'asc';	
	  $data['sort_by'] =  'ma001';	
	  $data['date']= date("Y/m/d");
	  $data['numrow']=$this->db->count_all_results('invma');// 總筆數 
	  $data['page']=$this->db->count_all_results('invma')/15; // 總頁數 
      $this->load->helper('url'); 
	  $this->load->library('pagination');//加載分頁類 
	  $this->load->model('inv/invi01_model');// 加載TABLE model 模型 
	  $config['base_url'] = base_url().'index.php/inv/invi01/index';//設定分頁url路徑
	  $config['total_rows'] = $this->db->count_all_results('invma');// 總筆數 
	  $config ['uri_segment'] = 4; //設置url上第几段用于傳分頁器的偏移量
	  $config['per_page'] = '15';// 每頁筆數
	  $config['first_link'] = '首頁';
	  $config['last_link'] = '尾頁';
	  $config ['next_link'] = '下一頁>';
      $config ['prev_link'] = '<上一頁';
	  $config['display_pages'] = TRUE;  //隐藏數字鏈接
	//  $config['num_links']=3;  //當前頁碼前後數字鏈結數量
	//  $config['last_tag_open'] = '';  //最後一頁鏈結打開標簽。
	//  $config['cur_tag_open'] = '<li>';//當前鏈結打開標簽。
	  $config['full_tag_open'] = '<p>';
	  $config['full_tag_close'] = '</p>'; 
	  $this->pagination->initialize($config);//分頁初始化 
	 // $data['results']=  $this->invi01_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄 
	  $result=  $this->invi01_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄 
	  $data['results'] = $result['rows'];
	  $this->load->library('table');//加載table函數	  
	   $this->pagination->initialize($config);//初始化 
      $this->load->view('inv/invi01_v',$data);   
	  
	  //允許你檢索特定的區段部份。n 是您想檢索的特定區段，區段是由左到右順序排列，底下簡單來說，假設您的 URL 網址如下：
	  //http://example.com/index.php/news/local/metro/crime_is_up  全部的區段分別是：news,local,metro,crime_is_up  
	 // $data['results']=  $this->invi01_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄                          
	 
	    
	}
	   //表頭排序
	 public function display($sort_by = 'ma002', $sort_order = 'asc', $offset = 0) {
		
		$limit = 15;
		$data['fields'] = array(
		   
			'ma001' => 'ma001',
			'ma002' => 'ma002',
			'ma003' => 'ma003',
			'ma004' => 'ma004',
			'ma005' => 'ma005',
			'ma006' => 'ma006'
			
		);
		$this->load->helper('url'); 
		
	   // $config['base_url'] = base_url().'index.php/inv/invi01/display/$sort_by/$sort_order';//設定分頁url路徑
		$this->load->model('inv/invi01_model');// 加載TABLE model 模型 
		$result= $this->invi01_model->search($limit, $offset, $sort_by, $sort_order);
		
		$data['results'] = $result['rows'];
	//	$data['num_results'] = $result['num_rows'];
		
		// pagination
		$this->load->helper('url');
		$this->load->library('pagination');
		 $data['numrow']=$this->db->count_all_results('invma');// 總筆數 
	     $data['page']=$this->db->count_all_results('invma')/15; // 總頁數 
		$config = array();
		
		//$config['NUM_LINKS'] = 2;
		 $config['per_page'] = '15';// 每頁筆數
	  $config['first_link'] = '首頁';
	  $config['last_link'] = '尾頁';
	  $config ['next_link'] = '下一頁>';
      $config ['prev_link'] = '<上一頁';
	  $config['display_pages'] = TRUE;  //隐藏數字鏈接
		$config['full_tag_open'] = '<p>';
	  $config['full_tag_close'] = '</p>'; 
	  $this->pagination->initialize($config);//分頁初始化 
		//$config['base_url'] = site_url("inv/invi01/display/$sort_by/$sort_order");
		$config['base_url'] = base_url().'index.php/inv/invi01/display/$sort_by/$sort_order';//設定分頁url路徑
		$config['total_rows'] = $this->db->count_all_results('invma');// 總筆數
		$config['per_page'] = $limit;
		$config['uri_segment'] = 6;
		 $this->load->library('table');//加載table函數
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;

		
		$this->load->view('inv/invi01_v', $data);
	} 	
	 public function sorth($sorth1)   //排序
    {
	   echo $sorth1;
	   $data['date']= date("Ymd");
       $this->load->view('inv/invi01_add_v',$data);
				
   }
    public function addform()   //新增
    {
	   
	   $data['date']= date("Ymd");
       $this->load->view('inv/invi01_add_v',$data);
				
   }
    public function addsave()
    {
	   $this->load->helper('url');
		$date=date("Ymd");
	
       $this->db->get('invma');	
       $this->load->model('inv/invi01_model','',TRUE);
	   echo 'insert-addsave';
       $this->invi01_model->insertf();
	   $this->load->view('inv/invi01_add_v',$date);
      // redirect('invi01/addedit','refresh');
 
    //    return FALSE;
      // redirect('invi01','refresh');
  }
   public function updsave()
    {
	   $this->load->helper('url');
		$date=date("Ymd");
	
       $this->db->get('invma');	
       $this->load->model('inv/invi01_model','',TRUE);
	   echo '修改存檔';
       $this->invi01_model->updatef();
	   	   
	  $data['date']= date("Ymd");
	  $data['numrow']=$this->db->count_all_results('invma');// 總筆數 
	  $data['page']=$this->db->count_all_results('invma')/15; // 總頁數 
      $this->load->helper('url'); 
	  $this->load->library('pagination');//加載分頁類 
	  $this->load->model('inv/invi01_model');// 加載TABLE model 模型 
	  $config['base_url'] = base_url().'index.php/inv/invi01/index';//設定分頁url路徑
	  $config['total_rows'] = $this->db->count_all_results('invma');// 總筆數 
	  $config ['uri_segment'] = 4; //設置url上第几段用于傳分頁器的偏移量
	  $config['per_page'] = '15';// 每頁筆數
	  $config['first_link'] = '首頁';
	  $config['last_link'] = '尾頁';
	  $config ['next_link'] = '下一頁>';
      $config ['prev_link'] = '<上一頁';
	  $config['display_pages'] = TRUE;  //隐藏數字鏈接
	//  $config['num_links']=3;  //當前頁碼前後數字鏈結數量
	//  $config['last_tag_open'] = '';  //最後一頁鏈結打開標簽。
	//  $config['cur_tag_open'] = '<li>';//當前鏈結打開標簽。
	  $config['full_tag_open'] = '<p>';
	  $config['full_tag_close'] = '</p>'; 
	  $this->pagination->initialize($config);//分頁初始化 
	  $data['results']=  $this->invi01_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄 
	  $this->load->library('table');//加載table函數	  
	   $this->pagination->initialize($config);//初始化 
      $this->load->view('inv/invi01_v',$data);   
      // redirect('invi01/addedit','refresh');
 
    //    return FALSE;
      // redirect('invi01','refresh');
  }
  
  
   
		//$this->invi01_model->insert(); 
	//	if ($this->invi01_model->insertf()) {
	//	$this->load->view('inv/invi01_add_v'); 
	//	}
   
    public function editform()
    {
	   $data['seq1'] = $this->uri->segment(4); 
	   $data['seq2'] = $this->uri->segment(5); 
       	echo $this->uri->segment(4);
		$this->db->get('invma');	
		$this->load->vars($data);
	   	$this->load->model('inv/invi01_model');
		$data['result'] = $this->invi01_model->selone($this->uri->segment(4),$this->uri->segment(5));
		$this->load->view('inv/invi01_upd_v',$data);
	
	     //$this->load->view('test2_edit',$data);  
		
		
   }
    public function updform()
    {
       if ($this->input->post('ma002')){
      $seg1=$this->uri->segment(4);
      $seg2=$this->uri->segment(5); 	  
     $this->db->get('invmb');
	 $this->load->model('inv/invi01_model','',TRUE);
    $this->invi01_model->updatef($seg1,$seg2);
	// $data['include'] = 'test2_edit';
	// $this->load->vars($data);
	$this->load->model('inv/invi01_model','',TRUE);
    $data['result']=$this->invi01_model->selone($seg1,$seg2);
	$this->load->view('inv/invi01_upd_v',$data); 
	
	 }	
   }
    public function del()
    {      
       	$seg1=$this->uri->segment(4);
        $seg2=$this->uri->segment(5); 
       // $this->load->database(); 		
      //  $this->db->get('invmb');
	   	$this->load->model('inv/invi01_model','',TRUE);
		$this->invi01_model->deletef($seg1,$seg2);

        $data['date']= date("Ymd");
	  $data['numrow']=$this->db->count_all_results('invma');// 總筆數 
	  $data['page']=$this->db->count_all_results('invma')/15; // 總頁數 
      $this->load->helper('url'); 
	  $this->load->library('pagination');//加載分頁類 
	  $this->load->model('inv/invi01_model');// 加載TABLE model 模型 
	  $config['base_url'] = base_url().'index.php/inv/invi01/index';//設定分頁url路徑
	  $config['total_rows'] = $this->db->count_all_results('invma');// 總筆數 
	  $config ['uri_segment'] = 4; //設置url上第几段用于傳分頁器的偏移量
	  $config['per_page'] = '15';// 每頁筆數
	  $config['first_link'] = '首頁';
	  $config['last_link'] = '尾頁';
	  $config ['next_link'] = '下一頁>';
      $config ['prev_link'] = '<上一頁';
	  $config['display_pages'] = TRUE;  //隐藏數字鏈接
	//  $config['num_links']=3;  //當前頁碼前後數字鏈結數量
	//  $config['last_tag_open'] = '';  //最後一頁鏈結打開標簽。
	//  $config['cur_tag_open'] = '<li>';//當前鏈結打開標簽。
	  $config['full_tag_open'] = '<p>';
	  $config['full_tag_close'] = '</p>'; 
	  $this->pagination->initialize($config);//分頁初始化 
	  $data['results']=  $this->invi01_model->selbrowse($config['per_page'],$this->uri->segment(4));//得到數据庫記錄 
	  $this->load->library('table');//加載table函數	  
	   $this->pagination->initialize($config);//初始化 
      $this->load->view('inv/invi01_v',$data);   
    	
   }
  
// 產生： INSERT INTO mytable (title，name，date) VALUES ('{$title}'，'{$name}'，'{$date}')
 


}

/* End of file login.php */
/* Location: ./application/controllers/login.php */