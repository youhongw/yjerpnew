<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bomi06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tf001, tf002, tf003, tf004, tf005, tf006,tf008,tf010,tf011,tf013, create_date');
          $this->db->from('bomtf');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tf001 desc, tf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('bomtf');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tf001', 'tf002', 'tf003', 'tf004', 'tf005', 'tf007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tf001, a.tf002, a.tf003, a.tf004,b.ma002 as tf004disp, a.tf005, a.tf007,a.create_date')
	                       ->from('bomtf as a')
						   ->join('purma as b', 'a.tf004 = b.ma001 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomtf');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('bomi06_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['bomi06']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['bomi06']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tf002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['bomi06']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['bomi06']['search']['where'];
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
				$value .= $val." like '".$val_ary[$key]."%' ";  //%% 合部搜尋 先一個 like '%
			}
			$where .= "(".$value.")";
		}
		
		if($func == "or_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " or ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " or ";}
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
		
		if(isset($_SESSION['bomi06']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['bomi06']['search']['order'];
		}
		
		if(!isset($_SESSION['bomi06']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,c.mq002,b.mb002,b.mb003,c.mq002 as tf001disp,b.mb002 as tf004disp,b.mb003 as tf004disp1')
	                       ->from('bomtf as a')
						   ->join('invmb as b', 'a.tf004 = b.mb001','left')
						   ->join('cmsmq as c', 'a.tf001 = c.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,c.mq002,b.mb002,b.mb003,c.mq002 as tf001disp,b.mb002 as tf004disp,b.mb003 as tf004disp1')
	                       ->from('bomtf as a')
						   ->join('invmb as b', 'a.tf004 = b.mb001','left')
						   ->join('cmsmq as c', 'a.tf001 = c.mq001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['bomi06']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('bomtf as a')
		    ->join('invmb as b', 'a.tf004 = b.mb001','left')
			->join('cmsmq as c', 'a.tf001 = c.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['bomi06']['search']['where'] = $where;
		$_SESSION['bomi06']['search']['order'] = $order;
		$_SESSION['bomi06']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"tf001","tf002"
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
		$_SESSION['bomi06']['search']['view'] = $view_array;
		$_SESSION['bomi06']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['bomi06']['search']['view']);exit;
	}		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf004disp,d.mb003 AS tf004disp1, e.mc002 AS tf008disp,
		  f.mb002 as tg004disp,f.mb003 as tg004disp1,g.mc002 as tg007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007,b.tg008,b.tg009,b.tg010, b.tg011, b.tg012, b.tg013');
		 
        $this->db->from('bomtf as a');	
        $this->db->join('bomtg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001  ','left');
		$this->db->join('invmb as d', 'a.tf004 = d.mb001 ','left');		
	    $this->db->join('cmsmc as e', 'a.tf008 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.tg004 = f.mb001 ','left');		
	    $this->db->join('cmsmc as g', 'b.tg007 = g.mc001 ','left');
		$this->db->where('a.tf001', $seq1); 
	    $this->db->where('a.tf002', $seq2); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*,c.mc002 as tg007disp,d.mb002 as tg004disp,d.mb003 as tg004disp1')
			->from('bomtg as b')
			->join('cmsmc as c', 'b.tg007 = c.mc001 ','left')   //庫別
			->join('invmb as d', 'b.tg004 = d.mb001 ','left')
			->where('b.tg001', $seq1)
			->where('b.tg002', $seq2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('invmb');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
		
	//ajax 查詢 顯示 請購單別 tg001	
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
		
	//ajax 查詢顯示用 廠別 tf010  
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
	      $this->db->select_max('tf002');
		  $this->db->where('tf001', $this->uri->segment(4));
	      $this->db->where('tf010', $this->uri->segment(5));
		  $query = $this->db->get('bomtf');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tf002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `bomtf` ";
	      $seq1 = "tf001, tf002, tf003, tf004, tf005,tf006, tf010, a.create_date FROM `bomtf` as a ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'tf001 desc' ;
          $seq9 = " ORDER BY tf001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
         $seq7="tf001 ";

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
	     $sort_columns = array('tf001', 'tf002', 'tf003', 'tf004', 'tf005', 'tf006','tf007','tf008','tf010','tf011','tf021','tf031','tf019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('tf001, tf002, tf003, tf004,c.mq002,c.mq002 as tf001disp,b.mb002,b.mb003,b.mb002 as tf004disp,b.mb003 as tf004disp1, tf005, tf006,tf007,tf010,tf008,tf010,tf012, a.create_date')
	                       ->from('bomtf as a')
						  ->join('invmb as b', 'a.tf004 = b.mb001 ','left')
						   ->join('cmsmq as c', 'a.tf001 = c.mq001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomtf as a')
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
	      $sort_columns = array('tf001', 'tf002', 'tf003', 'tf005', 'tf021', 'tf031','tf019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否為 table
	      $this->db->select('tf001, tf002, tf003, tf004,c.mq002,c.mq002 as tf001disp,b.mb002,b.mb003,b.mb002 as tf004disp,b.mb003 as tf004disp1,tf005, tf007, tf012, a.create_date');
	      $this->db->from('bomtf as a');
		  $this->db->join('invmb as b', 'a.tf004 = b.mb001 ','left');
		  $this->db->join('cmsmq as c', 'a.tf001 = c.mq001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tf001 asc, tf002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('bomtf');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('tf001', $this->input->post('purq04a32'));
		  $this->db->where('tf002', $this->input->post('tf002'));
	      $query = $this->db->get('bomtf');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tg001', $this->input->post('purq04a32'));
		  $this->db->where('tg002', $this->input->post('tf002'));
	      $query = $this->db->get('bomtg');
	      return $query->num_rows() ;
	    }  	
	//查新增品號廠商資料是否重複 	
    function selone2d($seg1,$seg2,$seg3,$seg4,$seg5)    
        {
	      $this->db->where('mb001', $seg1);
		  $this->db->where('mb002', $seg2);
		  $this->db->where('mb003', $seg3);
		  $this->db->where('mb004', $seg4);
		  $this->db->where('mb014', $seg5);
	      $query = $this->db->get('purmb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  bomtf	
	function insertf()    //新增一筆 檔頭  bomtf
        {
			  preg_match_all('/\d/S',$this->input->post('tf003'), $matches);  //處理日期字串
			 $tf003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf012'), $matches);  //處理日期字串
			 $tf012 = implode('',$matches[0]);
			 
			 
			 $tf001=$this->input->post('tf001');
			 $tf002=$this->input->post('tf002');
			 
			 $tf004=$this->input->post('tf004');
			 $tf008=$this->input->post('tf008');
			 $tf010=$this->input->post('tf010');
			 $tf007=$this->input->post('tf007');
			 $tf201=$this->input->post('tf201');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tf001' => $this->input->post('tf001'),
		         'tf002' => $this->input->post('tf002'),
		         'tf003' => $tf003,
		         'tf004' => $this->input->post('tf004'),
		         'tf005' => $this->input->post('tf005'),
		         'tf006' => $this->input->post('tf006'),
                 'tf007' => $this->input->post('tf007'),
                 'tf008' => $this->input->post('tf008'),
                 'tf009' => $this->input->post('tf009'),
                 'tf010' => $this->input->post('tf010'),	
                 'tf011' => $this->input->post('tf011'),		
                 'tf012' => $tf012,
				 'tf013' => $this->input->post('tf013'),
				 'tf014' => $this->input->post('tf014'),
				 'tf015' => $this->input->post('tf015'),
				 'tf016' => $this->input->post('tf016'),
				 'tf017' => $this->input->post('tf017'),
				 'tf018' => $this->input->post('tf018'),
				 'tf200' => $this->input->post('tf200'),
				 'tf201' => $this->input->post('tf201')
                 
                );
         
	     $tf002no=$tf002;   //明細用再新增一筆時加1
           //檢查資料是否已存在 若存在加1
			  while($this->bomi06_model->selone1($tf001,$tf002)>0){
				$tf002 = $this->check_title_no($tf001,$tf012);
				$tf002no=$tf002;
			}
	     
             $this->db->insert('bomtf', $data);
			 
			 //庫存增加欄位 庫別
				if (@$tf004 and @$tf008  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tf004','$tf008','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存增加				
				if (@$tf004 and @$tf010 and @$tf007 and @$tf201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007-'$tf007',mc008=mc008-'$tf201' WHERE mc001 = '$tf004'  AND mc002 = '$tf008'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064-'$tf007',mb065=mb065-'$tf201' WHERE mb001 = '$tf004'   "; 
		         $query = $this->db->query($sql84);
					}
				//平均單價MC014
				if (@$tf004 and @$tf008  ) {
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$tf004'  AND mc002 = '$tf008' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$tf004'  AND mc002 = '$tf008' and  mc007<0  "; 
				$query = $this->db->query($sql832);}
				 $tf007=0;$tf201=0;$tf004='';$tf010='';
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
			
		// 新增明細 coptb
		  $vtg003='1010';		//流水號重新排序
		 foreach($order_product as $key => $val){
		        if($val['tg003'] && $val['tg004']){
				        extract($val);
					//	preg_match_all('/\d/S',$tg014, $matches);  //處理日期字串
			         //   $tg014 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tg001' => $tf001,
							'tg002' => $tf002no
						);
						foreach($val as $k=>$v){
							if($k!="tg001"&&$k!="tg002"&&$k!="tg004disp"&&$k!="tg004disp1"&&$k!="tg007disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tg003") {$data[$k] = $vtg003;} else {$data[$k] = $v;} //流水號
							}
						}
					$this->db->insert('bomtg', $data);
					$mtg003 = (int) $vtg003+10;
			        $vtg003 =  (string)$mtg003;
				}
				preg_match_all('/\d/S',$this->input->post('tf012'), $matches);  //處理日期字串
			    $tf012 = implode('',$matches[0]);
				
				//庫存增加欄位 庫別
				if (@$tg004 and @$tg007  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tg004','$tg007','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存減少				
				if (@$tg004 and @$tg007 and @$tg008 and @$tg201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007-'$tg008',mc008=mc008-'$tg201' WHERE mc001 = '$tg004'  AND mc002 = '$tg007'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064-'$tg008',mb065=mb065-'$tg201' WHERE mb001 = '$tg004'   "; 
		         $query = $this->db->query($sql84);
					}
				//平均單價MC014
				if (@$tg004 and @$tg007  ) {
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$tg004'  AND mc002 = '$tg007' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$tg004'  AND mc002 = '$tg007' and  mc007<0  "; 
				$query = $this->db->query($sql832);}
				 $tg008=0;$tg201=0;$tg004='';$tg007='';
				
			}
		 }
		 
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('purq04a32'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if(@$tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('purq04a32')."/".$this->input->post('tf002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 	 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tf001', $this->input->post('tf001c')); 
          $this->db->where('tf002', $this->input->post('tf002c'));
	      $query = $this->db->get('bomtf');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tf001', $this->input->post('tf001o'));
			$this->db->where('tf002', $this->input->post('tf002o'));
	        $query = $this->db->get('bomtf');
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
                $tf003=$row->tf003;$tf004=$row->tf004;$tf005=$row->tf005;$tf006=$row->tf006;$tf007=$row->tf007;$tf008=$row->tf008;$tf009=$row->tf009;$tf010=$row->tf010;
				$tf011=$row->tf011;$tf012=$row->tf012;$tf013=$row->tf013;$tf014=$row->tf014;$tf015=$row->tf015;$tf016=$row->tf016;$tf017=$row->tf017;$tf018=$row->tf018;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tf001c');    //主鍵一筆檔頭bomtf
			$seq2=$this->input->post('tf002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tf001' => $seq1,'tf002' => $seq2,'tf003' => $tf003,'tf004' => $tf004,'tf005' => $tf005,'tf006' => $tf006,'tf007' => $tf007,'tf008' => $tf008,'tf009' => $tf009,'tf010' => $tf010,
		           'tf011' => $tf011,'tf012' => $tf012,'tf013' => $tf013,'tf014' => $tf014,'tf015' => $tf015,'tf016' => $tf016,'tf017' => $tf017,'tf018' => $tf018
                   );
				   
            $exist = $this->bomi06_model->selone2($this->input->post('tf001c'),$this->input->post('tf002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('bomtf', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tg001', $this->input->post('tf001o'));
			$this->db->where('tg002', $this->input->post('tf002o'));
	        $query = $this->db->get('bomtg');
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
                 $tg003[$i]=$row->tg003;$tg004[$i]=$row->tg004;$tg005[$i]=$row->tg005;$tg006[$i]=$row->tg006;$tg007[$i]=$row->tg007;
				 $tg008[$i]=$row->tg008;$tg009[$i]=$row->tg009;$tg010[$i]=$row->tg010;$tg011[$i]=$row->tg011;$tg012[$i]=$row->tg012;
				 $tg013[$i]=$row->tg013;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tf001c');    //主鍵一筆明細bomtg
			$seq2=$this->input->post('tf002c'); 
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
                'tg001' => $seq1,'tg002' => $seq2,'tg003' => $tg003[$i],'tg004' => $tg004[$i],'tg005' => $tg005[$i],'tg006' => $tg006[$i],'tg007' => $tg007[$i],
		        'tg008' => $tg008[$i],'tg009' => $tg009[$i],'tg010' => $tg010[$i],'tg011' => $tg011[$i],'tg012' => $tg012[$i],
				'tg013' => $tg013[$i]
                ); 
				
             $this->db->insert('bomtg', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tf001o');    
	      $seq2=$this->input->post('tf001c');
		  $seq3=$this->input->post('tf002o');    
	      $seq4=$this->input->post('tf002c');	 
         $sql = " SELECT a.tf001,a.tf002,a.tf012,a.tf010,a.tf007,a.tf008,a.tf004,c.mb002 as tf004disp,c.mb003 as tf004disp1,a.tf005,
		           b.tg003,b.tg004,d.mb002 as tg004disp,d.mb003 as tg004disp1, tg005, tg007,tg011,tg009
		       FROM bomtf as a LEFT JOIN bomtg as b ON  a.tf001=b.tg001 and a.tf002=b.tg002 and  a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.tf004=c.mb001  LEFT JOIN invmb as d ON b.tg004=d.mb001"; 
	//	  FROM bomtf as a, bomtg as b WHERE tf001=tg001 and tf002=tg002 and  tf001 >= '$seq1'  AND tf001 <= '$seq2' AND tf002 >= '$seq3'  AND tf002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	     $seq1=$this->input->post('tf001o');    
	      $seq2=$this->input->post('tf001c');
		  $seq3=$this->input->post('tf002o');    
	      $seq4=$this->input->post('tf002c');
	 
		$sql = " SELECT a.tf001,a.tf002,a.tf012,a.tf010,a.tf007,a.tf008,a.tf004,c.mb002 as tf004disp,c.mb003 as tf004disp1,a.tf005,
		           b.tg003,b.tg004,d.mb002 as tg004disp,d.mb003 as tg004disp1, tg005, tg007,tg011,tg009,tg008,tg012
		       FROM bomtf as a LEFT JOIN bomtg as b ON  a.tf001=b.tg001 and a.tf002=b.tg002 and  a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.tf004=c.mb001  LEFT JOIN invmb as d ON b.tg004=d.mb001"; 				  
	//	  FROM bomtf as a, bomtg as b WHERE tf001=tg001 and tf002=tg002 and  tf001 >= '$seq1'  AND tf001 <= '$seq2' AND tf002 >= '$seq3'  AND tf002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tf001 >= '$seq1'  AND tf001 <= '$seq2' AND tf002 >= '$seq3'  AND tf002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('bomtf')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
          $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf004disp,d.mb003 as tf004disp1, e.mc002 as tf008disp 
		  ,f.mb002 as tg004disp,f.mb003 as tg004disp1, g.mc002 as tg007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013');
		 
        $this->db->from('bomtf as a');	
        $this->db->join('bomtg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="42" ','left');
	    $this->db->join('invmb as d', 'a.tf004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.tf008 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.tg004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.tg007 = g.mc001 ','left');	
		$this->db->where('a.tf001', $this->uri->segment(4)); 
	    $this->db->where('a.tf002', $this->uri->segment(5)); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tg001', $this->uri->segment(4));
		$this->db->where('tg002', $this->uri->segment(5));
	    $query = $this->db->get('bomtg');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf004disp,d.mb003 as tf004disp1, e.mc002 as tf008disp 
		  ,f.mb002 as tg004disp,f.mb003 as tg004disp1, g.mc002 as tg007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013');
		 
        $this->db->from('bomtf as a');	
        $this->db->join('bomtg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="42" ','left');
	    $this->db->join('invmb as d', 'a.tf004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.tf008 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.tg004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.tg007 = g.mc001 ','left');
		$this->db->where('a.tf001', $this->input->post('tf001o')); 
	    $this->db->where('a.tf002', $this->input->post('tf002o')); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
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
	//印單據筆  
		function printfb()   
        {           
        $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf004disp,d.mb003 as tf004disp1, e.mc002 as tf008disp 
		  ,f.mb002 as tg004disp,f.mb003 as tg004disp1, g.mc002 as tg007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013');
		 
        $this->db->from('bomtf as a');	
        $this->db->join('bomtg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001  ','left');
	    $this->db->join('invmb as d', 'a.tf004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.tf008 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.tg004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.tg007 = g.mc001 ','left');
		$this->db->where('a.tf001', $this->uri->segment(4)); 
	    $this->db->where('a.tf002', $this->uri->segment(5)); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }	    		
        }
		
	//更改一筆	
	function updatef()   
        {
			$tf001=$this->input->post('tf001');
			 $tf002=$this->input->post('tf002');
			$sql="select * from bomtf where tf001='$tf001' and tf002='$tf002' ";
			$query = $this->db->query($sql) ;
			//庫存增加欄位 庫別
				if (@$tf004 and @$tf008  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tf004','$tf008','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存減少				
				if (@$tf004 and @$tf008 and @$tf007 and @$tf201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007+'$tf007',mc008=mc008+'$tf201' WHERE mc001 = '$tf004'  AND mc002 = '$tf008'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064+'$tf007',mb065=mb065+'$tf201' WHERE mb001 = '$tf004'   "; 
		         $query = $this->db->query($sql84);
					}
			  preg_match_all('/\d/S',$this->input->post('tf003'), $matches);  //處理日期字串
			 $tf003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf012'), $matches);  //處理日期字串
			 $tf012 = implode('',$matches[0]);
			 
			 $tf001=$this->input->post('tf001');
			 $tf002=$this->input->post('tf002');
			 
			 $tf004=$this->input->post('tf004');
			 $tf008=$this->input->post('tf008');
			 $tf010=$this->input->post('tf010');
			 $tf007=$this->input->post('tf007');
			 $tf201=$this->input->post('tf201');			 
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'tf003' => $tf003,
		         'tf004' => $this->input->post('tf004'),
		         'tf005' => $this->input->post('tf005'),
		         'tf006' => $this->input->post('tf006'),
                 'tf007' => $this->input->post('tf007'),
                 'tf008' => $this->input->post('tf008'),
                 'tf009' => $this->input->post('tf009'),
                 'tf010' => $this->input->post('tf010'),	
                 'tf011' => $this->input->post('tf011'),		
                 'tf012' => $tf012,
				 'tf013' => $this->input->post('tf013'),
				 'tf014' => $this->input->post('tf014'),
				 'tf015' => $this->input->post('tf015'),
				 'tf016' => $this->input->post('tf016'),
				 'tf017' => $this->input->post('tf017'),
				 'tf018' => $this->input->post('tf018'),
				 'tf200' => $this->input->post('tf200'),
				 'tf201' => $this->input->post('tf201')
                );
            $this->db->where('tf001', $tf001);
			$this->db->where('tf002', $tf002);
            $this->db->update('bomtf',$data);                   //更改一筆
			//庫存增加欄位 庫別
				if (@$tf004 and @$tf008  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tf004','$tf008','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存減少				
				if (@$tf004 and @$tf008 and @$tf007 and @$tf201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007-'$tf007',mc008=mc008-'$tf201' WHERE mc001 = '$tf004'  AND mc002 = '$tf008'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064-'$tf007',mb065=mb065-'$tf201' WHERE mb001 = '$tf004'   "; 
		         $query = $this->db->query($sql84);
					}
			//刪除明細 先調整庫存
			$sql="select * from bomtg where tg001='$tf001' and tg002='$tf002' ";
			$query = $this->db->query($sql) ;
		    foreach ($query->result() as $row) {
            foreach($row as $i=>$v){
            $$i=$v;
				//庫存增加欄位 庫別
				if (@$tg004 and @$tg007  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tg004','$tg007','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存增加				
				if (@$tg004 and @$tg007 and @$tg008 and @$tg201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007-'$tg008',mc008=mc008-'$tg201' WHERE mc001 = '$tg004'  AND mc002 = '$tg007'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064-'$tg008',mb065=mb065-'$tg201' WHERE mb001 = '$tg004'   "; 
		         $query = $this->db->query($sql84);
				$tg008=0;$tg201=0;$tg004='';$tg007='';	}
			
            }}
			
			
			//刪除明細 
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('tg001', $tf001);
					$this->db->where('tg002', $tf002);
					$this->db->delete('bomtg'); //刪除明細 1060809
					
		    $vtg003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				//preg_match_all('/\d/S',$tg014, $matches);  //處理日期字串
			   // $tg014 = implode('',$matches[0]);
				
				if($this->seldetail($tf001,$tf002,$val['tg003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if ($k!="tg001" &&$k!="tg002" && $k!="tg004disp" && $k!="tg004disp1"&& $k!="tg007disp"){//主鍵不用更改以及其他外來鍵庫別名稱 tf013日期等別處理
							if($k=="tg003") {$data[$k] = $vtg003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('tg001', $tf001);
					$this->db->where('tg002', $tf002);
					$this->db->where('tg003', $vtf003);
					$this->db->update('bomtg',$data);//更改一筆
					$mtg003 = (int) $vtg003+10;
			        $vtg003 =  (string)$mtg003;
				}else{
					if($val['tg003'] && $val['tg004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tg001' => $tf001,
							'tg002' => $tf002
						);
						foreach($val as $k=>$v){
							if($k!="tg001"&&$k!="tg002"&& $k!="tg004disp"&& $k!="tg004disp1"&& $k!="tg007disp"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="tg003") {$data[$k] = $vtg003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('bomtg', $data);
						$mtg003 = (int) $vtg003+10;
			            $vtg003 =  (string)$mtg003;
					}
				}
				
				preg_match_all('/\d/S',$this->input->post('tf012'), $matches);  //處理日期字串
			    $tf012 = implode('',$matches[0]);
				//庫存增加欄位 庫別
				if (@$tg004 and @$tg007  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tg004','$tg007','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存增加				
				if (@$tg004 and @$tg007 and @$tg008 and @$tg201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007+'$tg008',mc008=mc008+'$tg201' WHERE mc001 = '$tg004'  AND mc002 = '$tg007'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064+'$tg008',mb065=mb065+'$tg201' WHERE mb001 = '$tg004'   "; 
		         $query = $this->db->query($sql84);
				$tg008=0;$tg201=0;$tg004='';$tg007='';	}
			}
			
        }
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('tg001', $seg1);
			$this->db->where('tg002', $seg2);
	        $this->db->where('tg003', $seg3);
	        $query = $this->db->get('bomtg');
	        return $query->num_rows() ; 
	    }		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tf001', $this->uri->segment(4));
		  $this->db->where('tf002', $this->uri->segment(5));
          $this->db->delete('bomtf'); 
		  $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
          $this->db->delete('bomtg'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('tg001', $seg1);
	      $this->db->where('tg002', $seg2);
	      $this->db->where('tg003', $seg3);
          $this->db->delete('bomtg'); 
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
			      $this->db->where('tf001', $seq1);
			      $this->db->where('tf002', $seq2);
                  $this->db->delete('bomtf'); 
				  $this->db->where('tg001', $seq1);
			      $this->db->where('tg002', $seq2);
                  $this->db->delete('bomtg'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	 function del_detail(){
		$this->db->where('tg001', $_POST['del_md001']);
		$this->db->where('tg002', $_POST['del_md002']);
		$this->db->where('tg003', $_POST['del_md003']);
		$this->db->delete('bomtg');
	}
   //取單號 最大值加1
	function check_title_no($bomi03,$tf012){
		preg_match_all('/\d/S',$tf012, $matches);  //處理日期字串
		$tf012 = implode('',$matches[0]);
		$this->db->select('MAX(tf002) as max_no')
			->from('bomtf')
			->where('tf001', $bomi03)
		//	->where('tc039', $tc039);
			->like('tf012', $tf012, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $tf012."001";}
		
		return $result[0]->max_no+1;
	}
	//import copi05
	function check_detail_num($mz001,$mz002,$mz003,$mz004){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('bommd as a')
				->where('md001',$mz001);
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data($mz001,$mz002,$mz003,$mz004){
		
		$query = $this->db->select('a.md001,a.md002,a.md003,b.mb001,b.mb002,b.mb003,a.md004,a.md006')
				->from('bommd as a')
				->join('invmb as b', 'a.md003 = b.mb001 ','left')
				->where('md001',$mz001);
				
		$data = $query->get()->result();
		
		return $data;		
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>