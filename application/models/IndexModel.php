<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IndexModel extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function all_category_images()
    {
        $categories = $this->db->select('*')
                        ->where(array('status' => 1, 'is_deleted' => 0))
                        ->order_by('category_name', 'ASC')
                        ->get('categories')
                        ->result_array();
        $cat_images = array();
        foreach ($categories as $keyC => $valueC)
        {
            $images = $this->db->select('*')
                            ->where(array('status' => 1, 'is_deleted' => 0, 'image_type' => 'item', 'image_category' => $valueC['id']))
                            ->order_by('image_name', 'ASC')
                            ->get('images')
                            ->result_array();

            $categories[$keyC]['category_images'] = $images;
        }
// print_r($categories);die;
        return $categories;
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