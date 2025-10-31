<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puri02_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006, create_date');
        $this->db->from('purmb');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('purmb');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.mb001,b.mb002 as mb001disp,b.mb003 as mb001disp1,  a.mb002, c.ma002 as mb002disp,a.mb003, a.mb011, a.mb014, a.create_date')
	                      ->from('purmb as a')
						  ->join('invmb as b', 'a.mb001 = b.mb001 ','left')
						  ->join('purma as c', 'a.mb002 = c.ma001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('purmb');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mb001', $this->uri->segment(4));
	    $this->db->where('mb001', $this->uri->segment(4));	
	    $query = $this->db->get('purmb');
			
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
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2,$seq3)    
       { 
		 $this->db->select('a.*, d.mb002 as mb003disp,b.mb002 as mb001disp,b.mb003 as mb001disp1,c.ma002 as mb002disp');	
		 $this->db->from('purmb as a');
	     //$this->db->set('mb001', $this->uri->segment(4)); 
	    // $this->db->where('mb001', $this->uri->segment(4));
		 $this->db->join('invmb as b', 'a.mb001 = b.mb001 ','left');
		 $this->db->join('purma as c', 'a.mb002 = c.ma001 ','left'); 
		 $this->db->join('cmsmb as d', 'a.mb003 = d.mb001','left');
		// $this->db->where('mb001', $this->uri->segment(4));
		 $this->db->where('a.mb001',$seq1); 
	     $this->db->where('a.mb002', $seq2); 
	     $this->db->where('a.mb003', $seq3); 
		 $query = $this->db->get();
			
	     if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	   }
	   
	//查詢進階查詢 	
	function findf($limit, $offset, $sort_by, $sort_order)     
       {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `purmb` ";
	     $seq1 = " mb001, mb002, mb003, mb004, mb005, mb008,mb014, create_date FROM `purmb` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mb001 desc' ;
         $seq9 = " ORDER BY mb001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
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
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb008','mb014','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mb001, mb002, mb003, mb004, mb005, mb008,mb014, create_date')
	                       ->from('purmb')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purmb')
		                  ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
       }
	   
	//篩選多筆    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	   {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
        $sort_by = $this->uri->segment(4);			
        $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.mb001,b.mb002 as mb001disp,b.mb003 as mb001disp1,  a.mb002, c.ma002 as mb002disp,a.mb003, a.mb011, a.mb014, a.create_date');
	       $this->db->from('purmb as a');
			$this->db->join('invmb as b', 'a.mb001 = b.mb001 ','left');
			$this->db->join('purma as c', 'a.mb002 = c.ma001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('mb001 asc, mb002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('purmb');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2,$seg3,$seg4)    
       {
	  //  $this->db->set('mb001', $this->input->post('mb001')); 
	    $this->db->where('mb001', $this->input->post('invq02a')); 
	    $this->db->where('mb002', $this->input->post('purq01a')); 
	    $this->db->where('mb003', $this->input->post('cmsq06a')); 
		$this->db->where('mb014', substr($this->input->post('mb014'),0,4).substr($this->input->post('mb014'),5,2).substr(rtrim($this->input->post('mb014')),8,2)); 
	    $query = $this->db->get('purmb');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		  $smb013 = $this->input->post('mb013');
          if ($smb013 != 'Y') {
          $smb013 = 'N';
           }
		 
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'mb001' => $this->input->post('invq02a'),
		          'mb002' => $this->input->post('purq01a'),
		          'mb003' => $this->input->post('cmsq06a'),
		          'mb004' => $this->input->post('mb004'),
		          'mb005' => $this->input->post('mb005'),		        
                  'mb007' => $this->input->post('mb007'),
				  'mb008' => $this->input->post('mb008'),
				  'mb009' => $this->input->post('mb009'),
				  'mb010' => $this->input->post('mb010'),
				  'mb011' => $this->input->post('mb011'),
				  'mb012' => $this->input->post('mb012'),
				  'mb013' => $this->input->post('mb013'),
				  'mb014' => substr($this->input->post('mb014'),0,4).substr($this->input->post('mb014'),5,2).substr(rtrim($this->input->post('mb014')),8,2),
				  'mb015' => $this->input->post('mb015')
				   
                      );
         
	    $exist = $this->puri02_model->selone1($this->input->post('invq02a'),$this->input->post('purq01a'),$this->input->post('cmsq06a'),$this->input->post('mb014'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('purmb', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg3,$seg4)    
       { 	
	  //  $this->db->set('mb001', $this->input->post('mb002c')); 
	    $this->db->where('mb001',$seg3);
        $this->db->where('mb002',$seg4);		
	    $query = $this->db->get('purmb');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mb001o');    
	    $seq2=$this->input->post('mb001c');
    	 $seq3=$this->input->post('mb002o');    
	    $seq4=$this->input->post('mb002c');
	    $this->db->where('mb001', $this->input->post('mb001o')); 
	    $this->db->where('mb002', $this->input->post('mb002o')); 
	    $query = $this->db->get('purmb');
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
				$mb003=$row->mb003;
                $mb004=$row->mb004;
                $mb005=$row->mb005;
                $mb007=$row->mb007; 
                $mb008=$row->mb008; 
                $mb009=$row->mb009; 
                $mb010=$row->mb010; 
                $mb011=$row->mb011; 
                $mb012=$row->mb012; 
                $mb013=$row->mb013; 
                $mb014=$row->mb014; 
                $mb015=$row->mb015; 
                $mb016=$row->mb016; 				
	 	  endforeach;
	      } 
            $seq3=$this->input->post('mb001c');    //主鍵一筆
	        $seq4=$this->input->post('mb002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'mb001' => $seq3,
		          'mb002' => $seq4,
		          'mb003' => $mb003,
		          'mb004' => $mb004,
		          'mb005' => $mb005,
                  'mb007' => $mb007,
                  'mb008' => $mb008,
                  'mb009' => $mb009,
                  'mb010' => $mb010,
                  'mb011' => $mb011,
                  'mb012' => $mb012,
                  'mb013' => $mb013,
                  'mb014' => $mb014,
                  'mb015' => $mb015,
                  'mb016' => $mb016,
                  'mb017' => $mb017				  
                    );
            $exist = $this->puri02_model->selone2($seq3,$seq4));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('purmb', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('mb001c');    //查詢一筆以上
	    $seq2=$this->input->post('mb002c');
	    $sql = " SELECT mb001,mb002,mb003,mb004,mb005,mb006,mb007,create_date FROM purmb WHERE mb001 >= '$seq1'  AND mb001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('mb001o');    //查詢一筆以上
	    $seq2=$this->input->post('mb001c'); 
	    $seq3=$this->input->post('mb002o');    
	    $seq4=$this->input->post('mb002c'); 
		 
	//    $sql1 = " SELECT a.mb001,b.mb002 as mb001disp,b.mb003 as mb001disp1,  a.mb002, c.ma002 as mb002disp,a.mb003, a.mb011, a.mb014, a.create_date "; 
	//	$sql2 = " FROM purmb as a LEFT JOIN invmb as b ON  a.mb001=b.mb001 LEFT JOIN purma as c ON a.mb002=c.ma001 "; 
	//	$sql3 = " WHERE mb001 >= '$seq1'  AND mb001 <= '$seq2' AND  mb002 >= '$seq3'  AND mb002 <= '$seq4' "; 
	//	$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mb001 >= '$seq1'  AND mb001 <= '$seq2' AND  mb002 >= '$seq3'  AND mb002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('purmb')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	          if ($this->input->post('mb005')>'0') {$mb005=substr($this->input->post('mb005'),0,4).substr($this->input->post('mb005'),5,2).substr(rtrim($this->input->post('mb005')),8,2);}
              else {$mb005='';}  
			   if ($this->input->post('mb008')>'0') {$mb008=substr($this->input->post('mb008'),0,4).substr($this->input->post('mb008'),5,2).substr(rtrim($this->input->post('mb008')),8,2);}
              else {$mb008='';}  
			   if ($this->input->post('mb009')>'0') {$mb009=substr($this->input->post('mb009'),0,4).substr($this->input->post('mb009'),5,2).substr(rtrim($this->input->post('mb009')),8,2);}
              else {$mb009='';}  
			   if ($this->input->post('mb014')>'0') {$mb014=substr($this->input->post('mb014'),0,4).substr($this->input->post('mb014'),5,2).substr(rtrim($this->input->post('mb014')),8,2);}
              else {$mb014='';}  
                if ($this->input->post('mb015')>'0') {$mb015=substr($this->input->post('mb015'),0,4).substr($this->input->post('mb015'),5,2).substr(rtrim($this->input->post('mb015')),8,2);}
              else {$mb015='';}  			  
		   $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'mb004' => $this->input->post('mb004'),
		          'mb005' => $mb005,		        
                  'mb007' => $this->input->post('mb007'),
				  'mb008' => $mb008,
				  'mb009' => $mb009,
				  'mb010' => $this->input->post('mb010'),
				  'mb011' => $this->input->post('mb011'),
				  'mb012' => $this->input->post('mb012'),
				  'mb013' => $this->input->post('mb013'),
				  'mb014' => $mb014,
				  'mb015' => $mb015      
                        );
			
            $this->db->where('mb001', $this->input->post('invq02a'));
	        $this->db->where('mb002', $this->input->post('purq01a'));
			$this->db->where('mb003', $this->input->post('cmsq06a'));
            $this->db->update('purmb',$data);                   //更改一筆
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
	    $this->db->where('mb001', $seg1);
        $this->db->delete('purmb'); 
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
		      //   $seq2;
			  $this->db->where('mb001', $seq1);
              $this->db->delete('purmb'); 
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