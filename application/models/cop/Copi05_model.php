<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copi05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta005, ta006,ta008,ta010,ta011,ta013, create_date');
          $this->db->from('copta');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('copta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta006', 'ta007','ta005','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*,c.mq002,b.ma002,c.mq002 as ta001disp,b.ma002 as ta004disp')
	                       ->from('copta as a')
						   ->join('copma as b', 'a.ta004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ta001 = c.mq001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('copta ');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('copi05_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['copi05']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['copi05']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "ta001 asc,ta002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['copi05']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['copi05']['search']['where'];
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
		
		if(isset($_SESSION['copi05']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['copi05']['search']['order'];
		}
		
		if(!isset($_SESSION['copi05']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,c.mq002,b.ma002,c.mq002 as ta001disp,b.ma002 as ta004disp')
	                       ->from('copta as a')
						   ->join('copma as b', 'a.ta004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ta001 = c.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,c.mq002,b.ma002,c.mq002 as ta001disp,b.ma002 as ta004disp')
	                       ->from('copta as a')
						   ->join('copma as b', 'a.ta004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ta001 = c.mq001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['copi05']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('copta as a')
			->join('copma as b', 'a.ta004 = b.ma001','left')
			->join('cmsmq as c', 'a.ta001 = c.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['copi05']['search']['where'] = $where;
		$_SESSION['copi05']['search']['order'] = $order;
		$_SESSION['copi05']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"ta001","ta002"
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
		$_SESSION['copi05']['search']['view'] = $view_array;
		$_SESSION['copi05']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['copi05']['search']['view']);exit;
	}	
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma002 AS ta004disp, f.na003 AS ta011disp, e.mv002 AS ta005disp,g.mf002 AS ta007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007,b.tb008,b.tb009,b.tb010, b.tb011,b.tb012,b.tb016,b.tb018, b.tb020, b.tb021');
		 
        $this->db->from('copta as a');	
        $this->db->join('coptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="21" ','left');
		$this->db->join('copma as d', 'a.ta004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.ta005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.ta011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.ta007 = g.mf001 ','left');	  		
		$this->db->where('a.ta001', $seq1); 
	    $this->db->where('a.ta002', $seq2); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*')
			->from('coptb as b')
			//->join('cmsmc as i', 'b.td007 = i.mc001 ','left')   //庫別
			->where('b.tb001', $seq1)
			->where('b.tb002', $seq2);
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
		
	//ajax 查詢 顯示 核價單別 tb001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '21');
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
		
	//ajax 查詢顯示用 廠別 ta010  
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
	      $this->db->select_max('ta002');
		  $this->db->where('ta001', $this->uri->segment(4));
	      $this->db->where('ta013', $this->uri->segment(5));
		  $query = $this->db->get('copta');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ta002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `copta` ";
	      $seq1 = "ta001, ta002, ta003, ta004, ta005, ta006,ta007,ta08,ta010,ta011,ta013,ta012,ta016, create_date FROM `copta` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'ta001 desc' ;
          $seq9 = " ORDER BY ta001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="ta001 ";

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
		if(@$_SESSION['copi05_sql_term']){$seq32 = $_SESSION['copi05_sql_term'];}
		if(@$_SESSION['copi05_sql_sort']){$seq33 = $_SESSION['copi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta005', 'ta006','ta007','ta008','ta010','ta011','ta013','ta012','ta016','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*,c.mq002,b.ma002,c.mq002 as ta001disp,b.ma002 as ta004disp')
	                       ->from('copta as a')
						   ->join('copma as b', 'a.ta004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ta001 = c.mq001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('copta as a')
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
	      $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta012','ta006', 'ta013','ta016','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('a.*,c.mq002,b.ma002,c.mq002 as ta001disp,b.ma002 as ta004disp');
	      $this->db->from('copta as a');
		  $this->db->join('copma as b', 'a.ta004 = b.ma001','left');
		  $this->db->join('cmsmq as c', 'a.ta001 = c.mq001','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('copta');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ta001', $this->input->post('copq03a21'));
		  $this->db->where('ta002', $this->input->post('ta002'));
	      $query = $this->db->get('copta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tb001', $this->input->post('copq03a21'));
		  $this->db->where('tb002', $this->input->post('ta002'));
		  $this->db->where('tb003', $seg3);
	      $query = $this->db->get('coptb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  copta	
	function insertf()    //新增一筆 檔頭  copta
        {
			  preg_match_all('/\d/S',$this->input->post('ta003'), $matches);  //處理日期字串
			 $ta003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta013'), $matches);  //處理日期字串
			 $ta013 = implode('',$matches[0]);
			 
			 $ta001=$this->input->post('ta001');
			 $ta002=$this->input->post('ta002');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $this->input->post('ta001'),
		         'ta002' => $this->input->post('ta002'),
		         'ta003' => $ta003,
		         'ta004' => $this->input->post('ta004'),
		         'ta005' => $this->input->post('ta005'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => strtoupper($this->input->post('ta010')),		
                 'ta011' => $this->input->post('ta011'),	
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $ta013,
                 'ta014' => $this->input->post('ta014'),		
                 'ta015' => $this->input->post('ta015'),
                 'ta016' => $this->input->post('ta016'),
                  'ta017' => $this->input->post('ta017'),
                  'ta018' => $this->input->post('ta018'),
                  'ta019' => $this->input->post('ta019'),
                  'ta020' => $this->input->post('ta020'),
                  'ta021' => $this->input->post('ta021'),
                  'ta022' => $this->input->post('ta022'),
                  'ta023' => $this->input->post('ta023'),
                  'ta024' => $this->input->post('ta024'),
                  'ta025' => $this->input->post('ta025'),
                  'ta026' => $this->input->post('ta026'),	
                  'ta027' => $this->input->post('ta027'),	
                  'ta028' => $this->input->post('ta028'),	
                  'ta029' => $this->input->post('ta029'),					  
                  'ta030' => $this->input->post('ta030')
                 
                );
				
				$ta002no=$ta002;   //明細用再新增一筆時加1
           //檢查資料是否已存在 若存在加1
			  while($this->copi05_model->selone1($ta001,$ta002)>0){
				$ta002 = $this->check_title_no($ta001,$ta013);
				$ta002no=$ta002;
			}
	     
             $this->db->insert('copta', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 coptb
		  $vtb003='1010';		//流水號重新排序
		 foreach($order_product as $key => $val){
		        if($val['tb003'] && $val['tb004']){
				        extract($val);
						preg_match_all('/\d/S',$tb016, $matches);  //處理日期字串
			            $tb016 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tb016' => $tb016,
							'tb001' => $ta001,
							'tb002' => $ta002no
						);
						foreach($val as $k=>$v){
							if($k!="tb001"&&$k!="tb002"&&$k!="tb016"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;} //流水號
							}
						}
					$this->db->insert('coptb', $data);
					$mtb003 = (int) $vtb003+10;
			        $vtb003 =  (string)$mtb003;
				}
			}
		 }
	
    function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('copq03a22'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('copq03a21')."/".$this->input->post('ta002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 	
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('copta');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf($ta001o,$ta002o,$ta001c,$ta013)           
        {
			
			$user = $this->session->userdata('sysuser');
			
			$sql_chk = "SELECT COUNT(*) AS NUM FROM COPTA WHERE TA001 = '$ta001o' AND TA002 = '$ta002o'";
			$query_chk = $this->db->query($sql_chk);
			$num = $query_chk->result();
			$NUM1 = $num[0] -> NUM; //輸入的單號是否存在
			$ta013_d = substr($ta013,0,4)-1911 .substr($ta013,5,2).substr($ta013,8,2);
			$ta013_1 = substr($ta013,0,4).substr($ta013,5,2).substr($ta013,8,2);
			
			//echo var_dump($ta013_d);exit;
			
			//echo $NUM1 ;exit;
			
			$sql = "
			SELECT CASE  WHEN MAX(TA002) IS NULL THEN '$ta013_d' + '001' ELSE MAX(TA002)+ 1 END AS TA002

		    FROM COPTA WHERE TA001 = '$ta001c' AND CREATE_DATE > '20210101' AND TA002 LIKE '$ta013_d%'";
			
			//echo var_dump($sql);exit;
			$query = $this->db->query($sql);
			$tb002 = $query->result();
			$TB002_N = $tb002[0] -> TA002; //取出最大單號+1
			
			
			//echo var_dump($TB002_N);exit;
			
			$sql1 = "INSERT INTO COPTA (COMPANY,CREATOR,USR_GROUP,CREATE_DATE,MODIFIER,MODI_DATE,FLAG,TA001,TA002,TA003,TA004,TA005,TA006,TA007,TA008,TA009,TA010,TA011,TA012,TA013,TA014,TA015,TA016,TA017,TA018,TA019,TA020,TA021,TA022,TA023,TA024,TA025,TA026,TA027,TA028,TA029,TA030)
			SELECT COMPANY,'$user','A100',convert(varchar, getdate(), 112),'','','1','$ta001c','$TB002_N','$ta013_1',TA004,TA005,TA006,TA007,TA008,TA009,TA010,TA011,TA012,'$ta013_1',TA014,'','N',TA017,'0','N',TA020,TA021,TA022,TA023,TA024,TA025,TA026,TA027,TA028,TA029,TA030 FROM COPTA WHERE TA001 = '$ta001o' AND TA002 = '$ta002o'
			";
			
		//	echo var_dump($sql1);
			$query1 = $this->db->query($sql1);
			
			$sql2 = "INSERT INTO COPTB (COMPANY,CREATOR,USR_GROUP,CREATE_DATE,MODIFIER,MODI_DATE,FLAG,TB001,TB002,TB003,TB004,TB005,TB006,TB007,TB008,TB009,TB010,TB011,TB012,TB013,TB014,TB015,TB016,TB017,TB018,TB019,TB020,TB021,TB022,TB023,TB024)
			SELECT COMPANY,'$user','A100',convert(varchar, getdate(), 112),'','','1','$ta001c','$TB002_N',TB003,TB004,TB005,TB006,TB007,TB008,TB009,TB010,'N',TB012,TB013,TB014,TB015,TB016,TB017,TB018,TB019,TB020,TB021,TB022,TB023,TB024 FROM COPTB WHERE TB001 = '$ta001o' AND TB002 = '$ta002o'
			";
			
		//	echo var_dump($sql2);exit;
			
			$query2 = $this->db->query($sql2);
			
		//	return $NUM1 ;
	
			

			if($NUM1 == 0 ) {
			  return "0";
			}else{
			  return $TB002_N;
			}

			
			//return $TB002_N;
			
			/*
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('copta');
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
                $ta003=$row->ta003;$ta004=$row->ta004;$ta005=$row->ta005;$ta006=$row->ta006;$ta007=$row->ta007;$ta008=$row->ta008;$ta009=$row->ta009;$ta010=$row->ta010;
				$ta011=$row->ta011;$ta012=$row->ta012;$ta013=$row->ta013;$ta014=$row->ta014;$ta015=$row->ta015;$ta016=$row->ta016;
				$ta017=$row->ta017;$ta018=$row->ta018;$ta019=$row->ta019;$ta020=$row->ta020;$ta021=$row->ta021;$ta022=$row->ta022;
				$ta023=$row->ta023;$ta024=$row->ta024;$ta025=$row->ta025;$ta026=$row->ta026;$ta027=$row->ta027;$ta028=$row->ta028;
				$ta029=$row->ta029;$ta030=$row->ta030;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭copta
			$seq2=$this->input->post('ta002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ta001' => $seq1,'ta002' => $seq2,'ta003' => $ta003,'ta004' => $ta004,'ta005' => $ta005,'ta006' => $ta006,'ta007' => $ta007,'ta008' => $ta008,'ta009' => $ta009,'ta010' => $ta010,
		           'ta011' => $ta011,'ta012' => $ta012,'ta013' => $ta013,'ta014' => $ta014,'ta015' => $ta015,'ta016' => $ta016,'ta017' => $ta017,
				   'ta018' => $ta018,'ta019' => $ta019,'ta020' => $ta020,'ta021' => $ta021,'ta022' => $ta022,'ta023' => $ta023,'ta024' => $ta024,
				   'ta025' => $ta025,'ta026' => $ta026,'ta027' => $ta027,'ta028' => $ta028,'ta029' => $ta029,'ta030' => $ta030
                   );
				   
            $exist = $this->copi05_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('copta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('coptb');
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
                 $tb003[$i]=$row->tb003;$tb004[$i]=$row->tb004;$tb005[$i]=$row->tb005;$tb006[$i]=$row->tb006;$tb007[$i]=$row->tb007;$tb008[$i]=$row->tb008;
				 $tb009[$i]=$row->tb009;$tb010[$i]=$row->tb010;$tb011[$i]=$row->tb011;$tb012[$i]=$row->tb012;$tb016[$i]=$row->tb016;$tb018[$i]=$row->tb018;
				 $tb019[$i]=$row->tb019;$tb020[$i]=$row->tb020;$tb021[$i]=$row->tb021;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細coptb
			$seq2=$this->input->post('ta002c'); 
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
                'tb001' => $seq1,'tb002' => $seq2,'tb003' => $tb003[$i],'tb004' => $tb004[$i],'tb005' => $tb005[$i],'tb006' => $tb006[$i],'tb007' => $tb007[$i],
		         'tb009' => $tb009[$i],'tb010' => $tb010[$i],'tb011' => $tb011[$i],'tb016' => substr($tb016[$i],0,4).substr($tb016[$i],5,2).substr($tb016[$i],8,2),
				 'tb012' => $tb012[$i],'tb018' => $tb018[$i],'tb020' => $tb020[$i],'tb021' => $tb021[$i]
                ); 
				
             $this->db->insert('coptb', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;	*/	 
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ta001o');    
	      $seq2=$this->input->post('ta001c');
		  $seq3=$this->input->post('ta002o');    
	      $seq4=$this->input->post('ta002c');
		
	     // $sql = " SELECT ta001,ta002,ta003,ta004,ta006,ta007,ta005,ta011,tb003,tb004,tb005,tb006,tb008,tb007,tb009,tb010
		 // FROM copta as a,coptb as b,copma as c
		 // WHERE ta001=tb001 and ta002=tb002 and ta004=ma001 and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
		  
		  $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,a.ta006,a.ta007,a.ta005,a.ta011,b.tb003,b.tb004,b.tb005,b.tb006,b.tb008,b.tb007,b.tb009,b.tb010
		  FROM copta as a
		  left join coptb as b on a.ta001=b.tb001 and a.ta002=b.tb002
		  left join copma as c on a.ta004=c.ma001
		  WHERE  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('ta001o');    
	      $seq2=$this->input->post('ta001c');
		  $seq3=$this->input->post('ta002o');    
	      $seq4=$this->input->post('ta002c');
	      $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,c.ma002 as ta004disp,a.ta007,b.tb003,b.tb004,tb005,tb006,tb008,tb007,tb009,tb010 
		  FROM copta as a,coptb as b,copma c
		  WHERE ta001=tb001 and ta002=tb002 and ta004=ma001 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('copta')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
	    $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma002 AS ta004disp, f.na003 AS ta011disp, e.mv002 AS ta005disp,g.mf002 AS ta007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007,b.tb008,b.tb009,b.tb010, b.tb011,b.tb012,b.tb016,b.tb017,b.tb018, b.tb020, b.tb021');
		 
        $this->db->from('copta as a');	
        $this->db->join('coptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="21" ','left');
		$this->db->join('copma as d', 'a.ta004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.ta005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.ta011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.ta007 = g.mf001 ','left');	
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
	    $query = $this->db->get('coptb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {      
          $ta001o=$this->input->post('ta001o');
		  $ta002o=$this->input->post('ta002o');
		  $ta002c=$this->input->post('ta002c');
		  $this->db->where('tb002 >=', '0');
		  $this->db->delete('coptbp'); 
					 
		  $sql1="insert into coptbp select * from coptb 
		  where tb001='$ta001o' and tb002>='$ta002o' and tb002<='$ta002c' ";
		  $this->db->query($sql1);
		  //th040 張數的筆數
		  $sql2="UPDATE coptbp AS t
                 INNER JOIN (
                 SELECT s.tb001,s.tb002, COUNT(*) AS count
                 FROM coptbp AS s  
                 GROUP BY s.tb001,s.tb002
                 ) AS anum ON anum.tb001 = t.tb001 and anum.tb002 = t.tb002 
                 SET t.tb023 = anum.count  ";
		  $this->db->query($sql2);
		  
          $this->db->select('a.* ,h.tb023 as vcount,c.mq002 AS ta001disp, d.ma002 AS ta004disp, f.na003 AS ta011disp, e.mv002 AS ta005disp,g.mf002 AS ta007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007,b.tb008,b.tb009,b.tb010, b.tb011,b.tb012,b.tb016,b.tb017,b.tb018, b.tb020, b.tb021');
		 
        $this->db->from('copta as a');	
        $this->db->join('coptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="21" ','left');
		$this->db->join('copma as d', 'a.ta004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.ta005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.ta011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.ta007 = g.mf001 ','left');
        $this->db->join('coptbp as h', '
                       b.tb001=h.tb001 and b.tb002=h.tb002 and b.tb003=h.tb003 ','inner');		
		$this->db->where('a.ta001', $this->input->post('ta001o')); 
	    $this->db->where('a.ta002 >=', $this->input->post('ta002o'));
        $this->db->where('a.ta002 <=', $this->input->post('ta002c'));		
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
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
         $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma002 AS ta004disp, f.na003 AS ta011disp, e.mv002 AS ta005disp,g.mf002 AS ta007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007,b.tb008,b.tb009,b.tb010, b.tb011,b.tb012,b.tb016,b.tb017,b.tb018, b.tb020, b.tb021');
		 
        $this->db->from('copta as a');	
        $this->db->join('coptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="21" ','left');
		$this->db->join('copma as d', 'a.ta004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.ta005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.ta011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.ta007 = g.mf001 ','left');		
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
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
			  preg_match_all('/\d/S',$this->input->post('ta003'), $matches);  //處理日期字串
			 $ta003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta013'), $matches);  //處理日期字串
			 $ta013 = implode('',$matches[0]);
			 
			 $ta001=$this->input->post('ta001');
			 $ta002=$this->input->post('ta002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'ta003' => $ta003,
		         'ta004' => $this->input->post('ta004'),
		         'ta005' => $this->input->post('ta005'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => strtoupper($this->input->post('ta010')),		
                 'ta011' => $this->input->post('ta011'),	
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $ta013,
                 'ta014' => $this->input->post('ta014'),		
                 'ta015' => $this->input->post('ta015'),
                 'ta016' => $this->input->post('ta016'),
                  'ta017' => $this->input->post('ta017'),
                  'ta018' => $this->input->post('ta018'),
                  'ta019' => $this->input->post('ta019'),
                  'ta020' => $this->input->post('ta020'),
                  'ta021' => $this->input->post('ta021'),
                  'ta022' => $this->input->post('ta022'),
                  'ta023' => $this->input->post('ta023'),
                  'ta024' => $this->input->post('ta024'),
                  'ta025' => $this->input->post('ta025'),
                  'ta026' => $this->input->post('ta026'),	
                  'ta027' => $this->input->post('ta027'),	
                  'ta028' => $this->input->post('ta028'),	
                  'ta029' => $this->input->post('ta029'),					  
                  'ta030' => $this->input->post('ta030')
                );
            $this->db->where('ta001', $this->input->post('ta001'));
			$this->db->where('ta002', $this->input->post('ta002'));
            $this->db->update('copta',$data);                   //更改一筆
			
			//刪除明細 
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('tb001', $ta001);
					$this->db->where('tb002', $ta002);
					$this->db->delete('coptb'); //刪除明細 1060809
					
		    $vtb003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				preg_match_all('/\d/S',$tb016, $matches);  //處理日期字串
			    $tb016 = implode('',$matches[0]);
				
				if($this->seldetail($ta001,$ta002,$val['tb003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'tb016' => $tb016,
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="tb001"&&$k!="tb002"&& $k!="tb016"){//主鍵不用更改以及其他外來鍵庫別名稱 td013日期等別處理
							if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('tb001', $ta001);
					$this->db->where('tb002', $ta002);
					$this->db->where('tb003', $vtd003);
					$this->db->update('coptb',$data);//更改一筆
					$mtb003 = (int) $vtb003+10;
			        $vtb003 =  (string)$mtb003;
				}else{
					if($val['tb003'] && $val['tb004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tb016' => $tb016,
							'tb001' => $ta001,
							'tb002' => $ta002
						);
						foreach($val as $k=>$v){
							if($k!="tb001"&&$k!="tb002"&& $k!="tb016"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('coptb', $data);
						$mtb003 = (int) $vtb003+10;
			            $vtb003 =  (string)$mtb003;
					}
				}
				
			}
			
        }
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('tb001', $seg1);
			$this->db->where('tb002', $seg2);
	        $this->db->where('tb003', $seg3);
	        $query = $this->db->get('coptb');
	        return $query->num_rows() ; 
	    }		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('copta'); 
		  $this->db->where('tb001', $this->uri->segment(4));
		  $this->db->where('tb002', $this->uri->segment(5));
          $this->db->delete('coptb'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('tb001', $seg1);
	      $this->db->where('tb002', $seg2);
	      $this->db->where('tb003', $seg3);
          $this->db->delete('coptb'); 
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
			      $this->db->where('ta001', $seq1);
			      $this->db->where('ta002', $seq2);
                  $this->db->delete('copta'); 
				  $this->db->where('tb001', $seq1);
			      $this->db->where('tb002', $seq2);
                  $this->db->delete('coptb'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	function del_detail(){
		$this->db->where('tb001', $_POST['del_md001']);
		$this->db->where('tb002', $_POST['del_md002']);
		$this->db->where('tb003', $_POST['del_md003']);
		$this->db->delete('coptb');
	}
	//取單號 最大值加1
	function check_title_no($copi03,$ta013){
		preg_match_all('/\d/S',$ta013, $matches);  //處理日期字串
		$ta013 = implode('',$matches[0]);
		$this->db->select('MAX(ta002) as max_no')
			->from('copta')
			->where('ta001', $copi03)
		//	->where('tc039', $tc039);
			->like('ta013', $ta013, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $ta013."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>