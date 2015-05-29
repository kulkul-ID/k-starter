<?php 

class Test extends Front_Controller{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->helper('config');
        echo config('site', 'name');
    }
}