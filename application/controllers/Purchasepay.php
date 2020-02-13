<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchasepay extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('purchasepay_model');
        $this->load->model('general_model');
    }

    public function index()
    {
    	$data['_title'] = 'Purchase Payments';
    	$this->load->template('purchasepayments/index',$data);
    }

    public function add()
    {
        $data['_title']     = 'Add Purchase Payment';
        $data['clients']    = $this->general_model->purchase_clients();
        $this->load->template('purchasepayments/add',$data);
    }

    public function edit($id = false)
    {
        if($id){
            if($this->purchasepay_model->get_payment($id)){
                $data['_title']      = 'Edit Sales Payment';
                $data['sale']        = $this->purchasepay_model->get_payment($id)[0];
                $data['clients']     = $this->general_model->purchase_clients();
                $this->load->template('purchasepayments/edit',$data);
            }
            else{
                $this->session->set_flashdata('error', 'Payment Not Found');
                redirect(base_url('purchasepay'));
            }
        }
        else{
            $this->session->set_flashdata('error', 'Payment Not Found');
            redirect(base_url('purchasepay'));
        }
    }

    public function save()
    {
        $data = [
            'client'     => $this->input->post('client'),
            'white'         => $this->input->post('invoice'),
            'black'         => $this->input->post('challan'),
            'date'          => date('Y-m-d',strtotime($this->input->post('date'))),
            'desc'          => $this->input->post('desc')
        ];

        if($this->db->insert('purchase_payments',$data)){
            $insert_id = $this->db->insert_id();
            $data = [
                'client'    => $this->input->post('client'),
                'type'      => tpurchasepay(),
                'credit'    => $this->input->post('challan'),
                'tra_id'    => $insert_id,
                'date'          => date('Y-m-d',strtotime($this->input->post('date')))
            ];
            $this->db->insert('transactions_b',$data);

            $data = [
                'client'    => $this->input->post('client'),
                'type'      => tpurchasepay(),
                'credit'    => $this->input->post('invoice'),
                'tra_id'    => $insert_id,
                'date'          => date('Y-m-d',strtotime($this->input->post('date')))
            ];
            $this->db->insert('transactions_w',$data);


            $this->session->set_flashdata('msg', 'Purchase Payment Successfully Added');
            redirect(base_url('purchasepay'));
        }else{
            $this->session->set_flashdata('error', 'Error In Add Purchase Payment');
            redirect(base_url('purchasepay'));
        }
    }

    public function update()
    {
        $data = [
            'client'     => $this->input->post('client'),
            'white'         => $this->input->post('invoice'),
            'black'         => $this->input->post('challan'),
            'date'          => date('Y-m-d',strtotime($this->input->post('date'))),
            'desc'          => $this->input->post('desc')
        ];
        $this->db->where('id',$this->input->post('id'));
        if($this->db->update('purchase_payments',$data)){

            $this->db->where('tra_id',$this->input->post('id'));
            $this->db->where('type',tpurchasepay());
            $this->db->delete('transactions_b'); 
            
            $this->db->where('tra_id',$this->input->post('id'));
            $this->db->where('type',tpurchasepay());
            $this->db->delete('transactions_w');            

            $insert_id = $this->input->post('id');

            $data = [
                'client'    => $this->input->post('client'),
                'type'      => tpurchasepay(),
                'credit'     => $this->input->post('challan'),
                'tra_id'    => $insert_id,
                'date'      => date('Y-m-d',strtotime($this->input->post('date')))
            ];
            $this->db->insert('transactions_b',$data);

            $data = [
                'client'    => $this->input->post('client'),
                'type'      => tpurchasepay(),
                'credit'     => $this->input->post('invoice'),
                'tra_id'    => $insert_id,
                'date'      => date('Y-m-d',strtotime($this->input->post('date')))
            ];
            $this->db->insert('transactions_w',$data);

            $this->session->set_flashdata('msg', 'Purchase Payment Successfully Updated');
            redirect(base_url('purchasepay'));
        }else{
            $this->session->set_flashdata('error', 'Error In Update Purchase Payment');
            redirect(base_url('purchasepay'));
        }
    }

    public function delete($id = false)
    {
        if($id){
            if($this->purchasepay_model->get_payment($id)){
                $this->db->where('id',$id);
                $this->db->delete('purchase_payments');

                $this->db->where('tra_id',$id);
                $this->db->where('type',tpurchasepay());
                $this->db->delete('transactions_b'); 
                
                $this->db->where('tra_id',$id);
                $this->db->where('type',tpurchasepay());
                $this->db->delete('transactions_w');  

                $this->session->set_flashdata('msg', 'Purchase Payment Successfully Deleted');
                redirect(base_url('purchasepay'));
            }
            else{
                $this->session->set_flashdata('error', 'Purchase Payment Not Found');
                redirect(base_url('purchasepay'));
            }
        }
        else{
            $this->session->set_flashdata('error', 'Purchase Payment Not Found');
            redirect(base_url('purchasepay'));
        }
    }

    public function get_payments()
    {  

       $fetch_data = $this->purchasepay_model->make_datatables();  
       $data = array();  
       foreach($fetch_data as  $key=>$row)  
       {  
            $sub_array   = array();
            $sub_array[] = vd($row->date);
            $sub_array[] = $this->general_model->_client($row->client)['name'];  
            $sub_array[] = moneyFormatIndia($row->black);  
            $sub_array[] = moneyFormatIndia($row->white);     
            $action_string = "";
            $action_string .= ' <a class="btn btn-xs btn-primary" href="'.base_url('purchasepay/edit/').$row->id.'" title="Edit"><i class="fa fa-edit"></i>
                                </a>';
            $action_string .= ' <a class="btn btn-xs btn-danger" href="'.base_url('purchasepay/delete/').$row->id.'" onclick=\'return confirm("Are you Sure You Want to Delete this ?")\' title="Delete"><i class="fa fa-trash"></i>
                            </a>';

            $sub_array[] = $action_string;   

            
            
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                      =>     intval($_POST["draw"]),  
            "recordsTotal"              =>     $this->purchasepay_model->get_all_data(),  
            "recordsFiltered"           =>     $this->purchasepay_model->get_filtered_data(),  
            "data"                      =>     $data  
       );  
       echo json_encode($output);  
    }
}
?>