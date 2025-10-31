<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csti02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mb001, mb002, mb003, mb004, mb0011, mb0019,mb020, create_date');
          $this->db->from('cstmb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cstmb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.mb001', 'a.mb002', 'a.mb003', 'a.mb004', 'a.mb011', 'a.mb019','a.mb030','b.mb002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.mb001, a.mb002, a.mb003, a.mb004, b.mb002,  a.mb029, a.mb030,a.create_date')
	                       ->from('cstmb as a')
						    ->join('copma as b', 'a.mb004 = b.mb001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cstmb');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('csti02_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['csti02']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mb001 asc,mb002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['csti02']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['csti02']['search']['where'];
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
		
		if(isset($_SESSION['csti02']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['csti02']['search']['order'];
		}
		
		if(!isset($_SESSION['csti02']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,b.md002 as mb001disp')
	                       ->from('cstmb as a')
						   ->join('cmsmd as b', 'a.mb001 = b.md001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,b.md002 as mb001disp')
	                       ->from('cstmb as a')
						   ->join('cmsmd as b', 'a.mb001 = b.md001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['csti02']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cstmb as a');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['csti02']['search']['where'] = $where;
		$_SESSION['csti02']['search']['order'] = $order;
		$_SESSION['csti02']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mb001","mb002"
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
		$_SESSION['csti02']['search']['view'] = $view_array;
		$_SESSION['csti02']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['copi06']['search']['view']);exit;
	}
	
	//查詢一筆 修改用   
	function selone($seg1) {
		$this->db->select('a.*,b.md002 as mb001disp, c.mb002 as mb007disp, c.mb003 as mb007disp1, c.mb004 as mb007disp2, a.mb004 as mb004disp, a.mb004 as mb004disp1');     
        $this->db->from('cstmb as a');
		$this->db->join('cmsmd as b', 'a.mb001 = b.md001','left');
		$this->db->join('invmb as c', 'a.mb007 = c.mb001','left');	
		$this->db->where('a.mb001', $seg1); 
		$this->db->order_by('a.mb001 , a.mb002');
		
		$query = $this->db->get();
	
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		/*$this->db->select('b.*,i.mc002 as td007disp')
			->from('coptd as b')
			->join('cmsmc as i', 'b.td007 = i.mc001 ','left')   //庫別
			->where('b.td001', $seg1)
			->where('b.td002', $seg2);
		$query = $this->db->get();*/
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		$this->db->select('a.*, b.md002 as a.mb001disp, c.mb002 as a.mb007disp, c.mb003 as a.mb007disp1, c.mb004 as a.mb007disp2, a.mb004 as mb004disp, a.mb004 as mb004disp1');
        $this->db->from('cstmb as a');	
		$this->db->join('cmsmd as b', 'a.mb001 = b.md001','left');
		$this->db->join('invmb as c', 'a.mb007 = c.mb001','left');
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('cstmb');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('mc001, mc002')->from('cmsmc');  
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
			
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `cstmb` ";
	      $seq1 = "mb001, mb002, mb003, mb004, mb005, mb006,mb007, create_date FROM `cstmb` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.mb001 desc' ;
          $seq9 = " ORDER BY a.mb001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.mb001 ";

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
		//下一頁不要跑掉 1050317 1060815
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
	    }
		if(@$_SESSION['csti02_sql_term']){$seq32 = $_SESSION['csti02_sql_term'];}
		if(@$_SESSION['csti02_sql_sort']){$seq33 = $_SESSION['csti02_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.*');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*')
	                       ->from('cstmb as a')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cstmb')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//篩選多筆  舊版   
	function filterf1($limit, $offset , $sort_by  , $sort_order)          
	    {    
	      $seq4 = trim(urldecode(urldecode($this->uri->segment(6)))); 	 //解決亂碼          
          $sort_by = $this->uri->segment(4);			
          $sort_order = $this->uri->segment(5);	
	      $offset=$this->uri->segment(8,0);
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('a.mb001', 'a.mb002', 'a.mb003', 'a.mb004', 'b.mb002', 'a.mb029','a.mb030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否為 table
	      $this->db->select('a.mb001, a.mb002, a.mb003, a.mb004,b.mb002,  a.mb029,a.mb030, a.create_date');
	      $this->db->from('cstmb as a');
		  $this->db->join('copma as b', 'a.mb004 = b.mb001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mb001 asc, mb002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cstmb as a');
		  $this->db->join('copma as b', 'a.mb004 = b.mb001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('mb001', $seg1);
		  $this->db->where('mb002', $seg2);
	      $query = $this->db->get('cstmb');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $seg1);
		  $this->db->where('td002', $seg2);
		  $this->db->where('td003', $seg3);
	      $query = $this->db->get('coptd');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  cstmb	
	function insertf()    //新增一筆 檔頭  cstmb
        {
		    //刪日期 / 符號
		     //preg_match_all('/\d/S',$this->input->post('mb003'), $matches);  //處理日期字串
			 //$mb003 = implode('',$matches[0]);
			 //preg_match_all('/\d/S',$this->input->post('mb027'), $matches);  //處理日期字串
			 //$mb027 = implode('',$matches[0]);
			   
			 $mb001=$this->input->post('mb001');
			 $mb002=$this->input->post('mb002');
			 //$mb002no=$mb002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  //while($this->csti02_model->selone1($mb001,$mb002)>0){
				//$mb002 = $this->check_title_no($mb001,$mb027);
				//$mb002no=$mb002;
			//}
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mb001' => $this->input->post('mb001'),
		         'mb002' => $this->input->post('mb002'),
		         'mb003' => $this->input->post('mb003'),
		         'mb004' => $this->input->post('mb004'),  
		         'mb005' => $this->input->post('mb005'),    
		         'mb006' => $this->input->post('mb006'),    
                 'mb007' => $this->input->post('mb007')
                );
	    
             $this->db->insert('cstmb', $data);
			
			/*if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 coptd  
		      $vtd003='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['td003'] && $val['td004']){
				        extract($val);
						preg_match_all('/\d/S',$td013, $matches);  //處理日期字串
			            $td013 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'td013' => $td013,
							'td001' => $mb001,
							'td002' => $mb002no
						);
						foreach($val as $k=>$v){
							if($k!="td001"&&$k!="td002"&&$k!="td007disp"&&$k!="td013"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="td003") {$data[$k] = $vtd003;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('coptd', $data);
					$mtd003 = (int) $vtd003+10;
			        $vtd003 =  (string)$mtd003;
				}
			}*/
		 }
	
    //自動列印	
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('copi03'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
		      echo "<script>window.open('printbb/".$this->input->post('copi03')."/".$this->input->post('mb002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('mb001', $this->input->post('mb001c')); 
          $this->db->where('mb002', $this->input->post('mb002c'));
	      $query = $this->db->get('cstmb');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('mb001', $this->input->post('mb001o'));
			$this->db->where('mb002', $this->input->post('mb002o'));
	        $query = $this->db->get('cstmb');
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
                $mb003=$row->mb003;$mb004=$row->mb004;$mb005=$row->mb005;$mb006=$row->mb006;$mb007=$row->mb007;$mb008=$row->mb008;$mb009=$row->mb009;$mb010=$row->mb010;
				$mb011=$row->mb011;$mb012=$row->mb012;$mb013=$row->mb013;$mb014=$row->mb014;$mb015=$row->mb015;$mb016=$row->mb016;
				$mb017=$row->mb017;$mb018=$row->mb018;$mb019=$row->mb019;$mb020=$row->mb020;$mb021=$row->mb021;$mb022=$row->mb022;
				$mb023=$row->mb023;$mb024=$row->mb024;$mb025=$row->mb025;$mb026=$row->mb026;$mb027=$row->mb027;$mb028=$row->mb028;
				$mb029=$row->mb029;$mb030=$row->mb030;$mb031=$row->mb031;$mb032=$row->mb032;$mb033=$row->mb033;$mb034=$row->mb034;
				$mb035=$row->mb035;$mb036=$row->mb036;$mb037=$row->mb037;$mb038=$row->mb038;$mb039=$row->mb039;$mb040=$row->mb040;$mb041=$row->mb041;
				$mb042=$row->mb042;$mb043=$row->mb043;$mb044=$row->mb044;$mb045=$row->mb045;$mb046=$row->mb046;$mb047=$row->mb047;
				$mb048=$row->mb048;$mb049=$row->mb049;$mb050=$row->mb050;$mb051=$row->mb051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mb001c');    //主鍵一筆檔頭cstmb
			$seq2=$this->input->post('mb002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mb001' => $seq1,'mb002' => $seq2,'mb003' => $mb003,'mb004' => $mb004,'mb005' => $mb005,'mb006' => $mb006,'mb007' => $mb007,'mb008' => $mb008,'mb009' => $mb009,'mb010' => $mb010,
		           'mb011' => $mb011,'mb012' => $mb012,'mb013' => $mb013,'mb014' => $mb014,'mb015' => $mb015,'mb016' => $mb016,'mb017' => $mb017,
				   'mb018' => $mb018,'mb019' => $mb019,'mb020' => $mb020,'mb021' => $mb021,'mb022' => $mb022,'mb023' => $mb023,'mb024' => $mb024,
				   'mb025' => $mb025,'mb026' => $mb026,'mb027' => $mb027,'mb028' => $mb028,'mb029' => $mb029,'mb030' => $mb030,
				   'mb031' => $mb031,'mb032' => $mb032,'mb033' => $mb033,'mb034' => $mb034,'mb035' => $mb035,'mb036' => $mb036,
				   'mb037' => $mb037,'mb038' => $mb038,'mb039' => $mb039,'mb040' => $mb040,'mb041' => $mb041,'mb042' => $mb042,
				   'mb043' => $mb043,'mb044' => $mb044,'mb045' => $mb045,'mb046' => $mb046,'mb047' => $mb047,'mb048' => $mb048,
				   'mb049' => $mb049,'mb050' => $mb050,'mb051' => $mb051
                   );
				   
            $exist = $this->copi06_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('cstmb', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('td001', $this->input->post('mb001o'));
			$this->db->where('td002', $this->input->post('mb002o'));
	        $query = $this->db->get('coptd');
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
                 $td003[$i]=$row->td003;$td004[$i]=$row->td004;$td005[$i]=$row->td005;$td006[$i]=$row->td006;$td007[$i]=$row->td007;
				 $td008[$i]=$row->td008;$td009[$i]=$row->td009;$td010[$i]=$row->td010;$td011[$i]=$row->td011;$td012[$i]=$row->td012;
				 $td013[$i]=$row->td013;$td014[$i]=$row->td014;$td015[$i]=$row->td015;$td016[$i]=$row->td016;$td017[$i]=$row->td017;
				 $td018[$i]=$row->td018;$td019[$i]=$row->td019;$td020[$i]=$row->td020;$td021[$i]=$row->td021;$td022[$i]=$row->td022;
			     $td023[$i]=$row->td023;$td024[$i]=$row->td024;$td025[$i]=$row->td025;$td026[$i]=$row->td026;$td027[$i]=$row->td027;
				 $td028[$i]=$row->td028;$td029[$i]=$row->td029;$td030[$i]=$row->td030;$td031[$i]=$row->td031;$td032[$i]=$row->td032;
				 $td033[$i]=$row->td033;$td034[$i]=$row->td034;$td035[$i]=$row->td035;$td036[$i]=$row->td036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('mb001c');    //主鍵一筆明細coptd
			$seq2=$this->input->post('mb002c'); 
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
                'td001' => $seq1,'td002' => $seq2,'td003' => $td003[$i],'td004' => $td004[$i],'td005' => $td005[$i],'td006' => $td006[$i],'td007' => $td007[$i],
		         'td008' => $td008[$i],'td009' => $td009[$i],'td010' => $td010[$i],'td011' => $td011[$i],'td012' => $td012[$i],'td013' => $td013[$i],
				 'td014' => $td014[$i],'td015' => $td015[$i],'td016' => $td016[$i],'td017' => $td017[$i],'td018' => $td018[$i],'td019' => $td019[$i],
				 'td020' => $td020[$i],'td021' => $td021[$i],'td022' => $td022[$i],'td023' => $td023[$i],'td024' => $td024[$i],'td025' => $td025[$i],
				 'td026' => $td026[$i],'td027' => $td027[$i],'td028' => $td028[$i],'td029' => $td029[$i],'td030' => $td030[$i],'td031' => $td031[$i],'td032' => $td032[$i],
				 'td033' => $td033[$i],'td034' => $td034[$i],'td035' => $td035[$i],'td036' => $td036[$i]
                ); 
				
             $this->db->insert('coptd', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mb001o');    
	      $seq2=$this->input->post('mb001c');
		  $seq3=$this->input->post('mb002o');    
	      $seq4=$this->input->post('mb002c');
	      $sql = " SELECT mb001,mb002,mb039,mb004,mb002 as mb004disp,td003,td004,td005,td006,td010,td008,td011,td012 
		  FROM cstmb as a,coptd as b,copma as c WHERE mb001=td001 and mb002=td002 and mb004=mb001 and mb001 >= '$seq1'  AND mb001 <= '$seq2' AND  mb002 >= '$seq3'  AND mb002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('mb001o');    
	      $seq2=$this->input->post('mb001c');
		  $seq3=$this->input->post('mb002o');    
	      $seq4=$this->input->post('mb002c');
	      $sql = " SELECT a.mb001,a.mb002,a.mb039,a.mb004,c.mb002 as mb004disp,b.td003,b.td004,b.td005,b.td006,b.td010,b.td008,b.td011,b.td012
		  FROM cstmb as a,coptd as b,copma as c
		  WHERE mb001=td001 and mb002=td002 and mb004=mb001 and mb001 >= '$seq1'  AND mb001 <= '$seq2' AND mb002 >= '$seq3'  AND mb002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
          $seq32 = "mb001 >= '$seq1'  AND mb001 <= '$seq2' AND mb002 >= '$seq3'  AND mb002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('cstmb')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS mb001disp, d.me002 AS mb004disp, e.mb002 AS mb010disp, f.mv002 AS mb012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td011, b.td009, b.td017, b.td018, b.td012');
		 
        $this->db->from('cstmb as a');	
        $this->db->join('coptd as b', 'a.mb001 = b.td001  and a.mb002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mb004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mb010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mb012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.td003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('td001', $this->uri->segment(4));
		$this->db->where('td002', $this->uri->segment(5));
	    $query = $this->db->get('coptd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS mb001disp, d.mb002 AS mb007disp,e.mf002 AS mb008disp, f.mv002 AS mb006disp,g.na003 AS mb014disp,
		  ,h.mb002 AS mb004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as mb005disp');
		 
        $this->db->from('cstmb as a');	
        $this->db->join('coptd as b', 'a.mb001 = b.td001  and a.mb002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mb007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mb008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mb006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mb014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mb004 = h.mb001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mb005 = j.me001 ','left');   //部門	
		$this->db->where('a.mb001', $this->input->post('mb001o')); 
	    $this->db->where('a.mb002 >= '.$this->input->post('mb002o').' and a.mb002 <= '.$this->input->post('mb002c')); 
		$this->db->order_by('mb001 , mb002 ,b.td003');
		
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
          $this->db->select('a.* ,c.mq002 AS mb001disp, d.mb002 AS mb007disp,e.mf002 AS mb008disp, f.mv002 AS mb006disp,g.na003 AS mb014disp,
		  ,h.mb002 AS mb004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as mb005disp');
		 
        $this->db->from('cstmb as a');	
        $this->db->join('coptd as b', 'a.mb001 = b.td001  and a.mb002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mb007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mb008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mb006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mb014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mb004 = h.mb001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mb005 = j.me001 ','left');   //部門
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.td003');
		
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
			//substr($this->input->post('mb003'),0,4).substr($this->input->post('mb003'),5,2).substr(rtrim($this->input->post('mb003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $mb002=$this->input->post('mb002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			// preg_match_all('/\d/S',$this->input->post('mb003'), $matches);  //處理日期字串
			// $mb003 = implode('',$matches[0]);
			// preg_match_all('/\d/S',$this->input->post('mb027'), $matches);  //處理日期字串
			// $mb027 = implode('',$matches[0]);
			   
			 $mb001=$this->input->post('mb001');
			 $mb002=$this->input->post('mb002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
				 'mb003' => $this->input->post('mb003'),
		         'mb004' => $this->input->post('mb004'),  
		         'mb005' => $this->input->post('mb005'),    
		         'mb006' => $this->input->post('mb006'),    
                 'mb007' => $this->input->post('mb007')
                );
				
            $this->db->where('mb001', $mb001); //單別
			$this->db->where('mb002', $mb002);
            $this->db->update('cstmb',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			/*if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('td001', $mb001);
					$this->db->where('td002', $mb002);
					$this->db->delete('coptd'); //刪除明細 1060809
					
		    $vtd003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				preg_match_all('/\d/S',$td013, $matches);  //處理日期字串
			    $td013 = implode('',$matches[0]);
				if($this->seldetail($mb001,$mb002,$val['td003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'td013' => $td013,
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="td001"&&$k!="td002"&&$k!="td007disp" && $k!="td013"){//主鍵不用更改以及其他外來鍵庫別名稱 td013日期等別處理
							if($k=="td003") {$data[$k] = $vtd003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('td001', $mb001);
					$this->db->where('td002', $mb002);
					$this->db->where('td003', $vtd003);
					$this->db->update('coptd',$data);//更改一筆
					$mtd003 = (int) $vtd003+10;
			        $vtd003 =  (string)$mtd003;
				}else{
					if($val['td003'] && $val['td004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'td013' => $td013,
							'td001' => $mb001,
							'td002' => $mb002
						);
						foreach($val as $k=>$v){
							if($k!="td001"&&$k!="td002"&&$k!="td007disp" && $k!="td013"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="td003") {$data[$k] = $vtd003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('coptd', $data);
						$mtd003 = (int) $vtd003+10;
			            $vtd003 =  (string)$mtd003;
					}
				}
				
			}*/
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('td001', $seg1);
			$this->db->where('td002', $seg2);
	        $this->db->where('td003', $seg3);
	        $query = $this->db->get('coptd');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mb001', $this->uri->segment(4));
		  $this->db->where('mb002', $this->uri->segment(5));
          $this->db->delete('cstmb'); 
		  $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('coptd'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('td001', $seg1);
	      $this->db->where('td002', $seg2);
	      $this->db->where('td003', $seg3);
          $this->db->delete('coptd'); 
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
			      $this->db->where('mb001', $seq1);
			      $this->db->where('mb002', $seq2);
                  $this->db->delete('cstmb'); 
				  //$this->db->where('tl001', $seq1);
			      //$this->db->where('tl002', $seq2);
                  //$this->db->delete('nottl'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	   
	//刪除明細一筆新增修改時使用   
	function del_detail(){
		$this->db->where('td001', $_POST['del_md001']);
		$this->db->where('td002', $_POST['del_md002']);
		$this->db->where('td003', $_POST['del_md003']);
		$this->db->delete('coptd');
	}
	
	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookup_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=15){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('invmb');
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
	
	//取單號 最大值加1
	function check_title_no($asti03_csti02,$mb027){
		preg_match_all('/\d/S',$mb027, $matches);  //處理日期字串
		$mb027 = implode('',$matches[0]);
		$this->db->select('MAX(mb002) as max_no')
			->from('cstmb')
			->where('mb001', $asti03_csti02)
		//	->where('mb039', $mb039);
			->like('mb027', $mb027, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $mb027."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>