<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }

    public function index()
    {
    	$data['_title'] = 'Daily';
    	$this->load->template('daily/index',$data);
    }

    public function save()
    {
        foreach ($this->input->post('date') as $key => $value) {
                
            if($this->input->post('type')[$key] == '1'){

                if($this->input->post('chl_inv')[$key] == '1'){
                    $invoice = $this->input->post('amount')[$key];
                    $chalan = 0;
                }else{
                    $chalan = $this->input->post('amount')[$key];
                    $invoice = 0;
                }

                $data = [
                    'client'     => $this->input->post('client')[$key],
                    'white'      => $invoice,
                    'black'      => $chalan,
                    'date'       => date('Y-m-d',strtotime($this->input->post('date')[$key])),
                    'desc'       => $this->input->post('remarks')[$key]
                ];
                $this->db->insert('sale_payments',$data);

                $insert_id = $this->db->insert_id();

                if($this->input->post('chl_inv')[$key] == '1'){
                    $data = [
                        'client'    => $this->input->post('client')[$key],
                        'type'      => tsalepay(),
                        'debit'     => $invoice,
                        'tra_id'    => $insert_id,
                        'date'       => date('Y-m-d',strtotime($this->input->post('date')[$key]))
                    ];
                    $this->db->insert('transactions_w',$data);
                }else{
                    $data = [
                        'client'    => $this->input->post('client')[$key],
                        'type'      => tsalepay(),
                        'debit'     => $chalan,
                        'tra_id'    => $insert_id,
                        'date'       => date('Y-m-d',strtotime($this->input->post('date')[$key])),
                    ];
                    $this->db->insert('transactions_b',$data);
                }


            }else if($this->input->post('type')[$key] == '2'){

                if($this->input->post('chl_inv')[$key] == '1'){
                    $invoice = $this->input->post('amount')[$key];
                    $chalan = 0;
                }else{
                    $chalan = $this->input->post('amount')[$key];
                    $invoice = 0;
                }

                $data = [
                    'client'     => $this->input->post('client')[$key],
                    'white'      => $invoice,
                    'black'      => $chalan,
                    'date'       => date('Y-m-d',strtotime($this->input->post('date')[$key])),
                    'desc'       => $this->input->post('remarks')[$key]
                ];

                $this->db->insert('purchase_payments',$data);
                $insert_id = $this->db->insert_id();

                if($this->input->post('chl_inv')[$key] == '1'){
                    $data = [
                        'client'    => $this->input->post('client')[$key],
                        'type'      => tpurchasepay(),
                        'credit'     => $invoice,
                        'tra_id'    => $insert_id,
                        'date'       => date('Y-m-d',strtotime($this->input->post('date')[$key]))
                    ];
                    $this->db->insert('transactions_w',$data);
                }else{
                    $data = [
                        'client'    => $this->input->post('client')[$key],
                        'type'      => tpurchasepay(),
                        'credit'     => $chalan,
                        'tra_id'    => $insert_id,
                        'date'       => date('Y-m-d',strtotime($this->input->post('date')[$key])),
                    ];
                    $this->db->insert('transactions_b',$data);
                }
            }
        }


        $this->session->set_flashdata('msg', 'Daily Successfully Added');
        redirect(base_url('daily'));
    }
}