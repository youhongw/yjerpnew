<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moci09_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006, ma007, ma008, ma009, ma010, ma011, ma012, ma013, ma014,b.mb001,b.mb002 create_date');
        $this->db->from('mocma');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('ma001 desc, ma002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('mocma');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('ma001', 'mb002','mb003', 'ma004', 'ma005','ma014','create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('ma001,b.mb002,b.mb003, ma004, ma005, ma014, mocma.create_date')
	                      ->from('mocma')
						  ->join('`invmb` as b', 'ma001 = b.mb001','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('mocma');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('ma001', $this->uri->segment(4));
	    $this->db->where('ma001', $this->uri->segment(4));	
	    $query = $this->db->get('mocma');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->ma002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1)    
       { 
		 $this->db->select('a.* , b.mb002, b.mb003,c.mf002 as ma010disp, d.mb002 as ma003disp');	
		 $this->db->from('mocma as a');
		 $this->db->join('`invmb` as b', 'a.ma001=b.mb001' ,'left');
		 $this->db->join('`cmsmf` as c', 'a.ma010=c.mf001' ,'left');
		 $this->db->join('`cmsmb` as d', 'a.ma003=d.mb001' ,'left');
		 
	     //$this->db->set('mc001', $this->uri->segment(4)); 
	     $this->db->where('ma001', $this->uri->segment(4));
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `mocma` ";
	     $seq1 = " ma001, mb002, mb003, ma004, ma005, ma014, create_date FROM `mocma` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'ma001 desc' ;
         $seq9 = " ORDER BY ma001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="ma001 ";

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
		if(@$_SESSION['moci09_sql_term']){$seq32 = $_SESSION['moci09_sql_term'];}
		if(@$_SESSION['moci09_sql_sort']){$seq33 = $_SESSION['moci09_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ma001', 'mb002', 'mb003', 'ma004', 'ma005', 'ma014','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ma001, b.mb002, b.mb003, ma004, ma005, ma014, mocma.create_date')
	                       ->from('mocma')
						   ->join('`invmb` as b', 'ma001 = b.mb001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('mocma')
						   ->join('`invmb` as b', 'ma001 = b.mb001','left')
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
		echo $sort_by;
		echo $sort_order;
		echo $seq4;
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('ma001', 'mb002', 'mb003', 'ma004', 'ma005', 'ma014', 'create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
		echo $sort_by;
	    $this->db->select('ma001, ma004, ma005, ma014, b.mb002,b.mb003, mocma.create_date');
	    $this->db->from('mocma');
		$this->db->join('`invmb` as b', 'ma001 = b.mb001','left');
	    $this->db->like($sort_by, $seq4, 'after');
		echo $seq4;
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mc001 asc, mc002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('mocma');
		$this->db->join('`invmb` as b', 'ma001 = b.mb001','left');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->where('ma001', $this->input->post('invq02a')); 
	    $this->db->where('ma002', $this->input->post('ma002')); 
	    $this->db->where('ma003', $this->input->post('cmsq02a')); 
	    $this->db->where('ma004', $this->input->post('ma004')); 
	    $this->db->where('ma010', $this->input->post('ma010')); 
	    $this->db->where('ma012', $this->input->post('ma012')); 
	    $query = $this->db->get('mocma');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		  
		  /*$smc005 = $this->input->post('mc005');
          if ($smc005 != 'Y') {
          $smc005 = 'N';
           }
		  $smc006 = $this->input->post('mc006');
          if ($smc006 != 'Y') {
          $smc006 = 'N';
           }*/
		   
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'ma001' => $this->input->post('invq02a'),
		          'ma002' => $this->input->post('ma002'),
		          'ma003' => $this->input->post('cmsq02a'),
		          'ma004' => $this->input->post('ma004'),
		          'ma005' => $this->input->post('ma005'),
		          'ma006' => $this->input->post('ma006'),
                  'ma007' => $this->input->post('ma007'),
				  'ma008' => $this->input->post('ma008'),
				  'ma009' => $this->input->post('ma009'),
				  'ma010' => $this->input->post('ma010'),
				  'ma011' => $this->input->post('ma011'),
				  'ma012' => $this->input->post('ma012'),
				  'ma013' => $this->input->post('ma013'),
				  'ma014' => $this->input->post('ma014'),
                      );
         
	    $exist = $this->moci09_model->selone1($this->input->post('invq02a'),$this->input->post('ma002'),$this->input->post('cmsq02a'),$this->input->post('ma004'),$this->input->post('ma010'),$this->input->post('ma012'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
			
           return  $this->db->insert('mocma', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->where('ma001', $this->input->post('ma001c')); 
	    $this->db->where('ma002', $this->input->post('ma002c')); 
	    $this->db->where('ma003', $this->input->post('ma003c')); 
	    $this->db->where('ma004', $this->input->post('ma004c')); 
	    $this->db->where('ma010', $this->input->post('ma010c')); 
	    $this->db->where('ma012', $this->input->post('ma012c')); 
	    $query = $this->db->get('mocma');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $this->db->where('ma001', $this->input->post('ma001')); 
	    $this->db->where('ma002', $this->input->post('ma002')); 
	    $this->db->where('ma003', $this->input->post('ma003')); 
	    $this->db->where('ma004', $this->input->post('ma004')); 
	    $this->db->where('ma010', $this->input->post('ma010')); 
	    $this->db->where('ma012', $this->input->post('ma012')); 
	    $query = $this->db->get('mocma');
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
                $ma001=$row->ma001;
                $ma002=$row->ma002;
				$ma003=$row->ma003;
                $ma004=$row->ma004;
                $ma005=$row->ma005;
                $ma006=$row->ma006; 
                $ma007=$row->ma007;  						   
                $ma008=$row->ma008;  						   
                $ma009=$row->ma009;  						   
                $ma010=$row->ma010;  						   
                $ma011=$row->ma011;  						   
                $ma012=$row->ma012;  						   
                $ma013=$row->ma013;  						   
                $ma014=$row->ma014;  						   
	 	  endforeach;
	      } 
            $seq1=$this->input->post('ma001c');    //主鍵一筆
			$seq2=$this->input->post('ma002c');
			$seq3=$this->input->post('ma003c');
			$seq4=$this->input->post('ma004c');
			$seq5=$this->input->post('ma010c');
			$seq6=$this->input->post('ma012c');
	  
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'ma001' => $seq1,
		          'ma002' => $seq2,
		          'ma003' => $seq3,
		          'ma004' => $seq4,
		          'ma005' => $ma005,
		          'ma006' => $ma006, 
                  'ma007' => $ma007,				  
                  'ma008' => $ma008,				  
                  'ma009' => $ma009,				  
                  'ma010' => $seq5,				  
                  'ma011' => $ma011,				  
                  'ma012' => $seq6,				  
                  'ma013' => $ma013,				  
                  'ma014' => $ma014				  
                    );
            $exist = $this->moci09_model->selone2($this->input->post('ma001c'),$this->input->post('ma002c'),$this->input->post('ma003c'),$this->input->post('ma004c'),$this->input->post('ma010c'),$this->input->post('ma012c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('mocma', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('ma001');    //查詢一筆以上
	    $seq2=$this->input->post('ma001c'); 
	    $seq3=$this->input->post('ma004'); 
	    $seq4=$this->input->post('ma004c');
	    $sql = " SELECT a.ma001, b.mb002, b.mb003 ,a.ma004,a.ma005, a.ma006, a.ma007, a.ma008, a.ma009, a.ma010, a.ma011, a.ma012, a.ma013, a.ma014 
		FROM mocma as a
		LEFT JOIN invmb as b ON a.ma001=b.mb001
		WHERE ma001 >= '$seq1' AND ma001 <= '$seq2' AND ma004>= '$seq3' AND ma004 <= '$seq4'  ";
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('ma001');    //查詢一筆以上
	    $seq2=$this->input->post('ma001c'); 
	    $seq3=$this->input->post('ma004'); 
	    $seq4=$this->input->post('ma004c'); 
	    $sql = " SELECT a.ma001, b.mb002, b.mb003 ,a.ma004,a.ma005 
		FROM mocma as a
		LEFT JOIN invmb as b ON a.ma001=b.mb001
		WHERE ma001 >= '$seq1' AND ma001 <= '$seq2' AND ma004>= '$seq3' AND ma004 <= '$seq4'  "; 
		$query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "ma001 >= '$seq1' AND ma001 <= '$seq2' AND ma004>= '$seq3' AND ma004 <= '$seq4'";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('mocma')
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
				  'ma005' => $this->input->post('ma005'),
		          'ma006' => $this->input->post('ma006'),
		          'ma007' => $this->input->post('ma007'),
		          'ma008' => $this->input->post('ma008'),
		          'ma009' => $this->input->post('ma009'),
                  'ma011' => $this->input->post('ma011')		      
                        );
            $this->db->where('ma001', $this->input->post('ma001'));
	       
            $this->db->update('mocma',$data);                   //更改一筆
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
	    $this->db->where('mc001', $seg1);
        $this->db->delete('mocma'); 
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
			  var_dump($seq[$x]);
		      list($seq1) = explode("/", $seq[$x]);
		      $seq1;
		      //   $seq2;
			  $this->db->where('ma001', $seq1);
              $this->db->delete('mocma'); 
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