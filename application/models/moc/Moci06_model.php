<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moci06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tl001, tl002, tl003, tl004, tl005, tl006,tl008,tl010,tl011,tl013, create_date');
          $this->db->from('moctm');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tl001 desc, tl002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('moctm');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    {
		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('th001', 'th002', 'th003', 'th004', 'th005', 'th007', 'th008', 'th010');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'th002';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('a.th001,a.th002,a.th003,a.th004,b.mb002,a.th005,c.ma002,a.th007,a.th008,a.th010,a.create_date')
			->from('mocth as a')
			->join('cmsmb as b','a.th004 = b.mb001','left')
			->join('purma as c','a.th005 = c.ma001','left')
			->order_by($sort_by, $sort_order);
		$ret['rows'] = $query->get()->result();
		//建構暫存view
		$this->construct_view($ret['rows']);
		
		$query = $this->db->select('a.th001,a.th002,a.th003,a.th004,b.mb002,a.th005,c.ma002,a.th007,a.th008,a.th010,a.create_date')
			->from('mocth as a')
			->join('cmsmb as b','a.th004 = b.mb001','left')
			->join('purma as c','a.th005 = c.ma001','left')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
					   ->from('mocth');
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		
		return $ret;

	  }
	  
	  /***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('moci06_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "th002 desc, th001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['moci06']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['moci06']['search']['where'];
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
		
		if(isset($_SESSION['moci06']['search']['order'])){
			if($order){$order .= " , ";} 
			$order .= $_SESSION['moci06']['search']['order'];
		}
		
		if(!isset($_SESSION['moci06']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.th001,a.th002,a.th003,a.th004,b.mb002,a.th005,c.ma002,a.th007,a.th008,a.th010,a.create_date')
			->from('mocth as a')
			->join('cmsmb as b','a.th004 = b.mb001','left')
			->join('purma as c','a.th005 = c.ma001','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.th001,a.th002,a.th003,a.th004,b.mb002,a.th005,c.ma002,a.th007,a.th008,a.th010,a.create_date')
			->from('mocth as a')
			->join('cmsmb as b','a.th004 = b.mb001','left')
			->join('purma as c','a.th005 = c.ma001','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['moci06']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('mocth');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['moci06']['search']['where'] = $where;
		$_SESSION['moci06']['search']['order'] = $order;
		$_SESSION['moci06']['search']['offset'] = $offset;
		return $ret;
	}
	  
	  /***新增暫存view表方法construct_view
	*	
	*
	***/
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"th001","th002"
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
		$_SESSION['moci06']['search']['view'] = $view_array;
		$_SESSION['moci06']['search']['index'] = $index_array;
	}
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		/*$this->db->select('a.* , b.te004, c.mb002, c.mb003, e.tb004, e.tb005, b.te005, b.te006, b.te008, f.mq002 , d.mc002 as te008disp, b.te009, b.te011, b.te012, b.te014' ,false);
		 
        $this->db->from('moctc as a');	
        $this->db->join('mocte as b', 'a.tc001 = b.te001  AND a.tc002=b.te002 ','left');		
		$this->db->join('invmb as c', 'b.te004 = c.mb001 ','left');
		$this->db->join('cmsmc as d', 'b.te008 = d.mc001 ','left');
		$this->db->join('moctb as e', 'b.te011 = e.tb001 AND b.te012 = e.tb002','left');
		$this->db->join('cmsmq as f', 'substr(a.tc001,1,2) = f.mq003','left');
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002');*/
		
		//$query = $this->db->get();
		$this->db->select('a.*, b.mq002 as puri04disp, c.ma002 as puri01disp, d.mb002 as cmsi02disp, e.mf002 as cmsi06disp, f.na002 as cmsi21disp')
			->from('mocth as a')
			->join('cmsmq as b','a.th001 = b.mq001','left')
			->join('purma as c','a.th005 = c.ma001','left')
			->join('cmsmb as d','a.th004 = d.mb001','left')
			->join('cmsmf as e','a.th007 = e.mf001','left')
			->join('cmsna as f','a.th033 = f.na001','left')
			->where('a.th001', $seq1)
			->where('a.th002', $seq2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('a.*, b.mc002')
			->from('mocti as a')
			->join('invmc as b','a.ti004 = b.mc001','left')
			->where('a.ti001', $seq1)
			->where('a.ti002', $seq2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		return $result;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		$this->db->select('b.tb003, c.mb002, c.mb003, b.tb004, b.tb005, c.mb004, d.mc001, d.mc002, a.ta001, a.ta002, b.tb006, b.tb017, b.tb011'); 
        $this->db->from('mocta as a');	
        $this->db->join('moctb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');	//單身	
        $this->db->join('invmb as c', 'b.tb003 = c.mb001','left');	//品號	
        $this->db->join('cmsmc as d', 'a.ta020 = d.mc001','left');	//庫別
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('b.tb003 , c.mb002 , c.mb003');
		$query = $this->db->get();
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//  系統參數
		function funsysf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsma'); 		
		$query = $this->db->get();
	    $result2['rows2'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result2;
		 }	    		
        }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003, mb004, b.mc002, c.mc002 as mc002disp');
	  $this->db->from('invmb');
	  $this->db->join('invmc as b', 'mb001 = b.mc001','left');
	  $this->db->join('cmsmc as c', 'b.mc002 = c.mc001','left');
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
		
	//ajax 查詢 顯示 請購單別 tm001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '31');
          $this->db->where('mq001', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsmq');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mq002;
              }
		   return $result;   
		   } 
	    }
		
	//ajax 查詢顯示用 請購部門	
	function ajaxcmsq05a($seg1)    
        {
	      $this->db->where('me001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsme');
			
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
		
	//ajax 查詢顯示用 廠別 tl010  
	function ajaxcmsq02a($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmb');
			
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
		
	//ajax 查詢 顯示用 請購人員  
	function ajaxpalq01a($seg1)    
        { 	              
	      $this->db->set('mv001', $this->uri->segment(4));
		  $this->db->where('mv022', '');
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmv');
			
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
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1,$seg2)    
        { 	              
	      $this->db->select_max('tc002');
		  $this->db->where('tc001', $this->uri->segment(4));
	      $this->db->where('tc014', $this->uri->segment(5));
		  $query = $this->db->get('moctc');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tc002;
              }
		      return $result;   
		     }			 
	      }
		  
	//ajax 查詢 顯示用 明細 品號	
	function ajaxinvq02a4($seg1)    
        { 
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
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `mocth` ";
	      $seq1 = "th001, th002, th003, th004, th005, th007, th008, th010, a.create_date FROM `mocth` as a ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'th001 desc' ;
          $seq9 = " ORDER BY th001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="th001 ";

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
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('th001', 'th002', 'th003', 'th004', 'th005', 'b.mb002', 'c.ma002', 'th007', 'tc008', 'tc010', 'a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'th001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('th001, th002, th003, th004, th005, b.mb002, c.ma002, th007, th008, th010, a.create_date')
	                       ->from('mocth as a')
							->join('cmsmb as b','a.th004 = b.mb001','left')
							->join('purma as c','a.th005 = c.ma001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		 //echo "<pre>";var_dump($ret['rows']);
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('mocth as a')
						   ->join('cmsmb as b','a.th004 = b.mb001','left')
							->join('purma as c','a.th005 = c.ma001','left')
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
	      $sort_columns = array('a.tc001', 'a.tc002', 'a.tc003', 'a.tc004','tc004disp', 'a.tc005', 'a.tc006', 'a.tc007','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tm001';  //檢查排序欄位是否為 table
	      $this->db->select('a.tc001, a.tc002, a.tc003, a.tc004,b.ma002 as tc004disp, a.tc005, a.tc006, a.tc007,a.create_date');
	      $this->db->from('moctc as a');
		  $this->db->join('purma as b', 'a.tc004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tl001 asc, tl002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('moctc as a');
		   $this->db->join('purma as b', 'a.tc004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('th001', $seg1);
		  $this->db->where('th002', $seg2);
	      $query = $this->db->get('mocth');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tn001', $this->input->post('purq04a36'));
		  $this->db->where('tn002', $this->input->post('tm002'));
	      $query = $this->db->get('moctn');
	      return $query->num_rows() ;
	    }  	
	//查新增品號廠商資料是否重複 	
    function selone2d($seg1,$seg2,$seg3,$seg4)    
        {
	      $this->db->where('tb001', $seg1);
		  $this->db->where('tb002', $seg2);
		  $this->db->where('tb003', $seg3);
		  $this->db->where('tb006', $seg4);
	      $query = $this->db->get('moctb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  moctc	
		function insertf()    //新增一筆 檔頭  moctc
        {
		 //    $tax=round($this->input->post('ti019')*$this->input->post('ti026'));
		  //   if ($this->input->post('ti018')=='1') {$ti019=round($this->input->post('ti019')-$tax);}
		//	 if ($this->input->post('ti018')!='1') {$ti019=round($this->input->post('ti019'));}
		     if ($this->input->post()){
				extract($this->input->post());
			}
			/*echo "<pre>";
			var_dump($this->input->post());
			exit;*/
			if(!isset($puri04)||!isset($th002)){return FALSE;}
			preg_match_all('/\d/S',$this->input->post('Ddate'), $matches);  //處理日期字串
			$Ddate = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('th003'), $matches);  //處理日期字串
			$th003 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('th028'), $matches);  //處理日期字串
			$th028 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('th013'), $matches);  //處理日期字串
			$th013 = implode('',$matches[0]);
			if(!isset($order_product)){$order_product=array();}
			if(!is_array($order_product)){$order_product=array();}
			if(!isset($th026)){$th026="";}if(!isset($th035)){$th035="";}
            $data = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' =>date("Ymd"),	
				'modifier' => "",
				'modi_date' => "",
				'flag'  => $flag,
				'th001' => $puri04,
				'th002' => $th002,
				'th029' => $Ddate,
				'th003' => $th003,
				'th004' => $cmsi02,
				'th005' => $puri01,
				'th025' => $th025,
				'th036' => $th036,
				'th023' => $th023,
				'th010' => $th010,
				'th011' => $th011,
				'th014' => $th014,
				'th028' => $th028,
				'th012' => $th012,
				'th015' => $th015,
				'th030' => $th030,
				'th013' => $th013,
				'th016' => $th016,
				'th007' => $cmsi06,
				'th008' => $cmsi07,
				'th008' => $cmsi07,
				'th009' => $th009,
				'th006' => $th006,
				'th033' => $cmsi21,
				'th010' => $th010,
				'th026' => $th026,
				'th035' => $th035
			);
			$exist = $this->moci06_model->selone1($puri04,$th002);
			while($this->moci06_model->selone1($puri04,$th002)>0){
				$th002 = $this->check_title_no($puri04,$Ddate);
			}
			$this->db->insert('mocth', $data);
			
			foreach($order_product as $key => $val){
				if($val['ti003'] && $val['ti004']){
					extract($val);
					$data = array( 
						'company' => $this->session->userdata('syscompany'),
						'creator' => $this->session->userdata('manager'),
						'usr_group' => 'A100',
						'create_date' =>date("Ymd"),
						'modifier' => '',
						'modi_date' => '',
						'flag' => 0,
						'ti001' => $puri04,
						'ti002' => $th002,
						'ti011' => substr($ti011,0,4).substr($ti011,5,2).substr($ti011,8,2),
						'ti012' => substr($ti011,0,4).substr($ti011,5,2).substr($ti011,8,2),
						'ti018' => substr($ti011,0,4).substr($ti011,5,2).substr($ti011,8,2)
					);
					foreach($val as $k=>$v){
						if($k!="ti001"&&$k!="ti002"&&$k!="mc002"&&$k!="ti011"&&$k!="ti012"&&$k!="ti018"){//主鍵不用更改
							$data[$k] = $v;
						}
					}
					
					$this->db->insert('mocti', $data);
				}
			}
			
			
			//處理製令的以領用量(製令單身)
			/*$list = array();
			$temp_array = array();
			
			foreach($order_product as $key=>$val){
				extract($val);
				if($te004&&$te011&&$te012){
					if(isset($list[$te004.'_'.$te011.'_'.$te012])){
						$list[$te004.'_'.$te011.'_'.$te012] += $te005;
					}else{
						$list[$te004.'_'.$te011.'_'.$te012] = $te005;
					}
				}
			}
			
			foreach($list as $key => $val){
				$temp = explode('_',$key);
				$temp2 = $val;
				$this->db->select('tb005');
				$this->db->from('moctb');
				$this->db->where('tb003',$temp[0]);
				$this->db->where('tb001',$temp[1]);
				$this->db->where('tb002',$temp[2]);
				$query = $this->db->get();
				$temp_array = $query->result();
				
				foreach($temp_array as $key => $val){
					$temp3 = $val->tb005;
					$temp3 -= $temp2;
					
					$data=array(
						'tb005' => $temp3
					);
					$this->db->where('tb003',$temp[0]);
					$this->db->where('tb001',$temp[1]);
					$this->db->where('tb002',$temp[2]);
					$this->db->update('moctb',$data); 
					$this->db->flush_cache();
					
						
				}
			}
			
			//處理製令的以領用量(庫別)
			$list2 = array();
			$temp_array2 = array();
			
			foreach($order_product as $key=>$val){
				extract($val);
				if($te004&&$te008){
					if(isset($list2[$te004.'_'.$te008])){
						$list2[$te004.'_'.$te008] += $te005;
					}else{
						$list2[$te004.'_'.$te008] = $te005;
					}
				}
			}
			
			foreach($list2 as $key => $val){
				$temp = explode('_',$key);
				$temp2 = $val;
				$this->db->select('mc007');
				$this->db->from('invmc');
				$this->db->where('mc001',$temp[0]);
				$this->db->where('mc002',$temp[1]);
				$query = $this->db->get();
				$temp_array = $query->result();
				
				foreach($temp_array as $key => $val){
					$temp3 = $val->mc007;
					$temp3 += $temp2;
					$data=array(
						'mc007' => $temp3
					);
					$this->db->where('mc001',$temp[0]);
					$this->db->where('mc002',$temp[1]);
					$this->db->update('invmc',$data); 
					$this->db->flush_cache();
					
						
				}
			}*/
		}
		 
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('purq04a32'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('purq04a32')."/".$this->input->post('tl002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 	 	 	 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tc001', $this->input->post('tc001c')); 
          $this->db->where('tc002', $this->input->post('tc002c'));
	      $query = $this->db->get('moctc');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        /*{
	        $this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('moctc');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         		
         //   if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() == 1) 
		       {
			     $result = $query->result();
			     foreach($result as $row):
                $tc003=$row->tc003;$tc004=$row->tc004;$tc005=$row->tc005;$tc006=$row->tc006;$tc007=$row->tc007;$tc008=$row->tc008;$tc009=$row->tc009;$tc010=$row->tc010;
				$tc011=$row->tc011;$tc012=$row->tc012;$tc013=$row->tc013;$tc014=$row->tc014;$tc015=$row->tc015;$tc016=$row->tc016;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tc001c');    //主鍵一筆檔頭moctm
			$seq2=$this->input->post('tc002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tc001' => $seq1,'tc002' => $seq2,'tc003' => $tc003,'tc004' => $tc004,'tc005' => $tc005,'tc006' => $tc006,'tc007' => $tc007,'tc008' => $tc008,'tc009' => $tc009,'tc010' => $tc010,
		           'tc011' => $tc011,'tc012' => $tc012, 'tc013' => $tc013, 'tc014' => $tc014, 'tc015' => $tc015, 'tc016' => $tc016
                   );
				   
            $exist = $this->moci06_model->selone2($this->input->post('tc001c'),$this->input->post('tc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('moctc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('te001', $this->input->post('te001o'));
			$this->db->where('te002', $this->input->post('te002o'));
	        $query = $this->db->get('mocte');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         
			    $num=$query->num_rows();
          //  if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() >= 1) 
		       {
			     $result = $query->result();
				 $i=0;
			     foreach($result as $row):
                 $te003[$i]=$row->te003;$te004[$i]=$row->te004;$te005[$i]=$row->te005;$te006[$i]=$row->te006;$te007[$i]=$row->te007;
				 $te008[$i]=$row->te008;$te009[$i]=$row->te009;$te010[$i]=$row->te010;$te011[$i]=$row->te011;$te012[$i]=$row->te012;
				 $te013[$i]=$row->te013;$te014[$i]=$row->te014;$te015[$i]=$row->te015;$te016[$i]=$row->te016;$te017[$i]=$row->te017;
				 $te018[$i]=$row->te018;$te019[$i]=$row->te019;$te020[$i]=$row->te020;$te021[$i]=$row->te021;$te022[$i]=$row->te022;
				 
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tc001c');    //主鍵一筆明細purtm
			$seq2=$this->input->post('tc002c'); 
              $i=0;
            while ($i<$num) {	
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                'te001' => $seq1,'te002' => $seq2,'te003' => $te003[$i],'te004' => $te004[$i],'te005' => $te005[$i],'te006' => $te006[$i],'te007' => $te007[$i],'te008' => $te008[$i],
				'te009' => $te009[$i],'te010' => $te010[$i],'te011' => $te011[$i],'te012' => $te012[$i],'te013' => $te013[$i],'te014' => $te014[$i],'te015' => $te015[$i],'te016' => $te016[$i],
				'te017' => $te017[$i],'te018' => $te018[$i],'te019' => $te019[$i],'te020' => $te020[$i],'te021' => $te021[$i],'te022' => $te022[$i]
                ); 
				
             $this->db->insert('mocte', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }*/
	   
	   {
	        $this->db->where('th001', $this->input->post('th001o'));
	        $this->db->where('th002', $this->input->post('th002o'));
	        $query = $this->db->get('mocth');
	        $exist = $query->num_rows();
            if($exist){
				$result = $query->result();
			}
			else{
				return "nodata";
			}
			
			$data = array();
			foreach($result[0] as $key => $val){
				$data[$key] = $val;
			}
			$data['creator'] = $this->session->userdata('manager');
			$data['modifier'] = "";
			$data['modi_date'] = "";
			$data['flag'] = "";
			$data['th001'] = $this->input->post('th001c');
			$data['th002'] = $this->input->post('th002c');
			
            $exist = $this->moci06_model->selone1($this->input->post('th001c'),$this->input->post('th002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
            return $this->db->insert('mocth', $data);      //複製一筆  
        }	

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ti001o');    
	      $seq2=$this->input->post('ti001c');
	      $seq3=$this->input->post('ti002o');
	      $seq4=$this->input->post('ti002c');
	      $sql = " SELECT a.ti001, a.ti002, a.ti004, a.ti005, a.ti006, a.ti007, a.ti008, a.ti009, a.ti010, a.ti011, a.ti012, a.ti013, a.ti014, a.ti015, a.ti016, a.ti017, a.ti018, a.ti019, a.ti020, a.ti021, a.ti022, a.ti023, a.ti024, a.ti025, a.ti026, a.ti027, a.ti028, a.ti029, a.ti030, a.ti031, a.ti032, a.ti033, a.ti034, a.ti035, a.ti036, a.ti037, a.ti038, a.ti039, a.ti040, a.ti041, a.ti042, a.ti043, a.ti044, a.ti045, a.ti046, a.ti047, a.ti048, a.ti049, a.ti050, a.ti051 FROM mocti as a  WHERE a.ti001 >= '$seq1' AND a.ti001 <= '$seq2' AND a.ti002 >= '$seq3' AND a.ti002 <= '$seq4' ORDER BY ti001,ti002 "; 
		  $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('th001o');    
	      $seq2=$this->input->post('th001c');
		  $seq3=$this->input->post('th002o');    
	      $seq4=$this->input->post('th002c');
	      $sql = " SELECT a.th001, a.th002, a.th003, a.th004, a.th005, a.th006, a.th009, a.th010, a.th015, a.th016, a.th023, b.ti004, b.ti005, b.ti006, b.ti007, b.ti020, b.ti019, b.ti020, b.ti022, b.ti023, b.ti018, b.ti027, b.ti024, b.ti025, b.ti026, b.ti009, c.mc002 as ti009disp, b.ti014, b.ti015, d.mq002 as puri04disp, f.ma002 as puri01disp , e.mb002 as cmsi02disp
					FROM mocth as a , mocti as b , cmsmc as c , cmsmq as d , cmsmb as e  , purma as f
					WHERE a.th001 = b.ti001 AND a.th002 = b.ti002 AND b.ti009 = c.mc001 AND a.th001 = d.mq001 AND a.th004 = e.mb001 AND a.th005 = f.ma001 AND th001 >= '$seq1'  AND th001 <= '$seq2' AND th002 >= '$seq3'  AND th002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "th001 >= '$seq1'  AND th001 <= '$seq2' AND th002 >= '$seq3'  AND th002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('mocth')
		              ->where($seq32);
	      $num = $query->get()->result();
	      $ret['num_rows'] = $num[0]->count;
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tl001disp, d.me002 AS tl004disp, e.mb002 AS tl010disp, f.mv002 AS tl012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tm001, b.tm002, b.tm003, b.tm004, b.tm005,
		  b.tm006, b.tm007, b.tm011, b.tm009, b.tm017, b.tm018, b.tm012');
		 
        $this->db->from('moctm as a');	
        $this->db->join('purtm as b', 'a.tl001 = b.tm001  and a.tl002=b.tm002 ','left');		
		$this->db->join('cmsmq as c', 'a.tl001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tl004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tl010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tl012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tl001', $this->uri->segment(4)); 
	    $this->db->where('a.tl002', $this->uri->segment(5)); 
		$this->db->order_by('tl001 , tl002 ,b.tm003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tm001', $this->uri->segment(4));
		$this->db->where('tm002', $this->uri->segment(5));
	    $query = $this->db->get('purtm');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
     {           
        $this->db->select('a.th001, a.th002, a.th003, a.th004, a.th005, a.th006, a.th009, a.th010, a.th015, a.th016, a.th023, b.ti004, b.ti005, b.ti006, b.ti007, b.ti020, b.ti019, b.ti020, b.ti022, b.ti023, b.ti018, b.ti027, b.ti024, b.ti025, b.ti026, b.ti009, b.ti047, c.mc002 as ti009disp, b.ti014, b.ti015, d.mq002 as puri04disp, f.ma002 as puri01disp , e.mb002 as cmsi02disp');
        $this->db->from('mocth as a');	
        $this->db->join('mocti as b', 'a.th001 = b.ti001  and a.th002=b.ti002 ','left');	//單身	
		$this->db->join('cmsmc as c', 'b.ti009 = c.mc001','left');
		$this->db->join('cmsmq as d', 'a.th001 = d.mq001','left');
		$this->db->join('cmsmb as e', 'a.th004 = e.mb001','left');
		$this->db->join('purma as f', 'a.th005 = f.ma001','left');
		$this->db->where('a.th001', $this->input->post('th001o')); 
	    $this->db->where('a.th002 >= '.$this->input->post('th002o').' and a.th002 <= '.$this->input->post('th002c')); 
		$this->db->order_by('th001 , th002');
				
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	   //印單據筆  半張紙letter1/2 A4half  公司表頭
		function companyf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsml'); 		
		$query = $this->db->get();
	    $result1['rows1'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result1;
		 }	    		
        }
	
	//印單據筆  
		function printfb()   
        {           
        $this->db->select('a.th001, a.th002, a.th003, a.th004, a.th005, a.th006, a.th009, a.th010, a.th015, a.th016, a.th023, a.th029, b.ti004, b.ti005, b.ti006, b.ti007, b.ti020, b.ti019, b.ti020, b.ti022, b.ti023, b.ti018, b.ti027, b.ti024, b.ti025, b.ti026, b.ti009, b.ti047, c.mc002 as ti009disp, b.ti014, b.ti015, d.mq002 as puri04disp, f.ma002 as puri01disp , e.mb002 as cmsi02disp');
        $this->db->from('mocth as a');	
        $this->db->join('mocti as b', 'a.th001 = b.ti001 and a.th002 = b.ti002 ','left');	//單身	
		$this->db->join('cmsmc as c', 'b.ti009 = c.mc001','left');
		$this->db->join('cmsmq as d', 'a.th001 = d.mq001','left');
		$this->db->join('cmsmb as e', 'a.th004 = e.mb001','left');
		$this->db->join('purma as f', 'a.th005 = f.ma001','left');
		$this->db->where('a.th001', $this->uri->segment(4)); 
	    $this->db->where('a.th002', $this->uri->segment(5)); 
		$this->db->order_by('th001 , th002');
		
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }	    		
        }
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別	
	function lookupa($keyword){     
      $this->db->select('mc001, mc002')->from('cmsmc');  
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }
		
	//更改一筆	
	function updatef()  
		{
			if ($this->input->post()){
				extract($this->input->post());
			}
			/*echo "<pre>";
			var_dump($this->input->post());
			exit;*/
			if(!isset($puri04)||!isset($th002)){return FALSE;}
			preg_match_all('/\d/S',$this->input->post('Ddate'), $matches);  //處理日期字串
			$Ddate = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('th003'), $matches);  //處理日期字串
			$th003 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('th028'), $matches);  //處理日期字串
			$th028 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('th013'), $matches);  //處理日期字串
			$th013 = implode('',$matches[0]);
			if(!isset($order_product)){$order_product=array();}
			if(!is_array($order_product)){$order_product=array();}
			if(!isset($th026)){$th026="";}if(!isset($th035)){$th035="";}
            $data = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' =>date("Ymd"),	
				'modifier' => "",
				'modi_date' => "",
				'flag'  => $flag,
				'th001' => $puri04,
				'th002' => $th002,
				'th029' => $Ddate,
				'th003' => $th003,
				'th004' => $cmsi02,
				'th005' => $puri01,
				'th025' => $th025,
				'th036' => $th036,
				'th023' => $th023,
				'th010' => $th010,
				'th011' => $th011,
				'th014' => $th014,
				'th028' => $th028,
				'th012' => $th012,
				'th015' => $th015,
				'th030' => $th030,
				'th013' => $th013,
				'th016' => $th016,
				'th007' => $cmsi06,
				'th008' => $cmsi07,
				'th008' => $cmsi07,
				'th009' => $th009,
				'th006' => $th006,
				'th033' => $cmsi21,
				'th010' => $th010,
				'th026' => $th026,
				'th035' => $th035
			);
            $this->db->where('th001', $puri04);
            $this->db->where('th002', $th002);
            $this->db->update('mocth',$data);                   //更改一筆
			foreach($order_product as $key => $val){
				extract($val);
				
				if($this->seldetail($puri04,$th002,$val['ti003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag,
						'ti011' => substr($ti011,0,4).substr($ti011,5,2).substr($ti011,8,2),
						'ti012' => substr($ti012,0,4).substr($ti012,5,2).substr($ti012,8,2),
						'ti018' => substr($ti018,0,4).substr($ti018,5,2).substr($ti018,8,2)
					);
					foreach($val as $k=>$v){
						if($k!="ti001"&&$k!="ti002"&&$k!="mc002"&&$k!="ti011"&&$k!="ti012"&&$k!="ti018"){//主鍵不用更改以及其他外來鍵
							$data[$k] = $v;
							
						}
					}
					$this->db->where('ti001', $puri04);
					$this->db->where('ti002', $th002);
					$this->db->where('ti003', $ti003);
					$this->db->update('mocti',$data);//更改一筆
					
				}else{
					if($val['ti003'] && $val['ti004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'ti001' => $puri04,
							'ti002' => $th002,
							'ti011' => substr($ti011,0,4).substr($ti011,5,2).substr($ti011,8,2),
							'ti012' => substr($ti012,0,4).substr($ti012,5,2).substr($ti012,8,2),
							'ti018' => substr($ti018,0,4).substr($ti018,5,2).substr($ti018,8,2)
							
						);
						foreach($val as $k=>$v){
							if($k!="ti001"&&$k!="ti002"&&$k!="mc002"&&$k!="ti011"&&$k!="ti012"&&$k!="ti018"){//主鍵不用更改以及其他外來鍵&日期欄位
								$data[$k] = $v;
							}
						}
						$this->db->insert('mocti', $data);
					}
				}
				
			}
			
			//處理製令的以領用量(製令單身)
			/*$list = array();
			$temp_array = array();
			
			foreach($order_product as $key=>$val){
				extract($val);
				if($te004&&$te011&&$te012){
					if(isset($list[$te004.'_'.$te011.'_'.$te012])){
						$list[$te004.'_'.$te011.'_'.$te012] += $te005;
					}else{
						$list[$te004.'_'.$te011.'_'.$te012] = $te005;
					}
				}
			}
			
			foreach($list as $key => $val){
				$temp = explode('_',$key);
				$temp2 = $val;
				$this->db->select('tb005');
				$this->db->from('moctb');
				$this->db->where('tb003',$temp[0]);
				$this->db->where('tb001',$temp[1]);
				$this->db->where('tb002',$temp[2]);
				$query = $this->db->get();
				$temp_array = $query->result();
				
				foreach($temp_array as $key => $val){
					$temp3 = $val->tb005;
					$temp3 -= $temp2;
					
					$data=array(
						'tb005' => $temp3
					);
					$this->db->where('tb003',$temp[0]);
					$this->db->where('tb001',$temp[1]);
					$this->db->where('tb002',$temp[2]);
					$this->db->update('moctb',$data); 
					$this->db->flush_cache();
					
						
				}
			}
			
			//處理製令的以領用量(庫別)
			$list2 = array();
			$temp_array2 = array();
			
			foreach($order_product as $key=>$val){
				extract($val);
				if($te004&&$te008){
					if(isset($list2[$te004.'_'.$te008])){
						$list2[$te004.'_'.$te008] += $te005;
					}else{
						$list2[$te004.'_'.$te008] = $te005;
					}
				}
			}
			
			foreach($list2 as $key => $val){
				$temp = explode('_',$key);
				$temp2 = $val;
				$this->db->select('mc007');
				$this->db->from('invmc');
				$this->db->where('mc001',$temp[0]);
				$this->db->where('mc002',$temp[1]);
				$query = $this->db->get();
				$temp_array = $query->result();
				
				foreach($temp_array as $key => $val){
					$temp3 = $val->mc007;
					$temp3 += $temp2;
					$data=array(
						'mc007' => $temp3
					);
					$this->db->where('mc001',$temp[0]);
					$this->db->where('mc002',$temp[1]);
					$this->db->update('invmc',$data); 
					$this->db->flush_cache();
					
						
				}
			}*/
			
			
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('ti001', $seg1);
			$this->db->where('ti002', $seg2);
	        $this->db->where('ti003', $seg3);
	        $query = $this->db->get('mocti');
	        return $query->num_rows() ; 
	    }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tm001', $this->uri->segment(4));
		  $this->db->where('tm002', $this->uri->segment(5));
          $this->db->delete('moctm'); 
		  $this->db->where('tn001', $this->uri->segment(4));
		  $this->db->where('tn002', $this->uri->segment(5));
          $this->db->delete('moctn'); 
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
			      $this->db->where('th001', $seq1);
			      $this->db->where('th002', $seq2);
                  $this->db->delete('mocth'); 
				  $this->db->where('ti001', $seq1);
			      $this->db->where('ti002', $seq2);
                  $this->db->delete('mocti'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	 function del_detail(){
		$this->db->where('te001', $_POST['del_md001']);
		$this->db->where('te002', $_POST['del_md002']);
		$this->db->where('te003', $_POST['del_md003']);
		$this->db->delete('mocte');
	}
	
	function check_moci01(){
		 $this->db->select('ta001, ta002, b.tb003, b.tb004, b.tb005');
		 $this->db->from('mocta');
		 $this->db->join('moctb as b','b.tb001=ta001 and b.tb002=ta002','left');
		 
		 $query=$this->db->get();
		 $result=$query->result();
		 return $result;
		 
	}
	
	function check_title_no($puri04,$Ddate){
		preg_match_all('/\d/S',$Ddate, $matches);  //處理日期字串
		$Ddate = implode('',$matches[0]);
		$this->db->select('MAX(th002) as max_no')
			->from('mocth')
			->where('th001', $puri04)
			->like('th029', $Ddate, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $Ddate."001";}
		return $result[0]->max_no+1;
	}
		
	function lookupmoc($select_col=array(),$search_col=array(),$keyword=array(),$limit=15){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('moctb');
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
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('ti001', $seg1);
	      $this->db->where('ti002', $seg2);
	      $this->db->where('ti003', $seg3);
          $this->db->delete('mocti'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	function check_detail_num($ta001,$ta002){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('mocta as a')
				->join('invmb as b','a.ta006 = b.mb001','left')
				->join('cmsmc as c','b.mb017 = c.mc001','left')
				->where('ta001',$ta001)
				->where('ta002',$ta002);
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;	
	}
	
	function get_detail_data($ta001,$ta002){
		
		$query = $this->db->select('*')
				->from('mocta as a')
				->join('invmb as b','a.ta006 = b.mb001','left')
				->join('cmsmc as c','b.mb017 = c.mc001','left')
				->where('ta001',$ta001)
				->where('ta002',$ta002);
				
		$data = $query->get()->result();
		return $data;	
	}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>