<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moci02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta0011, ta0019,ta020, create_date');
          $this->db->from('mocta');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('mocta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta005', 'ta021', 'ta031','ta019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002, ta003, ta006,b.mb002 as ta006disp,b.mb003 as ta006disp1, ta015, ta011, a.create_date')
	                       ->from('mocta as a')
						   ->join('invmb as b', 'a.ta006 = b.mb001 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('mocta');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('moci02_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['moci02']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['moci02']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "ta001 asc,ta002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['moci02']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['moci02']['search']['where'];
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
				$value .= $val." like '".$val_ary[$key]."%' ";  //%% 合部搜尋 先一個 like '%
			}
			$where .= "(".$value.")";
		}
		
		if($func == "or_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " or ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " or ";}
				$value .= $val." like '".$val_ary[$key]."%' ";
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
		
		if(isset($_SESSION['moci02']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['moci02']['search']['order'];
		}
		
		if(!isset($_SESSION['moci02']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('ta001, ta002, ta003,d.mq002, ta006,b.mb002 as ta006disp,b.mb003 as ta006disp1, ta015, ta011, a.create_date')
	                       ->from('mocta as a')
						   ->join('invmb as b', 'a.ta006 = b.mb001 ','left')
						   ->join('cmsmq as d', 'a.ta001 = d.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('ta001, ta002, ta003,d.mq002, ta006,b.mb002 as ta006disp,b.mb003 as ta006disp1, ta015, ta011, a.create_date')
	                       ->from('mocta as a')
						   ->join('invmb as b', 'a.ta006 = b.mb001 ','left')
						   ->join('cmsmq as d', 'a.ta001 = d.mq001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['moci02']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('mocta as a')
			->join('invmb as b', 'a.ta006 = b.mb001 ','left')
		    ->join('cmsmq as d', 'a.ta001 = d.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['moci02']['search']['where'] = $where;
		$_SESSION['moci02']['search']['order'] = $order;
		$_SESSION['moci02']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"ta001","ta002"
		);
		$view_array = array();
		$index_array = array();
		
		foreach($data as $key => $val){
			$key_str = "";
			foreach($pk_array as $pk_k => $pk_v){
				if($key_str){
					$key_str .= "_";
				}$key_str .= $val->$pk_v;
			}
			$view_array[$key_str] = $key;
			$index_array[$key] = $key_str;
		}
		$_SESSION['moci02']['search']['view'] = $view_array;
		$_SESSION['moci02']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['moci02']['search']['view']);exit;
	}		
	//查詢前置單據用 ()   
	function selonebefore($seq1,$seq2)    
        {
		  $this->db->select('a.* ,d.mb002 as md001disp,d.mb003 as md001disp1,d.mb004 as md001disp2,b.md001,b.md002,b.md003,b.md004,b.md006,b.md007,b.md008,b.md016,b.md017,c.mb002 as md003disp, c.mb003 as md003disp1, c.mb004 as md003disp2');
		 
        $this->db->from('bommc as a');	
        $this->db->join('bommd as b', 'a.mc001 = b.md001  ','left'); //沒有不要出現		
		$this->db->join('invmb  as c','b.md003 = c.mb001  ','left');
		
	    $this->db->join('invmb  as d','a.mc001 = d.mb001  ','left');
		$this->db->where('a.mc001', $this->uri->segment(4)); 
		$this->db->order_by('md001 , md002, md003 ');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//查詢修改用 (看資料用)  單別,品號 , 廠別, 庫別, 線別, 加工廠商, 品號,庫别2,幣別
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,a.ta034 as ta006disp,a.ta035 as ta006disp1,a.ta007 as ta006disp2,c.mq002 AS ta001disp, d.mb002 AS ta019disp,e.mc002 AS ta020disp, g.ma002 AS ta032disp,j.mq002 as ta026disp
		  ,h.mc002 AS tb009disp,i.mf002 as ta042disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016, b.tb017, b.tb018,b.tb019,b.tb020,b.tb021');
		 
        $this->db->from('mocta as a');	
        $this->db->join('moctb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="51" ','left');
	    $this->db->join('cmsmb as d', 'a.ta019 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.ta020 = e.mc001 ','left');
		$this->db->join('cmsmd as f', 'a.ta021 = f.md001 ','left');
		$this->db->join('purma as g', 'a.ta032 = g.ma001 ','left');
		$this->db->join('cmsmc as h', 'b.tb009 = h.mc001 ','left');
		$this->db->join('cmsmf as i', 'a.ta042 = i.mf001 ','left');
		$this->db->join('cmsmq as j', 'a.ta026 = j.mq001 and j.mq003="22"' ,'left');
		$this->db->where('a.ta001', $seq1); 
	    $this->db->where('a.ta002', $seq2); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*,i.mc002 as tb009disp,k.mw002 as tb006disp')
			->from('moctb as b')
			->join('cmsmc as i', 'b.tb009 = i.mc001 ','left')   //庫別
			->join('cmsmw as k', 'b.tb006 = k.mw001 ','left')   //製程
			->where('b.tb001', $seq1)
			->where('b.tb002', $seq2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	規格單位庫別代號名稱
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004,mb017,b.mc002 as mb017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ','left'); 
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('mc001, mc002')->from('cmsmc');  
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
	//ajax 查詢 顯示 請購單別 tb001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '31');
          $this->db->where('mq001', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsmq');
			
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
	function ajaxcmsq05a($seg1)    
        {
	      $this->db->where('me001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsme');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->me002;
              }
		   return $result;   
		  }
	    }
		
	//ajax 查詢顯示用 廠別 ta010  
	function ajaxcmsq02a($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmb');
			
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
	      $query = $this->db->get('cmsmv');
			
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
		
	//ajax 查詢 顯示用 製令單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('ta002');
		  $this->db->where('ta001', $this->uri->segment(4));
	      $this->db->where('ta003', $this->uri->segment(5));
		  $query = $this->db->get('mocta');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ta002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `mocta` ";
	      $seq1 = "ta001, ta002, ta003, ta004, ta005, ta006,ta007,ta08,ta010,ta011,ta021,ta031,ta019,ta015, create_date FROM `mocta` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'ta001 desc' ;
          $seq9 = " ORDER BY ta001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="ta001 ";

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
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta005', 'ta006','ta007','ta008','ta010','ta011','ta021','ta031','ta019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002,d.mq002, ta003, ta004, ta006,b.ma002 as ta006disp,b.ma003 as ta006disp1,b.ma004 as ta006disp2,ta015,ta011, a.create_date')
	                       ->from('mocta as a')
						  ->join('purma as b', 'a.ta006 = b.ma001 ','left')
						  ->join('cmsmq as d', 'a.ta001 = d.mq001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('mocta as a')
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
	      $sort_columns = array('ta001', 'ta002', 'ta003', 'ta005', 'ta021', 'ta031','ta019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('ta001, ta002,d.mq002, ta003, ta006,b.ma002 as ta006disp,b.ma003 as ta006disp1,b.ma004 as ta006disp2, ta015, ta011, a.create_date');
	      $this->db->from('mocta as a');
		  $this->db->join('purma as b', 'a.ta006 = b.ma001 ','left');
		  $this->db->join('cmsmq as d', 'a.ta001 = d.mq001','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('mocta');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('ta001', $seg1);
		  $this->db->where('ta002', $seg2);
	      $query = $this->db->get('mocta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tb001', $this->input->post('mocq01a51'));
		  $this->db->where('tb002', $this->input->post('ta002'));
	      $query = $this->db->get('moctb');
	      return $query->num_rows() ;
	    }  
    //查新增資料是否重複 (庫別)	
    function selone2d($seg1,$seg2)    
        {
	      $this->db->where('mc001', $seg1);
		  $this->db->where('mc002', $seg2);
	      $query = $this->db->get('invmc');
	      return $query->num_rows() ;
	    }  			
		
	 //查採購單是否存在 	
    function selone3d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tb001', $seg1);
		  $this->db->where('tb002', $seg2);
		  $this->db->where('tb003', $seg3);
	      $query = $this->db->get('moctb');
	      return $query->num_rows() ;
	    }  		
 		
	//新增一筆 檔頭  mocta	
	function insertf()    //新增一筆 檔頭  mocta
        {
		     preg_match_all('/\d/S',$this->input->post('ta003'), $matches);  //處理日期字串
			 $ta003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta004'), $matches);  //處理日期字串
			 $ta004 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta009'), $matches);  //處理日期字串
			 $ta009 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta010'), $matches);  //處理日期字串
			 $ta010 = implode('',$matches[0]);
             preg_match_all('/\d/S',$this->input->post('ta012'), $matches);  //處理日期字串
			 $ta012 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta014'), $matches);  //處理日期字串
			 $ta014 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta040'), $matches);  //處理日期字串
			 $ta040 = implode('',$matches[0]);			 
			 $ta001=$this->input->post('ta001');
			 $ta002=$this->input->post('ta002');
			 $ta002no=$ta002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->moci02_model->selone1($ta001,$ta002)>0){
				$ta002 = $this->check_title_no($ta001,$ta003);
				$ta002no=$ta002;
			}
			$data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $this->input->post('ta001'),
		         'ta002' => $this->input->post('ta002'),
		         'ta003' => $ta003,
		         'ta004' => $ta004,
		         'ta005' => $this->input->post('ta005'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $ta009,
                 'ta010' => $ta010,		
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $ta012,
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $ta014,	
                 'ta015' => $this->input->post('ta015'),	
                 'ta016' => $this->input->post('ta016'),
                 'ta017' => $this->input->post('ta017'),
                 'ta018' => $this->input->post('ta018'),
                 'ta019' => $this->input->post('ta019'),
                 'ta020' => $this->input->post('ta020'),
                 'ta021' => $this->input->post('ta021'),
				 'ta022' => $this->input->post('ta022'),
				 'ta023' => $this->input->post('ta023'),
                 'ta024' => $this->input->post('ta024'),
                 'ta025' => $this->input->post('ta025'),
                 'ta026' => $this->input->post('ta026'),
                 'ta027' => $this->input->post('ta027'),
                 'ta028' => $this->input->post('ta028'),
                 'ta029' => $this->input->post('ta029'),
                 'ta030' => $this->input->post('ta030'),
				 'ta031' => $this->input->post('ta031'),
				 'ta032' => $this->input->post('ta032'),
		         'ta033' => $this->input->post('ta033'),
				 'ta034' => $this->input->post('ta034'),
				 'ta035' => $this->input->post('ta035'),
                 'ta036' => $this->input->post('ta036'),
                 'ta037' => $this->input->post('ta037'),
                 'ta038' => $this->input->post('ta038'),
                 'ta039' => $this->input->post('ta039'),
		    	 'ta040' => $ta040,
				 'ta041' => $this->input->post('ta041'),
				 'ta042' => $this->input->post('ta042'),
		         'ta043' => $this->input->post('ta043'),
				 'ta044' => $this->input->post('ta044'),
				 'ta045' => $this->input->post('ta045'),
                 'ta046' => $this->input->post('ta046'),
                 'ta047' => $this->input->post('ta047'),
                 'ta048' => $this->input->post('ta048'),
                 'ta049' => $this->input->post('ta049')
                 
                );
         
	      $this->db->insert('mocta', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
			
		// 新增明細 moctb
		  $vtb008='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['tb008'] && $val['tb003']){
				        extract($val);
						//preg_match_all('/\d/S',$tb012, $matches);  //處理日期字串
			           //$tb012 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tb001' => $ta001,
							'tb002' => $ta002no
						);
						foreach($val as $k=>$v){
							if($k!="tb001"&&$k!="tb002"&&$k!="tb009disp"&&$k!="tb006disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tb008") {$data[$k] = $vtb008;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('moctb', $data);
					$mtb008 = (int) $vtb008+10;
			        $vtb008 =  (string)$mtb008;
				}
			}
		 }
	 function auto_print($seg1,$seg2){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$seg1);	
		$query = $this->db->get();
		$tmp = $query->result();
		if(@$tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$seg1."/".$seg2.".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('mocta');
	      return $query->num_rows() ; 
	    }
		  
	//複製前置單據	
    function copybefore()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('mocta');
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
                $ta003=$row->ta003;$ta004=$row->ta004;$ta005=$row->ta005;$ta006=$row->ta006;$ta007=$row->ta007;$ta008=$row->ta008;$ta009=$row->ta009;$ta010=$row->ta010;
				$ta011=$row->ta011;$ta012=$row->ta012;$ta013=$row->ta013;$ta014=$row->ta014;$ta015=$row->ta015;$ta016=$row->ta016;
				$ta017=$row->ta017;$ta018=$row->ta018;$ta019=$row->ta019;$ta020=$row->ta020;$ta021=$row->ta021;$ta022=$row->ta022;
				$ta023=$row->ta023;$ta024=$row->ta024;$ta025=$row->ta025;$ta026=$row->ta026;$ta027=$row->ta027;$ta028=$row->ta028;
				$ta029=$row->ta029;$ta030=$row->ta030;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭mocta
			$seq2=$this->input->post('ta002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ta001' => $seq1,'ta002' => $seq2,'ta003' => $ta003,'ta004' => $ta004,'ta005' => $ta005,'ta006' => $ta006,'ta007' => $ta007,'ta008' => $ta008,'ta009' => $ta009,'ta010' => $ta010,
		           'ta011' => $ta011,'ta012' => $ta012,'ta013' => $ta013,'ta014' => $ta014,'ta015' => $ta015,'ta016' => $ta016,'ta017' => $ta017,
				   'ta018' => $ta018,'ta019' => $ta019,'ta020' => $ta020,'ta021' => $ta021,'ta022' => $ta022,'ta023' => $ta023,'ta024' => $ta024,
				   'ta025' => $ta025,'ta026' => $ta026,'ta027' => $ta027,'ta028' => $ta028,'ta029' => $ta029,'ta030' => $ta030
                   );
				   
            $exist = $this->moci02_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('mocta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('moctb');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         
			    $num=$query->num_rows();
          //  if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() >= 1) 
		       {
			     $result = $query->result();
				 $i=0;
			     foreach($result as $row):
                 $tb003[$i]=$row->tb003;$tb004[$i]=$row->tb004;$tb005[$i]=$row->tb005;$tb006[$i]=$row->tb006;$tb007[$i]=$row->tb007;
				 $tb008[$i]=$row->tb008;$tb009[$i]=$row->tb009;$tb010[$i]=$row->tb010;$tb011[$i]=$row->tb011;$tb012[$i]=$row->tb012;
				 $tb013[$i]=$row->tb013;$tb014[$i]=$row->tb014;$tb015[$i]=$row->tb015;$tb016[$i]=$row->tb016;$tb017[$i]=$row->tb017;
				 $tb018[$i]=$row->tb018;$tb019[$i]=$row->tb019;$tb020[$i]=$row->tb020;$tb021[$i]=$row->tb021;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細moctb
			$seq2=$this->input->post('ta002c'); 
              $i=0;
            while ($i<$num) {	
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                'tb001' => $seq1,'tb002' => $seq2,'tb003' => $tb003[$i],'tb004' => $tb004[$i],'tb005' => $tb005[$i],'tb006' => $tb006[$i],'tb007' => $tb007[$i],
		         'tb008' => $tb008[$i],'tb009' => $tb009[$i],'tb010' => $tb010[$i],'tb011' => $tb011[$i],'tb012' => $tb012[$i],'tb013' => $tb013[$i],
				 'tb014' => $tb014[$i],'tb015' => $tb015[$i],'tb016' => $tb016[$i],'tb017' => $tb017[$i],'tb018' => $tb018[$i],'tb019' => $tb019[$i],
				 'tb020' => $tb020[$i],'tb021' => $tb021[$i]
                ); 
				
             $this->db->insert('moctb', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('mocta');
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
                $ta003=$row->ta003;$ta004=$row->ta004;$ta005=$row->ta005;$ta006=$row->ta006;$ta007=$row->ta007;$ta008=$row->ta008;$ta009=$row->ta009;$ta010=$row->ta010;
				$ta011=$row->ta011;$ta012=$row->ta012;$ta013=$row->ta013;$ta014=$row->ta014;$ta015=$row->ta015;$ta016=$row->ta016;
				$ta017=$row->ta017;$ta018=$row->ta018;$ta019=$row->ta019;$ta020=$row->ta020;$ta021=$row->ta021;$ta022=$row->ta022;
				$ta023=$row->ta023;$ta024=$row->ta024;$ta025=$row->ta025;$ta026=$row->ta026;$ta027=$row->ta027;$ta028=$row->ta028;
				$ta029=$row->ta029;$ta030=$row->ta030;
				$ta031=$row->ta031;$ta032=$row->ta032;$ta033=$row->ta033;$ta034=$row->ta034;$ta035=$row->ta035;$ta036=$row->ta036;
				$ta037=$row->ta037;$ta038=$row->ta038;$ta039=$row->ta039;$ta040=$row->ta040;$ta041=$row->ta041;$ta042=$row->ta042;$ta043=$row->ta043;
				$ta044=$row->ta044;$ta045=$row->ta045;$ta046=$row->ta046;$ta047=$row->ta047;$ta048=$row->ta048;$ta049=$row->ta049;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭mocta
			$seq2=$this->input->post('ta002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ta001' => $seq1,'ta002' => $seq2,'ta003' => $ta003,'ta004' => $ta004,'ta005' => $ta005,'ta006' => $ta006,'ta007' => $ta007,'ta008' => $ta008,'ta009' => $ta009,'ta010' => $ta010,
		           'ta011' => $ta011,'ta012' => $ta012,'ta013' => $ta013,'ta014' => $ta014,'ta015' => $ta015,'ta016' => $ta016,'ta017' => $ta017,
				   'ta018' => $ta018,'ta019' => $ta019,'ta020' => $ta020,'ta021' => $ta021,'ta022' => $ta022,'ta023' => $ta023,'ta024' => $ta024,
				   'ta025' => $ta025,'ta026' => $ta026,'ta027' => $ta027,'ta028' => $ta028,'ta029' => $ta029,'ta030' => $ta030,
				   'ta031' => $ta031,'ta032' => $ta032,'ta033' => $ta033,'ta034' => $ta034,'ta035' => $ta035,'ta036' => $ta036,'ta037' => $ta037,
				   'ta038' => $ta038,'ta039' => $ta039,'ta040' => $ta040,'ta041' => $ta041,'ta042' => $ta042,'ta043' => $ta043,
				   'ta044' => $ta044,'ta045' => $ta045,'ta046' => $ta046,'ta047' => $ta047,'ta048' => $ta048,'ta049' => $ta049
                   );
				   
            $exist = $this->moci02_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('mocta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('moctb');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         
			    $num=$query->num_rows();
          //  if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() >= 1) 
		       {
			     $result = $query->result();
				 $i=0;
			     foreach($result as $row):
                 $tb003[$i]=$row->tb003;$tb004[$i]=$row->tb004;$tb005[$i]=$row->tb005;$tb006[$i]=$row->tb006;$tb007[$i]=$row->tb007;
				 $tb008[$i]=$row->tb008;$tb009[$i]=$row->tb009;$tb010[$i]=$row->tb010;$tb011[$i]=$row->tb011;$tb012[$i]=$row->tb012;
				 $tb013[$i]=$row->tb013;$tb014[$i]=$row->tb014;$tb015[$i]=$row->tb015;$tb016[$i]=$row->tb016;$tb017[$i]=$row->tb017;
				 $tb018[$i]=$row->tb018;$tb019[$i]=$row->tb019;$tb020[$i]=$row->tb020;$tb021[$i]=$row->tb021;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細moctb
			$seq2=$this->input->post('ta002c'); 
              $i=0;
            while ($i<$num) {	
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                'tb001' => $seq1,'tb002' => $seq2,'tb003' => $tb003[$i],'tb004' => $tb004[$i],'tb005' => $tb005[$i],'tb006' => $tb006[$i],'tb007' => $tb007[$i],
		         'tb008' => $tb008[$i],'tb009' => $tb009[$i],'tb010' => $tb010[$i],'tb011' => $tb011[$i],'tb012' => $tb012[$i],'tb013' => $tb013[$i],
				 'tb014' => $tb014[$i],'tb015' => $tb015[$i],'tb016' => $tb016[$i],'tb017' => $tb017[$i],'tb018' => $tb018[$i],'tb019' => $tb019[$i],
				 'tb020' => $tb020[$i],'tb021' => $tb021[$i]
                ); 
				
             $this->db->insert('moctb', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
		
	      $seq1=$this->input->post('ta001o');    
	      $seq2=$this->input->post('ta001c');
		  $seq3=$this->input->post('ta002o');    
	      $seq4=$this->input->post('ta002c');	 
         $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta032,a.ta015,a.ta006,c.mb002 as ta006disp,c.mb003 as ta006disp1,a.ta007,
		           b.tb008,b.tb003,b.tb012,b.tb013,b.tb007,b.tb004,b.tb005,b.tb016
		       FROM mocta as a LEFT JOIN moctb as b ON  a.ta001=b.tb001 and a.ta002=b.tb002 and  a.ta001 >= '$seq1'  AND a.ta001 <= '$seq2' AND a.ta002 >= '$seq3'  AND a.ta002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.ta006=c.mb001 "; 
	//	  FROM mocta as a, moctb as b WHERE ta001=tb001 and ta002=tb002 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('ta001o');    
	      $seq2=$this->input->post('ta001c');
		  $seq3=$this->input->post('ta002o');    
	      $seq4=$this->input->post('ta002c');
	      $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta032,a.ta006,c.mb002 as ta006disp, c.mb003 as ta006disp1,a.ta007,
		              b.tb008,b.tb003,b.tb012,b.tb013,b.tb007,b.tb004,b.tb005,b.tb016
		  FROM mocta as a left join moctb as b on a.ta001=b.tb001 and a.ta002=b.tb002 and  a.ta001 >= '$seq1'  AND a.ta001 <= '$seq2' AND a.ta002 >= '$seq3'  AND a.ta002 <= '$seq4' 
		                  left join invmb as c on a.ta006=c.mb001  "; 
						  
	//	  FROM mocta as a, moctb as b WHERE ta001=tb001 and ta002=tb002 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('mocta')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS ta001disp, d.me002 AS ta004disp, e.mb002 AS ta010disp, f.mv002 AS ta012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb011, b.tb009, b.tb017, b.tb018, b.tb012');
		 
        $this->db->from('mocta as a');	
        $this->db->join('moctb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ta004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.ta010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.ta012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
	    $query = $this->db->get('moctb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
         $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta019disp,e.mc002 AS ta020disp, g.ma002 AS ta032disp,j.mq002 as ta026disp
		  ,h.mc002 AS tb009disp,i.mf002 as ta042disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016, b.tb017, b.tb018,b.tb019,b.tb020,b.tb021');
		 
        $this->db->from('mocta as a');	
        $this->db->join('moctb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="51" ','left');
	    $this->db->join('cmsmb as d', 'a.ta019 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.ta020 = e.mc001 ','left');
		$this->db->join('cmsmd as f', 'a.ta021 = f.md001 ','left');
		$this->db->join('purma as g', 'a.ta032 = g.ma001 ','left');
		$this->db->join('cmsmc as h', 'b.tb009 = h.mc001 ','left');
		$this->db->join('cmsmf as i', 'a.ta042 = i.mf001 ','left');
		$this->db->join('cmsmq as j', 'a.ta026 = j.mq001 and j.mq003="22"' ,'left');
		$this->db->where('a.ta001', $this->input->post('ta001o')); 
	    $this->db->where('a.ta002', $this->input->post('ta002o')); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
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
            $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta019disp,e.mc002 AS ta020disp, g.ma002 AS ta032disp,j.mq002 as ta026disp
		  ,h.mc002 AS tb009disp,i.mf002 as ta042disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016, b.tb017, b.tb018,b.tb019,b.tb020,b.tb021');
		 
        $this->db->from('mocta as a');	
        $this->db->join('moctb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="51" ','left');
	    $this->db->join('cmsmb as d', 'a.ta019 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.ta020 = e.mc001 ','left');
		$this->db->join('cmsmd as f', 'a.ta021 = f.md001 ','left');
		$this->db->join('purma as g', 'a.ta032 = g.ma001 ','left');
		$this->db->join('cmsmc as h', 'b.tb009 = h.mc001 ','left');
		$this->db->join('cmsmf as i', 'a.ta042 = i.mf001 ','left');
		$this->db->join('cmsmq as j', 'a.ta026 = j.mq001 and j.mq003="22"' ,'left');
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
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
		   preg_match_all('/\d/S',$this->input->post('ta003'), $matches);  //處理日期字串
			 $ta003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta004'), $matches);  //處理日期字串
			 $ta004 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta009'), $matches);  //處理日期字串
			 $ta009 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta010'), $matches);  //處理日期字串
			 $ta010 = implode('',$matches[0]);
             preg_match_all('/\d/S',$this->input->post('ta012'), $matches);  //處理日期字串
			 $ta012 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta014'), $matches);  //處理日期字串
			 $ta014 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta040'), $matches);  //處理日期字串
			 $ta040 = implode('',$matches[0]);			 
			 $ta001=$this->input->post('ta001');
			 $ta002=$this->input->post('ta002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'ta003' => $ta003,
		         'ta004' => $ta004,
		         'ta005' => $this->input->post('ta005'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $ta009,
                 'ta010' => $ta010,		
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $ta012,
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $ta014,	
                 'ta015' => $this->input->post('ta015'),	
                 'ta016' => $this->input->post('ta016'),
                 'ta017' => $this->input->post('ta017'),
                 'ta018' => $this->input->post('ta018'),
                 'ta019' => $this->input->post('ta019'),
                 'ta020' => $this->input->post('ta020'),
                 'ta021' => $this->input->post('ta021'),
				 'ta022' => $this->input->post('ta022'),
				 'ta023' => $this->input->post('ta023'),
                 'ta024' => $this->input->post('ta024'),
                 'ta025' => $this->input->post('ta025'),
                 'ta026' => $this->input->post('ta026'),
                 'ta027' => $this->input->post('ta027'),
                 'ta028' => $this->input->post('ta028'),
                 'ta029' => $this->input->post('ta029'),
                 'ta030' => $this->input->post('ta030'),
				 'ta031' => $this->input->post('ta031'),
				 'ta032' => $this->input->post('ta032'),
		         'ta033' => $this->input->post('ta033'),
				 'ta034' => $this->input->post('ta034'),
				 'ta035' => $this->input->post('ta035'),
                 'ta036' => $this->input->post('ta036'),
                 'ta037' => $this->input->post('ta037'),
                 'ta038' => $this->input->post('ta038'),
                 'ta039' => $this->input->post('ta039'),
		    	 'ta040' => $ta040,
				 'ta041' => $this->input->post('ta041'),
				 'ta042' => $this->input->post('ta042'),
		         'ta043' => $this->input->post('ta043'),
				 'ta044' => $this->input->post('ta044'),
				 'ta045' => $this->input->post('ta045'),
                 'ta046' => $this->input->post('ta046'),
                 'ta047' => $this->input->post('ta047'),
                 'ta048' => $this->input->post('ta048'),
                 'ta049' => $this->input->post('ta049')
                );
            $this->db->where('ta001', $ta001); //單別
			$this->db->where('ta002', $ta002);
            $this->db->update('mocta',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('tb001', $ta001);
					$this->db->where('tb002', $ta002);
					$this->db->delete('moctb'); //刪除明細 1060809 
			
		//	$this->db->flush_cache();  
			// 新增明細 moctb
			$vtb008='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				//preg_match_all('/\d/S',$tb012, $matches);  //處理日期字串
			    //$tb012 = implode('',$matches[0]);
				if($this->seldetail($ta001,$ta002,$val['tb008'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="tb001"&&$k!="tb002"&&$k!="tb009disp" &&$k!="tb006disp"){//主鍵不用更改以及其他外來鍵庫別名稱 tb013日期等別處理
							if($k=="tb008") {$data[$k] = $vtb008;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('tb001', $ta001);
					$this->db->where('tb002', $ta002);
					$this->db->where('tb008', $vtb008);
					$this->db->update('moctb',$data);//更改一筆
					$mtb008 = (int) $vtb008+10;
			        $vtb008 =  (string)$mtb008;
				}else{
					if($val['tb008'] && $val['tb003']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tb001' => $ta001,
							'tb002' => $ta002
						);
						foreach($val as $k=>$v){
							if($k!="tb001"&&$k!="tb002"&&$k!="tb009disp" &&$k!="tb006disp"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="tb008") {$data[$k] = $vtb008;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('moctb', $data);
						$mtb008 = (int) $vtb008+10;
			            $vtb008 =  (string)$mtb008;
					}
				}
				
			}
	
        }
		//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('tb001', $seg1);
			$this->db->where('tb002', $seg2);
	        $this->db->where('tb008', $seg3);
	        $query = $this->db->get('moctb');
	        return $query->num_rows() ; 
	    }	
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('mocta'); 
		  $this->db->where('tb001', $this->uri->segment(4));
		  $this->db->where('tb002', $this->uri->segment(5));
          $this->db->delete('moctb'); 
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
          $seq3=' ';		  
	    if (!empty($_POST['selected'])) 
	         {
                foreach($_POST['selected'] as $check) 
			    {
			      $seq[$x] = $check; 
		    	      list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
					  $seq3;
					 if ($seq3 == '1') {  
				//由製造命令 1未生產 		  
		 
			        $i='0';
			      $this->db->where('ta001', $seq1);
			      $this->db->where('ta002', $seq2);
                  $this->db->delete('mocta'); 
				  $this->db->where('tb001', $seq1);
			      $this->db->where('tb002', $seq2);
					 $this->db->delete('moctb'); $this->session->set_userdata('msg1',"未生產已刪除"); }
					 else {$this->session->set_userdata('msg1',"已生產不可刪除");}
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	
	function check_detail_num($tb001,$tb002){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('moctb')
				->where('tb001',$tb001)
				->where('tb002',$tb002);
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data($tb001,$tb002){
		
		$query = $this->db->select('*')
				->from('moctb')
				->where('tb001',$tb001)
				->where('tb002',$tb002);
				
		$data = $query->get()->result();
		
		return $data;		
	}
   //取單號 最大值加1
	function check_title_no($moci01,$ta003){
		preg_match_all('/\d/S',$ta003, $matches);  //處理日期字串
		$ta003 = implode('',$matches[0]);
		$this->db->select('MAX(ta002) as max_no')
			->from('mocta')
			->where('ta001', $moci01)
		//	->where('ta024', $ta024);
			->like('ta003', $ta003, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $ta003."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>