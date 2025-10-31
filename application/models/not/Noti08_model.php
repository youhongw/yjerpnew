<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noti08_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tj001, tj002, tj003, tj004, tj0011, tj0019,tj020, create_date');
          $this->db->from('nottj');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tj001 desc, tj002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('nottj');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.tj001', 'a.tj002', 'a.tj003', 'a.tj004', 'a.tj011', 'a.tj019','a.tj030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tj001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tj001, a.tj002, a.tj003, a.tj004, b.ma002,  a.tj029, a.tj030,a.create_date')
	                       ->from('nottj as a')
						    ->join('copma as b', 'a.tj004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('nottj');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('noti08_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['noti08']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['noti08']['search']);}

		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tj002 desc,tj001 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['noti08']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['noti08']['search']['where'];
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
		
		if(isset($_SESSION['noti08']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['noti08']['search']['order'];
		}
		
		if(!isset($_SESSION['noti08']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.tj001,a.tj002,a.tj003,b.ma002,b.ma004,a.tj005,a.tj007,a.tj016,c.mc002,a.tj004,a.create_date')
	                       ->from('nottj as a')
						   ->join('notma as b', 'a.tj003 = b.ma001','left')
						   ->join('notmc as c', 'a.tj016 = c.mc001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.tj001,a.tj002,a.tj003,b.ma002,b.ma004,a.tj005,a.tj007,a.tj016,c.mc002,a.tj004,a.create_date')
	                       ->from('nottj as a')
						   ->join('notma as b', 'a.tj003 = b.ma001','left')
						   ->join('notmc as c', 'a.tj016 = c.mc001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['noti08']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('nottj as a')
			->join('notma as b', 'a.tj003 = b.ma001','left')
		    ->join('notmc as c', 'a.tj016 = c.mc001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['noti08']['search']['where'] = $where;
		$_SESSION['noti08']['search']['order'] = $order;
		$_SESSION['noti08']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"tj001","tj002"
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
		$_SESSION['noti08']['search']['view'] = $view_array;
		$_SESSION['noti08']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['noti08']['search']['view']);exit;
	}
	
	//查詢一筆 修改用   
	function selone($seg1) {
		$this->db->select('a.*,b.*,c.ma002 as tj003disp,c.ma004 as tj003disp1,d.ma003 as tj012disp,e.ma003 as tj018disp,
		                  f.mf002 as tj005disp,g.mc002 as tj016disp');
		 
        $this->db->from('nottj as a');	
        $this->db->join('notto as b', 'a.tj001 = b.to001 ','left');	//單身	
		$this->db->join('notma as c', 'a.tj003 = c.ma001 ','left');  //銀行代號 noti01
	    $this->db->join('actma as d', 'a.tj012 = d.ma001 ','left');    //科目代號1 acti03
		$this->db->join('actma as e', 'a.tj018 = e.ma001 ','left');    //科目代號2 acti03
		$this->db->join('cmsmf as f', 'a.tj005 = f.mf001 ','left');		//幣別1 cmsi06
		$this->db->join('notmc as g', 'a.tj016 = g.mc001 ','left');    //融資種類noti13
		$this->db->join('cmsmf as h', 'b.to004 = h.mf001 ','left');  //幣別2 cmsi06
		$this->db->where('a.tj001', $seg1); 
		$this->db->order_by('tj001 , b.to002');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*')
			->from('notto as b')
			->where('b.to001', $seg1);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS tj001disp, d.mb002 AS tj007disp,e.mf002 AS tj008disp, f.mv002 AS tj006disp,g.na003 AS tj014disp,
		  ,h.ma002 AS tj004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.to001, b.to002, b.to003, b.to004, b.to005,
		  b.to006, b.to007, b.to008, b.to009, b.to010, b.to011, b.to012,b.to013, b.to014,b.to016,b.to020,b.to030,b.to031,i.mc002 as to007disp,j.me002 as tj005disp');
		 
        $this->db->from('nottj as a');	
        $this->db->join('notto as b', 'a.tj001 = b.to001  and a.tj002=b.to002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tj007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tj008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tj006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tj014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tj004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.to007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tj005 = j.me001 ','left');   //部門
		$this->db->where('a.tj001', $this->uri->segment(4)); 
	    $this->db->where('a.tj002', $this->uri->segment(5)); 
		$this->db->order_by('tj001 , tj002 ,b.to003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('nottj');  
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `nottj` ";
	      $seq1 = "tj001, tj002, tj003, tj004, tj004 as tj004disp,tj005, tj006,tj007,tj08,tj010,tj011,tj012,tj029,tj030, create_date FROM `nottj` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.tj001 desc' ;
          $seq9 = " ORDER BY a.tj001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.tj001 ";

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
		if(@$_SESSION['noti08_sql_term']){$seq32 = $_SESSION['noti08_sql_term'];}
		if(@$_SESSION['noti08_sql_sort']){$seq33 = $_SESSION['noti08_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tj001', 'tj002', 'tj003', 'tj004','b.ma002', 'tj005', 'tj006','tj007','tj008','tj010','tj011','tj012','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tj001';  //檢查排序欄位是否在 table 內
	   //  $query = $this->db->select('tj001, tj002,b.ma002, tj003, tj004,tj004 as tj004disp, tj005, tj007,tj008,tj010,tj011,tj012, a.create_date')
	  //                     ->from('nottj as a')
	//					   ->join('notma as b', 'a.tj003 = b.ma001 ','left')  //銀行代號 noti01
		$query = $this->db->select('a.tj001,a.tj002,a.tj003,b.ma002,b.ma004,a.tj005,a.tj007,a.tj016,c.mc002,a.tj004,a.create_date')
	                       ->from('nottj as a')
						   ->join('notma as b', 'a.tj003 = b.ma001','left')
						   ->join('notmc as c', 'a.tj016 = c.mc001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('nottj as a')
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
	      $sort_columns = array('a.tj001', 'a.tj002', 'a.tj003', 'a.tj004', 'b.ma002', 'a.tj029','a.tj030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tj001';  //檢查排序欄位是否為 table
	      $this->db->select('a.tj001, a.tj002, a.tj003, a.tj004,b.ma002,  a.tj029,a.tj030, a.create_date');
	      $this->db->from('nottj as a');
		  $this->db->join('copma as b', 'a.tj004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tj001 asc, tj002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('nottj as a');
		  $this->db->join('copma as b', 'a.tj004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tj001', $seg1);
	      $query = $this->db->get('nottj');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2)    
        {
	      $this->db->where('to001', $seg1);
		  $this->db->where('to002', $seg2);
	      $query = $this->db->get('notto');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  nottj	
	function insertf()    //新增一筆 檔頭  nottj
        {
		    //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('tj002'), $matches);  //處理日期字串
			 $tj002 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tj004'), $matches);  //處理日期字串
			 $tj004 = implode('',$matches[0]);
			   
			 $tj001=$this->input->post('tj001');
			// $tj002=$this->input->post('tj002');
			/* $tj002no=$tj002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->noti08_model->selone1($tj001,$tj002)>0){
				$tj002 = $this->check_title_no($tj001,$tj039);
				$tj002no=$tj002;
			} */
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tj001' => $tj001,
		         'tj002' => $tj002,
		         'tj003' => $this->input->post('noti01'),    //銀行帳號
		         'tj004' => $tj004,    
		         'tj005' => $this->input->post('cmsi06'),     //幣別
                 'tj007' => $this->input->post('tj007'),    
                 'tj008' => $this->input->post('tj008'),   
                 'tj009' => $this->input->post('tj009'),
                 'tj010' => $this->input->post('tj010'),		
                 'tj011' => $this->input->post('tj011'),
                 'tj012' => $this->input->post('acti03'),   //借款科目
                 'tj013' => $this->input->post('tj013'),	
                 'tj014' => $this->input->post('tj014'),	
                 'tj015' => $this->input->post('tj015'),	
                 'tj016' => $this->input->post('noti13'),   //融資種類
                 'tj017' => $this->input->post('tj017'),	
                 'tj018' => $this->input->post('acti03a'),    //借款科目a
                 'tj019' => 0,	
                 'tj020' => 0
                 
                );
	    
             $this->db->insert('nottj', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 notto  
		      $vto002='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['to002'] && $val['to003']){
				        extract($val);
					/*	preg_match_all('/\d/S',$to013, $matches);  //處理日期字串
			            $to013 = implode('',$matches[0]); */
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'to001' => $tj001,
							'to002' => $tj002
						);
						foreach($val as $k=>$v){
							if($k!="to001" ){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="to002") {$data[$k] = $vto002;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('notto', $data);
					$mto002 = (int) $vto002+10;
			        $vto002 =  (string)$mto002;
				}
			}
		 }
	
    //自動列印	
	function auto_print(){
	 /*	$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('copi03'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
		      echo "<script>window.open('printbb/".$this->input->post('copi03')."/".$this->input->post('tj002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		} */
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tj001', $this->input->post('tj001c')); 
          $this->db->where('tj002', $this->input->post('tj002c'));
	      $query = $this->db->get('nottj');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tj001', $this->input->post('tj001o'));
			$this->db->where('tj002', $this->input->post('tj002o'));
	        $query = $this->db->get('nottj');
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
                $tj003=$row->tj003;$tj004=$row->tj004;$tj005=$row->tj005;$tj006=$row->tj006;$tj007=$row->tj007;$tj008=$row->tj008;$tj009=$row->tj009;$tj010=$row->tj010;
				$tj011=$row->tj011;$tj012=$row->tj012;$tj013=$row->tj013;$tj014=$row->tj014;$tj015=$row->tj015;$tj016=$row->tj016;
				$tj017=$row->tj017;$tj018=$row->tj018;$tj019=$row->tj019;$tj020=$row->tj020;$tj021=$row->tj021;$tj022=$row->tj022;
				$tj023=$row->tj023;$tj024=$row->tj024;$tj025=$row->tj025;$tj026=$row->tj026;$tj027=$row->tj027;$tj028=$row->tj028;
				$tj029=$row->tj029;$tj030=$row->tj030;$tj031=$row->tj031;$tj032=$row->tj032;$tj033=$row->tj033;$tj034=$row->tj034;
				$tj035=$row->tj035;$tj036=$row->tj036;$tj037=$row->tj037;$tj038=$row->tj038;$tj039=$row->tj039;$tj040=$row->tj040;$tj041=$row->tj041;
				$tj042=$row->tj042;$tj043=$row->tj043;$tj044=$row->tj044;$tj045=$row->tj045;$tj046=$row->tj046;$tj047=$row->tj047;
				$tj048=$row->tj048;$tj049=$row->tj049;$tj050=$row->tj050;$tj051=$row->tj051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tj001c');    //主鍵一筆檔頭nottj
			$seq2=$this->input->post('tj002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tj001' => $seq1,'tj002' => $seq2,'tj003' => $tj003,'tj004' => $tj004,'tj005' => $tj005,'tj006' => $tj006,'tj007' => $tj007,'tj008' => $tj008,'tj009' => $tj009,'tj010' => $tj010,
		           'tj011' => $tj011,'tj012' => $tj012,'tj013' => $tj013,'tj014' => $tj014,'tj015' => $tj015,'tj016' => $tj016,'tj017' => $tj017,
				   'tj018' => $tj018,'tj019' => $tj019,'tj020' => $tj020,'tj021' => $tj021,'tj022' => $tj022,'tj023' => $tj023,'tj024' => $tj024,
				   'tj025' => $tj025,'tj026' => $tj026,'tj027' => $tj027,'tj028' => $tj028,'tj029' => $tj029,'tj030' => $tj030,
				   'tj031' => $tj031,'tj032' => $tj032,'tj033' => $tj033,'tj034' => $tj034,'tj035' => $tj035,'tj036' => $tj036,
				   'tj037' => $tj037,'tj038' => $tj038,'tj039' => $tj039,'tj040' => $tj040,'tj041' => $tj041,'tj042' => $tj042,
				   'tj043' => $tj043,'tj044' => $tj044,'tj045' => $tj045,'tj046' => $tj046,'tj047' => $tj047,'tj048' => $tj048,
				   'tj049' => $tj049,'tj050' => $tj050,'tj051' => $tj051
                   );
				   
            $exist = $this->noti08_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('nottj', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('to001', $this->input->post('tj001o'));
			$this->db->where('to002', $this->input->post('tj002o'));
	        $query = $this->db->get('notto');
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
                 $to003[$i]=$row->to003;$to004[$i]=$row->to004;$to005[$i]=$row->to005;$to006[$i]=$row->to006;$to007[$i]=$row->to007;
				 $to008[$i]=$row->to008;$to009[$i]=$row->to009;$to010[$i]=$row->to010;$to011[$i]=$row->to011;$to012[$i]=$row->to012;
				 $to013[$i]=$row->to013;$to014[$i]=$row->to014;$to015[$i]=$row->to015;$to016[$i]=$row->to016;$to017[$i]=$row->to017;
				 $to018[$i]=$row->to018;$to019[$i]=$row->to019;$to020[$i]=$row->to020;$to021[$i]=$row->to021;$to022[$i]=$row->to022;
			     $to023[$i]=$row->to023;$to024[$i]=$row->to024;$to025[$i]=$row->to025;$to026[$i]=$row->to026;$to027[$i]=$row->to027;
				 $to028[$i]=$row->to028;$to029[$i]=$row->to029;$to030[$i]=$row->to030;$to031[$i]=$row->to031;$to032[$i]=$row->to032;
				 $to033[$i]=$row->to033;$to034[$i]=$row->to034;$to035[$i]=$row->to035;$to036[$i]=$row->to036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tj001c');    //主鍵一筆明細notto
			$seq2=$this->input->post('tj002c'); 
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
                'to001' => $seq1,'to002' => $seq2,'to003' => $to003[$i],'to004' => $to004[$i],'to005' => $to005[$i],'to006' => $to006[$i],'to007' => $to007[$i],
		         'to008' => $to008[$i],'to009' => $to009[$i],'to010' => $to010[$i],'to011' => $to011[$i],'to012' => $to012[$i],'to013' => $to013[$i],
				 'to014' => $to014[$i],'to015' => $to015[$i],'to016' => $to016[$i],'to017' => $to017[$i],'to018' => $to018[$i],'to019' => $to019[$i],
				 'to020' => $to020[$i],'to021' => $to021[$i],'to022' => $to022[$i],'to023' => $to023[$i],'to024' => $to024[$i],'to025' => $to025[$i],
				 'to026' => $to026[$i],'to027' => $to027[$i],'to028' => $to028[$i],'to029' => $to029[$i],'to030' => $to030[$i],'to031' => $to031[$i],'to032' => $to032[$i],
				 'to033' => $to033[$i],'to034' => $to034[$i],'to035' => $to035[$i],'to036' => $to036[$i]
                ); 
				
             $this->db->insert('notto', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tj001o');    
	      $seq2=$this->input->post('tj001c');
		  $seq3=$this->input->post('tj002o');    
	      $seq4=$this->input->post('tj002c');
	      $sql = " SELECT tj001,tj002,tj039,tj004,ma002 as tj004disp,to003,to004,to005,to006,to010,to008,to011,to012 
		  FROM nottj as a,notto as b,copma as c WHERE tj001=to001 and tj002=to002 and tj004=ma001 and tj001 >= '$seq1'  AND tj001 <= '$seq2' AND  tj002 >= '$seq3'  AND tj002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tj001o');    
	      $seq2=$this->input->post('tj001c');
		  $seq3=$this->input->post('tj002o');    
	      $seq4=$this->input->post('tj002c');
		  preg_match_all('/\d/S',$this->input->post('tj002o'), $matches);  //處理日期字串
			 $seq3 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('tj002c'), $matches);  //處理日期字串
			 $seq4 = implode('',$matches[0]); 
			 //  echo var_dump($seq3.$seq4);exit;
	      $sql = " SELECT a.*,b.*,c.ma002 as tj003disp
		  FROM nottj as a left join notto as b on tj001=to001 left join notma as c on tj003=ma001
		  WHERE tj001 >= '$seq1'  AND tj001 <= '$seq2' and tj002 >= '$seq3'  AND tj002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
		//  echo var_dump($query->result());exit;
		  
          $seq32 = "tj001 >= '$seq1'  AND tj001 <= '$seq2' AND tj002 >= '$seq3'  AND tj002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('nottj')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;
        //  echo var_dump($num[0]->count);exit;		  
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tj001disp, d.me002 AS tj004disp, e.mb002 AS tj010disp, f.mv002 AS tj012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.to001, b.to002, b.to003, b.to004, b.to005,
		  b.to006, b.to007, b.to011, b.to009, b.to017, b.to018, b.to012');
		 
        $this->db->from('nottj as a');	
        $this->db->join('notto as b', 'a.tj001 = b.to001  and a.tj002=b.to002 ','left');		
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tj004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tj010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tj012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tj001', $this->uri->segment(4)); 
	    $this->db->where('a.tj002', $this->uri->segment(5)); 
		$this->db->order_by('tj001 , tj002 ,b.to003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('to001', $this->uri->segment(4));
		$this->db->where('to002', $this->uri->segment(5));
	    $query = $this->db->get('notto');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS tj001disp, d.mb002 AS tj007disp,e.mf002 AS tj008disp, f.mv002 AS tj006disp,g.na003 AS tj014disp,
		  ,h.ma002 AS tj004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.to001, b.to002, b.to003, b.to004, b.to005,
		  b.to006, b.to007, b.to008, b.to009, b.to010, b.to011, b.to012,b.to013, b.to014,b.to016,b.to020,b.to030,b.to031,i.mc002 as to007disp,j.me002 as tj005disp');
		 
        $this->db->from('nottj as a');	
        $this->db->join('notto as b', 'a.tj001 = b.to001  and a.tj002=b.to002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tj007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tj008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tj006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tj014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tj004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.to007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tj005 = j.me001 ','left');   //部門	
		$this->db->where('a.tj001', $this->input->post('tj001o')); 
	    $this->db->where('a.tj002 >= '.$this->input->post('tj002o').' and a.tj002 <= '.$this->input->post('tj002c')); 
		$this->db->order_by('tj001 , tj002 ,b.to003');
		
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
          $this->db->select('a.* ,c.mq002 AS tj001disp, d.mb002 AS tj007disp,e.mf002 AS tj008disp, f.mv002 AS tj006disp,g.na003 AS tj014disp,
		  ,h.ma002 AS tj004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.to001, b.to002, b.to003, b.to004, b.to005,
		  b.to006, b.to007, b.to008, b.to009, b.to010, b.to011, b.to012,b.to013, b.to014,b.to016,b.to020,b.to030,b.to031,i.mc002 as to007disp,j.me002 as tj005disp');
		 
        $this->db->from('nottj as a');	
        $this->db->join('notto as b', 'a.tj001 = b.to001  and a.tj002=b.to002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tj007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tj008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tj006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tj014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tj004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.to007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tj005 = j.me001 ','left');   //部門
		$this->db->where('a.tj001', $this->uri->segment(4)); 
	    $this->db->where('a.tj002', $this->uri->segment(5)); 
		$this->db->order_by('tj001 , tj002 ,b.to003');
		
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
			//substr($this->input->post('tj003'),0,4).substr($this->input->post('tj003'),5,2).substr(rtrim($this->input->post('tj003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $tj002=$this->input->post('tj002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			 preg_match_all('/\d/S',$this->input->post('tj002'), $matches);  //處理日期字串
			 $tj002 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tj004'), $matches);  //處理日期字串
			 $tj004 = implode('',$matches[0]);
			   
			 $tj001=$this->input->post('tj001');
			// $tj002=$this->input->post('tj002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'tj002' => $tj002,
		         'tj003' => $this->input->post('noti01'),    //銀行帳號
		         'tj004' => $tj004,    
		         'tj005' => $this->input->post('cmsi06'),     //幣別  
                 'tj007' => $this->input->post('tj007'),    
                 'tj008' => $this->input->post('tj008'),   
                 'tj009' => $this->input->post('tj009'),
                 'tj010' => $this->input->post('tj010'),		
                 'tj011' => $this->input->post('tj011'),
                 'tj012' => $this->input->post('acti03'),   //借款科目
                 'tj013' => $this->input->post('tj013'),	
                 'tj014' => $this->input->post('tj014'),	
                 'tj015' => $this->input->post('tj015'),	
                 'tj016' => $this->input->post('noti13'),   //融資種類
                 'tj017' => $this->input->post('tj017'),	
                 'tj018' => $this->input->post('acti03a'),    //借款科目a
                 'tj019' => $this->input->post('tj019'),	
                 'tj020' => $this->input->post('tj020')
                );
            $this->db->where('tj001', $tj001); //借款批號
            $this->db->update('nottj',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('to001', $tj001);
					$this->db->delete('notto'); //刪除明細 1060809
					
		    $vto002='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				
				if($this->seldetail($tj001,$val['to002'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="to001"){//主鍵不用更改以及其他外來鍵庫別名稱 to013日期等別處理
							if($k=="to002") {$data[$k] = $vto002;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('to001', $tj001);
					$this->db->where('to002', $vto002);
					$this->db->update('notto',$data);//更改一筆
					$mto002 = (int) $vto002+10;
			        $vto002 =  (string)$mto002;
				}else{
					if($val['to002'] && $val['to003']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'to001' => $tj001
						);
						foreach($val as $k=>$v){
							if($k!="to001"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="to002") {$data[$k] = $vto002;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('notto', $data);
						$mto002 = (int) $vto002+10;
			            $vto002 =  (string)$mto002;
					}
				}
				
			}
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2)    
        { 	
			$this->db->where('to001', $seg1);
			$this->db->where('to002', $seg2);
	        $query = $this->db->get('notto');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tj001', $this->uri->segment(4));
          $this->db->delete('nottj'); 
		  $this->db->where('to001', $this->uri->segment(4));
          $this->db->delete('notto'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2)
        { 
	      $this->db->where('to001', $seg1);
	      $this->db->where('to002', $seg2);
          $this->db->delete('notto'); 
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
		    	      list($seq1) = explode("/", $seq[$x]);
		    	      $seq1;
						
				
			      $this->db->where('tj001', $seq1);
                  $this->db->delete('nottj'); 
				  $this->db->where('to001', $seq1);
				  $this->db->delete('notto'); $this->session->set_userdata('msg1',"已刪除");
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	  }  
	//刪除明細一筆新增修改時使用   
	function del_detail(){
		$this->db->where('to001', $_POST['del_md001']);
		$this->db->where('to002', $_POST['del_md002']);
		$this->db->delete('notto');
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
	function check_title_no($copi03,$tj039){
		preg_match_all('/\d/S',$tj039, $matches);  //處理日期字串
		$tj039 = implode('',$matches[0]);
		$this->db->select('MAX(tj002) as max_no')
			->from('nottj')
			->where('tj001', $copi03)
		//	->where('tj039', $tj039);
			->like('tj039', $tj039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $tj039."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>