<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prod_pricing extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('general_model');
    }

    public function index()
    {
    	$data['_title'] = 'Product Pricing';
    	$this->db->order_by('id','desc');
    	$data['clients'] = $this->db->get_where('clients',['df' => ''])->result_array();
    	$this->load->template('settings/pricing/index',$data);
    }
    

    public function edit($id = false)
    {
        if($id){
            $data = $this->db->get_where('clients',['df' => '','id' => $id])->result_array();
            if($data){
                $data['_title']     = 'Edit Product Pricing';
                $data['client']    = $data[0];
                $this->db->order_by('id','product');
                $data['products'] = $this->db->get_where('pricing',['client' => $data[0]['id']])->result_array();
                $this->load->template('settings/pricing/edit',$data);
            }
            else{
                redirect(base_url('pricing'));
            }
        }
        else{
            redirect(base_url('pricing'));
        }
    }


    public function save()
    {
        foreach ($this->input->post('product_id') as $key => $value) {
            $data = [
                'price' => $this->input->post('price')[$key]
            ];
            $this->db->where('id',$value);
            $this->db->update('pricing',$data);
        }

        $this->session->set_flashdata('msg', 'Price Successfully Updated');
        redirect(base_url('prod_pricing'));
    }
}

?>