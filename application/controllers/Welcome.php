<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        /* the data */
        $this->stencil->title('Welcome to K-Starter');
        $this->stencil->data(array(
            'welcome_message' => 'Welcome to K-Starter',
        ));

        /* the layout */
        $this->stencil->layout('single-col-layout.php');

        /* the slices */
        $this->stencil->slice(array(
            'footer',
            'header'
        ));

        /* paint the view */
        $this->stencil->paint('welcome');
    }

    public function two_cols()
    {
        /* the data */
        $this->stencil->title('Layout with 2 cols');
        $this->stencil->data(array(
            'welcome_message' => 'Layout with 2 cols',
        ));

        /* the layout */
        $this->stencil->layout('two-cols-layout.php');

        /* the slices */
        $this->stencil->slice(array(
            'footer',
            'header',
            'sidebar'
        ));

        /* paint the view */
        $this->stencil->paint('welcome');
    }
}
