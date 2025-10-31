<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ipsi04_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('te001, te002, te003, te004, te0011, te0019,te020, create_date');
          $this->db->from('ipste');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('te001 desc, te002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('ipste');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.te001', 'a.te002', 'a.te003', 'a.te004', 'a.te011', 'a.te019','a.te030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.te001, a.te002, a.te003, a.te004, b.ma002,  a.te029, a.te030,a.create_date')
	                       ->from('ipste as a')
						    ->join('copma as b', 'a.te004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('ipste');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('ipsi04_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['ipsi04']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "te001 asc,te002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['ipsi04']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['ipsi04']['search']['where'];
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
		
		if(isset($_SESSION['ipsi04']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['ipsi04']['search']['order'];
		}
		
		if(!isset($_SESSION['ipsi04']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,c.mb002, b.ma002')
	                       ->from('ipste as a')
						   ->join('purma as b', 'a.te003 = b.ma001','left')
						   ->join('cmsmb as c', 'a.te004 = c.mb001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,c.mb002,b.ma002')
	                       ->from('ipste as a')
						   ->join('purma as b', 'a.te003 = b.ma001','left')
						   ->join('cmsmb as c', 'a.te004 = c.mb001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['ipsi04']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('ipste as a');
			//->join('copma as b', 'a.te004 = b.ma001','left')
			//->join('cmsmb as c', 'a.te001 = c.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['ipsi04']['search']['where'] = $where;
		$_SESSION['ipsi04']['search']['order'] = $order;
		$_SESSION['ipsi04']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"te001","te002"
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
		$_SESSION['ipsi04']['search']['view'] = $view_array;
		$_SESSION['ipsi04']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['ipsi04']['search']['view']);exit;
	}
	
	//查詢一筆 修改用   
	function selone($seg1, $seg2) {
		$this->db->select('a.te001,a.te002,a.te003,a.te004 ,i.mc002 as tf005disp, e.ma002 as te003disp,f.mb002 as te004disp,b.*');
		 
        $this->db->from('ipste as a');	
        $this->db->join('ipstf as b', 'a.te001 = b.tf001   ','left');	//單身	
		$this->db->join('purma as e', 'a.te003 = e.ma001 ','left');  //廠商代號
		$this->db->join('cmsmb as f', 'a.te004 = f.mb001 ','left');  //廠別
		$this->db->join('cmsmc as i', 'b.tf005 = i.mc001 ','left');   //庫別
		$this->db->where('a.te001', $seg1); 
		$this->db->order_by('te001 , te002 ,b.tf003');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*,i.mc002 as tf005disp')
			->from('ipstf as b')
			->join('cmsmc as i', 'b.tf005 = i.mc001 ','left')
			->where('b.tf001', $seg1);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS te001disp, d.mb002 AS te007disp,e.mf002 AS te008disp, f.mv002 AS te006disp,g.na003 AS te014disp,
		  ,h.ma002 AS te004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tf001, b.tf002, b.tf003, b.tf004, b.tf005,
		  b.tf006, b.tf007, b.tf008, b.tf009, b.tf010, b.tf011, b.tf012,b.tf013, b.tf014,b.tf016,b.tf020,b.tf030,b.tf031,i.mc002 as tf007disp,j.me002 as te005disp');
		 
        $this->db->from('ipste as a');	
        $this->db->join('ipstf as b', 'a.te001 = b.tf001  and a.te002=b.tf002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.te001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.te007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.te008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.te006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.te014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.te004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tf007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.te005 = j.me001 ','left');   //部門
		$this->db->where('a.te001', $this->uri->segment(4)); 
	    $this->db->where('a.te002', $this->uri->segment(5)); 
		$this->db->order_by('te001 , te002 ,b.tf003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('ipste');  
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `ipste` ";
	      $seq1 = "te001, te002, te003, te004, te004 as te004disp,te005, te006,te007,te08,te010,te011,te012,te029,te030, create_date FROM `ipste` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.te001 desc' ;
          $seq9 = " ORDER BY a.te001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.te001 ";

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
		if(@$_SESSION['ipsi04_sql_term']){$seq32 = $_SESSION['ipsi04_sql_term'];}
		if(@$_SESSION['ipsi04_sql_sort']){$seq33 = $_SESSION['ipsi04_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('te001', 'te002', 'te003', 'te004','b.ma002', 'te005', 'te006','te007','te008','te010','te011','te012','te019','te027','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*,c.mb002,b.ma002')
	                       ->from('ipste as a')
						   ->join('purma as b', 'a.te003 = b.ma001','left')
						   ->join('cmsmb as c', 'a.te004 = c.mb001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('ipste as a')
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
	      $sort_columns = array('a.te001', 'a.te002', 'a.te003', 'a.te004', 'b.ma002', 'a.te029','a.te030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否為 table
	      $this->db->select('a.te001, a.te002, a.te003, a.te004,b.ma002,  a.te029,a.te030, a.create_date');
	      $this->db->from('ipste as a');
		  $this->db->join('copma as b', 'a.te004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('te001 asc, te002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('ipste as a');
		  $this->db->join('copma as b', 'a.te004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('te001', $seg1);
		  $this->db->where('te002', $seg2);
	      $query = $this->db->get('ipste');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tf001', $seg1);
		  $this->db->where('tf002', $seg2);
		  $this->db->where('tf003', $seg3);
	      $query = $this->db->get('ipstf');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  ipste	
	function insertf()    //新增一筆 檔頭  ipste
        {
		    //刪日期 / 符號
		    preg_match_all('/\d/S',$this->input->post('te002'), $matches);  //處理日期字串
			 $te002 = implode('',$matches[0]);
						   
			 $te001=$this->input->post('te001');
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'te001' => $te001,
		         'te002' => $te002,
		         'te003' => $this->input->post('te003'),
		         'te004' => $this->input->post('te004')
				
               );
	    
             $this->db->insert('ipste', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 ipstf  
		      
		   foreach($order_product as $key => $val){
		        if($val['tf002'] && $val['tf003'] && $val['tf004']){
				        extract($val);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tf001' => $te001,
							'tf002' => $tf002,
							'tf003' => $tf003,
							'tf004' => $tf004,
						);
						foreach($val as $k=>$v){
							if($k!="tf001"&&$k!="tf002"&&$k!="tf003"&&$k!="tf004"&&$k!="tf005disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    $data[$k] = $v;
							}
						}
					$this->db->insert('ipstf', $data);
					
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
		      echo "<script>window.open('printbb/".$this->input->post('copi03')."/".$this->input->post('te002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('te001', $this->input->post('te001c')); 
          $this->db->where('te002', $this->input->post('te002c'));
	      $query = $this->db->get('ipste');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('te001', $this->input->post('te001o'));
			$this->db->where('te002', $this->input->post('te002o'));
	        $query = $this->db->get('ipste');
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
                $te003=$row->te003;$te004=$row->te004;$te005=$row->te005;$te006=$row->te006;$te007=$row->te007;$te008=$row->te008;$te009=$row->te009;$te010=$row->te010;
				$te011=$row->te011;$te012=$row->te012;$te013=$row->te013;$te014=$row->te014;$te015=$row->te015;$te016=$row->te016;
				$te017=$row->te017;$te018=$row->te018;$te019=$row->te019;$te020=$row->te020;$te021=$row->te021;$te022=$row->te022;
				$te023=$row->te023;$te024=$row->te024;$te025=$row->te025;$te026=$row->te026;$te027=$row->te027;$te028=$row->te028;
				$te029=$row->te029;$te030=$row->te030;$te031=$row->te031;$te032=$row->te032;$te033=$row->te033;$te034=$row->te034;
				$te035=$row->te035;$te036=$row->te036;$te037=$row->te037;$te038=$row->te038;$te039=$row->te039;$te040=$row->te040;$te041=$row->te041;
				$te042=$row->te042;$te043=$row->te043;$te044=$row->te044;$te045=$row->te045;$te046=$row->te046;$te047=$row->te047;
				$te048=$row->te048;$te049=$row->te049;$te050=$row->te050;$te051=$row->te051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('te001c');    //主鍵一筆檔頭ipste
			$seq2=$this->input->post('te002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'te001' => $seq1,'te002' => $seq2,'te003' => $te003,'te004' => $te004,'te005' => $te005,'te006' => $te006,'te007' => $te007,'te008' => $te008,'te009' => $te009,'te010' => $te010,
		           'te011' => $te011,'te012' => $te012,'te013' => $te013,'te014' => $te014,'te015' => $te015,'te016' => $te016,'te017' => $te017,
				   'te018' => $te018,'te019' => $te019,'te020' => $te020,'te021' => $te021,'te022' => $te022,'te023' => $te023,'te024' => $te024,
				   'te025' => $te025,'te026' => $te026,'te027' => $te027,'te028' => $te028,'te029' => $te029,'te030' => $te030,
				   'te031' => $te031,'te032' => $te032,'te033' => $te033,'te034' => $te034,'te035' => $te035,'te036' => $te036,
				   'te037' => $te037,'te038' => $te038,'te039' => $te039,'te040' => $te040,'te041' => $te041,'te042' => $te042,
				   'te043' => $te043,'te044' => $te044,'te045' => $te045,'te046' => $te046,'te047' => $te047,'te048' => $te048,
				   'te049' => $te049,'te050' => $te050,'te051' => $te051
                   );
				   
            $exist = $this->ipsi04_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('ipste', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tf001', $this->input->post('te001o'));
			$this->db->where('tf002', $this->input->post('te002o'));
	        $query = $this->db->get('ipstf');
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
                 $tf003[$i]=$row->tf003;$tf004[$i]=$row->tf004;$tf005[$i]=$row->tf005;$tf006[$i]=$row->tf006;$tf007[$i]=$row->tf007;
				 $tf008[$i]=$row->tf008;$tf009[$i]=$row->tf009;$tf010[$i]=$row->tf010;$tf011[$i]=$row->tf011;$tf012[$i]=$row->tf012;
				 $tf013[$i]=$row->tf013;$tf014[$i]=$row->tf014;$tf015[$i]=$row->tf015;$tf016[$i]=$row->tf016;$tf017[$i]=$row->tf017;
				 $tf018[$i]=$row->tf018;$tf019[$i]=$row->tf019;$tf020[$i]=$row->tf020;$tf021[$i]=$row->tf021;$tf022[$i]=$row->tf022;
			     $tf023[$i]=$row->tf023;$tf024[$i]=$row->tf024;$tf025[$i]=$row->tf025;$tf026[$i]=$row->tf026;$tf027[$i]=$row->tf027;
				 $tf028[$i]=$row->tf028;$tf029[$i]=$row->tf029;$tf030[$i]=$row->tf030;$tf031[$i]=$row->tf031;$tf032[$i]=$row->tf032;
				 $tf033[$i]=$row->tf033;$tf034[$i]=$row->tf034;$tf035[$i]=$row->tf035;$tf036[$i]=$row->tf036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('te001c');    //主鍵一筆明細ipstf
			$seq2=$this->input->post('te002c'); 
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
                'tf001' => $seq1,'tf002' => $seq2,'tf003' => $tf003[$i],'tf004' => $tf004[$i],'tf005' => $tf005[$i],'tf006' => $tf006[$i],'tf007' => $tf007[$i],
		         'tf008' => $tf008[$i],'tf009' => $tf009[$i],'tf010' => $tf010[$i],'tf011' => $tf011[$i],'tf012' => $tf012[$i],'tf013' => $tf013[$i],
				 'tf014' => $tf014[$i],'tf015' => $tf015[$i],'tf016' => $tf016[$i],'tf017' => $tf017[$i],'tf018' => $tf018[$i],'tf019' => $tf019[$i],
				 'tf020' => $tf020[$i],'tf021' => $tf021[$i],'tf022' => $tf022[$i],'tf023' => $tf023[$i],'tf024' => $tf024[$i],'tf025' => $tf025[$i],
				 'tf026' => $tf026[$i],'tf027' => $tf027[$i],'tf028' => $tf028[$i],'tf029' => $tf029[$i],'tf030' => $tf030[$i],'tf031' => $tf031[$i],'tf032' => $tf032[$i],
				 'tf033' => $tf033[$i],'tf034' => $tf034[$i],'tf035' => $tf035[$i],'tf036' => $tf036[$i]
                ); 
				
             $this->db->insert('ipstf', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('te001o');    
	      $seq2=$this->input->post('te001c');
		  $seq3=$this->input->post('te002o');    
	      $seq4=$this->input->post('te002c');
	      $sql = " SELECT te001,te002,te039,te004,ma002 as te004disp,tf003,tf004,tf005,tf006,tf010,tf008,tf011,tf012 
		  FROM ipste as a,ipstf as b,copma as c WHERE te001=tf001 and te002=tf002 and te004=ma001 and te001 >= '$seq1'  AND te001 <= '$seq2' AND  te002 >= '$seq3'  AND te002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('te001o');    
	      $seq2=$this->input->post('te001c');
		  $seq3=$this->input->post('te002o');    
	      $seq4=$this->input->post('te002c');
	      $sql = " SELECT a.te001,a.te002,a.te039,a.te004,c.ma002 as te004disp,b.tf003,b.tf004,b.tf005,b.tf006,b.tf010,b.tf008,b.tf011,b.tf012
		  FROM ipste as a,ipstf as b,copma as c
		  WHERE te001=tf001 and te002=tf002 and te004=ma001 and te001 >= '$seq1'  AND te001 <= '$seq2' AND te002 >= '$seq3'  AND te002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
          $seq32 = "te001 >= '$seq1'  AND te001 <= '$seq2' AND te002 >= '$seq3'  AND te002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('ipste')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS te001disp, d.me002 AS te004disp, e.mb002 AS te010disp, f.mv002 AS te012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tf001, b.tf002, b.tf003, b.tf004, b.tf005,
		  b.tf006, b.tf007, b.tf011, b.tf009, b.tf017, b.tf018, b.tf012');
		 
        $this->db->from('ipste as a');	
        $this->db->join('ipstf as b', 'a.te001 = b.tf001  and a.te002=b.tf002 ','left');		
		$this->db->join('cmsmq as c', 'a.te001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.te004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.te010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.te012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.te001', $this->uri->segment(4)); 
	    $this->db->where('a.te002', $this->uri->segment(5)); 
		$this->db->order_by('te001 , te002 ,b.tf003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tf001', $this->uri->segment(4));
		$this->db->where('tf002', $this->uri->segment(5));
	    $query = $this->db->get('ipstf');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS te001disp, d.mb002 AS te007disp,e.mf002 AS te008disp, f.mv002 AS te006disp,g.na003 AS te014disp,
		  ,h.ma002 AS te004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tf001, b.tf002, b.tf003, b.tf004, b.tf005,
		  b.tf006, b.tf007, b.tf008, b.tf009, b.tf010, b.tf011, b.tf012,b.tf013, b.tf014,b.tf016,b.tf020,b.tf030,b.tf031,i.mc002 as tf007disp,j.me002 as te005disp');
		 
        $this->db->from('ipste as a');	
        $this->db->join('ipstf as b', 'a.te001 = b.tf001  and a.te002=b.tf002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.te001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.te007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.te008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.te006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.te014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.te004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tf007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.te005 = j.me001 ','left');   //部門	
		$this->db->where('a.te001', $this->input->post('te001o')); 
	    $this->db->where('a.te002 >= '.$this->input->post('te002o').' and a.te002 <= '.$this->input->post('te002c')); 
		$this->db->order_by('te001 , te002 ,b.tf003');
		
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
          $this->db->select('a.* ,c.mq002 AS te001disp, d.mb002 AS te007disp,e.mf002 AS te008disp, f.mv002 AS te006disp,g.na003 AS te014disp,
		  ,h.ma002 AS te004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tf001, b.tf002, b.tf003, b.tf004, b.tf005,
		  b.tf006, b.tf007, b.tf008, b.tf009, b.tf010, b.tf011, b.tf012,b.tf013, b.tf014,b.tf016,b.tf020,b.tf030,b.tf031,i.mc002 as tf007disp,j.me002 as te005disp');
		 
        $this->db->from('ipste as a');	
        $this->db->join('ipstf as b', 'a.te001 = b.tf001  and a.te002=b.tf002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.te001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.te007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.te008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.te006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.te014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.te004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tf007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.te005 = j.me001 ','left');   //部門
		$this->db->where('a.te001', $this->uri->segment(4)); 
	    $this->db->where('a.te002', $this->uri->segment(5)); 
		$this->db->order_by('te001 , te002 ,b.tf003');
		
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
			//substr($this->input->post('te003'),0,4).substr($this->input->post('te003'),5,2).substr(rtrim($this->input->post('te003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $te002=$this->input->post('te002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			 preg_match_all('/\d/S',$this->input->post('te002'), $matches);  //處理日期字串
			 $te002 = implode('',$matches[0]);
			   
			 $te001=$this->input->post('te001');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'te002' => $te002,
				 'te003' => $this->input->post('te003'),
		         'te004' => $this->input->post('te004')
                );
            $this->db->where('te001', $te001); //單別
            $this->db->update('ipste',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('tf001', $te001);
					$this->db->delete('ipstf'); //刪除明細 1060809
		   
			foreach($order_product as $key => $val){
				extract($val);
				if($this->seldetail($te001,$val['tf002'],$val['tf003'],$val['tf004'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="tf001"&&$k!="tf005disp"){//主鍵不用更改以及其他外來鍵庫別名稱 tf013日期等別處理
							$data[$k] = $v;
						}
					}
					$this->db->where('tf001', $te001);
					$this->db->where('tf002', $tf002);
					$this->db->where('tf003', $tf003);
					$this->db->where('tf004', $tf004);
					$this->db->update('ipstf',$data);//更改一筆
				}else{
					if($val['tf002'] && $val['tf003'] && $val['tf004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tf001' => $te001
						);
						foreach($val as $k=>$v){
							if($k!="tf001"&&$k!="tf005disp"){//主鍵不用更改以及其他外來鍵庫別名稱
								$data[$k] = $v;
							}
						}
						$this->db->insert('ipstf', $data);
					}
				}
				
			}
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3,$seg4)    
        { 	
			$this->db->where('tf001', $seg1);
			$this->db->where('tf002', $seg2);
	        $this->db->where('tf003', $seg3);
			$this->db->where('tf004', $seg4);
	        $query = $this->db->get('ipstf');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('te001', $this->uri->segment(4));
		  $this->db->where('te002', $this->uri->segment(5));
          $this->db->delete('ipste'); 
		  $this->db->where('tf001', $this->uri->segment(4));
		  $this->db->where('tf002', $this->uri->segment(5));
          $this->db->delete('ipstf'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('tf001', $seg1);
	      $this->db->where('tf002', $seg2);
	      $this->db->where('tf003', $seg3);
          $this->db->delete('ipstf'); 
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
					$query6c = $this->db->query("SELECT UPPER(tf016) as tf0161 FROM ipstf WHERE tf001='$seq1' AND tf002='$seq2' AND ( UPPER(tf016)='Y' or tf009>0 ) ");         
                    foreach ($query6c->result() as $row)
                          {
                            $tf0161[]=$row->tf0161;		 
                          }
                         if(isset($tf0161[0])) {
	                         $vtf0161=$tf0161[0];
                                                 }
	                     else 
                            { $vtf0161='N'; }    //結案碼
						
						
				if ($vtf0161 != 'Y') {	  
			      $this->db->where('te001', $seq1);
			      $this->db->where('te002', $seq2);
                  $this->db->delete('ipste'); 
				  $this->db->where('tf001', $seq1);
			      $this->db->where('tf002', $seq2);
				  $this->db->delete('ipstf'); $this->session->set_userdata('msg1',"未出貨已刪除"); }
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
		$this->db->where('tf001', $_POST['del_md001']);
		$this->db->where('tf002', $_POST['del_md002']);
		$this->db->where('tf003', $_POST['del_md003']);
		$this->db->delete('ipstf');
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
	function check_title_no($ipsi06,$te008){
		preg_match_all('/\d/S',$te008, $matches);  //處理日期字串
		$te008 = implode('',$matches[0]);
		//echo var_dump($te070);exit;
		
		$this->db->select('MAX(te002) as max_no')
			->from('ipste')
			->where('te001', $ipsi06)
			->where('te008', $te008);
		//	->like('te070', $te070, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		//echo var_dump($te001.$te070);exit;
		
	    if (!$result[0]->max_no){return $te008."001";}
		
		return $result[0]->max_no+1;
	}
	function check_vno_no(){
	
		$this->db->select('MAX(id) as max_no')
			->from('invoice');
		//	->where('te039', $te039);
		//	->like('te039', $te039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	   // if (!$result[0]->max_no){return $te039."001";}
		
		return $result[0]->max_no;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>