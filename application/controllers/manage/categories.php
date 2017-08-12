<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model(MODELS_PATH . 'CategoriesModel');

		$is_user_loggedin = $this->session->userdata('userAccess');
        if (!$is_user_loggedin)
        {
        	redirect(CONTROLLERS_PATH . 'login', 'refresh');
        }
	}

	public function index()
	{
		$this->_outData['categories'] = $this->CategoriesModel->all_categories();

		$this->load->view('manage/include/header', $this->_outData);
		$this->load->view(VIEWS_PATH . '/categories/all_categories');
		$this->load->view('manage/include/footer');
	}

	public function save_categories()
	{
		$params = $this->input->post();
		parse_str($params['form_data'], $data);
		$data = array_filter($data['category_name']);

		if (sizeof($data) > 0)
		{
			try
			{
				$categories = array();
				foreach ($data as $keyD => $valueD)
				{
					$categories[$keyD]['category_name'] = $valueD;
					$categories[$keyD]['created_at'] = date("Y-m-d H:i:s");
				}
				$insert_res = $this->CategoriesModel->save_category($categories);

				echo json_encode(array("status" => 1, "message" => "Saved Successfully"));die;
			}
			catch (Exception $e)
			{
				echo json_encode(array("status" => 0, "message" => $e->getMesssage()));die;
			}
		}
		else
		{
			echo json_encode(array("status" => 0, "message" => "Please enter atleast one category"));die;
		}
	}

	public function edit_category()
	{
		try
		{
			$insert_res = $this->CategoriesModel->edit_category(array("category_name" => $this->input->post('category_name'), "updated_at" => date('Y-m-d H:i:s')), $this->input->post('id'));
			echo json_encode(array("status" => 1, "message" => "Edited Successfully"));die;
		}
		catch (Exception $e)
		{
			echo json_encode(array("status" => 0, "message" => $e->getMesssage()));die;
		}
	}

	public function delete_category()
	{
		try
		{
			$insert_res = $this->CategoriesModel->delete_category(array("is_deleted" => 1, "updated_at" => date('Y-m-d H:i:s')), $this->input->post('id'));
			echo json_encode(array("status" => 1, "message" => "Deleted Successfully"));die;
		}
		catch (Exception $e)
		{
			echo json_encode(array("status" => 0, "message" => $e->getMesssage()));die;
		}
	}
}