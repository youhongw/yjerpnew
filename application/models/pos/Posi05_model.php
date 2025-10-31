<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class posi05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
	
	function get_store_setting()
		{
			$query = $this->db->select('mk001,mk002,mk003,mk004,mk005,mk006,mk007,mk008,mk009,mk010,mk011,mk012,mk013,mk014,mk015,mk016,mk017,mk018,mk019,mk020,mk021,mk022,mk023,mk024')
				->from('posmk');
			$result = $query->get()->result();
			$data = $result[0];
			
			$query = $this->db->select('mf001,mf002,mf003,mf004,mf005,mf006,mf007')
				->from('admmf')
				->where("mf001 ='".$data->mk023."'");
			$result = $query->get()->result();
			if(@$result[0]){
				$temp = $result[0];
				$data->mf002 = $temp->mf002;
				$data->mf003 = $temp->mf003;
				$data->mf004 = $temp->mf004;
				$data->mf005 = $temp->mf005;
				$data->mf006 = $temp->mf006;
				$data->mf007 = $temp->mf007;
			}
			else{
				$data->mf002 = "無此使用者";
			}
			return $data;			
		}
		
	function change_employee($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			$data = new stdClass();
			$query = $this->db->select('mk001,mk002,mk003,mk004,mk005,mk006,mk007,mk008,mk009,mk010,mk011,mk012,mk013,mk014,mk015,mk016,mk017,mk018,mk019,mk020,mk021,mk022,mk023,mk024')
				->from('posmk');
			$result = $query->get()->result();
			$origin = $result[0];
			
			$query = $this->db->select('mf001,mf002,mf003,mf004,mf005,mf006,mf007')
				->from('admmf')
				->where("mf001 ='". $mf001 ."'");
			$result = $query->get()->result();
			if(@$result[0]){
				$temp = $result[0];
				if($mf002 == $temp->mf003){
					$sql = "UPDATE posmk SET mk023 = '".$mf001."' WHERE mk001 = '". $origin->mk001 ."'";
					$result = mysql_query($sql);
					
					$data->ret = "success";
					$data->response = "登入成功。";
				}
				else{
					$data->ret = "fail";
					$data->response = "代號或密碼錯誤。";
				}
			}
			else{
				$data->ret = "fail";
				$data->response = "代號或密碼錯誤。";
			}
			return $data;			
		}
/*****商品*****/
	function list_goods($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			if(!@$sidx){
				$sidx = "mb001";
				$sord = "asc";
			}
			if(@$rows){
				$limit = $rows * ($page-1);
			}
			else{
				$rows = 1;
			}
			$limit = empty($limit) ? "0,".$rows : $limit.",".$rows;
			
			$query = $this->db->select('mb001,mb002,mb003,mb004,mb009,mb013,mb046,mb047,mb051,mb064')
				->from('invmb')
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
			$result = $query->get()->result();
			
			$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('invmb');
			$num = $query->get()->result();		
			$records = $num[0]->count;
			$total = ceil($records/$rows);
			$data['total']=$total;
			$data['records']=$records;
			$data['rows'] = $result;
			return $data;
		}
		
	function select_goods($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			
			$where_str = "";
			if(!@$sidx){
				$sidx = "mb001";
				$sord = "asc";
			}
			if(@$rows){
				$limit = $rows * ($page-1);
			}
			else{
				$rows = 1;
			}
			if(@$where){
				$where_str .= "".$where_col." = '".$where."' ";
			}
			if(@$mode == "wild"){
				$where_str = "";
				$where_str .= "".$where_col." like '%".$where."%' ";
			}
			
			if($where_col == "all"){
				$goods_col = array( "mb002","mb003","mb004","mb009","mb013","mb046","mb047","mb051","mb064" );
				$where_str = "";
				$where_str .= "mb001 like '%".$where."%'";
				foreach($goods_col as $val){
					$where_str .= " or ";
					$where_str .= $val." like '%".$where."%'";
				}
			}
			$limit = empty($limit) ? "0,".$rows : $limit.",".$rows;
			
			$query = $this->db->select('mb001,mb002,mb003,mb004,mb009,mb013,mb046,mb047,mb051,mb064')
				->from('invmb')
				->where($where_str)
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
			$result = $query->get()->result();
			if(@$result){  //檢查有無促銷
			if(@$mode != "wild" && $this->check_promotions($result[0]->mb001) && $where_col != "all"){
				$temp_ret = $this->check_promotions($result[0]->mb001);
				if($temp_ret!="no_input" && $temp_ret!="no_promo" && $temp_ret!="over_time" ){
					$result[0]->td002 = $temp_ret->td002;
					$result[0]->td009 = $temp_ret->td009;
					$result[0]->td010 = $temp_ret->td010;
				}
			}
			}
			$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('invmb')
				->where($where_str);
			$num = $query->get()->result();		
			$records = $num[0]->count;
			$total = ceil($records/$rows);
			$data['total']=$total;
			$data['records']=$records;
			$data['rows'] = $result;
			return $data;
		}
		/***促銷***/
		function check_promotions($td004){
			$setting = $this->get_store_setting();
			$td001 = $setting->mk022;
			if(!@$td001 || !@$td004)
				return "no_input";
			$query = $this->db->select('td001,td002,td003,td004,td005,td006,td007,td008,td009,td010,td011')
				->from('postd')
				->where("td001 = '".$td001."' and td004 = '".$td004."'")
				->order_by("td002", "asc");
				$result = $query->get()->result();
			if(@$result){
				$query = $this->db->select('tc001,tc002,tc003,tc004,tc005,tc006,tc007,tc008')
				->from('postc')
				->where("tc001 = '".$td001."' and tc002 = '".$result[0]->td002 ."' and tc004 <= '".date("Ymd")."' and tc006 >= '".date("Ymd")."'");
				$title_result = $query->get()->result();
			}
			else if(!@$result)
				return 'no_promo';
			
			if(@$result && !@$title_result){
				return 'over_time';
			}
			
			return $result[0];
		}
		
		
/*****商品*****/
/*****銷貨*****/
	function list_sales($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			$where_str = "";
			if(!@$sidx){
				$sidx = "ta002";
				$sord = "desc";
			}
			if(@$rows){
				$limit = $rows * ($page-1);
			}
			if(@$date){
				preg_match_all('/\d/S',$date, $matches);  //處理日期字串
				$date = implode('',$matches[0]);
				$where_str .= "where ta002 like '".$date."%' ";
			}
			else if(@$str_date ||@$end_date){
				preg_match_all('/\d/S',$str_date, $matches);
				$str_date = implode('',$matches[0]);
				preg_match_all('/\d/S',$end_date, $matches);
				$end_date = implode('',$matches[0]);
				$where_str .= "where";
				if(@$str_date)
					$where_str .= " substring(ta002 ,1,8) >= '".$str_date."'";
				if(@$str_date &&@$end_date)
					$where_str .= " and";
				if(@$end_date)
					$where_str .= " substring(ta002 ,1,8) >= '".$str_date."' and substring(ta002 ,1,8) <= '".$end_date."'";
			}
			
			if(@$where && $where_col != "all"){
				if($where_str != ""){
					$where_str .= "and ".$where_col." like '%".$where."%' ";
				}else{
					$where_str .= "where ".$where_col." like '%".$where."%' ";
				}
				
			}
			else if(@$where_col == "all"){
				if($where_str != ""){
					$where_str .= " and (";
				}else{
					$where_str .= "where";
				}
				$record_col = array( 'ta002','ta008','ta009','ta010','ta012','ta013','ta017' );
				$where_str .= "ta001 like '%".$where."%'";
				foreach($record_col as $val){
					$where_str .= " or ";
					$where_str .= $val." like '%".$where."%'";
				}
			}
			if((@$str_date || @$end_date) &&@$where_col == "all"){
				$where_str .= ")";
			}
			$limit = empty($limit) ? "0,".$rows : $limit.",".$rows;
			$order_str = "order by ".$sidx." ".$sord." limit ".$limit;
			$sql = "select * from posta ";
			if(@$where_str){
				$sql .= $where_str;
			}
			$sql .= $order_str;
			$result = mysql_query($sql);
			$data = array();
			$row_data = array();
			$get_need = array('ta001','ta002','ta008','ta009','ta010','ta012','ta013','ta017');
			$total = 0;
			while($row = mysql_fetch_array($result)){
				foreach($get_need as $val){
					$temp_row[$val] = $row[$val];
				}
				$type_ary = array(
					"1" => "銷貨",
					"2" => "銷退"
				);
				$temp_row['ta001_str'] = $type_ary[$temp_row['ta001']];
				$row_data[] = $temp_row;
				$total ++;
			}
			$sql = "SELECT COUNT(*) FROM posta ";
			if(@$where_str){
				$sql .= $where_str;
			}
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$records = $row[0];
			$total = ceil($records/$rows);
			$data['total']=$total;
			$data['records']=$records;
			$data['rows'] = $row_data;
			
			return $data;
		}
	
	function select_sales($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			if(!@$ta001 || !@$ta002){
				return "param_error";
			}
			$where_str = "ta001 = '".$ta001."' and ta002 = '".$ta002."' ";		
			$query = $this->db->select('ta001,ta002,ta003,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta013,ta014,ta015,ta016,ta017,ta018,ta019')
				->from('posta')
				->where($where_str);
			$result = $query->get()->result();
			if(@$result[0])
				$title_ret = $result[0];
			else
				$title_ret = "nodata";
			
			if($title_ret == "nodata"){  //查無檔頭就不查檔身
				return $title_ret;
			}
			
			$where_str = "tb001 = '".$ta001."' and tb002 = '".$ta002."' ";		
			$query = $this->db->select('tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb008,tb009,tb010,tb011,tb012,tb013,tb014,tb015,tb016')
				->from('postb')
				->where($where_str);
			$result = $query->get()->result();
			if(@$result)
				$cont_ret = $result;
			else
				$cont_ret = "nodata";
			
			$ret['title'] = $title_ret;
			$ret['cont'] = $cont_ret;
			
			return $ret;
		}
	
	function save_sales($data_title,$data_cont)
		{
			$receipt_number = $data_title['ta010'];
			$next_number = $this->get_max_serial();
			$data_title['ta002'] = $next_number;
			$data_title['ta003'] = date("Y-m-d");
			$data_title['ta004'] = date("H:i:s");
			if($data_title['ta010'] != "DDDDDDDDDD")
				$data_title['ta010'] = $this->get_current_receipt();
			//表頭處理
			$SQL = "INSERT INTO `posta` ";
			$col_str = "(";
			$val_str = "(";
			foreach($data_title as $key => $val ){
				$col_str .= "`".$key."`,";
				$val_str .= "'".$val."',";
			}
			$col_str = substr($col_str,0,-1).")";
			$val_str = substr($val_str,0,-1).")";
			$SQL .= $col_str." VALUES ".$val_str;
			
			$ret = mysql_query($SQL);
			if($ret){
				$res_title = $next_number;
			}else{
				$res_title = $ret;
			}
			//表身處理
			foreach($data_cont as $key => $val ){
				$SQL = "INSERT INTO `postb` ";
				$col_str = "(`tb002`,";
				$val_str = "('".$next_number."',";
				if(is_array($val)&&!empty($val)){
					foreach($val as $k => $v){
						$col_str .= "`".$k."`,";
						$val_str .= "'".$v."',";	
					}
				$col_str = substr($col_str,0,-1).")";
				$val_str = substr($val_str,0,-1).")";
				$SQL .= $col_str." VALUES ".$val_str;
				$ret = mysql_query($SQL);
				}
			}
			if($ret){
				$res_cont = $next_number;
			}else{
				$res_cont = $ret;
			}
			
			if($res_title && $res_cont){
				$res = $res_title;
				$this->set_current_receipt($data_title['ta010']);
			}else{
				$res = false;
			}
			return $res;
		}
	
	function select_refound_sales($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			if(!@$ta001 || !@$ta010){
				return "param_error";
			}
			$where_str = "ta001 = '".$ta001."' and ta010 = '".$ta010."' ";		
			$query = $this->db->select('ta001,ta002,ta003,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta013,ta014,ta015,ta016,ta017,ta018,ta019')
				->from('posta')
				->where($where_str);
			$result = $query->get()->result();
			if(@$result[0]){
				$title_ret = $result[0];
				$tb002 = $result[0]->ta002;
			}
			else
				$title_ret = "nodata";
			
			if($title_ret == "nodata"){  //查無檔頭就不查檔身
				return $title_ret;
			}
			
			$where_str = "tb001 = '".$ta001."' and tb002 = '".$tb002."' ";		
			$query = $this->db->select('tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb008,tb009,tb010,tb011,tb012,tb013,tb014,tb015,tb016')
				->from('postb')
				->where($where_str);
			$result = $query->get()->result();
			if(@$result)
				$cont_ret = $result;
			else
				$cont_ret = "nodata";
			
			$ret['title'] = $title_ret;
			$ret['cont'] = $cont_ret;
			
			return $ret;
		}
	
	function refound_sales($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			if(!@$ta001 || (!@$ta002 && !@$ta010)){
				return "param_error";
			}
			if(@$ta002){
				$where_str = "ta001 = '".$ta001."' and ta002 = '".$ta002."' ";
			}
			if(@$ta010){
				$where_str = "ta001 = '".$ta001."' and ta010 = '".$ta010."' ";
			}
			$query = $this->db->select('ta001,ta002,ta003,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta013,ta014,ta015,ta016,ta017,ta018,ta019')
				->from('posta')
				->where($where_str);
			$result = $query->get()->result();
			if(@$result[0]){
				$title_ret = $result[0];
				$tb002 = $result[0]->ta002;
				//檢查是否有銷退過
				if(@$ta002){
					$where_str = "ta001 = '2' and ta002 = '".$ta002."' ";
				}
				if(@$ta010){
					$where_str = "ta001 = '2' and ta010 = '".$ta010."' ";
				}	
				$query = $this->db->select('ta001,ta002,ta003,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta013,ta014,ta015,ta016,ta017,ta018,ta019')
					->from('posta')
					->where($where_str);
				$result = $query->get()->result();
				if(@$result[0]){
					$res_title = "have_refound";
				}
			}
			else
				$title_ret = "nodata";
			
			if($title_ret == "nodata"){  //查無檔頭就不查檔身
				return $title_ret;
			}
			
			$where_str = "tb001 = '".$ta001."' and tb002 = '".$tb002."' ";		
			$query = $this->db->select('tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb008,tb009,tb010,tb011,tb012,tb013,tb014,tb015,tb016')
				->from('postb')
				->where($where_str);
			$result = $query->get()->result();
			if(@$result)
				$cont_ret = $result;
			else{
				$cont_ret = "nodata";
				return "nodata";
			}
				
			$data_title = $title_ret;
			$data_title->ta001 = 2;
			//表頭處理
			$SQL = "INSERT INTO `posta` ";
			$col_str = "(";
			$val_str = "(";
			foreach($data_title as $key => $val ){
				$col_str .= "`".$key."`,";
				$val_str .= "'".$val."',";
			}
			$col_str = substr($col_str,0,-1).")";
			$val_str = substr($val_str,0,-1).")";
			$SQL .= $col_str." VALUES ".$val_str;
			$ret = mysql_query($SQL);
			if($ret){
				$res_title = $data_title->ta002;
			}else if($res_title == "have_refound"){
				$res_title = "have_refound";
			}else{
				$res_title = $ret;
			}
			//表身處理
			$data_cont = $cont_ret;
			foreach($data_cont as $key => $val ){
				$SQL = "INSERT INTO `postb` ";
				$col_str = "(`tb001`,";
				$val_str = "('2',";
				foreach($val as $k => $v){
					if($k != 'tb001' ){
						$col_str .= "`".$k."`,";
						$val_str .= "'".$v."',";
					}
				}
				$col_str = substr($col_str,0,-1).")";
				$val_str = substr($val_str,0,-1).")";
				$SQL .= $col_str." VALUES ".$val_str;
				$ret = mysql_query($SQL);
			}
			if($ret){
				$res_cont = $data_title->ta002;
			}else{
				$res_cont = $ret;
			}
			
			if($res_title && $res_cont){
				$res = $res_title;
			}else{
				$res = false;
			}
			
			if($res_title == "have_refound"){
				$res = "have_refound";
			}
			return $res;
			
		}
		
	function get_max_serial()
		{
			$sql = "SELECT MAX(ta002) FROM posta WHERE ta002 like '".date("Ymd")."%' ";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			if(!$row[0]){
				$ret = date("Ymd")."0001";
			}else{
				$ret = $row[0]+1;
			}
			return $ret;
		}
	function select_sales_byrece($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			if(!@$invoice || !@$date){
				return "param_error";
			}
			$where_str = "ta010 = '".$invoice."' and substring(ta002 ,1,6) = '".$date."'";		
			$query = $this->db->select('ta001,ta002,ta003,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta013,ta014,ta015,ta016,ta017,ta018,ta019')
				->from('posta')
				->where($where_str);
			$result = $query->get()->result();
			if(@$result[0]){
				$title_ret = $result[0];
				$ta001 = $result[0]->ta001;
				$ta002 = $result[0]->ta002;
			}
			else
				$title_ret = "nodata";
			
			if($title_ret == "nodata"){  //查無檔頭就不查檔身
				return $title_ret;
			}
			
			$where_str = "tb001 = '".$ta001."' and tb002 = '".$ta002."' ";		
			$query = $this->db->select('tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb008,tb009,tb010,tb011,tb012,tb013,tb014,tb015,tb016')
				->from('postb')
				->where($where_str);
			$result = $query->get()->result();
			if(@$result)
				$cont_ret = $result;
			else
				$cont_ret = "nodata";
			
			$ret['title'] = $title_ret;
			$ret['cont'] = $cont_ret;
			
			return $ret;
		}
/*****銷貨*****/
/*****發票方法*****/
	function list_receipt($get_data,$post_data)
		{
			$setting = $this->get_store_setting();
			extract($get_data);extract($post_data);
			if(!@$sidx){
				$sidx = "mb002";
				$sord = "desc";
			}
			if(@$rows){
				$limit = $rows * ($page-1);
			}
			else{
				$rows = 1;
			}
			$limit = empty($limit) ? "0,".$rows : $limit.",".$rows;
			
			$query = $this->db->select('mb001,mb002,mb003,mb004,mb005,mb006,mb007,mb008,mb009')
				->from('posmb')
				->where("mb001 = '".$setting->mk001."'")
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
			$result = $query->get()->result();
			$receipt_ary = Array('1'=>"二聯",'2'=>"三聯",'3'=>"二聯式收銀機發票",'4'=>"三聯式收銀機發票",'5'=>"電子計算機發票",'6'=>"無紙發票証明聯");
			foreach($result as $key => $val){
				if($val->mb004)
					$result[$key]->mb004_str = $receipt_ary[$val->mb004];
			}
			$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('posmb')
				->where("mb001 = '".$setting->mk001."'")
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
			$num = $query->get()->result();		
			$records = $num[0]->count;
			$total = ceil($records/$rows);
			$data['total']=$total;
			$data['records']=$records;
			$data['rows'] = $result;
			return $data;
		}
	function get_current_receipt()
		{
			$setting = $this->get_store_setting();
			$sql = "SELECT mb002,mb003,mb006,mb007,mb008 FROM posmb WHERE mb002 <= '".date("Ym")."' and mb003 >= '".date("Ym")."' and mb001 = '".$setting->mk001."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			if(!$row['mb008']){
				$ret = $row['mb006'];
			}else{
				$temp = substr($row['mb008'],2,8);
				$ret = substr($row['mb008'],0,2).($temp+1);
			}
			if(!$ret){
				$ret = "noset";
			}
			while(1){
				$chk = $this->check_receipt($ret,$row['mb002'],$row['mb003']);
				if($chk){
					$temp = substr($ret,2,8);
					$ret = substr($ret,0,2).($temp+1);
				}else{
					break;
				}
			}
			if($ret>$row['mb007']){
				$ret = "overflow";
			}
			return $ret;
		}
	function set_current_receipt($used_receipt,$get_data="",$post_data="")
		{
			if(@$get_data)
				extract($get_data);
			if(@$post_data)
				extract($post_data);
			if(!$used_receipt)
				return "noinput";
			if(@$str_date)
				$set_date = $str_date;
			else
				$set_date = date("Ym");
			$setting = $this->get_store_setting();
			$sql = "SELECT mb002,mb003,mb006,mb007,mb008 FROM posmb WHERE mb002 <= '".$set_date."' and mb003 >= '".$set_date."' and mb001 = '".$setting->mk001."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			if(!$row['mb006']){
				return "wrong_setting";
			}else{
				$temp_eng = substr($row['mb006'],0,2);
				$str_temp = substr($row['mb006'],2,8);
				$end_temp = substr($row['mb007'],2,8);
				$input_eng = substr($used_receipt,0,2);
				$input_temp = substr($used_receipt,2,8);
			}
			if($input_eng != $temp_eng){
				return "wrong_format";
			}
			else if($input_temp<$str_temp || $input_temp>$end_temp){
				return "wrong_range";
			}
						$used_receipt = substr($used_receipt,0,2).(substr($used_receipt,2,8)+1);//先加1模擬成
			$chk = $this->check_receipt($used_receipt,$row['mb002'],$row['mb003']);
			if($chk){
				return "have_used";
			}
			
			$used_receipt = substr($used_receipt,0,2).(substr($used_receipt,2,8)-1);
			$setting = $this->get_store_setting();
			$sql = "UPDATE posmb SET mb008 = '".$used_receipt."' WHERE mb002 <= '".$set_date."' and mb003 >= '".$set_date."' and mb001 = '".$setting->mk001."'";
			$result = mysql_query($sql);
			if($result==true)
				return "success";
			
			return "Fail";
		}
	function check_receipt($chk_receipt,$str_date,$end_date)
		{
			$sql = "SELECT COUNT(*) FROM posta where ta010 = '".$chk_receipt."' and (ta002 like '".$str_date."%' or ta002 like '".$end_date."%')";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$ret = $row[0];
			
			return $ret;
		}
/*****發票方法*****/
/*****會    員*****/
	function list_member($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			if(!@$sidx){
				$sidx = "mc001";
				$sord = "asc";
			}
			if(@$rows){
				$limit = $rows * ($page-1);
			}
			else{
				$rows = 1;
			}
			$limit = empty($limit) ? "0,".$rows : $limit.",".$rows;
			$where_str = "";
			if(@$where){
				$where_str .= "".$where_col." = '".$where."' ";
			}
			if(@$mode == "wild"){
				$where_str = "";
				$where_str .= "".$where_col." like '%".$where."%' ";
			}
			
			if(@$where_col == "all"){
				$member_col = array( "mc001","mc002","mc005","mc006","mc014","mc019","mc021" );
				$where_str = "";
				$where_str .= "mc001 like '%".$where."%'";
				foreach($member_col as $val){
					$where_str .= " or ";
					$where_str .= $val." like '%".$where."%'";
				}
			}			
			
			
			if(@$where_str){
				$query = $this->db->select('mc001,mc002,mc005,mc006,mc014,mc019,mc021')
				->from('posmc')
				->where($where_str)
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
			}
			else{
				$query = $this->db->select('mc001,mc002,mc005,mc006,mc014,mc019,mc021')
				->from('posmc')
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
			}
			$result = $query->get()->result();
			
			if(@$where_str){
				$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('posmc')
				->where($where_str);
			}
			else{
				$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('posmc');
			}
			$num = $query->get()->result();		
			$records = $num[0]->count;
			$total = ceil($records/$rows);
			$data['total']=$total;
			$data['records']=$records;
			$data['rows'] = $result;
			return $data;
		}
	function select_member($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			
			if($where_col == "all"){
				$member_col = array( "mc001","mc002","mc005","mc006","mc014","mc019","mc021" );
				$where_str = "";
				$where_str .= "mc001 = '".$where."'";
				foreach($member_col as $val){
					$where_str .= " or ";
					$where_str .= $val." = '".$where."'";
				}
			}
			
			$query = $this->db->select('mc001,mc002,mc005,mc006,mc014,mc019,mc021')
				->from('posmc')
				->where($where_str);
			$result = $query->get()->result();
			if(!$result)
				$ret = "nodata";
			else{
				$res = new stdClass();
				$ret = $result[0];
				foreach($ret as $key=>$val){
					if(!$val){
						$ret->$key = " ";
					}
				}
			}
			return $ret;
		}
/*****會    員*****/
/*****促    銷*****/
	function list_promotion($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			if(!@$sidx){
					$sidx = "td002";
					$sord = "asc";
				}
				if(@$rows){
					$limit = $rows * ($page-1);
				}
				else{
					$rows = 1;
				}
			$limit = empty($limit) ? "0,".$rows : $limit.",".$rows;
				
			$setting = $this->get_store_setting();
			$td001 = $setting->mk022;
			if(@$td001){
				$query = $this->db->select('a.td001,a.td002,a.td003,a.td004,a.td005,a.td006,a.td007,a.td008,a.td009,a.td010,a.td011,b.tc002,b.tc004,b.tc006')
				->from('postd as a')
				->join('postc as b', 'a.td002 = b.tc002','left')
				->where("a.td001 = '".$td001."'")
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
				$result = $query->get()->result();
			}
			else if(!@$td001)
				return 'no_setting';
			
			$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('postd')
				->where("td001 = '".$td001."'")
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
			$num = $query->get()->result();		
			$records = $num[0]->count;
			$total = ceil($records/$rows);
			$data['total']=$total;
			$data['records']=$records;
			$data['rows'] = $result;
			
			return $data;
		}

	function select_promotion($get_data,$post_data)
		{
			extract($get_data);extract($post_data);
			$setting = $this->get_store_setting();
			$td001 = $setting->mk022;
			$td001_str = $setting->mk002;
			if(!@$sidx){
					$sidx = "a.td002";
					$sord = "asc";
				}
				if(@$rows){
					$limit = $rows * ($page-1);
				}
				else{
					$rows = 1;
				}
			$limit = empty($limit) ? "0,".$rows : $limit.",".$rows;		
			$where_str = "a.td001 = '".$td001."'";
			if(@$where_col &&@$where){
				switch($where_col){
					case 'all' :
						$where_str .= " and (a.td004 like '%".$where."%'
						or a.td011 like '%".$where."%' 
						or a.td005 like '%".$where."%'
						or a.td002 like '%".$where."%')";
					break;
					case 'td004' :
						$where_str .= " and a.td004 like '%".$where."%'";
					break;
					case 'td011' :
						$where_str .= " and a.td011 like '%".$where."%'";
					break;
					case 'td005' :
						$where_str .= " and a.td005 like '%".$where."%'";
					break;
					case 'td002' :
						$where_str .= " and a.td002 like '%".$where."%'";
					break;
					default:
						return "param_error";
					break;
				}
			}
			if(@$str_date ||@$end_date){
				preg_match_all('/\d/S',$str_date, $matches);
				$str_date = implode('',$matches[0]);
				preg_match_all('/\d/S',$end_date, $matches);
				$end_date = implode('',$matches[0]);
				$where_str .= " and";
				if(@$str_date)
					$where_str .= " substring(tc006 ,1,8) >= '".$str_date."'";
				if(@$str_date &&@$end_date)
					$where_str .= " and";
				if(@$end_date)
					$where_str .= " substring(tc004 ,1,8) <= '".$end_date."'";
			}
			if(!@$td001){
				return "param_error";
			}
			if(@$td001){
				$query = $this->db->select('a.td001,a.td002,a.td003,a.td004,a.td005,a.td006,a.td007,a.td008,a.td009,a.td010,a.td011,b.tc002,b.tc004,b.tc006')
				->from('postd as a')
				->join('postc as b', 'a.td002 = b.tc002','left')
				->where($where_str)
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
				$result = $query->get()->result();
			}
			else if(!@$td001)
				return 'no_setting';
			$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
				->from('postd as a')
				->join('postc as b', 'a.td002 = b.tc002','left')
				->where($where_str)
				->order_by($sidx, $sord)
				->limit( $rows,$limit);
				
			$num = $query->get()->result();
			$records = $num[0]->count;
			$total = ceil($records/$rows);
			$data['total'] = $total;
			$data['records'] = $records;
			$data['rows'] = $result;
			
			return $data;
		}
	/*function check_promotions($td004){
		$setting = $this->get_store_setting();
		$td001 = $setting->mk022;
		if(!@$td001 || !@$td004)
			return "no_input";
		$query = $this->db->select('td001,td002,td003,td004,td005,td006,td007,td008,td009,td010,td011')
			->from('postd')
			->where("td001 = '".$td001."' and td004 = '".$td004."'")
			->order_by("td002", "asc");
			$result = $query->get()->result();
		if(@$result){
			$query = $this->db->select('tc001,tc002,tc003,tc004,tc005,tc006,tc007,tc008')
			->from('postc')
			->where("tc001 = '".$td001."' and tc002 = '".$result[0]->td002 ."' and tc004 <= '".date("Ymd")."' and tc006 >= '".date("Ymd")."'");
			$title_result = $query->get()->result();
		}
		else if(!@$result)
			return 'no_promo';
		
		if(@$result && !@$title_result){
			return 'over_time';
		}
		
		return $result[0];
	}*/
/*****促    銷*****/
/*
if(!@$td001)
	return "no_setting";
$query = $this->db->select('td001,td002,td003,td004,td005,td006,td007,td008,td009,td010,td011')
	->from('postd')
	->where("td001 = '".$td001."'")
	->order_by("td002", "asc");
	$result = $query->get()->result();
*/
}




/* End of file model.php */
/* Location: ./application/model/model.php */
?>