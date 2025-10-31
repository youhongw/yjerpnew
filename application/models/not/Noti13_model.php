<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class noti13_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mc001,mc002,mc003');
          $this->db->from('notmc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mc001 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('notmc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mc001', 'mc002', 'mc003');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mc001,mc002,mc003')
	                       ->from('notmc')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('notmc');
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
		$this->session->set_userdata('noti13_search',"display_search/".$offset);
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
		$default_order = "mc001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['noti13']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['noti13']['search']['where'];
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
		
		if(isset($_SESSION['noti13']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['noti13']['search']['order'];
		}
		
		if(!isset($_SESSION['noti13']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mc001, mc002, mc003,  create_date')
			->from('notmc')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mc001, mc002, mc003, create_date')
			->from('notmc')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['noti13']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('notmc');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['noti13']['search']['where'] = $where;
		$_SESSION['noti13']['search']['order'] = $order;
		$_SESSION['noti13']['search']['offset'] = $offset;
		
		return $ret;
	}	
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('* ');
        $this->db->from('notmc');
		$this->db->where('mc001', urldecode($this->uri->segment(4))); 
	 //   $this->db->where('a.mf002', $this->uri->segment(5)); 
		$this->db->order_by('mc001');
		
		$query = $this->db->get();
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('invmb');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
		
	//ajax 查詢 顯示 請購單別 mb001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '31');
          $this->db->where('mq001', $this->uri->segment(4));		  
	      $query = $this->db->get('notmq');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mq002;
              }
		   return $result;   
		   } 
	    }
		
	//ajax 查詢顯示用 請購部門	
	function ajaxnotq05a($seg1)    
        {
	      $this->db->where('mc001', $this->uri->segment(4));	
	      $query = $this->db->get('notme');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mc002;
              }
		   return $result;   
		  }
	    }
		
	//ajax 查詢顯示用 廠別 mf010  
	function ajaxnotq02a($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('notmb');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mb002;
              }
		    return $result;   
		   }
	    }
		
	//ajax 查詢 顯示用 請購人員  
	function ajaxpalq01a($seg1)    
        { 	              
	      $this->db->set('mv001', $this->uri->segment(4));
		  $this->db->where('mv022', '');
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('notmv');
			
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
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('mf002');
		  $this->db->where('mc001', $this->uri->segment(4));
	      $this->db->where('mf013', $this->uri->segment(5));
		  $query = $this->db->get('notmc');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mf002;
              }
		      return $result;   
		     }
	      }
		  
	//ajax 查詢 顯示用 明細 品號	
	function ajaxinvq02a4($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('invmb');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mb001;
              }
		   return $result;   
		   }
	    }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `notmc` ";
	      $seq1 = "mc001,mc002,mc003 FROM `notmc` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mc001 desc' ;
          $seq9 = " ORDER BY mc001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="mc001 ";

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
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mc001', 'mc002', 'mc003');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mc001,mc002,mc003')
	                       ->from('notmc')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('notmc')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//篩選多筆     
	function filterf1($limit, $offset , $sort_by  , $sort_order)          
	    {    
	      $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
          $sort_by = $this->uri->segment(4);			
          $sort_order = $this->uri->segment(5);	
	      $offset=$this->uri->segment(8,0);
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('mc001', 'mc002', 'mc003');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否為 table
	      $this->db->select('mc001,mc002,mc003');
	      $this->db->from('notmc');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mc001 asc, mf002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('notmc');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('mc001', $this->input->post('mc001'));
		//  $this->db->where('mf002', $this->input->post('mf002'));
	      $query = $this->db->get('notmc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2)    
        {
	      $this->db->where('mb002', $seg1);
	      $this->db->where('mb001', $seg2);
	      $query = $this->db->get('notmb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  notmc	
	function insertf()    //新增一筆 檔頭  notmc
        {
	     $data = array( 
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' =>date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'mc001' => $this->input->post('mc001'),
			'mc002' => $this->input->post('mc002'),
			'mc003' => $this->input->post('mc003')
		);
         
	      $exist = $this->noti13_model->selone1($this->input->post('mc001'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('notmc', $data);

		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1)    
        { 
	      $this->db->where('mc001', $this->input->post('mc001c')); 
         // $this->db->where('mf002', $this->input->post('mf002c'));
	      $query = $this->db->get('notmc');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('mc001', $this->input->post('mc001o'));
		//	$this->db->where('mf002', $this->input->post('mf002o'));
	        $query = $this->db->get('notmc');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         		
         //   if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() == 1) 
		       {
			     $result = $query->result();
			     foreach($result as $row):
                $mc002=$row->mc002;$mc003=$row->mc003;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mc001c');    //主鍵一筆檔頭notmc
		//	$seq2=$this->input->post('mf002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mc001' => $seq1,'mc002' => $mc002,'mc003' => $mc003
                   );
				   
            $exist = $this->noti13_model->selone2($this->input->post('mc001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('notmc', $data);      //複製一筆  
			
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mc001o');    
	      $seq2=$this->input->post('mc001c');
	      $sql = "SELECT mc001,mc002,mc003 FROM notmc WHERE mc001 >= '$seq1'  AND mc001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('mc001o');    
	      $seq2=$this->input->post('mc001c');
		//  $seq3=$this->input->post('mf002o');    
	   //   $seq4=$this->input->post('mf002c');
	      $sql = " SELECT * FROM notmc WHERE mc001 >= '$seq1'  AND mc001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "mc001 >= '$seq1'  AND mc001 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('notmc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006');
		 
        $this->db->from('notmc as a');	
        $this->db->join('notmb as b', 'a.mc001 = b.mb001   ','left');
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	  
		$this->db->order_by('a.mc001 , b.mb002');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mb001', $this->uri->segment(4));
		//$this->db->where('mb002', $this->uri->segment(5));
	    $query = $this->db->get('notmb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS mc001disp, d.mc002 AS mf004disp, e.mb002 AS mf010disp, f.mv002 AS mf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006, b.mb007, b.mb011, b.mb009, b.mb017, b.mb018, b.mb012');
		 
        $this->db->from('notmc as a');	
        $this->db->join('notmb as b', 'a.mc001 = b.mb001  and a.mf002=b.mb002 ','left');		
		$this->db->join('notmq as c', 'a.mc001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('notme as d', 'a.mf004 = d.mc001 ','left');
	    $this->db->join('notmb as e', 'a.mf010 = e.mb001 ','left');
		$this->db->join('notmv as f ', 'a.mf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mc001', $this->input->post('mc001o')); 
	    $this->db->where('a.mf002', $this->input->post('mf002o')); 
		$this->db->order_by('mc001 , mf002 ,b.mb003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  
	//印單據筆  
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS mc001disp, d.mc002 AS mf004disp, e.mb002 AS mf010disp, f.mv002 AS mf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006, b.mb007, b.mb011, b.mb009, b.mb017, b.mb018, b.mb012');
		 
        $this->db->from('notmc as a');	
        $this->db->join('notmb as b', 'a.mc001 = b.mb001  and a.mf002=b.mb002 ','left');		
		$this->db->join('notmq as c', 'a.mc001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('notme as d', 'a.mf004 = d.mc001 ','left');
	    $this->db->join('notmb as e', 'a.mf010 = e.mb001 ','left');
		$this->db->join('notmv as f ', 'a.mf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	    $this->db->where('a.mf002', $this->uri->segment(5)); 
		$this->db->order_by('mc001 , mf002 ,b.mb003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }	    		
        }
		
	//更改一筆	
	function updatef()   
        {
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'mc001' => $this->input->post('mc001'),
				'mc002' => $this->input->post('mc002'),
				'mc003' => $this->input->post('mc003')
                );
            $this->db->where('mc001', $this->input->post('mc001'));
		//	$this->db->where('mf002', $this->input->post('mf002'));
            $this->db->update('notmc',$data);                   //更改一筆
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mc001', $this->uri->segment(4));
	//	  $this->db->where('mf002', $this->uri->segment(5));
          $this->db->delete('notmc');  
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
			      $this->db->where('mc001', $seq1);
			   //   $this->db->where('mf002', $seq2);
                  $this->db->delete('notmc'); 
				  $this->db->where('mb001', $seq1);
			    //  $this->db->where('mb002', $seq2);
                  $this->db->delete('notmb'); 
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