<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Background extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('manage/BackgroundModel');
		
		$is_user_loggedin = $this->session->userdata('userAccess');
        if (!$is_user_loggedin)
        {
        	redirect(CONTROLLERS_PATH . 'login', 'refresh');
        }
	}

	public function index()
	{
		$data['data'] = $this->BackgroundModel->getBackgrounds();
		// print_r($data['data']);die;
		$this->load->view('manage/include/header', $data);
		$this->load->view('manage/background/index');
		$this->load->view('manage/include/footer');
	}

	public function uploadImage()
	{
		if (!empty($_FILES)) 
		{
			if($_FILES['backgound']['error'] == 0)
			{
				$params = $this->input->post();

				$folderName = $params['folderName'];
				$rp = realpath(getcwd());  
   				$file = $_FILES['backgound'];
		       	$originalName = $file["name"];
	            
	            $fileName = time() . "_" .str_replace(array(" ", "(", ")"), "_", $file["name"]);
		        
		        if (! is_dir($rp . DS . "uploadedFiles" .DS. $folderName)) 
		        {
		            mkdir($rp . DS. "uploadedFiles" . DS . $folderName, 0777, true);
		        }
		             	 
		        $dest = DS . "uploadedFiles" . DS . $folderName . DS . $fileName;     
		       	$cp = $rp . $dest;

		        if(move_uploaded_file($file["tmp_name"], $cp))
		        {
		        	$exttn = pathinfo($originalName, PATHINFO_EXTENSION);

					$data['image_path'] = $dest;
					
					if(isset($params['oldRecordId']) && $params['oldRecordId'] != '')
					{
						$data['updated_at'] = date('Y-m-d H:i:s');
						$this->BackgroundModel->updateImage($params['oldRecordId'], $data);
						$insertId = $params['oldRecordId'];
					}
					else
					{
						$data['image_type'] = 'background';
						$data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
						$insertId = $this->BackgroundModel->saveImage($data);
					}
					
					echo json_encode(array('status' => 'success', 'path' => $dest, 'id' => $insertId));die();
		        }
		        else
		        {
					echo json_encode('Error while uploading. Try again later.');die();
		        }
			}
			else
			{
				echo json_encode('File data is currupted!');die();
			}
		}
		else
		{
			echo json_encode('File is empty!');die();
		}
	}

	public function delete_image()
	{
		$id = $this->input->post('id');
		echo $this->BackgroundModel->deleteImage($id);die();
	}
}
