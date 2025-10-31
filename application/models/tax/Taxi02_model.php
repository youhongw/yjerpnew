<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxi02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006,mb017,mb025,mb069 create_date');
          $this->db->from('taxmb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('taxmb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006','mb200','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select(' * ')
	                        ->from('taxmb')
		                    ->order_by($sort_by, $sort_order)
		                    ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('taxmb');
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
		$this->session->set_userdata('taxi02_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['taxi02']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['taxi02']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mb001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['taxi02']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['taxi02']['search']['where'];
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
				//$value .= $val." like '%".$val_ary[$key]."%' ";
				
				if($val != "chkbx"){
				$value .= $val." like '".$val_ary[$key]."%' ";}
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
		
		if(isset($_SESSION['taxi02']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['taxi02']['search']['order'];
		}
		
		if(!isset($_SESSION['taxi02']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,b.ma002 as ma001disp')
			->from('taxmb as a')
			->join('taxma as b', 'mb001 = b.ma001','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.*,b.ma002 as ma001disp')
			->from('taxmb as a')
			->join('taxma as b', 'mb001 = b.ma001','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['taxi02']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('taxmb');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['taxi02']['search']['where'] = $where;
		$_SESSION['taxi02']['search']['order'] = $order;
		$_SESSION['taxi02']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//***新增暫存view表方法construct_view
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mb001","mb200","mb206","mb207"
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
		$_SESSION['taxi02']['search']['view'] = $view_array;
		$_SESSION['taxi02']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['taxi02']['search']['view']);exit;
		
	}
	 //查詢一筆 修改用  
	function selone($seq1,$seq2,$seq3,$seq4)    
        {
		  $this->db->select(' a.*,b.ma002 as mb001disp ');
          $this->db->from('taxmb as a');
		  $this->db->join('taxma as b', 'a.mb001 = b.ma001','left');
		  $this->db->where('mb001', $seq1); 
		  $this->db->where('mb200', $seq2);
		  $this->db->where('mb206', $seq3);
		  $this->db->where('mb207', $seq4);
	//	  $this->db->query('SET SQL_BIG_SELECTS=1');
		  $query = $this->db->get();
		//  var_dump($query);exit;
		  
	      if ($query->num_rows() > 0) 
		   {
		    $result = $query->result();
		    return $result;   
		  }
	   }
	   
	//進階查詢   
	function findf($limit, $offset, $sort_by, $sort_order)     
        {            		
	     $seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `taxmb` ";
	     $seq1 = "mb001, mb002, mb003, mb004, mb005, mb006,mb007,mb017,mb025,mb069, create_date FROM `taxmb` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mb001 desc' ;
         $seq9 = " ORDER BY mb001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mb001 ";

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
		if(@$_SESSION['taxi02_sql_term']){$seq32 = $_SESSION['taxi02_sql_term'];}
		if(@$_SESSION['taxi02_sql_sort']){$seq33 = $_SESSION['taxi02_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mb001', 'mb200', 'mb204', 'mb205', 'mb206', 'mb207','mb208','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('taxmb')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('taxmb')
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
	     $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006','mb017','mb025','mb200','create_date');
         $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否為 table
			
	     $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006,mb017,mb025,mb069,mb200, create_date');
	     $this->db->from('taxmb');
	     $this->db->like($sort_by, $seq4, 'after');
	     $this->db->order_by($sort_by, $sort_order);
	     //$this->db->order_by('mb001 asc, mb002 asc');
	     $this->db->limit($limit, $offset);   // 每頁15筆
	     $query = $this->db->get();    
	     $ret['rows'] = $query->result();
						
	     $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('taxmb');
	     $this->db->like($sort_by, $seq4, 'after');	
	     $query = $this->db->get();
	     $tmp = $query->result();		
	     $ret['num_rows'] = $tmp[0]->count;			
	     return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
        {
	     $this->db->set('mb001', $this->input->post('mb001')); 
	     $this->db->where('mb001', $this->input->post('mb001'));
	     $query = $this->db->get('taxmb');
	     return $query->num_rows() ;
	    }  
		
	//新增一筆	
	function insertf()    
        {
			if ($this->input->post()){
				extract($this->input->post());
			}
			preg_match_all('/\d/S',$this->input->post('mb200'), $matches);  //處理日期年月字串
			 $mc200 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('mb204'), $matches);  //處理日期年月字串
			 $mc204 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('mb205'), $matches);  //處理日期年月字串
			 $mc205 = implode('',$matches[0]);
			// $mb001=$this->input->post('cmsi11');
		//	var_dump($this->input->post('userfile'));exit;
	     $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => '',
		        'modi_date' => '',
		        'flag' => 0,
                'mb001' => strtoupper($this->input->post('cmsi11')),
		        'mb200' => $mc200,
		        'mb201' => $this->input->post('mb201'),
		        'mb202' => $this->input->post('mb202'),	
                'mb203' => $this->input->post('mb203'),		
                'mb204' => $mc204,		
                'mb205' => $mc205,		
                'mb206' => strtoupper($this->input->post('mb206')),	
                'mb207' => $this->input->post('mb207'),	
                'mb208' => $this->input->post('mb208'),	
                'mb209' => $this->input->post('mb209'),	
                'mb210' => $this->input->post('mb210'),
                'mb211' => $this->input->post('mb211'),	
                'mb212' => $this->input->post('mb212'),	
                'mb213' => $this->input->post('mb213')
                );
         
	     $exist = $this->taxi02_model->selone1($cmsi11,$mb200,$mb206,$mb207);
	     if ($exist)
	       {
		    return 'exist';
		   } 
            return  $this->db->insert('taxmb', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
        { 	
	     $this->db->set('mb001', $this->input->post('mb001c'));
	     $this->db->where('mb001', $this->input->post('mb001c'));
	     $query = $this->db->get('taxmb');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
          {
	       $this->db->set('mb001', $this->input->post('mb001o'));
	       $this->db->where('mb001', $this->input->post('mb001o'));
	       $query = $this->db->get('taxmb');
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
                $mb002=$row->mb002;$mb003=$row->mb003;$mb004=$row->mb004;$mb005=$row->mb005;$mb006=$row->mb006;$mb007=$row->mb007;$mb008=$row->mb008;$mb009=$row->mb009;$mb010=$row->mb010;
				$mb011=$row->mb011;$mb012=$row->mb012;$mb013=$row->mb013;$mb014=$row->mb014;$mb015=$row->mb015;$mb016=$row->mb016;$mb017=$row->mb017;$mb018=$row->mb018;$mb019=$row->mb019;$mb020=$row->mb020;
				$mb021=$row->mb021;$mb022=$row->mb022;$mb023=$row->mb023;$mb024=$row->mb024;$mb025=$row->mb025;$mb026=$row->mb026;$mb027=$row->mb027;$mb028=$row->mb028;$mb029=$row->mb029;$mb030=$row->mb030;		 
                $mb031=$row->mb031;$mb032=$row->mb032;$mb033=$row->mb033;$mb034=$row->mb034;$mb035=$row->mb035;$mb036=$row->mb036;$mb037=$row->mb037;$mb038=$row->mb038;$mb039=$row->mb039;$mb040=$row->mb040;
				$mb041=$row->mb041;$mb042=$row->mb042;$mb043=$row->mb043;$mb044=$row->mb044;$mb045=$row->mb045;$mb046=$row->mb046;$mb047=$row->mb047;$mb048=$row->mb048;$mb049=$row->mb049;$mb050=$row->mb050;
				$mb051=$row->mb051;$mb052=$row->mb052;$mb053=$row->mb053;$mb054=$row->mb054;$mb055=$row->mb055;$mb056=$row->mb056;$mb057=$row->mb057;$mb058=$row->mb058;$mb059=$row->mb059;$mb060=$row->mb060;
				$mb061=$row->mb061;$mb062=$row->mb062;$mb063=$row->mb063;$mb064=$row->mb064;$mb065=$row->mb065;$mb066=$row->mb066;$mb067=$row->mb067;$mb068=$row->mb068;$mb069=$row->mb069;$mb070=$row->mb070;
				$mb071=$row->mb071;$mb072=$row->mb072;$mb073=$row->mb073;$mb074=$row->mb074;$mb075=$row->mb075;$mb076=$row->mb076;$mb077=$row->mb077;$mb078=$row->mb078;$mb079=$row->mb079;$mb080=$row->mb080;
				$mb081=$row->mb081;$mb082=$row->mb082;$mb083=$row->mb083;$mb084=$row->mb084;$mb085=$row->mb085;$mb086=$row->mb086;$mb087=$row->mb087;$mb088=$row->mb088;$mb089=$row->mb089;$mb090=$row->mb090;      						   
	 	        $mb091=$row->mb091;$mb092=$row->mb092;$mb093=$row->mb093;$mb094=$row->mb094;$mb095=$row->mb095;$mb096=$row->mb096;
			  endforeach;
		     }   
		  
            $seq3=$this->input->post('mb001c');    //主鍵一筆
	        $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                 
		          'mb001' => $seq3,'mb002' => $mb002,'mb003' => $mb003,'mb004' => $mb004,'mb005' => $mb005,'mb006' => $mb006,'mb007' => $mb007,'mb008' => $mb008,'mb009' => $mb009,'mb010' => $mb010,
		          'mb011' => $mb011,'mb012' => $mb012,'mb013' => $mb013,'mb014' => $mb014,'mb015' => $mb015,'mb016' => $mb016,'mb017' => $mb017,'mb018' => $mb018,'mb019' => $mb019,'mb020' => $mb020,
		          'mb021' => $mb021,'mb022' => $mb022,'mb023' => $mb023,'mb024' => $mb024,'mb025' => $mb025,'mb026' => $mb026,'mb027' => $mb027,'mb028' => $mb028,'mb029' => $mb029,'mb030' => $mb030,
				  'mb031' => $mb031,'mb032' => $mb032,'mb033' => $mb033,'mb034' => $mb034,'mb035' => $mb035,'mb036' => $mb036,'mb037' => $mb037,'mb038' => $mb038,'mb039' => $mb039,'mb040' => $mb040,
				  'mb041' => $mb041,'mb042' => $mb042,'mb043' => $mb043,'mb044' => $mb044,'mb045' => $mb045,'mb046' => $mb046,'mb047' => $mb047,'mb048' => $mb048,'mb049' => $mb049,'mb050' => $mb050,
				  'mb051' => $mb051,'mb052' => $mb052,'mb053' => $mb053,'mb054' => $mb054,'mb055' => $mb055,'mb056' => $mb056,'mb057' => $mb057,'mb058' => $mb058,'mb059' => $mb059,'mb060' => $mb060,
				  'mb061' => $mb061,'mb062' => $mb062,'mb063' => $mb063,'mb064' => $mb064,'mb065' => $mb065,'mb066' => $mb066,'mb067' => $mb067,'mb068' => $mb058,'mb069' => $mb069,'mb070' => $mb070,
				  'mb071' => $mb071,'mb072' => $mb072,'mb073' => $mb073,'mb074' => $mb074,'mb075' => $mb075,'mb076' => $mb076,'mb077' => $mb077,'mb078' => $mb078,'mb079' => $mb079,'mb080' => $mb080,
				  'mb081' => $mb081,'mb082' => $mb082,'mb083' => $mb083,'mb084' => $mb084,'mb085' => $mb085,'mb086' => $mb086,'mb087' => $mb087,'mb088' => $mb088,'mb089' => $mb089,'mb090' => $mb090,
				  'mb091' => $mb081,'mb092' => $mb092,'mb093' => $mb093,'mb094' => $mb094,'mb095' => $mb095,
				  'mb096' => $mb096             
                         );
             $exist = $this->taxi02_model->selone2($this->input->post('mb001c'));
		     if ($exist)
		       {
			    return 'exist';
		       }         
                return $this->db->insert('taxmb', $data);      //複製一筆  
          }	
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('mb001o');    
	     $seq2=$this->input->post('mb001c'); 
	     $sql = " SELECT mb001,mb200,mb204,mb205,mb206,mb207,mb208 FROM taxmb WHERE mb200 >= '$seq1'  AND mb200 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('mb001o');    
	     $seq2=$this->input->post('mb001c');
	     $sql = " SELECT *  FROM taxmb WHERE mb200 >= '$seq1'  AND mb200 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "mb001 >= '$seq1'  AND mb001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		               ->from('taxmb')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//更改一筆	 
	function updatef()   //更改一筆
          {
			  // if (!$this->input->post('userfile')) {$this->input->post('userfile')=$this->uri->segment(4);}
			 //  var_dump($this->input->post('userfile'));exit;
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		         
		        'mb201' => $this->input->post('mb201'),
		        'mb202' => $this->input->post('mb202'),	
                'mb203' => $this->input->post('mb203'),		
                'mb204' => $this->input->post('mb204'),		
                'mb205' => $this->input->post('mb205'),		
               
                'mb208' => $this->input->post('mb208'),	
                'mb209' => $this->input->post('mb209'),	
                'mb210' => $this->input->post('mb210'),
                'mb211' => $this->input->post('mb211'),	
                'mb212' => $this->input->post('mb212'),	
                'mb213' => $this->input->post('mb213')
                        );
            $this->db->where('mb001', $this->input->post('cmsi11'));
			$this->db->where('mb200', $this->input->post('mb200'));
			$this->db->where('mb206', $this->input->post('mb206'));
			$this->db->where('mb207', $this->input->post('mb207'));
            $this->db->update('taxmb',$data);                   //更改一筆
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
         $seg2=$this->uri->segment(5); 
	     $this->db->where('mb001', $seg1);
	     $this->db->where('mb002', $seg2);
         $this->db->delete('taxmb'); 
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
		      list($seq1, $seq2, $seq3, $seq4) = explode("/", $seq[$x]);
		      list($seq1, $seq2, $seq3, $seq4) = explode("/", $seq[$x]);
		      $seq1;
		   	  $seq2;
			  $seq3;
			  $seq4;
			  $this->db->where('mb001', $seq1);
			  $this->db->where('mb200', $seq2);
			  $this->db->where('mb206', $seq3);
			  $this->db->where('mb207', $seq4);
              $this->db->delete('taxmb'); 
	         }
           }
	     if ($this->db->affected_rows() > 0)
           {
            return TRUE;
           }
            return FALSE;					
        }
		
	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 品號
	function lookup(){
		 $this->db->select('mb001, mb002, mb003, mb004, mb017, b.mc002 as mb017disp');
	  $this->db->from('taxmb');
	  $this->db->join('cmsmc as b', 'mb017 = b.mc001','left');
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }
	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd($keyword){     
      $this->db->select('mb001, mb002, mb003, mb004, mb017, b.mc002 as mb017disp');
	  $this->db->from('taxmb');
	  $this->db->join('cmsmc as b', 'mb017 = b.mc001','left');
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookupd2($keyword){     
      $this->db->select('mb001, mb002, mb003, mb004, mb017, b.mc002 as mb017disp');
	  $this->db->from('taxmb');
	  $this->db->join('cmsmc as b', 'mb017 = b.mc001','left');
      $this->db->where('mb001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 查詢一筆 品號 key 	
	function ajaxkey($seg1)    
        { 	              
	     $this->db->set('mb001', $this->uri->segment(4));
	     $this->db->where('mb001', $this->uri->segment(4));	
	     $query = $this->db->get('taxmb');
			
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
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>