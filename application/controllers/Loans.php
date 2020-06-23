<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loans extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }

    public function index()
    {
    	$data['_title'] = 'Loans';	
    						$this->db->order_by('id','desc');
    	$data['loans']	= 	$this->db->get('loans')->result_array();
    	$this->load->template('loan/index',$data);
    }

    public function add()
    {
    	$data['_title'] = 'Add Loan';	
    	$this->load->template('loan/add',$data);	
    }

    public function save()
    {
    	$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
    	$this->form_validation->set_rules('date','Date','required');
    	$this->form_validation->set_rules('loan','Loan no.','required');
        $this->form_validation->set_rules('bank','Bank','required');
    	$this->form_validation->set_rules('type','Bank','required');
    	$this->form_validation->set_rules('interest_amount','Interest Amount','required');
    	$this->form_validation->set_rules('principle_amount','Principle Amount','required');
    	$this->form_validation->set_rules('no_of_installment','No of Installment','required');
    	$this->form_validation->set_rules('interest','Interest per Year','required');

    	if($this->form_validation->run()==FALSE){
    		$data['_title'] = 'Add Loan';	
    		$this->load->template('loan/add',$data);
    	}else{

    		$data = [
    			'date' 			=> dd($this->input->post('date')),
    			'loan_no' 		=> $this->input->post('loan'),
    			'bank' 			=> $this->input->post('bank'),
    			'remarks' 		=> $this->input->post('remarks'),
    			'installments' 	=> $this->input->post('no_of_installment'),
    			'interest' 		=> $this->input->post('interest'),
    			'type' 			=> $this->input->post('type'),
    			'interest_amount' 			=> $this->input->post('interest_amount'),
    			'principle_amount' 			=> $this->input->post('principle_amount')
    		];
    		$this->db->insert('loans',$data);
    		$id = $this->db->insert_id();

    		$amount = $this->input->post('interest_amount') + $this->input->post('principle_amount');
    		$installment_amount = $amount  / $this->input->post('no_of_installment');
    		$principle = $amount;
    		for ($i=1; $i <= $this->input->post('no_of_installment'); $i++) { 
    			$principle -= $installment_amount;
    			$data = [
    				'loan_id' 	=> 	$id,
    				'amount'	=>	$installment_amount,
    				'p_amount'	=> 	$principle
    			];
    			$this->db->insert('loan_installment',$data);
    		}

    		$this->session->set_flashdata('msg', 'Loan Successfully Added');
            redirect(base_url('loans'));
    	}
    }

    public function delete($id = FALSE)
    {
    	if($id){

    		$this->db->where('loan_id',$id);
    		$this->db->delete('loan_installment');

    		$this->db->where('id',$id);
    		$this->db->delete('loans');

    		$this->session->set_flashdata('msg', 'Loan Successfully Deleted');
            redirect(base_url('loans'));

    	}else{
    		redirect(base_url('loans'));	
    	}
    }

    public function view($id = FALSE)
    {
        if($id){

            $data['_title'] = 'View Loan';   
            $data['data']   = $this->db->get_where('loans',['id' => $id])->row_array();
            $this->load->template('loan/view',$data);    

        }else{
            redirect(base_url('loans'));    
        }   
    }
}