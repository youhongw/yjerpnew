<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class palr35_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('yh001, yh002, yh003, yh004, yh0011, yh0019,yh020, create_date');
          $this->db->from('palyh');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('yh001 desc, yh002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('palyh');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('yh001', 'yh002', 'yh042', 'yh004', 'yh007', 'yh013','yh025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'yh001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('yh001, yh002, yh042, yh004, yh007, yh013, yh025,create_date')
	                       ->from('palyh')						   
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palyh');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		 $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門
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
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS yh001disp, d.mb002 AS yh010disp,e.mf002 AS yh011disp, g.na003 AS yh047disp,j.me002 as yh005disp,f.mv002 as yh006disp
		  ,h.ma002 AS yh004disp,k.mv002 as yh026disp,l.mv002 as yh035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mc002 as th007disp');
		 
        $this->db->from('palyh as a');	
        $this->db->join('copth as b', 'a.yh001 = b.th001  and a.yh002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.yh001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.yh010 = d.mb001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.yh011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.yh006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.yh033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.yh004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.yh005 = j.me001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.yh026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.yh035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.yh001', $this->uri->segment(4)); 
	    $this->db->where('a.yh002', $this->uri->segment(5)); 
		$this->db->order_by('yh001 , yh002 ,b.th003');
		$this->db->query('SET SQL_BIG_SELECTS=1');   //連結太多table 加此行
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004,mb017,b.mc002 as mb017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ','left'); 
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
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
	
		
	//ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('yh002');
		  $this->db->where('yh001', $this->uri->segment(4));
	      $this->db->where('yh042', $this->uri->segment(5));
		  $query = $this->db->get('palyh');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->yh002;
              }
		      return $result;   
		     }
	      }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `palyh` ";
	      $seq1 = "yh001, yh002, yh003, yh004, yh005, yh006,yh007,tg13,yh025,yh042, create_date FROM `palyh` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'yh001 desc' ;
          $seq9 = " ORDER BY yh001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="yh001 ";

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
	     $sort_columns = array('yh001', 'yh002', 'yh003', 'yh004', 'yh005', 'yh006','yh007','yh008','yh013','yh025','yh042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'yh001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('yh001, yh002, yh003, yh004, yh005, yh006,yh007,yh008,yh010,yh011,yh013,yh025,yh042, create_date')
	                       ->from('palyh')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palyh')
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
	      $sort_columns = array('yh001', 'yh002', 'yh003', 'yh005', 'yh021', 'yh031','yh019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'yh001';  //檢查排序欄位是否為 table
	      $this->db->select('yh001, yh002, yh003, yh005, yh021, yh031,yh019, create_date');
	      $this->db->from('palyh');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('yh001 asc, yh002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('palyh');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('yh001', $this->input->post('copq03a23'));
		  $this->db->where('yh002', $this->input->post('yh002'));
	      $query = $this->db->get('palyh');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('yh002'));
		  $this->db->where('th003', $seg3);
	      $query = $this->db->get('copth');
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
 	 //查新增資料是否輸入訂單訂號 
    function selone3d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $seg1);
		  $this->db->where('td002', $seg2);
		  $this->db->where('td003', $seg2);
	      $query = $this->db->get('coptd');
	      return $query->num_rows() ;
	    }  				
	//新增一筆 檔頭  palyh	
	function insertf()    //新增一筆 檔頭  palyh
        {
		 //    $tax=round($this->input->post('yh019')*$this->input->post('yh026'));
		  //   if ($this->input->post('yh018')=='1') {$yh019=round($this->input->post('yh019')-$tax);}
		//	 if ($this->input->post('yh018')!='1') {$yh019=round($this->input->post('yh019'));}
		 //營業稅率, 匯率  
		       $yh001=$this->input->post('copq03a23');
			   $yh002=$this->input->post('yh002');
			   $yh044=$this->input->post('yh044');
		 	   $yh012=$this->input->post('yh012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'yh001' => $this->input->post('copq03a23'),
		         'yh002' => $this->input->post('yh002'),
		         'yh003' => substr($this->input->post('yh003'),0,4).substr($this->input->post('yh003'),5,2).substr(rtrim($this->input->post('yh003')),8,2),
		         'yh004' => $this->input->post('copq01a'),
		         'yh005' => $this->input->post('cmsq05a'),
		         'yh006' => $this->input->post('cmsq09a3'),
                 'yh007' => $this->input->post('yh007'),
                 'yh008' => $this->input->post('yh008'),
                 'yh009' => $this->input->post('yh009'),
                 'yh010' => $this->input->post('cmsq02a'),	
                 'yh011' => strtoupper($this->input->post('cmsq06a')),
                 'yh012' => $this->input->post('yh012'),
                 'yh013' => $this->input->post('yh013'),	
                 'yh014' => $this->input->post('yh014'),	
                 'yh015' => $this->input->post('yh015'),	
                 'yh016' => $this->input->post('yh016'),
                 'yh017' => $this->input->post('yh017'),
                 'yh018' => $this->input->post('yh018'),
                 'yh019' => $this->input->post('yh019'),
                 'yh020' => $this->input->post('yh020'),
                 'yh021' => $this->input->post('yh021'),
				 'yh022' => $this->input->post('yh022'),
				 'yh023' => $this->input->post('yh023'),
                 'yh024' => $this->input->post('yh024'),
                 'yh025' => $this->input->post('yh025'),
                 'yh026' => $this->input->post('cmsq09a31'),
                 'yh027' => $this->input->post('yh027'),
                 'yh028' => $this->input->post('yh028'),
                 'yh029' => $this->input->post('yh029'),
                 'yh030' => $this->input->post('yh030'),
				 'yh031' => $this->input->post('yh031'),
				 'yh032' => $this->input->post('yh032'),
		         'yh033' => $this->input->post('cmsq21a1'),
				 'yh034' => $this->input->post('yh034'),
				 'yh035' => $this->input->post('cmsq09a32'),
		         'yh036' => $this->input->post('yh036'),
				 'yh037' => $this->input->post('yh037'),
				 'yh038' => substr($this->input->post('yh038'),0,4).substr($this->input->post('yh038'),5,2),
		         'yh039' => $this->input->post('yh039'),
				 'yh040' => $this->input->post('yh040'),
				 'yh041' => $this->input->post('yh041'),
		         'yh042' => substr($this->input->post('yh042'),0,4).substr($this->input->post('yh042'),5,2).substr(rtrim($this->input->post('yh042')),8,2),
				 'yh043' => $this->input->post('yh043'),
				 'yh044' => $this->input->post('yh044'),
				 'yh045' => $this->input->post('yh045'),
				 'yh046' => $this->input->post('yh046'),
				 'yh047' => $this->input->post('cmsq21a2'),
				 'yh048' => $this->input->post('yh048'),
				 'yh049' => $this->input->post('yh049'),
				 'yh050' => $this->input->post('yh050'),
                 'yh051' => $this->input->post('yh051'),
		         'yh052' => $this->input->post('yh052'),
				 'yh053' => $this->input->post('yh053'),
				 'yh054' => $this->input->post('yh054'),
				 'yh055' => $this->input->post('yh055'),
				 'yh056' => $this->input->post('yh056'),
				 'yh057' => $this->input->post('yh057'),
				 'yh058' => $this->input->post('yh058'),
				 'yh059' => $this->input->post('yh059'),
				 'yh060' => $this->input->post('yh060'),
                 'yh061' => $this->input->post('yh061')
                );
         
	      $exist = $this->palr35_model->selone1($this->input->post('copq03a23'),$this->input->post('yh002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('palyh', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 palyh  主檔 copth 重計算合計金額 數量 庫存數量
			    $yh013=0;$yh025=0;$yh033=0;$yh045=0;$yh046=0;$yh033b=0;	
			    $n = '0';
				$th003='1000';
		//前置單据		
		IF ($this->uri->segment(3)!='copybefore') {
		if (!isset($_POST['order_product'][  $n  ]['th004']) ) { $n='15'; } } 
		
		
		 if (!isset($_POST['order_product'][  $n  ]['th004']) ) { $n='15'; } 
		  
		//	while ($_POST['order_product'][  $n  ]['th004']) {		
		    while (isset($_POST['order_product'][  $n  ]['th004'])) {
			 
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'th001' => $this->input->post('copq03a23'),
		         'th002' => $this->input->post('yh002'),
		         'th003' =>  $th003,
		         'th004' => $_POST['order_product'][  $n  ]['th004'],
		         'th005' => $_POST['order_product'][ $n  ]['th005'],
		         'th006' => $_POST['order_product'][ $n  ]['th006'],
                 'th007' => $_POST['order_product'][ $n  ]['th007'],
                 'th008' =>  $_POST['order_product'][ $n  ]['th008'],
				 'th009' =>  $_POST['order_product'][ $n  ]['th009'],
				 'th012' =>  $_POST['order_product'][ $n  ]['th012'],
				 'th013' =>  $_POST['order_product'][ $n  ]['th013'],
                 'th014' =>  $_POST['order_product'][ $n  ]['th014'],
                 'th015' =>  $_POST['order_product'][ $n  ]['th015'],
			     'th016' =>  $_POST['order_product'][ $n  ]['th016'],
				 'th017' =>  $_POST['order_product'][ $n  ]['th017'],
				 'th018' =>  $_POST['order_product'][ $n  ]['th018'],
				 'th019' =>  $_POST['order_product'][ $n  ]['th019'],
				
				 'th030' =>  $_POST['order_product'][ $n  ]['th030'],
				 'th035' =>  $_POST['order_product'][ $n  ]['th035'],
				 'th036' =>  $_POST['order_product'][ $n  ]['th036'],
				 'th037' =>  $_POST['order_product'][ $n  ]['th037'],
				 'th038' =>  $_POST['order_product'][ $n  ]['th038']
				 
                );   
						 
	     $exist = $this->palr35_model->selone1d($this->input->post('copq03a23'),$this->input->post('yh002'),$th003);
		
		if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $existb = $this->palr35_model->selone3d($th014,$th015,$th016);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
				 'td009' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th015']!='') {
			 if ($existb){			  
         $sql = " UPDATE coptd set td009=td009+'$th008' WHERE td001 = '$th014'  AND td002 = '$th015'  AND td003 = '$th016' "; 
		 $query = $this->db->query($sql);	} 
			  }
		  //庫存增加減少 品號,庫別, 數量
			 $th004=$_POST['order_product'][ $n  ]['th004'];
			 $th007=$_POST['order_product'][ $n  ]['th007'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $exista = $this->palr35_model->selone2d($th004,$th007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $th004,
		         'mc002' => $th007,
				 'mc007' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$th008' WHERE mc001 = '$th004'  AND mc002 = '$th007'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			  
		  $yh013=$yh013+ $_POST['order_product'][ $n  ]['th035'];
		  $yh025=$yh025+ $_POST['order_product'][ $n  ]['th036'];
		  $yh045=$yh045+ $_POST['order_product'][ $n  ]['th037'];
		  $yh046=$yh046+ $_POST['order_product'][ $n  ]['th038'];
		  $yh033=$yh033+ $_POST['order_product'][ $n  ]['th008'];
			  
		  	 $mth003 = (int) $th003+10;
			 $th003 =  (string)$mth003;
	          
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}			
			
			
		  if ($exist)
			{
             return 'exist';
		    }
          	//重新計算貨款 coptc  幣別, 匯率整張計算
			    $yh025=round($yh013*$yh044,0);
		        if ($this->input->post('yh017')=='1') {$yh013=$yh013-$yh025;}
		        if ($this->input->post('yh017')>'1') {$yh013=$yh013;}
			  $yh045=round($yh013*$yh012,0);
			  $yh046=round($yh025*$yh012,0);
		  $sql = " UPDATE palyh set yh013='$yh013',yh025='$yh025',yh033='$yh033',yh045='$yh045',yh046='$yh046' WHERE yh001 = '$yh001'  AND yh002 = '$yh002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('yh001', $this->input->post('yh001c')); 
          $this->db->where('yh002', $this->input->post('yh002c'));
	      $query = $this->db->get('palyh');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('yh001', $this->input->post('yh001o'));
			$this->db->where('yh002', $this->input->post('yh002o'));
	        $query = $this->db->get('palyh');
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
                $yh003=$row->yh003;$yh004=$row->yh004;$yh005=$row->yh005;$yh006=$row->yh006;$yh007=$row->yh007;$yh008=$row->yh008;$yh009=$row->yh009;$yh010=$row->yh010;
				$yh011=$row->yh011;$yh012=$row->yh012;$yh013=$row->yh013;$yh014=$row->yh014;$yh015=$row->yh015;$yh016=$row->yh016;
				$yh017=$row->yh017;$yh018=$row->yh018;$yh019=$row->yh019;$yh020=$row->yh020;$yh021=$row->yh021;$yh022=$row->yh022;
				$yh023=$row->yh023;$yh024=$row->yh024;$yh025=$row->yh025;$yh026=$row->yh026;$yh027=$row->yh027;$yh028=$row->yh028;
				$yh029=$row->yh029;$yh030=$row->yh030;$yh031=$row->yh031;$yh032=$row->yh032;$yh033=$row->yh033;$yh034=$row->yh034;
				$yh035=$row->yh035;$yh036=$row->yh036;$yh037=$row->yh037;$yh038=$row->yh038;$yh039=$row->yh039;$yh040=$row->yh040;
				$yh041=$row->yh041;$yh042=$row->yh042;$yh043=$row->yh043;$yh044=$row->yh044;$yh045=$row->yh045;$yh046=$row->yh046;
				$yh047=$row->yh047;$yh048=$row->yh048;$yh049=$row->yh049;$yh050=$row->yh050;$yh051=$row->yh051;$yh052=$row->yh052;
				$yh053=$row->yh053;$yh054=$row->yh054;$yh055=$row->yh055;$yh056=$row->yh056;$yh057=$row->yh057;$yh058=$row->yh058;
				$yh059=$row->yh059;$yh060=$row->yh060;$yh061=$row->yh061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('yh001c');    //主鍵一筆檔頭palyh
			$seq2=$this->input->post('yh002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'yh001' => $seq1,'yh002' => $seq2,'yh003' => $yh003,'yh004' => $yh004,'yh005' => $yh005,'yh006' => $yh006,'yh007' => $yh007,'yh008' => $yh008,'yh009' => $yh009,'yh010' => $yh010,
		           'yh011' => $yh011,'yh012' => $yh012,'yh013' => $yh013,'yh014' => $yh014,'yh015' => $yh015,'yh016' => $yh016,'yh017' => $yh017,
				   'yh018' => $yh018,'yh019' => $yh019,'yh020' => $yh020,'yh021' => $yh021,'yh022' => $yh022,'yh023' => $yh023,'yh024' => $yh024,
				   'yh025' => $yh025,'yh026' => $yh026,'yh027' => $yh027,'yh028' => $yh028,'yh029' => $yh029,'yh030' => $yh030,
				   'yh031' => $yh031,'yh032' => $yh032,'yh033' => $yh033,'yh034' => $yh034,'yh035' => $yh035,'yh036' => $yh036,'yh037' => $yh037,
				   'yh038' => $yh038,'yh039' => $yh039,'yh040' => $yh040,'yh041' => $yh041,'yh042' => $yh042,'yh043' => $yh043,
				   'yh044' => $yh044,'yh045' => $yh045,'yh046' => $yh046,'yh047' => $yh047,'yh048' => $yh048,'yh049' => $yh049,'yh050' => $yh050,
				   'yh051' => $yh051,'yh052' => $yh052,'yh053' => $yh053,'yh054' => $yh054,'yh055' => $yh055,'yh056' => $yh056,'yh057' => $yh057,
				   'yh058' => $yh058,'yh059' => $yh059,'yh060' => $yh060,'yh061' => $yh061
                   );
				   
            $exist = $this->palr35_model->selone2($this->input->post('yh001c'),$this->input->post('yh002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('palyh', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('yh001o'));
			$this->db->where('th002', $this->input->post('yh002o'));
	        $query = $this->db->get('copth');
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
                 $th003[$i]=$row->th003;$th004[$i]=$row->th004;$th005[$i]=$row->th005;$th006[$i]=$row->th006;$th007[$i]=$row->th007;
				 $th008[$i]=$row->th008;$th009[$i]=$row->th009;$th010[$i]=$row->th010;$th011[$i]=$row->th011;$th012[$i]=$row->th012;
				 $th013[$i]=$row->th013;$th014[$i]=$row->th014;$th015[$i]=$row->th015;$th016[$i]=$row->th016;$th017[$i]=$row->th017;
				 $th018[$i]=$row->th018;$th019[$i]=$row->th019;$th020[$i]=$row->th020;$th021[$i]=$row->th021;$th022[$i]=$row->th022;
			     $th023[$i]=$row->th023;$th024[$i]=$row->th024;$th025[$i]=$row->th025;$th026[$i]=$row->th026;$th027[$i]=$row->th027;
				 $th028[$i]=$row->th028;$th029[$i]=$row->th029;$th030[$i]=$row->th030;$th031[$i]=$row->th031;$th032[$i]=$row->th032;
				 $th033[$i]=$row->th033;$th034[$i]=$row->th034;$th035[$i]=$row->th035;$th036[$i]=$row->th036;$th037[$i]=$row->th037;
				 $th038[$i]=$row->th038;$th039[$i]=$row->th039;$th040[$i]=$row->th040;$th041[$i]=$row->th041;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('yh001c');    //主鍵一筆明細copth
			$seq2=$this->input->post('yh002c'); 
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
                'th001' => $seq1,'th002' => $seq2,'th003' => $th003[$i],'th004' => $th004[$i],'th005' => $th005[$i],'th006' => $th006[$i],'th007' => $th007[$i],
		         'th008' => $th008[$i],'th009' => $th009[$i],'th010' => $th010[$i],'th011' => $th011[$i],'th012' => $th012[$i],'th013' => $th013[$i],
				 'th014' => $th014[$i],'th015' => $th015[$i],'th016' => $th016[$i],'th017' => $th017[$i],'th018' => $th018[$i],'th019' => $th019[$i],
				 'th020' => $th020[$i],'th021' => $th021[$i],'th022' => $th022[$i],'th023' => $th023[$i],'th024' => $th024[$i],'th025' => $th025[$i],
				 'th026' => $th026[$i],'th027' => $th027[$i],'th028' => $th028[$i],'th029' => $th029[$i],'th030' => $th030[$i],'th031' => $th031[$i],'th032' => $th032[$i],
			    'th033' => $th033[$i],'th034' => $th034[$i],'th035' => $th035[$i],'th036' => $th036[$i],'th037' => $th037[$i],'th038' => $th038[$i],'th039' => $th039[$i],
			    'th040' => $th040[$i],'th041' => $th041[$i]
                ); 
				
             $this->db->insert('copth', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('yh001o');    
	      $seq2=$this->input->post('yh001c');
		  $seq3=$this->input->post('yh002o');    
	      $seq4=$this->input->post('yh002c');
	  //    $sql = " SELECT yh001,yh002,yh024,yh004,yh011,yh003,create_date FROM palyh WHERE yh001 >= '$seq1'  AND yh001 <= '$seq2' AND  yh002 >= '$seq3'  AND yh002 <= '$seq4'  "; 
         $sql = " SELECT a.yh001,a.yh002,a.yh003,a.yh004,c.ma002 as yh004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM palyh as a
		  LEFT JOIN copth as b ON a.yh001=b.th001 and a.yh002=b.th002 
		  LEFT JOIN copma as c ON a.yh004=c.ma001 
		  WHERE  yh001 >= '$seq1'  AND yh001 <= '$seq2' AND yh002 >= '$seq3'  AND yh002 <= '$seq4'  "; 
	//	  FROM palyh as a, copth as b WHERE yh001=th001 and yh002=th002 and  yh001 >= '$seq1'  AND yh001 <= '$seq2' AND yh002 >= '$seq3'  AND yh002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('dateo');    //客代
	      $seq2=$this->input->post('datec');
		  $seq3='';$seq4='';
		  IF ($seq2=='1' ) { $seq3='1';$seq4='3';} 
		  IF ($seq2=='2' ) { $seq3='4';$seq4='4';} 
		  IF ($seq2=='3' ) { $seq3='5';$seq4='5';} 
		//  $seq3=$this->input->post('dateo');   //日期 
	//	  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	 //     $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		//  $seq5=$this->input->post('invq02a');   //業務 
	    //  $seq6=$this->input->post('invq02a1');
		  
		/*   $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp'); */
		 
		  
		  
		  $this->db->select('a.*,b.mv036 '); 
          $this->db->from('palyh as a');	
          $this->db->join('cmsmv as b ', 'a.yh002 = b.mv001  ','left');  //業務人員
	//	$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	 //   $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
	//	$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
	//	$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
	//	$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
	//	$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
	//	$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
	//	$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門
	  
		$this->db->where('a.yh001 ', $seq1); 
	    $this->db->where('a.yh047 >=', $seq3); 
		$this->db->where('a.yh047 <=', $seq4); 
	//	$this->db->group_by(array("tc004", "tc004disp", "td004", "td005", "td006", "td010")); 
		$this->db->order_by('yh001 , yh002');
		
		$query = $this->db->get();
		  
		  
	 /*     $sql = " SELECT a.yh001,a.yh002,a.yh003,a.yh004,c.ma002 as yh004disp,b.th001,b.th002,b.th003,b.th004,b.th005,b.th006,b.th007,b.th008,b.th009,
		  b.th011,b.th012,b.th013,b.th016
		  FROM palyh as a
		  LEFT JOIN copth as b ON a.yh001=b.th001 and a.yh002=b.th002 
		  LEFT JOIN copma as c ON a.yh004=c.ma001 
		  WHERE  yh001 >= '$seq1'  AND yh001 <= '$seq2' AND yh002 >= '$seq3'  AND yh002 <= '$seq4'  AND yh004 >= '$seq5'  AND yh004 <= '$seq6'
order by a.yh001,a.yh002,b.th003 "; 
          $query = $this->db->query($sql); */
	      $ret['rows'] = $query->result();  
          $seq32 = "yh001 = '$seq1'  AND yh047 >= '$seq3' AND yh047 <= '$seq4'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('palyh')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS yh001disp, d.me002 AS yh004disp, e.mb002 AS yh010disp, f.mv002 AS yh012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('palyh as a');	
        $this->db->join('copth as b', 'a.yh001 = b.th001  and a.yh002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.yh001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.yh004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.yh010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.yh012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.yh001', $this->uri->segment(4)); 
	    $this->db->where('a.yh002', $this->uri->segment(5)); 
		$this->db->order_by('yh001 , yh002 ,b.th003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('th001', $this->uri->segment(4));
		$this->db->where('th002', $this->uri->segment(5));
	    $query = $this->db->get('copth');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆 A4
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS yh001disp, d.mb002 AS yh010disp,e.mf002 AS yh011disp, f.mv002 AS yh006disp,g.na003 AS yh047disp,
		  ,h.ma002 AS yh004disp,h.ma006 as yh004disp1,h.ma008 as yh004disp2,h.ma005 as yh004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as yh005disp');
		 
        $this->db->from('palyh as a');	
        $this->db->join('copth as b', 'a.yh001 = b.th001  and a.yh002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.yh001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.yh010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.yh011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.yh006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.yh047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.yh004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.yh005 = j.me001 ','left');   //部門
		$this->db->where('a.yh001', $this->input->post('yh001o')); 
	    $this->db->where('a.yh002', $this->input->post('yh002o')); 
		$this->db->order_by('yh001 , yh002 ,b.th003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  
	//印單據筆  半張紙letter1/2 A4half
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS yh001disp, d.mb002 AS yh010disp,e.mf002 AS yh011disp, f.mv002 AS yh006disp,g.na003 AS yh047disp,
		  ,h.ma002 AS yh004disp,h.ma006 as yh004disp1,h.ma008 as yh004disp2,h.ma005 as yh004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as yh005disp');
		 
        $this->db->from('palyh as a');	
        $this->db->join('copth as b', 'a.yh001 = b.th001  and a.yh002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.yh001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.yh010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.yh011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.yh006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.yh047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.yh004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.yh005 = j.me001 ','left');   //部門
		$this->db->where('a.yh001', $this->uri->segment(4)); 
	    $this->db->where('a.yh002', $this->uri->segment(5)); 
		$this->db->order_by('yh001 , yh002 ,b.th003');
		
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
		   //  $tax=round($this->input->post('yh019')*$this->input->post('yh026'));
		  //   if ($this->input->post('yh018')=='1') {$yh019=round($this->input->post('yh019')-$tax);}
			// if ($this->input->post('yh018')!='1') {$yh019=round($this->input->post('yh019'));}
			 $yh001=$this->input->post('copq03a23');
			 $yh002=$this->input->post('yh002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'yh003' => substr($this->input->post('yh003'),0,4).substr($this->input->post('yh003'),5,2).substr(rtrim($this->input->post('yh003')),8,2),
		         'yh004' => $this->input->post('copq01a'),
		         'yh005' => $this->input->post('cmsq05a'),
		         'yh006' => $this->input->post('cmsq09a3'),
                 'yh007' => $this->input->post('yh007'),
                 'yh008' => $this->input->post('yh008'),
                 'yh009' => $this->input->post('yh009'),
                 'yh010' => $this->input->post('cmsq02a'),	
                 'yh011' => strtoupper($this->input->post('cmsq06a')),
                 'yh012' => $this->input->post('yh012'),
                 'yh013' => $this->input->post('yh013'),	
                 'yh014' => $this->input->post('yh014'),	
                 'yh015' => $this->input->post('yh015'),	
                 'yh016' => $this->input->post('yh016'),
                 'yh017' => $this->input->post('yh017'),
                 'yh018' => $this->input->post('yh018'),
                 'yh019' => $this->input->post('yh019'),
                 'yh020' => $this->input->post('yh020'),
                 'yh021' => $this->input->post('yh021'),
				 'yh022' => $this->input->post('yh022'),
				 'yh023' => $this->input->post('yh023'),
                 'yh024' => $this->input->post('yh024'),
                 'yh025' => $this->input->post('yh025'),
                 'yh026' => $this->input->post('cmsq09a31'),
                 'yh027' => $this->input->post('yh027'),
                 'yh028' => $this->input->post('yh028'),
                 'yh029' => $this->input->post('yh029'),
                 'yh030' => $this->input->post('yh030'),
				 'yh031' => $this->input->post('yh031'),
				 'yh032' => $this->input->post('yh032'),
		         'yh033' => $this->input->post('cmsq21a1'),
				 'yh034' => $this->input->post('yh034'),
				 'yh035' => $this->input->post('cmsq09a32'),
		         'yh036' => $this->input->post('yh036'),
				 'yh037' => $this->input->post('yh037'),
				 'yh038' => substr($this->input->post('yh038'),0,4).substr($this->input->post('yh038'),5,2),
		         'yh039' => $this->input->post('yh039'),
				 'yh040' => $this->input->post('yh040'),
				 'yh041' => $this->input->post('yh041'),
		         'yh042' => substr($this->input->post('yh042'),0,4).substr($this->input->post('yh042'),5,2).substr(rtrim($this->input->post('yh042')),8,2),
				 'yh043' => $this->input->post('yh043'),
				 'yh044' => $this->input->post('yh044'),
				 'yh045' => $this->input->post('yh045'),
				 'yh046' => $this->input->post('yh046'),
				 'yh047' => $this->input->post('cmsq21a2'),
				 'yh048' => $this->input->post('yh048'),
				 'yh049' => $this->input->post('yh049'),
				 'yh050' => $this->input->post('yh050'),
                 'yh051' => $this->input->post('yh051'),
		         'yh052' => $this->input->post('yh052'),
				 'yh053' => $this->input->post('yh053'),
				 'yh054' => $this->input->post('yh054'),
				 'yh055' => $this->input->post('yh055'),
				 'yh056' => $this->input->post('yh056'),
				 'yh057' => $this->input->post('yh057'),
				 'yh058' => $this->input->post('yh058'),
				 'yh059' => $this->input->post('yh059'),
				 'yh060' => $this->input->post('yh060'),
                 'yh061' => $this->input->post('yh061')
                );
            $this->db->where('yh001', $this->input->post('copq03a23'));
			$this->db->where('yh002', $this->input->post('yh002'));
            $this->db->update('palyh',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('copq03a23'));
			$this->db->where('th002', $this->input->post('yh002'));
            $this->db->delete('copth'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 copth b原數量
			    $th035=0;$th036=0;$th037=0;$th038=0;$th008b=0;
			    $n = '0';		
				$th003='1000';
		//	while ($_POST['order_product'][  $n  ]['th004']) {
			while (isset($_POST['order_product'][  $n  ]['th004'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'th001' => $this->input->post('copq03a23'),
		         'th002' => $this->input->post('yh002'),
		         'th003' =>  $th003,
		          'th004' => $_POST['order_product'][  $n  ]['th004'],
		         'th005' => $_POST['order_product'][ $n  ]['th005'],
		         'th006' => $_POST['order_product'][ $n  ]['th006'],
                 'th007' => $_POST['order_product'][ $n  ]['th007'],
                 'th008' =>  $_POST['order_product'][ $n  ]['th008'],
				 'th009' =>  $_POST['order_product'][ $n  ]['th009'],
				 'th012' =>  $_POST['order_product'][ $n  ]['th012'],
				 'th013' =>  $_POST['order_product'][ $n  ]['th013'],
                 'th014' =>  $_POST['order_product'][ $n  ]['th014'],
                 'th015' =>  $_POST['order_product'][ $n  ]['th015'],
			     'th016' =>  $_POST['order_product'][ $n  ]['th016'],
				 'th017' =>  $_POST['order_product'][ $n  ]['th017'],
				 'th018' =>  $_POST['order_product'][ $n  ]['th018'],
				 'th019' =>  $_POST['order_product'][ $n  ]['th019'],
				
				 'th030' =>  $_POST['order_product'][ $n  ]['th030'],
				 'th035' =>  $_POST['order_product'][ $n  ]['th035'],
				 'th036' =>  $_POST['order_product'][ $n  ]['th036'],
				 'th037' =>  $_POST['order_product'][ $n  ]['th037'],
				 'th038' =>  $_POST['order_product'][ $n  ]['th038']
                );  
				 if ($_POST['order_product'][  $n  ]['th004']!='') {
		     $this->db->insert('copth', $data_array); }
			  $th035=$th035+$_POST['order_product'][ $n  ]['th035'];
			  $th036=$th036+$_POST['order_product'][ $n  ]['th036'];
			  $th037=$th037+$_POST['order_product'][ $n  ]['th037'];
			  $th038=$th038+$_POST['order_product'][ $n  ]['th038'];
			  $th008b=$th008b+$_POST['order_product'][ $n  ]['th008'];
			  
			  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $th008a=$_POST['order_product'][ $n  ]['th008a'];
			 $existb = $this->palr35_model->selone3d($th014,$th015,$th016);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,                 
				 'td009' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th015']!='') {
			 if ($existb){			  
         $sql = " UPDATE coptd set td009=td009+'$th008'-'$th008a' WHERE td001 = '$th014'  AND td002 = '$th015'  AND td003 = '$th016' "; 
		 $query = $this->db->query($sql);	} 
			  }
			 //庫存增加減少
			 $th004=$_POST['order_product'][ $n  ]['th004'];
			 $th007=$_POST['order_product'][ $n  ]['th007'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $th008a=$_POST['order_product'][ $n  ]['th008a'];
			 $exista = $this->palr35_model->selone2d($th004,$th007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $th004,
		         'mc002' => $th007,
				 'mc007' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$th008'-'$th008a' WHERE mc001 = '$th004'  AND mc002 = '$th007'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			 
			 
			 
			 $mth003 = (int) $th003+10;
			 $th003 =  (string)$mth003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '15';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['th004']) {
			  while (isset($_POST['order_product'][  $n  ]['th004'])) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'th001' => $this->input->post('copq03a23'),
		         'th002' => $this->input->post('yh002'),
		         'th003' =>  $th003,
		           'th004' => $_POST['order_product'][  $n  ]['th004'],
		         'th005' => $_POST['order_product'][ $n  ]['th005'],
		         'th006' => $_POST['order_product'][ $n  ]['th006'],
                 'th007' => $_POST['order_product'][ $n  ]['th007'],
                 'th008' =>  $_POST['order_product'][ $n  ]['th008'],
				 'th009' =>  $_POST['order_product'][ $n  ]['th009'],
				 'th012' =>  $_POST['order_product'][ $n  ]['th012'],
				 'th013' =>  $_POST['order_product'][ $n  ]['th013'],
                 'th014' =>  $_POST['order_product'][ $n  ]['th014'],
                 'th015' =>  $_POST['order_product'][ $n  ]['th015'],
			     'th016' =>  $_POST['order_product'][ $n  ]['th016'],
				 'th017' =>  $_POST['order_product'][ $n  ]['th017'],
				 'th018' =>  $_POST['order_product'][ $n  ]['th018'],
				 'th019' =>  $_POST['order_product'][ $n  ]['th019'],
				
				 'th030' =>  $_POST['order_product'][ $n  ]['th030'],
				 'th035' =>  $_POST['order_product'][ $n  ]['th035'],
				 'th036' =>  $_POST['order_product'][ $n  ]['th036'],
				 'th037' =>  $_POST['order_product'][ $n  ]['th037'],
				 'th038' =>  $_POST['order_product'][ $n  ]['th038']
                );   
				if ($_POST['order_product'][  $n  ]['th004']!='') {
			$this->db->insert('copth', $data_array);}
			  $th035=$th035+$_POST['order_product'][ $n  ]['th035'];
			  $th036=$th036+$_POST['order_product'][ $n  ]['th036'];
			  $th037=$th037+$_POST['order_product'][ $n  ]['th037'];
			  $th038=$th038+$_POST['order_product'][ $n  ]['th038'];
			  $th008b=$th008b+$_POST['order_product'][ $n  ]['th008'];
			  
			$mth003 = (int) $th003+10;
			$th003 =  (string)$mth003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 palyh
		  $sql = " UPDATE palyh set yh013='$th035',yh025='$th036',yh031='$th045',yh046='$th038',yh033='$th008b' WHERE yh001 = '$yh001'  AND yh002 = '$yh002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('yh001', $this->uri->segment(4));
		  $this->db->where('yh002', $this->uri->segment(5));
          $this->db->delete('palyh'); 
		  $this->db->where('th001', $this->uri->segment(4));
		  $this->db->where('th002', $this->uri->segment(5));
          $this->db->delete('copth'); 
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
			      $this->db->where('yh001', $seq1);
			      $this->db->where('yh002', $seq2);
                  $this->db->delete('palyh'); 
				  $this->db->where('th001', $seq1);
			      $this->db->where('th002', $seq2);
                  $this->db->delete('copth'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>