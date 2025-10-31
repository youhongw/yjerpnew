<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali36_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('tk001, tk002, tk003, tk004, tk005, tk006, create_date');
        $this->db->from('paltk');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('tk001 desc, tk002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('paltk');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tk001', 'tk002', 'tk003', 'tk004', 'tk005', 'tk006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tk001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.tk001,b.mv002 as tk001disp, a.tk002, c.me002 as tk002disp,a.tk003, a.tk004, a.tk005')
	                      ->from('paltk as a')
						  ->join('cmsmv as b', 'a.tk001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.tk002 = c.me001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->order_by('tk003', 'desc')
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('paltk');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('tk001', $this->uri->segment(4));
	    $this->db->where('tk001', $this->uri->segment(4));	
	    $query = $this->db->get('paltk');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->tk002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2)    
       { 
		 $this->db->select('a.*, b.mv002 as tk001disp, c.me002 as tk002disp');	
		 $this->db->from('paltk as a');
		 $this->db->join('cmsmv as b', 'a.tk001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.tk002 = c.me001 ','left');
		// $this->db->where('tk001', $this->uri->segment(4));
		 $this->db->where('a.tk001',$seq1); 
	     $this->db->where('a.tk003',$seq2); 
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `paltk` ";
	     $seq1 = " tk001, tk002, tk003, tk004, tk005, create_date FROM `paltk` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "a.`create_date` >='' ";
         $seq33 = 'tk001 desc' ;
         $seq9 = " ORDER BY tk001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "a.`create_date` >='' ";
         $seq7="tk001 ";

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
	     $sort_columns = array('tk001', 'tk002', 'tk003', 'tk004', 'tk005', 'tk008','tk014','tk011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tk001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tk001,b.mv002 as tk001disp, a.tk002, c.me002 as tk002disp,a.tk003, a.tk004, a.tk005, a.create_date')
	                       ->from('paltk as a')
						   ->join('cmsmv as b', 'a.tk001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.tk002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('paltk as a')
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
	    $sort_columns = array('tk001', 'tk002', 'tk003', 'tk004', 'tk005', 'tk006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tk001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.tk001,b.mv002 as tk001disp, a.tk002, c.me002 as tk002disp,a.tk003, a.tk004, a.tk005, a.create_date');
	       $this->db->from('paltk as a');
			$this->db->join('cmsmv as b', 'a.tk001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.tk002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('tk001 asc, tk002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('paltk');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('tk001', $this->input->post('palq01a')); 
	    $this->db->where('tk003', $seg2); 	    
	    $query = $this->db->get('paltk');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()   
       {
       	$tk003=substr($this->input->post('tk003'),0,4).substr($this->input->post('tk003'),5,2);
	    $data = array( 
		  'company' => $this->session->userdata('syscompany'),
		  'creator' => $this->session->userdata('manager'),
		  'usr_group' => 'A100',
		  'create_date' =>date("Ymd"),
		  'modifier' => '',
		  'modi_date' => '',
		  'flag' => 0,
		  'tk001' => $this->input->post('palq01a'),
		  'tk002' => $this->input->post('cmsq05a'),
		  'tk003' =>substr($this->input->post('tk003'),0,4).substr($this->input->post('tk003'),5,2),
		  'tk004' => $this->input->post('tk004'),
		  'tk005' => $this->input->post('tk005')
			  );
         
	    $exist = $this->pali36_model->selone1($this->input->post('palq01a'),$tk003);
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('paltk', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seg4)    
       { 	
		 $this->db->where('tk001',$seg2);
		 $this->db->where('tk003',$seg4);
	    $query = $this->db->get('paltk');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('tk001o');    
	    $seq2=$this->input->post('tk001c');
    	$seq3=substr($this->input->post('tk002o'),0,4).substr($this->input->post('tk002o'),5,2);    
	    $seq4=substr($this->input->post('tk002c'),0,4).substr($this->input->post('tk002c'),5,2);
	    $this->db->where('tk001', $seq1); 
	    $this->db->where('tk003', $seq3);
	    $query = $this->db->get('paltk');
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
		        $tk002=$row->tk002;
				$tk003=$row->tk003;
                $tk004=$row->tk004;
                $tk005=$row->tk005;
              
	 	  endforeach;
	      } 
         //   $seq2=$this->input->post('tk001c');    //主鍵一筆
	     //   $seq4=$this->input->post('tk002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'tk001' => $seq2,
		          'tk002' => $tk002,
		          'tk003' => $seq4,
		          'tk004' => $tk004,
		          'tk005' => $tk005
                 			  
                    );
            $exist = $this->pali36_model->selone2($seq2,$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('paltk', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('tk001o');    //查詢一筆以上
	    $seq2=$this->input->post('tk001c'); 
	    $seq3=substr($this->input->post('tk002o'),0,4).substr($this->input->post('tk002o'),5,2);    
	    $seq4=substr($this->input->post('tk002c'),0,4).substr($this->input->post('tk002c'),5,2);
		 
	    $sql1 = " SELECT a.tk001,b.mv002 as tk001disp,a.tk002,c.me002 as tk002disp,a.tk003, a.tk004,a.tk005 "; 
		$sql2 = " FROM paltk as a LEFT JOIN cmsmv as b ON  a.tk001=b.mv001 LEFT JOIN cmsme as c ON a.tk002=c.me001 "; 
		$sql3 = " WHERE a.tk001 >= '$seq1'  AND a.tk001 <= '$seq2' AND  a.tk003 >= '$seq3'  AND a.tk003 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
		$seq1=$this->input->post('tk001o');    //查詢一筆以上
	    $seq2=$this->input->post('tk001c'); 
		$seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2);    
	    $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2);
		$seq5=$this->input->post('mv206');
		if(!$seq4){$seq4 = $seq3;}
	    $sql1 = " SELECT a.*,b.mv002 as tk001disp,c.me002 as tk002disp "; 
		$sql2 = " FROM paltk as a LEFT JOIN cmsmv as b ON  a.tk001=b.mv001 LEFT JOIN cmsme as c ON a.tk002=c.me001 "; 
		$sql3 = " WHERE a.tk003 >= '$seq3' AND a.tk003 <= '$seq4' "; 
		
		if(@$seq1){
			$sql3.=" and a.tk001 >= '".$seq1."' ";
		}
		if(@$seq2){
			$sql3.=" and a.tk001 <= '".$seq2."' ";
		}
		if(@$seq5){
			$sql3.=" and ( b.mv206 = '".$seq5[0]."' ";
			foreach($seq5 as $key => $val){
				$sql3 .= " or b.mv206 = '".$val."'";
			}
			$sql3.=" ) ";
		}
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "tk001 >= '$seq1'  AND tk001 <= '$seq2' AND  tk003 >= '$seq3'  AND tk003 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('paltk')
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
	         
            //    if ($this->input->post('tk015')>'0') {$tk015=substr($this->input->post('tk015'),0,4).substr($this->input->post('tk015'),5,2).substr(rtrim($this->input->post('tk015')),8,2);}
            //  else {$tk015='';}  
            	$tk003=substr($this->input->post('tk003'),0,4).substr($this->input->post('tk003'),5,2);			
		   $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'tk002' => $this->input->post('cmsq05a'),
		          'tk004' => $this->input->post('tk004'),
                  'tk005' => $this->input->post('tk005')
                        );
			
            $this->db->where('tk001', $this->input->post('palq01a'));
	        $this->db->where('tk003', $tk003);
            $this->db->update('paltk',$data);                   //更改一筆
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
	    $this->db->where('tk001', $seg1);
        $this->db->delete('paltk'); 
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
			  $this->db->where('tk001', $seq1);
			  $this->db->where('tk003', $seq2);
              $this->db->delete('paltk'); 
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