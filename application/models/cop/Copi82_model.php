<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copi82_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
		 
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mm001, mm002, mm003, mm004, mm005, mm006, mm008, create_date');
        $this->db->from('copmm');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mm001 desc, mm002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('copmm');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mm001', 'mm002', 'mm003', 'mm004', 'mm005','mm008', 'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mm001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.*,b.mv002 as mm002disp,c.ma002 as mm003disp')
	                      ->from('copmm as a')
						  ->join('cmsmv as b', 'a.mm002 = b.mv001 ','left')
						  ->join('copma as c', 'a.mm003 = c.ma001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('copmm as a');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mm001', $this->uri->segment(4));
	    $this->db->where('mm001', $this->uri->segment(4));	
	    $query = $this->db->get('copmm');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->mm002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('a.*, b.mv002 as mm002disp,c.ma002 as mm003disp');
		  $this->db->from('copmm as a');
         $this->db->join('cmsmv as b', 'a.mm002 = b.mv001 ','left');
		 $this->db->join('copma as c', 'a.mm003 = c.ma001 ','left');		 
		 
	     $this->db->set('mm001', $this->uri->segment(4)); 
	     $this->db->where('mm002', $this->uri->segment(5));
		 $this->db->where('mm003', $this->uri->segment(6));
	//	 $this->db->join('cmsmb', 'copmm.mm003 = cmsmb.mb001','left');
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `copmm` ";
	     $seq1 = " mm001, mm002, mm003, mm004, mm005, create_date FROM `copmm` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mm001 desc' ;
         $seq9 = " ORDER BY mm001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mm001 ";

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
	     $sort_columns = array('mm001', 'mm002', 'mm003', 'mm004', 'mm005', 'mm008','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mm001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.mm001, a.mm002, a.mm003, a.mm004, a.mm005,a.mm008,b.mv002 as mm002disp,c.ma002 as mm003disp,  a.create_date')
	                       ->from('copmm as a')
						   ->join('cmsmv as b', 'a.mm002 = b.mv001 ','left')
		                   ->join('copma as c', 'a.mm003 = c.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('copmm as a')
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
	    $sort_columns = array('mm001', 'mm002','b.mv002', 'mm003','c.ma002', 'mm004', 'mm005', 'mm008','a.create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mm001';  //檢查排序欄位是否為 table
	    $this->db->select('a.mm001, a.mm002, a.mm003, a.mm004, a.mm005,a.mm008,b.mv002,b.mv002 as mm002disp,c.ma002,c.ma002 as mm003disp, a.create_date');
	    $this->db->from('copmm as a');
		                  $this->db->join('cmsmv as b', 'a.mm002 = b.mv001 ','left');
		                   $this->db->join('copma as c', 'a.mm003 = c.ma001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mm001 asc, mm002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('copmm as a');
		 $this->db->join('cmsmv as b', 'a.mm002 = b.mv001 ','left');
		 $this->db->join('copma as c', 'a.mm003 = c.ma001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->set('mm001', $this->input->post('mm001')); 
	    $this->db->where('mm001', $this->input->post('mm001')); 
	    $query = $this->db->get('copmm');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		  $smm005 = $this->input->post('mm005');
          if ($smm005 != 'Y') {
          $smm005 = 'N';
           }
		  $smm006 = $this->input->post('mm006');
          if ($smm006 != 'Y') {
          $smm006 = 'N';
           }
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'mm001' => substr($this->input->post('mm001'),0,4).substr($this->input->post('mm001'),5,2).substr(rtrim($this->input->post('mm001')),8,2),
		          'mm002' => $this->input->post('cmsq09a3'),
		          'mm003' => $this->input->post('copq81a'),
		          'mm004' => strtoupper($this->input->post('mm004')),
		          'mm005' => $this->input->post('mm005'),
                  'mm006' => $this->input->post('mm006'),
                  'mm007' => $this->input->post('mm007'),
                  'mm008' => $this->input->post('mm008'),
                   'mm009' => $this->input->post('mm009'),
                    'mm010' => $this->input->post('mm010')				   
                      );
         
	    $exist = $this->copi82_model->selone1($this->input->post('mm001'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('copmm', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->set('mm001', $this->input->post('mm002c')); 
	    $this->db->where('mm001', $this->input->post('mm002c')); 
		$this->db->where('mm002', $this->input->post('mm004c')); 
		$this->db->where('mm003', $this->input->post('mm006c')); 
	    $query = $this->db->get('copmm');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mm001c');    
	    $seq2=$this->input->post('mm002c');
		$seq3=$this->input->post('mm003c');    
	    $seq4=$this->input->post('mm004c');
		$seq5=$this->input->post('mm005c');    
	    $seq6=$this->input->post('mm006c');
	    $this->db->where('mm001', $this->input->post('mm001c')); 
		$this->db->where('mm002', $this->input->post('mm003c')); 
		$this->db->where('mm003', $this->input->post('mm005c')); 
	    $query = $this->db->get('copmm');
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
              //  $mm002=$row->mm002;
			//	$mm003=$row->mm003;
                $mm004=$row->mm004;
                $mm005=$row->mm005;
               				   
	 	  endforeach;
	      } 
            $seq3=$this->input->post('mm002c');    //主鍵一筆
	  
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'mm001' => $this->input->post('mm002c'),
		          'mm002' => $this->input->post('mm004c'),
		          'mm003' => $this->input->post('mm006c'),
		          'mm004' => $mm004,
		          'mm005' => $mm005		  
                    );
            $exist = $this->copi82_model->selone2($this->input->post('mm002c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('copmm', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('mm001c');    //查詢一筆以上
	    $seq2=$this->input->post('mm002c');
		$seq3=$this->input->post('mm003c');    //查詢一筆以上
	    $seq4=$this->input->post('mm004c');
		$seq5=$this->input->post('mm005c');    //查詢一筆以上
	    $seq6=$this->input->post('mm006c');
	    $sql = " SELECT mm001,mm002,mm003,mm004,mm005,create_date FROM copmm WHERE mm001 >= '$seq1'  AND mm001 <= '$seq2' and
             mm002 >= '$seq3'  AND mm002 <= '$seq4' and  mm003 >= '$seq5'  AND mm003 <= '$seq6'		"; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('mm001c');    //查詢一筆以上
	    $seq2=$this->input->post('mm002c'); 
		 $seq3=$this->input->post('mm003c');    //查詢一筆以上
	    $seq4=$this->input->post('mm004c'); 
		 $seq5=$this->input->post('mm005c');    //查詢一筆以上
	    $seq6=$this->input->post('mm006c'); 
			 $seq7=$this->input->post('mm007c');    //查詢一筆以上
	    $seq8=$this->input->post('mm008c'); 
		 $seq9=$this->input->post('mm009c'); 
		  $seq10=$this->input->post('mm010c'); 
	    $sql = " SELECT a.*,b.ma002 as mm003disp,c.mv002 as mm002disp FROM copmm as a  left join copma as b on a.mm003=b.ma001 left join cmsmv as c on a.mm002=c.mv001   
		WHERE mm001 >= '$seq1'  AND mm001 <= '$seq2' and  mm002 >= '$seq3'  AND mm002 <= '$seq4' and  mm004 >= '$seq5'  AND mm004 <= '$seq6' and  mm003 >= '$seq7'  AND mm003 <= '$seq8' and  mm008 >= '$seq9'  AND mm008 <= '$seq10' "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mm001 >= '$seq1'  AND mm001 <= '$seq2' and  mm002 >= '$seq3'  AND mm002 <= '$seq4' and  mm004 >= '$seq5'  AND mm004 <= '$seq6' and  mm003 >= '$seq7'  AND mm003 <= '$seq8' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('copmm')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	 
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				//   'mm002' => $this->input->post('cmsq09a3'),
		        //  'mm003' => $this->input->post('copq81a'),
		          'mm004' => strtoupper($this->input->post('mm004')),
				//  'mm005' => $this->textarea->post('mm005')
		          'mm005' =>  $this->input->post('mm005'),
                  'mm006' =>  $this->input->post('mm006'),
                  'mm007' =>  $this->input->post('mm007'),
                  'mm008' =>  $this->input->post('mm008'),
                    'mm009' =>  $this->input->post('mm009'), 	
                    'mm010' =>  $this->input->post('mm010') 						
                        );
			  $mm001=substr($this->input->post('mm001'),0,4).substr($this->input->post('mm001'),5,2).substr(rtrim($this->input->post('mm001')),8,2);
            $this->db->where('mm001', $mm001);
	        $this->db->where('mm002', $this->input->post('cmsq09a3'));
		    $this->db->where('mm003', $this->input->post('copq81a'));
            $this->db->update('copmm',$data);                   //更改一筆
			                //更改一筆
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
	    $this->db->where('mm001', $seg1);
        $this->db->delete('copmm'); 
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
		 $seq3=' ';		
	     if (!empty($_POST['selected'])) 
	       {
            foreach($_POST['selected'] as $check) 
		     {
			  $seq[$x] = $check; 
		      list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
		      $seq1;
		      $seq2;
			  $seq3;
			  $this->db->where('mm001', $seq1);
			  $this->db->where('mm002', $seq2);
			  $this->db->where('mm003', $seq3);
              $this->db->delete('copmm'); 
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