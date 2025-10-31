<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi01_model extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -  
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct()
       {
            parent::__construct();      //重載ci底層程式 自動執行父類別S
       }
	
	   	
	  function selbrowse($num,$offset)
      {            
			$this->db->select('*');
            $this->db->from('invma');
          //  $this->db->order_by('id', 'DESC');
			$this->db->order_by('ma001 desc, ma002 desc');    //排序asc
			$this->db->limit($num,$offset);   // 每頁15筆
			return $this->db->get()->result_array();
			
			
			//   $query = $this->db->get('test');
           //     $result = $query->result();
			//	return $result;
	       // return $this->db->get('invma',200,0)->result_array();      //流覽用, 查詢一次限制0-200筆	
			
			//$this->db->order_by('ma001 desc, ma002 desc');    //排序asc
			//$query = $this->db->get('invma',200);  //流覽用, 查詢一次限制200筆	
			
			//return $query;
      }
	 function selone($seg1,$seg2)
      {            		
			$this->db->set('ma001', $seg1);               //查詢一筆 修改用
			$this->db->set('ma002', $seg2);
			$query = $this->db->get('invma');
			$query = $this->db->where('ma001', $seg1);
			$query = $this->db->where('ma002', $seg2);
			$result = $query->result();
			return $result;
		
			
      }
	   function insertf()

        {
			echo 'insert';
			 $data = array( 
		    'company' => $this->input->post('company'),
			'creator' => '89044',
			'usr_group' => 'test',
			'create_date' =>date("Ymd"),
			'modifier' => '89044',
			'modi_date' => date("Ymd"),
			'flag' => 0,
            'ma001' => $this->input->post('ma001'),
			'ma002' => $this->input->post('ma002'),
			'ma003' => $this->input->post('ma003'),
			'ma004' => $this->input->post('ma004'),
			'ma005' => $this->input->post('ma005'),
			'ma006' => $this->input->post('ma006')             
            );

         $this->db->insert('invma', $data);      //新增一筆
     //    if ($this->db->affected_rows() > 0)
     //    {
            return TRUE;
     //    }
        //    return FALSE;
         }
  
     
		 function updatef()

        {
             $data = array(
			   'create_date' => $date,
               'ma001' => $ma001,
               'ma002' => $ma002,
               'ma003' => $ma003,
			   'ma004' => $ma004,
			   'ma005' => $ma005,
			   'ma006' => $ma006
            );
           $this->db->where('ma001', $ma001);
		   $this->db->where('ma002', $ma002);
           $this->db->update('invma',$data);                   //更改一筆

        }
		 function deletef()
      {            		
			$this->db->set('ma001', $ma001);               //刪除一筆 
			$this->db->set('ma002', $ma002);
			$this->db->where('ma001', $ma001);
			$this->db->where('ma002', $ma002);
            $this->db->delete('invma'); 
			
      }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */