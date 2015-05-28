<?php

class Site_config extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        /* load model */
		$this->load->model('config_model');
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
        
		$data['configs'] = $this->config_model->get_all();

		$this->stencil->title('Site Configurations');
        $this->stencil->data($this->session->flashdata());
		$this->stencil->data($data);

		$this->stencil->paint('admin/site_config');
    }
    
    public function form($id = NULL)
    {
        $data = array();
        
		if($id == NULL)
		{
			$this->stencil->title('Add New Configuration');
		}else{
			$this->stencil->title('Update Configuration');
			$data['config'] = $this->config_model->get($id);
		}
        
        $this->stencil->data($data);
        
		if($this->input->method() != 'post')
		{
			$this->stencil->paint('admin/site_config-form');
		}else{
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('id', 'ID');
            $this->form_validation->set_rules('label', 'Label');
            $this->form_validation->set_rules('item', 'Config Item', 'required|alpha_numeric');
            $this->form_validation->set_rules('index', 'Item Index', 'alpha_numeric');
            $this->form_validation->set_rules('value', 'Value');
            
			if($this->form_validation->run() === FALSE)
			{
				$this->stencil->paint('admin/site_config-form');
			}else{
				$values = array(
					'label' 	=> $this->input->post('label'),
					'item' 	    => $this->input->post('item'),
					'index' 	=> $this->input->post('index'),
					'value' 	=> $this->input->post('value'),
				);

				if($this->input->post('id') == '')
				{
				    $this->config_model->insert($values);
					$this->session->set_flashdata('success', 'New user has been added.');
				}else{
				    $this->config_model->update($this->input->post('id'), $values);
					$this->session->set_flashdata('success', 'User has been updated.');
				}
                
                redirect(admin_url('site-config'));
			}
		}
	}
}