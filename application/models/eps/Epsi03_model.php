<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class epsi03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mb001, mb002, mb003, mb004, mb0011, mb0019,mb020, create_date');
          $this->db->from('epsmb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('epsmb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.mb001', 'a.mb002', 'a.mb003', 'a.mb004', 'a.mb011', 'a.mb019','a.mb030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.mb001, a.mb002, a.mb003, a.mb004, b.ma002,  a.mb029, a.mb030,a.create_date')
	                       ->from('epsmb as a')
						    ->join('copma as b', 'a.mb004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('epsmb');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('epsi03_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['epsi03']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mb001 asc,mb002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['epsi03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['epsi03']['search']['where'];
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
		
		if(isset($_SESSION['epsi03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['epsi03']['search']['order'];
		}
		
		if(!isset($_SESSION['epsi03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,b.mb002 as mb001disp,b.mb003 as mb001disp1')
	                       ->from('epsmb as a')
						   ->join('invmb as b', 'a.mb001 = b.mb001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,b.mb002 as mb001disp,b.mb003 as mb001disp1')
	                       ->from('epsmb as a')
						    ->join('invmb as b', 'a.mb001 = b.mb001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法回傳查詢字串
		$_SESSION['epsi03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('epsmb as a')
			->join('invmb as b', 'a.mb001 = b.mb001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['epsi03']['search']['where'] = $where;
		$_SESSION['epsi03']['search']['order'] = $order;
		$_SESSION['epsi03']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mb001","mb002"
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
		$_SESSION['epsi03']['search']['view'] = $view_array;
		$_SESSION['epsi03']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['epsi03']['search']['view']);exit;
	}
	
	//查詢一筆 修改用   
	function selone($seg1, $seg2) {
		$this->db->select('a.mb001,a.mb002,a.mb003,a.mb004,a.mb005,b.*,
		                   c.mb002 as mb001disp, c.mb003 as mb001disp1
		                ');
		 
        $this->db->from('epsmb as a');	
        $this->db->join('epsmc as b', 'a.mb001 = b.mc001  and a.mb002=b.mc002 ','left');	//單身	
		$this->db->join('invmb as c', 'a.mb001 = c.mb001  ','left');  //品號
		$this->db->where('a.mb001', $seg1); 
	    $this->db->where('a.mb002', $seg2); 
		$this->db->order_by('mb001 , mb002 ,b.mc003');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*')
			->from('epsmc as b')
			->where('b.mc001', $seg1)
			->where('b.mc002', $seg2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS mb001disp, d.mb002 AS mb007disp,e.mf002 AS mb008disp, f.mv002 AS mb006disp,g.na003 AS mb014disp,
		  ,h.ma002 AS mb004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mc001, b.mc002, b.mc003, b.mc004, b.mc005,
		  b.mc006, b.mc007, b.mc008, b.mc009, b.mc010, b.mc011, b.mc012,b.mc013, b.mc014,b.mc016,b.mc020,b.mc030,b.mc031,i.mc002 as mc007disp,j.me002 as mb005disp');
		 
        $this->db->from('epsmb as a');	
        $this->db->join('epsmc as b', 'a.mb001 = b.mc001  and a.mb002=b.mc002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mb007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mb008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mb006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mb014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mb004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.mc007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mb005 = j.me001 ','left');   //部門
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.mc003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('epsmb');  
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `epsmb` ";
	      $seq1 = "mb001, mb002, mb003, mb004, mb004 as mb004disp,mb005, mb006,mb007,mb08,mb010,mb011,mb012,mb029,mb030, create_date FROM `epsmb` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.mb001 desc' ;
          $seq9 = " ORDER BY a.mb001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.mb001 ";

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
		if(@$_SESSION['epsi03_sql_term']){$seq32 = $_SESSION['epsi03_sql_term'];}
		if(@$_SESSION['epsi03_sql_sort']){$seq33 = $_SESSION['epsi03_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004','mb004disp','b.ma002', 'mb005', 'mb006','mb007','mb008','mb010','mb011','mb012','mb019','mb027','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select(' a.*,e.mb002 as mb001disp,e.mb003 as mb001disp1')
	                       ->from('epsmb as a')
						   ->join('epsmc as b', 'a.mb001 = b.mc001 and a.mb002 = b.mc002' ,'left')
						   ->join('invmb as e', 'a.mb001 = e.mb001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('epsmb as a')
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
	      $sort_columns = array('a.mb001', 'a.mb002', 'a.mb003', 'a.mb004', 'b.ma002', 'a.mb029','a.mb030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否為 table
	      $this->db->select('a.mb001, a.mb002, a.mb003, a.mb004,b.ma002,  a.mb029,a.mb030, a.create_date');
	      $this->db->from('epsmb as a');
		  $this->db->join('copma as b', 'a.mb004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mb001 asc, mb002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('epsmb as a');
		  $this->db->join('copma as b', 'a.mb004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('mb001', $seg1);
		  $this->db->where('mb002', $seg2);
	      $query = $this->db->get('epsmb');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('mc001', $seg1);
		  $this->db->where('mc002', $seg2);
		  $this->db->where('mc003', $seg3);
	      $query = $this->db->get('epsmc');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  epsmb	
	function insertf()    //新增一筆 檔頭  epsmb
        {
		    //刪日期 / 符號
		    // preg_match_all('/\d/S',$this->input->post('mb003'), $matches);  //處理日期字串
			// $mb003 = implode('',$matches[0]);
			
			 $mb001=$this->input->post('mb001');
			 $mb002=$this->input->post('mb002');
			 $mb002no=$mb002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->epsi03_model->selone1($mb001,$mb002)>0){
				$mb002 = $this->check_title_no($mb001,$mb002);
				$mb002no=$mb002;
			}
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mb001' => $mb001,
		         'mb002' => $mb002,
		         'mb003' => $this->input->post('mb003'),
		         'mb004' => $this->input->post('mb004'),    
		         'mb005' => $this->input->post('mb005')
                 
                );
	    
             $this->db->insert('epsmb', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 epsmc  
		      $vmc003='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['mc003'] ){
				        extract($val);
						//preg_match_all('/\d/S',$mc024, $matches);  //處理日期字串
			            //$mc024 = implode('',$matches[0]);
						
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'mc001' => $mb001,
							'mc002' => $mb002
						);
						foreach($val as $k=>$v){
							if($k!="mc001"&&$k!="mc002"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="mc003") {$data[$k] = $vmc003;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('epsmc', $data);
					$mmc003 = (int) $vmc003+10;
			        $vmc003 =  (string)$mmc003;
				}
			}
		 }
	
    //自動列印	
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('sfci01'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
		      echo "<script>window.open('printbb/".$this->input->post('sfci01')."/".$this->input->post('mb002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('mb001', $this->input->post('mb001c')); 
          $this->db->where('mb002', $this->input->post('mb002c'));
	      $query = $this->db->get('epsmb');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('mb001', $this->input->post('mb001o'));
			$this->db->where('mb002', $this->input->post('mb002o'));
	        $query = $this->db->get('epsmb');
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
                $mb003=$row->mb003;$mb004=$row->mb004;$mb005=$row->mb005;$mb006=$row->mb006;$mb007=$row->mb007;$mb008=$row->mb008;$mb009=$row->mb009;$mb010=$row->mb010;
				$mb011=$row->mb011;$mb012=$row->mb012;$mb013=$row->mb013;$mb014=$row->mb014;$mb015=$row->mb015;$mb016=$row->mb016;
				$mb017=$row->mb017;$mb018=$row->mb018;$mb019=$row->mb019;$mb020=$row->mb020;$mb021=$row->mb021;$mb022=$row->mb022;
				$mb023=$row->mb023;$mb024=$row->mb024;$mb025=$row->mb025;$mb026=$row->mb026;$mb027=$row->mb027;$mb028=$row->mb028;
				$mb029=$row->mb029;$mb030=$row->mb030;$mb031=$row->mb031;$mb032=$row->mb032;$mb033=$row->mb033;$mb034=$row->mb034;
				$mb035=$row->mb035;$mb036=$row->mb036;$mb037=$row->mb037;$mb038=$row->mb038;$mb039=$row->mb039;$mb040=$row->mb040;$mb041=$row->mb041;
				$mb042=$row->mb042;$mb043=$row->mb043;$mb044=$row->mb044;$mb045=$row->mb045;$mb046=$row->mb046;$mb047=$row->mb047;
				$mb048=$row->mb048;$mb049=$row->mb049;$mb050=$row->mb050;$mb051=$row->mb051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mb001c');    //主鍵一筆檔頭epsmb
			$seq2=$this->input->post('mb002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mb001' => $seq1,'mb002' => $seq2,'mb003' => $mb003,'mb004' => $mb004,'mb005' => $mb005,'mb006' => $mb006,'mb007' => $mb007,'mb008' => $mb008,'mb009' => $mb009,'mb010' => $mb010,
		           'mb011' => $mb011,'mb012' => $mb012,'mb013' => $mb013,'mb014' => $mb014,'mb015' => $mb015,'mb016' => $mb016,'mb017' => $mb017,
				   'mb018' => $mb018,'mb019' => $mb019,'mb020' => $mb020,'mb021' => $mb021,'mb022' => $mb022,'mb023' => $mb023,'mb024' => $mb024,
				   'mb025' => $mb025,'mb026' => $mb026,'mb027' => $mb027,'mb028' => $mb028,'mb029' => $mb029,'mb030' => $mb030,
				   'mb031' => $mb031,'mb032' => $mb032,'mb033' => $mb033,'mb034' => $mb034,'mb035' => $mb035,'mb036' => $mb036,
				   'mb037' => $mb037,'mb038' => $mb038,'mb039' => $mb039,'mb040' => $mb040,'mb041' => $mb041,'mb042' => $mb042,
				   'mb043' => $mb043,'mb044' => $mb044,'mb045' => $mb045,'mb046' => $mb046,'mb047' => $mb047,'mb048' => $mb048,
				   'mb049' => $mb049,'mb050' => $mb050,'mb051' => $mb051
                   );
				   
            $exist = $this->epsi03_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('epsmb', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('mc001', $this->input->post('mb001o'));
			$this->db->where('mc002', $this->input->post('mb002o'));
	        $query = $this->db->get('epsmc');
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
                 $mc003[$i]=$row->mc003;$mc004[$i]=$row->mc004;$mc005[$i]=$row->mc005;$mc006[$i]=$row->mc006;$mc007[$i]=$row->mc007;
				 $mc008[$i]=$row->mc008;$mc009[$i]=$row->mc009;$mc010[$i]=$row->mc010;$mc011[$i]=$row->mc011;$mc012[$i]=$row->mc012;
				 $mc013[$i]=$row->mc013;$mc014[$i]=$row->mc014;$mc015[$i]=$row->mc015;$mc016[$i]=$row->mc016;$mc017[$i]=$row->mc017;
				 $mc018[$i]=$row->mc018;$mc019[$i]=$row->mc019;$mc020[$i]=$row->mc020;$mc021[$i]=$row->mc021;$mc022[$i]=$row->mc022;
			     $mc023[$i]=$row->mc023;$mc024[$i]=$row->mc024;$mc025[$i]=$row->mc025;$mc026[$i]=$row->mc026;$mc027[$i]=$row->mc027;
				 $mc028[$i]=$row->mc028;$mc029[$i]=$row->mc029;$mc030[$i]=$row->mc030;$mc031[$i]=$row->mc031;$mc032[$i]=$row->mc032;
				 $mc033[$i]=$row->mc033;$mc034[$i]=$row->mc034;$mc035[$i]=$row->mc035;$mc036[$i]=$row->mc036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('mb001c');    //主鍵一筆明細epsmc
			$seq2=$this->input->post('mb002c'); 
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
                'mc001' => $seq1,'mc002' => $seq2,'mc003' => $mc003[$i],'mc004' => $mc004[$i],'mc005' => $mc005[$i],'mc006' => $mc006[$i],'mc007' => $mc007[$i],
		         'mc008' => $mc008[$i],'mc009' => $mc009[$i],'mc010' => $mc010[$i],'mc011' => $mc011[$i],'mc012' => $mc012[$i],'mc013' => $mc013[$i],
				 'mc014' => $mc014[$i],'mc015' => $mc015[$i],'mc016' => $mc016[$i],'mc017' => $mc017[$i],'mc018' => $mc018[$i],'mc019' => $mc019[$i],
				 'mc020' => $mc020[$i],'mc021' => $mc021[$i],'mc022' => $mc022[$i],'mc023' => $mc023[$i],'mc024' => $mc024[$i],'mc025' => $mc025[$i],
				 'mc026' => $mc026[$i],'mc027' => $mc027[$i],'mc028' => $mc028[$i],'mc029' => $mc029[$i],'mc030' => $mc030[$i],'mc031' => $mc031[$i],'mc032' => $mc032[$i],
				 'mc033' => $mc033[$i],'mc034' => $mc034[$i],'mc035' => $mc035[$i],'mc036' => $mc036[$i]
                ); 
				
             $this->db->insert('epsmc', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mb001o');    
	      $seq2=$this->input->post('mb001c');
		  $seq3=$this->input->post('mb002o');    
	      $seq4=$this->input->post('mb002c');
	      $sql = " SELECT mb001,mb002,mb039,mb004,ma002 as mb004disp,mc003,mc004,mc005,mc006,mc010,mc008,mc011,mc012 
		  FROM epsmb as a,epsmc as b,copma as c WHERE mb001=mc001 and mb002=mc002 and mb004=ma001 and mb001 >= '$seq1'  AND mb001 <= '$seq2' AND  mb002 >= '$seq3'  AND mb002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('mb001o');    
	      $seq2=$this->input->post('mb001c');
		  $seq3=$this->input->post('mb002o');    
	      $seq4=$this->input->post('mb002c');
	      $sql = " SELECT a.mb001,a.mb002,a.mb039,a.mb004,c.ma002 as mb004disp,b.mc003,b.mc004,b.mc005,b.mc006,b.mc010,b.mc008,b.mc011,b.mc012
		  FROM epsmb as a,epsmc as b,copma as c
		  WHERE mb001=mc001 and mb002=mc002 and mb004=ma001 and mb001 >= '$seq1'  AND mb001 <= '$seq2' AND mb002 >= '$seq3'  AND mb002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
          $seq32 = "mb001 >= '$seq1'  AND mb001 <= '$seq2' AND mb002 >= '$seq3'  AND mb002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('epsmb')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS mb001disp, d.me002 AS mb004disp, e.mb002 AS mb010disp, f.mv002 AS mb012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mc001, b.mc002, b.mc003, b.mc004, b.mc005,
		  b.mc006, b.mc007, b.mc011, b.mc009, b.mc017, b.mc018, b.mc012');
		 
        $this->db->from('epsmb as a');	
        $this->db->join('epsmc as b', 'a.mb001 = b.mc001  and a.mb002=b.mc002 ','left');		
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mb004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mb010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mb012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.mc003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mc001', $this->uri->segment(4));
		$this->db->where('mc002', $this->uri->segment(5));
	    $query = $this->db->get('epsmc');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS mb001disp, d.mb002 AS mb007disp,e.mf002 AS mb008disp, f.mv002 AS mb006disp,g.na003 AS mb014disp,
		  ,h.ma002 AS mb004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mc001, b.mc002, b.mc003, b.mc004, b.mc005,
		  b.mc006, b.mc007, b.mc008, b.mc009, b.mc010, b.mc011, b.mc012,b.mc013, b.mc014,b.mc016,b.mc020,b.mc030,b.mc031,i.mc002 as mc007disp,j.me002 as mb005disp');
		 
        $this->db->from('epsmb as a');	
        $this->db->join('epsmc as b', 'a.mb001 = b.mc001  and a.mb002=b.mc002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mb007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mb008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mb006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mb014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mb004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.mc007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mb005 = j.me001 ','left');   //部門	
		$this->db->where('a.mb001', $this->input->post('mb001o')); 
	    $this->db->where('a.mb002 >= '.$this->input->post('mb002o').' and a.mb002 <= '.$this->input->post('mb002c')); 
		$this->db->order_by('mb001 , mb002 ,b.mc003');
		
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
          $this->db->select('a.* ,c.mq002 AS mb001disp, d.mb002 AS mb007disp,e.mf002 AS mb008disp, f.mv002 AS mb006disp,g.na003 AS mb014disp,
		  ,h.ma002 AS mb004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mc001, b.mc002, b.mc003, b.mc004, b.mc005,
		  b.mc006, b.mc007, b.mc008, b.mc009, b.mc010, b.mc011, b.mc012,b.mc013, b.mc014,b.mc016,b.mc020,b.mc030,b.mc031,i.mc002 as mc007disp,j.me002 as mb005disp');
		 
        $this->db->from('epsmb as a');	
        $this->db->join('epsmc as b', 'a.mb001 = b.mc001  and a.mb002=b.mc002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mb007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mb008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mb006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mb014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mb004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.mc007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mb005 = j.me001 ','left');   //部門
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.mc003');
		
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
			//substr($this->input->post('mb003'),0,4).substr($this->input->post('mb003'),5,2).substr(rtrim($this->input->post('mb003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $mb002=$this->input->post('mb002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			//preg_match_all('/\d/S',$this->input->post('mb003'), $matches);  //處理日期字串
			// $mb003 = implode('',$matches[0]);
			
			   
			 $mb001=$this->input->post('mb001');
			 $mb002=$this->input->post('mb002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'mb003' => $this->input->post('mb003'),
		         'mb004' => $this->input->post('mb004'),    
		         'mb005' => $this->input->post('mb005')
                );
            $this->db->where('mb001', $mb001); //單別
			$this->db->where('mb002', $mb002);
            $this->db->update('epsmb',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('mc001', $mb001);
					$this->db->where('mc002', $mb002);
					$this->db->delete('epsmc'); //刪除明細 1060809
					
		    $vmc003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				    //   preg_match_all('/\d/S',$mc024, $matches);  //處理日期字串
			        //    $mc024 = implode('',$matches[0]);
				
				if($this->seldetail($mb001,$mb002,$val['mc003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="mc001"&&$k!="mc002"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="mc003") {$data[$k] = $vmc003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('mc001', $mb001);
					$this->db->where('mc002', $mb002);
					$this->db->where('mc003', $mc003);
					$this->db->update('epsmc',$data);//更改一筆
				//	$mmc003 = (int) $vmc003+10;
			     //   $vmc003 =  (string)$mmc003;
				}else{
					if($val['mc003'] ){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,							
							'mc001' => $mb001,
							'mc002' => $mb002
						);
						foreach($val as $k=>$v){
							if($k!="mc001"&&$k!="mc002"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="mc003") {$data[$k] = $vmc003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('epsmc', $data);
					//	$mmc003 = (int) $vmc003+10;
			         //   $vmc003 =  (string)$mmc003;
					}
				}
				
			}
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('mc001', $seg1);
			$this->db->where('mc002', $seg2);
	        $this->db->where('mc003', $seg3);
	        $query = $this->db->get('epsmc');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mb001', $this->uri->segment(4));
		  $this->db->where('mb002', $this->uri->segment(5));
          $this->db->delete('epsmb'); 
		  $this->db->where('mc001', $this->uri->segment(4));
		  $this->db->where('mc002', $this->uri->segment(5));
          $this->db->delete('epsmc'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('mc001', $seg1);
	      $this->db->where('mc002', $seg2);
	      $this->db->where('mc003', $seg3);
          $this->db->delete('epsmc'); 
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
					$query6c = $this->db->query("SELECT UPPER(mc016) as mc0161 FROM epsmc WHERE mc001='$seq1' AND mc002='$seq2' AND ( UPPER(mc016)='Y' or mc009>0 ) ");         
                    foreach ($query6c->result() as $row)
                          {
                            $mc0161[]=$row->mc0161;		 
                          }
                         if(isset($mc0161[0])) {
	                         $vmc0161=$mc0161[0];
                                                 }
	                     else 
                            { $vmc0161='N'; }    //結案碼
						
						
				if ($vmc0161 != 'Y') {	  
			      $this->db->where('mb001', $seq1);
			      $this->db->where('mb002', $seq2);
                  $this->db->delete('epsmb'); 
				  $this->db->where('mc001', $seq1);
			      $this->db->where('mc002', $seq2);
				  $this->db->delete('epsmc'); $this->session->set_userdata('msg1',"未出貨已刪除"); }
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
		$this->db->where('mc001', $_POST['del_md001']);
		$this->db->where('mc002', $_POST['del_md002']);
		$this->db->where('mc003', $_POST['del_md003']);
		$this->db->delete('epsmc');
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
	function check_title_no($sfci01,$mb008){
		preg_match_all('/\d/S',$mb008, $matches);  //處理日期字串
		$mb008 = implode('',$matches[0]);
		$this->db->select('MAX(mb002) as max_no')
			->from('epsmb')
			->where('mb001', $sfci01)
			->like('mb008', $mb008, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $mb008."001";}
		
		return $result[0]->max_no+1;
	}
	function check_vno_no(){
	
		$this->db->select('MAX(id) as max_no')
			->from('invoice');
		//	->where('mb039', $mb039);
		//	->like('mb039', $mb039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	   // if (!$result[0]->max_no){return $mb039."001";}
		
		return $result[0]->max_no;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>