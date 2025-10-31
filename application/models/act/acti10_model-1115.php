<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acti10_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta0016, ta0011,ta015, create_date');
          $this->db->from('actta');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('actta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004','ta004disp',  'ta007','ta008','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.ta001, a.ta002, a.ta003, a.ta004,b.ma003 as ta004disp, a.ta007, a.ta008,a.create_date')
	                       ->from('actta as a')
						   ->join('actma as b', 'a.ta004 = b.ma001 ','left')	
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('actta');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma003 AS tb005disp,e.me002 AS tb006disp ,
		 b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016,b.tb017,b.tb018 ');
		 
        $this->db->from('actta as a');	
        $this->db->join('acttb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="91" ','left');  //單別
	    $this->db->join('actma as d', 'b.tb005 = d.ma001 ','left');   //科目代號
		$this->db->join('cmsme as e', 'b.tb006 = e.me001 ','left');  //部門
		
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
		
	//ajax 下拉視窗查詢類 google 下拉 明細 結帳單	 
	//結帳單 來源單別,單號,幣別, 匯率, 立帳應收金額, 立帳餘額未收金額, 訂單單別,訂單單號,預計兌現日客戶代號,備註
	function lookup($keyword,$seq5){   
	
	     $this->db->select('me001, me002 ');
	//  $this->db->select('ta001, ta002, ta008,ta004,ta009,(ta028+ta029) as ta0281');
	  $this->db->from('cmsme ');
	 // $this->db->where ('te004', $seq5); 	 
      $this->db->like('me001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('me002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//退貨
	function lookup2($keyword,$seq5){     
	   // $seq5=$this->uri->segment(5);
    //  $this->db->select('mb001, mb002, mb003,mb004,mb017,b.mc002 as mb017disp');
	   $this->db->select('tj001 as th001, tj002 as th002, tj003 as th003,tj004 as th004,tj010 as th019,
	   tj030 as th045,tj031 as th046,tj032 as th047,tj033 as th048,b.ti004 as tg005');
	  $this->db->from('purtj as a');
	  $this->db->join('purti as b', "a.tj001=b.ti001 and a.tj002=b.ti002 and b.ti004='$seq5'  ",'left'); 
	//  $this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ','left'); 
      $this->db->like('th001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('th002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 
	//ajax 下拉視窗查詢類 google 下拉 明細 會計科目
	function lookupa($keyword){     
      $this->db->select('ma001, ma003,ma018')->from('actma');  
      $this->db->like('ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ma003',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
	//ajax 查詢 顯示 請購單別 tb001	
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
		
	
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('ta002');
		  $this->db->where('ta001', $this->uri->segment(4));
	      $this->db->where('ta003', $this->uri->segment(5));
		  $query = $this->db->get('actta');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `actta` ";
	      $seq1 = "ta001, ta002, ta003, ta004,ta007,ta008, ta011, ta012,ta016,ta015, create_date FROM `actta` ";
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
		//下一頁不要跑掉 1050317
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta013', 'ta018','ta007','ta008','ta012','ta011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002, ta003, ta004, ta004,b.ma002 as ta004disp,ta007,ta008, ta011,ta012,ta016,ta015, a.create_date')
	                       ->from('actta as a')
						   ->join('actma as b', 'a.ta004 = b.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('actta')
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
	      $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta004disp', 'ta007','ta008','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('ta001, ta002, ta003, ta004,b.ma002 as  ta004disp, ta007,ta008, a.create_date');
	      $this->db->from('actta as a');
		  $this->db->join('actma as b', 'a.ta004 = b.ma001 ','left'); 
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('actta');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ta001', $this->input->post('actq02a'));
		  $this->db->where('ta002', $this->input->post('ta002'));
	      $query = $this->db->get('actta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tb001', $this->input->post('actq02a'));
		  $this->db->where('tb002', $this->input->post('ta002'));
	      $query = $this->db->get('acttb');
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
 		
	//新增一筆 檔頭  actta	
	function insertf()    //新增一筆 檔頭  actta
        {
		 //    $tax=round($this->input->post('ta019')*$this->input->post('ta026'));
		  //   if ($this->input->post('ta018')=='1') {$ta019=round($this->input->post('ta019')-$tax);}
		//	 if ($this->input->post('ta018')!='1') {$ta019=round($this->input->post('ta019'));}
		     $ta001=$this->input->post('actq02a');
			 $ta002=$this->input->post('ta002');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $this->input->post('actq02a'),
		         'ta002' => $this->input->post('ta002'),
		         'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('actq03a'),
				 'ta005' => $this->input->post('ta005'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('ta010'),		
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $this->input->post('ta014'),
                 'ta015' => $this->input->post('ta015'),
				 'ta201' => $_FILES['userfile']['name'],
                 'ta016' => $this->input->post('ta016')
                );
         
	      $exist = $this->acti10_model->selone1($this->input->post('actq02a'),$this->input->post('ta002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('actta', $data);
			
		// 新增明細 acttb
				//		$this->db->flush_cache(); 
            // 新增明細 acttb  主檔 actta 重計算合計金額 數量
			    $ta011=0;$ta0071=0;$ta0081=0;$ta0072=0;$ta0082=0;$ta022b=0;				
			    $n = '0';
				$tb003='1000';
		
		
		if (!isset($_POST['order_product'][  $n  ]['tb005']) ) { $n='250'; }  
		  
		//	while ($_POST['order_product'][  $n  ]['tb004']) {		
		    while (isset($_POST['order_product'][  $n  ]['tb005'])) {
				 
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tb001' => $this->input->post('actq02a'),
		         'tb002' => $this->input->post('ta002'),
		         'tb003' =>  $tb003,
		         'tb004' => $_POST['order_product'][ $n  ]['tb004'],
		         'tb005' => $_POST['order_product'][ $n  ]['tb005'],
		         'tb006' => $_POST['order_product'][ $n  ]['tb006'],
                 'tb007' => $_POST['order_product'][ $n  ]['tb007'],
				 'tb010' =>  $_POST['order_product'][ $n  ]['tb010'],
                 'tb011' =>  $_POST['order_product'][ $n  ]['tb011'],
				 'tb012' =>  $_POST['order_product'][ $n  ]['tb012'],
				 'tb013' =>  $_POST['order_product'][ $n  ]['tb013'],
				 'tb014' =>  $_POST['order_product'][ $n  ]['tb014'],
                 'tb015' =>  $_POST['order_product'][ $n  ]['tb015'],
				 'tb016' =>  'Y'
				 
                );   
						 
	     // $exist = $this->acti10_model->selone1d($this->input->post('purq04a34'),$this->input->post('ta002'));
		  if ($_POST['order_product'][  $n  ]['tb005'] >'0') {
		  $this->db->insert('acttb', $data_array); }
		  
		    if ($_POST['order_product'][  $n  ]['tb004'] =='1') {
		      $ta0071=$ta0071+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0081=$ta0081+$_POST['order_product'][ $n  ]['tb015'];}
			else {  
			  $ta0072=$ta0072+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0082=$ta0082+$_POST['order_product'][ $n  ]['tb015'];} 
			  
		  	 $mtb003 = (int) $tb003+10;
			 $tb003 =  (string)$mtb003;
	          
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}			
			if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 actta
		  $sql = " UPDATE actta set ta007='$ta0071',ta008='$ta0072' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
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
			echo "<script>window.open('printbb/".$this->input->post('copq03a22')."/".$this->input->post('tc002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('actta');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('actta');
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
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭actta
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
		           'ta011' => $ta011,'ta012' => $ta012,'ta013' => $ta013,'ta014' => $ta014,'ta015' => $ta015,'ta016' => $ta016
				   );
				   
            $exist = $this->acti10_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('actta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('acttb');
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
                 $tb003[$i]=$row->tb003;$tb004[$i]=$row->tb004;$tb005[$i]=$row->tb005;$tb006[$i]=$row->tb006;$tb007[$i]=$row->tb007;
				 $tb008[$i]=$row->tb008;$tb009[$i]=$row->tb009;$tb010[$i]=$row->tb010;$tb011[$i]=$row->tb011;$tb012[$i]=$row->tb012;
				 $tb013[$i]=$row->tb013;$tb014[$i]=$row->tb014;$tb015[$i]=$row->tb015;$tb016[$i]=$row->tb016;$tb017[$i]=$row->tb017;
				 $tb018[$i]=$row->tb018;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細acttb
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
		         'tb008' => $tb008[$i],'tb009' => $tb009[$i],'tb010' => $tb010[$i],'tb011' => $tb011[$i],'tb012' => $tb012[$i],'tb013' => $tb013[$i],
				 'tb014' => $tb014[$i],'tb015' => $tb015[$i],'tb016' => $tb016[$i],'tb017' => $tb017[$i],'tb018' => $tb018[$i]
                ); 
				
             $this->db->insert('acttb', $data_array);      //複製一筆 
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
	  //    $sql = " SELECT ta001,ta002,ta024,ta004,ta011,ta003,create_date FROM actta WHERE ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
     
	   $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,c.ma002 as ta004disp,b.tb003,b.tb004,b.tb005,b.tb006,b.tb007,b.tb008,
		  b.tb014,b.tb015,b.tb017
		  FROM actta as a, acttb as b,copma as c WHERE ta001=tb001 and ta002=tb002 and a.ta004=c.ma001 and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.* ,c.mq002 AS ta001disp, d.ma003 AS tb005disp,e.me002 AS tb006disp ,
		 b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016,b.tb017,b.tb018
		  FROM actta as a left join acttb as b on ta001=tb001 and ta002=tb002 
		                  left join cmsmq as c on a.ta001=c.mq001
						  left join actma as d on  b.tb005 = d.ma001
						  left join cmsme as e on  b.tb006 = e.me001
		                 WHERE  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";
		
		$query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('actta')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
        $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta010disp,e.mf002 AS ta005disp,f.ml002 as ta015disp, i.ma003 as tb008disp,g.mf002 as tb010disp,
		  h.ma002 AS ta004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016, b.tb017,b.tb018,b.tb019,b.tb020,b.tb021 ');
		 
        $this->db->from('actta as a');	
        $this->db->join('acttb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="63" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta010 = d.mb001 ','left');  //廠別
		$this->db->join('cmsmf as e', 'a.ta005 = e.mf001 ','left');  //幣別
		$this->db->join('cmsml as f', 'a.ta015 = f.ml001 ','left');  //收款業務員
		$this->db->join('cmsmf as g', 'b.tb010 = g.mf001 ','left');  //幣別明細
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');  //客戶代號
		$this->db->join('actma as i', 'b.tb008 = i.ma001 ','left');   //科目代號	
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
	    $query = $this->db->get('acttb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆  一張 
	function printfc()   
      {           
         $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma003 AS tb005disp,e.me002 AS tb006disp ,
		 b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016,b.tb017,b.tb018 ');
		 
        $this->db->from('actta as a');	
        $this->db->join('acttb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="91" ','left');  //單別
	    $this->db->join('actma as d', 'b.tb005 = d.ma001 ','left');   //科目代號
		$this->db->join('cmsme as e', 'b.tb006 = e.me001 ','left');  //部門
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
	//印單據筆  半張
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma003 AS tb005disp,e.me002 AS tb006disp ,
		 b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016,b.tb017,b.tb018 ');
		 
        $this->db->from('actta as a');	
        $this->db->join('acttb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="91" ','left');  //單別
	    $this->db->join('actma as d', 'b.tb005 = d.ma001 ','left');   //科目代號
		$this->db->join('cmsme as e', 'b.tb006 = e.me001 ','left');  //部門
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
		   //  $tax=round($this->input->post('ta019')*$this->input->post('ta026'));
		  //   if ($this->input->post('ta018')=='1') {$ta019=round($this->input->post('ta019')-$tax);}
			// if ($this->input->post('ta018')!='1') {$ta019=round($this->input->post('ta019'));}
			 $ta001=$this->input->post('actq02a');
			 $ta002=$this->input->post('ta002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,		       
		        'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('actq03a'),
				 'ta005' => $this->input->post('ta005'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('ta010'),	
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $this->input->post('ta014'),
                 'ta015' => $this->input->post('ta015'),
                 'ta016' => $this->input->post('ta016')
                 
                );
			if($_FILES['userfile']['name']){
				$data['ta201'] = $_FILES['userfile']['name'];
			}
            $this->db->where('ta001', $this->input->post('actq02a'));
			$this->db->where('ta002', $this->input->post('ta002'));
            $this->db->update('actta',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tb001', $this->input->post('actq02a'));
			$this->db->where('tb002', $this->input->post('ta002'));
            $this->db->delete('acttb'); 
			
			$this->db->flush_cache();  
			// 新增明細 acttb  主檔 actta 重計算合計金額 數量
			    $ta011=0;$ta0071=0;$ta0081=0;$ta0072=0;$ta0082=0;$ta014=0;$ta022b=0;	
			    $n = '0';		
				$tb003='1000';$ta0071=0;$ta0081=0;
		//	while ($_POST['order_product'][  $n  ]['tb004']) {
			while (isset($_POST['order_product'][  $n  ]['tb005'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tb001' => $this->input->post('actq02a'),
		         'tb002' => $this->input->post('ta002'),
		         'tb003' =>  $tb003,
		         'tb004' => $_POST['order_product'][ $n  ]['tb004'],
		         'tb005' => $_POST['order_product'][ $n  ]['tb005'],
		         'tb006' => $_POST['order_product'][ $n  ]['tb006'],
                 'tb007' => $_POST['order_product'][ $n  ]['tb007'],
				 'tb010' =>  $_POST['order_product'][ $n  ]['tb010'],
                 'tb011' =>  $_POST['order_product'][ $n  ]['tb011'],
				 'tb012' =>  $_POST['order_product'][ $n  ]['tb012'],
				 'tb013' =>  $_POST['order_product'][ $n  ]['tb013'],
				 'tb014' =>  $_POST['order_product'][ $n  ]['tb014'],
                 'tb015' =>  $_POST['order_product'][ $n  ]['tb015'],
				 'tb016' =>  'Y'
                );  
				
				 if ($_POST['order_product'][  $n  ]['tb005']>'0') {
		     $this->db->insert('acttb', $data_array); 
			 if ($_POST['order_product'][  $n  ]['tb004'] =='1') {
		      $ta0071=$ta0071+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0081=$ta0081+$_POST['order_product'][ $n  ]['tb015'];}
			else {  
			  $ta0072=$ta0072+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0082=$ta0082+$_POST['order_product'][ $n  ]['tb015'];}   }
			  
		/*	   if ($_POST['order_product'][  $n  ]['tb004'] =='1' && $_POST['order_product'][  $n  ]['tb005'] > '0' ) {
		      $ta0071=$ta0071+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0081=$ta0081+$_POST['order_product'][ $n  ]['tb015'];}
		 if ($_POST['order_product'][  $n  ]['tb004'] !='1' && $_POST['order_product'][  $n  ]['tb005'] > '0' ) {
			  $ta0071=$ta0071+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0081=$ta0081+$_POST['order_product'][ $n  ]['tb015'];}  */
			  
			
			 $mtb003 = (int) $tb003+10;
			 $tb003 =  (string)$mtb003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['tb004']) {
			  while (isset($_POST['order_product'][  $n  ]['tb005'])) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tb001' => $this->input->post('actq02a'),
		         'tb002' => $this->input->post('ta002'),
		         'tb003' =>  $tb003,
		         'tb004' => $_POST['order_product'][ $n  ]['tb004'],
		         'tb005' => $_POST['order_product'][ $n  ]['tb005'],
		         'tb006' => $_POST['order_product'][ $n  ]['tb006'],
                 'tb007' => $_POST['order_product'][ $n  ]['tb007'],
				 'tb010' =>  $_POST['order_product'][ $n  ]['tb010'],
                 'tb011' =>  $_POST['order_product'][ $n  ]['tb011'],
				 'tb012' =>  $_POST['order_product'][ $n  ]['tb012'],
				 'tb013' =>  $_POST['order_product'][ $n  ]['tb013'],
				 'tb014' =>  $_POST['order_product'][ $n  ]['tb014'],
                 'tb015' =>  $_POST['order_product'][ $n  ]['tb015'],
				 'tb016' =>   'Y'
                );   
		//		if ($_POST['order_product'][  $n  ]['tb005'] > '0') {
		//	$this->db->insert('acttb', $data_array);}
			 if ($_POST['order_product'][  $n  ]['tb005']>'0') {
		     $this->db->insert('acttb', $data_array); 
			 if ($_POST['order_product'][  $n  ]['tb004'] =='1') {
		      $ta0071=$ta0071+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0081=$ta0081+$_POST['order_product'][ $n  ]['tb015'];}
			else {  
			  $ta0072=$ta0072+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0082=$ta0082+$_POST['order_product'][ $n  ]['tb015'];}   }
			
	/*	 if ($_POST['order_product'][  $n  ]['tb004'] =='1' && $_POST['order_product'][  $n  ]['tb005'] > '0' ) {
		      $ta0071=$ta0071+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0081=$ta0081+$_POST['order_product'][ $n  ]['tb015'];}
		 if ($_POST['order_product'][  $n  ]['tb004'] !='1' && $_POST['order_product'][  $n  ]['tb005'] > '0' ) {
			  $ta0071=$ta0071+$_POST['order_product'][ $n  ]['tb007'];
			  $ta0081=$ta0081+$_POST['order_product'][ $n  ]['tb015'];}  */
			
			  
			$mtb003 = (int) $tb003+10;
			$tb003 =  (string)$mtb003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 actta
		 $sql = " UPDATE actta set ta007='$ta0071',ta008='$ta0072' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
		 $query = $this->db->query($sql);
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('actta'); 
		  $this->db->where('tb001', $this->uri->segment(4));
		  $this->db->where('tb002', $this->uri->segment(5));
          $this->db->delete('acttb'); 
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
                  $this->db->delete('actta'); 
				  $this->db->where('tb001', $seq1);
			      $this->db->where('tb002', $seq2);
                  $this->db->delete('acttb'); 
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
		$this->db->delete('acttb');
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>