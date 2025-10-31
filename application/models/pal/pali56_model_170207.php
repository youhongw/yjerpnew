<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pali56_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('tf001, tf002, tf003, tf004, tf005, tf006, create_date');
        $this->db->from('paltf');
	    $this->db->order_by('tf001 desc, tf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
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
	function search($limit, $offset, $sort_by, $sort_order, $dateo, $datec, $type)
	  { 
		//$this->input->post('type')=="B"
		
		preg_match_all('/\d/S',$dateo, $matches);  //處理日期字串
		$dateo = implode('',$matches[0]);
		preg_match_all('/\d/S',$datec, $matches);  //處理日期字串
		$datec = implode('',$matches[0]);
		if(!@$dateo) {$dateo = date("Ymd");}
		if(!@$datec) {$datec = date("Ymd");}
		if($dateo>$datec){$temp = $dateo;$dateo=$datec;$datec=$temp;unset($temp);} //如果前者較小則對換
		
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('te001', 'te002', 'me001', 'me002', 'create_date', 'modifier','modi_date','creator');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
		
		$sql = "SELECT IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002,a.mv027,IFNULL(b.te002,'') as te002, COUNT(b.te003) as c_te003, b.create_date, b.modi_date as modi_date, d.mo002, d.mo003, d.mo004, d.mo005, d.mo006 
				FROM cmsmv as a
				LEFT JOIN palte as b ON a.mv001 = b.te001 and b.te002 >= '".$dateo."' and b.te002 <= '".$datec."'
                LEFT JOIN cmsme as c ON a.mv004 = c.me001
				LEFT JOIN palmo as d ON a.mv027 = d.mo001 
				WHERE (a.mv022='' or a.mv022 IS NULL) and a.mv026='Y'
				GROUP BY mv001 , te002
				ORDER BY b.te002 asc, a.mv004 asc, a.mv021 asc";

		$query = $this->db->query($sql); 
	    $ret['rows'] = $query->result(); 
		
		$temp_data = $ret['rows'];
		$sql = "SELECT `te001`,`te002`,`te003` FROM `palte` where te002 >= '".$dateo."' and te002 <= '".$datec."'";
		$query = $this->db->query($sql); 
	    $temp_tdata = $query->result();
		foreach($temp_tdata as $key => $val){
			$time_data[$val->te002][$val->te001][]=$val->te003;
		}
		$selected_date = array();
		foreach($temp_data as $key => $val){
			if($val->te002){$selected_date[$val->te002] = true;}
			if(@$val->te002){
				$data[$val->te002][$val->te001] = $val;
				if(@$time_data[$val->te002][$val->te001]){
					//$data[$val->te002][$val->te001]->te003 = $time_data[$val->te002][$val->te001];
				}
				else if(!@$time_data[$val->te002][$val->te001]){
					//$data[$val->te002][$val->te001]->te003 = array();
				}
			}
		}echo "<pre>";var_dump($temp_data);
		exit;
		foreach($temp_data as $key => $val){
			foreach($selected_date as $t_k => $t_v){
				if(!@$data[$t_k][$val->te001]){
					$data[$t_k][$val->te001] = $val;
					$data[$t_k][$val->te001]->te002 = $t_k;
					$data[$t_k][$val->te001]->create_date = $t_k;
					echo "<pre>";echo $t_k." ";var_dump($val->te001);@var_dump($data[$t_k][$val->te001]->te003);
					//$data[$t_k][$val->te001]->te003 = array();
					//if($val->te001=="89044"){echo "<pre>";echo $t_k." ";var_dump($val->te001);@var_dump($data[$t_k][$val->te001]);exit;}
				}
			}
		}
		//echo "<pre>";var_dump($data);
		exit;
		if(!@$data){$data=array();}
		$result = $this->compute_status($data,$type);
		
		$ret['rows'] = $result;
		
		//echo "<pre>";var_dump($result);exit;
		
	    return $ret;
	  }

	//查詢一筆 修改用   
	function selone($seq1,$seq2)
       {
		 $this->db->select('a.*, b.mv002,b.mv004,b.mv027,c.me001, c.me002,d.mo001,d.mo002,d.mo003,d.mo004,d.mo005');	
		 $this->db->from('paltf as a');
		 $this->db->join('cmsmv as b', 'a.tf001 = b.mv001 ','left');
		 $this->db->join('cmsme as c', 'b.mv004 = c.me001 ','left');
		 $this->db->join('palmo as d', 'b.mv027 = d.mo001 ','left');
		 $this->db->where('a.tf002',$seq1); 
	     $this->db->where('c.me001',$seq2);
         	 
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
	     $query = $this->db->select('a.tf001,b.mv002 as tf001disp, a.tf002, c.me002 as tf002disp,a.tf003, a.tf004, a.tf005,a.tf006,a.tf007,a.tf010,a.tf011,a.tf016, a.create_date')
	                       ->from('paltf as a')
						   ->join('cmsmv as b', 'a.tf001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.tf002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
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
		$sort_columns = array('a.tf001', 'a.tf002', 'a.tf003', 'a.tf010', 'a.tf011', 'a.tf016','a.create_date','count_count','c_count','c.me002');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
		$sql = "SELECT COUNT(a.tf001) as count_count, `a`.`tf002`, `c`.`me001`, `c`.`me002`, `a`.`create_date`, `a`.`modifier`, `a`.`modi_date`, `a`.`creator`,COUNT( CASE WHEN `a`.`tf017` = 'Y' THEN 1 ELSE NULL END ) as c_count
			FROM `paltf` as a 
			LEFT JOIN `cmsmv` as b ON `a`.`tf001` = `b`.`mv001` 
			LEFT JOIN `cmsme` as c ON `b`.`mv004` = `c`.`me001` ";
		$sql .= "WHERE ".$sort_by." LIKE '".$seq4."%' ";
		$temp_sort = explode(".",$sort_by);if(@$temp_sort[1]){$temp_sort=$temp_sort[1];}else{$temp_sort=$temp_sort[0];}
		$sql .=	"GROUP BY `tf002`, `me002` ORDER BY `".$temp_sort."` ".$sort_order." LIMIT ".$offset.",".$limit;

		$query = $this->db->query($sql); 
		  
		$ret['rows'] = $query->result(); 
		
		$sql = "SELECT COUNT(a.tf001) as count_count, `a`.`tf002`, `c`.`me001`, `c`.`me002`, `a`.`create_date`, `a`.`modifier`, `a`.`modi_date`, `a`.`creator`,COUNT( CASE WHEN `a`.`tf017` = 'Y' THEN 1 ELSE NULL END ) as c_count
			FROM `paltf` as a 
			LEFT JOIN `cmsmv` as b ON `a`.`tf001` = `b`.`mv001` 
			LEFT JOIN `cmsme` as c ON `b`.`mv004` = `c`.`me001` ";
		$sql .= "WHERE ".$sort_by." LIKE '".$seq4."%' ";
		$temp_sort = explode(".",$sort_by);if(@$temp_sort[1]){$temp_sort=$temp_sort[1];}else{$temp_sort=$temp_sort[0];}
		$sql .=	"GROUP BY `tf002`, `me002` ORDER BY `".$temp_sort."` ".$sort_order;
		
		$query = $this->db->query($sql); 
	    $rows_count = $query->result(); 
		
	    $ret['num_rows'] = count($rows_count);
		
		return $ret;
		
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('tf001', $seg1); 
	    $this->db->where('tf002', $seg2); 	    
	    $query = $this->db->get('paltf');
	    return $query->num_rows();
	   }  
	   
	//新增多筆	
	function insertf()   
       {
			if(@$this->input->post('tf001')) $tf001 = $this->input->post('tf001');
			if(@$this->input->post('tf006')) $tf006 = $this->input->post('tf006');
			if(@$this->input->post('tf009')) $tf009 = $this->input->post('tf009');
			if(!$tf001 || (!$tf006 && !$tf009)){
				return "nodata";
			}$done = 0;$total = 0;
			$data = $this->input->post();
			$tf002="";$tf003="";$exist_ary=array();
			preg_match_all('/\d/S',$data['tf002'], $matches);
			$tf002 = implode('',$matches[0]);$tf003=$data['tf003'];$holiday = $this->pali56_model->check_holiday($tf002);
			unset($data['tf002'],$data['tf003'],$data['submit']);
			foreach($data as $key => $val){
				foreach($val as $k => $v){
					$add_data[$k][$key] = $v;
				}
			}
			//echo "<pre>";var_dump($add_data);exit;
			foreach($add_data as $key=>$val){
				if(!@$val['tf006']&&!@$val['tf009'])
					continue;
				if(!@$val['tf017']) $val['tf017'] = "N";
				$data = array(
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tf001' => $val['tf001'],
                 'tf002' => $tf002,
                 'tf003' => $tf003,
                 'tf004' => $val['tf004'],
                 'tf005' => $val['tf005'],
		         'tf006' => $val['tf006'],
                 'tf007' => $val['tf007'],
                 'tf008' => $val['tf008'],
		         'tf009' => $val['tf009'],
                 'tf016' => $val['tf016'],
                 'tf017' => $val['tf017']
                );
				if($tf003 == 6){
					$data['tf012'] = $val['tf012'];$data['tf013'] = $val['tf013'];
				}else if($tf003 == 7 || $holiday){
					$data['tf014'] = $val['tf014'];$data['tf015'] = $val['tf015'];
				}else{
					$data['tf010'] = @$val['tf010'];$data['tf011'] = @$val['tf011'];
				}
				$exist = $this->pali56_model->selone1($tf001[$key],$tf002);
				if ($exist){
					$exist_ary[$val['tf001']]['name'] = $val['tf001_disp'];
					$exist_ary[$val['tf001']]['date'] = $tf002;
					continue;
				}
				if($this->db->insert('paltf', $data)){
					$done++;
				}
				$total++;
			}
			$return_data['done'] = $done;
			$return_data['total'] = $total;
			$return_data['array'] = $exist_ary;
			
			return $return_data;

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
				  'tf016' => $tf016
                 			  
            );
            $exist = $this->pali56_model->selone2($seq2,$seq4);
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
	    $seq3=substr($this->input->post('tf002o'),0,4).substr($this->input->post('tf002o'),5,2);    
	    $seq4=substr($this->input->post('tf002c'),0,4).substr($this->input->post('tf002c'),5,2);
		 
	    $sql1 = " SELECT a.tf001,b.mv002 as tf001disp,b.mv004 as tf001disp1,c.me002 as tf001disp2,a.tf002,a.tf003, a.tf010,a.tf011,a.tf012,a.tf013,a.tf014,a.tf015,a.tf016 "; 
		$sql2 = " FROM paltf as a LEFT JOIN cmsmv as b ON  a.tf001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 "; 
		$sql3 = " WHERE a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND  a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('tf001o');    //查詢一筆以上
	    $seq2=$this->input->post('tf001c'); 
	    $seq3=substr($this->input->post('tf002o'),0,4).substr($this->input->post('tf002o'),5,2).substr($this->input->post('tf002o'),8,2);    
	    $seq4=substr($this->input->post('tf002c'),0,4).substr($this->input->post('tf002c'),5,2).substr($this->input->post('tf002c'),8,2);
		 
	    $sql1 = " SELECT a.*,b.mv002 as tf001disp,b.mv004 as tf001disp1,c.me002 as tf001disp2 "; 
		$sql2 = " FROM paltf as a LEFT JOIN cmsmv as b ON  a.tf001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 "; 
		$sql3 = " WHERE a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND  a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "tf001 >= '$seq1'  AND tf001 <= '$seq2' AND  tf002 >= '$seq3'  AND tf002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('paltf')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
			if(@$this->input->post('tf001')) $tf001 = $this->input->post('tf001');
			if(@$this->input->post('tf006')) $tf006 = $this->input->post('tf006');
			if(@$this->input->post('tf009')) $tf009 = $this->input->post('tf009');
			if(!$tf001 || (!$tf006 && !$tf009)){
				return "nodata";
			}$done = 0;$total = 0;
			$data = $this->input->post();
			$tf002="";$tf003="";$add_ary=array();
			preg_match_all('/\d/S',$data['tf002'], $matches);
			$tf002 = implode('',$matches[0]);$tf003=$data['tf003'];$holiday = $this->pali56_model->check_holiday($tf002);
			unset($data['tf002'],$data['tf003'],$data['submit']);
			foreach($data as $key => $val){
				foreach($val as $k => $v){
					$add_data[$k][$key] = $v;
				}
			}
			//echo "<pre>";var_dump($add_data);exit;
			foreach($add_data as $key=>$val){
				if(!$val['tf006']&&!$val['tf009']&&!$val['tf010']&&!$val['tf011']&&!$val['tf012']&&!$val['tf013']&&!$val['tf014']&&!$val['tf015'])
					continue;
				if(!@$val['tf017']) $val['tf017'] = "N";
				$data = array(
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
                 'tf004' => $val['tf004'],
                 'tf005' => $val['tf005'],
		         'tf006' => $val['tf006'],
                 'tf007' => $val['tf007'],
                 'tf008' => $val['tf008'],
		         'tf009' => $val['tf009'],
                 'tf016' => $val['tf016'],
                 'tf017' => $val['tf017']
                );
				$data['tf010'] = 0;$data['tf011'] = 0;$data['tf012'] = 0;$data['tf013'] = 0;$data['tf014'] = 0;$data['tf015'] = 0;
				if($tf003 == 6){
					$data['tf012'] = $val['tf012'];$data['tf013'] = $val['tf013'];
				}else if($tf003 == 0 || $holiday){
					$data['tf014'] = $val['tf014'];$data['tf015'] = $val['tf015'];
				}else{
					$data['tf010'] = $val['tf010'];$data['tf011'] = $val['tf011'];
				}
				$exist = $this->pali56_model->selone1($tf001[$key],$tf002);
				if (!$exist){
					$data['company'] = $this->session->userdata('syscompany');
					$data['creator'] = $this->session->userdata('manager');
					$data['usr_group'] = 'A100';
					$data['create_date'] = date("Ymd");
					$data['modifier'] = '';
					$data['modi_date'] = '';
					$data['flag'] = 0;
					$data['tf001'] = $val['tf001'];
					$data['tf002'] = $tf002;
					$data['tf003'] = $tf003;
					$this->db->insert('paltf', $data);
					$add_ary[$val['tf001']]['name'] = $val['tf001_disp'];
					$add_ary[$val['tf001']]['date'] = $tf002;
					continue;
				}else{
					$this->db->where('tf001', $val['tf001']);
					$this->db->where('tf002', $tf002);
					if($this->db->update('paltf', $data)){
						if($this->db->affected_rows() > 0){
							$done++;
						}
					}
				}
				$total++;
			}
			$return_data['done'] = $done;
			$return_data['total'] = $total;
			$return_data['array'] = $add_ary;
			
			return $return_data;
          }
		  
	//刪除一筆	
	function deletef($seg1,$seg2)      
       {  
	    $this->db->where('tf001', $seg1);
	    $this->db->where('tf002', $seg2);
        $this->db->delete('paltf');
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	   
	//選取刪除多筆  
	function delmutif($seq1,$seq2)   
       {
		foreach($seq1 as $key => $val){
			$temp_tf001 = $this->get_depart($seq2[$key]);
			if($temp_tf001){
				foreach($temp_tf001[$seq2[$key]] as $k => $v){
					$this->db->where('tf001', $v);
					$this->db->where('tf002', $seq1[$key]);
					$this->db->delete('paltf');
				}
			}
		}
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	   
	
	/***自動自刷卡取得加班資料***/
	/*
	主表:palte(刷卡資料) JOIN:palmo(班別),cmsme(部門),cmsmv(員工)
	他表:palms(國定假日)
	*/
	function auto_compute($seq1,$seq2){//seq1:部門seq2:日期
		  $sql = " SELECT a.te001,a.te002,a.te003,a.te004,
		  b.mv001,b.mv002,b.mv004,b.mv027,
		  c.me001,c.me002,
		  d.mo001,d.mo002,d.mo003,d.mo004,d.mo005
		   FROM palte as a
		  LEFT JOIN cmsmv as b ON a.te001=b.mv001
		  LEFT JOIN cmsme as c ON b.mv004=c.me001
		  LEFT JOIN palmo as d ON b.mv027=d.mo001
		  WHERE (b.mv022='' or b.mv022 IS NULL or b.mv022>='$seq2') and b.mv026='Y' and a.te002='$seq2' and c.me001='$seq1'
          ORDER BY a.te001 asc ,a.te002 asc ,a.te003 asc "; 
		  
		$query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		$t_data = array();
		foreach($ret['rows'] as $key=>$val ){
			$t_data[$val->te004][] = $val;
		}
		$week = date("w",mktime(0,0,0,substr($seq2,4,2),substr($seq2,6,2),substr($seq2,0,4)));//判斷平日六日假日
		$add_data = array();$temp_hr="";$temp_mn="";
		$otime_hr="";$otime_mn="";$ctime_hr="";$ctime_mn="";
		foreach($t_data as $key=>$val){
			$add_data[$key] = $val[0];
			$otime_hr = substr($val[0]->mo003,0,2);$otime_mn = substr($val[0]->mo003,2,2);
			$ctime_hr = substr($val[0]->mo005,0,2);$ctime_mn = substr($val[0]->mo005,2,2);
			foreach($val as $k=>$v){
				if($week == 6 || $week == 0 || $this->check_holiday($seq2)){
					$otime_hr = 1200;$ctime_hr = 1300;
					$temp_hr = substr($v->te003,0,2);$temp_mn = substr($v->te003,2,2);
					$matcho_hr = $temp_hr - $otime_hr;$matcho_mn = $temp_mn - $otime_mn;
					$matchc_hr = $ctime_hr - $temp_hr;$matchc_mn = $ctime_mn - $temp_mn;
					$matcho = $matcho_hr*60+$matcho_mn;
					$matchc = $matchc_hr*60+$matchc_mn;
					if($matcho>=30 || $matchc>=30){
						$add_data[$key]->add_time[] = $v->te003;
					}
				}else{
					$temp_hr = substr($v->te003,0,2);$temp_mn = substr($v->te003,2,2);
					$matcho_hr = $otime_hr - $temp_hr;$matcho_mn = $otime_mn - $temp_mn;
					$matchc_hr = $temp_hr - $ctime_hr;$matchc_mn = $temp_mn - $ctime_mn;
					$matcho = $matcho_hr*60+$matcho_mn;
					$matchc = $matchc_hr*60+$matchc_mn;
					if($matcho>=30 || $matchc>=30){
						$add_data[$key]->add_time[] = $v->te003;
					}
				}
				$add_data[$key]->times[] = $v->te003;
			}
		}
		  
		return $add_data;
	}
	
	function get_times($seq1,$seq2){
		preg_match_all('/\d/S',$seq2, $matches);
		$seq2 = implode('',$matches[0]);
		$this->db->select('a.te001,a.te002,a.te003');
        $this->db->from('palte as a');
		$this->db->join('cmsmv as b', 'a.te001 = b.mv001 ','left');
		$this->db->join('cmsme as c', 'b.mv004 = c.me001 ','left');
		$this->db->where('a.te002', $seq2);
		$this->db->where('c.me001', $seq1);
		$query = $this->db->get();
		$result = $query->result();
	    if ($query->num_rows() > 0) 
		{
			foreach($result as $key => $val){
				$results[$val->te002][$val->te001][] = $val->te003;
			}
			
			return $results;
		}
	}	
	
	function get_depart($seq1){
		$this->db->select('a.mv001,a.mv004');
        $this->db->from('cmsmv as a');
		$this->db->join('paltf as b', 'a.mv001 = b.tf001 ','right');
		$this->db->where('a.mv004', $seq1);
		$query = $this->db->get();
		$result = $query->result();
	    if ($query->num_rows() > 0) 
		{
			foreach($result as $key => $val){
				$results[$val->mv004][] = $val->mv001;
			}
			
			return $results;
		}
	}
	
	/***自動判斷出勤狀態***/
	/*
	
	*/	
	function compute_status($day_data,$type){
		/***參數列表***/
		$return_data = $day_data;
		$today = date("Ymd");
		$leave_data = array();
		$leave_class_hr = Array(
			'tg006' => "事",
			'tg007' => "病",
			'tg008' => "特",
			'tg010' => "無薪"
		);
		$leave_class_day = Array(
			'tg009' => "喪",
			'tg011' => "產",
			'tg012' => "陪產",
			'tg013' => "婚",
			'tg014' => "公傷",
			'tg016' => "公"
		);
		foreach($day_data as $day_key => $day_val){		//每天 一天一天處理
		
		/**取得一些資料(以天為計的資料)**/
		$temp_data = $this->get_leave($day_key);	//當日請假資料
		foreach($temp_data as $key=>$val){
			foreach($val as $k=>$v){
				if($v)
					$leave_data[$day_key][$val->tg001][$k] = $v;//取用結果$leave_data['日期']['員編']
			}
		}
		
		/***開始判斷
			$day_key=日期
			$day_val=日期的資料
			$epy_key=員工編號
			$epy_val=員工資料
		**/
		foreach($day_val as $epy_key => $epy_val){				//每位員工
			/**參數列表**/
			$year_late_time = $epy_val->mo006;					//年遲到時間
			$on_time = $epy_val->mo003;							//上班時間，到+5分鐘的時間點之間是遲到，超過等於曠職
			$on_time_hr = substr($on_time,0,2);$on_time_mn = substr($on_time,2,2);//上班時、分
			$off_time = $epy_val->mo004;						//下班時間
			$off_time_hr = substr($off_time,0,2);$off_time_mn = substr($on_time,2,2);//下班時、分
			$noon_time_hr = "12";$noon_time_mn = "00";			//12:00
			$aftnoon_time_hr = "13";$aftnoon_time_mn = "00";	//13:00
			if(!@$epy_val->te003){
				//$return_data[$day_val][$epy_key]->te003 = array();
				$punch_data = array();$punch_count = count($punch_data);
			}else{
				$punch_data = $epy_val->te003;$punch_count = count($punch_data);
			}
			
			
			$return_data[$day_key][$epy_key]->status = array();	//預先宣告狀態與請假曠職資訊
			$return_data[$day_key][$epy_key]->leave_hr = 0;
			$return_data[$day_key][$epy_key]->absenteeism_hr = 0;
			$return_data[$day_key][$epy_key]->status['absenteeism'] = "";
			$absenteeism_hr = 0;
			
			//請假判斷區域
			$return_data[$day_key][$epy_key]->status['leave'] = "";
			if(@$leave_data[$day_key][$epy_key]){
				foreach($leave_class_hr as $l_k => $l_v){
					if(@$leave_data[$day_key][$epy_key][$l_k]){
						$return_data[$day_key][$epy_key]->leave_hr += $leave_data[$day_key][$epy_key][$l_k];
						$return_data[$day_key][$epy_key]->status['leave'] .= $leave_data[$day_key][$epy_key][$l_k]."小時".$l_v;
						if($l_v=="特"){
							$return_data[$day_key][$epy_key]->status['leave'] .= "休 ";
						}else{
							$return_data[$day_key][$epy_key]->status['leave'] .= "假 ";
						}
					}
				}
				foreach($leave_class_day as $l_k => $l_v){
					if(@$leave_data[$day_key][$epy_key][$l_k]){
						$return_data[$day_key][$epy_key]->leave_hr += $leave_data[$day_key][$epy_key][$l_k]*8;
						$return_data[$day_key][$epy_key]->status['leave'] .= $leave_data[$day_key][$epy_key][$l_k]."天".$l_v."假 ";
					}
				}
			}
			
			if($punch_count==0&&!$this->check_holiday($day_key)){
				$return_data[$day_key][$epy_key]->absenteeism_hr = 8;//完全沒來就是曠職八小時
				$return_data[$day_key][$epy_key]->status['absenteeism'] .= "曠8小時";
				if($type=="C"){
					if($return_data[$day_key][$epy_key]->absenteeism_hr==0&&!@$return_data[$day_key][$epy_key]->status['error']){
						unset($return_data[$day_key][$epy_key]);
					}
					else if($return_data[$day_key][$epy_key]->absenteeism_hr-$return_data[$day_key][$epy_key]->leave_hr==0&&!@$return_data[$day_key][$epy_key]->status['error']){
						unset($return_data[$day_key][$epy_key]);
					}
				}
				continue;
			}
			
			if($on_time>$off_time){//夜班計算
				$return_data[$day_key][$epy_key]->status['error'] = "夜班注意";
				continue;
			}
			
			if($punch_count%2!=0&&$day_key!=$today){//進出不平衡
				$return_data[$day_key][$epy_key]->status['error'] = "進出不平衡";
				//記得要加入一些資訊後，直接continue
				continue;
			}
			$return_data[$day_key][$epy_key]->compute_times = array();
			foreach($punch_data as $key => $val){
				$current_status = 0;									//初始化參數 0是未進廠 1是已進廠
				if($key%2==0){$current_status = 1;}if($key%2==1){$current_status = 0;}	//奇數離廠，偶數進廠  因為key"0"是第一個
				$val_hr = substr($val,0,2);$val_mn = substr($val,2,2);	//切出每個時間點的時和分
				if($current_status == 0){								//離開要拉前 進入要往後
					if($val_mn>30){$val_mn="30";}else if($val_mn<30){$val_mn="00";}
					if($val_hr==12||($val_hr==13&&$val_mn=="00")){		//中午期間離廠都算是13:00離場(曠四小時)
						$val_hr="13";$val_mn="00";
					}
				}
				if($current_status == 1){
					if($val_mn>30){$val_hr++;$val_mn="00";}else if($val_mn<30){$val_mn="30";}
					if($val_hr==12||($val_hr==13&&$val_mn=="00")){		//中午期間入廠都算是12:00入場(曠四小時)
						$val_hr="12";$val_mn="00";
					}
				}
				$return_data[$day_key][$epy_key]->compute_times[] = $val_hr.$val_mn;
				if($key==0){											//最先前一筆，當作上班打卡，判斷遲到
					if($current_status != 1){
						$return_data[$day_key][$epy_key]->status['error'] = "系統錯誤，請聯絡工程師!";
						continue;
					}
					if($val>$year_late_time){
						$return_data[$day_key][$epy_key]->status['late'] = "年遲到(".$epy_val->mo002.")";
					}
					if($val>$on_time){
						$return_data[$day_key][$epy_key]->status['late'] = "遲到";
					}
					if($val>($on_time+5)){
						$return_data[$day_key][$epy_key]->status['late'] = "";//超過五分鐘就不算遲到 算曠職
					}
				}							
				//開始處理曠職問題，原則:以入抓出(往前推)，最後一筆抓下班
				if($val>$on_time&&$val<$off_time){							//在上班期間有刷卡就是有問題!!
					if($current_status == 1){//進場時間就是計算截止點
						if($key==0&&$val>($on_time+5)){	//直接抓住第一筆，只有第一筆需要注意中午或下午進廠
							if($val_hr<13){	//早上到中午都只要以此時間去扣上班時間0800
								$absenteeism_hr += ($val_hr-$on_time_hr)+($val_mn-$on_time_mn)/60;
							}
							if($val_hr>=13){	//下午進廠，先加上午四小時，再加
								$absenteeism_hr += 4;
								$absenteeism_hr += ($val_hr-13)+($val_mn-0)/60;
							}
						}else if($val_hr != 12){	//中午時間不用處理了
							if(@$punch_data[$key-1]){
								$temp_time = $punch_data[$key-1];
								$temp_hr = substr($temp_time,0,2);$temp_mn = substr($temp_time,2,2);
								if($temp_mn>30){$temp_mn="30";}if($temp_mn<30){$temp_mn="00";}
								
								if($temp_hr<12&&$val_hr>12){//需分開算
									$absenteeism_hr += (12-$temp_hr)+(0-$temp_mn)/60;
									$absenteeism_hr += ($val_hr-13)+($val_mn-0)/60;
								}else{
									$absenteeism_hr += ($val_hr-$temp_hr)+($val_mn-$temp_mn)/60;
								}
							}
						}else{//還是處理一下好了
							if(@$punch_data[$key-1]){
								$temp_time = $punch_data[$key-1];
								$temp_hr = substr($temp_time,0,2);$temp_mn = substr($temp_time,2,2);
								if($temp_mn>30){$temp_mn="30";}if($temp_mn<30){$temp_mn="00";}
								if($temp_hr!=12){//這等於早上又有出去中午才回來?
									if($temp_hr<$on_time_hr){
										$absenteeism_hr += ($val_hr-8)+($val_mn-0)/60;
									}else{
										$absenteeism_hr += ($val_hr-$temp_hr)+($val_mn-$temp_mn)/60;
									}
								}
							}
						}
						
					}
					if($current_status == 0){//離場時間就是計算開始點，只抓下班時間
						if($key+1==$epy_val->c_te003){//表示最後一筆，又刷在上班時間
							$absenteeism_hr += ($off_time_hr-$val_hr)+($off_time_mn-$val_mn)/60;
							if($val_hr<12){$absenteeism_hr-=1;}
						}
					}
				}
				
				
			}
			
			$return_data[$day_key][$epy_key]->status['absenteeism'] = "";
			$return_data[$day_key][$epy_key]->absenteeism_hr = $absenteeism_hr;
			if($absenteeism_hr>0){
				$return_data[$day_key][$epy_key]->status['absenteeism'] .= "曠".$absenteeism_hr."小時";
			}
			
			if($type=="B"){
				if($return_data[$day_key][$epy_key]->absenteeism_hr==0&&!@$return_data[$day_key][$epy_key]->status['error']){
					unset($return_data[$day_key][$epy_key]);
				}
			}
			if($type=="C"){
				if($return_data[$day_key][$epy_key]->absenteeism_hr==0&&!@$return_data[$day_key][$epy_key]->status['error']){
					unset($return_data[$day_key][$epy_key]);
				}
				else if($return_data[$day_key][$epy_key]->absenteeism_hr-$return_data[$day_key][$epy_key]->leave_hr==0){
					unset($return_data[$day_key][$epy_key]);
				}
			}
			
		}
		
		
		
		
		
		
		
		}
		
		return $return_data;
	}
		
		function get_leave($date){
			preg_match_all('/\d/S',$date, $matches);  //處理日期字串
			$date = implode('',$matches[0]);
			$sql = " SELECT * FROM `paltg` WHERE tg003 = '".$date."' "; 
			$query = $this->db->query($sql);
			$ret = $query->result();
			
			return $ret;
		}
		
		function get_work_class(){
			$sql = " SELECT * FROM `palmo` "; 
			$query = $this->db->query($sql);
			$ret = $query->result();
			
			return $ret;
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
		
		function get_oneday_data($seq1){
			preg_match_all('/\d/S',$seq1, $matches);
			$seq1 = implode('',$matches[0]);
			$sql9 = " SELECT a.mv004 ,IFNULL(c.me002,'') as me002,a.mv001 as te001,a.mv002,a.mv027,b.te003,b.te002, d.mo002, d.mo003, d.mo004, d.mo005, d.mo006 
				FROM cmsmv as a
				LEFT JOIN palte as b ON a.mv001=b.te001 and b.te002 = $seq1 ";
			$sql9 .= "LEFT JOIN cmsme as c ON a.mv004=c.me001
				LEFT JOIN palmo as d ON a.mv027 = d.mo001 
				WHERE (a.mv022='' or a.mv022 IS NULL) and a.mv026='Y'  
				ORDER BY a.mv004 asc, a.mv021 asc, b.te002 asc, b.te003 asc";
			//echo $sql9;exit;
			$result = mysql_query($sql9) or die_content("查詢資料失敗".mysql_error());
			$query = $this->db->query($sql9);
			$ret = $query->result();
			return $ret;
		}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>