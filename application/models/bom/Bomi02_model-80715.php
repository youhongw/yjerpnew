<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bomi02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mc001, mc002, mc003, mc004, mc005, mc006,mc008,mc010,mc011,mc013, create_date');
          $this->db->from('bommc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mc001 desc, mc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('bommc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mc001', 'mc002', 'mc003', 'mc004', 'mc005', 'mc007','b.mb002','b.mb003','b.mb004','mc010');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.mc001, b.mb002 as mc001disp, b.mb003 as mc001disp1, b.mb004 as mc001disp2,  a.mc004,a.mc010')
	                       ->from('bommc as a')
						   ->join('invmb as b', 'a.mc001 = b.mb001 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bommc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS mc005disp, d.mb002 AS mc001disp,d.mb003 AS mc001disp1,d.mb004 AS mc001disp2,d.mb072 AS mc001disp3,d.mb025 AS mc001disp4,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.md001, b.md002, b.md003, b.md004, b.md005,
		  b.md006, b.md007,b.md008,b.md009,b.md010, b.md011, b.md012, b.md013, b.md014, b.md015, b.md016, b.md017,e.mb002 as md003disp,e.mb003 as md003disp1,e.mb004 as md003disp2');
		 
        $this->db->from('bommc as a');	
        $this->db->join('bommd as b', 'a.mc001 = b.md001 ','left');		
		$this->db->join('cmsmq as c', 'a.mc005 = c.mq001 and c.mq003="51" ','left');
		$this->db->join('invmb as d', 'a.mc001 = d.mb001 ','left');
		$this->db->join('invmb as e', 'b.md003 = e.mb001 ','left');
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	    $this->db->where('a.mc002', $this->uri->segment(5)); 
		$this->db->order_by('mc001,b.md002');
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
		
	//ajax 查詢 顯示 請購單別 md001	
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
		
	//ajax 查詢顯示用 廠別 mc010  
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
	      $this->db->select_max('mc002');
		  $this->db->where('mc001', $this->uri->segment(4));
	      $this->db->where('mc010', $this->uri->segment(5));
		  $query = $this->db->get('bommc');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `bommc` ";
	      $seq1 = "mc001, mc002, mc003, mc004, mc005,mc006, mc010, create_date FROM `bommc`  ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'mc001 desc' ;
          $seq9 = " ORDER BY mc001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
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
			 //下一頁不會亂跳
		if(@$_SESSION['bomi02_sql_term']){$seq32 = $_SESSION['bomi02_sql_term'];}
		if(@$_SESSION['bomi02_sql_sort']){$seq33 = $_SESSION['bomi02_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mc001', 'mc002', 'mc003', 'mc004', 'mc005', 'mc006','mc007','mc008','mc010','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mc001, mc002, mc003, mc004,b.mb002 as mc001disp,b.mb003 as mc001disp1,b.mb004 as mc001disp2, mc005, mc006,mc007,mc010,mc008,mc010, a.create_date')
	                       ->from('bommc as a')
						   ->join('invmb as b', 'a.mc001 = b.mb001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bommc')
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
	      $sort_columns = array('mc001', 'mc002', 'mc003', 'mc004', 'mc012', 'mc013','mc016','b.mb002','b.mb003','b.mb004','mc010');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否為 table
	      $this->db->select('mc001, mc002, mc003, mc004,b.mb002,b.mb003,b.mb004,b.mb002 as mc001disp,b.mb003 as mc001disp1,b.mb004 as mc001disp2, mc005, mc006,mc007,mc010,mc008,mc010, a.create_date');
	      $this->db->from('bommc as a');
		  $this->db->join('invmb as b', 'a.mc001 = b.mb001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mc001 asc, mc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('bommc as a');
		  $this->db->join('invmb as b', 'a.mc001 = b.mb001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('mc001', $this->input->post('invq02a'));
	      $query = $this->db->get('bommc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('md001', $this->input->post('invq02a'));
		//  $this->db->where('md002', $this->input->post('mc002'));
	      $query = $this->db->get('bommd');
	      return $query->num_rows() ;
	    }  	
	//查新增品號廠商資料是否重複 	
    function selone2d($seg1,$seg2,$seg3,$seg4,$seg5)    
        {
	      $this->db->where('mb001', $seg1);
		  $this->db->where('mb002', $seg2);
		  $this->db->where('mb003', $seg3);
		  $this->db->where('mb004', $seg4);
		  $this->db->where('mb014', $seg5);
	      $query = $this->db->get('purmb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  bommc	
	function insertf()    //新增一筆 檔頭  bommc
        {
			 
			  $mc001= $this->input->post('invq02a');
			  $mc005= $this->input->post('mocq01a');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $this->input->post('invq02a'),
		         'mc002' => $this->input->post('mc002'),
		         'mc003' => $this->input->post('mc003'),
		         'mc004' => $this->input->post('mc004'),
		         'mc005' => $this->input->post('mocq01a'),
		         'mc006' => $this->input->post('mc006'),
                 'mc007' => $this->input->post('mc007'),
                 'mc008' => $this->input->post('mc008'),
                 'mc009' => $this->input->post('mc009'),
                 'mc010' => $this->input->post('mc010')
                 
                );
         
	      $exist = $this->bomi02_model->selone1($this->input->post('invq02a'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('bommc', $data);
			
		// 新增明細 bommd
		     $n = '0';
				$md002='1000';
			if (!isset($_POST['order_product'][  $n  ]['md003']) ) { $n='250'; }  
			 //   $n = '0';
		//	while (($_POST['order_product'][  $n  ]['md004']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['md004']) {
			 while (isset($_POST['order_product'][  $n  ]['md003'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'md001' => $this->input->post('invq02a'),
		         'md002' => $md002,
		         'md003' => $_POST['order_product'][ $n  ]['md003'],
		         'md006' => $_POST['order_product'][ $n  ]['md006'],
		         'md007' => $_POST['order_product'][ $n  ]['md007'],
		         'md008' => $_POST['order_product'][ $n  ]['md008'],
                 'md011' =>  substr($_POST['order_product'][ $n  ]['md011'],0,4).substr($_POST['order_product'][ $n ]['md011'],5,2).substr($_POST['order_product'][ $n ]['md011'],8,2),			
                 'md012' =>  substr($_POST['order_product'][ $n  ]['md012'],0,4).substr($_POST['order_product'][ $n ]['md012'],5,2).substr($_POST['order_product'][ $n ]['md012'],8,2),
                 'md014' =>  $_POST['order_product'][ $n  ]['md014'],
                 
				 'md016' =>  $_POST['order_product'][ $n  ]['md016'],
				 'md017' =>  $_POST['order_product'][ $n  ]['md017']
                );   
						 
	      $exist = $this->bomi02_model->selone1d($this->input->post('invq02a'));
		   if ($_POST['order_product'][  $n  ]['md003'] !='') {
		   $this->db->insert('bommd', $data_array);}
		  
		      $mmd002 = (int) $md002+10;
			 $md002 =  (string)$mmd002;
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			 
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			return true;
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1)    
        { 
	      $this->db->where('mc001', $this->input->post('mc001c')); 
        //  $this->db->where('mc002', $this->input->post('mc002c'));
	      $query = $this->db->get('bommc');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('mc001', $this->input->post('mc001o'));
		//	$this->db->where('mc002', $this->input->post('mc002o'));
	        $query = $this->db->get('bommc');
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
                $mc002=$row->mc002;$mc003=$row->mc003;$mc004=$row->mc004;$mc005=$row->mc005;$mc006=$row->mc006;$mc007=$row->mc007;$mc008=$row->mc008;$mc009=$row->mc009;
				$mc010=$row->mc010;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mc001c');    //主鍵一筆檔頭bommc
		//	$seq2=$this->input->post('mc002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mc001' => $seq1,'mc002' => $mc002,'mc003' => $mc003,'mc004' => $mc004,'mc005' => $mc005,'mc006' => $mc006,'mc007' => $mc007,'mc008' => $mc008,'mc009' => $mc009,
		           'mc010' => $mc010
                   );
				   
            $exist = $this->bomi02_model->selone2($this->input->post('mc001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('bommc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('md001', $this->input->post('mc001o'));
		//	$this->db->where('md002', $this->input->post('mc002o'));
	        $query = $this->db->get('bommd');
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
                 $md002[$i]=$row->md002;$md003[$i]=$row->md003;$md004[$i]=$row->md004;$md005[$i]=$row->md005;$md006[$i]=$row->md006;$md007[$i]=$row->md007;
				 $md008[$i]=$row->md008;$md009[$i]=$row->md009;$md010[$i]=$row->md010;$md011[$i]=$row->md011;$md012[$i]=$row->md012;
				 $md013[$i]=$row->md013;$md014[$i]=$row->md014;$md015[$i]=$row->md015;$md016[$i]=$row->md016;$md017[$i]=$row->md017;
				 $md018[$i]=$row->md018;$md019[$i]=$row->md019;$md020[$i]=$row->md020;$md021[$i]=$row->md021;$md022[$i]=$row->md022;
				 $md023[$i]=$row->md023;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('mc001c');    //主鍵一筆明細bommd
		//	$seq2=$this->input->post('mc002c'); 
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
                'md001' => $seq1,'md002' => $md002[$i],'md003' => $md003[$i],'md004' => $md004[$i],'md005' => $md005[$i],'md006' => $md006[$i],'md007' => $md007[$i],
		        'md008' => $md008[$i],'md009' => $md009[$i],'md010' => $md010[$i],'md011' => $md011[$i],'md012' => $md012[$i],
				'md013' => $md013[$i],'md014' => $md014[$i],'md015' => $md015[$i],'md016' => $md016[$i],'md017' => $md017[$i],'md018' => $md018[$i],
				'md019' => $md019[$i],'md020' => $md020[$i],'md021' => $md021[$i],'md022' => $md022[$i],'md023' => $md023[$i]
                ); 
				
             $this->db->insert('bommd', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mc001o');    
	      $seq2=$this->input->post('mc001c');
		//  $seq3=$this->input->post('mc002o');    
	   //   $seq4=$this->input->post('mc002c');
	  //    $sql = " SELECT mc001,mc002,mc003,mc004,c.ma002 as mc004disp,mc005,md003,md004,md005,md006,md009,md010 FROM bommc as a,bommd as b,purma c
	//	  WHERE mc001=md001 AND mc002=md002 AND mc004=ma001 AND  mc001 >= '$seq1'  AND mc001 <= '$seq2' AND mc002 >= '$seq3'  AND mc002 <= '$seq4'  ";  
           $sql = " SELECT mc001,c.mb002 as mc001disp,c.mb003 as mc001disp1,c.mb004 as mc001disp2,mc004,md003,md002
		           ,d.mb002 as md003disp ,d.mb003 as md003disp1 ,d.mb004 as md003disp2,md006,md007,md008 FROM bommc as a,bommd as b,invmb c, invmb d
		  WHERE a.mc001=b.md001 AND  a.mc001=c.mb001 AND b.md003=d.mb001 AND  mc001 >= '$seq1'  AND mc001 <= '$seq2'   "; 
		  $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('mc001o');    
	      $seq2=$this->input->post('mc001c');
		//  $seq3=$this->input->post('mc002o');    
	    //  $seq4=$this->input->post('mc002c');
	      $sql = " SELECT mc001,mc002,mc003,mc004,c.mb002 as mc001disp,c.mb003 as mc001disp1,c.mb004 as mc001disp2,mc005,md003,md004,md005,md006,md009,md010 
		            md002,md007,md008,d.mb002 as md003disp ,d.mb003 as md003disp1 ,d.mb004 as md003disp2 FROM bommc as a,bommd as b,invmb c, invmb d
		  WHERE a.mc001=b.md001 AND  a.mc001=c.mb001 AND b.md003=d.mb001 AND  mc001 >= '$seq1'  AND mc001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "mc001 >= '$seq1'  AND mc001 <= '$seq2'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('bommc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS mc001disp, d.me002 AS mc004disp, e.mb002 AS mc010disp, f.mv002 AS mc012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.md001, b.md002, b.md003, b.md004, b.md005,
		  b.md006, b.md007, b.md011, b.md009, b.md017, b.md018, b.md012');
		 
        $this->db->from('bommc as a');	
        $this->db->join('bommd as b', 'a.mc001 = b.md001  and a.mc002=b.md002 ','left');		
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mc004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mc010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mc012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	    $this->db->where('a.mc002', $this->uri->segment(5)); 
		$this->db->order_by('mc001 , mc002 ,b.md003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('md001', $this->uri->segment(4));
		$this->db->where('md002', $this->uri->segment(5));
	    $query = $this->db->get('bommd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS mc001disp, d.ma002 AS mc004disp, 
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.md001, b.md002, b.md003, b.md004, b.md005,
		  b.md006, b.md007, b.md009, b.md010, b.md014, b.md012');
		 
        $this->db->from('bommc as a');	
        $this->db->join('bommd as b', 'a.mc001 = b.md001  and a.mc002=b.md002 ','left');		
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="32" ','left');
		$this->db->join('purma as d', 'a.mc004 = d.ma001 ','left');		
		$this->db->where('a.mc001', $this->input->post('mc001o')); 
	    $this->db->where('a.mc002', $this->input->post('mc002o')); 
		$this->db->order_by('mc001 , mc002 ,b.md003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  
	//印單據筆  
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS mc001disp, d.ma002 AS mc004disp, 
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.md001, b.md002, b.md003, b.md004, b.md005,
		  b.md006, b.md007, b.md009, b.md010, b.md014, b.md012');
		 
        $this->db->from('bommc as a');	
        $this->db->join('bommd as b', 'a.mc001 = b.md001  and a.mc002=b.md002 ','left');		
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="32" ','left');
		$this->db->join('purma as d', 'a.mc004 = d.ma001 ','left');
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	    $this->db->where('a.mc002', $this->uri->segment(5)); 
		$this->db->order_by('mc001 , mc002 ,b.md003');
		
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
			
			    $mc001= $this->input->post('invq02a');
			  $mc005= $this->input->post('mocq01a');	    
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'mc002' => $this->input->post('mc002'),
		         'mc003' => $this->input->post('mc003'),
		         'mc004' => $this->input->post('mc004'),
		         'mc005' => $this->input->post('mocq01a'),
		         'mc006' => $this->input->post('mc006'),
                 'mc007' => $this->input->post('mc007'),
                 'mc008' => $this->input->post('mc008'),
                 'mc009' => $this->input->post('mc009'),
                 'mc010' => $this->input->post('mc010')
                );
            $this->db->where('mc001', $this->input->post('invq02a'));
		//	$this->db->where('mc002', $this->input->post('mc002'));
            $this->db->update('bommc',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('md001', $this->input->post('invq02a'));
			//$this->db->where('md002', $this->input->post('mc002'));
            $this->db->delete('bommd'); 
			
			$this->db->flush_cache();  
			// 新增明細 bommd
			
			    $n = '0';		
				$md002='1000';
		   while (isset($_POST['order_product'][  $n  ]['md003'])) {
		//	while ($_POST['order_product'][  $n  ]['md004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                'md001' => $this->input->post('invq02a'),
		         'md002' => $md002,
		         'md003' => $_POST['order_product'][ $n  ]['md003'],
		         'md006' => $_POST['order_product'][ $n  ]['md006'],
		         'md007' => $_POST['order_product'][ $n  ]['md007'],
		         'md008' => $_POST['order_product'][ $n  ]['md008'],
                 'md011' =>  substr($_POST['order_product'][ $n  ]['md011'],0,4).substr($_POST['order_product'][ $n ]['md011'],5,2).substr($_POST['order_product'][ $n ]['md011'],8,2),			
                 'md012' =>  substr($_POST['order_product'][ $n  ]['md012'],0,4).substr($_POST['order_product'][ $n ]['md012'],5,2).substr($_POST['order_product'][ $n ]['md012'],8,2),
                 'md014' =>  $_POST['order_product'][ $n  ]['md014'],
               
				 'md016' =>  $_POST['order_product'][ $n  ]['md016'],
				 'md017' =>  $_POST['order_product'][ $n  ]['md017']
                );  
			if ($_POST['order_product'][  $n  ]['md003']>'0') {
			$this->db->insert('bommd', $data_array);}
			
			 $mmd002 = (int) $md002+10;
			 $md002 =  (string)$mmd002;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		   while (isset($_POST['order_product'][  $n  ]['md003'])) {
		//	 while ($_POST['order_product'][  $n  ]['md004']) {
			if ($_POST['order_product'][  $n  ]['md011']>'0') {$md014=substr($_POST['order_product'][ $n  ]['md011'],0,4).substr($_POST['order_product'][ $n ]['md011'],5,2).substr($_POST['order_product'][ $n ]['md011'],8,2);}
			   else {$md011='';}
			if ($_POST['order_product'][  $n  ]['md012']>'0') {$md014=substr($_POST['order_product'][ $n  ]['md012'],0,4).substr($_POST['order_product'][ $n ]['md012'],5,2).substr($_POST['order_product'][ $n ]['md011'],8,2);}
			   else {$md012='';}
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                'md001' => $this->input->post('invq02a'),
		         'md002' => $md002,
		         'md003' => $_POST['order_product'][ $n  ]['md003'],
		         'md006' => $_POST['order_product'][ $n  ]['md006'],
		         'md007' => $_POST['order_product'][ $n  ]['md007'],
		         'md008' => $_POST['order_product'][ $n  ]['md008'],
                 'md011' =>  substr($_POST['order_product'][ $n  ]['md011'],0,4).substr($_POST['order_product'][ $n ]['md011'],5,2).substr($_POST['order_product'][ $n ]['md011'],8,2),			
                 'md012' =>  substr($_POST['order_product'][ $n  ]['md012'],0,4).substr($_POST['order_product'][ $n ]['md012'],5,2).substr($_POST['order_product'][ $n ]['md012'],8,2),
                 'md014' =>  $_POST['order_product'][ $n  ]['md014'],
             
				 'md016' =>  $_POST['order_product'][ $n  ]['md016'],
				 'md017' =>  $_POST['order_product'][ $n  ]['md017']
                );   
			if ($_POST['order_product'][  $n  ]['md003'] > '0') {	
			$this->db->insert('bommd', $data_array); }
			$mmd002 = (int) $md002+10;
			$md002 =  (string)$mmd002;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mc001', $this->uri->segment(4));
		//  $this->db->where('mc002', $this->uri->segment(5));
          $this->db->delete('bommc'); 
		  $this->db->where('md001', $this->uri->segment(4));
		//  $this->db->where('md002', $this->uri->segment(5));
          $this->db->delete('bommd'); 
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
		    	     
			      $this->db->where('mc001', $seq1);
			  //    $this->db->where('mc002', $seq2);
                  $this->db->delete('bommc'); 
				  $this->db->where('md001', $seq1);
			   //   $this->db->where('md002', $seq2);
                  $this->db->delete('bommd'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	function del_detail(){
		$this->db->where('md001', $_POST['del_md001']);
		$this->db->where('md002', $_POST['del_md002']);
		$this->db->where('md003', $_POST['del_md003']);
		$this->db->delete('bommd');
	}
	//import copi05
	function check_detail_num($mz001,$mz002,$mz003,$mz004){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('bommd as a')
				->where('md001',$mz001);
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data($mz001,$mz002,$mz003,$mz004){
		
		$query = $this->db->select('a.md001,a.md002,a.md003,b.mb001,b.mb002,b.mb003,a.md004,a.md006')
				->from('bommd as a')
				->join('invmb as b', 'a.md003 = b.mb001 ','left')
				->where('md001',$mz001);
				
		$data = $query->get()->result();
		
		return $data;		
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>