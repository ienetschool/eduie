<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Disciplines_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
        
    function duplicate_check($name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        return $this->db->get('payment_modes')->num_rows();            
    }
	public function get_discipline_list($school_id = null){        
        $this->db->select('D.*, S.school_name');
        $this->db->from('academic_disciplines AS D');       		
        $this->db->join('schools AS S', 'S.id = D.school_id', 'left');		
        if($this->session->userdata('role_id') != SUPER_ADMIN && $this->session->userdata('role_id') != DISTRICT_ADMIN){
            $this->db->where('D.school_id', $this->session->userdata('school_id')); 
            $this->db->or_where('D.school_id','0'); 
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $school_id){
            $this->db->where('D.school_id', $school_id); 
            $this->db->or_where('D.school_id','0'); 
        }
		if($this->session->userdata('role_id') == DISTRICT_ADMIN && $school_id){
            $this->db->where('D.school_id', $school_id); 
            $this->db->or_where('D.school_id','0'); 
        }
		else if($this->session->userdata('role_id') == DISTRICT_ADMIN && $school_id==null){
			$this->db->where('S.district_id', $this->session->userdata('district_id'));
		}
        return $this->db->get()->result();
        
    }

    public function insert($data,$table){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

     function delete($id,$table){   
        $this->db->where('id', $id);
       return $this->db->delete($table);

    }
	
     function edit($id,$table){ 

        $this->db->select('*');

        $this->db->from($table);

        $this->db->where('id', $id);
        
       return $this->db->get()->result();
    }
	public function get_discipline_by_name($school_id,$name){
		$this->db->select('D.*');
        $this->db->from('academic_disciplines AS D');
		$this->db->where('LOWER(name)', strtolower($name));
        $this->db->where('school_id', $school_id);
		$this->db->or_where('school_id',0);
		$query = $this->db->get();
		return $query->row();
	}
}
