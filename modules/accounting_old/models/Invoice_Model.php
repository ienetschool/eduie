<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function get_fee_type($school_id){     
          
        $sql = "SELECT IH.*
                FROM income_heads AS IH
                WHERE (IH.head_type = 'fee' OR IH.head_type = 'hostel'  OR IH.head_type = 'transport' ) 
                AND IH.school_id = $school_id";
        
        return $this->db->query($sql)->result();  
      
    }
    
     public function get_hostel_fee($student_id){
        
        $this->db->select('R.cost');
        $this->db->from('students AS S'); 
        $this->db->join('hostel_members AS HM', 'HM.user_id = S.user_id', 'left');
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('S.id', $student_id); 
        $this->db->where('S.is_hostel_member', 1);
        return $this->db->get()->row(); 
    }
    
    public function get_transport_fee($student_id){
        
        $this->db->select('RS.stop_fare');
        $this->db->from('students AS S'); 
        $this->db->join('transport_members AS TM', 'TM.user_id = S.user_id', 'left');
        $this->db->join('route_stops AS RS', 'RS.id = TM.route_stop_id', 'left');
        $this->db->where('S.id', $student_id); 
        $this->db->where('S.is_transport_member', 1);
        return $this->db->get()->row(); 
    }

    public function get_student_discount($student_id){
        
        $this->db->select('D.*');
        $this->db->from('students AS S'); 
        $this->db->join('discounts AS D', 'D.id = S.discount_id', 'left');
        $this->db->where('S.id', $student_id);         
        return $this->db->get()->row();
    }
    
    public function get_invoice_list($school_id = null, $due = null, $academic_year_id = null){
        
        $this->db->select('I.*, SC.school_name, IH.title AS head, S.name AS student_name, AY.session_year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = I.school_id', 'left');
        
        $this->db->where('I.invoice_type !=', 'income');  
        
        if($due){
            $this->db->where('I.paid_status !=', 'paid');  
            
        }  
        
        if($this->session->userdata('role_id') == GUARDIAN){
            $this->db->where('S.guardian_id', $this->session->userdata('profile_id'));  
           
        }   
        
        if($this->session->userdata('role_id') == STUDENT){
            $this->db->where('I.student_id', $this->session->userdata('profile_id'));
       }  
        
        if($this->session->userdata('role_id') != SUPER_ADMIN && $this->session->userdata('dadmin') != 1){
            $this->db->where('I.school_id', $this->session->userdata('school_id'));
       } 
        
        if($academic_year_id){
            $this->db->where('I.academic_year_id', $academic_year_id); 
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $school_id){
            $this->db->where('I.school_id', $school_id);
        }
		if($this->session->userdata('dadmin') == 1 && $school_id){
            $this->db->where('I.school_id', $school_id);
        }
		else if($this->session->userdata('dadmin') == 1 && $school_id==null){
			$this->db->where_in('SC.id', $this->session->userdata('dadmin_school_ids'));
		}
       
       // $this->db->group_by('I.student_id');    
       $this->db->order_by('I.id', 'DESC');  
        return $this->db->get()->result(); 
        // print_r($this->db->last_query());exit       
    }
    
    public function get_single_invoice($id){
        
        $this->db->select('I.*,  IH.title AS head, I.discount AS inv_discount, I.id AS inv_id , S.*, AY.session_year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->where('I.invoice_type !=', 'income');  
        $this->db->where('I.id', $id);       
       
        return $this->db->get()->row();        
    }
    
    public function get_student_list( $school_id, $academic_year_id, $class_id, $student_id = null){
        
        $this->db->select('E.roll_no,  S.id, S.user_id, S.name, S.is_hostel_member, S.is_transport_member');
        $this->db->from('enrollments AS E');        
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        $this->db->where('E.academic_year_id', $academic_year_id);       
        $this->db->where('E.class_id', $class_id);  
        $this->db->where('E.school_id', $school_id);  
        
        if($student_id > 0){
            $this->db->where('E.student_id', $student_id); 
        }
        
        
        return $this->db->get()->result();   
        //echo $this->db->last_query();
    }
    
    public function get_student_hostel_cost($user_id){
         $this->db->select('R.cost');
        $this->db->from('hostel_members AS HM');        
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('HM.user_id', $user_id);                  
        return $this->db->get()->row();
    }
    
    public function get_student_transport_fare($user_id){
        
        
        $this->db->select('R.fare');
        $this->db->from('transport_members AS TM');        
        $this->db->join('routes AS R', 'R.id = TM.route_id', 'left');
        $this->db->where('TM.user_id', $user_id);                  
        return $this->db->get()->row();
    }
    
   /* public function get_invoice_log_list($invoice_id){                
        $this->db->select('IL.*, IH.title');
        $this->db->from('invoice_logs AS IL');        
        $this->db->join('income_heads AS IH', 'IH.id = IL.income_head_id', 'left');
        $this->db->where('IL.invoice_id', $invoice_id);
        return $this->db->get()->result();
    }*/    


      public  function harry($school,$class){
   
        $this->db->select('I.*, SC.school_name, IH.title AS head, S.name AS student_name, AY.session_year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = I.school_id', 'left');
        
        $this->db->where('I.invoice_type !=', 'income');  

        $this->db->where('I.school_id', $school);
        $this->db->where('I.class_id', $class);
        
       //  if($due){
       //      $this->db->where('I.paid_status !=', 'paid');  
       //     ;
       //  }  
        
       //  if($this->session->userdata('role_id') == GUARDIAN){
       //      $this->db->where('S.guardian_id', $this->session->userdata('profile_id'));  
       //      echo "hello1";
       //  }   
        
       //  if($this->session->userdata('role_id') == STUDENT){
       //      $this->db->where('I.student_id', $this->session->userdata('profile_id'));
       // }  
        
       //  if($this->session->userdata('role_id') != SUPER_ADMIN && $this->session->userdata('dadmin') != 1){
       //      $this->db->where('I.school_id', $this->session->userdata('school_id'));
       //  } 
        
       //  if($academic_year_id){
       //      $this->db->where('I.academic_year_id', $academic_year_id); 
       //  }
        
       //  if($this->session->userdata('role_id') == SUPER_ADMIN && $school_id){
       //      $this->db->where('I.school_id', $school);
       //      $this->db->where('I.class_id', $class);
       //  }
            
       $this->db->order_by('I.id', 'DESC'); 

       return $this->db->get()->result(); 
        }

      function get_discount_model($id){
        $this->db->select();
        $this->db->from('discounts');
        $this->db->where('school_id',$id);
        $query =  $this->db->get();
        return $query->result_array();
       

      }  

      public function get_student_discount1($student_id){
        
        $this->db->select('amount');
        $this->db->from('discounts'); 
        // $this->db->join('discounts AS D', 'D.id = S.discount_id', 'left');
        $this->db->where('id', $student_id);         
        return $this->db->get()->row();
    }

      
    
}
