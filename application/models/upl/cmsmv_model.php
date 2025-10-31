<?php 

class cmsmv_model extends CI_Model {
	
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
	
    function add_Excel($value)
      {  
	    //  $msg3=$value['mv018'];
		//  $msg3='mv018';
		//  return $msg3;
        $data = array(
             //   'mv001' => excelTime($value['mv001']),
                'company'  => $value['company'],  
				'creator'  => $value['creator'], 
                'usr_group'  => $value['usr_group'],
		        'create_date'  => $value['create_date'],
		        'modifier'  => $value['modifier'],
		        'modi_date'  => $value['modi_date'],
		        'flag'  => $value['flag'],
				 'mv001'  => $value['mv001'],  
				'mv002'  => $value['mv002'], 
                'mv003'  => $value['mv003'],
		        'mv004'  => $value['mv004'],
		        'mv005'  => $value['mv005'],
		        'mv006'  => $value['mv006'],
		        'mv007'  => $value['mv007'],
		        'mv008'  => $value['mv008'],
		        'mv009'  => $value['mv009'],
		        'mv010'  => $value['mv010'],
		        'mv011'  => $value['mv011'],
		        'mv012'  => $value['mv012'],
		        'mv013'  => $value['mv013'],
	        	'mv014'  => $value['mv014'],
	        	'mv015'  => $value['mv015'],
		        'mv016'  => $value['mv016'],
	        	'mv017'  => $value['mv017'],
		        'mv018'  => $value['mv018'],
	        	'mv019'  => $value['mv019'],
	        	'mv020'  => $value['mv020'],
		        'mv021'  => $value['mv021'],
		        'mv022'  => $value['mv022'],
	        	'mv023'  => $value['mv023'],
	        	'mv024'  => $value['mv024'],
	        	'mv025'  => $value['mv025'],
	        	'mv026'  => $value['mv026'],
		        'mv027'  => $value['mv027'],
		        'mv028'  => $value['mv028'],
		        'mv029'  => $value['mv029'],
		        'mv030'  => $value['mv030'],
		        'mv031'  => $value['mv031'],
		        'mv032'  => $value['mv032'],
		        'mv033'  => $value['mv033'],
		        'mv034'  => $value['mv034'],
		        'mv035'  => $value['mv035'],
				'mv036'  => $value['mv036'],
		        'mv037'  => $value['mv037'],
		        'mv038'  => $value['mv038'],
		        'mv039'  => $value['mv039'],
		        'mv040'  => $value['mv040'],
				'mv041'  => $value['mv041'],
		        'mv042'  => $value['mv042'],
		        'mv043'  => $value['mv043'],
				'mv044'  => $value['mv044'],
		        'mv045'  => $value['mv045'],
				'mv046'  => $value['mv046'],
		        'mv047'  => $value['mv047'],
		        'mv048'  => $value['mv048'],
		        'mv049'  => $value['mv049'],
		        'mv050'  => $value['mv050'],
				'mv051'  => $value['mv051'],
		        'mv052'  => $value['mv052'],
		        'mv053'  => $value['mv053'],
		);
        return $this->db->insert('cmsmv', $data); 
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
                 'mv001' => $value['mv001'],
                'mv002'  => $value['mv002'],  
                'mv003'  => $value['mv003'],
		        'mv004'  => $value['mv004'],
		        'mv005'  => $value['mv005'],
		        'mv006'  => $value['mv006'],
		        'mv007'  => $value['mv007'],
		        'mv008'  => $value['mv008'],
		        'mv009'  => $value['mv009'],
		        'mv010'  => $value['mv010'],
		        'mv011'  => $value['mv011'],
		        'mv012'  => $value['mv012'],
		        'mv013'  => $value['mv013'],
	        	'mv014'  => $value['mv014'],
	        	'mv015'  => $value['mv015'],
		        'mv016'  => $value['mv016'],
	        	'mv017'  => $value['mv017'],
		        'mv018'  => $value['mv018'],
	        	'mv019'  => $value['mv019'],
	        	'mv020'  => $value['mv020'],
		        'mv021'  => $value['mv021'],
		        'mv022'  => $value['mv022'],
	        	'mv023'  => $value['mv023'],
	        	'mv024'  => $value['mv024'],
	        	'mv025'  => $value['mv025'],
	        	'mv026'  => $value['mv026'],
		        'mv027'  => $value['mv027'],
		        'mv028'  => $value['mv028'],
		        'mv029'  => $value['mv029'],
		        'mv030'  => $value['mv030'],
		        'mv031'  => $value['mv031'],
		        'mv032'  => $value['mv032'],
		        'mv033'  => $value['mv033'],
		        'mv034'  => $value['mv034'],
		        'mv035'  => $value['mv035'],
				'mv036'  => $value['mv036'],
		        'mv037'  => $value['mv037'],
		        'mv038'  => $value['mv038'],
		        'mv039'  => $value['mv039'],
		        'mv040'  => $value['mv040'],
				'mv041'  => $value['mv041'],
		        'mv042'  => $value['mv042'],
		        'mv043'  => $value['mv043'],
				);
		$this->db->where('mv001', $value['mv001']);
		$this->db->where('mv002', $value['mv002']);
        return $this->db->update('cmsmv', $data); 
      }
    
    /**
     *查询表中的全部数据 
     *@return data
     */
     function selUsers()
      {
		$this->db->select('*');    //查詢數
	    $this->db->from('cmsmv');		
        $query = $this->db->get();
        return $query->result_array();
      } 
}
