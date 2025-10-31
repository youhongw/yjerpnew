<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puri03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tl001, tl002, tl003, tl004, tl005, tl006,tl008,tl010,tl011,tl013, create_date');
          $this->db->from('purtl');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tl001 desc, tl002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('purtl');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tl001', 'tl002', 'tl003', 'tl004', 'tl005', 'tl007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tl001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tl001, a.tl002, a.tl003, a.tl004,b.ma002 as tl004disp, a.tl005, a.tl007,a.create_date')
	                       ->from('purtl as a')
						   ->join('purma as b', 'a.tl004 = b.ma001 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purtl');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tl001disp, d.ma002 AS tl004disp, e.mf002 AS tl005disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tm001, b.tm002, b.tm003, b.tm004, b.tm005,
		  b.tm006, b.tm007,b.tm008,b.tm009,b.tm010, b.tm011, b.tm012, b.tm013, b.tm014, b.tm015, b.tm016');
		 
        $this->db->from('purtl as a');	
        $this->db->join('purtm as b', 'a.tl001 = b.tm001  and a.tl002=b.tm002 ','left');		
		$this->db->join('cmsmq as c', 'a.tl001 = c.mq001 and c.mq003="32" ','left');
		$this->db->join('purma as d', 'a.tl004 = d.ma001 ','left');
	    $this->db->join('cmsmf as e', 'a.tl005 = e.mf001 ','left');
		$this->db->where('a.tl001', $this->uri->segment(4)); 
	    $this->db->where('a.tl002', $this->uri->segment(5)); 
		$this->db->order_by('tl001 , tl002 ,b.tm003');
		
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
		
	//ajax 查詢 顯示 請購單別 tm001	
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
		
	//ajax 查詢顯示用 廠別 tl010  
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
	      $this->db->select_max('tl002');
		  $this->db->where('tl001', $this->uri->segment(4));
	      $this->db->where('tl010', $this->uri->segment(5));
		  $query = $this->db->get('purtl');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tl002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `purtl` ";
	      $seq1 = "tl001, tl002, tl003, tl004, tl005,tl006, tl010, a.create_date FROM `purtl` as a ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'tl001 desc' ;
          $seq9 = " ORDER BY tl001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="tl001 ";

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
		 
	     $sort_columns = array('tl001', 'tl002', 'tl003', 'tl004','b.ma002', 'tl005', 'tl006','tl007','tl008','tl010','tl011','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tl001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tl001, tl002, tl003, tl004,b.ma002,b.ma002 as tl004disp, tl005, tl006,tl007,tl010,tl008,tl010,tl011, a.create_date')
	                       ->from('purtl as a')
						   ->join('purma as b', 'a.tl004 = b.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purtl as a')
						   ->join('purma as b', 'a.tl004 = b.ma001 ','left')
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
	      $sort_columns = array('tl001', 'tl002', 'b.ma002','tl003', 'tl004','tl005', 'tl007', 'a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tl001';  //檢查排序欄位是否為 table
	      $this->db->select('tl001, tl002, tl003, tl004,b.ma002, b.ma002 as tl004disp, tl005,tl007, a.create_date');
	      $this->db->from('purtl as a');
		  $this->db->join('purma as b', 'a.tl004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tl001 asc, tl002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('purtl as a');
		   $this->db->join('purma as b', 'a.tl004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('tl001', $this->input->post('purq04a32'));
		  $this->db->where('tl002', $this->input->post('tl002'));
	      $query = $this->db->get('purtl');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tm001', $this->input->post('purq04a32'));
		  $this->db->where('tm002', $this->input->post('tl002'));
	      $query = $this->db->get('purtm');
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
 		
	//新增一筆 檔頭  purtl	
	function insertf()    //新增一筆 檔頭  purtl
        {
			 if ($this->input->post('tl003')>'0') {$tl003=substr($this->input->post('tl003'),0,4).substr($this->input->post('tl003'),5,2).substr($this->input->post('tl003'),8,2);}
              else {$tl003='';}  
			  if ($this->input->post('tl010')>'0') {$tl010=substr($this->input->post('tl010'),0,4).substr($this->input->post('tl010'),5,2).substr(rtrim($this->input->post('tl010')),8,2);}
              else {$tl010='';} 
			  $tl004= $this->input->post('purq01a');
			  $tl005= $this->input->post('cmsq06a');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tl001' => $this->input->post('purq04a32'),
		         'tl002' => $this->input->post('tl002'),
		         'tl003' => $tl003,
		         'tl004' => $this->input->post('purq01a'),
		         'tl005' => $this->input->post('cmsq06a'),
		         'tl006' => $this->input->post('tl006'),
                 'tl007' => $this->input->post('tl007'),
                 'tl008' => $this->input->post('tl008'),
                 'tl009' => $this->input->post('tl009'),
                 'tl010' => $tl010,		
                 'tl011' => $this->input->post('tl011'),		
                 'tl012' => $this->input->post('tl012')
                 
                );
         
	      $exist = $this->puri03_model->selone1($this->input->post('purq04a32'),$this->input->post('tl002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('purtl', $data);
			
		// 新增明細 purtm
		     $n = '0';
				$tm003='1000';
			if (!isset($_POST['order_product'][  $n  ]['tm004']) ) { $n='250'; }  
			 //   $n = '0';
		//	while (($_POST['order_product'][  $n  ]['tm004']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['tm004']) {
			 while (isset($_POST['order_product'][  $n  ]['tm004'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tm001' => $this->input->post('purq04a32'),
		         'tm002' => $this->input->post('tl002'),
		         'tm003' =>  $tm003,
		         'tm004' => $_POST['order_product'][ $n  ]['tm004'],
		         'tm005' => $_POST['order_product'][ $n  ]['tm005'],
		         'tm006' => $_POST['order_product'][ $n  ]['tm006'],
                 'tm007' => $_POST['order_product'][ $n  ]['tm007'],			
                 'tm014' =>  substr($_POST['order_product'][ $n  ]['tm014'],0,4).substr($_POST['order_product'][ $n ]['tm014'],5,2).substr($_POST['order_product'][ $n ]['tm014'],8,2),
                 'tm009' =>  $_POST['order_product'][ $n  ]['tm009'],
                 'tm010' =>  $_POST['order_product'][ $n  ]['tm010']
                );   
						 
	      $exist = $this->puri03_model->selone1d($this->input->post('purq04a32'),$this->input->post('tl002'));
		   if ($_POST['order_product'][  $n  ]['tm004'] !='') {
		   $this->db->insert('purtm', $data_array);}
		  
		   //新增品號廠商資料
			 $tm004=$_POST['order_product'][ $n  ]['tm004'];    //品號
			 $tm009=$_POST['order_product'][ $n  ]['tm009'];   //單位
			 $tm014=substr($_POST['order_product'][ $n  ]['tm014'],0,4).substr($_POST['order_product'][ $n ]['tm014'],5,2).substr($_POST['order_product'][ $n ]['tm014'],8,2);   //生效日
		     $tm010=$_POST['order_product'][ $n  ]['tm010'];   //單價
			 $exista = $this->puri03_model->selone2d($tm004,$tl004,$tl005,$tm009,$tm014);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mb001' => $tm004,
		         'mb002' => $tl004,
				 'mb003' => $tl005,
				 'mb008' => $tl003,
				 'mb004' => $tm009,
		         'mb014' => $tm014,
				 'mb011' => $tm010
                );   
			   if ($_POST['order_product'][  $n  ]['tm004']!='') {
			 if (!$exista) { $this->db->insert('purmb', $data_add);  }
		     else {			  
         $sql = " UPDATE purmb set mb011='$tm010',mb008='$tl003' WHERE mb001 = '$tm004'  AND mb002 = '$tl004'  AND mb003 = '$tl005'  AND mb004 = '$tm009'  AND mb014 = '$tm014' "; 
		 $query = $this->db->query($sql);	} 
			  }
		  
		  
		      $mtm003 = (int) $tm003+10;
			 $tm003 =  (string)$mtm003;
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			 
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			return true;
		 }
		 
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('purq04a32'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('purq04a32')."/".$this->input->post('tl002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 	 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tl001', $this->input->post('tl001c')); 
          $this->db->where('tl002', $this->input->post('tl002c'));
	      $query = $this->db->get('purtl');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tl001', $this->input->post('tl001o'));
			$this->db->where('tl002', $this->input->post('tl002o'));
	        $query = $this->db->get('purtl');
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
                $tl003=$row->tl003;$tl004=$row->tl004;$tl005=$row->tl005;$tl006=$row->tl006;$tl007=$row->tl007;$tl008=$row->tl008;$tl009=$row->tl009;$tl010=$row->tl010;
				$tl011=$row->tl011;$tl012=$row->tl012;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tl001c');    //主鍵一筆檔頭purtl
			$seq2=$this->input->post('tl002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tl001' => $seq1,'tl002' => $seq2,'tl003' => $tl003,'tl004' => $tl004,'tl005' => $tl005,'tl006' => $tl006,'tl007' => $tl007,'tl008' => $tl008,'tl009' => $tl009,'tl010' => $tl010,
		           'tl011' => $tl011,'tl012' => $tl012
                   );
				   
            $exist = $this->puri03_model->selone2($this->input->post('tl001c'),$this->input->post('tl002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('purtl', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tm001', $this->input->post('tl001o'));
			$this->db->where('tm002', $this->input->post('tl002o'));
	        $query = $this->db->get('purtm');
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
                 $tm003[$i]=$row->tm003;$tm004[$i]=$row->tm004;$tm005[$i]=$row->tm005;$tm006[$i]=$row->tm006;$tm007[$i]=$row->tm007;
				 $tm008[$i]=$row->tm008;$tm009[$i]=$row->tm009;$tm010[$i]=$row->tm010;$tm011[$i]=$row->tm011;$tm012[$i]=$row->tm012;
				 $tm013[$i]=$row->tm013;$tm014[$i]=$row->tm014;$tm015[$i]=$row->tm015;$tm016[$i]=$row->tm016;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tl001c');    //主鍵一筆明細purtm
			$seq2=$this->input->post('tl002c'); 
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
                'tm001' => $seq1,'tm002' => $seq2,'tm003' => $tm003[$i],'tm004' => $tm004[$i],'tm005' => $tm005[$i],'tm006' => $tm006[$i],'tm007' => $tm007[$i],
		        'tm008' => $tm008[$i],'tm009' => $tm009[$i],'tm010' => $tm010[$i],'tm011' => $tm011[$i],'tm012' => $tm012[$i],
				'tm013' => $tm013[$i],'tm014' => $tm014[$i],'tm015' => $tm015[$i],'tm016' => $tm016[$i]
                ); 
				
             $this->db->insert('purtm', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tl001o');    
	      $seq2=$this->input->post('tl001c');
		  $seq3=$this->input->post('tl002o');    
	      $seq4=$this->input->post('tl002c');
	      $sql = " SELECT tl001,tl002,tl003,tl004,c.ma002 as tl004disp,tl005,tm003,tm004,tm005,tm006,tm009,tm010 FROM purtl as a,purtm as b,purma c
		  WHERE tl001=tm001 AND tl002=tm002 AND tl004=ma001 AND  tl001 >= '$seq1'  AND tl001 <= '$seq2' AND tl002 >= '$seq3'  AND tl002 <= '$seq4'  ";  
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tl001o');    
	      $seq2=$this->input->post('tl001c');
		  $seq3=$this->input->post('tl002o');    
	      $seq4=$this->input->post('tl002c');
	      $sql = " SELECT tl001,tl002,tl003,tl004,c.ma002 as tl004disp,tl005,tm003,tm004,tm005,tm006,tm009,tm010 FROM purtl as a,purtm as b,purma c
		  WHERE tl001=tm001 AND tl002=tm002 AND tl004=ma001 AND  tl001 >= '$seq1'  AND tl001 <= '$seq2' AND tl002 >= '$seq3'  AND tl002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tl001 >= '$seq1'  AND tl001 <= '$seq2' AND tl002 >= '$seq3'  AND tl002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('purtl')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tl001disp, d.me002 AS tl004disp, e.mb002 AS tl010disp, f.mv002 AS tl012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tm001, b.tm002, b.tm003, b.tm004, b.tm005,
		  b.tm006, b.tm007, b.tm011, b.tm009, b.tm017, b.tm018, b.tm012');
		 
        $this->db->from('purtl as a');	
        $this->db->join('purtm as b', 'a.tl001 = b.tm001  and a.tl002=b.tm002 ','left');		
		$this->db->join('cmsmq as c', 'a.tl001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tl004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tl010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tl012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tl001', $this->uri->segment(4)); 
	    $this->db->where('a.tl002', $this->uri->segment(5)); 
		$this->db->order_by('tl001 , tl002 ,b.tm003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tm001', $this->uri->segment(4));
		$this->db->where('tm002', $this->uri->segment(5));
	    $query = $this->db->get('purtm');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tl001disp, d.ma002 AS tl004disp, 
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tm001, b.tm002, b.tm003, b.tm004, b.tm005,
		  b.tm006, b.tm007, b.tm009, b.tm010, b.tm014, b.tm012');
		 
        $this->db->from('purtl as a');	
        $this->db->join('purtm as b', 'a.tl001 = b.tm001  and a.tl002=b.tm002 ','left');		
		$this->db->join('cmsmq as c', 'a.tl001 = c.mq001 and c.mq003="32" ','left');
		$this->db->join('purma as d', 'a.tl004 = d.ma001 ','left');		
		$this->db->where('a.tl001', $this->input->post('tl001o')); 
	    $this->db->where('a.tl002', $this->input->post('tl002o')); 
		$this->db->order_by('tl001 , tl002 ,b.tm003');
		
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
          $this->db->select('a.* ,c.mq002 AS tl001disp, d.ma002 AS tl004disp, 
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tm001, b.tm002, b.tm003, b.tm004, b.tm005,
		  b.tm006, b.tm007, b.tm009, b.tm010, b.tm014, b.tm012');
		 
        $this->db->from('purtl as a');	
        $this->db->join('purtm as b', 'a.tl001 = b.tm001  and a.tl002=b.tm002 ','left');		
		$this->db->join('cmsmq as c', 'a.tl001 = c.mq001 and c.mq003="32" ','left');
		$this->db->join('purma as d', 'a.tl004 = d.ma001 ','left');
		$this->db->where('a.tl001', $this->uri->segment(4)); 
	    $this->db->where('a.tl002', $this->uri->segment(5)); 
		$this->db->order_by('tl001 , tl002 ,b.tm003');
		
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
			 if ($this->input->post('tl003')>'0') {$tl003=substr($this->input->post('tl003'),0,4).substr($this->input->post('tl003'),5,2).substr($this->input->post('tl003'),8,2);}
              else {$tl003='';}  
			  if ($this->input->post('tl010')>'0') {$tl010=substr($this->input->post('tl010'),0,4).substr($this->input->post('tl010'),5,2).substr(rtrim($this->input->post('tl010')),8,2);}
              else {$tl010='';} 
			    $tl004= $this->input->post('purq01a');
			  $tl005= $this->input->post('cmsq06a');	    
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'tl003' => $tl003,
		         'tl004' => $this->input->post('purq01a'),
		         'tl005' => $this->input->post('cmsq06a'),
		         'tl006' => $this->input->post('tl006'),
                 'tl007' => $this->input->post('tl007'),
                 'tl008' => $this->input->post('tl008'),
                 'tl009' => $this->input->post('tl009'),
                 'tl010' => $tl010,		
                 'tl011' => $this->input->post('tl011'),		
                 'tl012' => $this->input->post('tl012')
                );
            $this->db->where('tl001', $this->input->post('purq04a32'));
			$this->db->where('tl002', $this->input->post('tl002'));
            $this->db->update('purtl',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tm001', $this->input->post('purq04a32'));
			$this->db->where('tm002', $this->input->post('tl002'));
            $this->db->delete('purtm'); 
			
			$this->db->flush_cache();  
			// 新增明細 purtm
			
			    $n = '0';		
				$tm003='1000';
		   while (isset($_POST['order_product'][  $n  ]['tm004'])) {
		//	while ($_POST['order_product'][  $n  ]['tm004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tm001' => $this->input->post('purq04a32'),
		         'tm002' => $this->input->post('tl002'),
		         'tm003' =>  $tm003,
		         'tm004' => $_POST['order_product'][ $n  ]['tm004'],
		         'tm005' => $_POST['order_product'][ $n  ]['tm005'],
		         'tm006' => $_POST['order_product'][ $n  ]['tm006'],
                 'tm007' => $_POST['order_product'][ $n  ]['tm007'],			
                 'tm014' =>  substr($_POST['order_product'][ $n  ]['tm014'],0,4).substr($_POST['order_product'][ $n ]['tm014'],5,2).substr($_POST['order_product'][ $n ]['tm014'],8,2),
                 'tm009' =>  $_POST['order_product'][ $n  ]['tm009'],
                 'tm010' =>  $_POST['order_product'][ $n  ]['tm010']
                );  
			if ($_POST['order_product'][  $n  ]['tm004']>'0') {
			$this->db->insert('purtm', $data_array);}
			
			 //新增品號廠商資料
			 $tm004=$_POST['order_product'][ $n  ]['tm004'];    //品號
			 $tm009=$_POST['order_product'][ $n  ]['tm009'];   //單位
			 $tm014=substr($_POST['order_product'][ $n  ]['tm014'],0,4).substr($_POST['order_product'][ $n ]['tm014'],5,2).substr($_POST['order_product'][ $n ]['tm014'],8,2);   //生效日
		     $tm010=$_POST['order_product'][ $n  ]['tm010'];   //單價
			 $exista = $this->puri03_model->selone2d($tm004,$tl004,$tl005,$tm009,$tm014);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mb001' => $tm004,
		         'mb002' => $tl004,
				 'mb003' => $tl005,
				 'mb008' => $tl003,
				 'mb004' => $tm009,
		         'mb014' => $tm014,
				 'mb011' => $tm010
                );   
			   if ($_POST['order_product'][  $n  ]['tm004']!='') {
			 if (!$exista) { $this->db->insert('purmb', $data_add);  }
		     else {			  
         $sql = " UPDATE purmb set mb011='$tm010' ,mb008='$tl003' WHERE mb001 = '$tm004'  AND mb002 = '$tl004'  AND mb003 = '$tl005'  AND mb004 = '$tm009'  AND mb014 = '$tm014' "; 
		 $query = $this->db->query($sql);	} 
			  }
			
			
			 $mtm003 = (int) $tm003+10;
			 $tm003 =  (string)$mtm003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		   while (isset($_POST['order_product'][  $n  ]['tm004'])) {
		//	 while ($_POST['order_product'][  $n  ]['tm004']) {
			if ($_POST['order_product'][  $n  ]['tm014']>'0') {$tm014=substr($_POST['order_product'][ $n  ]['tm014'],0,4).substr($_POST['order_product'][ $n ]['tm014'],5,2).substr($_POST['order_product'][ $n ]['tm014'],8,2);}
			   else {$tm014='';}
			
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tm001' => $this->input->post('purq04a32'),
		         'tm002' => $this->input->post('tl002'),
		         'tm003' =>  $tm003,
		         'tm004' => $_POST['order_product'][ $n  ]['tm004'],
		         'tm005' => $_POST['order_product'][ $n  ]['tm005'],
		         'tm006' => $_POST['order_product'][ $n  ]['tm006'],
                 'tm007' => $_POST['order_product'][ $n  ]['tm007'],			
                 'tm014' =>  $tm014,
                 'tm009' =>  $_POST['order_product'][ $n  ]['tm009'],
                 'tm010' =>  $_POST['order_product'][ $n  ]['tm010']
                );   
			if ($_POST['order_product'][  $n  ]['tm004'] > '0') {	
			$this->db->insert('purtm', $data_array); }
			$mtm003 = (int) $tm003+10;
			$tm003 =  (string)$mtm003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tl001', $this->uri->segment(4));
		  $this->db->where('tl002', $this->uri->segment(5));
          $this->db->delete('purtl'); 
		  $this->db->where('tm001', $this->uri->segment(4));
		  $this->db->where('tm002', $this->uri->segment(5));
          $this->db->delete('purtm'); 
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
			      $this->db->where('tl001', $seq1);
			      $this->db->where('tl002', $seq2);
                  $this->db->delete('purtl'); 
				  $this->db->where('tm001', $seq1);
			      $this->db->where('tm002', $seq2);
                  $this->db->delete('purtm'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	 function del_detail(){
		$this->db->where('tm001', $_POST['del_md001']);
		$this->db->where('tm002', $_POST['del_md002']);
		$this->db->where('tm003', $_POST['del_md003']);
		$this->db->delete('purtm');
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>