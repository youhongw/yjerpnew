<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class copi05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta005, ta006,ta008,ta010,ta011,ta013, create_date');
          $this->db->from('copta');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('copta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta006', 'ta007','ta005','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002, ta003, ta004, ta006, ta007, ta005,create_date')
	                       ->from('copta')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('copta');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma002 AS ta004disp, f.na003 AS ta011disp, e.mv002 AS ta005disp,g.mf002 AS ta007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007,b.tb008,b.tb009,b.tb010, b.tb011,b.tb012,b.tb016,b.tb018, b.tb020, b.tb021');
		 
        $this->db->from('copta as a');	
        $this->db->join('coptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="21" ','left');
		$this->db->join('copma as d', 'a.ta004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.ta005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.ta011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.ta007 = g.mf001 ','left');	  		
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
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('invmb');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
		
	//ajax 查詢 顯示 核價單別 tb001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '21');
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
		
	//ajax 查詢顯示用 廠別 ta010  
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
	function ajaxchkno1($seg1,$seg2)    
        { 	              
	      $this->db->select_max('ta002');
		  $this->db->where('ta001', $this->uri->segment(4));
	      $this->db->where('ta013', $this->uri->segment(5));
		  $query = $this->db->get('copta');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ta002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `copta` ";
	      $seq1 = "ta001, ta002, ta003, ta004, ta005, ta006,ta007,ta08,ta010,ta011,ta013,ta012,ta016, create_date FROM `copta` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'ta001 desc' ;
          $seq9 = " ORDER BY ta001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="ta001 ";

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
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta005', 'ta006','ta007','ta008','ta010','ta011','ta013','ta012','ta016','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002, ta003, ta004, ta005, ta006,ta007,ta008,ta010,ta011,ta013,ta012,ta016, create_date')
	                       ->from('copta')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('copta')
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
	      $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta012','ta006', 'ta013','ta016','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('ta001, ta002, ta003, ta004,ta006,ta005,ta007, ta012, ta013,ta016, create_date');
	      $this->db->from('copta');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('copta');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ta001', $this->input->post('copq03a21'));
		  $this->db->where('ta002', $this->input->post('ta002'));
	      $query = $this->db->get('copta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tb001', $this->input->post('copq03a21'));
		  $this->db->where('tb002', $this->input->post('ta002'));
		  $this->db->where('tb003', $seg3);
	      $query = $this->db->get('coptb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  copta	
	function insertf()    //新增一筆 檔頭  copta
        {
			 $ta001=$this->input->post('copq03a21');
			 $ta002=$this->input->post('ta002');
			 $ta024=$this->input->post('ta024');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $this->input->post('copq03a21'),
		         'ta002' => $this->input->post('ta002'),
		         'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('copq01a'),
		         'ta005' => $this->input->post('cmsq09a3'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('cmsq06a'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => strtoupper($this->input->post('ta010')),		
                 'ta011' => $this->input->post('cmsq21a2'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => substr($this->input->post('ta013'),0,4).substr($this->input->post('ta013'),5,2).substr(rtrim($this->input->post('ta013')),8,2),
                 'ta014' => $this->input->post('ta014'),		
                 'ta015' =>  $this->session->userdata('manager'),
                 'ta016' => $this->input->post('ta016'),
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
                 'ta030' => $this->input->post('ta030')
                 
                );
         
	      $exist = $this->copi05_model->selone1($this->input->post('copq03a21'),$this->input->post('ta002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('copta', $data);
			
			 
		// 新增明細 coptb
		 // 新增明細 copta  主檔 copta 重計算合計金額 數量
			    $ta009=0;$ta023=0;$ta025=0;$ta027=0;$ta028=0;$tc022b=0;	
				 $n = '0';
				$tb003='1000';		
		if (!isset($_POST['order_product'][  $n  ]['tb004']) ) { $n='30'; }  
				  
		//	while (($_POST['order_product'][  $n  ]['tb004']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['tb004']) {
			 while (isset($_POST['order_product'][  $n  ]['tb004'])) {	
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tb001' => $this->input->post('copq03a21'),
		         'tb002' => $this->input->post('ta002'),
		         'tb003' =>  $tb003,
		         'tb004' => $_POST['order_product'][ $n  ]['tb004'],
		         'tb005' => $_POST['order_product'][ $n  ]['tb005'],
		         'tb006' => $_POST['order_product'][ $n  ]['tb006'],
                 'tb007' => $_POST['order_product'][ $n  ]['tb007'],
                 'tb008' => $_POST['order_product'][ $n  ]['tb008'],				 
                
                 'tb009' =>  $_POST['order_product'][ $n  ]['tb009'],
				 'tb010' =>  $_POST['order_product'][ $n  ]['tb010'],
				 'tb012' =>  $_POST['order_product'][ $n  ]['tb012'],
				 'tb016' =>  substr($_POST['order_product'][ $n  ]['tb016'],0,4).substr($_POST['order_product'][ $n ]['tb016'],5,2).substr($_POST['order_product'][ $n ]['tb016'],8,2),
				 'tb018' =>  $_POST['order_product'][ $n  ]['tb018'],
				 'tb020' =>  $_POST['order_product'][ $n  ]['tb020'],
				 'tb021' =>  $_POST['order_product'][ $n  ]['tb021']
                
                );   
						 
	      $exist = $this->copi05_model->selone1d($this->input->post('copq03a21'),$this->input->post('ta002'),$tb003);
		    if ($_POST['order_product'][  $n  ]['tb004'] >'0') {
		  $this->db->insert('coptb', $data_array); }
		  $ta009=$ta009+$_POST['order_product'][ $n  ]['tb010'];
		  $ta023=$ta023+($_POST['order_product'][ $n  ]['tb010']*$ta024);
		  $ta025=$ta025+$_POST['order_product'][ $n  ]['tb009'];
		  $ta027=$ta027+$_POST['order_product'][ $n  ]['tb020'];
		  $ta028=$ta028+$_POST['order_product'][ $n  ]['tb021'];
		  
		      $mtb003 = (int) $tb003+10;
			 $tb003 =  (string)$mtb003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 copta
		  $sql = " UPDATE copta set ta009='$ta009',ta023='$ta023',ta025='$ta025',ta027='$ta027',ta028='$ta028' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
		 $query = $this->db->query($sql);	
				return true;
		 }
	
    function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('copq03a22'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('copq03a21')."/".$this->input->post('ta002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 	
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('copta');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('copta');
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
				$ta029=$row->ta029;$ta030=$row->ta030;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭copta
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
				   'ta025' => $ta025,'ta026' => $ta026,'ta027' => $ta027,'ta028' => $ta028,'ta029' => $ta029,'ta030' => $ta030
                   );
				   
            $exist = $this->copi05_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('copta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('coptb');
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
                 $tb003[$i]=$row->tb003;$tb004[$i]=$row->tb004;$tb005[$i]=$row->tb005;$tb006[$i]=$row->tb006;$tb007[$i]=$row->tb007;$tb008[$i]=$row->tb008;
				 $tb009[$i]=$row->tb009;$tb010[$i]=$row->tb010;$tb011[$i]=$row->tb011;$tb012[$i]=$row->tb012;$tb016[$i]=$row->tb016;$tb018[$i]=$row->tb018;
				 $tb019[$i]=$row->tb019;$tb020[$i]=$row->tb020;$tb021[$i]=$row->tb021;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細coptb
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
		         'tb009' => $tb009[$i],'tb010' => $tb010[$i],'tb011' => $tb011[$i],'tb016' => substr($tb016[$i],0,4).substr($tb016[$i],5,2).substr($tb016[$i],8,2),
				 'tb012' => $tb012[$i],'tb018' => $tb018[$i],'tb020' => $tb020[$i],'tb021' => $tb021[$i]
                ); 
				
             $this->db->insert('coptb', $data_array);      //複製一筆 
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
		
	     // $sql = " SELECT ta001,ta002,ta003,ta004,ta006,ta007,ta005,ta011,tb003,tb004,tb005,tb006,tb008,tb007,tb009,tb010
		 // FROM copta as a,coptb as b,copma as c
		 // WHERE ta001=tb001 and ta002=tb002 and ta004=ma001 and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
		  
		  $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,a.ta006,a.ta007,a.ta005,a.ta011,b.tb003,b.tb004,b.tb005,b.tb006,b.tb008,b.tb007,b.tb009,b.tb010
		  FROM copta as a
		  left join coptb as b on a.ta001=b.tb001 and a.ta002=b.tb002
		  left join copma as c on a.ta004=c.ma001
		  WHERE  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,c.ma002 as ta004disp,a.ta007,b.tb003,b.tb004,tb005,tb006,tb008,tb007,tb009,tb010 
		  FROM copta as a,coptb as b,copma c
		  WHERE ta001=tb001 and ta002=tb002 and ta004=ma001 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('copta')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
	    $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma002 AS ta004disp, f.na003 AS ta011disp, e.mv002 AS ta005disp,g.mf002 AS ta007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007,b.tb008,b.tb009,b.tb010, b.tb011,b.tb012,b.tb016,b.tb017,b.tb018, b.tb020, b.tb021');
		 
        $this->db->from('copta as a');	
        $this->db->join('coptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="21" ','left');
		$this->db->join('copma as d', 'a.ta004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.ta005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.ta011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.ta007 = g.mf001 ','left');	
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
	    $query = $this->db->get('coptb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
           $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma002 AS ta004disp, f.na003 AS ta011disp, e.mv002 AS ta005disp,g.mf002 AS ta007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007,b.tb008,b.tb009,b.tb010, b.tb011,b.tb012,b.tb016,b.tb017,b.tb018, b.tb020, b.tb021');
		 
        $this->db->from('copta as a');	
        $this->db->join('coptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="21" ','left');
		$this->db->join('copma as d', 'a.ta004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.ta005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.ta011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.ta007 = g.mf001 ','left');		
		$this->db->where('a.ta001', $this->input->post('ta001o')); 
	    $this->db->where('a.ta002', $this->input->post('ta002o')); 
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
         $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma002 AS ta004disp, f.na003 AS ta011disp, e.mv002 AS ta005disp,g.mf002 AS ta007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007,b.tb008,b.tb009,b.tb010, b.tb011,b.tb012,b.tb016,b.tb017,b.tb018, b.tb020, b.tb021');
		 
        $this->db->from('copta as a');	
        $this->db->join('coptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="21" ','left');
		$this->db->join('copma as d', 'a.ta004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.ta005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.ta011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.ta007 = g.mf001 ','left');		
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
			 $ta001=$this->input->post('copq03a21');
			 $ta002=$this->input->post('ta002');
			  $ta024=$this->input->post('ta024');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('copq01a'),
		         'ta005' => $this->input->post('cmsq09a3'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('cmsq06a'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => strtoupper($this->input->post('ta010')),		
                 'ta011' => $this->input->post('cmsq21a2'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => substr($this->input->post('ta013'),0,4).substr($this->input->post('ta013'),5,2).substr(rtrim($this->input->post('ta013')),8,2),
                 'ta014' => $this->input->post('ta014'),		
                 'ta015' =>  $this->session->userdata('manager'),
                 'ta016' => $this->input->post('ta016'),
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
                 'ta030' => $this->input->post('ta030')
                );
            $this->db->where('ta001', $this->input->post('copq03a21'));
			$this->db->where('ta002', $this->input->post('ta002'));
            $this->db->update('copta',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tb001', $this->input->post('copq03a21'));
			$this->db->where('tb002', $this->input->post('ta002'));
            $this->db->delete('coptb'); 
			
			$this->db->flush_cache();  
			// 新增明細 coptb
			// 新增明細 copta  主檔 copta 重計算合計金額 數量
			    $ta009=0;$ta023=0;$ta025=0;$ta027=0;$ta028=0;$tc022b=0;	
			    $n = '0';		
				$tb003='1000';
				while (isset($_POST['order_product'][  $n  ]['tb004'])) {
		//	while ($_POST['order_product'][  $n  ]['tb004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tb001' => $this->input->post('copq03a21'),
		         'tb002' => $this->input->post('ta002'),
		         'tb003' =>  $tb003,
		         'tb004' => $_POST['order_product'][ $n  ]['tb004'],
		         'tb005' => $_POST['order_product'][ $n  ]['tb005'],
		         'tb006' => $_POST['order_product'][ $n  ]['tb006'],
                 'tb007' => $_POST['order_product'][ $n  ]['tb007'],
                 'tb008' => $_POST['order_product'][ $n  ]['tb008'],				 
                
                 'tb009' =>  $_POST['order_product'][ $n  ]['tb009'],
				 'tb010' =>  $_POST['order_product'][ $n  ]['tb010'],
				 'tb012' =>  $_POST['order_product'][ $n  ]['tb012'],
				 'tb016' =>  substr($_POST['order_product'][ $n  ]['tb016'],0,4).substr($_POST['order_product'][ $n ]['tb016'],5,2).substr($_POST['order_product'][ $n ]['tb016'],8,2),
				 'tb018' =>  $_POST['order_product'][ $n  ]['tb018'],
				 'tb020' =>  $_POST['order_product'][ $n  ]['tb020'],
				 'tb021' =>  $_POST['order_product'][ $n  ]['tb021']
                );  
				 if ($_POST['order_product'][  $n  ]['tb004']>'0') {
		     $this->db->insert('coptb', $data_array); }
		    $ta009=$ta009+$_POST['order_product'][ $n  ]['tb010'];
			$ta023=$ta023+($_POST['order_product'][ $n  ]['tb010']*$ta024);
		  $ta025=$ta025+$_POST['order_product'][ $n  ]['tb009'];
		  $ta027=$ta027+$_POST['order_product'][ $n  ]['tb020'];
		  $ta028=$ta028+$_POST['order_product'][ $n  ]['tb021'];
			 $mtb003 = (int) $tb003+10;
			 $tb003 =  (string)$mtb003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			  while (isset($_POST['order_product'][  $n  ]['tb004'])) {
			// while ($_POST['order_product'][  $n  ]['tb004']) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tb001' => $this->input->post('copq03a21'),
		         'tb002' => $this->input->post('ta002'),
		         'tb003' =>  $tb003,
		         'tb004' => $_POST['order_product'][ $n  ]['tb004'],
		         'tb005' => $_POST['order_product'][ $n  ]['tb005'],
		         'tb006' => $_POST['order_product'][ $n  ]['tb006'],
                 'tb007' => $_POST['order_product'][ $n  ]['tb007'],
                 'tb008' => $_POST['order_product'][ $n  ]['tb008'],				 
                
                 'tb009' =>  $_POST['order_product'][ $n  ]['tb009'],
				 'tb010' =>  $_POST['order_product'][ $n  ]['tb010'],
				 'tb012' =>  $_POST['order_product'][ $n  ]['tb012'],
				 'tb016' =>  substr($_POST['order_product'][ $n  ]['tb016'],0,4).substr($_POST['order_product'][ $n ]['tb016'],5,2).substr($_POST['order_product'][ $n ]['tb016'],8,2),
				 'tb018' =>  $_POST['order_product'][ $n  ]['tb018'],
				 'tb020' =>  $_POST['order_product'][ $n  ]['tb020'],
				 'tb021' =>  $_POST['order_product'][ $n  ]['tb021']
                );   
				if ($_POST['order_product'][  $n  ]['tb004'] !='') {
		     $this->db->insert('coptb', $data_array); }
			 $ta009=$ta009+$_POST['order_product'][ $n  ]['tb010'];
			 $ta023=$ta023+($_POST['order_product'][ $n  ]['tb010']*$ta024);
		  $ta025=$ta025+$_POST['order_product'][ $n  ]['tb009'];
		  $ta027=$ta027+$_POST['order_product'][ $n  ]['tb020'];
		  $ta028=$ta028+$_POST['order_product'][ $n  ]['tb021'];
			$mtb003 = (int) $tb003+10;
			$tb003 =  (string)$mtb003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 copta
		  $sql = " UPDATE copta set ta009='$ta009',ta023='$ta023',ta025='$ta025',ta027='$ta027',ta028='$ta028' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
		 $query = $this->db->query($sql);	
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('copta'); 
		  $this->db->where('tb001', $this->uri->segment(4));
		  $this->db->where('tb002', $this->uri->segment(5));
          $this->db->delete('coptb'); 
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
			      $this->db->where('ta001', $seq1);
			      $this->db->where('ta002', $seq2);
                  $this->db->delete('copta'); 
				  $this->db->where('tb001', $seq1);
			      $this->db->where('tb002', $seq2);
                  $this->db->delete('coptb'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	function del_detail(){
		$this->db->where('tb001', $_POST['del_md001']);
		$this->db->where('tb002', $_POST['del_md002']);
		$this->db->where('tb003', $_POST['del_md003']);
		$this->db->delete('coptb');
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>