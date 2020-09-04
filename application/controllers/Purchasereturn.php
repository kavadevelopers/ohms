<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchasereturn extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
        $this->load->model('purchasereturn_model');
        $this->load->model('general_model');
    }

    public function index()
    {
    	$data['_title'] = 'Purchasereturn';
    	$this->load->template('purchasereturn/index',$data);
    }

    public function add()
    {
        $data['_title']     = 'Add Purchasereturn';
        $data['clients']    = $this->general_model->purchase_clients();
        $data['products']    = $this->general_model->products();
        $this->load->template('purchasereturn/add',$data);
    }

    public function edit($id = false)
    {
        if($id){
            if($this->purchasereturn_model->get_purchase($id)){
                $data['_title']      = 'Edit Purchasereturn';
                $data['sale']        = $this->purchasereturn_model->get_purchase($id)[0];
                $data['clients']     = $this->general_model->purchase_clients();
                $data['products']    = $this->general_model->products();
                $data['details']     = $this->purchasereturn_model->get_details($id);
                $this->load->template('purchasereturn/edit',$data);
            }
            else{
                $this->session->set_flashdata('error', 'Purchasereturn Not Found');
                redirect(base_url('purchasereturn'));
            }
        }
        else{
            $this->session->set_flashdata('error', 'Purchasereturn Not Found');
            redirect(base_url('purchasereturn'));
        }
    }

    public function save()
    {
        $data = [
            'date'          => date('Y-m-d',strtotime($this->input->post('date'))),
            'client_id'     => $this->input->post('client'),
            'invoice'       => $this->input->post('inv'),
            'chalan'        => $this->input->post('challan_no'),
            'challan_total' => $this->input->post('challan_total'),
            'invoice_total' => $this->input->post('invoice_total'),
            'tax_total'     => $this->input->post('tax_total'),
            'net_invoice'   => $this->input->post('net_invoice'),
            'desc'          => $this->input->post('description'),
        ];

        if($this->db->insert('purchasereturn',$data)){
            $sale_id = $this->db->insert_id();
            foreach ($this->input->post('product') as $key => $value) {
                if($value != ""){
                    $detail = [
                        'product'           => $this->input->post('product')[$key],
                        'chalan_qty'        => $this->input->post('challan')[$key],
                        'invoice_qty'       => $this->input->post('invoice')[$key],
                        'rate'              => $this->input->post('price')[$key],
                        'challan_amount'    => $this->input->post('chalan_price')[$key],
                        'invoice_amount'    => $this->input->post('invoice_price')[$key],
                        'tax_amount'        => $this->input->post('tax')[$key],
                        'invoice'           => $sale_id
                    ];      
                    $this->db->insert('purchasereturn_detail',$detail);           
                }
            }

            $data = [
                'client'    => $this->input->post('client'),
                'type'      => tpurchasereturn(),
                'credit'    => $this->input->post('challan_total'),
                'tra_id'    => $sale_id,
                'date'      => date('Y-m-d',strtotime($this->input->post('date')))
            ];
            $this->db->insert('transactions_b',$data);
            $invoice = $this->input->post('net_invoice');

            $data = [
                'client'    => $this->input->post('client'),
                'type'      => tpurchasereturn(),
                'credit'    => $invoice,
                'tra_id'    => $sale_id,
                'date'      => date('Y-m-d',strtotime($this->input->post('date')))
            ];
            $this->db->insert('transactions_w',$data);

            $this->session->set_flashdata('msg', 'Purchasereturn Successfully Added');
            redirect(base_url('purchasereturn'));
        }else{
            $this->session->set_flashdata('error', 'Error In Add Purchasereturn');
            redirect(base_url('purchasereturn'));
        }
    }

    public function update()
    {
        $data = [
            'date'          => date('Y-m-d',strtotime($this->input->post('date'))),
            'client_id'     => $this->input->post('client'),
            'invoice'       => $this->input->post('inv'),
            'chalan'        => $this->input->post('challan_no'),
            'challan_total' => $this->input->post('challan_total'),
            'invoice_total' => $this->input->post('invoice_total'),
            'tax_total'     => $this->input->post('tax_total'),
            'net_invoice'   => $this->input->post('net_invoice'),
            'desc'          => $this->input->post('description'),
        ];

        $this->db->where('id',$this->input->post('id'));
        if($this->db->update('purchasereturn',$data)){

            $this->db->where('tra_id',$this->input->post('id'));
            $this->db->where('type',tpurchasereturn());
            $this->db->delete('transactions_b'); 
            
            $this->db->where('tra_id',$this->input->post('id'));
            $this->db->where('type',tpurchasereturn());
            $this->db->delete('transactions_w');  

            $this->db->where('invoice',$this->input->post('id'));
            $this->db->delete('purchasereturn_detail'); 

            $sale_id = $this->input->post('id');
            foreach ($this->input->post('product') as $key => $value) {
                if($value != ""){
                    $detail = [
                        'product'           => $this->input->post('product')[$key],
                        'chalan_qty'        => $this->input->post('challan')[$key],
                        'invoice_qty'       => $this->input->post('invoice')[$key],
                        'rate'              => $this->input->post('price')[$key],
                        'challan_amount'    => $this->input->post('chalan_price')[$key],
                        'invoice_amount'    => $this->input->post('invoice_price')[$key],
                        'tax_amount'        => $this->input->post('tax')[$key],
                        'invoice'           => $sale_id
                    ];      
                    $this->db->insert('purchasereturn_detail',$detail);           
                }
            }       

            $data = [
                'client'    => $this->input->post('client'),
                'type'      => tpurchasereturn(),
                'credit'    => $this->input->post('challan_total'),
                'tra_id'    => $sale_id,
                'date'      => date('Y-m-d',strtotime($this->input->post('date')))
            ];
            $this->db->insert('transactions_b',$data);
            $invoice = $this->input->post('net_invoice');

            $data = [
                'client'    => $this->input->post('client'),
                'type'      => tpurchasereturn(),
                'credit'    => $invoice,
                'tra_id'    => $sale_id,
                'date'      => date('Y-m-d',strtotime($this->input->post('date')))
            ];
            $this->db->insert('transactions_w',$data);


            $this->session->set_flashdata('msg', 'Purchasereturn Successfully Saved');
            redirect(base_url('purchasereturn'));
        }else{
            $this->session->set_flashdata('error', 'Error In Edit Purchasereturn');
            redirect(base_url('purchasereturn'));
        }
    }

    public function delete($id = false)
    {
        if($id){
            if($this->purchasereturn_model->get_purchase($id)){
                $this->db->where('id',$id);
                $this->db->delete('purchasereturn');

                $this->db->where('invoice',$id);
                $this->db->delete('purchasereturn_detail');

                $this->db->where('tra_id',$id);
                $this->db->where('type',tpurchasereturn());
                $this->db->delete('transactions_b'); 
                
                $this->db->where('tra_id',$id);
                $this->db->where('type',tpurchasereturn());
                $this->db->delete('transactions_w');  

                $this->session->set_flashdata('msg', 'Purchasereturn Successfully Deleted');
                redirect(base_url('purchasereturn'));
            }
            else{
                $this->session->set_flashdata('error', 'Purchasereturn Not Found');
                redirect(base_url('purchasereturn'));
            }
        }
        else{
            $this->session->set_flashdata('error', 'Purchasereturn Not Found');
            redirect(base_url('purchasereturn'));
        }
    }

    public function get_purchase()
    {  

       $fetch_data = $this->purchasereturn_model->make_datatables();  
       $data = array();  
       foreach($fetch_data as  $key=>$row)  
       {  
            $sub_array   = array();
            $sub_array[] = vd($row->date);  
            $sub_array[] = $row->invoice;  
            $sub_array[] = $row->chalan;  
            $sub_array[] = $this->general_model->_client($row->client_id)['name'];   
            $sub_array[] = moneyFormatIndia($row->challan_total);  
            $sub_array[] = moneyFormatIndia($row->net_invoice);     

            $action_string = "";
            $action_string .= ' <a class="btn btn-xs btn-primary" href="'.base_url('purchasereturn/edit/').$row->id.'" title="Edit"><i class="fa fa-edit"></i>
                                </a>';
            $action_string .= ' <a class="btn btn-xs btn-danger" href="'.base_url('purchasereturn/delete/').$row->id.'" onclick=\'return confirm("Are you Sure You Want to Delete this ?")\' title="Delete"><i class="fa fa-trash"></i>
                            </a>';

            $sub_array[] = $action_string;   

            
            
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                      =>     intval($_POST["draw"]),  
            "recordsTotal"              =>     $this->purchasereturn_model->get_all_data(),  
            "recordsFiltered"           =>     $this->purchasereturn_model->get_filtered_data(),  
            "data"                      =>     $data  
       );  
       echo json_encode($output);  
    }
}
?>