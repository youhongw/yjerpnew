<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noti02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('a.*,b.ma002,b.ma004,b.ma005,c.*');
          $this->db->from('nottf as a');
          $this->db->join('notma as b', 'a.tf004 = b.ma001 ','left');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('a.tf001 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('nottf');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.tf001', 'a.tf002', 'a.tf004', 'b.ma002', 'b.ma004', 'b.ma005','b.ma011', 'a.tf003', 'a.tf012');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tf001,a.tf002,a.tf004,b.ma002,b.ma004,b.ma005,a.tf003,a.tf012')
	                       ->from('nottf as a')
						   ->join('notma as b', 'a.tf004 = b.ma001 ','left')
						   //->join('nottg as c', 'a.tf002 = c.tg002 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('nottf');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)
        {
		  $this->db->select('a.*,b.ma002,b.ma004,b.ma005,b.ma011,d.ma003,c.*');
        $this->db->from('nottf as a');
        $this->db->join('notma as b', 'a.tf004 = b.ma001 ','left');
		$this->db->join('nottg as c', 'a.tf002 = c.tg002 ','left');
        $this->db->join('actma as d', 'b.ma005 = d.ma001 ','left');
		$this->db->where('a.tf001', $seq1); 
	    $this->db->where('a.tf002', $seq2); 
		$this->db->order_by('a.tf002 , b.ma002');
		
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
		
	//ajax 查詢 顯示 請購單別 mb001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '31');
          $this->db->where('mq001', $this->uri->segment(4));		  
	      $query = $this->db->get('notmq');
			
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
	function ajaxnotq05a($seg1)    
        {
	      $this->db->where('tf001', $this->uri->segment(4));	
	      $query = $this->db->get('nottf');
			
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `nottf` as a ";
	      $seq1 = "'a.tf001,a.tf002,a.tf004,b.ma002,b.ma004,b.ma005,a.tf003,a.tf012 FROM `nottf` as a LEFT JOIN `notma` as b on a.tf004=b.ma001 ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'tf001 desc' ;
          $seq9 = " ORDER BY tf001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="ma001 ";

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
	     $sort_columns = array('a.tf001', 'a.tf002', 'a.tf004', 'b.ma002', 'b.ma004', 'b.ma005', 'a.tf003', 'a.tf012');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tf001,a.tf002,a.tf004,b.ma002,b.ma004,b.ma005,a.tf003,a.tf012')
	                       ->from('nottf as a')
						   ->join('notma as b', 'a.tf004 = b.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('nottf as a')
						   ->join('notma as b', 'a.tf004 = b.ma001 ','left')
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
	      $sort_columns = array('a.tf001', 'a.tf002', 'a.tf004', 'a.tf012', 'a.tf003', 'b.ma002', 'b.ma005');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
	      $this->db->select('a.tf001,a.tf002,a.tf004,b.ma002,b.ma004,b.ma005,a.tf003,a.tf012,a.flag');
	      $this->db->from('nottf as a');
		  $this->db->join('notma as b', 'a.tf004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ma001 asc, mf002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('nottf as a');
		  $this->db->join('notma as b', 'a.tf001 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tf001', $this->input->post('tf001'));
	      $this->db->where('tf002', $seg1);
	      $query = $this->db->get('nottf');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2)    
        {
	      $this->db->where('tg003', $seg1);
	      $this->db->where('tg002', $seg2);
		  $this->db->where('tg001', $this->input->post('tf001'));
	      $query = $this->db->get('nottg');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  notma	
	function insertf()    //新增一筆 檔頭  notma
        {
		 preg_match_all('/\d/S',$this->input->post('tf003'), $matches);  //處理日期字串
			 $tf003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf011'), $matches);  //處理日期字串
			 $tf011 = implode('',$matches[0]);
			 
		if(@$this->input->post('tf012')){$temp_tf012=1;}
		  else{$temp_tf012=0;}
	     $data = array( 
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' =>date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'tf001' => $this->input->post('tf001'),
			'tf002' => $this->input->post('tf002'),
			'tf003' => $tf003,
			'tf004' => $this->input->post('tf004'),
			'tf005' => $this->input->post('tf005'),
			'tf006' => $this->input->post('tf006'),
			'tf007' => $this->input->post('tf007'),
			'tf008' => $this->input->post('tf008'),
			'tf009' => $this->input->post('tf009'),
			'tf010' => $this->input->post('tf010'),
			'tf011' => $tf011,
			'tf012' => $this->input->post('tf012'),
			'tf013' => $this->input->post('tf013'),
			'tf014' => $this->input->post('tf014'),
			'tf015' => $this->input->post('tf015'),
			'tf016' => $this->input->post('tf016'),
			'tf017' => $this->input->post('tf017'),
			'tf018' => $this->input->post('tf018')
		);
			$this->db->select('max(tf002) as max_id');//查詢編號
			$this->db->from('nottf');
		    $this->db->where("tf002 like '".date("Ymd")."%'");
			$query = $this->db->get();
			$tmp = $query->result();
			if(!$tmp[0]->max_id)
				$data['tf002'] = date("Ymd")."001";
			else
				$data['tf002'] = date("Ymd").(str_pad(substr($tmp[0]->max_id,8)+1,3,0,STR_PAD_LEFT));
	      $exist = $this->noti02_model->selone1($data['tf002']);
	      if ($exist)
	         {
		      return 'exist';
		     }
             $this->db->insert('nottf', $data);
			
		// 新增明細 notmb
			
			    $n = '0';
			
			   while (isset($_POST['order_product'][  $n  ]['tg002'])) {
		//	while (($_POST['order_product'][  $n  ]['mb002']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['mb002']) {
			  if  ( $_POST['order_product'][ $n  ]['tg002'] || $_POST['order_product'][ $n  ]['tg003']){
			  $seg2=$this->input->post('tg002');
			   $data_array = array(
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tg001' => $this->input->post('tf001'),
		         'tg002' => $data["tf002"],
		         'tg003' => $_POST['order_product'][ $n  ]['tg003'],
		         'tg004' => $_POST['order_product'][ $n  ]['tg004'],
		         'tg005' => $_POST['order_product'][ $n  ]['tg005'],
		         'tg006' => $_POST['order_product'][ $n  ]['tg006'],
		         'tg007' => $_POST['order_product'][ $n  ]['tg007'],
		         'tg008' => $_POST['order_product'][ $n  ]['tg008'],
		         'tg009' => $_POST['order_product'][ $n  ]['tg009'],
		         'tg011' => $_POST['order_product'][ $n  ]['tg011'],
		         'tg012' => $_POST['order_product'][ $n  ]['tg012'],
		         'tg013' => $_POST['order_product'][ $n  ]['tg013'],
		         'tg014' => $_POST['order_product'][ $n  ]['tg014'],
		         'tg015' => $_POST['order_product'][ $n  ]['tg015']
                );   
				
	      $exist = $this->noti02_model->selone1d($_POST['order_product'][ $n  ]['tg003'],$seg2);
		  if($_POST['order_product'][ $n  ]['tg008']<1)
			  return "no data";
		   if ($exist) { return 'exist'; } else {$this->db->insert('nottg', $data_array);} 
		  
		 // $this->db->insert('notmb', $data_array);
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			}
			echo "<script>alert('單據編號為:".$data["tf002"]."');</script>";
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1)    
        { 
	      $this->db->where('tf001', $this->input->post('tf002c')); 
	      $query = $this->db->get('nottf');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tf002', $this->input->post('tf002o'));
	        $query = $this->db->get('nottf');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         		
		    if ($query->num_rows() == 1) 
		       {
			     $result = $query->result();
			     foreach($result as $row):
                $tf001=$row->tf001;$tf004=$row->tf004;$tf005=$row->tf005;$tf006=$row->tf006;$tf007=$row->tf007;$tf008=$row->tf008;$tf009=$row->tf009;$tf010=$row->tf010;$tf011=$row->tf011;$tf012=$row->tf012;$tf013=$row->tf013;$tf014=$row->tf014;$tf016=$row->tf016;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tf002c');    //主鍵一筆檔頭nottf
		//	$seq2=$this->input->post('mf002c');
			$this->db->select('max(tf002) as max_id');//查詢編號
			$this->db->from('nottf');
		    $this->db->where("tf002 like '".date("Ymd")."%'");
			$query = $this->db->get();
			$tmp = $query->result();
			if(!$tmp[0]->max_id)
				$temp_tf002 = date("Ymd")."001";
			else
				$temp_tf002 = date("Ymd").(str_pad(substr($tmp[0]->max_id,8)+1,3,0,STR_PAD_LEFT));		
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tf001' => $tf001,'tf002' => $temp_tf002,'tf003' => date("Y/m/d"),'tf004' => $tf004,'tf005' => $tf005,'tf006' => $tf006,'tf007' => $tf007,'tf008' => $tf008,'tf009' => $tf009,'tf010' => $tf010,'tf011' => $tf011,'tf012' => $tf012,'tf013' => $tf013,'tf014' => $tf014,'tf016' => $tf016
                   );
				      
             $this->db->insert('nottf', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tg002', $this->input->post('tf002o'));
		//	$this->db->where('mb002', $this->input->post('mf002o'));
	        $query = $this->db->get('nottg');
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
                 $tg001[$i]=$row->tg001;$tg003[$i]=$row->tg003;$tg004[$i]=$row->tg004;$tg005[$i]=$row->tg005;$tg006[$i]=$row->tg006;$tg007[$i]=$row->tg007;$tg008[$i]=$row->tg008;$tg009[$i]=$row->tg009;$tg010[$i]=$row->tg010;$tg011[$i]=$row->tg011;$tg012[$i]=$row->tg012;$tg013[$i]=$row->tg013;$tg014[$i]=$row->tg014;$tg015[$i]=$row->tg015;
				 $i++;
			    endforeach;
		       }   
		//	$seq1=$this->input->post('tf002c');    //主鍵一筆明細notmb
		//	$seq2=$this->input->post('mf002c'); 
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
                'tg001' => $tg001[$i],'tg002' => $temp_tf002,'tg003' => $tg003[$i],'tg004' => $tg004[$i],'tg005' => $tg005[$i],'tg006' => $tg006[$i],'tg007' => $tg007[$i],'tg008' => $tg008[$i],'tg009' => $tg009[$i],'tg010' => $tg010[$i],'tg011' => $tg011[$i],'tg012' => $tg012[$i],'tg013' => $tg013[$i],'tg014' => $tg014[$i],'tg015' => $tg015[$i]
                ); 
				
             $this->db->insert('nottg', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tf002o');    
	      $seq2=$this->input->post('tf002c');
		//  $seq3=$this->input->post('mf002o');    
	    //  $seq4=$this->input->post('mf002c');
	      $sql = "SELECT a.tf001,a.tf002,a.tf004,b.ma002,b.ma004,b.ma005,a.tf003,a.tf012 FROM nottf as a LEFT JOIN notma as b on a.tf004=b.ma001 WHERE a.tf002 >= '$seq1'  AND a.tf002 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tf002o');    
	      $seq2=$this->input->post('tf002c');
		//  $seq3=$this->input->post('mf002o');    
	   //   $seq4=$this->input->post('mf002c');
	      $sql = " SELECT a.tf001,a.tf002,a.tf004,b.ma002,b.ma004,b.ma005,a.tf003,a.tf012,a.flag FROM nottf as a LEFT JOIN notma as b on a.tf004=b.ma001 WHERE tf002 >= '$seq1'  AND tf002 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tf002 >= '$seq1'  AND tf002 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('nottf')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006');
		 
        $this->db->from('notma as a');	
        $this->db->join('notmb as b', 'a.tf001 = b.mb001   ','left');
		$this->db->where('a.tf001', $this->uri->segment(4)); 
	  
		$this->db->order_by('a.tf001 , b.mb002');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mb001', $this->uri->segment(4));
		//$this->db->where('mb002', $this->uri->segment(5));
	    $query = $this->db->get('notmb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tf001disp, d.me002 AS mf004disp, e.mb002 AS mf010disp, f.mv002 AS mf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006, b.mb007, b.mb011, b.mb009, b.mb017, b.mb018, b.mb012');
		 
        $this->db->from('notma as a');	
        $this->db->join('notmb as b', 'a.tf001 = b.mb001  and a.mf002=b.mb002 ','left');		
		$this->db->join('notmq as c', 'a.tf001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('nottf as d', 'a.mf004 = d.tf001 ','left');
	    $this->db->join('notmb as e', 'a.mf010 = e.mb001 ','left');
		$this->db->join('notmv as f ', 'a.mf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tf001', $this->input->post('tf001o')); 
	    $this->db->where('a.mf002', $this->input->post('mf002o')); 
		$this->db->order_by('tf001 , mf002 ,b.mb003');
		
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
          $this->db->select('a.* ,c.mq002 AS tf001disp, d.me002 AS mf004disp, e.mb002 AS mf010disp, f.mv002 AS mf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006, b.mb007, b.mb011, b.mb009, b.mb017, b.mb018, b.mb012');
		 
        $this->db->from('notma as a');	
        $this->db->join('notmb as b', 'a.tf001 = b.mb001  and a.mf002=b.mb002 ','left');		
		$this->db->join('notmq as c', 'a.tf001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('nottf as d', 'a.mf004 = d.tf001 ','left');
	    $this->db->join('notmb as e', 'a.mf010 = e.mb001 ','left');
		$this->db->join('notmv as f ', 'a.mf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tf001', $this->uri->segment(4)); 
	    $this->db->where('a.mf002', $this->uri->segment(5)); 
		$this->db->order_by('tf001 , mf002 ,b.mb003');
		
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
			preg_match_all('/\d/S',$this->input->post('tf003'), $matches);  //處理日期字串
			 $tf003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tf011'), $matches);  //處理日期字串
			 $tf011 = implode('',$matches[0]);
		  if(@$this->input->post('tf012')){$temp_tf012=1;}
		  else{$temp_tf012=0;}
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		   //     'tf001' => $this->input->post('tf001'),
			//	'tf002' => $this->input->post('tf002'),
				'tf003' => $tf003,
				'tf004' => $this->input->post('tf004'),
				'tf005' => $this->input->post('tf005'),
				'tf006' => $this->input->post('tf006'),
				'tf007' => $this->input->post('tf007'),
				'tf008' => $this->input->post('tf008'),
				'tf009' => $this->input->post('tf009'),
				'tf010' => $this->input->post('tf010'),
				'tf011' => $tf011,
				'tf012' => $this->input->post('tf012'),
				'tf013' => $this->input->post('tf013'),
				'tf014' => $this->input->post('tf014'),
				'tf015' => $this->input->post('tf015'),
				'tf016' => $this->input->post('tf016'),
				'tf017' => $this->input->post('tf017'),
				'tf018' => $this->input->post('tf018')
                );
            $this->db->where('tf001', $this->input->post('tf001'));
            $this->db->where('tf002', $this->input->post('tf002'));
            $this->db->update('nottf',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tg001', $this->input->post('tf001'));
			$this->db->where('tg002', $this->input->post('tf002'));
            $this->db->delete('nottg'); 
			$this->db->flush_cache();  
			// 新增明細 notmb
			
			    $n = '0';
			while (isset($_POST['order_product'][  $n  ]['tg003'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tg001' => $this->input->post('tf001'),
		         'tg002' => $this->input->post('tf002'),
		         'tg003' => $_POST['order_product'][ $n  ]['tg003'],
		         'tg004' => $_POST['order_product'][ $n  ]['tg004'],
		         'tg005' => $_POST['order_product'][ $n  ]['tg005'],
		         'tg006' => $_POST['order_product'][ $n  ]['tg006'],
		         'tg007' => $_POST['order_product'][ $n  ]['tg007'],
		         'tg008' => $_POST['order_product'][ $n  ]['tg008'],
		         'tg009' => $_POST['order_product'][ $n  ]['tg009'],
		         'tg011' => $_POST['order_product'][ $n  ]['tg011'],
		         'tg012' => $_POST['order_product'][ $n  ]['tg012'],
		         'tg013' => $_POST['order_product'][ $n  ]['tg013'],
		         'tg014' => $_POST['order_product'][ $n  ]['tg014'],
		         'tg015' => $_POST['order_product'][ $n  ]['tg015']
                );
		     $this->db->insert('nottg', $data_array);
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '10';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 while ($_POST['order_product'][  $n  ]['tg003']) {
				if( $_POST['order_product'][ $n  ]['tg003'] ){
					  $data_array = array( 
						 'company' => $this->session->userdata('syscompany'),
						 'creator' => $this->session->userdata('manager'),
						 'usr_group' => 'A100',
						 'create_date' =>date("Ymd"),
						 'modifier' => $this->session->userdata('manager'),
						 'modi_date' => date("Ymd"),
						 'flag' => 1,
						 'tg001' => $this->input->post('tf001'),
						 'tg002' => $this->input->post('tf002'),
						 'tg003' => $_POST['order_product'][ $n  ]['tg003'],
						 'tg004' => $_POST['order_product'][ $n  ]['tg004'],
						 'tg005' => $_POST['order_product'][ $n  ]['tg005'],
						 'tg006' => $_POST['order_product'][ $n  ]['tg006'],
						 'tg007' => $_POST['order_product'][ $n  ]['tg007'],
						 'tg008' => $_POST['order_product'][ $n  ]['tg008'],
						 'tg009' => $_POST['order_product'][ $n  ]['tg009'],
						 'tg011' => $_POST['order_product'][ $n  ]['tg011'],
						 'tg012' => $_POST['order_product'][ $n  ]['tg012'],
						 'tg013' => $_POST['order_product'][ $n  ]['tg013'],
						 'tg014' => $_POST['order_product'][ $n  ]['tg014'],
						 'tg015' => $_POST['order_product'][ $n  ]['tg015']
						);
					$seg2=$this->input->post('tf002');
					if($_POST['order_product'][ $n  ]['tg008']<1)
						return "no data";
					$exist = $this->noti02_model->selone1d($_POST['order_product'][ $n  ]['tg003'],$seg2);
					if ($exist) { return 'exist'; } else {$this->db->insert('nottg', $data_array);}
				//	$mmb003 = (int) $mb003+10;
				//	$mb003 =  (string)$mmb003;
					$num =  (int)$n + 1;
					$n =  (string)$num;
				}
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
			var_dump($this->uri->segment(4));var_dump($this->uri->segment(5));exit;
	      $this->db->where('tf001', $this->uri->segment(4));
	      $this->db->where('tf002', $this->uri->segment(4));
	//	  $this->db->where('mf002', $this->uri->segment(5));
          $this->db->delete('nottf'); 
		  $this->db->where('tg002', $this->uri->segment(4));
		//  $this->db->where('mb002', $this->uri->segment(5));
          $this->db->delete('nottg'); 
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
		    	      list($seq1,$seq2) = explode("/", $seq[$x]);
		    	      $seq1;
			      $this->db->where('tf001', $seq1);
				  $this->db->where('tf002', $seq2);
                  $this->db->delete('nottf'); 
				  $this->db->where('tg001', $seq1);
				  $this->db->where('tg002', $seq2);
			    //  $this->db->where('mb002', $seq2);
                  $this->db->delete('nottg'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	 //ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1,$seg2)    
        { 	              
	      $this->db->select_max('tf002');
		  $this->db->where('tf001', $this->uri->segment(4));
	      $this->db->where('tf011', $this->uri->segment(5));
		  $query = $this->db->get('nottf');
		//  echo var_dump($query);exit;
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
			  echo var_dump($res);exit;
		     foreach ($query->result() as $row)
              {
               $result=$row->tf002;
              }
		      return $result;   
		     }
	      }
	//取單號 最大值加1
	function check_title_no($tf001,$tf011){
		preg_match_all('/\d/S',$tf011, $matches);  //處理日期字串
		$tf011 = implode('',$matches[0]);
		$this->db->select('MAX(tf002) as max_no')
			->from('nottf')
			->where('tf001', $tf001)
		//	->where('tc039', $tc039);
			->like('tf011', $tf011, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $tf011."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>