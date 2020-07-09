<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('general_model');
    }

    public function ledger()
    {
    	$data['_title'] 	= 'Ledger';
    	$data['clients']    = $this->general_model->clients();
    	$this->load->template('reports/ledger',$data);
    }

    public function ledger_result()
    {
    	$client = $this->general_model->_client($this->input->post('client'));
    	$data['_title'] 	= $client['name']." Ledger - (".vd($this->input->post('fdate'))." to ".vd($this->input->post('tdate')).")";
    	$this->db->where('date >=', dd($this->input->post('fdate')));
        $this->db->where('date <=', dd($this->input->post('tdate')));
        $this->db->where('client', $this->input->post('client'));
        $this->db->group_start();
            $this->db->where('debit !=',0.00);
            $this->db->or_where('credit !=',0.00);
        $this->db->group_end();
		$this->db->group_start();
		    $this->db->where('type',tsale());
            $this->db->or_where('type',tsalepay());
            $this->db->or_where('type',tpurchase());
            $this->db->or_where('type',tpurchasepay());
		$this->db->group_end();
		$this->db->order_by('date','asc');
		if($this->input->post('type') == 'invoice'){
    		$data['list']		= $this->db->get('transactions_w')->result_array();
            $data['type']       = "w";
            $data['opening']    = $this->general_model->w_opening_balance($this->input->post('client'),dd($this->input->post('fdate')));
            $data['date']       =  $this->input->post('fdate');
    	}else{
    		$data['list']		= $this->db->get('transactions_b')->result_array();
            $data['type']       = "b";
            $data['opening']    = $this->general_model->b_opening_balance($this->input->post('client'),dd($this->input->post('fdate')));
            $data['date']       =  $this->input->post('fdate');
    	}
        $data['client_type']    = $client['type'];
    	$this->load->template('reports/ledger_result',$data);
    }	

    public function salary()
    {
        $data['_title']     = 'Salary';
        $data['months']     = $this->db->order_by('id','desc')->get('months')->result_array();
        $data['employees']     = $this->db->order_by('id','asc')->get_where('employees',['df' => ''])->result_array();
        $this->load->template('reports/salary/index',$data);
    }

    public function salary_reports()
    {
        $employee = $this->db->get_where('employees',['id' => $this->input->post('employee')])->row_array();
        $data['_title']     = $employee['name'].' Salary - ('.vd($this->input->post('fdate'))." to ".vd($this->input->post('tdate')).")";
        $data['opening']    = $this->general_model->salary_opening($this->input->post('employee'),$this->input->post('fdate'));
        $data['date']       = $this->input->post('fdate');
        $data['employee']       = $this->input->post('employee');
        $data['loop']     = dateRangeLoop($this->input->post('fdate'),$this->input->post('tdate'));
        $this->load->template('reports/salary/result',$data);
    }
}
?>