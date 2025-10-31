<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puri06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tb001, tb002, tb003, tb004, tb005, tb006, create_date');
          $this->db->from('purtb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tb001 desc, tb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('purtb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('TB001', 'TB002', 'TB003', 'TB004', 'TB005', 'TB006','TB010','CREATE_DATE');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'TB001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('TB001, TB002, TB003, TB004, TB005, TB006,TB010, CREATE_DATE')
	                        ->from('PURTB')
		                    ->order_by($sort_by, $sort_order)
		                    ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('PURTB');
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
	    }
		
	//ajax 查詢主鍵 顯示用 品類代號  
	function ajaxkey($seg1)    
        {                   
	      $this->db->set('tb002', $this->uri->segment(4));
	      $this->db->where('tb002', $this->uri->segment(4));
	      $query = $this->db->get('purtb');
			
	      if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->tb002;
           }
		   return $result;   
		  }
	    }
		
	//查詢一筆 修改用   
	function selone()    
        { 
		  $this->db->select('purtb.*,a.mv002 as tb013disp, b.mf002 as tb016disp,c.ma002 as tb010disp,d.mc002 as tb008disp,e.ta013,e.ta003,f.mb039');	
	      $this->db->from('purtb');
		  $this->db->where('purtb.tb001', $this->uri->segment(4)); 
		  $this->db->where('purtb.tb002', $this->uri->segment(5));
		  $this->db->where('purtb.tb003', $this->uri->segment(6));
		  $this->db->join('purta as e', 'purtb.tb001 = e.ta001' and 'purtb.tb002 = e.ta002','left');
		  $this->db->join('cmsmv as a', 'purtb.tb013 = a.mv001','left');
	      $this->db->join('cmsmf as b', 'purtb.tb016 = b.mf001','left');
		  $this->db->join('purma as c', 'purtb.tb010 = c.ma001','left');
		  $this->db->join('cmsmc as d', 'purtb.tb008 = d.mc001','left');
		  $this->db->join('invmb as f', 'purtb.tb004 = f.mb001','left');
	      $query = $this->db->get();			
	      if ($query->num_rows() > 0) 
		   {
		    $result = $query->result();
		    return $result;   
		  }
	    }
		
	//多筆進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)    
        {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `purtb` ";
	      $seq1 = " tb001, tb002, tb003, tb004, tb005, tb006, create_date FROM `purtb` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'tb001 desc' ;
          $seq9 = " ORDER BY tb001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
          $seq7="tb001 ";

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
		if(@$_SESSION['puri06_sql_term']){$seq32 = $_SESSION['puri06_sql_term'];}
		if(@$_SESSION['puri06_sql_sort']){$seq33 = $_SESSION['puri06_sql_sort'];}
		
          $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('tb001', 'tb002', 'tb003', 'tb004', 'tb005', 'tb006','tb010','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tb001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('tb001, tb002, tb003, tb004, tb005, tb006,tb010, create_date')
	                        ->from('purtb')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('purtb')
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
	      $sort_columns = array('tb001', 'tb002', 'tb003', 'tb004', 'tb005', 'tb006','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tb001';  //檢查排序欄位是否為 table
			
	      $this->db->select('tb001, tb002, tb003, tb004, tb005, tb006, create_date');
	      $this->db->from('purtb');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tb001 asc, tb002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('purtb');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複  
	function selone1($seg1,$seg2)    
        {
	      $this->db->set('tb001', $this->input->post('tb001'));              
	      $this->db->set('tb002', $this->input->post('tb002'));
	      $this->db->where('tb001', $this->input->post('tb001'));     
	      $this->db->where('tb002', $this->input->post('tb002'));	
	      $query = $this->db->get('purtb');
	      return $query->num_rows() ;
	    }  
		
	//新增一筆	
	function insertf()    
        {
	      $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'tb001' => $this->input->post('tb001'),
		          'tb002' => $this->input->post('tb002'),
		          'tb003' => $this->input->post('tb003'),
		          'tb004' => $this->input->post('tb004'),
		          'tb005' => $this->input->post('tb005'),
		          'tb006' => $this->input->post('tb006')             
                       );
         
	      $exist = $this->puri06_model->selone1($this->input->post('tb001'),$this->input->post('tb002'));
	      if ($exist)
	        {
		     return 'exist';
		   } 
             return  $this->db->insert('purtb', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1,$seg2)    
        { 	
	      $this->db->set('tb001', $this->input->post('tb003c'));              
	      $this->db->set('tb002', $this->input->post('tb004c'));
	      $this->db->where('tb001', $this->input->post('tb003c'));     
	      $this->db->where('tb002', $this->input->post('tb004c'));	
	      $query = $this->db->get('purtb');
	      return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           //複製一筆
        {
	      $seq1=$this->input->post('tb001c');    
	      $seq2=$this->input->post('tb002c'); 
	      $this->db->set('tb001', $this->input->post('tb001c'));              
	      $this->db->set('tb002', $this->input->post('tb002c'));
	      $this->db->where('tb001', $this->input->post('tb001c'));     
	      $this->db->where('tb002', $this->input->post('tb002c'));	
	      $query = $this->db->get('purtb');
	      $exist = $query->num_rows();
          if (!$exist)
	        {
		     return 'exist';
	        }         		
          if ($query->num_rows() != 1) { return 'exist'; }
		  if ($query->num_rows() == 1) 
		    {
			 $result = $query->result();
			 foreach($result as $row):
                $tb003=$row->tb003;
                $tb004=$row->tb004;
                $tb005=$row->tb005;
                $tb006=$row->tb006;    	
	 	    endforeach;
		    }   
		  
          $seq3=$this->input->post('tb003c');    //主鍵一筆
	      $seq4=$this->input->post('tb004c'); 
	      $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'tb001' => $seq3,
		          'tb002' => $seq4,
		          'tb003' => $tb003,
		          'tb004' => $tb004,
		          'tb005' => $tb005,
		          'tb006' => $tb006             
                      );
          $exist = $this->puri06_model->selone2($this->input->post('tb003c'),$this->input->post('tb004c'));
		  if ($exist)
		    {
			 return 'exist';
		    }         
             return $this->db->insert('purtb', $data);      //複製一筆  
        }	
		
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tb001c');    
	      $seq2=$this->input->post('tb002c'); 
	      $seq3=$this->input->post('tb003c'); 
	      $seq4=$this->input->post('tb004c'); 
	      $sql = " SELECT tb001,tb002,tb003,tb004,tb005,tb006,create_date FROM purtb WHERE tb001 >= '$seq1'  AND tb001 <= '$seq2' AND tb002 >= '$seq3' AND tb002 <= '$seq4' "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		 //印單據筆   
	function printfc($ta001o,$ta002o,$ta003o,$ta004o)   
      {    
		$sql1 = "SELECT A.* ,C.MQ002 AS TA001DISP, D.ME002 AS TA004DISP, E.MB002 AS TA010DISP, F.MV002 AS TA012DISP,
		  B.COMPANY, B.CREATOR, B.USR_GROUP, B.CREATE_DATE, B.MODIFIER, B.MODI_DATE, B.FLAG, B.TB001, B.TB002, B.TB003, B.TB004, B.TB005,
		  B.TB006, B.TB007, B.TB011, B.TB009, B.TB017, B.TB018, B.TB012 
		  FROM PURTA AS A 
		  LEFT JOIN PURTB AS B ON A.TA001 = B.TB001  AND A.TA002=B.TB002 
		  LEFT JOIN CMSMQ AS C ON A.TA001 = C.MQ001 AND C.MQ003='31' 
		  LEFT JOIN CMSME AS D ON A.TA004 = D.ME001 
		  LEFT JOIN CMSMB AS E ON A.TA010 = E.MB001 
		  LEFT JOIN CMSMV AS F ON A.TA012 = F.MV001 AND F.MV022 ='' 
		  WHERE B.TB001 = '$ta001o' AND B.TB002 = '$ta002o' AND B.TB003 >=  '$ta003o' AND B.TB003 <= '$ta004o'
		  ORDER BY A.TA001,A.TA002,B.TB003";
		  
		$query = $this->db->query($sql1);
		$result['rows'] = $query->result();
		
		$sql = "EXEC PRO_PURTB_TH @TB001 = '$ta001o' , @TB002 = '$ta002o' ,@TB003 = '$ta003o'";
		$query2 = $this->db->query($sql);
		
		//echo var_dump($sql);exit;
		
		$sql2 = "SELECT TB001,TB002,TB003,TH002,TH003,TH014,TG005,MA002,TH015,TH018 FROM coptb_temp WHERE TB001 = '$ta001o' AND TB002 = '$ta002o' AND TB003 >= '$ta003o' AND TB003 <= '$ta004o' ORDER BY TB003";
		
		//echo var_dump($sql2);exit;
		
		$query1 = $this->db->query($sql2);

		$result['rows1'] = $query1->result();
		
		//echo var_dump($query);exit;
		/*  
		$this->db->select('A.* ,C.MQ002 AS TA001DISP, D.ME002 AS TA004DISP, E.MB002 AS TA010DISP, F.MV002 AS TA012DISP,
		  B.COMPANY, B.CREATOR, B.USR_GROUP, B.CREATE_DATE, B.MODIFIER, B.MODI_DATE, B.FLAG, B.TB001, B.TB002, B.TB003, B.TB004, B.TB005,
		  B.TB006, B.TB007, B.TB011, B.TB009, B.TB017, B.TB018, B.TB012');
        $this->db->from('PURTA AS A');	
        $this->db->join('PURTB AS B', 'A.TA001 = B.TB001  AND A.TA002=B.TB002 ','left');		
		$this->db->join('CMSMQ AS C', 'A.TA001 = C.MQ001 AND C.MQ003="31" ','left');
		$this->db->join('CMSME AS D', 'A.TA004 = D.ME001 ','left');
	    $this->db->join('CMSMB AS E', 'A.TA010 = E.MB001 ','left');
		$this->db->join('CMSMV AS F ', 'A.TA012 = F.MV001 AND F.MV022 = " " ','left');		
		$this->db->where('A.TA001', $this->input->post('ta001o')); 
	    $this->db->where('A.TA002', $this->input->post('ta002o')); 
		$this->db->order_by('TA001 , TA002 ,B.TB003');
		
		$query = $this->db->get(); */
		//$result['rows1'] = $query->result();
		
		
		return $result;
		//  echo var_dump($result);exit;
	    /*if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }*/
      }
	//印明細表	
	function printfd($limit, $offset, $sort_by, $sort_order, $where, $where_tb003){
		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('a.tb001', 'a.tb002', 'a.tb003', 'a.tb004', 'a.tb005', 'a.tb006','a.create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.tb001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.tb001 ,a.tb002 ,a.tb003 ,b.ta003 ,b.ta004 ,a.tb004, a.tb005 , c.mc007
						, a.tb006 ,a.tb007 ,a.tb009 ,a.tb011 ,b.ta012 ,a.tb032, a.create_date')
						->from('purtb as a')
						->join('purta as b','a.tb002 = b.ta002','left')
						->join('invmc as c','a.tb004 = c.mc001','left')
						->order_by($sort_by, $sort_order)
						->limit($limit, $offset)
						->where('a.tb002',$where)
						->where('a.tb003',$where_tb003);
	    $ret['rows'] = $query->get()->result();

	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	  					->from('purtb as a')
						->join('purta as b','a.tb002 = b.ta002','left')
						->join('invmc as c','a.tb004 = c.mc001','left')
						->order_by($sort_by, $sort_order)
						->limit($limit, $offset)
						->where('a.tb002',$where)
						->where('a.tb003',$where_tb003);
	    $num = $query->get()->result();		
  	    $ret['num_rows'] = $num[0]->count;		
		
	    return $ret;
	}
	function printfd_hp($ta001o,$ta002o,$ta003o,$ta004o){
		
		$sql2 = "SELECT B.TH014,TG005,MA002 ,B.TH014 ,B.TH015 ,B.TH018 
				FROM PURMA ,PURTG , PURTH B, 
				(SELECT TH004,MAX(PURTH.CREATE_DATE) AS CREATE_DATE FROM PURTB, PURTG , PURTH  
				WHERE  TB004 = TH004 AND TH001 = '3400' AND TB001 = '$ta001o' AND TB002 = '$ta002o' AND TB003 >= '$ta003o' AND TB003 <= '$ta004o' GROUP BY TH004) A 
				WHERE MA001 = TG005 AND TG001 = TH001 AND TG002 = TH002 AND B.TH004 = A.TH004 AND B.CREATE_DATE = A.CREATE_DATE AND TG001 = '3400'";
				
		$query = $this->db->query($sql2);
		
		$hp_results['rows1'] = $query->result();
		return $hp_results;
		
		/*
		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('a.th014','a.create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.th014';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.th014, b.tg005, a.th015, a.th008, a.th018, a.create_date')
	                    ->from('purth as a')
						->join('purtg as b', 'a.th002 = b.tg002','left')
						->order_by($sort_by, $sort_order)
						->limit($limit, $offset)
						->where('a.th004',$where);
						
	    $ret['rows'] = $query->get()->result();
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                    ->from('purth as a')
						->join('purtg as b', 'a.th002 = b.tg002','left')
						->order_by($sort_by, $sort_order)
						->limit($limit, $offset)
						->where('a.th004',$where);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
		*/
	}
	/*function printfd()           
        {
	      $seq1=$this->input->post('tb001c');    
	      $seq2=$this->input->post('tb002c'); 
	      $seq3=$this->input->post('tb003c'); 
	      $seq4=$this->input->post('tb004c'); 
	      $sql = " SELECT tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb008,tb009 FROM purtb 
		  WHERE tb001 = '$seq1'  AND tb002 = '$seq2' AND tb003 >= '$seq3' AND tb003 <= '$seq4' "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		
          $seq32 = "tb001 = '$seq1'  AND tb002 = '$seq2' AND tb003 >= '$seq3' AND tb003 <= '$seq4' ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                    ->from('purtb')
		                    ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
	*/
	//更改一筆	 
	function updatef()   //更改一筆
        {
        $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,		       
		      //  'tb004' => $this->input->post('tb004'),
		      //  'tb005' => $this->input->post('tb005'),
		      //  'tb006' => $this->input->post('tb006'),
             //   'tb007' => $this->input->post('tb007'),
		        'tb008' => $this->input->post('cmsq03a'),
		     //   'tb009' => $this->input->post('tb009'),
                'tb010' => $this->input->post('purq01a'),
		    //    'tb011' => $this->input->post('tb011'),
		        'tb012' => $this->input->post('tb012'),
                'tb013' => $this->input->post('cmsq09a4'),
		        'tb014' => $this->input->post('tb014'),
		        'tb015' => $this->input->post('tb015'),   
                'tb016' => $this->input->post('cmsq06a'),
		        'tb017' => $this->input->post('tb017'),
		        'tb018' => $this->input->post('tb018'),
                'tb019' => substr($this->input->post('tb019'),0,4).substr($this->input->post('tb019'),5,2).substr($this->input->post('tb019'),8,2),
                'tb020' => $this->input->post('tb020'),
                'tb021' => $this->input->post('tb021'),
		        'tb022' => $this->input->post('tb022'),
                'tb023' => $this->input->post('tb023'),
		    //    'tb024' => $this->input->post('tb024'),
		        'tb025' => $this->input->post('tb025'),   
                'tb026' => $this->input->post('tb026'),
		     //   'tb027' => $this->input->post('tb027'),
		     //  'tb028' => $this->input->post('tb028'),
                'tb029' => $this->input->post('tb029'),
                'tb030' => $this->input->post('tb030'),
                'tb031' => $this->input->post('tb031'),
		        'tb032' => $this->input->post('tb032'),
                'tb033' => $this->input->post('tb033'),
		        'tb034' => $this->input->post('tb034'),
		        'tb035' => $this->input->post('tb035'),   
                'tb036' => $this->input->post('tb036'),
		        'tb037' => $this->input->post('tb037'),
		        'tb038' => $this->input->post('tb038'),
                'tb039' => $this->input->post('tb039')			
                     );
          $this->db->where('tb001', $this->input->post('tb001'));
	      $this->db->where('tb002', $this->input->post('tb002'));
		  $this->db->where('tb003', $this->input->post('tb003'));
          $this->db->update('purtb',$data);                   
          if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;
        }
		
	//刪除一筆	
	function deletef($seg1,$seg2)      
        {  
	      $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $this->db->where('tb001', $seg1);
	      $this->db->where('tb002', $seg2);
          $this->db->delete('purtb'); 
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
			 $this->db->where('tb001', $seq1);
			 $this->db->where('tb002', $seq2);
             $this->db->delete('purtb'); 
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