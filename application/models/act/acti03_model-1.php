<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acti03_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('ma001, ma003, ma003, ma004, ma005, ma006, create_date');
        $this->db->from('actma');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('ma001 desc, ma003 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('actma');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('ma001', 'ma003', 'ma003', 'ma004', 'ma005', 'ma006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('ma001, ma003, ma007, ma008, ma009, ma011, create_date')
	                      ->from('actma')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('actma');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    //
	/***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('acti03_search',"display_search/".$offset);
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
		$default_order = "ma001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['acti03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['acti03']['search']['where'];
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
		
		if(isset($_SESSION['acti03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['acti03']['search']['order'];
		}
		
		if(!isset($_SESSION['acti03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('ma001, ma002, ma003, ma004, create_date')
			->from('actma')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('ma001, ma002, ma003, ma004, create_date')
			->from('actma')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['acti03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('actma');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['acti03']['search']['where'] = $where;
		$_SESSION['acti03']['search']['order'] = $order;
		$_SESSION['acti03']['search']['offset'] = $offset;
		
		return $ret;
	}
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('ma001', $this->uri->segment(4));
	    $this->db->where('ma001', $this->uri->segment(4));	
	    $query = $this->db->get('actma');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->ma003;
         }
		  return $result;   
		 }
	   }
	   //ajax 查詢一筆 交易幣別	
	function ajaxcmsq06a($seg1)    
        { 
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('actma');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ma003;
              }
		      return $result;   
		   }
	    }
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('actma.*, actma.ma003 as ma018disp');	
		 $this->db->from('actma');
	     //$this->db->set('ma001', $this->uri->segment(4)); 
	     $this->db->where('ma001', $this->uri->segment(4));
	//	 $this->db->join('actma', 'actma.ma018 = actma.ma001','left');
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `actma` ";
	     $seq1 = " ma001, ma003, ma003, ma004, ma005, ma006,ma007, create_date FROM `actma` ";
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
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ma001', 'ma003', 'ma003', 'ma004', 'ma005', 'ma006','ma007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ma001, ma003, ma003, ma007, ma008, ma009,ma011, create_date')
	                       ->from('actma')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('actma')
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
	    $sort_columns = array('ma001', 'ma003', 'ma003', 'ma007','ma008', 'ma009', 'ma011','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
	    $this->db->select('ma001, ma003, ma003, ma007, ma008, ma009, ma011, create_date');
	    $this->db->from('actma');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('ma001 asc, ma003 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('actma');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	  //  $this->db->set('ma001', $this->input->post('ma001')); 
	    $this->db->where('ma001', $this->input->post('ma001')); 
	    $query = $this->db->get('actma');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		  $sma005 = $this->input->post('ma005');
          if ($sma005 != 'Y') {
          $sma005 = 'N';
           }
		  $sma006 = $this->input->post('ma006');
          if ($sma006 != 'Y') {
          $sma006 = 'N';
           }
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'ma001' => $this->input->post('ma001'),
		          'ma003' => $this->input->post('ma003'),
		          'ma003' => $this->input->post('ma003'),
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
				  'ma015' => $this->input->post('ma015'),
				  'ma016' => $this->input->post('ma016'),
				  'ma017' => $this->input->post('ma017'),
				  'ma018' => $this->input->post('cmsq06a'),
		          'ma019' => $this->input->post('ma019')
		             
                      );
         
	    $exist = $this->acti03_model->selone1($this->input->post('ma001'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('actma', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->set('ma001', $this->input->post('ma003c')); 
	    $this->db->where('ma001', $this->input->post('ma003c')); 
	    $query = $this->db->get('actma');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('ma001c');    
	    $seq2=$this->input->post('ma003c');
	    $this->db->where('ma001', $this->input->post('ma001c')); 
	    $query = $this->db->get('actma');
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
                $ma003=$row->ma003;
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
                $ma015=$row->ma015;
                $ma016=$row->ma016;
                $ma017=$row->ma017; 
                $ma018=$row->ma018; 	
                $ma019=$row->ma019; 				
	 	  endforeach;
	      } 
            $seq3=$this->input->post('ma003c');    //主鍵一筆
	  
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'ma001' => $seq3,
		          'ma003' => $ma003,
		          'ma003' => $ma003,
		          'ma004' => $ma004,
		          'ma005' => $ma005,
		          'ma006' => $ma006, 
				  'ma007' => $ma007,
		          'ma008' => $ma008,
		          'ma009' => $ma009,
		          'ma010' => $ma010,
		          'ma011' => $ma011, 
				  'ma012' => $ma012,
		          'ma013' => $ma013,
		          'ma014' => $ma014,
		          'ma015' => $ma015,
		          'ma016' => $ma016,
                  'ma017' => $ma017,
		          'ma018' => $ma018, 				  
                  'ma019' => $ma019				  
                    );
            $exist = $this->acti03_model->selone2($this->input->post('ma003c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('actma', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('ma001c');    //查詢一筆以上
	    $seq2=$this->input->post('ma003c');
	    $sql = " SELECT ma001,ma003,ma005,ma006,ma007,ma008,create_date FROM actma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('ma001c');    //查詢一筆以上
	    $seq2=$this->input->post('ma003c'); 
	    $sql = " SELECT * FROM actma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "ma001 >= '$seq1'  AND ma001 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('actma')
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
		          'ma003' => $this->input->post('ma003'),
		          'ma003' => $this->input->post('ma003'),
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
				  'ma015' => $this->input->post('ma015'),
				  'ma016' => $this->input->post('ma016'),
				  'ma017' => $this->input->post('ma017'),
				  'ma018' => $this->input->post('cmsq06a'),
		          'ma019' => $this->input->post('ma019')     
                        );
            $this->db->where('ma001', $this->input->post('ma001'));
	       
            $this->db->update('actma',$data);                   //更改一筆
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
	    $this->db->where('ma001', $seg1);
        $this->db->delete('actma'); 
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
		   //   $seq1;
		      //   $seq2;
			  $this->db->where('ma001', $seq1);
              $this->db->delete('actma'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup1($keyword){     
      $this->db->select('ma001, ma003');
	  $this->db->from('actma');  
      $this->db->like('ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ma003',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookup2($keyword){  
      $ma001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('ma001, ma003');
	  $this->db->from('actma');  
      $this->db->where('ma001',$ma001);
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function ajaxacti03($seg1)    //ajax 查詢一筆 顯示用 廠別6
          { 	              
	    $this->db->set('ma001', $this->uri->segment(4));
	    $this->db->where('ma001', $this->uri->segment(4));	
	    $query = $this->db->get('actma');
			
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
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>