<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Increment_salary extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('general_model');
    }

    public function index()
    {
    	$data['_title']	= "Salary Increments";
    	$data['_e'] = 0;
    	$this->db->order_by('id','desc');
    	$data['increments'] = $this->db->get('increment')->result_array();
        $data['employees']  = $this->db->get_where('employees',['df'=>''])->result_array();
    	$this->load->template('salary/increment_salary',$data);
   	}
   	public function save()
   	{
   		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');
   		$this->form_validation->set_rules('name', 'Name', 'required');
   		$this->form_validation->set_rules('salary', 'Salary', 'required|decimal');

   		if($this->form_validation->run()==false )
   		{
			$data['_title']	= "Salary Increments";
    		$data['_e'] = 0;
    		$this->db->order_by('id','desc');
	    	$data['increments'] = $this->db->get('increment')->result_array();
	        $data['employees']  = $this->db->get_where('employees',['df'=>''])->result_array();
    		$this->load->template('salary/increment_salary',$data);
   		}
   		else{

	   		$data = [
	   			'employee' 	=> $this->input->post('name'),
	   			'salary' 	=> $this->input->post('salary'),
	   			'date'		=> date('Y-m-d')
	   		];
	   		$this->db->insert('increment',$data);
	   		$this->session->set_flashdata('msg', 'Increment Successfully Added');
	   		redirect(base_url('increment_salary'));
   		}
   	}

   	public function edit($id = false)
    {
        if($id){
            $data = $this->db->get_where('increment',['id' => $id])->result_array();
            if($data){
                $data['_title']     = 'Salary Increments';
                $data['_e']         = 1;
                $data['client']    = $data[0];
        		$this->db->order_by('id','desc');
		    	$data['increments'] = $this->db->get('increment')->result_array();
		        $data['employees']  = $this->db->get_where('employees',['df'=>''])->result_array();
                $this->load->template('salary/increment_salary',$data);
            }
            else{
                redirect(base_url('increment'));
            }
        }
        else{
            redirect(base_url('increment'));
        }
    }

   	public function update()
   	{
   		$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

   		$this->form_validation->set_rules('name', 'Name', 'required');
   		$this->form_validation->set_rules('salary', 'Salary', 'required|decimal');

   		if($this->form_validation->run()==false)
   		{
   			$data['_title']     = 'Employees';
            $data['_e']         = 1;
            $data['client']     = $this->db->get_where('increment',['id' => $this->input->post('id')])->result_array()[0];
            $this->db->order_by('id','desc');
	    	$data['increments'] = $this->db->get('increment')->result_array();
	        $data['employees']  = $this->db->get_where('employees',['df'=>''])->result_array();
    		$this->load->template('salary/increment_salary',$data);
           
   		}else{
   			$data   =   [   
                'employee' 	=> $this->input->post('name'),
   				'salary' 	=> $this->input->post('salary')
            ];
            $this->db->where('id',$this->input->post('id'));
            if($this->db->update('increment',$data))
            {
                $this->session->set_flashdata('msg', 'Increment Successfully Saved');
                redirect(base_url('increment_salary'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Error In Edit Increment');
                redirect(base_url('increment_salary'));
            }
   		}

   	}
   	public function delete($id = false)
    {
        if($id){
            $data = $this->db->get_where('increment',['id' => $id])->result_array();
            if($data){
                $this->db->where('id',$id);
            	$this->db->delete('increment');
            	$this->session->set_flashdata('msg', 'Increment Successfully Deleted');
                redirect(base_url('increment_salary'));
            }
            else{
                redirect(base_url('increment_salary'));
            }
        }
        else{
            redirect(base_url('increment_salary'));
        }
    }

    public function report()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST'){
            $data['_title'] = "Increment Report";
            $data['_e'] = 1;
            $this->db->order_by('id','desc');
            $this->db->where('employee',$this->input->post('name'));
            $data['increments'] = $this->db->get('increment')->result_array();
            $data['employees']  = $this->db->get_where('employees',['df'=>''])->result_array();
            $this->load->template('salary/increment_report',$data);
        }else{
            $data['_title'] = "Increment Report";
            $data['_e'] = 0;
            $data['employees']  = $this->db->get_where('employees',['df'=>''])->result_array();
            $this->load->template('salary/increment_report',$data);
        }
    }
}
?>