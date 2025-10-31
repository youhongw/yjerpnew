<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admr01_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
		
	//欄位表頭排序流覽資料
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('admr01_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['admr01']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['admr01']['search']);}
		
		
		if(is_array($this->input->get())){
			extract($this->input->get());
		//	echo var_dump($val);exit ;    //第一次空白
		    if (@$val!=null) {	
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mf001 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['admr01']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['admr01']['search']['where'];
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
		
		if(isset($_SESSION['admr01']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['admr01']['search']['order'];
		}
		
		if(!isset($_SESSION['admr01']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp')
			->from('barma as a')
			->join('admme as b', 'a.mf004 = b.me001 ','left')
			->join('cmsme as c', 'a.mf007 = c.me001 ','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);
		 
		$query = $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp')
			->from('barma as a')
			->join('admme as b', 'a.mf004 = b.me001 ','left')
			->join('cmsme as c', 'a.mf007 = c.me001 ','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['admr01']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('barma as a');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['admr01']['search']['where'] = $where;
		$_SESSION['admr01']['search']['order'] = $order;
		$_SESSION['admr01']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//***新增暫存view表方法construct_view
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mf001"
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
		$_SESSION['admr01']['search']['view'] = $view_array;
		$_SESSION['admr01']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['admr01']['search']['view']);exit;
		
	}
	//查詢一筆 修改用	
	function selone()  {  
		 $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp');	
		 $this->db->from('barma as a');	
		 $this->db->join('admme as b', 'a.mf004 = b.me001 ','left');
         $this->db->join('cmsme as c', 'a.mf007 = c.me001 ','left');
	     $this->db->where('mf001', $this->uri->segment(4)); 
	     
		 $query = $this->db->get();
	     if ($query->num_rows() > 0) {
		   $result = $query->result();
		   return $result;   
		 }
	 }
		
	//進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)   { 
	     $seq11 = "SELECT COUNT(*) as count  FROM `barma` ";
	     $seq1 = " mf001, mf002, mf003,mf004,mf005,mf006,mf007,  create_date FROM `barma` ";
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
		if(@$_SESSION['admr01_sql_term']){$seq32 = $_SESSION['admr01_sql_term'];}
		if(@$_SESSION['admr01_sql_sort']){$seq33 = $_SESSION['admr01_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mf001', 'mf002', 'mf003','mf004','mf005','mf006','mf007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*,b.me002 as mf004disp, c.me002 as mf007disp')
	                       ->from('barma as a')
						   ->join('admme as b', 'a.mf004=b.me001','left')
						   ->join('cmsme as c', 'a.mf007=c.me001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('barma')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        } 
	   
	//新增  查詢資料是否重複  
	function CheckRepeat($seq1) {  
	   $this->db->where('mf001', $seq1); 
	   $query = $this->db->get('barma');
	   return $query->num_rows() ;
	}
		
	//新增一筆	
	function insertf()   {  
	     $vdate=date("Ymd");
		//新增
		if ($this->input->post('mf001')>'0') {
		  $vno=$this->input->post('mf001');}
		else
		  { $vno = $this->admr01_model->check_title_no($vdate);}
	     $data = array( 
	                  'company' => '000',
	                  'creator' => 'demo',
		              'usr_group' => 'A100',
		              'create_date' =>date("Ymd"),
		              'modifier' => '',
		              'modi_date' => '',
		              'flag' => 0,
                      'mf001' => $vno,
		              'mf002' => $this->input->post('mf002'),
		              'mf003' => $this->input->post('mf003'),
					  'mf004' => $this->input->post('mf004'),
					  'mf005' => $this->input->post('mf005'),
					  'mf006' => $this->input->post('mf006'),
					  'mf007' => $this->input->post('mf007'),
					  'mf008' => $this->input->post('mf008'),
                     );
         
	     $exist = $this->admr01_model->CheckRepeat($this->input->post('mf001'));   //查詢資料是否重複
	     if ($exist) {
		    return 'exist';
		  }
		 
		$this->db->insert('barma', $data);
		//$vdate=date("Ymd");
		//新增
		/*if ($this->input->post('mf001')>'0') {
		$vno=$this->input->post('mf001');}
		else
		{ $vno = $this->admr01_model->check_title_no($vdate);} */
		$date=date("Ymd");
		$vtg002 = $this->check_title_no1($vno,$date);	//自動產生號碼
		$sql21 = " SELECT a.*
			           FROM  barma as a
                       WHERE mf001='$vno' 				   
					    " ;
		$query =$this->db->query($sql21); 
        $result = $query->result();		 
		foreach($result as $row) {
		  $tg001='3401';                        //單別
		  $tg002=$vtg002;                       //單號
		  $tg003=date("Ymd");                   //日期
		  $tg004='AB';                          //廠別
		  $tg005='0000';                          //供應廠商

		  $tg007='NTD';                          //幣別
		  $tg008=1;                              //匯率
		  $tg009='6';                          //發票聯數
          $tg010='9';                          //課稅別                      
		  $tg012='N';                          //列印次數
		  $tg013='Y';                          //確認碼
          $tg014=date("Ymd");                   //單據日期
		  $tg015='N';                              //更新碼
		  $tg024='N';                          // 菸酒註記                    
          $tg026=$row->mf005;                          //數量合計                                          
		  $tg030=0.05;                          //營業稅率                    
		  $tg042='N';                          //簽核狀態碼 
          
          $th001='3401';                        //單別
		  $th002=$vtg002;                       //單號
		  $th003='1010';                        //序號
          $th004=$row->mf004;                        //品號
		  $th005=$row->mf006;                       //品名
		  $th006=$row->mf007;                        //規格
		  $th007=$row->mf005;                        //數量
          $th008=$row->mf008;                        //單位
		  $th009='111';                         //庫別
          $th011=$row->mf002;                        //儲位編號
          $th012=$row->mf003;                         //容器編號		  
		  $th014=date("Ymd");                  // 驗收日期                    
          $th015=$row->mf005;                       //驗收數量
		  $th016=$row->mf005;                        //計價數量
          $th026='N';                       //暫不付款                    
		  $th027='N';                        // 逾期碼                      
          $th028='2';                       //檢驗狀態                    
		  $th029='N';                        //驗退碼                      	
          $th030='Y';                       //確認碼                      
		  $th031='N';                        //結帳碼                      	
          $th032='N';                       //更新碼 	  
			}
       
		//新增單頭	
       // echo var_dump($mc001.$mc002.$vmc006);exit;		
		$sql221 = " INSERT INTO  purtg (tg001,tg002,tg003,tg004,tg005,tg007,tg008,tg009,tg010,
		           tg012,tg013,tg014,tg015,tg024,tg026,tg030,tg042
					) values 
				  ('$tg001','$tg002','$tg003','$tg004','$tg005','$tg007','$tg008','$tg009','$tg010',
				    '$tg012','$tg013','$tg014','$tg015','$tg024','$tg026','$tg030','$tg042'
				   )
                " ;	
		$this->db->query($sql221); 
		  //新增單身
		$sql241 = " INSERT INTO  purth (th001,th002,th003,th004,th005,th006,th007,th008,th009,th011,th012,
		           th014,th015,th016,th026,th027,th028,th029,th030,th031,th032
					) values 
				  ('$th001','$th002','$th003','$th004','$th005','$th006','$th007','$th008','$th009','$th011','$th012',
				    '$th014','$th015','$th016','$th026','$th027','$th028','$th029','$th030','$th031','$th032'
				   )
                " ;	
		$this->db->query($sql241);
        return  true;
     }
	//自動產生號碼
	function check_title_no1($vno,$date){
		$sql21 = " SELECT MAX(tg002) as max_no from  purtg  where tg001='3401' and tg014='$date' " ;
		$query = $this->db->query($sql21);
		$result = $query->result();
	    if (!$result[0]->max_no){return $date."001";}
		return $result[0]->max_no+1;
	}	
	//轉excel檔	 
	function excelnewf()  {	  
	     $seq1=$this->input->post('mf001c');    //查詢一筆以上
	     $seq2=$this->input->post('mf002c');
	     $sql = " SELECT mf001,mf002,mf003,mf004,mf005,mf007,create_date FROM barma WHERE mf001 >= '$seq1' AND mf001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd($seq1,$seq2)  {  
	     preg_match_all('/\d/S',$seq1, $matches);  //處理日期字串
			 $seq1 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$seq2, $matches);  //處理日期字串
			 $seq2 = implode('',$matches[0]);
		 $sql9= " DELETE SCMMA ";
		 $this->db->query($sql9);
		// ECHO VAR_DUMP($seq1,$seq2);EXIT;
	     $sql8 = " SELECT  A.TG006 AS MA001,D.MV002 AS MA002,SUM(B.TH013*A.TG012) AS MA003  FROM COPTG AS A
        LEFT JOIN COPTH AS B ON A.TG001=B.TH001 AND A.TG002=B.TH002 
        LEFT JOIN COPMA AS C ON  C.MA001=A.TG004 
        LEFT JOIN CMSMV AS D ON  A.TG006=D.MV001
        WHERE A.TG004 >='100000' AND A.TG004<='59999999' 
               AND A.TG003>='$seq1' AND A.TG003<='$seq2'   AND  TH013>0
                AND A.TG023='Y'   AND A.TG006<>'6666'
        GROUP BY A.TG006,D.MV002
        UNION
SELECT   A.TI006 AS MA001,D.MV002 AS MA002,SUM(B.TJ012*A.TI009)*-1 AS MA003 FROM  COPTI AS A
         LEFT JOIN COPTJ AS B ON A.TI001=B.TJ001 AND A.TI002=B.TJ002
         LEFT JOIN COPMA AS C ON C.MA001=A.TI004 
         LEFT JOIN CMSMV AS D ON A.TI006=D.MV001
WHERE  A.TI004 >='1000000' AND A.TI004 <='59999999'   
       AND A.TI003>='$seq1' AND A.TI003<='$seq2'   AND B.TJ012>0 
      AND A.TI019='Y'   AND A.TI006<>'6666'
GROUP BY A.TI006,D.MV002
		 "; 
         $query = $this->db->query($sql8);
		// echo var_dump($query->result());
		 foreach ($query->result() as $row) {
			 $MA001=$row->MA001;
		     $MA002=$row->MA002;
             $MA003=$row->MA003;
             $sql2= "INSERT INTO SCMMA(MA001,MA002,MA003) VALUES ('$MA001','$MA002','$MA003') ";
			 $this->db->query($sql2);			 
		 }
		 
		/* foreach ($query8->result() as $row) {
            foreach($row as $i=>$v){
            $$i=$v;
				if (@$VMA001 and @$VMA002 and @$VMA003  ) {
					$KMA003=ROUND($VMA003);
					//$VMA002=iconv("big-5","utf-8//IGNORE",$MA002);
				$sql2= "INSERT INTO SCMMA(MA001,MA003) VALUES ('$VMA001','$KMA003')
					      ";
				$this->db->query($sql2);}
		 }}	*/
		/* $sql3= "UPDATE SCMMA  SET MA002=MV002
		         FROM SCMMA AS B LEFT JOIN CMSMV AS C ON  B.MA001=C.MV001 
				 WHERE MA001=MV001 
					      ";

		$this->db->query($sql3); */
		 
		 $sql3="SELECT MA001,MA002,SUM(MA003) AS MA003 FROM SCMMA GROUP BY MA001,MA002 ORDER BY MA003 DESC   ";
		 
		 $query = $this->db->query($sql3);
	     $ret['rows'] = $query->result();
		
       /*  $seq32 = " SELECT COUNT(*) as count FROM COPTG AS A WHERE A.TG004 >='100000' AND A.TG004<='59999999' 
               AND A.TG003>='$seq1' AND A.TG003<='$seq2'  
                AND A.TG023='Y'   AND A.TG006<>'6666'  "; */
			$seq32 = "	SELECT COUNT(*) as count FROM SCMMA AS A ";
	     $query = $this->db->query($seq32);
	     $num = $query->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//更改一筆	 
	function updatef()   { 
         $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'mf002' => $this->input->post('mf002'),
		        'mf003' => $this->input->post('mf003'),
                'mf004' => $this->input->post('mf004'), 
                'mf005' => $this->input->post('mf005'),
                'mf006' => $this->input->post('mf006'),
                'mf007' => $this->input->post('mf007'),	
                'mf008' => $this->input->post('mf008'),				
                     );
         $this->db->where('mf001', $this->input->post('mf001'));
         $this->db->update('barma',$data);                  
         if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;
     }
		
	//刪除一筆	
	function deletef($seg1)      
        {  
	    // $seg1=$this->uri->segment(4);
        // $seg2=$this->uri->segment(5); 
	     $this->db->where('mf001', $seg1);
         $this->db->delete('barma'); 
	     if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;					
        }	
		
	//選取刪除多筆  
	function delmutif()   {   
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
			     $this->db->where('mf001', $seq1);
                 $this->db->delete('barma'); 
	           }
             }
	     if ($this->db->affected_rows() > 0)
             {
               return TRUE;
             }
               return FALSE;					
        }
		
	//ajax 查詢一筆主鍵 有無重複	
	function check_key($mf001) { 
		$this->db->select('mf001,mf002')
		 	     ->from('barma')
			     ->where('mf001', $mf001);
		$query = $this->db->get();
		$result = $query->result();
       //  echo "<pre>";var_dump($result->mg003);exit;	
		if ($query->num_rows() == 1) 
		 { return "資料重複!請重新輸入"; } else { return ""; }
		 	 
	}
		
	//ajax 查詢 顯示 使用者權限	1050803 new
	function ajaxadmr01a($seg1)    
        {
		   if  ($this->session->userdata('syssuper')=='Y') { $this->db->where('mg001', $this->session->userdata('manager'));} else {
	      $this->db->where('mg001', $this->session->userdata('manager'));
		   $this->db->where('mg002', $this->uri->segment(3)); }		  
	      $query = $this->db->get('admmg');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mg004;
			   $this->session->set_userdata('sysmg006',$row->mg006);
              }
			  
			  if  ($this->session->userdata('syssuper')=='Y') {$result='Y';$this->session->set_userdata('sysmg006',"YYYYYYYYYYYY");}
		     return $result;   
		  }
		
	    }
	//取單號 最大值加1
	function check_title_no($vdate){
		preg_match_all('/\d/S',$vdate, $matches);  //處理日期字串
		$vdate = implode('',$matches[0]);
		$this->db->select('MAX(mf001) as max_no')
			->from('barma')
			->where('create_date', $vdate);
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $vdate."0001";}
		
		return $result[0]->max_no+1;
	}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>