<?php
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->stencil->title('Dashboard');
        $this->stencil->data(array(
            'tagline' => 'Yes this is Administrator Panel'
        ));
        
        $this->stencil->paint('admin/dashboard');
    }
}