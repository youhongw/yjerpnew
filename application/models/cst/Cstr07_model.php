<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cstr07_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mc001, mc002, mc003, mc004, mc0011, mc0019,mc020, create_date');
          $this->db->from('cstmc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mc001 desc, mc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cstmc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mc001', 'mc002', 'mc042', 'mc004', 'mc007', 'mc013','mc025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('cstmc')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cstmc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		 $this->db->select('a.* ,c.mq002 AS tc001disp, d.mc002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.mc002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mc001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.mc001 ','left');   //部門
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
		  $this->db->select('a.* ,c.mq002 AS mc001disp, d.mc002 AS mc010disp,e.mf002 AS mc011disp, g.na003 AS mc047disp,j.mc002 as mc005disp,f.mv002 as mc006disp
		  ,h.ma002 AS mc004disp,k.mv002 as mc026disp,l.mv002 as mc035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mc002 as th007disp');
		 
        $this->db->from('cstmc as a');	
        $this->db->join('copth as b', 'a.mc001 = b.th001  and a.mc002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.mc010 = d.mc001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.mc011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.mc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mc033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.mc004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.mc005 = j.mc001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.mc026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.mc035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	    $this->db->where('a.mc002', $this->uri->segment(5)); 
		$this->db->order_by('mc001 , mc002 ,b.th003');
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
      $this->db->select('mc001, mc002, mc003,mc004,mc017,b.mc002 as mc017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.mc017 = b.mc001 ','left'); 
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
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
	      $this->db->select_max('mc002');
		  $this->db->where('mc001', $this->uri->segment(4));
	      $this->db->where('mc042', $this->uri->segment(5));
		  $query = $this->db->get('cstmc');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mc002;
              }
		      return $result;   
		     }
	      }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `cstmc` ";
	      $seq1 = "mc001, mc002, mc003, mc004, mc005, mc006,mc007,tg13,mc025,mc042, create_date FROM `cstmc` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mc001 desc' ;
          $seq9 = " ORDER BY mc001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="mc001 ";

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
	     $sort_columns = array('mc001', 'mc002', 'mc003', 'mc004', 'mc005', 'mc006','mc007','mc008','mc013','mc025','mc042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mc001, mc002, mc003, mc004, mc005, mc006,mc007,mc008,mc010,mc011,mc013,mc025,mc042, create_date')
	                       ->from('cstmc')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cstmc')
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
	      $sort_columns = array('mc001', 'mc002', 'mc003', 'mc005', 'mc021', 'mc031','mc019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否為 table
	      $this->db->select('mc001, mc002, mc003, mc005, mc021, mc031,mc019, create_date');
	      $this->db->from('cstmc');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mc001 asc, mc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cstmc');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('mc001', $this->input->post('copq03a23'));
		  $this->db->where('mc002', $this->input->post('mc002'));
	      $query = $this->db->get('cstmc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('mc002'));
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
	//新增一筆 檔頭  cstmc	
	function insertf()    //新增一筆 檔頭  cstmc
        {
		 //    $tax=round($this->input->post('mc019')*$this->input->post('mc026'));
		  //   if ($this->input->post('mc018')=='1') {$mc019=round($this->input->post('mc019')-$tax);}
		//	 if ($this->input->post('mc018')!='1') {$mc019=round($this->input->post('mc019'));}
		 //營業稅率, 匯率  
		       $mc001=$this->input->post('copq03a23');
			   $mc002=$this->input->post('mc002');
			   $mc044=$this->input->post('mc044');
		 	   $mc012=$this->input->post('mc012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $this->input->post('copq03a23'),
		         'mc002' => $this->input->post('mc002'),
		         'mc003' => substr($this->input->post('mc003'),0,4).substr($this->input->post('mc003'),5,2).substr(rtrim($this->input->post('mc003')),8,2),
		         'mc004' => $this->input->post('copq01a'),
		         'mc005' => $this->input->post('cmsq05a'),
		         'mc006' => $this->input->post('cmsq09a3'),
                 'mc007' => $this->input->post('mc007'),
                 'mc008' => $this->input->post('mc008'),
                 'mc009' => $this->input->post('mc009'),
                 'mc010' => $this->input->post('cmsq02a'),	
                 'mc011' => strtoupper($this->input->post('cmsq06a')),
                 'mc012' => $this->input->post('mc012'),
                 'mc013' => $this->input->post('mc013'),	
                 'mc014' => $this->input->post('mc014'),	
                 'mc015' => $this->input->post('mc015'),	
                 'mc016' => $this->input->post('mc016'),
                 'mc017' => $this->input->post('mc017'),
                 'mc018' => $this->input->post('mc018'),
                 'mc019' => $this->input->post('mc019'),
                 'mc020' => $this->input->post('mc020'),
                 'mc021' => $this->input->post('mc021'),
				 'mc022' => $this->input->post('mc022'),
				 'mc023' => $this->input->post('mc023'),
                 'mc024' => $this->input->post('mc024'),
                 'mc025' => $this->input->post('mc025'),
                 'mc026' => $this->input->post('cmsq09a31'),
                 'mc027' => $this->input->post('mc027'),
                 'mc028' => $this->input->post('mc028'),
                 'mc029' => $this->input->post('mc029'),
                 'mc030' => $this->input->post('mc030'),
				 'mc031' => $this->input->post('mc031'),
				 'mc032' => $this->input->post('mc032'),
		         'mc033' => $this->input->post('cmsq21a1'),
				 'mc034' => $this->input->post('mc034'),
				 'mc035' => $this->input->post('cmsq09a32'),
		         'mc036' => $this->input->post('mc036'),
				 'mc037' => $this->input->post('mc037'),
				 'mc038' => substr($this->input->post('mc038'),0,4).substr($this->input->post('mc038'),5,2),
		         'mc039' => $this->input->post('mc039'),
				 'mc040' => $this->input->post('mc040'),
				 'mc041' => $this->input->post('mc041'),
		         'mc042' => substr($this->input->post('mc042'),0,4).substr($this->input->post('mc042'),5,2).substr(rtrim($this->input->post('mc042')),8,2),
				 'mc043' => $this->input->post('mc043'),
				 'mc044' => $this->input->post('mc044'),
				 'mc045' => $this->input->post('mc045'),
				 'mc046' => $this->input->post('mc046'),
				 'mc047' => $this->input->post('cmsq21a2'),
				 'mc048' => $this->input->post('mc048'),
				 'mc049' => $this->input->post('mc049'),
				 'mc050' => $this->input->post('mc050'),
                 'mc051' => $this->input->post('mc051'),
		         'mc052' => $this->input->post('mc052'),
				 'mc053' => $this->input->post('mc053'),
				 'mc054' => $this->input->post('mc054'),
				 'mc055' => $this->input->post('mc055'),
				 'mc056' => $this->input->post('mc056'),
				 'mc057' => $this->input->post('mc057'),
				 'mc058' => $this->input->post('mc058'),
				 'mc059' => $this->input->post('mc059'),
				 'mc060' => $this->input->post('mc060'),
                 'mc061' => $this->input->post('mc061')
                );
         
	      $exist = $this->cstr07_model->selone1($this->input->post('copq03a23'),$this->input->post('mc002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('cstmc', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 cstmc  主檔 copth 重計算合計金額 數量 庫存數量
			    $mc013=0;$mc025=0;$mc033=0;$mc045=0;$mc046=0;$mc033b=0;	
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
		         'th002' => $this->input->post('mc002'),
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
						 
	     $exist = $this->cstr07_model->selone1d($this->input->post('copq03a23'),$this->input->post('mc002'),$th003);
		
		if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $existb = $this->cstr07_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->cstr07_model->selone2d($th004,$th007);
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
			  
		  $mc013=$mc013+ $_POST['order_product'][ $n  ]['th035'];
		  $mc025=$mc025+ $_POST['order_product'][ $n  ]['th036'];
		  $mc045=$mc045+ $_POST['order_product'][ $n  ]['th037'];
		  $mc046=$mc046+ $_POST['order_product'][ $n  ]['th038'];
		  $mc033=$mc033+ $_POST['order_product'][ $n  ]['th008'];
			  
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
			    $mc025=round($mc013*$mc044,0);
		        if ($this->input->post('mc017')=='1') {$mc013=$mc013-$mc025;}
		        if ($this->input->post('mc017')>'1') {$mc013=$mc013;}
			  $mc045=round($mc013*$mc012,0);
			  $mc046=round($mc025*$mc012,0);
		  $sql = " UPDATE cstmc set mc013='$mc013',mc025='$mc025',mc033='$mc033',mc045='$mc045',mc046='$mc046' WHERE mc001 = '$mc001'  AND mc002 = '$mc002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('mc001', $this->input->post('mc001c')); 
          $this->db->where('mc002', $this->input->post('mc002c'));
	      $query = $this->db->get('cstmc');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('mc001', $this->input->post('mc001o'));
			$this->db->where('mc002', $this->input->post('mc002o'));
	        $query = $this->db->get('cstmc');
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
                $mc003=$row->mc003;$mc004=$row->mc004;$mc005=$row->mc005;$mc006=$row->mc006;$mc007=$row->mc007;$mc008=$row->mc008;$mc009=$row->mc009;$mc010=$row->mc010;
				$mc011=$row->mc011;$mc012=$row->mc012;$mc013=$row->mc013;$mc014=$row->mc014;$mc015=$row->mc015;$mc016=$row->mc016;
				$mc017=$row->mc017;$mc018=$row->mc018;$mc019=$row->mc019;$mc020=$row->mc020;$mc021=$row->mc021;$mc022=$row->mc022;
				$mc023=$row->mc023;$mc024=$row->mc024;$mc025=$row->mc025;$mc026=$row->mc026;$mc027=$row->mc027;$mc028=$row->mc028;
				$mc029=$row->mc029;$mc030=$row->mc030;$mc031=$row->mc031;$mc032=$row->mc032;$mc033=$row->mc033;$mc034=$row->mc034;
				$mc035=$row->mc035;$mc036=$row->mc036;$mc037=$row->mc037;$mc038=$row->mc038;$mc039=$row->mc039;$mc040=$row->mc040;
				$mc041=$row->mc041;$mc042=$row->mc042;$mc043=$row->mc043;$mc044=$row->mc044;$mc045=$row->mc045;$mc046=$row->mc046;
				$mc047=$row->mc047;$mc048=$row->mc048;$mc049=$row->mc049;$mc050=$row->mc050;$mc051=$row->mc051;$mc052=$row->mc052;
				$mc053=$row->mc053;$mc054=$row->mc054;$mc055=$row->mc055;$mc056=$row->mc056;$mc057=$row->mc057;$mc058=$row->mc058;
				$mc059=$row->mc059;$mc060=$row->mc060;$mc061=$row->mc061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mc001c');    //主鍵一筆檔頭cstmc
			$seq2=$this->input->post('mc002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mc001' => $seq1,'mc002' => $seq2,'mc003' => $mc003,'mc004' => $mc004,'mc005' => $mc005,'mc006' => $mc006,'mc007' => $mc007,'mc008' => $mc008,'mc009' => $mc009,'mc010' => $mc010,
		           'mc011' => $mc011,'mc012' => $mc012,'mc013' => $mc013,'mc014' => $mc014,'mc015' => $mc015,'mc016' => $mc016,'mc017' => $mc017,
				   'mc018' => $mc018,'mc019' => $mc019,'mc020' => $mc020,'mc021' => $mc021,'mc022' => $mc022,'mc023' => $mc023,'mc024' => $mc024,
				   'mc025' => $mc025,'mc026' => $mc026,'mc027' => $mc027,'mc028' => $mc028,'mc029' => $mc029,'mc030' => $mc030,
				   'mc031' => $mc031,'mc032' => $mc032,'mc033' => $mc033,'mc034' => $mc034,'mc035' => $mc035,'mc036' => $mc036,'mc037' => $mc037,
				   'mc038' => $mc038,'mc039' => $mc039,'mc040' => $mc040,'mc041' => $mc041,'mc042' => $mc042,'mc043' => $mc043,
				   'mc044' => $mc044,'mc045' => $mc045,'mc046' => $mc046,'mc047' => $mc047,'mc048' => $mc048,'mc049' => $mc049,'mc050' => $mc050,
				   'mc051' => $mc051,'mc052' => $mc052,'mc053' => $mc053,'mc054' => $mc054,'mc055' => $mc055,'mc056' => $mc056,'mc057' => $mc057,
				   'mc058' => $mc058,'mc059' => $mc059,'mc060' => $mc060,'mc061' => $mc061
                   );
				   
            $exist = $this->cstr07_model->selone2($this->input->post('mc001c'),$this->input->post('mc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('cstmc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('mc001o'));
			$this->db->where('th002', $this->input->post('mc002o'));
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
			$seq1=$this->input->post('mc001c');    //主鍵一筆明細copth
			$seq2=$this->input->post('mc002c'); 
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
	      $seq1=$this->input->post('mc001o');    
	      $seq2=$this->input->post('mc001c');
		  $seq3=$this->input->post('mc002o');    
	      $seq4=$this->input->post('mc002c');
	  //    $sql = " SELECT mc001,mc002,mc024,mc004,mc011,mc003,create_date FROM cstmc WHERE mc001 >= '$seq1'  AND mc001 <= '$seq2' AND  mc002 >= '$seq3'  AND mc002 <= '$seq4'  "; 
         $sql = " SELECT a.mc001,a.mc002,a.mc003,a.mc004,c.ma002 as mc004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM cstmc as a
		  LEFT JOIN copth as b ON a.mc001=b.th001 and a.mc002=b.th002 
		  LEFT JOIN copma as c ON a.mc004=c.ma001 
		  WHERE  mc001 >= '$seq1'  AND mc001 <= '$seq2' AND mc002 >= '$seq3'  AND mc002 <= '$seq4'  "; 
	//	  FROM cstmc as a, copth as b WHERE mc001=th001 and mc002=th002 and  mc001 >= '$seq1'  AND mc001 <= '$seq2' AND mc002 >= '$seq3'  AND mc002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tc002o');    //客代
	      $seq2=$this->input->post('tc002c');
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  $seq5=$this->input->post('invq02a');   //品號 
	      $seq6=$this->input->post('invq02a1');
		
		  $this->db->select('*'); 
        $this->db->from('cstmc as a');	
        
		$this->db->where('a.mc001 >=', $seq1); 
	    $this->db->where('a.mc001 <=', $seq2); 
		$this->db->group_by(array("mc001", "mc002")); 
		$this->db->order_by('mc001 , mc002');
		
		$query = $this->db->get();		  
		
	      $ret['rows'] = $query->result();  
          $seq32 = "mc001 >= '$seq1'  AND mc001 <= '$seq2'    ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('cstmc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS mc001disp, d.mc002 AS mc004disp, e.mc002 AS mc010disp, f.mv002 AS mc012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('cstmc as a');	
        $this->db->join('copth as b', 'a.mc001 = b.th001  and a.mc002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mc004 = d.mc001 ','left');
	    $this->db->join('cmsmb as e', 'a.mc010 = e.mc001 ','left');
		$this->db->join('cmsmv as f ', 'a.mc012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	    $this->db->where('a.mc002', $this->uri->segment(5)); 
		$this->db->order_by('mc001 , mc002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS mc001disp, d.mc002 AS mc010disp,e.mf002 AS mc011disp, f.mv002 AS mc006disp,g.na003 AS mc047disp,
		  ,h.ma002 AS mc004disp,h.ma006 as mc004disp1,h.ma008 as mc004disp2,h.ma005 as mc004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.mc002 as mc005disp');
		 
        $this->db->from('cstmc as a');	
        $this->db->join('copth as b', 'a.mc001 = b.th001  and a.mc002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mc010 = d.mc001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mc011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mc047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mc005 = j.mc001 ','left');   //部門
		$this->db->where('a.mc001', $this->input->post('mc001o')); 
	    $this->db->where('a.mc002', $this->input->post('mc002o')); 
		$this->db->order_by('mc001 , mc002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS mc001disp, d.mc002 AS mc010disp,e.mf002 AS mc011disp, f.mv002 AS mc006disp,g.na003 AS mc047disp,
		  ,h.ma002 AS mc004disp,h.ma006 as mc004disp1,h.ma008 as mc004disp2,h.ma005 as mc004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.mc002 as mc005disp');
		 
        $this->db->from('cstmc as a');	
        $this->db->join('copth as b', 'a.mc001 = b.th001  and a.mc002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mc010 = d.mc001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mc011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mc047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mc005 = j.mc001 ','left');   //部門
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	    $this->db->where('a.mc002', $this->uri->segment(5)); 
		$this->db->order_by('mc001 , mc002 ,b.th003');
		
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
		   //  $tax=round($this->input->post('mc019')*$this->input->post('mc026'));
		  //   if ($this->input->post('mc018')=='1') {$mc019=round($this->input->post('mc019')-$tax);}
			// if ($this->input->post('mc018')!='1') {$mc019=round($this->input->post('mc019'));}
			 $mc001=$this->input->post('copq03a23');
			 $mc002=$this->input->post('mc002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'mc003' => substr($this->input->post('mc003'),0,4).substr($this->input->post('mc003'),5,2).substr(rtrim($this->input->post('mc003')),8,2),
		         'mc004' => $this->input->post('copq01a'),
		         'mc005' => $this->input->post('cmsq05a'),
		         'mc006' => $this->input->post('cmsq09a3'),
                 'mc007' => $this->input->post('mc007'),
                 'mc008' => $this->input->post('mc008'),
                 'mc009' => $this->input->post('mc009'),
                 'mc010' => $this->input->post('cmsq02a'),	
                 'mc011' => strtoupper($this->input->post('cmsq06a')),
                 'mc012' => $this->input->post('mc012'),
                 'mc013' => $this->input->post('mc013'),	
                 'mc014' => $this->input->post('mc014'),	
                 'mc015' => $this->input->post('mc015'),	
                 'mc016' => $this->input->post('mc016'),
                 'mc017' => $this->input->post('mc017'),
                 'mc018' => $this->input->post('mc018'),
                 'mc019' => $this->input->post('mc019'),
                 'mc020' => $this->input->post('mc020'),
                 'mc021' => $this->input->post('mc021'),
				 'mc022' => $this->input->post('mc022'),
				 'mc023' => $this->input->post('mc023'),
                 'mc024' => $this->input->post('mc024'),
                 'mc025' => $this->input->post('mc025'),
                 'mc026' => $this->input->post('cmsq09a31'),
                 'mc027' => $this->input->post('mc027'),
                 'mc028' => $this->input->post('mc028'),
                 'mc029' => $this->input->post('mc029'),
                 'mc030' => $this->input->post('mc030'),
				 'mc031' => $this->input->post('mc031'),
				 'mc032' => $this->input->post('mc032'),
		         'mc033' => $this->input->post('cmsq21a1'),
				 'mc034' => $this->input->post('mc034'),
				 'mc035' => $this->input->post('cmsq09a32'),
		         'mc036' => $this->input->post('mc036'),
				 'mc037' => $this->input->post('mc037'),
				 'mc038' => substr($this->input->post('mc038'),0,4).substr($this->input->post('mc038'),5,2),
		         'mc039' => $this->input->post('mc039'),
				 'mc040' => $this->input->post('mc040'),
				 'mc041' => $this->input->post('mc041'),
		         'mc042' => substr($this->input->post('mc042'),0,4).substr($this->input->post('mc042'),5,2).substr(rtrim($this->input->post('mc042')),8,2),
				 'mc043' => $this->input->post('mc043'),
				 'mc044' => $this->input->post('mc044'),
				 'mc045' => $this->input->post('mc045'),
				 'mc046' => $this->input->post('mc046'),
				 'mc047' => $this->input->post('cmsq21a2'),
				 'mc048' => $this->input->post('mc048'),
				 'mc049' => $this->input->post('mc049'),
				 'mc050' => $this->input->post('mc050'),
                 'mc051' => $this->input->post('mc051'),
		         'mc052' => $this->input->post('mc052'),
				 'mc053' => $this->input->post('mc053'),
				 'mc054' => $this->input->post('mc054'),
				 'mc055' => $this->input->post('mc055'),
				 'mc056' => $this->input->post('mc056'),
				 'mc057' => $this->input->post('mc057'),
				 'mc058' => $this->input->post('mc058'),
				 'mc059' => $this->input->post('mc059'),
				 'mc060' => $this->input->post('mc060'),
                 'mc061' => $this->input->post('mc061')
                );
            $this->db->where('mc001', $this->input->post('copq03a23'));
			$this->db->where('mc002', $this->input->post('mc002'));
            $this->db->update('cstmc',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('copq03a23'));
			$this->db->where('th002', $this->input->post('mc002'));
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
		         'th002' => $this->input->post('mc002'),
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
			 $existb = $this->cstr07_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->cstr07_model->selone2d($th004,$th007);
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
		         'th002' => $this->input->post('mc002'),
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
		   //重新計算貨款 cstmc
		  $sql = " UPDATE cstmc set mc013='$th035',mc025='$th036',mc031='$th045',mc046='$th038',mc033='$th008b' WHERE mc001 = '$mc001'  AND mc002 = '$mc002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mc001', $this->uri->segment(4));
		  $this->db->where('mc002', $this->uri->segment(5));
          $this->db->delete('cstmc'); 
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
			      $this->db->where('mc001', $seq1);
			      $this->db->where('mc002', $seq2);
                  $this->db->delete('cstmc'); 
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