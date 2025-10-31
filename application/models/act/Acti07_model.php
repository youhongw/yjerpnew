<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acti07_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mg001, mg002, mg003, mg004, mg005, mg006, create_date');
          $this->db->from('actmg');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mg001 desc, mg002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('actmg');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mg001', 'mg002', 'mg003',  'create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mg001, mg002, mg003, create_date')
	                       ->from('actmg')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('actmg');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mh001, b.mh002, b.mh003, b.mh004');
		 
        $this->db->from('actmg as a');	
        $this->db->join('actmh as b', 'a.mg001 = b.mh001   ','left');		
			
		$this->db->where('a.mg001', $this->uri->segment(4)); 
	 //   $this->db->where('a.mg002', $this->uri->segment(5)); 
		$this->db->order_by('mg001 , b.mh002');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 查詢一筆 顯示 鍵值 
	function ajaxkey($seg1)    
        { 	              
	      $this->db->set('mg001', $this->uri->segment(4));
	      $this->db->where('mg001', $this->uri->segment(4));	
	      $query = $this->db->get('actmg');
	      if ($query->num_rows() > 0) 
		  {
		    $res = $query->result();
		  foreach ($query->result() as $row)
           {
            $result=$row->mg001;
           }
		    return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('dt001, dt002, dt003,dt004')->from('actdt');
      $this->db->like('dt001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('dt002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15'); 
      $query = $this->db->get(); 
      return $query->result();
    }  	
		
	//ajax 查詢 顯示 請購單別 mh001	
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
		
	//ajax 查詢顯示用 廠別 mg010  
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
	      $this->db->select_max('mg002');
		  $this->db->where('mg001', $this->uri->segment(4));
	      $this->db->where('mg013', $this->uri->segment(5));
		  $query = $this->db->get('actmg');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mg002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `actmg` ";
	      $seq1 = "mg001, mg002, mg003,  create_date FROM `actmg` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mg001 desc' ;
          $seq9 = " ORDER BY mg001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="mg001 ";

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
	     $sort_columns = array('mg001', 'mg002', 'mg003',  'create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mg001, mg002, mg003,  create_date')
	                       ->from('actmg')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('actmg')
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
	      $sort_columns = array('mg001', 'mg002', 'mg003', 'create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mg001';  //檢查排序欄位是否為 table
	      $this->db->select('mg001, mg002, mg003,   create_date');
	      $this->db->from('actmg');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mg001 asc, mg002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('actmg');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('mg001', $this->input->post('mg001'));
		//  $this->db->where('mg002', $this->input->post('mg002'));
	      $query = $this->db->get('actmg');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2)    
        {
	      $this->db->where('mh001', $seg1);
		  $this->db->where('mh002', $seg2);
	      $query = $this->db->get('actmh');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  actmg	
	function insertf()    //新增一筆 檔頭  actmg
        {
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mg001' => $this->input->post('mg001'),
		         'mg002' => substr($this->input->post('mg002'),0,4).substr($this->input->post('mg002'),5,2).substr(rtrim($this->input->post('mg002')),8,2),
		         'mg003' => $this->input->post('mg003')
                 
                );
         
	      $exist = $this->acti07_model->selone1($this->input->post('mg001'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('actmg', $data);
			
		// 新增明細 actmh
			
			    $n = '0';
		//	while (($_POST['order_product'][  $n  ]['mh004']) > '0' ) {
			while ($_POST['order_product'][  $n  ]['mh002']) {
			
			//  if  ( $_POST['order_product'][ $n  ]['mh003']='' )  $_POST['order_product'][ $n  ]['mh003']= 0;
			 
			  
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mh001' => $this->input->post('mg001'),
		         'mh002' =>  $_POST['order_product'][ $n  ]['mh002'],
		         'mh003' =>  substr($_POST['order_product'][ $n  ]['mh003'],0,4).substr($_POST['order_product'][ $n ]['mh003'],5,2).substr($_POST['order_product'][ $n ]['mh003'],8,2),
		         'mh004' =>  substr($_POST['order_product'][ $n  ]['mh004'],0,4).substr($_POST['order_product'][ $n ]['mh004'],5,2).substr($_POST['order_product'][ $n ]['mh004'],8,2)
               
                );   
						 
	      $exist = $this->acti07_model->selone1d($this->input->post('mg001'),$_POST['order_product'][ $n  ]['mh002']);
		  $this->db->insert('actmh', $data_array);
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1)    
        { 
	      $this->db->where('mg001', $this->input->post('mg001c')); 
         // $this->db->where('mg002', $this->input->post('mg002c'));
	      $query = $this->db->get('actmg');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('mg001', $this->input->post('mg001o'));
		//	$this->db->where('mg002', $this->input->post('mg002o'));
	        $query = $this->db->get('actmg');
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
                $mg002=$row->mg002;$mg003=$row->mg003;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mg001c');    //主鍵一筆檔頭actmg
		//	$seq2=$this->input->post('mg002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mg001' => $seq1,'mg002' => $mg002,'mg003' => $mg003
                   );
				   
            $exist = $this->acti07_model->selone2($this->input->post('mg001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('actmg', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('mh001', $this->input->post('mg001o'));
		//	$this->db->where('mh002', $this->input->post('mg002o'));
	        $query = $this->db->get('actmh');
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
                 $mh002[$i]=$row->mh002;$mh003[$i]=$row->mh003;$mh004[$i]=$row->mh004;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('mg001c');    //主鍵一筆明細actmh
		//	$seq2=$this->input->post('mg002c'); 
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
                'mh001' => $seq1,'mh002' => $mh002[$i],'mh003' => $mh003[$i],'mh004' => $mh004[$i]
                ); 
				
             $this->db->insert('actmh', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mg001o');    
	      $seq2=$this->input->post('mg001c');
		//  $seq3=$this->input->post('mg002o');    
	    //  $seq4=$this->input->post('mg002c');
	      $sql = " SELECT mg001,mg002,mg003,create_date FROM actmg WHERE mg001 >= '$seq1'  AND mg001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('mg001o');    
	      $seq2=$this->input->post('mg001c');
		//  $seq3=$this->input->post('mg002o');    
	   //   $seq4=$this->input->post('mg002c');
	      $sql = " SELECT * FROM actmg WHERE mg001 >= '$seq1'  AND mg001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "mg001 >= '$seq1'  AND mg001 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('actmg')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mh001, b.mh002, b.mh003, b.mh004, b.mh005,
		  b.mh006');
		 
        $this->db->from('actmg as a');	
        $this->db->join('actmh as b', 'a.mg001 = b.mh001   ','left');
		$this->db->where('a.mg001', $this->uri->segment(4)); 
	  
		$this->db->order_by('mg001 , b.mh002');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mh001', $this->uri->segment(4));
		//$this->db->where('mh002', $this->uri->segment(5));
	    $query = $this->db->get('actmh');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS mg001disp, d.me002 AS mg004disp, e.mb002 AS mg010disp, f.mv002 AS mg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mh001, b.mh002, b.mh003, b.mh004, b.mh005,
		  b.mh006, b.mh007, b.mh011, b.mh009, b.mh017, b.mh018, b.mh012');
		 
        $this->db->from('actmg as a');	
        $this->db->join('actmh as b', 'a.mg001 = b.mh001  and a.mg002=b.mh002 ','left');		
		$this->db->join('cmsmq as c', 'a.mg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mg001', $this->input->post('mg001o')); 
	    $this->db->where('a.mg002', $this->input->post('mg002o')); 
		$this->db->order_by('mg001 , mg002 ,b.mh003');
		
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
          $this->db->select('a.* ,c.mq002 AS mg001disp, d.me002 AS mg004disp, e.mb002 AS mg010disp, f.mv002 AS mg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mh001, b.mh002, b.mh003, b.mh004, b.mh005,
		  b.mh006, b.mh007, b.mh011, b.mh009, b.mh017, b.mh018, b.mh012');
		 
        $this->db->from('actmg as a');	
        $this->db->join('actmh as b', 'a.mg001 = b.mh001  and a.mg002=b.mh002 ','left');		
		$this->db->join('cmsmq as c', 'a.mg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mg001', $this->uri->segment(4)); 
	    $this->db->where('a.mg002', $this->uri->segment(5)); 
		$this->db->order_by('mg001 , mg002 ,b.mh003');
		
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
		         'mg001' => $this->input->post('mg001'),
		         'mg002' => substr($this->input->post('mg002'),0,4).substr($this->input->post('mg002'),5,2).substr(rtrim($this->input->post('mg002')),8,2),
		         'mg003' => $this->input->post('mg003')
                );
            $this->db->where('mg001', $this->input->post('mg001'));
		//	$this->db->where('mg002', $this->input->post('mg002'));
            $this->db->update('actmg',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('mh001', $this->input->post('mg001'));
            $this->db->delete('actmh'); 
			
			$this->db->flush_cache();  
			// 新增明細 actmh
			
			    $n = '0';		
			//	$mh003='1000';
			while ($_POST['order_product'][  $n  ]['mh002']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mh001' => $this->input->post('mg001'),
		         'mh002' =>  $_POST['order_product'][ $n  ]['mh002'],
		         'mh003' =>  substr($_POST['order_product'][ $n  ]['mh003'],0,4).substr($_POST['order_product'][ $n ]['mh003'],5,2).substr($_POST['order_product'][ $n ]['mh003'],8,2),
		         'mh004' =>  substr($_POST['order_product'][ $n  ]['mh004'],0,4).substr($_POST['order_product'][ $n ]['mh004'],5,2).substr($_POST['order_product'][ $n ]['mh004'],8,2)
                );  
		     $this->db->insert('actmh', $data_array);
			// $mmh003 = (int) $mh003+10;
			// $mh003 =  (string)$mmh003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '10';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 while ($_POST['order_product'][  $n  ]['mh002']) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                'mh001' => $this->input->post('mg001'),
		         'mh002' =>  $_POST['order_product'][ $n  ]['mh002'],
		         'mh003' =>  substr($_POST['order_product'][ $n  ]['mh003'],0,4).substr($_POST['order_product'][ $n ]['mh003'],5,2).substr($_POST['order_product'][ $n ]['mh003'],8,2),
		         'mh004' =>  substr($_POST['order_product'][ $n  ]['mh004'],0,4).substr($_POST['order_product'][ $n ]['mh004'],5,2).substr($_POST['order_product'][ $n ]['mh004'],8,2)
                );   
			$this->db->insert('actmh', $data_array);
		//	$mmh003 = (int) $mh003+10;
		//	$mh003 =  (string)$mmh003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mg001', $this->uri->segment(4));
	//	  $this->db->where('mg002', $this->uri->segment(5));
          $this->db->delete('actmg'); 
		  $this->db->where('mh001', $this->uri->segment(4));
		//  $this->db->where('mh002', $this->uri->segment(5));
          $this->db->delete('actmh'); 
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
			      $this->db->where('mg001', $seq1);
			   //   $this->db->where('mg002', $seq2);
                  $this->db->delete('actmg'); 
				  $this->db->where('mh001', $seq1);
			    //  $this->db->where('mh002', $seq2);
                  $this->db->delete('actmh'); 
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