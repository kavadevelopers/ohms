<?php
class General_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function get_product($id)
	{
		return $this->db->get_where('products' ,['id' => $id])->result_array()[0];
	}

	public function _client($id)
	{
		return $this->db->get_where('clients' ,['id' => $id])->row_array();	
	}

	public function _expanse_client($id)
	{
		return $this->db->get_where('client_expense' ,['id' => $id])->row_array();	
	}

	public function _salary_client($id)
	{
		return $this->db->get_where('employees' ,['id' => $id])->row_array();	
	}

	public function _loan_client($id)
	{
		return $this->db->get_where('loan' ,['id' => $id])->row_array();	
	}

	public function _product($id)
	{
		return $this->db->get_where('products' ,['id' => $id])->row_array();	
	}

	public function clients()
	{
		return $this->db->get_where('clients',['df' => ''])->result_array();
	}

	public function sale_clients()
	{
		return $this->db->get_where('clients',['df' => '','type' => 'Sales'])->result_array();
	}

	public function purchase_clients()
	{
		return $this->db->get_where('clients',['df' => '','type' => 'Purchase'])->result_array();
	}

	public function expense_clients()
	{
		return $this->db->get_where('client_expense',['df' => ''])->result_array();
	}

	public function get_employees()
	{
		return $this->db->get_where('employees',['df' => ''])->result_array();
	}

	public function get_loans()
	{
		return $this->db->get_where('loans')->result_array();
	}

	public function products()
	{
		return $this->db->get_where('products',['df' => ''])->result_array();
	}

	public function get_product_by_client($id)
	{	
		$this->db->select('product,price');
		$products = $this->db->get_where('pricing',['client' => $id])->result_array();
		return htmlspecialchars(json_encode($products), ENT_QUOTES, 'UTF-8');
	}

	public function employee($id)
	{
		return $this->db->get_where('employees',['id'=> $id])->row_array();	
	}

	public function per_min_salary($id)
	{
		$salary = $this->db->get_where('employees',['id' => $id])->row_array()['salary'];
		$increments = $this->db->get_where('increment',['employee' => $id])->result_array();
		$increment_value = 0;
		foreach ($increments as $key => $increment) {
			$increment_value += $increment['salary'];
		}
		return $salary + $increment_value;
	}

	public function w_opening_balance($client_id,$date)
	{

		$query = $this->db->select_sum('credit')
					->from('transactions_w')
					->where('client', $client_id)
					->group_start()
				    	->where('type',topening())
					->group_end()->get();
		$ocredit = $query->row()->credit;

		$query = $this->db->select_sum('debit')
					->from('transactions_w')
					->where('client', $client_id)
					->group_start()
				    	->where('type',topening())
					->group_end()->get();
		$odebit = $query->row()->debit;

		$query = $this->db->select_sum('credit')
					->from('transactions_w')
					->where('date <', $date)
					->where('client', $client_id)
					->group_start()
				    	->where('type',tsale())
		            	->or_where('type',tsalepay())
		            	->or_where('type',tpurchase())
		            	->or_where('type',tpurchasepay())
					->group_end()->get();
		$credit = $query->row()->credit;

		$query = $this->db->select_sum('debit')
					->from('transactions_w')
					->where('date <', $date)
					->where('client', $client_id)
					->group_start()
				    	->where('type',tsale())
		            	->or_where('type',tsalepay())
		            	->or_where('type',tpurchase())
		            	->or_where('type',tpurchasepay())
					->group_end()->get();
		$debit = $query->row()->debit;

		$credit += $ocredit;
		$debit 	+= $odebit;

		if($credit > $debit){
			return ['c',$credit - $debit];
		}
		else{
			return ['d',$debit - $credit];
		}
	}

	public function b_opening_balance($client_id,$date)
	{

		$query = $this->db->select_sum('credit')
					->from('transactions_b')
					->where('client', $client_id)
					->group_start()
				    	->where('type',topening())
					->group_end()->get();
		$ocredit = $query->row()->credit;

		$query = $this->db->select_sum('debit')
					->from('transactions_b')
					->where('client', $client_id)
					->group_start()
				    	->where('type',topening())
					->group_end()->get();
		$odebit = $query->row()->debit;

		$query = $this->db->select_sum('credit')
					->from('transactions_b')
					->where('date <', $date)
					->where('client', $client_id)
					->group_start()
				    	->where('type',tsale())
		            	->or_where('type',tsalepay())
		            	->or_where('type',tpurchase())
		            	->or_where('type',tpurchasepay())
					->group_end()->get();
		$credit = $query->row()->credit;

		$query = $this->db->select_sum('debit')
					->from('transactions_b')
					->where('date <', $date)
					->where('client', $client_id)
					->group_start()
				    	->where('type',tsale())
		            	->or_where('type',tsalepay())
		            	->or_where('type',tpurchase())
		            	->or_where('type',tpurchasepay())
					->group_end()->get();
		$debit = $query->row()->debit;

		$credit += $ocredit;
		$debit 	+= $odebit;

		if($credit > $debit){
			return ['c',$credit - $debit];
		}
		else{
			return ['d',$debit - $credit];
		}
	}

	public function salary_opening($employee,$date)
	{
		$this->db->select_sum('salary');
        $this->db->where('date <', dd($date));
        $this->db->where('emp_id',$employee);
        $credit = $this->db->get('salary')->row()->salary;

		$this->db->select_sum('credit');
        $this->db->where('date <', dd($date));
        $this->db->where('client',$employee);
        $this->db->where('type',tsalarypay());
        $wdebit = $this->db->get('transactions_w')->row()->credit; 
        
        $this->db->select_sum('credit');
        $this->db->where('date <', dd($date));
        $this->db->where('client',$employee);
        $this->db->where('type',tsalarypay());
        $bdebit = $this->db->get('transactions_b')->row()->credit;   

        $debit = $wdebit + $bdebit;

        if($credit > $debit){
			return ['d',$credit - $debit];
		}
		else{
			return ['c',$debit - $credit];
		}
	}

	public function salary_from_to($employee,$from,$to)
	{
		$this->db->select_sum('salary');
		$this->db->where('date >=', dd($this->input->post('fdate')));
        $this->db->where('date <=', dd($this->input->post('tdate')));
        return $this->db->get('salary')->row()->salary;
	}

	public function get_total_invoice()
	{
		$this->db->select_sum('debit');
		$this->db->where_in('type',[2,4,6,7]);
		$this->db->from('transactions_w');
		$sale = $this->db->get()->row()->debit;

		$this->db->select_sum('credit');
		$this->db->where_in('type',[2,4,6,7]);
		$this->db->from('transactions_w');
		$purchase = $this->db->get()->row()->credit;

		return $sale - $purchase;
	}

	public function get_total_chalan()
	{
		$this->db->select_sum('debit');
		$this->db->where_in('type',[2,4,6,7]);
		$this->db->from('transactions_b');
		$sale = $this->db->get()->row()->debit;

		$this->db->select_sum('credit');
		$this->db->where_in('type',[2,4,6,7]);
		$this->db->from('transactions_b');
		$purchase = $this->db->get()->row()->credit;

		return $sale - $purchase;
	}

	public function client_total($client,$chin,$type)
	{
		$this->db->select_sum('debit');
		$this->db->select_sum('credit');
		$this->db->where('client',$client);
		$this->db->group_start();
			if($type == 1){
				$this->db->or_where('type',tsalepay());
	            $this->db->or_where('type',tsale());
	            $this->db->or_where('type',topening());
			}else if($type == 2){
				$this->db->or_where('type',tpurchase());
	            $this->db->or_where('type',tpurchasepay());
	            $this->db->or_where('type',topening());
			}else if($type == '3'){
                $this->db->or_where('type',texpensepay());
            }
		$this->db->group_end();
		if($chin == "invoice"){
            $result       = $this->db->get('transactions_w')->row_array();
        }else{
            $result       = $this->db->get('transactions_b')->row_array();
        }

        return $result;
	}



	public function getRegisterTotal($type,$chin,$main_id)
	{
		if($type == '1'){
	        $sale = $this->db->get_where('sales',['id' => $main_id])->row_array();
	        if($chin == 'invoice'){
	            return $sale['net_invoice'];
	        }else{
	            return $sale['challan_total'];
	        }
	    }else{
	        $purchase = $this->db->get_where('purchase',['id' => $main_id])->row_array();
	        if($chin == 'invoice'){
	            return $purchase['net_invoice'];
	        }else{
	            return $purchase['challan_total'];
	        }
	    }
	}

	public function getRegisterTax($type,$chin,$main_id){
		if($type == '1'){
            $sale = $this->db->get_where('sales',['id' => $main_id])->row_array();
            return $sale['tax_total'];
        }else{
            $purchase = $this->db->get_where('purchase',['id' => $main_id])->row_array();
            return $purchase['tax_total'];
        }
	}

	public function getRegisterGross($type,$chin,$main_id){
		if($type == '1'){
            $sale = $this->db->get_where('sales',['id' => $main_id])->row_array();
            if($chin == 'invoice'){
                return $sale['invoice_total'];
            }else{
                return $sale['challan_total'];
            }
        }else{
            $purchase = $this->db->get_where('purchase',['id' => $main_id])->row_array();
            if($chin == 'invoice'){
                return $purchase['invoice_total'];
            }else{
                return $purchase['challan_total'];
            }
        }
	}

	public function getRegisterInvoice($type,$chin,$main_id)
	{
		if($type == '1'){
            $sale = $this->db->get_where('sales',['id' => $main_id])->row_array();
            if($chin == 'invoice'){
                return $sale['invoice'];
            }else{
                return $sale['chalan'];
            }
        }else{
            $purchase = $this->db->get_where('purchase',['id' => $main_id])->row_array();
            if($chin == 'invoice'){
                return $purchase['invoice'];
            }else{
                return $purchase['chalan'];
            }
        }
	}
}

?>