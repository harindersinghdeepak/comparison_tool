<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model(MODELS_PATH . '../IndexModel');
	}

	public function index()
	{
		$this->_outData['categories_and_images'] = $this->IndexModel->all_category_images();

		$this->load->view('include/header', $this->_outData);
		$this->load->view(VIEWS_PATH . '../index/index');
		$this->load->view('include/footer');
	}
}