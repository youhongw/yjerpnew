<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006,mb017,mb025,mb069 create_date');
          $this->db->from('invmb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('invmb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006','mb200','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006,mb017,mb025,mb069,mb200,create_date')
	                        ->from('invmb')
		                    ->order_by($sort_by, $sort_order)
		                    ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('invmb');
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
		$this->session->set_userdata('invi02_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['invi02']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mb001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['invi02']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['invi02']['search']['where'];
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
				//$value .= $val." like '%".$val_ary[$key]."%' ";
				
				if($val != "chkbx"){
				$value .= $val." like '%".$val_ary[$key]."%' ";}
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
		
		if(isset($_SESSION['invi02']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['invi02']['search']['order'];
		}
		
		if(!isset($_SESSION['invi02']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006, mb017,b.mc002 as mb017disp, mb025, mb069, mb200, a.create_date')
			->from('invmb as a')
			->join('cmsmc as b', 'mb017 = b.mc001','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614
		$this->construct_view($ret['data']);
		
		$query = $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006, mb017,b.mc002 as mb017disp, mb025, mb069, mb200, a.create_date')
			->from('invmb as a')
			->join('cmsmc as b', 'mb017 = b.mc001','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['invi02']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('invmb');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['invi02']['search']['where'] = $where;
		$_SESSION['invi02']['search']['order'] = $order;
		$_SESSION['invi02']['search']['offset'] = $offset;
		
		return $ret;
	}
	//Talence Editor 2017.04.10
	/***新增暫存view表方法construct_view
	*	
	*
	***/
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mb001"
		);
		$view_array = array();
		$index_array = array();
		
		foreach($data as $key => $val){
			$key_str = "";
			foreach($pk_array as $pk_k => $pk_v){
				if($key_str){
					$key_str .= "_";
				}$key_str .= $val->$pk_v;
			}
			$view_array[$key_str] = $key;
			$index_array[$key] = $key_str;
		}
		$_SESSION['invi02']['search']['view'] = $view_array;
		$_SESSION['invi02']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['invi02']['search']['view']);exit;
		
	}
	 //查詢一筆 修改用  
	function selone($seg1)    
        {
		  $this->db->select(' a.*, b.ma003 as mb005disp, c.ma003 as mb006disp, d.ma003 as mb007disp, e.ma003 as mb008disp
		  , f.mc002 as mb017disp, g.md002 as mb068disp, h.mv002 as mb018disp, a.mb011 as mb010disp,j.mv002 as mb067disp,k.ma002 as mb032disp ');
          $this->db->from('invmb as a');
		//  $this->db->where('mb001 as a', $this->uri->segment(4)); 
		  $this->db->join('invma as b', 'a.mb005 = b.ma002','left');
		  $this->db->join('invma as c', 'a.mb006 = c.ma002','left');
		  $this->db->join('invma as d', 'a.mb007 = d.ma002','left');
		  $this->db->join('invma as e', 'a.mb008 = e.ma002','left');
		  $this->db->join('cmsmc as f', 'a.mb017 = f.mc001','left');
		  $this->db->join('cmsmd as g', 'a.mb068 = g.md001','left');
		  $this->db->join('cmsmv as h', 'a.mb018 = h.mv001','left');
		  $this->db->join('bomme as i', 'a.mb010 = i.me002','left');
		  $this->db->join('cmsmv as j', 'a.mb067 = j.mv001','left');
		  $this->db->join('purma as k', 'a.mb032 = k.ma001','left');
		  $this->db->where('mb001', $this->uri->segment(4)); 
	//	  $this->db->query('SET SQL_BIG_SELECTS=1');
		  $query = $this->db->get();
			
	      if ($query->num_rows() > 0) 
		   {
		    $result = $query->result();
		    return $result;   
		  }
	  }
	  
	//ajax 查詢多筆 顯示用
	function jensonajax1($seg1)    
        { 
	      $this->db->set('mb001', $this->uri->segment(4));
	      $this->db->like('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('invmb');
			
		  for($i=0;$i<$query->num_rows();$i++ )
           {
             $mydata[] = $query->row_array($i);
           }	
		  $total=$query->num_rows();
		  $json_string = json_encode($mydata);
            //赋值--
          $data['total']=$total;
          $data['jsonstr']=$json_string;
          return $data;
	    }
		
	//ajax 查詢一筆 顯示用 會計 
	function seloneajax1($seg1)    
        { 
	      $this->db->set('ma002', $this->uri->segment(4));
	      $this->db->where('ma002', $this->uri->segment(4));	
	      $query = $this->db->get('invmav1');
			
	      if ($query->num_rows() > 0) 
		  {
		    $res = $query->result();
		    foreach ($query->result() as $row)
            {
             $result=$row->ma003;
            }
		   return $result;   
		  }
	    }
		
	//ajax 查詢一筆 顯示用 商品2  
	function seloneajax2($seg1)    
        { 	              
	      $this->db->set('ma002', $this->uri->segment(4));
	      $this->db->where('ma002', $this->uri->segment(4));	
	      $query = $this->db->get('invmav2');
			
	      if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->ma003;
           }
		   return $result;   
		  }
	    }
		
	//ajax 查詢一筆 顯示用 類別3  
	function seloneajax3($seg1)    
        { 	              
	      $this->db->set('ma002', $this->uri->segment(4));
	      $this->db->where('ma002', $this->uri->segment(4));	
	      $query = $this->db->get('invmav3');
			
	      if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->ma003;
           }
		    return $result;   
		  }
	    }
		
	//ajax 查詢一筆 顯示用 生管4  
	function seloneajax4($seg1)    
        { 	              
	     $this->db->set('ma002', $this->uri->segment(4));
	     $this->db->where('ma002', $this->uri->segment(4));	
	     $query = $this->db->get('invmav4');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->ma003;
           }
		    return $result;   
		 }
	    }
		
	//ajax 查詢一筆 品號 key 5	
	function ajaxkey($seg1)    
        { 	              
	     $this->db->set('mb001', $this->uri->segment(4));
	     $this->db->where('mb001', $this->uri->segment(4));	
	     $query = $this->db->get('invmb');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->mb001;
           }
		    return $result;   
		 }
	    }
		
	//ajax 查詢一筆 顯示用 庫別6 
	function seloneajax6($seg1)    
        { 	              
	     $this->db->set('mc001', $this->uri->segment(4));
	     $this->db->where('mc001', $this->uri->segment(4));	
	     $query = $this->db->get('cmsmc');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->mc002;
           }
		    return $result;   
		 }
	    }
		
	//ajax 查詢一筆 顯示用 生產線別7  
	function seloneajax7($seg1)    
        { 	              
	     $this->db->set('md001', $this->uri->segment(4));
	     $this->db->where('md001', $this->uri->segment(4));	
	     $query = $this->db->get('cmsmd');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->md002;
           }
		    return $result;   
		 }
	    }
		
	//ajax 查詢一筆 顯示用 途程代號8  
	function seloneajax8($seg1)    
        { 	              
	     $this->db->set('me001', $this->uri->segment(4));
	     $this->db->where('me001', $this->uri->segment(4));	
	     $query = $this->db->get('bomme');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->me002;
           }
		    return $result;   
		 }
	   }
	   
	//ajax 查詢一筆 顯示用 計劃人員 21  
	function seloneajax21($seg1)    
        { 	              
	     $this->db->set('mv001', $this->uri->segment(4));
	     $this->db->where('mv001', $this->uri->segment(4));	
	     $query = $this->db->get('cmsmkv2');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->mv002;
           }
		    return $result;   
		 }
	   }
	   
	//進階查詢   
	function findf($limit, $offset, $sort_by, $sort_order)     
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `invmb` ";
	     $seq1 = "mb001, mb002, mb003, mb004, mb005, mb006,mb007,mb017,mb025,mb069, create_date FROM `invmb` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mb001 desc' ;
         $seq9 = " ORDER BY mb001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mb001 ";

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
		if(@$_SESSION['invi02_sql_term']){$seq32 = $_SESSION['invi02_sql_term'];}
		if(@$_SESSION['invi02_sql_sort']){$seq33 = $_SESSION['invi02_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006','mb007','mb017','mb200','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006,mb007,mb017,mb025,mb069,mb200, create_date')
	                       ->from('invmb')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invmb')
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
	     $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006','mb017','mb025','mb200','create_date');
         $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否為 table
			
	     $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006,mb017,mb025,mb069,mb200, create_date');
	     $this->db->from('invmb');
	     $this->db->like($sort_by, $seq4, 'after');
	     $this->db->order_by($sort_by, $sort_order);
	     //$this->db->order_by('mb001 asc, mb002 asc');
	     $this->db->limit($limit, $offset);   // 每頁15筆
	     $query = $this->db->get();    
	     $ret['rows'] = $query->result();
						
	     $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('invmb');
	     $this->db->like($sort_by, $seq4, 'after');	
	     $query = $this->db->get();
	     $tmp = $query->result();		
	     $ret['num_rows'] = $tmp[0]->count;			
	     return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
        {
	     $this->db->set('mb001', $this->input->post('mb001')); 
	     $this->db->where('mb001', $this->input->post('mb001'));
	     $query = $this->db->get('invmb');
	     return $query->num_rows() ;
	    }  
		
	//新增一筆	
	function insertf()    
        {
			
		//	var_dump($this->input->post('userfile'));exit;
	     $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => '',
		        'modi_date' => '',
		        'flag' => 0,
                'mb001' => strtoupper($this->input->post('mb001')),
		        'mb002' => strtoupper($this->input->post('mb002')),
		        'mb003' => strtoupper($this->input->post('mb003')),
		        'mb004' => strtoupper($this->input->post('mb004')),
		        'mb005' => $this->input->post('invi01a'),
		        'mb006' => $this->input->post('invi01b'),
                'mb007' => $this->input->post('invi01c'),
                'mb008' => $this->input->post('invi01d'),
                'mb009' => $this->input->post('mb009'),
                'mb010' => $this->input->post('bomi07'),		
                'mb011' => $this->input->post('mb011'),	
                'mb012' => $this->input->post('mb012'),		
                'mb013' => $this->input->post('mb013'),		
                'mb014' => $this->input->post('mb014'),		
                'mb015' => $this->input->post('mb015'),		
                'mb016' => $this->input->post('mb016'),		
                'mb017' => $this->input->post('cmsi03'),		
                'mb018' => $this->input->post('cmsi09'),		
                'mb019' => $this->input->post('mb019'),		
                'mb020' => $this->input->post('mb020'),	
                'mb021' => $this->input->post('mb021'),	
                'mb022' => $this->input->post('mb022'),	
                'mb023' => $this->input->post('mb023'),	
                'mb024' => $this->input->post('mb024'),	
                'mb025' => $this->input->post('mb025'),	
                'mb026' => $this->input->post('mb026'),	
                'mb027' => $this->input->post('mb027'),	
                'mb028' => $this->input->post('mb028'),	
                'mb029' => $this->input->post('mb029'),	
                'mb030' => $this->input->post('mb030'),
                'mb031' => $this->input->post('mb031'),	
                'mb032' => $this->input->post('puri01'),	
                'mb033' => $this->input->post('mb033'),	
                'mb034' => $this->input->post('mb034'),	
                'mb035' => $this->input->post('mb035'),	
                'mb036' => $this->input->post('mb036'),	
                'mb037' => $this->input->post('mb037'),	
                'mb038' => $this->input->post('mb038'),	
                'mb039' => $this->input->post('mb039'),		
                'mb040' => $this->input->post('mb040'),
                'mb041' => $this->input->post('mb041'),	
                'mb042' => $this->input->post('mb042'),	
                'mb043' => $this->input->post('mb043'),	
                'mb044' => $this->input->post('mb044'),	
                'mb045' => $this->input->post('mb045'),	
                'mb046' => $this->input->post('mb046'),	
                'mb047' => $this->input->post('mb047'),	
                'mb048' => $this->input->post('mb048'),	
                'mb049' => $this->input->post('mb049'),		
                'mb050' => $this->input->post('mb050'),
                'mb051' => $this->input->post('mb051'),	
                'mb052' => $this->input->post('mb052'),	
                'mb053' => $this->input->post('mb053'),	
                'mb054' => $this->input->post('mb054'),	
                'mb055' => $this->input->post('mb055'),	
                'mb056' => $this->input->post('mb056'),	
                'mb057' => $this->input->post('mb057'),	
                'mb058' => $this->input->post('mb058'),	
                'mb059' => $this->input->post('mb059'),		
                'mb060' => $this->input->post('mb060'),
                'mb061' => $this->input->post('mb061'),	
                'mb062' => $this->input->post('mb062'),	
                'mb063' => $this->input->post('mb063'),	
                'mb064' => $this->input->post('mb064'),	
                'mb065' => $this->input->post('mb065'),	
                'mb066' => $this->input->post('mb066'),	
                'mb067' => $this->input->post('cmsi09a'),	
                'mb068' => $this->input->post('cmsi04'),	
                'mb069' => $this->input->post('mb069'),
                'mb070' => $this->input->post('mb070'),
                'mb071' => $this->input->post('mb071'),	
                'mb072' => $this->input->post('mb072'),	
                'mb073' => $this->input->post('mb073'),	
                'mb074' => $this->input->post('mb074'),	
                'mb075' => $this->input->post('mb075'),	
                'mb076' => $this->input->post('mb076'),	
                'mb077' => $this->input->post('mb077'),	
                'mb078' => $this->input->post('mb078'),	
                'mb079' => $this->input->post('mb079'),
                'mb080' => $this->input->post('mb080'),
                'mb081' => $this->input->post('mb081'),	
                'mb082' => $this->input->post('mb082'),	
                'mb083' => $this->input->post('mb083'),	
                'mb084' => $this->input->post('mb084'),	
                'mb085' => $this->input->post('mb085'),	
                'mb086' => $this->input->post('mb086'),	
                'mb087' => $this->input->post('mb087'),	
                'mb088' => $this->input->post('mb088'),	
                'mb089' => $this->input->post('mb089'),
                'mb090' => $this->input->post('mb090'),
                'mb091' => $this->input->post('mb091'),	
                'mb092' => $this->input->post('mb092'),	
                'mb093' => $this->input->post('mb093'),	
                'mb094' => $this->input->post('mb094'),	
                'mb095' => $this->input->post('mb095'),	
                'mb096' => $this->input->post('mb096'),
				'mb201' => $this->input->post('mb201'),
				'mb202' => $this->input->post('mb202'),
				'mb200' => $_FILES['userfile']['name']
                );
         
	     $exist = $this->invi02_model->selone1($this->input->post('mb001'));
	     if ($exist)
	       {
		    return 'exist';
		   } 
            return  $this->db->insert('invmb', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
        { 	
	     $this->db->set('mb001', $this->input->post('mb001c'));
	     $this->db->where('mb001', $this->input->post('mb001c'));
	     $query = $this->db->get('invmb');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
          {
	       $this->db->set('mb001', $this->input->post('mb001o'));
	       $this->db->where('mb001', $this->input->post('mb001o'));
	       $query = $this->db->get('invmb');
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
                $mb002=$row->mb002;$mb003=$row->mb003;$mb004=$row->mb004;$mb005=$row->mb005;$mb006=$row->mb006;$mb007=$row->mb007;$mb008=$row->mb008;$mb009=$row->mb009;$mb010=$row->mb010;
				$mb011=$row->mb011;$mb012=$row->mb012;$mb013=$row->mb013;$mb014=$row->mb014;$mb015=$row->mb015;$mb016=$row->mb016;$mb017=$row->mb017;$mb018=$row->mb018;$mb019=$row->mb019;$mb020=$row->mb020;
				$mb021=$row->mb021;$mb022=$row->mb022;$mb023=$row->mb023;$mb024=$row->mb024;$mb025=$row->mb025;$mb026=$row->mb026;$mb027=$row->mb027;$mb028=$row->mb028;$mb029=$row->mb029;$mb030=$row->mb030;		 
                $mb031=$row->mb031;$mb032=$row->mb032;$mb033=$row->mb033;$mb034=$row->mb034;$mb035=$row->mb035;$mb036=$row->mb036;$mb037=$row->mb037;$mb038=$row->mb038;$mb039=$row->mb039;$mb040=$row->mb040;
				$mb041=$row->mb041;$mb042=$row->mb042;$mb043=$row->mb043;$mb044=$row->mb044;$mb045=$row->mb045;$mb046=$row->mb046;$mb047=$row->mb047;$mb048=$row->mb048;$mb049=$row->mb049;$mb050=$row->mb050;
				$mb051=$row->mb051;$mb052=$row->mb052;$mb053=$row->mb053;$mb054=$row->mb054;$mb055=$row->mb055;$mb056=$row->mb056;$mb057=$row->mb057;$mb058=$row->mb058;$mb059=$row->mb059;$mb060=$row->mb060;
				$mb061=$row->mb061;$mb062=$row->mb062;$mb063=$row->mb063;$mb064=$row->mb064;$mb065=$row->mb065;$mb066=$row->mb066;$mb067=$row->mb067;$mb068=$row->mb068;$mb069=$row->mb069;$mb070=$row->mb070;
				$mb071=$row->mb071;$mb072=$row->mb072;$mb073=$row->mb073;$mb074=$row->mb074;$mb075=$row->mb075;$mb076=$row->mb076;$mb077=$row->mb077;$mb078=$row->mb078;$mb079=$row->mb079;$mb080=$row->mb080;
				$mb081=$row->mb081;$mb082=$row->mb082;$mb083=$row->mb083;$mb084=$row->mb084;$mb085=$row->mb085;$mb086=$row->mb086;$mb087=$row->mb087;$mb088=$row->mb088;$mb089=$row->mb089;$mb090=$row->mb090;      						   
	 	        $mb091=$row->mb091;$mb092=$row->mb092;$mb093=$row->mb093;$mb094=$row->mb094;$mb095=$row->mb095;$mb096=$row->mb096;
			  endforeach;
		     }   
		  
            $seq3=$this->input->post('mb001c');    //主鍵一筆
	        $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                 
		          'mb001' => $seq3,'mb002' => $mb002,'mb003' => $mb003,'mb004' => $mb004,'mb005' => $mb005,'mb006' => $mb006,'mb007' => $mb007,'mb008' => $mb008,'mb009' => $mb009,'mb010' => $mb010,
		          'mb011' => $mb011,'mb012' => $mb012,'mb013' => $mb013,'mb014' => $mb014,'mb015' => $mb015,'mb016' => $mb016,'mb017' => $mb017,'mb018' => $mb018,'mb019' => $mb019,'mb020' => $mb020,
		          'mb021' => $mb021,'mb022' => $mb022,'mb023' => $mb023,'mb024' => $mb024,'mb025' => $mb025,'mb026' => $mb026,'mb027' => $mb027,'mb028' => $mb028,'mb029' => $mb029,'mb030' => $mb030,
				  'mb031' => $mb031,'mb032' => $mb032,'mb033' => $mb033,'mb034' => $mb034,'mb035' => $mb035,'mb036' => $mb036,'mb037' => $mb037,'mb038' => $mb038,'mb039' => $mb039,'mb040' => $mb040,
				  'mb041' => $mb041,'mb042' => $mb042,'mb043' => $mb043,'mb044' => $mb044,'mb045' => $mb045,'mb046' => $mb046,'mb047' => $mb047,'mb048' => $mb048,'mb049' => $mb049,'mb050' => $mb050,
				  'mb051' => $mb051,'mb052' => $mb052,'mb053' => $mb053,'mb054' => $mb054,'mb055' => $mb055,'mb056' => $mb056,'mb057' => $mb057,'mb058' => $mb058,'mb059' => $mb059,'mb060' => $mb060,
				  'mb061' => $mb061,'mb062' => $mb062,'mb063' => $mb063,'mb064' => $mb064,'mb065' => $mb065,'mb066' => $mb066,'mb067' => $mb067,'mb068' => $mb058,'mb069' => $mb069,'mb070' => $mb070,
				  'mb071' => $mb071,'mb072' => $mb072,'mb073' => $mb073,'mb074' => $mb074,'mb075' => $mb075,'mb076' => $mb076,'mb077' => $mb077,'mb078' => $mb078,'mb079' => $mb079,'mb080' => $mb080,
				  'mb081' => $mb081,'mb082' => $mb082,'mb083' => $mb083,'mb084' => $mb084,'mb085' => $mb085,'mb086' => $mb086,'mb087' => $mb087,'mb088' => $mb088,'mb089' => $mb089,'mb090' => $mb090,
				  'mb091' => $mb081,'mb092' => $mb092,'mb093' => $mb093,'mb094' => $mb094,'mb095' => $mb095,
				  'mb096' => $mb096             
                         );
             $exist = $this->invi02_model->selone2($this->input->post('mb001c'));
		     if ($exist)
		       {
			    return 'exist';
		       }         
                return $this->db->insert('invmb', $data);      //複製一筆  
          }	
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('mb001o');    
	     $seq2=$this->input->post('mb001c'); 
	     $sql = " SELECT mb001,mb002,mb003,mb004,mb013,mb017,create_date FROM invmb WHERE mb001 >= '$seq1'  AND mb001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('mb001o');    
	     $seq2=$this->input->post('mb001c');
	     $sql = " SELECT mb001,mb002,mb003,mb004,mb013,mb017,create_date  FROM invmb WHERE mb001 >= '$seq1'  AND mb001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "mb001 >= '$seq1'  AND mb001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		               ->from('invmb')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//更改一筆	 
	function updatef()   //更改一筆
          {
			  // if (!$this->input->post('userfile')) {$this->input->post('userfile')=$this->uri->segment(4);}
			 //  var_dump($this->input->post('userfile'));exit;
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		          'mb002' => strtoupper($this->input->post('mb002')),
		          'mb003' => strtoupper($this->input->post('mb003')),
		          'mb004' => strtoupper($this->input->post('mb004')),
		          'mb005' => $this->input->post('invi01a'),
		          'mb006' => $this->input->post('invi01b'),
                  'mb007' => $this->input->post('invi01c'),
                  'mb008' => $this->input->post('invi01d'),
                  'mb009' => $this->input->post('mb009'),
                  'mb010' => $this->input->post('bomi07'),		
                  'mb011' => $this->input->post('mb011'),		
                  'mb012' => $this->input->post('mb012'),		
                  'mb013' => $this->input->post('mb013'),		
                  'mb014' => $this->input->post('mb014'),		
                  'mb015' => $this->input->post('mb015'),		
                  'mb016' => $this->input->post('mb016'),		
                  'mb017' => $this->input->post('cmsi03'),		
                  'mb018' => $this->input->post('cmsi09'),		
                  'mb019' => $this->input->post('mb019'),		
                  'mb020' => $this->input->post('mb020'),	
                  'mb021' => $this->input->post('mb021'),	
                  'mb022' => $this->input->post('mb022'),	
                  'mb023' => $this->input->post('mb023'),	
                  'mb024' => $this->input->post('mb024'),	
                  'mb025' => $this->input->post('mb025'),	
                  'mb026' => $this->input->post('mb026'),	
                  'mb027' => $this->input->post('mb027'),	
                  'mb028' => $this->input->post('mb028'),	
                  'mb029' => $this->input->post('mb029'),	
                  'mb030' => $this->input->post('mb030'),
                  'mb031' => $this->input->post('mb031'),	
                  'mb032' => $this->input->post('puri01'),	
                  'mb033' => $this->input->post('mb033'),	
                  'mb034' => $this->input->post('mb034'),	
                  'mb035' => $this->input->post('mb035'),	
                  'mb036' => $this->input->post('mb036'),	
                  'mb037' => $this->input->post('mb037'),	
                  'mb038' => $this->input->post('mb038'),	
                  'mb039' => $this->input->post('mb039'),		
                  'mb040' => $this->input->post('mb040'),
                  'mb041' => $this->input->post('mb041'),	
                  'mb042' => $this->input->post('mb042'),	
                  'mb043' => $this->input->post('mb043'),	
                  'mb044' => $this->input->post('mb044'),	
                  'mb045' => $this->input->post('mb045'),	
                  'mb046' => $this->input->post('mb046'),	
                  'mb047' => $this->input->post('mb047'),	
                  'mb048' => $this->input->post('mb048'),	
                  'mb049' => $this->input->post('mb049'),		
                  'mb050' => $this->input->post('mb050'),
                  'mb051' => $this->input->post('mb051'),	
                  'mb052' => $this->input->post('mb052'),	
                  'mb053' => $this->input->post('mb053'),	
                  'mb054' => $this->input->post('mb054'),	
                  'mb055' => $this->input->post('mb055'),	
                  'mb056' => $this->input->post('mb056'),	
                  'mb057' => $this->input->post('mb057'),	
                  'mb058' => $this->input->post('mb058'),	
                  'mb059' => $this->input->post('mb059'),		
                  'mb060' => $this->input->post('mb060'),
                  'mb061' => $this->input->post('mb061'),	
                  'mb062' => $this->input->post('mb062'),	
                  'mb063' => $this->input->post('mb063'),	
                  'mb064' => $this->input->post('mb064'),	
                  'mb065' => $this->input->post('mb065'),	
                  'mb066' => $this->input->post('mb066'),	
                  'mb067' => $this->input->post('cmsi09a'),	
                  'mb068' => $this->input->post('cmsi04'),	
                  'mb069' => $this->input->post('mb069'),
                  'mb070' => $this->input->post('mb070'),
                  'mb071' => $this->input->post('mb071'),	
                  'mb072' => $this->input->post('mb072'),	
                  'mb073' => $this->input->post('mb073'),	
                  'mb074' => $this->input->post('mb074'),	
                  'mb075' => $this->input->post('mb075'),	
                  'mb076' => $this->input->post('mb076'),	
                  'mb077' => $this->input->post('mb077'),	
                  'mb078' => $this->input->post('mb078'),	
                  'mb079' => $this->input->post('mb079'),
                  'mb080' => $this->input->post('mb080'),
                  'mb081' => $this->input->post('mb081'),	
                  'mb082' => $this->input->post('mb082'),	
                  'mb083' => $this->input->post('mb083'),	
                  'mb084' => $this->input->post('mb084'),	
                  'mb085' => $this->input->post('mb085'),	
                  'mb086' => $this->input->post('mb086'),	
                  'mb087' => $this->input->post('mb087'),	
                  'mb088' => $this->input->post('mb088'),	
                  'mb089' => $this->input->post('mb089'),
                  'mb090' => $this->input->post('mb090'),
                  'mb091' => $this->input->post('mb091'),	
                  'mb092' => $this->input->post('mb092'),	
                  'mb093' => $this->input->post('mb093'),	
                  'mb094' => $this->input->post('mb094'),	
                  'mb095' => $this->input->post('mb095'),	
                  'mb096' => $this->input->post('mb096'),
				  'mb201' => $this->input->post('mb201'),
				  'mb202' => $this->input->post('mb202')
                        );
			if($_FILES['userfile']['name']){
				$data['mb200'] = $_FILES['userfile']['name'];
			}
            $this->db->where('mb001', $this->input->post('mb001'));
            $this->db->update('invmb',$data);                   //更改一筆
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
	     $this->db->where('mb002', $seg2);
         $this->db->delete('invmb'); 
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
		      //list($seq1, $seq2) = explode("/", $seq[$x]);
		      list($seq1) = explode("/", $seq[$x]);
		      $seq1;
		   	  //$seq2;
			  $this->db->where('mb001', $seq1);
			  //$this->db->where('mb002', $seq2);
              $this->db->delete('invmb'); 
	         }
           }
	     if ($this->db->affected_rows() > 0)
           {
            return TRUE;
           }
            return FALSE;					
        }
		
	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 品號
	function lookup($select_col=array(),$search_col=array(),$keyword=array(),$limit=15){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('invmb');
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
	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd($keyword){     
      $this->db->select('mb001, mb002, mb003, mb004, mb017, b.mc002 as mb017disp');
	  $this->db->from('invmb');
	  $this->db->join('cmsmc as b', 'mb017 = b.mc001','left');
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookupd2($keyword){     
      $this->db->select('mb001, mb002, mb003, mb004, mb017, b.mc002 as mb017disp');
	  $this->db->from('invmb');
	  $this->db->join('cmsmc as b', 'mb017 = b.mc001','left');
      $this->db->where('mb001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號
	function lookupd_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=15){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('invmb');
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