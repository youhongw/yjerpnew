<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class posr01_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('md001, md002, md003, md004, md005, md006, create_date');
        $this->db->from('posmd');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('md001 desc, md002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('posmd');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order, $date)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tb001', 'tb002', 'tb003', 'tb004', 'tb005', 'tb006','tb007','tb008','tb009','tb010','tb011',
		'tb012', 'tb013', 'tb014', 'tb015', 'tb016');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tb002';  //檢查排序欄位是否在 tbble 內
	    $query = $this->db->select('tb001, tb002, tb003, tb004, tb005, tb006, tb007, tb008, tb009, tb010, tb011, tb012, tb013, tb014, tb015, tb016')
	                      ->from('postb')
						  ->where("substring(`tb002`,1,8) = '".$date."'")
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		$totle = 0;//小計統計
		foreach($ret['rows'] as $key=>$val){
			$totle += $val->tb016;
		}
		$ret['totle'] = $totle;
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('postb')
						  ->where("substring(`tb002`,1,8) = '".$date."'");
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)
       { 	              
	    $this->db->set('md001', $this->uri->segment(4));
	    $this->db->where('md001', $this->uri->segment(4));	
	    $query = $this->db->get('posmd');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->md002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('a.*, b.*');	
		 $this->db->from('postb as a');
	     //$this->db->set('md001', $this->uri->segment(4)); 
	   //  $this->db->where('md001 ', $this->uri->segment(4));
		 $this->db->join('posta as b', 'b.ta001 = a.tb001 and b.ta002 = a.tb002','left');
		  $this->db->where('tb001 ', $this->uri->segment(4));
		  $this->db->where('tb002 ', $this->uri->segment(5));
		  $this->db->where('tb003 ', $this->uri->segment(6));
		 $query = $this->db->get();
			
	     if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   //echo "<pre>";var_dump($result);exit;
		   return $result;
		 }
	   }
	   
	//查詢進階查詢 	
	function findf($limit, $offset, $sort_by, $sort_order)     
       {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `posmd` ";
	     $seq1 = " md001, md002, md003, md004, md005, md006,md007, create_date FROM `posmd` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'md001 desc' ;
         $seq9 = " ORDER BY md001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="md001 ";

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
		if(@$_SESSION['posr01_sql_term']){$seq32 = $_SESSION['posr01_sql_term'];}
		if(@$_SESSION['posr01_sql_sort']){$seq33 = $_SESSION['posr01_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('md001, md002, md003, md004, md005, md006, create_date')
	                       ->from('posmd')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('posmd')
		                  ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
       }
	   
	//篩選多筆    
	function filterf1($limit, $offset , $sort_by  , $sort_order , $date)    //篩選多筆        
	   {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
        $sort_by = $this->uri->segment(4);			
        $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tb001', 'tb002', 'tb003', 'tb004', 'tb005', 'tb006','tb007','tb008','tb009','tb010','tb011',
		'tb012', 'tb013', 'tb014', 'tb015', 'tb016');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tb002';  //檢查排序欄位是否為 table
	    $this->db->select('tb001, tb002, tb003, tb004, tb005, tb006, tb007, tb008, tb009, tb010, tb011, tb012, tb013, tb014, tb015, tb016');
	    $this->db->from('postb');
	    $this->db->like($sort_by, $seq4, 'after');
		$this->db->where("substring(`tb002`,1,8) = '".$date."'");
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('md001 asc, md002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
		$totle = 0;
		foreach($ret['rows'] as $key=>$val){  //小計總和
			$totle += $val->tb016;
		}
		$ret['totle'] = $totle;
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('postb');
	    $this->db->like($sort_by, $seq4, 'after');	
		$this->db->where("substring(`tb002`,1,8) = '".$date."'");
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;		
		$ret['sch_col'] = $sort_by;
		$ret['sch_val'] = $seq4;
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	  //  $this->db->set('md001', $this->input->post('md001')); 
	    $this->db->where('md001', $this->input->post('md001')); 
		  $this->db->where('md002', $this->input->post('md002')); 
	    $query = $this->db->get('posmd');
	    return $query->num_rows() ;
	   }  
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    
	    $this->db->where('md001', $this->input->post('md002c')); 
		 $this->db->where('md002', $this->input->post('md004c')); 
	    $query = $this->db->get('posmd');
	    return $query->num_rows() ; 
	   }
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('md001c');    //查詢一筆以上
	    $seq2=$this->input->post('md002c');
	    $sql = " SELECT md001,md002,md003,md004,md005,md006,create_date FROM posmd WHERE md002 >= '$seq1'  AND md002 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('md001c');    //查詢一筆以上
	    $seq2=$this->input->post('md002c'); 
	    $sql = " SELECT * FROM posmd WHERE md002 >= '$seq1'  AND md002 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "md002 >= '$seq1'  AND md002 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('posmd')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	  //ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1,$seg2)    
        { 	              
	      $this->db->select_max('md002');
		 
	      $this->db->where('md001', $this->uri->segment(5));
		  $query = $this->db->get('posmd');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->md002;
              }
		      return $result;   
		     }
	      }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>