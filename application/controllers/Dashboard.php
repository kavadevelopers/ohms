<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->auth->check_session();
    }


	public function index()
	{	
		$data['_title']	= "Dashboard";
		$this->load->template('dashboard',$data);
	}

	function logout()
	{
	    $user_data = $this->session->all_userdata();
	    $this->session->unset_userdata($user_data['id']);
	    $this->session->sess_destroy();
	    redirect(base_url());
	}

}
