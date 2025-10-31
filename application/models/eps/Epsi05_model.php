<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Epsi05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta0011, ta0019,ta020, create_date');
          $this->db->from('epsta');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('epsta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.ta001', 'a.ta002', 'a.ta003', 'a.ta004', 'a.ta011', 'a.ta019','a.ta030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.ta001, a.ta002, a.ta003, a.ta004, b.ma002,  a.ta029, a.ta030,a.create_date')
	                       ->from('epsta as a')
						    ->join('copma as b', 'a.ta004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('epsta');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('epsi05_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['epsi05']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "ta001 asc,ta002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['epsi05']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['epsi05']['search']['where'];
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
		
		if(isset($_SESSION['epsi05']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['epsi05']['search']['order'];
		}
		
		if(!isset($_SESSION['epsi05']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,c.mq002, b.ma002')
	                       ->from('epsta as a')
						   ->join('copma as b', 'a.ta004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ta001 = c.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,c.mq002,b.ma002')
	                       ->from('epsta as a')
						   ->join('copma as b', 'a.ta004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ta001 = c.mq001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['epsi05']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('epsta as a')
			->join('copma as b', 'a.ta004 = b.ma001','left')
			->join('cmsmq as c', 'a.ta001 = c.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['epsi05']['search']['where'] = $where;
		$_SESSION['epsi05']['search']['order'] = $order;
		$_SESSION['epsi05']['search']['offset'] = $offset;
		
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
		$_SESSION['epsi05']['search']['view'] = $view_array;
		$_SESSION['epsi05']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['epsi05']['search']['view']);exit;
	}
	
	//查詢一筆 修改用   
	function selone($seg1, $seg2) {
		$this->db->select('a.* ,c.mq002 AS ta001disp, e.mf002 AS ta022disp, f.mv002 AS ta007disp,g.na003 AS ta074disp,
		  ,h.ma002 AS ta004disp,k.ma002 as ta008disp,l.mb002 as ta041disp,m.md007 as ta028disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015,b.tb016,b.tb017,
		  b.tb018,b.tb019,b.tb020,b.tb021,b.tb022,b.tb023,b.tb024,b.tb025,b.tb026,b.tb027,b.tb028,b.tb029,b.tb030,
		  b.tb031,b.tb032,b.tb033,b.tb034,b.tb035,b.tb036,b.tb037,b.tb038,b.tb039,b.tb040,
		  i.mc002 as tb018disp,j.me002 as ta006disp');
		 
        $this->db->from('epsta as a');	
        $this->db->join('epstb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001  ','left');  //單別copi03
		$this->db->join('cmsmf as e', 'a.ta022 = e.mf001 ','left');		//幣別cmsi06
		$this->db->join('cmsmv as f ', 'a.ta007 = f.mv001 and f.mv022 = " " ','left');  //業務人員cmsi09
		$this->db->join('cmsna as g ', 'a.ta074 = g.na002 and g.na001= "1" ','left');    //付款條件cmsi21
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tb018 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ta006 = j.me001 ','left');   //部門cmsi05
		$this->db->join('copma as k', 'a.ta008 = k.ma001 ','left');  //客戶代號1
		$this->db->join('cmsmb as l', 'a.ta041 = l.mb001 ','left');  //廠別
		$this->db->join('epsmd as m', 'a.ta028 = m.md002 ','left');  //麥頭代號7
		$this->db->where('a.ta001', $seg1); 
	    $this->db->where('a.ta002', $seg2); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		$this->db->query('SET SQL_BIG_SELECTS=1');   
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		$this->db->select('b.*,c.mb002 as tb007disp,c.mb003 as tb007disp1,d.mc002 as tb018disp')
			->from('epstb as b')
			->join('invmb as c', 'b.tb007 = c.mb001 ','left')   //品號
			->join('cmsmc as d', 'b.tb018 = d.mc001 ','left')   //庫別
			->where('b.tb001', $seg1)
			->where('b.tb002', $seg2);
		$this->db->query('SET SQL_BIG_SELECTS=1');   
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta007disp,e.mf002 AS ta008disp, f.mv002 AS ta006disp,g.na003 AS ta014disp,
		  ,h.ma002 AS ta004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb016,b.tb020,b.tb030,b.tb031,i.mc002 as tb007disp,j.me002 as ta005disp');
		 
        $this->db->from('epsta as a');	
        $this->db->join('epstb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ta008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ta006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ta014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tb007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ta005 = j.me001 ','left');   //部門
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('epsta');  
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `epsta` ";
	      $seq1 = "ta001, ta002, ta003, ta004, ta004 as ta004disp,ta005, ta006,ta007,ta08,ta010,ta011,ta012,ta029,ta030, create_date FROM `epsta` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.ta001 desc' ;
          $seq9 = " ORDER BY a.ta001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.ta001 ";

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
		if(@$_SESSION['epsi05_sql_term']){$seq32 = $_SESSION['epsi05_sql_term'];}
		if(@$_SESSION['epsi05_sql_sort']){$seq33 = $_SESSION['epsi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004','b.ma002', 'ta005', 'ta006','ta007','ta008','ta010','ta011','ta012','ta019','ta027','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002,b.ma002, ta003, ta004,ta004 as ta004disp, ta005, ta006,ta007,ta008,ta010,ta011,ta012,ta029,ta030, a.create_date')
	                       ->from('epsta as a')
						   ->join('copma as b', 'a.ta004 = b.ma001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('epsta as a')
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
	      $sort_columns = array('a.ta001', 'a.ta002', 'a.ta003', 'a.ta004', 'b.ma002', 'a.ta029','a.ta030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('a.ta001, a.ta002, a.ta003, a.ta004,b.ma002,  a.ta029,a.ta030, a.create_date');
	      $this->db->from('epsta as a');
		  $this->db->join('copma as b', 'a.ta004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('epsta as a');
		  $this->db->join('copma as b', 'a.ta004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('ta001', $seg1);
		  $this->db->where('ta002', $seg2);
	      $query = $this->db->get('epsta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tb001', $seg1);
		  $this->db->where('tb002', $seg2);
		  $this->db->where('tb003', $seg3);
	      $query = $this->db->get('epstb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  epsta	
	function insertf()    //新增一筆 檔頭  epsta
        {
		    //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('ta003'), $matches);  //處理日期字串
			 $ta003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta016'), $matches);  //處理日期字串
			 $ta016 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta039'), $matches);  //處理日期字串
			 $ta039 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta040'), $matches);  //處理日期字串
			 $ta040 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta052'), $matches);  //處理日期字串
			 $ta052 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta053'), $matches);  //處理日期字串
			 $ta053 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta054'), $matches);  //處理日期字串
			 $ta054 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta070'), $matches);  //處理日期字串
			 $ta070 = implode('',$matches[0]);
			   
			 $ta001=$this->input->post('ta001');
			 $ta002=$this->input->post('ta002');
			 $ta002no=$ta002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->epsi05_model->selone1($ta001,$ta002)>0){
				$ta002 = $this->check_title_no($ta001,$ta039);
				$ta002no=$ta002;
			}
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $ta001,
		         'ta002' => $ta002,
		         'ta003' => $ta003,
		         'ta004' => $this->input->post('ta004'),    //客戶
		         'ta005' => $this->input->post('ta005'),    
		         'ta006' => $this->input->post('ta006'),    
                 'ta007' => $this->input->post('ta007'),    
                 'ta008' => $this->input->post('ta008'),  
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('ta010'),		
                 'ta011' => $this->input->post('ta011'),
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $this->input->post('ta014'),	
                 'ta015' => $this->input->post('ta015'),	
                 'ta016' => $ta016,
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
                 'ta030' => $this->input->post('ta030'),
				 'ta031' => $this->input->post('ta031'),
				 'ta032' => $this->input->post('ta032'),
                 'ta033' => $this->input->post('ta033'),
                 'ta034' => $this->input->post('ta034'),
                 'ta035' => $this->input->post('ta035'),
				 'ta036' => $this->input->post('ta036'),
                 'ta037' => $this->input->post('ta037'),
                 'ta038' => $this->input->post('ta038'),
                 'ta039' => $ta039,
                 'ta040' => $ta040,
				 'ta041' => $this->input->post('ta041'),
				 'ta042' => $this->input->post('ta042'),
				 'ta043' => $this->input->post('ta043'),
                 'ta044' => $this->input->post('ta044'),
                 'ta045' => $this->input->post('ta045'),
				 'ta046' => $this->input->post('ta046'),
                 'ta047' => $this->input->post('ta047'),
                 'ta048' => $this->input->post('ta048'),
                 'ta049' => $this->input->post('ta049'),
                 'ta050' => $this->input->post('ta050'),
				 'ta051' => $this->input->post('ta051'),
				 'ta052' => $ta052,
				 'ta053' => $ta053,
                 'ta054' => $ta054,
                 'ta055' => $this->input->post('ta055'),
				 'ta056' => $this->input->post('ta056'),
                 'ta057' => $this->input->post('ta057'),
                 'ta058' => $this->input->post('ta058'),
                 'ta059' => $this->input->post('ta059'),
                 'ta060' => $this->input->post('ta060'),
				 'ta061' => $this->input->post('ta061'),
				 'ta062' => $this->input->post('ta062'),
				 'ta063' => $this->input->post('ta063'),
                 'ta064' => $this->input->post('ta064'),
                 'ta065' => $this->input->post('ta065'),
				 'ta066' => $this->input->post('ta066'),
                 'ta067' => $this->input->post('ta067'),
                 'ta068' => $this->input->post('ta068'),
                 'ta069' => $this->input->post('ta069'),
                 'ta070' => $ta070,
				 'ta071' => $this->input->post('ta071'),
				 'ta072' => $this->input->post('ta072'),
				 'ta073' => $this->input->post('ta073'),
                 'ta074' => $this->input->post('ta074'),
                 'ta075' => $this->input->post('ta075'),
				 'ta076' => $this->input->post('ta076')
               );
	    
             $this->db->insert('epsta', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 epstb  
		      $vtb003='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['tb003'] && $val['tb004']){
				        extract($val);
					//	preg_match_all('/\d/S',$tb013, $matches);  //處理日期字串
			         //   $tb013 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tb001' => $ta001,
							'tb002' => $ta002no
						);
						foreach($val as $k=>$v){
							if($k!="tb001"&&$k!="tb002"&&$k!="tb007disp"&&$k!="tb007disp1"&&$k!="tb018disp"&&$k!="tb033disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('epstb', $data);
					$mtb003 = (int) $vtb003+10;
			        $vtb003 =  (string)$mtb003;
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
		      echo "<script>window.open('printbb/".$this->input->post('copi03')."/".$this->input->post('ta002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('epsta');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('epsta');
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
				$ta029=$row->ta029;$ta030=$row->ta030;$ta031=$row->ta031;$ta032=$row->ta032;$ta033=$row->ta033;$ta034=$row->ta034;
				$ta035=$row->ta035;$ta036=$row->ta036;$ta037=$row->ta037;$ta038=$row->ta038;$ta039=$row->ta039;$ta040=$row->ta040;$ta041=$row->ta041;
				$ta042=$row->ta042;$ta043=$row->ta043;$ta044=$row->ta044;$ta045=$row->ta045;$ta046=$row->ta046;$ta047=$row->ta047;
				$ta048=$row->ta048;$ta049=$row->ta049;$ta050=$row->ta050;$ta051=$row->ta051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭epsta
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
				   'ta025' => $ta025,'ta026' => $ta026,'ta027' => $ta027,'ta028' => $ta028,'ta029' => $ta029,'ta030' => $ta030,
				   'ta031' => $ta031,'ta032' => $ta032,'ta033' => $ta033,'ta034' => $ta034,'ta035' => $ta035,'ta036' => $ta036,
				   'ta037' => $ta037,'ta038' => $ta038,'ta039' => $ta039,'ta040' => $ta040,'ta041' => $ta041,'ta042' => $ta042,
				   'ta043' => $ta043,'ta044' => $ta044,'ta045' => $ta045,'ta046' => $ta046,'ta047' => $ta047,'ta048' => $ta048,
				   'ta049' => $ta049,'ta050' => $ta050,'ta051' => $ta051
                   );
				   
            $exist = $this->epsi05_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('epsta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('epstb');
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
                 $tb003[$i]=$row->tb003;$tb004[$i]=$row->tb004;$tb005[$i]=$row->tb005;$tb006[$i]=$row->tb006;$tb007[$i]=$row->tb007;
				 $tb008[$i]=$row->tb008;$tb009[$i]=$row->tb009;$tb010[$i]=$row->tb010;$tb011[$i]=$row->tb011;$tb012[$i]=$row->tb012;
				 $tb013[$i]=$row->tb013;$tb014[$i]=$row->tb014;$tb015[$i]=$row->tb015;$tb016[$i]=$row->tb016;$tb017[$i]=$row->tb017;
				 $tb018[$i]=$row->tb018;$tb019[$i]=$row->tb019;$tb020[$i]=$row->tb020;$tb021[$i]=$row->tb021;$tb022[$i]=$row->tb022;
			     $tb023[$i]=$row->tb023;$tb024[$i]=$row->tb024;$tb025[$i]=$row->tb025;$tb026[$i]=$row->tb026;$tb027[$i]=$row->tb027;
				 $tb028[$i]=$row->tb028;$tb029[$i]=$row->tb029;$tb030[$i]=$row->tb030;$tb031[$i]=$row->tb031;$tb032[$i]=$row->tb032;
				 $tb033[$i]=$row->tb033;$tb034[$i]=$row->tb034;$tb035[$i]=$row->tb035;$tb036[$i]=$row->tb036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細epstb
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
		         'tb008' => $tb008[$i],'tb009' => $tb009[$i],'tb010' => $tb010[$i],'tb011' => $tb011[$i],'tb012' => $tb012[$i],'tb013' => $tb013[$i],
				 'tb014' => $tb014[$i],'tb015' => $tb015[$i],'tb016' => $tb016[$i],'tb017' => $tb017[$i],'tb018' => $tb018[$i],'tb019' => $tb019[$i],
				 'tb020' => $tb020[$i],'tb021' => $tb021[$i],'tb022' => $tb022[$i],'tb023' => $tb023[$i],'tb024' => $tb024[$i],'tb025' => $tb025[$i],
				 'tb026' => $tb026[$i],'tb027' => $tb027[$i],'tb028' => $tb028[$i],'tb029' => $tb029[$i],'tb030' => $tb030[$i],'tb031' => $tb031[$i],'tb032' => $tb032[$i],
				 'tb033' => $tb033[$i],'tb034' => $tb034[$i],'tb035' => $tb035[$i],'tb036' => $tb036[$i]
                ); 
				
             $this->db->insert('epstb', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ta001o');    
	      $seq2=$this->input->post('ta001c');
		  $seq3=$this->input->post('ta002o');    
	      $seq4=$this->input->post('ta002c');
	      $sql = " SELECT ta001,ta002,ta039,ta004,ma002 as ta004disp,tb003,tb004,tb005,tb006,tb010,tb008,tb011,tb012 
		  FROM epsta as a,epstb as b,copma as c WHERE ta001=tb001 and ta002=tb002 and ta004=ma001 and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.ta001,a.ta002,a.ta039,a.ta004,c.ma002 as ta004disp,b.tb003,b.tb004,b.tb005,b.tb006,b.tb010,b.tb008,b.tb011,b.tb012
		  FROM epsta as a,epstb as b,copma as c
		  WHERE ta001=tb001 and ta002=tb002 and ta004=ma001 and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
          $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('epsta')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS ta001disp, d.me002 AS ta004disp, e.mb002 AS ta010disp, f.mv002 AS ta012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb011, b.tb009, b.tb017, b.tb018, b.tb012');
		 
        $this->db->from('epsta as a');	
        $this->db->join('epstb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ta004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.ta010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.ta012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
	    $query = $this->db->get('epstb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta007disp,e.mf002 AS ta008disp, f.mv002 AS ta006disp,g.na003 AS ta014disp,
		  ,h.ma002 AS ta004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb016,b.tb020,b.tb030,b.tb031,i.mc002 as tb007disp,j.me002 as ta005disp');
		 
        $this->db->from('epsta as a');	
        $this->db->join('epstb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ta008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ta006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ta014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tb007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ta005 = j.me001 ','left');   //部門	
		$this->db->where('a.ta001', $this->input->post('ta001o')); 
	    $this->db->where('a.ta002 >= '.$this->input->post('ta002o').' and a.ta002 <= '.$this->input->post('ta002c')); 
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
          $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta007disp,e.mf002 AS ta008disp, f.mv002 AS ta006disp,g.na003 AS ta014disp,
		  ,h.ma002 AS ta004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb016,b.tb020,b.tb030,b.tb031,i.mc002 as tb007disp,j.me002 as ta005disp');
		 
        $this->db->from('epsta as a');	
        $this->db->join('epstb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ta008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ta006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ta014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tb007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ta005 = j.me001 ','left');   //部門
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
			//substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $ta002=$this->input->post('ta002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			 preg_match_all('/\d/S',$this->input->post('ta003'), $matches);  //處理日期字串
			 $ta003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta016'), $matches);  //處理日期字串
			 $ta016 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta039'), $matches);  //處理日期字串
			 $ta039 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta040'), $matches);  //處理日期字串
			 $ta040 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta052'), $matches);  //處理日期字串
			 $ta052 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta053'), $matches);  //處理日期字串
			 $ta053 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta054'), $matches);  //處理日期字串
			 $ta054 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta070'), $matches);  //處理日期字串
			 $ta070 = implode('',$matches[0]);
			   
			 $ta001=$this->input->post('ta001');
			 $ta002=$this->input->post('ta002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'ta003' => $ta003,
		         'ta004' => $this->input->post('ta004'),    //客戶
		         'ta005' => $this->input->post('ta005'),    
		         'ta006' => $this->input->post('ta006'),    
                 'ta007' => $this->input->post('ta007'),    
                 'ta008' => $this->input->post('ta008'),  
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('ta010'),		
                 'ta011' => $this->input->post('ta011'),
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $this->input->post('ta014'),	
                 'ta015' => $this->input->post('ta015'),	
                 'ta016' => $ta016,
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
                 'ta030' => $this->input->post('ta030'),
				 'ta031' => $this->input->post('ta031'),
				 'ta032' => $this->input->post('ta032'),
                 'ta033' => $this->input->post('ta033'),
                 'ta034' => $this->input->post('ta034'),
                 'ta035' => $this->input->post('ta035'),
				 'ta036' => $this->input->post('ta036'),
                 'ta037' => $this->input->post('ta037'),
                 'ta038' => $this->input->post('ta038'),
                 'ta039' => $ta039,
                 'ta040' => $ta040,
				 'ta041' => $this->input->post('ta041'),
				 'ta042' => $this->input->post('ta042'),
				 'ta043' => $this->input->post('ta043'),
                 'ta044' => $this->input->post('ta044'),
                 'ta045' => $this->input->post('ta045'),
				 'ta046' => $this->input->post('ta046'),
                 'ta047' => $this->input->post('ta047'),
                 'ta048' => $this->input->post('ta048'),
                 'ta049' => $this->input->post('ta049'),
                 'ta050' => $this->input->post('ta050'),
				 'ta051' => $this->input->post('ta051'),
				 'ta052' => $ta052,
				 'ta053' => $ta053,
                 'ta054' => $ta054,
                 'ta055' => $this->input->post('ta055'),
				 'ta056' => $this->input->post('ta056'),
                 'ta057' => $this->input->post('ta057'),
                 'ta058' => $this->input->post('ta058'),
                 'ta059' => $this->input->post('ta059'),
                 'ta060' => $this->input->post('ta060'),
				 'ta061' => $this->input->post('ta061'),
				 'ta062' => $this->input->post('ta062'),
				 'ta063' => $this->input->post('ta063'),
                 'ta064' => $this->input->post('ta064'),
                 'ta065' => $this->input->post('ta065'),
				 'ta066' => $this->input->post('ta066'),
                 'ta067' => $this->input->post('ta067'),
                 'ta068' => $this->input->post('ta068'),
                 'ta069' => $this->input->post('ta069'),
                 'ta070' => $ta070,
				 'ta071' => $this->input->post('ta071'),
				 'ta072' => $this->input->post('ta072'),
				 'ta073' => $this->input->post('ta073'),
                 'ta074' => $this->input->post('ta074'),
                 'ta075' => $this->input->post('ta075'),
				 'ta076' => $this->input->post('ta076')
                );
            $this->db->where('ta001', $ta001); //單別
			$this->db->where('ta002', $ta002);
            $this->db->update('epsta',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('tb001', $ta001);
					$this->db->where('tb002', $ta002);
					$this->db->delete('epstb'); //刪除明細 1060809
					
		    $vtb003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
			//	preg_match_all('/\d/S',$tb013, $matches);  //處理日期字串
			 //   $tb013 = implode('',$matches[0]);
				if($this->seldetail($ta001,$ta002,$val['tb003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="tb001"&&$k!="tb002"&&$k!="tb007disp"&&$k!="tb007disp1" && $k!="tb018disp"&& $k!="tb033disp"){//主鍵不用更改以及其他外來鍵庫別名稱 tb013日期等別處理
							if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('tb001', $ta001);
					$this->db->where('tb002', $ta002);
					$this->db->where('tb003', $vtb003);
					$this->db->update('epstb',$data);//更改一筆
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
							'tb001' => $ta001,
							'tb002' => $ta002
						);
						foreach($val as $k=>$v){
							if($k!="tb001"&&$k!="tb002"&&$k!="tb007disp"&&$k!="tb007disp1" && $k!="tb018disp"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('epstb', $data);
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
	        $query = $this->db->get('epstb');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('epsta'); 
		  $this->db->where('tb001', $this->uri->segment(4));
		  $this->db->where('tb002', $this->uri->segment(5));
          $this->db->delete('epstb'); 
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
          $this->db->delete('epstb'); 
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
					$query6c = $this->db->query("SELECT UPPER(tb016) as tb0161 FROM epstb WHERE tb001='$seq1' AND tb002='$seq2' AND ( UPPER(tb016)='Y' or tb009>0 ) ");         
                    foreach ($query6c->result() as $row)
                          {
                            $tb0161[]=$row->tb0161;		 
                          }
                         if(isset($tb0161[0])) {
	                         $vtb0161=$tb0161[0];
                                                 }
	                     else 
                            { $vtb0161='N'; }    //結案碼
						
						
				if ($vtb0161 != 'Y') {	  
			      $this->db->where('ta001', $seq1);
			      $this->db->where('ta002', $seq2);
                  $this->db->delete('epsta'); 
				  $this->db->where('tb001', $seq1);
			      $this->db->where('tb002', $seq2);
				  $this->db->delete('epstb'); $this->session->set_userdata('msg1',"未出貨已刪除"); }
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
		$this->db->where('tb001', $_POST['del_md001']);
		$this->db->where('tb002', $_POST['del_md002']);
		$this->db->where('tb003', $_POST['del_md003']);
		$this->db->delete('epstb');
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
	function check_title_no($epsi01,$ta070){
		preg_match_all('/\d/S',$ta070, $matches);  //處理日期字串
		$ta070 = implode('',$matches[0]);
		//echo var_dump($ta070);exit;
		
		$this->db->select('MAX(ta002) as max_no')
			->from('epsta')
			->where('ta001', $epsi01)
			->where('ta070', $ta070);
		//	->like('ta070', $ta070, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		//echo var_dump($ta001.$ta070);exit;
		
	    if (!$result[0]->max_no){return $ta070."001";}
		
		return $result[0]->max_no+1;
	}
	function check_vno_no(){
	
		$this->db->select('MAX(id) as max_no')
			->from('invoice');
		//	->where('ta039', $ta039);
		//	->like('ta039', $ta039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	   // if (!$result[0]->max_no){return $ta039."001";}
		
		return $result[0]->max_no;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>