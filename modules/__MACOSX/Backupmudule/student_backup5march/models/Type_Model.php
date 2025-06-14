<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Type_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_type($schol_id = null){                
        $this->db->select('T.*, S.school_name');
        $this->db->from('student_types AS T');
        $this->db->join('schools AS S', 'S.id = T.school_id', 'left');
         
        if($this->session->userdata('role_id') != SUPER_ADMIN && $this->session->userdata('dadmin') != 1){
			
            $this->db->where('T.school_id', $this->session->userdata('school_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $schol_id){
            $this->db->where('T.school_id', $schol_id);
        }
		if($this->session->userdata('dadmin') == 1 && $school_id){
			
            $this->db->where('T.school_id', $school_id);
        }
		else if($this->session->userdata('dadmin') == 1 && $school_id==null){
			$this->db->where_in('S.id', $this->session->userdata('dadmin_school_ids'));
		}
               
        $this->db->order_by('T.id', 'ASC');
        
        return $this->db->get()->result();
    }
    
    
    function duplicate_check($school_id, $type, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('type', $type);
        $this->db->where('school_id', $school_id);
        return $this->db->get('student_types')->num_rows();            
    }
}
