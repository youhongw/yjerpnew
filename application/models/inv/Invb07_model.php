<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invb07_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  invi14 invte1 盤點儲位輸入檔
	
//計算 產生盤點表 invtc  
    //查新增資料是否輸入訂單訂號 
    function selone1($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tc001', $seg1);
		   $this->db->where('tc003', $seg2);
		    $this->db->where('tc004', $seg3);
	      $query = $this->db->get('invtc');
	      return $query->num_rows() ;
	    }  				
	function batchaf()           
        {
			$vtd001=$this->input->post('td001c');
			$vtd002=substr($this->input->post('td002c'),0,4).substr($this->input->post('td002c'),5,2).substr(rtrim($this->input->post('td002c')),8,2);
		    $vtd003=$this->input->post('cmsq03a');    //庫別
			$vtd004=$this->input->post('invq02a');
			$vtd005=$this->input->post('invq02a1');
		  //盤點表 底稿編號, 盤點日期, 盤點庫別   invtc
         /*   $this->db->where('tc001', $vtd001);   //盤點底稿編號
			$this->db->where('tc009', $vtd002);     //日期
			$this->db->where('tc004', $vtd003);     //庫別
			$this->db->where('tc003 >=', $vtd004);  //起品號
			$this->db->where('tc003 <=', $vtd005);　//迄品號
		    $this->db->delete('invtc');  */		  
		  
          //
		    //刪除 庫存檔 invmc
				/*	 $this->db->where('mc002', $vtd003);     //庫別
			         $this->db->where('mc001 >=', $vtd004);  //起品號
			         $this->db->where('mc001 <=', $vtd005);　//迄品號
		             $this->db->delete('invmc');  */
		/* 1070811	$sqlk = " delete from invmc  where  mc002='$vtd003' and mc001>='$vtd004' and mc001<='$vtd005'  ";
            $this->db->query($sqlk); 
					 
			$sql = " INSERT INTO  invmc (company,creator,usr_group,create_date,modifier,modi_date,flag,mc001,mc002,mc003,mc007)
			            SELECT a.company,a.creator,a.usr_group,a.create_date,a.modifier,a.modi_date,a.flag,a.mb001,b.mc002,a.mb004,0  from invmb as a,cmsmc as b where b.mc001='$vtd003' and b.mc001>='$vtd004' and b.mc001<='$vtd005'  ";
            $this->db->query($sql); 
		  //庫存歸零 invmc  原庫存量金額日期
		    $sqla = " update invmc set mc011='$vtd002', mc200=mc007, mc201=mc008 where mc002='$vtd003' and mc001>='$vtd004' and mc001<='$vtd005'  "; 
		    $query = $this->db->query($sqla);	
		  //庫存歸零 invmc
		   $sqlb = " update invmc set mc007=0, mc008=0 where mc002='$vtd003' and mc001>='$vtd004' and mc001<='$vtd005'  "; 
		    $query = $this->db->query($sqlb);	
		    //共用參數盤點日期轉入		1050615	
			$sql0 = " UPDATE  cmsma set ma204=$vtd002  WHERE 1=1 ";
            $this->db->query($sql0); */

			
		  
         /*   $sql1=" select mb001,mb004,mc002 from invmb a,invmc b
            where mb001=mc001 and mc002='$vtd003' and mc001>='$vtd004' and mc001<='$vtd005' "; */
			
	/*1080814		   $sql1=" select mb001,mb004 from invmb a
            where  mb001>='$vtd004' and mb001<='$vtd005' "; 
            
			$vnum='10001';
             $result = mysql_query($sql1) or die_content("查詢資料失敗".mysql_error());
          while($row=mysql_fetch_assoc($result)){
            foreach($row as $i=>$v){
            $$i=$v;
            }
			
            $data1 = array(
				 'tc001' => $vtd001,
				 'tc002' => $vnum,
				 'tc003' => $mb001,
				 'tc004' => $vtd003,
				 'tc009' => $vtd002
                );	
			
			   $exist = $this->invb07_model->selone1($vtd001,$mb001,$vtd003);
	      if ($exist)
	         {
		      return 'exist';
		     } 
            			
			 $this->db->insert('invtc', $data1);
			 $mnum = (int) $vnum+1;
			 $vnum =  (string)$mnum;
		 }	 
		  
		  //儲位轉入
		  $sql2 = " UPDATE  invtc AS A,  
         (select te1004,tc005,tc001,tc003,tc004,tc009 from invtc as a, invte1 as b where tc001=te1001 and tc003=te1005 and tc004=te1003  ) AS B  
    SET A.`tc005`=B.`te1004` 
    WHERE A.`tc001`=B.`tc001` and  A.`tc003`=B.`tc003` and A.`tc004`=B.`tc004`   and A.`tc009`=B.`tc009` "; 	
		$query = $this->db->query($sql2);
			
	         return true;   */
        }	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>