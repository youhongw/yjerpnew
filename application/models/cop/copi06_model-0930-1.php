<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copi06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tc001, tc002, tc003, tc004, tc0011, tc0019,tc020, create_date');
          $this->db->from('coptc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tc001 desc, tc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('coptc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.tc001', 'a.tc002', 'a.tc003', 'a.tc004', 'a.tc011', 'a.tc019','a.tc030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tc001, a.tc002, a.tc003, a.tc004, b.ma002,  a.tc029, a.tc030,a.create_date')
	                       ->from('coptc as a')
						    ->join('copma as b', 'a.tc004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
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
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('invmb');  
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
		
	//ajax 查詢顯示用 廠別 tc010  
	function ajaxcmsq02a($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmb');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mb002;
              }
		    return $result;   
		   }
	    }
		
	//ajax 查詢 顯示用 請購人員  
	function ajaxpalq01a($seg1)    
        { 	              
	      $this->db->set('mv001', $this->uri->segment(4));
		  $this->db->where('mv022', '');
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmv');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mv002;
              }
		   return $result;   
		   }
	    }
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('tc002');
		  $this->db->where('tc001', $this->uri->segment(4));
	      $this->db->where('tc039', $this->uri->segment(5));
		  $query = $this->db->get('coptc');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `coptc` ";
	      $seq1 = "tc001, tc002, tc003, tc004, tc004 as tc004disp,tc005, tc006,tc007,tc08,tc010,tc011,tc012,tc029,tc030, create_date FROM `coptc` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.tc001 desc' ;
          $seq9 = " ORDER BY a.tc001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.tc001 ";

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
		//下一頁不要跑掉 1050317
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004','b.ma002', 'tc005', 'tc006','tc007','tc008','tc010','tc011','tc012','tc019','tc027','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002,b.ma002, tc003, tc004,tc004 as tc004disp, tc005, tc006,tc007,tc008,tc010,tc011,tc012,tc029,tc030, a.create_date')
	                       ->from('coptc as a')
						   ->join('copma as b', 'a.tc004 = b.ma001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptc as a')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//篩選多筆     
	function filterf1($limit, $offset , $sort_by  , $sort_order)          
	    {    
	      $seq4 = trim(urldecode(urldecode($this->uri->segment(6)))); 	 //解決亂碼          
          $sort_by = $this->uri->segment(4);			
          $sort_order = $this->uri->segment(5);	
	      $offset=$this->uri->segment(8,0);
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('a.tc001', 'a.tc002', 'a.tc003', 'a.tc004', 'b.ma002', 'a.tc029','a.tc030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	      $this->db->select('a.tc001, a.tc002, a.tc003, a.tc004,b.ma002,  a.tc029,a.tc030, a.create_date');
	      $this->db->from('coptc as a');
		  $this->db->join('copma as b', 'a.tc004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tc001 asc, tc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('coptc as a');
		  $this->db->join('copma as b', 'a.tc004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tc001', $this->input->post('copq03a22'));
		  $this->db->where('tc002', $this->input->post('tc002'));
	      $query = $this->db->get('coptc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $this->input->post('copq03a22'));
		  $this->db->where('td002', $this->input->post('tc002'));
		  $this->db->where('td003', $seg3);
	      $query = $this->db->get('coptd');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  coptc	
	function insertf()    //新增一筆 檔頭  coptc
        {
		 //    $tax=round($this->input->post('tc019')*$this->input->post('tc026'));
		  //   if ($this->input->post('tc018')=='1') {$tc019=round($this->input->post('tc019')-$tax);}
		//	 if ($this->input->post('tc018')!='1') {$tc019=round($this->input->post('tc019'));}
		    //營業稅率
		       $tc001=$this->input->post('copq03a22');
			   $tc002=$this->input->post('tc002');
			   $tc041=$this->input->post('tc041');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tc001' => $this->input->post('copq03a22'),
		         'tc002' => $this->input->post('tc002'),
		         'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $this->input->post('copq01a'),
		         'tc005' => $this->input->post('cmsq05a'),
		         'tc006' => $this->input->post('cmsq09a3'),
                 'tc007' => $this->input->post('cmsq02a'),
                 'tc008' => $this->input->post('cmsq06a'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('tc010'),		
                 'tc011' => $this->input->post('tc011'),		
                 'tc012' => strtoupper($this->input->post('palq01a')),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('cmsq21a2'),		
                 'tc015' => $this->input->post('tc015'),	
                 'tc016' => $this->input->post('tc016'),
                 'tc017' => $this->input->post('tc017'),
                 'tc018' => $this->input->post('tc018'),
                 'tc019' => $this->input->post('tc019'),
                 'tc020' => $this->input->post('tc020'),
                 'tc021' => $this->input->post('tc021'),
				 'tc022' => $this->input->post('tc022'),
				 'tc023' => $this->input->post('tc023'),
                 'tc024' =>$this->input->post('tc024'),
                 'tc025' => $this->input->post('tc025'),
                 'tc026' => $this->input->post('tc026'),
                 'tc027' => $this->input->post('tc027'),
                 'tc028' => $this->input->post('tc028'),
                 'tc029' => $this->input->post('tc029'),
                 'tc030' => $this->input->post('tc030'),
				 'tc031' => $this->input->post('tc031'),
				 'tc032' => $this->input->post('tc032'),
				 'tc033' => $this->input->post('tc033'),
                 'tc034' =>$this->input->post('tc034'),
                 'tc035' => $this->input->post('tc035'),
                 'tc036' => $this->input->post('tc036'),
                 'tc037' => $this->input->post('tc037'),
                 'tc038' => $this->input->post('tc038'),
                 'tc039' =>substr($this->input->post('tc039'),0,4).substr($this->input->post('tc039'),5,2).substr(rtrim($this->input->post('tc039')),8,2),
                 'tc040' => $this->input->post('tc030'),
				 'tc041' => $this->input->post('tc041'),
				 'tc042' => $this->input->post('tc042'),
				 'tc043' => $this->input->post('tc043'),
                 'tc044' => $this->input->post('tc044'),
                 'tc045' => $this->input->post('tc045'),
                 'tc046' => $this->input->post('tc046'),
                 'tc047' => $this->input->post('tc047'),
                 'tc048' => $this->input->post('tc048'),
                 'tc049' => $this->input->post('tc049'),
                 'tc050' => $this->input->post('tc050'),
				 'tc051' => $this->input->post('tc051')
                 
                );
         
	      $exist = $this->copi06_model->selone1($this->input->post('copq03a22'),$this->input->post('tc002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('coptc', $data);
			
		// 新增明細 coptd  主檔 coptd 重計算合計金額 數量
			    $tc029=0;$tc030=0;$tc031=0;$tc043=0;$tc044=0;$tc031b=0;	
				 $n = '0';
				$td003='1000';		
		if (!isset($_POST['order_product'][  $n  ]['td004']) ) { $n='250'; } 
			
		 while (isset($_POST['order_product'][  $n  ]['td004'])) {	
		//	while ($_POST['order_product'][  $n  ]['td004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'td001' => $this->input->post('copq03a22'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][ $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
                 'td008' =>  $_POST['order_product'][ $n  ]['td008'],
				 'td009' =>  $_POST['order_product'][ $n  ]['td009'],
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
                 'td013' =>  substr($_POST['order_product'][ $n  ]['td013'],0,4).substr($_POST['order_product'][ $n ]['td013'],5,2).substr($_POST['order_product'][ $n ]['td013'],8,2),
                 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016'],
				 'td020' =>  $_POST['order_product'][ $n  ]['td020'],
				 'td030' =>  $_POST['order_product'][ $n  ]['td030'],
				 'td031' =>  $_POST['order_product'][ $n  ]['td031']
                );   
						 
	      $exist = $this->copi06_model->selone1d($this->input->post('copq03a22'),$this->input->post('tc002'),$td003);
		   if ($_POST['order_product'][  $n  ]['td004']>'0') {
		     $this->db->insert('coptd', $data_array); }
		
		  $tc029=$tc029+$_POST['order_product'][ $n  ]['td012'];
		  $tc030=$tc030+round(($_POST['order_product'][ $n  ]['td012'])*$tc041,0);
		  $tc031=$tc031+$_POST['order_product'][ $n  ]['td008'];
		  $tc043=$tc043+$_POST['order_product'][ $n  ]['td030'];
		  $tc044=$tc044+$_POST['order_product'][ $n  ]['td031'];
		  
		      $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 coptc
		  $sql = " UPDATE coptc set tc029='$tc029',tc030='$tc030',tc031='$tc031',tc043='$tc043',tc044='$tc044' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		  $query = $this->db->query($sql);//儲存完畢
				return true;
		 }
		 
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('copq03a22'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('copq03a22')."/".$this->input->post('tc002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 
		 
	
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tc001', $this->input->post('tc001c')); 
          $this->db->where('tc002', $this->input->post('tc002c'));
	      $query = $this->db->get('coptc');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('coptc');
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
                $tc003=$row->tc003;$tc004=$row->tc004;$tc005=$row->tc005;$tc006=$row->tc006;$tc007=$row->tc007;$tc008=$row->tc008;$tc009=$row->tc009;$tc010=$row->tc010;
				$tc011=$row->tc011;$tc012=$row->tc012;$tc013=$row->tc013;$tc014=$row->tc014;$tc015=$row->tc015;$tc016=$row->tc016;
				$tc017=$row->tc017;$tc018=$row->tc018;$tc019=$row->tc019;$tc020=$row->tc020;$tc021=$row->tc021;$tc022=$row->tc022;
				$tc023=$row->tc023;$tc024=$row->tc024;$tc025=$row->tc025;$tc026=$row->tc026;$tc027=$row->tc027;$tc028=$row->tc028;
				$tc029=$row->tc029;$tc030=$row->tc030;$tc031=$row->tc031;$tc032=$row->tc032;$tc033=$row->tc033;$tc034=$row->tc034;
				$tc035=$row->tc035;$tc036=$row->tc036;$tc037=$row->tc037;$tc038=$row->tc038;$tc039=$row->tc039;$tc040=$row->tc040;$tc041=$row->tc041;
				$tc042=$row->tc042;$tc043=$row->tc043;$tc044=$row->tc044;$tc045=$row->tc045;$tc046=$row->tc046;$tc047=$row->tc047;
				$tc048=$row->tc048;$tc049=$row->tc049;$tc050=$row->tc050;$tc051=$row->tc051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tc001c');    //主鍵一筆檔頭coptc
			$seq2=$this->input->post('tc002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tc001' => $seq1,'tc002' => $seq2,'tc003' => $tc003,'tc004' => $tc004,'tc005' => $tc005,'tc006' => $tc006,'tc007' => $tc007,'tc008' => $tc008,'tc009' => $tc009,'tc010' => $tc010,
		           'tc011' => $tc011,'tc012' => $tc012,'tc013' => $tc013,'tc014' => $tc014,'tc015' => $tc015,'tc016' => $tc016,'tc017' => $tc017,
				   'tc018' => $tc018,'tc019' => $tc019,'tc020' => $tc020,'tc021' => $tc021,'tc022' => $tc022,'tc023' => $tc023,'tc024' => $tc024,
				   'tc025' => $tc025,'tc026' => $tc026,'tc027' => $tc027,'tc028' => $tc028,'tc029' => $tc029,'tc030' => $tc030,
				   'tc031' => $tc031,'tc032' => $tc032,'tc033' => $tc033,'tc034' => $tc034,'tc035' => $tc035,'tc036' => $tc036,
				   'tc037' => $tc037,'tc038' => $tc038,'tc039' => $tc039,'tc040' => $tc040,'tc041' => $tc041,'tc042' => $tc042,
				   'tc043' => $tc043,'tc044' => $tc044,'tc045' => $tc045,'tc046' => $tc046,'tc047' => $tc047,'tc048' => $tc048,
				   'tc049' => $tc049,'tc050' => $tc050,'tc051' => $tc051
                   );
				   
            $exist = $this->copi06_model->selone2($this->input->post('tc001c'),$this->input->post('tc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('coptc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('td001', $this->input->post('tc001o'));
			$this->db->where('td002', $this->input->post('tc002o'));
	        $query = $this->db->get('coptd');
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
				 $td018[$i]=$row->td018;$td019[$i]=$row->td019;$td020[$i]=$row->td020;$td021[$i]=$row->td021;$td022[$i]=$row->td022;
			     $td023[$i]=$row->td023;$td024[$i]=$row->td024;$td025[$i]=$row->td025;$td026[$i]=$row->td026;$td027[$i]=$row->td027;
				 $td028[$i]=$row->td028;$td029[$i]=$row->td029;$td030[$i]=$row->td030;$td031[$i]=$row->td031;$td032[$i]=$row->td032;
				 $td033[$i]=$row->td033;$td034[$i]=$row->td034;$td035[$i]=$row->td035;$td036[$i]=$row->td036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tc001c');    //主鍵一筆明細coptd
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
				 'td020' => $td020[$i],'td021' => $td021[$i],'td022' => $td022[$i],'td023' => $td023[$i],'td024' => $td024[$i],'td025' => $td025[$i],
				 'td026' => $td026[$i],'td027' => $td027[$i],'td028' => $td028[$i],'td029' => $td029[$i],'td030' => $td030[$i],'td031' => $td031[$i],'td032' => $td032[$i],
				 'td033' => $td033[$i],'td034' => $td034[$i],'td035' => $td035[$i],'td036' => $td036[$i]
                ); 
				
             $this->db->insert('coptd', $data_array);      //複製一筆 
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
	      $sql = " SELECT tc001,tc002,tc039,tc004,ma002 as tc004disp,td003,td004,td005,td006,td010,td008,td011,td012 
		  FROM coptc as a,coptd as b,copma as c WHERE tc001=td001 and tc002=td002 and tc004=ma001 and tc001 >= '$seq1'  AND tc001 <= '$seq2' AND  tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.tc001,a.tc002,a.tc039,a.tc004,c.ma002 as tc004disp,b.td003,b.td004,b.td005,b.td006,b.td010,b.td008,b.td011,b.td012
		  FROM coptc as a,coptd as b,copma as c
		  WHERE tc001=td001 and tc002=td002 and tc004=ma001 and tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('coptc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tc001disp, d.me002 AS tc004disp, e.mb002 AS tc010disp, f.mv002 AS tc012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td011, b.td009, b.td017, b.td018, b.td012');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tc004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tc010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tc012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('td001', $this->uri->segment(4));
		$this->db->where('td002', $this->uri->segment(5));
	    $query = $this->db->get('coptd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
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
	//印單據筆  
		function printfb()   
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
			 //營業稅率
		       $tc001=$this->input->post('copq03a22');
			   $tc002=$this->input->post('tc002');
			   $tc041=$this->input->post('tc041');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		           'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $this->input->post('copq01a'),
		         'tc005' => $this->input->post('cmsq05a'),
		         'tc006' => $this->input->post('cmsq09a3'),
                 'tc007' => $this->input->post('cmsq02a'),
                 'tc008' => $this->input->post('cmsq06a'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('tc010'),		
                 'tc011' => $this->input->post('tc011'),	
                 'tc012' => strtoupper($this->input->post('palq01a')),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('cmsq21a2'),		
                 'tc015' => $this->input->post('tc015'),	
                 'tc016' => $this->input->post('tc016'),
                 'tc017' => $this->input->post('tc017'),
                 'tc018' => $this->input->post('tc018'),
                 'tc019' => $this->input->post('tc019'),
                 'tc020' => $this->input->post('tc020'),
                 'tc021' => $this->input->post('tc021'),
				 'tc022' => $this->input->post('tc022'),
				 'tc023' => $this->input->post('tc023'),
                 'tc024' =>$this->input->post('tc024'),
                 'tc025' => $this->input->post('tc025'),
                 'tc026' => $this->input->post('tc026'),
                 'tc027' => $this->input->post('tc027'),
                 'tc028' => $this->input->post('tc028'),
                 'tc029' => $this->input->post('tc029'),
                 'tc030' => $this->input->post('tc030'),
				 'tc031' => $this->input->post('tc031'),
				 'tc032' => $this->input->post('tc032'),
				 'tc033' => $this->input->post('tc033'),
                 'tc034' =>$this->input->post('tc034'),
                 'tc035' => $this->input->post('tc035'),
                 'tc036' => $this->input->post('tc036'),
                 'tc037' => $this->input->post('tc037'),
                 'tc038' => $this->input->post('tc038'),
                 'tc039' =>substr($this->input->post('tc039'),0,4).substr($this->input->post('tc039'),5,2).substr(rtrim($this->input->post('tc039')),8,2),
                 'tc040' => $this->input->post('tc030'),
				 'tc041' => $this->input->post('tc041'),
				 'tc042' => $this->input->post('tc042'),
				 'tc043' => $this->input->post('tc043'),
                 'tc044' => $this->input->post('tc044'),
                 'tc045' => $this->input->post('tc045'),
                 'tc046' => $this->input->post('tc046'),
                 'tc047' => $this->input->post('tc047'),
                 'tc048' => $this->input->post('tc048'),
                 'tc049' => $this->input->post('tc049'),
                 'tc050' => $this->input->post('tc050'),
				 'tc051' => $this->input->post('tc051')
                );
            $this->db->where('tc001', $this->input->post('copq03a22'));
			$this->db->where('tc002', $this->input->post('tc002'));
            $this->db->update('coptc',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('td001', $this->input->post('copq03a22'));
			$this->db->where('td002', $this->input->post('tc002'));
            $this->db->delete('coptd'); 
			
			$this->db->flush_cache();  
			// 新增明細 coptd
			  $tc029=0;$tc030=0;$tc031=0;$tc043=0;$tc044=0;$tc031b=0;	
			
			    $n = '0';		
				$td003='1000';
			 while (isset($_POST['order_product'][  $n  ]['td004'])) {	
			// while ($_POST['order_product'][  $n  ]['td004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'td001' => $this->input->post('copq03a22'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][ $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
                 'td008' =>  $_POST['order_product'][ $n  ]['td008'],
				 'td009' =>  $_POST['order_product'][ $n  ]['td009'],
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
                 'td013' =>  substr($_POST['order_product'][ $n  ]['td013'],0,4).substr($_POST['order_product'][ $n ]['td013'],5,2).substr($_POST['order_product'][ $n ]['td013'],8,2),
                 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016'],
				 'td020' =>  $_POST['order_product'][ $n  ]['td020'],
				 'td030' =>  $_POST['order_product'][ $n  ]['td030'],
				 'td031' =>  $_POST['order_product'][ $n  ]['td031']
                );  
				 if ($_POST['order_product'][  $n  ]['td004']>='0') {
		     $this->db->insert('coptd', $data_array); }
		    
			  $tc029=$tc029+$_POST['order_product'][ $n  ]['td012'];
		  $tc030=$tc030+round(($_POST['order_product'][ $n  ]['td012'])*$tc041,0);
		  $tc031=$tc031+$_POST['order_product'][ $n  ]['td008'];
		  $tc043=$tc043+$_POST['order_product'][ $n  ]['td030'];
		  $tc044=$tc044+$_POST['order_product'][ $n  ]['td031'];
			 
			 $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			// while ($_POST['order_product'][  $n  ]['td004']) {
			 while (isset($_POST['order_product'][  $n  ]['td004'])) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                  'td001' => $this->input->post('copq03a22'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][ $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
                 'td008' =>  $_POST['order_product'][ $n  ]['td008'],
				 'td009' =>  $_POST['order_product'][ $n  ]['td009'],
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
                 'td013' =>  substr($_POST['order_product'][ $n  ]['td013'],0,4).substr($_POST['order_product'][ $n ]['td013'],5,2).substr($_POST['order_product'][ $n ]['td013'],8,2),
                 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016'],
				 'td020' =>  $_POST['order_product'][ $n  ]['td020'],
				 'td030' =>  $_POST['order_product'][ $n  ]['td030'],
				 'td031' =>  $_POST['order_product'][ $n  ]['td031']
                );   
				 if ($_POST['order_product'][  $n  ]['td004']>'0') {
		     $this->db->insert('coptd', $data_array); }
		    
			  $tc029=$tc029+$_POST['order_product'][ $n  ]['td012'];
		   $tc030=$tc030+round(($_POST['order_product'][ $n  ]['td012'])*$tc041,0);
		  $tc031=$tc031+$_POST['order_product'][ $n  ]['td008'];
		  $tc043=$tc043+$_POST['order_product'][ $n  ]['td030'];
		  $tc044=$tc044+$_POST['order_product'][ $n  ]['td031'];
		
			$mtd003 = (int) $td003+10;
			$td003 =  (string)$mtd003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 coptc
		  $sql = " UPDATE coptc set tc029='$tc029',tc030='$tc030',tc031='$tc031',tc043='$tc043',tc044='$tc044' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		  $query = $this->db->query($sql);	
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tc001', $this->uri->segment(4));
		  $this->db->where('tc002', $this->uri->segment(5));
          $this->db->delete('coptc'); 
		  $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('coptd'); 
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
					$query6c = $this->db->query("SELECT UPPER(td016) as td0161 FROM coptd WHERE td001='$seq1' AND td002='$seq2' AND ( UPPER(td016)='Y' or td009>0 ) ");         
                    foreach ($query6c->result() as $row)
                          {
                            $td0161[]=$row->td0161;		 
                          }
                         if(isset($td0161[0])) {
	                         $vtd0161=$td0161[0];
                                                 }
	                     else 
                            { $vtd0161='N'; }    //結案碼
						
						
				if ($vtd0161 != 'Y') {	  
			      $this->db->where('tc001', $seq1);
			      $this->db->where('tc002', $seq2);
                  $this->db->delete('coptc'); 
				  $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
				$this->db->delete('coptd'); $this->session->set_userdata('msg1',"未出貨已刪除"); }
					 else {$this->session->set_userdata('msg1',"已出貨不可刪除");} 
				  
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	function del_detail(){
		$this->db->where('td001', $_POST['del_md001']);
		$this->db->where('td002', $_POST['del_md002']);
		$this->db->where('td003', $_POST['del_md003']);
		$this->db->delete('coptd');
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>