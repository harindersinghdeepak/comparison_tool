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
                        ->get('categories')
                        ->result_array();
    }
}