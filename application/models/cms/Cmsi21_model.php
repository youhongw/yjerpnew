<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi21_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('na001, na002, na003, na004, na005, na008, create_date');
          $this->db->from('cmsna');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('na001 desc, na002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cmsna');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na006','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('na001, na002, na003, na004, na005, na008, create_date')
	                        ->from('cmsna')
		                    ->order_by($sort_by, $sort_order)
		                    ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('cmsna');
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
	    }
	//Talence Editor 2017.03.21
	/***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('cmsi21_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where")   
		    { unset($_SESSION['cmsi21']['search']);}
		
       if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['cmsi21']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "na001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['cmsi21']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['cmsi21']['search']['where'];
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
				$value .= $val." like '".$val_ary[$key]."%' ";
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
				$value .= $val." like '".$val_ary[$key]."%' ";
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
		
		if(isset($_SESSION['cmsi21']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['cmsi21']['search']['order'];
		}
		
		if(!isset($_SESSION['cmsi21']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('na001, na002, na003, create_date')
			->from('cmsna')
			->where('na001','2')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('na001, na002, na003,  create_date')
			->from('cmsna')
			->where('na001','2')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['cmsi21']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsna')
			->where('na001','2');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['cmsi21']['search']['where'] = $where;
		$_SESSION['cmsi21']['search']['order'] = $order;
		$_SESSION['cmsi21']['search']['offset'] = $offset;
		
		return $ret;
	}	
	
	//建構SQL字串 採購1
	function constructa_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('cmsi21_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where")   
		    { unset($_SESSION['cmsi21']['search']);}
		
        if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['cmsi21']['search']);}
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "na001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['cmsi21']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['cmsi21']['search']['where'];
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
		
		if(isset($_SESSION['cmsi21']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['cmsi21']['search']['order'];
		}
		
		if(!isset($_SESSION['cmsi21']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('na001, na002, na003, create_date')
			->from('cmsna')
			->where('na001','1')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('na001, na002, na003,  create_date')
			->from('cmsna')
			->where('na001','1')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['cmsi21']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cmsna')
			->where('na001','1');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['cmsi21']['search']['where'] = $where;
		$_SESSION['cmsi21']['search']['order'] = $order;
		$_SESSION['cmsi21']['search']['offset'] = $offset;
		
		return $ret;
	}	
	//ajax 查詢主鍵 顯示用 品類代號  
	function ajaxkey($seg1)    
        {                   
	      $this->db->set('na002', $this->uri->segment(4));
	      $this->db->where('na002', $this->uri->segment(4));
	      $query = $this->db->get('cmsna');
			
	      if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->na002;
           }
		   return $result;   
		  }
	    }
		
	//查詢一筆 修改用   
	function selone()    
        { 
		  $this->db->select('*');	
	      $this->db->set('na001', $this->uri->segment(4));              
	      $this->db->set('na002', $this->uri->segment(5));
	      $this->db->where('na001', $this->uri->segment(4));     
	      $this->db->where('na002', $this->uri->segment(5));
	      $query = $this->db->get('cmsna');
			
	      if ($query->num_rows() > 0) 
		   {
		    $result = $query->result();
		    return $result;   
		  }
	    }
		
	//多筆進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)    
        {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `cmsna` ";
	      $seq1 = " na001, na002, na003, na004, na005, na008, create_date FROM `cmsna` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'na001 desc' ;
          $seq9 = " ORDER BY na001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
          $seq7="na001 ";

          if (trim($this->input->post('find005'))!='')
		   {
			$seq5=$this->input->post('find005');
		    $seq2="WHERE ".$seq5;
		    $seq32=$seq5;
		   }
	      if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
	      if (trim($this->input->post('find007'))!='') 
	        {
		     $seq7=$this->input->post('find007');		   
		     $seq9=" ORDER BY ".$seq7;
		     $seq33=$seq7;
		    }
          if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		   //下一頁不會亂跳
		if(@$_SESSION['cmsi21_sql_term']){$seq32 = $_SESSION['cmsi21_sql_term'];}
		if(@$_SESSION['cmsi21_sql_sort']){$seq33 = $_SESSION['cmsi21_sql_sort'];}
		
          $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na008','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('na001, na002, na003, na004, na005, na008, create_date')
	                        ->from('cmsna')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('cmsna')
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
	      $sort_columns = array('na001', 'na002', 'na003', 'na004', 'na005', 'na008','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'na001';  //檢查排序欄位是否為 table
			
	      $this->db->select('na001, na002, na003, na004, na005, na008, create_date');
	      $this->db->from('cmsna');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('na001 asc, na002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cmsna');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複  
	function selone1($seg1,$seg2)    
        {
	      $this->db->set('na001', $this->input->post('na001'));              
	      $this->db->set('na002', $this->input->post('na002'));
	      $this->db->where('na001', $this->input->post('na001'));     
	      $this->db->where('na002', $this->input->post('na002'));	
	      $query = $this->db->get('cmsna');
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
                  'na001' => $this->input->post('na001'),
		          'na002' => $this->input->post('na002'),
		          'na003' => $this->input->post('na003'),
		          'na004' => $this->input->post('na004'),
		          'na005' => $this->input->post('na005'),
				  'na006' => $this->input->post('na006'),
				  'na007' => $this->input->post('na007'),
				  'na008' => $this->input->post('na008'),
				  'na009' => $this->input->post('na009'),
				  'na010' => $this->input->post('na010'),
				  'na011' => $this->input->post('na011'),
		          'na012' => $this->input->post('na012'),
		          'na013' => $this->input->post('na013'),
		          'na014' => $this->input->post('na014'),
		          'na015' => $this->input->post('na015'),
				  'na016' => $this->input->post('na016'),
				  'na017' => $this->input->post('na017'),
				  'na018' => $this->input->post('na018'),
				  'na019' => $this->input->post('na019')           
                       );
         
	      $exist = $this->cmsi21_model->selone1($this->input->post('na001'),$this->input->post('na002'));
	      if ($exist)
	        {
		     return 'exist';
		   } 
             return  $this->db->insert('cmsna', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1,$seg2)    
        { 	
	    //  $this->db->set('na003', $this->input->post('na003c'));              
	   //   $this->db->set('na004', $this->input->post('na004c'));
	      $this->db->where('na003', $this->input->post('na003c'));     
	      $this->db->where('na004', $this->input->post('na004c'));	
	      $query = $this->db->get('cmsna');
	      return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           //複製一筆
        {
	      $seq1=$this->input->post('na001c');    
	      $seq2=$this->input->post('na002c'); 
	   //   $this->db->set('na001', $this->input->post('na001c'));              
	   //   $this->db->set('na002', $this->input->post('na002c'));
	      $this->db->where('na001', $this->input->post('na001c'));     
	      $this->db->where('na002', $this->input->post('na002c'));	
	      $query = $this->db->get('cmsna');
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
                $na003=$row->na003;
                $na004=$row->na004;
                $na005=$row->na005;
                $na006=$row->na006; 
                $na007=$row->na007; 
				$na008=$row->na008; 
				$na009=$row->na009; 
				$na010=$row->na010;
				$na011=$row->na011;
				$na012=$row->na012;
				$na013=$row->na013;
				$na014=$row->na014;
				$na015=$row->na015;
				$na016=$row->na016;
				$na017=$row->na017;
				$na018=$row->na018;
				$na019=$row->na019;
	 	    endforeach;
		    }   
		  
          $seq3=$this->input->post('na003c');    //主鍵一筆
	      $seq4=$this->input->post('na004c'); 
	      $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'na001' => $seq3,
		          'na002' => $seq4,
		          'na003' => $na003,
		          'na004' => $na004,
		          'na005' => $na005,
				  'na006' => $na006,
				  'na007' => $na007,
				  'na008' => $na008,
				  'na009' => $na009,
				  'na010' => $na010,
				  'na011' => $na011,
				  'na012' => $na012,
				  'na013' => $na013,
				  'na014' => $na014,
				  'na015' => $na015,
				  'na016' => $na016,
				  'na017' => $na017,
				  'na018' => $na018,
		          'na019' => $na019             
                      );
          $exist = $this->cmsi21_model->selone2($this->input->post('na003c'),$this->input->post('na004c'));
		  if ($exist)
		    {
			 return 'exist';
		    }         
             return $this->db->insert('cmsna', $data);      //複製一筆  
        }	
		
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('na001c');    
	      $seq2=$this->input->post('na002c'); 
	      $seq3=$this->input->post('na003c'); 
	      $seq4=$this->input->post('na004c'); 
	      $sql = " SELECT na001,na002,na003,na004,na005,na008,create_date FROM cmsna WHERE na001 >= '$seq1'  AND na001 <= '$seq2' AND na002 >= '$seq3' AND na002 <= '$seq4' ORDER BY na001,na002 "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	      $seq1=$this->input->post('na001c');    
	      $seq2=$this->input->post('na002c'); 
	      $seq3=$this->input->post('na003c'); 
	      $seq4=$this->input->post('na004c'); 
	      $sql = " SELECT * FROM cmsna WHERE na001 >= '$seq1'  AND na001 <= '$seq2' AND na002 >= '$seq3' AND na002 <= '$seq4'  ORDER BY na001,na002 "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		
          $seq32 = "na001 >= '$seq1'  AND na001 <= '$seq2' AND na002 >= '$seq3' AND na002 <= '$seq4' ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                    ->from('cmsna')
		                    ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//更改一筆	 
	function updatef()   //更改一筆
        {
        $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'na003' => $this->input->post('na003'),
		        'na004' => $this->input->post('na004'),
		        'na005' => $this->input->post('na005'),
				'na006' => $this->input->post('na006'),
		        'na007' => $this->input->post('na007'),
		        'na008' => $this->input->post('na008'),
				'na009' => $this->input->post('na009'),
		        'na010' => $this->input->post('na010'),
		        'na011' => $this->input->post('na011'),
				'na012' => $this->input->post('na012'),
		        'na013' => $this->input->post('na013'),
		        'na014' => $this->input->post('na014'),
				'na015' => $this->input->post('na015'),
				'na016' => $this->input->post('na016'),
		        'na017' => $this->input->post('na017'),
		        'na018' => $this->input->post('na018'),
				'na019' => $this->input->post('na019')  
                     );
          $this->db->where('na001', $this->input->post('na001'));
	      $this->db->where('na002', $this->input->post('na002'));
          $this->db->update('cmsna',$data);                   
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
	      $this->db->where('na001', $seg1);
	      $this->db->where('na002', $seg2);
          $this->db->delete('cmsna'); 
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
		     list($seq1, $seq2) = explode("/", $seq[$x]);
		     $seq1;
		     $seq2;
			 $this->db->where('na001', $seq1);
			 $this->db->where('na002', $seq2);
             $this->db->delete('cmsna'); 
	         }
           }
	      if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;					
        }
	/*==以下AJAX處理區域==*/
	 function ajaxcmsi03($seg1)    //ajax 查詢一筆 顯示用 廠別6
          { 	              
	    $this->db->set('na002', $this->uri->segment(4));
	    $this->db->where('na001', '2');	
		$this->db->where('na002', $this->uri->segment(4));
	    $query = $this->db->get('cmsna');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->na003;
            }
		   return $result;   
		 }
	  }
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword){     
      $this->db->select('na002, na003');
	  $this->db->from('cmsna');  
	  $this->db->where('na001','2');
      $this->db->like('na002',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('na003',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookup2($keyword){  
      $na001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('na002, na003');
	  $this->db->from('cmsna');  
	  $this->db->where('na001','2');
      $this->db->where('na002',$keyword);
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 廠別
	function lookup_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=10){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('cmsna');
		foreach($search_col as $key => $val){
			if($key == "and"){
				$this->db->like($val,$keyword[$val],'after');
			}elseif($key == "or"){
				$this->db->or_like($val,$keyword[$val], 'after');
			}
		}
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
    }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>