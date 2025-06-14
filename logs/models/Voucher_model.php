<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voucher_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
        
    function duplicate_check($name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        return $this->db->get('account_ledgers')->num_rows();            
    }
	public function get_voucher_list($school_id = null,$category= null){        
        $this->db->select('V.*, S.school_name, VT.name as type_name');
        $this->db->from('vouchers AS V');       		
        $this->db->join('schools AS S', 'S.id = V.school_id', 'left');		
		$this->db->join('voucher_types AS VT', 'VT.id = V.type_id', 'left');
		//$this->db->join('account_transactions AS AT', 'AT.voucher_id = V.id', 'left');
		if($category!= null){
            $this->db->where('V.category', $category);
        }		
        if($this->session->userdata('role_id') != SUPER_ADMIN && $this->session->userdata('dadmin') != 1){
            $this->db->where('V.school_id', $this->session->userdata('school_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $school_id!=null){
            $this->db->where('V.school_id', $school_id);
        }
		if($this->session->userdata('dadmin') == 1 && $school_id != null){
            $this->db->where('V.school_id', $school_id);
        }
		else if($this->session->userdata('dadmin') == 1 && $school_id==null){
			$this->db->where_in('S.id', $this->session->userdata('dadmin_school_ids'));
		}
        $result=$this->db->get()->result();
		return $result;
		
        
    }
	public function get_voucher_by_id($id =null){
		if($id !=null){
			$this->db->select('V.*, S.school_name, VT.name as type_name, AY.session_year,
			(SELECT SUM(amount) FROM account_transaction_details where transaction_id in ( select id from account_transactions WHERE V.id = account_transactions.voucher_id and account_transactions.cancelled = 0) ) AS total_amount
			');
			$this->db->from('vouchers AS V');       		
			$this->db->join('schools AS S', 'S.id = V.school_id', 'left');		
			$this->db->join('voucher_types AS VT', 'VT.id = V.type_id', 'left');
			$this->db->join('financial_years AS AY', 'AY.id = V.financial_year_id', 'left');
			$this->db->where('V.id', $id); 
			return $this->db->get()->row();     
		}
	}
	public function get_voucher_by_name($school_id,$name){		
		$this->db->select('V.*');
        $this->db->from('vouchers AS V');    
		$this->db->where('V.school_id', $school_id); 	
		$this->db->where('V.name', $name);		
		return $this->db->get()->row(); 		
	}
	public function insert_default($school_id, $financial_year_id){
		$this->db->select('V.*,');
        $this->db->from('vouchers AS V');
		$this->db->where('V.school_id', 0); 			
		$vouchers=$this->db->get()->result(); 	
		foreach($vouchers as $l){
			$larr=array();
			$larr['school_id']=$school_id;
			$larr['financial_year_id']=$financial_year_id;
			$larr['type_id']=$l->type_id;
			$larr['name']=$l->name;
			$larr['is_readonly']=$l->is_readonly;
			$larr['budget']=$l->budget;
			$larr['budget_cr_dr']=$l->budget_cr_dr;
			$larr['category']=$l->category;						
			$larr['created']= date('Y-m-d H:i:s');
			$larr['modified']= date('Y-m-d H:i:s');
			$this->db->insert('vouchers',$larr);
			$voucher_id=$this->db->insert_id();
						
		}
	}
	
}
