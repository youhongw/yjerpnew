<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asti01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006,ma017,ma025,ma069 create_date');
          $this->db->from('astma');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ma001 desc, ma002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('astma');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','ma000','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select(' * ')
	                        ->from('astma')
		                    ->order_by($sort_by, $sort_order)
		                    ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('astma');
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
		$this->session->set_userdata('asti01_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['asti01']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "a.ma001 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti01']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti01']['search']['where'];
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
		
		if(isset($_SESSION['asti01']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti01']['search']['order'];
		}
		
		if(!isset($_SESSION['asti01']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,b.ma003 as ma001disp')
			->from('astma as a')
			->join('actma as b', 'a.ma001 = b.ma001','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.*,b.ma002 as ma001disp')
			->from('astma as a')
			->join('actma as b', 'a.ma001 = b.ma001','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['asti01']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('astma');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti01']['search']['where'] = $where;
		$_SESSION['asti01']['search']['order'] = $order;
		$_SESSION['asti01']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//***新增暫存view表方法construct_view
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"ma001"
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
		$_SESSION['asti01']['search']['view'] = $view_array;
		$_SESSION['asti01']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['asti01']['search']['view']);exit;
		
	}
	 //查詢一筆 修改用  
	function selone($seq1)    
        {
		  $this->db->select(' a.*,b.ma003 as ma003disp,c.ma003 as ma004disp,d.ma003 as ma005disp ');
          $this->db->from('astma as a');
		  $this->db->join('actma as b', 'a.ma003 = b.ma001','left');
		  $this->db->join('actma as c', 'a.ma004 = c.ma001','left');
		  $this->db->join('actma as d', 'a.ma005 = d.ma001','left');
		  $this->db->where('a.ma001', $seq1); 
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
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `astma` ";
	     $seq1 = "ma001, ma002, ma003, ma004, ma005, ma006,ma007,ma017,ma025,ma069, create_date FROM `astma` ";
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
		if(@$_SESSION['asti01_sql_term']){$seq32 = $_SESSION['asti01_sql_term'];}
		if(@$_SESSION['asti01_sql_sort']){$seq33 = $_SESSION['asti01_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ma001', 'ma000', 'ma004', 'ma005', 'ma006', 'ma007','ma008','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('astma')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('astma')
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
	     $sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','ma017','ma025','ma000','create_date');
         $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
			
	     $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006,ma017,ma025,ma069,ma000, create_date');
	     $this->db->from('astma');
	     $this->db->like($sort_by, $seq4, 'after');
	     $this->db->order_by($sort_by, $sort_order);
	     //$this->db->order_by('ma001 asc, ma002 asc');
	     $this->db->limit($limit, $offset);   // 每頁15筆
	     $query = $this->db->get();    
	     $ret['rows'] = $query->result();
						
	     $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('astma');
	     $this->db->like($sort_by, $seq4, 'after');	
	     $query = $this->db->get();
	     $tmp = $query->result();		
	     $ret['num_rows'] = $tmp[0]->count;			
	     return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
        {
	     $this->db->set('ma001', $this->input->post('ma001')); 
	     $this->db->where('ma001', $this->input->post('ma001'));
	     $query = $this->db->get('astma');
	     return $query->num_rows() ;
	    }  
		
	//新增一筆	
	function insertf()    
         {
			if ($this->input->post()){
				extract($this->input->post());
			}
			// preg_match_all('/\d/S',$this->input->post('ma000'), $matches);  //處理日期年月字串
			// $mc200 = implode('',$matches[0]);
			
			 $ma003=$this->input->post('acti03');
			 $ma004=$this->input->post('acti03a');
			 $ma005=$this->input->post('acti03b');
		//	var_dump($this->input->post('userfile'));exit;
	     $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => '',
		        'modi_date' => '',
		        'flag' => 0,
                'ma001' => $ma001,
		        'ma002' => $ma002,
		        'ma003' => $ma003,
		        'ma004' => $ma004,
                'ma005' => $ma005,		
                'ma006' => $ma006,		
                'ma007' => $ma007,		
                'ma008' => $ma008,	
                'ma009' => $ma009
                );
         
	     $exist = $this->asti01_model->selone1($ma001);
	     if ($exist)
	       {
		    return 'exist';
		   } 
            return  $this->db->insert('astma', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
        { 	
	     $this->db->set('ma001', $this->input->post('ma001c'));
	     $this->db->where('ma001', $this->input->post('ma001c'));
	     $query = $this->db->get('astma');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
          {
	       $this->db->set('ma001', $this->input->post('ma001o'));
	       $this->db->where('ma001', $this->input->post('ma001o'));
	       $query = $this->db->get('astma');
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
                $ma002=$row->ma002;$ma003=$row->ma003;$ma004=$row->ma004;$ma005=$row->ma005;$ma006=$row->ma006;$ma007=$row->ma007;$ma008=$row->ma008;$ma009=$row->ma009;$ma010=$row->ma010;
				$ma011=$row->ma011;$ma012=$row->ma012;$ma013=$row->ma013;$ma014=$row->ma014;$ma015=$row->ma015;$ma016=$row->ma016;$ma017=$row->ma017;$ma018=$row->ma018;$ma019=$row->ma019;$ma020=$row->ma020;
				$ma021=$row->ma021;$ma022=$row->ma022;$ma023=$row->ma023;$ma024=$row->ma024;$ma025=$row->ma025;$ma026=$row->ma026;$ma027=$row->ma027;$ma028=$row->ma028;$ma029=$row->ma029;$ma030=$row->ma030;		 
                $ma031=$row->ma031;$ma032=$row->ma032;$ma033=$row->ma033;$ma034=$row->ma034;$ma035=$row->ma035;$ma036=$row->ma036;$ma037=$row->ma037;$ma038=$row->ma038;$ma039=$row->ma039;$ma040=$row->ma040;
				$ma041=$row->ma041;$ma042=$row->ma042;$ma043=$row->ma043;$ma044=$row->ma044;$ma045=$row->ma045;$ma046=$row->ma046;$ma047=$row->ma047;$ma048=$row->ma048;$ma049=$row->ma049;$ma050=$row->ma050;
				$ma051=$row->ma051;$ma052=$row->ma052;$ma053=$row->ma053;$ma054=$row->ma054;$ma055=$row->ma055;$ma056=$row->ma056;$ma057=$row->ma057;$ma058=$row->ma058;$ma059=$row->ma059;$ma060=$row->ma060;
				$ma061=$row->ma061;$ma062=$row->ma062;$ma063=$row->ma063;$ma064=$row->ma064;$ma065=$row->ma065;$ma066=$row->ma066;$ma067=$row->ma067;$ma068=$row->ma068;$ma069=$row->ma069;$ma070=$row->ma070;
				$ma071=$row->ma071;$ma072=$row->ma072;$ma073=$row->ma073;$ma074=$row->ma074;$ma075=$row->ma075;$ma076=$row->ma076;$ma077=$row->ma077;$ma078=$row->ma078;$ma079=$row->ma079;$ma080=$row->ma080;
				$ma081=$row->ma081;$ma082=$row->ma082;$ma083=$row->ma083;$ma084=$row->ma084;$ma085=$row->ma085;$ma086=$row->ma086;$ma087=$row->ma087;$ma088=$row->ma088;$ma089=$row->ma089;$ma090=$row->ma090;      						   
	 	        $ma091=$row->ma091;$ma092=$row->ma092;$ma093=$row->ma093;$ma094=$row->ma094;$ma095=$row->ma095;$ma096=$row->ma096;
			  endforeach;
		     }   
		  
            $seq3=$this->input->post('ma001c');    //主鍵一筆
	        $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                 
		          'ma001' => $seq3,'ma002' => $ma002,'ma003' => $ma003,'ma004' => $ma004,'ma005' => $ma005,'ma006' => $ma006,'ma007' => $ma007,'ma008' => $ma008,'ma009' => $ma009,'ma010' => $ma010,
		          'ma011' => $ma011,'ma012' => $ma012,'ma013' => $ma013,'ma014' => $ma014,'ma015' => $ma015,'ma016' => $ma016,'ma017' => $ma017,'ma018' => $ma018,'ma019' => $ma019,'ma020' => $ma020,
		          'ma021' => $ma021,'ma022' => $ma022,'ma023' => $ma023,'ma024' => $ma024,'ma025' => $ma025,'ma026' => $ma026,'ma027' => $ma027,'ma028' => $ma028,'ma029' => $ma029,'ma030' => $ma030,
				  'ma031' => $ma031,'ma032' => $ma032,'ma033' => $ma033,'ma034' => $ma034,'ma035' => $ma035,'ma036' => $ma036,'ma037' => $ma037,'ma038' => $ma038,'ma039' => $ma039,'ma040' => $ma040,
				  'ma041' => $ma041,'ma042' => $ma042,'ma043' => $ma043,'ma044' => $ma044,'ma045' => $ma045,'ma046' => $ma046,'ma047' => $ma047,'ma048' => $ma048,'ma049' => $ma049,'ma050' => $ma050,
				  'ma051' => $ma051,'ma052' => $ma052,'ma053' => $ma053,'ma054' => $ma054,'ma055' => $ma055,'ma056' => $ma056,'ma057' => $ma057,'ma058' => $ma058,'ma059' => $ma059,'ma060' => $ma060,
				  'ma061' => $ma061,'ma062' => $ma062,'ma063' => $ma063,'ma064' => $ma064,'ma065' => $ma065,'ma066' => $ma066,'ma067' => $ma067,'ma068' => $ma058,'ma069' => $ma069,'ma070' => $ma070,
				  'ma071' => $ma071,'ma072' => $ma072,'ma073' => $ma073,'ma074' => $ma074,'ma075' => $ma075,'ma076' => $ma076,'ma077' => $ma077,'ma078' => $ma078,'ma079' => $ma079,'ma080' => $ma080,
				  'ma081' => $ma081,'ma082' => $ma082,'ma083' => $ma083,'ma084' => $ma084,'ma085' => $ma085,'ma086' => $ma086,'ma087' => $ma087,'ma088' => $ma088,'ma089' => $ma089,'ma090' => $ma090,
				  'ma091' => $ma081,'ma092' => $ma092,'ma093' => $ma093,'ma094' => $ma094,'ma095' => $ma095,
				  'ma096' => $ma096             
                         );
             $exist = $this->asti01_model->selone2($this->input->post('ma001c'));
		     if ($exist)
		       {
			    return 'exist';
		       }         
                return $this->db->insert('astma', $data);      //複製一筆  
          }	
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('ma001o');    
	     $seq2=$this->input->post('ma001c'); 
	     $sql = " SELECT ma001,ma002,ma003,ma004,ma005,ma006,ma007,ma008,ma009 FROM astma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('ma001o');    
	     $seq2=$this->input->post('ma001c');
	     $sql = " SELECT *  FROM astma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "ma001 >= '$seq1'  AND ma001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		               ->from('astma')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//更改一筆	 
	function updatef()   //更改一筆
          {
			  if ($this->input->post()){
				extract($this->input->post());
			   }
			
			 $ma003=$this->input->post('acti03');
			 $ma004=$this->input->post('acti03a');
			 $ma005=$this->input->post('acti03b');
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		        'ma002' => $ma002,
		        'ma003' => $ma003,
		        'ma004' => $ma004,
                'ma005' => $ma005,		
                'ma006' => $ma006,		
                'ma007' => $ma007,		
                'ma008' => $ma008,	
                'ma009' => $ma009
                        );
            $this->db->where('ma001', $ma001);
            $this->db->update('astma',$data);                   //更改一筆
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
	     $this->db->where('ma001', $seg1);
	     $this->db->where('ma002', $seg2);
         $this->db->delete('astma'); 
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
		    //  list($seq1, $seq2, $seq3, $seq4) = explode("/", $seq[$x]);
		      $seq1;
		   	  
			  $this->db->where('ma001', $seq1);
              $this->db->delete('astma'); 
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
		 $this->db->select('ma001, ma002, ma003, ma004, ma017, b.mc002 as ma017disp');
	  $this->db->from('astma');
	  $this->db->join('cmsmc as b', 'ma017 = b.mc001','left');
      $this->db->like('ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ma002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }
	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd($keyword){     
      $this->db->select('ma001, ma002, ma003, ma004, ma017, b.mc002 as ma017disp');
	  $this->db->from('astma');
	  $this->db->join('cmsmc as b', 'ma017 = b.mc001','left');
      $this->db->like('ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ma002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookupd2($keyword){     
      $this->db->select('ma001, ma002, ma003, ma004, ma017, b.mc002 as ma017disp');
	  $this->db->from('astma');
	  $this->db->join('cmsmc as b', 'ma017 = b.mc001','left');
      $this->db->where('ma001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 查詢一筆 品號 key 	
	function ajaxkey($seg1)    
        { 	              
	     $this->db->set('ma001', $this->uri->segment(4));
	     $this->db->where('ma001', $this->uri->segment(4));	
	     $query = $this->db->get('astma');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->ma001;
           }
		    return $result;   
		 }
	    }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>