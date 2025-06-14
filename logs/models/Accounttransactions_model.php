<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounttransactions_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
        
    function duplicate_check($name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        return $this->db->get('account_groups')->num_rows();            
    }
	public function get_transactions_by_voucher_id($voucher_id = null,$financial_year_start=null,$financial_year_end=null){        
        $this->db->select('AT.*,AL.name as ledger_name
		,(SELECT SUM(amount) FROM account_transaction_details where transaction_id in ( select id from account_transactions WHERE AT.voucher_id = account_transactions.voucher_id and account_transactions.cancelled = 0) ) AS total_amount

		');
        $this->db->from('account_transactions AS AT');
		$this->db->join('account_ledgers AS AL', 'AL.id = AT.ledger_id', 'left');				
		if($financial_year_start != null && $financial_year_end != null){
			 $this->db->where('AT.date >= ', $financial_year_start);
			 $this->db->where('AT.date <= ', $financial_year_end);
		}
        $this->db->where('AT.voucher_id', $voucher_id);
		$this->db->order_by('date','desc');
        
        return $this->db->get()->result();
        
    }
	public function get_transactions_by_date($school_id,$date = null,$category=null,$start = null, $limit = null){        
        $this->db->select('AT.*,AL.name as ledger_name,V.name as voucher_name,V.category as voucher_category');
        $this->db->from('account_transactions AS AT');
		$this->db->join('account_ledgers AS AL', 'AL.id = AT.ledger_id', 'left');				
		$this->db->join('vouchers AS V', 'V.id = AT.voucher_id', 'left');
		if($category !=null){
			$this->db->where('V.category', $category);
		}
        $this->db->where('DATE(AT.date)', date('Y-m-d',strtotime($date)));
		$this->db->where('AT.cancelled', 0);
		$this->db->where('V.school_id', $school_id);
		
        if ($limit != null && $start != null) {
			$this->db->limit($limit, $start);
    	}
        return $this->db->get()->result();
        
    }
	public function get_transactions_by_date_count($school_id,$date = null,$category=null){        
        $this->db->select('AT.*,AL.name as ledger_name,V.name as voucher_name,V.category as voucher_category');
        $this->db->from('account_transactions AS AT');
		$this->db->join('account_ledgers AS AL', 'AL.id = AT.ledger_id', 'left');				
		$this->db->join('vouchers AS V', 'V.id = AT.voucher_id', 'left');
		if($category !=null){
			$this->db->where('V.category', $category);
		}
        $this->db->where('DATE(AT.date)', date('Y-m-d',strtotime($date)));
		$this->db->where('AT.cancelled', 0);
		$this->db->where('V.school_id', $school_id);
		$this->db->order_by('AT.date');
       
		return $this->db->get()->num_rows();
        
    }
	public function get_transactions_by_range($school_id,$category=null,$start_date = null,$end_date = null,$start = null, $limit = null){ 
		$start_date = date('Y-m-d',strtotime($start_date));  
		$end_date = date('Y-m-d',strtotime($end_date));       
        $this->db->select('AT.*,AL.name as ledger_name,V.name as voucher_name,V.category as voucher_category');
        $this->db->from('account_transactions AS AT');
		$this->db->join('account_ledgers AS AL', 'AL.id = AT.ledger_id', 'left');				
		$this->db->join('vouchers AS V', 'V.id = AT.voucher_id', 'left');
		if($category !=null){
			$this->db->where('V.category', $category);
		}
        $this->db->where("DATE(AT.date) >= '$start_date' and DATE(AT.date) <= '$end_date' ");
		$this->db->where('AT.cancelled', 0);
		$this->db->where('V.school_id', $school_id);
		if ($limit != null && $start != null) {
			$this->db->limit($limit, $start);
    	}
		$this->db->order_by('AT.date');
        
        return $this->db->get()->result();
        
    }
	public function get_transactions_by_range_count($school_id,$category=null,$start_date = null,$end_date = null){ 
		$start_date = date('Y-m-d',strtotime($start_date));  
		$end_date = date('Y-m-d',strtotime($end_date));       
        $this->db->select('AT.*,AL.name as ledger_name,V.name as voucher_name,V.category as voucher_category');
        $this->db->from('account_transactions AS AT');
		$this->db->join('account_ledgers AS AL', 'AL.id = AT.ledger_id', 'left');				
		$this->db->join('vouchers AS V', 'V.id = AT.voucher_id', 'left');
		if($category !=null){
			$this->db->where('V.category', $category);
		}
        $this->db->where("DATE(AT.date) >= '$start_date' and DATE(AT.date) <= '$end_date' ");
		$this->db->where('AT.cancelled', 0);
		$this->db->where('V.school_id', $school_id);
        
        return $this->db->get()->num_rows();
        
    }
	public function get_transactions_by_id($id = null){        
        $this->db->select("AT.*,AL.name as ledger_name,AL.school_id,V.name as voucher_name, V.budget as budget, V.budget_cr_dr  as budget_cr_dr,
		(SELECT SUM(amount) FROM account_transaction_details where transaction_id in ( select id from account_transactions WHERE AT.voucher_id = account_transactions.voucher_id and account_transactions.cancelled = 0) ) AS total_amount,
		(SELECT MAX(id) FROM account_transactions WHERE id <  $id  limit 1) AS prev_id,
        (SELECT MIN(id) FROM account_transactions WHERE id >  $id  limit 1) AS next_id");
        $this->db->from('account_transactions AS AT');
		$this->db->join('vouchers AS V','V.id = AT.voucher_id', 'left');
		$this->db->join('account_ledgers AS AL', 'AL.id = AT.ledger_id', 'left');				
        $this->db->where('AT.id', $id);
	    $result =  $this->db->get();   
		 return $result->row();
    }
	public function get_transaction_detail($transaction_id){
		 $this->db->select('ATD.*,AL.name as ledger_name, AL.dr_cr as ledger_dr_cr');
        $this->db->from('account_transaction_details AS ATD');
		$this->db->join('account_ledgers AS AL', 'AL.id = ATD.ledger_id', 'left');				
        $this->db->where('ATD.transaction_id', $transaction_id);
		return $this->db->get()->result();
	}
	public function get_total_amount_by_transaction_id($transaction_id){
		$this->db->select('sum(ATD.amount) as total_amount');
		$this->db->from('account_transaction_details as ATD');
		$this->db->where('ATD.transaction_id', $transaction_id);
		//$this->db->where('ATD.transaction_id', $transaction_id);
		$res=$this->db->get()->row(); 
		if(isset($res->total_amount)){
			return $res->total_amount;
		}
		else {
			return 0;
		}
	}	
	public function get_last_transaction_entry($transaction_id_arr=array()){
		 $this->db->select('ATD.*');
		 $this->db->from('account_transaction_details AS ATD');
		 $this->db->where_in('ATD.transaction_id', $transaction_id_arr);
		 $this->db->limit(1);
		 $this->db->order_by('created','desc');
		 return $this->db->get()->row()	;
	}
	public function get_last_transaction_entry_by_voucher($voucher_id=null){
		 $this->db->select('AT.*');
		 $this->db->from('account_transactions AS AT');
		 $this->db->where('AT.voucher_id', $voucher_id);
		 $this->db->where('AT.cancelled', 0);
		 $this->db->limit(1);
		 $this->db->order_by('date','desc');
		 return $this->db->get()->row()	;
	}
	public function generate_transaction_no($voucher_id){
		$this->db->select('V.*');
		 $this->db->from('vouchers AS V');
		 $this->db->where('V.id', $voucher_id);		 
		 $voucher= $this->db->get()->row();
		 $school_id=$voucher->school_id;
		 // get voucher ids of school
		 $this->db->select('V.*');
		 $this->db->from('vouchers AS V');
		 $this->db->where('V.school_id', $school_id);		 
		 $voucher_list= $this->db->get()->result();
		 $ids=array();
		 foreach($voucher_list as $vl){
			 $ids[]=$vl->id;
		 }
		// get last transaction record
		$this->db->select('AT.*');
		 $this->db->from('account_transactions AS AT');
		 if(!empty($ids)){
		 $this->db->where_in('AT.voucher_id', $ids);
		 }
		 $this->db->limit(1);
		 $this->db->order_by('id','desc');
		 $transaction= $this->db->get()->row();
		 if(!empty($transaction)){
			//$transaction_no=substr($voucher_id.uniqid(),0,8);
			$arr=explode("-",$transaction->transaction_no);
			$no=sprintf('%06d', $arr[1]+1);
		 }
		 else{
			 $no="000001";
		 }
		 $transaction_no=$voucher_id."-".$no;
		 return $transaction_no;
	}
	public function get_transactions_by_ledger_id($ledger_id = null,$financial_year_start=null,$financial_year_end=null){   
		$tr_ids=array();
		$this->db->select('AT.*,V.name as voucher_name,V.id as voucher_no');
        $this->db->from('account_transactions AS AT'); 	
		$this->db->join('vouchers AS V', 'AT.voucher_id = V.id', 'left');		
		$this->db->where('AT.ledger_id', $ledger_id); 		
		if($financial_year_start != null && $financial_year_end != null){
			 $this->db->where('AT.date >= ', $financial_year_start);
			 $this->db->where('AT.date <= ', $financial_year_end);
		}
		$this->db->order_by('date','desc');
		$transactions=$this->db->get()->result();
		
		$index=0;
		foreach($transactions as $t){
			$tr_ids[]=$t->id;
			// get transaction detial to get amount
			$total_amount=0;
			$this->db->select('sum(ATD.amount) as total_amount');
			$this->db->from('account_transaction_details AS ATD');    
			$this->db->where('ATD.transaction_id', $t->id); 
			//$this->db->where('ATD.ledger_id', $ledger_id); 
			$res=$this->db->get()->row();			
			if(isset($res->total_amount)){				
				$total_amount=$res->total_amount;
			}
			if($t->head_cr_dr == 'DR'){				
			
				$transactions[$index]->debit_amount=$total_amount;
			
			}
			else {				
				$transactions[$index]->credit_amount=$total_amount;			
			}	
			$index++;						
		}
		$ledger_detail = $this->db->select('AL.*')->from('account_ledgers AS AL')->where('id', $ledger_id)->limit(1)->get()->row();		
		$total_amount=0;
		$this->db->select('ATD.amount,ATD.ledger_id,AT.*,V.name as voucher_name');
		$this->db->from('account_transaction_details AS ATD');    
		$this->db->join('account_transactions AS AT', 'ATD.transaction_id = AT.id', 'left');		
		$this->db->join('vouchers AS V', 'AT.voucher_id = V.id', 'left');		
		if(!empty($tr_ids)){
			$this->db->where_not_in('ATD.transaction_id', $tr_ids); 
		}
		if($financial_year_start != null && $financial_year_end != null){
			 $this->db->where('AT.date >= ', $financial_year_start);
			 $this->db->where('AT.date <= ', $financial_year_end);
		}
		$this->db->where('ATD.ledger_id', $ledger_id); 
		$this->db->order_by('date','desc');
		$res=$this->db->get()->result();		
		foreach($res as $t){			
			$transactions[$index]=$t;
			if($t->head_cr_dr == 'DR'){				
				$transactions[$index]->credit_amount=$t->amount;			
			}
			else {						
					$transactions[$index]->debit_amount=$t->amount;				
			}	
			$index++;						
		}				
		return $transactions;               
        
    }
	public function revert_transaction($id){
		$this->db->set('cancelled', '1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('account_transactions'); 
		return;
	}
	
}
