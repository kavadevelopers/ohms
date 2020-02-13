<?php
class Purchasepay_model extends CI_Model
{
	public $table = "purchase_payments";  
	public $select_column = array("id","client","white","black","date");  
	public $order_column = array(null,"id","client","white","black","date",null);

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_payment($id)
	{
		return $this->db->get_where('purchase_payments',['id' => $id])->result_array();
	}

	public function make_query()  
	{  
		$this->db->select($this->select_column);  
		$this->db->from($this->table); 
		$this->db->order_by('date','desc');
		if(isset($_POST["search"]["value"]))  
		{  
			
		}  
		if(isset($_POST["order"]))  
		{  
		    $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
		}  
		else  
		{  
		    $this->db->order_by('id', 'DESC');  
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