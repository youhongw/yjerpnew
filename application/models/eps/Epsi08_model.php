<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class epsi08_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tf001, tf002, tf003, tf004, tf0011, tf0019,tf020, create_date');
          $this->db->from('epstf');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tf001 desc, tf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('epstf');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.tf001', 'a.tf002', 'a.tf003', 'a.tf004', 'a.tf011', 'a.tf019','a.tf030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tf001, a.tf002, a.tf003, a.tf004, b.ma002,  a.tf029, a.tf030,a.create_date')
	                       ->from('epstf as a')
						    ->join('copma as b', 'a.tf004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('epstf');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('epsi08_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['epsi08']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tf001 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['epsi08']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['epsi08']['search']['where'];
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
		
		if(isset($_SESSION['epsi08']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['epsi08']['search']['order'];
		}
		
		if(!isset($_SESSION['epsi08']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*, b.ma002 as tf003disp')
	                       ->from('epstf as a')
						   ->join('copma as b', 'a.tf003 = b.ma001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*, b.ma002 as tf003disp')
	                       ->from('epstf as a')
						   ->join('copma as b', 'a.tf003 = b.ma001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['epsi08']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('epstf as a')
			->join('copma as b', 'a.tf003 = b.ma001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['epsi08']['search']['where'] = $where;
		$_SESSION['epsi08']['search']['order'] = $order;
		$_SESSION['epsi08']['search']['offset'] = $offset;
		
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
		$_SESSION['epsi08']['search']['view'] = $view_array;
		$_SESSION['epsi08']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['epsi08']['search']['view']);exit;
	}
	
	//查詢一筆 修改用   
	function selone($seg1) {
		$this->db->select('a.* ,c.ma002 AS tf003disp,d.mb002 as tf004disp,e.mo006 as tf005disp,f.mo006 as tf006disp,g.mo006 as tf007disp,
		                  h.mf002 as tf016disp,a.tf018 as tf018disp,a.tf018 as tf018disp1,
		                  b.tg001,b.tg002,b.tg003,b.tg004,b.tg005,b.tg006,b.tg007');
		 
        $this->db->from('epstf as a');	
        $this->db->join('epstg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');	//單身	
		$this->db->join('copma as c', 'a.tf003 = c.ma001 ','left');  //客戶代號copi01
		$this->db->join('cmsmb as d', 'a.tf004 = d.mb001 ','left');   //廠別
		$this->db->join('cmsmo as e', 'a.tf005 = e.mo001 ','left');   //銀行
		$this->db->join('cmsmo as f', 'a.tf006 = f.mo001 ','left');   //銀行
		$this->db->join('cmsmo as g', 'a.tf007 = g.mo001 ','left');   //銀行
		$this->db->join('cmsmf as h', 'a.tf016 = h.mf001 ','left');		//幣別cmsi06
		$this->db->where('a.tf001', $seg1); 
	   // $this->db->where('a.tf002', $seg2); 
		$this->db->order_by('tf001 , tg002 ');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*,i.tc003 as tg004disp,i.tc004 as tg004disp1')
			->from('epstg as b')
			->join('coptc as i', 'b.tg003 = i.tc001 and b.tg004=i.tc002 ','left')   //庫別
			->where('b.tg001', $seg1);
		//	->where('b.tg002', $seg2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf007disp,e.mf002 AS tf008disp, f.mv002 AS tf006disp,g.na003 AS tf014disp,
		  ,h.ma002 AS tf004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013, b.tg014,b.tg016,b.tg020,b.tg030,b.tg031,i.mc002 as tg007disp,j.me002 as tf005disp');
		 
        $this->db->from('epstf as a');	
        $this->db->join('epstg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tf007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tf008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tf006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tf014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tf004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tg007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tf005 = j.me001 ','left');   //部門
		$this->db->where('a.tf001', $this->uri->segment(4)); 
	    $this->db->where('a.tf002', $this->uri->segment(5)); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('epstf');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('mc001, mc002')->from('cmsmc');  
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
			
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `epstf` ";
	      $seq1 = "tf001, tf002, tf003, tf004, tf004 as tf004disp,tf005, tf006,tf007,tf08,tf010,tf011,tf012,tf029,tf030, create_date FROM `epstf` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.tf001 desc' ;
          $seq9 = " ORDER BY a.tf001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.tf001 ";

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
		//下一頁不要跑掉 1050317 1060815
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
	    }
		if(@$_SESSION['epsi08_sql_term']){$seq32 = $_SESSION['epsi08_sql_term'];}
		if(@$_SESSION['epsi08_sql_sort']){$seq33 = $_SESSION['epsi08_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tf001', 'tf002', 'tf003', 'tf004','b.ma002', 'tf005', 'tf006','tf007','tf008','tf010','tf011','tf012','tf019','tf027','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select(' a.*,b.ma002 as tf003disp')
	                       ->from('epstf as a')
						   ->join('copma as b', 'a.tf003 = b.ma001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('epstf as a')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//篩選多筆  舊版   
	function filterf1($limit, $offset , $sort_by  , $sort_order)          
	    {    
	      $seq4 = trim(urldecode(urldecode($this->uri->segment(6)))); 	 //解決亂碼          
          $sort_by = $this->uri->segment(4);			
          $sort_order = $this->uri->segment(5);	
	      $offset=$this->uri->segment(8,0);
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('a.tf001', 'a.tf002', 'a.tf003', 'a.tf004', 'b.ma002', 'a.tf029','a.tf030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否為 table
	      $this->db->select('a.tf001, a.tf002, a.tf003, a.tf004,b.ma002,  a.tf029,a.tf030, a.create_date');
	      $this->db->from('epstf as a');
		  $this->db->join('copma as b', 'a.tf004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tf001 asc, tf002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('epstf as a');
		  $this->db->join('copma as b', 'a.tf004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('tf001', $seg1);
		  $this->db->where('tf002', $seg2);
	      $query = $this->db->get('epstf');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tg001', $seg1);
		  $this->db->where('tg002', $seg2);
		  $this->db->where('tg003', $seg3);
	      $query = $this->db->get('epstg');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  epstf	
	function insertf()    //新增一筆 檔頭  epstf
        {
		    //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('tf008'), $matches);  //處理日期字串
			 $tf008 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf009'), $matches);  //處理日期字串
			 $tf009 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf010'), $matches);  //處理日期字串
			 $tf010 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf011'), $matches);  //處理日期字串
			 $tf011 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf012'), $matches);  //處理日期字串
			 $tf012 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf025'), $matches);  //處理日期字串
			 $tf025 = implode('',$matches[0]);
			   
			 $tf001=$this->input->post('tf001');
			 $tf002=$this->input->post('tf002');
			 $tf002no=$tf002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->epsi08_model->selone1($tf001,$tf002)>0){
			//	$tf002 = $this->check_title_no($tf001,$tf039);
			//	$tf002no=$tf002;
			}
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tf001' => $tf001,
		         'tf002' => $tf002,
		         'tf003' => $this->input->post('tf003'),
		         'tf004' => $this->input->post('tf004'),    
		         'tf005' => $this->input->post('tf005'),    
		         'tf006' => $this->input->post('tf006'),    
                 'tf007' => $this->input->post('tf007'),    
                 'tf008' => $tf008,
                 'tf009' => $tf009,
                 'tf010' => $tf010,		
                 'tf011' => $tf011,
                 'tf012' => $tf012,
                 'tf013' => $this->input->post('tf013'),	
                 'tf014' => $this->input->post('tf014'),	
                 'tf015' => $this->input->post('tf015'),	
                 'tf016' => $this->input->post('tf016'),
                 'tf017' => $this->input->post('tf017'),	
                 'tf018' => $this->input->post('tf018'),	
                 'tf019' => $this->input->post('tf019'),	
                 'tf020' => $this->input->post('tf020'),
				 'tf021' => $this->input->post('tf021'),
				 'tf022' => $this->input->post('tf022'),
				 'tf023' => $this->input->post('tf023'),	
                 'tf024' => $this->input->post('tf024'),	
                 'tf025' => $tf025,	
                 'tf026' => $this->input->post('tf026'),
                 'tf027' => $this->input->post('tf027')
                 
                );
	    
             $this->db->insert('epstf', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 epstg  
		      $vtg002='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['tg002'] && $val['tg003']){
				        extract($val);
						
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tg001' => $tf001
						);
						foreach($val as $k=>$v){
							if($k!="tg001"&&$k!="tg004disp"&&$k!="tg004disp1"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tg002") {$data[$k] = $vtg002;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('epstg', $data);
					$mtg002 = (int) $vtg002+10;
			        $vtg002 =  (string)$mtg002;
				}
			}
		 }
	
    //自動列印	
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('copi03'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
		      echo "<script>window.open('printbb/".$this->input->post('copi03')."/".$this->input->post('tf002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tf001', $this->input->post('tf001c')); 
          $this->db->where('tf002', $this->input->post('tf002c'));
	      $query = $this->db->get('epstf');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tf001', $this->input->post('tf001o'));
			$this->db->where('tf002', $this->input->post('tf002o'));
	        $query = $this->db->get('epstf');
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
				$tf011=$row->tf011;$tf012=$row->tf012;$tf013=$row->tf013;$tf014=$row->tf014;$tf015=$row->tf015;$tf016=$row->tf016;
				$tf017=$row->tf017;$tf018=$row->tf018;$tf019=$row->tf019;$tf020=$row->tf020;$tf021=$row->tf021;$tf022=$row->tf022;
				$tf023=$row->tf023;$tf024=$row->tf024;$tf025=$row->tf025;$tf026=$row->tf026;$tf027=$row->tf027;$tf028=$row->tf028;
				$tf029=$row->tf029;$tf030=$row->tf030;$tf031=$row->tf031;$tf032=$row->tf032;$tf033=$row->tf033;$tf034=$row->tf034;
				$tf035=$row->tf035;$tf036=$row->tf036;$tf037=$row->tf037;$tf038=$row->tf038;$tf039=$row->tf039;$tf040=$row->tf040;$tf041=$row->tf041;
				$tf042=$row->tf042;$tf043=$row->tf043;$tf044=$row->tf044;$tf045=$row->tf045;$tf046=$row->tf046;$tf047=$row->tf047;
				$tf048=$row->tf048;$tf049=$row->tf049;$tf050=$row->tf050;$tf051=$row->tf051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tf001c');    //主鍵一筆檔頭epstf
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
		           'tf011' => $tf011,'tf012' => $tf012,'tf013' => $tf013,'tf014' => $tf014,'tf015' => $tf015,'tf016' => $tf016,'tf017' => $tf017,
				   'tf018' => $tf018,'tf019' => $tf019,'tf020' => $tf020,'tf021' => $tf021,'tf022' => $tf022,'tf023' => $tf023,'tf024' => $tf024,
				   'tf025' => $tf025,'tf026' => $tf026,'tf027' => $tf027,'tf028' => $tf028,'tf029' => $tf029,'tf030' => $tf030,
				   'tf031' => $tf031,'tf032' => $tf032,'tf033' => $tf033,'tf034' => $tf034,'tf035' => $tf035,'tf036' => $tf036,
				   'tf037' => $tf037,'tf038' => $tf038,'tf039' => $tf039,'tf040' => $tf040,'tf041' => $tf041,'tf042' => $tf042,
				   'tf043' => $tf043,'tf044' => $tf044,'tf045' => $tf045,'tf046' => $tf046,'tf047' => $tf047,'tf048' => $tf048,
				   'tf049' => $tf049,'tf050' => $tf050,'tf051' => $tf051
                   );
				   
            $exist = $this->epsi08_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('epstf', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tg001', $this->input->post('tf001o'));
			$this->db->where('tg002', $this->input->post('tf002o'));
	        $query = $this->db->get('epstg');
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
				 $tg013[$i]=$row->tg013;$tg014[$i]=$row->tg014;$tg015[$i]=$row->tg015;$tg016[$i]=$row->tg016;$tg017[$i]=$row->tg017;
				 $tg018[$i]=$row->tg018;$tg019[$i]=$row->tg019;$tg020[$i]=$row->tg020;$tg021[$i]=$row->tg021;$tg022[$i]=$row->tg022;
			     $tg023[$i]=$row->tg023;$tg024[$i]=$row->tg024;$tg025[$i]=$row->tg025;$tg026[$i]=$row->tg026;$tg027[$i]=$row->tg027;
				 $tg028[$i]=$row->tg028;$tg029[$i]=$row->tg029;$tg030[$i]=$row->tg030;$tg031[$i]=$row->tg031;$tg032[$i]=$row->tg032;
				 $tg033[$i]=$row->tg033;$tg034[$i]=$row->tg034;$tg035[$i]=$row->tg035;$tg036[$i]=$row->tg036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tf001c');    //主鍵一筆明細epstg
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
		         'tg008' => $tg008[$i],'tg009' => $tg009[$i],'tg010' => $tg010[$i],'tg011' => $tg011[$i],'tg012' => $tg012[$i],'tg013' => $tg013[$i],
				 'tg014' => $tg014[$i],'tg015' => $tg015[$i],'tg016' => $tg016[$i],'tg017' => $tg017[$i],'tg018' => $tg018[$i],'tg019' => $tg019[$i],
				 'tg020' => $tg020[$i],'tg021' => $tg021[$i],'tg022' => $tg022[$i],'tg023' => $tg023[$i],'tg024' => $tg024[$i],'tg025' => $tg025[$i],
				 'tg026' => $tg026[$i],'tg027' => $tg027[$i],'tg028' => $tg028[$i],'tg029' => $tg029[$i],'tg030' => $tg030[$i],'tg031' => $tg031[$i],'tg032' => $tg032[$i],
				 'tg033' => $tg033[$i],'tg034' => $tg034[$i],'tg035' => $tg035[$i],'tg036' => $tg036[$i]
                ); 
				
             $this->db->insert('epstg', $data_array);      //複製一筆 
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
	      $sql = " SELECT tf001,tf002,tf039,tf004,ma002 as tf004disp,tg003,tg004,tg005,tg006,tg010,tg008,tg011,tg012 
		  FROM epstf as a,epstg as b,copma as c WHERE tf001=tg001 and tf002=tg002 and tf004=ma001 and tf001 >= '$seq1'  AND tf001 <= '$seq2' AND  tf002 >= '$seq3'  AND tf002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.tf001,a.tf002,a.tf039,a.tf004,c.ma002 as tf004disp,b.tg003,b.tg004,b.tg005,b.tg006,b.tg010,b.tg008,b.tg011,b.tg012
		  FROM epstf as a,epstg as b,copma as c
		  WHERE tf001=tg001 and tf002=tg002 and tf004=ma001 and tf001 >= '$seq1'  AND tf001 <= '$seq2' AND tf002 >= '$seq3'  AND tf002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
          $seq32 = "tf001 >= '$seq1'  AND tf001 <= '$seq2' AND tf002 >= '$seq3'  AND tf002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('epstf')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tf001disp, d.me002 AS tf004disp, e.mb002 AS tf010disp, f.mv002 AS tf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg011, b.tg009, b.tg017, b.tg018, b.tg012');
		 
        $this->db->from('epstf as a');	
        $this->db->join('epstg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tf004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tf010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tf001', $this->uri->segment(4)); 
	    $this->db->where('a.tf002', $this->uri->segment(5)); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tg001', $this->uri->segment(4));
		$this->db->where('tg002', $this->uri->segment(5));
	    $query = $this->db->get('epstg');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf007disp,e.mf002 AS tf008disp, f.mv002 AS tf006disp,g.na003 AS tf014disp,
		  ,h.ma002 AS tf004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013, b.tg014,b.tg016,b.tg020,b.tg030,b.tg031,i.mc002 as tg007disp,j.me002 as tf005disp');
		 
        $this->db->from('epstf as a');	
        $this->db->join('epstg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tf007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tf008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tf006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tf014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tf004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tg007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tf005 = j.me001 ','left');   //部門	
		$this->db->where('a.tf001', $this->input->post('tf001o')); 
	    $this->db->where('a.tf002 >= '.$this->input->post('tf002o').' and a.tf002 <= '.$this->input->post('tf002c')); 
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
          $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf007disp,e.mf002 AS tf008disp, f.mv002 AS tf006disp,g.na003 AS tf014disp,
		  ,h.ma002 AS tf004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013, b.tg014,b.tg016,b.tg020,b.tg030,b.tg031,i.mc002 as tg007disp,j.me002 as tf005disp');
		 
        $this->db->from('epstf as a');	
        $this->db->join('epstg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tf007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tf008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tf006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tf014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tf004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tg007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tf005 = j.me001 ','left');   //部門
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
			//substr($this->input->post('tf003'),0,4).substr($this->input->post('tf003'),5,2).substr(rtrim($this->input->post('tf003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $tf002=$this->input->post('tf002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			//刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('tf008'), $matches);  //處理日期字串
			 $tf008 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf009'), $matches);  //處理日期字串
			 $tf009 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf010'), $matches);  //處理日期字串
			 $tf010 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf011'), $matches);  //處理日期字串
			 $tf011 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf012'), $matches);  //處理日期字串
			 $tf012 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf025'), $matches);  //處理日期字串
			 $tf025 = implode('',$matches[0]);
			   
			 $tf001=$this->input->post('tf001');
			 $tf002=$this->input->post('tf002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'tf003' => $this->input->post('tf003'),
		         'tf004' => $this->input->post('tf004'),    
		         'tf005' => $this->input->post('tf005'),    
		         'tf006' => $this->input->post('tf006'),    
                 'tf007' => $this->input->post('tf007'),    
                 'tf008' => $tf008,
                 'tf009' => $tf009,
                 'tf010' => $tf010,		
                 'tf011' => $tf011,
                 'tf012' => $tf012,
                 'tf013' => $this->input->post('tf013'),	
                 'tf014' => $this->input->post('tf014'),	
                 'tf015' => $this->input->post('tf015'),	
                 'tf016' => $this->input->post('tf016'),
                 'tf017' => $this->input->post('tf017'),	
                 'tf018' => $this->input->post('tf018'),	
                 'tf019' => $this->input->post('tf019'),	
                 'tf020' => $this->input->post('tf020'),
				 'tf021' => $this->input->post('tf021'),
				 'tf022' => $this->input->post('tf022'),
				 'tf023' => $this->input->post('tf023'),	
                 'tf024' => $this->input->post('tf024'),	
                 'tf025' => $tf025,	
                 'tf026' => $this->input->post('tf026'),
                 'tf027' => $this->input->post('tf027')
                );
            $this->db->where('tf001', $tf001); //單別
			$this->db->where('tf002', $tf002);
            $this->db->update('epstf',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('tg001', $tf001);
				//	$this->db->where('tg002', $tf002);
					$this->db->delete('epstg'); //刪除明細 1060809
					
		    $vtg002='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				//preg_match_all('/\d/S',$tg013, $matches);  //處理日期字串
			  //  $tg013 = implode('',$matches[0]);
				if($this->seldetail($tf001,$tg002,$val['tg003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="tg001"&&$k!="tg004disp"&&$k!="tg004disp1"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tg002") {$data[$k] = $vtg002;} else {$data[$k] = $v;}
							}
					}
					$this->db->where('tg001', $tf001);
					$this->db->where('tg002', $vtg002);
					$this->db->update('epstg',$data);//更改一筆
					$mtg002 = (int) $vtg002+10;
			        $vtg002 =  (string)$mtg002;
				}else{
					if($val['tg002'] && $val['tg003']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tg001' => $tf001
						);
						foreach($val as $k=>$v){
							if($k!="tg001"&&$k!="tg004disp"&&$k!="tg004disp1"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tg002") {$data[$k] = $vtg002;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('epstg', $data);
						$mtg002 = (int) $vtg002+10;
			            $vtg002 =  (string)$mtg002;
					}
				}
				
			}
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('tg001', $seg1);
			$this->db->where('tg002', $seg2);
	        $query = $this->db->get('epstg');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tf001', $this->uri->segment(4));
		  $this->db->where('tf002', $this->uri->segment(5));
          $this->db->delete('epstf'); 
		  $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
          $this->db->delete('epstg'); 
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
          $this->db->delete('epstg'); 
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
					  //只要有一筆Y就不能刪除
					$query6c = $this->db->query("SELECT UPPER(tg016) as tg0161 FROM epstg WHERE tg001='$seq1' AND tg002='$seq2' AND ( UPPER(tg016)='Y' or tg009>0 ) ");         
                    foreach ($query6c->result() as $row)
                          {
                            $tg0161[]=$row->tg0161;		 
                          }
                         if(isset($tg0161[0])) {
	                         $vtg0161=$tg0161[0];
                                                 }
	                     else 
                            { $vtg0161='N'; }    //結案碼
						
						
				if ($vtg0161 != 'Y') {	  
			      $this->db->where('tf001', $seq1);
			      $this->db->where('tf002', $seq2);
                  $this->db->delete('epstf'); 
				  $this->db->where('tg001', $seq1);
			      $this->db->where('tg002', $seq2);
				  $this->db->delete('epstg'); $this->session->set_userdata('msg1',"未出貨已刪除"); }
					 else {$this->session->set_userdata('msg1',"已出貨不可刪除");} 
				  
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	   
	//刪除明細一筆新增修改時使用   
	function del_detail(){
		$this->db->where('tg001', $_POST['del_md001']);
		$this->db->where('tg002', $_POST['del_md002']);
		$this->db->where('tg003', $_POST['del_md003']);
		$this->db->delete('epstg');
	}
	
	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookup_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=15){
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
	
	//取單號 最大值加1
	function check_title_no($copi03,$tf039){
		preg_match_all('/\d/S',$tf039, $matches);  //處理日期字串
		$tf039 = implode('',$matches[0]);
		$this->db->select('MAX(tf002) as max_no')
			->from('epstf')
			->where('tf001', $copi03)
		//	->where('tf039', $tf039);
			->like('tf039', $tf039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $tf039."001";}
		
		return $result[0]->max_no+1;
	}
	function check_vno_no(){
	
		$this->db->select('MAX(id) as max_no')
			->from('invoice');
		//	->where('tf039', $tf039);
		//	->like('tf039', $tf039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	   // if (!$result[0]->max_no){return $tf039."001";}
		
		return $result[0]->max_no;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>