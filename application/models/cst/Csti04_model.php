<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class csti04_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('me001, me002, me003, me004, me005, me006,me017,me025,me069 create_date');
          $this->db->from('cstme');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('me001 desc, me002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cstme');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('me001', 'me002', 'me003', 'me004', 'me005', 'me006','mb200','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('me001, me002, me003, me004, me005, me006,me017,me025,me069,mb200,create_date')
	                        ->from('cstme')
		                    ->order_by($sort_by, $sort_order)
		                    ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('cstme');
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
		$this->session->set_userdata('csti04_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['csti04']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "me001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['csti04']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['csti04']['search']['where'];
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
		
		if(isset($_SESSION['csti04']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['csti04']['search']['order'];
		}
		
		if(!isset($_SESSION['csti04']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,mb002 as me001disp, mb003 as me001disp1, mb004 as me001disp2')
			->from('cstme as a')
			->join('invmb as b', 'me001 = b.mb001','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.*,mb002 as me001disp, mb003 as me001disp1, mb004 as me001disp2')
			->from('cstme as a')
			->join('invmb as b', 'me001 = b.mb001','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['csti04']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('cstme');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['csti04']['search']['where'] = $where;
		$_SESSION['csti04']['search']['order'] = $order;
		$_SESSION['csti04']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//***新增暫存view表方法construct_view
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"me001"
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
		$_SESSION['csti04']['search']['view'] = $view_array;
		$_SESSION['csti04']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['csti04']['search']['view']);exit;
		
	}
	 //查詢一筆 修改用  
	function selone($seg1)    
        {
		  $this->db->select('a.*,mb002 as me001disp, mb003 as me001disp1, mb004 as me001disp2');
          $this->db->from('cstme as a');
		  $this->db->join('invmb as b', 'me001 = b.mb001','left');
		  $this->db->where('me001', $this->uri->segment(4)); 
	//	  $this->db->query('SET SQL_BIG_SELECTS=1');
		  $query = $this->db->get();
			
	      if ($query->num_rows() > 0) 
		   {
		    $result = $query->result();
		    return $result;   
		  }
	   }
	   
	//進階查詢   
	function findf($limit, $offset, $sort_by, $sort_order)     
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `cstme` ";
	     $seq1 = "me001, me002, me003, me004, me005, me006,me007,me017,me025,me069, create_date FROM `cstme` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'me001 desc' ;
         $seq9 = " ORDER BY me001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="me001 ";

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
		if(@$_SESSION['csti04_sql_term']){$seq32 = $_SESSION['csti04_sql_term'];}
		if(@$_SESSION['csti04_sql_sort']){$seq33 = $_SESSION['csti04_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('me001', 'me002', 'me003', 'me004', 'me005', 'me006','me007','me017','mb200','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('me001, me002, me003, me004, me005, me006,me007,me017,me025,me069,mb200, create_date')
	                       ->from('cstme')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cstme')
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
	     $sort_columns = array('me001', 'me002', 'me003', 'me004', 'me005', 'me006','me017','me025','mb200','create_date');
         $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否為 table
			
	     $this->db->select('me001, me002, me003, me004, me005, me006,me017,me025,me069,mb200, create_date');
	     $this->db->from('cstme');
	     $this->db->like($sort_by, $seq4, 'after');
	     $this->db->order_by($sort_by, $sort_order);
	     //$this->db->order_by('me001 asc, me002 asc');
	     $this->db->limit($limit, $offset);   // 每頁15筆
	     $query = $this->db->get();    
	     $ret['rows'] = $query->result();
						
	     $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('cstme');
	     $this->db->like($sort_by, $seq4, 'after');	
	     $query = $this->db->get();
	     $tmp = $query->result();		
	     $ret['num_rows'] = $tmp[0]->count;			
	     return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
        {
	     $this->db->set('me001', $this->input->post('me001')); 
	     $this->db->where('me001', $this->input->post('me001'));
	     $query = $this->db->get('cstme');
	     return $query->num_rows() ;
	    }  
		
	//新增一筆	
	function insertf()    
        {
			
		//	var_dump($this->input->post('userfile'));exit;
	     $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => '',
		        'modi_date' => '',
		        'flag' => 0,
                'me001' => strtoupper($this->input->post('me001')),
		        'me002' => strtoupper($this->input->post('me002')),
		        'me003' => strtoupper($this->input->post('me003')),
		        'me004' => strtoupper($this->input->post('me004')),
		        'me005' => $this->input->post('me005'),
		        'me006' => $this->input->post('me006'),
                'me007' => $this->input->post('me007'),
                'me008' => $this->input->post('me008'),
                'me009' => $this->input->post('me009'),
                'me010' => $this->input->post('me010'),		
                'me011' => $this->input->post('me011'),	
                'me012' => $this->input->post('me012'),		
                'me013' => $this->input->post('me013'),		
                'me014' => $this->input->post('me014'),		
                'me015' => $this->input->post('me015'),		
                'me016' => $this->input->post('me016'),		
                'me017' => $this->input->post('me017'),		
                'me018' => $this->input->post('me018'),		
                'me019' => $this->input->post('me019'),		
                'me020' => $this->input->post('me020'),	
                'me021' => $this->input->post('me021'),	
                'me022' => $this->input->post('me022'),	
                'me023' => $this->input->post('me023'),	
                'me024' => $this->input->post('me024'),	
                'me025' => $this->input->post('me025'),	
                'me026' => $this->input->post('me026'),	
                'me027' => $this->input->post('me027'),	
                'me028' => $this->input->post('me028'),	
                'me029' => $this->input->post('me029'),	
                'me030' => $this->input->post('me030'),
                'me031' => $this->input->post('me031'),	
                'me032' => $this->input->post('me032'),	
                'me033' => $this->input->post('me033'),	
                'me034' => $this->input->post('me034'),	
                'me035' => $this->input->post('me035')
                );
         
	     $exist = $this->csti04_model->selone1($this->input->post('me001'));
	     if ($exist)
	       {
		    return 'exist';
		   } 
            return  $this->db->insert('cstme', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
        { 	
	     $this->db->set('me001', $this->input->post('me001c'));
	     $this->db->where('me001', $this->input->post('me001c'));
	     $query = $this->db->get('cstme');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
          {
	       $this->db->set('me001', $this->input->post('me001o'));
	       $this->db->where('me001', $this->input->post('me001o'));
	       $query = $this->db->get('cstme');
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
                $me002=$row->me002;$me003=$row->me003;$me004=$row->me004;$me005=$row->me005;$me006=$row->me006;$me007=$row->me007;$me008=$row->me008;$me009=$row->me009;$me010=$row->me010;
				$me011=$row->me011;$me012=$row->me012;$me013=$row->me013;$me014=$row->me014;$me015=$row->me015;$me016=$row->me016;$me017=$row->me017;$me018=$row->me018;$me019=$row->me019;$me020=$row->me020;
				$me021=$row->me021;$me022=$row->me022;$me023=$row->me023;$me024=$row->me024;$me025=$row->me025;$me026=$row->me026;$me027=$row->me027;$me028=$row->me028;$me029=$row->me029;$me030=$row->me030;		 
                $me031=$row->me031;$me032=$row->me032;$me033=$row->me033;$me034=$row->me034;$me035=$row->me035;$me036=$row->me036;$me037=$row->me037;$me038=$row->me038;$me039=$row->me039;$me040=$row->me040;
				$me041=$row->me041;$me042=$row->me042;$me043=$row->me043;$me044=$row->me044;$me045=$row->me045;$me046=$row->me046;$me047=$row->me047;$me048=$row->me048;$me049=$row->me049;$me050=$row->me050;
				$me051=$row->me051;$me052=$row->me052;$me053=$row->me053;$me054=$row->me054;$me055=$row->me055;$me056=$row->me056;$me057=$row->me057;$me058=$row->me058;$me059=$row->me059;$me060=$row->me060;
				$me061=$row->me061;$me062=$row->me062;$me063=$row->me063;$me064=$row->me064;$me065=$row->me065;$me066=$row->me066;$me067=$row->me067;$me068=$row->me068;$me069=$row->me069;$me070=$row->me070;
				$me071=$row->me071;$me072=$row->me072;$me073=$row->me073;$me074=$row->me074;$me075=$row->me075;$me076=$row->me076;$me077=$row->me077;$me078=$row->me078;$me079=$row->me079;$me080=$row->me080;
				$me081=$row->me081;$me082=$row->me082;$me083=$row->me083;$me084=$row->me084;$me085=$row->me085;$me086=$row->me086;$me087=$row->me087;$me088=$row->me088;$me089=$row->me089;$me090=$row->me090;      						   
	 	        $me091=$row->me091;$me092=$row->me092;$me093=$row->me093;$me094=$row->me094;$me095=$row->me095;$me096=$row->me096;
			  endforeach;
		     }   
		  
            $seq3=$this->input->post('me001c');    //主鍵一筆
	        $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                 
		          'me001' => $seq3,'me002' => $me002,'me003' => $me003,'me004' => $me004,'me005' => $me005,'me006' => $me006,'me007' => $me007,'me008' => $me008,'me009' => $me009,'me010' => $me010,
		          'me011' => $me011,'me012' => $me012,'me013' => $me013,'me014' => $me014,'me015' => $me015,'me016' => $me016,'me017' => $me017,'me018' => $me018,'me019' => $me019,'me020' => $me020,
		          'me021' => $me021,'me022' => $me022,'me023' => $me023,'me024' => $me024,'me025' => $me025,'me026' => $me026,'me027' => $me027,'me028' => $me028,'me029' => $me029,'me030' => $me030,
				  'me031' => $me031,'me032' => $me032,'me033' => $me033,'me034' => $me034,'me035' => $me035,'me036' => $me036,'me037' => $me037,'me038' => $me038,'me039' => $me039,'me040' => $me040,
				  'me041' => $me041,'me042' => $me042,'me043' => $me043,'me044' => $me044,'me045' => $me045,'me046' => $me046,'me047' => $me047,'me048' => $me048,'me049' => $me049,'me050' => $me050,
				  'me051' => $me051,'me052' => $me052,'me053' => $me053,'me054' => $me054,'me055' => $me055,'me056' => $me056,'me057' => $me057,'me058' => $me058,'me059' => $me059,'me060' => $me060,
				  'me061' => $me061,'me062' => $me062,'me063' => $me063,'me064' => $me064,'me065' => $me065,'me066' => $me066,'me067' => $me067,'me068' => $me058,'me069' => $me069,'me070' => $me070,
				  'me071' => $me071,'me072' => $me072,'me073' => $me073,'me074' => $me074,'me075' => $me075,'me076' => $me076,'me077' => $me077,'me078' => $me078,'me079' => $me079,'me080' => $me080,
				  'me081' => $me081,'me082' => $me082,'me083' => $me083,'me084' => $me084,'me085' => $me085,'me086' => $me086,'me087' => $me087,'me088' => $me088,'me089' => $me089,'me090' => $me090,
				  'me091' => $me081,'me092' => $me092,'me093' => $me093,'me094' => $me094,'me095' => $me095,
				  'me096' => $me096             
                         );
             $exist = $this->csti04_model->selone2($this->input->post('me001c'));
		     if ($exist)
		       {
			    return 'exist';
		       }         
                return $this->db->insert('cstme', $data);      //複製一筆  
          }	
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('me001o');    
	     $seq2=$this->input->post('me001c'); 
	     $sql = " SELECT me001,me002,me003,me004,me013,me017,create_date FROM cstme WHERE me001 >= '$seq1'  AND me001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('me001o');    
	     $seq2=$this->input->post('me001c');
	     $sql = " SELECT me001,me002,me003,me004,me013,me017,create_date  FROM cstme WHERE me001 >= '$seq1'  AND me001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "me001 >= '$seq1'  AND me001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		               ->from('cstme')
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
		          'me003' => strtoupper($this->input->post('me003')),
		        'me004' => strtoupper($this->input->post('me004')),
		        'me005' => $this->input->post('me005'),
		        'me006' => $this->input->post('me006'),
                'me007' => $this->input->post('me007'),
                'me008' => $this->input->post('me008'),
                'me009' => $this->input->post('me009'),
                'me010' => $this->input->post('me010'),		
                'me011' => $this->input->post('me011'),	
                'me012' => $this->input->post('me012'),		
                'me013' => $this->input->post('me013'),		
                'me014' => $this->input->post('me014'),		
                'me015' => $this->input->post('me015'),		
                'me016' => $this->input->post('me016'),		
                'me017' => $this->input->post('me017'),		
                'me018' => $this->input->post('me018'),		
                'me019' => $this->input->post('me019'),		
                'me020' => $this->input->post('me020'),	
                'me021' => $this->input->post('me021'),	
                'me022' => $this->input->post('me022'),	
                'me023' => $this->input->post('me023'),	
                'me024' => $this->input->post('me024'),	
                'me025' => $this->input->post('me025'),	
                'me026' => $this->input->post('me026'),	
                'me027' => $this->input->post('me027'),	
                'me028' => $this->input->post('me028'),	
                'me029' => $this->input->post('me029'),	
                'me030' => $this->input->post('me030'),
                'me031' => $this->input->post('me031'),	
                'me032' => $this->input->post('me032'),	
                'me033' => $this->input->post('me033'),	
                'me034' => $this->input->post('me034'),	
                'me035' => $this->input->post('me035')
                        );
            $this->db->where('me001', $this->input->post('me001'));
            $this->db->update('cstme',$data);                   //更改一筆
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
	     $this->db->where('me001', $seg1);
	     $this->db->where('me002', $seg2);
         $this->db->delete('cstme'); 
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
		      //list($seq1, $seq2) = explode("/", $seq[$x]);
		      list($seq1) = explode("/", $seq[$x]);
		      $seq1;
		   	  //$seq2;
			  $this->db->where('me001', $seq1);
			  //$this->db->where('me002', $seq2);
              $this->db->delete('cstme'); 
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
		 $this->db->select('me001, me002, me003, me004, me017, b.mc002 as me017disp');
	  $this->db->from('cstme');
	  $this->db->join('cmsmc as b', 'me017 = b.mc001','left');
      $this->db->like('me001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('me002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }
	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd($keyword){     
      $this->db->select('me001, me002, me003, me004, me017, b.mc002 as me017disp');
	  $this->db->from('cstme');
	  $this->db->join('cmsmc as b', 'me017 = b.mc001','left');
      $this->db->like('me001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('me002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookupd2($keyword){     
      $this->db->select('me001, me002, me003, me004, me017, b.mc002 as me017disp');
	  $this->db->from('cstme');
	  $this->db->join('cmsmc as b', 'me017 = b.mc001','left');
      $this->db->where('me001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 查詢一筆 品號 key 	
	function ajaxkey($seg1)    
        { 	              
	     $this->db->set('me001', $this->uri->segment(4));
	     $this->db->where('me001', $this->uri->segment(4));	
	     $query = $this->db->get('cstme');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->me001;
           }
		    return $result;   
		 }
	    }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>