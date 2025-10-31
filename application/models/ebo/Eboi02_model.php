<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eboi02_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mi001, mi002, mi003, mi004, mi005, mi006, create_date');
        $this->db->from('ebomi');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mi001 desc, mi002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('ebomi');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mi001', 'mi002', 'mi003', 'mi004', 'mi005', 'mi006','mi006','a.create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mi001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.*,b.mb002 as mb001disp,b.mb003 as mb001disp1,b.mb004 as mb001disp2')
	                      ->from('ebomi as a')
						  ->join('invmb as b', 'a.mi001 = b.mb001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('ebomi as a')
						  ->join('invmb as b', 'a.mi001 = b.mb001 ','left');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mi001', $this->uri->segment(4));
	    $this->db->where('mi001', $this->uri->segment(4));	
	    $query = $this->db->get('ebomi');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->mi002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2,$seq3)    
       { 
		 $this->db->select('a.*,,b.mb002 as mi001disp,b.mb003 as mi001disp1,b.mb004 as mi001disp2,c.ma003 as mi005disp,d.me003 as mi007disp');	
		 $this->db->from('ebomi as a');
	     
		 $this->db->join('invmb as b', 'a.mi001 = b.mb001 ','left');
		 $this->db->join('invma as c', 'a.mi005 = c.ma002 and c.ma001="1" ','left');
		 $this->db->join('bomme as d', 'a.mi007 = d.me001 ','left');
		 //$this->db->where('mi001', $this->uri->segment(4));
		 $this->db->where('a.mi001',$seq1); 
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `ebomi` ";
	     $seq1 = " a.mi001, a.mi002, a.mi003, a.mi004, a.mi005, a.mi008,a.mi014,a.mi011, a.create_date FROM `ebomi` as a ";
         $seq2 = "WHERE `a.create_date` >=' ' ";
	     $seq32 = "`a.create_date` >='' ";
         $seq33 = 'a.mi001 desc' ;
         $seq9 = " ORDER BY a.mi001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`a.create_date` >='' ";
         $seq7="a.mi001 ";

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
	   //  $sort_columns = array('mi001', 'mi002', 'mi003', 'mi004', 'mi005', 'mi008','mi014','mi011','create_date');
		  $sort_columns = array('a.mi001', 'a.mi002','b.mi002', 'b.mi003', 'a.mi004', 'c.ma002', 'a,mi011','a.mi014','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.mi001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*,b.mb002,b.mb002 as mb001disp,b.mb003,b.mb003 as mb001disp1,b.mb004 as mb001disp2,c.ma002,c.ma002 as ma002disp, a.create_date')
	                       ->from('ebomi as a')
						   ->join('invmb as b', 'a.mi001 = b.mb001 ','left')
						   ->join('purma as c', 'a.mi002 = c.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('ebomi as a')
						   ->join('invmb as b', 'a.mi001 = b.mb001 ','left')
						   ->join('purma as c', 'a.mi002 = c.ma001 ','left')
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
	    $sort_columns = array('a.mi001', 'a.mi002','b.mi002', 'b.mi003', 'a.mi004', 'c.ma002', 'a.mi011','a.mi014','a.create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'a.mi001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.mi001,b.mi002 ,b.mi003 ,b.mi002 as mi001disp,b.mi003 as mi001disp1,  a.mi002, c.ma002, c.ma002 as mi002disp,a.mi003, a.mi011, a.mi014, a.create_date');
	       $this->db->from('ebomi as a');
			$this->db->join('invmb as b', 'a.mi001 = b.mi001 ','left');
			$this->db->join('purma as c', 'a.mi002 = c.ma001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mi001 asc, mi002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('ebomi as a');
		$this->db->join('invmb as b', 'a.mi001 = b.mi001 ','left');
		$this->db->join('purma as c', 'a.mi002 = c.ma001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	  //  $this->db->set('mi001', $this->input->post('mi001')); 
	    $this->db->where('mi001', $this->input->post('invq02a')); 
	    $query = $this->db->get('ebomi');
	    return $query->num_rows() ;
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
                  'mi001' => $this->input->post('invq02a'),
		          'mi002' => $this->input->post('mi002'),
		          'mi003' => $this->input->post('mi003'),
		          'mi004' => $this->input->post('mi004'),
		          'mi005' => $this->input->post('invi01a'),
                  'mi006' => $this->input->post('mi006'),				  
                  'mi007' => $this->input->post('bomi07'),
				  'mi008' => $this->input->post('mi008'),
				  'mi009' => $this->input->post('mi009'),
				  'mi010' => $this->input->post('mi010'),
				  'mi011' => $this->input->post('mi011'),
				  'mi012' => $this->input->post('mi012')
				   
                      );
         
	    $exist = $this->eboi02_model->selone1($this->input->post('invq02a'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('ebomi', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seq4)    
       { 	
	 //   $this->db->set('mi001', $this->input->post('mi002c')); 
	 //   $this->db->where('mi001', $this->input->post('mi002c')); 
		 $this->db->where('mi001',$this->input->post('mi001c'));
        $this->db->where('mi002',$this->input->post('mi002c'));	
	    $query = $this->db->get('ebomi');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mi001o');    
	    $seq2=$this->input->post('mi001c');
    	$seq3=$this->input->post('mi002o');    
	    $seq4=$this->input->post('mi002c');
	    $this->db->where('mi001', $this->input->post('mi001o')); 
	    $this->db->where('mi002', $this->input->post('mi002o')); 
	    $query = $this->db->get('ebomi');
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
				$mi003=$row->mi003;
                $mi004=$row->mi004;
                $mi005=$row->mi005;
                $mi007=$row->mi007; 
                $mi008=$row->mi008; 
                $mi009=$row->mi009; 
                $mi010=$row->mi010; 
                $mi011=$row->mi011; 
                $mi012=$row->mi012; 
                $mi013=$row->mi013; 
                $mi014=$row->mi014; 
                $mi015=$row->mi015; 
                $mi016=$row->mi016; 				
	 	  endforeach;
	      } 
            $seq2=$this->input->post('mi001c');    //主鍵一筆
	        $seq4=$this->input->post('mi002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'mi001' => $seq2,
		          'mi002' => $seq4,
		          'mi003' => $mi003,
		          'mi004' => $mi004,
		          'mi005' => $mi005,
                  'mi007' => $mi007,
                  'mi008' => $mi008,
                  'mi009' => $mi009,
                  'mi010' => $mi010,
                  'mi011' => $mi011,
                  'mi012' => $mi012,
                  'mi013' => $mi013,
                  'mi014' => $mi014,
                  'mi015' => $mi015,
                  'mi016' => $mi016
                 			  
                    );
            $exist = $this->eboi02_model->selone2($this->input->post('mi001c'),$this->input->post('mi002c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('ebomi', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('mi001o');    //查詢一筆以上
	    $seq2=$this->input->post('mi001c'); 
	    $seq3=$this->input->post('mi002o');    
	    $seq4=$this->input->post('mi002c'); 
		 
	    $sql1 = " SELECT a.mi001,b.mi002 as mi001disp,b.mi003 as mi001disp1, a.mi004, a.mi002, c.ma002 as mi002disp,a.mi011,a.mi003, a.mi014, a.create_date "; 
		$sql2 = " FROM ebomi as a LEFT JOIN invmb as b ON  a.mi001=b.mi001 LEFT JOIN purma as c ON a.mi002=c.ma001 "; 
		$sql3 = " WHERE a.mi001 >= '$seq1'  AND a.mi001 <= '$seq2' AND  a.mi002 >= '$seq3'  AND a.mi002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('mi001o');    //查詢一筆以上
	    $seq2=$this->input->post('mi001c'); 
	    $seq3=$this->input->post('mi002o');    
	    $seq4=$this->input->post('mi002c'); 
		 
	    $sql1 = " SELECT a.mi008,a.mi001,a.mi004,b.mi002 as mi001disp,b.mi003 as mi001disp1,  a.mi002, c.ma002 as mi002disp,a.mi003, a.mi011, a.mi014, a.create_date "; 
		$sql2 = " FROM ebomi as a LEFT JOIN invmb as b ON  a.mi001=b.mi001 LEFT JOIN purma as c ON a.mi002=c.ma001 "; 
		$sql3 = " WHERE a.mi001 >= '$seq1'  AND a.mi001 <= '$seq2' AND  a.mi002 >= '$seq3'  AND a.mi002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mi001 >= '$seq1'  AND mi001 <= '$seq2' AND  mi002 >= '$seq3'  AND mi002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('ebomi')
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
				  'mi002' => $this->input->post('mi002'),
		          'mi003' => $this->input->post('mi003'),
		          'mi004' => $this->input->post('mi004'),
		          'mi005' => $this->input->post('invi01a'),
                  'mi006' => $this->input->post('mi006'),				  
                  'mi007' => $this->input->post('bomi07'),
				  'mi008' => $this->input->post('mi008'),
				  'mi009' => $this->input->post('mi009'),
				  'mi010' => $this->input->post('mi010'),
				  'mi011' => $this->input->post('mi011'),
				  'mi012' => $this->input->post('mi012')
                        );
			
            $this->db->where('mi001', $this->input->post('invq02a'));
            $this->db->update('ebomi',$data);                   //更改一筆
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
	    $this->db->where('mi001', $seg1);
        $this->db->delete('ebomi'); 
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
			  $this->db->where('mi001', $seq1);
			  $this->db->where('mi002', $seq2);
              $this->db->delete('ebomi'); 
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