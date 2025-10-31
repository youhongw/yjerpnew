<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pali25_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('ml001, ml002, ml003, ml004, ml005, ml006, create_date');
        $this->db->from('palml1');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('ml001 desc, ml002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palml1');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('ml001', 'ml002', 'ml003', 'ml004', 'ml005', 'ml006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ml001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.ml001,b.mv002 as ml001disp, a.ml002, c.me002 as ml002disp,a.ml003, a.ml004, a.ml005, d.mk002 as ml008disp,ml010,ml013')
	                      ->from('palml1 as a')
						  ->join('cmsmv as b', 'a.ml001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.ml002 = c.me001 ','left')
						  ->join('palmk as d', 'a.ml008 = d.mk001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palml1');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('ml001', $this->uri->segment(4));
	    $this->db->where('ml001', $this->uri->segment(4));	
	    $query = $this->db->get('palml1');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->ml002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2)    
       { 
		 $this->db->select('a.*, b.mv002 as ml001disp, c.me002 as ml002disp, d.mk002 as ml008disp,e.mp002 as ml010disp,f.mq002 as ml011disp');	
		 $this->db->from('palml1 as a');
		 $this->db->join('cmsmv as b', 'a.ml001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.ml002 = c.me001 ','left');
		  $this->db->join('palmk as d', 'a.ml008 = d.mk001 ','left');
		  $this->db->join('palmp as e', 'a.ml010 = e.mp001 ','left');
		 $this->db->join('palmq as f', 'a.ml011 = f.mq001 ','left');
		// $this->db->where('ml001', $this->uri->segment(4));
		 $this->db->where('a.ml001',$seq1); 
	    
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `palml1` ";
	     $seq1 = " ml001, ml002, ml003, ml004, ml005, create_date FROM `palml1` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'ml001 desc' ;
         $seq9 = " ORDER BY ml001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="ml001 ";

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
	     $sort_columns = array('ml001', 'ml002', 'ml003', 'ml004', 'ml005', 'ml008','ml014','ml011','ml013','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ml001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ml001,ml001 as ml001disp,ml001 as ml001disp1,ml002 as ml002disp, ml002, ml003, ml004, ml005,ml010,ml013,create_date')
	                       ->from('palml1')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palml1')
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
	    $sort_columns = array('ml001', 'ml002', 'ml003', 'ml004', 'ml005', 'ml006','ml013','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ml001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.ml001,b.mv002 as ml001disp, a.ml002, c.me002 as ml002disp,a.ml003, a.ml004, a.ml005,a.ml010,a.ml013, a.create_date');
	       $this->db->from('palml1 as a');
			$this->db->join('cmsmv as b', 'a.ml001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.ml002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('ml001 asc, ml002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palml1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('ml001', $this->input->post('palq01a')); 
	    $this->db->where('ml002', $seg2); 	    
	    $query = $this->db->get('palml1');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()   
       {
       		 $ml013=substr($this->input->post('ml013'),0,4).substr($this->input->post('ml013'),5,2).substr(rtrim($this->input->post('ml013')),8,2);
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'ml001' => $this->input->post('palq01a'),
		          'ml002' => $this->input->post('cmsq05a'),
		          'ml003' => $this->input->post('ml003'),
		          'ml004' => $this->input->post('ml004'),
                  'ml005' => $this->input->post('ml005'),
				  'ml006' => $this->input->post('ml006'),
				  'ml007' => $this->input->post('ml007'),
				  'ml008' => $this->input->post('palq21a'),
				  'ml009' => $this->input->post('ml009'),
				   'ml010' => $this->input->post('palq02a'),
				  'ml011' => $this->input->post('palq04a'),
				  'ml012' => $this->input->post('ml012'),
				  'ml013' => substr($this->input->post('ml013'),0,4).substr($this->input->post('ml013'),5,2).substr(rtrim($this->input->post('ml013')),8,2)
				   
                      );
         $data1 = array( 
	            
		          'modi_date' => date("Ymd"),
                  'ml001' => $this->input->post('palq01a'),
		          'ml002' => $this->input->post('cmsq05a'),
		          'ml003' => $this->input->post('ml003'),
		          'ml004' => $this->input->post('ml004'),
                  'ml005' => $this->input->post('ml005'),
				  'ml006' => $this->input->post('ml006'),
				  'ml007' => $this->input->post('ml007'),
				  'ml008' => $this->input->post('palq21a'),
				  'ml009' => $this->input->post('ml009'),
				  'ml010' => $this->input->post('palq02a'),
				  'ml011' => $this->input->post('palq04a'),
				  'ml012' => $this->input->post('ml012'),
				  
                      );
	    $exist = $this->pali25_model->selone1($this->input->post('palq01a'),$ml013);
	    if ($exist)
	      {
		    return 'exist';
		  } 
		    $this->db->where('ml001', $this->input->post('palq01a'));	      
            $this->db->update('palml',$data1);
			
           return  $this->db->insert('palml1', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1,$seg2)    
       { 	
		 $this->db->where('ml001',$this->input->post('ml001c'));
		  $this->db->where('ml010',$seg2);
	    $query = $this->db->get('palml1');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('ml001o');    
	    $seq2=$this->input->post('ml001c');
    	
		$seq3=substr($this->input->post('ml002o'),0,4).substr($this->input->post('ml002o'),5,2).substr($this->input->post('ml002o'),8,2);    
	    $seq4=substr($this->input->post('ml002c'),0,4).substr($this->input->post('ml002c'),5,2).substr($this->input->post('ml002c'),8,2);
	    $this->db->where('ml001', $this->input->post('ml001o')); 
	    $this->db->where('ml010', $seq3); 
	    $query = $this->db->get('palml1');
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
		        $ml002=$row->ml002;
				$ml003=$row->ml003;
                $ml004=$row->ml004;
                $ml005=$row->ml005;
                $ml007=$row->ml007; 
                $ml008=$row->ml008; 
                $ml009=$row->ml009;
				$ml010=$row->ml010;
	 	  endforeach;
	      } 
         //   $seq2=$this->input->post('ml001c');    //主鍵一筆
	     //   $seq4=$this->input->post('ml002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'ml001' => $seq2,
		          'ml002' => $ml002,
		          'ml003' => $ml003,
		          'ml004' => $ml004,
		          'ml005' => $ml005,
                  'ml007' => $ml007,
                  'ml008' => $ml008,
                  'ml009' => $ml009,
				  'ml010' => $ml010
                 			  
                    );
            $exist = $this->pali25_model->selone2($this->input->post('ml001c'),$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palml1', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('ml001o');    //查詢一筆以上
	    $seq2=$this->input->post('ml001c'); 
	    $seq3=substr($this->input->post('ml002o'),0,4).substr($this->input->post('ml002o'),5,2).substr($this->input->post('ml002o'),8,2);    
	    $seq4=substr($this->input->post('ml002c'),0,4).substr($this->input->post('ml002c'),5,2).substr($this->input->post('ml002c'),8,2);
		 
	    $sql1 = " SELECT a.ml001,b.mv002 as ml001disp,a.ml002,c.me002 as ml002disp,a.ml003, a.ml004,a.ml005,a.ml006,a.ml007,a.ml008,d.mk002 as ml008disp,a.ml009 "; 
		$sql2 = " FROM palml1 as a LEFT JOIN cmsmv as b ON  a.ml001=b.mv001 LEFT JOIN cmsme as c ON a.ml002=c.me001 LEFT JOIN palmk as d ON a.ml008=d.mk001"; 
		$sql3 = " WHERE a.ml001 >= '$seq1'  AND a.ml001 <= '$seq2' AND  a.ml010 >= '$seq3'  AND a.ml010 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('ml001o');    //查詢一筆以上
	    $seq2=$this->input->post('ml001c'); 
	   $seq3=substr($this->input->post('ml002o'),0,4).substr($this->input->post('ml002o'),5,2).substr($this->input->post('ml002o'),8,2);    
	    $seq4=substr($this->input->post('ml002c'),0,4).substr($this->input->post('ml002c'),5,2).substr($this->input->post('ml002c'),8,2);
		 
	    $sql1 = " SELECT a.*,b.mv002 as ml001disp,c.me002 as ml002disp,d.mk002 as ml008disp "; 
		$sql2 = " FROM palml1 as a LEFT JOIN cmsmv as b ON  a.ml001=b.mv001 LEFT JOIN cmsme as c ON a.ml002=c.me001 LEFT JOIN palmk as d ON a.ml008=d.mk001 "; 
		$sql3 = " WHERE a.ml001 >= '$seq1'  AND a.ml001 <= '$seq2' AND  a.ml010 >= '$seq3'  AND a.ml010 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "ml001 >= '$seq1'  AND ml001 <= '$seq2' AND  ml010 >= '$seq3'  AND ml010 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palml1')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	         
                if ($this->input->post('ml013')>'0') {$ml013=substr($this->input->post('ml013'),0,4).substr($this->input->post('ml013'),5,2).substr(rtrim($this->input->post('ml013')),8,2);}
              else {$ml013='';}  			  
		   $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'ml003' => $this->input->post('ml003'),
		          'ml004' => $this->input->post('ml004'),
                  'ml005' => $this->input->post('ml005'),
				  'ml006' => $this->input->post('ml006'),
				  'ml007' => $this->input->post('ml007'),
				 'ml008' => $this->input->post('palq21a'),
				  'ml009' => $this->input->post('ml009'),
				   'ml010' => $this->input->post('palq02a'),
				  'ml011' => $this->input->post('palq04a'),
				  'ml012' => $this->input->post('ml012'),
				//  'ml013' => substr($this->input->post('ml013'),0,4).substr($this->input->post('ml013'),5,2).substr(rtrim($this->input->post('ml013')),8,2)
                        );
			 $data1 = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'ml003' => $this->input->post('ml003'),
		          'ml004' => $this->input->post('ml004'),
                  'ml005' => $this->input->post('ml005'),
				  'ml006' => $this->input->post('ml006'),
				  'ml007' => $this->input->post('ml007'),
				 'ml008' => $this->input->post('palq21a'),
				  'ml009' => $this->input->post('ml009'),
				   'ml010' => $this->input->post('palq02a'),
				  'ml011' => $this->input->post('palq04a'),
				  'ml012' => $this->input->post('ml012'),
				 
                        );			
            $this->db->where('ml001', $this->input->post('palq01a'));
	       $this->db->where('ml013', $ml013);
            $this->db->update('palml1',$data);                   //更改一筆
			
			$this->db->where('ml001', $this->input->post('palq01a'));	      
            $this->db->update('palml',$data1);
			
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
	    $this->db->where('ml001', $seg1);
        $this->db->delete('palml1'); 
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
			  $this->db->where('ml001', $seq1);
			  $this->db->where('ml010', $seq2);
              $this->db->delete('palml1'); 
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