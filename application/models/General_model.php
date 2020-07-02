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
}

?>