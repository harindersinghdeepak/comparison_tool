<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('manage/LibraryModel');
		$this->load->model('manage/CategoriesModel');
		
		$is_user_loggedin = $this->session->userdata('userAccess');
		if (!$is_user_loggedin)
        {
        	redirect(CONTROLLERS_PATH . 'login', 'refresh');
        }
	}

	public function index()
	{
		$sort = $this->input->get('sort');
		if($sort)
		{
			if($sort == 'name-asc')
			{
				$order = 'i.image_name asc';
			}
			elseif($sort == 'category-asc')
			{
				$order = 'c.category_name asc';
			}
			else
			{
				$order = 'i.id desc';
			}
		}
		else
		{
			$order = 'i.id desc';
		}

		$data['data'] = $this->LibraryModel->getLibraries($order);
		$data['category'] = $this->CategoriesModel->all_categories();
		$data['sort'] = $sort;
		// print_r($data['data']);die;
		$this->load->view('manage/include/header', $data);
		$this->load->view('manage/library/index');
		$this->load->view('manage/include/footer');
	}

	public function uploadImage()
	{
		if (!empty($_FILES)) 
		{
			if($_FILES['image']['error'] == 0)
			{
				$params = $this->input->post();

				$folderName = $params['folderName'];
				$rp = realpath(getcwd());  
   				$file = $_FILES['image'];
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

					// if(isset($params['oldRecordId']) && $params['oldRecordId'] != '')
					// {
					// 	$data['updated_at'] = date('Y-m-d H:i:s');
					// 	$this->LibraryModel->updateImage($params['oldRecordId'], $data);
					// 	$insertId = $params['oldRecordId'];
					// }
					// else
					// {
						// $data['image_type'] = 'item';
						// $data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
						// $insertId = $this->LibraryModel->saveImage($data);
					// }
					
					echo json_encode(array('status' => 'success', 'path' => $dest, 'fileName' => $fileName));die();
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

	public function save_image()
	{
		$params = $this->input->post();
		$rp = realpath(getcwd());
		$source = $rp. DS . "uploadedFiles" . DS . 'library_temp' . DS . $params['image'];
		$dest = DS . "uploadedFiles" . DS . 'library' . DS . $params['image'];
		copy($source, $rp.$dest);

		if(file_exists($source))
		{
			unlink($source);
		}

		$data['image_name'] = $params['imageName'];
		$data['image_size'] = $params['imageSize'];
		$data['image_category'] = $params['category'];
		$data['image_path'] = $dest;
		$data['image_type'] = 'item';
		$data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
		echo $this->LibraryModel->saveImage($data);die;
	}
}
