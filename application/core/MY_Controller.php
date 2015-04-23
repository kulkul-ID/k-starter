<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Extend the CI_Controller
 **/
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
}

require_once APPPATH.'/core/controllers/Front_Controller.php';
require_once APPPATH.'/core/controllers/Admin_Controller.php';