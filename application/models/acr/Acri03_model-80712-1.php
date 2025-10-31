<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acri03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tc001, tc002, tc003, tc004, tc0016, tc0011,tc015, create_date');
          $this->db->from('acrtc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tc001 desc, tc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('acrtc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'b.ma002','tc003', 'tc004','tc004disp',  'tc011','tc012','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tc001, a.tc002,b.ma002, a.tc003, a.tc004,b.ma002 as tc004disp, a.tc011, a.tc012,a.create_date')
	                       ->from('acrtc as a')
						   ->join('copma as b', 'a.tc004 = b.ma001 ','left')	
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('acrtc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢 table 表所有資料	 
	function construct_sql($limit = 15, $offset = 0, $func = "",$sma001)
	{
		$this->session->set_userdata('acri03_search',"display_search/".$offset);
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
		$default_order = "tc001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['acri03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['acri03']['search']['where'];
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
		
		if(isset($_SESSION['acri03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['acri03']['search']['order'];
		}
		
		if(!isset($_SESSION['acri03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('b.td001, b.td002, b.td003, b.create_date')
			->from('acrtc as a')
			->join('acrtd as b','a.tc001 = b.td001 AND a.tc002 = b.td002','left')
			->order_by($order);
		$query->where('a.tc004',$sma001);
		if($where){
			$query->where($where);
		}
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('b.td001, b.td002, b.td003, b.create_date')
			->from('acrtc as a')
			->join('acrtd as b','a.tc001 = b.td001 AND a.tc002 = b.td002','left')
			->order_by($order)
			->limit($limit, $offset);
		$query->where('a.tc004',$sma001);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['acri03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('acrtc as a')
			->join('acrtd as b','a.tc001 = b.td001 AND a.tc002 = b.td002','left');
		$query->where('a.tc004',$sma001);
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['acri03']['search']['where'] = $where;
		$_SESSION['acri03']['search']['order'] = $order;
		$_SESSION['acri03']['search']['offset'] = $offset;
		
		return $ret;
	}	
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp,f.ml002 as tc015disp, i.ma003 as td008disp,g.mf002 as td010disp,
		  h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017,b.td018,b.td019,b.td020,b.td021 ');
		 
        $this->db->from('acrtc as a');	
        $this->db->join('acrtd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="63" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc010 = d.mb001 ','left');  //廠別
		$this->db->join('cmsmf as e', 'a.tc005 = e.mf001 ','left');  //幣別
		$this->db->join('cmsml as f', 'a.tc015 = f.ml001 ','left');  //收款業務員
		$this->db->join('cmsmf as g', 'b.td010 = g.mf001 ','left');  //幣別明細
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('actma as i', 'b.td008 = i.ma001 ','left');   //科目代號
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 結帳單	 TA027!='Y'  ta0291,ta031,ta0292,ta0411
	//結帳單 來源單別,單號,幣別, 匯率, abs立帳應收金額, abs立帳餘額未收金額, 訂單單別,訂單單號,預計兌現日客戶代號,備註
	function lookup($keyword,$seq5){   
	
	     $this->db->select('ta001, ta002, ta009,ta010,abs(ta029+ta030) as ta0291,abs(ta029+ta030-ta031) as ta031,abs(ta029+ta030-ta031) as ta0292,abs(ta041+ta042-ta031) as ta0411,ta021,ta004,ta022');
	//  $this->db->select('ta001, ta002, ta008,ta004,ta009,(ta028+ta029) as ta0281');
	  $this->db->from('acrta ');
	  $this->db->where ('ta004', $seq5); 
      $this->db->where ('ta027 !=', 'Y'); 	  
      $this->db->like('ta001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ta002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//退貨
	function lookup2($keyword,$seq5){     
	   // $seq5=$this->uri->segment(5);
    //  $this->db->select('mb001, mb002, mb003,mb004,mb017,b.mc002 as mb017disp');
	   $this->db->select('tj001 as th001, tj002 as th002, tj003 as th003,tj004 as th004,tj010 as th019,
	   tj030 as th045,tj031 as th046,tj032 as th047,tj033 as th048,b.ti004 as tg005');
	  $this->db->from('purtj as a');
	  $this->db->join('purti as b', "a.tj001=b.ti001 and a.tj002=b.ti002 and b.ti004='$seq5'  ",'left'); 
	//  $this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ','left'); 
      $this->db->like('th001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('th002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 
	//ajax 下拉視窗查詢類 google 下拉 明細 會計科目
	function lookupa($keyword){     
      $this->db->select('ma001, ma003')->from('actma');  
      $this->db->like('ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ma003',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
	//ajax 查詢 顯示 請購單別 td001	
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
		
	
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('tc002');
		  $this->db->where('tc001', $this->uri->segment(4));
	      $this->db->where('tc017', $this->uri->segment(5));
		  $query = $this->db->get('acrtc');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `acrtc` ";
	      $seq1 = "tc001, tc002, tc003, tc004,tc007,tc008, tc011, tc012,tc016,tc015, create_date FROM `acrtc` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'tc001 desc' ;
          $seq9 = " ORDER BY tc001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="tc001 ";

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
		if(@$_SESSION['acri03_sql_term']){$seq32 = $_SESSION['acri03_sql_term'];}
		if(@$_SESSION['acri03_sql_sort']){$seq33 = $_SESSION['acri03_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'b.ma002','tc003', 'tc004', 'tc013', 'tc018','tc007','tc008','tc012','tc011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002,b.ma002, tc003, tc004, tc004,b.ma002 as tc004disp,tc007,tc008, tc011,tc012,tc016,tc015, a.create_date')
	                       ->from('acrtc as a')
						   ->join('copma as b', 'a.tc004 = b.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('acrtc')
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
	      $sort_columns = array('tc001', 'tc002', 'b.ma002','tc003', 'tc004', 'tc004disp', 'tc011','tc012','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	      $this->db->select('tc001, tc002,b.ma002, tc003, tc004,b.ma002 as  tc004disp, tc011,tc012, a.create_date');
	      $this->db->from('acrtc as a');
		  $this->db->join('copma as b', 'a.tc004 = b.ma001 ','left'); 
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tc001 asc, tc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('acrtc');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tc001', $this->input->post('acrq01a63'));
		  $this->db->where('tc002', $this->input->post('tc002'));
	      $query = $this->db->get('acrtc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('td001', $this->input->post('acrq01a63'));
		  $this->db->where('td002', $this->input->post('tc002'));
	      $query = $this->db->get('acrtd');
	      return $query->num_rows() ;
	    }  
    //查新增資料是否重複 (庫別)	
    function selone2d($seg1,$seg2)    
        {
	      $this->db->where('mc001', $seg1);
		  $this->db->where('mc002', $seg2);
	      $query = $this->db->get('invmc');
	      return $query->num_rows() ;
	    }  			
 		
	//新增一筆 檔頭  acrtc	
	function insertf()    //新增一筆 檔頭  acrtc
        {
		 //    $tax=round($this->input->post('tc019')*$this->input->post('tc026'));
		  //   if ($this->input->post('tc018')=='1') {$tc019=round($this->input->post('tc019')-$tax);}
		//	 if ($this->input->post('tc018')!='1') {$tc019=round($this->input->post('tc019'));}
		     $tc001=$this->input->post('acrq01a63');
			 $tc002=$this->input->post('tc002');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tc001' => $this->input->post('acrq01a63'),
		         'tc002' => $this->input->post('tc002'),
		         'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $this->input->post('copq01a'),
				 'tc005' => $this->input->post('cmsq06a'),
		         'tc006' => $this->input->post('tc006'),
                 'tc007' => $this->input->post('tc007'),
                 'tc008' => $this->input->post('tc008'),
                 'tc009' => 'N',
                 'tc010' => $this->input->post('cmsq02a'),		
                 'tc011' => $this->input->post('tc011'),		
                 'tc012' => $this->input->post('tc012'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('tc014'),
                 'tc015' => $this->input->post('cmsq09a31'),
                 'tc016' => $this->input->post('tc016'),
                 'tc017' =>  substr($this->input->post('tc017'),0,4).substr($this->input->post('tc017'),5,2).substr(rtrim($this->input->post('tc017')),8,2),
                 'tc018' => $this->input->post('tc018'),
				 'tc019' => $this->input->post('tc019')
                 
                );
         
	      $exist = $this->acri03_model->selone1($this->input->post('acrq01a63'),$this->input->post('tc002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('acrtc', $data);
			
		// 新增明細 acrtd
				//		$this->db->flush_cache(); 
            // 新增明細 acrtd  主檔 acrtc 重計算合計金額 數量
			    $tc011=0;$tc012=0;$tc013=0;$tc014=0;$tc022b=0;				
			    $n = '0';
				$td003='1000';
		
		
		if (!isset($_POST['order_product'][  $n  ]['td005']) ) { $n='250'; }  
		  
		//	while ($_POST['order_product'][  $n  ]['td004']) {		
		    while (isset($_POST['order_product'][  $n  ]['td005'])) {
			       if ($_POST['order_product'][ $n  ]['td009']>'') {$vtd009=substr($_POST['order_product'][ $n  ]['td009'],0,4).substr($_POST['order_product'][ $n  ]['td009'],5,2).substr($_POST['order_product'][ $n  ]['td009'],8,2);} else {$vtd009='';}
				 
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'td001' => $this->input->post('acrq01a63'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][  $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
				 'td008' =>  $_POST['order_product'][ $n  ]['td008'],		
				 'td009' => $vtd009,
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
				 'td013' =>  $_POST['order_product'][ $n  ]['td013'],
				 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				
                 'td015' =>  $_POST['order_product'][ $n  ]['td015'],
				 'td017' =>  $_POST['order_product'][ $n  ]['td017'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016']
				
				 
                );   
						 
	     // $exist = $this->acri03_model->selone1d($this->input->post('purq04a34'),$this->input->post('tc002'));
		  if ($_POST['order_product'][  $n  ]['td005'] >'0') {
		  $this->db->insert('acrtd', $data_array); }
		  
		    if ($_POST['order_product'][  $n  ]['td004'] =='1') {
		      $tc011=$tc011+$_POST['order_product'][ $n  ]['td014'];
			  $tc013=$tc013+$_POST['order_product'][ $n  ]['td015'];}
			else {  
			  $tc012=$tc012+$_POST['order_product'][ $n  ]['td014'];
			  $tc014=$tc014+$_POST['order_product'][ $n  ]['td015']; }
			  
			  $btd006=$_POST['order_product'][ $n  ]['td006'];
			  $etd007=$_POST['order_product'][ $n  ]['td007'];
			    $vtd015= $_POST['order_product'][ $n  ]['td015'];
			  //  $vtd013a= $_POST['order_product'][ $n  ]['td013a'];
			//    $vtd015a= $_POST['order_product'][ $n  ]['td015a'];
			  //結帳單 結帳碼N 改 Y ACRTA  TA027 已付 ta031
	$sql92 =" update acrta as c,(select td006,td007,ta027,td015 from acrtd as b,acrta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta027='N'
                ) d
               set c.ta027='Y',c.ta031=c.ta031+$vtd015
               where d.td006=c.ta001 and d.td007=c.ta002  " ; 
$this->db->query($sql92);
            //結一半Y改N
$sql921 =" update acrta as c,(select td006,td007,ta027,td015 from acrtd as b,acrta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta027='Y'
                ) d
               set c.ta027='N'
               where d.td006=c.ta001 and d.td007=c.ta002 and c.ta029+c.ta030 > c.ta031 " ; 
$this->db->query($sql921);
			  
		  	 $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
	          
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}			
			if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 acrtc
		  $sql = " UPDATE acrtc set tc011='$tc011',tc012='$tc012',tc013='$tc013',tc014='$tc014' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
		
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tc001', $this->input->post('tc001c')); 
          $this->db->where('tc002', $this->input->post('tc002c'));
	      $query = $this->db->get('acrtc');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('acrtc');
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
                $tc003=$row->tc003;$tc004=$row->tc004;$tc005=$row->tc005;$tc006=$row->tc006;$tc008=$row->tc008;$tc009=$row->tc009;$tc010=$row->tc010;
				$tc011=$row->tc011;$tc012=$row->tc012;$tc013=$row->tc013;$tc014=$row->tc014;$tc015=$row->tc015;$tc016=$row->tc016;
				$tc017=$row->tc017;$tc018=$row->tc018;$tc019=$row->tc019;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tc001c');    //主鍵一筆檔頭acrtc
			$seq2=$this->input->post('tc002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tc001' => $seq1,'tc002' => $seq2,'tc003' => $tc003,'tc004' => $tc004,'tc005' => $tc005,'tc006' => $tc006,'tc008' => $tc008,'tc009' => $tc009,'tc010' => $tc010,
		           'tc011' => $tc011,'tc012' => $tc012,'tc013' => $tc013,'tc014' => $tc014,'tc015' => $tc015,'tc016' => $tc016,'tc017' => $tc017,
				   'tc018' => $tc018,'tc019' => $tc019
				   );
				   
            $exist = $this->acri03_model->selone2($this->input->post('tc001c'),$this->input->post('tc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('acrtc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('td001', $this->input->post('tc001o'));
			$this->db->where('td002', $this->input->post('tc002o'));
	        $query = $this->db->get('acrtd');
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
                 $td003[$i]=$row->td003;$td004[$i]=$row->td004;$td005[$i]=$row->td005;$td006[$i]=$row->td006;$td007[$i]=$row->td007;
				 $td008[$i]=$row->td008;$td009[$i]=$row->td009;$td010[$i]=$row->td010;$td011[$i]=$row->td011;$td012[$i]=$row->td012;
				 $td013[$i]=$row->td013;$td014[$i]=$row->td014;$td015[$i]=$row->td015;$td016[$i]=$row->td016;$td017[$i]=$row->td017;
				 $td018[$i]=$row->td018;$td019[$i]=$row->td019;$td020[$i]=$row->td020;$td021[$i]=$row->td021;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tc001c');    //主鍵一筆明細acrtd
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
                'td001' => $seq1,'td002' => $seq2,'td003' => $td003[$i],'td004' => $td004[$i],'td005' => $td005[$i],'td006' => $td006[$i],'td007' => $td007[$i],
		         'td008' => $td008[$i],'td009' => $td009[$i],'td010' => $td010[$i],'td011' => $td011[$i],'td012' => $td012[$i],'td013' => $td013[$i],
				 'td014' => $td014[$i],'td015' => $td015[$i],'td016' => $td016[$i],'td017' => $td017[$i],'td018' => $td018[$i],'td019' => $td019[$i],
				 'td020' => $td020[$i],'td021' => $td021[$i]
                ); 
				
             $this->db->insert('acrtd', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tc001o');    
	      $seq2=$this->input->post('tc001c');
		  $seq3=$this->input->post('tc002o');    
	      $seq4=$this->input->post('tc002c');
	  //    $sql = " SELECT tc001,tc002,tc024,tc004,tc011,tc003,create_date FROM acrtc WHERE tc001 >= '$seq1'  AND tc001 <= '$seq2' AND  tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
     
	   $sql = " SELECT a.tc001,a.tc002,a.tc003,a.tc004,c.ma002 as tc004disp,b.td003,b.td004,b.td005,b.td006,b.td007,b.td008,
		  b.td014,b.td015,b.td017
		  FROM acrtc as a, acrtd as b,copma as c WHERE tc001=td001 and tc002=td002 and a.tc004=c.ma001 and tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tc001o');    
	      $seq2=$this->input->post('tc001c');
		  $seq3=$this->input->post('tc002o');    
	      $seq4=$this->input->post('tc002c');
	      $sql = " SELECT a.tc001,a.tc002,a.tc003,a.tc004,c.ma002 as tc004disp,b.td001,b.td002,b.td003,b.td004,b.td005,b.td006,b.td007,b.td008,b.td009,
		  b.td010,b.td011,b.td012,b.td014,b.td015,b.td018
		  FROM acrtc as a, acrtd as b,copma as c WHERE tc001=td001 and tc002=td002 and a.tc004=c.ma001 and  tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('acrtc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
        $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp,f.ml002 as tc015disp, i.ma003 as td008disp,g.mf002 as td010disp,
		  h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017,b.td018,b.td019,b.td020,b.td021 ');
		 
        $this->db->from('acrtc as a');	
        $this->db->join('acrtd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="63" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc010 = d.mb001 ','left');  //廠別
		$this->db->join('cmsmf as e', 'a.tc005 = e.mf001 ','left');  //幣別
		$this->db->join('cmsml as f', 'a.tc015 = f.ml001 ','left');  //收款業務員
		$this->db->join('cmsmf as g', 'b.td010 = g.mf001 ','left');  //幣別明細
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('actma as i', 'b.td008 = i.ma001 ','left');   //科目代號	
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('td001', $this->uri->segment(4));
		$this->db->where('td002', $this->uri->segment(5));
	    $query = $this->db->get('acrtd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆  一張 
	function printfc()   
      {           
         $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp,f.ml002 as tc015disp, i.ma003 as td008disp,g.mf002 as td010disp,
		  h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017,b.td018,b.td019,b.td020,b.td021 ');
		 
        $this->db->from('acrtc as a');	
        $this->db->join('acrtd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="63" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc010 = d.mb001 ','left');  //廠別
		$this->db->join('cmsmf as e', 'a.tc005 = e.mf001 ','left');  //幣別
		$this->db->join('cmsml as f', 'a.tc015 = f.ml001 ','left');  //收款業務員
		$this->db->join('cmsmf as g', 'b.td010 = g.mf001 ','left');  //幣別明細
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('actma as i', 'b.td008 = i.ma001 ','left');   //科目代號
		$this->db->where('a.tc001', $this->input->post('tc001o')); 
	    $this->db->where('a.tc002', $this->input->post('tc002o')); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
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
	//印單據筆  半張
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp,f.ml002 as tc015disp, i.ma003 as td008disp,g.mf002 as td010disp,
		  h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017,b.td018,b.td019,b.td020,b.td021 ');
		 
        $this->db->from('acrtc as a');	
        $this->db->join('acrtd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="63" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc010 = d.mb001 ','left');  //廠別
		$this->db->join('cmsmf as e', 'a.tc005 = e.mf001 ','left');  //幣別
		$this->db->join('cmsml as f', 'a.tc015 = f.ml001 ','left');  //收款業務員
		$this->db->join('cmsmf as g', 'b.td010 = g.mf001 ','left');  //幣別明細
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('actma as i', 'b.td008 = i.ma001 ','left');   //科目代號
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
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
		   //  $tax=round($this->input->post('tc019')*$this->input->post('tc026'));
		  //   if ($this->input->post('tc018')=='1') {$tc019=round($this->input->post('tc019')-$tax);}
			// if ($this->input->post('tc018')!='1') {$tc019=round($this->input->post('tc019'));}
			 $tc001=$this->input->post('acrq01a63');
			 $tc002=$this->input->post('tc002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,		       
		         'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $this->input->post('copq01a'),
				 'tc005' => $this->input->post('cmsq06a'),
		         'tc006' => $this->input->post('tc006'),
                 'tc007' => $this->input->post('tc007'),
                 'tc008' => $this->input->post('tc008'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('cmsq02a'),		
                 'tc011' => $this->input->post('tc011'),		
                 'tc012' => $this->input->post('tc012'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('tc014'),
                 'tc015' => $this->input->post('cmsq09a31'),
                 'tc016' => $this->input->post('tc016'),
                 'tc017' =>  substr($this->input->post('tc017'),0,4).substr($this->input->post('tc017'),5,2).substr(rtrim($this->input->post('tc017')),8,2),
                 'tc018' => $this->input->post('tc018'),
				 'tc019' => $this->input->post('tc019')
                 
                );
            $this->db->where('tc001', $this->input->post('acrq01a63'));
			$this->db->where('tc002', $this->input->post('tc002'));
            $this->db->update('acrtc',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('td001', $this->input->post('acrq01a63'));
			$this->db->where('td002', $this->input->post('tc002'));
            $this->db->delete('acrtd'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 acrtd  主檔 acrtc 重計算合計金額 數量
			    $tc011=0;$tc012=0;$tc013=0;$tc014=0;$tc022b=0;
			    $n = '0';		
				$td003='1000';
		//	while ($_POST['order_product'][  $n  ]['td004']) {
			while (isset($_POST['order_product'][  $n  ]['td005'])) {
				  if ($_POST['order_product'][ $n  ]['td009']>'') {$vtd009=substr($_POST['order_product'][ $n  ]['td009'],0,4).substr($_POST['order_product'][ $n  ]['td009'],5,2).substr($_POST['order_product'][ $n  ]['td009'],8,2);} else {$vtd009='';}
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'td001' => $this->input->post('acrq01a63'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][  $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
				 'td008' =>  $_POST['order_product'][ $n  ]['td008'],		
				 'td009' => $vtd009,
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
				 'td013' =>  $_POST['order_product'][ $n  ]['td013'],
				 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				
                 'td015' =>  $_POST['order_product'][ $n  ]['td015'],
				 'td017' =>  $_POST['order_product'][ $n  ]['td017'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016']
                );  
				
				 if ($_POST['order_product'][  $n  ]['td005']>'0' && $_POST['order_product'][  $n  ]['td005'] < 'c'  ) {
		     $this->db->insert('acrtd', $data_array); }
			if ($_POST['order_product'][  $n  ]['td004'] =='1') {
		      $tc011=$tc011+$_POST['order_product'][ $n  ]['td014'];
			  $tc013=$tc013+$_POST['order_product'][ $n  ]['td015'];}
			else {  
			  $tc012=$tc012+$_POST['order_product'][ $n  ]['td014'];
			  $tc014=$tc014+$_POST['order_product'][ $n  ]['td015']; }
			  
			   $btd006=$_POST['order_product'][ $n  ]['td006'];
			  $etd007=$_POST['order_product'][ $n  ]['td007'];
			   $vtd015= $_POST['order_product'][ $n  ]['td015'];
			//80127   $vtd015a= $_POST['order_product'][ $n  ]['td015a'];
			  $vtd015a=0;
			  //結帳單 結帳碼N 改 Y ACRTA  TA027
	$sql93 =" update acrta as c,(select td006,td007,ta027,td015 from acrtd as b,acrta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta027='N'
                ) d
               set c.ta027='Y',c.ta031=c.ta031+$vtd015-$vtd015a
               where d.td006=c.ta001 and d.td007=c.ta002  " ; 

$this->db->query($sql93);
	           //結一半Y改N
$sql921 =" update acrta as c,(select td006,td007,ta027,td015 from acrtd as b,acrta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta027='Y'
                ) d
               set c.ta027='N'
               where d.td006=c.ta001 and d.td007=c.ta002 and c.ta029+c.ta030 > c.ta031 " ; 
$this->db->query($sql921);		
			 $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['td004']) {
			  while (isset($_POST['order_product'][  $n  ]['td005'])) {
				    if ($_POST['order_product'][ $n  ]['td009']>'') {$vtd009=substr($_POST['order_product'][ $n  ]['td009'],0,4).substr($_POST['order_product'][ $n  ]['td009'],5,2).substr($_POST['order_product'][ $n  ]['td009'],8,2);} else {$vtd009='';}
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'td001' => $this->input->post('acrq01a63'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][  $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
				 'td008' =>  $_POST['order_product'][ $n  ]['td008'],		
				 'td009' => $vtd009,
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
				 'td013' =>  $_POST['order_product'][ $n  ]['td013'],
				 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				
                 'td015' =>  $_POST['order_product'][ $n  ]['td015'],
				 'td017' =>  $_POST['order_product'][ $n  ]['td017'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016']
                );   
				if ($_POST['order_product'][  $n  ]['td005'] > '0' && $_POST['order_product'][  $n  ]['td005'] < 'c'  ) {
			$this->db->insert('acrtd', $data_array);}
			if ($_POST['order_product'][  $n  ]['td004'] =='1') {
		      $tc011=$tc011+$_POST['order_product'][ $n  ]['td014'];
			  $tc013=$tc013+$_POST['order_product'][ $n  ]['td015'];}
			else {  
			  $tc012=$tc012+$_POST['order_product'][ $n  ]['td014'];
			  $tc014=$tc014+$_POST['order_product'][ $n  ]['td015']; }
			  
			   $btd006=$_POST['order_product'][ $n  ]['td006'];
			  $etd007=$_POST['order_product'][ $n  ]['td007'];
			  //結帳單 結帳碼N 改 Y ACRTA  TA027
	$sql94 =" update acrta as c,(select td006,td007,ta027,td015 from acrtd as b,acrta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta027='N'
                ) d
               set c.ta027='Y',c.ta031=td015
               where d.td006=c.ta001 and d.td007=c.ta002  " ; 

$this->db->query($sql94);
			  
			$mtd003 = (int) $td003+10;
			$td003 =  (string)$mtd003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 acrtc
		$sql = " UPDATE acrtc set tc011='$tc011',tc012='$tc012',tc013='$tc013',tc014='$tc014' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		 $query = $this->db->query($sql);
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tc001', $this->uri->segment(4));
		  $this->db->where('tc002', $this->uri->segment(5));
          $this->db->delete('acrtc'); 
		  $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('acrtd'); 
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
          $seq1='';
          $seq2='';			
	    if (!empty($_POST['selected'])) 
	         {
                 foreach($_POST['selected'] as $check) 
			    {
			      $seq[$x] = $check; 
		    	      list($seq1, $seq2) = explode("/", $seq[$x]);
					//    list($seq1) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
				//	 return true; 
			//由收款單找結帳單		  
				$query81 = $this->db->query("SELECT td006,td007   FROM acrtd as a 
		  WHERE td001='$seq1'  AND td002='$seq2' AND td007>'0'   ");         
	   foreach ($query81->result() as $row)
            {
               $td006[]=$row->td006;
               $td007[]=$row->td007;		 
            }
			 $i='0';
			while (isset($td007[$i])) {
		        $btd006=$td006[$i];
                $etd007=$td007[$i];
				  //結帳單 結帳碼Y 改 N ACRTA  TA027 減已付 ta031 
	$sql95 =" update acrta as c,(select td006,td007,ta027,td015 from acrtd as b,acrta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta027='Y'
                ) d
               set c.ta027='N',c.ta031=c.ta031-d.td015
               where d.td006=c.ta001 and d.td007=c.ta002  " ; 
			$this->db->query($sql95);   $num =  (int)$i + 1;
			 $i =  (string)$num; 
			  } 
	
			      $this->db->where('tc001', $seq1);
			      $this->db->where('tc002', $seq2);
                  $this->db->delete('acrtc'); 
				  $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
                  $this->db->delete('acrtd'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	   //選取刪除多筆   
	function delmutiftest()   
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
					  
			//由收款單找結帳單		  
				$query81 = $this->db->query("SELECT td006,td007   FROM acrtd as a 
		  WHERE td001='$seq1'  AND td002='$seq2' AND td007>'0'   ");         
	   foreach ($query81->result() as $row)
            {
               $td006[]=$row->td006;
               $td007[]=$row->td007;		 
            }
			 $i='0';
			while (isset($td007[$i])) {
		        $btd006=$td006[$i];
                $etd007=$td007[$i];
				  //結帳單 結帳碼Y 改 N ACRTA  TA027 減已付 ta031 
	$sql95 =" update acrta as c,(select td006,td007,ta027,td015 from acrtd as b,acrta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta027='Y'
                ) d
               set c.ta027='N',c.ta031=c.ta031-d.td015
               where d.td006=c.ta001 and d.td007=c.ta002  " ; 
			$this->db->query($sql95);   $num =  (int)$i + 1;
			 $i =  (string)$num; 
			  } 
	
			      $this->db->where('tc001', $seq1);
			      $this->db->where('tc002', $seq2);
                  $this->db->delete('acrtc'); 
				  $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
                  $this->db->delete('acrtd'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	  //ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword,$smb002){     
      $this->db->select('b.td001,b.td002,b.td003,b.create_date');
	  $this->db->from('acrtc as a');  
	  $this->db->join('acrtd as b','a.tc001 = b.td001 AND a.tc002 = b.td002','left');  
      $this->db->like('b.td001',urldecode(urldecode($this->uri->segment(4))),'after');
	  //$this->db->or_like('a.ma002',urldecode(urldecode($this->uri->segment(4))), 'after');
	  $this->db->where('a.tc004',$smb002);
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }    	
	
	//noti04.php
	function lookup3($keyword,$smb002){  
      $ma001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('b.td001,b.td002,b.td003,b.create_date');
	  $this->db->from('acrtc as a');  
	  $this->db->join('acrtd as b','a.tc001 = b.td001 AND a.tc002 = b.td002','left'); 
      $this->db->where('b.td001',$keyword);
      $this->db->where('a.tc004',$smb002);
	 // echo "<pre>";var_dump($this->db);exit;
      $query = $this->db->get(); 
      return $query->result();
    }  	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>