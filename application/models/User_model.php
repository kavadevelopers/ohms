<?php
class User_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function _user($userid)
	{
		return $this->db->get_where("user",['id' => $userid])->result_array();
	}

}

?>