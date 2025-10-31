<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copq06a_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
	function selbrowse($num,$offset)   //查詢 table 表所有資料
      {            
	    $this->db->select('td001, td002, td003, td004, td005, td006, create_date');
        $this->db->from('coptd');
        $this->db->order_by('td001', 'ASC');                //排序  單欄
	   // $this->db->order_by('td001 asc, td002 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁10筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('coptd');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
      }
	
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','td008','td013','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內幣別,付款條件,課稅別,業務員,收款業務
	    $query = $this->db->select('td001, td002, td003, td004, td005, td006,td011,create_date')
	                      ->from('coptd')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('coptd');
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	  function search1($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "td002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
           $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('td001' => '1', 'td002 >=' => $seq6, 'td002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','td008','td013','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('td001, td002, td003, td004')
	                      ->from('coptd')
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	    // $array = array('td001' => '1', 'td002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('coptd')
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('td001','1');
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    
	function selone()    //查詢一筆 修改用
          { 
	    
        $this->db->select('*');		
	    $query = $this->db->get('coptd');
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	  }
		
	function findf($limit, $offset, $sort_by, $sort_order)    //查詢多筆進階查詢 mysql 
          {            		
	  //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `coptd` ";
	    $seq1 = " td001, td002, td003, td004, td005, td006, create_date FROM `coptd` ";
            $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
            $seq33 = 'td001 desc' ;
            $seq9 = " ORDER BY td001 " ;
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
	     $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('td001, td002, td003, td004, td005, td006, create_date')
	                       ->from('coptd')
		               ->where($seq32)
			       ->order_by($seq33)
			     //->order_by($sort_by, $sort_order)
			       ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptd')
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
	    $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否為 table
			
	    $this->db->select('td001, td002, td003, td004, td005, td006, create_date');
	    $this->db->from('coptd');
		$this->db->where('td001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('td001 asc, td002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('coptd');
		$this->db->where('td001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
	  
	function selone1($seg1,$seg2)    //查新增資料是否重複
          {
	    $this->db->set('td001', $this->input->post('td001'));              
	    $this->db->set('td002', $this->input->post('td002'));
	    $this->db->where('td001', $this->input->post('td001'));     
	    $this->db->where('td002', $this->input->post('td002'));	
	    $query = $this->db->get('coptd');
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
                          'td001' => $this->input->post('td001'),
		          'td002' => $this->input->post('td002'),
		          'td003' => $this->input->post('td003'),
		          'td004' => $this->input->post('td004'),
		          'td005' => $this->input->post('td005'),
		          'td006' => $this->input->post('td006')             
                         );
         
	    $exist = $this->invq01a_model->selone1($this->input->post('td001'),$this->input->post('td002'));
	    if ($exist)
	         {
		    return 'exist';
		 } 
            return  $this->db->insert('coptd', $data);
         }
		 
        function selone2($seg1,$seg2)    //查copy複製資料是否重複
          { 	
	    $this->db->set('td001', $this->input->post('td003c'));              
	    $this->db->set('td002', $this->input->post('td004c'));
	    $this->db->where('td001', $this->input->post('td003c'));     
	    $this->db->where('td002', $this->input->post('td004c'));	
	    $query = $this->db->get('coptd');
	    return $query->num_rows() ; 
	  }
		
        function copyf()           //複製一筆
          {
	    $seq1=$this->input->post('td001c');    
	    $seq2=$this->input->post('td002c'); 
	    $this->db->set('td001', $this->input->post('td001c'));              
	    $this->db->set('td002', $this->input->post('td002c'));
	    $this->db->where('td001', $this->input->post('td001c'));     
	    $this->db->where('td002', $this->input->post('td002c'));	
	    $query = $this->db->get('coptd');
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
                           $td003=$row->td003;
                           $td004=$row->td004;
                           $td005=$row->td005;
                           $td006=$row->td006;    	
	 	         endforeach;
		       }   
		  
            $seq3=$this->input->post('td003c');    //主鍵一筆
	    $seq4=$this->input->post('td004c'); 
	    $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                          'td001' => $seq3,
		          'td002' => $seq4,
		          'td003' => $td003,
		          'td004' => $td004,
		          'td005' => $td005,
		          'td006' => $td006             
                         );
            $exist = $this->invq01a_model->selone2($this->input->post('td003c'),$this->input->post('td004c'));
		    if ($exist)
		        {
			  return 'exist';
		        }         
            return $this->db->insert('coptd', $data);      //複製一筆  
          }		
		 
	function excelnewf()           //轉excel檔,一筆以上
          {			
	    $seq1=$this->input->post('td001c');    //查詢一筆以上
	    $seq2=$this->input->post('td002c'); 
	    $seq3=$this->input->post('td003c'); 
	    $seq4=$this->input->post('td004c'); 
	    $sql = " SELECT td001,td002,td003,td004,td005,td006,create_date FROM coptd WHERE td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3' AND td002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    return $query->result_array();
          }
		
	function printfd()           //印明細表一筆以上
          {
	    $seq1=$this->input->post('td001c');    //查詢一筆以上
	    $seq2=$this->input->post('td002c'); 
	    $seq3=$this->input->post('td003c'); 
	    $seq4=$this->input->post('td004c'); 
	    $sql = " SELECT * FROM coptd WHERE td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3' AND td002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
            $seq32 = "td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3' AND td002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('coptd')
		              ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
          }
		 
	function updatef()   //更改一筆
          {
	    $td001=$this->input->post('td001');
	    $td002=$this->input->post('td002');
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
                          'td001' => $this->input->post('td001'),
		          'td002' => $this->input->post('td002'),
		          'td003' => $this->input->post('td003'),
		          'td004' => $this->input->post('td004'),
		          'td005' => $this->input->post('td005'),
		          'td006' => $this->input->post('td006')      
                        );
            $this->db->where('td001', $td001);
	    $this->db->where('td002', $td002);
            $this->db->update('coptd',$data);                   //更改一筆
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
	    $this->db->where('td001', $seg1);
	    $this->db->where('td002', $seg2);
            $this->db->delete('coptd'); 
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
			      $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
                              $this->db->delete('coptd'); 
	                    }
                 }
	  if ($this->db->affected_rows() > 0)
             {
                return TRUE;
             }
                return FALSE;					
          }
    function ajaxCopq06a($seg1)    //ajax 查詢一筆 不更新網頁 供應商 
          { 	              
	    $this->db->set('td001', $this->uri->segment(4));
	    $this->db->where('td001', $this->uri->segment(4));	
	    $query = $this->db->get('coptd');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->td002;
            }
		   return $result;   
		 }
	  }
	 
	function search_hp($limit, $offset, $sort_by, $sort_order, $tc004, $td004, $row_count){//歷史查價
		//先取有其產品的主單 //檢查排序欄位是否在 table 內幣別,付款條件,課稅別,業務員,收款業務
	    $query = $this->db->select('a.tc002, a.tc004, a.tc008')
	                    ->from('coptc as a')
						->join('coptd as b', 'a.tc002 = b.td002 ','left')
						->where('a.tc004', $tc004)
						->where('b.td004',$td004);
	    $ret['rows'] = $query->get()->result();
		$query = $this->db->select('COUNT(*) as count' ,FALSE)
	                    ->from('coptc as a')
						->join('coptd as b', 'a.tc002 = b.td002 ','left')
						->where('a.tc004', $tc004)
						->where('b.td004',$td004);
		$num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		if(!$ret['rows']) {return $ret;}//查無資料就阻斷 or_where

		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('b.td001', 'b.td002', 'b.td003', 'b.td004', 'b.td005', 'b.td006','b.td008','b.td011','b.create_date','a.create_date');
		if($sort_by == "create_date")
			$sort_by = "a.".$sort_by;
		else
			$sort_by = "b.".$sort_by;
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內幣別,付款條件,課稅別,業務員,收款業務
	    $query = $this->db->select('b.td001, b.td002, b.td003, b.td004, b.td005, b.td006, b.td011, a.create_date')
	                    ->from('coptd as b')
						->join('coptc as a', 'a.tc002 = b.td002 ','left')
		                ->order_by($sort_by, $sort_order)
		                ->limit($limit, $offset)
						->where('b.td004',$td004)
						->where('a.tc004',$tc004);
	    $ret['rows'] = $query->get()->result();
		//echo "<pre>";
		//var_dump($ret['rows']);
	    $query = $this->db->select('COUNT(*) as count' ,FALSE)
	                    ->from('coptc as a')
						->join('coptd as b', 'a.tc002 = b.td002 ','left')
						->where('a.tc004', $tc004)
						->where('b.td004',$td004);
						
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		$ret['row_count'] = $row_count;//紀錄查第幾列
		
	    return $ret;
	}
	
		function search_filter_hp($limit, $offset, $sort_by, $sort_order, $tc004, $td004, $like, $row_count){//歷史查價
		//先取有其產品的主單 //檢查排序欄位是否在 table 內幣別,付款條件,課稅別,業務員,收款業務
	    $query = $this->db->select('a.tc002, a.tc004, a.tc008')
	                    ->from('coptc as a')
						->join('coptd as b', 'a.tc002 = b.td002 ','left')
						->where('a.tc004', $tc004)
						->where('b.td004',$td004);
	    $ret['rows'] = $query->get()->result();
		$query = $this->db->select('COUNT(*) as count' ,FALSE)
	                    ->from('coptc as a')
						->join('coptd as b', 'a.tc002 = b.td002 ','left')
						->where('a.tc004', $tc004)
						->where('b.td004',$td004);
		$num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		if(!$ret['rows']) {return $ret;}//查無資料就阻斷 or_where
		
		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('b.td001', 'b.td002', 'b.td003', 'b.td004', 'b.td005', 'b.td006','b.td008','b.td011','b.create_date','a.create_date');
		if($sort_by == "create_date")
			$sort_by = "a.".$sort_by;
		else
			$sort_by = "b.".$sort_by;
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內幣別,付款條件,課稅別,業務員,收款業務
	    $query = $this->db->select('b.td001, b.td002, b.td003, b.td004, b.td005, b.td006, b.td011, a.create_date')
	                    ->from('coptd as b')
						->join('coptc as a', 'a.tc002 = b.td002 ','left')
		                ->order_by($sort_by, $sort_order)
		                ->limit($limit, $offset)
						->where('b.td004',$td004)
						->where('a.tc004',$tc004)
						->like($sort_by,$like);
	    $ret['rows'] = $query->get()->result();

	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                    ->from('coptd as b')
						->join('coptc as a', 'a.tc002 = b.td002 ','left')
		                ->order_by($sort_by, $sort_order)
		                ->limit($limit, $offset)
						->where('b.td004',$td004)
						->where('a.tc004',$tc004)
						->like($sort_by,$like);
						    
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		$ret['row_count'] = $row_count;//紀錄查第幾列
	    return $ret;
	}

}

/* End of file model.php */
/* Location: ./application/model/model.php */