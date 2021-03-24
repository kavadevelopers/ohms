<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbbackup extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }


    public function index()
    {
    	$this->load->dbutil();

		$prefs = array(     
		    'format'      => 'zip',             
		    'filename'    => 'my_db_backup.sql'
		);


		$backup = $this->dbutil->backup($prefs); 

		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		$save = './dbbackupfolder/'.$db_name;

		$this->load->helper('file');
		write_file($save, $backup); 


		// $this->load->helper('download');
		// force_download($db_name, $backup);
		sendDbEmail($db_name);
    }
}