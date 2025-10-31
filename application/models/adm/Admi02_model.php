<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admi02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	    $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006, create_date');
        $this->db->from('admmb');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('admmb');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
        }
	
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('admi02_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mb001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['admi02']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['admi02']['search']['where'];
		}
		
		if($this->input->post('find005')){
			if($where){$where .= " and ";}
			$where .= $this->input->post('find005');
		}
		
		if($func == "and_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " and ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($func == "or_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " or ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($where == ""){$where=false;}
		/* where end */
		
		/* order 處理區域 */
		if($this->input->post('find007')){
			$order = $this->input->post('find007');
		}else{
			$order = "";
		}
		
		if($func == "order" && @strlen($val)!=0){
			$value = $val;
			$order = $value;
		}else{
			$order = "";
		}
		
		if(isset($_SESSION['admi02']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['admi02']['search']['order'];
		}
		
		if(!isset($_SESSION['admi02']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mb001,mb002,create_date')
			->from('admmb')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mb001,mb002,create_date')
			->from('admmb')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['admi02']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('admmb');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['admi02']['search']['where'] = $where;
		$_SESSION['admi02']['search']['order'] = $order;
		$_SESSION['admi02']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	
	//程式代號(單身)
	function construct_sql_body($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('admi02_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mb001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['admi02_body']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['admi02_body']['search']['where'];
		}
		
		if($this->input->post('find005')){
			if($where){$where .= " and ";}
			$where .= $this->input->post('find005');
		}
		
		if($func == "and_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " and ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($func == "or_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " or ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($where == ""){$where=false;}
		
		/* where end */
		
		/* order 處理區域 */
		if($this->input->post('find007')){
			$order = $this->input->post('find007');
		}else{
			$order = "";
		}
		
		if($func == "order" && @strlen($val)!=0){
			$value = $val;
			$order = $value;
		}else{
			$order = "";
		}
		
		if(isset($_SESSION['admi02_body']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['admi02_body']['search']['order'];
		}
		
		if(!isset($_SESSION['admi02_body']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mb001,mb002')
			->from('admmb')
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mb001,mb002')
			->from('admmb')
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['admi02_body']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('admmb');
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['admi02_body']['search']['where'] = $where;
		$_SESSION['admi02_body']['search']['order'] = $order;
		$_SESSION['admi02_body']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006', 'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006,  create_date')
	                      ->from('admmb')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('admmb');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	    }
		
	//ajax 查詢一筆 資料重複 主鍵  
	function ajaxkey($seg1)     
        { 	              
	    $this->db->set('mb002', $this->uri->segment(4));
	    $this->db->where('mb002', $this->uri->segment(4));	
	    $query = $this->db->get('admmb');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->mb002;
         }
		  return $result;   
		 }
	    }
		
	 //查詢一筆 修改用  
	function selone()    
        { 
		 $this->db->select('*');	
	     $this->db->set('mb001', $this->uri->segment(4));
	     $this->db->where('mb001', $this->uri->segment(4));
	     $query = $this->db->get('admmb');
			
	     if ($query->num_rows() > 0) 
		  {
		   $result = $query->result();
		   return $result;   
		  }
	    }
		
	//多筆進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)    
        { 
	     $seq11 = "SELECT COUNT(*) as count  FROM `admmb` ";
	     $seq1 = " mb001, mb002, mb003,mb004,mb005,mb006,  create_date FROM `admmb` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mb001 desc' ;
         $seq9 = " ORDER BY mb001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
		 // $seq5=$this->session->userdata('find05');
	   //  $seq7=$this->session->userdata('find07');
         $seq7="mb001 ";
         if (trim($this->input->post('find005'))!='')
		  {
		  //  $this->session->set_userdata('find05',$this->input->post('find005'));
		   // $seq5=$this->session->userdata('find05');
			$seq5=$this->input->post('find005');
		    $seq2="WHERE ".$seq5;
		    $seq32=$seq5;
		  }
	     if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
			  
	     if (trim($this->input->post('find007'))!='') 
	        {
		 //   $this->session->set_userdata('find07',$this->input->post('find007'));
		    $seq7=$this->input->post('find007');
            //$seq7=$this->session->userdata('find07');			
		    $seq9=" ORDER BY ".$seq7;
		    $seq33=$seq7;
		    }
         if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		 //下一頁不會亂跳
		if(@$_SESSION['admi02_sql_term']){$seq32 = $_SESSION['admi02_sql_term'];}
		if(@$_SESSION['admi02_sql_sort']){$seq33 = $_SESSION['admi02_sql_sort'];}
	//	if (substr($seq33,0,2)) != "mb" {$seq33='mb001';}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mb001', 'mb002', 'mb003','mb004','mb005','mb006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mb001, mb002, mb003,mb004,mb005,mb006,  create_date')
	                       ->from('admmb')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('admmb')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	 //篩選多筆   
	function filterf1($limit, $offset , $sort_by  , $sort_order)            
	   {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
        $sort_by = $this->uri->segment(4);			
        $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mb001', 'mb002', 'mb003','mb004','mb005','mb006', 'create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mb001, mb002, mb003,mb004,mb005,mb006, create_date');
	    $this->db->from('admmb');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mb001 asc, mb002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('admmb');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	 //新增  查詢資料是否重複 
	function selone1($seq1)    
        {
	     $this->db->set('mb001', $this->input->post('mb001')); 
	     $this->db->where('mb001', $this->input->post('mb001')); 
	     $query = $this->db->get('admmb');
	     return $query->num_rows() ;
	    }  	 
		
	//新增一筆	
	function insertf()    
        {
	     $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		              'usr_group' => 'A100',
		              'create_date' =>date("Ymd"),
		              'modifier' => '',
		              'modi_date' => '',
		              'flag' => 0,
                      'mb001' => $this->input->post('mb001'),
		              'mb002' => $this->input->post('mb002'),
		              'mb003' => $this->input->post('mb003'),
                     );
         
	     $exist = $this->admi02_model->selone1($this->input->post('mb001'));   //查詢資料是否重複
	     if ($exist)
	        {
		     return 'exist';
		    } 
             return  $this->db->insert('admmb', $data);
         }
		 
	//copy複製資料是否重複	 
    function selone2($seg1)    
        { 
	      $this->db->where('mb001', $this->input->post('mb002c')); 
	      $query = $this->db->get('admmb');
	      return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
        {
	     $seq1=$this->input->post('mb001c'); 
	     $this->db->where('mb001', $this->input->post('mb001c'));
	     $query = $this->db->get('admmb');
	     $exist = $query->num_rows();
         if (!$exist)
	        {
		     return 'exist';
	        }         		
         if ($query->num_rows() != 1) { return 'exist'; }
		 if ($query->num_rows() == 1) 
		    {
			 $result = $query->result();
			 foreach($result as $row):
                           $mb002=$row->mb002;
                           $mb003=$row->mb003;
						   $mb004=$row->mb004;
						   $mb005=$row->mb005;
						   $mb006=$row->mb006;
	 	         endforeach;
		    }
         $seq3=$this->input->post('mb002c');    //主鍵一筆
	     $data = array( 
	                 'company' => $this->session->userdata('syscompany'),
	                 'creator' => $this->session->userdata('manager'),
		             'usr_group' => 'A100',
		             'create_date' =>date("Ymd"),
		             'modifier' => ' ',
		             'modi_date' => ' ',
		             'flag' => 0,
                     'mb001' => $seq3,
		             'mb002' => $mb002,
		             'mb003' => $mb003,
					 'mb004' => $mb004,
					 'mb005' => $mb005,
					 'mb006' => $mb006
                     );
        $exist = $this->admi02_model->selone2($this->input->post('mb002c'));
		 if ($exist)
		    {
		     return 'exist';
		    }         
             return $this->db->insert('admmb', $data);      //複製一筆  
        }
		
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('mb001c');    //查詢一筆以上
	     $seq2=$this->input->post('mb002c');
	     $sql = " SELECT mb001,mb002,mb003,mb004,mb005,mb006,create_date FROM admmb WHERE mb001 >= '$seq1' AND mb001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('mb001c');    
	     $seq2=$this->input->post('mb002c');
	     $sql = " SELECT * FROM admmb WHERE mb001 >= '$seq1'  AND mb001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "mb001 >= '$seq1'  AND mb001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                   ->from('admmb')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//更改一筆	 
	function updatef()   
        {
         $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		          'mb002' => $this->input->post('mb002'),
		          'mb003' => $this->input->post('mb003'), 
                  'mb004' => $this->input->post('mb004'),
                  'mb005' => $this->input->post('mb005'),
                  'mb006' => strtoupper($this->input->post('mb006')),				  
                       );
         $this->db->where('mb001', $this->input->post('mb001'));
         $this->db->update('admmb',$data);                   //更改一筆
         if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;
        }
		
	//刪除一筆	
	function deletef($seg1,$seg2)      
        {  
	     $seg1=$this->uri->segment(4);
         $seg2=$this->uri->segment(5); 
	     $this->db->where('mb001', $seg1);
         $this->db->delete('admmb'); 
	     if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;					
        }	 
		
	//選取刪除多筆  
	function delmutif()    
        {           
          $seq[] = array('','','','','','','','','','','','','','','');
          $x=0;	
          $seq1=' ';
          $seq2=' ';			
	     if (!empty($_POST['selected'])) 
	        {
              foreach($_POST['selected'] as $check) 
		      {
			    $seq[$x] = $check; 
		        list($seq1) = explode("/", $seq[$x]);
		        $seq1;
		      //  $seq2;
			    $this->db->where('mb001', $seq1);
			  //$this->db->where('mb002', $seq2);
                $this->db->delete('admmb'); 
	          }
           }
	     if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;					
        }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 程式單身(catcomplete)
	function lookupd_body_catcomplete($keyword){     
      $this->db->select('*');
	  $this->db->from('admmb');
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 程式單身(check)
	function lookupd_body_check($keyword){     
      $this->db->select('*');
	  $this->db->from('admmb');
      $this->db->where('mb001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	function check_detail_num_adm(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','ADM','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_adm(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','ADM','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_cms(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','CMS','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_cms(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','CMS','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_inv(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','INV','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_inv(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','INV','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_bom(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','BOM','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_bom(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','BOM','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_cop(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','COP','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_cop(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','COP','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_eps(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','EPS','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_eps(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','EPS','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_sas(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','SAS','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_sas(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','SAS','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}	
	
	function check_detail_num_pur(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','PUR','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_pur(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','PUR','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_ips(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','IPS','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_ips(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','IPS','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_moc(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','MOC','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_moc(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','MOC','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_sfc(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','SFC','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_sfc(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','SFC','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_pal(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','PAL','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_pal(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','PAL','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_ams(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','AMS','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_ams(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','AMS','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_acr(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','ACR','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_acr(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','ACR','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}	
	
	function check_detail_num_acp(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','ACP','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_acp(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','ACP','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_not(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','NOT','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_not(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','NOT','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_act(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','ACT','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_act(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','ACT','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_ajs(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','AJS','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_ajs(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','AJS','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_lrp(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','LRP','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_lrp(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','LRP','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}

	function check_detail_num_mps(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','MPS','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_mps(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','MPS','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_mrp(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','MRP','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_mrp(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','MRP','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_cst(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','CST','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_cst(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','CST','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_ast(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','AST','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_ast(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','AST','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}

	function check_detail_num_tax(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','TAX','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_tax(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','TAX','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_qms(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','QMS','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_qms(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','QMS','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_wsc(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','WSC','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_wsc(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','WSC','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_bcs(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','BCS','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_bcs(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','BCS','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_rma(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','RMA','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_rma(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','RMA','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_ect(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','ECT','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_ect(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','ECT','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
	
	function check_detail_num_ifb(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','IFB','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_ifb(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','IFB','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}

	function check_detail_num_ifg(){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('admmb')
				->like('mb001','IFG','after');
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data_ifg(){
		
		$query = $this->db->select('mb001,mb002')
				->from('admmb')
				->like('mb001','IFG','after');
				
		$data = $query->get()->result();
		
		return $data;		
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>