<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$is_user_loggedin = $this->session->userdata('userAccess');
		if (!$is_user_loggedin)
        {
        	redirect(CONTROLLERS_PATH . 'login', 'refresh');
        }
		
	}

	public function index()
	{
		$this->load->view('manage/include/header');
		$this->load->view('manage/include/footer');
	}
}
