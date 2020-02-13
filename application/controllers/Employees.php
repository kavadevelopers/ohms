<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }


    public function index()
    {
    	$data['_title'] = 'Employees';
        $data['_e']         = 0;
    	$this->db->order_by('id','desc');
    	$data['employees'] = $this->db->get_where('employees',['df' => ''])->result_array();
    	$this->load->template('settings/employees/index',$data);
    }

    public function edit($id = false)
    {
        if($id){
            $data = $this->db->get_where('employees',['df' => '','id' => $id])->result_array();
            if($data){
                $data['_title']     = 'Employees';
                $data['_e']         = 1;
                $data['client']    = $data[0];
                $this->db->order_by('id','desc');
                $data['employees'] = $this->db->get_where('employees',['df' => ''])->result_array();
                $this->load->template('settings/employees/index',$data);
            }
            else{
                redirect(base_url('employees'));
            }
        }
        else{
            redirect(base_url('employees'));
        }
    }

    public function save()
    {
    	$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('gender','Gender','required');
        $this->form_validation->set_rules('mobile','Mobile','required|is_natural|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('opening','Opening Balance','required|decimal');
        $this->form_validation->set_rules('salary','Salary','required|decimal');


        
        if($this->form_validation->run()==FALSE){
            $data['_title'] = 'Employees';
	        $data['_e']         = 0;
	    	$this->db->order_by('id','desc');
	    	$data['employees'] = $this->db->get_where('employees',['df' => ''])->result_array();
	    	$this->load->template('settings/employees/index',$data);
        }
        else{
            $data   =   [   
                'name'         	=>  strtoupper($this->input->post('name')),
                'mobile'       	=>  $this->input->post('mobile'),
                'opening'      	=>  $this->input->post('opening'),
                'gender'        =>  $this->input->post('gender'),
                'salary'        =>  $this->input->post('salary'),
                'created_at'	=>  date('Y-m-d H:i:s')
            ];
            if($this->db->insert('employees',$data))
            {
                $this->session->set_flashdata('msg', 'Employee Successfully Added');
                redirect(base_url('employees'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Error In Add Employee');
                redirect(base_url('employees'));
            }
        }
    }


    public function update()
    {
        $this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('mobile','Mobile','required|is_natural|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('gender','Gender','required');
        $this->form_validation->set_rules('salary','Salary','required|decimal');
        $this->form_validation->set_rules('opening','Opening Balance','required|decimal');
        
        if($this->form_validation->run()==FALSE){
            $data['_title']     = 'Employees';
            $data['_e']         = 1;
            $data['client']     = $this->db->get_where('employees',['df' => '','id' => $this->input->post('id')])->result_array()[0];
            $this->db->order_by('id','desc');
            $data['employees'] = $this->db->get_where('employees',['df' => ''])->result_array();
            $this->load->template('settings/employees/index',$data);
        }
        else{
            $data   =   [   
                'name'         	=>  strtoupper($this->input->post('name')),
                'mobile'       	=>  $this->input->post('mobile'),
                'gender'        =>  $this->input->post('gender'),
                'salary'        =>  $this->input->post('salary'),
                'opening'      	=>  $this->input->post('opening')
            ];
            $this->db->where('id',$this->input->post('id'));
            if($this->db->update('employees',$data))
            {
                $this->session->set_flashdata('msg', 'Employee Successfully Saved');
                redirect(base_url('employees'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Error In Edit Employee');
                redirect(base_url('employees'));
            }
        }
    }


    public function delete($id = false)
    {
        if($id){
            $data = $this->db->get_where('employees',['df' => '','id' => $id])->result_array();
            if($data){
                $this->db->where('id',$id);
            	$this->db->update('employees',['df' => '1']);

            	$this->session->set_flashdata('msg', 'Employee Successfully Deleted');
                redirect(base_url('employees'));
            }
            else{
                redirect(base_url('employees'));
            }
        }
        else{
            redirect(base_url('employees'));
        }
    }
}

?>