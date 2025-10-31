<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puri07_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tc001, tc002, tc003, tc004, tc0011, tc0019,tc020, create_date');
          $this->db->from('purtc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tc001 desc, tc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('purtc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006','tc011','tc018','tc014','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006, tc011, tc018, tc014,create_date')
	                       ->from('purtc')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purtc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp, f.mv002 AS tc011disp,g.na003 AS tc027disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		  b.tc006, b.tc007, b.tc008, b.tc009, b.tc010, b.tc011, b.tc012, b.tc014,b.tc016,i.mc002 as tc007disp');
		 
        $this->db->from('purtc as a');	
        $this->db->join('purtd as b', 'a.tc001 = b.tc001  and a.tc002=b.tc002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="33" ','left');
	    $this->db->join('cmsmb as d', 'a.tc010 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc005 = e.mf001 ','left');		
		$this->db->join('cmsmv as f ', 'a.tc011 = f.mv001 and f.mv022 = " " ','left');
		$this->db->join('cmsna as g ', 'a.tc027 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.tc004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.tc007 = i.mc001 ','left');
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.tc003');
		
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
	//ajax 查詢 顯示 請購單別 tc001	
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
	      $this->db->where('tc024', $this->uri->segment(5));
		  $query = $this->db->get('purtc');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `purtc` ";
	      $seq1 = "tc001, tc002, tc003, tc004, tc005, tc006,tc007,tc08,tc010,tc011,tc018,tc014, create_date FROM `purtc` ";
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
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006','tc007','tc008','tc010','tc011','tc018','tc014','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006,tc007,tc008,tc010,tc011,tc018,tc014, create_date')
	                       ->from('purtc')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purtc')
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
	      $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc011', 'tc019','tc020','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	      $this->db->select('tc001, tc002, tc003, tc004, tc011, tc019,tc020, create_date');
	      $this->db->from('purtc');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tc001 asc, tc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('purtc');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tc001', $this->input->post('purq04a33'));
		  $this->db->where('tc002', $this->input->post('tc002'));
	      $query = $this->db->get('purtc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tc001', $this->input->post('purq04a33'));
		  $this->db->where('tc002', $this->input->post('tc002'));
	      $query = $this->db->get('purtd');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  purtc	
	function insertf()    //新增一筆 檔頭  purtc
        {
		 //    $tax=round($this->input->post('tc019')*$this->input->post('tc026'));
		  //   if ($this->input->post('tc018')=='1') {$tc019=round($this->input->post('tc019')-$tax);}
		//	 if ($this->input->post('tc018')!='1') {$tc019=round($this->input->post('tc019'));}
		$tc019=0;$tc020=0;$tc023=0;
			$tc026=round($this->input->post('tc026'));
			$tc006=round($this->input->post('tc006'));
			
			$tc001=round($this->input->post('purq04a33'));
			$tc002=round($this->input->post('tc002'));
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tc001' => $this->input->post('purq04a33'),
		         'tc002' => $this->input->post('tc002'),
		         'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $this->input->post('purq01a'),
		         'tc005' => $this->input->post('cmsq06a'),
		         'tc006' => $this->input->post('tc006'),
                 'tc007' => $this->input->post('tc007'),
                 'tc008' => $this->input->post('tc008'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => strtoupper($this->input->post('cmsq02a')),		
                 'tc011' => $this->input->post('cmsq09a4'),		
                 'tc012' => $this->input->post('palq01a'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('tc014'),			
                 'tc015' => $this->input->post('tc015'),	
                 'tc016' => $this->input->post('tc016'),
                 'tc017' => $this->input->post('tc017'),
                 'tc018' => $this->input->post('tc018'),
                 'tc019' => $this->input->post('tc019'),
                 'tc020' => $this->input->post('tc020'),
                 'tc021' => $this->input->post('tc021'),
				 'tc022' => $this->input->post('tc022'),
				 'tc023' => $this->input->post('tc023'),
                 'tc024' => substr($this->input->post('tc024'),0,4).substr($this->input->post('tc024'),5,2).substr(rtrim($this->input->post('tc024')),8,2),
                 'tc025' => $this->session->userdata('manager'),
                 'tc026' => $this->input->post('tc026'),
                 'tc027' => $this->input->post('cmsq21a1'),
                 'tc028' => $this->input->post('tc028'),
                 'tc029' => $this->input->post('tc029'),
                 'tc030' => $this->input->post('tc030')
                 
                );
         
	      $exist = $this->puri07_model->selone1($this->input->post('purq04a33'),$this->input->post('tc002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('purtc', $data);
			
		// 新增明細 purtd
			
			    $n = '0';
		//	while (($_POST['order_product'][  $n  ]['tc004']) > '0' ) {
			while ($_POST['order_product'][  $n  ]['tc004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tc001' => $this->input->post('purq04a33'),
		         'tc002' => $this->input->post('tc002'),
		         'tc003' =>  $_POST['order_product'][ $n  ]['tc003'],
		         'tc004' => $_POST['order_product'][ $n  ]['tc004'],
		         'tc005' => $_POST['order_product'][ $n  ]['tc005'],
		         'tc006' => $_POST['order_product'][ $n  ]['tc006'],
                 'tc007' => $_POST['order_product'][ $n  ]['tc007'],
                 'tc008' =>  $_POST['order_product'][ $n  ]['tc008'],
				 'tc009' =>  $_POST['order_product'][ $n  ]['tc009'],
				 'tc010' =>  $_POST['order_product'][ $n  ]['tc010'],
                 'tc011' =>  $_POST['order_product'][ $n  ]['tc011'],
                 'tc012' =>  substr($_POST['order_product'][ $n  ]['tc012'],0,4).substr($_POST['order_product'][ $n ]['tc012'],5,2).substr($_POST['order_product'][ $n ]['tc012'],8,2),
                 'tc014' =>  $_POST['order_product'][ $n  ]['tc014'],
				 'tc014' =>  $_POST['order_product'][ $n  ]['tc016']
                );   
						 
	      $exist = $this->puri07_model->selone1d($this->input->post('purq04a33'),$this->input->post('tc002'));
		  $this->db->insert('purtd', $data_array);
		  $tc019=$tc019+ $_POST['order_product'][ $n  ]['tc011'];
			  $tc023=$tc023+ $_POST['order_product'][ $n  ]['tc008'];
		  
		  
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			//重新計算數量金額 purtc  幣別, 匯率整張計算 
			    $tc020=round($tc019*$tc026,0);  //稅額
		        if ($this->input->post('tc018')=='1') {$tc019=$tc019-$tc020;}
		        if ($this->input->post('tc018')>'1') {$tc019=$tc019;}
			 
		  $sql = " UPDATE purtc set tc019='$tc019',tc020='$tc020',tc023='$tc023' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		  $query = $this->db->query($sql);	
		  return true;
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tc001', $this->input->post('tc001c')); 
          $this->db->where('tc002', $this->input->post('tc002c'));
	      $query = $this->db->get('purtc');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('purtc');
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
				$tc029=$row->tc029;$tc030=$row->tc030;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tc001c');    //主鍵一筆檔頭purtc
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
				   'tc025' => $tc025,'tc026' => $tc026,'tc027' => $tc027,'tc028' => $tc028,'tc029' => $tc029,'tc030' => $tc030
                   );
				   
            $exist = $this->puri07_model->selone2($this->input->post('tc001c'),$this->input->post('tc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('purtc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('purtd');
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
                 $tc003[$i]=$row->tc003;$tc004[$i]=$row->tc004;$tc005[$i]=$row->tc005;$tc006[$i]=$row->tc006;$tc007[$i]=$row->tc007;
				 $tc008[$i]=$row->tc008;$tc009[$i]=$row->tc009;$tc010[$i]=$row->tc010;$tc011[$i]=$row->tc011;$tc012[$i]=$row->tc012;
				 $tc013[$i]=$row->tc013;$tc014[$i]=$row->tc014;$tc015[$i]=$row->tc015;$tc016[$i]=$row->tc016;$tc017[$i]=$row->tc017;
				 $tc018[$i]=$row->tc018;$tc019[$i]=$row->tc019;$tc020[$i]=$row->tc020;$tc021[$i]=$row->tc021;$tc022[$i]=$row->tc022;
			     $tc023[$i]=$row->tc023;$tc024[$i]=$row->tc024;$tc025[$i]=$row->tc025;$tc026[$i]=$row->tc026;$tc027[$i]=$row->tc027;
				 $tc028[$i]=$row->tc028;$tc029[$i]=$row->tc029;$tc030[$i]=$row->tc030;$tc031[$i]=$row->tc031;$tc032[$i]=$row->tc032;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tc001c');    //主鍵一筆明細purtd
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
                'tc001' => $seq1,'tc002' => $seq2,'tc003' => $tc003[$i],'tc004' => $tc004[$i],'tc005' => $tc005[$i],'tc006' => $tc006[$i],'tc007' => $tc007[$i],
		         'tc008' => $tc008[$i],'tc009' => $tc009[$i],'tc010' => $tc010[$i],'tc011' => $tc011[$i],'tc012' => $tc012[$i],'tc013' => $tc013[$i],
				 'tc014' => $tc014[$i],'tc015' => $tc015[$i],'tc016' => $tc016[$i],'tc017' => $tc017[$i],'tc018' => $tc018[$i],'tc019' => $tc019[$i],
				 'tc020' => $tc020[$i],'tc021' => $tc021[$i],'tc022' => $tc022[$i],'tc023' => $tc023[$i],'tc024' => $tc024[$i],'tc025' => $tc025[$i],
				 'tc026' => $tc026[$i],'tc027' => $tc027[$i],'tc028' => $tc028[$i],'tc029' => $tc029[$i],'tc030' => $tc030[$i],'tc031' => $tc031[$i],'tc032' => $tc032[$i]
                ); 
				
             $this->db->insert('purtd', $data_array);      //複製一筆 
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
	      $sql = " SELECT tc001,tc002,tc024,tc004,tc011,tc003,create_date FROM purtc WHERE tc001 >= '$seq1'  AND tc001 <= '$seq2' AND  tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
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
	   /*   $sql = " SELECT * FROM purtc WHERE tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
		  
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result(); */
		 $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp, f.mv002 AS tc011disp,g.na003 AS tc027disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		  b.tc006, b.tc007, b.tc008, b.tc009, b.tc010, b.tc011, b.tc012, b.tc014,b.tc015,i.mc002 as tc007disp');
		 
        $this->db->from('purtc as a');	
        $this->db->join('purtd as b', 'a.tc001 = b.tc001  and a.tc002=b.tc002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="33" ','left');
	    $this->db->join('cmsmb as d', 'a.tc010 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc005 = e.mf001 ','left');		
		$this->db->join('cmsmv as f ', 'a.tc011 = f.mv001 and f.mv022 = " " ','left');
		$this->db->join('cmsna as g ', 'a.tc027 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.tc004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.tc007 = i.mc001 ','left');
		$this->db->where('a.tc001 >=',$seq1); 
		$this->db->where('a.tc001 <=', $seq2); 
	    $this->db->where('a.tc002 >=', $seq3); 
		$this->db->where('a.tc002 <=', $seq4); 
		$this->db->order_by('tc001 , tc002 ,b.tc003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		  
          $seq32 = "tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('purtc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tc001disp, d.me002 AS tc004disp, e.mb002 AS tc010disp, f.mv002 AS tc012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		  b.tc006, b.tc007, b.tc011, b.tc009, b.tc017, b.tc018, b.tc012');
		 
        $this->db->from('purtc as a');	
        $this->db->join('purtd as b', 'a.tc001 = b.tc001  and a.tc002=b.tc002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tc004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tc010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tc012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.tc003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tc001', $this->uri->segment(4));
		$this->db->where('tc002', $this->uri->segment(5));
	    $query = $this->db->get('purtd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tc001disp, d.mf002 AS tc005disp, e.mb002 AS tc010disp, f.mv002 AS tc011disp,h.mb007 AS tc017disp,
		   i.ma002 AS tc027disp,g.ma002 AS tc004disp,g.ma014 AS tc004disp1,g.ma013 AS tc004disp2,g.ma008 AS tc004disp3,g.ma009 AS tc004disp4,g.ma051 AS tc004disp5,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		  b.tc006, b.tc007,b.tc008,b.tc009,b.tc010, b.tc011, b.tc012, b.tc013, b.tc014,b.tc015,b.tc016,b.tc017,b.tc020,b.tc021,b.tc022,b.tc025,b.tc027');
		 
        $this->db->from('purtc as a');	
        $this->db->join('purtd as b', 'a.tc001 = b.tc001  and a.tc002=b.tc002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="33" ','left');
		$this->db->join('cmsmf as d', 'a.tc005 = d.mf001 ','left');
	    $this->db->join('cmsmb as e', 'a.tc010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tc011 = f.mv001 and f.mv022 = " " ','left');
        $this->db->join('purma as g', 'a.tc004 = g.ma001 ','left');	
        $this->db->join('purmb as h', 'b.tc004 = h.mb001 and a.tc004 = h.mb002 and a.tc005 = h.mb003 ','left');
		$this->db->join('cmsma as i', 'a.tc027 = i.ma001 ','left');		
		$this->db->where('a.tc001', $this->input->post('tc001o')); 
	    $this->db->where('a.tc002', $this->input->post('tc002o')); 
		$this->db->order_by('tc001 , tc002 ,b.tc003');
		
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
          $this->db->select('a.* ,c.mq002 AS tc001disp, d.mf002 AS tc005disp, e.mb002 AS tc010disp, f.mv002 AS tc011disp,h.mb007 AS tc017disp,
		   i.ma002 AS tc027disp,g.ma002 AS tc004disp,g.ma014 AS tc004disp1,g.ma013 AS tc004disp2,g.ma008 AS tc004disp3,g.ma009 AS tc004disp4,g.ma051 AS tc004disp5,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tc001, b.tc002, b.tc003, b.tc004, b.tc005,
		  b.tc006, b.tc007,b.tc008,b.tc009,b.tc010, b.tc011, b.tc012, b.tc013, b.tc014,b.tc015,b.tc016,b.tc017,b.tc020,b.tc021,b.tc022,b.tc025,b.tc027');
		 
        $this->db->from('purtc as a');	
        $this->db->join('purtd as b', 'a.tc001 = b.tc001  and a.tc002=b.tc002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="33" ','left');
		$this->db->join('cmsmf as d', 'a.tc005 = d.mf001 ','left');
	    $this->db->join('cmsmb as e', 'a.tc010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tc011 = f.mv001 and f.mv022 = " " ','left');
        $this->db->join('purma as g', 'a.tc004 = g.ma001 ','left');	
        $this->db->join('purmb as h', 'b.tc004 = h.mb001 and a.tc004 = h.mb002 and a.tc005 = h.mb003 ','left');
		$this->db->join('cmsma as i', 'a.tc027 = i.ma001 ','left');	
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.tc003');
		
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
			$tc019=0;$tc020=0;$tc023=0;
			$tc026=round($this->input->post('tc026'));
			$tc006=round($this->input->post('tc006'));
			
			$tc001=round($this->input->post('purq04a33'));
			$tc002=round($this->input->post('tc002'));
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $this->input->post('purq01a'),
		         'tc005' => $this->input->post('cmsq06a'),
		         'tc006' => $this->input->post('tc006'),
                 'tc007' => $this->input->post('tc007'),
                 'tc008' => $this->input->post('tc008'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => strtoupper($this->input->post('cmsq02a')),		
                 'tc011' => $this->input->post('cmsq09a4'),		
                 'tc012' => $this->input->post('palq01a'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('tc014'),			
                 'tc015' => $this->input->post('tc015'),	
                 'tc016' => $this->input->post('tc016'),
                 'tc017' => $this->input->post('tc017'),
                 'tc018' => $this->input->post('tc018'),
                 'tc019' => $this->input->post('tc019'),
                 'tc020' => $this->input->post('tc020'),
                 'tc021' => $this->input->post('tc021'),
				 'tc022' => $this->input->post('tc022'),
				 'tc023' => $this->input->post('tc023'),
                 'tc024' => substr($this->input->post('tc024'),0,4).substr($this->input->post('tc024'),5,2).substr(rtrim($this->input->post('tc024')),8,2),
                 'tc025' => $this->session->userdata('manager'),
                 'tc026' => $this->input->post('tc026'),
                 'tc027' => $this->input->post('cmsq21a1'),
                 'tc028' => $this->input->post('tc028'),
                 'tc029' => $this->input->post('tc029'),
                 'tc030' => $this->input->post('tc030')
                );
            $this->db->where('tc001', $this->input->post('purq04a33'));
			$this->db->where('tc002', $this->input->post('tc002'));
            $this->db->update('purtc',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tc001', $this->input->post('purq04a33'));
			$this->db->where('tc002', $this->input->post('tc002'));
            $this->db->delete('purtd'); 
			
			$this->db->flush_cache();  
			// 新增明細 purtd
			
			    $n = '0';		
				$tc003='1000';
			while ($_POST['order_product'][  $n  ]['tc004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                  'tc001' => $this->input->post('purq04a33'),
		         'tc002' => $this->input->post('tc002'),
		         'tc003' =>  $tc003,
		         'tc004' => $_POST['order_product'][ $n  ]['tc004'],
		         'tc005' => $_POST['order_product'][ $n  ]['tc005'],
		         'tc006' => $_POST['order_product'][ $n  ]['tc006'],
                 'tc007' => $_POST['order_product'][ $n  ]['tc007'],
                 'tc008' =>  $_POST['order_product'][ $n  ]['tc008'],
				 'tc009' =>  $_POST['order_product'][ $n  ]['tc009'],
				 'tc010' =>  $_POST['order_product'][ $n  ]['tc010'],
                 'tc011' =>  $_POST['order_product'][ $n  ]['tc011'],
                 'tc012' =>  substr($_POST['order_product'][ $n  ]['tc012'],0,4).substr($_POST['order_product'][ $n ]['tc012'],5,2).substr($_POST['order_product'][ $n ]['tc012'],8,2),
                 'tc014' =>  $_POST['order_product'][ $n  ]['tc014'],
			     'tc016' =>  $_POST['order_product'][ $n  ]['tc016']
                );  
		     $this->db->insert('purtd', $data_array);
			 
			  $tc019=$tc019+ $_POST['order_product'][ $n  ]['tc011'];
			  $tc023=$tc023+ $_POST['order_product'][ $n  ]['tc008'];
			  
			 $mtc003 = (int) $tc003+10;
			 $tc003 =  (string)$mtc003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '15';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 while ($_POST['order_product'][  $n  ]['tc004']) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                  'tc001' => $this->input->post('purq04a33'),
		         'tc002' => $this->input->post('tc002'),
		         'tc003' =>  $tc003,
		         'tc004' => $_POST['order_product'][ $n  ]['tc004'],
		         'tc005' => $_POST['order_product'][ $n  ]['tc005'],
		         'tc006' => $_POST['order_product'][ $n  ]['tc006'],
                 'tc007' => $_POST['order_product'][ $n  ]['tc007'],
                 'tc008' =>  $_POST['order_product'][ $n  ]['tc008'],
				 'tc009' =>  $_POST['order_product'][ $n  ]['tc009'],
				 'tc010' =>  $_POST['order_product'][ $n  ]['tc010'],
                 'tc011' =>  $_POST['order_product'][ $n  ]['tc011'],
                 'tc012' =>  substr($_POST['order_product'][ $n  ]['tc012'],0,4).substr($_POST['order_product'][ $n ]['tc012'],5,2).substr($_POST['order_product'][ $n ]['tc012'],8,2),
                 'tc014' =>  $_POST['order_product'][ $n  ]['tc014'],
				 'tc016' =>  $_POST['order_product'][ $n  ]['tc016']
                );   
			$this->db->insert('purtd', $data_array);
			$tc019=$tc019+ $_POST['order_product'][ $n  ]['tc011'];
			  $tc023=$tc023+ $_POST['order_product'][ $n  ]['tc008'];
			
			$mtc003 = (int) $tc003+10;
			$tc003 =  (string)$mtc003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   	//重新計算數量金額 purtc  幣別, 匯率整張計算 
			    $tc020=round($tc019*$tc026,0);  //稅額
		        if ($this->input->post('tc018')=='1') {$tc019=$tc019-$tc020;}
		        if ($this->input->post('tc018')>'1') {$tc019=$tc019;}
			 
		  $sql = " UPDATE purtc set tc019='$tc019',tc020='$tc020',tc023='$tc023' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		  $query = $this->db->query($sql);	
		   
		   
			return true;
        }
	// 確認一筆	
	//查 N 才可確認  (單頭)  
	function seloney()    
        {
	      $this->db->where('tc001', $this->input->post('purq04a33'));
		  $this->db->where('tc002', $this->input->post('tc002'));
		  $this->db->where('tc014', 'N');
	      $query = $this->db->get('purtc');
	      return $query->num_rows() ;
	    }
	function yescalf($seq1,$seq2)   
        {
			//$tc001=round($this->input->post('purq04a33'));
		//	$tc002=round($this->input->post('tc002'));
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         	
                 'tc014' => 'Y',
                 'tc025' => $this->session->userdata('manager')
                );
				
		//	 $exist = $this->puri07_model->seloney();
			/*  if ($exist)
	            {
		         $this->db->where('tc001', $this->input->post('purq04a33'));
			     $this->db->where('tc002', $this->input->post('tc002'));
			     $this->db->where('tc014', 'N');
                 $this->db->update('purtc',$data);                   //確認更改一筆
				 return 'exist';
		       } else */
			    $this->db->where('tc001', $seq1);
			     $this->db->where('tc002', $seq2);
			     $this->db->where('tc014', 'N');
				$this->db->update('purtc',$data);                 //確認更改一筆
			 
          
			
			//確認明細
			$data_array = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
                'tc018' => 'Y'
                );
			$this->db->where('tc001', $seq1);
			$this->db->where('tc002', $seq2);
			$this->db->where('tc018', 'N');
            $this->db->update('purtd', $data_array);
		   
			return true;
        }
			
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tc001', $this->uri->segment(4));
		  $this->db->where('tc002', $this->uri->segment(5));
          $this->db->delete('purtc'); 
		  $this->db->where('tc001', $this->uri->segment(4));
		  $this->db->where('tc002', $this->uri->segment(5));
          $this->db->delete('purtd'); 
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
			      $this->db->where('tc001', $seq1);
			      $this->db->where('tc002', $seq2);
                  $this->db->delete('purtc'); 
				  $this->db->where('tc001', $seq1);
			      $this->db->where('tc002', $seq2);
                  $this->db->delete('purtd'); 
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