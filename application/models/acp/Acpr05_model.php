<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class acpr05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//印明細表	
	function printfd($purq01a,$dateo,$datec,$cmsq06a)          
        {
		
		$ta003 = substr($dateo,0,4).substr($dateo,5,2).substr($dateo,8,2);
		$ta003_1 = substr($datec,0,4).substr($datec,5,2).substr($datec,8,2);
		
		$sql1 = "SELECT * FROM (SELECT '$dateo' AS 'dateo' ,'$datec' AS 'datec',COUNT(*) AS CNT,CASE WHEN SUM(TA028-TA030) IS NULL THEN 0 ELSE SUM(TA028-TA030) END AS TA028 FROM ACPTA WHERE TA004 = '$purq01a' AND TA028 <> TA030  AND TA024 = 'Y' AND TA003 < '$ta003_1') A,
				(SELECT COUNT(*) AS CNT1,SUM(TA028) AS TA0281,SUM(TA030) AS TA030 FROM ACPTA WHERE TA004 = '$purq01a' AND TA024 = 'Y' AND TA003 >= '$ta003' AND TA003 <= '$ta003_1') B";
		  
		$query = $this->db->query($sql1);
		$result['rows'] = $query->result();
		
		
		$sql2 = "SELECT TA004,MA002,TA003,TA001,TA002,TA005,MB002,TA014,TA008,TA028,TA028-TA030 AS TA029,TB001,TB002,TB003,TB005,TB006,TB007,TB008,TB015,TB016,TB017,TB018,TH004,TH005,TH006,TH007,TH008,TH018,TH019,TB011 
			FROM ACPTA,ACPTB,PURTH,PURMA,CMSMB  WHERE MB001 = TA005 AND MA001 = TA004 AND TA001 = TB001 AND TA002 = TB002 AND TA003 >= '$ta003' AND TA003 <= '$ta003_1' AND TA004 = '$purq01a' AND TB005 = TH001 AND TB006 = TH002 AND TB007 = TH003 AND TB004 = '1' AND TA024 = 'Y'

			UNION

			SELECT TA004,MA002,TA003,TA001,TA002,TA005,MB002,TA014,TA008,TA028,TA028-TA030 AS TA029,TB001,TB002,TB003,TB005,TB006,TB007,TB008,TB015,TB016,TB017,TB018,TJ004,TJ005,TJ006,TJ009,TJ007,TJ008 ,TJ010*-1,TB011 
			FROM ACPTA,ACPTB,PURTJ,PURMA,CMSMB  WHERE MB001 = TA005 AND MA001 = TA004 AND TA001 = TB001 AND TA002 = TB002 AND TA003 >= '$ta003' AND TA003 <= '$ta003_1' AND TA004 = '$purq01a' AND TB005 = TJ001 AND TB006 = TJ002 AND TB007 = TJ003 AND TB004 = '2' AND TA024 = 'Y'
			
			UNION

			SELECT TA004,MA002,TA003,TA001,TA002,TA005,MB002,TA014,TA008,TA028,TA028-TA030 AS TA029,TB001,TB002,TB003,TB005,TB006,TB007,TB008,TB015,TB016,TB017,TB018,TI004,TI005,TI006,TI007,TI008,TI024 ,TI025,TB011 
			FROM ACPTA,ACPTB,MOCTI,PURMA,CMSMB WHERE MB001 = TA005 AND MA001 = TA004 AND TA001 = TB001 AND TA002 = TB002 AND TA003 >= '$ta003' AND TA003 <= '$ta003_1' AND TA004 = '$purq01a' AND TB005 = TI001 AND TB006 = TI002 AND TB007 = TI003 AND TB004 = '3' AND TA024 = 'Y'

			UNION

			SELECT TA004,MA002,TA003,TA001,TA002,TA005,MB002,TA014,TA008,TA028,TA028-TA030 AS TA029,TB001,TB002,TB003,TB005,TB006,TB007,TB008,TB015,TB016,TB017,TB018,TL004,TL005,TL006,TL007,TL008,TL011 ,TL012*-1,TB011 
			FROM ACPTA,ACPTB,MOCTL,PURMA,CMSMB WHERE MB001 = TA005 AND MA001 = TA004 AND TA001 = TB001 AND TA002 = TB002 AND TA003 >= '$ta003' AND TA003 <= '$ta003_1' AND TA004 = '$purq01a' AND TB005 = TL001 AND TB006 = TL002 AND TB007 = TL003 AND TB004 = '4' AND TA024 = 'Y' 
			
			UNION
			
			SELECT TA004,MA002,TA003,TA001,TA002,TA005,MB002,TA014,TA008,TA028,TA028-TA030 AS TA029,TB001,TB002,TB003,TB005,TB006,TB007,TB008,TB015,TB016,TB017,TB018,TH004,TH005,TH006,TH007,TH008,TH018,TH019,TB011 
			FROM ACPTA,ACPTB,PURTH,PURMA,CMSMB  WHERE MB001 = TA005 AND MA001 = TA004 AND TA001 = TB001 AND TA002 = TB002 AND TA003 >= '$ta003' AND TA003 <= '$ta003_1' AND TA004 = '$purq01a' AND TB005 = TH001 AND TB006 = TH002 AND TB007 = '' AND TB004 = '1' AND TA024 = 'Y'

			UNION

			SELECT TA004,MA002,TA003,TA001,TA002,TA005,MB002,TA014,TA008,TA028,TA028-TA030 AS TA029,TB001,TB002,TB003,TB005,TB006,TB007,TB008,TB015,TB016,TB017,TB018,TJ004,TJ005,TJ006,TJ009,TJ007,TJ008 ,TJ010*-1,TB011 
			FROM ACPTA,ACPTB,PURTJ,PURMA,CMSMB  WHERE MB001 = TA005 AND MA001 = TA004 AND TA001 = TB001 AND TA002 = TB002 AND TA003 >= '$ta003' AND TA003 <= '$ta003_1' AND TA004 = '$purq01a' AND TB005 = TJ001 AND TB006 = TJ002 AND TB007 = '' AND TB004 = '2' AND TA024 = 'Y'
			
			UNION

			SELECT TA004,MA002,TA003,TA001,TA002,TA005,MB002,TA014,TA008,TA028,TA028-TA030 AS TA029,TB001,TB002,TB003,TB005,TB006,TB007,TB008,TB015,TB016,TB017,TB018,TI004,TI005,TI006,TI007,TI008,TI024 ,TI025,TB011 
			FROM ACPTA,ACPTB,MOCTI,PURMA,CMSMB WHERE MB001 = TA005 AND MA001 = TA004 AND TA001 = TB001 AND TA002 = TB002 AND TA003 >= '$ta003' AND TA003 <= '$ta003_1' AND TA004 = '$purq01a' AND TB005 = TI001 AND TB006 = TI002 AND TB007 = '' AND TB004 = '3' AND TA024 = 'Y'

			UNION

			SELECT TA004,MA002,TA003,TA001,TA002,TA005,MB002,TA014,TA008,TA028,TA028-TA030 AS TA029,TB001,TB002,TB003,TB005,TB006,TB007,TB008,TB015,TB016,TB017,TB018,TL004,TL005,TL006,TL007,TL008,TL011 ,TL012*-1,TB011 
			FROM ACPTA,ACPTB,MOCTL,PURMA,CMSMB WHERE MB001 = TA005 AND MA001 = TA004 AND TA001 = TB001 AND TA002 = TB002 AND TA003 >= '$ta003' AND TA003 <= '$ta003_1' AND TA004 = '$purq01a' AND TB005 = TL001 AND TB006 = TL002 AND TB007 = '' AND TB004 = '4' AND TA024 = 'Y' 
			
		
			ORDER BY TA002,TB008
			";
		
		//echo var_dump($sql2);exit;
		
		$query1 = $this->db->query($sql2);

		$result['rows1'] = $query1->result();
		
		//echo var_dump($query1);exit;
	
		return $result;
			
			
			
			/*
	      $seq1=$this->input->post('purq01a');    //廠商
	      $seq2=$this->input->post('purq01a1');
		
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  
		//  $seq5=substr($this->input->post('dateo1'),0,4).substr($this->input->post('dateo1'),5,2).substr(rtrim($this->input->post('dateo1')),8,2);
	   //   $seq6=substr($this->input->post('datec1'),0,4).substr($this->input->post('datec1'),5,2).substr(rtrim($this->input->post('datec1')),8,2);
		  $seq7=$this->input->post('cmsq06a');   //幣別 
	 
		
      /*    $this->db->select('a.ta004,h.ma003 as ta004disp,a.ta003,ta001,ta002,a.ta014,a.ta008,e.mf002 as ta008disp,(a.ta028+a.ta029) as ta028a,(a.ta028+a.ta029-a.ta030) as ta030a,a.ta030,
		                  b.tb005,b.tb006,b.tb007,b.tb008,b.tb015,b.tb016,b.tb017,b.tb018,b.tb011,a.ta009');		
		  
        $this->db->from('acpta as a');	
        $this->db->join('acptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');
		$this->db->join('cmsmf as e', 'a.ta008 = e.mf001 ','left');   //幣別
		$this->db->join('purma as h', 'a.ta004 = h.ma001 ','left');   //廠商代號
	    $this->db->join('purth as l', 'a.ta005 = l.th001  and a.ta006=l.th002 ','left'); //進貨明細	
		$this->db->join('purtg as m', 'a.ta005 = m.tg001  and a.ta006=m.tg002 and m.tg001=l.th001 and m.tg002=l.th002 ','left'); //進貨單頭	
		$this->db->where('a.ta004 >=', $seq1); 
	    $this->db->where('a.ta004 <=', $seq2); 
		$this->db->where('a.ta003 >=', $seq3); 
	    $this->db->where('a.ta003 <=', $seq4); 
        $this->db->where('a.ta008', $seq7);
		$this->db->order_by('ta004 , ta003');
		
		$query = $this->db->get();
	      $ret['rows'] = $query->result();  
          $seq32 = "tc004 >= '$seq1'  AND tc004 <= '$seq2' AND tc003 >= '$seq3'  AND tc003 <= '$seq4'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('coptc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;   */
		  
		  
		/*  
		  
		  //進貨
          $this->db->select('a.ta004,h.ma003 as ta004disp,h.ma015 as tb021,k.me002 as tb021disp,h.ma004,h.ma005,h.ma006,h.ma008,h.ma027,
		                  a.ta015,b.tb004,m.tg003,m.tg002,l.th005,l.th006,l.th016 ,l.th018 ,l.th019 ,m.tg030 as tg044,m.tg010,m.tg014 
		                         ');		
		  
        $this->db->from('acpta as a');	
        $this->db->join('acptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 and b.tb002>"0" ','left');
		$this->db->join('cmsmf as e', 'a.ta008 = e.mf001 ','left');   //幣別
		$this->db->join('purma as h', 'a.ta004 = h.ma001 ','left');   //廠商代號
	//	$this->db->join('cmsml as i', 'a.ta005 = i.ml001 ','left');   //收款業務員
		$this->db->join('cmsme as k', 'h.ma015 = k.me001 ','left');   //部門
	    $this->db->join('purth as l', 'b.tb005 = l.th001  and b.tb006=l.th002 and b.tb007=l.th003 ','left'); //進貨明細	
		$this->db->join('purtg as m', 'b.tb005 = m.tg001  and b.tb006=m.tg002 and m.tg001=l.th001 and m.tg002=l.th002 ','left'); //進貨單頭	
		$this->db->where('a.ta004 >=', $seq1); 
	    $this->db->where('a.ta004 <=', $seq2); 
		$this->db->where('a.ta003 >=', $seq3); 
	    $this->db->where('a.ta003 <=', $seq4); 
        $this->db->where('a.ta008', $seq7);
		 $this->db->where('b.tb004', '1');
		 $this->db->distinct();
		$this->db->order_by('ta004 , ta003, tb004 ');
		
		$query1 = $this->db->get()->result();
		//進退出
		
        $this->db->select('a.ta004,h.ma003 as ta004disp,h.ma015 as tb021,k.me002 as tb021disp,h.ma004,h.ma005,h.ma006,h.ma008,h.ma027,
		                  a.ta015,b.tb004,m.ti003 as tg003,m.ti002 as tg002 ,l.tj005 as th005,l.tj006 as th006,(l.tj009 * -1) as th016,l.tj008 as th018,(l.tj010 * -1) as th019,m.ti027 as tg044,m.ti009 as tg010,m.ti014 as tg014
		                         ');		
		  
        $this->db->from('acpta as a');	
        $this->db->join('acptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 and b.tb002>"0" ','left');
		$this->db->join('cmsmf as e', 'a.ta008 = e.mf001 ','left');   //幣別
		$this->db->join('purma as h', 'a.ta004 = h.ma001 ','left');   //廠商代號
	//	$this->db->join('cmsml as i', 'a.ta005 = i.ml001 ','left');   //收款業務員
		$this->db->join('cmsme as k', 'h.ma015 = k.me001 ','left');   //部門
	    $this->db->join('purtj as l', 'b.tb005 = l.tj001  and b.tb006=l.tj002 and b.tb007=l.tj003 ','left'); //進退明細	
		$this->db->join('purti as m', 'b.tb005 = m.ti001  and b.tb006=m.ti002 and m.ti001=l.tj001 and m.ti002=l.tj002 ','left'); //進退單頭	
		$this->db->where('a.ta004 >=', $seq1); 
	    $this->db->where('a.ta004 <=', $seq2); 
		$this->db->where('a.ta003 >=', $seq3); 
	    $this->db->where('a.ta003 <=', $seq4); 
        $this->db->where('a.ta008', $seq7);
         $this->db->where('b.tb004', '2');   //進退
		 $this->db->distinct();
		$this->db->order_by('ta004 , ta003, tb004 ');
		$query2 = $this->db->get()->result();
		
		$query = array_merge($query1, $query2);
	    sort($query);
	//	$query  = mergesort($query);
		
		
	     $ret['rows'] = $query; 
	  //   $ret['rows'] = $query->result();  
          $seq32 = "tg005 >= '$seq1'  AND tg005 <= '$seq2' AND tg003 >= '$seq3'  AND tg003 <= '$seq4'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('purtg')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
		  */
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tg001disp, d.me002 AS tg004disp, e.mb002 AS tg010disp, f.mv002 AS tg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002  ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('th001', $this->uri->segment(4));
		$this->db->where('th002', $this->uri->segment(5));
	    $query = $this->db->get('copth');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆 A4
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //廠商代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->input->post('tg001o')); 
	    $this->db->where('a.tg002', $this->input->post('tg002o')); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  
	//印單據筆  半張紙letter1/2 A4half
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //廠商代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }	    		
        }
		
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>