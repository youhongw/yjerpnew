<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class eivi11_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006, create_date');
        $this->db->from('eivmv');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mv001 desc, mv002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('eivmv');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mv001', 'mv002', 'mv003', 'mv026', 'mv027', 'mv028','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('*')
	                      ->from('eivmv')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('eivmv');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  //Talence Editor 2017.03.21
	/***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('eivi11_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mv002 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['eivi11']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['eivi11']['search']['where'];
		}
		
		if($this->input->post('find005')){
			if($where){$where .= " and ";}
			$where .= $this->input->post('find005');
		}
		
		if($func == "and_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " and ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($func == "or_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " or ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($where == ""){$where=false;}
		/* where end */
		
		/* order 處理區域 */
		if($this->input->post('find007')){
			$order = $this->input->post('find007');
		}else{
			$order = "";
		}
		
		if($func == "order" && @strlen($val)!=0){
			$value = $val;
			$order = $value;
		}else{
			$order = "";
		}
		
		if(isset($_SESSION['eivi11']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['eivi11']['search']['order'];
		}
		
		if(!isset($_SESSION['eivi11']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select(' * ')
			->from('eivmv')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select(' * ')
			->from('eivmv')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['eivi11']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('eivmv');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['eivi11']['search']['where'] = $where;
		$_SESSION['eivi11']['search']['order'] = $order;
		$_SESSION['eivi11']['search']['offset'] = $offset;
		
		return $ret;
	}
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mv001', $this->uri->segment(4));
	    $this->db->where('mv001', $this->uri->segment(4));	
	    $query = $this->db->get('eivmv');
			
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
	function selone()    
       { 
		 $this->db->select('*');	
		 $this->db->from('eivmv');
	     //$this->db->set('mv001', $this->uri->segment(4)); 
	     $this->db->where('mv002', $this->uri->segment(4));
		// $this->db->join('eivmv', 'eivmv.mv003 = eivmv.mb001','left');
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `eivmv` ";
	     $seq1 = " mv001, mv002, mv003, mv004, mv005, mv006,mv007, create_date FROM `eivmv` ";
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
	     $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv006','mv007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006,mv007, create_date')
	                       ->from('eivmv')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('eivmv')
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
	    $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006, create_date');
	    $this->db->from('eivmv');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mv001 asc, mv002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('eivmv');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    
	    $this->db->where('mv053', $this->input->post('mv053')); 
	    $query = $this->db->get('eivmv');
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
                  'mv001' => $this->input->post('mv001'),
		          'mv002' => $this->input->post('mv002'),
		          'mv003' => $this->input->post('mv003'),
		          'mv004' => $this->input->post('mv004'),
		          'mv005' => $this->input->post('mv005'),
		          'mv006' => $this->input->post('mv006'),
				  'mv007' => $this->input->post('mv007'),
		          'mv008' => $this->input->post('mv008'),
		          'mv009' => $this->input->post('mv009'),
				  'mv010' => $this->input->post('mv010'),
		          'mv011' => $this->input->post('mv011'),
		          'mv026' => $this->input->post('mv026'),
				  'mv027' => $this->input->post('mv027'),
		          'mv028' => $this->input->post('mv028'),
		          'mv053' => $this->input->post('mv053'),
                  'mv054' => $this->input->post('mv054'),
                  'mv055' => $this->input->post('mv055'),
                  'mv056' => $this->input->post('mv056')				  
                      );
         
	    $exist = $this->eivi11_model->selone1($this->input->post('mv053'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('eivmv', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->set('mv001', $this->input->post('mv002c')); 
	    $this->db->where('mv001', $this->input->post('mv002c')); 
	    $query = $this->db->get('eivmv');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mv001c');    
	    $seq2=$this->input->post('mv002c');
	    $this->db->where('mv001', $this->input->post('mv001c')); 
	    $query = $this->db->get('eivmv');
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
                $mv006=$row->mv006; 
                $mv007=$row->mv007;  						   
	 	  endforeach;
	      } 
            $seq3=$this->input->post('mv002c');    //主鍵一筆
	  
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'mv001' => $seq3,
		          'mv002' => $mv002,
		          'mv003' => $mv003,
		          'mv004' => $mv004,
		          'mv005' => $mv005,
		          'mv006' => $mv006, 
                  'mv007' => $mv007				  
                    );
            $exist = $this->eivi11_model->selone2($this->input->post('mv002c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('eivmv', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('mv001c');    //查詢一筆以上
	    $seq2=$this->input->post('mv002c');
	    $sql = " SELECT mv001,mv002,mv003,mv004,mv005,mv006,mv007,create_date FROM eivmv WHERE mv001 >= '$seq1'  AND mv001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('mv001c');    //查詢一筆以上
	    $seq2=$this->input->post('mv002c'); 
	    $sql = " SELECT * FROM eivmv WHERE mv001 >= '$seq1'  AND mv001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mv001 >= '$seq1'  AND mv001 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('eivmv')
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
				  'mv001' => $this->input->post('mv001'),
		          'mv002' => $this->input->post('mv002'),
		          'mv003' => $this->input->post('mv003'),
		          'mv004' => $this->input->post('mv004'),
		          'mv005' => $this->input->post('mv005'),
		          'mv006' => $this->input->post('mv006'),
				  'mv007' => $this->input->post('mv007'),
		          'mv008' => $this->input->post('mv008'),
		          'mv009' => $this->input->post('mv009'),
				  'mv010' => $this->input->post('mv010'),
		          'mv011' => $this->input->post('mv011'),
		          'mv026' => $this->input->post('mv026'),
				  'mv027' => $this->input->post('mv027'),
		          'mv028' => $this->input->post('mv028'),
		        //  'mv053' => $this->input->post('mv053'),
                  'mv054' => $this->input->post('mv054'),
                  'mv055' => $this->input->post('mv055'),
                  'mv056' => $this->input->post('mv056')		      
                        );
            $this->db->where('mv053', $this->input->post('mv053'));
	       
            $this->db->update('eivmv',$data);                   //更改一筆
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
        $this->db->delete('eivmv'); 
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
		      //   $seq2;
			  $this->db->where('mv001', $seq1);
              $this->db->delete('eivmv'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	/*==以下AJAX處理區域==*/
	 function ajaxeivi11($seg1)    //ajax 查詢一筆 顯示用 庫別6
          { 	              
	    $this->db->set('mv001', $this->uri->segment(4));
	    $this->db->where('mv001', $this->uri->segment(4));	
	    $query = $this->db->get('eivmv');
			
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
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword){     
      $this->db->select('mv001, mv002');
	  $this->db->from('eivmv');  
      $this->db->like('mv001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mv002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookup2($keyword){  
      $mv001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('mv001, mv002');
	  $this->db->from('eivmv');  
      $this->db->where('mv001',$mv001);
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd($keyword){     
      $this->db->select('mv001, mv002');
	  $this->db->from('eivmv');
      $this->db->like('mv001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mv002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookup_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=10){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('eivmv');
		foreach($search_col as $key => $val){
			if($key == "and"){
				$this->db->like($val,$keyword[$val],'after');
			}elseif($key == "or"){
				$this->db->or_like($val,$keyword[$val], 'after');
			}
		}
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
    }
	//ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('mv053');
		  $this->db->where('mv055', $seg1);
		  $query = $this->db->get('eivmv');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		//	 echo var_dump($res);exit;
			 
		     foreach ($query->result() as $row)
              {
               $result=$row->mv053;
              }
		      return $result;   
		     }
	      }
	//取單號 最大值加1
	function check_title_no($seg1){
		//preg_match_all('/\d/S',$mv053tc039, $matches);  //處理日期字串
		//$tc039 = implode('',$matches[0]);
		$this->db->select('MAX(mv053) as max_no')
			->from('eivmv')
			->where('mv055', $seg1)
			->like('mv055', $seg1, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $seg1."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>