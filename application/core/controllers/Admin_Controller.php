<?php
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_check_user();
        $this->_load_layout();
    }
    
    /**
     * Check if user is already login 
     * and redirect to /user/index if not admin
     **/
    private function _check_user()
    {
        /* if already login */
        if($this->kulkul_auth->user())
        {
            $user = (object) $this->kulkul_auth->user();
            if($user->is_admin != 1)
            {
                show_error('You do not have sufficient permissions to access this page', 
                    '403',
                    'Access Forbidden');
                exit();
            }
        }else{
            redirect('admin/login');
        }
    }
    
    /**
     * Styles and scripts for admin is here
     * and also the layout
     **/
    private function _load_layout()
    {
        /* load style on controller */
        $this->stencil->css(array(
            'bootstrap.min.css',
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
            'http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css',
            'AdminLTE.min.css',
            'skins/_all-skins.min.css'
        ));
        
        /* load script on controller */
        $this->stencil->js(array(
            'jQuery-2.1.3.min.js',
            'bootstrap.min.js',
            asset_url('plugins/fastclick/fastclick.min.js'),
            'app.min.js'
        ));
        
        /* load slice */
        $this->stencil->slice(array(
            'header' => 'admin/header',
            'sidebar' => 'admin/sidebar',
            'footer' => 'admin/footer',
        ));
        
        /* pre loaded data */
        $this->stencil->data(array(
            'tagline' => ''
        ));

        $this->stencil->layout('admin/dashboard-layout');
    }
}