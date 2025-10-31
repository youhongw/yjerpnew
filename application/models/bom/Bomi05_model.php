<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bomi05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('td001, td002, td003, td004, td005, td006,td008,td010,td011,td013, create_date');
          $this->db->from('bomtd');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('td001 desc, td002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('bomtd');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.td001, a.td002, a.td003, a.td004,b.ma002 as td004disp, a.td005, a.td007,a.create_date')
	                       ->from('bomtd as a')
						   ->join('purma as b', 'a.td004 = b.ma001 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomtd');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('bomi05_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['bomi05']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['bomi05']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "td002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['bomi05']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['bomi05']['search']['where'];
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
		
		if(isset($_SESSION['bomi05']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['bomi05']['search']['order'];
		}
		
		if(!isset($_SESSION['bomi05']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,c.mq002,b.mb002,b.mb003,c.mq002 as td001disp,b.mb002 as td004disp,b.mb003 as td004disp1')
	                       ->from('bomtd as a')
						   ->join('invmb as b', 'a.td004 = b.mb001','left')
						   ->join('cmsmq as c', 'a.td001 = c.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,c.mq002,b.mb002,b.mb003,c.mq002 as td001disp,b.mb002 as td004disp,b.mb003 as td004disp1')
	                       ->from('bomtd as a')
						   ->join('invmb as b', 'a.td004 = b.mb001','left')
						   ->join('cmsmq as c', 'a.td001 = c.mq001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['bomi05']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('bomtd as a')
		    ->join('invmb as b', 'a.td004 = b.mb001','left')
			->join('cmsmq as c', 'a.td001 = c.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['bomi05']['search']['where'] = $where;
		$_SESSION['bomi05']['search']['order'] = $order;
		$_SESSION['bomi05']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"td001","td002"
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
		$_SESSION['bomi05']['search']['view'] = $view_array;
		$_SESSION['bomi05']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['bomi05']['search']['view']);exit;
	}		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td004disp,d.mb003 AS td004disp1, e.mc002 AS td010disp,
		  f.mb002 as te004disp,f.mb003 as te004disp1,g.mc002 as te007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007,b.te008,b.te009,b.te010, b.te011, b.te012, b.te013');
		 
        $this->db->from('bomtd as a');	
        $this->db->join('bomte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001  ','left');
		$this->db->join('invmb as d', 'a.td004 = d.mb001 ','left');		
	    $this->db->join('cmsmc as e', 'a.td010 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.te004 = f.mb001 ','left');		
	    $this->db->join('cmsmc as g', 'b.te007 = g.mc001 ','left');
		$this->db->where('a.td001', $seq1); 
	    $this->db->where('a.td002', $seq2); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*,c.mc002 as te007disp,d.mb002 as te004disp,d.mb003 as te004disp1')
			->from('bomte as b')
			->join('cmsmc as c', 'b.te007 = c.mc001 ','left')   //庫別
			->join('invmb as d', 'b.te004 = d.mb001 ','left')
			->where('b.te001', $seq1)
			->where('b.te002', $seq2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
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
		
	//ajax 查詢 顯示 請購單別 te001	
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
		
	//ajax 查詢顯示用 廠別 td010  
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
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1,$seg2)    
        { 	              
	      $this->db->select_max('td002');
		  $this->db->where('td001', $this->uri->segment(4));
	      $this->db->where('td010', $this->uri->segment(5));
		  $query = $this->db->get('bomtd');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `bomtd` ";
	      $seq1 = "td001, td002, td003, td004, td005,td006, td010, a.create_date FROM `bomtd` as a ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'td001 desc' ;
          $seq9 = " ORDER BY td001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
         $seq7="td001 ";

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
	     $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','td007','td008','td010','td011','td021','td031','td019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('td001, td002, td003, td004,c.mq002,c.mq002 as td001disp,b.mb002,b.mb003,b.mb002 as td004disp,b.mb003 as td004disp1, td005, td006,td007,td010,td008,td010,td014, a.create_date')
	                       ->from('bomtd as a')
						  ->join('invmb as b', 'a.td004 = b.mb001 ','left')
						   ->join('cmsmq as c', 'a.td001 = c.mq001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomtd as a')
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
	      $sort_columns = array('td001', 'td002', 'td003', 'td005', 'td021', 'td031','td019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否為 table
	      $this->db->select('td001, td002, td003, td004,c.mq002,c.mq002 as td001disp,b.mb002,b.mb003,b.mb002 as td004disp,b.mb003 as td004disp1,td005, td007, td014, a.create_date');
	      $this->db->from('bomtd as a');
		  $this->db->join('invmb as b', 'a.td004 = b.mb001 ','left');
		  $this->db->join('cmsmq as c', 'a.td001 = c.mq001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('td001 asc, td002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('bomtd');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('td001', $this->input->post('purq04a32'));
		  $this->db->where('td002', $this->input->post('td002'));
	      $query = $this->db->get('bomtd');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('te001', $this->input->post('purq04a32'));
		  $this->db->where('te002', $this->input->post('td002'));
	      $query = $this->db->get('bomte');
	      return $query->num_rows() ;
	    }  	
	//查新增品號廠商資料是否重複 	
    function selone2d($seg1,$seg2,$seg3,$seg4,$seg5)    
        {
	      $this->db->where('mb001', $seg1);
		  $this->db->where('mb002', $seg2);
		  $this->db->where('mb003', $seg3);
		  $this->db->where('mb004', $seg4);
		  $this->db->where('mb014', $seg5);
	      $query = $this->db->get('purmb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  bomtd	
	function insertf()    //新增一筆 檔頭  bomtd
        {
			  preg_match_all('/\d/S',$this->input->post('td003'), $matches);  //處理日期字串
			 $td003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('td014'), $matches);  //處理日期字串
			 $td014 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('td018'), $matches);  //處理日期字串
			 $td018 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('td019'), $matches);  //處理日期字串
			 $td019 = implode('',$matches[0]);
			 
			 $td001=$this->input->post('td001');
			 $td002=$this->input->post('td002');
			 
			 $td004=$this->input->post('td004');
			 $td010=$this->input->post('td010');
			 $td007=$this->input->post('td007');
			 $td201=$this->input->post('td201');
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
		         'td003' => $td003,
		         'td004' => $this->input->post('td004'),
		         'td005' => $this->input->post('td005'),
		         'td006' => $this->input->post('td006'),
                 'td007' => $this->input->post('td007'),
                 'td008' => $this->input->post('td008'),
                 'td009' => $this->input->post('td009'),
                 'td010' => $this->input->post('td010'),	
                 'td011' => $this->input->post('td011'),		
                 'td012' => $this->input->post('td012'),
				 'td013' => $this->input->post('td013'),
				 'td014' => $td014,
				 'td015' => $this->input->post('td015'),
				 'td016' => $this->input->post('td016'),
				 'td017' => $this->input->post('td017'),
				 'td018' => $td018,
				 'td019' => $td019,
				 'td200' => $this->input->post('td200'),
				 'td201' => $this->input->post('td201')
                 
                );
         
	     $td002no=$td002;   //明細用再新增一筆時加1
           //檢查資料是否已存在 若存在加1
			  while($this->bomi05_model->selone1($td001,$td002)>0){
				$td002 = $this->check_title_no($td001,$td014);
				$td002no=$td002;
			}
	     
             $this->db->insert('bomtd', $data);
			 
			 //庫存增加欄位 庫別
				if (@$td004 and @$td010  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$td004','$td010','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存增加				
				if (@$td004 and @$td010 and @$td007 and @$td201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007+'$td007',mc008=mc008+'$td201' WHERE mc001 = '$td004'  AND mc002 = '$td010'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064+'$td007',mb065=mb065+'$td201' WHERE mb001 = '$td004'   "; 
		         $query = $this->db->query($sql84);
					}
				//平均單價MC014
				if (@$td004 and @$td010  ) {
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$td004'  AND mc002 = '$td010' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$td004'  AND mc002 = '$td010' and  mc007<0  "; 
				$query = $this->db->query($sql832);}
				 $td007=0;$td201=0;$td004='';$td010='';
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
			
		// 新增明細 coptb
		  $vte003='1010';		//流水號重新排序
		 foreach($order_product as $key => $val){
		        if($val['te003'] && $val['te004']){
				        extract($val);
					//	preg_match_all('/\d/S',$te014, $matches);  //處理日期字串
			         //   $te014 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'te001' => $td001,
							'te002' => $td002no
						);
						foreach($val as $k=>$v){
							if($k!="te001"&&$k!="te002"&&$k!="te004disp"&&$k!="te004disp1"&&$k!="te007disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="te003") {$data[$k] = $vte003;} else {$data[$k] = $v;} //流水號
							}
						}
					$this->db->insert('bomte', $data);
					$mte003 = (int) $vte003+10;
			        $vte003 =  (string)$mte003;
				}
				preg_match_all('/\d/S',$this->input->post('td014'), $matches);  //處理日期字串
			    $td014 = implode('',$matches[0]);
				
				//庫存增加欄位 庫別
				if (@$te004 and @$te007  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$te004','$te007','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存減少				
				if (@$te004 and @$te007 and @$te008 and @$te201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007+'$te008',mc008=mc008+'$te201' WHERE mc001 = '$te004'  AND mc002 = '$te007'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064+'$te008',mb065=mb065+'$te201' WHERE mb001 = '$te004'   "; 
		         $query = $this->db->query($sql84);
					}
				//平均單價MC014
				if (@$te004 and @$te007  ) {
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$te004'  AND mc002 = '$te007' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$te004'  AND mc002 = '$te007' and  mc007<0  "; 
				$query = $this->db->query($sql832);}
				 $te008=0;$te201=0;$te004='';$te007='';
				
			}
		 }
		 
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('purq04a32'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if(@$tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('purq04a32')."/".$this->input->post('td002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 	 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('td001', $this->input->post('td001c')); 
          $this->db->where('td002', $this->input->post('td002c'));
	      $query = $this->db->get('bomtd');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('td001', $this->input->post('td001o'));
			$this->db->where('td002', $this->input->post('td002o'));
	        $query = $this->db->get('bomtd');
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
                $td003=$row->td003;$td004=$row->td004;$td005=$row->td005;$td006=$row->td006;$td007=$row->td007;$td008=$row->td008;$td009=$row->td009;$td010=$row->td010;
				$td011=$row->td011;$td012=$row->td012;$td013=$row->td013;$td014=$row->td014;$td015=$row->td015;$td016=$row->td016;$td017=$row->td017;$td018=$row->td018;$td019=$row->td019;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('td001c');    //主鍵一筆檔頭bomtd
			$seq2=$this->input->post('td002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'td001' => $seq1,'td002' => $seq2,'td003' => $td003,'td004' => $td004,'td005' => $td005,'td006' => $td006,'td007' => $td007,'td008' => $td008,'td009' => $td009,'td010' => $td010,
		           'td011' => $td011,'td012' => $td012,'td013' => $td013,'td014' => $td014,'td015' => $td015,'td016' => $td016,'td017' => $td017,'td018' => $td018,'td019' => $td019
                   );
				   
            $exist = $this->bomi05_model->selone2($this->input->post('td001c'),$this->input->post('td002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('bomtd', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('te001', $this->input->post('td001o'));
			$this->db->where('te002', $this->input->post('td002o'));
	        $query = $this->db->get('bomte');
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
                 $te003[$i]=$row->te003;$te004[$i]=$row->te004;$te005[$i]=$row->te005;$te006[$i]=$row->te006;$te007[$i]=$row->te007;
				 $te008[$i]=$row->te008;$te009[$i]=$row->te009;$te010[$i]=$row->te010;$te011[$i]=$row->te011;$te012[$i]=$row->te012;
				 $te013[$i]=$row->te013;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('td001c');    //主鍵一筆明細bomte
			$seq2=$this->input->post('td002c'); 
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
                'te001' => $seq1,'te002' => $seq2,'te003' => $te003[$i],'te004' => $te004[$i],'te005' => $te005[$i],'te006' => $te006[$i],'te007' => $te007[$i],
		        'te008' => $te008[$i],'te009' => $te009[$i],'te010' => $te010[$i],'te011' => $te011[$i],'te012' => $te012[$i],
				'te013' => $te013[$i]
                ); 
				
             $this->db->insert('bomte', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('td001o');    
	      $seq2=$this->input->post('td001c');
		  $seq3=$this->input->post('td002o');    
	      $seq4=$this->input->post('td002c');	 
         $sql = " SELECT a.td001,a.td002,a.td014,a.td010,a.td007,a.td004,c.mb002 as td004disp,c.mb003 as td004disp1,a.td005,
		           b.te003,b.te004,d.mb002 as te004disp,d.mb003 as te004disp1, te005, te007,te011,te009
		       FROM bomtd as a LEFT JOIN bomte as b ON  a.td001=b.te001 and a.td002=b.te002 and  a.td001 >= '$seq1'  AND a.td001 <= '$seq2' AND a.td002 >= '$seq3'  AND a.td002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.td004=c.mb001  LEFT JOIN invmb as d ON b.te004=d.mb001"; 
	//	  FROM bomtd as a, bomte as b WHERE td001=te001 and td002=te002 and  td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	     $seq1=$this->input->post('td001o');    
	      $seq2=$this->input->post('td001c');
		  $seq3=$this->input->post('td002o');    
	      $seq4=$this->input->post('td002c');
	 
		$sql = " SELECT a.td001,a.td002,a.td014,a.td010,a.td007,a.td004,c.mb002 as td004disp,c.mb003 as td004disp1,a.td005,
		           b.te003,b.te004,d.mb002 as te004disp,d.mb003 as te004disp1, te005, te007,te011,te009,te008,te012
		       FROM bomtd as a LEFT JOIN bomte as b ON  a.td001=b.te001 and a.td002=b.te002 and  a.td001 >= '$seq1'  AND a.td001 <= '$seq2' AND a.td002 >= '$seq3'  AND a.td002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.td004=c.mb001  LEFT JOIN invmb as d ON b.te004=d.mb001"; 				  
	//	  FROM bomtd as a, bomte as b WHERE td001=te001 and td002=te002 and  td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('bomtd')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
          $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td004disp,d.mb003 as td004disp1, e.mc002 as td010disp 
		  ,f.mb002 as te004disp,f.mb003 as te004disp1, g.mc002 as te007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013');
		 
        $this->db->from('bomtd as a');	
        $this->db->join('bomte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="42" ','left');
	    $this->db->join('invmb as d', 'a.td004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.td010 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.te004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.te007 = g.mc001 ','left');	
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('te001', $this->uri->segment(4));
		$this->db->where('te002', $this->uri->segment(5));
	    $query = $this->db->get('bomte');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td004disp,d.mb003 as td004disp1, e.mc002 as td010disp 
		  ,f.mb002 as te004disp,f.mb003 as te004disp1, g.mc002 as te007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013');
		 
        $this->db->from('bomtd as a');	
        $this->db->join('bomte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="42" ','left');
	    $this->db->join('invmb as d', 'a.td004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.td010 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.te004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.te007 = g.mc001 ','left');
		$this->db->where('a.td001', $this->input->post('td001o')); 
	    $this->db->where('a.td002', $this->input->post('td002o')); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	   //印單據筆  半張紙letter1/2 A4half  公司表頭
		function companyf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsml'); 		
		$query = $this->db->get();
	    $result1['rows1'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result1;
		 }	    		
        }
	//  系統參數
		function funsysf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsma'); 		
		$query = $this->db->get();
	    $result2['rows2'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result2;
		 }	    		
        }
	//印單據筆  
		function printfb()   
        {           
        $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td004disp,d.mb003 as td004disp1, e.mc002 as td010disp 
		  ,f.mb002 as te004disp,f.mb003 as te004disp1, g.mc002 as te007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013');
		 
        $this->db->from('bomtd as a');	
        $this->db->join('bomte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001  ','left');
	    $this->db->join('invmb as d', 'a.td004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.td010 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.te004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.te007 = g.mc001 ','left');
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
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
			$td001=$this->input->post('td001');
			 $td002=$this->input->post('td002');
			$sql="select * from bomtd where td001='$td001' and td002='$td002' ";
			$query = $this->db->query($sql) ;
			//庫存增加欄位 庫別
				if (@$td004 and @$td010  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$td004','$td010','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存減少				
				if (@$td004 and @$td010 and @$td007 and @$td201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007-'$td007',mc008=mc008-'$td201' WHERE mc001 = '$td004'  AND mc002 = '$td010'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064-'$td007',mb065=mb065-'$td201' WHERE mb001 = '$td004'   "; 
		         $query = $this->db->query($sql84);
					}
			  preg_match_all('/\d/S',$this->input->post('td003'), $matches);  //處理日期字串
			 $td003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('td014'), $matches);  //處理日期字串
			 $td014 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('td018'), $matches);  //處理日期字串
			 $td018 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('td019'), $matches);  //處理日期字串
			 $td019 = implode('',$matches[0]);
			 
			 $td001=$this->input->post('td001');
			 $td002=$this->input->post('td002');
			 
			 $td004=$this->input->post('td004');
			 $td010=$this->input->post('td010');
			 $td007=$this->input->post('td007');
			 $td201=$this->input->post('td201');			 
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'td003' => $td003,
		         'td004' => $this->input->post('td004'),
		         'td005' => $this->input->post('td005'),
		         'td006' => $this->input->post('td006'),
                 'td007' => $this->input->post('td007'),
                 'td008' => $this->input->post('td008'),
                 'td009' => $this->input->post('td009'),
                 'td010' => $this->input->post('td010'),	
                 'td011' => $this->input->post('td011'),		
                 'td012' => $this->input->post('td012'),
				 'td013' => $this->input->post('td013'),
				 'td014' => $td014,
				 'td015' => $this->input->post('td015'),
				 'td016' => $this->input->post('td016'),
				 'td017' => $this->input->post('td017'),
				 'td018' => $td018,
				 'td019' => $td019,
				 'td200' => $this->input->post('td200'),
				 'td201' => $this->input->post('td201')
                );
            $this->db->where('td001', $td001);
			$this->db->where('td002', $td002);
            $this->db->update('bomtd',$data);                   //更改一筆
			//庫存增加欄位 庫別
				if (@$td004 and @$td010  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$td004','$td010','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存減少				
				if (@$td004 and @$td010 and @$td007 and @$td201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007+'$td007',mc008=mc008+'$td201' WHERE mc001 = '$td004'  AND mc002 = '$td010'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064+'$td007',mb065=mb065+'$td201' WHERE mb001 = '$td004'   "; 
		         $query = $this->db->query($sql84);
					}
			//刪除明細 先調整庫存
			$sql="select * from bomte where te001='$td001' and te002='$td002' ";
			$query = $this->db->query($sql) ;
		    foreach ($query->result() as $row) {
            foreach($row as $i=>$v){
            $$i=$v;
				//庫存增加欄位 庫別
				if (@$te004 and @$te007  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$te004','$te007','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存增加				
				if (@$te004 and @$te007 and @$te008 and @$te201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007+'$te008',mc008=mc008+'$te201' WHERE mc001 = '$te004'  AND mc002 = '$te007'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064+'$te008',mb065=mb065+'$te201' WHERE mb001 = '$te004'   "; 
		         $query = $this->db->query($sql84);
				$te008=0;$te201=0;$te004='';$te007='';	}
			
            }}
			
			
			//刪除明細 
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('te001', $td001);
					$this->db->where('te002', $td002);
					$this->db->delete('bomte'); //刪除明細 1060809
					
		    $vte003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				//preg_match_all('/\d/S',$te014, $matches);  //處理日期字串
			   // $te014 = implode('',$matches[0]);
				
				if($this->seldetail($td001,$td002,$val['te003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if ($k!="te001" &&$k!="te002" && $k!="te004disp" && $k!="te004disp1"&& $k!="te007disp"){//主鍵不用更改以及其他外來鍵庫別名稱 td013日期等別處理
							if($k=="te003") {$data[$k] = $vte003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('te001', $td001);
					$this->db->where('te002', $td002);
					$this->db->where('te003', $vtd003);
					$this->db->update('bomte',$data);//更改一筆
					$mte003 = (int) $vte003+10;
			        $vte003 =  (string)$mte003;
				}else{
					if($val['te003'] && $val['te004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'te001' => $td001,
							'te002' => $td002
						);
						foreach($val as $k=>$v){
							if($k!="te001"&&$k!="te002"&& $k!="te004disp"&& $k!="te004disp1"&& $k!="te007disp"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="te003") {$data[$k] = $vte003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('bomte', $data);
						$mte003 = (int) $vte003+10;
			            $vte003 =  (string)$mte003;
					}
				}
				
				preg_match_all('/\d/S',$this->input->post('td014'), $matches);  //處理日期字串
			    $td014 = implode('',$matches[0]);
				//庫存增加欄位 庫別
				if (@$te004 and @$te007  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$te004','$te007','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存增加				
				if (@$te004 and @$te007 and @$te008 and @$te201 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007-'$te008',mc008=mc008-'$te201' WHERE mc001 = '$te004'  AND mc002 = '$te007'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064-'$te008',mb065=mb065-'$te201' WHERE mb001 = '$te004'   "; 
		         $query = $this->db->query($sql84);
				$te008=0;$te201=0;$te004='';$te007='';	}
			}
			
        }
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('te001', $seg1);
			$this->db->where('te002', $seg2);
	        $this->db->where('te003', $seg3);
	        $query = $this->db->get('bomte');
	        return $query->num_rows() ; 
	    }		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('bomtd'); 
		  $this->db->where('te001', $this->uri->segment(4));
		  $this->db->where('te002', $this->uri->segment(5));
          $this->db->delete('bomte'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('te001', $seg1);
	      $this->db->where('te002', $seg2);
	      $this->db->where('te003', $seg3);
          $this->db->delete('bomte'); 
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
		    	      list($seq1, $seq2) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
			      $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
                  $this->db->delete('bomtd'); 
				  $this->db->where('te001', $seq1);
			      $this->db->where('te002', $seq2);
                  $this->db->delete('bomte'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	 function del_detail(){
		$this->db->where('te001', $_POST['del_md001']);
		$this->db->where('te002', $_POST['del_md002']);
		$this->db->where('te003', $_POST['del_md003']);
		$this->db->delete('bomte');
	}
   //取單號 最大值加1
	function check_title_no($bomi03,$td014){
		preg_match_all('/\d/S',$td014, $matches);  //處理日期字串
		$td014 = implode('',$matches[0]);
		$this->db->select('MAX(td002) as max_no')
			->from('bomtd')
			->where('td001', $bomi03)
		//	->where('tc039', $tc039);
			->like('td014', $td014, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $td014."001";}
		
		return $result[0]->max_no+1;
	}
	//import copi05
	function check_detail_num($mz001,$mz002,$mz003,$mz004){
		
		$query = $this->db->select('COUNT(*) as num_count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('bommd as a')
				->where('md001',$mz001);
				
		$num = $query->get()->result();
		
		return $num[0]->num_count;		
	}
	
	function get_detail_data($mz001,$mz002,$mz003,$mz004){
		
		$query = $this->db->select('a.md001,a.md002,a.md003,b.mb001,b.mb002,b.mb003,a.md004,a.md006')
				->from('bommd as a')
				->join('invmb as b', 'a.md003 = b.mb001 ','left')
				->where('md001',$mz001);
				
		$data = $query->get()->result();
		
		return $data;		
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>