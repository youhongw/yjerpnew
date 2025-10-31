<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pali31_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('ta001, ta002, ta003, ta004, ta005, ta006, create_date');
        $this->db->from('palta');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palta');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('ta001','b.mv002', 'ta002', 'ta003', 'ta004', 'ta005', 'ta006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.ta001,b.mv002 as ta001disp, a.ta002, c.me002 as ta002disp,a.ta003, a.ta011, a.ta012')
	                      ->from('palta as a')
						  ->join('cmsmv as b', 'a.ta001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.ta002 = c.me001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palta');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('ta001', $this->uri->segment(4));
	    $this->db->where('ta001', $this->uri->segment(4));	
	    $query = $this->db->get('palta');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->ta002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2)    
       { 
		 $this->db->select('a.*, b.mv002 as ta001disp, c.me002 as ta002disp');	
		 $this->db->from('palta as a');
		 $this->db->join('cmsmv as b', 'a.ta001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.ta002 = c.me001 ','left');
		// $this->db->where('ta001', $this->uri->segment(4));
		 $this->db->where('a.ta001',$seq1); 
	     $this->db->where('a.ta003',$seq2); 
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `palta` ";
	     $seq1 = " ta001, ta002, ta003, ta004, ta005, ta008,ta014,ta011, create_date FROM `palta` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "a.`create_date` >='' ";
         $seq33 = 'ta001 desc' ;
         $seq9 = " ORDER BY ta001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "a.`create_date` >='' ";
         $seq7="ta001 ";

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
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta005', 'ta008','ta014','ta011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.ta001,b.mv002 as ta001disp, a.ta002, c.me002 as ta002disp,a.ta003, a.ta011, a.ta012, a.create_date')
	                       ->from('palta as a')
						   ->join('cmsmv as b', 'a.ta001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.ta002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palta as a')
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
	    $sort_columns = array('ta001','b.mv002', 'ta002', 'ta003', 'ta004', 'ta005', 'ta006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.ta001,b.mv002 as ta001disp, a.ta002, c.me002 as ta002disp,a.ta003, a.ta011, a.ta012, a.create_date');
	       $this->db->from('palta as a');
			$this->db->join('cmsmv as b', 'a.ta001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.ta002 = c.me001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('ta001 asc, ta002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palta as a');
		$this->db->join('cmsmv as b', 'a.ta001 = b.mv001 ','left');
		$this->db->join('cmsme as c', 'a.ta002 = c.me001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('ta001', $this->input->post('palq01a')); 
	    $this->db->where('ta003', $seg2); 	    
	    $query = $this->db->get('palta');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()   
       {
       	$ta003=substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2);
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'ta001' => $this->input->post('palq01a'),
		          'ta002' => $this->input->post('cmsq05a'),
		          'ta003' =>substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2),
		          'ta004' => $this->input->post('ta004'),
                  'ta005' => $this->input->post('ta005'),
				  'ta006' => $this->input->post('ta006'),
				  'ta007' => $this->input->post('ta007'),
				  'ta008' => $this->input->post('ta008'),
				  'ta009' => $this->input->post('ta009'),
				  'ta010' => $this->input->post('ta010'),
				  'ta011' => $this->input->post('ta011'),
				  'ta012' => $this->input->post('ta012'),
				  'ta014' => $this->input->post('ta014'),
				  'ta015' => $this->input->post('ta015'),
				  'ta016' => $this->input->post('ta016'),
				  'ta017' => $this->input->post('ta017')
				   
                      );
         
	    $exist = $this->pali31_model->selone1($this->input->post('palq01a'),$ta003);
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('palta', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seg4)    
       { 	
		 $this->db->where('ta001',$seg2);
		 $this->db->where('ta003',$seg4);
	    $query = $this->db->get('palta');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('ta001o');    
	    $seq2=$this->input->post('ta001c');
    	$seq3=substr($this->input->post('ta002o'),0,4).substr($this->input->post('ta002o'),5,2);    
	    $seq4=substr($this->input->post('ta002c'),0,4).substr($this->input->post('ta002c'),5,2);
	    $this->db->where('ta001', $seq1); 
	    $this->db->where('ta003', $seq3);
	    $query = $this->db->get('palta');
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
		        $ta002=$row->ta002;
				$ta003=$row->ta003;
                $ta004=$row->ta004;
                $ta005=$row->ta005;
                $ta007=$row->ta007; 
                $ta008=$row->ta008; 
                $ta009=$row->ta009; 
                $ta010=$row->ta010; 
                $ta011=$row->ta011; 
                $ta012=$row->ta012;	
	 	  endforeach;
	      } 
         //   $seq2=$this->input->post('ta001c');    //主鍵一筆
	     //   $seq4=$this->input->post('ta002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'ta001' => $seq2,
		          'ta002' => $ta002,
		          'ta003' => $seq4,
		          'ta004' => $ta004,
		          'ta005' => $ta005,
                  'ta007' => $ta007,
                  'ta008' => $ta008,
                  'ta009' => $ta009,
                  'ta010' => $ta010,
                  'ta011' => $ta011,
                  'ta012' => $ta012,
                  'ta014' => $ta014,
                  'ta015' => $ta015,
                  'ta016' => $ta016,
                  'ta017' => $ta017
                 			  
                    );
            $exist = $this->pali31_model->selone2($seq2,$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palta', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
		$seq1=$this->input->post('ta001o');    //查詢一筆以上
	    $seq2=$this->input->post('ta001c'); 
		$seq3=$this->input->post('ta002o');
	    $seq4=$this->input->post('ta002c');
		preg_match_all('/\d/S',$seq3, $matches);
		$seq3 = implode('',$matches[0]);
		preg_match_all('/\d/S',$seq4, $matches);
		$seq4 = implode('',$matches[0]);
		 
	    $sql1 = " SELECT a.ta001,b.mv002,a.ta002,c.me002,a.ta003, a.ta004
		,a.ta005,a.ta006,a.ta007,a.ta008,a.ta009,a.ta010,a.ta011
		,a.ta014,a.ta015,a.ta016,a.ta017,b.mv032,a.ta012 "; 
		$sql2 = " FROM palta as a LEFT JOIN cmsmv as b ON  a.ta001=b.mv001 LEFT JOIN cmsme as c ON a.ta002=c.me001 "; 
		$sql3 = ""; 
		if($seq1||$seq2||$seq3||$seq4){
			$sql3 .= " WHERE ";
		}
		if($seq1){
			$sql3 .= " a.ta001 >= '$seq1' ";
		}
		if($seq2){
			if(strlen($sql3)>7){
				$sql3 .= " and ";
			}
			$sql3 .= " a.ta001 <= '$seq2' ";
		}
		if($seq3){
			if(strlen($sql3)>7){
				$sql3 .= " and ";
			}
			$sql3 .= " a.ta003 >= '$seq3' ";
		}
		if($seq4){
			if(strlen($sql3)>7){
				$sql3 .= " and ";
			}
			$sql3 .= " a.ta003 <= '$seq4' ";
		}
		
		$sql=$sql1.$sql2.$sql3;
		
		$sql .= " ORDER BY a.ta002 asc,a.ta001 asc ";
		
        $query = $this->db->query($sql);
		
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
		$seq1=$this->input->post('ta001o');    //查詢一筆以上
	    $seq2=$this->input->post('ta001c'); 
		$seq3=$this->input->post('ta002o');
	    $seq4=$this->input->post('ta002c');
		$seq5=$this->input->post('mv206');
		preg_match_all('/\d/S',$seq3, $matches);
		$seq3 = implode('',$matches[0]);
		preg_match_all('/\d/S',$seq4, $matches);
		$seq4 = implode('',$matches[0]);
		
	    $sql1 = " SELECT a.*,b.mv002 as ta001disp,c.me002 as ta002disp "; 
		$sql2 = " FROM palta as a LEFT JOIN cmsmv as b ON a.ta001=b.mv001 LEFT JOIN cmsme as c ON a.ta002=c.me001 "; 
		$sql3 = ""; 
		if($seq1||$seq2||$seq3||$seq4){
			$sql3 .= " WHERE ";
		}
		if($seq1){
			$sql3 .= " a.ta001 >= '$seq1' ";
		}
		if($seq2){
			if(strlen($sql3)>7){
				$sql3 .= " and ";
			}
			$sql3 .= " a.ta001 <= '$seq2' ";
		}
		if($seq3){
			if(strlen($sql3)>7){
				$sql3 .= " and ";
			}
			$sql3 .= " a.ta003 >= '$seq3' ";
		}
		if($seq4){
			if(strlen($sql3)>7){
				$sql3 .= " and ";
			}
			$sql3 .= " a.ta003 <= '$seq4' ";
		}
		
		if(@$seq5){
			$sql3.=" and ( b.mv206 = '".$seq5[0]."' ";
			foreach($seq5 as $key => $val){
				$sql3 .= " or b.mv206 = '".$val."'";
			}
			$sql3.=" ) ";
		}
		
		$sql=$sql1.$sql2.$sql3;
		
		$sql .= " ORDER BY a.ta002 asc,a.ta001 asc ";
		
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta003 >= '$seq3'  AND ta003 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palta')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	function printcol()
        {
	      $this->db->select('mk001, mk002, mk003');
          $this->db->from('palmk');
	      $this->db->order_by('mk004 ASC');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('palmk');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;
        }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	         
            //    if ($this->input->post('ta015')>'0') {$ta015=substr($this->input->post('ta015'),0,4).substr($this->input->post('ta015'),5,2).substr(rtrim($this->input->post('ta015')),8,2);}
            //  else {$ta015='';}  
			$ta003=substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2);			
			$data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'ta002' => $this->input->post('cmsq05a'),
		          'ta004' => $this->input->post('ta004'),
                  'ta005' => $this->input->post('ta005'),
				  'ta006' => $this->input->post('ta006'),
				  'ta007' => $this->input->post('ta007'),
				  'ta008' => $this->input->post('ta008'),
				  'ta009' => $this->input->post('ta009'),
				  'ta010' => $this->input->post('ta010'),
				  'ta011' => $this->input->post('ta011'),
				  'ta012' => $this->input->post('ta012'),
				  'ta014' => $this->input->post('ta014'),
				  'ta015' => $this->input->post('ta015'),
				  'ta016' => $this->input->post('ta016'),
				  'ta017' => $this->input->post('ta017')
			);
			
            $this->db->where('ta001', $this->input->post('palq01a'));
	        $this->db->where('ta003', $ta003);
            $this->db->update('palta',$data);                   //更改一筆
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
	    $this->db->where('ta001', $seg1);
        $this->db->delete('palta'); 
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
			  $this->db->where('ta001', $seq1);
			  $this->db->where('ta003', $seq2);
              $this->db->delete('palta'); 
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