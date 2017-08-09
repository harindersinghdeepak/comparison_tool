<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model(MODELS_PATH . 'CategoriesModel');		
	}

	public function index()
	{
		$this->_outData['categories'] = $this->CategoriesModel->all_categories();
		
		$this->load->view('manage/include/header', $this->_outData);
		$this->load->view(VIEWS_PATH . '/categories/all_categories');
		$this->load->view('manage/include/footer');
	}
}