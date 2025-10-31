<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pali54_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('tg001, tg002, tg003, tg004, tg005, tg006, create_date');
        $this->db->from('paltg');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('tg001 desc, tg002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('paltg');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tg001', 'tg002', 'tg003', 'tg004', 'tg005', 'tg006','tg008','total_hr','tg023','a.create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.tg001,b.mv002 as tg001disp, a.tg002, c.me002 as tg002disp,a.tg003, a.tg008, a.tg023, a.tg006, a.tg007, a.tg009, a.tg010, a.tg011, a.tg012, a.tg013, a.tg014, a.tg015, a.tg016,a.tg201,a.tg202,a.tg203, (a.tg006+a.tg007+a.tg008+(a.tg009*8)+a.tg010+(a.tg011*8)+(a.tg012*8)+(a.tg013*8)+(a.tg014*8)+(a.tg015*8)+(a.tg016*8)) as total_hr,a.create_date')
			  ->from('paltg as a')
			  ->join('cmsmv as b', 'a.tg001 = b.mv001 ','left')
			  ->join('cmsme as c', 'a.tg002 = c.me001 ','left')
			  ->order_by($sort_by, $sort_order)
			  ->order_by('tg003', 'desc')
			  ->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();
		
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('paltg');
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
		$this->session->set_userdata('pali54_search',"display_search");
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
		$default_order = "tg003 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['pali54']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['pali54']['search']['where'];
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
			//$value .= $val." like '%".$val_ary[$key]."%' ";
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
			//$value .= $val." like '%".$val_ary[$key]."%' ";
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
		
		if(isset($_SESSION['pali54']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['pali54']['search']['order'];
		}
		
		if(!isset($_SESSION['pali54']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		/* Data SQL */
		
			$query = $this->db->select('a.tg001,b.mv002 as tg001disp, a.tg002, c.me002 as tg002disp,a.tg003, a.tg008, a.tg023, a.create_date')
	                       ->from('paltg as a')
						   ->join('cmsmv as b', 'a.tg001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.tg002 = c.me001 ','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['pali54']['search']['sql'] = $this->db->last_query();
		
		/*此段為判斷是否國定假日，其他功能不用，可直接砍掉*/
		foreach($ret['data'] as $key => $val){
			if($this->check_holiday($val->tg003)){
				$ret['data'][$key]->holiday = 1;
			}else{
				$ret['data'][$key]->holiday = 0;
			}
		}
		/* Num SQL*/
		$query = $this->db->select('count(a.tg001) as total_num')
			->from('paltg as a')
			->join('cmsmv as b', 'a.tg001 = b.mv001 ','left')
		   ->join('cmsme as c', 'a.tg002 = c.me001 ','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['pali54']['search']['where'] = $where;
		$_SESSION['pali54']['search']['order'] = $order;
		$_SESSION['pali54']['search']['offset'] = $offset;
		
		return $ret;
	}
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('tg001', $this->uri->segment(4));
	    $this->db->where('tg001', $this->uri->segment(4));	
	    $query = $this->db->get('paltg');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->tg002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2)    
       { 
		 $this->db->select('a.*, b.mv002 as tg001disp, c.me002 as tg002disp');	
		 $this->db->from('paltg as a');
		 $this->db->join('cmsmv as b', 'a.tg001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.tg002 = c.me001 ','left');
		// $this->db->where('tg001', $this->uri->segment(4));
		 $this->db->where('a.tg001',$seq1); 
	     $this->db->where('a.tg003',$seq2); 
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `paltg` ";
	     $seq1 = " tg001, tg002, tg003, tg004, tg005, tg008,tg014,tg011, create_date FROM `paltg` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "a.`create_date` >='' ";
         $seq33 = 'tg001 desc' ;
         $seq9 = " ORDER BY tg001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "a.`create_date` >='' ";
         $seq7="tg001 ";

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
	     $sort_columns = array('tg001', 'tg002', 'tg003', 'tg004', 'tg005', 'tg008','tg014','tg011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tg001,b.mv002 as tg001disp, a.tg002, c.me002 as tg002disp,a.tg003, a.tg008, a.tg023, a.create_date')
	                       ->from('paltg as a')
						   ->join('cmsmv as b', 'a.tg001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.tg002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('paltg as a')
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
	    $sort_columns = array('tg001', 'tg002', 'tg003', 'tg004', 'tg005', 'tg006','total_hr','a.create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.tg001,b.mv002 as tg001disp, a.tg002, c.me002 as tg002disp,a.tg003, a.tg008, a.tg023, a.create_date, a.tg006, a.tg007, a.tg009, a.tg010, a.tg011, a.tg012, a.tg013, a.tg014, a.tg015, a.tg016, (a.tg006+a.tg007+a.tg008+(a.tg009*8)+a.tg010+(a.tg011*8)+(a.tg012*8)+(a.tg013*8)+(a.tg014*8)+(a.tg015*8)+(a.tg016*8)) as total_hr');
	       $this->db->from('paltg as a');
			$this->db->join('cmsmv as b', 'a.tg001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.tg002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
		$this->db->order_by('tg003', 'desc');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('tg001 asc, tg002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('paltg');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('tg001', $this->input->post('palq01a')); 
	    $this->db->where('tg003', $seg2); 	    
	    $query = $this->db->get('paltg');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		preg_match_all('/\d/S',$this->input->post('tg003'), $matches);  //處理日期字串
		$tg003 = implode('',$matches[0]);
		 $tg306=$this->input->post('tg306');
		 $tg311=$this->input->post('tg311');
		 $tg001=$this->input->post('palq01a');
       	//$tg003=substr($this->input->post('tg003'),0,4).substr($this->input->post('tg003'),5,2).substr($this->input->post('tg003'),8,2);
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'tg001' => $this->input->post('palq01a'),
		          'tg002' => $this->input->post('cmsq05a'),
		          'tg003' => $tg003,
		          'tg004' => $this->input->post('tg004'),
                  'tg005' => $this->input->post('tg005'),
				  'tg006' => $this->input->post('tg006'),
				  'tg007' => $this->input->post('tg007'),
				  'tg008' => $this->input->post('tg008'),
				  'tg009' => $this->input->post('tg009'),
				  'tg010' => $this->input->post('tg010'),
				  'tg011' => $this->input->post('tg011'),
				  'tg012' => $this->input->post('tg012'),
				  'tg013' => $this->input->post('tg013'),
				  'tg014' => $this->input->post('tg014'),
				  'tg015' => $this->input->post('tg015'),
				  'tg016' => $this->input->post('tg016'),
				  'tg017' => $this->input->post('tg017'),
				  'tg018' => $this->input->post('tg018'),
				  'tg019' => $this->input->post('tg019'),
				  'tg020' => $this->input->post('tg020'),
				  'tg021' => $this->input->post('tg021'),
				  'tg022' => $this->input->post('tg022'),
				  'tg023' => $this->input->post('tg023'),
				  'tg201' => $this->input->post('tg201'),
				  'tg202' => $this->input->post('tg202'),
				  'tg203' => $this->input->post('tg203')
				   
                      );
         
	    $exist = $this->pali54_model->selone1($this->input->post('palq01a'),$tg003);
	    if ($exist)
	      {
		    return 'exist';
		  } 
		    //已請特休
				 $sql22 =" update cmsmv  
                           set mv306='$tg306',mv311='$tg311'
               where mv001='$tg001'  ";
			 $this->db->query($sql22);
           return  $this->db->insert('paltg', $data);
       }
	
	//新增一筆	
	function insert_multf()   
       {
		preg_match_all('/\d/S',$this->input->post('tg003o'), $matches);  //處理日期字串
		$tg003o = implode('',$matches[0]);
		preg_match_all('/\d/S',$this->input->post('tg003c'), $matches);  //處理日期字串
		$tg003c = implode('',$matches[0]);
       	
		$str_date = $tg003o;
		$str_year = substr($str_date,0,4);
		$str_month = substr($str_date,4,2);
		$str_day = substr($str_date,6,2);
		
		$end_date = $tg003c;
		$end_year = substr($end_date,0,4);
		$end_month = substr($end_date,4,2);
		$end_day = substr($end_date,6,2);
		
		//check_holiday
		$date_ary = array();
		
		//echo "<pre>";var_dump($str_date);exit;
		for($i=$str_date;$i<=$end_date;$i++){
			$t_date = $i;
			$t_year = substr($i,0,4);
			$t_month = substr($i,4,2);
			$t_day = substr($i,6,2);
			$m_days = date('t', mktime(0, 0, 0, $t_month, 1, $t_year));
			
			if($t_day > $m_days){
				$t_month++;if(strlen($t_month)==1){$t_month = "0".$t_month;}
				$t_day = "01";
				if($t_month>12){
					$t_month = "01";
					$t_year++;
				}
				$i = $t_year.$t_month.$t_day;
				$date_ary[] = $i;
			}
			else{
				$date_ary[] = $i;
			}
		}
		
		//echo "<pre>";var_dump($date_ary);exit;
		
	    $data = array( 
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' =>date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'tg001' => $this->input->post('palq01a'),
			'tg002' => $this->input->post('cmsq05a'),
			'tg004' => $this->input->post('tg004'),
			'tg005' => $this->input->post('tg005'),
			'tg006' => $this->input->post('tg006'),
			'tg007' => $this->input->post('tg007'),
			'tg008' => $this->input->post('tg008'),
			'tg009' => $this->input->post('tg009'),
			'tg010' => $this->input->post('tg010'),
			'tg011' => $this->input->post('tg011'),
			'tg012' => $this->input->post('tg012'),
			'tg013' => $this->input->post('tg013'),
			'tg014' => $this->input->post('tg014'),
			'tg015' => $this->input->post('tg015'),
			'tg016' => $this->input->post('tg016'),
			'tg017' => $this->input->post('tg017'),
			'tg018' => $this->input->post('tg018'),
			'tg019' => $this->input->post('tg019'),
			'tg020' => $this->input->post('tg020'),
			'tg021' => $this->input->post('tg021'),
			'tg022' => $this->input->post('tg022'),
			'tg023' => $this->input->post('tg023')
        );
        $success_ary = array();
        $exist_ary = array();
		foreach($date_ary as $key=>$val){
			$week = date('w', strtotime($val));
			$holiday = $this->check_holiday($val);
			if($week!=0&&$week!=6&&!$holiday){//假日或國定假日不請假
				$data['tg003'] = $val;
				$exist = $this->pali54_model->selone1($this->input->post('palq01a'),$val);
				if ($exist){
					$exist_ary[] = $val;
				}else{
					$this->db->insert('paltg', $data);
					$success_ary[] = $val;
				}
			}
		}
		$ret_ary = array('success'=>$success_ary,'exist'=>$exist_ary);
		
		return $ret_ary;
       }
	
	//查複製資料是否重複	 
    function selone2($seg2,$seg4)    
       { 	
		 $this->db->where('tg001',$seg2);
		 $this->db->where('tg003',$seg4);
	    $query = $this->db->get('paltg');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('tg001o');    
	    $seq2=$this->input->post('tg001c');
    	$seq3=substr($this->input->post('tg002o'),0,4).substr($this->input->post('tg002o'),5,2).substr($this->input->post('tg002o'),8,2);    
	    $seq4=substr($this->input->post('tg002c'),0,4).substr($this->input->post('tg002c'),5,2).substr($this->input->post('tg002c'),8,2);
	    $this->db->where('tg001', $seq1); 
	    $this->db->where('tg003', $seq3);
	    $query = $this->db->get('paltg');
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
		        $tg002=$row->tg002;
				$tg003=$row->tg003;
                $tg004=$row->tg004;
                $tg005=$row->tg005;
                $tg007=$row->tg007; 
                $tg008=$row->tg008; 
                $tg009=$row->tg009; 
                $tg010=$row->tg010; 
                $tg011=$row->tg011; 
                $tg012=$row->tg012;	
			    $tg013=$row->tg013; 
                $tg014=$row->tg014; 
                $tg015=$row->tg015;	
				$tg016=$row->tg016; 
                $tg017=$row->tg017; 
                $tg018=$row->tg018;	
				$tg019=$row->tg019; 
                $tg020=$row->tg020; 
                $tg021=$row->tg021;
                $tg022=$row->tg022;
                $tg023=$row->tg023;				
	 	  endforeach;
	      } 
         //   $seq2=$this->input->post('tg001c');    //主鍵一筆
	     //   $seq4=$this->input->post('tg002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'tg001' => $seq2,
		          'tg002' => $tg002,
		          'tg003' => $seq4,
		          'tg004' => $tg004,
		          'tg005' => $tg005,
                  'tg007' => $tg007,
                  'tg008' => $tg008,
                  'tg009' => $tg009,
                  'tg010' => $tg010,
                  'tg011' => $tg011,
				  'tg012' => $tg012,
                  'tg013' => $tg013,
				  'tg014' => $tg014,
                  'tg015' => $tg015,
				  'tg016' => $tg016,
                  'tg017' => $tg017,
				  'tg018' => $tg018,
                  'tg019' => $tg019,
				  'tg020' => $tg020,
                  'tg021' => $tg021,
				  'tg022' => $tg022,
                  'tg023' => $tg023
                 			  
                    );
            $exist = $this->pali54_model->selone2($seq2,$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('paltg', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('tg001o');    //查詢一筆以上
	    $seq2=$this->input->post('tg001c'); 
	    $seq3=substr($this->input->post('tg002o'),0,4).substr($this->input->post('tg002o'),5,2).substr($this->input->post('tg002o'),8,2);    
	    $seq4=substr($this->input->post('tg002c'),0,4).substr($this->input->post('tg002c'),5,2).substr($this->input->post('tg002c'),8,2);
		 
	    $sql1 = " SELECT a.tg001,b.mv002 as tg001disp,a.tg002,c.me002 as tg002disp,a.tg003, a.tg004,a.tg005,a.tg006,a.tg007,a.tg008,a.tg009,a.tg010,a.tg011,a.tg012
		              ,a.tg201,a.tg202,a.tg013,a.tg014,a.tg015,a.tg016,a.tg017,a.tg018,a.tg019,a.tg020,a.tg021,a.tg022,a.tg023 "; 
		$sql2 = " FROM paltg as a LEFT JOIN cmsmv as b ON  a.tg001=b.mv001 LEFT JOIN cmsme as c ON a.tg002=c.me001 "; 
		$sql3 = " WHERE a.tg001 >= '$seq1'  AND a.tg001 <= '$seq2' AND  a.tg003 >= '$seq3'  AND a.tg003 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('tg001o');    //查詢一筆以上
	    $seq2=$this->input->post('tg001c'); 
	   $seq3=substr($this->input->post('tg002o'),0,4).substr($this->input->post('tg002o'),5,2).substr($this->input->post('tg002o'),8,2);    
	    $seq4=substr($this->input->post('tg002c'),0,4).substr($this->input->post('tg002c'),5,2).substr($this->input->post('tg002c'),8,2);
		 
	    $sql1 = " SELECT a.*,b.mv002 as tg001disp,c.me002 as tg002disp "; 
		$sql2 = " FROM paltg as a LEFT JOIN cmsmv as b ON  a.tg001=b.mv001 LEFT JOIN cmsme as c ON a.tg002=c.me001 "; 
		$sql3 = " WHERE a.tg001 >= '$seq1'  AND a.tg001 <= '$seq2' AND  a.tg003 >= '$seq3'  AND a.tg003 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "tg001 >= '$seq1'  AND tg001 <= '$seq2' AND  tg003 >= '$seq3'  AND tg003 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('paltg')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	         
            //    if ($this->input->post('tg015')>'0') {$tg015=substr($this->input->post('tg015'),0,4).substr($this->input->post('tg015'),5,2).substr(rtrim($this->input->post('tg015')),8,2);}
            //  else {$tg015='';}  
            	$tg003=substr($this->input->post('tg003'),0,4).substr($this->input->post('tg003'),5,2).substr($this->input->post('tg003'),8,2);			
				preg_match_all('/\d/S',$this->input->post('tg003'), $matches);  //處理日期字串
				$tg003 = implode('',$matches[0]);
				preg_match_all('/\d/S',$this->input->post('ori_date'), $matches);  //處理日期字串
				$ori_date = implode('',$matches[0]);
			$exist = $this->pali54_model->selone2($this->input->post('palq01a'),$tg003);
			if ($exist)
			  {
				$tg003 = $ori_date;
			  }
			$data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'tg002' => $this->input->post('cmsq05a'),
		          'tg003' => $tg003,
		          'tg004' => $this->input->post('tg004'),
                  'tg005' => $this->input->post('tg005'),
				  'tg006' => $this->input->post('tg006'),
				  'tg007' => $this->input->post('tg007'),
				  'tg008' => $this->input->post('tg008'),
				  'tg009' => $this->input->post('tg009'),
				  'tg010' => $this->input->post('tg010'),
				  'tg011' => $this->input->post('tg011'),
				  'tg012' => $this->input->post('tg012'),
				  'tg013' => $this->input->post('tg013'),
				  'tg014' => $this->input->post('tg014'),
				  'tg015' => $this->input->post('tg015'),
				  'tg016' => $this->input->post('tg016'),
				  'tg017' => $this->input->post('tg017'),
				  'tg018' => $this->input->post('tg018'),
				  'tg019' => $this->input->post('tg019'),
				  'tg020' => $this->input->post('tg020'),
				  'tg021' => $this->input->post('tg021'),
				  'tg022' => $this->input->post('tg022'),
				   'tg023' => $this->input->post('tg023'),
				   'tg201' => $this->input->post('tg201'),
				   'tg202' => $this->input->post('tg202'),
				  'tg203' => $this->input->post('tg203')
            );
			
            $this->db->where('tg001', $this->input->post('palq01a'));
	        $this->db->where('tg003', $ori_date);
            $this->db->update('paltg',$data);                   //更改一筆
			//echo "<pre>";var_dump($this->db);exit;
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
	    $this->db->where('tg001', $seg1);
        $this->db->delete('paltg'); 
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
			  $this->db->where('tg001', $seq1);
			  $this->db->where('tg003', $seq2);
              $this->db->delete('paltg'); 
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
			
	    if ($query->num_rows() > 0) 
		{
		   return true;
		}
	}
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>