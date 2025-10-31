<?php 

class copma_model extends CI_Model {
	
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
	    $this->db->where('ma002 >=', $seg1);
		$this->db->where('ma002 <=', $seg2);
        $this->db->delete('mymta'); 
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
    function add_Excel($value)
      {  
	    //  $msg3=$value['ma018'];
		//  $msg3='ma018';
		//  return $msg3;
        $data = array(
             //   'ma001' => excelTime($value['ma001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'ma001'  => $value['ma001'],  
				'ma002'  => $value['ma002'], 
                'ma003'  => $value['ma003'],
		        'ma004'  => $value['ma004'],
		        'ma005'  => $value['ma005'],
		        'ma006'  => $value['ma006'],
		        'ma007'  => $value['ma007'],
		        'ma008'  => $value['ma008'],
		        'ma009'  => $value['ma009'],
		        'ma010'  => $value['ma010'],
		        'ma011'  => $value['ma011'],
		        'ma012'  => $value['ma012'],
		        'ma013'  => $value['ma013'],
	        	'ma014'  => $value['ma014'],
	        	'ma015'  => $value['ma015'],
		        'ma016'  => $value['ma016'],
	        	'ma017'  => $value['ma017'],
		        'ma018'  => $value['ma018'],
	        	'ma019'  => $value['ma019'],
	        	'ma020'  => $value['ma020'],
		        'ma021'  => $value['ma021'],
		        'ma022'  => $value['ma022'],
	        	'ma023'  => $value['ma023'],
	        	'ma024'  => $value['ma024'],
	        	'ma025'  => $value['ma025'],
	        	'ma026'  => $value['ma026'],
		        'ma027'  => $value['ma027'],
		        'ma028'  => $value['ma028'],
		        'ma029'  => $value['ma029'],
		        'ma030'  => $value['ma030'],
		        'ma031'  => $value['ma031'],
		        'ma032'  => $value['ma032'],
		        'ma033'  => $value['ma033'],
		        'ma034'  => $value['ma034'],
		        'ma035'  => $value['ma035'],
				'ma036'  => $value['ma036'],
		        'ma037'  => $value['ma037'],
		        'ma038'  => $value['ma038'],
		        'ma039'  => $value['ma039'],
		        'ma040'  => $value['ma040'],
				'ma041'  => $value['ma041'],
		        'ma042'  => $value['ma042'],
		        'ma043'  => $value['ma043'],
		        'ma044'  => $value['ma044'],
		        'ma045'  => $value['ma045'],
				'ma046'  => $value['ma046'],
		        'ma047'  => $value['ma047'],
		        'ma048'  => $value['ma048'],
		        'ma049'  => $value['ma049'],
		        'ma050'  => $value['ma050'],
				'ma051'  => $value['ma051'],
		        'ma052'  => $value['ma052'],
		        'ma053'  => $value['ma053'],
		        'ma054'  => $value['ma054'],
		        'ma055'  => $value['ma055'],
				'ma056'  => $value['ma056'],
		        'ma057'  => $value['ma057'],
		        'ma058'  => $value['ma058'],
		        'ma059'  => $value['ma059'],
		        'ma060'  => $value['ma060'],
				'ma061'  => $value['ma061'],
		        'ma062'  => $value['ma062'],
		        'ma063'  => $value['ma063'],
		        'ma064'  => $value['ma064'],
		        'ma065'  => $value['ma065'],
				'ma066'  => $value['ma066'],
		        'ma067'  => $value['ma067'],
		        'ma068'  => $value['ma068'],
		        'ma069'  => $value['ma069'],
		        'ma070'  => $value['ma070'],
				'ma071'  => $value['ma071'],
		        'ma072'  => $value['ma072'],
		        'ma073'  => $value['ma073'],
		        'ma074'  => $value['ma074'],
		        'ma075'  => $value['ma075'],
				'ma076'  => $value['ma076'],
		        'ma077'  => $value['ma077'],
		        'ma078'  => $value['ma078'],
		        'ma079'  => $value['ma079'],
		        'ma080'  => $value['ma080'],
				'ma081'  => $value['ma081'],
		        'ma082'  => $value['ma082'],
		        'ma083'  => $value['ma083'],
		        'ma084'  => $value['ma084'],
		        'ma085'  => $value['ma085'],
				'ma086'  => $value['ma086'],
		        'ma087'  => $value['ma087'],
		        'ma088'  => $value['ma088'],
		        'ma089'  => $value['ma089'],
		        'ma090'  => $value['ma090'],
				'ma091'  => $value['ma091'],
		        'ma092'  => $value['ma092'],
		        'ma093'  => $value['ma093'],
		        'ma094'  => $value['ma094'],
		        'ma200'  => $value['ma200'],
			
		);
        return $this->db->insert('copma', $data); 
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
                 'ma001' => $value['ma001'],
                'ma002'  => $value['ma002'],  
                'ma003'  => $value['ma003'],
		        'ma004'  => $value['ma004'],
		        'ma005'  => $value['ma005'],
		        'ma006'  => $value['ma006'],
		        'ma007'  => $value['ma007'],
		        'ma008'  => $value['ma008'],
		        'ma009'  => $value['ma009'],
		        'ma010'  => $value['ma010'],
		        'ma011'  => $value['ma011'],
		        'ma012'  => $value['ma012'],
		        'ma013'  => $value['ma013'],
	        	'ma014'  => $value['ma014'],
	        	'ma015'  => $value['ma015'],
		        'ma016'  => $value['ma016'],
	        	'ma017'  => $value['ma017'],
		        'ma018'  => $value['ma018'],
	        	'ma019'  => $value['ma019'],
	        	'ma020'  => $value['ma020'],
		        'ma021'  => $value['ma021'],
		        'ma022'  => $value['ma022'],
	        	'ma023'  => $value['ma023'],
	        	'ma024'  => $value['ma024'],
	        	'ma025'  => $value['ma025'],
	        	'ma026'  => $value['ma026'],
		        'ma027'  => $value['ma027'],
		        'ma028'  => $value['ma028'],
		        'ma029'  => $value['ma029'],
		        'ma030'  => $value['ma030'],
		        'ma031'  => $value['ma031'],
		        'ma032'  => $value['ma032'],
		        'ma033'  => $value['ma033'],
		        'ma034'  => $value['ma034'],
		        'ma035'  => $value['ma035'],
				);
		$this->db->where('ma002', $value['ma002']);
		$this->db->where('ma031', $value['ma031']);
        return $this->db->update('mymta', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('copma');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
