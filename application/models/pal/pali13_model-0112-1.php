<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali13_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006, create_date');
        $this->db->from('palmv');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mv001 desc, mv002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmv');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.mv001,b.mv002 as mv001disp, a.mv002, c.me002 as mv002disp,a.mv003, a.mv004, a.mv005')
	                      ->from('palmv as a')
						  ->join('cmsmv as b', 'a.mv001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.mv002 = c.me001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmv');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mv001', $this->uri->segment(4));
	    $this->db->where('mv001', $this->uri->segment(4));	
	    $query = $this->db->get('palmv');
			
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
	   
	//查詢一筆 修改用   
	function selone($seq1)    
       { 
		 $this->db->select('a.*, b.mv002 as mv001disp,c.me002 as mv002disp, d.mu002 as mv006disp');	
		 $this->db->from('palmv as a');
		 $this->db->join('cmsmv as b', 'a.mv001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.mv002 = c.me001 ','left');
		 $this->db->join('palmu as d', 'a.mv006 = d.mu001 ','left');
		// $this->db->where('mv001', $this->uri->segment(4));
		 $this->db->where('a.mv001',$seq1); 
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `palmv` ";
	     $seq1 = " mv001, mv002, mv003, mv004, mv005, mv008,mv014,mv011, create_date FROM `palmv` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mv001 desc' ;
         $seq9 = " ORDER BY mv001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mv001 ";

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
	     $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv008','mv014','mv011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mv001,mv001 as mv001disp,mv001 as mv001disp1,mv002 as mv002disp, mv002, mv003, mv004, mv005, mv006,mv007, create_date')
	                       ->from('palmv')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palmv')
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
	    $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.mv001,b.mv002 as mv001disp, a.mv002, c.me002 as mv002disp,a.mv014, a.mv003, a.mv013, a.create_date');
	       $this->db->from('palmv as a');
			$this->db->join('cmsmv as b', 'a.mv001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.mv002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('mv001 asc, mv002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palmv');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->where('mv001', $this->input->post('palq01a'));     
	    $query = $this->db->get('palmv');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()   
       {
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'mv001' => $this->input->post('palq01a'),
		          'mv002' => $this->input->post('cmsq05a'),
		          'mv003' => substr($this->input->post('mv003'),0,4).substr($this->input->post('mv003'),5,2).substr(rtrim($this->input->post('mv003')),8,2),
		          'mv004' => $this->input->post('mv004'),
                  'mv005' => $this->input->post('mv005'),
				  'mv006' => $this->input->post('palq12a'),
				  'mv007' => $this->input->post('mv007')
				   ); 
               $exist = $this->pali13_model->selone1($this->input->post('palq01a'));   //查詢資料是否重複
	    if ($exist)
	     {
		  return 'exist';
		 } 
          return  $this->db->insert('palmv', $data);
        }
         
	  
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seq4)    
       { 	
		 $this->db->where('mv001',$this->input->post('mv001c'));
		 $this->db->where('mv014',$seq4);
	    $query = $this->db->get('palmv');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mv001o');    
	    $seq2=$this->input->post('mv001c');
    	
		$seq3=substr($this->input->post('mv002o'),0,4).substr($this->input->post('mv002o'),5,2).substr($this->input->post('mv002o'),8,2);    
	    $seq4=substr($this->input->post('mv002c'),0,4).substr($this->input->post('mv002c'),5,2).substr($this->input->post('mv002c'),8,2);
	    $this->db->where('mv001', $this->input->post('mv001o')); 
	     $this->db->where('mv014', $seq3);
	    $query = $this->db->get('palmv');
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
		        $mv002=$row->mv002;
				$mv003=$row->mv003;
                $mv004=$row->mv004;
                $mv005=$row->mv005;
                $mv007=$row->mv007; 
                $mv008=$row->mv008; 
                $mv009=$row->mv009; 
                $mv010=$row->mv010; 
                $mv011=$row->mv011; 
                $mv012=$row->mv012; 
                $mv013=$row->mv013;	
                $mv014=$row->mv014; 
                $mv015=$row->mv015;					
	 	  endforeach;
	      } 
          //  $seq2=$this->input->post('mv001c');    //主鍵一筆
	     //   $seq4=$this->input->post('mv002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'mv001' => $seq2,
		          'mv002' => $mv002,
		          'mv003' => $mv003,
		          'mv004' => $mv004,
		          'mv005' => $mv005,
                  'mv007' => $mv007,
                  'mv008' => $mv008,
                  'mv009' => $mv009,
                  'mv010' => $mv010,
                  'mv011' => $mv011,
                  'mv012' => $mv012,
                  'mv013' => $mv013,
				  'mv014' => $mv014,
                  'mv015' => $mv015
                 			  
                    );
            $exist = $this->pali13_model->selone2($this->input->post('mv001c'),$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palmv', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('mv001o');    //查詢一筆以上
	    $seq2=$this->input->post('mv001c'); 
	 //   $seq3=$this->input->post('mv002o');    
	 //   $seq4=$this->input->post('mv002c'); 
		$seq3=substr($this->input->post('mv002o'),0,4).substr($this->input->post('mv002o'),5,2).substr($this->input->post('mv002o'),8,2);    
	    $seq4=substr($this->input->post('mv002c'),0,4).substr($this->input->post('mv002c'),5,2).substr($this->input->post('mv002c'),8,2);
		 
	    $sql1 = " SELECT a.mv001,b.mv002 as mv001disp,a.mv002,c.me002 as mv002disp,a.mv003, a.mv004,a.mv005,a.mv006,a.mv007 "; 
		$sql2 = " FROM palmv as a LEFT JOIN cmsmv as b ON  a.mv001=b.mv001 LEFT JOIN cmsme as c ON a.mv002=c.me001 "; 
		$sql3 = "  WHERE trim(a.mv001) >= '$seq1'  AND trim(a.mv001) <= '$seq2' AND  trim(a.mv003) >= '$seq3'  AND trim(a.mv003) <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('mv001o');    //查詢一筆以上
	    $seq2=$this->input->post('mv001c'); 
	 //   $seq3=$this->input->post('mv002o');    
	  //  $seq4=$this->input->post('mv002c'); 
		$seq3=substr($this->input->post('mv002o'),0,4).substr($this->input->post('mv002o'),5,2).substr($this->input->post('mv002o'),8,2);    
	    $seq4=substr($this->input->post('mv002c'),0,4).substr($this->input->post('mv002c'),5,2).substr($this->input->post('mv002c'),8,2);
		 
	    $sql1 = " SELECT a.*,b.mv002 as mv001disp,c.me002 as mv002disp "; 
		$sql2 = " FROM palmv as a LEFT JOIN cmsmv as b ON  a.mv001=b.mv001 LEFT JOIN cmsme as c ON a.mv002=c.me001 "; 
		$sql3 = " WHERE a.mv001 >= '$seq1'  AND trim(a.mv001) <= '$seq2' AND  a.mv003 >= '$seq3'  AND trim(a.mv003) <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mv001 >= '$seq1'  AND trim(mv001) <= '$seq2' AND  mv003 >= '$seq3'  AND trim(mv003) <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palmv')
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
		          'mv002' => $this->input->post('cmsq05a'),
		          'mv003' => substr($this->input->post('mv003'),0,4).substr($this->input->post('mv003'),5,2).substr(rtrim($this->input->post('mv003')),8,2),
		          'mv004' => $this->input->post('mv004'),
                  'mv005' => $this->input->post('mv005'),
				  'mv006' => $this->input->post('palq12a'),
				  'mv007' => $this->input->post('mv007')
                        );
			
         $this->db->where('mv001', $this->input->post('palq01a'));
          $this->db->update('palmv',$data);                   
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
	    $this->db->where('mv001', $seg1);
        $this->db->delete('palmv'); 
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
		     
			  $this->db->where('mv001', $seq1);
              $this->db->delete('palmv'); 
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