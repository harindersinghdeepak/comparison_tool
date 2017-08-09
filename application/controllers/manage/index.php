<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		// $this->load->model(MODELS_PATH.'ReportsModel');
		
	}

	public function index()
	{
		$this->load->view('manage/include/header');
		// $this->load->view(VIEWS_PATH.'reports_sales');
		$this->load->view('manage/include/footer');
	}
}
