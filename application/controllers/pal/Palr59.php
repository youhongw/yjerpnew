<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palr59 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  date_default_timezone_set("Asia/Taipei");  //設置時區
	    }
		
	  public function index()           //自訂類預設執行函數 流覽資料
	    {
			
	    }
                      
      public function printdetail()   //印明細起迄資料輸入
        {
	     $this->load->model('pal/palr59_model');
		 $result = $this->palr59_model->printcol();
		 $data['data_col'] = $result;
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='薪資印領清冊列印-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/palr59_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function printa()   //印明細
        {
			$data['paper9']=$this->input->post('mv009p');
			$data['dateo']=$this->input->post('dateo');
			$data['datec']=$this->input->post('datec');
			if($this->input->post('action')=="excel"){
				$this->write();
			}
			$this->load->model('pal/palr59_model','',TRUE);
			$data['message'] = '列印明細成功!';
			$result = $this->palr59_model->printfd();
			
			$data['results'] = $result['rows'];
			$data['num_results'] = $result['num_rows'];
			$this->load->library('pagination');
			
			$data['numrow']=$result['num_rows'];// 總筆數 
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='薪資印領清冊列印-印明細表';
			//$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'pal/palr59_printa_v';
			//$data['foot_v'] ='main_footno_v';
			$this->load->vars($data);
			$this->load->view('main_headprint_v');
			//$this->load->view('pal/palr59_printa_v',$data);  
        }
		public function printc()   //印產品銷貨單
        {
		    $data['paper9']=$this->input->post('mv009p');
			$this->load->model('pal/palr59_model','',TRUE);
			$data['message'] = '薪資印領清冊列印!';
			$result = $this->palr59_model->printfc();
		  
			$data['results'] = $result['rows'];
	  
			$this->load->vars($data);
		//  $this->load->view('main_headprint_v');
			$this->load->view('pal/palr59_printc_v');  
        }
		public function printbb()   //印產品銷貨單
        {
			$data['paper9'] = $this->session->userdata('sysma202');
			$this->load->model('pal/palr59_model','',TRUE);
			$data['message'] = '薪資印領清冊列印!';
			$result = $this->palr59_model->printfb();
			$data['results'] = $result['rows'];
			$this->load->vars($data);
			$this->load->view('pal/palr59_printb_v');  
        }
    
	 public function printb()   //印單據選取
        {
			$this->load->model('pal/palr59_model','',TRUE);
			$data['message'] = '列印單據成功!';
			$result = $this->palr59_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
			$data['results'] = $result['rows'];
			$data['num_results'] = $result['num_rows'];
			$this->load->library('pagination');
			$data['numrow']=$result['num_rows'];// 總筆數 
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='薪資印領清冊';	
		//  $this->load->view('pal/palr59_printb_v');
          
			$data['content_v'] = 'pal/palr59_printb_v';	   
			$this->load->vars($data);
			$this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
    //轉excel 檔
    public function write()
      {
		$this->load->model('pal/palr59_model','',TRUE);
		$data['message'] = '轉檔excel成功!';
		$data['username'] = $this->session->userdata('manager');
		$result = $this->palr59_model->printfd();
		$result = $result['rows'];
		
		$date_ary = array();
		preg_match_all('/\d/S',$this->input->post('dateo'), $matches);  //處理日期字串
		$dateo = implode('',$matches[0]);
		preg_match_all('/\d/S',$this->input->post('datec'), $matches);  //處理日期字串
		$datec = implode('',$matches[0]);
		for($i=$dateo;$i<=$datec;$i++){
			$temp_year = substr($i,0,4);$temp_month = substr($i,4,2);
			if($temp_month>12){
				$temp_year++;$temp_month="01";
				$i = $temp_year.$temp_month;
			}
			$date_ary[] = $i;
		}
		$month_ary = array(
			'01' => "一月",'02' => "二月",'03' => "三月",'04' => "四月",
			'05' => "五月",'06' => "六月",'07' => "七月",'08' => "八月",
			'09' => "九月",'10' => "十月",'11' => "十一月",'12' => "十二月",
		);
		$payclass_ary = array(
			'1'=>'薪資','2'=>'薪稅','3'=>'伙食津貼','4'=>'加班費','5'=>'蓋章'
		);
		$title = array('領款人編號','領款人姓名','地址','身分證號','給付別');//excel 表頭
		$width = array(12,12,20,12,12);
		$height = array(array(1,5),5,45);	//結構為:array(每一組中的哪幾個位置),每幾筆為一組,高度
		//以此為例就是指每五筆中的第一與五筆會設為高度45
		foreach($date_ary as $d_key=>$d_val){
			$title[] = $month_ary[substr($d_val,4,2)];
			$width[] = 10;
		}
		$title[] = "總計";
		$width[] = 10;
		
		$temp_data = array();
		//echo "<pre>";var_dump($result);exit;
		foreach($result as $key => $val){
			if(!isset($temp_data[$val->td001])){
				$temp_data[$val->td001] = array();
				$temp_data[$val->td001]['td001'] = $val->td001;
				$temp_data[$val->td001]['td002'] = $val->td002;
				$temp_data[$val->td001]['td054'] = $val->td054;
				$temp_data[$val->td001]['td050'] = $val->td050;
				$temp_data[$val->td001]['me002'] = $val->me002;
				$temp_data[$val->td001]['sa_data'] = array();
			}
		/*	$temp_data[$val->td001]['sa_data']['td047'][$val->td005] = $val->td047;
			$temp_data[$val->td001]['sa_data']['td037'][$val->td005] = $val->td037;
			$temp_data[$val->td001]['sa_data']['td049'][$val->td005] = $val->td049;
			$temp_data[$val->td001]['sa_data']['td044'][$val->td005] = $val->td044;
			$temp_data[$val->td001]['sa_data']['stamp'][$val->td005] = ""; */
			$temp_data[$val->td001]['sa_data']['td047'][$val->td005] = $val->td047;
			$temp_data[$val->td001]['sa_data']['td037'][$val->td005] = $val->td037;
			$temp_data[$val->td001]['sa_data']['td049'][$val->td005] = $val->td049;
			$temp_data[$val->td001]['sa_data']['td044'][$val->td005] = $val->td044;
			$temp_data[$val->td001]['sa_data']['stamp'][$val->td005] = "";
		}
		//echo "<pre>";var_dump($temp_data);exit;
		$excel_data = array();
		foreach($temp_data as $t_key => $t_val){//each 員工
			$row_count = 0;
			foreach($t_val['sa_data'] as $key => $val){//each 列
				$row_count++;
				$temp_row = array();
				$temp_row[] = $t_val['td001'];
				if($row_count == 1){
					$temp_row[] = $t_val['td002'];
					$temp_row[] = $t_val['td054'];
					$temp_row[] = $t_val['td050'];
					$temp_row[] = $payclass_ary[$row_count];
				}else if($row_count == 2){
					$temp_row[] = "";
					$temp_row[] = $t_val['me002'];
					$temp_row[] = "";
					$temp_row[] = $payclass_ary[$row_count];
				}else{
					$temp_row[] = "";
					$temp_row[] = "";
					$temp_row[] = "";
					$temp_row[] = $payclass_ary[$row_count];
				}
				$row_total = 0;$col_count = count($val);
				if(count($date_ary)>$col_count){
					for($i=0;$i<count($date_ary)-$col_count;$i++){
						$temp_row[] = "";
					}
				}
				foreach($val as $k => $v){
					if($v==0){$temp_row[] = "";}
					else{$temp_row[] = $v;}
					$row_total += $v;
				}
				if($row_total==0){
					$temp_row[] = "";
				}else{
					$temp_row[] = $row_total;
				}
				
				$excel_data[] = $temp_row;
			}
		}
		//echo "<pre>";var_dump($excel_data);exit;
		
		//echo "<pre>";var_dump($width_ary);exit;
		$this->excel->writer_special($title,$excel_data,$this->input->post('dateo')."薪資印領清冊列印",$width,$height);    //讀取excel  
      }
}
/* End of file palr59.php */
/* Location: ./application/controllers/palr59.php */
?>