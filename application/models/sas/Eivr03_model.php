<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class eivr03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('me001, me002, me003, me004, me0011, me0019,me020, create_date');
          $this->db->from('coptg');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('me001 desc, me002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('coptg');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('me001', 'me002', 'me042', 'me004', 'me007', 'me013','me025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('me001, me002, me042, me004, me007, me013, me025,create_date')
	                       ->from('coptg')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptg');
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
		  $this->db->select('a.* ,c.mq002 AS me001disp, d.mb002 AS me010disp,e.mf002 AS me011disp, g.na003 AS me047disp,j.me002 as me005disp,f.mv002 as me006disp
		  ,h.ma002 AS me004disp,k.mv002 as me026disp,l.mv002 as me035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mc002 as th007disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.me001 = b.th001  and a.me002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.me001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.me010 = d.mb001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.me011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.me006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.me033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.me004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.me005 = j.me001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.me026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.me035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.me001', $this->uri->segment(4)); 
	    $this->db->where('a.me002', $this->uri->segment(5)); 
		$this->db->order_by('me001 , me002 ,b.th003');
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
	      $this->db->select_max('me002');
		  $this->db->where('me001', $this->uri->segment(4));
	      $this->db->where('me042', $this->uri->segment(5));
		  $query = $this->db->get('coptg');
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
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `coptg` ";
	      $seq1 = "me001, me002, me003, me004, me005, me006,me007,tg13,me025,me042, create_date FROM `coptg` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'me001 desc' ;
          $seq9 = " ORDER BY me001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="me001 ";

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
	     $sort_columns = array('me001', 'me002', 'me003', 'me004', 'me005', 'me006','me007','me008','me013','me025','me042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('me001, me002, me003, me004, me005, me006,me007,me008,me010,me011,me013,me025,me042, create_date')
	                       ->from('coptg')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptg')
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
	      $sort_columns = array('me001', 'me002', 'me003', 'me005', 'me021', 'me031','me019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否為 table
	      $this->db->select('me001, me002, me003, me005, me021, me031,me019, create_date');
	      $this->db->from('coptg');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('me001 asc, me002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('coptg');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('me001', $this->input->post('copq03a23'));
		  $this->db->where('me002', $this->input->post('me002'));
	      $query = $this->db->get('coptg');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('me002'));
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
	//新增一筆 檔頭  coptg	
	function insertf()    //新增一筆 檔頭  coptg
        {
		 //    $tax=round($this->input->post('me019')*$this->input->post('me026'));
		  //   if ($this->input->post('me018')=='1') {$me019=round($this->input->post('me019')-$tax);}
		//	 if ($this->input->post('me018')!='1') {$me019=round($this->input->post('me019'));}
		 //營業稅率, 匯率  
		       $me001=$this->input->post('copq03a23');
			   $me002=$this->input->post('me002');
			   $me044=$this->input->post('me044');
		 	   $me012=$this->input->post('me012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'me001' => $this->input->post('copq03a23'),
		         'me002' => $this->input->post('me002'),
		         'me003' => substr($this->input->post('me003'),0,4).substr($this->input->post('me003'),5,2).substr(rtrim($this->input->post('me003')),8,2),
		         'me004' => $this->input->post('copq01a'),
		         'me005' => $this->input->post('cmsq05a'),
		         'me006' => $this->input->post('cmsq09a3'),
                 'me007' => $this->input->post('me007'),
                 'me008' => $this->input->post('me008'),
                 'me009' => $this->input->post('me009'),
                 'me010' => $this->input->post('cmsq02a'),	
                 'me011' => strtoupper($this->input->post('cmsq06a')),
                 'me012' => $this->input->post('me012'),
                 'me013' => $this->input->post('me013'),	
                 'me014' => $this->input->post('me014'),	
                 'me015' => $this->input->post('me015'),	
                 'me016' => $this->input->post('me016'),
                 'me017' => $this->input->post('me017'),
                 'me018' => $this->input->post('me018'),
                 'me019' => $this->input->post('me019'),
                 'me020' => $this->input->post('me020'),
                 'me021' => $this->input->post('me021'),
				 'me022' => $this->input->post('me022'),
				 'me023' => $this->input->post('me023'),
                 'me024' => $this->input->post('me024'),
                 'me025' => $this->input->post('me025'),
                 'me026' => $this->input->post('cmsq09a31'),
                 'me027' => $this->input->post('me027'),
                 'me028' => $this->input->post('me028'),
                 'me029' => $this->input->post('me029'),
                 'me030' => $this->input->post('me030'),
				 'me031' => $this->input->post('me031'),
				 'me032' => $this->input->post('me032'),
		         'me033' => $this->input->post('cmsq21a1'),
				 'me034' => $this->input->post('me034'),
				 'me035' => $this->input->post('cmsq09a32'),
		         'me036' => $this->input->post('me036'),
				 'me037' => $this->input->post('me037'),
				 'me038' => substr($this->input->post('me038'),0,4).substr($this->input->post('me038'),5,2),
		         'me039' => $this->input->post('me039'),
				 'me040' => $this->input->post('me040'),
				 'me041' => $this->input->post('me041'),
		         'me042' => substr($this->input->post('me042'),0,4).substr($this->input->post('me042'),5,2).substr(rtrim($this->input->post('me042')),8,2),
				 'me043' => $this->input->post('me043'),
				 'me044' => $this->input->post('me044'),
				 'me045' => $this->input->post('me045'),
				 'me046' => $this->input->post('me046'),
				 'me047' => $this->input->post('cmsq21a2'),
				 'me048' => $this->input->post('me048'),
				 'me049' => $this->input->post('me049'),
				 'me050' => $this->input->post('me050'),
                 'me051' => $this->input->post('me051'),
		         'me052' => $this->input->post('me052'),
				 'me053' => $this->input->post('me053'),
				 'me054' => $this->input->post('me054'),
				 'me055' => $this->input->post('me055'),
				 'me056' => $this->input->post('me056'),
				 'me057' => $this->input->post('me057'),
				 'me058' => $this->input->post('me058'),
				 'me059' => $this->input->post('me059'),
				 'me060' => $this->input->post('me060'),
                 'me061' => $this->input->post('me061')
                );
         
	      $exist = $this->eivr03_model->selone1($this->input->post('copq03a23'),$this->input->post('me002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('coptg', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 coptg  主檔 copth 重計算合計金額 數量 庫存數量
			    $me013=0;$me025=0;$me033=0;$me045=0;$me046=0;$me033b=0;	
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
		         'th002' => $this->input->post('me002'),
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
						 
	     $exist = $this->eivr03_model->selone1d($this->input->post('copq03a23'),$this->input->post('me002'),$th003);
		
		if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $existb = $this->eivr03_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->eivr03_model->selone2d($th004,$th007);
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
			  
		  $me013=$me013+ $_POST['order_product'][ $n  ]['th035'];
		  $me025=$me025+ $_POST['order_product'][ $n  ]['th036'];
		  $me045=$me045+ $_POST['order_product'][ $n  ]['th037'];
		  $me046=$me046+ $_POST['order_product'][ $n  ]['th038'];
		  $me033=$me033+ $_POST['order_product'][ $n  ]['th008'];
			  
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
			    $me025=round($me013*$me044,0);
		        if ($this->input->post('me017')=='1') {$me013=$me013-$me025;}
		        if ($this->input->post('me017')>'1') {$me013=$me013;}
			  $me045=round($me013*$me012,0);
			  $me046=round($me025*$me012,0);
		  $sql = " UPDATE coptg set me013='$me013',me025='$me025',me033='$me033',me045='$me045',me046='$me046' WHERE me001 = '$me001'  AND me002 = '$me002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('me001', $this->input->post('me001c')); 
          $this->db->where('me002', $this->input->post('me002c'));
	      $query = $this->db->get('coptg');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('me001', $this->input->post('me001o'));
			$this->db->where('me002', $this->input->post('me002o'));
	        $query = $this->db->get('coptg');
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
                $me003=$row->me003;$me004=$row->me004;$me005=$row->me005;$me006=$row->me006;$me007=$row->me007;$me008=$row->me008;$me009=$row->me009;$me010=$row->me010;
				$me011=$row->me011;$me012=$row->me012;$me013=$row->me013;$me014=$row->me014;$me015=$row->me015;$me016=$row->me016;
				$me017=$row->me017;$me018=$row->me018;$me019=$row->me019;$me020=$row->me020;$me021=$row->me021;$me022=$row->me022;
				$me023=$row->me023;$me024=$row->me024;$me025=$row->me025;$me026=$row->me026;$me027=$row->me027;$me028=$row->me028;
				$me029=$row->me029;$me030=$row->me030;$me031=$row->me031;$me032=$row->me032;$me033=$row->me033;$me034=$row->me034;
				$me035=$row->me035;$me036=$row->me036;$me037=$row->me037;$me038=$row->me038;$me039=$row->me039;$me040=$row->me040;
				$me041=$row->me041;$me042=$row->me042;$me043=$row->me043;$me044=$row->me044;$me045=$row->me045;$me046=$row->me046;
				$me047=$row->me047;$me048=$row->me048;$me049=$row->me049;$me050=$row->me050;$me051=$row->me051;$me052=$row->me052;
				$me053=$row->me053;$me054=$row->me054;$me055=$row->me055;$me056=$row->me056;$me057=$row->me057;$me058=$row->me058;
				$me059=$row->me059;$me060=$row->me060;$me061=$row->me061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('me001c');    //主鍵一筆檔頭coptg
			$seq2=$this->input->post('me002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'me001' => $seq1,'me002' => $seq2,'me003' => $me003,'me004' => $me004,'me005' => $me005,'me006' => $me006,'me007' => $me007,'me008' => $me008,'me009' => $me009,'me010' => $me010,
		           'me011' => $me011,'me012' => $me012,'me013' => $me013,'me014' => $me014,'me015' => $me015,'me016' => $me016,'me017' => $me017,
				   'me018' => $me018,'me019' => $me019,'me020' => $me020,'me021' => $me021,'me022' => $me022,'me023' => $me023,'me024' => $me024,
				   'me025' => $me025,'me026' => $me026,'me027' => $me027,'me028' => $me028,'me029' => $me029,'me030' => $me030,
				   'me031' => $me031,'me032' => $me032,'me033' => $me033,'me034' => $me034,'me035' => $me035,'me036' => $me036,'me037' => $me037,
				   'me038' => $me038,'me039' => $me039,'me040' => $me040,'me041' => $me041,'me042' => $me042,'me043' => $me043,
				   'me044' => $me044,'me045' => $me045,'me046' => $me046,'me047' => $me047,'me048' => $me048,'me049' => $me049,'me050' => $me050,
				   'me051' => $me051,'me052' => $me052,'me053' => $me053,'me054' => $me054,'me055' => $me055,'me056' => $me056,'me057' => $me057,
				   'me058' => $me058,'me059' => $me059,'me060' => $me060,'me061' => $me061
                   );
				   
            $exist = $this->eivr03_model->selone2($this->input->post('me001c'),$this->input->post('me002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('coptg', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('me001o'));
			$this->db->where('th002', $this->input->post('me002o'));
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
			$seq1=$this->input->post('me001c');    //主鍵一筆明細copth
			$seq2=$this->input->post('me002c'); 
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
	      $seq1=$this->input->post('me001o');    
	      $seq2=$this->input->post('me001c');
		  $seq3=$this->input->post('me002o');    
	      $seq4=$this->input->post('me002c');
	  //    $sql = " SELECT me001,me002,me024,me004,me011,me003,create_date FROM coptg WHERE me001 >= '$seq1'  AND me001 <= '$seq2' AND  me002 >= '$seq3'  AND me002 <= '$seq4'  "; 
         $sql = " SELECT a.me001,a.me002,a.me003,a.me004,c.ma002 as me004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM coptg as a
		  LEFT JOIN copth as b ON a.me001=b.th001 and a.me002=b.th002 
		  LEFT JOIN copma as c ON a.me004=c.ma001 
		  WHERE  me001 >= '$seq1'  AND me001 <= '$seq2' AND me002 >= '$seq3'  AND me002 <= '$seq4'  "; 
	//	  FROM coptg as a, copth as b WHERE me001=th001 and me002=th002 and  me001 >= '$seq1'  AND me001 <= '$seq2' AND me002 >= '$seq3'  AND me002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	       $seq1=$this->input->post('copq01a');    //客代
	      $seq2=$this->input->post('copq01a1');
		//  $seq3=$this->input->post('dateo');   //日期 
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  $seq5=$this->input->post('invq02a');   //品號 
	      $seq6=$this->input->post('invq02a1');
		  
		/*   $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp'); */
		  
		  $this->db->select('a.* '); 
        $this->db->from('taxmc1 as a');
		$this->db->where('a.mc004 >=', '30'); 
	    $this->db->where('a.mc004 <=', '39'); 
		$this->db->order_by('mc004 , mc006');
		
		$query = $this->db->get();
		  
		  
	 /*     $sql = " SELECT a.me001,a.me002,a.me003,a.me004,c.ma002 as me004disp,b.th001,b.th002,b.th003,b.th004,b.th005,b.th006,b.th007,b.th008,b.th009,
		  b.th011,b.th012,b.th013,b.th016
		  FROM coptg as a
		  LEFT JOIN copth as b ON a.me001=b.th001 and a.me002=b.th002 
		  LEFT JOIN copma as c ON a.me004=c.ma001 
		  WHERE  me001 >= '$seq1'  AND me001 <= '$seq2' AND me002 >= '$seq3'  AND me002 <= '$seq4'  AND me004 >= '$seq5'  AND me004 <= '$seq6'
order by a.me001,a.me002,b.th003 "; 
          $query = $this->db->query($sql); */
	      $ret['rows'] = $query->result();  
          $seq32 = "mc004 >= '30'  AND mc004 <= '39'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('taxmc1')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS me001disp, d.me002 AS me004disp, e.mb002 AS me010disp, f.mv002 AS me012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.me001 = b.th001  and a.me002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.me001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.me004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.me010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.me012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.me001', $this->uri->segment(4)); 
	    $this->db->where('a.me002', $this->uri->segment(5)); 
		$this->db->order_by('me001 , me002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS me001disp, d.mb002 AS me010disp,e.mf002 AS me011disp, f.mv002 AS me006disp,g.na003 AS me047disp,
		  ,h.ma002 AS me004disp,h.ma006 as me004disp1,h.ma008 as me004disp2,h.ma005 as me004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as me005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.me001 = b.th001  and a.me002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.me001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.me010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.me011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.me006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.me047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.me004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.me005 = j.me001 ','left');   //部門
		$this->db->where('a.me001', $this->input->post('me001o')); 
	    $this->db->where('a.me002', $this->input->post('me002o')); 
		$this->db->order_by('me001 , me002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS me001disp, d.mb002 AS me010disp,e.mf002 AS me011disp, f.mv002 AS me006disp,g.na003 AS me047disp,
		  ,h.ma002 AS me004disp,h.ma006 as me004disp1,h.ma008 as me004disp2,h.ma005 as me004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as me005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.me001 = b.th001  and a.me002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.me001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.me010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.me011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.me006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.me047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.me004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.me005 = j.me001 ','left');   //部門
		$this->db->where('a.me001', $this->uri->segment(4)); 
	    $this->db->where('a.me002', $this->uri->segment(5)); 
		$this->db->order_by('me001 , me002 ,b.th003');
		
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
		   //  $tax=round($this->input->post('me019')*$this->input->post('me026'));
		  //   if ($this->input->post('me018')=='1') {$me019=round($this->input->post('me019')-$tax);}
			// if ($this->input->post('me018')!='1') {$me019=round($this->input->post('me019'));}
			 $me001=$this->input->post('copq03a23');
			 $me002=$this->input->post('me002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'me003' => substr($this->input->post('me003'),0,4).substr($this->input->post('me003'),5,2).substr(rtrim($this->input->post('me003')),8,2),
		         'me004' => $this->input->post('copq01a'),
		         'me005' => $this->input->post('cmsq05a'),
		         'me006' => $this->input->post('cmsq09a3'),
                 'me007' => $this->input->post('me007'),
                 'me008' => $this->input->post('me008'),
                 'me009' => $this->input->post('me009'),
                 'me010' => $this->input->post('cmsq02a'),	
                 'me011' => strtoupper($this->input->post('cmsq06a')),
                 'me012' => $this->input->post('me012'),
                 'me013' => $this->input->post('me013'),	
                 'me014' => $this->input->post('me014'),	
                 'me015' => $this->input->post('me015'),	
                 'me016' => $this->input->post('me016'),
                 'me017' => $this->input->post('me017'),
                 'me018' => $this->input->post('me018'),
                 'me019' => $this->input->post('me019'),
                 'me020' => $this->input->post('me020'),
                 'me021' => $this->input->post('me021'),
				 'me022' => $this->input->post('me022'),
				 'me023' => $this->input->post('me023'),
                 'me024' => $this->input->post('me024'),
                 'me025' => $this->input->post('me025'),
                 'me026' => $this->input->post('cmsq09a31'),
                 'me027' => $this->input->post('me027'),
                 'me028' => $this->input->post('me028'),
                 'me029' => $this->input->post('me029'),
                 'me030' => $this->input->post('me030'),
				 'me031' => $this->input->post('me031'),
				 'me032' => $this->input->post('me032'),
		         'me033' => $this->input->post('cmsq21a1'),
				 'me034' => $this->input->post('me034'),
				 'me035' => $this->input->post('cmsq09a32'),
		         'me036' => $this->input->post('me036'),
				 'me037' => $this->input->post('me037'),
				 'me038' => substr($this->input->post('me038'),0,4).substr($this->input->post('me038'),5,2),
		         'me039' => $this->input->post('me039'),
				 'me040' => $this->input->post('me040'),
				 'me041' => $this->input->post('me041'),
		         'me042' => substr($this->input->post('me042'),0,4).substr($this->input->post('me042'),5,2).substr(rtrim($this->input->post('me042')),8,2),
				 'me043' => $this->input->post('me043'),
				 'me044' => $this->input->post('me044'),
				 'me045' => $this->input->post('me045'),
				 'me046' => $this->input->post('me046'),
				 'me047' => $this->input->post('cmsq21a2'),
				 'me048' => $this->input->post('me048'),
				 'me049' => $this->input->post('me049'),
				 'me050' => $this->input->post('me050'),
                 'me051' => $this->input->post('me051'),
		         'me052' => $this->input->post('me052'),
				 'me053' => $this->input->post('me053'),
				 'me054' => $this->input->post('me054'),
				 'me055' => $this->input->post('me055'),
				 'me056' => $this->input->post('me056'),
				 'me057' => $this->input->post('me057'),
				 'me058' => $this->input->post('me058'),
				 'me059' => $this->input->post('me059'),
				 'me060' => $this->input->post('me060'),
                 'me061' => $this->input->post('me061')
                );
            $this->db->where('me001', $this->input->post('copq03a23'));
			$this->db->where('me002', $this->input->post('me002'));
            $this->db->update('coptg',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('copq03a23'));
			$this->db->where('th002', $this->input->post('me002'));
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
		         'th002' => $this->input->post('me002'),
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
			 $existb = $this->eivr03_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->eivr03_model->selone2d($th004,$th007);
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
		         'th002' => $this->input->post('me002'),
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
		   //重新計算貨款 coptg
		  $sql = " UPDATE coptg set me013='$th035',me025='$th036',me031='$th045',me046='$th038',me033='$th008b' WHERE me001 = '$me001'  AND me002 = '$me002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('me001', $this->uri->segment(4));
		  $this->db->where('me002', $this->uri->segment(5));
          $this->db->delete('coptg'); 
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
			      $this->db->where('me001', $seq1);
			      $this->db->where('me002', $seq2);
                  $this->db->delete('coptg'); 
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