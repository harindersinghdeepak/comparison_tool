<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class LoginModel extends CI_Model
{
    private $tableName = 'users';
	public function __construct() 
	{
    	parent::__construct();
        $this->load->database();
	}

    public function is_user_exist($username, $password)
    {
        return $this->db->select('*')
                        ->where(array('status' => 1, 'is_deleted' => 0, 'username' => $username, 'password' => md5($password)))
                        ->get('users')
                        ->row_array();
    }
}