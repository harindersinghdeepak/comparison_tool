<?php
class login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model(MODELS_PATH . 'LoginModel');
		$this->load->library('session');
		$this->_outData['role_data'] = $this->session->userdata('userAccess');
	}

	public function index()
	{
		if ($this->input->server('REQUEST_METHOD') == 'GET')
		{
			$isLoggedIn = $this->session->userdata('userAccess');
			if ($isLoggedIn)
			{
				redirect(CONTROLLERS_PATH . "manage/categories", 'refresh');
			}

			$this->load->view('manage/include/header');
			$this->load->view(VIEWS_PATH . 'login/login');
			$this->load->view('manage/include/footer');
		}
		else
		{
			$this->session->unset_userdata('userAccess');
			$params = $this->input->post();
			if ($params['username'] == "" || $params['password'] == "")
			{
				$this->session->set_flashdata('error', "Incorrect credentials");
				redirect('/manage/login', 'refresh');
			}
			else
			{
				$result = $this->LoginModel->is_user_exist($params['username'], $params['password']);
				if($result)
				{
					$this->session->set_userdata('userAccess', $result);
					redirect(CONTROLLERS_PATH . 'categories', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Incorrect Credentials');
					redirect(CONTROLLERS_PATH . 'login', 'refresh');
				}
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('userAccess');
		redirect(CONTROLLERS_PATH . 'login', 'refresh');
	}
}