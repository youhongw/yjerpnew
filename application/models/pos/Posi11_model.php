<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class posi11_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006,tc008,tc010,tc011,tc013, a.create_date');
          $this->db->from('postc as a');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tc001 desc, tc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('postc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006','tc007','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006,tc007, a.create_date')
	                       ->from('postc as a')
						//    ->like('tc001','12', 'after')  //單別
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('postc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.*,c.ma002 as tc001disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006,b.td007, b.td008, b.td009, b.td010, b.td011');
		 
        $this->db->from('postc as a');	
        $this->db->join('postd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('posma as c', 'a.tc001 = c.ma001  ','left');  //門市單別
				
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
      $this->db->select('mb001, mb002, mb003,mb004,mb051,mb013');
	  $this->db->from('invmb as a');
	//  $this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ','left'); 
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
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupb($keyword){     
      $this->db->select('mc001, mc002')->from('cmsmc');  
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 		
	//ajax 查詢 顯示 單別 td001	
	function ajaxinvq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '12');
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
		
	//ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1,$seg2)    
        { 	              
	      $this->db->select_max('tc002');
		  $this->db->where('tc001', $this->uri->segment(4));
	      $this->db->where('tc003', $this->uri->segment(5));
		  $query = $this->db->get('postc');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `postc` ";
	      $seq1 = "tc001, tc002, tc003, tc004, tc005, tc006,tc007,tc08,tc010,tc011,tc013,tc012, create_date FROM `postc` ";
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
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006','tc007','tc008','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006,tc007,tc008, create_date')
	                       ->from('postc')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('postc')
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
	      $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004','tc005', 'tc006','tc007', 'tc008','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	      $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006,tc007,tc008, create_date');
	      $this->db->from('postc');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tc001 asc, tc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('postc');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tc001', $this->input->post('posq02a'));
		  $this->db->where('tc002', $this->input->post('tc002'));
	      $query = $this->db->get('postc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $this->input->post('posq02a'));
		  $this->db->where('td002', $this->input->post('tc002'));
		  $this->db->where('td003', $seg3);
	      $query = $this->db->get('postd');
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
	//新增一筆 檔頭  postc	
	function insertf()    //新增一筆 檔頭  postc 
        {
			 $tc001=$this->input->post('posq02a');
			 $tc002=$this->input->post('tc002');
			    if ($this->input->post('tc004')>'0') {$vtc004=substr($this->input->post('tc004'),0,4).substr($this->input->post('tc004'),5,2).substr($this->input->post('tc004'),8,2);} else {$vtc004='';}
	            if ($this->input->post('tc005')>'0') {$vtc005=substr($this->input->post('tc005'),0,2).substr($this->input->post('tc005'),3,2);} else {$vtc005='';}
				if ($this->input->post('tc006')>'0') {$vtc006=substr($this->input->post('tc006'),0,4).substr($this->input->post('tc006'),5,2).substr($this->input->post('tc006'),8,2);} else {$vtc006='';}
				if ($this->input->post('tc007')>'0') {$vtc007=substr($this->input->post('tc007'),0,2).substr($this->input->post('tc007'),3,2);} else {$vtc007='';}
		 $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tc001' => $this->input->post('posq02a'),
		         'tc002' => $this->input->post('tc002'),
		         'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $vtc004,
		         'tc005' => $vtc005,
		         'tc006' => $vtc006,
                 'tc007' => $vtc007,
                 'tc008' => $this->input->post('tc008')
                );
         
	      $exist = $this->posi11_model->selone1($this->input->post('posq02a'),$this->input->post('tc002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('postc', $data);
			
			 
		// 新增明細 postd
		 // 新增明細 postc  主檔 postc 重計算合計金額 數量
			    $tc011=0;$tc012=0;$tc011b=0;	
				 $n = '0';
				$td003='1000';		
		if (!isset($_POST['order_product'][  $n  ]['td004']) ) { $n='30'; }  
				  
		//	while (($_POST['order_product'][  $n  ]['td004']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['td004']) {
			 while (isset($_POST['order_product'][  $n  ]['td004'])) {	
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'td001' => $this->input->post('posq02a'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][ $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td008' => $_POST['order_product'][ $n  ]['td008'],
			     'td009' => $_POST['order_product'][ $n  ]['td009'],
				 'td010' => $_POST['order_product'][ $n  ]['td010'],
				 'td011' => $_POST['order_product'][ $n  ]['td011']
                );   
						 
	      $exist = $this->posi11_model->selone1d($this->input->post('posq02a'),$this->input->post('tc002'),$td003);
		    if ($_POST['order_product'][  $n  ]['td004'] >'0') {
		  $this->db->insert('postd', $data_array); }
		  
		  $tc011=$tc011+$_POST['order_product'][ $n  ]['td009'];
		  $tc012=$tc012+$_POST['order_product'][ $n  ]['td011'];
		  
		      $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 postc
		 
				return true;
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tc001', $this->input->post('tc001c')); 
          $this->db->where('tc002', $this->input->post('tc002c'));
	      $query = $this->db->get('postc');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('postc');
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
                $tc003=$row->tc003;$tc004=$row->tc004;$tc005=$row->tc005;$tc006=$row->tc006;$tc007=$row->tc007;$tc008=$row->tc008;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tc001c');    //主鍵一筆檔頭postc
			$seq2=$this->input->post('tc002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tc001' => $seq1,'tc002' => $seq2,'tc003' => $tc003,'tc004' => $tc004,'tc005' => $tc005,'tc006' => $tc006,'tc007' => $tc007,'tc008' => $tc008
                   );
				   
            $exist = $this->posi11_model->selone2($this->input->post('tc001c'),$this->input->post('tc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('postc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('td001', $this->input->post('tc001o'));
			$this->db->where('td002', $this->input->post('tc002o'));
	        $query = $this->db->get('postd');
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
                 $td003[$i]=$row->td003;$td004[$i]=$row->td004;$td005[$i]=$row->td005;$td006[$i]=$row->td006;$td007[$i]=$row->td007;$td008[$i]=$row->td008;
				 $td009[$i]=$row->td009;$td010[$i]=$row->td010;$td011[$i]=$row->td011;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tc001c');    //主鍵一筆明細postd
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
		         'td008' => $td008[$i],'td009' => $td009[$i],'td010' => $td010[$i],'td011' => $td011[$i]
                ); 
				
             $this->db->insert('postd', $data_array);      //複製一筆 
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
		 
		
	     // $sql = " SELECT tc001,tc002,tc003,tc004,tc006,tc007,tc005,tc011,td003,td004,td005,td006,td008,td007,td009,td010
		 // FROM postc as a,postd as b,copma as c
		 // WHERE tc001=td001 and tc002=td002 and tc004=ma001 and tc001 >= '$seq1'  AND tc001 <= '$seq2' AND  tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
		  
		  $sql = " SELECT a.tc001,a.tc002,a.tc003,a.tc004,a.tc005,a.tc006,a.tc007, b.td003, b.td004, b.td005,b.td006,b.td007,b.td008, b.td009,b.td010, b.td011
		  FROM postc as a
		  left join postd as b on a.tc001=b.td001 and a.tc002=b.td002
		  WHERE   tc001 >= '$seq1'  AND tc001 <= '$seq2' AND  tc002 >= '$seq3'  AND tc002 <= '$seq4'
		  order by  a.tc001,a.tc002,b.td003 "; 
		 

	/*	 $this->db->select('a.tc001,a.tc002,a.tc004,d.me002 AS tc004disp,a.tc005, e.mb002 AS tc005disp,b.td003, b.td004, b.td005,b.td006,f.mb004 as td006disp, b.td007, b.td016,b.td022');
		 
        $this->db->from('postc as a');	
        $this->db->join('postd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.tc004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.tc005 = e.mb001 ','left');  //廠別	  幣別cmsmf
		$this->db->join('invmb as f', 'b.td004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.td017 = g.mc001 ','left');  //庫別		
		$this->db->where('a.tc001 >=', $seq1); 
		$this->db->where('a.tc001 <=', $seq2); 
		$this->db->where('a.tc002 >=', $seq3); 
		$this->db->where('a.tc002 <=', $seq4); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		$query = $this->db->get();  */
		  
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
		  
	  /*    $sql = " SELECT a.tc001,a.tc002,a.tc003,a.tc004,c.me002 as tc004disp,b.td003,b.td004,td005,td006,d.mb004 as td006disp,td007,td016,td019 
		  FROM postc as a,postd as b,cmsme as c,invmb as d
		  WHERE tc001=td001 and tc002=td002 and tc004=me001 and td004=mb001 and tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
         */
		 
		  $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006,b.td008, b.td007, b.td009,b.td010,b.td011');
		 
        $this->db->from('postc as a');	
        $this->db->join('postd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
	//	$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="17" ','left');  //單別
	//	$this->db->join('cmsme as d', 'a.tc004 = d.me001 ','left');  //部門	    
	//	$this->db->join('cmsmb as e', 'a.tc008 = e.mb001 ','left');  //廠別	 
	//	$this->db->join('invmb as f', 'b.td004 = f.mb001 ','left');  //品號
    //    $this->db->join('cmsmc as g', 'b.td012 = g.mc001 ','left');  //庫別		
	//	$this->db->like('tc001','12', 'after');  //單別
		$this->db->where('a.tc001 >=', $seq1); 
		$this->db->where('a.tc001 <=', $seq2); 
		$this->db->where('a.tc002 >=', $seq3); 
		$this->db->where('a.tc002 <=', $seq4); 
	  //  $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		$query = $this->db->get();
		  
	//	  $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('postc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
	    $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007,b.td008,b.td009,b.td010, b.td011');
		 
        $this->db->from('postc as a');	
        $this->db->join('postd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
	//	$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="11" ','left');   //單別
	//	$this->db->join('copma as d', 'a.tc004 = d.ma001 ','left');	    
	//	$this->db->join('cmsmv as e ', 'a.tc005 = e.mv001 and e.mv022 = " " ','left');	
    //    $this->db->join('cmsna as f ', 'a.tc011 = f.na002 and f.na001 = "2" ','left');	
    //    $this->db->join('cmsmf as g', 'a.tc007 = g.mf001 ','left');	
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('td001', $this->uri->segment(4));
		$this->db->where('td002', $this->uri->segment(5));
	    $query = $this->db->get('postd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006,b.td008, b.td007, b.td009,b.td010,b.td011 ');
		 
        $this->db->from('postc as a');	
        $this->db->join('postd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
	//	$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="17" ','left');  //單別
	//	$this->db->join('cmsme as d', 'a.tc004 = d.me001 ','left');  //部門	    
	//	$this->db->join('cmsmb as e', 'a.tc008 = e.mb001 ','left');  //廠別	 
	//	$this->db->join('invmb as f', 'b.td004 = f.mb001 ','left');  //品號
    //    $this->db->join('cmsmc as g', 'b.td012 = g.mc001 ','left');  //庫別	
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
           $this->db->select('a.*,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006,b.td008, b.td007, b.td009,b.td010,b.td011 ');
		 
        $this->db->from('postc as a');	
        $this->db->join('postd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
	//	$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="17" ','left');  //單別
	//	$this->db->join('cmsme as d', 'a.tc004 = d.me001 ','left');  //部門	    
	//	$this->db->join('cmsmb as e', 'a.tc008 = e.mb001 ','left');  //廠別	 
	//	$this->db->join('invmb as f', 'b.td004 = f.mb001 ','left');  //品號
    //    $this->db->join('cmsmc as g', 'b.td012 = g.mc001 ','left');  //庫別	
	//    $this->db->join('cmsmc as h', 'a.tc018 = h.mc001 ','left');  //庫別a
	//	$this->db->join('cmsmc as i', 'a.tc019 = i.mc001 ','left');  //庫別b
		
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
			 $tc001=$this->input->post('posq02a');
			 $tc002=$this->input->post('tc002');
			    if ($this->input->post('tc004')>'0') {$vtc004=substr($this->input->post('tc004'),0,4).substr($this->input->post('tc004'),5,2).substr($this->input->post('tc004'),8,2);} else {$vtc004='';}
	            if ($this->input->post('tc005')>'0') {$vtc005=substr($this->input->post('tc005'),0,2).substr($this->input->post('tc005'),3,2);} else {$vtc005='';}
				if ($this->input->post('tc006')>'0') {$vtc006=substr($this->input->post('tc006'),0,4).substr($this->input->post('tc006'),5,2).substr($this->input->post('tc006'),8,2);} else {$vtc006='';}
				if ($this->input->post('tc007')>'0') {$vtc007=substr($this->input->post('tc007'),0,2).substr($this->input->post('tc007'),3,2);} else {$vtc007='';}
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $vtc004,
		         'tc005' => $vtc005,
		         'tc006' => $vtc006,
                 'tc007' => $vtc007,
                 'tc008' => $this->input->post('tc008')
                );
            $this->db->where('tc001', $this->input->post('posq02a'));
			$this->db->where('tc002', $this->input->post('tc002'));
            $this->db->update('postc',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('td001', $this->input->post('posq02a'));
			$this->db->where('td002', $this->input->post('tc002'));
            $this->db->delete('postd'); 
			
			$this->db->flush_cache();  
			// 新增明細 postd
			// 新增明細 postc  主檔 postc 重計算合計金額 數量
			    $tc011=0;$tc012=0;$td009b=0;		
			    $n = '0';		
				$td003='1000';
				while (isset($_POST['order_product'][  $n  ]['td004'])) {
		//	while ($_POST['order_product'][  $n  ]['td004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'td001' => $this->input->post('posq02a'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		        'td004' => $_POST['order_product'][ $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td008' => $_POST['order_product'][ $n  ]['td008'],
			     'td009' => $_POST['order_product'][ $n  ]['td009'],
				 'td010' => $_POST['order_product'][ $n  ]['td010'],
				 'td011' => $_POST['order_product'][ $n  ]['td011']
                );  
				 if ($_POST['order_product'][  $n  ]['td004']>'0') {
		     $this->db->insert('postd', $data_array); }
		  
		  $tc011=$tc011+$_POST['order_product'][ $n  ]['td009'];
		  $tc012=$tc012+$_POST['order_product'][ $n  ]['td011'];
			 $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
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
                 'td001' => $this->input->post('posq02a'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		        'td004' => $_POST['order_product'][ $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td008' => $_POST['order_product'][ $n  ]['td008'],
			     'td009' => $_POST['order_product'][ $n  ]['td009'],
				 'td010' => $_POST['order_product'][ $n  ]['td010'],
				 'td011' => $_POST['order_product'][ $n  ]['td011']
                );   
				if ($_POST['order_product'][  $n  ]['td004']>'0') {
		     $this->db->insert('postd', $data_array); }
		  
		  $tc011=$tc011+$_POST['order_product'][ $n  ]['td009'];
		  $tc012=$tc012+$_POST['order_product'][ $n  ]['td011'];
		  
			$mtd003 = (int) $td003+10;
			$td003 =  (string)$mtd003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		  
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tc001', $this->uri->segment(4));
		  $this->db->where('tc002', $this->uri->segment(5));
          $this->db->delete('postc'); 
		  $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('postd'); 
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
                  $this->db->delete('postc'); 
				  $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
                  $this->db->delete('postd'); 
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
		$this->db->delete('postd');
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>