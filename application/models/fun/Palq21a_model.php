<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palq21a_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
	function selbrowse($num,$offset)   //查詢 table 表所有資料
      {            
	    $this->db->select('mk001, mk002, mk003,  create_date');
        $this->db->from('palmk');
        $this->db->order_by('mk001', 'ASC');                //排序  單欄
	   // $this->db->order_by('mk001 asc, mk002 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁10筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmk');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
      }
	
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mk001', 'mk002', 'mk003', 'mk004',  'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mk001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mk001, mk002, mk003, create_date')
	                      ->from('palmk')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmk');
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	  function search1($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mk002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mk001' => '1', 'mk002 >=' => $seq6, 'mk002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mk001', 'mk002', 'mk003', 'mk004','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mk001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mk001, mk002, mk003,create_date')
	                      ->from('palmk')
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('mk001' => '1', 'mk002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmk')
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('mk001','1');
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    
	function selone()    //查詢一筆 修改用
          { 
	    
        $this->db->select('*');		
	    $query = $this->db->get('palmk');
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	  }
		
	function findf($limit, $offset, $sort_by, $sort_order)    //查詢多筆進階查詢 mysql 
          {            		
	  //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `palmk` ";
	    $seq1 = " mk001, mk002, mk003, mk004, mk005, mk006, mk007, mk008, mk009, mk010, create_date FROM `palmk` ";
            $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
            $seq33 = 'mk001 desc' ;
            $seq9 = " ORDER BY mk001 " ;
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
	     $sort_columns = array('mk001', 'mk002', 'mk003', 'mk004', 'mk005', 'mk006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mk001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mk001, mk002, mk003, mk004, mk005, mk006, create_date')
	                       ->from('palmk')
		               ->where($seq32)
			       ->order_by($seq33)
			     //->order_by($sort_by, $sort_order)
			       ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palmk')
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
	    $sort_columns = array('mk001', 'mk002', 'mk003', 'mk004','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mk001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mk001, mk002, mk003,  create_date');
	    $this->db->from('palmk');
		$this->db->where('mk001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mk001 asc, mk002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palmk');
		$this->db->where('mk001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
	  
	function selone1($seg1,$seg2)    //查新增資料是否重複
          {
	    $this->db->set('mk001', $this->input->post('mk001'));              
	    $this->db->set('mk002', $this->input->post('mk002'));
	    $this->db->where('mk001', $this->input->post('mk001'));     
	    $this->db->where('mk002', $this->input->post('mk002'));	
	    $query = $this->db->get('palmk');
	    return $query->num_rows() ;
	  }  	 
		
	function insertf()    //新增一筆
          {
	    $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                          'mk001' => $this->input->post('mk001'),
		          'mk002' => $this->input->post('mk002'),
		          'mk003' => $this->input->post('mk003'),
		          'mk004' => $this->input->post('mk004'),
		          'mk005' => $this->input->post('mk005'),
		          'mk006' => $this->input->post('mk006')             
                         );
         
	    $exist = $this->invq01a_model->selone1($this->input->post('mk001'),$this->input->post('mk002'));
	    if ($exist)
	         {
		    return 'exist';
		 } 
            return  $this->db->insert('palmk', $data);
         }
		 
        function selone2($seg1,$seg2)    //查copy複製資料是否重複
          { 	
	    $this->db->set('mk001', $this->input->post('mk003c'));              
	    $this->db->set('mk002', $this->input->post('mk004c'));
	    $this->db->where('mk001', $this->input->post('mk003c'));     
	    $this->db->where('mk002', $this->input->post('mk004c'));	
	    $query = $this->db->get('palmk');
	    return $query->num_rows() ; 
	  }
		
        function copyf()           //複製一筆
          {
	    $seq1=$this->input->post('mk001c');    
	    $seq2=$this->input->post('mk002c'); 
	    $this->db->set('mk001', $this->input->post('mk001c'));              
	    $this->db->set('mk002', $this->input->post('mk002c'));
	    $this->db->where('mk001', $this->input->post('mk001c'));     
	    $this->db->where('mk002', $this->input->post('mk002c'));	
	    $query = $this->db->get('palmk');
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
                           $mk003=$row->mk003;
                           $mk004=$row->mk004;
                           $mk005=$row->mk005;
                           $mk006=$row->mk006;    	
	 	         endforeach;
		       }   
		  
            $seq3=$this->input->post('mk003c');    //主鍵一筆
	    $seq4=$this->input->post('mk004c'); 
	    $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                          'mk001' => $seq3,
		          'mk002' => $seq4,
		          'mk003' => $mk003,
		          'mk004' => $mk004,
		          'mk005' => $mk005,
		          'mk006' => $mk006             
                         );
            $exist = $this->invq01a_model->selone2($this->input->post('mk003c'),$this->input->post('mk004c'));
		    if ($exist)
		        {
			  return 'exist';
		        }         
            return $this->db->insert('palmk', $data);      //複製一筆  
          }		
		 
	function excelnewf()           //轉excel檔,一筆以上
          {			
	    $seq1=$this->input->post('mk001c');    //查詢一筆以上
	    $seq2=$this->input->post('mk002c'); 
	    $seq3=$this->input->post('mk003c'); 
	    $seq4=$this->input->post('mk004c'); 
	    $sql = " SELECT mk001,mk002,mk003,mk004,mk005,mk006,create_date FROM palmk WHERE mk001 >= '$seq1'  AND mk001 <= '$seq2' AND mk002 >= '$seq3' AND mk002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    return $query->result_array();
          }
		
	function printfd()           //印明細表一筆以上
          {
	    $seq1=$this->input->post('mk001c');    //查詢一筆以上
	    $seq2=$this->input->post('mk002c'); 
	    $seq3=$this->input->post('mk003c'); 
	    $seq4=$this->input->post('mk004c'); 
	    $sql = " SELECT * FROM palmk WHERE mk001 >= '$seq1'  AND mk001 <= '$seq2' AND mk002 >= '$seq3' AND mk002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
            $seq32 = "mk001 >= '$seq1'  AND mk001 <= '$seq2' AND mk002 >= '$seq3' AND mk002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('palmk')
		              ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
          }
		 
	function updatef()   //更改一筆
          {
	    $mk001=$this->input->post('mk001');
	    $mk002=$this->input->post('mk002');
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
                          'mk001' => $this->input->post('mk001'),
		          'mk002' => $this->input->post('mk002'),
		          'mk003' => $this->input->post('mk003'),
		          'mk004' => $this->input->post('mk004'),
		          'mk005' => $this->input->post('mk005'),
		          'mk006' => $this->input->post('mk006')      
                        );
            $this->db->where('mk001', $mk001);
	    $this->db->where('mk002', $mk002);
            $this->db->update('palmk',$data);                   //更改一筆
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
	    $this->db->where('mk001', $seg1);
	    $this->db->where('mk002', $seg2);
            $this->db->delete('palmk'); 
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
		    	      list($seq1, $seq2) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
			      $this->db->where('mk001', $seq1);
			      $this->db->where('mk002', $seq2);
                              $this->db->delete('palmk'); 
	                    }
                 }
	  if ($this->db->affected_rows() > 0)
             {
                return TRUE;
             }
                return FALSE;					
          } 
     function ajaxpalq21a($seg1)    //ajax 查詢一筆 顯示用 請購部門
        { 	              
	      
	      $this->db->where('mk001', $this->uri->segment(4));	
	      $query = $this->db->get('palmk');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mk002;
              }
		   return $result;   
		  }
	    }
}

/* End of file model.php */
/* Location: ./application/model/model.php */