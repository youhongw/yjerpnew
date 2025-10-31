<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palq41_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('td001, td002, td003, td004, td005, td006, create_date');
        $this->db->from('paltd');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('td001 desc, td002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('paltd');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','td008','td023','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.td001,b.mv002 as td001disp, a.td002, c.me002 as td002disp,a.td003, a.td008, a.td023,a.td030,a.td039,a.td005')
	                      ->from('paltd as a')
						  ->join('cmsmv as b', 'a.td001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.td003 = c.me001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('paltd');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('td001', $this->uri->segment(4));
	    $this->db->where('td001', $this->uri->segment(4));	
	    $query = $this->db->get('paltd');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->td002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2)    
       { 
		 $this->db->select('a.*, b.mv002 as td001disp, c.me002 as td002disp');	
		 $this->db->from('paltd as a');
		 $this->db->join('cmsmv as b', 'a.td001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.td003 = c.me001 ','left');
		// $this->db->where('td001', $this->uri->segment(4));
		 $this->db->where('a.td001',$seq1); 
		 $this->db->where('a.td005',$seq2); 
	   //  $this->db->where('a.td003',$seq2); 
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `paltd` ";
	     $seq1 = " td001, td002, td003, td004, td005, td008,td014,td011, create_date FROM `paltd` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "a.`create_date` >='' ";
         $seq33 = 'td001 desc' ;
         $seq9 = " ORDER BY td001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "a.`create_date` >='' ";
         $seq7="td001 ";

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
	     $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td008','td014','td011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.td001,b.mv002 as td001disp, a.td002, c.me002 as td002disp,a.td003,a.td005, a.td008, a.td023,a.td030,a.td039, a.create_date')
	                       ->from('paltd as a')
						   ->join('cmsmv as b', 'a.td001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.td002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('paltd as a')
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
	    $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.td001,b.mv002 as td001disp, a.td002, c.me002 as td002disp,a.td003, a.td008, a.td023,a.td030,a.td039,a.td005, a.create_date');
	       $this->db->from('paltd as a');
			$this->db->join('cmsmv as b', 'a.td001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.td002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('td001 asc, td002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('paltd');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('td001', $this->input->post('palq01a')); 
	    $this->db->where('td005', $seg2); 	    
	    $query = $this->db->get('paltd');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()   
       {
       	$td003=substr($this->input->post('td003'),0,4).substr($this->input->post('td003'),5,2);
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'td001' => $this->input->post('palq01a'),
		          'td002' => $this->input->post('cmsq05a'),
		          'td003' =>substr($this->input->post('td003'),0,4).substr($this->input->post('td003'),5,2),
		          'td004' => $this->input->post('td004'),
                  'td005' => $this->input->post('td005'),
				  'td006' => $this->input->post('td006'),
				  'td007' => $this->input->post('td007'),
				  'td008' => $this->input->post('td008'),
				  'td009' => $this->input->post('td009'),
				  'td010' => $this->input->post('td010'),
				  'td011' => $this->input->post('td011'),
				  'td012' => $this->input->post('td012'),
				  'td013' => $this->input->post('td013'),
				  'td014' => $this->input->post('td014'),
				  'td015' => $this->input->post('td015'),
				  'td016' => $this->input->post('td016'),
				  'td017' => $this->input->post('td017'),
				  'td018' => $this->input->post('td018'),
				  'td019' => $this->input->post('td019'),
				  'td020' => $this->input->post('td020'),
				  'td021' => $this->input->post('td021'),
				  'td022' => $this->input->post('td022'),
				  'td023' => $this->input->post('td023')
				   
                      );
         
	    $exist = $this->palq41_model->selone1($this->input->post('palq01a'),$td003);
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('paltd', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seg4)    
       { 	
		 $this->db->where('td001',$seg2);
		 $this->db->where('td003',$seg4);
	    $query = $this->db->get('paltd');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('td001o');    
	    $seq2=$this->input->post('td001c');
    	$seq3=substr($this->input->post('td002o'),0,4).substr($this->input->post('td002o'),5,2);    
	    $seq4=substr($this->input->post('td002c'),0,4).substr($this->input->post('td002c'),5,2);
	    $this->db->where('td001', $seq1); 
	    $this->db->where('td003', $seq3);
	    $query = $this->db->get('paltd');
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
		        $td002=$row->td002;
				$td003=$row->td003;
                $td004=$row->td004;
                $td005=$row->td005;
                $td007=$row->td007; 
                $td008=$row->td008; 
                $td009=$row->td009; 
                $td010=$row->td010; 
                $td011=$row->td011; 
                $td012=$row->td012;	
			    $td013=$row->td013; 
                $td014=$row->td014; 
                $td015=$row->td015;	
				$td016=$row->td016; 
                $td017=$row->td017; 
                $td018=$row->td018;	
				$td019=$row->td019; 
                $td020=$row->td020; 
                $td021=$row->td021;
                $td022=$row->td022;
                $td023=$row->td023;				
	 	  endforeach;
	      } 
         //   $seq2=$this->input->post('td001c');    //主鍵一筆
	     //   $seq4=$this->input->post('td002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'td001' => $seq2,
		          'td002' => $td002,
		          'td003' => $seq4,
		          'td004' => $td004,
		          'td005' => $td005,
                  'td007' => $td007,
                  'td008' => $td008,
                  'td009' => $td009,
                  'td010' => $td010,
                  'td011' => $td011,
				  'td012' => $td012,
                  'td013' => $td013,
				  'td014' => $td014,
                  'td015' => $td015,
				  'td016' => $td016,
                  'td017' => $td017,
				  'td018' => $td018,
                  'td019' => $td019,
				  'td020' => $td020,
                  'td021' => $td021,
				  'td022' => $td022,
                  'td023' => $td023
                 			  
                    );
            $exist = $this->palq41_model->selone2($seq2,$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('paltd', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('td001o');    //查詢一筆以上
	    $seq2=$this->input->post('td001c'); 
	    $seq3=substr($this->input->post('td002o'),0,4).substr($this->input->post('td002o'),5,2);    
	    $seq4=substr($this->input->post('td002c'),0,4).substr($this->input->post('td002c'),5,2);
		 
	    $sql1 = " SELECT a.td001,b.mv002 as td001disp,a.td002,c.me002 as td002disp,a.td003, a.td004,a.td005,a.td006,a.td007,a.td008,a.td009,a.td010,a.td011,a.td012
		              ,a.td013,a.td014,a.td015,a.td016,a.td017,a.td018,a.td019,a.td020,a.td021,a.td022,a.td023 "; 
		$sql2 = " FROM paltd as a LEFT JOIN cmsmv as b ON  a.td001=b.mv001 LEFT JOIN cmsme as c ON a.td002=c.me001 "; 
		$sql3 = " WHERE a.td001 >= '$seq1'  AND a.td001 <= '$seq2' AND  a.td003 >= '$seq3'  AND a.td003 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('td001o');    //查詢一筆以上
	    $seq2=$this->input->post('td001c'); 
	   $seq3=substr($this->input->post('td002o'),0,4).substr($this->input->post('td002o'),5,2);    
	    $seq4=substr($this->input->post('td002c'),0,4).substr($this->input->post('td002c'),5,2);
		 
	    $sql1 = " SELECT a.*,b.mv002 as td001disp,c.me002 as td002disp "; 
		$sql2 = " FROM paltd as a LEFT JOIN cmsmv as b ON  a.td001=b.mv001 LEFT JOIN cmsme as c ON a.td002=c.me001 "; 
		$sql3 = " WHERE a.td001 >= '$seq1'  AND a.td001 <= '$seq2' AND  a.td003 >= '$seq3'  AND a.td003 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "td001 >= '$seq1'  AND td001 <= '$seq2' AND  td003 >= '$seq3'  AND td003 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('paltd')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	         
            //    if ($this->input->post('td015')>'0') {$td015=substr($this->input->post('td015'),0,4).substr($this->input->post('td015'),5,2).substr(rtrim($this->input->post('td015')),8,2);}
            //  else {$td015='';}  
            	$td003=substr($this->input->post('td003'),0,4).substr($this->input->post('td003'),5,2);			
		   $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'td002' => $this->input->post('cmsq05a'),
		          'td004' => $this->input->post('td004'),
                  'td005' => $this->input->post('td005'),
				  'td006' => $this->input->post('td006'),
				  'td007' => $this->input->post('td007'),
				  'td008' => $this->input->post('td008'),
				  'td009' => $this->input->post('td009'),
				  'td010' => $this->input->post('td010'),
				  'td011' => $this->input->post('td011'),
				  'td012' => $this->input->post('td012'),
				  'td013' => $this->input->post('td013'),
				  'td014' => $this->input->post('td014'),
				  'td015' => $this->input->post('td015'),
				  'td016' => $this->input->post('td016'),
				  'td017' => $this->input->post('td017'),
				  'td018' => $this->input->post('td018'),
				  'td019' => $this->input->post('td019'),
				  'td020' => $this->input->post('td020'),
				  'td021' => $this->input->post('td021'),
				  'td022' => $this->input->post('td022'),
				  'td023' => $this->input->post('td023')
                        );
			
            $this->db->where('td001', $this->input->post('palq01a'));
	        $this->db->where('td003', $td003);
            $this->db->update('paltd',$data);                   //更改一筆
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
	    $this->db->where('td001', $seg1);
        $this->db->delete('paltd'); 
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
		      $seq2;
			  $this->db->where('td001', $seq1);
			  $this->db->where('td003', $seq2);
              $this->db->delete('paltd'); 
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