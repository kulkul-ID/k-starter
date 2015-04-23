<?php

class User extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();

        /* the layout */
        $this->stencil->layout('single-col-layout.php');

        /* the slices */
        $this->stencil->slice(array(
            'footer',
            'header'
        ));
        
        $this->load->library('kulkul_auth');
        $this->load->model('user_model');
    }
    
    /**
     * User Profile Page
     **/
    public function index()
    {
        /* check if active user */
        if(!$this->kulkul_auth->restart()) redirect('user/login');

        /* the message */
        if($this->session->flashdata('info'))
            $this->stencil->data('message', $this->session->flashdata('info'));
            
        /* display the data */
        $this->stencil->title('My Personal Data');
        $this->stencil->data('user', $this->kulkul_auth->user());
        $this->stencil->paint('user/user');
    }

    /**
     * User Login
     **/
    public function login()
    {
        /* the data */
        $this->stencil->title('Login');

        /* check if login */
        if($this->kulkul_auth->restart()) redirect('user');

        /* the message */
        if($this->session->flashdata('info'))
            $this->stencil->data('message', $this->session->flashdata('info'));

        if($this->input->method() != 'post')
        {
            /* paint the view */
            $this->stencil->paint('user/login');
        }else{
            if($this->input->post('email') == '' ||
                $this->input->post('password') == '')
            {
                $data['error'] = 'Email and password did not match.';
                $this->stencil->paint('user/login', $data);
            }else{

                $auth_value = $this->input->post();
                $this->kulkul_auth->set_value($auth_value);

                if($this->kulkul_auth->start())
                {
                    /* redirection */
                    if($this->input->get('redirect')) 
                        redirect($this->input->get('redirect'));
                    
                    redirect('user');
                }else{
                    $data['error'] = 'Email and password did not match.';
                    
                    /* set error message */
                    $this->session->set_flashdata('error', $data['error']);
                    if($this->input->get('error')) redirect($this->input->get('error'));
                    
                    $this->stencil->paint('user/login', $data);
                }
            }
        }
    }

    /**
     * User Logout
     **/
    public function logout()
    {
        $this->kulkul_auth->shutdown();
        $this->session->set_flashdata('info', 'You have been logout.');
        redirect('user/login');
    }
    
    /**
     * Reset Password
     **/
    public function reset_password()
    {
        /* the data */
        $this->stencil->title('Reset Password');
        $this->stencil->data($this->session->flashdata());
        
        if($this->input->method() != 'post')
        {
            $this->stencil->paint('user/reset-password');
        }else{
            /* find the user */
            $user = $this->user_model->get_by(array('email' => $this->input->post()));
            
            if(!isset($user->email))
            {
                $this->session->set_flashdata('error', 'Your account is not found. Please register.');
            }else{
                $this->load->library('encrypt');
                $this->load->helper('string');
                
                /* generate password */
                $rand = random_string('alnum', 8);
                
                /* encode */
                $new_password = $this->encrypt->encode($rand);
                
                $this->user_model->update($user->id, array('password' => $new_password));
                
                $this->_send_password($user, $rand);
                
                $this->session->set_flashdata('info', 'Your new password has been sent to you email. If there is no email, please cheak the spam nor other folder.');
            }
            redirect('user/reset-password');
        }
    }

    /**
     * User Register
     **/
    public function register()
    {
        /* check if login */
        if($this->kulkul_auth->restart()) redirect('user');
        
        $this->stencil->title('Register');
        
        if($this->input->method() != 'post')
        {
            $this->stencil->paint('user/register');
        }else{
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
            
            if($this->form_validation->run() === FALSE)
            {
                $this->stencil->data('error', $this->form_validation->error_array());
                $this->stencil->paint('user/register');
            }else{
                $this->load->library('encrypt');
                
                $user = array(
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'password' => $this->encrypt->encode($this->input->post('password')),
                    'is_admin' => 0,
                    'active' => 0
                );
                
                $id = $this->user_model->insert($user);
                
                $new_user = $this->user_model->get($id);
                $this->_send_activation($new_user);
                
                $this->session->set_flashdata('info', 'Register succeed. Please activate your account.');
                redirect('user/login');
            }
        }
    }
    
    public function activate($key)
    {
        $this->load->library('encrypt');
        
        /* decode */
        $key = urldecode($key);
        $key = urldecode($key);
        
        $id = $this->encrypt->decode($key);
        
        $this->user_model->update($id, array('active' => 1));
        
        $this->session->set_flashdata('info', 'Your account is active. Please login to access your account.');
        redirect('user/login');
    }
    
    /**
     * Update Profile
     **/
    public function update()
    {
        /* check if login */
        if(!$this->kulkul_auth->restart()) redirect('user/login');
        
        /* the data */
        $this->stencil->title('Update Profile');

        /* the message */
        if($this->session->flashdata('info'))
            $this->stencil->data('message', $this->session->flashdata('info'));
        
        $data['user'] = (object) $this->kulkul_auth->user();
        
        if($this->input->method() != 'post')
        {
            /* paint the view */
            $this->stencil->paint('user/update', $data);
        }else{
            /* validation */
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            
            /* data not valid */
            if($this->form_validation->run() === FALSE)
            {
                $this->stencil->paint('user/update', $data);
            }else{
                /* valid */
                $this->user_model->update($data['user']->id, array(
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email')
                ));
                
                $this->session->set_flashdata('info', 'Your profile have been updated.');
                redirect('user');
            }
        }
    }
    
    /**
     * Change Password
     **/
    public function change_password()
    {
        /* check if login */
        if(!$this->kulkul_auth->restart()) redirect('user/login');
        
        /* the data */
        $this->stencil->title('Change Password');

        /* the message */
        if($this->session->flashdata('info'))
            $this->stencil->data('message', $this->session->flashdata('info'));
        
        $data['user'] = (object) $this->kulkul_auth->user();
        
        if($this->input->method() != 'post')
        {
            /* paint the view */
            $this->stencil->paint('user/change-password', $data);
        }else{
            /* validation */
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_password_check');
            $this->form_validation->set_rules('password', 'New Password', 'required');
            $this->form_validation->set_rules('re_password', 'Password Confirmation', 'required|matches[password]');
            
            /* data not valid */
            if($this->form_validation->run() === FALSE)
            {
                $this->stencil->paint('user/change-password', $data);
            }else{
                /* valid */
                $this->load->library('encrypt');
                
                $this->user_model->update($data['user']->id, array(
                    'password' => $this->encrypt->encode($this->input->post('password'))
                ));
                
                $this->session->set_flashdata('info', 'Your password has been changed.');
                redirect('user'); 
            }
        }
    }
    
    /**
     * Validation for password checker
     **/
    public function password_check($str = '')
    {
         if($str != '')
         {
            /* check the password */
            $this->load->library('encrypt');
            
            $user = (object) $this->kulkul_auth->user();
            $pasword = $this->encrypt->decode($user->password);
            
            if($pasword == $str)
            {
                return TRUE;
            }else{
                $this->form_validation->set_message('password_check', 'The {field} is mismatch.');
                return FALSE;
            }
         }         
    }
    
    /**
     * Send password
     * 
     * @param obj User object
     * @param str New password
     **/
    private function _send_password($user, $new_password)
    {
        /* get the admin */
        $admin = $this->user_model->limit(1)->get_by(array('is_admin' => 1));
        
        $data = array(
            'user'      => $user,
            'password'  => $new_password
        );
        
        $message = $this->load->view('mail/user-send-password', $data, TRUE);
        
        $this->load->library('email');
        
        $this->mailtype = 'html';
        $this->email->from($admin->email, $admin->full_name);
        $this->email->to($user->email, $user->full_name);
        
        $this->email->subject('You password has been reset');
        $this->email->message($message);
        
        $this->email->send();
    }
    
    public function naskleng()
    {
        $user_id = 2;
        $user = $this->user_model->get($user_id);
        $this->_send_activation($user);
    }
    
    /**
     * Send password
     * 
     * @param obj User object
     **/
    private function _send_activation($user)
    {
        /* get the admin */
        $admin = $this->user_model->limit(1)->get_by(array('is_admin' => 1));
        
        $data = array(
            'user' => $user
        );
        
        $message = $this->load->view('mail/user-send-acivation', $data, TRUE);
        
        echo $message;
        
        $this->load->library('email');
        
        $this->mailtype = 'html';
        $this->email->from($admin->email, $admin->full_name);
        $this->email->to($user->email, $user->full_name);
        
        $this->email->subject('Please activate yout account.');
        $this->email->message($message);
        
        $this->email->send();
    }
}
