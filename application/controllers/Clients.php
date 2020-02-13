<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }

    public function index()
    {
    	$data['_title'] = 'Clients';
        $data['_e']         = 0;
    	$this->db->order_by('id','desc');
    	$data['clients'] = $this->db->get_where('clients',['df' => ''])->result_array();
    	$this->load->template('settings/clients/index',$data);
    }

    public function edit($id = false)
    {
        if($id){
            $data = $this->db->get_where('clients',['df' => '','id' => $id])->result_array();
            if($data){
                $data['_title']     = 'Clients';
                $data['_e']         = 1;
                $data['client']    = $data[0];
                $this->db->order_by('id','desc');
                $data['clients'] = $this->db->get_where('clients',['df' => ''])->result_array();
                $this->load->template('settings/clients/index',$data);
            }
            else{
                redirect(base_url('clients'));
            }
        }
        else{
            redirect(base_url('clients'));
        }
    }

    public function save()
    {
    	$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('mobile','Mobile','required|is_natural|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('invoice_opening','Invoice Opening Balance','required|decimal');
        $this->form_validation->set_rules('chalan_opening','Challan Opening Balance','required|decimal');
        
        if($this->form_validation->run()==FALSE){
            $data['_title'] = 'Clients';
	        $data['_e']         = 0;
	    	$this->db->order_by('id','desc');
	    	$data['clients'] = $this->db->get_where('clients',['df' => ''])->result_array();
	    	$this->load->template('settings/clients/index',$data);
        }
        else{
            $data   =   [   
                'name'         	        =>  strtoupper($this->input->post('name')),
                'mobile'       	        =>  $this->input->post('mobile'),
                'challan_opening'       =>  $this->input->post('chalan_opening'),
                'invoice_opening'       =>  $this->input->post('invoice_opening'),
                'type'      	        =>  $this->input->post('type'),
                'created_at'	        =>  date('Y-m-d H:i:s')
            ];
            if($this->db->insert('clients',$data))
            {
                $client_id = $this->db->insert_id();
                $products = $this->db->get_where('products',['df' => ''])->result_array();
                foreach ($products as $key => $product) {
                    $this->db->insert('pricing',['client' => $client_id,'product' => $product['id'],'price' => $product['regular_price']]);
                }

                if($this->input->post('type') == 'Sales'){
                    if($this->input->post('chalan_opening') > 0){
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'credit'    => $this->input->post('chalan_opening'),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_b',$data);
                    }
                    else{
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'debit'    => abs($this->input->post('chalan_opening')),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_b',$data);
                    }

                    if($this->input->post('invoice_opening') > 0){
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'credit'    => $this->input->post('invoice_opening'),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_w',$data);
                    }
                    else{
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'debit'    => abs($this->input->post('invoice_opening')),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_w',$data);
                    }
                }else{
                    if($this->input->post('chalan_opening') > 0){
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'debit'    => $this->input->post('chalan_opening'),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_b',$data);
                    }
                    else{
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'credit'    => abs($this->input->post('chalan_opening')),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_b',$data);
                    }

                    if($this->input->post('invoice_opening') > 0){
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'debit'    => $this->input->post('invoice_opening'),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_w',$data);
                    }
                    else{
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'credit'    => abs($this->input->post('invoice_opening')),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_w',$data);
                    }
                }

                $this->session->set_flashdata('msg', 'Clients Successfully Added');
                redirect(base_url('clients'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Error In Add Clients');
                redirect(base_url('clients'));
            }
        }
    }

    public function update()
    {
        $this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('mobile','Mobile','required|is_natural|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('invoice_opening','Invoice Opening Balance','required|decimal');
        $this->form_validation->set_rules('chalan_opening','Challan Opening Balance','required|decimal');
        
        if($this->form_validation->run()==FALSE){
            $data['_title']     = 'Clients';
            $data['_e']         = 1;
            $data['client']     = $this->db->get_where('clients',['df' => '','id' => $this->input->post('id')])->result_array()[0];
            $this->db->order_by('id','desc');
            $data['clients'] = $this->db->get_where('clients',['df' => ''])->result_array();
            $this->load->template('settings/clients/index',$data);
        }
        else{
            $data   =   [   
                'name'         	=>  strtoupper($this->input->post('name')),
                'mobile'       	=>  $this->input->post('mobile'),
                'challan_opening'       =>  $this->input->post('chalan_opening'),
                'invoice_opening'       =>  $this->input->post('invoice_opening'),
                'type'          =>  $this->input->post('type')
            ];
            $this->db->where('id',$this->input->post('id'));
            if($this->db->update('clients',$data))
            {
                $client_id = $this->input->post('id');
                $this->db->where('tra_id',0);
                $this->db->where('client',$this->input->post('id'));
                $this->db->where('type',topening());
                $this->db->delete('transactions_b'); 
                
                $this->db->where('tra_id',0);
                $this->db->where('client',$this->input->post('id'));
                $this->db->where('type',topening());
                $this->db->delete('transactions_w'); 

                if($this->input->post('type') == 'Sales'){
                    if($this->input->post('chalan_opening') > 0){
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'credit'    => $this->input->post('chalan_opening'),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_b',$data);
                    }
                    else{
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'debit'    => abs($this->input->post('chalan_opening')),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_b',$data);
                    }

                    if($this->input->post('invoice_opening') > 0){
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'credit'    => $this->input->post('invoice_opening'),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_w',$data);
                    }
                    else{
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'debit'    => abs($this->input->post('invoice_opening')),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_w',$data);
                    }
                }else{
                    if($this->input->post('chalan_opening') > 0){
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'debit'    => $this->input->post('chalan_opening'),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_b',$data);
                    }
                    else{
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'credit'    => abs($this->input->post('chalan_opening')),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_b',$data);
                    }

                    if($this->input->post('invoice_opening') > 0){
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'debit'    => $this->input->post('invoice_opening'),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_w',$data);
                    }
                    else{
                        $data = [
                            'client'    => $client_id,
                            'type'      => topening(),
                            'credit'    => abs($this->input->post('invoice_opening')),
                            'tra_id'    => 0,
                            'date'      => date('Y-m-d')
                        ];
                        $this->db->insert('transactions_w',$data);
                    }
                }


                $this->session->set_flashdata('msg', 'Clients Successfully Saved');
                redirect(base_url('clients'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Error In Edit Clients');
                redirect(base_url('clients'));
            }
        }
    }


    public function delete($id = false)
    {
        if($id){
            $data = $this->db->get_where('clients',['df' => '','id' => $id])->result_array();
            if($data){
                $this->db->where('id',$id);
            	$this->db->update('clients',['df' => '1']);

            	$this->session->set_flashdata('msg', 'Client Successfully Deleted');
                redirect(base_url('clients'));
            }
            else{
                redirect(base_url('clients'));
            }
        }
        else{
            redirect(base_url('clients'));
        }
    }
}

?>