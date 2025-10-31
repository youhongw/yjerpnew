<?php

class Test2 extends CI_Controller {

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
	 // $this->load->helper('url');   //載入預設url 庫函數及數据庫配置 
	 // $this->load->database(); 
	 $this->load->helper('form');
	 $this -> load -> library( 'form_validation' ); 
	 //  $data['title'] = "Welcome to our Site";   //設定全域變數
	 //  $data['headline'] = "Welcome!";
	  // $data['include'] = 'test2_home';
	  // $CI =& get_instance();
	 //  $this->load->vars($data);
	  }
	  
	  public function index($num='') {  
	  
	         //select
			  $data['title'] = "Welcome to our Site"; 
			 $data['headline'] = "Welcome!";
			  $data['include'] = 'test2_home';
	           $this->load->vars($data);
                $this->load->model('test2_model');
				
				$this->load->library('pagination'); // 加载分页类
        $config['base_url'] = '/index.php/test2/index/';  // 分页的基础 URL
        $config['total_rows'] = 100; // 统计数量
        $config['per_page'] = 2; // 每页显示数量，为了能有更好的显示效果，我将该数值设置得较小
        $config['num_links'] = 3; // 当前连接前后显示页码个数
        $config['full_tag_open'] = '<div class="pagination">'; // 分页开始样式
        $config['full_tag_close'] = '</div>'; // 分页结束样式
        $config['first_link'] = '首页'; // 第一页显示
        $config['last_link'] = '末页'; // 最后一页显示
        $config['next_link'] = '下一页 >'; // 下一页显示
        $config['prev_link'] = '< 上一页'; // 上一页显示
        $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>'; // 当前页结束样式
        $this->pagination->initialize($config); // 配置分页
       
		 $data['result'] = $this->test2_model->select();
		 $data['result'] =  array_slice($data['result'], intval($num), $config['per_page']); // 获取前分页数据
        $data['pager'] = $this->pagination->create_links();
     //   $this->load->view('page', $data);

             //   $data['result'] = $this->test2_model->select();
                $this->load->view('test2_v',$data);

                //update
                if($this->input->post('update') === 'update')
                {
                        $id=$this->input->post('id');
						echo $id;
                        $this->test2_model->update($id);
                }

                //delete
                if($this->input->post('act') === 'delete')
                {
                        $id=$this->input->post('id');
                        $this->test2_model->delete($id);
                }
                //insert
                if($this->input->post('insert') === 'insert')
                {
                 
                       $this->load->view('test2_template');
						
                }
   	  
       }
	   public  function edit1(){	
    $kk=$this->uri->segment(3);       
	$this->db->get('test');	
    $this->load->model('test2_model','',TRUE);
    $data['result']=$this->test2_model->selone($kk);
	$this->load->view('test2_edit',$data);   
  }
  
 public  function editsave(){   
  if ($this->input->post('name')){
      $kk=$this->uri->segment(3); 
     $this->db->get('test');
	$this->load->model('test2_model','',TRUE);
    $this->test2_model->update($kk);
	 $data['include'] = 'test2_edit';
	 $this->load->vars($data);
	$this->load->model('test2_model','',TRUE);
    $data['result']=$this->test2_model->selone($kk);
	$this->load->view('test2_edit',$data); 
	}
}
	  public  function contactus(){
     // $this->load->helper('url');
  if ($this->input->post('name')){
    $this->db->get('test');
	
    $this->load->model('test2_model','',TRUE);
    $this->test2_model->insert();
	// $data['title'] = "Welcome to our Site";
   //   $data['headline'] = "Welcome!";
   //   $data['include'] = 'test2_home';
	//  $this->load->vars($data);
      $this->load->view('test2_template');
    // redirect('test2','refresh');
  }else{
      return FALSE;
   // redirect('test2','refresh');
  }
}
/**
	 * 编辑用户
	 */
	function edit()
	{
		$this->check_power('測試列表');
		$edit_id = $this->uri->segment(4);
		$view_datas['edit_data'] = $this->m_common->get_one('test', array('id' => $edit_id));
		if($view_datas['edit_data'])
		{
			$view_datas['title'] = '编辑測試';
			if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
			{
				$post['name'] = $this->input->post('name');
				$post['hobby'] = $this->input->post('hobby');
				$action = $this->m_common->update('test', $post, array('id' => $edit_id));
				$view_datas['edit_data'] = array_merge($view_datas['edit_data'], $post);
				if($action)
				{
					$view_datas['submit_info'] = array('title' => '编辑成功');
				} else {
					$view_datas['submit_info'] = array('title' => '资料未修改或更新失败');
				}
			}
			$this->load->view($this->file_name . 'edit', $view_datas);
		} else {
			redirect('test2/edit1');
		}
	}
	
	/**
	 * 删除用户
	 */
	public function del()
	{		
	$kk=$this->uri->segment(3);       
	$this->db->get('test');	
    $this->load->model('test2_model','',TRUE);
    $this->test2_model->delete($kk);
	 $data['title'] = "Welcome to our Site"; 
			 $data['headline'] = "Welcome!";
			  $data['include'] = 'test2_home';
	           $this->load->vars($data);
                $this->load->model('test2_model');
                $data['result'] = $this->test2_model->select();
                $this->load->view('test2_v',$data);
	}

}
?>

