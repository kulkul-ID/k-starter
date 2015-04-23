<?php
class Login extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        /* check logged in user */
        $this->_check_user();
        
        $this->stencil->title('Login | Administrator Panel');
        
        /* load style on controller */
        $this->stencil->css(array(
            'bootstrap.min.css',
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
            'AdminLTE.min.css',
            asset_url('plugins/iCheck/square/blue.css')
        ));
        
        /* load script on controller */
        $this->stencil->js(array(
            'jQuery-2.1.3.min.js',
            'bootstrap.min.js',
            asset_url('plugins/iCheck/icheck.min.js')
        ));
        
        if($this->input->method() != 'post')
        {
            $this->stencil->data($this->session->flashdata());
            $this->stencil->layout('admin/login-layout');
            $this->stencil->paint('admin/login');
        }else{
            
        }
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
            }elseif($user->is_admin == 1){
                redirect('admin');
            }
        }
    }
}