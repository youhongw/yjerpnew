<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali52_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('te001, te002, te003, te004, te005, te006, create_date');
        $this->db->from('palte');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('te001 desc, te002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palte');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('te001', 'te002', 'te003', 'te004', 'te005', 'te006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.te001,b.mv002 as te001disp,a.te002, a.te003,a.te004, a.te005, a.te007,a.create_date')
	                      ->from('palte as a')
						  ->join('cmsmv as b', 'a.te001 = b.mv001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palte');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('te001', $this->uri->segment(4));
	    $this->db->where('te001', $this->uri->segment(4));	
	    $query = $this->db->get('palte');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->te002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2,$seq3)    
       { 
		 $this->db->select('a.*, b.mv002 as te001disp, c.me002 as te002disp');	
		 $this->db->from('palte as a');
		 $this->db->join('cmsmv as b', 'a.te001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.te002 = c.me001 ','left');
		// $this->db->where('te001', $this->uri->segment(4));
		 $this->db->where('a.te001',$seq1); 
	     $this->db->where('a.te002',$seq2);
         $this->db->where('a.te003',$seq3); 		 
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `palte` ";
	     $seq1 = " te001, te002, te003, te004, te005, te008,te014,te011, create_date FROM `palte` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "a.`create_date` >='' ";
         $seq33 = 'te001 desc' ;
         $seq9 = " ORDER BY te001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "a.`create_date` >='' ";
         $seq7="te001 ";

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
	     $sort_columns = array('te001', 'te002', 'te003', 'te004', 'te005', 'te006','te007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.te001,b.mv002 as te001disp, a.te002, c.me002 as te002disp,a.te003, a.te004, a.te005,a.te006,a.te007, a.create_date')
	                       ->from('palte as a')
						   ->join('cmsmv as b', 'a.te001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.te002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palte as a')
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
	    $sort_columns = array('te001', 'te002', 'te003', 'te004', 'te005', 'te006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.te001,b.mv002 as te001disp, a.te002, c.me002 as te002disp,a.te003, a.te004, a.te005,a.te006,a.te007, a.create_date');
	       $this->db->from('palte as a');
			$this->db->join('cmsmv as b', 'a.te001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.te002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('te001 asc, te002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palte');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('te001', $this->input->post('palq01a')); 
	    $this->db->where('te003', $seg2); 	    
	    $query = $this->db->get('palte');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		$te002=substr($this->input->post('te002'),0,4).substr($this->input->post('te002'),5,2).substr(rtrim($this->input->post('te002')),8,2);
       	$te003=substr($this->input->post('te003'),0,2).substr($this->input->post('te003'),3,2);
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'te001' => $this->input->post('palq01a'),
		          'te002' => substr($this->input->post('te002'),0,4).substr($this->input->post('te002'),5,2).substr(rtrim($this->input->post('te002')),8,2),
		       //   'te003' =>substr($this->input->post('te003'),0,2).substr($this->input->post('te003'),3,2),
		          'te003' => $this->input->post('te003'),
				  'te004' => $this->input->post('te004'),
                  'te005' => $this->input->post('te005'),
				  'te006' => substr($this->input->post('te006'),0,4).substr($this->input->post('te006'),5,2).substr(rtrim($this->input->post('te006')),8,2),
				  'te007' => $this->input->post('te007')
				   
                      );
         
	    $exist = $this->pali52_model->selone1($this->input->post('palq01a'),$te003);
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('palte', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seg4,$seg6)    
       { 	
		 $this->db->where('te001',$seg2);
		 $this->db->where('te002',$seg4);
		 $this->db->where('te003',$seg6);
	    $query = $this->db->get('palte');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('te001o');    
	    $seq2=$this->input->post('te001c');
    	$seq3=substr($this->input->post('te002o'),0,4).substr($this->input->post('te002o'),5,2).substr($this->input->post('te002o'),8,2);    
	    $seq4=substr($this->input->post('te002c'),0,4).substr($this->input->post('te002c'),5,2).substr($this->input->post('te002o'),8,2);
		$seq5=substr($this->input->post('te003o'),0,2).substr($this->input->post('te003o'),3,2);    
	    $seq6=substr($this->input->post('te003c'),0,2).substr($this->input->post('te003c'),3,2);
	    $this->db->where('te001', $seq1); 
	    $this->db->where('te002', $seq3);
		$this->db->where('te003', $seq5);
	    $query = $this->db->get('palte');
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
		        $te002=$row->te002;
				$te003=$row->te003;
                $te004=$row->te004;
                $te005=$row->te005;
                $te007=$row->te007; 
	 	  endforeach;
	      } 
         //   $seq2=$this->input->post('te001c');    //主鍵一筆
	     //   $seq4=$this->input->post('te002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'te001' => $seq2,
		          'te002' => $seq4,
		          'te003' => $seq6,
		          'te004' => $te004,
		          'te005' => $te005,
                  'te007' => $te007
                 			  
                    );
            $exist = $this->pali52_model->selone2($seq2,$seq4,$seq6);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palte', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('te001o');    //查詢一筆以上
	    $seq2=$this->input->post('te001c'); 
	    $seq3=substr($this->input->post('te002o'),0,4).substr($this->input->post('te002o'),5,2);    
	    $seq4=substr($this->input->post('te002c'),0,4).substr($this->input->post('te002c'),5,2);
		 
	    $sql1 = " SELECT a.te001,b.mv002 as te001disp,b.mv004 as te001disp1,c.me002 as te001disp2,a.te002,a.te003, a.te004,a.te005,a.te006,a.te007 "; 
		$sql2 = " FROM palte as a LEFT JOIN cmsmv as b ON  a.te001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 "; 
		$sql3 = " WHERE a.te001 >= '$seq1'  AND a.te001 <= '$seq2' AND  a.te002 >= '$seq3'  AND a.te002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('te001o');    //查詢一筆以上
	    $seq2=$this->input->post('te001c'); 
	    $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr($this->input->post('dateo'),8,2);    
	    $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr($this->input->post('datec'),8,2);
		 
	    $sql1 = " SELECT a.*,b.mv002 as te001disp,b.mv004 as te001disp1,c.me002 as te001disp2 "; 
		$sql2 = " FROM palte as a LEFT JOIN cmsmv as b ON  a.te001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 "; 
		$sql3 = " WHERE a.te001 >= '$seq1'  AND a.te001 <= '$seq2' AND  a.te002 >= '$seq3'  AND a.te002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "te001 >= '$seq1'  AND te001 <= '$seq2' AND  te002 >= '$seq3'  AND te002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palte')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	         
            //    if ($this->input->post('te015')>'0') {$te015=substr($this->input->post('te015'),0,4).substr($this->input->post('te015'),5,2).substr(rtrim($this->input->post('te015')),8,2);}
            //  else {$te015='';}
			    $te002=substr($this->input->post('te002'),0,4).substr($this->input->post('te002'),5,2).substr(rtrim($this->input->post('te002')),8,2);
            	$te003=preg_match_all('/\d/S',$this->input->post('te003'), $matches);
				$te003 = implode('',$matches[0]);
				$te003_origin=preg_match_all('/\d/S',$this->input->post('te003_origin'), $matches);
				$te003_origin = implode('',$matches[0]);
				
		   $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				//  'te003' =>substr($this->input->post('te003'),0,2).substr($this->input->post('te003'),3,2),
		          'te003' => $this->input->post('te003'),
				  'te004' => $this->input->post('te004'),
                  'te005' => $this->input->post('te005'),
				  'te006' => substr($this->input->post('te006'),0,4).substr($this->input->post('te006'),5,2).substr(rtrim($this->input->post('te006')),8,2),
				  'te007' => $this->input->post('te007')
                        );
            $this->db->where('te001', $this->input->post('palq01a'));
	        $this->db->where('te002', $te002);
			$this->db->where('te003', $te003_origin);
            $this->db->update('palte',$data);                   //更改一筆
			//echo "<pre>";var_dump($this->db);exit;
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
	    $this->db->where('te001', $seg1);
        $this->db->delete('palte'); 
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
		      list($seq1,$seq2,$seq3) = explode("/", $seq[$x]);
		      $seq1;
		      $seq2;
			  $seq3;
			  $this->db->where('te001', $seq1);
			  $this->db->where('te002', $seq2);
			  $this->db->where('te003', $seq3);
              $this->db->delete('palte'); 
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