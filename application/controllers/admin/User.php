<?php
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class User extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		/* load model */
		$this->load->model('user_model');
	}

	public function index()
	{
		$this->stencil->css(
			asset_url('plugins/datatables/dataTables.bootstrap.css'));

		$this->stencil->js(array(
			asset_url('plugins/datatables/jquery.dataTables.js'),
			asset_url('plugins/datatables/dataTables.bootstrap.js'),
			asset_url('plugins/slimScroll/jquery.slimscroll.min.js')
		));
        
		$data['users'] = $this->user_model->get_all();
		$data['tagline'] = 'Manage all users';

		$this->stencil->title('User Management');
        $this->stencil->data($this->session->flashdata());
		$this->stencil->data($data);

		$this->stencil->paint('admin/user');
	}

	public function form($id = NULL)
	{
        $data = array();
        
		if($id == NULL)
		{
			$this->stencil->title('Add New User');
		}else{
			$this->stencil->title('Update User');
			$data['user'] = $this->user_model->get($id);
		}
        
        $this->stencil->data($data);
        
		if($this->input->method() != 'post')
		{
			$this->stencil->paint('admin/user-form');
		}else{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('id', 'User ID', 'integer');
			$this->form_validation->set_rules('full_name', 'Full Name', 'required');
			if($id == NULL )
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
			if($id == NULL )
                $this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('is_admin', 'Is Admin', 'required');
			$this->form_validation->set_rules('active', 'Active', 'required');

			if($this->form_validation->run() === FALSE)
			{
				$this->stencil->paint('admin/user-form');
			}else{
				$values = array(
						'full_name' => $this->input->post('full_name'),
						'email' 	=> $this->input->post('email'),
						'password' 	=> $this->input->post('password'),
						'is_admin' 	=> $this->input->post('is_admin'),
						'active' 	=> $this->input->post('active'),
					);

				if($this->input->post('id') == '')
				{
					$this->user_model->insert($values);
					$this->session->set_flashdata('success', 'New user has been added.');
				}else{
				    if($values['password'] == '') unset($values['password']);
					$this->user_model->update($this->input->post('id'), $values);
					$this->session->set_flashdata('success', 'User has been updated.');
				}
				redirect('admin/user');
			}
		}
	}
    
    public function deactivate($id)
    {
        $values = array(
			'active' 	=> 0,
		);
        $this->user_model->update($this->input->post('id'), $values);
		$this->session->set_flashdata('success', 'User has been deactivated.');
        redirect('admin/user');
    }
    
    public function send_email($id)
    {
        $data = array();
        $this->stencil->title('Send email');
        
		if($id != NULL)
		{
			$data['user'] = $this->user_model->get($id);
		}
        
        $this->stencil->data($data);
        
        if($this->input->method() != 'post')
        {
            $this->stencil->js(asset_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'));
            $this->stencil->css(asset_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'));
            $this->stencil->paint('admin/user-send-email');
        }else{
            $user = $this->kulkul_auth->user();
            
            $this->load->library('email');

            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            
            $this->email->initialize($config);
            
            $this->email->from($user->email, $user->full_name);
            $this->email->to($this->input->post('to'));
            $this->email->cc($this->input->post('cc'));
            $this->email->bcc($this->input->post('bcc'));
            
            $this->email->subject($this->input->post('subject'));
            $this->email->message($this->input->post('body'));
            
            $this->email->send();
            
            $this->session->set_flashdata('success', 'Your email has been sent');
            redirect('admin/user');
        }
    }
}