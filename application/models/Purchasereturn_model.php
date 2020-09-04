<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchasereturn_model extends CI_Model
{
	public $table = "purchasereturn";  
	public $select_column = array("id","client_id", "invoice","chalan","challan_total" ,"invoice_total","tax_total","net_invoice","date","desc");  
	public $order_column = array("date","invoice");

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_purchase($id)
	{
		return $this->db->get_where('purchasereturn',['id' => $id])->result_array();
	}

	public function get_details($id)
	{	
		$this->db->order_by('id','asc');
		return $this->db->get_where('purchasereturn_detail',['invoice' => $id])->result_array();
	}

	public function make_query()  
	{  
		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		if(isset($_POST["search"]["value"]))  
		{  
			
		}  
		if(isset($_POST["order"]))  
		{  
		    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
		}  
		else  
		{  
		    $this->db->order_by('date', 'DESC');  
		}  
	} 

	public function make_datatables()
	{  
		$this->make_query();  
		if($_POST["length"] != -1)  
		{  
		    $this->db->limit($_POST['length'], $_POST['start']);  
		}  
		$query = $this->db->get();  
		return $query->result();  
    }
    
    public function get_filtered_data()
    {  
        $this->make_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
    } 
    
    public function get_all_data()  
    {  
        $this->db->select("*");  
        $this->db->from($this->table);
        return $this->db->count_all_results();  
    }

}
?>