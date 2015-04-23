<?php
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class User_Model extends MY_Model
{
    var $table = 'user';
    
    var $before_create = array('en_pass');
    
    var $before_update = array('en_pass');
    
    public function __construct()
    {
        parent::__construct();
    }

    public function en_pass($row)
    {
    	$this->load->library('encrypt');
    	if(isset($row['password']) && $row['password'] != '') 
    		$row['password'] = $this->encrypt->encode($row['password']);
    	return $row;
    }
}