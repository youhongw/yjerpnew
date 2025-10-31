<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class invq02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006,mb008,mb010,mb011,mb013, create_date');
          $this->db->from('invmb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('invmb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb017', 'mb064','mb065','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mb001, mb002, mb003, mb004, mb017, mb064, mb065,create_date')
	                       ->from('invmb')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invmb');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1)    
        {
		  $this->db->select('a.* ,c.mc002 AS mb017disp,d.mc002 as mc002disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mc001, b.mc002, b.mc003, b.mc004, b.mc007,
		  b.mc008, b.mc012, b.mc013');
		 
        $this->db->from('invmb as a');	
        $this->db->join('invmc as b', 'a.mb001 = b.mc001   ','left');		
		$this->db->join('cmsmc as c', 'a.mb017 = c.mc001  ','left');
		$this->db->join('cmsmc as d', 'b.mc002 = d.mc001  ','left');
		$this->db->where('a.mb001', $this->uri->segment(4)); 
		$this->db->order_by('mb001 , mb017');
		
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
		
	//ajax 查詢 顯示 請購單別 mc001	
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
		
	//ajax 查詢顯示用 廠別 mb010  
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
	      $this->db->select_max('mb002');
		  $this->db->where('mb001', $this->uri->segment(4));
	      $this->db->where('mb013', $this->uri->segment(5));
		  $query = $this->db->get('invmb');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `invmb` ";
	      $seq1 = "mb001, mb002, mb003, mb004, mb017, mb064,mb065,mb08,mb010,mb011,mb013,mb012,mb016, create_date FROM `invmb` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mb001 desc' ;
          $seq9 = " ORDER BY mb001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="mb001 ";

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
		if(@$_SESSION['invq02_sql_term']){$seq32 = $_SESSION['invq02_sql_term'];}
		if(@$_SESSION['invq02_sql_sort']){$seq33 = $_SESSION['invq02_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006','mb007','mb008','mb010','mb011','mb013','mb012','mb016','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mb001, mb002, mb003, mb004, , mb017, mb064,mb065,mb010,mb011,mb013,mb012,mb016, create_date')
	                       ->from('invmb')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invmb')
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
	      $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb017', 'mb064','mb065','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否為 table
	      $this->db->select('mb001, mb002, mb003, mb004, mb017, mb064,mb065, create_date');
	      $this->db->from('invmb');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mb001 asc, mb002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('invmb');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('mb001', $this->input->post('purq04a31'));
		  $this->db->where('mb002', $this->input->post('mb002'));
	      $query = $this->db->get('invmb');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('mc001', $this->input->post('purq04a31'));
		  $this->db->where('mc002', $this->input->post('mb002'));
	      $query = $this->db->get('invmc');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  invmb	
	function insertf()    //新增一筆 檔頭  invmb
        {
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mb001' => $this->input->post('purq04a31'),
		         'mb002' => $this->input->post('mb002'),
		         'mb003' => substr($this->input->post('mb003'),0,4).substr($this->input->post('mb003'),5,2).substr(rtrim($this->input->post('mb003')),8,2),
		         'mb004' => $this->input->post('cmsq05a'),
		         'mb005' => $this->input->post('mb005'),
		         'mb006' => $this->input->post('mb006'),
                 'mb007' => 'Y',
                 'mb008' => 0,
                 'mb009' => '9',
                 'mb010' => strtoupper($this->input->post('cmsq02a')),		
                 'mb011' => $this->input->post('mb011'),		
                 'mb012' => $this->input->post('palq01a'),
                 'mb013' => substr($this->input->post('mb013'),0,4).substr($this->input->post('mb013'),5,2).substr(rtrim($this->input->post('mb013')),8,2),
                 'mb014' => $this->session->userdata('manager'),		
                 'mb015' => $this->input->post('mb015'),		
                 'mb016' => 'N'		
                 
                );
         
	      $exist = $this->invq02_model->selone1($this->input->post('purq04a31'),$this->input->post('mb002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('invmb', $data);
			
		// 新增明細 invmc
			
			    $n = '0';
		//	while (($_POST['order_product'][  $n  ]['mc004']) > '0' ) {
			while ($_POST['order_product'][  $n  ]['mc004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $this->input->post('purq04a31'),
		         'mc002' => $this->input->post('mb002'),
		         'mc003' =>  $_POST['order_product'][ $n  ]['mc003'],
		         'mc004' => $_POST['order_product'][ $n  ]['mc004'],
		         'mc005' => $_POST['order_product'][ $n  ]['mc005'],
		         'mc006' => $_POST['order_product'][ $n  ]['mc006'],
                 'mc007' => $_POST['order_product'][ $n  ]['mc007'],			
                 'mc011' =>  substr($_POST['order_product'][ $n  ]['mc011'],0,4).substr($_POST['order_product'][ $n ]['mc011'],5,2).substr($_POST['order_product'][ $n ]['mc011'],8,2),
                 'mc009' =>  $_POST['order_product'][ $n  ]['mc009'],
                 'mc017' =>  $_POST['order_product'][ $n  ]['mc017'],		
                 'mc018' =>  $_POST['order_product'][ $n  ]['mc018'],
                 'mc012' =>  $_POST['order_product'][ $n  ]['mc012']
                );   
						 
	      $exist = $this->invq02_model->selone1d($this->input->post('purq04a31'),$this->input->post('mb002'));
		  $this->db->insert('invmc', $data_array);
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('mb001', $this->input->post('mb001c')); 
          $this->db->where('mb002', $this->input->post('mb002c'));
	      $query = $this->db->get('invmb');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('mb001', $this->input->post('mb001o'));
			$this->db->where('mb002', $this->input->post('mb002o'));
	        $query = $this->db->get('invmb');
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
                $mb003=$row->mb003;$mb004=$row->mb004;$mb005=$row->mb005;$mb006=$row->mb006;$mb007=$row->mb007;$mb008=$row->mb008;$mb009=$row->mb009;$mb010=$row->mb010;
				$mb011=$row->mb011;$mb012=$row->mb012;$mb013=$row->mb013;$mb014=$row->mb014;$mb015=$row->mb015;$mb016=$row->mb016;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mb001c');    //主鍵一筆檔頭invmb
			$seq2=$this->input->post('mb002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mb001' => $seq1,'mb002' => $seq2,'mb003' => $mb003,'mb004' => $mb004,'mb005' => $mb005,'mb006' => $mb006,'mb007' => $mb007,'mb008' => $mb008,'mb009' => $mb009,'mb010' => $mb010,
		           'mb011' => $mb011,'mb012' => $mb012,'mb013' => $mb013,'mb014' => $mb014,'mb015' => $mb015,'mb016' => $mb016
                   );
				   
            $exist = $this->invq02_model->selone2($this->input->post('mb001c'),$this->input->post('mb002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('invmb', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('mc001', $this->input->post('mb001o'));
			$this->db->where('mc002', $this->input->post('mb002o'));
	        $query = $this->db->get('invmc');
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
                 $mc003[$i]=$row->mc003;$mc004[$i]=$row->mc004;$mc005[$i]=$row->mc005;$mc006[$i]=$row->mc006;$mc007[$i]=$row->mc007;
				 $mc009[$i]=$row->mc009;$mc011[$i]=$row->mc011;$mc017[$i]=$row->mc017;$mc018[$i]=$row->mc018;$mc012[$i]=$row->mc012;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('mb001c');    //主鍵一筆明細invmc
			$seq2=$this->input->post('mb002c'); 
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
                'mc001' => $seq1,'mc002' => $seq2,'mc003' => $mc003[$i],'mc004' => $mc004[$i],'mc005' => $mc005[$i],'mc006' => $mc006[$i],'mc007' => $mc007[$i],
		         'mc009' => $mc009[$i],'mc011' => substr($mc011[$i],0,4).substr($mc011[$i],5,2).substr($mc011[$i],8,2),'mc017' => $mc017[$i],'mc018' => $mc018[$i],'mc012' => $mc012[$i]
                ); 
				
             $this->db->insert('invmc', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mb001o');    
	      $seq2=$this->input->post('mb001c');
		//  $seq3=$this->input->post('mb002o');    
	    //  $seq4=$this->input->post('mb002c');
	      $sql = " SELECT mb001,mb002,mb003,mb004,mb064,mb065,create_date FROM invmb WHERE mb001 >= '$seq1'  AND mb001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('mb001o');    
	      $seq2=$this->input->post('mb001c');
		//  $seq3=$this->input->post('mb002o');    
	   //   $seq4=$this->input->post('mb002c');
	      $sql = " SELECT * FROM invmb WHERE mb001 >= '$seq1'  AND mb001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "mb001 >= '$seq1'  AND mb001 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('invmb')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS mb001disp, d.me002 AS mb004disp, e.mb002 AS mb010disp, f.mv002 AS mb012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mc001, b.mc002, b.mc003, b.mc004, b.mc005,
		  b.mc006, b.mc007, b.mc011, b.mc009, b.mc017, b.mc018, b.mc012');
		 
        $this->db->from('invmb as a');	
        $this->db->join('invmc as b', 'a.mb001 = b.mc001  and a.mb002=b.mc002 ','left');		
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mb004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mb010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mb012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.mc003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mc001', $this->uri->segment(4));
		$this->db->where('mc002', $this->uri->segment(5));
	    $query = $this->db->get('invmc');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS mb001disp, d.me002 AS mb004disp, e.mb002 AS mb010disp, f.mv002 AS mb012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mc001, b.mc002, b.mc003, b.mc004, b.mc005,
		  b.mc006, b.mc007, b.mc011, b.mc009, b.mc017, b.mc018, b.mc012');
		 
        $this->db->from('invmb as a');	
        $this->db->join('invmc as b', 'a.mb001 = b.mc001  and a.mb002=b.mc002 ','left');		
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mb004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mb010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mb012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mb001', $this->input->post('mb001o')); 
	    $this->db->where('a.mb002', $this->input->post('mb002o')); 
		$this->db->order_by('mb001 , mb002 ,b.mc003');
		
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
          $this->db->select('a.* ,c.mq002 AS mb001disp, d.me002 AS mb004disp, e.mb002 AS mb010disp, f.mv002 AS mb012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mc001, b.mc002, b.mc003, b.mc004, b.mc005,
		  b.mc006, b.mc007, b.mc011, b.mc009, b.mc017, b.mc018, b.mc012');
		 
        $this->db->from('invmb as a');	
        $this->db->join('invmc as b', 'a.mb001 = b.mc001  and a.mb002=b.mc002 ','left');		
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mb004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mb010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mb012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.mc003');
		
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
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'mb003' => substr($this->input->post('mb003'),0,4).substr($this->input->post('mb003'),5,2).substr($this->input->post('mb003'),8,2),
			    'mb004' => $this->input->post('cmsq05a'),
		        'mb005' => $this->input->post('mb005'),'mb006' => $this->input->post('mb006'),'mb007' => $this->input->post('mb007'),
                'mb008' => $this->input->post('mb008'),'mb009' => $this->input->post('mb009'),'mb010' => $this->input->post('cmsq02a'),
                'mb011' => $this->input->post('mb011'),'mb012' => $this->input->post('palq01a'),
				'mb013' => substr($this->input->post('mb013'),0,4).substr($this->input->post('mb013'),5,2).substr($this->input->post('mb013'),8,2),
                'mb014' => $this->input->post('mb014'),'mb015' => $this->input->post('mb015'),'mb016' => $this->input->post('mb016')
                );
            $this->db->where('mb001', $this->input->post('purq04a31'));
			$this->db->where('mb002', $this->input->post('mb002'));
            $this->db->update('invmb',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('mc001', $this->input->post('purq04a31'));
			$this->db->where('mc002', $this->input->post('mb002'));
            $this->db->delete('invmc'); 
			
			$this->db->flush_cache();  
			// 新增明細 invmc
			
			    $n = '0';		
				$mc003='1000';
			while ($_POST['order_product'][  $n  ]['mc004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mc001' => $this->input->post('purq04a31'),
		         'mc002' => $this->input->post('mb002'),
		         'mc003' =>  $mc003,
		         'mc004' => $_POST['order_product'][ $n  ]['mc004'],
		         'mc005' => $_POST['order_product'][ $n  ]['mc005'],
		         'mc006' => $_POST['order_product'][ $n  ]['mc006'],
                 'mc007' => $_POST['order_product'][ $n  ]['mc007'],			
                 'mc011' =>  substr($_POST['order_product'][ $n  ]['mc011'],0,4).substr($_POST['order_product'][ $n ]['mc011'],5,2).substr($_POST['order_product'][ $n ]['mc011'],8,2),
                 'mc009' =>  $_POST['order_product'][ $n  ]['mc009'],
                 'mc017' =>  $_POST['order_product'][ $n  ]['mc017'],		
                 'mc018' =>  $_POST['order_product'][ $n  ]['mc018'],
                 'mc012' =>  $_POST['order_product'][ $n  ]['mc012']
                );  
		     $this->db->insert('invmc', $data_array);
			 $mmc003 = (int) $mc003+10;
			 $mc003 =  (string)$mmc003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '10';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 while ($_POST['order_product'][  $n  ]['mc004']) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mc001' => $this->input->post('purq04a31'),
		         'mc002' => $this->input->post('mb002'),
		         'mc003' =>  $mc003,
		         'mc004' => $_POST['order_product'][ $n  ]['mc004'],
		         'mc005' => $_POST['order_product'][ $n  ]['mc005'],
		         'mc006' => $_POST['order_product'][ $n  ]['mc006'],
                 'mc007' => $_POST['order_product'][ $n  ]['mc007'],			
                 'mc011' =>  substr($_POST['order_product'][ $n  ]['mc011'],0,4).substr($_POST['order_product'][ $n ]['mc011'],5,2).substr($_POST['order_product'][ $n ]['mc011'],8,2),
                 'mc009' =>  $_POST['order_product'][ $n  ]['mc009'],
                 'mc017' =>  $_POST['order_product'][ $n  ]['mc017'],		
                 'mc018' =>  $_POST['order_product'][ $n  ]['mc018'],
                 'mc012' =>  $_POST['order_product'][ $n  ]['mc012']
                );   
			$this->db->insert('invmc', $data_array);
			$mmc003 = (int) $mc003+10;
			$mc003 =  (string)$mmc003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mb001', $this->uri->segment(4));
		  $this->db->where('mb002', $this->uri->segment(5));
          $this->db->delete('invmb'); 
		  $this->db->where('mc001', $this->uri->segment(4));
		  $this->db->where('mc002', $this->uri->segment(5));
          $this->db->delete('invmc'); 
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
			      $this->db->where('mb001', $seq1);
			      $this->db->where('mb002', $seq2);
                  $this->db->delete('invmb'); 
				  $this->db->where('mc001', $seq1);
			      $this->db->where('mc002', $seq2);
                  $this->db->delete('invmc'); 
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