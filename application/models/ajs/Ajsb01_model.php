<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajsb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 轉入分錄底稿及傳票 付款  
	function batchaf($date='')
        {
			//mq312 付款單Y acpq01a73 單別 mq401 起迄單號 403 404 日期 407 408 底稿409 傳票日410 
			$mq312=$this->input->post('mq312'); 
            $mq401=$this->input->post('acpq01a73'); 
            $mq403=$this->input->post('mq403');	
            $mq404=$this->input->post('mq404');	
			 preg_match_all('/\d/S',$this->input->post('mq407'), $matches);  //處理日期字串
			 $mq407 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('mq408'), $matches);  //底稿批號
			 $mq408 = implode('',$matches[0]);
			 $mq409=$this->input->post('mq409');
			 preg_match_all('/\d/S',$this->input->post('mq410'), $matches);  //傳票日期
			 $mq410 = implode('',$matches[0]);
			
			//取傳票單別
			$query81 = $this->db->query("SELECT mb002,mb003,mb018,mb019  FROM ajsmb as a 
		  WHERE mb002='$mq401'     ");         
	   foreach ($query81->result() as $row)
            {
               $mb002[]=$row->mb002;
               $mb003[]=$row->mb003;
               $mb018[]=$row->mb018;
               $mb019[]=$row->mb019;			   
            }
			   $mb003=$mb003[0]; //傳票單別
			   $mb018=$mb018[0]; //借摘要
			   $mb019=$mb019[0]; //貸摘要
			 //  $ta005no[]=$this->checkvno($mb003,$mq410);
		    //取出一筆付款單單頭
			$this->db->select('a.*,c.mq002 as tc001disp');
			$this->db->from('acptc as a');
			$this->db->join('cmsmq as c', 'a.tc001 = c.mq001  ','left');  //單別
			$this->db->where('a.tc001', $mq401); 
			$this->db->where('a.tc009 !=', 'Y');
			if ($mq403>='0') {
	        $this->db->where('a.tc002 >=', $mq403);
            $this->db->where('a.tc002 <=', $mq404);}
            if ($mq407>='0') {
	        $this->db->where('a.tc016 >=', $mq407);
            $this->db->where('a.tc016 <=', $mq408);}
			$query = $this->db->get();
			$result = $query->result();
		$ii=0;
		//$ta001[0]=0;
		//$kk=$this->checksno($mq409);
		//var_dump($kk);exit;
		
		foreach($result as $row) {
			$ta001[]=$mq409;
			$ta002[]=$this->checksno($mq409);
			$ta003[]=date("H:i");
			$ta004[]=$mb003;
			$ta005[]=$this->checkvno($mb003,$mq410);
			$ta006[]=$mq410;
			$ta007[]=$row->tc013;
			$ta008[]=$row->tc013;
			$ta009[]=$row->tc014;
			$ta010[]=$row->tc007;
			$ta011[]=$this->session->userdata('manager');
			$ta012[]=date("Ymd");
			$ta013[]=date("H:i");
			$ta014[]="Y";
			$ta015[]=$row->tc001disp;
			$ta016[]="1";
			$tc002[]=$row->tc002;
			//傳票頭
			$ta001a[]=$mb003;
			//$ta002a[]=$ta005[];
			$ta003a[]=$mq410;
			$ta006a[]='D';
			$ta007a[]=$row->tc013;
			$ta008a[]=$row->tc014;
			$ta009a[]=$row->tc007;
			$ta010a[]='Y';
			$ta011a[]='N';
			$ta012a[]=0;
			$ta014a[]=date("Ymd");
			$ta015a[]=$this->session->userdata('manager');
			$ta016a[]='N';
		$ii = $ii + 1 ; }
		$i=0;
	//	var_dump($ta002[0]);exit;
		while ($i<$ii) {
		        //底稿單頭增加				
				 $sql82 = " INSERT IGNORE INTO ajsta (ta001,ta002,ta003,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta013,ta014,ta015,ta016) 
				 values ('$ta001[$i]','$ta002[$i]','$ta003[$i]','$ta004[$i]','$ta005[$i]','$ta006[$i]','$ta007[$i]','$ta008[$i]','$ta009[$i]',
				         '$ta010[$i]','$ta011[$i]','$ta012[$i]','$ta013[$i]','$ta014[$i]','$ta015[$i]','$ta016[$i]')  "; 
				$query = $this->db->query($sql82);
				//傳票單頭增加 203,204				
				 $sql83 = " INSERT IGNORE INTO actta (ta001,ta002,ta003,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta014,ta015,ta016) 
				 values ('$ta001a[$i]','$ta005[$i]','$ta003a[$i]','$ta006a[$i]','$ta007a[$i]','$ta008a[$i]','$ta009a[$i]',
				         '$ta010a[$i]','$ta011a[$i]','$ta012a[$i]','$ta014a[$i]','$ta015a[$i]','$ta016a[$i]')  "; 
				$query = $this->db->query($sql83);
				
				$sql2= "update acptc set tc009='Y',tc015='Y',tc201= '$ta001[$i]',tc202='$ta002[$i]',tc203='$ta001a[$i]',tc204='$ta005[$i]'
					    where  tc001='$mq401' and tc002='$tc002[$i]'  ";
				$this->db->query($sql2); 
				
				
			//	echo var_dump($sql2);exit;
		   $i++;
		}
		
        //取出一筆付款單單身
			$this->db->select('a.*,c.mq002 as tc001disp,b.*');
			$this->db->from('acptc as a');	
            $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身
			$this->db->join('cmsmq as c', 'a.tc001 = c.mq001  ','left');  //單別
			$this->db->where('a.tc001', $mq401);
            $this->db->where('a.tc009', 'Y');
            $this->db->where('a.tc201 =', $mq409);			
			if ($mq403>='0') {
	        $this->db->where('a.tc002 >=', $mq403);
            $this->db->where('a.tc002 <=', $mq404);}
            if ($mq407>='0') {
	        $this->db->where('a.tc016 >=', $mq407);
            $this->db->where('a.tc016 <=', $mq408);}
			$this->db->order_by('tc201 , tc202 ');
			$query = $this->db->get();
			$result = $query->result();
		//摘要458
		//$vmb018=trim($row->td009).','.trim($row->td016).','.trim($row->td017);
		//$vmb019=trim($row->td009).','.trim($row->td016).','.trim($row->td017);
		$ii=0;
		$vtb003='1010';		//流水號重新排序
		foreach($result as $row) {
			$tb001[]=$row->tc201;
			$tb002[]=$row->tc202;
			$tb003[]=$vtb003;
			$tb004[]=$row->td004;
			$tb005[]=$row->td008;
			$tb006[]=$row->td022;
			$tb007[]=$row->td015;
			if ($row->td004==1) {$tb010[]=trim($row->td009).','.trim($row->td016).','.trim($row->td017);} else
				{$tb010[]=trim($row->td009).','.trim($row->td016).','.trim($row->td017);}
			$tb012[]=$row->td017;
			$tb013[]=$row->td001;
			$tb014[]=$row->td002;
			$tb015[]=$row->td010;
			$tb016[]=$row->td011;
			$tb017[]=$row->td014;
			//傳票身
			$tb001b[]=$row->tc203;
			$tb002b[]=$row->tc204;
			$tb003b[]=$vtb003;
			$tb004b[]=$row->td004;
			$tb005b[]=$row->td008;
			$tb006b[]=$row->td022;
			$tb007b[]=$row->td015;
			if ($row->td004==1) {$tb010b[]=trim($row->td009).','.trim($row->td016).','.trim($row->td017);} else
				{$tb010b[]=trim($row->td009).','.trim($row->td016).','.trim($row->td017);}
			$tb012b[]=$row->td017;
			$tb013b[]=$row->td010;
			$tb014b[]=$row->td011;
			$tb015b[]=$row->td014;
			$tb016b[]='Y';
			
		$ii = $ii + 1 ;$mtb003 = (int) $vtb003+10;
			        $vtb003 =  (string)$mtb003; }
		$i=0;
		while ($i<$ii) {
		        //底稿單身增加				
				 $sql82 = " INSERT IGNORE INTO ajstb (tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb010,tb012,tb013,tb014,tb015,tb016,tb017) 
				 values ('$tb001[$i]','$tb002[$i]','$tb003[$i]','$tb004[$i]','$tb005[$i]','$tb006[$i]','$tb007[$i]','$tb010[$i]',
				 '$tb012[$i]','$tb013[$i]','$tb014[$i]','$tb015[$i]','$tb016[$i]','$tb017[$i]')  "; 
				$query = $this->db->query($sql82);
				//傳票單身增加				
				 $sql83 = " INSERT IGNORE INTO acttb (tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb010,tb012,tb013,tb014,tb015,tb016) 
				 values ('$tb001b[$i]','$tb002b[$i]','$tb003b[$i]','$tb004b[$i]','$tb005b[$i]','$tb006b[$i]','$tb007b[$i]','$tb010b[$i]',
				 '$tb012b[$i]','$tb013b[$i]','$tb014b[$i]','$tb015b[$i]','$tb016b[$i]')  "; 
				$query = $this->db->query($sql83);
				
			//	echo var_dump($sql2);exit;
		   $i++;
		}	
		
}	

//計算 轉入分錄底稿及傳票 收款  
	function batchbf($date='')
        {
			//mq311 收款單Y acpq01a73 單別 mq401 起迄單號 403 404 日期 407 408 底稿409 傳票日410 
			$mq311=$this->input->post('mq311'); 
            $mq401=$this->input->post('acpq01a73'); 
            $mq403=$this->input->post('mq403');	
            $mq404=$this->input->post('mq404');	
			 preg_match_all('/\d/S',$this->input->post('mq407'), $matches);  //處理日期字串
			 $mq407 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('mq408'), $matches);  //底稿批號
			 $mq408 = implode('',$matches[0]);
			 $mq409=$this->input->post('mq409');
			 preg_match_all('/\d/S',$this->input->post('mq410'), $matches);  //傳票日期
			 $mq410 = implode('',$matches[0]);
		//	var_dump('test1');exit;
			//取傳票單別
			$query81 = $this->db->query("SELECT mb002,mb003,mb018,mb019  FROM ajsmb as a 
		  WHERE mb002='$mq401'     ");         
	   foreach ($query81->result() as $row)
            {
               $mb002[]=$row->mb002;
               $mb003[]=$row->mb003;
               $mb018[]=$row->mb018;
               $mb019[]=$row->mb019;			   
            }
			   $mb003=$mb003[0]; //傳票單別
			   $mb018=$mb018[0]; //借摘要
			   $mb019=$mb019[0]; //貸摘要
			 //  $ta005no[]=$this->checkvno($mb003,$mq410);
		    //取出一筆收款單單頭 到1080620
			$this->db->select('a.*,c.mq002 as tc001disp');
			$this->db->from('acrtc as a');
			$this->db->join('cmsmq as c', 'a.tc001 = c.mq001  ','left');  //單別
			$this->db->where('a.tc001', $mq401); 
			$this->db->where('a.tc009 !=', 'Y');
			if ($mq403>='0') {
	        $this->db->where('a.tc002 >=', $mq403);
            $this->db->where('a.tc002 <=', $mq404);}
            if ($mq407>='0') {
	        $this->db->where('a.tc017 >=', $mq407);
            $this->db->where('a.tc017 <=', $mq408);}
			$query = $this->db->get();
			$result = $query->result();
		$ii=0;
		//$ta001[0]=0;
	//	$kk=$this->checksno($mq409);
		//var_dump($kk);exit;
	//	var_dump('test2');exit;
		foreach($result as $row) {
			$ta001[]=$mq409;
			$ta002[]=$this->checksno($mq409);
			$ta003[]=date("H:i");
			$ta004[]=$mb003;
			$ta005[]=$this->checkvno($mb003,$mq410);
			$ta006[]=$mq410;
			$ta007[]=$row->tc013;
			$ta008[]=$row->tc013;
			$ta009[]=$row->tc014;
			$ta010[]=$row->tc007;
			$ta011[]=$this->session->userdata('manager');
			$ta012[]=date("Ymd");
			$ta013[]=date("H:i");
			$ta014[]="Y";
			$ta015[]=$row->tc001disp;
			$ta016[]="1";
			$tc002[]=$row->tc002;
			//傳票頭
			$ta001a[]=$mb003;
			//$ta002a[]=$ta005[];
			$ta003a[]=$mq410;
			$ta006a[]='D';
			$ta007a[]=$row->tc013;
			$ta008a[]=$row->tc014;
			$ta009a[]=$row->tc007;
			$ta010a[]='Y';
			$ta011a[]='N';
			$ta012a[]=0;
			$ta014a[]=date("Ymd");
			$ta015a[]=$this->session->userdata('manager');
			$ta016a[]='N';
		$ii = $ii + 1 ; }
		$i=0;
	//	var_dump($ta002[0]);exit;
		while ($i<$ii) {
		        //底稿單頭增加				
				 $sql82 = " INSERT IGNORE INTO ajsta (ta001,ta002,ta003,ta004,ta005,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta013,ta014,ta015,ta016) 
				 values ('$ta001[$i]','$ta002[$i]','$ta003[$i]','$ta004[$i]','$ta005[$i]','$ta006[$i]','$ta007[$i]','$ta008[$i]','$ta009[$i]',
				         '$ta010[$i]','$ta011[$i]','$ta012[$i]','$ta013[$i]','$ta014[$i]','$ta015[$i]','$ta016[$i]')  "; 
				$query = $this->db->query($sql82);
				//傳票單頭增加 203,204				
				 $sql83 = " INSERT IGNORE INTO actta (ta001,ta002,ta003,ta006,ta007,ta008,ta009,ta010,ta011,ta012,ta014,ta015,ta016) 
				 values ('$ta001a[$i]','$ta005[$i]','$ta003a[$i]','$ta006a[$i]','$ta007a[$i]','$ta008a[$i]','$ta009a[$i]',
				         '$ta010a[$i]','$ta011a[$i]','$ta012a[$i]','$ta014a[$i]','$ta015a[$i]','$ta016a[$i]')  "; 
				$query = $this->db->query($sql83);
				
				$sql2= "update acrtc set tc009='Y',tc016='Y',tc201= '$ta001[$i]',tc202='$ta002[$i]',tc203='$ta001a[$i]',tc204='$ta005[$i]'
					    where  tc001='$mq401' and tc002='$tc002[$i]'  ";
				$this->db->query($sql2); 
				
				
			//	echo var_dump($sql2);exit;
		   $i++;
		}
		
        //取出一筆收款單單身
			$this->db->select('a.*,c.mq002 as tc001disp,b.*');
			$this->db->from('acrtc as a');	
            $this->db->join('acrtd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身
			$this->db->join('cmsmq as c', 'a.tc001 = c.mq001  ','left');  //單別
			$this->db->where('a.tc001', $mq401);
            $this->db->where('a.tc009', 'Y');
			$this->db->where('a.tc016', 'Y');
            $this->db->where('a.tc201 =', $mq409);			
			if ($mq403>='0') {
	        $this->db->where('a.tc002 >=', $mq403);
            $this->db->where('a.tc002 <=', $mq404);}
            if ($mq407>='0') {
	        $this->db->where('a.tc017 >=', $mq407);
            $this->db->where('a.tc017 <=', $mq408);}
			$this->db->order_by('tc201 , tc202, td003 ');
			$query = $this->db->get();
			$result = $query->result();
		//摘要458
		//$vmb018=trim($row->td009).','.trim($row->td016).','.trim($row->td017);
		//$vmb019=trim($row->td009).','.trim($row->td016).','.trim($row->td017);
		$ii=0;
		$vtb003='1010';		//流水號重新排序
		foreach($result as $row) {
			$tb001[]=$row->tc201;
			$tb002[]=$row->tc202;
			$tb003[]=$vtb003;
			$tb004[]=$row->td004;
			$tb005[]=$row->td008;
			$tb006[]=$row->td021;
			$tb007[]=$row->td015;
			if ($row->td004==1) {$tb010[]=trim($row->td009).','.trim($row->td016).','.trim($row->td017);} else
				{$tb010[]=trim($row->td009).','.trim($row->td016).','.trim($row->td017);}
			$tb012[]=$row->td017;
			$tb013[]=$row->td001;
			$tb014[]=$row->td002;
			$tb015[]=$row->td010;
			$tb016[]=$row->td011;
			$tb017[]=$row->td014;
			//傳票身
			$tb001b[]=$row->tc203;
			$tb002b[]=$row->tc204;
			$tb003b[]=$vtb003;
			$tb004b[]=$row->td004;
			$tb005b[]=$row->td008;
			$tb006b[]=$row->td021;
			$tb007b[]=$row->td015;
			if ($row->td004==1) {$tb010b[]=trim($row->td009).','.trim($row->td016).','.trim($row->td017);} else
				{$tb010b[]=trim($row->td009).','.trim($row->td016).','.trim($row->td017);}
			$tb012b[]=$row->td017;
			$tb013b[]=$row->td010;
			$tb014b[]=$row->td011;
			$tb015b[]=$row->td014;
			$tb016b[]='Y';
			
		$ii = $ii + 1 ;$mtb003 = (int) $vtb003+10;
			        $vtb003 =  (string)$mtb003; }
		$i=0;
		while ($i<$ii) {
		        //底稿單身增加				
				 $sql82 = " INSERT IGNORE INTO ajstb (tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb010,tb012,tb013,tb014,tb015,tb016,tb017) 
				 values ('$tb001[$i]','$tb002[$i]','$tb003[$i]','$tb004[$i]','$tb005[$i]','$tb006[$i]','$tb007[$i]','$tb010[$i]',
				 '$tb012[$i]','$tb013[$i]','$tb014[$i]','$tb015[$i]','$tb016[$i]','$tb017[$i]')  "; 
				$query = $this->db->query($sql82);
				//傳票單身增加				
				 $sql83 = " INSERT IGNORE INTO acttb (tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb010,tb012,tb013,tb014,tb015,tb016) 
				 values ('$tb001b[$i]','$tb002b[$i]','$tb003b[$i]','$tb004b[$i]','$tb005b[$i]','$tb006b[$i]','$tb007b[$i]','$tb010b[$i]',
				 '$tb012b[$i]','$tb013b[$i]','$tb014b[$i]','$tb015b[$i]','$tb016b[$i]')  "; 
				$query = $this->db->query($sql83);
				
			//	echo var_dump($sql2);exit;
		   $i++;
		}	
		
}	
//產生底稿批號序號
function checksno($mq409)
        {
		 $this->db->select('MAX(ta002) as max_no')
			->from('ajsta')
			->where('ta001', $mq409);
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return "1001";}
		
		return $result[0]->max_no+1;	
		}
//產生傳票號碼
function checkvno($mb003,$mq410)
        {
		 $this->db->select('MAX(ta002) as max_no')
			->from('actta')
			->where('ta001', $mb003)
			->like('ta003', $mq410, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $mq410."001";}
		
		return $result[0]->max_no+1;
		}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>