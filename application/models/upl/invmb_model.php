<?php 

class Invmb_model extends CI_Model {
	
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
	//刪除一筆	
	function deletef($seg1,$seg2)      
       {  
	    $seg1=$this->uri->segment(4);
		$seg2=$this->uri->segment(5);
	    $this->db->where('mb002 >=', $seg1);
		$this->db->where('mb002 <=', $seg2);
        $this->db->delete('mymta'); 
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
    function add_Excel($value)
      {  
	    //  $msg3=$value['mb018'];
		//  $msg3='mb018';
		//  return $msg3;
        $data = array(
             //   'mb001' => excelTime($value['mb001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'mb001'  => $value['mb001'],  
				'mb002'  => $value['mb002'], 
                'mb003'  => $value['mb003'],
		        'mb004'  => $value['mb004'],
		        'mb005'  => $value['mb005'],
		        'mb006'  => $value['mb006'],
		        'mb007'  => $value['mb007'],
		        'mb008'  => $value['mb008'],
		        'mb009'  => $value['mb009'],
		        'mb010'  => $value['mb010'],
		        'mb011'  => $value['mb011'],
		        'mb012'  => $value['mb012'],
		        'mb013'  => $value['mb013'],
	        	'mb014'  => $value['mb014'],
	        	'mb015'  => $value['mb015'],
		        'mb016'  => $value['mb016'],
	        	'mb017'  => $value['mb017'],
		        'mb018'  => $value['mb018'],
	        	'mb019'  => $value['mb019'],
	        	'mb020'  => $value['mb020'],
		        'mb021'  => $value['mb021'],
		        'mb022'  => $value['mb022'],
	        	'mb023'  => $value['mb023'],
	        	'mb024'  => $value['mb024'],
	        	'mb025'  => $value['mb025'],
	        	'mb026'  => $value['mb026'],
		        'mb027'  => $value['mb027'],
		        'mb028'  => $value['mb028'],
		        'mb029'  => $value['mb029'],
		        'mb030'  => $value['mb030'],
		        'mb031'  => $value['mb031'],
		        'mb032'  => $value['mb032'],
		        'mb033'  => $value['mb033'],
		        'mb034'  => $value['mb034'],
		        'mb035'  => $value['mb035'],
				'mb036'  => $value['mb036'],
		        'mb037'  => $value['mb037'],
		        'mb038'  => $value['mb038'],
		        'mb039'  => $value['mb039'],
		        'mb040'  => $value['mb040'],
				'mb041'  => $value['mb041'],
		        'mb042'  => $value['mb042'],
		        'mb043'  => $value['mb043'],
		        'mb044'  => $value['mb044'],
		        'mb045'  => $value['mb045'],
				'mb046'  => $value['mb046'],
		        'mb047'  => $value['mb047'],
		        'mb048'  => $value['mb048'],
		        'mb049'  => $value['mb049'],
		        'mb050'  => $value['mb050'],
				'mb051'  => $value['mb051'],
		        'mb052'  => $value['mb052'],
		        'mb053'  => $value['mb053'],
		        'mb054'  => $value['mb054'],
		        'mb055'  => $value['mb055'],
				'mb056'  => $value['mb056'],
		        'mb057'  => $value['mb057'],
		        'mb058'  => $value['mb058'],
		        'mb059'  => $value['mb059'],
		        'mb060'  => $value['mb060'],
				'mb061'  => $value['mb061'],
		        'mb062'  => $value['mb062'],
		        'mb063'  => $value['mb063'],
		        'mb064'  => $value['mb064'],
		        'mb065'  => $value['mb065'],
				'mb066'  => $value['mb066'],
		        'mb067'  => $value['mb067'],
		        'mb068'  => $value['mb068'],
		        'mb069'  => $value['mb069'],
		        'mb070'  => $value['mb070'],
				'mb071'  => $value['mb071'],
		        'mb072'  => $value['mb072'],
		        'mb073'  => $value['mb073'],
		        'mb074'  => $value['mb074'],
		        'mb075'  => $value['mb075'],
				'mb076'  => $value['mb076'],
		        'mb077'  => $value['mb077'],
		        'mb078'  => $value['mb078'],
		        'mb079'  => $value['mb079'],
		        'mb080'  => $value['mb080'],
				'mb081'  => $value['mb081'],
		        'mb082'  => $value['mb082'],
		        'mb083'  => $value['mb083'],
		        'mb084'  => $value['mb084'],
		        'mb085'  => $value['mb085'],
				'mb086'  => $value['mb086'],
		        'mb087'  => $value['mb087'],
		        'mb088'  => $value['mb088'],
		        'mb089'  => $value['mb089'],
		        'mb090'  => $value['mb090'],
				'mb091'  => $value['mb091'],
		        'mb092'  => $value['mb092'],
		        'mb093'  => $value['mb093'],
		        'mb094'  => $value['mb094'],
		        'mb095'  => $value['mb095'],
				'mb096'  => $value['mb096'],
		        
		);
        return $this->db->insert('invmb', $data); 
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
        $data = array(
                 'mb001' => $value['mb001'],
                'mb002'  => $value['mb002'],  
                'mb003'  => $value['mb003'],
		        'mb004'  => $value['mb004'],
		        'mb005'  => $value['mb005'],
		        'mb006'  => $value['mb006'],
		        'mb007'  => $value['mb007'],
		        'mb008'  => $value['mb008'],
		        'mb009'  => $value['mb009'],
		        'mb010'  => $value['mb010'],
		        'mb011'  => $value['mb011'],
		        'mb012'  => $value['mb012'],
		        'mb013'  => $value['mb013'],
	        	'mb014'  => $value['mb014'],
	        	'mb015'  => $value['mb015'],
		        'mb016'  => $value['mb016'],
	        	'mb017'  => $value['mb017'],
		        'mb018'  => $value['mb018'],
	        	'mb019'  => $value['mb019'],
	        	'mb020'  => $value['mb020'],
		        'mb021'  => $value['mb021'],
		        'mb022'  => $value['mb022'],
	        	'mb023'  => $value['mb023'],
	        	'mb024'  => $value['mb024'],
	        	'mb025'  => $value['mb025'],
	        	'mb026'  => $value['mb026'],
		        'mb027'  => $value['mb027'],
		        'mb028'  => $value['mb028'],
		        'mb029'  => $value['mb029'],
		        'mb030'  => $value['mb030'],
		        'mb031'  => $value['mb031'],
		        'mb032'  => $value['mb032'],
		        'mb033'  => $value['mb033'],
		        'mb034'  => $value['mb034'],
		        'mb035'  => $value['mb035'],
				);
		$this->db->where('mb002', $value['mb002']);
		$this->db->where('mb031', $value['mb031']);
        return $this->db->update('mymta', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('invmb');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
