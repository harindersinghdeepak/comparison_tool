<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class BackgroundModel extends CI_Model
	{
        private $tableName = 'images';
        
		public function __construct() 
		{
        	parent::__construct();
            $this->load->database();            
    	}

        public function saveImage($in_data)
        {
            if(is_array($in_data) && count($in_data) > 0)
            {
                $ins_res = $this->db->insert($this->tableName, $in_data);
                if($ins_res === TRUE)
                {
                    return $this->db->insert_id();
                }
            }
            return FALSE;
        }

        public function getBackgrounds()
        {
            return $this->db->select('*')
                            ->where(array('status' => 1 , 'is_deleted' => 0, 'image_type' => 'background'))
                            ->order_by('id desc')
                            ->get($this->tableName)
                            ->result_array();
        }

        public function deleteImage($id)
        {
            $this->db->where(array('id' => $id, 'image_type' => 'background') )->update($this->tableName, array('is_deleted' => 1));
            return json_encode(array('status' => 'ok'));
        }

        public function updateImage($id, $data )
        {
            $oldImage = $this->db->select('image_path')->where(array('id' => $id, 'image_type' => 'background'))
                            ->get($this->tableName)
                            ->row_array();
            $rp = realpath(getcwd());
            if(file_exists($rp.$oldImage['image_path']))
            {
                unlink($rp.$oldImage['image_path']);
            }

            $this->db->where(array('id' => $id, 'image_type' => 'background') )->update($this->tableName, $data);
        }
        
    }