<?php

class Test2_model extends CI_Model {


         function __construct()
        {
                parent::__construct();
               
        }
		 public function select()
        {
                $this->load->database();
                $query = $this->db->get('test');
                $result = $query->result();

                /*
                $result = $query -> result();
                foreach ($result as $key => $row)
                {

                        $data['item'][$key]['id'] = $row->id;
                        $data['item'][$key]['name'] = $row->name;
                        $data['item'][$key]['hobby'] = $row->hobby;
                }
                $this->load->view('conn_db',$data);
                */
                return $result;             
        }
     function selone($id)
      {            		
	         echo $id;
			$this->load->database();
			$this->db->set('id', $id);               //查詢一筆 修改用
			$this->db->where('id', $id);
			$query = $this->db->get('test');
			if ($query->num_rows() > 0) {
			$result = $query->result();
		 	return $result;   
			}
      
	  }
        public function insert()
        {
                echo 'insert';
				$data = array( 
		   'id' => ' ',
    'name' => $this->input->post('name'),
    'hobby' => $this->input->post('hobby')    
          );

         $this->db->insert('test', $data);
         if ($this->db->affected_rows() > 0)
         {
            return TRUE;
         }
         return FALSE;
         }
           
	
        public function delete($id)
        {
                echo 'delete:'.$id;
				 $this->db->where('id', $id);
				 $this->db->delete('test');
				 if ($this->db->affected_rows() > 0)
                    {
                    return TRUE;
                     }
                    return FALSE;
        }     

        public function update($id)
        {
                echo 'update:'.$id;
				
				$data = array( 
		   
    'name' => $this->input->post('name'),
    'hobby' => $this->input->post('hobby')
	 );
	             $this->db->where('id', $id);
				 $this->db->update('test',$data);
				 if ($this->db->affected_rows() > 0)
                    {
                    return TRUE;
                     }
                    return FALSE;
        }
    
				
    	public   function addContact()
         {
         // $this->db->get('test');
		   $data = array( 
		   'id' => ' ',
    'name' => $this->input->post('name'),
    'hobby' => $this->input->post('hobby')
    
  );

         $this->db->insert('test', $data);
         if ($this->db->affected_rows() > 0)
         {
            return TRUE;
         }
         return FALSE;
         }
	
     /**
	 * 添加用户
	 * 
	 * @access   public
	 * @param    array    数据数组
	 * @return   number   添加后的数据编号
	 */
	function add($post)
	{
		$exist = $this->m_common->get_one('test', array('name' => $post['name']), 'id');
		if($exist)
		{
			return 'exist';
		}
		return $this->m_common->insert('test', $post);
	}
	
	/**
	 * 管理员数据
	 * 
	 * @access   public
	 * @param    array    条件数据
	 * @return
	 */
	function admin_datas($arg = array())
	{
		$this->db->select('*')->from('test');
		if(isset($arg['id']))
		{
			$this->db->where('test.id', $arg['id']);
		}
		if(isset($arg['id']) )
		{
			$this->db->like('name', $arg['id']);
			
		}
				
	} 
}
?>
