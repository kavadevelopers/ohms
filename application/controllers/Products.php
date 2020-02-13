<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }

    public function index()
    {
    	$data['_title'] = 'Products';
        $data['_e']         = 0;
    	$this->db->order_by('id','desc');
    	$data['products'] = $this->db->get_where('products',['df' => ''])->result_array();
    	$this->load->template('settings/products/index',$data);
    }

    public function edit($id = false)
    {
        if($id){
            $data = $this->db->get_where('products',['df' => '','id' => $id])->result_array();
            if($data){
                $data['_title']     = 'Products';
                $data['_e']         = 1;
                $data['product']    = $data[0];
                $this->db->order_by('id','desc');
                $data['products'] = $this->db->get_where('products',['df' => ''])->result_array();
                $this->load->template('settings/products/index',$data);
            }
            else{
                redirect(base_url('products'));
            }
        }
        else{
            redirect(base_url('products'));
        }
    }

    public function save()
    {
    	$this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('price','Price of Manufactured','required|decimal');
        $this->form_validation->set_rules('sprice','Price of Sell','required|decimal');
        
        if($this->form_validation->run()==FALSE){
            $data['_title']     = 'Products';
            $data['_e']         = 0;
            $this->db->order_by('id','desc');
	    	$data['products'] = $this->db->get_where('products',['df' => ''])->result_array();
	    	$this->load->template('settings/products/index',$data);
        }
        else{

            $data   =   [   
                'name'         =>  strtoupper($this->input->post('name')),
                'price'        =>  $this->input->post('price'),
                'regular_price'=>  $this->input->post('sprice')
            ];

            if($this->db->insert('products',$data))
            {

                $product_id = $this->db->insert_id();
                $clients = $this->db->get_where('clients',['df' => ''])->result_array();
                foreach ($clients as $key => $client) {
                    $this->db->insert('pricing',['client' => $client['id'],'product' => $product_id,'price' => $this->input->post('sprice')]);
                }


                $this->session->set_flashdata('msg', 'Product Successfully Added');
                redirect(base_url('products'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Error In Add Products');
                redirect(base_url('products'));
            }
        }
    }

    public function update()
    {
        $this->form_validation->set_error_delimiters('<div class="my_text_error">', '</div>');

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('price','Price of Manufactured','required|decimal');
        $this->form_validation->set_rules('sprice','Price of Sell','required|decimal');
        
        if($this->form_validation->run()==FALSE){
            $data['_title']     = 'Products';
            $data['_e']         = 1;
            $data['product']    = $this->db->get_where('products',['id' => $this->input->post('id')])->result_array()[0];
            $data['products'] = $this->db->get_where('products',['df' => ''])->result_array();
            $this->load->template('settings/products/index',$data);
        }
        else{
            $data   =   [   
                'name'         =>  strtoupper($this->input->post('name')),
                'price'        =>  $this->input->post('price'),
                'regular_price'=>  $this->input->post('sprice')
            ];
            $this->db->where('id',$this->input->post('id'));
            if($this->db->update('products',$data))
            {
                $this->session->set_flashdata('msg', 'Product Successfully Saved');
                redirect(base_url('products'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Error In Edit Products');
                redirect(base_url('products'));
            }
        }
    }

    public function delete($id = false)
    {
        if($id){
            $data = $this->db->get_where('products',['df' => '','id' => $id])->result_array();
            if($data){
                $this->db->where('id',$id);
                $this->db->update('products',['df' => '1']);

                $this->session->set_flashdata('msg', 'Product Successfully Deleted');
                redirect(base_url('products'));
            }
            else{
                redirect(base_url('products'));
            }
        }
        else{
            redirect(base_url('products'));
        }
    }

}