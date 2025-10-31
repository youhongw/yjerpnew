<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pali53_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('tf001, tf002, tf003, tf004, tf005, tf006, create_date');
        $this->db->from('paltf');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('tf002 desc, tf001 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('paltf');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tf001', 'tf002', 'tf003', 'tf010', 'tf011', 'tf016','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf002';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.tf001,b.mv002 as tf001disp,a.tf002, a.tf003,a.tf010, a.tf011, a.tf012, a.tf013, a.tf014, a.tf015, a.tf016, a.tf017, a.tf018, a.tf019')
			  ->from('paltf as a')
			  ->join('cmsmv as b', 'a.tf001 = b.mv001 ','left')
			  ->order_by($sort_by, $sort_order)
			  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		foreach($ret['rows'] as $key => $val){
			if($this->check_holiday($val->tf002)){
				$ret['rows'][$key]->holiday = 1;
			}else{
				$ret['rows'][$key]->holiday = 0;
			}
		}
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			  ->from('paltf');
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
		$this->session->set_userdata('pali53_search',"display_search");
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get()); //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量
			$temp_url = explode(".html",$val); //explode() 函数把字符串打散为数组。
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tf002,tf001 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['pali53']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['pali53']['search']['where'];
		//	echo "<pre>";var_dump($_SESSION['pali53']['search']['where']);exit;
		}
	//	echo "<pre>";var_dump($_SESSION['pali53']['search']['where']);exit;
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
				$value .= $val." like '".$val_ary[$key]."%' ";
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
				$value .= $val." like '".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($where == ""){$where=false;}
		//echo "<pre>";var_dump($where);
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
		
		if(isset($_SESSION['pali53']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['pali53']['search']['order'];
		}
		
		if(!isset($_SESSION['pali53']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		/* Data SQL */
		$query = $this->db->select('a.tf001,b.mv002 as tf001disp,a.tf002, a.tf003,a.tf010, a.tf011, a.tf012, a.tf013, a.tf014, a.tf015, a.tf016, a.tf017, a.tf018, a.tf019')
			->from('paltf as a')
			->join('cmsmv as b', 'a.tf001 = b.mv001 ','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['pali53']['search']['sql'] = $this->db->last_query();
		
		/*此段為判斷是否國定假日，其他功能不用，可直接砍掉*/
		foreach($ret['data'] as $key => $val){
			if($this->check_holiday($val->tf002)){
				$ret['data'][$key]->holiday = 1;
			}else{
				$ret['data'][$key]->holiday = 0;
			}
		}
		/* Num SQL*/
		$query = $this->db->select('count(a.tf001) as total_num')
			->from('paltf as a')
			->join('cmsmv as b', 'a.tf001 = b.mv001 ','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['pali53']['search']['where'] = $where;
		$_SESSION['pali53']['search']['order'] = $order;
		$_SESSION['pali53']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('tf001', $this->uri->segment(4));
	    $this->db->where('tf001', $this->uri->segment(4));	
	    $query = $this->db->get('paltf');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->tf002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2)    
       { 
		 $this->db->select('a.*, b.mv002 as tf001disp, c.me002 as tf001disp1');	
		 $this->db->from('paltf as a');
		 $this->db->join('cmsmv as b', 'a.tf001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.tf002 = c.me001 ','left');
		// $this->db->where('tf001', $this->uri->segment(4));
		 $this->db->where('a.tf001',$seq1); 
	     $this->db->where('a.tf002',$seq2);
         	 
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
		$seq11 = "SELECT COUNT(*) as count  FROM `paltf` ";
		$seq1 = " tf001, tf002, tf003, tf004, tf005, tf008,tf014,tf011, create_date FROM `paltf` ";
		$seq2 = "WHERE `create_date` >=' ' ";
		$seq32 = "a.`create_date` >='' ";
		$seq33 = 'tf001 desc' ;
		$seq9 = " ORDER BY tf001 " ;
		$seq91=" limit ";
		$seq92=", ";
		$seq5= "a.`create_date` >='' ";
		$seq7="tf001 ";

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
		$sort_columns = array('tf001', 'tf002', 'tf003', 'tf004', 'tf005', 'tf006','tf007','tf010','tf011','tf016','create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('a.tf001,b.mv002 as tf001disp, a.tf002, c.me002 as tf002disp,a.tf003, a.tf004, a.tf005,a.tf006,a.tf007,a.tf010,a.tf011, a.tf012, a.tf013, a.tf014, a.tf015,a.tf016, a.tf017, a.tf018, a.tf019, a.create_date')
	                       ->from('paltf as a')
						   ->join('cmsmv as b', 'a.tf001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.tf002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();
		// echo "<pre>";var_dump($this->db->last_query());exit;
		foreach($ret['rows'] as $key => $val){
			if($this->check_holiday($val->tf002)){
				$ret['rows'][$key]->holiday = 1;
			}else{
				$ret['rows'][$key]->holiday = 0;
			}
		}
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			   ->from('paltf as a')
			  ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
       }
	
	//查詢進階查詢 	
	function findf_bak($limit, $offset, $sort_by, $sort_order)     
       {
	//	echo "<pre>";var_dump($this->input->post());exit;
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `paltf` ";
	     $seq1 = " tf001, tf002, tf003, tf004, tf005, tf008,tf014,tf011, create_date FROM `paltf` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "a.`create_date` >='' ";
         $seq33 = 'tf001 desc' ;
         $seq9 = " ORDER BY tf001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "a.`create_date` >='' ";
         $seq7="tf001 ";

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
	     $sort_columns = array('tf001', 'tf002', 'tf003', 'tf004', 'tf005', 'tf006','tf007','tf010','tf011','tf016','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tf001,b.mv002 as tf001disp, a.tf002, c.me002 as tf002disp,a.tf003, a.tf004, a.tf005,a.tf006,a.tf007,a.tf010,a.tf011, a.tf012, a.tf013, a.tf014, a.tf015,a.tf016, a.tf017, a.tf018, a.tf019, a.create_date')
	                       ->from('paltf as a')
						   ->join('cmsmv as b', 'a.tf001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.tf002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		// echo "<pre>";var_dump($this->db->last_query());exit;
		foreach($ret['rows'] as $key => $val){
			if($this->check_holiday($val->tf002)){
				$ret['rows'][$key]->holiday = 1;
			}else{
				$ret['rows'][$key]->holiday = 0;
			}
		}
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			   ->from('paltf as a')
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
	    $sort_columns = array('tf001', 'tf002', 'tf003', 'tf004', 'tf005', 'tf006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否為 table
		
		$this->db->select('a.tf001,b.mv002 as tf001disp, a.tf002, c.me002 as tf002disp,a.tf003, a.tf004, a.tf005,a.tf006,a.tf007,a.tf010,a.tf011, a.tf012, a.tf013, a.tf014, a.tf015,a.tf016, a.tf017, a.tf018, a.tf019, a.create_date');
	       $this->db->from('paltf as a');
			$this->db->join('cmsmv as b', 'a.tf001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.tf002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('tf001 asc, tf002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
		foreach($ret['rows'] as $key => $val){
			if($this->check_holiday($val->tf002)){
				$ret['rows'][$key]->holiday = 1;
			}else{
				$ret['rows'][$key]->holiday = 0;
			}
		}
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('paltf');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('tf001', $this->input->post('palq01a')); 
	    $this->db->where('tf002', $seg2); 	    
	    $query = $this->db->get('paltf');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		$tf002=substr($this->input->post('tf002'),0,4).substr($this->input->post('tf002'),5,2).substr(rtrim($this->input->post('tf002')),8,2);
       	$tf003=substr($this->input->post('tf003'),0,2).substr($this->input->post('tf003'),3,2);
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'tf001' => $this->input->post('palq01a'),
		          'tf002' => substr($this->input->post('tf002'),0,4).substr($this->input->post('tf002'),5,2).substr(rtrim($this->input->post('tf002')),8,2),
		          'tf003' => $this->input->post('tf003'),
				  'tf004' => $this->input->post('tf004'),
                  'tf005' => $this->input->post('tf005'),
				  'tf006' => $this->input->post('tf006'),
				  'tf007' => $this->input->post('tf007'),
                  'tf008' => $this->input->post('tf008'),
				  'tf009' => $this->input->post('tf009'),
				  'tf010' => $this->input->post('tf010'),
                  'tf011' => $this->input->post('tf011'),
				  'tf012' => $this->input->post('tf012'),
				  'tf013' => $this->input->post('tf013'),
                  'tf014' => $this->input->post('tf014'),
				  'tf015' => $this->input->post('tf015'),
				  'tf016' => $this->input->post('tf016'),
				  'tf017' => "Y"
				   
                      );
         
	    $exist = $this->pali53_model->selone1($this->input->post('palq01a'),$tf002);
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('paltf', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seg4)    
       { 	
		 $this->db->where('tf001',$seg2);
		 $this->db->where('tf002',$seg4);
	    $query = $this->db->get('paltf');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('tf001o');    
	    $seq2=$this->input->post('tf001c');
    	$seq3=substr($this->input->post('tf002o'),0,4).substr($this->input->post('tf002o'),5,2).substr($this->input->post('tf002o'),8,2);    
	    $seq4=substr($this->input->post('tf002c'),0,4).substr($this->input->post('tf002c'),5,2).substr($this->input->post('tf002c'),8,2);
		
	    $this->db->where('tf001', $seq1); 
	    $this->db->where('tf002', $seq3);
	    $query = $this->db->get('paltf');
	//    $exist = $query->num_rows();
   //     if (!$exist)
	//      {
	//	   return 'exist';
	//      }         		
   //     if ($query->num_rows() != 1) { return 'exist'; }
		if ($query->num_rows() == 1) 
		  {
		   $result = $query->result();
		   foreach($result as $row):
		        $tf002=$row->tf002;
				$tf003=$row->tf003;
                $tf004=$row->tf004;
                $tf005=$row->tf005;
				$tf006=$row->tf006;
                $tf007=$row->tf007;
                $tf008=$row->tf008;
				$tf009=$row->tf009;
                $tf010=$row->tf010;
                $tf011=$row->tf011;
                $tf012=$row->tf012; 
				$tf013=$row->tf013;
                $tf014=$row->tf014;
                $tf015=$row->tf015; 
				$tf016=$row->tf016; 
	 	  endforeach;
	      } 
         //   $seq2=$this->input->post('tf001c');    //主鍵一筆
	     //   $seq4=$this->input->post('tf002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'tf001' => $seq2,
		          'tf002' => $seq4,
		          'tf003' => $tf003,
		          'tf004' => $tf004,
		          'tf005' => $tf005,
				  'tf006' => $tf006,
				  'tf007' => $tf007,
		          'tf008' => $tf008,
		          'tf009' => $tf009,
				  'tf010' => $tf010,
				  'tf011' => $tf011,
		          'tf012' => $tf012,
		          'tf013' => $tf013,
				  'tf014' => $tf014,
				  'tf015' => $tf015,
				  'tf016' => $tf016,
				  'tf017' => "Y"
                 			  
                    );
            $exist = $this->pali53_model->selone2($seq2,$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('paltf', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('tf001o');    //查詢一筆以上
	    $seq2=$this->input->post('tf001c'); 
	    $seq3=substr($this->input->post('tf002o'),0,4).substr($this->input->post('tf002o'),5,2).substr($this->input->post('tf002o'),8,2);    
	    $seq4=substr($this->input->post('tf002c'),0,4).substr($this->input->post('tf002c'),5,2).substr($this->input->post('tf002c'),8,2);
		 
	    $sql1 = " SELECT a.tf001,b.mv002 as tf001disp,b.mv004 as tf001disp1,c.me002 as tf001disp2,a.tf002,a.tf003, a.tf010,a.tf011,a.tf012,a.tf013,a.tf014,a.tf015,a.tf016 "; 
		$sql2 = " FROM paltf as a LEFT JOIN cmsmv as b ON a.tf001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 "; 
		$sql3 = " WHERE a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND a.tf002 >= '$seq3' AND a.tf002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
		
        $query = $this->db->query($sql);
		
		$result = $query->result_array();
		$week_ary = array('0'=>"日",'1'=>"一",'2'=>"二",'3'=>"三",'4'=>"四",'5'=>"五",'6'=>"六");
		$t_tf010 = 0;$t_tf011 = 0;$t_tf012 = 0;$t_tf013 = 0;$t_tf014 = 0;$t_tf015 = 0;
		foreach($result as $key=>$val){
			$t_tf010 += $val['tf010'];
			$t_tf011 += $val['tf011'];
			$t_tf012 += $val['tf012'];
			$t_tf013 += $val['tf013'];
			$t_tf014 += $val['tf014'];
			$t_tf015 += $val['tf015'];
			$result[$key]['tf003'] = $week_ary[$result[$key]['tf003']];
		}
		$add_ary = array(
			'tf001' => $val['tf001'],
			'tf001disp' => $val['tf001disp'],
			'tf001disp1' => $val['tf001disp1'],
			'tf001disp2' => $val['tf001disp2'],
			'total' => "總和:",
			'tf003' => "",
			'tf010' => $t_tf010,
			'tf011' => $t_tf011,
			'tf012' => $t_tf012,
			'tf013' => $t_tf013,
			'tf014' => $t_tf014,
			'tf015' => $t_tf015
		);
		$result[] = $add_ary;
		
	    return $result;
       }
	   
	//印明細表	
	function printfd()          
       {
		$seq1=$this->input->post('tf001o');    //查詢一筆以上
	    $seq2=$this->input->post('tf001c'); 
		preg_match_all('/\d/S',$this->input->post('tf002o'), $matches);  //處理日期字串
		$seq3 = implode('',$matches[0]);
		preg_match_all('/\d/S',$this->input->post('tf002c'), $matches);  //處理日期字串
		$seq4 = implode('',$matches[0]);
		/*
	    $seq3=substr($this->input->post('tf002o'),0,4).substr($this->input->post('tf002o'),5,2).substr($this->input->post('tf002o'),8,2);    
	    $seq4=substr($this->input->post('tf002c'),0,4).substr($this->input->post('tf002c'),5,2).substr($this->input->post('tf002c'),8,2);
		 */
	    $sql1 = " SELECT a.*,b.mv002 as tf001disp,b.mv004 as tf001disp1,c.me002 as tf001disp2 "; 
		$sql2 = " FROM paltf as a LEFT JOIN cmsmv as b ON  a.tf001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 "; 
		$sql3 = " WHERE a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND  a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' "; 
		$sql3 = "";
		$where_str = "";
		if($seq1 || $seq2 || $seq3 || $seq4){
			$sql3 = " WHERE ";
			if($seq1){
				if($where_str){
					$where_str .= " AND ";
				}
				$where_str .= "a.tf001 >= '".$seq1."'";
			}
			if($seq2){
				if($where_str){
					$where_str .= " AND ";
				}
				$where_str .= "a.tf001 <= '".$seq2."'";
			}
			if($seq3){
				if($where_str){
					$where_str .= " AND ";
				}
				$where_str .= "a.tf002 >= '".$seq3."'";
			}
			if($seq4){
				if($where_str){
					$where_str .= " AND ";
				}
				$where_str .= "a.tf002 <= '".$seq4."'";
			}
			$sql3 .= $where_str;
		}
		
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
		/*此段為判斷是否國定假日，其他功能不用，可直接砍掉*/
		foreach($ret['rows'] as $key => $val){
			if($this->check_holiday($val->tf002)){
				$ret['rows'][$key]->holiday = 1;
			}else{
				$ret['rows'][$key]->holiday = 0;
			}
		}
		
        $seq32 = $where_str;
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
			->from('paltf as a')
			->where($seq32);
	    $num = $query->get()->result();
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
			preg_match_all('/\d/S',$this->input->post('tf002'), $matches);  //處理日期字串
			$tf002 = implode('',$matches[0]);
			/*$tf002=substr($this->input->post('tf002'),0,4).substr($this->input->post('tf002'),5,2).substr(rtrim($this->input->post('tf002')),8,2);
			$tf003=substr($this->input->post('tf003'),0,2).substr($this->input->post('tf003'),3,2);*/	
		   $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				 'tf003' => $this->input->post('tf003'),
				  'tf004' => $this->input->post('tf004'),
                  'tf005' => $this->input->post('tf005'),
				  'tf006' => $this->input->post('tf006'),
				  'tf007' => $this->input->post('tf007'),
                  'tf008' => $this->input->post('tf008'),
				  'tf009' => $this->input->post('tf009'),
				  'tf010' => $this->input->post('tf010'),
                  'tf011' => $this->input->post('tf011'),
				  'tf012' => $this->input->post('tf012'),
				  'tf013' => $this->input->post('tf013'),
                  'tf014' => $this->input->post('tf014'),
				  'tf015' => $this->input->post('tf015'),
				  'tf016' => $this->input->post('tf016'),
				  'tf017' => "Y"
                        );
			
            $this->db->where('tf001', $this->input->post('palq01a'));
	        $this->db->where('tf002', $tf002);
            $this->db->update('paltf',$data);                   //更改一筆
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
	    $this->db->where('tf001', $seg1);
        $this->db->delete('paltf'); 
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
			 
			  $this->db->where('tf001', $seq1);
			  $this->db->where('tf002', $seq2);
			  
              $this->db->delete('paltf'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
		
	function check_holiday($seq1){
		preg_match_all('/\d/S',$seq1, $matches);
		$seq1 = implode('',$matches[0]);
		$seq_1=substr($seq1,0,4);$seq_2=substr($seq1,4,4);
		$this->db->select('*');
		$this->db->from('palms');
		$this->db->where('ms001', $seq_1);
		$this->db->where('ms002', $seq_2);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
		   return true;
		}
		else{
			return false;
		}
	}
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>