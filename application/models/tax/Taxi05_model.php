<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxi05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mf001, mf002, mf003, mf004, mf005, mf006,mf017,mf025,mf069 create_date');
          $this->db->from('taxmf');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mf001 desc, mf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('taxmf');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('mf001', 'mf002', 'mf003', 'mf004', 'mf005', 'mf006','mb200','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('mf001, mf002, mf003, mf004, mf005, mf006,mf017,mf025,mf069,mb200,create_date')
	                        ->from('taxmf')
		                    ->order_by($sort_by, $sort_order)
		                    ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('taxmf');
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
		$this->session->set_userdata('taxi05_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['taxi05']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['taxi05']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mf005 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['taxi05']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['taxi05']['search']['where'];
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
		
		if(isset($_SESSION['taxi05']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['taxi05']['search']['order'];
		}
		
		if(!isset($_SESSION['taxi05']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select(' *')
			->from('taxmf ')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);
		
		$query = $this->db->select(' * ')
			->from('taxmf ')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['taxi05']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('taxmf');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['taxi05']['search']['where'] = $where;
		$_SESSION['taxi05']['search']['order'] = $order;
		$_SESSION['taxi05']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//***新增暫存view表方法construct_view
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mf005"
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
		$_SESSION['taxi05']['search']['view'] = $view_array;
		$_SESSION['taxi05']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['taxi05']['search']['view']);exit;
		
	}
	 //查詢一筆 修改用  
	function selone($seg1)    
        {
		  $this->db->select(' a.*,ma002 as mf001disp ');
          $this->db->from('taxmf as a');
		  $this->db->join('taxma as c', 'a.mf001 = c.ma001 ','left');
		  $this->db->where('mf005', $seg1); 
	//	  $this->db->query('SET SQL_BIG_SELECTS=1');
	      $query = $this->db->get();
	     if ($query->num_rows() > 0) {
		   $result = $query->result();
		   return $result;   
		 }
	   }
	   
	//進階查詢   
	function findf($limit, $offset, $sort_by, $sort_order)     
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `taxmf` ";
	     $seq1 = "mf001, mf002, mf003, mf004, mf005, mf006,mf007,mf017,mf025,mf069, create_date FROM `taxmf` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mf001 desc' ;
         $seq9 = " ORDER BY mf001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mf001 ";

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
		if(@$_SESSION['taxi05_sql_term']){$seq32 = $_SESSION['taxi05_sql_term'];}
		if(@$_SESSION['taxi05_sql_sort']){$seq33 = $_SESSION['taxi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mf001', 'mf002', 'mf003', 'mf004', 'mf005', 'mf006','mf007','mf017','mb200','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('taxmf')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('taxmf')
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
	     $sort_columns = array('mf001', 'mf002', 'mf003', 'mf004', 'mf005', 'mf006','mf017','mf025','mb200','create_date');
         $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否為 table
			
	     $this->db->select('mf001, mf002, mf003, mf004, mf005, mf006,mf017,mf025,mf069,mb200, create_date');
	     $this->db->from('taxmf');
	     $this->db->like($sort_by, $seq4, 'after');
	     $this->db->order_by($sort_by, $sort_order);
	     //$this->db->order_by('mf001 asc, mf002 asc');
	     $this->db->limit($limit, $offset);   // 每頁15筆
	     $query = $this->db->get();    
	     $ret['rows'] = $query->result();
						
	     $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('taxmf');
	     $this->db->like($sort_by, $seq4, 'after');	
	     $query = $this->db->get();
	     $tmp = $query->result();		
	     $ret['num_rows'] = $tmp[0]->count;			
	     return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2,$seg3)    
        {
	     $this->db->set('mf001', $seg1); 
	     $this->db->where('mf002', $seg2);
		 $this->db->where('mf005', $seg3);
	     $query = $this->db->get('taxmf');
	     return $query->num_rows() ;
	    }  
		
	//新增一筆	
	function insertf()    
        {
			
		     preg_match_all('/\d/S',$this->input->post('mf002'), $matches);  //處理日期字串
			 $mf002 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('mf006'), $matches);  //處理日期年月字串
			 $mf006 = implode('',$matches[0]);
			 $mf001=$this->input->post('mf001');
			 $mf005=$this->input->post('mf005');
			 $mf005no=$mf005;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->taxi05_model->selone1($mf001,$mf002,$mf005)>0){
				$mf005 = $this->check_title_no($mf001,$mf002,$mf005);
				$mf005no=$mf005;
			}
	     $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => '',
		        'modi_date' => '',
		        'flag' => 0,
                'mf001' => strtoupper($this->input->post('mf001')),
		        'mf002' => $mf002,
		        'mf003' => strtoupper($this->input->post('mf003')),
		        'mf004' => strtoupper($this->input->post('mf004')),
		        'mf005' => $mf005no,
		        'mf006' => $mf006,
                'mf007' => $this->input->post('mf007'),
                'mf008' => $this->input->post('mf008'),
                'mf009' => $this->input->post('mf009'),
                'mf010' => $this->input->post('mf010'),
                'mf011' => $this->input->post('mf011'),	
                'mf012' => $this->input->post('mf012'),		
                'mf013' => $this->input->post('mf013'),		
                'mf014' => $this->input->post('mf014'),		
                'mf015' => $this->input->post('mf015'),		
                'mf016' => $this->input->post('mf016'),		
                'mf017' => $this->input->post('mf017'),		
                'mf018' => $this->input->post('mf018')
                );
         
	     $exist = $this->taxi05_model->selone1($mf001,$mf002,$mf005);
	     if ($exist)
	       {
		    return 'exist';
		   } 
            return  $this->db->insert('taxmf', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
        { 	
	     $this->db->set('mf001', $this->input->post('mf001c'));
	     $this->db->where('mf001', $this->input->post('mf001c'));
	     $query = $this->db->get('taxmf');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
          {
	       $this->db->set('mf001', $this->input->post('mf001o'));
	       $this->db->where('mf001', $this->input->post('mf001o'));
	       $query = $this->db->get('taxmf');
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
                $mf002=$row->mf002;$mf003=$row->mf003;$mf004=$row->mf004;$mf005=$row->mf005;$mf006=$row->mf006;$mf007=$row->mf007;$mf008=$row->mf008;$mf009=$row->mf009;$mf010=$row->mf010;
				$mf011=$row->mf011;$mf012=$row->mf012;$mf013=$row->mf013;$mf014=$row->mf014;$mf015=$row->mf015;$mf016=$row->mf016;$mf017=$row->mf017;$mf018=$row->mf018;$mf019=$row->mf019;$mf020=$row->mf020;
				$mf021=$row->mf021;$mf022=$row->mf022;$mf023=$row->mf023;$mf024=$row->mf024;$mf025=$row->mf025;$mf026=$row->mf026;$mf027=$row->mf027;$mf028=$row->mf028;$mf029=$row->mf029;$mf030=$row->mf030;		 
                $mf031=$row->mf031;$mf032=$row->mf032;$mf033=$row->mf033;$mf034=$row->mf034;$mf035=$row->mf035;$mf036=$row->mf036;$mf037=$row->mf037;$mf038=$row->mf038;$mf039=$row->mf039;$mf040=$row->mf040;
				$mf041=$row->mf041;$mf042=$row->mf042;$mf043=$row->mf043;$mf044=$row->mf044;$mf045=$row->mf045;$mf046=$row->mf046;$mf047=$row->mf047;$mf048=$row->mf048;$mf049=$row->mf049;$mf050=$row->mf050;
				$mf051=$row->mf051;$mf052=$row->mf052;$mf053=$row->mf053;$mf054=$row->mf054;$mf055=$row->mf055;$mf056=$row->mf056;$mf057=$row->mf057;$mf058=$row->mf058;$mf059=$row->mf059;$mf060=$row->mf060;
				$mf061=$row->mf061;$mf062=$row->mf062;$mf063=$row->mf063;$mf064=$row->mf064;$mf065=$row->mf065;$mf066=$row->mf066;$mf067=$row->mf067;$mf068=$row->mf068;$mf069=$row->mf069;$mf070=$row->mf070;
				$mf071=$row->mf071;$mf072=$row->mf072;$mf073=$row->mf073;$mf074=$row->mf074;$mf075=$row->mf075;$mf076=$row->mf076;$mf077=$row->mf077;$mf078=$row->mf078;$mf079=$row->mf079;$mf080=$row->mf080;
				$mf081=$row->mf081;$mf082=$row->mf082;$mf083=$row->mf083;$mf084=$row->mf084;$mf085=$row->mf085;$mf086=$row->mf086;$mf087=$row->mf087;$mf088=$row->mf088;$mf089=$row->mf089;$mf090=$row->mf090;      						   
	 	        $mf091=$row->mf091;$mf092=$row->mf092;$mf093=$row->mf093;$mf094=$row->mf094;$mf095=$row->mf095;$mf096=$row->mf096;
			  endforeach;
		     }   
		  
            $seq3=$this->input->post('mf001c');    //主鍵一筆
	        $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                 
		          'mf001' => $seq3,'mf002' => $mf002,'mf003' => $mf003,'mf004' => $mf004,'mf005' => $mf005,'mf006' => $mf006,'mf007' => $mf007,'mf008' => $mf008,'mf009' => $mf009,'mf010' => $mf010,
		          'mf011' => $mf011,'mf012' => $mf012,'mf013' => $mf013,'mf014' => $mf014,'mf015' => $mf015,'mf016' => $mf016,'mf017' => $mf017,'mf018' => $mf018,'mf019' => $mf019,'mf020' => $mf020,
		          'mf021' => $mf021,'mf022' => $mf022,'mf023' => $mf023,'mf024' => $mf024,'mf025' => $mf025,'mf026' => $mf026,'mf027' => $mf027,'mf028' => $mf028,'mf029' => $mf029,'mf030' => $mf030,
				  'mf031' => $mf031,'mf032' => $mf032,'mf033' => $mf033,'mf034' => $mf034,'mf035' => $mf035,'mf036' => $mf036,'mf037' => $mf037,'mf038' => $mf038,'mf039' => $mf039,'mf040' => $mf040,
				  'mf041' => $mf041,'mf042' => $mf042,'mf043' => $mf043,'mf044' => $mf044,'mf045' => $mf045,'mf046' => $mf046,'mf047' => $mf047,'mf048' => $mf048,'mf049' => $mf049,'mf050' => $mf050,
				  'mf051' => $mf051,'mf052' => $mf052,'mf053' => $mf053,'mf054' => $mf054,'mf055' => $mf055,'mf056' => $mf056,'mf057' => $mf057,'mf058' => $mf058,'mf059' => $mf059,'mf060' => $mf060,
				  'mf061' => $mf061,'mf062' => $mf062,'mf063' => $mf063,'mf064' => $mf064,'mf065' => $mf065,'mf066' => $mf066,'mf067' => $mf067,'mf068' => $mf058,'mf069' => $mf069,'mf070' => $mf070,
				  'mf071' => $mf071,'mf072' => $mf072,'mf073' => $mf073,'mf074' => $mf074,'mf075' => $mf075,'mf076' => $mf076,'mf077' => $mf077,'mf078' => $mf078,'mf079' => $mf079,'mf080' => $mf080,
				  'mf081' => $mf081,'mf082' => $mf082,'mf083' => $mf083,'mf084' => $mf084,'mf085' => $mf085,'mf086' => $mf086,'mf087' => $mf087,'mf088' => $mf088,'mf089' => $mf089,'mf090' => $mf090,
				  'mf091' => $mf081,'mf092' => $mf092,'mf093' => $mf093,'mf094' => $mf094,'mf095' => $mf095,
				  'mf096' => $mf096             
                         );
             $exist = $this->taxi05_model->selone2($this->input->post('mf001c'));
		     if ($exist)
		       {
			    return 'exist';
		       }         
                return $this->db->insert('taxmf', $data);      //複製一筆  
          }	
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('mf001o');    
	     $seq2=$this->input->post('mf001c'); 
	     $sql = " SELECT mf001,mf002,mf003,mf004,mf013,mf017,create_date FROM taxmf WHERE mf001 >= '$seq1'  AND mf001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('mf001o');    
	     $seq2=$this->input->post('mf001c');
	     $sql = " SELECT mf001,mf002,mf003,mf004,mf013,mf017,create_date  FROM taxmf WHERE mf001 >= '$seq1'  AND mf001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "mf001 >= '$seq1'  AND mf001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		               ->from('taxmf')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//更改一筆	 
	function updatef()   //更改一筆
          {
			   preg_match_all('/\d/S',$this->input->post('mf002'), $matches);  //處理日期字串
			 $mf002 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('mf006'), $matches);  //處理日期年月字串
			 $mf006 = implode('',$matches[0]);
			 $mf001=$this->input->post('mf001');
			 $mf005=$this->input->post('mf005');
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		          
		        'mf003' => strtoupper($this->input->post('mf003')),
		        'mf004' => strtoupper($this->input->post('mf004')),
		        
		        'mf006' => $mf006,
                'mf007' => $this->input->post('mf007'),
                'mf008' => $this->input->post('mf008'),
                'mf009' => $this->input->post('mf009'),
                'mf010' => $this->input->post('mf010'),
                'mf011' => $this->input->post('mf011'),	
                'mf012' => $this->input->post('mf012'),		
                'mf013' => $this->input->post('mf013'),		
                'mf014' => $this->input->post('mf014'),		
                'mf015' => $this->input->post('mf015'),		
                'mf016' => $this->input->post('mf016'),		
                'mf017' => $this->input->post('mf017'),		
                'mf018' => $this->input->post('mf018')
                        );
			
            $this->db->where('mf001', $mf001); //單別
			$this->db->where('mf002', $mf002);
			$this->db->where('mf005', $mf005);
            $this->db->update('taxmf',$data);                   //更改一筆
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
	     $this->db->where('mf001', $seg1);
	     $this->db->where('mf002', $seg2);
         $this->db->delete('taxmf'); 
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
			  $this->db->where('mf001', $seq1);
			  //$this->db->where('mf002', $seq2);
              $this->db->delete('taxmf'); 
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
		 $this->db->select('mf001, mf002, mf003, mf004, mf017, b.mc002 as mf017disp');
	  $this->db->from('taxmf');
	  $this->db->join('cmsmc as b', 'mf017 = b.mc001','left');
      $this->db->like('mf001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mf002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }
	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd($keyword){     
      $this->db->select('mf001, mf002, mf003, mf004, mf017, b.mc002 as mf017disp');
	  $this->db->from('taxmf');
	  $this->db->join('cmsmc as b', 'mf017 = b.mc001','left');
      $this->db->like('mf001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mf002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookupd2($keyword){     
      $this->db->select('mf001, mf002, mf003, mf004, mf017, b.mc002 as mf017disp');
	  $this->db->from('taxmf');
	  $this->db->join('cmsmc as b', 'mf017 = b.mc001','left');
      $this->db->where('mf001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 查詢一筆 品號 key 	
	function ajaxkey($seg1)    
        { 	              
	     $this->db->set('mf001', $this->uri->segment(4));
	     $this->db->where('mf001', $this->uri->segment(4));	
	     $query = $this->db->get('taxmf');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->mf001;
           }
		    return $result;   
		 }
	    }
	//取單號 最大值加1
	function check_title_no($mf001,$mf002){
		preg_match_all('/\d/S',$mf002, $matches);  //處理日期字串
		$mf002 = implode('',$matches[0]);
		$this->db->select('MAX(mf005) as max_no')
			->from('taxmf')
			->where('mf001', $mf001)
			->where('mf002', $mf002);
			//->like('mf039', $mf039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $mf001.$mf002."0001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>