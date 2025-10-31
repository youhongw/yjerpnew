<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali33_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006, create_date');
        $this->db->from('paltc');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('tc001 desc, tc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('paltc');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006','tc008','tc023','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.tc001,b.mv002 as tc001disp, a.tc002, c.me002 as tc002disp,a.tc003, a.tc008, a.tc023')
	                      ->from('paltc as a')
						  ->join('cmsmv as b', 'a.tc001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.tc002 = c.me001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('paltc');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('tc001', $this->uri->segment(4));
	    $this->db->where('tc001', $this->uri->segment(4));	
	    $query = $this->db->get('paltc');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->tc002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2)    
       { 
		 $this->db->select('a.*, b.mv002 as tc001disp, c.me002 as tc002disp');	
		 $this->db->from('paltc as a');
		 $this->db->join('cmsmv as b', 'a.tc001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.tc002 = c.me001 ','left');
		// $this->db->where('tc001', $this->uri->segment(4));
		 $this->db->where('a.tc001',$seq1); 
	     $this->db->where('a.tc003',$seq2); 
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `paltc` ";
	     $seq1 = " tc001, tc002, tc003, tc004, tc005, tc008,tc014,tc011, create_date FROM `paltc` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "a.`create_date` >='' ";
         $seq33 = 'tc001 desc' ;
         $seq9 = " ORDER BY tc001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "a.`create_date` >='' ";
         $seq7="tc001 ";

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
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc008','tc014','tc011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tc001,b.mv002 as tc001disp, a.tc002, c.me002 as tc002disp,a.tc003, a.tc008, a.tc023, a.create_date')
	                       ->from('paltc as a')
						   ->join('cmsmv as b', 'a.tc001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.tc002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('paltc as a')
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
	    $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.tc001,b.mv002 as tc001disp, a.tc002, c.me002 as tc002disp,a.tc003, a.tc008, a.tc023, a.create_date');
	       $this->db->from('paltc as a');
			$this->db->join('cmsmv as b', 'a.tc001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.tc002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('tc001 asc, tc002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('paltc');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('tc001', $this->input->post('palq01a')); 
	    $this->db->where('tc003', $seg2); 	    
	    $query = $this->db->get('paltc');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()   
       {
       	$tc003=substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2);
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'tc001' => $this->input->post('palq01a'),
		          'tc002' => $this->input->post('cmsq05a'),
		          'tc003' =>substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2),
		          'tc004' => $this->input->post('tc004'),
                  'tc005' => $this->input->post('tc005'),
				  'tc006' => $this->input->post('tc006'),
				  'tc007' => $this->input->post('tc007'),
				  'tc008' => $this->input->post('tc008'),
				  'tc009' => $this->input->post('tc009'),
				  'tc010' => $this->input->post('tc010'),
				  'tc011' => $this->input->post('tc011'),
				  'tc012' => $this->input->post('tc012'),
				  'tc013' => $this->input->post('tc013'),
				  'tc014' => $this->input->post('tc014'),
				  'tc015' => $this->input->post('tc015'),
				  'tc016' => $this->input->post('tc016'),
				  'tc017' => $this->input->post('tc017'),
				  'tc018' => $this->input->post('tc018'),
				  'tc019' => $this->input->post('tc019'),
				  'tc020' => $this->input->post('tc020'),
				  'tc021' => $this->input->post('tc021'),
				  'tc022' => $this->input->post('tc022'),
				  'tc023' => $this->input->post('tc023'),
				  'tc201' => $this->input->post('tc201'),
				  'tc202' => $this->input->post('tc202')
				   
                      );
         
	    $exist = $this->pali33_model->selone1($this->input->post('palq01a'),$tc003);
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('paltc', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seg4)    
       { 	
		 $this->db->where('tc001',$seg2);
		 $this->db->where('tc003',$seg4);
	    $query = $this->db->get('paltc');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('tc001o');    
	    $seq2=$this->input->post('tc001c');
    	$seq3=substr($this->input->post('tc002o'),0,4).substr($this->input->post('tc002o'),5,2);    
	    $seq4=substr($this->input->post('tc002c'),0,4).substr($this->input->post('tc002c'),5,2);
	    $this->db->where('tc001', $seq1); 
	    $this->db->where('tc003', $seq3);
	    $query = $this->db->get('paltc');
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
		        $tc002=$row->tc002;
				$tc003=$row->tc003;
                $tc004=$row->tc004;
                $tc005=$row->tc005;
                $tc007=$row->tc007; 
                $tc008=$row->tc008; 
                $tc009=$row->tc009; 
                $tc010=$row->tc010; 
                $tc011=$row->tc011; 
                $tc012=$row->tc012;	
			    $tc013=$row->tc013; 
                $tc014=$row->tc014; 
                $tc015=$row->tc015;	
				$tc016=$row->tc016; 
                $tc017=$row->tc017; 
                $tc018=$row->tc018;	
				$tc019=$row->tc019; 
                $tc020=$row->tc020; 
                $tc021=$row->tc021;
                $tc022=$row->tc022;
                $tc023=$row->tc023;				
	 	  endforeach;
	      } 
         //   $seq2=$this->input->post('tc001c');    //主鍵一筆
	     //   $seq4=$this->input->post('tc002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'tc001' => $seq2,
		          'tc002' => $tc002,
		          'tc003' => $seq4,
		          'tc004' => $tc004,
		          'tc005' => $tc005,
                  'tc007' => $tc007,
                  'tc008' => $tc008,
                  'tc009' => $tc009,
                  'tc010' => $tc010,
                  'tc011' => $tc011,
				  'tc012' => $tc012,
                  'tc013' => $tc013,
				  'tc014' => $tc014,
                  'tc015' => $tc015,
				  'tc016' => $tc016,
                  'tc017' => $tc017,
				  'tc018' => $tc018,
                  'tc019' => $tc019,
				  'tc020' => $tc020,
                  'tc021' => $tc021,
				  'tc022' => $tc022,
                  'tc023' => $tc023
                 			  
                    );
            $exist = $this->pali33_model->selone2($seq2,$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('paltc', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
		$seq1=$this->input->post('tc001o');    //查詢一筆以上
	    $seq2=$this->input->post('tc001c'); 
	    $seq3=substr($this->input->post('tc002o'),0,4).substr($this->input->post('tc002o'),5,2);    
	    $seq4=substr($this->input->post('tc002c'),0,4).substr($this->input->post('tc002c'),5,2);
		 
	    $sql1 = " SELECT a.tc001,b.mv002 as tc001disp,a.tc002,c.me002 as tc002disp,a.tc003, a.tc004,a.tc005,a.tc006,a.tc007,a.tc008,a.tc009,a.tc010,a.tc011,a.tc012
		              ,a.tc013,a.tc014,a.tc015,a.tc016,a.tc017,a.tc018,a.tc019,a.tc020,a.tc021,a.tc022,a.tc023 "; 
		$sql2 = " FROM paltc as a LEFT JOIN cmsmv as b ON  a.tc001=b.mv001 LEFT JOIN cmsme as c ON a.tc002=c.me001 "; 
		$sql3 = "";
		$sql4 = "";
		if($seq1 || $seq2 || $seq3 || $seq4){
			$sql3 = " WHERE ";
		}
		if($seq1){if($sql4){$sql4 .= " and ";}$sql4 .= " a.tc001 >= '$seq1' ";}
		if($seq2){if($sql4){$sql4 .= " and ";}$sql4 .= " a.tc001 <= '$seq2' ";}
		if($seq3){if($sql4){$sql4 .= " and ";}$sql4 .= " a.tc003 >= '$seq3' ";}
		if($seq4){if($sql4){$sql4 .= " and ";}$sql4 .= " a.tc003 <= '$seq4' ";}
		
		$sql=$sql1.$sql2.$sql3.$sql4;
		
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('tc001o');    //查詢一筆以上
	    $seq2=$this->input->post('tc001c'); 
	   $seq3=substr($this->input->post('tc002o'),0,4).substr($this->input->post('tc002o'),5,2);    
	    $seq4=substr($this->input->post('tc002c'),0,4).substr($this->input->post('tc002c'),5,2);
		$seq5=$this->input->post('mv202');
		
		if(!$seq4){$seq4=$seq3;}
	    $sql1 = " SELECT distinct a.*,a.tc019+a.tc020 as sum_tc019,a.tc021+a.tc022 as sum_tc021
		,b.mv002 as tc001disp,c.me002 as tc002disp,b.mv203,d.*,f.td038,f.td056
		,d.ta004+d.ta006+d.ta007 as sum_ta006,e.ta004+e.ta006+e.ta007 as sum_ta0061,d.ta009,d.ta015,e.ta009 as ta0091,d.ta005+d.ta008+d.ta010 as sum_ta010,
		e.ta005 as ta005b,e.ta008 as ta008b,e.ta010 as ta010b";
		$sql2 = " FROM paltc as a 
		LEFT JOIN cmsmv as b ON a.tc001=b.mv001 
		LEFT JOIN cmsme as c ON a.tc002=c.me001 
		LEFT JOIN palta as d ON a.tc001=d.ta001 and a.tc003=d.ta003 
		LEFT JOIN palta1 as e ON a.tc001=e.ta001 
		LEFT JOIN paltd as f ON a.tc001=f.td001 ";
		$sql3 = " WHERE a.tc003 >= '$seq3' AND a.tc003 <= '$seq4' AND f.td005='$seq3' "; 
        $seq32 = "tc001 >= '$seq1' AND tc001 <= '$seq2' AND tc003 >= '$seq3' AND tc003 <= '$seq4'  ";
		if($seq1){
			$sql3 .= " and tc001 >= '$seq1'";
			$seq32 .= " and tc001 >= '$seq1'";
		}
		if($seq2){
			$sql3 .= " and tc001 <= '$seq2'";
			$seq32 .= " and tc001 <= '$seq2'";
		}
		if(@$seq5){
			$sql3.=" and ( b.mv202 = '".$seq5[0]."' ";
			foreach($seq5 as $key => $val){
				$sql3 .= " or b.mv202 = '".$val."'";
			}
			$sql3.=" ) ";
		}
		$sql3 .= " order by mv004 asc,mv001 asc";
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		if($seq1){
			$seq32 .= " and tc001 >= '$seq1'";
		}
		if($seq2){
			$seq32 .= " and tc001 <= '$seq2'";
		}
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('paltc')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		
	    return $ret;
       }
	//列出類別
	function printcol()
        {
	      $this->db->select('mm001, mm002, mm003');
          $this->db->from('palmm');
	      $this->db->order_by('mm001 ASC, mm002 ASC');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('palmm');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;
        }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	         
            //    if ($this->input->post('tc015')>'0') {$tc015=substr($this->input->post('tc015'),0,4).substr($this->input->post('tc015'),5,2).substr(rtrim($this->input->post('tc015')),8,2);}
            //  else {$tc015='';}  
            	$tc003=substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2);			
		   $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'tc002' => $this->input->post('cmsq05a'),
		          'tc004' => $this->input->post('tc004'),
                  'tc005' => $this->input->post('tc005'),
				  'tc006' => $this->input->post('tc006'),
				  'tc007' => $this->input->post('tc007'),
				  'tc008' => $this->input->post('tc008'),
				  'tc009' => $this->input->post('tc009'),
				  'tc010' => $this->input->post('tc010'),
				  'tc011' => $this->input->post('tc011'),
				  'tc012' => $this->input->post('tc012'),
				  'tc013' => $this->input->post('tc013'),
				  'tc014' => $this->input->post('tc014'),
				  'tc015' => $this->input->post('tc015'),
				  'tc016' => $this->input->post('tc016'),
				  'tc017' => $this->input->post('tc017'),
				  'tc018' => $this->input->post('tc018'),
				  'tc019' => $this->input->post('tc019'),
				  'tc020' => $this->input->post('tc020'),
				  'tc021' => $this->input->post('tc021'),
				  'tc022' => $this->input->post('tc022'),
				  'tc023' => $this->input->post('tc023'),
				   'tc201' => $this->input->post('tc201'),
				  'tc202' => $this->input->post('tc202')
                        );
			
            $this->db->where('tc001', $this->input->post('palq01a'));
	        $this->db->where('tc003', $tc003);
            $this->db->update('paltc',$data);                   //更改一筆
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
	    $this->db->where('tc001', $seg1);
        $this->db->delete('paltc'); 
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
			  $this->db->where('tc001', $seq1);
			  $this->db->where('tc003', $seq2);
              $this->db->delete('paltc'); 
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