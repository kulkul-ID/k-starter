<?php
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Config_model extends MY_Model
{
    var $table = 'configs';
    
    public function __construct()
    {
        parent::__construct();
    }
}