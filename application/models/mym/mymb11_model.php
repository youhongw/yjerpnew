<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mymb11_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
		  $this->load->database();
       }	

    /**
    * 增加
    * @param 姓名
    * @param 性别
    * @param 电话
    * @return bool
    */ 
	 //查複製資料是否重coptg1
    function selone2($seg1,$seg2)    
        { 	
	      $this->db->where('tg001', $seg1);     
	      $this->db->where('tg002', $seg2);
	      $query52 = $this->db->get('coptg3');
	      return $query52->num_rows() ; 
	    }
	//查複製資料是否重複copth1	 
    function selone1($seg1,$seg2,$seg3)    
        { 	
	      $this->db->where('th001', $seg1);     
	      $this->db->where('th002', $seg2);
		  $this->db->where('th003', $seg3);
	      $query53 = $this->db->get('copth3');
	      return $query53->num_rows() ; 
	    }
	//新增一筆	
	function insertf()      
       {  
	      // insert to palte 
		   $sql51="select * from `mymta1` ";
	//$result = mysql_query($sql51) or die_content("查詢資料失敗".mysql_error());
	//$result = mysqli_query($sql51);
   // while($row=mysql_fetch_assoc($result)){
	   $query = $this->db->query($sql51) ;
		foreach ($query->result() as $row) {
        foreach($row as $i=>$v){
            $$i=$v;
        }
		  
				//pos coptg1  
		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'tg001' => $ta001,  //    6
		         'tg002' => $ta002,  //     8
		         'tg003' => $ta003,   //  4
			     'tg042' => $ta003,   //  4
				 'tg004' => '0000',   //  6
		         'tg011' => 'NTD',   //  6
				 'tg012' => 1,   //  6
				 'tg023' => 'Y',
				 'tg024' => 'Y',
				 'tg034' => 'Y',
				 'tg013' => $ta012,
				 'tg045' => $ta012
                );	
			$exist = $this->mymb11_model->selone2($ta001,$ta002);
		  if ($exist)
		    {
			 $this->db->where('tg001', $ta001);
			 $this->db->where('tg002', $ta002);
			 $this->db->update('coptg3', $data1);
		    }  else {       
              $this->db->insert('coptg3', $data1);      //新增一筆  
	         }
				//pos copth1  
		$data2 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
                 'th001' => $ta001,  //    6
		         'th002' => $ta002,  //     8
		         'th003' => $ta018,   //  4
				 'th004' => $ta020,   //  6
		         'th005' => $ta021,   //  6
				 'th008' => $ta024,   //  6
				 'th012' => $ta028,
				 'th013' => round($ta024*$ta028,0),
				 'th035' => round($ta024*$ta028,0),
				 'th037' => round($ta024*$ta028,0)
                );	
			$exist1 = $this->mymb11_model->selone1($ta001,$ta002,$ta018);
		  if ($exist1)
		    {
			 $this->db->where('th001', $ta001);
			 $this->db->where('th002', $ta001);
			 $this->db->where('th002', $ta001);
			 $this->db->update('copth3', $data2);
		    }  else {       
              $this->db->insert('copth3', $data2);      //新增一筆  
	         } 
			 
           }	//mymta1
       }
	   //刪除一筆	
	function deletef()      
       {  
	   // $seg1=$this->uri->segment(4);
	//	$seg2=$this->uri->segment(5);
	    $this->db->where('ta002 >=', '');
        $this->db->delete('mymta1'); 
	  /*  if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;	*/				
       }
    function add_Excel($value)
      {  
	    //  $msg3=$value['ta018'];
		//  $msg3='ta018';
		//  return $msg3;
		    $vta001=$this->input->post('ta002o');
        $data = array(
             //   'ta001' => excelTime($value['ta001']),
             //   'ta001'  => $vta001,  
			    'ta001'  => $value['ta001'],
				'ta002'  => $value['ta002'], 
                'ta003'  => $value['ta003'],
		        'ta004'  => $value['ta004'],
		        'ta005'  => $value['ta005'],
		        'ta006'  => $value['ta006'],
		        'ta007'  => $value['ta007'],
		        'ta008'  => $value['ta008'],
		        'ta009'  => $value['ta009'],
		        'ta010'  => $value['ta010'],
		        'ta011'  => $value['ta011'],
		        'ta012'  => $value['ta012'],
		        'ta013'  => $value['ta013'],
	        	'ta014'  => $value['ta014'],
	        	'ta015'  => $value['ta015'],
		        'ta016'  => $value['ta016'],
	        	'ta017'  => $value['ta017'],
		        'ta018'  => $value['ta018'],
	        	'ta019'  => $value['ta019'],
	        	'ta020'  => $value['ta020'],
		        'ta021'  => $value['ta021'],
		        'ta022'  => $value['ta022'],
	        	'ta023'  => $value['ta023'],
	        	'ta024'  => $value['ta024'],
	        	'ta025'  => $value['ta025'],
	        	'ta026'  => $value['ta026'],
		        'ta027'  => $value['ta027'],
		        'ta028'  => $value['ta028']
		      
		);
        return $this->db->insert('mymta1', $data); 
      }
    
   /**
    * 更新
    * @param 姓名
    * @param 性别
    * @param 电话
    * @param ID
    * @return bool
    */
    function upd_Excel($value='')
      {    
	     $vta001=$this->input->post('ta002o');
        $data = array(
                 'ta001' => $vta001,
                'ta002'  => $value['ta002'],  
                'ta003'  => $value['ta003'],
		        'ta004'  => $value['ta004'],
		        'ta005'  => $value['ta005'],
		        'ta006'  => $value['ta006'],
		        'ta007'  => $value['ta007'],
		        'ta008'  => $value['ta008'],
		        'ta009'  => $value['ta009'],
		        'ta010'  => $value['ta010'],
		        'ta011'  => $value['ta011'],
		        'ta012'  => $value['ta012'],
		        'ta013'  => $value['ta013'],
	        	'ta014'  => $value['ta014'],
	        	'ta015'  => $value['ta015'],
		        'ta016'  => $value['ta016'],
	        	'ta017'  => $value['ta017'],
		        'ta018'  => $value['ta018'],
	        	'ta019'  => $value['ta019'],
	        	'ta020'  => $value['ta020'],
		        'ta021'  => $value['ta021'],
		        'ta022'  => $value['ta022'],
	        	'ta023'  => $value['ta023'],
	        	'ta024'  => $value['ta024'],
	        	'ta025'  => $value['ta025'],
	        	'ta026'  => $value['ta026'],
		        'ta027'  => $value['ta027'],
		        'ta028'  => $value['ta028']
		       
				);
		$this->db->where('ta002', $value['ta002']);
		$this->db->where('ta001', $vta001);
        return $this->db->update('mymta1', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('mymta1');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
?>