<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

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
	  public function index() {  
	 
	  $this->load->helper('url'); 
	  $this->load->library('pagination');//加載分頁類 
	  $this->load->model('test_model');// 加載TABLE 模型 
	 // $data = array('tests' => $this->test_model->get_test(0));
	 // $res = $this->db->get('test');// 查詢table 
	  $config['base_url'] = base_url().'index.php/test/index';//設定分頁url路徑
	  $config['total_rows'] = $this->db->count_all_results('test');// 總筆數 
	  $config['per_page'] = '2';// 每頁筆數
	  $config['first_link'] = '首頁';
	  $config['last_link'] = '尾頁';
	  $config['full_tag_open'] = '<p>'; 
	  $config['full_tag_close'] = '</p>'; 
	  $this->pagination->initialize($config);//分頁初始化 
	  $data['results']=  $this->test_model->get_test($config['per_page'],$this->uri->segment(3));//得到数据库记录 
	                          //允許你檢索特定的區段部份。n 是您想檢索的特定區段，區段是由左到右順序排列，底下簡單來說，假設您的 URL 網址如下：
							  //http://example.com/index.php/news/local/metro/crime_is_up  全部的區段分別是：news,local,metro,crime_is_up   
	  $this->load->library('table');//加载table函数
	  $this->table->set_heading('編號','名字','描述'); 
	  $tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="0">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );

            $this->table->set_template($tmpl); 
			 //以下是設定樣式
  $config['full_tag_open']   = '';
  $config['full_tag_close']  = '';
  $config['first_link']      = '首頁';
  $config['last_link']       = '末頁';
  $config['next_link']       = '下一頁>';
  $config['prev_link']       = '<上一頁';
  
  $this->pagination->initialize($config);//初始化 
	  $this->load->view('test_v',$data);// 調用客戶端 
	   if($this->input->post('insert') === 'insert')

                {

                        $this->test_model->insert();

                }
	  
	  
	  
	  
	  
	  
       }
	   
	  	   
	   
	   
	   
	  
		
		function page($offset)
 {
 $this->load->helper('url');
  $this->load->library('pagination');   
  $data['title'] = "留言板"; //設定title
  $data['heading'] = "留言板";//設定標題 
  $data['all'] = $this->db->count_all_results('test'); 
  $config['base_url'] = base_url().'index.php/test/page/';//設定頁面輸出網址
  $config['total_rows'] = $this->db->count_all_results('test'); //計算所有筆數
  $config['per_page'] = '2'; //一個分頁的數量
  //以下是設定樣式
  $config['full_tag_open']   = '
';
  $config['full_tag_close']  = '
';
  $config['first_link']      = '首頁';
  $config['last_link']       = '末頁';
  $config['next_link']       = '下一頁>';
  $config['prev_link']       = '<上一頁';
  
  $this->pagination->initialize($config);//初始化 
  $this->db->order_by('id','desc');
  $this->db->limit($config['per_page'],$offset);
   $data['query']=$this->db->get('test');
        $data['pagelist']=$this->pagination->create_links();//顯示分頁，如果沒有分頁不會印出
        $this->load->view('test_v',$data);
   
 }

		
		public function page1($offset)	
	{
	   $this->load->model('test_model');
			     $data = array('tests' => $this->test_model->getArticle($offset));
			     $this->load->view('test_v',$data);
	  }
	public	function show_all($offset)
{
  //載入'分頁類'
  $this->load->library('pagination');
  $this->load->helper('form');
  $this->load->helper('url');
  //根據組合條件，計算記錄總數，（當前組合條件為空）
  $config['total_rows'] = $this->db->count_all_results('test');
  //設置本頁路徑
  $config['base_url'] = "http://ci.dercaster.com/index.php/test/show_all/1";
  //設置每頁顯示記錄數
  $config['per_page'] = '3';
  //設置分頁導航條樣式
  $config['full_tag_open']   = '<div id = "page_nav">';
  $config['full_tag_close']  = '</div>';
  $config['first_link']      = '首頁';
  $config['last_link']       = '末頁';
  $config['next_link']       = '下一頁>';
  $config['prev_link']       = '<上一頁';
  //應用設置
  $this->pagination->initialize($config);
  //設置查詢條件
 // $this->db->select('');
  //排序順序
 // $this->db->order_by("id", "desc");
  //limit(結果數，偏移量)
  $this->db->limit($config['per_page'],$offset);
  //查詢
  $this->load->model('test_model');
   $data = array('tests' => $this->test_model->getArticle());
			     $this->load->view('test_v',$data);
 // $query = $this->db->get('test');
  //顯示結果列表
 // foreach ($query->result_array() as $row){
 //   $this->table->add_row($row);
 // }
 // echo $this->table->generate();
  //添加分頁導航條
 // echo $this->pagination->create_links();
} 


		
		
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */