<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoriesModel extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function all_categories()
    {
        return $this->db->select('*')
                        ->where(array('status' => 1, 'is_deleted' => 0))
                        ->order_by('updated_at', 'DESC')
                        ->get('categories')
                        ->result_array();
    }

    public function save_category($data)
    {
        $this->db->insert_batch('categories', $data);
        return $this->db->insert_id();
    }

    public function edit_category($data, $id)
    {
        $this->db->where('id', $id)->update('categories', $data);
        return $id;
    }

    public function delete_category($data, $id)
    {
        $this->db->where('id', $id)->update('categories', $data);
        return $id;
    }
}