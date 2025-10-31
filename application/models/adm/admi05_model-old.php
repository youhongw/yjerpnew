<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admi05_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
	function selbrowse($num,$offset)   //查詢 table 表所有資料
          {            
	    $this->db->select('mg001, mg002, mg003, mg004, mg005,mg006,mg007,mg008, create_date');
            $this->db->from('admmg');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mg001 desc, mg002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('admmg');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
          }
	
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mg001', 'mg002', 'mg003','mg004','mg005','mg006','mg007','mg008', 'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mg001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008,  create_date')
	                      ->from('admmg')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('admmg');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   function seloneajax5($seg1)    //ajax 查詢一筆 顯示用 使用者代號看有無重複
          { 	              
	    $this->db->set('mg001', $this->uri->segment(4));
	    $this->db->where('mg001', $this->uri->segment(4));	
	    $query = $this->db->get('admmg');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->mg001;
            }
		   return $result;   
		 }
	  }
	    function ajaxadmq04a($seg1)    //ajax 查詢一筆 顯示用 群組代號
          { 	              
	    $this->db->set('mg001', $this->uri->segment(4));
	    $this->db->where('mg001', $this->uri->segment(4));	
	    $query = $this->db->get('admme');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->mg002;
            }
		   return $result;   
		 }
	  }
	   function ajaxcmsq05a($seg1)    //ajax 查詢一筆 顯示用 請購部門
        { 	              
	      
	      $this->db->where('mg001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsme');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mg002;
              }
		   return $result;   
		  }
	    }
	function selone()    //查詢一筆 修改用
          { 
		 $this->db->select('a.*,b.mf002 as mg001disp,c.mb002 as mg002disp');	
		 $this->db->from('admmg as a');	
		 $this->db->join('admmf as b', 'a.mg001 = b.mf001 ','left');
         $this->db->join('admmb as c', 'a.mg002 = c.mb001 ','left');
	     $this->db->where('mg001', $this->uri->segment(4)); 
	     $this->db->where('mg002', $this->uri->segment(5));
		 $query = $this->db->get();
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	  }
		
	function findf($limit, $offset, $sort_by, $sort_order)    //查詢多筆進階查詢 mysql 
          {            		
	  //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `admmg` ";
	    $seq1 = " mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008,  create_date FROM `admmg` ";
            $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
            $seq33 = 'mg001 desc' ;
            $seq9 = " ORDER BY mg001 " ;
	    $seq91=" limit ";
	    $seq92=", ";
	    $seq5=$this->session->userdata('find05');
	    $seq7=$this->session->userdata('find07');

            if (trim($this->input->post('find005'))!='')
		  {
		    $this->session->set_userdata('find05',$this->input->post('find005'));
		    $seq5=$this->session->userdata('find05');
		    $seq2="WHERE ".$seq5;
		    $seq32=$seq5;
		  }
	    if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
			  
	    if (trim($this->input->post('find007'))!='') 
	          {
		    $this->session->set_userdata('find07',$this->input->post('find007'));
		    $seq7=$this->session->userdata('find07');			   
		    $seq9=" ORDER BY ".$seq7;
		    $seq33=$seq7;
		  }
             if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		
             $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mg001', 'mg002', 'mg003','mg004','mg005','mg006','mg007','mg008','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008,  create_date')
	                       ->from('admmg')
		               ->where($seq32)
			       ->order_by($seq33)
			     //->order_by($sort_by, $sort_order)
			       ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('admmg')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
          }
	    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mg001', 'mg002', 'mg003','mg004','mg005','mg006','mg007','mg008', 'create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mg001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008, create_date');
	    $this->db->from('admmg');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mg001 asc, mg002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('admmg');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
	  
	function selone1($seq1,$seq2)    //新增  查詢資料是否重複
        {
	  //  $this->db->set('mg001', $this->input->post('mg001')); 
	    $this->db->where('mg001', $this->input->post('mg001')); 
		 $this->db->where('mg002', $this->input->post('mg002')); 
	    $query = $this->db->get('admmg');
	    return $query->num_rows() ;
	    }  	 
		
	function insertf()    //新增一筆
        {
		$mg6=$this->input->post('mg611').$this->input->post('mg612').$this->input->post('mg613').$this->input->post('mg614').$this->input->post('mg615').$this->input->post('mg616').
	       $this->input->post('mg617').$this->input->post('mg618').$this->input->post('mg619').$this->input->post('mg620').$this->input->post('mg621').$this->input->post('mg622');
		$mg7=$this->input->post('mg711').$this->input->post('mg712').$this->input->post('mg713').$this->input->post('mg714').$this->input->post('mg715').$this->input->post('mg716').
	       $this->input->post('mg717').$this->input->post('mg718').$this->input->post('mg719').$this->input->post('mg720').$this->input->post('mg721').$this->input->post('mg722');
        $mg8=$this->input->post('mg811').$this->input->post('mg812').$this->input->post('mg813').$this->input->post('mg814').$this->input->post('mg815').$this->input->post('mg816').
	       $this->input->post('mg817').$this->input->post('mg818').$this->input->post('mg819').$this->input->post('mg820').$this->input->post('mg821').$this->input->post('mg822');
		   
		$data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		              'usr_group' => 'A100',
		              'create_date' =>date("Ymd"),
		              'modifier' => '',
		              'modi_date' => '',
		              'flag' => 0,
                      'mg001' => $this->input->post('mg001'),
		              'mg002' => $this->input->post('mg002'),
		              'mg003' => $this->input->post('mg003'),
					  'mg004' => $this->input->post('mg004'),
					  'mg005' => $this->input->post('mg005'),
					  'mg006' => $mg6,
					  'mg007' => $mg7,
					  'mg008' => $mg8,
                     );
         
	    $exist = $this->admi05_model->selone1($this->input->post('mg001'),$this->input->post('mg002'));   //查詢資料是否重複
	    if ($exist)
	         {
		    return 'exist';
		 } 
            return  $this->db->insert('admmg', $data);
         }
		 
        function selone2($seq3,$seq4)    //查copy複製資料是否重複
          { 	
	  
	    $this->db->where('mg001', $this->input->post('mg002c'));     
	    $this->db->where('mg002', $this->input->post('mg004c'));   
	    $query = $this->db->get('admmg');
	    return $query->num_rows() ; 
	  }
		
        function copyf()           //複製一筆
          {
	    $seq1=$this->input->post('mg001c');    
	 
	    $this->db->where('mg001', $this->input->post('mg001c'));     
	   	$this->db->where('mg002', $this->input->post('mg003c')); 
	    $query = $this->db->get('admmg');
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
                           $mg002=$row->mg002;
                           $mg003=$row->mg003;
						   $mg004=$row->mg004;
						   $mg005=$row->mg005;
						   $mg006=$row->mg006;
						   $mg007=$row->mg007;
						   $mg008=$row->mg008;
	 	         endforeach;
		       }   
		  
            $seq3=$this->input->post('mg002c');    //主鍵一筆
	        $seq4=$this->input->post('mg004c'); 
	    $data = array( 
	                 'company' => $this->session->userdata('syscompany'),
	                 'creator' => $this->session->userdata('manager'),
		             'usr_group' => 'A100',
		             'create_date' =>date("Ymd"),
		             'modifier' => ' ',
		             'modi_date' => ' ',
		             'flag' => 0,
                     'mg001' => $seq3,
		             'mg002' => $seq4,
		             'mg003' => $mg003,
					 'mg004' => $mg004,
				     'mg005' => $mg005,
					 'mg006' => $mg006,
					 'mg007' => $mg007,
					 'mg008' => $mg008
                     );
            $exist = $this->admi05_model->selone2($this->input->post('mg002c'),$this->input->post('mg004c'));
		    if ($exist)
		        {
			  return 'exist';
		        }         
            return $this->db->insert('admmg', $data);      //複製一筆  
          }		
		 
	function excelnewf()           //轉excel檔,一筆以上
        {			
	    $seq1=$this->input->post('mg001c');    //查詢一筆以上
	    $seq2=$this->input->post('mg002c'); 
	  
	    $sql = " SELECT mg001,mg002,mg003,mg004,mg005,mg007,mg008,create_date FROM admmg WHERE mg001 >= '$seq1' AND mg001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
        }
		
	function printfd()           //印明細表一筆以上
          {
	    $seq1=$this->input->post('mg001c');    //查詢一筆以上
	    $seq2=$this->input->post('mg002c'); 
	   
	    $sql = " SELECT * FROM admmg WHERE mg001 >= '$seq1'  AND mg001 <= '$seq2'  "; 
            $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
            $seq32 = "mg001 >= '$seq1'  AND mg001 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('admmg')
		              ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
          }
		 
	function updatef()   //更改一筆
          {
	       $mg6=$this->input->post('mg611').$this->input->post('mg612').$this->input->post('mg613').$this->input->post('mg614').$this->input->post('mg615').$this->input->post('mg616').
	            $this->input->post('mg617').$this->input->post('mg618').$this->input->post('mg619').$this->input->post('mg620').$this->input->post('mg621').$this->input->post('mg622');
		   $mg7=$this->input->post('mg711').$this->input->post('mg712').$this->input->post('mg713').$this->input->post('mg714').$this->input->post('mg715').$this->input->post('mg716').
	            $this->input->post('mg717').$this->input->post('mg718').$this->input->post('mg719').$this->input->post('mg720').$this->input->post('mg721').$this->input->post('mg722');
           $mg8=$this->input->post('mg811').$this->input->post('mg812').$this->input->post('mg813').$this->input->post('mg814').$this->input->post('mg815').$this->input->post('mg816').
	            $this->input->post('mg817').$this->input->post('mg818').$this->input->post('mg819').$this->input->post('mg820').$this->input->post('mg821').$this->input->post('mg822');
		   
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		          'mg002' => $this->input->post('mg002'),
		          'mg003' => $this->input->post('mg003'),
                  'mg004' => $this->input->post('mg004'), 
                  'mg005' => $this->input->post('mg005'),
                  'mg006' => $mg6,
                  'mg007' => $mg7,
                  'mg008' => $mg8,				  
                        );
            $this->db->where('mg001', $this->input->post('mg001'));
			$this->db->where('mg002', $this->input->post('mg002'));
            $this->db->update('admmg',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
          }
		
	function deletef($seg1,$seg2)      //刪除一筆 暫存
          {  
	    $seg1=$this->uri->segment(4);
        $seg2=$this->uri->segment(5); 
	    $this->db->where('mg001', $seg1);
	    $this->db->where('mg002', $seg2);
		
            $this->db->delete('admmg'); 
	    if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
          }	  
	  
	function delmutif()   //選取刪除多筆 
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
		    	      $seq1,$seq2;
		    	      
			      $this->db->where('mg001', $seq1);
				  $this->db->where('mg002', $seq1);
			      
                              $this->db->delete('admmg'); 
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