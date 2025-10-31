<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ipsi05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tg001, tg002, tg003, tg004, tg0011, tg0019,tg020, create_date');
          $this->db->from('ipstg');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tg001 desc, tg002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('ipstg');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.tg001', 'a.tg002', 'a.tg003', 'a.tg004', 'a.tg011', 'a.tg019','a.tg030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tg001, a.tg002, a.tg003, a.tg004, b.ma002,  a.tg029, a.tg030,a.create_date')
	                       ->from('ipstg as a')
						    ->join('purma as b', 'a.tg004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('ipstg');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('ipsi05_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['ipsi05']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tg001 asc,tg002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['ipsi05']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['ipsi05']['search']['where'];
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
		
		if(isset($_SESSION['ipsi05']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['ipsi05']['search']['order'];
		}
		
		if(!isset($_SESSION['ipsi05']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,c.mq002, b.ma002,d.mb002')
	                       ->from('ipstg as a')
						   ->join('purma as b', 'a.tg006 = b.ma001','left')
						   ->join('cmsmq as c', 'a.tg001 = c.mq001','left')
						   ->join('cmsmb as d', 'a.tg005 = d.mb001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,c.mq002,b.ma002,d.mb002')
	                       ->from('ipstg as a')
						   ->join('purma as b', 'a.tg006 = b.ma001','left')
						   ->join('cmsmq as c', 'a.tg001 = c.mq001','left')
						   ->join('cmsmb as d', 'a.tg005 = d.mb001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['ipsi05']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('ipstg as a')
			->join('purma as b', 'a.tg004 = b.ma001','left')
			->join('cmsmq as c', 'a.tg001 = c.mq001','left')
			->join('cmsmb as d', 'a.tg005 = d.mb001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['ipsi05']['search']['where'] = $where;
		$_SESSION['ipsi05']['search']['order'] = $order;
		$_SESSION['ipsi05']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"tg001","tg002"
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
		$_SESSION['ipsi05']['search']['view'] = $view_array;
		$_SESSION['ipsi05']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['ipsi05']['search']['view']);exit;
	}
	
	//查詢一筆 修改用   
	function selone($seg1, $seg2) {
		$this->db->select('a.* ,c.mq002 AS tg001disp, d.mf002 AS tg017disp, e.ma002 AS tg005disp,f.mb002 AS tg036disp,
		  g.ma002 as tg006disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.ti001, b.ti002, b.ti003, b.ti004, b.ti005,
		  b.ti006, b.ti007, b.ti008, b.ti009, b.ti010, b.ti011, b.ti012,b.ti013, b.ti014,b.ti015,b.ti016,b.ti017,
		  i.mc002 as ti007disp');
		 
        $this->db->from('ipstg as a');	
        $this->db->join('ipsti as b', 'a.tg001 = b.ti001  and a.tg002=b.ti002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001  ','left');  //單別copi03
		$this->db->join('cmsmf as d', 'a.tg017 = d.mf001 ','left');		//幣別cmsi06
		$this->db->join('purma as e', 'a.tg005 = e.ma001 ','left');  //廠商代號
		$this->db->join('cmsmb as f', 'a.tg036 = f.mb001 ','left');  //廠別
		$this->db->join('cmsma as g', 'a.tg006 = g.ma001 ','left');  //銀行
		$this->db->join('cmsmc as i', 'b.ti007 = i.mc001 ','left');   //庫別
		$this->db->where('a.tg001', $seg1); 
	    $this->db->where('a.tg002', $seg2); 
		$this->db->order_by('tg001 , tg002 ,b.ti003');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*,c.mb002 as ti010disp,c.mb003 as ti010disp1,c.mb004 as ti010disp2,d.mc002 as ti007disp')
			->from('ipsti as b')
			->join('invmb as c', 'b.ti010 = c.mb001 ','left')   //品號
			->join('cmsmc as d', 'b.ti007 = d.mc001 ','left')   //庫別
			->where('b.ti001', $seg1)
			->where('b.ti002', $seg2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg007disp,e.mf002 AS tg008disp, f.mv002 AS tg006disp,g.na003 AS tg014disp,
		  ,h.ma002 AS tg004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.ti001, b.ti002, b.ti003, b.ti004, b.ti005,
		  b.ti006, b.ti007, b.ti008, b.ti009, b.ti010, b.ti011, b.ti012,b.ti013, b.ti014,b.ti016,b.ti020,b.ti030,b.ti031,i.mc002 as ti007disp,j.me002 as tg005disp');
		 
        $this->db->from('ipstg as a');	
        $this->db->join('ipsti as b', 'a.tg001 = b.ti001  and a.tg002=b.ti002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('purma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.ti007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.ti003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('ipstg');  
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `ipstg` ";
	      $seq1 = "tg001, tg002, tg003, tg004, tg004 as tg004disp,tg005, tg006,tg007,tg08,tg010,tg011,tg012,tg029,tg030, create_date FROM `ipstg` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.tg001 desc' ;
          $seq9 = " ORDER BY a.tg001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.tg001 ";

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
		if(@$_SESSION['ipsi05_sql_term']){$seq32 = $_SESSION['ipsi05_sql_term'];}
		if(@$_SESSION['ipsi05_sql_sort']){$seq33 = $_SESSION['ipsi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tg001', 'tg002', 'tg003', 'tg004','b.ma002', 'tg005', 'tg006','tg007','tg008','tg010','tg011','tg012','tg019','tg027','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*,c.mq002,b.ma002,d.mb002')
	                       ->from('ipstg as a')
						   ->join('purma as b', 'a.tg006 = b.ma001','left')
						   ->join('cmsmq as c', 'a.tg001 = c.mq001','left')
						   ->join('cmsmb as d', 'a.tg005 = d.mb001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('ipstg as a')
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
	      $sort_columns = array('a.tg001', 'a.tg002', 'a.tg003', 'a.tg004', 'b.ma002', 'a.tg029','a.tg030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否為 table
	      $this->db->select('a.tg001, a.tg002, a.tg003, a.tg004,b.ma002,  a.tg029,a.tg030, a.create_date');
	      $this->db->from('ipstg as a');
		  $this->db->join('purma as b', 'a.tg004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tg001 asc, tg002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('ipstg as a');
		  $this->db->join('purma as b', 'a.tg004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('tg001', $seg1);
		  $this->db->where('tg002', $seg2);
	      $query = $this->db->get('ipstg');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('ti001', $seg1);
		  $this->db->where('ti002', $seg2);
		  $this->db->where('ti003', $seg3);
	      $query = $this->db->get('ipsti');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  ipstg	
	function insertf()    //新增一筆 檔頭  ipstg
        {
		    //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('tg003'), $matches);  //處理日期字串
			 $tg003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg008'), $matches);  //處理日期字串
			 $tg008 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg009'), $matches);  //處理日期字串
			 $tg009 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg011'), $matches);  //處理日期字串
			 $tg011 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg012'), $matches);  //處理日期字串
			 $tg012 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg015'), $matches);  //處理日期字串
			 $tg015 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg016'), $matches);  //處理日期字串
			 $tg016 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg027'), $matches);  //處理日期字串
			 $tg027 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg041'), $matches);  //處理日期字串
			 $tg041 = implode('',$matches[0]);
						   
			 $tg001=$this->input->post('tg001');
			 $tg002=$this->input->post('tg002');
			 $tg002no=$tg002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->ipsi05_model->selone1($tg001,$tg002)>0){
				$tg002 = $this->check_title_no($tg001,$tg003);
				$tg002no=$tg002;
			}
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tg001' => $tg001,
		         'tg002' => $tg002,
		         'tg003' => $tg003,
		         'tg004' => $this->input->post('tg004'),    
		         'tg005' => $this->input->post('tg005'),    
		         'tg006' => $this->input->post('tg006'),    
                 'tg007' => $this->input->post('tg007'),    
                 'tg008' => $tg008,  
                 'tg009' => $tg009,
                 'tg010' => $this->input->post('tg010'),		
                 'tg011' => $tg011,
                 'tg012' => $tg012,
                 'tg013' => $this->input->post('tg013'),	
                 'tg014' => $this->input->post('tg014'),		
                 'tg015' => $tg015,	
                 'tg016' => $tg016,
				 'tg017' => $this->input->post('tg017'),
                 'tg018' => $this->input->post('tg018'),
                 'tg019' => $this->input->post('tg019'),
                 'tg020' => $this->input->post('tg020'),
				 'tg021' => $this->input->post('tg021'),
				 'tg022' => $this->input->post('tg022'),
                 'tg023' => $this->input->post('tg023'),
                 'tg024' => $this->input->post('tg024'),
                 'tg025' => $this->input->post('tg025'),
				 'tg026' => $this->input->post('tg026'),
                 'tg027' => $tg027,
                 'tg028' => $this->input->post('tg028'),
                 'tg029' => $this->input->post('tg029'),
                 'tg030' => $this->input->post('tg030'),
				 'tg031' => $this->input->post('tg031'),
				 'tg032' => $this->input->post('tg032'),
                 'tg033' => $this->input->post('tg033'),
                 'tg034' => $this->input->post('tg034'),
                 'tg035' => $this->input->post('tg035'),
				 'tg036' => $this->input->post('tg036'),
                 'tg037' => $this->input->post('tg037'),
                 'tg038' => $this->input->post('tg038'),
                 'tg039' => $this->input->post('tg039'),
                 'tg040' => $this->input->post('tg040'),
				 'tg041' => $tg041,
				 'tg042' => $this->input->post('tg042'),
				 'tg043' => $this->input->post('tg043'),
                 'tg044' => $this->input->post('tg044'),
				 'tg045' => $this->input->post('tg045'),
				 'tg046' => $this->input->post('tg046'),
				 'tg047' => $this->input->post('tg047')
				
               );
	    
             $this->db->insert('ipstg', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 ipsti  
		      $vti003='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['ti003'] && $val['ti004']){
				        extract($val);
					//	preg_match_all('/\d/S',$ti013, $matches);  //處理日期字串
			         //   $ti013 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'ti001' => $tg001,
							'ti002' => $tg002no
						);
						foreach($val as $k=>$v){
							if($k!="ti001"&&$k!="ti002"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="ti003") {$data[$k] = $vti003;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('ipsti', $data);
					$mti003 = (int) $vti003+10;
			        $vti003 =  (string)$mti003;
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
		      echo "<script>window.open('printbb/".$this->input->post('copi03')."/".$this->input->post('tg002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tg001', $this->input->post('tg001c')); 
          $this->db->where('tg002', $this->input->post('tg002c'));
	      $query = $this->db->get('ipstg');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tg001', $this->input->post('tg001o'));
			$this->db->where('tg002', $this->input->post('tg002o'));
	        $query = $this->db->get('ipstg');
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
                $tg003=$row->tg003;$tg004=$row->tg004;$tg005=$row->tg005;$tg006=$row->tg006;$tg007=$row->tg007;$tg008=$row->tg008;$tg009=$row->tg009;$tg010=$row->tg010;
				$tg011=$row->tg011;$tg012=$row->tg012;$tg013=$row->tg013;$tg014=$row->tg014;$tg015=$row->tg015;$tg016=$row->tg016;
				$tg017=$row->tg017;$tg018=$row->tg018;$tg019=$row->tg019;$tg020=$row->tg020;$tg021=$row->tg021;$tg022=$row->tg022;
				$tg023=$row->tg023;$tg024=$row->tg024;$tg025=$row->tg025;$tg026=$row->tg026;$tg027=$row->tg027;$tg028=$row->tg028;
				$tg029=$row->tg029;$tg030=$row->tg030;$tg031=$row->tg031;$tg032=$row->tg032;$tg033=$row->tg033;$tg034=$row->tg034;
				$tg035=$row->tg035;$tg036=$row->tg036;$tg037=$row->tg037;$tg038=$row->tg038;$tg039=$row->tg039;$tg040=$row->tg040;$tg041=$row->tg041;
				$tg042=$row->tg042;$tg043=$row->tg043;$tg044=$row->tg044;$tg045=$row->tg045;$tg046=$row->tg046;$tg047=$row->tg047;
				$tg048=$row->tg048;$tg049=$row->tg049;$tg050=$row->tg050;$tg051=$row->tg051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tg001c');    //主鍵一筆檔頭ipstg
			$seq2=$this->input->post('tg002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tg001' => $seq1,'tg002' => $seq2,'tg003' => $tg003,'tg004' => $tg004,'tg005' => $tg005,'tg006' => $tg006,'tg007' => $tg007,'tg008' => $tg008,'tg009' => $tg009,'tg010' => $tg010,
		           'tg011' => $tg011,'tg012' => $tg012,'tg013' => $tg013,'tg014' => $tg014,'tg015' => $tg015,'tg016' => $tg016,'tg017' => $tg017,
				   'tg018' => $tg018,'tg019' => $tg019,'tg020' => $tg020,'tg021' => $tg021,'tg022' => $tg022,'tg023' => $tg023,'tg024' => $tg024,
				   'tg025' => $tg025,'tg026' => $tg026,'tg027' => $tg027,'tg028' => $tg028,'tg029' => $tg029,'tg030' => $tg030,
				   'tg031' => $tg031,'tg032' => $tg032,'tg033' => $tg033,'tg034' => $tg034,'tg035' => $tg035,'tg036' => $tg036,
				   'tg037' => $tg037,'tg038' => $tg038,'tg039' => $tg039,'tg040' => $tg040,'tg041' => $tg041,'tg042' => $tg042,
				   'tg043' => $tg043,'tg044' => $tg044,'tg045' => $tg045,'tg046' => $tg046,'tg047' => $tg047,'tg048' => $tg048,
				   'tg049' => $tg049,'tg050' => $tg050,'tg051' => $tg051
                   );
				   
            $exist = $this->ipsi05_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('ipstg', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('ti001', $this->input->post('tg001o'));
			$this->db->where('ti002', $this->input->post('tg002o'));
	        $query = $this->db->get('ipsti');
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
                 $ti003[$i]=$row->ti003;$ti004[$i]=$row->ti004;$ti005[$i]=$row->ti005;$ti006[$i]=$row->ti006;$ti007[$i]=$row->ti007;
				 $ti008[$i]=$row->ti008;$ti009[$i]=$row->ti009;$ti010[$i]=$row->ti010;$ti011[$i]=$row->ti011;$ti012[$i]=$row->ti012;
				 $ti013[$i]=$row->ti013;$ti014[$i]=$row->ti014;$ti015[$i]=$row->ti015;$ti016[$i]=$row->ti016;$ti017[$i]=$row->ti017;
				 $ti018[$i]=$row->ti018;$ti019[$i]=$row->ti019;$ti020[$i]=$row->ti020;$ti021[$i]=$row->ti021;$ti022[$i]=$row->ti022;
			     $ti023[$i]=$row->ti023;$ti024[$i]=$row->ti024;$ti025[$i]=$row->ti025;$ti026[$i]=$row->ti026;$ti027[$i]=$row->ti027;
				 $ti028[$i]=$row->ti028;$ti029[$i]=$row->ti029;$ti030[$i]=$row->ti030;$ti031[$i]=$row->ti031;$ti032[$i]=$row->ti032;
				 $ti033[$i]=$row->ti033;$ti034[$i]=$row->ti034;$ti035[$i]=$row->ti035;$ti036[$i]=$row->ti036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tg001c');    //主鍵一筆明細ipsti
			$seq2=$this->input->post('tg002c'); 
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
                'ti001' => $seq1,'ti002' => $seq2,'ti003' => $ti003[$i],'ti004' => $ti004[$i],'ti005' => $ti005[$i],'ti006' => $ti006[$i],'ti007' => $ti007[$i],
		         'ti008' => $ti008[$i],'ti009' => $ti009[$i],'ti010' => $ti010[$i],'ti011' => $ti011[$i],'ti012' => $ti012[$i],'ti013' => $ti013[$i],
				 'ti014' => $ti014[$i],'ti015' => $ti015[$i],'ti016' => $ti016[$i],'ti017' => $ti017[$i],'ti018' => $ti018[$i],'ti019' => $ti019[$i],
				 'ti020' => $ti020[$i],'ti021' => $ti021[$i],'ti022' => $ti022[$i],'ti023' => $ti023[$i],'ti024' => $ti024[$i],'ti025' => $ti025[$i],
				 'ti026' => $ti026[$i],'ti027' => $ti027[$i],'ti028' => $ti028[$i],'ti029' => $ti029[$i],'ti030' => $ti030[$i],'ti031' => $ti031[$i],'ti032' => $ti032[$i],
				 'ti033' => $ti033[$i],'ti034' => $ti034[$i],'ti035' => $ti035[$i],'ti036' => $ti036[$i]
                ); 
				
             $this->db->insert('ipsti', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tg001o');    
	      $seq2=$this->input->post('tg001c');
		  $seq3=$this->input->post('tg002o');    
	      $seq4=$this->input->post('tg002c');
	      $sql = " SELECT tg001,tg002,tg039,tg004,ma002 as tg004disp,ti003,ti004,ti005,ti006,ti010,ti008,ti011,ti012 
		  FROM ipstg as a,ipsti as b,purma as c WHERE tg001=ti001 and tg002=ti002 and tg004=ma001 and tg001 >= '$seq1'  AND tg001 <= '$seq2' AND  tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tg001o');    
	      $seq2=$this->input->post('tg001c');
		  $seq3=$this->input->post('tg002o');    
	      $seq4=$this->input->post('tg002c');
	      $sql = " SELECT a.tg001,a.tg002,a.tg039,a.tg004,c.ma002 as tg004disp,b.ti003,b.ti004,b.ti005,b.ti006,b.ti010,b.ti008,b.ti011,b.ti012
		  FROM ipstg as a,ipsti as b,purma as c
		  WHERE tg001=ti001 and tg002=ti002 and tg004=ma001 and tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
          $seq32 = "tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('ipstg')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tg001disp, d.me002 AS tg004disp, e.mb002 AS tg010disp, f.mv002 AS tg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.ti001, b.ti002, b.ti003, b.ti004, b.ti005,
		  b.ti006, b.ti007, b.ti011, b.ti009, b.ti017, b.ti018, b.ti012');
		 
        $this->db->from('ipstg as a');	
        $this->db->join('ipsti as b', 'a.tg001 = b.ti001  and a.tg002=b.ti002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.ti003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('ti001', $this->uri->segment(4));
		$this->db->where('ti002', $this->uri->segment(5));
	    $query = $this->db->get('ipsti');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg007disp,e.mf002 AS tg008disp, f.mv002 AS tg006disp,g.na003 AS tg014disp,
		  ,h.ma002 AS tg004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.ti001, b.ti002, b.ti003, b.ti004, b.ti005,
		  b.ti006, b.ti007, b.ti008, b.ti009, b.ti010, b.ti011, b.ti012,b.ti013, b.ti014,b.ti016,b.ti020,b.ti030,b.ti031,i.mc002 as ti007disp,j.me002 as tg005disp');
		 
        $this->db->from('ipstg as a');	
        $this->db->join('ipsti as b', 'a.tg001 = b.ti001  and a.tg002=b.ti002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('purma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.ti007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門	
		$this->db->where('a.tg001', $this->input->post('tg001o')); 
	    $this->db->where('a.tg002 >= '.$this->input->post('tg002o').' and a.tg002 <= '.$this->input->post('tg002c')); 
		$this->db->order_by('tg001 , tg002 ,b.ti003');
		
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
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg007disp,e.mf002 AS tg008disp, f.mv002 AS tg006disp,g.na003 AS tg014disp,
		  ,h.ma002 AS tg004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.ti001, b.ti002, b.ti003, b.ti004, b.ti005,
		  b.ti006, b.ti007, b.ti008, b.ti009, b.ti010, b.ti011, b.ti012,b.ti013, b.ti014,b.ti016,b.ti020,b.ti030,b.ti031,i.mc002 as ti007disp,j.me002 as tg005disp');
		 
        $this->db->from('ipstg as a');	
        $this->db->join('ipsti as b', 'a.tg001 = b.ti001  and a.tg002=b.ti002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('purma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.ti007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.ti003');
		
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
			//substr($this->input->post('tg003'),0,4).substr($this->input->post('tg003'),5,2).substr(rtrim($this->input->post('tg003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $tg002=$this->input->post('tg002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			 preg_match_all('/\d/S',$this->input->post('tg003'), $matches);  //處理日期字串
			 $tg003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg008'), $matches);  //處理日期字串
			 $tg008 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg009'), $matches);  //處理日期字串
			 $tg009 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg011'), $matches);  //處理日期字串
			 $tg011 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg012'), $matches);  //處理日期字串
			 $tg012 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg015'), $matches);  //處理日期字串
			 $tg015 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg016'), $matches);  //處理日期字串
			 $tg016 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg027'), $matches);  //處理日期字串
			 $tg027 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg041'), $matches);  //處理日期字串
			 $tg041 = implode('',$matches[0]);
			   
			 $tg001=$this->input->post('tg001');
			 $tg002=$this->input->post('tg002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'tg003' => $tg003,
		         'tg004' => $this->input->post('tg004'),    
		         'tg005' => $this->input->post('tg005'),    
		         'tg006' => $this->input->post('tg006'),    
                 'tg007' => $this->input->post('tg007'),    
                 'tg008' => $tg008,  
                 'tg009' => $tg009,
                 'tg010' => $this->input->post('tg010'),		
                 'tg011' => $tg011,
                 'tg012' => $tg012,
                 'tg013' => $this->input->post('tg013'),	
                 'tg014' => $this->input->post('tg014'),		
                 'tg015' => $tg015,	
                 'tg016' => $tg016,
				 'tg017' => $this->input->post('tg017'),
                 'tg018' => $this->input->post('tg018'),
                 'tg019' => $this->input->post('tg019'),
                 'tg020' => $this->input->post('tg020'),
				 'tg021' => $this->input->post('tg021'),
				 'tg022' => $this->input->post('tg022'),
                 'tg023' => $this->input->post('tg023'),
                 'tg024' => $this->input->post('tg024'),
                 'tg025' => $this->input->post('tg025'),
				 'tg026' => $this->input->post('tg026'),
                 'tg027' => $tg027,
                 'tg028' => $this->input->post('tg028'),
                 'tg029' => $this->input->post('tg029'),
                 'tg030' => $this->input->post('tg030'),
				 'tg031' => $this->input->post('tg031'),
				 'tg032' => $this->input->post('tg032'),
                 'tg033' => $this->input->post('tg033'),
                 'tg034' => $this->input->post('tg034'),
                 'tg035' => $this->input->post('tg035'),
				 'tg036' => $this->input->post('tg036'),
                 'tg037' => $this->input->post('tg037'),
                 'tg038' => $this->input->post('tg038'),
                 'tg039' => $this->input->post('tg039'),
                 'tg040' => $this->input->post('tg040'),
				 'tg041' => $tg041,
				 'tg042' => $this->input->post('tg042'),
				 'tg043' => $this->input->post('tg043'),
                 'tg044' => $this->input->post('tg044'),
				 'tg045' => $this->input->post('tg045'),
				 'tg046' => $this->input->post('tg046'),
				 'tg047' => $this->input->post('tg047')
                );
            $this->db->where('tg001', $tg001); //單別
			$this->db->where('tg002', $tg002);
            $this->db->update('ipstg',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('ti001', $tg001);
					$this->db->where('ti002', $tg002);
					$this->db->delete('ipsti'); //刪除明細 1060809
					
		    $vti003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
			//	preg_match_all('/\d/S',$ti013, $matches);  //處理日期字串
			 //   $ti013 = implode('',$matches[0]);
				if($this->seldetail($tg001,$tg002,$val['ti003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="ti001"&&$k!="ti002"){//主鍵不用更改以及其他外來鍵庫別名稱 ti013日期等別處理
							if($k=="ti003") {$data[$k] = $vti003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('ti001', $tg001);
					$this->db->where('ti002', $tg002);
					$this->db->where('ti003', $vti003);
					$this->db->update('ipsti',$data);//更改一筆
					$mti003 = (int) $vti003+10;
			        $vti003 =  (string)$mti003;
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
							'ti001' => $tg001,
							'ti002' => $tg002
						);
						foreach($val as $k=>$v){
							if($k!="ti001"&&$k!="ti002"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="ti003") {$data[$k] = $vti003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('ipsti', $data);
						$mti003 = (int) $vti003+10;
			            $vti003 =  (string)$mti003;
					}
				}
				
			}
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('ti001', $seg1);
			$this->db->where('ti002', $seg2);
	        $this->db->where('ti003', $seg3);
	        $query = $this->db->get('ipsti');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
          $this->db->delete('ipstg'); 
		  $this->db->where('ti001', $this->uri->segment(4));
		  $this->db->where('ti002', $this->uri->segment(5));
          $this->db->delete('ipsti'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('ti001', $seg1);
	      $this->db->where('ti002', $seg2);
	      $this->db->where('ti003', $seg3);
          $this->db->delete('ipsti'); 
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
					$query6c = $this->db->query("SELECT UPPER(ti016) as ti0161 FROM ipsti WHERE ti001='$seq1' AND ti002='$seq2' AND ( UPPER(ti016)='Y' or ti009>0 ) ");         
                    foreach ($query6c->result() as $row)
                          {
                            $ti0161[]=$row->ti0161;		 
                          }
                         if(isset($ti0161[0])) {
	                         $vti0161=$ti0161[0];
                                                 }
	                     else 
                            { $vti0161='N'; }    //結案碼
						
						
				if ($vti0161 != 'Y') {	  
			      $this->db->where('tg001', $seq1);
			      $this->db->where('tg002', $seq2);
                  $this->db->delete('ipstg'); 
				  $this->db->where('ti001', $seq1);
			      $this->db->where('ti002', $seq2);
				  $this->db->delete('ipsti'); $this->session->set_userdata('msg1',"未出貨已刪除"); }
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
		$this->db->where('ti001', $_POST['del_md001']);
		$this->db->where('ti002', $_POST['del_md002']);
		$this->db->where('ti003', $_POST['del_md003']);
		$this->db->delete('ipsti');
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
	function check_title_no($ipsi06,$tg003){
		preg_match_all('/\d/S',$tg003, $matches);  //處理日期字串
		$tg003 = implode('',$matches[0]);
		//echo var_dump($tg070);exit;
		
		$this->db->select('MAX(tg002) as max_no')
			->from('ipstg')
			->where('tg001', $ipsi06)
			->where('tg003', $tg003);
		//	->like('tg070', $tg070, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		//echo var_dump($tg001.$tg070);exit;
		
	    if (!$result[0]->max_no){return $tg003."001";}
		
		return $result[0]->max_no+1;
	}
	function check_vno_no(){
	
		$this->db->select('MAX(id) as max_no')
			->from('invoice');
		//	->where('tg039', $tg039);
		//	->like('tg039', $tg039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	   // if (!$result[0]->max_no){return $tg039."001";}
		
		return $result[0]->max_no;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>